<!--
HUST DBMS Design - usermanage.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "用户管理 | 管理员";
	require_once('header.php');
	require_once('connectdb.php');
?>

<script type="text/javascript" src="js/banner.js"></script>
<script type="text/javascript">
	$(function() {
    var leftHeight= $(".user_info").height();
    var rightHeight= $(".query_result").height();
    if (leftHeight > rightHeight) {
      $(".query_result").height(leftHeight);
		}
		else {
      $(".user_info").height(rightHeight);   
    }
	});
</script>
<div class="header"></div>
<div class="main">
	<div class="content">
		<div>
			<marquee><span id="welcome">您好，欢迎来到机票预订系统，您可以根据您的需求搜索相应航班并预订机票。&nbsp;&nbsp;&nbsp;&nbsp;我们衷心地为您服务，客户的满意就是我们最大的期待</span></marquee>
		</div>
		<div class="user_info">
			<div class="info">
				<ul style="list-style-type: none; font-family: '华文细黑';">

<?php
	// check if admin logined
	if (!isset($_SESSION['admin_id'])) {
		$home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
	} else {
		// get admin data in database
		$userid = $_SESSION['admin_id'];
		$username = $_SESSION['admin_name'];
		$query = "SELECT Sex, Age FROM Admin WHERE Userid = '$userid'";
		$data = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($data);
		$usersex = $row['Sex'];
		$userage = $row['Age'];
		
		echo '<li style="margin-left: -20px;"><h4>已登录用户</h4></li>';
		echo '<li style="height: 20px;"></li>';
		echo '<li>用户名：'.$username.' <span style="background: #FF0070; border-radius: 5px; font-size: 12px; padding: 3px; color: white">管理员</span></li>';
		echo '<li style="height: 20px;"></li>';
		echo '<li>性别：'.$usersex.'</li>';
		echo '<li style="height: 20px;"></li>';
		echo '<li>年龄：'.$userage.'</li>';
		echo '<li style="height: 20px;"></li>';
		echo '<li>';
		echo '<a href="logout.php"><input style="height: 30px; width: 80px; background-color: #ffffff; color: #555555; border: 1px solid #cccccc; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="退出"></a>';
		echo '</li>';
	}
?>

			</ul>
		</div>
		<div class="functions">
			<ul style="list-style-type: none;">
				<li style="margin-left: -39px; width: 310px; cursor: pointer;"><a href="index.php"><img src="img/home_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="usermanage.php"><img src="img/user_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="query.php"><img src="img/query_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="flightmanage.php"><img src="img/flight_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="reservemanage.php"><img src="img/reserve_button.png"/></a></li>
			</ul>
		</div>
		<br style="clear:both;"/>
	</div>
		<div class="query_result">
			<div class="query">
        <span style="color: red;">Tip: 您不可以直接删除已持有订单的用户哦</span>
				<img style="margin-top:10px" src="img/user_manage.png"/>
				<table class="flight">
					<tr class="th_list">
						<th width="80">用户名</th>
						<th width="30">性别</th>
						<th width="30">年龄</th>
						<th width="70">邮箱</th>
						<th width="70">电话</th>
						<th width="70">注册时间</th>
            <th width="30">订票数</th>
						<th width="75">修改</th>
						<th width="75">删除</th>
          </tr>

<?php
	$query = "SELECT * FROM User";
	$data = mysqli_query($conn, $query);
	$count = 0;
	foreach($data as $queryline) {
    $userid = $queryline['Userid'];
    $query = "SELECT * FROM FlightReserve WHERE Userid = '$userid'";
    $data = mysqli_query($conn, $query);
    $ticket_num = mysqli_num_rows($data);
		$count += 1;
		echo '<tr>';
		if ($count % 2 == 0) {
			echo '<td style="background: #ffffff">'.$queryline['Username'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['Sex'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['Age'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['Email'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['Phone'].'</td>';
      echo '<td style="background: #ffffff">'.$queryline['Jointime'].'</td>';
      echo '<td style="background: #ffffff">'.$ticket_num.'</td>';
			echo '<td style="background: #ffffff"><a href="modifyuser.php?userid='.$queryline['Userid'].'"><input class="booting_btn" type="button" value="修改"></a></td>';
			echo '<td style="background: #ffffff"><a href="deleteuser.php?userid='.$queryline['Userid'].'"><input class="refund_btn" type="button" value="删除"></a></td>';
		}
		else {
			echo '<td>'.$queryline['Username'].'</td>';
			echo '<td>'.$queryline['Sex'].'</td>';
			echo '<td>'.$queryline['Age'].'</td>';
			echo '<td>'.$queryline['Email'].'</td>';
			echo '<td>'.$queryline['Phone'].'</td>';
			echo '<td>'.$queryline['Jointime'].'</td>';
      echo '<td>'.$ticket_num.'</td>';
			echo '<td><a href="modifyuser.php?userid='.$queryline['Userid'].'"><input class="booting_btn" type="button" value="修改"></a></td>';
			echo '<td><a href="deleteuser.php?userid='.$queryline['Userid'].'"><input class="refund_btn" type="button" value="删除"></a></td>';
		}
		echo '<tr/>';
	}
?>

				</table>
			</div>
			<br style="clear:both;"/>
		</div>
		<br style="clear:both;"/>
	</div>
</div>

<?php
	mysqli_close();
  require_once('footer.php');
?>