<!--
HUST DBMS Design - header.php

Author: Pan Yue, zxc479773533@gmail.com
-->
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <?php
    echo '<title>'.$page_title.' | 机票预订系统</title>';
    if (($page_title == "登录") || ($page_title == "注册")) {
      echo '<link href="css/login_frame.css" rel="stylesheet" type="text/css">';
    }
    else {
      echo '<link href="css/main_frame.css" rel="stylesheet" type="text/css">';
    }
  ?>
  <link href="css/header_footer.css" rel="stylesheet" type="text/css">
</head>
<body>