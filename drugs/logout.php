<?php
require_once __DIR__ . '/config.php';
unset($_SESSION['username']);
unset($_SESSION['is_admin']);
fURL::redirect('index.php');

