<?php
	SESSION_START();
		if(!empty($_SESSION["id"]) and !empty($_GET["cart_id"])){
			$cid = $_GET["cart_id"];
			require("db.php");

		  $res = mysqli_query($db, "SELECT money FROM users WHERE user_id='". $_SESSION["id"]."'");


			$cash = intval(mysqli_fetch_assoc($res)["money"]);

			if($_SESSION["cart_total"] > 0){
				if($cash < $_SESSION["cart_total"]){
					echo "error_insufficient";
				}else{
					try {
						mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

						$res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='".$cid."' AND active='1'");
						while($row = mysqli_fetch_assoc($res)){
							$qUpdate = $row["quantity"];
							$pidUpdate = $row["product_id"];

							mysqli_query($db, "UPDATE products SET pquantity=pquantity-".$qUpdate." WHERE product_id='".$pidUpdate."'");
						}


						mysqli_query($db, "UPDATE users SET money=money-".$_SESSION["cart_total"]." WHERE user_id='". $_SESSION["id"]."'");		//add to order
						mysqli_query($db, "UPDATE users SET money=money+".$_SESSION["cart_total"]." WHERE user_id='1'");		//set item in cart to inactive?
						mysqli_query($db, "INSERT INTO orders (user_id, cart_id) VALUES ('".$_SESSION["id"]."', '".$cid."')");		//set cart inactive/remove

						mysqli_commit($db);
						echo "success";

					} catch (Exception $e){
						mysqli_rollback($db);
						echo "error_unknown"; //SOMETHNIG WHEN WRONG!
					}


				}
			}else{
				echo "error_empty_cart";
			}
	}else{
		echo "error_unknown";
	}
//https://www.php.net/manual/en/mysqli.begin-transaction.php

?>
