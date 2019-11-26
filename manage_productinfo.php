<!DOCTYPE html>
<?php
session_start();

if(empty($_GET["id"]))
	header("Location: https://cryslacks.win/racketkungen");

require("db.php");
$result = mysqli_query($db, "SELECT * FROM products WHERE product_id='".$_GET["id"]."'");

if($result->num_rows > 0){
	$row = mysqli_fetch_assoc($result);
	$product["id"]    = $row["product_id"];
	$product["name"]  = $row["pname"];
	$product["desc"]  = $row["description"];
	$product["price"] = $row["pprice"];
	$product["q"] 	  = $row["pquantity"];
	$product["pic"]   = $row["picture"];
}
?>
<html lang="sv">
<head>
  <title>Racketkungen</title>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" enctype="text/plain">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
	.list-group {
		width: 20%;
		float: left;
		color: black;
	}
	.container {
		padding:30px;
		//background-color: grey;
	}
	.info {
		padding: 25px;
		width: 78%;
		height: 640px;
		float: right;
		border: 1px solid #dddddd;
		border-radius: 8px;
		color: #dddddd;
	}
	.infoleft {
		width:70%;
		float: left;
		color: #dddddd;
	}
	.inforight {
		width:20%;
		float: right;
		color: #dddddd;
	}
	img {
		border: 1px solid #dddddd;
		border-radius: 8px;
	}
	h4 {
		color: black;
	}
	.button {
	background:linear-gradient(to bottom, #3379b7 5%, #255680 100%);
	background-color:#3379b7;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
	padding:5px 18px;
	text-decoration:none;
	}
	.button:hover {
	background:linear-gradient(to bottom, #255680 5%, #3379b7 100%);
	background-color:#255680;
	}
	.button:active {
	position:relative;
	top:1px;
	}
  </style>
</head>
<body>

<!--<div class="jumbotron">
  <div class="container text-center">
    <h1>Racketkungen</h1>      
  </div>
</div>
-->
<?php
	require('header.php');
?>

<div class="container">
<?php
// sql shit get all products
require("db.php");

$result = mysqli_query($db, "SELECT * FROM products");
echo '<ul class="list-group">';
	while($row = mysqli_fetch_row($result)){
		echo (' <li class="list-group-item"><a href="manage_productinfo.php?id='.$row[0].'">'.$row[1].'</a></li>');
	}
	echo '<li class="list-group-item"><a href="add_product.php" class="button">Add Product</a></li>';
echo '</ul>';
?>   
<div class="info">
	<div class="infoleft">
	<img src="images/<?php echo $product['pic'];?>" class="img-responsive" style="width:60%;" alt="Image">
	<h4>Quantity: <?php echo $product['q']; ?> st</h4>
	<h4>Price: <?php echo $product['price']; ?> kr</h4>
	<h4>Description: <?php echo utf8_encode($product['desc']);?></h4>
	</div>	
	<div class="inforight">
	
	<a href="delete.php?id=<?php echo $product['id'];?>" onclick="return confirm('Ta bort produkt?')" class="button">Remove Product</a>
	
	<h4>Name: <?php echo $product['name']; ?></h4>
	</div>
</div>
</div>
<br><br>

<footer class="container-fluid text-center">
  <p>Racketkungen Copyright</p>  
</footer>

</body>
</html>
