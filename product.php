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
  <title>Racketkungen <?php echo "- ".$product["name"];?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" enctype="text/plain">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.7.0/js/bootstrap.min.js"></script>
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
  </style>
</head>
<body>

<!--<div class="jumbotron">
  <div class="container text-center">
    <h1>Racketkungen</h1>      
  </div>
</div>
-->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Racketkungen</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Store</a></li>
	<?php
		if(!empty($_SESSION["name"]))
			echo '<li><h4 style="color:white;font-size:15px;margin-left:10px;margin-top: 17px;"><span class="glyphicon"></span> Welcome '.$_SESSION["name"].'</h4></li>';
	?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	    <?php
		if(!empty($_SESSION["rank"]) && $_SESSION["rank"] == 2)
			echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> Manage Products </a></li>';

		if(!empty($_SESSION["id"]))
			echo '<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
		else
			echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login </a></li>';
		?>
		<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<div class="col-sm">
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

<footer class="container-fluid text-center">
  <p>Racketkungen Copyright</p>
  <a href="debug.php">DEBUG <?php echo (!empty($_SESSION["id"])) ? "LOGOUT" : "LOGIN"; ?></a>
</footer>
<?php
echo "<pre>";
print_r($product);
echo "</pre>";

?>
</body>
</html>
