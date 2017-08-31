<?php

// $app->get('/sites',function($request, $response) {
//    try {
//        $con = $this->db;
//        $sql = "SELECT * FROM sites WHERE id = 'post';";
//        $result = null;
//        foreach ($con->query($sql) as $row) {
//            $result[] = $row;
//        }
//        if ($result) {
//            return $response->withJson(array('status' => 'true', 'result' => $result), 200);
//        } else {
//            return $response->withJson(array('status' => 'Posts Not Found'), 422);
//        }
//    } catch (\Exception $ex) {
//        return $response->withJson(array('error' => $ex->getMessage()), 422);
//    }
//
// });
//
//
// $app->get('/sites',function($request, $response) {
//    try {
//        $con = $this->db;
//        $sql = "SELECT * FROM sites;
//        $result = null;
//        foreach ($con->query($sql) as $row) {
//            $result[] = $row;
//        }
//        if ($result) {
//            return $response->withJson(array('status' => 'true', 'result' => $result), 200);
//        } else {
//            return $response->withJson(array('status' => 'Posts Not Found'), 422);
//        }
//    } catch (\Exception $ex) {
//        return $response->withJson(array('error' => $ex->getMessage()), 422);
//    }
// });
//
//














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
       });          // get user by ID
