<?php
$username = $_POST['username'];
$email = $_POST['email'];

use Components\QueryBuilder;

$db = new QueryBuilder;
$db->insert(['username' => $username, 'email' => $email], 'users');
header('Location: /');