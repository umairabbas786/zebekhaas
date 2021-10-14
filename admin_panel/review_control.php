<?php
session_start();
include "includes/conn.php";

$id=$_GET['id'];
if(isset($_POST['show'])){
    $status=1;
    $sql="update reviews set status='$status' where review_id='$id'";
    $result=$conn->query($sql);
    if($result){
        header("location:reviews.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

if(isset($_POST['hide'])){
    $status=0;
    $sql="update reviews set status='$status' where review_id='$id'";
    $result=$conn->query($sql);
    if($result){
        header("location:reviews.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

?>