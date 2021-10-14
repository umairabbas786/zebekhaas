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

    <title>Products</title>

    <!-- Custom fonts for this template -->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .thank-you-pop{
	width:100%;
 	padding:20px;
	text-align:center;
}
.thank-you-pop img{
	width:76px;
	height:auto;
	margin:0 auto;
	display:block;
	margin-bottom:25px;
}

.thank-you-pop h1{
	font-size: 42px;
    margin-bottom: 25px;
	color:#5C5C5C;
}
.thank-you-pop p{
	font-size: 20px;
    margin-bottom: 27px;
 	color:#5C5C5C;
}
.thank-you-pop h3.cupon-pop{
	font-size: 25px;
    margin-bottom: 40px;
	color:#222;
	display:inline-block;
	text-align:center;
	padding:10px 20px;
	border:2px dashed #222;
	clear:both;
	font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
	color:#03A9F4;
}

#done .modal-header{
    border:0px;
}
    </style>

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
                <a class="nav-link" href="#">
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
                            <button class="btn btn-form btn-primary btn-md btn-block"><a href="logout.php"
                                    class="text-white">Logout</a></button>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Products</h1>
                    <p class="mb-4">Here You Can Manage Your Products.</p>
                    <br><br>
                    <div class="container">
                        <h1 class="h3 mb-2">Add Product</h1>
                        <form class="user" action="add_product.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pname" name="pname" required
                                            placeholder="Enter Product Name ..">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group search-bar">
                                        <select class="form-control" name="cat" required>
                                            <option selected="selected" value="" disabled>Select Category </option>
                                            <?php
												$sql="select * from category";
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
                                    <div class="form-group">
                                        <textarea class="form-control form-control-md mb-3" rows="3" id="pdesc" name="pdesc" required placeholder="Enter Product Description .."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="pprice" step="any" name="pprice" required
                                            placeholder="Enter Product Price ..">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="pdiscount" step="any" name="pdiscount"
                                            placeholder="Enter Discount % (If Any) ..">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pimg" name="pimg" required>
                                    <label class="custom-file-label" for="pimg">Select Main Product Image ..</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <div class="custom-file">
                                    <input type="file" name="eimg[]" class="custom-file-input" id="eimg" multiple>
                                    <label class="custom-file-label" for="eimg">Select Extra Product Image ..</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="pquan" name="pquan" required
                                            placeholder="Enter Product Quantity ..">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button name="submit" id="submit" class="btn btn-primary btn-user btn-block" onclick="alert('Product Added Successfully!')">
                                        Add Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Belongs To Category</th>
                                            <th>Description</th>
                                            <th>Main Image</th>
                                            <th>Extra Images</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Upload Date</th>
                                            <th>Quantity</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
$sql="select * from product order by product_id desc";
$show=$conn->query($sql);
while ($row = mysqli_fetch_assoc($show)) {
    $id=$row['product_id'];
    $catid=$row['category_id'];
    $sql1="select category_name from category where id='$catid'";
    $result=$conn->query($sql1);
    if($roww=mysqli_fetch_assoc($result)){
        $cat=$roww['category_name'];
    }
    $name=$row['name'];
    $desc=$row['description'];
    $price=$row['price'];
    $discount=$row['discount'];
    $mainimg=$row['mainphoto'];
    if($row['extraphoto']!=null){
    $eimg=explode(',',$row['extraphoto']);
    }
    $date=$row['upload_date'];
    $quantity=$row['quantity'];
?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $cat ?></td>
                                            <td><?php echo $desc ?></td>
                                            <td><?php echo "<img src='../public/product/".$mainimg."' height='100' width='100' >"?></td>
                                            <td><?php
                                            if($row['extraphoto']!=null){
                                            $length=count($eimg);
                                            $i=0;
                                            while($i<$length){
                                             echo "<img src='../public/product/".$eimg[$i]."' height='50' width='100' class='mb-2'>";
                                             $i++;
                                            }
                                        }else{
                                            echo "<p>No Image.</p>";
                                        }
                                             ?>
                                             </td>
                                            <td><?php echo $price ?></td>
                                            <td><?php echo $discount ?>%</td>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $quantity ?></td>
                                            <td><a href="product_update.php?update_product=<?php echo $row['product_id']; ?>"
                                                    name=""><button class="btn btn-primary btn-block"
                                                        Onclick="return confirm('Are you sure?')">Edit</button></a></td>
                                            <td><a href="delete_product.php?delete_product=<?php echo $row['product_id']; ?>"
                                                    name=""><button class="btn btn-block btn-danger mb-2" onclick="alert('Product Deleted Successfully!')">Delete</button></a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



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