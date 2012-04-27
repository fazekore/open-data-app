<?php

function user_create ($db, $email, $password) {
	$sql = $db->prepare('
		INSERT INTO users (email, password)
		VALUES (:email, :password)
	');
	$sql->bindValue(':email', $email, PDO::PARAM_STR);
	$sql->bindValue(':password', get_hashed_password($password), PDO::PARAM_STR);
	$sql->execute();
}

function user_get ($db, $email) {
	$sql = $db->prepare('
		SELECT id, email, password
		FROM users
		WHERE email = :email
	');
	$sql->bindValue(':email', $email, PDO::PARAM_STR);
	$sql->execute();

	return $sql->fetch();
}

function user_signed_in () {
	session_start();

	if (
		isset($_SESSION['id'])
		&& !empty($_SESSION['id'])
		&& isset($_SESSION['fingerprint'])
		&& $_SESSION['fingerprint'] == get_fingerprint($_SESSION['id'])
	) {
		return true;
	}

	return false;
}

function user_sign_in ($id) {
	session_regenerate_id();
	$_SESSION['id'] = $id;
	$_SESSION['fingerprint'] = get_fingerprint($id);
}

function user_sign_out () {
	session_start();
	$_SESSION = array();
	session_destroy();
}

function passwords_match ($password, $stored_hash) {
	return crypt($password, $stored_hash) == $stored_hash;
}

function get_hashed_password ($password) {
	$rand = substr(strtr(base64_encode(openssl_random_pseudo_bytes(16)), '+', '.'), 0, 22);
	$salt = '$2a$12$' . $rand;

	return crypt($password, $salt);
}

function get_fingerprint ($id) {
	return sha1($id . $_SERVER['HTTP_USER_AGENT'] . session_id() . $_SERVER['REMOTE_ADDR']);
}
