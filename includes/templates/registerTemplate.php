<script src='https://www.google.com/recaptcha/api.js'></script>
<div class='wrapper'>
	
	<div class='registerWrap'>
		
		<h3>Register</h3>
		
		
			
			<form id='registerForm' method='post' action='<?php echo BASE_URI; ?>register' >
				
				<div class='regContainer'>
				
					<input type="text" id='username' name='username' class='inputBox' placeholder='Username' />
					<input type="email" id='email' name="email" class='inputBox' placeholder='Email' />
					<input type="password" id='password' name='password' class='inputBox' placeholder='Password' />
					<input type="password" id='confirm' name='confirm' class='inputBox' placeholder='Confirm Password' />
					
					<div class='captchaWrapper'>
						<div class="g-recaptcha" data-sitekey="6Lc4SBMTAAAAALM8OwwrEra4i8hwkFTmTo9xPA23">
						</div>
					</div>
					
				</div>
				
				<div class='registerMessages'>
					
					<div id='usernameMessage'>
						<p></p>
					</div>
					
				</div>
				
				<input id='regUser' type="submit" name='registerUser' value="Register" class='submitButton' />
				
			</form>
		</div>
		
	</div>
	
</div>
