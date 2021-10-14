<?php
session_start();
include "includes/conn.php";
if (!isset($_SESSION['user'])) {
  header('Location: index.php');
  die();
}
?>

<?php 
if(isset($_SESSION['user'])){
   $email = $_SESSION['user'];
   $sql = "SELECT * FROM admin WHERE email = '$email'";
   $result = $conn->query($sql);
   while ($row = mysqli_fetch_assoc($result)) {
     $name = "Hello" ." " .$row['name'];
   }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $name?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="category.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Categories</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Products</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reviews.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Customer Reviews</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Users</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Orders</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <button class="btn btn-form btn-primary btn-md btn-block"><a href="logout.php" class="text-white">Logout</a></button>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Product</h1>
    <p class="mb-4">Here You Can Update Your Product.</p>

    <!-- DataTales Example -->
<?php
$update=$_GET['update_product'];
$sql="select * from product where product_id=$update";
$result=$conn->query($sql);
while($row=mysqli_fetch_assoc($result))
{
    $id=$row['product_id'];
    $name=$row['name'];
    $catid=$row['category_id'];
    $sql1="select category_name from category where id='$catid'";
    $result=$conn->query($sql1);
    if($roww=mysqli_fetch_assoc($result)){
        $cat=$roww['category_name'];
    }
    $discount=$row['discount'];
    $desc=$row['description'];
    $price=$row['price'];
    $mainimg=$row['mainphoto'];
    $eimg=$row['extraphoto'];
    $quantity=$row['quantity'];
?>
    <div class="container">
                <form class="user" action="edit_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="ID" name="id" value="<?php echo $id;?>"  placeholder="ID" required>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="pname" class="col-form-label">Product Name: </label>
                                        <input type="text" class="form-control" id="pname" name="pname"
                                            value="<?php echo $name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group search-bar">
                                    <label for="cat" class="col-form-label">Product Category: </label>
                                        <select class="form-control" id="cat" name="cat">
                                            <option selected="selected" value="<?php echo $cat;?>"><?php echo $cat;?> </option>
                                            <?php
												$sql="select * from category where id!=$catid";
												$result=$conn->query($sql);
												while($row=mysqli_fetch_assoc($result))
												{
                                                    $id=$row['id'];
													$name=$row['category_name'];
												?>
                                            <option value="<?php echo $name; ?>" name="pcat"><?php echo $name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <label for="pdesc" class="col-form-label">Product Description: </label>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-md mb-3" rows="3" id="pdesc" name="pdesc"><?php echo $desc ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="pprice" class="col-form-label">Product Price: </label>
                                        <input type="number" class="form-control" id="pprice" step="any" name="pprice"
                                            value="<?php echo $price; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="pdiscount" class="col-form-label">Product Discount %: </label>
                                        <input type="number" class="form-control" id="pdiscount" step="any" name="pdiscount"
                                        value="<?php echo $discount; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="pimg" class="col-form-label">Product Image: </label>
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pimg" name="pimg">
                                    <label class="custom-file-label" for="pimg"><?php echo $mainimg ?></label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="eimg" class="col-form-label">Product Images(Extra): </label>
                                    <div class="custom-file">
                                    <input type="file" name="eimg[]" class="custom-file-input" id="eimg" multiple>
                                    <label class="custom-file-label" for="eimg"><?php echo $eimg ?></label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="pquan" class="col-form-label">Product Quantity: </label>
                                        <input type="number" class="form-control" id="pquan" name="pquan"
                                            value="<?php echo $quantity ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button name="submit" id="submit" class="btn btn-primary btn-user btn-block" onclick="alert('Product Updated Successfully!')">
                                        Update Product
                                    </button>
                                    <button name="cancle" id="cancle"  class="btn btn-dark btn-user btn-block">
                                            Cancle
                                        </button>
                                </div>
                            </div>
                        </form>
                    </div>
<?php } ?>

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="public/js/demo/datatables-demo.js"></script>

</body>

</html>