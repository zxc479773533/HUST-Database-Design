<!--
HUST DBMS Design - modifyuser.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "用户信息修改 | 管理员";
  require_once('header.php');

  // Check if admin logined
  if (isset($_SESSION['admin_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $userid = $_GET['userid'];
    $query = "SELECT * FROM User WHERE Userid = '$userid'";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($data);
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/usermanage.php';
    header('Location: '.$home_url);
  }
?>

<div class="header"></div>
<div class="main">
	<div class="login-frame">
		<div class="regist">
			<form id="login-form" method="post" action="modifyprofile.php">
				 <ul style="list-style-type: none;">
				 	<li style="height: 20px;"></li>
				 	<li style="margin-left: 90px;"><img src="img/profile.png"/></li>
          <li><p style="font-size: 14px">您可以在这里修改该用户的个人信息</p></li>

<?php
  echo '<li class="inputli"><span class="lable">用户名：</span>'.$row['Username'].'</li>';
  echo '<input type="hidden" name="userid" value="'.$row['Userid'].'">';
  echo '<li style="height: 10px;"></li>';
  echo '<li class="inputli"><span class="lable">性别：</span>';
  echo '<select style="height:25px; width: 50px; text-align: center;" name="sex">';
  if ($row['Sex'] == "男") {
    echo '<option value="男" selected="selected">男</option>';
    echo '<option value="女">女</option>';
  }
  else {
    echo '<option value="男">男</option>';
    echo '<option value="女" selected="selected">女</option>';
  }
  echo '</select>';
  echo '<li style="height: 10px;"></li>';
  echo '<li class="inputli"><span class="lable">年龄：</span><input class="inputtxt" type="text" name="age" maxlength="25" style="width: 100px;" value="'.$row['Age'].'"></li>';
  echo '<li style="height: 10px;"></li>';
  echo '<li class="inputli"><span class="lable">邮箱：</span><input class="inputtxt" type="text" name="email" maxlength="25" style="width: 300px;" value="'.$row['Email'].'"></li>';
  echo '<li style="height: 10px;"></li>';
  echo '<li class="inputli"><span class="lable">手机号：</span><input class="inputtxt" type="text" name="phone" maxlength="25" style="width: 300px;" value="'.$row['Phone'].'"></li>';
  echo '<li style="height: 20px;"></li>';
  echo '<li class="inputli"><span class="lable">注册时间：</span>'.$row['Jointime'].'</li>';
  echo '<li style="height: 20px;"></li>';
?>

					<li style="padding-left: 50px;">
            <input class="login-button" style="margin-left: 60px" type="submit" value="提交">
						<a href="index.php"><input class="regist-button" style="margin-left: 60px" type="button" value="返回"></a>
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