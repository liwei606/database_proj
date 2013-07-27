<?php
include __DIR__ . '/header.php';
?>
<h1>登录</h1>

<ul class="nav nav-pills" id="loginTab">
  <li class="active"><a href="#userLogin" data-toggle="tab">普通用户</a></li>
  <li><a href="#adminLogin" data-toggle="tab">管理员</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="userLogin">
    <form class="form-horizontal" method="POST" action="user-login.php">
      <div class="control-group">
        <label class="control-label" for="inputUsername">用户名</label>
        <div class="controls">
          <input type="text" id="inputUsername" placeholder="用户名" name="username">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">密码</label>
        <div class="controls">
          <input type="password" id="inputPassword" placeholder="密码" name="password">
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">普通用户登录</button>
        </div>
      </div>
    </form>
  </div>
  <div class="tab-pane" id="adminLogin">
    <form class="form-horizontal" method="POST" action="admin-login.php">
      <div class="control-group">
        <label class="control-label" for="inputUsername">用户名</label>
        <div class="controls">
          <input type="text" id="inputUsername" placeholder="用户名" name="username">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">密码</label>
        <div class="controls">
          <input type="password" id="inputPassword" placeholder="密码" name="password">
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">管理员登录</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
include __DIR__ . '/footer.php';
