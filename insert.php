<?php
include 'connect.inc.php';
$lat = $_POST['lat'];
$lng = $_POST['lng'];
mysql_query("INSERT INTO `loc_table`(`lat`, `lng`) VALUES ('".$lat."','".$lng."')");
//echo "INSERT INTO `loc_table`(`lat`, `lng`) VALUES ('".$lat."','".$lng."')";
 ?>
