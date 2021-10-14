<?php 
session_start();
include "include/conn.php";
?>

<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="Delete from shippingaddress where user_id='$id'";
        $delete=$conn->query($sql);
        if($delete)
        {
        $_SESSION['addsuccess']="Address Deleted Successfully.";
        header("location: myaccount.php");
        die();
        }
    else{
        echo $conn->error;
    }
    }
?>