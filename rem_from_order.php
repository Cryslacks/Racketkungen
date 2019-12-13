<?php
SESSION_START();
if(empty($_SESSION["id"]))
	echo "error_need_login";
else if(!empty($_GET["order_id"]) and !empty($_GET["total"])){
	require("db.php");
	$order_id = $_GET["order_id"];
	$total = $_GET["total"];

	try {
        	mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

		$res = mysqli_query($db, "SELECT * FROM orders WHERE order_id='".$order_id."'");
		$row = mysqli_fetch_assoc($res);

		$cid = $row["cart_id"];
		$user_id = $row["user_id"];

                $res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='".$cid."' AND active='1'");
                while($row = mysqli_fetch_assoc($res)){
                	$qUpdate = $row["quantity"];
                        $pidUpdate = $row["product_id"];

                         mysqli_query($db, "UPDATE products SET pquantity=pquantity+".$qUpdate." WHERE product_id='".$pidUpdate."'");
            	}


                mysqli_query($db, "UPDATE users SET money=money-".$total." WHERE user_id='1'");
                mysqli_query($db, "UPDATE users SET money=money+".$total." WHERE user_id='".$user_id."'");
                mysqli_query($db, "UPDATE orders SET cancelled=1 WHERE order_id=".$order_id);

                mysqli_commit($db);

	} catch (Exception $e){
        	mysqli_rollback($db);
                echo "error_unknown";
 	}

	if($_SESSION["rank"] > 1)
		$res = mysqli_query($db, "SELECT * FROM orders WHERE cancelled=0");
	else
		$res = mysqli_query($db, "SELECT * FROM orders WHERE cancelled=0 AND user_id=".$_SESSION["id"]);

	$total = 0;
	while($row = mysqli_fetch_assoc($res)){
		$res2 = mysqli_query($db, "SELECT SUM(price*quantity) as total FROM items WHERE cart_id='".$row["cart_id"]."'");
		$total += mysqli_fetch_assoc($res2)["total"];
	}

	echo "success;".$total;
}else {
	echo "error_fill_all_forms";
}
?>
