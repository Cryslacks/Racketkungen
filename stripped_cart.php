<?php
	session_start();
	if(empty($_SESSION["id"])){
		echo "error_need_login";
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
				$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES ('".$_SESSION["id"]."')");
				$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."' ORDER BY cart_id DESC");
				$id = mysqli_fetch_assoc($res)["cart_id"];
			}
		}else{
			$res = mysqli_query($db, "INSERT INTO carts (user_id) VALUES (".$_SESSION["id"].")");
			$res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='". $_SESSION["id"]."'");
			$id = mysqli_fetch_assoc($res)["cart_id"];
		}
	}
?>
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
														echo 'Du har inget i din korg';
													}else{
														$_SESSION["cart_total"] = 0;
														$i = 0;
														while($row = $res->fetch_assoc()){
															if($row["active"] == 1){
																$prod_id = $row["product_id"];
																$res2 = mysqli_query($db, "SELECT * FROM products WHERE product_id='".$prod_id."'");
																if($res2->num_rows > 0){
																	$row2 = mysqli_fetch_assoc($res2);

																}

																$_SESSION["cart_total"] += $row[price]*$row[quantity];
																		echo '<tr id="product-'.$prod_id.'">
																			<td style="width:75px"> <a href="product.php?id='.$prod_id.'"> <img src="images/'.$row2["picture"].'" class="img-responsive" alt="Image" Style="scale:5%"/> </a> </td>
																			<td style="padding-top: 25px;"> <a href="product.php?id='.$prod_id.'">'.$row2["pname"]. '</a> </td>
																			<td style="padding-top: 25px;">'.($row2["pquantity"] > 1 ? 'In stock' : 'Out of stock').'</td>
																			<td style="width:30px; padding-top: 20px;"><input class="form-control" type="number" min="1" value='.$row["quantity"]. ' onchange="update_items_in_cart('.$prod_id.', '.$id.', `qchange'.$i.'`)" id="qchange'.$i.'"></td>
																			<td class="text-right" style="padding-top: 25px;" id="product-'.$prod_id.'-price">'.$row[price] * $row[quantity].' kr</td>
																			<td  class="text-right" style="padding-top: 25px;"><a onclick="rem_from_cart('.$id.','.$prod_id.')" <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button></a> </td>
																		</tr>';
															}
															$i++;
														}

														echo '<tr style="border-top: 1px solid black">
																			<td style="width:75px">  </td>
																			<td style="padding-top: 25px;"></td>
																			<td style="padding-top: 25px;"></td>
																			<td style="width:30px; padding-top: 20px;">
</td>
																			<td class="text-right" style="padding-top: 25px;width: 150px
                       " id="cart_total">Total: '.$_SESSION["cart_total"].' kr</td>
																			<td class="text-right" style="padding-top: 25px;"></td>
																		</tr>';
													}
												?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <a onclick="openTab('index')" <button class="btn btn-block btn-light">Continue Shopping</button></a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a onclick="order_items(<?php echo $id;?>)" <button class="btn btn-lg btn-block btn-success text-uppercase">Place order</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
