<?php
	session_start();
	if(empty($_SESSION["id"]))
		echo "error_need_login";
	else{
		require("db.php");
	}
?>
<div class="container mb-2">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 400px">Order</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-right">Price</th>
                            <th  style="width:150px"> </th>
                        </tr>
                    </thead>
                    <tbody>
											<?php
													if($_SESSION["rank"] > 1)
														$res = mysqli_query($db, "SELECT * FROM orders");
													else
														$res = mysqli_query($db, "SELECT * FROM orders WHERE user_id='".$_SESSION["id"]."'");

													if($res->num_rows < 1){
														echo 'You have no orders';
													}else{
														$total = 0;
														$active_orders = 0;
														$i = 0;
														while($row = $res->fetch_assoc()){
																$i++;
																$res2 = mysqli_query($db, "SELECT * FROM users WHERE user_id='".$row["user_id"]."'");
																$res3 = mysqli_query($db, "SELECT SUM(price*quantity) as total FROM items WHERE cart_id='".$row["cart_id"]."'");
																$cur_total = mysqli_fetch_assoc($res3)["total"];

																if($res2->num_rows > 0){
																	$row2 = mysqli_fetch_assoc($res2);
																}

/*
																			<td style="width:75px"> <a href="product.php?id='.$prod_id.'"> <img src="images/'.$row2["picture"].'" class="img-responsive" alt="Image" Style="scale:5%"/> </a> </td>

*/
																		echo '<tr id="order-'.$row["order_id"].'" style="border-bottom:1px solid lightgray;">
																			<td style="padding-top: 25px;">Order #'.$row["order_id"]. '</td>
																			<td style="padding-top: 25px;"><a id="order-status-'.$row["order_id"].'" style="background-color:'.($row["cancelled"] == 1 ? '#cc0000' : 'green').';color:white;padding:5px;border-radius:5px;margin:auto">'.($row["cancelled"] == 1 ? 'Cancelled' : 'In-progress').'</td>
																			<td class="text-right" style="padding-top: 25px;" id="order-'.$row["order_id"].'-price">'.($cur_total == "" ? "0" : $cur_total).' kr</td>';
																		if($row["cancelled"] == 1 && $_SESSION["rank"] > 1)
																			echo '<td  class="text-right" style="padding-top: 25px;"><a> <button class="btn btn-sm btn-danger" style="background-color:gray;border-color:gray;cursor:initial;pointer-events:none"><i class="fa fa-trash"></i> </button></a> </td>';
																		else if($_SESSION["rank"] > 1)
																			echo '<td  class="text-right" style="padding-top: 25px;"><a onclick="rem_from_order('.$row["order_id"].', '.$cur_total.')"> <button class="btn btn-sm btn-danger" id="order-btn-'.$row["order_id"].'"><i class="fa fa-trash"></i> </button></a> </td>';
																		else
																			echo '<td></td>';
																		echo '</tr>';
																if($row["cancelled"] == 0){
																	$total += $cur_total;
																	$active_orders++;
																}

														}

														echo '<tr style="border-top: 1px solid black">
																			<td style="padding-top: 25px;font-weight:bold">Total orders: '.$res->num_rows.'</td>
																			<td style="width:30px; padding-top: 25px;font-weight:bold">Active orders: '.$active_orders.'
</td>
																			<td class="text-right" style="padding-top: 25px;width: 150px;font-weight:bold;
                       " id="order_total">Total: '.$total.' kr</td>
																			<td class="text-right" style="padding-top: 25px;"></td>
																		</tr>';
													}
												?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
echo ($i > 10 ? "status_more_than_ten" : "");
?>
