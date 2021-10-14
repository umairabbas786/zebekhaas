<?php
session_start();
include "includes/conn.php";
if (empty(isset($_SESSION['user']))) {
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

    <title>Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $name?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
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

                        <!-- Nav Item - User Information
                        <li class="nav-item mr-5 mt-2">
                            <button onclick="toggleFullScreen()" class="fullbtn" style="all: unset;cursor: pointer;"><i class="fas fa-expand" style="font-size:22px"></i></button>
                        </li> -->
                        <li class="nav-item ">
                            <button class="btn btn-form btn-primary btn-md btn-block"><a href="logout.php"
                                    class="text-white">Logout</a></button>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <?php 
$sql="select sum(total_bill) from orders where status = 1";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $total=$row['sum(total_bill)'];
}
if($total == null){
    $total = 0;
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-success shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Earning</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total;?> PKR
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

$sql="select count(id) from category";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(id)'];
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Categories</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 

$sql="select count(product_id) from product";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(product_id)'];
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Products</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

$sql="select count(user_id) from users";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(user_id)'];
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

$sql="select count(id) from orders where status = 0";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(id)'];
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pending Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-pause fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

$sql="select count(id) from orders where status = 1";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(id)'];
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Completed Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-check fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

$sql="select count(id) from orders where status = 2";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(id)'];
}

?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Cancelled Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-ban fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

$sql="select count(review_id) from reviews";
$result=$conn->query($sql);
if($row=mysqli_fetch_assoc($result))
{
    $count=$row['count(review_id)'];
}

?>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2" style="border-width:thick">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Costumer Reviews</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="col-md-6">
<!-- DataTales Example -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$sql="select * from orders where status = 0";
$show=$conn->query($sql);
if ($show->num_rows > 0) {
while ($row = mysqli_fetch_assoc($show)) {
    $id=$row['id'];
    $date=$row['date'];
    $status = $row['status'];
?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $date;?></td>
							<td><span class="badge badge-warning" style="font-size:18px;">Pending</span></td>
                        </tr>
                        <?php }}else{?>
							<tr><td class="text-center" colspan="3">No Data Found.</td></tr>
						<?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                                            </div>

                                            <div class="col-md-6">
<!-- DataTales Example -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Completed Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$sql="select * from orders where status = 1";
$show=$conn->query($sql);
if ($show->num_rows > 0) {
while ($row = mysqli_fetch_assoc($show)) {
    $id=$row['id'];
    $date=$row['date'];
    $status = $row['status'];
?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $date;?></td>
							<td><span class="badge badge-success" style="font-size:18px;">Completed</span></td>
                        </tr>
                        <?php }}else{?>
							<tr><td class="text-center" colspan="3">No Data Found.</td></tr>
						<?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                                            </div>


                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="public/vendor/jquery/jquery.min.js"></script>
        <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="public/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="public/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="public/js/demo/chart-area-demo.js"></script>
        <script src="public/js/demo/chart-pie-demo.js"></script>
        <script>
            function toggleFullScreen() {
  if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen();
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    }
  }
}
        </script>

</body>

</html>