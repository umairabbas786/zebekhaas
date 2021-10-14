<?php
session_start();
$message="";
include "includes/conn.php";

if(isset($_GET['delete_category']))
{
    $del=$_GET['delete_category'];
    $sql="Delete from category where id='$del'";
    $delete=$conn->query($sql);
    if($delete)
    {
        $_SESSION['messege']="Deleted Successfully!";
        header("location: category.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

?>