<!--
HUST DBMS Design - deleteflight.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Check if admin logined
  if (isset($_SESSION['admin_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $flightid = $_GET['flightid'];

    $query = "SELECT * FROM FlightReserve WHERE Flightid = '$flightid'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 0) {
      $query1 = "DELETE FROM FlightSeats WHERE Flightid = '$flightid'";
      $query2 = "DELETE FROM Flight WHERE Flightid = '$flightid'";
      mysqli_query($conn, $query1);
      mysqli_query($conn, $query2);
      mysqli_close();
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/flightmanage.php';
      header('Location: '.$home_url);
    }
    else {
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/flightmanage.php';
      header('Location: '.$home_url);
    }
  }
  else  {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>