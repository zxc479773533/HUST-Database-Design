<!--
HUST DBMS Design - ticket.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Check if user logined
  if (isset($_SESSION['user_id'])) {
    // Connect to database
    require_once('connectdb.php');
    $userid = $_SESSION['user_id'];
    $reserveid = $_GET['reserve'];
    $query = "SELECT * FROM FlightReserve WHERE Reserveid = '$reserveid'";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($data);
    $flightid = $row['Flightid'];
    $seattype = $row['SeatType'];
    $seatid = $row['Seatid'];
    $price = $row['Price'];
    $query1 = "UPDATE FlightSeats SET SeatUse = '0' WHERE Flightid = '$flightid' and Seatid = '$seatid'";
    $query2 = "DELETE FROM FlightReserve WHERE Reserveid = '$reserveid'";
    $query3 = "DELETE FROM Notification WHERE Flightid = '$flightid' and Seatid = '$seatid'";
    $query4 = "INSERT INTO Bill VALUES ('$userid', '$flightid', '$seattype', '$seatid', '$price', '1')";
    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
    mysqli_query($conn, $query4);
    mysqli_close();
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/ticket.php';
    header('Location: '.$home_url);
  }
  else  {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/login.php';
    header('Location: '.$home_url);
  }
?>