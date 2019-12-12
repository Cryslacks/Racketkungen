<?php
require("db.php");
session_start();

if(!empty($prev_set)){

  $id = intval(explode("&", explode("id=", $prev_set)[1])[0]);
  $q  = intval(explode("&", explode("quantity=", $prev_set)[1])[0]);

  $res = mysqli_query($db, "SELECT * FROM products WHERE product_id='".$id."'");
  $name = mysqli_fetch_assoc($res)["pname"];

  echo '<div class="jumbotron" style="padding: 10px;margin-bottom: 30px;background-color:#90ee90">
          <div class="container text-center">
            <h2>You have ordered '.$q.' '.$name.'</h2>      
          </div>
        </div>';
}
// sql shit get all products

$result = mysqli_query($db, "SELECT * FROM products");

//Loop through all rows
while($row = mysqli_fetch_row($result)){
	$js = "openTab('product', ".$row[0].")";
	$sale = rand(1,80);

	echo utf8_encode('	<div class="col-sm-4" onclick="'.$js.'" style="cursor:pointer">
                        		<div class="panel panel-primary">
                          				<div class="panel-heading" style="font-size:20px;font-weight:bold;">'.$row[1].'<span style="float:right">');

                                        for($i = 0; $i < 5-$row[6]; $i++)
                                                echo '<span class="glyphicon glyphicon-star" style="float:right;color:black;"></span>';
                                        for($i = 0; $i < $row[6]; $i++)
                                                echo '<span class="glyphicon glyphicon-star" style="float:right;color:#caa300;"></span>';


	echo '</span></div>';
        echo utf8_encode('	          				<a><div class="panel-body"><img src="images/'.$row[5].'" class="img-responsive" style="width:318px;height:318px;" alt="Image"></img></div></a>
        	                  				<div class="panel-footer" style="color:white;text-align: center;font-size: 22px;background-color:#337ab7;font-weight:bold;">'.$row[3].' kr</div>
	      				      	</div>
				       	</div>
	                  ');
}

?>
</div>
