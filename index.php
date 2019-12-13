<!DOCTYPE html>
<html lang="sv">
<head>
  <title>Racketkungen</title>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" enctype="text/plain">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<script type="text/javascript" src="ajax_funcs.js"></script>
<script>
window.onload = () => {
        console.log("[main] Site ajax started");
        current_page = ["<?php echo $_GET["site"]?>", "<?php echo $_GET["id"];echo $_GET["search"];?>"];
	<?php echo (!empty($_GET["search"]) ? "document.getElementById('search_input').value = '".$_GET["search"]."';\n" : "\n");?>
        if(current_page[0] == "")
                current_page = ["index", ""];

        openTab(current_page[0], current_page[1]);
}
</script>
</head>
<body>
<div id="header_main">
<?php
  include("header.php");
?>
</div>
<style>
#search_bar {
        margin:20px auto;
        width: 400px;
        height:40px;
        overflow:hidden;
        border:1px solid #dddddd;
        border-radius: 10px;
        background-color: #eeeeee;
        padding: 5px;
}

#search_txt {
        width: 100px;
        font-size: 25px;
        margin-top:0px;
        text-align: center;
        float:left;
}

#search_input {
        z-index: -1;
        width: 280px;
        font-size: 20px;
        height: 100%;
        background-color: #eeeeee;
}
</style>
<div id="search_bar" style="display:none">
        <h4 id="search_txt">Search</h4>
        <input id="search_input" type="text" onkeyup="search_products(this)">
</div>

<div class="jumbotron" id="jumbotron" style="padding: 10px;margin-bottom: 30px;background-color:#90ee90;display:none;cursor:pointer;width:60%;border-radius:10px;margin: 30px auto" tooltip="Click to close notification" onclick="close_notification(this)">
	<div class="container text-center">
		<h2 id="jumbo_txt"></h2>
	</div>
</div>
<div class="container" id="main_page">
</div>
<br><br>

<footer class="container-fluid text-center" id="footer_main" style="position:relative;bottom:0px;width:100%">
  <p>Racketkungen Copyright</p>
</footer>

</body>
</html>
