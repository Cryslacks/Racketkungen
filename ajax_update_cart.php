<?php
session_start();
if(!empty($_SESSION["id"])){
	if(!empty($_GET["pid"]) && !empty($_GET["q"]) && !empty($_GET["cid"])){
		require("db.php");
		$q = $_GET["q"];
		$pid = $_GET["pid"];
		$max_q = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM products WHERE product_id='".$pid."'"))["pquantity"];

		if($q > $max_q)
			$q = $max_q;
		if($q < 1)
			$q = 1;

		mysqli_query($db, "UPDATE items SET quantity='".$q."' WHERE cart_id='".$_GET["cid"]."' AND product_id='".$pid."'");
		$res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='".$_GET["cid"]."' AND active=1");
        	$total = 0;
		$price = 0;
        	while($row = mysqli_fetch_assoc($res)){
			if($row["product_id"] == $pid)
				$price = $row["price"]*$row["quantity"];
        	        $total += $row["price"]*$row["quantity"];
	        }

		echo "success;".$q.";".$price.";".$total;
	}else{
		echo "error_fill_all_forms";
	}
}else{
	echo "error_not_loggedin";
}


?>
