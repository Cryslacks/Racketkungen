<?php
/*
0 - banned
1 - customer
2 - admin/employee
*/

if(!empty($_GET["uname"]) && !empty($_GET["pass"])){
	require("db.php");
	session_start();
	$_GET["uname"] = implode("", explode("'", $_GET["uname"]));

	$result = mysqli_query($db, "SELECT * FROM users WHERE username='".$_GET["uname"]."' AND password='".$_GET["pass"]."'");

	if($result->num_rows > 0){
		// user_id, username, passwod, rank, name
		$row = mysqli_fetch_row($result);
		$_SESSION["id"] = $row[0];
		$_SESSION["rank"] = $row[3];
		$_SESSION["name"] = $row[4];
		if(!empty($_SESSION["prev"])){
			echo "success_redir;".$_SESSION["prev"];
		}else
			echo "success";
	}else{
		$_SESSION["failed"] = "true";
		echo "error_wrong_details";
	}
}else{
	echo "error_wrong_details";
}

?>
