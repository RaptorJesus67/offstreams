<h2 class="pageTitle center">Login</h2>
<div class='loginWrapper'>
	<form action="<?php echo BASE_URI; ?>login" class='loginForm' method="post">
		<input type="hidden" name="login" />
		<input type="text" name="username" placeholder="Username" class='inputBox' />
		<input type="password" name="password" placeholder="Password" class='inputBox' />
		<p id="loginWarnings"></p>
		<div class='loginShowPassword'>
			<input type="checkbox" id="showPasswordCheckbox" />
			<label id="showPassword">Show Password</label>
		</div>
		<input type="submit" name="login" id="loginSubmit" class='submitButton' value="Login" />
	</form>
</div>
