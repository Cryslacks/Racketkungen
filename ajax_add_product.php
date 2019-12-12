<?php


session_start();

if(empty($_SESSION["id"]))
        echo "error_need_login";
else if($_SESSION["rank"] < 2)
        echo "error_no_permission";
else if(!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_POST['price']) && !empty($_POST['quant']) && !empty($_FILES['file']['name'])){
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
		$id = mysqli_fetch_assoc(mysqli_query($db, "SELECT product_id FROM products WHERE pname='$name'"))["product_id"];
		echo "success;".$id;
	}else{
		echo "error_name_in_use";
	}
}else{
	echo "error_fill_all_forms";
}

?>
