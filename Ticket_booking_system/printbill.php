<!--
HUST DBMS Design - printbill.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "取票";
  require_once('header.php');

  // Check if user logined
  if (isset($_SESSION['user_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $reserveid = $_GET['reserve'];
    $username = $_SESSION['user_name'];
    $query = "SELECT * FROM FlightReserve WHERE Reserveid = '$reserveid'";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($data);
    $flightid = $row['Flightid'];
    $query = "SELECT * FROM Flight WHERE Flightid = '$flightid'";
    $data = mysqli_query($conn, $query);
    $flightinfo = mysqli_fetch_array($data);
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
			<form id="login-form">
				 <ul style="list-style-type: none;">
				 	<li style="height: 20px;"></li>
				 	<li style="margin-left: 90px;"><h2>账单</h2></li>
          <li><p style="font-size: 14px">您好，以下为您本次订票的账单</p></li>

<?php
  echo '<li class="inputli"><span class="lable">用户名：</span>'.$username.'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">航班次：</span>'.$flightinfo['Flightno'];
  echo '<input type="hidden" name="flightid" value="'.$flightid.'"></li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">起点站：</span>'.$flightinfo['StartStation'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">终点站：</span>'.$flightinfo['EndStation'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">起飞时间：</span>'.$flightinfo['Leavetime'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">起飞时间：</span>'.$flightinfo['Arrivetime'].'</li>';
  echo '<li style="height: 5px;"></li>';
  if ($row['SeatType'] == "商务舱")
    echo '<li class="inputli"><span class="lable">座位类型：</span>商务舱</li>';
  else
    echo '<li class="inputli"><span class="lable">座位类型：</span>经济舱</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">价格：</span>'.$row['Price'].'</li>';
  echo '<li style="height: 5px;"></li>';
?>

					  <li style="padding-left: 50px;">
              <input class="login-button" onclick="window.print()" style="margin-left: 60px" type="button" value="打印">
              <?php
						    echo '<a href="doticketing.php?reserve='.$reserveid.'"><input class="regist-button" style="margin-left: 60px" type="button" value="取票"></a>';
              ?>
					  </li>
				  </ul>
        </form>
		  </div>
		  <img style="float: right; width: 200px; height: 180px; margin-top: 180px; margin-right: 30px;" src="img/booting.png"/>
	  </div>
  </div>
</body>
</html>