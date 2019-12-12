<?php
session_start();
if(!empty($_POST['ename']) && !empty($_POST['edesc']) && !empty($_POST['eprice']) && !empty($_POST['equant']) && !empty($_POST['eid']) && !empty($_FILES['file']['name'])){
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

	mysqli_query($db, "UPDATE products SET pname='$name', description='$desc', pprice='$price', pquantity='$quant', picture='$file_name' WHERE product_id='$id'");
	header("Location: manage_productinfo.php?id=".$id);	

}elseif (!empty($_POST['ename']) && !empty($_POST['edesc']) && !empty($_POST['eprice']) && !empty($_POST['equant']) && !empty($_POST['eid'])){
	require("db.php");

	$id = $_REQUEST['eid'];
	$name = $_REQUEST['ename'];
	$desc = utf8_decode($_REQUEST['edesc']);
	$price = $_REQUEST['eprice'];
	$quant = $_REQUEST['equant'];

	mysqli_query($db, "UPDATE products SET pname='$name', description='$desc', pprice='$price', pquantity='$quant' WHERE product_id='$id'");
	header("Location: manage_productinfo.php?id=".$id);	
}else{
	$_SESSION["failed"] = 2;
	echo "Complete fail";
	header("Location: add_product.php");
}
?>
