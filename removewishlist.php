<?php 
session_start();
include "include/conn.php";
?>

<?php
    if(isset($_GET['rw'])){
        $id=$_GET['rw'];
        $useremail=$_SESSION['puser'];
        $sql="select user_id from users where email='$useremail'";
        $result=$conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $userid = $row["user_id"];
        $q="Delete from wishlist where product_id='$id' and user_id='$userid'";
        $delete=$conn->query($q);
        if($delete)
        {
        $_SESSION['wsuccess']="Item Removed Successfully.";
        header("location: wishlist.php");
        die();
        }
    else{
        echo $conn->error;
    }
    }
?>