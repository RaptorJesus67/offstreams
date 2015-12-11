<?php
	# Display any login errors
	$this->displayLoginErrors($this->loginError);
?>
<div class="loginRegisterContainer">
	<h2 class="center">Login</h2>
	<form action="<?php echo BASE_URI . "login"; ?>" method="post">
		<p>
			<input type="text" name="username" placeholder="Username" class="inputBox" required/>
		</p>
		<p>
			<input type="password" name="password" placeholder="Password" class="inputBox" required/>
		</p>
		<p>
			<input type="submit" name="submit" value="Login" class="submitButton"/>
		</p>
	</form>
</div>