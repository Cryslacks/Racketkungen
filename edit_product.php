<!DOCTYPE html>
<?php
session_start();

require("db.php");
$result = mysqli_query($db, "SELECT * FROM products WHERE product_id='".$_GET["id"]."'");

if($result->num_rows > 0){
	$row = mysqli_fetch_assoc($result);
	$product["id"]    = $row["product_id"];
	$product["name"]  = $row["pname"];
	$product["desc"]  = $row["description"];
	$product["price"] = $row["pprice"];
	$product["q"] 	  = $row["pquantity"];
	$product["pic"]   = $row["picture"];
}

?>
<html lang="en">
<head>
	<title>Edit Product</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<form action="create_edit.php" method="post" enctype="multipart/form-data"> 
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<div class="text-left">
					<a href="manage_productinfo.php?id=1" class="txt2 hov1" style="margin-left: -40px;position: relative;top: -50px;padding: 5px;background-color:white;color:blue">Back</a>
				</div>
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-33">
						Edit Product
					</span>

					<div class="wrap-input100 rs1 validate-input" data-validate="Product name is required">
						<input class="input100" type="text" name="ename" placeholder="Product Name" value="<?php echo $product['name']; ?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Description is required">
						<input class="input100" type="text" name="edesc" placeholder="Description" value="<?php echo utf8_encode($product['desc']);?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Price is required">
						<input class="input100" type="text" name="eprice" placeholder="Price" value="<?php echo utf8_encode($product['price']);?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					
					<div class="wrap-input100 rs1 validate-input" data-validate="Quantity is required">
						<input class="input100" type="text" name="equant" placeholder="Quantity" value="<?php echo $product['q']; ?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					
					<div class="wrap-input100 rs1 validate-input" data-validate="Quantity is required">
						<br>
						<input class="input100" type="file" name="file" placeholder="file">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					
					<div class="wrap-input100 rs1 validate-input" data-validate="Product ID is required">
						<input class="input100" type="hidden" name="eid" placeholder="Product ID" value="<?php echo $product['id'];?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>


					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							Submit
						</button>
					</div>
					 <?php
                                                session_start();
                                                if(!empty($_SESSION["failed"])){
							if($_SESSION["failed"] == 1){
                                                        	echo '  <div class="text-center" style="margin-top: 10px;">
                                                                        	<span class="txt1" style="color:red">
                                                                        	    Username already in use!
                                                                	        </span>
                                                         	       </div>';

							} else if($_SESSION["failed"] == 2){
                                                        	echo '  <div class="text-center" style="margin-top: 10px;">
                                                                        	<span class="txt1" style="color:red">
                                                                        	    Please fill out all inputs!
                                                                	        </span>
                                                         	       </div>';

							}
                                                        unset($_SESSION["failed"]);
                                                }
                                        ?>

			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
