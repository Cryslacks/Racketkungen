<?php


session_start();
if(!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_POST['price']) && !empty($_POST['quant']) && !empty($_FILES['file']['name'])){
	require("db.php");

	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$file_size = $_FILES['file']['size'];
	$file_tem_loc = $_FILES['file']['tmp_name'];
	$file_store = "images/".$file_name;
	
	move_uploaded_file($file_tem_loc, $file_store);
		
	$result = mysqli_query($db, "SELECT * FROM products WHERE pname='".$_REQUEST['name']."'");
	
	if($result->num_rows < 1){
		// prod_id, pname, desc, price, quantity, picture
		$desc = utf8_decode($_REQUEST['desc']);
		$name = $_REQUEST['name'];
		$price = $_REQUEST['price'];
		$quant = $_REQUEST['quant'];
		
		mysqli_query($db, "INSERT INTO products(pname, description, pprice, pquantity, picture) VALUES ('$name','$desc','$price','$quant','$file_name')");
		header("Location: manage_productinfo.php?id=1");
	}else{
		$_SESSION["failed"] = 1;
			echo "num row > 1";
                header("Location: add_product.php");
	}
}else{
	$_SESSION["failed"] = 2;
	echo "Complete fail";
	header("Location: add_product.php");
}

?>
