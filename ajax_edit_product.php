<?php
session_start();

if(empty($_SESSION["id"]))
        echo "error_need_login";
else if($_SESSION["rank"] < 2)
        echo "error_no_permission";
else if(!empty($_POST['ename']) && !empty($_POST['edesc']) && !empty($_POST['eprice']) && !empty($_POST['equant']) && !empty($_POST['eid']) && !empty($_FILES['file']['name']) && !empty($_POST['esale'])){
	require("db.php");

	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$file_size = $_FILES['file']['size'];
	$file_tem_loc = $_FILES['file']['tmp_name'];
	$file_store = "images/".$file_name;

	move_uploaded_file($file_tem_loc, $file_store);

	$id = $_REQUEST['eid'];
	$name = $_REQUEST['ename'];
	$desc = utf8_decode($_REQUEST['edesc']);
	$price = $_REQUEST['eprice'];
	$quant = $_REQUEST['equant'];
	$sale = $_REQUEST['esale'];

	mysqli_query($db, "UPDATE products SET pname='$name', description='$desc', pprice='$price', pquantity='$quant', picture='$file_name',sale='$sale' WHERE product_id='$id'");
	$id = mysqli_fetch_assoc(mysqli_query($db, "SELECT product_id FROM products WHERE pname='$name'"))["product_id"];
	echo "success;".$id;
}else if (!empty($_POST['ename']) && !empty($_POST['edesc']) && !empty($_POST['eprice']) && !empty($_POST['equant']) && !empty($_POST['eid'])){
	require("db.php");

	$id = $_REQUEST['eid'];
	$name = $_REQUEST['ename'];
	$desc = utf8_decode($_REQUEST['edesc']);
	$price = $_REQUEST['eprice'];
	$quant = $_REQUEST['equant'];
	$sale = $_REQUEST['esale'];

	mysqli_query($db, "UPDATE products SET pname='$name', description='$desc', pprice='$price', pquantity='$quant',sale='$sale' WHERE product_id='$id'");
	$id = mysqli_fetch_assoc(mysqli_query($db, "SELECT product_id FROM products WHERE pname='$name'"))["product_id"];
	echo "success;".$id;
}else{
	echo "error_fill_all_forms";
}
?>
