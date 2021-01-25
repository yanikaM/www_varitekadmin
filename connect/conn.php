<?php 
$host = "innovation.asefa.co.th/mysqlmanagement"; /* Host name */
$user = "innovation"; /* User */
$password = "Passw0rd@1"; /* Password */
$dbname = "varitek"; /* Database name */
//require_once('../class/class.phpmailer.php');
$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

?>