<?php
session_start();

if(empty($_SESSION["id"]))
	echo "error_need_login";
else if($_SESSION["rank"] < 2)
	echo "error_no_permission";


require("db.php");

if(empty($_GET["id"]))
	$result = mysqli_query($db, "SELECT * FROM products");
else
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
<style>
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
	color:white;
        background-color:#255680;
        }
        .button:active {
        position:relative;
        top:1px;
        }

</style>
<div class="container">
<?php
// sql shit get all products
require("db.php");

$result = mysqli_query($db, "SELECT * FROM products");
echo '<ul class="list-group">';
	while($row = mysqli_fetch_row($result)){
		if($product["id"] == $row[0]){
			echo (' <li class="list-group-item active" style="background-color:white;cursor:pointer" onclick="openTab(`manage`, '.$row[0].')"><a style="pointer-events:none">'.$row[1].'</a></li>');	
		}else{
			echo (' <li class="list-group-item" style="cursor:pointer" onclick="openTab(`manage`, '.$row[0].')"><a style="pointer-events:none">'.$row[1].'</a></li>');
		}
	}
	echo '<li class="list-group-item"><a onclick="openTab(`add`)" class="button">Add Product</a></li>';
echo '</ul>';
?>   
<div class="info">
	<div class="infoleft">
	<img src="images/<?php echo $product['pic'];?>" class="img-responsive" style="width:60%;" alt="Image">
	<h4>Name: <?php echo $product['name']; ?></h4>
	<h4>Quantity: <?php echo $product['q']; ?> st</h4>
	<h4>Price: <?php echo $product['price']; ?> kr</h4>
	<h4>Description: <?php echo utf8_encode($product['desc']);?></h4>
	</div>	
	<div class="inforight">
	<a onclick="openTab('edit', <?php echo $product['id'];?>)" class="button" style="cursor:pointer">Edit Product</a>
	<p>
	<p>
	<a onclick="delete_product(<?php echo $product['id'];?>)" class="button" style="cursor:pointer">Remove Product</a>
	</div>
</div>
</div>
