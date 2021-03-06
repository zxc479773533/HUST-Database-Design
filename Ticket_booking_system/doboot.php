<!--
HUST DBMS Design - booting.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "订票";
  require_once('header.php');

  // Connect to database
  require_once('connectdb.php');

  // Check if user logined
  if (isset($_SESSION['user_id'])) {
    // Get data in form
    $boot_flight_id = mysqli_real_escape_string($conn, trim($_POST['flightid']));
    $boot_type = mysqli_real_escape_string($conn, trim($_POST['seattype']));
    $query = "SELECT * FROM FlightSeats WHERE Flightid = '$boot_flight_id' AND SeatType = '$boot_type' AND SeatUse = '0' LIMIT 1";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 1) {
      $userid = $_SESSION['user_id'];
      $seatinfo = mysqli_fetch_array($data);
      $seatid = $seatinfo['Seatid'];
      $query = "SELECT * FROM Flight WHERE Flightid = '$boot_flight_id'";
      $data = mysqli_query($conn, $query);
      $flight_data = mysqli_fetch_array($data);
      if ($boot_type == "商务舱")
        $price = $flight_data['BPrice'];
      else
        $price = $flight_data['NPrice'];
      $query1 = "UPDATE FlightSeats SET SeatUse = '1' WHERE Flightid = '$boot_flight_id' and Seatid = '$seatid'";
      $query2 = "INSERT INTO FlightReserve (Userid, Flightid, SeatType, Seatid, Price) VALUES".
      "('$userid', '$boot_flight_id', '$boot_type', '$seatid', '$price')";
      $query3 = "INSERT INTO Notification VALUES".
      "('$userid', '$boot_flight_id', '$boot_type', '$seatid', '$price')";
      $query4 = "INSERT INTO Bill VALUES".
      "('$userid', '$boot_flight_id', '$boot_type', '$seatid', '$price', '0')";
      mysqli_query($conn, $query1);
      mysqli_query($conn, $query2);
      mysqli_query($conn, $query3);
      mysqli_query($conn, $query4);
      mysqli_close();
      require_once('dobootconfirm.php');
      exit();
    }
    else {
      mysqli_close();
      require_once('dobooterror.php');
    }
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>