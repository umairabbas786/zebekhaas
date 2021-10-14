<?php
session_start();
$message="";
include "includes/conn.php";

if(isset($_GET['delete']))
{
    $del=$_GET['delete'];
    $sql="Delete from reviews where review_id='$del'";
    $delete=$conn->query($sql);
    if($delete)
    {
        header("location: reviews.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

?>