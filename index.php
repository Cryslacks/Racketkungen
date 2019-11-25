<!DOCTYPE html>
<?php
session_start();

if(!empty($_SESSION["prev"])){
  $prev_set = $_SESSION["prev"];
  unset($_SESSION["prev"]);
}

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/?>
<html lang="sv">
<head>
  <title>Racketkungen</title>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" enctype="text/plain">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php
  require("header.php");
?>
<div class="container">    
<?php

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
	echo utf8_encode('	<div class="col-sm-4">
                        <div class="panel panel-primary">
                          <div class="panel-heading">'.$row[1].'</div>
                          <a href="product.php?id='.$row[0].'"><div class="panel-body"><img src="images/'.$row[5].'" class="img-responsive" style="width:100%" alt="Image"></div></a>
                          <div class="panel-footer">'.$row[2].'</div>
	      				        </div>
				              </div>
	                  ');
}

?>
</div>
<br><br>

<footer class="container-fluid text-center">
  <p>Racketkungen Copyright</p>  
  <a href="debug.php">DEBUG <?php echo (!empty($_SESSION["id"])) ? "LOGOUT" : "LOGIN"; ?></a>
</footer>

</body>
</html>
