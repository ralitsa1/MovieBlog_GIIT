<?php

session_start();

function login($users, $username, $password) {
	$user = \Cart\Db\read_user($users, $username, $password);

	if($user && password_verify($password, $user['password'])) {
		$_SESSION['username'] = $username;
		header('Location: product.php');
	} else {
		die('ERROR: login failed');
	}
}

function logout() {
	session_destroy();
}

function require_login() {
	if(empty($_SESSION['username'])) {
		header('Location: login.php');
		exit();
	}

}
