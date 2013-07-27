<?php
require_once __DIR__ . '/config.php';

if (is_logged_in()) {
  if ($_SESSION['is_admin']) {
    fURL::redirect('admin-drugs.php');
  }
  else {
    fURL::redirect('drugs.php');
  }
}
else {
  fURL::redirect('login.php');
}
