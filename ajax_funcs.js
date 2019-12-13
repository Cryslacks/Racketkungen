	/*		MANAGE FUNCTIONS		*/
	function delete_product(id){
		console.log("[delete_product] id="+id);

		if(!confirm("Vill du verkligen ta bort denna produkt?"))
			return;

		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			console.log(this.responseText);

			if(this.responseText == "success")
				openTab("manage", "");
		};
	        xhttp.open("GET", "ajax_delete_product.php?id="+id);
	        xhttp.send();
	}

	function update_product(file, redir){
		console.log("[upload_file] Uploading form file="+file+" redir="+redir);
		var anti_spam = 0;
		var form = document.getElementById("main_form");
		var formData = new FormData(form);
		var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			switch(this.responseText.split(";")[0]){
				case "success":
					if(redir != undefined)
						openTab(redir, this.responseText.split(";")[1]);
					else
						openTab("manage", this.responseText.split(";")[1]);
					break;
				case "error_fill_all_forms":
					document.getElementById("error_msg").innerText = "Please fill out all inputs";
					document.getElementById("error_box").style.visibility = "visible";
					break;
				case "error_name_in_use":
					document.getElementById("error_msg").innerText = "Product with that name already exists";
					document.getElementById("error_box").style.visibility = "visible";
					break;

			}
		};
		xhttp.open("POST", "ajax_"+file+"_product.php", true);
		xhttp.send(formData);
	}

	/*		EOF MANAGE FUNCTIONS		*/

	/*		COMMENT FUNCTIONS		*/
	function change_rating(rating){
		console.log("[change_rating] rating="+rating);
		var rat = document.getElementById("rating");

		if(rat.value == rating)
			return;

		if(rat.value > rating){
			for(var i = parseInt(rat.value); i > rating; i--)
				document.getElementById("rating-"+i).style.color = "black";

			rat.value = rating;
		}else{
			for(var i = parseInt(rat.value)+1; i < rating+1; i++)
				document.getElementById("rating-"+i).style.color = "#caa300";

			rat.value = rating;
		}
	}

	function send_comment(title, rating, comment, pid){
		console.log("[send_comment] title="+title+" rating="+rating+" comment="+comment+" product_id="+pid);
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			switch(this.responseText){
				case "success":
					openTab("product", pid);
					break;
				case "error_not_loggedin":
					openTab("login", "");
					break;
				case "error_fill_all_forms":
					document.getElementById("error_msg").style.visibility = "visible";
					break;

			}
		};
	        xhttp.open("GET", "ajax_add_comment.php?title="+title+"&rating="+rating+"&comment="+comment+"&pid="+pid);
	        xhttp.send();
	}

	/*		EOF COMMENT FUNCTIONS		*/

	/*		ORDER FUNCTIONS			*/
	function order_items(id){
		console.log("[order_items] cart_id = "+id);
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			switch(this.responseText){
				case "error_unknown":
					document.getElementById("jumbotron").style.display = "";
					document.getElementById("jumbotron").style.backgroundColor = "red";
					document.getElementById("jumbo_txt").innerText = "Something went horribly wrong";
					break;

				case "error_insufficient":
					document.getElementById("jumbotron").style.display = "";
					document.getElementById("jumbotron").style.backgroundColor = "red";
					document.getElementById("jumbo_txt").innerText = "Sorry you have insufficient balance";
					break;

				case "success":
					updateHeader();
					openTab("index", "");
					document.getElementById("jumbotron").style.display = "";
					document.getElementById("jumbotron").style.backgroundColor = "#90ee90";
					document.getElementById("jumbo_txt").innerText = "Your order has been placed";
					break;

			        case "error_empty_cart":
					document.getElementById("jumbotron").style.display = "";
					document.getElementById("jumbotron").style.backgroundColor = "red";
					document.getElementById("jumbo_txt").innerText = "Your cart is empty";
					break;
			}
	        };
	        xhttp.open("GET", "trans.php?cart_id="+id);
	        xhttp.send();

	}
	/*		EOF ORDER FUNCTIONS		*/

	/*		CART FUNCTIONS			*/

	function add_product_to_cart(id, p, q){
		console.log("[add_product_to_cart] product_id="+id+" price="+p+" quantity="+q);
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			console.log(this.responseText);


			if(this.responseText == "error_not_loggedin")
				openTab("login", "");
			else if(this.responseText.split(";").length > 1){
				document.getElementById("jumbotron").style.display = "";
				document.getElementById("jumbotron").style.backgroundColor = "#90ee90";
				document.getElementById("jumbo_txt").innerText = "You have ordered "+this.responseText.split(";")[1];

				updateHeader();
				openTab("index", "");
			}
	        };
	        xhttp.open("GET", "ajax_add_cart.php?id="+id+"&quantity="+q+"&price="+p);
	        xhttp.send();

	}

	function update_items_in_cart(pid, cid, q){
		console.log("[update_items_in_cart] product_id="+pid+" cart_id="+cid+" quantity="+document.getElementById(q).value);
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			switch(this.responseText.split(";")[0]){
				case "error_not_loggedin":
					openTab("login", "");
					break;

				case "error_fill_all_forms":
					document.getElementById("jumbotron").style.display = "";
					document.getElementById("jumbotron").style.backgroundColor = "red";
					document.getElementById("jumbo_txt").innerText = "Something went horribly wrong";
					break;

				case "success":
					document.getElementById(q).value = this.responseText.split(";")[1];
					document.getElementById("product-"+pid+"-price").innerText = this.responseText.split(";")[2]+" kr";
					document.getElementById("cart_total").innerText = "Total: "+this.responseText.split(";")[3]+" kr";
					break;
			}
	        };
	        xhttp.open("GET", "ajax_update_cart.php?cid="+cid+"&pid="+pid+"&q="+document.getElementById(q).value);
	        xhttp.send();
	}

	function rem_from_cart(cid, pid){
		console.log("[rem_from_cart] cart_id="+cid+" product_id="+pid);
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			document.getElementById("cart_total").innerText = "Total: "+this.responseText.split(";")[1]+" kr";
			if(document.getElementById("product-"+pid) != undefined)
				document.getElementById("product-"+pid).parentNode.removeChild(document.getElementById("product-"+pid));
			updateHeader();
		};
	        xhttp.open("GET", "rem_from_cart.php?cart_id="+cid+"&p_id="+pid);
	        xhttp.send();

	}

	function rem_from_order(oid, total){
		console.log("[rem_from_orders] order_id="+oid+" total="+total);
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			console.log(this.responseText);
			document.getElementById("order_total").innerText = "Total: "+this.responseText.split(";")[1]+" kr";
			document.getElementById("order-status-"+oid).innerText = "Cancelled";
			document.getElementById("order-status-"+oid).style.backgroundColor = "#cc0000";

			var x = document.getElementById("order-btn-"+oid).style;
			x.backgroundColor = "gray";
			x.borderColor = "gray";
			x.cursor = "initial";
			x.pointerEvents = "none";
			updateHeader();
		};
	        xhttp.open("GET", "rem_from_order.php?order_id="+oid+"&total="+total);
	        xhttp.send();

	}

	/*		EOF CART FUNCTIONS		*/

	/*		LOGIN FUNCTIONS			*/

	function logout(){
		console.log("[logout] Logged out");
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = () => {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam){
				updateHeader();
				return
			}else
				anti_spam = 1;

			openTab("index", "");
		};
	        xhttp.open("GET", "ajax_logout.php");
	        xhttp.send();
	}

	function create_login(name, usr, pw){
		console.log("[create_login] name="+name+" username="+usr+" password="+pw);

		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			console.log("[create_login] status="+this.responseText);

			switch(this.responseText){
				case "success":
					updateHeader();
					openTab("index", "");
					break;
				case "error_username_in_use":
					document.getElementById("error_msg").innerText = "Username already in use";
					document.getElementById("error_box").style.visibility = "visible";
					break;
				case "error_fill_all_forms":
					document.getElementById("error_msg").innerText = "Please fill out all inputs";
					document.getElementById("error_box").style.visibility = "visible";
					break;

			}
		};
	        xhttp.open("GET", "ajax_add_account.php?name="+name+"&uname="+usr+"&pass="+pw);
	        xhttp.send();
	}

	function login(usr, pw){
		console.log("[login] username="+usr+" password="+pw);

		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			response = this.responseText;
			if(response.split(";").length > 1){
				if(response.split(";")[1].split(".php").length > 1){
		        		var xhttp = new XMLHttpRequest();
		        		xhttp.onreadystatechange = function() {
	        	        		if(this.responseText == ""){
			                        	return;
		        	        	}

						console.log(this.responseText);

						document.getElementById("jumbotron").style.display = "";
						document.getElementById("jumbotron").style.backgroundColor = "#90ee90";
						document.getElementById("jumbo_txt").innerText = "You have ordered "+this.responseText.split(";")[1];
						updateHeader();
						openTab("index", "");
					};
		        		xhttp.open("GET", response.split(";")[1]);
				        xhttp.send();
				}else{
					site = response.split(";")[1];
					args = "";
					if(response.split(";")[1].split("&").length > 1){
						site = response.split(";")[1].split("&id=")[0];
						args = response.split(";")[1].split("&id=")[1];
					}

					openTab(site, args);
				}
			}else{
				if(response == "error_wrong_details"){
					console.log(document.getElementById("error_msg"));
					document.getElementById("error_msg").style.visibility = "visible";
				}else{
					updateHeader();
					openTab("index", "");
				}
			}

	        };
	        xhttp.open("GET", "ajax_login.php?uname="+usr+"&pass="+pw);
	        xhttp.send();
	}

	/*		EOF LOGIN FUNCTIONS		*/

	/*		GENERAL AJAX FUNCTIONS		*/
	function updateHeader(){
		console.log("[updateHeader] Updated header");
		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			document.getElementById("header_main").innerHTML = this.responseText;
	        };
	        xhttp.open("GET", "header.php");
	        xhttp.send();

	}

	function f_openTab(site, args, pushState){
		console.log("[f_openTab] site="+site+" args="+args);

		var pos = "absolute";

		switch(site){
			case "product":
				pos = "relative";
				ajax_site = "stripped_product.php?id="+args;
				if(args == "")
					openTab("index", "");
				break;
			case "index":
				pos = "relative";
				ajax_site = "stripped_index.php";
				if(args != undefined)
					ajax_site = "stripped_index.php?search="+args;
				break;
			case "cart":
				ajax_site = "stripped_cart.php";
				break;
			case "manage":
				pos = "relative";
				ajax_site = "stripped_manage.php";
				if(args != undefined)
					ajax_site += "?id="+args;
				break;
			case "edit":
				pos = "relative";
				if(typeof args === "string")
					ajax_site = "stripped_edit_product.php?id="+args.split(";")[0]+"&redir="+args.split(";")[1];
				else
					ajax_site = "stripped_edit_product.php?id="+args;

				break;
			case "add":
				pos = "relative";
				ajax_site = "stripped_add_product.php";
				break;
			case "login":
				updateHeader();
				ajax_site = "stripped_login.php";
				break;
			case "create":
				ajax_site = "stripped_create_account.php";
				break;
			case "orders":
				ajax_site = "stripped_orders.php";
				break;

		}

		if(document.getElementById("jumbotron").style.display == "" && site != "index")
			document.getElementById("jumbotron").style.display = "none";
		if(document.getElementById("jumbotron").style.backgroundColor == "red" && site != "cart")
			document.getElementById("jumbotron").style.display = "none";

		var anti_spam = 0;
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	                if(this.responseText == ""){
	                        return;
	                }

			if(anti_spam)
				return
			else
				anti_spam = 1;

			var response = this.responseText;

			if(response.endsWith("status_less_than_four")){
				response = response.substring(0, response.length - 21);
				pos = "absolute";
			}

			if(response.endsWith("status_more_than_ten")){
				response = response.substring(0, response.length - 20);
				pos = "relative";
			}

			if(response.startsWith("error_need_login"))
				openTab("login", "");
			else if(response.startsWith("error_no_permission"))
				openTab("index", "");
			else
		                document.getElementById("main_page").innerHTML = response;

			if(site == "index")
				document.getElementById("search_bar").style.display = "block";
			else if (document.getElementById("search_bar").style.display != "none")
				document.getElementById("search_bar").style.display = "none";

			if((site == "index" && (args == "" || args == undefined)) || (args == "" || args == undefined))
				document.getElementById("search_input").value = "";

			document.getElementById("footer_main").style.position = pos;
	        };
	        xhttp.open("GET", ajax_site);
	        xhttp.send();

		if(pushState){
			if(site == "product" || (site == "manage" && args != undefined) || (site == "edit" && typeof args === "number"))
				history.pushState({"site":current_page[0], "args":current_page[1]}, null, "?site="+site+"&id="+args);
			else if(site == "edit" && typeof args === "string")
				history.pushState({"site":current_page[0], "args":current_page[1]}, null, "?site="+site+"&id="+args.split(";")[0]+((args.split(";").length > 1) ? "&redir="+args.split(";")[1] : ""));
			else if(site == "index" && (args != "" && args != undefined))
				history.pushState({"site":current_page[0], "args":current_page[1]}, null, "?site="+site+"&search="+args);
			else
				history.pushState({"site":current_page[0], "args":""}, null, "?site="+site);
			current_page = [site, args];
		}
//		console.log(history);
	}

	function openTab(site, args){
		f_openTab(site, args, 1);
	}

	function search_products(a){
		if(document.getElementById("welcome_txt") == null || !document.getElementById("welcome_txt").innerText.startsWith(" Welcome .!")){
			openTab("index", a.value);
			return;
		}

		switch(a.value){
			case "old":
				document.body.style.filter = "grayscale(1.0)";
				var audio = new Audio("meme/dreamscape.mp3")
				audio.loop = 1;
				audio.volume = 0.1;
				audio.play();
				openTab("index", "");
				break;
			case "flip":
				flip();
				break;

			case "barrelroll":
				setInterval(spazm, 100);
				openTab("index", "");
				break;

			case "rainbow":
				setInterval(rainbow, 100);
				var audio = new Audio("meme/rainbow.mp3")
				audio.loop = 1;
				audio.volume = 0.1;
				audio.play();
				openTab("index", "");
				break;

			default:
				openTab("index", a.value);
				break;
		}

	}

	$(window).on('navigate', function(e, d) {
		console.log([e,d]);
		f_openTab(e.state["site"], e.state["args"], 0);
	});

	let keyHandler = (event, form) => {
		if(event.keyCode == 13){
			switch(form){
				case "product":
					event.preventDefault();
					add_product_to_cart(document.getElementById("pid").value, document.getElementById("price").value, document.getElementById("q").value);
					break;
				case "login":
					login(document.getElementById("usr").value, document.getElementById("pw").value);
					break;
				case "create":
					create_login(document.getElementById("name").value, document.getElementById("usr").value, document.getElementById("pw").value);
					break;
				case "edit":
					update_product("edit");
					break;
				case "r_edit":
					update_product("edit","product");
					break;
				case "add":
					update_product("add");
					break;
			}
		}
	}

	function close_notification(e){
		e.style.display = "none";
	}

	/*		EOF GENERAL AJAX FUNCTIONS	*/

	/*		FUNNY FUNCTIONS 		*/

	function sale_hype(){
		var audio = new Audio("meme/speed.mp3")
		audio.loop = 1;
		audio.volume = 0.1;
		audio.play();
		
		var dist = document.getElementById("sale_hype").getBoundingClientRect().top;
		var move_len = dist/57;
		document.getElementById("sale_hype").style.position = "fixed";
		document.getElementById("sale_hype").style.top = dist+"px";

		var a = setInterval(function(){ setInterval(rainbow, 210);setInterval(flash, 210);setInterval(sale_spin, 30);clearInterval(a);}, 5700);
		var b = setInterval(function(){
			console.log(document.getElementById("sale_hype").style.top);
			document.getElementById("sale_hype").style.top = (parseInt(document.getElementById("sale_hype").style.top.split("px")[0])-move_len)+"px";

			if((document.getElementById("sale_hype").style.top.split("px")[0]) < -30){
				document.getElementById("sale_hype").style.display = "none";
				clearInterval(b);
			}
		}, 100);
	}

	function sale_spin(){
		var e = document.getElementById("product_status");
		if(e == null)
			return;
		if(e.style != undefined && e.style.transform != ""){
               		e.style.transform = "rotate("+(parseInt(e.style.transform.split("rotate(")[1].split("deg)")[0])+35)+"deg)";
                }else if(e.style != undefined)
                	e.style.transform = "rotate(0deg)";
	}

	function flash(){
		var arr = document.getElementsByTagName("div");

		for(e in arr) {
			if(arr[e].style != undefined && arr[e].style.transform != ""){
				if(arr[e].style.transform == "scale(1.005)")
					arr[e].style.transform = "scale(1.0)";
				else
					arr[e].style.transform = "scale(1.005)";
			}else if(arr[e].style != undefined)
				arr[e].style.transform = "scale(1.005)";
		}
	}

	function rainbow(){
		var arr = document.getElementsByTagName("*");

		for(e in arr) {
			if(arr[e].style != undefined)
				arr[e].style.backgroundColor = generate_random_color();
		}
	}

	function flip(){
		var arr = document.getElementsByTagName("*");

		for(e in arr) {
			if(arr[e].style != undefined)
				arr[e].style.transform = "rotate(180deg)";
		}

	}

	function spazm(){
		var arr = document.getElementsByTagName("div");

		for(e in arr) {
			if(arr[e].style != undefined && arr[e].style.transform != ""){
				arr[e].style.transform = "rotate("+(parseInt(arr[e].style.transform.split("rotate(")[1].split("deg)")[0])+5)+"deg)";
			}else if(arr[e].style != undefined)
				arr[e].style.transform = "rotate(5deg)";
		}

	}

	function generate_random_color() {
		var letters = '0123456789ABCDEF';
		var color = '#';
		for (var i = 0; i < 6; i++)
			color += letters[Math.floor(Math.random() * 16)];

		return color;
	}

	/*		EOF FUNNY FUNCTIONS		*/
