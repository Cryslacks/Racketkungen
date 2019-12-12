<?php
session_start();

// TODO: Fixa så man blir tillbaka skickad hit efter man loggat in!
if(empty($_SESSION["id"])){
	$_SESSION["prev"] = "ajax_add_cart.php?id=".$_GET["id"]."&quantity=".$_GET["quantity"]."&price=".$_GET["price"];
	echo "error_not_loggedin";
}else{
	if(!empty($_GET["id"]) && !empty($_GET["quantity"]) && !empty($_GET["price"])){
		require("db.php");

		$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='".$_SESSION["id"]."'");
		if($res->num_rows > 0){
			$cart_found = 0;
			while($row = mysqli_fetch_assoc($res)){
				$res2 = mysqli_query($db, "SELECT * FROM orders WHERE cart_id='".$row["cart_id"]."'");

				if($res2->num_rows < 1){
					$id = $row["cart_id"];
					$cart_found = 1;
					break;
				}
			}

			if($cart_found == 0){
				$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES (".$_SESSION["id"].")");
				$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."'");
				$id = mysqli_fetch_assoc($res)["cart_id"];
			}
		}else{
			$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES (".$_SESSION["id"].")");
			$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."'");
			$id = mysqli_fetch_assoc($res)["cart_id"];
		}

		$res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='". $id ."' AND product_id='". $_GET["id"] ."' AND active=1");

		if($res->num_rows > 0){
			$item_info = mysqli_fetch_assoc($res);

			$res = mysqli_query($db, "SELECT * FROM products WHERE product_id='". $_GET["id"] ."'");
			$q = mysqli_fetch_assoc($res)["pquantity"];

			$quantity = intval($_GET["quantity"])+intval($item_info["quantity"]);

			if($quantity > $q)
				$quantity = $q;

			$res = mysqli_query($db, "UPDATE items SET quantity='".$quantity."' WHERE cart_id='".$id."' AND product_id='".$_GET["id"]."'");
		}else{
			$res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='". $id ."' AND product_id='". $_GET["id"] ."' AND active=0");

			if($res->num_rows > 0){
				$quantity = $_GET["quantity"];
				$res = mysqli_query($db, "UPDATE items SET quantity='".$quantity."',active='1' WHERE cart_id='".$id."' AND product_id='".$_GET["id"]."'");
			} else {
				$res = mysqli_query($db, "SELECT * FROM products WHERE product_id='". $_GET["id"] ."'");
				$q = mysqli_fetch_assoc($res)["pquantity"];

				$quantity = $_GET["quantity"];
				if($quantity > $q)
					$quantity = $q;

				$res = mysqli_query($db, "INSERT INTO items (cart_id, product_id, quantity, active, price) VALUES (".$id.", ".$_GET["id"].", ".$quantity.", 1, ".$_GET["price"].")");	
			}
		}

		$name = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM products WHERE product_id='".$_GET["id"]."'"))["pname"];
		echo "success;".$_GET["quantity"]." ".$name;
	}else{
		echo "error_fill_all_forms";
	}
}
// Kolla pa  UPSERT
?>
