<?php
session_start();
ob_start();
include "include/conn.php";
$login = 0;
if(isset($_SESSION['loggedin'])){
    $login=$_SESSION['loggedin'];
}
?>

<?php 
//login
if(isset($_POST['checkout_login'])){
    $status = 0;
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="select * from users where email='$email' && password='$password'";
    $result=mysqli_query($conn,$sql);
	if($row=mysqli_fetch_array($result)){
        $status=$row['block'];
    }
    $count = mysqli_num_rows($result);
    if($count>=1 && $status==0)
    {
        $_SESSION['puser'] = $email;
		$_SESSION['loggedin'] = 1;
        $_SESSION['clsuccess'] = "Logged In Successfully";
        header("location: checkout.php");
    }
    else{
        $_SESSION['clerror']="Invalid Username Or Password";
		if($status==1){
			$_SESSION['clerror']="Your Account is temporarily Blocked by Admin. Please Contact Customercare for more Details.";
		}
    }
}
//check coupon
if(isset($_POST['coupon'])){
    $code = $_POST['coupon_code'];
    $sql= "select * from coupon where coupon_code = '$code'";
    $result=mysqli_query($conn,$sql);
	if($row=mysqli_fetch_array($result)){
        $coupon_discount=$row['discount'];
    }
    $count = mysqli_num_rows($result);
    if($count>=1)
    {
        $_SESSION['coupon_discount'] = $coupon_discount;
        $_SESSION['csuccess'] = "Coupon Applied Successfully";
        header("location: checkout.php");
    }
    else{
        $_SESSION['cerror']="Coupon Doesn't Exist";
    }
}

?>

<?php 
if(isset($_POST['confirm_order'])){
    if(isset($_POST['cash_on_delivery'])){
        $id=uniqid();
        $ifname=$_POST['fname'];
		$ilname=$_POST['lname'];
        $name = $ifname ." ". $ilname;
        if(isset($_POST['pass'])){
        $pass=$_POST['pass'];
        }
        $iemail=$_POST['email'];
        //create user account
        if(isset($_POST['create_account'])){
            $sql="select * from users where email='$iemail'";
		    $result=$conn->query($sql);
		    if($result->num_rows > 0){
			    $_SESSION['puser'] = $iemail;
		        $_SESSION['loggedin'] = 1;
		    }
		    else
		        {
			    $ssql="insert into users(name,email,password)values('$name','$iemail','$pass');";
			    $insert=$conn->query($ssql);
                if($insert){
                    $_SESSION['puser'] = $iemail;
		            $_SESSION['loggedin'] = 1;
                }
		    }
        }
        //create user end
		$icompany="none";
		if(isset($_POST['company'])){
			$icompany=$_POST['company'];
		}
        $notes=$_POST['notes'];
		$iaddress=$_POST['address'];
		$icity=$_POST['city'];
		$icountry=$_POST['country'];
		$ipostal=$_POST['zipcode'];
		$iphone=$_POST['phone'];
        $bill=$_POST['total_bill'];
        $products=serialize($_SESSION['mycart']);
		$status=0;
		$sqll="insert into orders (id,first_name,last_name,email,company,address,city,country,zipcode,phone_number,products,note,total_bill,date,status)values('$id','$ifname','$ilname','$iemail','$icompany','$iaddress','$icity','$icountry','$ipostal','$iphone','$products','$notes','$bill',NOW(),'$status')";	
		$resultt=$conn->query($sqll);
		if($resultt){
			$_SESSION['order_success']="Order has been Placed successfully.";
            unset($_SESSION['checkout']);
            unset($_SESSION['total_payment']);
            header("location:myaccount.php");
            unset($_SESSION['mycart']);
            die();
		}
		else{
			$conn->error;
		}
    }
    else{
        echo "Payment Integration Not Done";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout - Zeb e Khaas</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="public/images/zeb-e-khass-png1.png">

    <link rel="stylesheet" href="public/css/vendor/plugins.min.css">
    <link rel="stylesheet" href="public/css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php 
    if(isset($_POST['checkout'])){
        $coupon_charge = 0;
        $_SESSION['checkout']=1;
        $_SESSION['total_payment']=$_POST['total'];
    }
    if($_SESSION['checkout'] == 1){
    ?>
    <!-- Page Banner Start -->
    <div class="page-banner-section section">
        <div class="container">
            <!-- Pager Banner Start -->
            <div class="page-banner-content text-center">
                <img src="public/images/zeb-e-khass-png1.png" alt="logo">
            </div>
            <!-- Pager Banner End -->
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Checkout Section Start -->
    <div class="section section-padding">
        <div class="container">
        <h4 class="page-banner-title mt-n3">Check Out</h4>
        <a href="viewcart.php"><i class="fas fa-backward"></i> Back to Cart</a>
        <?php if(isset($_SESSION['clsuccess'])){?>
									<div class="col-12">
										<div class="alert alert-success" role="alert">
											<?php echo $_SESSION['clsuccess']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['clsuccess'])?>
                                    <?php if(isset($_SESSION['cerror'])){?>
									<div class="col-12">
										<div class="alert alert-danger" role="alert">
											<?php echo $_SESSION['cerror']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['cerror'])?>
                                    <?php if(isset($_SESSION['csuccess'])){?>
									<div class="col-12">
										<div class="alert alert-info" role="alert">
											<?php echo $_SESSION['csuccess']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['csuccess'])?>
            <?php 
            if($login == 0){
            ?>
            <?php if(isset($_SESSION['clerror'])){?>
									<div class="col-12">
										<div class="alert alert-danger" role="alert">
											<?php echo $_SESSION['clerror']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['clerror'])?>
            <div class="checkout-info mt-30">
                <p class="info-header"> <i class="fas fa-exclamation-circle"></i> Returning customer? <a data-bs-toggle="collapse" href="#login">Click here to login</a></p>

                <div class="collapse" id="login">
                    <div class="card-body">
                        <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-form">
                                        <label class="form-label">Email*</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form">
                                        <label class="form-label">Password*</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="single-form d-flex align-items-center">
                                <button class="btn btn-dark" type="submit" name="checkout_login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php }?>

            <div class="checkout-info mt-30">
                <p class="info-header"> <i class="fa fa-exclamation-circle"></i> Have a coupon? <a data-bs-toggle="collapse" href="#coupon">Click here to enter your code</a></p>

                <div class="collapse" id="coupon">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-form">
                                        <input type="text" placeholder="Coupon code" class="form-control" name="coupon_code">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form">
                                        <button class="btn btn-dark" type="submit" name="coupon">Check Coupon</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <form action="#" method="POST">
                <div class="row">
                    <div class="col-lg-7">
                        <?php
                            if($login == 1){
                                $email=$_SESSION['puser'];
									$sql="select user_id from users where email='$email'";
									$result=$conn->query($sql);
									$row = mysqli_fetch_assoc($result);
									$id = $row["user_id"];

									$sqll="select * from shippingaddress where user_id=$id";
									$resultt=$conn->query($sqll);
                                    if ($resultt->num_rows > 0) {
										while($roww=mysqli_fetch_assoc($resultt)){
											$fname=$roww['first_name'];
											$lname=$roww['last_name'];
											$company=$roww['company'];
											$address=$roww['address'];
											$city=$roww['city'];
											$country=$roww['country'];
											$zipcode=$roww['zipcode'];
											$phone=$roww['phone_number'];
									    }
                        ?>
                        <!-- Checkout Form Start -->
                        <div class="checkout-form">
                            <div class="checkout-title">
                                <h4 class="title">Billing details</h4>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="single-form">
                                        <label class="form-label">First Name*</label>
                                        <input type="text" class="form-control" value="<?php echo $fname;?>" name="fname" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="single-form">
                                        <label class="form-label">Last Name*</label>
                                        <input type="text" class="form-control" value="<?php echo $lname;?>" name="lname" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Email Address*</label>
                                        <input type="text" class="form-control" value="<?php echo $email;?>" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-control" value="<?php echo $company;?>" name="company">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="single-form">
                                        <label class="form-label">Street Address *</label>
                                        <input type="text" class="form-control" value="<?php echo $address;?>" placeholder="House number and street name" name="address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">City*</label>
                                        <input type="text" class="form-control" value="<?php echo $city;?>" name="city" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-select2">
                                        <label class="form-label">Country*</label>
                                        <div class="form-select2">
                                            <select class="select2" required name="country">
                                                <option value="Pakistan" selected>Pakistan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Postcode / ZIP Code*</label>
                                        <input type="text" class="form-control" value="<?php echo $zipcode;?>" name="zipcode" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Phone Number*</label>
                                        <input type="text" class="form-control" value="<?php echo $phone;?>" name="phone" required>
                                    </div>
                                </div>
                            </div>

                            <div class="single-form checkout-note">
                                <label class="form-label">Order Notes</label>
                                <textarea class="form-control" placeholder="Notes about your order, e.g. item color." name="notes"></textarea>
                            </div>
                        </div>
                        <!-- Checkout Form End -->
                        <?php }}else{?>
                            <!-- Checkout Form Start -->
                        <div class="checkout-form">
                            <div class="checkout-title">
                                <h4 class="title">Billing details</h4>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="single-form">
                                        <label class="form-label">First Name*</label>
                                        <input type="text" class="form-control" name="fname" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="single-form">
                                        <label class="form-label">Last Name*</label>
                                        <input type="text" class="form-control" name="lname" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Email Address*</label>
                                        <input type="text" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-control" name="company">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="single-form">
                                        <label class="form-label">Street Address *</label>
                                        <input type="text" class="form-control" placeholder="House number and street name" name="address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">City*</label>
                                        <input type="text" class="form-control" name="city" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-select2">
                                        <label class="form-label">Country*</label>
                                        <div class="form-select2">
                                            <select class="select2" required name="country">
                                                <option value="" selected disabled>Select a country…</option>
                                                <option value="Pakistan">Pakistan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Postcode / ZIP Code*</label>
                                        <input type="text" class="form-control" name="zipcode" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <label class="form-label">Phone Number*</label>
                                        <input type="text" class="form-control" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-check checkout-checkbox">
                                <input type="checkbox" class="form-check-input" id="account" name="create_account">
                                <label class="form-check-label" for="account"> Create an account?</label>
                            </div>

                            <div class="checkout-account">
                                <div class="single-form">
                                    <label class="form-label">Create account Password *</label>
                                    <input type="password" placeholder="Password" class="form-control" name="pass">
                                </div>
                            </div>
                            </div>

                            <div class="single-form checkout-note">
                                <label class="form-label">Order Notes</label>
                                <textarea class="form-control" placeholder="Notes about your order, e.g. item color." name="notes"></textarea>
                            </div>
                        </div>
                        <!-- Checkout Form End -->
                        <?php }?>
                    </div>
                    <div class="col-lg-5">
                        <div class="checkout-order">
                            <div class="checkout-title">
                                <h4 class="title">Your Order</h4>
                            </div>

                            <div class="checkout-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="Product-name">Product</th>
                                            <th class="Product-price">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; $total=0; $saving=0; foreach($_SESSION['mycart'] as $key => $value){
                                        $sql="select * from product where product_id=$key";
                                        $result=$conn->query($sql);
                                        $row=mysqli_fetch_assoc($result);
                                        $name=$row['name'];
                                        $pdiscount=$row['discount'];
                                        $price=$row['price'];
                                        if($pdiscount!=0){
                                            $discount=$row['discount'];
                                            $discount=($discount * $price) / 100;
                                            $discount=$price-$discount;
                                            $price=round($discount);
                                        }
                                        $quan = $value['quan'];
                                ?>
                                        <tr>
                                            <td class="Product-name">
                                                <p><?php echo $name;?> × <?php echo $quan;?></p>
                                            </td>
                                            <td class="Product-price">
                                                <p><?php echo $price * $quan;?> PKR</p>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <?php if(isset($_SESSION['coupon_discount'])){
                                            $coupon_charge = $_SESSION['coupon_discount'];
                                            $coupon_charge = ($_SESSION['total_payment'] * $coupon_charge ) /100;
                                            $_SESSION['total_payment'] = $_SESSION['total_payment'] - $coupon_charge;
                                            ?>
                                        <tr>
                                            <td class="Product-name">
                                                <p>Coupon Discount</p>
                                            </td>
                                            <td class="Product-price">
                                                <p><?php echo $_SESSION['coupon_discount'];?>%</p>
                                            </td>
                                        </tr>
                                        <?php }unset($_SESSION['coupon_discount'])?>
                                        <tr>
                                            <td class="Product-name">
                                                <p>Subtotal</p>
                                            </td>
                                            <td class="Product-price">
                                                <p><?php echo $_SESSION['total_payment'];?> PKR</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Product-name">
                                                <p>Shipping</p>
                                            </td>
                                            <td class="Product-price">
                                                <?php 
                                                $sql="select * from shipping_charges";
                                                $result=$conn->query($sql);
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $ship_price = $row['price'];
                                                    $charges=$row['charges'];
                                                }
                                                ?>
                                                <?php 
                                                if($_SESSION['total_payment'] > $ship_price){
                                                    $charges = 0;
                                                }
                                                ?>
                                                <p><?php echo $charges;?> PKR</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Product-name">
                                                <p>Total</p>
                                            </td>
                                            <td class="total-price">
                                                <p><?php $_SESSION['total_payment'] = $_SESSION['total_payment'] + $charges; echo $_SESSION['total_payment']; ?> PKR</p>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <input type="hidden" value="<?php echo $_SESSION['total_payment']?>" name="total_bill">
                            <div class="checkout-payment">
                                <ul>
                                    <li>
                                        <div class="single-payment">
                                            <div class="payment-radio">
                                                <input type="radio" name="radio" id="bank">
                                                <label for="bank"><span></span> Direct bank transfer </label>

                                                <div class="payment-details">
                                                    <p>Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-payment">
                                            <div class="payment-radio">
                                                <input type="radio" name="cash_on_delivery" id="cash" checked="checked">
                                                <label for="cash"><span></span> Cash on Delivery</label>
                                                <div class="payment-details">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="checkout-btn">
                                    <button type="submit" class="btn btn-dark btn-block" name="confirm_order">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Section End -->


    <!--Back To Start-->
    <a href="#" class="back-to-top bg-dark">
    <i class="fas fa-sort-up"></i>
    </a>
    <!--Back To End-->
    <?php }else{?>
        <!-- Page Banner Start -->
    <div class="page-banner-section section">
        <div class="container">
            <!-- Pager Banner Start -->
            <div class="page-banner-content text-center">
            <img src="public/images/zeb-e-khass-png1.png" alt="logo">
            <br><br>
                <h2 class="page-banner-title">Session Expired</h2>
                <a href="viewcart.php">Back To Cart</a>
            </div>
            <!-- Pager Banner End -->
        </div>
    </div>
    <!-- Page Banner End -->
    <?php }?>




    <!-- JS
    ============================================ -->

    <!-- Modernizer & jQuery JS -->
    <script src="public/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="public/js/vendor/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <!-- <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script> -->

    <!-- Plugins JS -->
    <!-- <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/ajax-contact.js"></script> -->

    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <script src="public/js/plugins.min.js"></script>


    <!-- Main JS -->
    <script src="public/js/main.js"></script>

    <script>
        $(".alert").delay(5000).slideUp(200, function() {
    		$(this).alert('close');
		});
    </script>


</body>

</html>