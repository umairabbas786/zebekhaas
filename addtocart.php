<?php 
session_start();
include "include/conn.php";

    if(isset($_GET['allp'])){
        $all= explode(',',$_GET['allp']);
        print_r($all);
        $quan=1;
        if($all!=null){
            $length=count($all);
            $i=0;
            while($i<$length){
                $productid=$all[$i];
                if(isset($_SESSION['mycart'][$productid])){
                    $previous=$_SESSION['mycart'][$productid]['quan'];
                    $_SESSION['mycart'][$productid]=  array("id"=>$productid,"quan"=>$previous+$quan);
                }
                else{
                    $_SESSION['mycart'][$productid]=  array("id"=>$productid,"quan"=>$quan);
                }
                $i++;
            }
        }
        header ("location: wishlist.php");
        $_SESSION['cartadded']="All Items Added to Cart Successfully.";
    }

    if(isset($_GET['productid'])){
        $productid=$_GET['productid'];
        $location=$_GET['location'];

        $quan=1;

        //session start...
        if(isset($_SESSION['mycart'][$productid])){
            $previous=$_SESSION['mycart'][$productid]['quan'];
            $_SESSION['mycart'][$productid]=  array("id"=>$productid,"quan"=>$previous+$quan);
        }
        else{
            $_SESSION['mycart'][$productid]=  array("id"=>$productid,"quan"=>$quan);
        }
        header ("location: $location");
        $_SESSION['msg']="Item Added to Cart Successfully.";

        //session_destroy();

        //check printing..
        // echo "<pre>";
        // print_r($_SESSION['mycart']);
        // echo "</pre>";
    }
?>