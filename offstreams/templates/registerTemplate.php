<?php
	# Display any login errors
	$this->displayRegErrors($this->regError);
?>
<div class="loginRegisterContainer">
	<h2 class="center">Register</h2>
	<form action="<?php echo BASE_URI . "register"; ?>" method="post">
		<p>
			<input type="text" name="username" placeholder="Username" value="<?php echo $this->post['username']; ?>" class="inputBox" required/>
		</p>
		<p>
			<input type="text" name="emailAddress" placeholder="Email Address" value="<?php echo $this->post['emailAddress']; ?>" class="inputBox" required/>
		</p>
		<p>
			<input type="password" name="password" placeholder="Password" class="inputBox" required/>
		</p>
		<p>
			<input type="password" name="confirmPass" placeholder="Confirm Password" class="inputBox" required/>
		</p>
		<p>
			<input type="submit" name="submit" value="Register" class="submitButton"/>
		</p>
	</form>
</div>