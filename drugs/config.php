<?php
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
session_start();

define('DB_TYPE', 'mysql');
define('DB_NAME', 'drugs');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

$db = new fDatabase(DB_TYPE, DB_NAME, DB_USER, DB_PASS, DB_HOST);
$db->execute('SET NAMES utf8');
fORMDatabase::attach($db);

/**
 * Automatically includes classes
 * 
 * @throws Exception
 * 
 * @param  string $class_name  Name of the class to load
 * @return void
 */
function __autoload($class_name)
{
    $app_root = __DIR__ . '/app/';
    $file = $app_root . $class_name . '.php';
    if (file_exists($file)) {
        include $file;
        return;
    }

    $flourish_root = __DIR__ . '/flourish/';
    $file = $flourish_root . $class_name . '.php';
    if (file_exists($file)) {
        include $file;
        return;
    }

    throw new Exception('The class ' . $class_name . ' could not be loaded');
}

function exception_handler($exception) {
  echo "Uncaught exception: " , $exception->getMessage(), "\n";
}

set_exception_handler('exception_handler');

function is_logged_in() {
  return isset($_SESSION['username']) and isset($_SESSION['is_admin']);
}

function ensure_user_logged_in() {
  if (!(is_logged_in() and !$_SESSION['is_admin'])) {
    fURL::redirect('index.php');
  }
}

function ensure_admin_logged_in() {
  if (!(is_logged_in() and $_SESSION['is_admin'])) {
    fURL::redirect('index.php');
  }
}

function hash_password($username, $password) {
  return sha1($username . sha1($password));
}
