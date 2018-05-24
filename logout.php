<?php
session_start();
echo 'Logged out!';
unset($_SESSION['Username']);
session_destroy();
header("Location:loginform.php");
?>
