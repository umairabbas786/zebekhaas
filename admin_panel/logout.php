<?php
session_start();
unset($_SESSION['user']);
$_SESSION['message'] = "Logged Out Successfully !";
header("Location:index.php");
?>