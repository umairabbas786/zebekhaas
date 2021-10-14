<?php
session_start();
include "includes/conn.php";

if(isset($_POST['submit']))
{
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
    if(isset($_POST['pdiscount'])){
        $discount=$_POST['pdiscount'];
    }
    else{
        $discount=0;
    }
    //for image upload..
    $filename = $_FILES["pimg"]["name"];
    $tempname = $_FILES["pimg"]["tmp_name"];    
    $folder = "../public/product/".$filename;
    move_uploaded_file($tempname, $folder);

    //for multiple images
        // File upload configuration 
    $targetDir = "../public/product/";
    $allowTypes = array('jpg','png','jpeg','gif'); 
      
    $fileNames = array_filter($_FILES['eimg']['name']);
    if(!empty($fileNames)){ 
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
    }
    if(!empty($insertValuesSQL)){ 
        $insertValuesSQL = trim($insertValuesSQL, ',');
    }
    //--End Multiple Files..
    
    $sql="insert into product(category_id,name,description,price,discount,mainphoto,extraphoto,upload_date,quantity)values('$pcat','$pname','$pdesc','$pprice','$discount','$filename','$insertValuesSQL',NOW(),'$quan')";
    $result=$conn->query($sql);
    if($result)
    {
        echo "Product Added Successfully!";
        header("location: product.php");
        die();
    }
    else{
        echo $conn->error;
    }
}

?>