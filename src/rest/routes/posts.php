<?php

$app->post('/posts/new', function($request, $response) {
   try{
       $con = $this->db;
       $sql = "INSERT INTO `pp`( `post_title`,`post_content`,`slug`,`layout`,`type`) VALUES (:post_title,:post_content,:slug,:layout,:type)";
       $pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
       $values = array(
         ':post_title' => $request->getParam('post_title'),
         ':post_content' => $request->getParam('post_content'),
         ':slug' => $request->getParam('slug'),
         ':layout' => $request->getParam('layout'),
         ':type' => 'post',
//Using hash for password encryption
       );
       $result = $pre->execute($values);
       return $response->withJson(array('status' => 'New Post Created'),200);
   }
   catch(\Exception $ex){
       return $response->withJson(array('error' => $ex->getMessage()),422);
   }
});
