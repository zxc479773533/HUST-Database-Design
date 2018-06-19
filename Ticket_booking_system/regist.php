<!--
HUST DBMS Design - regist.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "注册";
  require_once('header.php');

  // Set error message
  $error_msg = "";

  // Connect to database
  require_once('connectdb.php');

  // Get data in form
  $regist_username = mysqli_real_escape_string($conn, trim($_POST['username']));
  $regist_password = mysqli_real_escape_string($conn, trim($_POST['password']));
  $regist_password_again = mysqli_real_escape_string($conn, trim($_POST['password_again']));
  $regist_sex = mysqli_real_escape_string($conn, trim($_POST['sex']));
  $regist_age = mysqli_real_escape_string($conn, trim($_POST['age']));
  $regist_email = mysqli_real_escape_string($conn, trim($_POST['email']));
  $regist_phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
  $regist_vaildcode = mysqli_real_escape_string($conn, trim($_POST['vaildcode']));
  $regist_vaildcode_again = mysqli_real_escape_string($conn, trim($_POST['vaildcode_again']));

  // Check input data
  if (!empty($regist_username) && !empty($regist_password) && !empty($regist_password_again)
  && !empty($regist_sex) && !empty($regist_age) && !empty($regist_email) && !empty($regist_phone)) {
    if ($regist_password == $regist_password_again) {
      if ($regist_vaildcode == $regist_vaildcode_again) {
        // Check if username existed
        $query = "SELECT * FROM User WHERE Username = '$regist_username'";
        $data = mysqli_query($conn, $query);

        if (mysqli_num_rows($data) == 0) {
          // Regist user
          $query = "INSERT INTO User (Username, Password, Sex, Age, Email, Phone, Jointime) VALUES".
          "('$regist_username', SHA('$regist_password'), '$regist_sex', '$regist_age', '$regist_email', ".
          "'$regist_phone', NOW())";
          mysqli_query($conn, $query);

          // Conform success
          mysqli_close();
          require_once('confirm.php');
          exit();
        }
        else {
          // The username exist
          $error_msg = "用户名已存在！";
        }
      }
      else {
        // The vaild code wrong
        $error_msg = "验证码输入错误！";
      }
    }
    else {
      // The password conform failed
      $error_msg = "两次输入的密码不同！";
    }
  }
  else {
    // Not input all information
    $error_msg = "请输入所有必填信息！";
  }
?>

<script type="text/javascript" src="js/vaildcode.js"></script>
<div class="header"></div>
<div class="main">
	<div class="login-frame">
		<div class="regist" onLoad="createCode()">
			<form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				 <ul style="list-style-type: none;">
				 	<li style="height: 20px;"></li>
				 	<li style="margin-left: 90px;"><h2>新用户注册</h2></li>
				 	<li class="inputli"><span class="lable"><span class="must">* </span>用户名：</span><input class="inputtxt" type="text" name="username" maxlength="12" style="width: 300px;"></li>
				 	<li style="height: 10px;"></li>
				 	<li class="inputli"><span class="lable"><span class="must">* </span>密码：</span><input class="inputtxt" type="password" name="password" maxlength="25" style="width: 300px;"></li>
				 	<li style="height: 10px;"></li>
				 	<li class="inputli"><span class="lable"><span class="must">* </span>确认密码：</span><input class="inputtxt" type="password" name="password_again" maxlength="25" style="width: 300px;"></li>
					<li style="height: 10px;"></li>
					<li class="inputli"><span class="lable"><span class="must">* </span>性别：</span>
						<select style="height:30px; width: 50px; text-align: center;" name="sex">
							<option value ="男">男</option>
							<option value ="女">女</option>
						</select>
					<li style="height: 10px;"></li>
					<li class="inputli"><span class="lable"><span class="must">* </span>年龄：</span><input class="inputtxt" type="text" name="age" maxlength="25" style="width: 100px;"></li>
				 	<li style="height: 10px;"></li>
				 	<li class="inputli"><span class="lable"><span class="must">* </span>邮箱：</span><input class="inputtxt" type="text" name="email" maxlength="25" style="width: 300px;"></li>
				 	<li style="height: 10px;"></li>
				 	<li class="inputli"><span class="lable"><span class="must">* </span>手机号：</span><input class="inputtxt" type="text" name="phone" maxlength="25" style="width: 300px;"></li>
				 	<li style="height: 10px;"></li>
					<li class="inputli"><span class="lable"><span class="must">* </span>验证码：</span>
						<input class="inputtxt" type="text" name="vaildcode" maxlength="25" style="width: 100px;">
						<input type="text" onClick="createCode()" readonly id="vaildcode_again" style="height: 30px; width: 80px; cursor:pointer; border:0;"/><br />
					</li>
				 	<li style="height: 20px;"></li>
					<li style="padding-left: 200px;">
            <input class="login-button" style="margin-left: 30px" type="submit" value="提交">
            <a href="login.php"><input class="regist-button" style="margin-left: 20px" type="button" value="返回"></a>
          </li>
					<li style="height: 10px;"></li>
					<li style="text-align: center;">
            <?php
              echo '<p style="color: red;">'.$error_msg.'</p>';
            ?>
          </li>
				 </ul>
			</form>
		</div>
		<img style="float: right; width: 230px; height: 110px; margin-top: 220px; margin-right: 15px;" src="img/plane.png"/>
	</div>
</div>

<?php
  require_once('footer.php');
?>