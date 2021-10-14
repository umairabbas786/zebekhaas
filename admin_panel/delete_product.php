<?php
session_start();
$message="";
include "includes/conn.php";

if(isset($_GET['delete_product']))
{
    $delete=$_GET['delete_product'];
    $query = "SELECT * FROM product WHERE product_id='".$delete."'";
        $result = $conn->query($query);

        while ($roww = mysqli_fetch_assoc($result)) {
            $image = $roww['mainphoto'];
            $file= '../public/product/'.$image;
            unlink($file);
            $eimg=explode(',',$roww['extraphoto']);
            $length=count($eimg);
            $i=0;
            while($i<$length){
                $efile= '../public/product/'.$eimg[$i];
                unlink($efile);
                $i++;
            }

        }
    $del=$_GET['delete_product'];
    $sql="Delete from product where product_id='$del'";
    $delete=$conn->query($sql);
    if($delete)
    {
        $_SESSION['messege']="Deleted Successfully!";
        header("location: product.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

?>