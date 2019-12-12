<?php
/*
0 - banned
1 - customer
2 - admin/employee
*/

session_start();
if(!empty($_GET["uname"]) && !empty($_GET["pass"]) && !empty($_GET["name"])){
	require("db.php");

	$result = mysqli_query($db, "SELECT * FROM users WHERE username='".$_GET["uname"]."'");

	if($result->num_rows < 1){
		// user_id, username, passwod, rank, name
		$result = mysqli_query($db, "INSERT INTO users(username, password, rank, name) VALUES ('".$_GET["uname"]."','".$_GET["pass"]."', 1, '".$_GET["name"]."')");

		$_SESSION["id"] = mysqli_insert_id($db);
		$_SESSION["rank"] = 1;
		$_SESSION["name"] = $_GET["name"];
		echo "success";
	}else{
		$_SESSION["failed"] = 1;
		echo "error_username_in_use";
	}
}else{
	$_SESSION["failed"] = 2;
	echo "error_fill_all_forms";
}

?>
