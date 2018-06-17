<!--
HUST DBMS Design - deleteuser.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Check if user logined
  if (isset($_SESSION['admin_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $userid = $_GET['userid'];
    $query = "SELECT * FROM FlightReserve WHERE Userid = '$userid'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) == 0) {
      $query = "DELETE FROM User WHERE Userid = '$userid'";
      mysqli_query($conn, $query);
      mysqli_close();
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/usermanage.php';
      header('Location: '.$home_url);
    }
    else {
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/usermanage.php';
      header('Location: '.$home_url);
    }
  }
  else  {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>