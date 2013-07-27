<?php
require_once __DIR__ . '/config.php';

$username = fRequest::get('username');
$password = fRequest::get('password');
$given_hash = hash_password($username, $password);

$user = new User($username);
$expected_hash = $user->getHashedPassword();
if ($given_hash === $expected_hash) {
  // 登录成功
  $_SESSION['username'] = $username;
  $_SESSION['is_admin'] = false;
  fURL::redirect('index.php');
}
else {
  throw new fValidationException('登录失败');
}

