<form action="login_user.php" method="get"> 
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50" style="margin: auto" onkeypress="keyHandler(event, 'login')">
	<form class="login100-form validate-form">
		<span class="login100-form-title p-b-33">
			Account Login
		</span>

		<div class="wrap-input100 validate-input" data-validate = "Username is required">
			<input class="input100" type="text" name="uname" placeholder="Username" id="usr">
			<span class="focus-input100-1"></span>
			<span class="focus-input100-2"></span>
		</div>

		<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
			<input class="input100" type="password" name="pass" placeholder="Password" id="pw">
			<span class="focus-input100-1"></span>
			<span class="focus-input100-2"></span>
		</div>

		<div class="container-login100-form-btn m-t-20">
			<a class="login100-form-btn" id="smBtn" onclick="login(document.getElementById('usr').value, document.getElementById('pw').value)">
				Sign in
			</a>
		</div>

		<div class="text-center">
                	<span class="txt1">
                		Create an account?
                        </span>

                        <a onclick="openTab('create')" class="txt2 hov1">
                 		Sign up
			</a>
                </div>
		<div class="text-center" style="visibility:hidden" id="error_msg">
                	<span class="txt1" style="color:red">
                        	Wrong username password combination!
                        </span>
                </div>
	</form>
</div>
</form>
