<?php
session_start();

// TODO: Fixa så man blir tillbaka skickad hit efter man loggat in!
if(empty($_SESSION["id"])){
	$_SESSION["prev"] = "add_cart.php?id=".$_GET["id"]."&quantity=".$_GET["quantity"]."&price=".$_GET["price"];
	header("Location: login.php");
}else{
	if(!empty($_GET["id"]) && !empty($_GET["quantity"]) && !empty($_GET["price"])){
		require("db.php");

		$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='".$_SESSION["id"]."'");
		if($res->num_rows > 0){
			echo "Cart exists";
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
			echo "Cart doesnt exists";
			$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES (".$_SESSION["id"].")");
			$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."'");
			$id = mysqli_fetch_assoc($res)["cart_id"];
		}

		$res = mysqli_query($db, "INSERT INTO items (cart_id, product_id, quantity, active, price) VALUES (".$id.", ".$_GET["id"].", ".$_GET["quantity"].", 1, ".$_GET["price"].")");
		echo "</br>CART_ID=".$id;
	}

	header("Location: index.php");
}
?>