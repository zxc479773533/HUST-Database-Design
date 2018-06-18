<!--
HUST DBMS Design - usermanage.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "航班管理 | 管理员";
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

<?php
	if (isset($_SESSION['admin_id'])) {
		echo '<li style="margin-left: -39px; width: 310px; cursor: pointer;"><a href="index.php"><img src="img/home_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="usermanage.php"><img src="img/user_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="query.php"><img src="img/query_button.png"/></a></li>';
		echo '<li style="margin-left: -39px; margin-top: 5px; width: 310px; cursor: pointer;"><a href="flightmanage.php"><img src="img/flight_button.png"/></a></li>';
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
    <div class="addflight">
			<form id="queryform" method="post" action="addflight.php">
				<div class="query_input">
					<ul style="list-style-type: none;">
						<li style="width: 400px; margin-top: -20px; margin-left: 150px;"><h2>新航班录入</h2></li>
						<li style="margin-top: 10px;"></li>
						<li style="width: 300px;">
							<span class="query_lable">航班次</span><input class="querytxt" type="text" name="Flightno" maxlength="12" style="width: 120px;">
						</li>
						<li style="margin-top: 10px;"></li>
						<li>
							<span class="query_lable">商务舱容量</span><input class="querytxt" type="text" name="BClass" maxlength="12" style="width: 120px;">
							<span class="query_lable">经济舱容量</span><input class="querytxt" type="text" name="NClass" maxlength="12" style="width: 120px;">
						</li>
						<li style="margin-top: 10px;"></li>
						<li style="width: 400px;">
							<span class="query_lable">起飞时间</span><input class="querytxt" type="datetime-local" name="Leavetime" maxlength="12" style="width: 200px;">
						</li>
						<li style="margin-top: 10px;"></li>
						<li style="width: 400px;">
							<span class="query_lable">到达时间</span><input class="querytxt" type="datetime-local" name="Arrivetime" maxlength="12" style="width: 200px;">
						</li>
						<li style="margin-top: 10px;"></li>
						<li>
							<span class="query_lable">起点站</span><input class="querytxt" type="text" name="StartStation" maxlength="12" style="width: 120px;">
							<span class="query_lable">终点站</span><input class="querytxt" type="text" name="EndStation" maxlength="12" style="width: 120px;">
						</li>
						<li style="margin-top: 10px;"></li>
						<li>
							<span class="query_lable">商务舱价格</span><input class="querytxt" type="text" name="BPrice" maxlength="12" style="width: 120px;">
							<span class="query_lable">经济舱价格</span><input class="querytxt" type="text" name="NPrice" maxlength="12" style="width: 120px;">
						</li>
					</ul>
				</div>
				<div class="add_submit">
					<input class="add_btn" type="submit" value="添加">
				</div>
      </form>
		</div>
		<div class="query">
      <span style="color: red;">Tips: 1.输入信息不完整的录入将会被舍弃。 2.您只能删除空航班哦。</span>
			<img style="margin-top:10px" src="img/flight_manage.png"/>
			<table class="flight">
				<tr class="th_list">
          <th width="45">航班次</th>
				  <th width="50">商务舱容量</th>
					<th width="50">经济舱容量</th>
					<th width="70">起飞时间</th>
					<th width="70">到达时间</th>
					<th width="50">起点站</th>
					<th width="50">终点站</th>
					<th width="40">商务舱价格</th>
					<th width="40">经济舱价格</th>
					<th width="75">操作</th>
        </tr>

<?php
	$query = "SELECT * FROM Flight ORDER BY Leavetime ASC";
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
			echo '<td style="background: #ffffff"><a href="deleteflight.php?flightid='.$queryline['Flightid'].'"><input class="refund_btn" type="button" value="删除"></a></td>';
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
			echo '<td><a href="deleteflight.php?flightid='.$queryline['Flightid'].'"><input class="refund_btn" type="button" value="删除"></a></td>';
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