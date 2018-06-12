<!--
HUST DBMS Design - connectdb.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<?php
  // Server info
  $server = "localhost";
  $db_username = "root";
  $db_password = "213";

  // Connect to mysql
  $conn = mysqli_connect($server, $db_username, $db_password, "ticket_booting");
  if (!$conn) {
    die("Can't connect".mysqli_error());
  }
?>