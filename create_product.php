<?php


session_start();
if(!empty($_GET["name"]) && !empty($_GET["desc"]) && !empty($_GET["price"]) && !empty($_GET["quant"]) && !empty($_GET["pic"])){
	require("db.php");

	$result = mysqli_query($db, "SELECT * FROM products WHERE pname='".$_GET["name"]."'");

	if($result->num_rows < 1){
		// prod_id, pname, desc, price, quantity, picture
		$desc = utf8_decode($_GET["desc"]);
		$result = mysqli_query($db, "INSERT INTO products(pname, description, pprice, pquantity, picture) VALUES ('".$_GET["name"]."','$desc','".$_GET["price"]."','".$_GET["quant"]."','".$_GET["pic"]."')");
		header("Location: manage_products.php");
	}else{
		$_SESSION["failed"] = 1;
                header("Location: add_product.php");
	}
}else{
	$_SESSION["failed"] = 2;
	header("Location: add_product.php");
}

?>
