<?php
if(empty($_GET["id"])){
	header("Location: https://cryslacks.win/racketkungen");
}
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

$sql = "DELETE FROM products WHERE product_id='".$_GET["id"]."'";
header("Location: manage_products.php");
?>