<?php

$app->get('/posts',function($request, $response) {
   try {
       $con = $this->db;
       $sql = "SELECT * FROM pp WHERE type = 'post';";
       $result = null;
       foreach ($con->query($sql) as $row) {
           $result[] = $row;
       }
       if ($result) {
           return $response->withJson(array('status' => 'true', 'result' => $result), 200);
       } else {
           return $response->withJson(array('status' => 'Posts Not Found'), 422);
       }
   } catch (\Exception $ex) {
       return $response->withJson(array('error' => $ex->getMessage()), 422);
   }

});
$app->get('/pages', function($request, $response) {
   try {
       $con = $this->db;
       $sql = "SELECT * FROM pp WHERE type = 'page'";
       $result = null;
       foreach ($con->query($sql) as $row) {
           $result[] = $row;
       }
       if ($result) {
           return $response->withJson(array('status' => 'true', 'result' => $result), 200);
       } else {
           return $response->withJson(array('status' => 'Pages Not Found'), 422);
       }
   } catch (\Exception $ex) {
       return $response->withJson(array('error' => $ex->getMessage()), 422);
   }

});

$app->delete('/pp/{id}', function ($request,$response) {
   try{
       $id     = $request->getAttribute('id');
       $con = $this->db;
       $sql = "DELETE FROM `pp` WHERE id = :id;";

       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

       $values = array(
       ':id' => $id);
       $result = $pre->execute($values);
       if($result){
           return $response->withJson(array('status' => 'Post Deleted'),200);
       }else{
           return $response->withJson(array('status' => 'Post Not Found'),422);
       }

   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }

});
