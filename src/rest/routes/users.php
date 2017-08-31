<?php
$app->post('/login', function($request, $response) {
   try{
       $con = $this->db;
       $sql = "SELECT id FROM `users` WHERE `username`= :username AND `password` = :password;";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
       $values = array(
       ':username' => $request->getParam('username'),
//Using hash for password encryption
       ':password' => md5($request->getParam('password'))
       );
        $pre->execute($values);
       $userID = $pre->fetch();
       if(isset($userID) && $userID){
         $token = createToken($userID);
         return $response->withJson(array('status' => 'user Logged','token'=>$token),200);
       }else{
         return $response->withJson(array('error' => 'invalid username and password'),422);
       }

   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }
});


$app->post('/user', function($request, $response) {
   try{
       $con = $this->db;
       $sql = "INSERT INTO `users`(`username`, `email`,`password`) VALUES (:username,:email,:password)";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

       $values = array(
       ':username' => $request->getParam('username'),
       ':email' => $request->getParam('email'),
//Using hash for password encryption
      ':password' => md5($request->getParam('password'))
       );
       $result = $pre->execute($values);
       return $response->withJson(array('status' => 'User Created'),200);
   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }
});



           //add a user
$app->get('/user/{id}', function($request,$response) {
   try{

      $id     = $request->getAttribute('id');
       $token     = $request->getParam('token');
       $con = $this->db;
       $sql = "SELECT * FROM users WHERE id = :id";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
       $values = array(
       ':id' => $id);
       $pre->execute($values);
       $result = $pre->fetch();
       $tokenValid = validateToken($token);
       if($tokenValid){
         if($result){
             return $response->withJson(array('status' => 'true','result'=> $result),200);
         }else{
             return $response->withJson(array('status' => 'User Not Found'),422);
         }
       }else{
         return $response->withJson(array('status' => 'Token invalid'),422);
       }


   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }

});          // get user by ID




$app->get('/users/{token}', function($request,$response) {
   try{
     $token = $request->getAttribute('token');
       $con = $this->db;
       $sql = "SELECT * FROM users";
       $result = null;
       $tokenValid = validateToken($token);

       foreach ($con->query($sql) as $row) {
           $result[] = $row;

       }
       if($tokenValid){
         if($result){
             return $response->withJson(array('status' => 'true','result'=>$result),200);
         }else{
             return $response->withJson(array('status' => 'Users Not Found'),422);
         }
       }else{
         return $response->withJson(array('status' => 'Token invalid'),422);

       }


   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }

} );                 // get all users
$app->put('/user/{id}',function($request,$response) {
   try{
       $id     = $request->getAttribute('id');
       $con = $this->db;
       $sql = "UPDATE users SET name=:name,email=:email,password=:password WHERE id = :id";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
       $values = array(
       ':name' => $request->getParam('name'),
       ':email' => $request->getParam('email'),
       ':password' => password_hash($request->getParam('password'),PASSWORD_DEFAULT),
       ':id' => $id
       );
       $result =  $pre->execute($values);
       if($result){
           return $response->withJson(array('status' => 'User Updated'),200);
       }else{
           return $response->withJson(array('status' => 'User Not Found'),422);
       }

   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }

} );         //update an user



$app->delete('/user/{id}', function($request,$response) {
   try{
       $id     = $request->getAttribute('id');
       $con = $this->db;
       $sql = "DELETE FROM users WHERE id = :id";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
       $values = array(
       ':id' => $id);
       $result = $pre->execute($values);
       if($result){
           return $response->withJson(array('status' => 'User Deleted'),200);
       }else{
           return $response->withJson(array('status' => 'User Not Found'),422);
       }

   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }

}); //delete a user
