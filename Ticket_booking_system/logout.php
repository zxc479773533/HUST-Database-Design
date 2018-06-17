<!--
HUST DBMS Design - logout.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  session_start();
  // Check login status
  if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $_SESSION = array();
    session_destroy();
  }
  $home_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
  header('Location: '.$home_url);
?>