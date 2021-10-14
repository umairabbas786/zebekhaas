<?php
session_start();
$message="";
include "includes/conn.php";

if(isset($_GET['uid']) && isset($_GET['status'])){
    $id=$_GET['uid'];
    $status=$_GET['status'];
    if($status==0){
        $set=1;
    }else{
        $set=0;
    }
    $sql="update users set block='$set' where user_id='$id'";
    $result=$conn->query($sql);
    if($result)
    {
        echo "Blocked Successfully!";
        header("location: users.php");
        die();
    }
    else{
        echo $conn->error;
    }
}


?>