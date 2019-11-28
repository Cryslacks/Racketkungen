<?php
	session_start();
	echo $_SESSION["id"];
	if(empty($_SESSION["id"])){
			header("Location: login.php");
	}else{
		require("db.php");
		$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='".$_SESSION["id"]."'");
		if($res->num_rows > 0){
			//echo "Cart exists";
			$cart_found = 0;
			while($row = mysqli_fetch_assoc($res)){
				$res2 = mysqli_query($db, "SELECT * FROM orders WHERE cart_id='".$row["cart_id"]."'");

				if($res2->num_rows < 1){
					$id = $row["cart_id"];
					$cart_found = 1;
					break;
				}
			}
			if($cart_found == 0){
				$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES (".$_SESSION["id"].")");
				$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."'");
				$id = mysqli_fetch_assoc($res)["cart_id"];
			}
		}else{
			$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES (".$_SESSION["id"].")");
			$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."'");
			$id = mysqli_fetch_assoc($res)["cart_id"];
	}
	}
?>


<html lang="sv">
<head>
  <title>cart</title>
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
  </style>
</head>
<body>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<?php
	require("header.php");

 ?>
<!--<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">E-COMMERCE CART</h1>
     </div>
</section>-->

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
											<?php
													$res = mysqli_query($db, "SELECT * FROM items WHERE cart_id='".$id."'");
													if($res->num_rows < 1){
														echo 'tom lista';
													}else{
														echo 'finns något i listan';
													}
													while($row = $res->fetch_assoc()){
														if($row["active"] == 1){
															$prod_id = $row["product_id"];
															$res2 = mysqli_query($db, "SELECT * FROM products WHERE product_id='".$prod_id."'");
															if($res2->num_rows > 0){
																$row2 = mysqli_fetch_assoc($res2);

															}


																	echo '<tr>
																		<td style="width:75px">  <img src="images/'.$row2["picture"].'" class="img-responsive" alt="Image" Style="scale:5%"/></td>
																		<td style="padding-top: 25px;">'.$row2["pname"]. '</td>
																		<td style="padding-top: 25px;">'.($row2["pquantity"] > 1 ? 'In stock' : 'Out of stock').'</td>
																		<td style="width:30px; padding-top: 20px;"><input class="form-control" type="number" value='.$row["quantity"]. '></td>
																		<td class="text-right" style="padding-top: 25px;">'.$row[price] * $row[quantity].' kr</td>
																		<td  class="text-right" style="padding-top: 25px;"><a href="remFromCart.php?cart_id='.$id.'&p_id='.$prod_id.'" <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button></a> </td>
																	</tr>';
														}
													}
												?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">Continue Shopping</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
