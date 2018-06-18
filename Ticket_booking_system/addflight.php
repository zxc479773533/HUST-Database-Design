<!--
HUST DBMS Design - addflight.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Check if admin logined
  if (isset($_SESSION['admin_id'])) {
    // Connect to database
    require_once('connectdb.php');
    // Get data in form
    $flightno = mysqli_real_escape_string($conn, trim($_POST['Flightno']));
    $bclass = mysqli_real_escape_string($conn, trim($_POST['BClass']));
    $nclass = mysqli_real_escape_string($conn, trim($_POST['NClass']));
    $leave_time = mysqli_real_escape_string($conn, trim($_POST['Leavetime']));
    $arrive_time = mysqli_real_escape_string($conn, trim($_POST['Arrivetime']));
    $start_station = mysqli_real_escape_string($conn, trim($_POST['StartStation']));
    $end_station = mysqli_real_escape_string($conn, trim($_POST['EndStation']));
    $bprice = mysqli_real_escape_string($conn, trim($_POST['BPrice']));
    $nprice = mysqli_real_escape_string($conn, trim($_POST['NPrice']));

    // Format time
    $leave_time[10] = ' ';
    $arrive_time[10] = ' ';
    $leave_time = $leave_time.":00";
    $arrive_time = $arrive_time.":00";

    // Check input data
    if (!empty($flightno) && !empty($bclass) && !empty($nclass) && !empty($leave_time)
     && !empty($arrive_time) && !empty($start_station) && !empty($end_station)
     && !empty($bprice) && !empty($nprice)) {
      $query = "INSERT INTO Flight (Flightno, BClass, NClass, Leavetime, Arrivetime, StartStation, EndStation, BPrice, NPrice) VALUES".
      "('$flightno', '$bclass', '$nclass', '$leave_time', '$arrive_time', '$start_station', ".
      "'$end_station', '$bprice', '$nprice')";
      mysqli_query($conn, $query);
      $query = "SELECT Flightid FROM Flight WHERE Flightno = '$flightno'";
      $data = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($data);
      $flightid = $row['Flightid'];
      $query = "CALL add_new_seats('$flightid', '$bclass', '$nclass')";
      mysqli_query($conn, $query);
      mysqli_close();

      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/flightmanage.php';
      header('Location: '.$home_url);
    }
    else {
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/flightmanage.php';
      header('Location: '.$home_url);
    }
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>