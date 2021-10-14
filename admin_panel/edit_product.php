<?php
session_start();
include "includes/conn.php";

if(isset($_POST['submit']))
{
    $id=$_POST['id'];
    $pname=$_POST['pname'];
    $cat=$_POST['cat'];
    $sql1="select id from category where category_name = '$cat'";
    $result=$conn->query($sql1);
    if($row=mysqli_fetch_assoc($result))
    {
    $pcat=$row['id'];
    }
    $quan=$_POST['pquan'];
    $pdesc=$_POST['pdesc'];
    $pprice=$_POST['pprice'];
    $discount=$_POST['pdiscount'];
    //for single image
    if(!empty($_FILES["pimg"]["name"])){
        $query = "SELECT * FROM product WHERE product_id=$id";
        $result = $conn->query($query);

        while ($roww = mysqli_fetch_assoc($result)) {
            $image = $roww['mainphoto'];
            $file= '../public/product/'.$image;
            unlink($file);
        }
    //for image upload..
    $filename = $_FILES["pimg"]["name"];
    $tempname = $_FILES["pimg"]["tmp_name"];    
        $folder = "../public/product/".$filename;
        move_uploaded_file($tempname, $folder);
    }
    else{
        $sql="select mainphoto from product where product_id=$id";
        $result=$conn->query($sql);
        if($row=mysqli_fetch_assoc($result)){
            $filename=$row['mainphoto'];
        }
    }
    //--end single image
    //for multiple images
    $fileNames = array_filter($_FILES['eimg']['name']);
    if(!empty($fileNames))
    {
        $query = "SELECT * FROM product WHERE product_id=$id";
        $result = $conn->query($query);

        while ($roww = mysqli_fetch_assoc($result)) {
        $eimg=explode(',',$roww['extraphoto']);
            $length=count($eimg);
            $i=0;
            while($i<$length){
                $efile= '../public/product/'.$eimg[$i];
                unlink($efile);
                $i++;
            }
        }
    //for image upload
    $targetDir = "../public/product/";
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $fileNames = array_filter($_FILES['eimg']['name']); 
        foreach($_FILES['eimg']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['eimg']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["eimg"]["tmp_name"][$key], $targetFilePath)){
                    $insertValuesSQL .= $fileName .",";
                }
            }
        } 
    if(!empty($insertValuesSQL)){ 
        $eimg = trim($insertValuesSQL, ',');
    }
    }
    else{
        $sql="select extraphoto from product where product_id=$id";
        $result=$conn->query($sql);
        if($row=mysqli_fetch_assoc($result)){
            $eimg=$row['extraphoto'];
        }
    }


    $sql="update product set category_id='$pcat',name='$pname',description='$pdesc',price='$pprice',discount='$discount',mainphoto='$filename',extraphoto='$eimg',upload_date=NOW(),quantity='$quan' where product_id='$id'";
    $result=$conn->query($sql);
    if($result)
    {
        echo "Updated Successfully!";
        header("location: product.php");
        die();
    }
    else{
        echo $conn->error;
    }
}
else{
    echo "Updated Cancelled!";
        header("location: product.php");
        die();
}

?>