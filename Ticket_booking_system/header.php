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
    if (($page_title == "登录") || ($page_title == "管理员登录") || ($page_title == "注册")
     || ($page_title == "个人中心") || ($page_title == "订票") || ($page_title == "用户信息修改 | 管理员")) {
      echo '<link href="css/login_frame.css" rel="stylesheet" type="text/css">';
    }
    else {
      echo '<link href="css/main_frame.css" rel="stylesheet" type="text/css">';
    }
  ?>
  <link href="css/header_footer.css" rel="stylesheet" type="text/css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>