<?php
 /**
  *
  */
 class dbUser
 {
     public function __construct()
     {
         # code...
     }
     public function createUser($xThis,$request, $username, $email)
     {
         $con = $xThis->db;
         $sql = 'INSERT INTO `users` (`username`, `email`,`password`) VALUES (:username,:email,:password)';
         $pre = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
         $values = array(
     ':username' => $request->getParam($username),
     ':email' => $request->getParam($email),
     //Using hash for password encryption
     'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
     );
         $result = $pre->execute($values);
     }
 }
