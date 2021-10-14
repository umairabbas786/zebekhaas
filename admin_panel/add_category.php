<?php
session_start();
include "includes/conn.php";

if(isset($_POST['submit']))
{
    $catname=$_POST['catname'];
    $catdesc=$_POST['catdesc'];
    $sql="insert into category(category_name,description)values('$catname','$catdesc')";
    $result=$conn->query($sql);
    if($result)
    {
        echo "Category Added Successfully!";
        header("location: category.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

?>