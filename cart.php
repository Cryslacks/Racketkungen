<!DOCTYPE html>
<?php
session_start();

/*if(empty($_GET["user_id"]))
	header("Location: index.php")
*/
//require("db.php");

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
        <li class="active"><a href="#">Store</a></li>
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
		<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<div id="cartDiv" style="background-color:grey;padding-left= 200px" align="center" >
	
	
	Här ska vara stå med en länk till säg själv!!
	<select style="height:26px;width=50px">
	<?php
		for($x = 0;$x < 10; $x++ ) {
			echo "<option>" . $x . "</option>";
		}
	?>
	</select>
	<button class="login100-form-btn">
			Remove
	</button>
	<br><br>
<div class="container">
	<button class="login100-form-btn">
			A
	</button>
</div>
<br><br>
</div>


</div>






	

<footer class="container-fluid text-center">
  <p>Racketkungen Copyright</p>  
  <a href="debug.php">DEBUG <?php echo (!empty($_SESSION["id"])) ? "LOGOUT" : "LOGIN"; ?></a>
</footer>

</body>
</html>