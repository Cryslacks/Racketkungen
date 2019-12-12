<?php
session_start();
if(empty($_SESSION["id"]))
        echo "error_need_login";
else if($_SESSION["rank"] < 2)
        echo "error_no_permission";
else if(empty($_GET["id"])){
	echo "error_fill_all_forms";
}else{
	require("db.php");
	$delete_id = $_GET['id'];
	mysqli_query($db,"DELETE FROM items WHERE product_id='$delete_id'");
	mysqli_query($db,"DELETE FROM comments WHERE product_id='$delete_id'");
	mysqli_query($db,"DELETE FROM products WHERE product_id='$delete_id'");

	echo "success";
}
?>
