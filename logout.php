<html lang="en">
  <head>
  <META http-equiv="expires" content="0">
  <meta charset="UTF-8">
 
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ThaiID Cloud</title>
    
  </head>

<?php

session_start();

// clear session
session_destroy(); // ทำลาย session
echo "<script language=\"javascript\" type=\"text/javascript\">parent.location.href='login.php';</script>";

?>
