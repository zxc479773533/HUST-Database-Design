<!--
HUST DBMS Design - login.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "登录";
  require_once('header.php');

  // Set error message
  $error_msg = "";

  // Check if user logined
  if (!isset($_SESSION['user_id'])) {
    // Check if submit login request
    if (!isset($_POST['submit'])) {
      // Connect to database
      require_once('connectdb.php');

      // Get data in form
      $user_username = mysqli_real_escape_string($conn, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($conn, trim($_POST['password']));

      // Check user vaildation
      if (!empty($user_username) && !empty($user_password)) {
        $query = "SELECT Userid, Username FROM User WHERE Username = '$user_username' AND ".
        "Password = SHA('$user_password')";
        $data = mysqli_query($conn, $query);

        // Set login session
        if (mysqli_num_rows($data) == 1) {
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['Userid'];
          $_SESSION['user_name'] = $row['Username'];
          $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
          header('Location: '.$home_url);
        }
        else {
          // Not find this user
          $error_msg = "用户名或密码不存在，请重新登录！";
        }
      }
      else {
        // Not input username or password
        $error_msg = "请输入用户名和密码！";
      }
    }
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/user.html';
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
				<li style="padding-top: 5px; color: rgb(102, 102, 102)">1、本系统提供全面的航班搜索功能和购票、退票功能，欢迎使用。</li>
				<li style="padding-top: 10px; color: rgb(102, 102, 102)">2、购票之后，在航班起飞前一天您登录后将会给您取票提示，以免您错过取票时间。</li>
				<li style="padding-top: 10px; color: rgb(102, 102, 102)">3、购票，退票业务办理请不晚于航班起飞前24小时。因个人原因造成的时间延误请自行承担后果。</li>
			</ul>
		</div>
		<div class="login">
			<form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				 <ul style="list-style-type: none; margin-left: -20px;">
				 	<li style="height: 140px;"></li>
				 	<li class="inputli"><span class="lable">用户名：</span><input class="inputtxt" type="text" name="username" maxlength="12" style="width: 300px;"></li>
				 	<li style="height: 10px;"></li>
				 	<li class="inputli"><span class="lable">密码：</span><input class="inputtxt" type="password" name="password" maxlength="25" style="width: 300px;"></li>
				 	<li style="height: 20px;"></li>
          <li style="padding-left: 120px;">
            <input class="login-button" type="submit" value="登录">
            <a href="regist.php"><input class="regist-button" style="margin-left: 60px" type="button" value="注册"></a>
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