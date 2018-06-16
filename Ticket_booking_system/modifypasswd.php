<!--
HUST DBMS Design - editprofile.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "个人中心";
  require_once('header.php');

  // Check if user logined
  if (isset($_SESSION['user_id'])) {
    // Set error message
    $error_msg = "";

    // Connect to database
    require_once('connectdb.php');

    // Get data in form
    $old_passwd = mysqli_real_escape_string($conn, trim($_POST['oldpasswd']));
    $new_passwd = mysqli_real_escape_string($conn, trim($_POST['newpasswd']));
    $new_passwd_again = mysqli_real_escape_string($conn, trim($_POST['newpasswd_again']));
    
    // Check input data
    if (!empty($old_passwd) && !empty($new_passwd) && !empty($new_passwd_again)) {
      if ($new_passwd == $new_passwd_again) {
        $userid = $_SESSION['user_id'];
        $query = "SELECT * FROM User WHERE Userid = '$userid' AND Password = SHA('$old_passwd')";
        $data = mysqli_query($conn, $query);

        if (mysqli_num_rows($data) == 1) {
          $query = "UPDATE User SET Password = SHA('$new_passwd') WHERE Userid = '$userid'";
          mysqli_query($conn, $query);
          mysqli_close();
          require_once('modifyconfirm.php');
          exit();
        }
        else {
          // Input the wrong answer
          $error_msg = "原密码输入错误！";
        }
      }
      else {
        // The password conform failed
        $error_msg = "两次输入的密码不同！";
      }
    }
    else {
      // Not input all information
      $error_msg = "请输入原密码和旧密码！";
    }
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>

<div class="header"></div>
<div class="main">
	<div class="login-frame">
		<div class="regist">
			<form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <ul style="list-style-type: none;">
				<li style="height: 20px;"></li>
        <li style="margin-left: 90px;"><img src="img/profile.png"/></li>
        <li style="height: 50px;"></li>
        <li><p style="font-size: 20px; margin-left: 10px;">请修改您的密码</p></li>
        <li class="inputli"><span class="lable">原密码：</span><input class="inputtxt" type="password" name="oldpasswd" maxlength="25" style="width: 300px;"></li>
				<li style="height: 20px;"></li>
				<li class="inputli"><span class="lable">新密码：</span><input class="inputtxt" type="password" name="newpasswd" maxlength="25" style="width: 300px;"></li>
				<li style="height: 20px;"></li>
				<li class="inputli"><span class="lable">确认密码：</span><input class="inputtxt" type="password" name="newpasswd_again" maxlength="25" style="width: 300px;"></li>
				<li style="height: 40px;"></li>
				<li style="padding-left: 200px;">
          <input class="login-button" style="margin-left: 30px" type="submit" value="提交">
          <a href="login.php"><input class="regist-button" style="margin-left: 20px" type="button" value="返回"></a>
        </li>
        <li style="text-align: center;">
          <?php
            echo '<p style="color: red;">'.$error_msg.'</p>';
          ?>
        </li>
			</ul>
      </form>
		</div>
		<img style="float: right; width: 160px; height: 160px; margin-top: 200px; margin-right: 50px;" src="img/editprofile.png"/>
	</div>
</div>

<?php
  require_once('footer.php');
?>