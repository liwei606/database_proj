<?php require_once __DIR__ . '/config.php'; ?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <title>药品管理系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/override.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
  <div class="masthead">
    <?php if (is_logged_in()): ?>
      <ul class="nav nav-pills pull-right">
		<form class="navbar-search pull-left" action="" method="GET">
		  <input type="text" name="q" value="<?= fRequest::get('q') ?>" class="search-query" placeholder="Search">
		</form>
        <li><a href="logout.php">登出</a></li>
        <?php if ($_SESSION['is_admin']): ?>
          <li class="active"><a><?= Administrator::fetchName($_SESSION['username']) ?> (管理员)</a></li>
		  <div class="btn-group" style="margin-top:40px;margin-bottom:40px">
		  <button class="btn"><a href="admin-drugs.php">查询药品</a></button>
		  <button class="btn"><a href="history.php">药品更改记录</a></button>
		  <button class="btn"><a href="all-applications.php">处理使用申请</a></button>
		  <button class="btn"><a href="notifications.php">库存提醒</a></button>
		  </div>
		  
        <?php else: ?>
          <li class="active"><a><?= User::fetchName($_SESSION['username']) ?> (普通用户)</a></li>
		  <div class="btn-group" style="margin-top:40px;margin-bottom:40px">
		  <button class="btn"><a href="drugs.php">查询药品</a></button>
		  <button class="btn"><a href="my-applications.php">查询申请结果</a></button>
		  </div>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
    <h2 class="muted">药品管理系统</h2>
	<hr/>
  </div>
