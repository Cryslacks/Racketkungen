<?php
session_start();

if(!empty($_SESSION["id"]))
	session_unset();

?>
