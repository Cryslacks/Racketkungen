<?php
SESSION_START();
if(!empty($_GET["cart_id"]) and !empty($_GET["p_id"])){
	require("db.php");
	$cart_id = $_GET["cart_id"];
	$p_id = $_GET["p_id"];
	$sql = "UPDATE items SET active=0 WHERE cart_id=".$cart_id." AND product_id=".$p_id;
	$db->query($sql);

	$res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='".$cart_id."' AND active=1");
	$total = 0;
	while($row = mysqli_fetch_assoc($res)){
		$total += $row["price"]*$row["quantity"];
	}

	$_SESSION["cart_total"] = $total;
	echo "success;".$total;
}else {
	echo "error_fill_all_forms";
}
?>
