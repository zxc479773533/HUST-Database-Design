<!--
HUST DBMS Design - reservemanage.php

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
	$(function() {   
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

	// Query flight
  $username = mysqli_real_escape_string($conn, trim($_POST['Username']));
  $query = "SELECT Userid FROM User WHERE Username = '$username'";
  $data = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($data);
  $userid = $row['Userid'];
  if (!empty($username)) {
    $query = "SELECT * FROM FlightReserve, Flight WHERE FlightReserve.Flightid = Flight.Flightid AND Userid = '$userid'";
		$reserve_data = mysqli_query($conn, $query);
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
		<div class="select">
			<form id="queryform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="query_input">
					<ul style="list-style-type: none;">
            <li style="width: 400px; margin-top: -20px; margin-left: 150px;"><h3>根据用户名查找订单</h3></li>
						<li style="margin-top: 10px;"></li>
						<li style="margin-left: 100px;">
							<span class="query_lable">用户名：</span><input class="querytxt" type="text" name="Username" maxlength="12" style="width: 120px;">
						</li>
					</ul>
				</div>
				<div class="query_submit">
					<input class="query_btn" type="submit" value="查询">
				</div>
      </form>
		</div>
		<div class="query">
			<img style="margin-top:10px" src="img/reserve_manage.png"/>
			<table class="flight">
				<tr class="th_list">
					<th width="70">用户名</th>
					<th width="45">航班次</th>
					<th width="40">座位<br/>类型</th>
					<th width="30">座位号</th>
					<th width="70">起飞时间</th>
					<th width="70">到达时间</th>
					<th width="50">起点站</th>
					<th width="50">终点站</th>
					<th width="40">票价</th>
					<th width="75">操作</th>
				</tr>

<?php
  if (!empty($reserve_data)) {
    $count = 0;
    foreach($reserve_data as $queryline) {
			$count += 1;
			echo '<tr>';
			if ($count % 2 == 0) {
				echo '<td style="background: #ffffff">'.$username.'</td>';
				echo '<td style="background: #ffffff">'.$queryline['Flightno'].'</td>';
				echo '<td style="background: #ffffff">'.$queryline['SeatType'].'</td>';
				echo '<td style="background: #ffffff">'.$queryline['Seatid'].'</td>';
				echo '<td style="background: #ffffff">'.$queryline['Leavetime'].'</td>';
				echo '<td style="background: #ffffff">'.$queryline['Arrivetime'].'</td>';
				echo '<td style="background: #ffffff">'.$queryline['StartStation'].'</td>';
        echo '<td style="background: #ffffff">'.$queryline['EndStation'].'</td>';
				echo '<td style="background: #ffffff">'.$queryline['Price'].'</td>';
				echo '<td style="background: #ffffff"><a href="deletereserve.php?reserveid='.$queryline['Reserveid'].'"><input class="refund_btn" type="button" value="删除"></a></td>';
			}
			else {
				echo '<td>'.$username.'</td>';
				echo '<td>'.$queryline['Flightno'].'</td>';
				echo '<td>'.$queryline['SeatType'].'</td>';
				echo '<td>'.$queryline['Seatid'].'</td>';
				echo '<td>'.$queryline['Leavetime'].'</td>';
				echo '<td>'.$queryline['Arrivetime'].'</td>';
				echo '<td>'.$queryline['StartStation'].'</td>';
        echo '<td>'.$queryline['EndStation'].'</td>';
				echo '<td>'.$queryline['Price'].'</td>';
				echo '<td><a href="deletereserve.php?reserveid='.$queryline['Reserveid'].'"><input class="refund_btn" type="button" value="删除"></a></td>';
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