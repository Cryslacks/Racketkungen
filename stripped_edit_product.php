<?php
session_start();

if(empty($_SESSION["id"]))
        echo "error_need_login";
else if($_SESSION["rank"] < 2)
        echo "error_no_permission";

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
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50" style="margin:auto">
				<form class="login100-form validate-form" id="main_form" onkeypress="keyHandler(event, '<?php if(!empty($_GET["redir"])) echo "r_";?>edit')">
					<div class="text-left" style="cursor:pointer">
                                        	<a onclick="openTab(<?php if(!empty($_GET["redir"])){echo "'product','".$_GET["id"]."'";}else{echo "'manage'";}?>)" class="txt2 hov1" style="margin-left: -40px;position: relative;top: -50px;padding: 5px;background-color:white;color:blue">Back</a>
	                                </div>
					<span class="login100-form-title p-b-33">
						Edit Product
					</span>

					<h5 style="padding:5px;margin-top:5px;">Name</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Product name is required">
						<input class="input100" type="text" name="ename" placeholder="Product Name" value="<?php echo $product['name']; ?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<h5 style="padding:5px;margin-top:5px;">Description</h5>
					<div class="wrap-input100 validate-input" data-validate = "Description is required">
						<input class="input100" type="text" name="edesc" placeholder="Description" value="<?php echo utf8_encode($product['desc']);?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<h5 style="padding:5px;margin-top:5px;">Price</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Price is required">
						<input class="input100" type="text" name="eprice" placeholder="Price" value="<?php echo utf8_encode($product['price']);?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<h5 style="padding:5px;margin-top:5px;">Quantity</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Quantity is required">
						<input class="input100" type="text" name="equant" placeholder="Quantity" value="<?php echo $product['q']; ?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<h5 style="padding:5px;margin-top:5px;">Image</h5>
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
						<a class="login100-form-btn" onclick="update_product('edit'<?php if(!empty($_GET["redir"])) echo ",'".$_GET["redir"]."'";?>)">
							Submit
						</a>
					</div>
                                        <div class="text-center" style="margin-top: 10px;visibility:hidden;" id="error_box">
                                               	<span class="txt1" style="color:red" id="error_msg">
                                                	Please fill out all inputs!
                                        	</span>
                                        </div>
			</div>
