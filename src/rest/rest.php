<?php
//include files
require_once 'db/user.php';
$dbUser = new dbUser();

require_once 'routes/user.php';

//call the classes
$rrouteUser = new rrouteUser();
