<?php 
session_start();
include "include/conn.php";


if(isset($_GET['wishlist'])){
    $location=$_GET['location'];
    $useremail=$_SESSION['puser'];
    $sql="select user_id from users where email='$useremail'";
	$result=$conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	$id = $row["user_id"];
    $pid=$_GET['wishlist'];
    $ssql="insert into wishlist(user_id,product_id)values('$id','$pid')";
    $rresult=$conn->query($ssql);
    if($rresult)
    {
        $_SESSION['wishlist']="Item Added to Wishlist Successfully!";
        echo "Product Added to Wishlist Successfully!";
        header("location: $location");
        die();
    }
    else{
         echo $conn->error;
    }
}



?>