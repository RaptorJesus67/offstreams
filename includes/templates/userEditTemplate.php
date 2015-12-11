<div class='wrapper'>
	<!-- USERNAME -->
	<h2 class='pageTitle'><?php echo $this->user["username"][0]; ?></h2>
	
	<div class='userProfileSection' ng-controller="userProfile as profile">
		
		
		<!-- USER INFO -->
		<?php echo $this->userInfoPanel(); ?>
			
			<?php if (isset($_SESSION['username']) && $this->user["username"][0] == $_SESSION['username']) : ?>
				<!-- EDIT BUTTON -->
				<?php echo $this->createButton("Edit Profile", "Standard", BASE_URI . "user/" . $this->url[1] . "/edit"); ?>
			<?php endif; ?>
			{{profile.fName}}
				
		<?php echo $this->endUserInfoPanel(); ?>
		
		
		<!-- LOAD FORM -->
		<div class='editFormUserContainer'>
			<?php echo $this->editFormUser(); ?>
			
			<?php echo $this->createForm; ?>
			
			<h3 class='center'>Edit Profile</h3>
			
			<div class="ng-row-2">
				<?php echo $this->inputFName; ?>
			</div>
			<div class="ng-row-2">
				<?php echo $this->inputLName; ?>
			</div>
			<div class="ng-row-3">
				<?php echo $this->inputCity; ?>
			</div>
			<div class="ng-row-3">
				<?php echo $this->inputState; ?>
			</div>
			<div class="ng-row-3">
				<?php echo $this->inputCountry; ?>
			</div>
			
			<?php echo $this->endForm; ?>
		</div>
		
		
	</div>
	
</div>
