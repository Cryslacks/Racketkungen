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
<html lang="sv" style="height:100%">
<head>
  <title>Racketkungen <?php echo "- ".$product["name"];?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" enctype="text/plain">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.7.0/js/bootstrap.min.js"></script>
</head>
<body style="position:relative;height:100%">

<?php
  require("header.php");
?>

<div class="container">
<div class="col-sm" style="margin-bottom: 70px">
	<div class="panel panel-primary">
		<div class="panel-heading"><?php echo $product['name'];?></div>
       		<div class="panel-body">
			<div style="float:left;width: 40%;">
				<img src="images/<?php echo $product['pic'];?>" class="img-responsive" style="width:80%;margin:auto;" alt="Image">
			</div>
			<div style="float:left;">
				<?php
					echo "<h3 style='width:160px;float:right;text-align:center;padding: 5px;border-radius: 5px;color:white;background-color:".($product['q'] > 1 ? 'green' : 'red')."'>".($product['q'] > 1 ? 'In stock' : 'Out of stock')."</h3>"; 
				?>
				<h3>Name: <?php echo $product['name']; ?></h3>
				<h3>Price: <?php echo $product['price']; ?>kr</h3>
				<h4 style="width: 600px;height: 100px;margin-top:30px;"><?php echo utf8_encode($product['desc']);?></h4>
			</div>
		</div>
	       	<div class="panel-footer" style="overflow: hidden">
			<form action="add_cart.php" method="get">
				<input type="hidden" value="<?php echo $product['id']; ?>" name="id"/>
				<input type="hidden" value="<?php echo $product['price']; ?>" name="price"/>
				<p style="float:left;margin-left:20%;margin-top:6px;margin-right:5px;">Quantity:</p><input type="number" value=1 name="quantity" min=1 max=<?php echo $product['q'];?> style="width: 20%;float:left;padding: 5px;"/>
				<input type="submit" value="Add to cart" style="width: 30%;float:right;margin-right:20%;padding:5px;color:white;background-color:green;border:none;border-radius: 5px;" class="login100-form-btn"/>
			</form>
		</div>
	</div>
</div>
</div>
<br><br>

<footer class="container-fluid text-center" style="position:absolute;bottom:0px;width:100%">
  <p>Racketkungen Copyright</p>
  <a href="debug.php">DEBUG <?php echo (!empty($_SESSION["id"])) ? "LOGOUT" : "LOGIN"; ?></a>
</footer>
</body>
</html>
