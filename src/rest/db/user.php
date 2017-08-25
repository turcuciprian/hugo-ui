<?php
 /**
  *
  */
 class dbUser
 {
     public function createUser($xThis, $request, $username, $email)
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

     public function getUserByID($xThis, $request)
     {
         $id = $request->getAttribute('id');
         $con = $xThis->db;
         $sql = 'SELECT * FROM users WHERE id = :id';
         $pre = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
         $values = array(
       ':id' => $id, );
         $pre->execute($values);
         $result = $pre->fetch();

         return $result;
     }
     public function getAllUsers($xThis)
     {
         $con = $xThis->db;
         $sql = 'SELECT * FROM users';
         $result = null;
         foreach ($con->query($sql) as $row) {
             $result[] = $row;
         }

         return $result;
     }
 }
