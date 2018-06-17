<!--
HUST DBMS Design - booting.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "订票";
  require_once('header.php');

  // Check if user logined
  if (isset($_SESSION['user_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $flightid = $_GET['flight'];
    $username = $_SESSION['user_name'];
    $query = "SELECT * FROM Flight WHERE Flightid = '$flightid'";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($data);
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/login.php';
    header('Location: '.$home_url);
  }
?>

<script type="text/javascript">
  function showPrice(value) {
    if (value == "商务舱") {
      <?php echo 'document.getElementById("price").innerHTML = '.$row['BPrice']; ?>
    }
    else {
      <?php echo 'document.getElementById("price").innerHTML = '.$row['NPrice']; ?>
    }
  }
</script>
<div class="header"></div>
<div class="main">
	<div class="login-frame">
		<div class="regist">
			<form id="login-form" method="post" action="doboot.php">
				 <ul style="list-style-type: none;">
				 	<li style="height: 20px;"></li>
				 	<li style="margin-left: 90px;"><h2>订票信息确认</h2></li>
          <li><p style="font-size: 14px">请确认您的订票信息，选择要定的类型，并在选择后完成下单</p></li>

<?php
  echo '<li class="inputli"><span class="lable">用户名：</span>'.$username.'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">航班次：</span>'.$row['Flightno'];
  echo '<input type="hidden" name="flightid" value="'.$flightid.'"></li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">起点站：</span>'.$row['StartStation'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">终点站：</span>'.$row['EndStation'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">起飞时间：</span>'.$row['Leavetime'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">起飞时间：</span>'.$row['Arrivetime'].'</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">座位类型：</span>';
  echo '<input type="radio" name="seattype" value="商务舱" onclick="showPrice(this.value)">商务舱';
  echo '<input type="radio" name="seattype" value="经济舱" onclick="showPrice(this.value)">经济舱</li>';
  echo '<li style="height: 5px;"></li>';
  echo '<li class="inputli"><span class="lable">价格：</span><span id="price"></span></li>';
  echo '<li style="height: 5px;"></li>';
?>

					<li style="padding-left: 50px;">
            <input class="login-button" style="margin-left: 60px" type="submit" value="确定">
						<a href="index.php"><input class="regist-button" style="margin-left: 60px" type="button" value="返回"></a>
					</li>
				 </ul>
      </form>
		</div>
		<img style="float: right; width: 200px; height: 180px; margin-top: 180px; margin-right: 30px;" src="img/booting.png"/>
	</div>
</div>

<?php
  require_once('footer.php');
?>