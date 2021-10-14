<?php
session_start();
$message="";
include "includes/conn.php";

if(isset($_POST['update']))
{
    $id=$_POST['id'];
    $catname=$_POST['catname'];
    $desc=$_POST['catdesc'];
    $sql="update category set category_name='$catname',description='$desc' where id='$id'";
    $result=$conn->query($sql);
    if($result)
    {
        echo "Updated Successfully!";
        header("location: category.php");
        die();
    }
    else{
        echo $conn->error;
    }
}
else{
    echo "Updated Cancelled!";
        header("location: category.php");
        die();
}

?>