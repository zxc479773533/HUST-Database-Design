<!--
HUST DBMS Design - index.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
	session_start();
  // Set page title
  $page_title = "主页 | 服务";
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
	// check if user logined
	if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
		echo '<li style="margin-top: 50px"><h2>当前未登录</h2></li>';
		echo '<li style="margin-top:30px"></li>';
		echo '<li>欢迎来到机票预定系统</li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>登录后方可预定机票</li>';
		echo '<li style="height: 30px;"></li>';
		echo '<li>';
		echo '<a href="login.php"><input style="height: 30px; width: 80px; background-color: #00a7de; color: #ffffff; border: 1px solid #0381aa; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="登录"></a>';
		echo '<a href="regist.php"><input style="margin-left: 40px; height: 30px; width: 80px; background-color: #ffffff; color: #555555; border: 1px solid #cccccc; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="注册"></a>';
		echo '</li>';
	} else if (isset($_SESSION['user_id'])) {
		// get user data in database
		$userid = $_SESSION['user_id'];
		$username = $_SESSION['user_name'];
		$query = "SELECT Sex, Age FROM User WHERE Userid = '$userid'";
		$data = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($data);
		$usersex = $row['Sex'];
		$userage = $row['Age'];
		$query = "SELECT * FROM FlightReserve WHERE Userid = '$userid'";
		$data = mysqli_query($conn, $query);
		$ticket_num = mysqli_num_rows($data);
		$query = "SELECT COUNT(*) AS Num from Notification, Flight WHERE Notification.Flightid = Flight.Flightid AND DATE(Leavetime) = DATE(NOW()) + 1 AND Userid = '$userid'";
		$data = mysqli_query($conn, $query);
		$numdata = mysqli_fetch_array($data);
		
		echo '<li style="margin-left: -20px;"><h4>已登录用户</h4></li>';
		echo '<li>用户名：'.$username.' <span style="background: #004CFF; border-radius: 5px; font-size: 12px; padding: 3px; color: white">普通用户</span></li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>性别：'.$usersex.'</li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>年龄：'.$userage.'</li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>已预定票数：'.$ticket_num.'</li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>待取票数：'.$numdata['Num'].'</li>';
		echo '<li style="height: 20px;"></li>';
		echo '<li>';
		echo '<a href="editprofile.php"><input style="height: 30px; width: 80px; background-color: #00a7de; color: #ffffff; border: 1px solid #0381aa; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="个人中心"></a>';
		echo '<a href="logout.php"><input style="margin-left: 40px; height: 30px; width: 80px; background-color: #ffffff; color: #555555; border: 1px solid #cccccc; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="退出"></a>';
		echo '</li>';
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

<?php
	if (isset($_SESSION['admin_id'])) {
		echo '<li style="margin-left: -39px; width: 310px; cursor: pointer;"><a href="index.php"><img src="img/home_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="usermanage.php"><img src="img/user_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="query.php"><img src="img/query_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="flightmanage.php"><img src="img/flight_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="reservemanage.php"><img src="img/reserve_button.png"/></a></li>';
	}
	else {
		echo '<li style="margin-left: -39px; width: 310px; cursor: pointer;"><a href="index.php"><img src="img/home_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="regist.php"><img src="img/regist_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="query.php"><img src="img/query_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="ticket.php"><img src="img/ticket_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="getticket.php"><img src="img/get_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="price.php"><img src="img/price_button.png"/></a></li>';
	}
?>

			</ul>
		</div>
		<br style="clear:both;"/>
	</div>
	<div class="query_result">
		<div class="banner">
			<div class="banner_pic">
				<a href="#" style="display: none;"><img style="display: block;" alt="#" src="img/banner1.png"/></a>
				<a href="#" style="display: none;"><img style="display: block;" alt="#" src="img/banner2.png"/></a>
				<a href="#" style="display: none;"><img style="display: block;" alt="#" src="img/banner3.png"/></a>
			</div>
			<div class="banner_btn">
				<ul>
					<li class="one">1</li>
					<li>2</li>
					<li>3</li>
				</ul>
			</div>
		</div>
		<div class="query">
			<img style="margin-top:10px" src="img/today_flight.png"/>
			<table class="flight">
				<tr class="th_list">
					<th width="45">航班次</th>
					<th width="50">商务舱</th>
					<th width="50">经济舱</th>
					<th width="70">起飞时间</th>
					<th width="70">到达时间</th>
					<th width="50">起点站</th>
					<th width="50">终点站</th>
					<th width="40">商务舱价格</th>
					<th width="40">经济舱价格</th>
					<?php
						if (isset($_SESSION['user_id']))
							echo '<th width="75">备注</th>';
					?>
				</tr>

<?php
	$query = "SELECT * FROM Flight WHERE DATE(Leavetime) = DATE(NOW()) order by Leavetime ASC LIMIT 15";
	$data = mysqli_query($conn, $query);
	$count = 0;
	foreach($data as $queryline) {
		$flightid = $queryline['Flightid'];
		$getseat = "SELECT SeatType, count(*) as Num FROM FlightSeats WHERE Flightid = '$flightid' AND SeatUse = '0' AND SeatType = '商务舱' group by SeatType";
		$Bseatdata = mysqli_query($conn, $getseat);
		$Brow = mysqli_fetch_array($Bseatdata);
		$getseat = "SELECT SeatType, count(*) as Num FROM FlightSeats WHERE Flightid = '$flightid' AND SeatUse = '0' AND SeatType = '经济舱' group by SeatType";
		$Nseatdata = mysqli_query($conn, $getseat);
		$Nrow = mysqli_fetch_array($Nseatdata);
		$count += 1;
		echo '<tr>';
		if ($count % 2 == 0) {
			echo '<td style="background: #ffffff">'.$queryline['Flightno'].'</td>';
			if (isset($Brow['Num']))
				echo '<td style="background: #ffffff">'.$Brow['Num'].'/'.$queryline['BClass'].'</td>';
			else
				echo '<td style="background: #ffffff">0/'.$queryline['BClass'].'</td>';
			if (isset($Nrow['Num']))
				echo '<td style="background: #ffffff">'.$Nrow['Num'].'/'.$queryline['NClass'].'</td>';
			else
				echo '<td style="background: #ffffff">0/'.$queryline['NClass'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['Leavetime'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['Arrivetime'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['StartStation'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['EndStation'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['BPrice'].'</td>';
			echo '<td style="background: #ffffff">'.$queryline['NPrice'].'</td>';
			if (isset($_SESSION['user_id'])) {
				if ($Brow['Num'] || $Nrow['Num'])
					echo '<td style="background: #ffffff"><a href="booting.php?flight='.$queryline['Flightid'].'"><input class="booting_btn" type="button" value="预定"></a></td>';
				else
					echo '<td style="background: #ffffff">预定</td>';
			}
		}
		else {
			echo '<td>'.$queryline['Flightno'].'</td>';
			if (isset($Brow['Num']))
				echo '<td>'.$Brow['Num'].'/'.$queryline['BClass'].'</td>';
			else
				echo '<td>0/'.$queryline['BClass'].'</td>';
			if (isset($Nrow['Num']))
				echo '<td>'.$Nrow['Num'].'/'.$queryline['NClass'].'</td>';
			else
				echo '<td>0/'.$queryline['NClass'].'</td>';
			echo '<td>'.$queryline['Leavetime'].'</td>';
			echo '<td>'.$queryline['Arrivetime'].'</td>';
			echo '<td>'.$queryline['StartStation'].'</td>';
			echo '<td>'.$queryline['EndStation'].'</td>';
			echo '<td>'.$queryline['BPrice'].'</td>';
			echo '<td>'.$queryline['NPrice'].'</td>';
			if (isset($_SESSION['user_id'])) {
				if ($Brow['Num'] || $Nrow['Num'])
					echo '<td><a href="booting.php?flight='.$queryline['Flightid'].'"><input class="booting_btn" type="button" value="预定"></a></td>';
				else
					echo '<td>预定</td>';
			}
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