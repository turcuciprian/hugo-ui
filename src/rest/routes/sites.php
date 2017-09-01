<?php
$app->post('/site', function($request, $response) {
   try{
       $con = $this->db;
       $sql = "INSERT INTO `sites` (`site_name`,`user_id`) VALUES (:site_name, :user_id)";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
       $values = array(
//Using hash for password encryption
       ':site_name' => $request->getParam('site_name'),
       ':user_id' => $request->getParam('user_id'),
       );
       $token = $request->getParam('token');
       $tokenValid = validateToken($token);
        $result = $pre->execute($values);
        if($tokenValid){
          if($result){
              return $response->withJson(array('status' => 'site created','result'=> $result),200);
          }else{
              return $response->withJson(array('status' => 'site can not be created'),422);
          }
        }else{
          return $response->withJson(array('status' => 'Token invalid'),422);
        }
       }
       catch(\Exception $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
       }
     });        //create a new site


       $app->put('/site/{id}',function($request,$response) {
          try{
              $id  = $request->getAttribute('id');
              $con = $this->db;
              $sql = "UPDATE sites SET site_name=:site_name,user_id=:user_id WHERE id = :id";
              $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
              $values = array(
              ':site_name' => $request->getParam('site_name'),
              ':user_id' => $request->getParam('user_id'),
              ':id' => $id
              );
              $token = $request->getParam('token');
              $tokenValid = validateToken($token);
              $result =  $pre->execute($values);
              if($tokenValid){
              if($result){
                  return $response->withJson(array('status' => 'Site Updated'),200);
              }else{
                  return $response->withJson(array('status' => 'Site Not Found'),422);
              }
            }else{
              return $response->withJson(array('status' => 'Token invalid'),422);
          }
          exit();
          catch(\Exception $ex){
              return $response->withJson(array('error' => $ex->getMessage()),422);
          }

       } );         //update a site
