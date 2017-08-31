<?php
$config = [
  'db' => [
     'servername' =>'localhost',
     'username' => 'root',
     'password' => '',
     'dbname' => 'hugouidb',
  ]
];

/*

CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `username` varchar(255) NOT NULL UNIQUE,
 `email` varchar(255) NOT NULL UNIQUE,
 `password` varchar(255) NOT NULL,
 `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pp`(
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `post_title` varchar(255) NOT NULL ,
 `post_content` TEXT CHARACTER SET latin1 COLLATE latin1_general_cs,
 `post_status` varchar(50) NOT NULL,
 `post_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `slug` varchar(255) NOT NULL,
 `layout` varchar(255) NOT NULL,
 `url` varchar(255) NOT NULL,
 `site_id` int(11) NOT NULL,
 `type` varchar(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `sites`(
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `site_name` varchar(255) NOT NULL ,
 `user_id` int(11) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8

*/
