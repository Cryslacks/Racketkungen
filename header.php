<?php
session_start();
?>

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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" onclick="openTab('index')" style="cursor:pointer">Racketkungen</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a onclick="openTab('index')" style="cursor:pointer">Store</a></li>
	<?php
		if(!empty($_SESSION["name"]))
			echo '<li><h4 style="color:white;font-size:15px;margin-left:10px;margin-top: 17px;cursor:default"><span class="glyphicon"></span> Welcome '.$_SESSION["name"].'</h4></li>';
	?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	    <?php
		if(!empty($_SESSION["rank"]) && $_SESSION["rank"] == 2)
			echo '<li><a onclick="openTab(`manage`)" style="cursor:pointer"><span class="glyphicon glyphicon-cog"></span> Manage Products </a></li>';

		if(!empty($_SESSION["id"]))
			echo '<li><a onclick="logout()" style="cursor:pointer"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
		else
			echo '<li><a onclick="openTab(`login`)" style="cursor:pointer"><span class="glyphicon glyphicon-user"></span> Login </a></li>';
		?>
        <li><a onclick="openTab(`cart`)" style="cursor:pointer"><span class="glyphicon glyphicon-shopping-cart"></span> Cart 
        <?php

        require("db.php");
        if(!empty($_SESSION["id"])){
            $res = mysqli_query($db, "SELECT * FROM carts WHERE user_id='".$_SESSION["id"]."'");
            if($res->num_rows > 0){
                $cart_found = 0;
                while($row = mysqli_fetch_assoc($res)){
                    $res2 = mysqli_query($db, "SELECT * FROM orders WHERE cart_id='".$row["cart_id"]."'");

                    if($res2->num_rows < 1){
                        $id = $row["cart_id"];
                        $cart_found = 1;
                        break;
                    }
                }

                if($cart_found == 1){
                    $q = mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM items WHERE cart_id='".$id."' AND active='1'"))[0];
                    if($q > 0)
                      echo '<p style="color:white;background-color:red;width:20px;display:inline;padding:4px;padding-right:5px;margin-left:3px;border-radius:5px;text-align:center;">'.$q.'</p>';
                }
            }        
        }
        
        ?>
        </a></li>
      </ul>
    </div>
  </div>
</nav>
