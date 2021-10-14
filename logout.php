<?php
session_start();
unset($_SESSION['loggedin']);
unset($_SESSION['puser']);
header("Location:index.php");
?>