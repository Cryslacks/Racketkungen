<?php
  SESSION_START();
  if(!empty($_GET["cart_id"]) and !empty($_GET["p_id"])){
      require("db.php");
	  $cart_id = $_GET["cart_id"];
	  $p_id = $_GET["p_id"];
      $sql = "UPDATE items SET active=0 WHERE cart_id=".$cart_id." AND product_id=".$p_id;
	  $db->query($sql);
	  header("Location: cart.php");
  }else {
    echo 'empty';
  }



 ?>
