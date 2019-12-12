<?php
session_start();
if(!empty($_SESSION["id"])){
	if(!empty($_GET["title"]) && !empty($_GET["rating"]) && !empty($_GET["comment"]) && !empty($_GET["pid"])){
		require("db.php");

		$res = mysqli_query($db, "INSERT INTO comments(user_id, product_id, title, comment, rating, date) VALUES ('".$_SESSION["id"]."','".$_GET["pid"]."', '".$_GET["title"]."', '".$_GET["comment"]."', '".$_GET["rating"]."', CURDATE())");

		$res = mysqli_query($db, "SELECT * FROM comments WHERE product_id='".$_GET["pid"]."'");

		$nr_rows = 0;
		$ratings = 0;
		while($row = mysqli_fetch_assoc($res)){
			$ratings += $row["rating"];
			$nr_rows++;
		}

		$p_rating = round($ratings/$nr_rows);

		mysqli_query($db, "UPDATE products SET rating='".$p_rating."' WHERE product_id=".$_GET["pid"]);

		echo "success";
	}else{
		echo "error_fill_all_forms";
	}
}else{
	echo "error_not_loggedin";
}
?>
