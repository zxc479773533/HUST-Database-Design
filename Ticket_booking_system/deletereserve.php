<!--
HUST DBMS Design - deletereserve.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Check if admin logined
  if (isset($_SESSION['admin_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $reserveid = $_GET['reserveid'];
    $query = "SELECT * FROM FlightReserve, Flight WHERE FlightReserve.Flightid = Flight.Flightid AND Reserveid = '$reserveid'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 1) {
      $row = mysqli_fetch_array($data);
      $userid = $row['Userid'];
      $flightid = $row['Flightid'];
      $seattype = $row['SeatType'];
      $seatid = $row['Seatid'];
      $price = $row['Price'];
      $query1 = "boot_delete('$reserveid', '$userid', '$flightid', '$seattype', '$seatid', '$price')";    
      mysqli_query($conn, $query);
      mysqli_close();
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/reservemanage.php';
      header('Location: '.$home_url);
    }
    else {
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/reservemanage.php';
      header('Location: '.$home_url);
    }
  }
  else  {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>