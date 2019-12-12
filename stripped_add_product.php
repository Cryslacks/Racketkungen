<?php
session_start();

if(empty($_SESSION["id"]))
        echo "error_need_login";
else if($_SESSION["rank"] < 2)
        echo "error_no_permission";

?>

			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50" style="margin:auto;">
				<div class="text-left">
					<a onclick="openTab('manage')" class="txt2 hov1" style="margin-left: -40px;position: relative;top: -50px;padding: 5px;background-color:white;color:blue">Back</a>
				</div>
				<form class="login100-form validate-form" id="main_form" onkeydown="keyHandler(event, 'add')">
					<span class="login100-form-title p-b-33">
						Add Product
					</span>

					<h5 style="padding:5px;margin-top:5px;">Name</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Product name is required">
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<h5 style="padding:5px;margin-top:5px;">Description</h5>
					<div class="wrap-input100 validate-input" data-validate = "Description is required">
						<input class="input100" type="text" name="desc" placeholder="Description">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<h5 style="padding:5px;margin-top:5px;">Price</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Price is required">
						<input class="input100" type="text" name="price" placeholder="Price">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					
					<h5 style="padding:5px;margin-top:5px;">Quantity</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Quantity is required">
						<input class="input100" type="text" name="quant" placeholder="Quantity">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					
					<h5 style="padding:5px;margin-top:5px;">Image</h5>
					<div class="wrap-input100 rs1 validate-input" data-validate="Quantity is required">
						<br>
						<input class="input100" type="file" name="file">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<a class="login100-form-btn" onclick="update_product('add')">
							Submit
						</a>
					</div>

					<div class="text-center" style="margin-top: 10px;visibility:hidden;" id="error_box">
                                                <span class="txt1" style="color:red" id="error_msg">
                                                        Please fill out all inputs!
                                                </span>
                                        </div>
			</div>
