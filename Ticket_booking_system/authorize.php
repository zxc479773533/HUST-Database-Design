<?php
  $authname = "test";
  $authpassswd = "123";

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
   ($_SERVER['PHP_AUTH_USER'] != $authname) || ($_SERVER['PHP_AUTH_PW'] != $authpassswd)) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Test Page"');
    exit('<h2>Test authorize</h2>');
   }
?>

<h2>Success</h2>