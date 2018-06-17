<!--
HUST DBMS Design - modifyprofile.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Set page title
  $page_title = "个人中心";
  require_once('header.php');

  // Connect to database
  require_once('connectdb.php');

  // Check if user logined
  if (isset($_SESSION['user_id'])) {
    // Get data in form
    $new_sex = mysqli_real_escape_string($conn, trim($_POST['sex']));
    $new_age = mysqli_real_escape_string($conn, trim($_POST['age']));
    $new_email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $new_phone = mysqli_real_escape_string($conn, trim($_POST['phone']));

    if (!empty($new_sex) && !empty($new_age) && !empty($new_email) && !empty($new_phone)) {
      $userid = $_SESSION['user_id'];
      $query = "UPDATE User SET Sex = '$new_sex', Age = '$new_age', Email = '$new_email', Phone = '$new_phone' ".
      "WHERE Userid = '$userid'";
      mysqli_query($conn, $query);
      mysqli_close();
      require_once('modifyconfirm.php');
      exit();
    }
    else {
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/editprofile.php';
      header('Location: '.$home_url);
    }
  }
  // Check if admin logind
  else if (isset($_SESSION['admin_id'])) {
    // Get data in form
    $userid = mysqli_real_escape_string($conn, trim($_POST['userid']));
    $new_sex = mysqli_real_escape_string($conn, trim($_POST['sex']));
    $new_age = mysqli_real_escape_string($conn, trim($_POST['age']));
    $new_email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $new_phone = mysqli_real_escape_string($conn, trim($_POST['phone']));

    if (!empty($new_sex) && !empty($new_age) && !empty($new_email) && !empty($new_phone)) {
      $query = "UPDATE User SET Sex = '$new_sex', Age = '$new_age', Email = '$new_email', Phone = '$new_phone' ".
      "WHERE Userid = '$userid'";
      mysqli_query($conn, $query);
      mysqli_close();
      $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/usermanage.php';
      header('Location: '.$home_url);
    }
  }
  else {
    $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
    header('Location: '.$home_url);
  }
?>