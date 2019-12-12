<?php
session_start();
if(empty($_GET["id"])){
	echo "error_no_id";
//	header("Location: https://cryslacks.win/racketkungen");
}
	require("db.php");
	$delete_id = $_GET['id'];
	mysqli_query($db,"DELETE FROM items WHERE product_id=$delete_id");
	mysqli_query($db,"DELETE FROM products WHERE product_id=$delete_id");
	echo "success";
//	header("Location: manage_productinfo.php?id=1");

?>
