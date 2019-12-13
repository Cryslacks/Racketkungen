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
	$product["sale"]  = $row["sale"];
}
?>

<div class="container">
<div class="col-sm" style="margin-bottom: 70px">
	<div class="panel panel-primary">
		<div class="panel-heading" style="font-weight:bold;font-size: 20px;"><?php echo $product['name'];?><span style="float:right">
		<?php
					for($i = 0; $i < 5-$row["rating"]; $i++)
						echo '<span class="glyphicon glyphicon-star" style="float:right;color:black;"></span>';
					for($i = 0; $i < $row["rating"]; $i++)
						echo '<span class="glyphicon glyphicon-star" style="float:right;color:#caa300;"></span>';
		?></span></div>
       		<div class="panel-body">
			<div style="float:left;width: 40%;">
				<img  src="images/<?php echo $product['pic'];?>" class="img-responsive" style="width:80%;margin:auto;" alt="Image">
			</div>
			<div style="float:left;">
				<?php
					echo "<h3 id='product_status'style='width:160px;float:right;text-align:center;padding: 5px;border-radius: 5px;color:white;background-color:".($product['q'] > 1 ? 'green' : 'red')."'>".($product['q'] > 1 ? 'In stock' : 'Out of stock')."</h3>"; 
				?>
				<h3>Name: <?php echo $product['name']; ?></h3>
				<?php
					if(!empty($_SESSION["id"]) && $_SESSION["id"] == 20 && $product["id"] == 46)
						$js = ' onclick="sale_hype()" id="sale_hype"';
					else
						$js = "";
				?>
				<h3>Price: <?php echo (($product['sale'] > 0 ? "<span style=text-decoration:line-through>".$product['price']." kr</span> ".($product['price']-($product['price']*($product['sale']/100)))." kr <span style='border-radius:5px;background-color:red;padding:5px;'".$js.">".$product['sale']."%</span>" : $product['price']." kr")); ?></h3>
				<h4 style="width: 600px;height: 100px;margin-top:30px;"><?php echo utf8_encode($product['desc']);?></h4>
			</div>
		</div>
	       	<div class="panel-footer" style="overflow: hidden" onkeypress="keyHandler(event, 'product')">
			<form>
				<input type="hidden" value="<?php echo $product['id']; ?>" name="id" id="pid"/>
				<input type="hidden" value="<?php echo ($product['price']-($product['price']*($product['sale']/100))); ?>" name="price" id="price"/>
				<p style="float:left;margin-left:20%;margin-top:8px;margin-right:5px;">Quantity:</p><input type="number" value=1 name="quantity" min=1 max=<?php echo $product['q'];?> style="width: 20%;float:left;padding: 5px;margin-top:5px;border:1px solid gray;" id="q"/>
				<?php
				if(!empty($_SESSION["id"]) && $_SESSION["rank"] > 1)
					echo '<span class="glyphicon glyphicon-pencil" style="float:right;margin:12px 10px 0px 0px;transform:scale(2);cursor:pointer" onclick="openTab(`edit`,`'.$_GET["id"].';product`)"></span>';
				?>
				<a onclick="add_product_to_cart(document.getElementById('pid').value, document.getElementById('price').value, document.getElementById('q').value)" value="Add to cart" style="width: 30%;height:40px;float:right;margin-right:20%;padding:5px;color:white;background-color:green;border:none;border-radius: 5px;text-align:center;text-decoration:none;cursor:pointer" class="login100-form-btn">Add to cart</a>
			</form>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading" style="margin-bottom:10px;">Comments</div>

			<?php
			// LOop here
			require("db.php");
			$res = mysqli_query($db, "SELECT * FROM comments INNER JOIN users ON comments.user_id=users.user_id WHERE product_id='".$_GET["id"]."'");
			//	print_r($res);
			if($res->num_rows > 0){
				while($row = mysqli_fetch_assoc($res)){
					echo '<div style="background-color: lightgray;border-radius:5px;margin:10px;padding:5px">';
					echo '<div class="comment_header" style="font-size:20px;font-weight:bold;border-bottom: 1px solid black">'.$row["title"];
					for($i = 0; $i < 5-$row["rating"]; $i++)
						echo '<span class="glyphicon glyphicon-star" style="float:right;color:black;"></span>';
					for($i = 0; $i < $row["rating"]; $i++)
						echo '<span class="glyphicon glyphicon-star" style="float:right;color:#caa300;"></span>';
					echo '</div><div class="comment_content" style="font-size:14px;margin-top: 8px;">'.$row["comment"].'<span style="float:right">'.$row["name"].', '.$row["date"].'</span></div></div>';
				}
			} else {
				echo "<span style='text-align:center;padding:10px;display:block;'>It seems like this product haven't been reviewed yet, be the first to review it!</span>";
			}

			if(empty($_SESSION["id"]))
				echo '<h3 style="cursor:pointer;position:relative; bottom:-140px;float:center;text-align:center;z-index:3000;" onclick="openTab(`login`)">Sign in to comment</br>Click here</h3><div style="filter:blur(5px);margin-top:-50px">';
		?>
		<div style="border: 1px solid black; border-radius: 5px;padding:10px;overflow:auto;width:550px;margin:30px auto 10px auto">
				<span style="font-size: 14px;">Title</span>
				<input type="text" id="title" style="border:1px solid black;margin-bottom: 10px;"/>
				</br>
				<span style="font-size: 14px;padding-right:5px;">Rating</span>
				<span class="glyphicon glyphicon-star" style="color:#caa300;cursor:pointer;" id="rating-1" onclick="change_rating(1)"></span>
				<span class="glyphicon glyphicon-star" style="color:black;cursor:pointer;" id="rating-2" onclick="change_rating(2)"></span>
				<span class="glyphicon glyphicon-star" style="color:black;cursor:pointer;" id="rating-3" onclick="change_rating(3)"></span>
				<span class="glyphicon glyphicon-star" style="color:black;cursor:pointer;" id="rating-4" onclick="change_rating(4)"></span>
				<span class="glyphicon glyphicon-star" style="color:black;cursor:pointer;" id="rating-5" onclick="change_rating(5)"></span>
				<input type="hidden" id="rating" value="1"/>
				</br>
				<div style="font-size: 14px;margin-top:8px;">Comment</div>
				<textarea rows=5 cols=60 id="comment" style="border:1px solid black"></textarea>
				<a onclick="send_comment(document.getElementById('title').value, document.getElementById('rating').value, document.getElementById('comment').value, <?php echo $_GET["id"];?>)" style="width: 80%; text-align: center; display:block; padding: 5px;margin: 20px auto 5px auto;cursor:pointer;background-color: green;color:white;border-radius: 5px;border:1px solid black;">Post comment</a>
				<div class="text-center" style="visibility:hidden" id="error_msg">
                        		<span class="txt1" style="color:red">
                                		Error please fill in all forms!
		                        </span>
        		        </div>
		</div>

		<?php
			if(empty($_SESSION["id"]))
				echo '</div>';
		?>
	</div>
</div>
</div>
