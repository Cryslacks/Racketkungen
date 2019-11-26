<?php
session_start();
if(empty($_GET["id"])){
	header("Location: https://cryslacks.win/racketkungen");
}else{
	require("db.php");
	$delete_id = $_GET['id'];
	mysqli_query($db,"DELETE FROM products WHERE product_id='$delete_id'");
	header("Location: manage_products.php");
}
?>