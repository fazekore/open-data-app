<?php

require_once 'includes/db.php';
require_once 'includes/users.php';

$email = 'faze0007@algonquinlive.com';
$password = 'password';

user_create($db, $email, $password);
