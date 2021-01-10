<?php
if (!session_id()) {
    @session_start();
}
use \Components\QueryBuilder;
use \Tamtamchik\SimpleFlash\Flash;

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];

$db = new QueryBuilder;

if($db->update(['username' => $username, 'email' => $email], $id, 'users')) {
    Flash::message('User updated!', 'success');
} else {
    Flash::message('Something went wrong!', 'error');
}

header('Location: /');