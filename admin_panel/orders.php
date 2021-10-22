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
<?php 
if(isset($_GET['completestatus'])){
    $sid = $_GET['completestatus'];
    $sql="update orders set status = 1 where id = '$sid'";
    $result=$conn->query($sql);
    if($result){
        $_SESSION['msg']="Order Completed";
        header("location:orders.php");
        die();
    }
    else{
        $conn->error;
    }
}

?>

<?php 
if(isset($_GET['canclestatus'])){
    $sid = $_GET['canclestatus'];
    $sql="update orders set status = 2 where id = '$sid'";
    $result=$conn->query($sql);
    if($result){
        $_SESSION['msgs']="Order canceled";
        header("location:orders.php");
        die();
    }
    else{
        $conn->error;
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

    <title>Orders</title>

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
<br>
<?php if(isset($_SESSION['msg'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['msg'];?>
			</div>
		<?php }unset($_SESSION['msg']);?>
        <?php if(isset($_SESSION['msgs'])){?>
			<div class="alert alert-danger" role="alert">
			<?php echo $_SESSION['msgs'];?>
			</div>
		<?php }unset($_SESSION['msgs']);?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Address</th>
                            <th>Customer Phone #</th>
                            <th>Products</th>
                            <th>Note</th>
                            <th>Total Bill</th>
                            <th>Date</th>
                            <th>Currenct Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$sql="select * from orders order by id desc";
$show=$conn->query($sql);
while ($row = mysqli_fetch_assoc($show)) {
    $id=$row['id'];
    $fname=$row['first_name'];
    $lname=$row['last_name'];
    $email=$row['email'];
    $company=$row['company'];
    $address = $row['address'];
    $city=$row['city'];
    $country=$row['country'];
    $zipcode=$row['zipcode'];
    $phone=$row['phone_number'];
    $products = $row['products'];
    $products = unserialize($products);
    $note=$row['note'];
    $bill=$row['total_bill'];
    $date=$row['date'];
    $status = $row['status'];
?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $fname; ?> <?php echo $lname;?></td>
                            <td><?php echo $email; ?></td>
                            <td>
                            <address style="font-size:18px;display:block;font-family:italic;">
								<?php echo $company;?><br>
								<?php echo $address;?><br>
								<?php echo $city;?>&nbsp;<?php echo $zipcode;?><br>
								<?php echo $country;?><br>
								<?php echo $phone;?>
								</address>
                            </td>
                            <td><?php echo $phone;?></td>
                            <td>
                            <?php foreach($products as $key => $value){
                                        $sqll="select * from product where product_id=$key";
                                        $resultt=$conn->query($sqll);
                                        $roww=mysqli_fetch_assoc($resultt);
                                        $namee=$roww['name'];
                                        $quan = $value['quan'];
                                ?>    
                            <p><?php echo $namee;?> [Quantity: <?php echo $quan;?>] </p>
                            <?php }?>
                        </td>
                        <td><?php echo $note;?></td>
                            <td><strong><?php echo $bill;?> PKR</strong></td>
                            <td><?php echo $date;?></td>
                            <?php if($status == 0){?>
											<td><span class="badge badge-warning" style="font-size:22px;">Pending</span></td>
											<?php }else if($status == 1){?>
												<td><span class="badge badge-success" style="font-size:22px;">Completed</span></td>
											<?php }else if($status == 2){?>
												<td><span class="badge badge-danger" style="font-size:22px;">Cancelled</span></td>
											<?php }?>
                            <td>
                                <a href="orders.php?completestatus=<?php echo $id;?>" name="" <?php if($status == 1 || $status == 2){echo "style='pointer-events:none'";}?>><button class="btn btn-block btn-success mb-2">Complete</button></a>
                                <a href="orders.php?canclestatus=<?php echo $id;?>" name="" <?php if($status == 1 || $status == 2){echo "style='pointer-events:none'";}?>><button class="btn btn-block btn-danger mb-2">Cancle</button></a>
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

    <script>
        $(".alert").delay(5000).slideUp(200, function() {
    		$(this).alert('close');
		});
    </script>

</body>

</html>