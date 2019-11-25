<?php
if(!empty($_GET["uname"]) && !empty($_GET["pass"])){
	session_start();
	echo "Website time active: ".$_SESSION["test"]."s ".$_GET["uname"];

	if(!empty($_SESSION["test"]) && $_SESSION["test"] > 7000000)
		$_SESSION["test"] = 0;
	$_SESSION["test"] += 1;
}
?>
