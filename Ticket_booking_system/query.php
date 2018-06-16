<!--
HUST DBMS Design - query.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "查询 | 服务";
	require_once('header.php');
	require_once('connectdb.php');
?>

<script type="text/javascript">
	$(function(){   
    var leftHeight= $(".user_info").height();
    var rightHeight= $(".query_result").height();
    if (leftHeight > rightHeight) {
          $(".query_result").height(leftHeight);
    } else {
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
	if (!isset($_SESSION['user_id'])) {
		echo '<li style="margin-top: 50px"><h2>当前未登录</h2></li>';
		echo '<li style="margin-top:30px"></li>';
		echo '<li>欢迎来到机票预定系统!</li>';
		echo '<li style="height: 40px;"></li>';
		echo '<li>';
		echo '<a href="login.php"><input style="height: 30px; width: 80px; background-color: #00a7de; color: #ffffff; border: 1px solid #0381aa; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="登录"></a>';
		echo '<a href="regist.php"><input style="margin-left: 40px; height: 30px; width: 80px; background-color: #ffffff; color: #555555; border: 1px solid #cccccc; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="注册"></a>';
		echo '</li>';
	} else {
		// get ticket data in database
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
		
		echo '<li style="margin-left: -20px;"><h4>已登录用户</h4></li>';
		echo '<li>用户名：'.$username.' <span style="background: #004CFF; border-radius: 5px; font-size: 12px; padding: 3px; color: white">普通用户</span></li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>性别：'.$usersex.'</li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>年龄：'.$userage.'</li>';
		echo '<li style="height: 10px;"></li>';
		echo '<li>待取票数：'.$ticket_num.'</li>';
		echo '<li style="height: 20px;"></li>';
		echo '<li>';
		echo '<a href="editprofile.php"><input style="height: 30px; width: 80px; background-color: #00a7de; color: #ffffff; border: 1px solid #0381aa; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="个人中心"></a>';
		echo '<a href="logout.php"><input style="margin-left: 40px; height: 30px; width: 80px; background-color: #ffffff; color: #555555; border: 1px solid #cccccc; border-radius: 2px; text-align: center; cursor: pointer;" type="button" value="退出"></a>';
		echo '</li>';
  }
  // Query flight
  $leave_station = mysqli_real_escape_string($conn, trim($_POST['LeaveStation']));
  $arrive_station = mysqli_real_escape_string($conn, trim($_POST['ArriveStation']));
  $leave_day = mysqli_real_escape_string($conn, trim($_POST['LeaveDay']));
  $arrive_day = mysqli_real_escape_string($conn, trim($_POST['ArriveDay']));
  if (!empty($leave_station) && !empty($arrive_station) && !empty($leave_day) && !empty($arrive_day)) {
    $query = "SELECT * FROM Flight WHERE StartStation = '$leave_station' AND EndStation = '$arrive_station' ".
    "AND DATE(Leavetime) = '$leave_day' AND DATE(Arrivetime) = '$arrive_day'";
    $flight_data = mysqli_query($conn, $query);
  }
?>

			</ul>
		</div>
		<div class="functions">
			<ul style="list-style-type: none;">
				<li style="margin-left: -39px; width: 310px; cursor: pointer;"><a href="index.php"><img src="img/home_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="regist.php"><img src="img/regist_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="query.php"><img src="img/query_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="ticket.php"><img src="img/ticket_button.png"/></a></li>
				<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="price.php"><img src="img/price_button.png"/></a></li>
			</ul>
		</div>
		<br style="clear:both;"/>
	</div>
	<div class="query_result">
		<div class="select">
			<form id="queryform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="query_input">
					<ul style="list-style-type: none;">
						<li>
							<span class="query_lable">起点站</span><input class="querytxt" type="text" name="LeaveStation" maxlength="12" style="width: 120px;">
							<span class="query_lable">终点站</span><input class="querytxt" type="text" name="ArriveStation" maxlength="12" style="width: 120px;">
						</li>
						<li style="margin-top: 10px;"></li>
						<li>
							<span class="query_lable">起飞日期</span><input class="querytxt" type="date" name="LeaveDay" maxlength="12" style="width: 120px;">
							<span class="query_lable">到达日期</span><input class="querytxt" type="date" name="ArriveDay" maxlength="12" style="width: 120px;">
						</li>
					</ul>
				</div>
				<div class="query_submit">
					<input class="query_btn" type="submit" value="查询">
				</div>
      </form>
		</div>
		<div class="query">
			<img style="margin-top:10px" src="img/flight_query.png"/>
			<table class="flight">
				<tr class="th_list">
					<th width="45">ID</th>
					<th width="50">商务舱</th>
					<th width="50">经济舱</th>
					<th width="70">起飞时间</th>
					<th width="70">到达时间</th>
					<th width="50">起点站</th>
					<th width="50">终点站</th>
					<th width="40">商务舱价格</th>
					<th width="40">经济舱价格</th>
					<th width="75">备注</th>
				</tr>

<?php
  if (!empty($flight_data)) {
    $count = 0;
    foreach($flight_data as $quaryline) {
      $count += 1;
		  echo '<tr>';
		  if ($count % 2 == 0) {
			  echo '<td style="background: #ffffff">'.$quaryline['Flightno'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['BClass'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['NClass'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['Leavetime'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['Arrivetime'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['StartStation'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['EndStation'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['BPrice'].'</td>';
			  echo '<td style="background: #ffffff">'.$quaryline['NPrice'].'</td>';
			  echo '<td style="background: #ffffff"><a href="booting.php?flight='.$queryline['Flightid'].'"><input class="booting_btn" type="button" value="预定"></a></td>';
		  }
		  else {
			  echo '<td>'.$quaryline['Flightno'].'</td>';
			  echo '<td>'.$quaryline['BClass'].'</td>';
			  echo '<td>'.$quaryline['NClass'].'</td>';
			  echo '<td>'.$quaryline['Leavetime'].'</td>';
			  echo '<td>'.$quaryline['Arrivetime'].'</td>';
			  echo '<td>'.$quaryline['StartStation'].'</td>';
			  echo '<td>'.$quaryline['EndStation'].'</td>';
			  echo '<td>'.$quaryline['BPrice'].'</td>';
			  echo '<td>'.$quaryline['NPrice'].'</td>';
			  echo '<td style="background: #ffffff"><a href="booting.php?flight='.$queryline['Flightid'].'"><input class="booting_btn" type="button" value="预定"></a></td>';
		  }
		  echo '<tr/>';
    }
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
  require_once('footer.php');
?>