<?php
	session_start();
	$_SESSION["test"] = 0;
?>
<body>
<script>

setInterval(updateStatus, 1000);
function updateStatus(){
	console.log("spam?");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
                if(this.responseText == ""){
                        return;
                }

                document.getElementById("a").innerText = this.responseText;

        };
        xhttp.open("GET", "query.php?uname= "+document.getElementById("i").value+"&pass=test");
        xhttp.send();
}

</script>
<input id="i" style="width:95%;margin: 10px auto"></input>
<p id="a" style="margin:10% auto;width:700px;font-size:50px;">This paragraph value</p>

</body>
