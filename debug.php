<?php
session_start();
if(!empty($_SESSION["fid"]) && $_SESSION["fid"] == 1){
	session_unset();
}else if(empty($_SESSION["id"])){
	$_SESSION["id"] = 1;
	$_SESSION["rank"] = 2;
	$_SESSION["name"] = "Racketkungen";
	$_SESSION["fid"] = 1;
}
?>
<script>
history.go(-1);
</script>
