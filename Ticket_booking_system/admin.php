<!--
HUST DBMS Design - login.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "管理员登录";
  require_once('header.php');

  // Set error message
  $error_msg = "";

  // Check if user logined
  if (!isset($_SESSION['admin_id'])) {
    // Check if submit login request
    if (!isset($_POST['submit'])) {
      // Connect to database
      require_once('connectdb.php');

      // Get data in form
      $user_username = mysqli_real_escape_string($conn, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($conn, trim($_POST['password']));

      // Check user vaildation
      if (!empty($user_username) && !empty($user_password)) {
        $query = "SELECT Userid, Username FROM Admin WHERE Username = '$user_username' AND ".
        "Password = SHA('$user_password')";
        $data = mysqli_query($conn, $query);

        // Set login session
        if (mysqli_num_rows($data) == 1) {
          $row = mysqli_fetch_array($data);
          $_SESSION['admin_id'] = $row['Userid'];
          $_SESSION['admin_name'] = $row['Username'];
          $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
          header('Location: '.$home_url);
        }
        else {
          // Not find this user
          $error_msg = "管理员不存在或密码错误，请重新登录！";
        }
      }
      else {
        // Not input username or password
        $error_msg = "请输入您的管理员用户和密码！";
      }
    }
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>

<div class="header"></div>
<div class="main">
	<div class="login-frame" style="height: 510px;">
		<div class="tips">
			<ul style="list-style-type: none; padding-left: 15px;">
				<li style="height: 40px;"></li>
				<li><h3>温馨提示：</h3></li>
				<li style="padding-top: 5px; color: rgb(102, 102, 102)">1、本窗口仅限管理员登录。</li>
				<li style="padding-top: 10px; color: rgb(102, 102, 102)">2、您可以录入和修改航班信息，管理用户信息。</li>
				<li style="padding-top: 10px; color: rgb(102, 102, 102)">3、对数据库的大量修改的操作请谨慎执行，必要时请先和系统负责人商量。</li>
			</ul>
		</div>
		<div class="login">
			<form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				 <ul style="list-style-type: none; margin-left: -20px;">
				 	<li style="height: 140px;"></li>
				 	<li class="inputli"><span class="lable">管理员：</span><input class="inputtxt" type="text" name="username" maxlength="12" style="width: 300px;"></li>
				 	<li style="height: 10px;"></li>
				 	<li class="inputli"><span class="lable">密码：</span><input class="inputtxt" type="password" name="password" maxlength="25" style="width: 300px;"></li>
				 	<li style="height: 40px;"></li>
          <li style="padding-left: 120px;">
            <input class="login-button" type="submit" value="登录">
            <a href="login.php"><input class="regist-button" style="margin-left: 60px;" type="button" value="返回"></a>
          </li>
          <li style="height: 20px;"></li>
					<li style="text-align: center;">
            <?php
              echo '<p style="color: red;">'.$error_msg.'</p>';
            ?>
          </li>
				 </ul>
			</form>
		</div>
	</div>
</div>

<?php
  require_once('footer.php');
?>