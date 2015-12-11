<section class='userPageWrapper'>
	<div class="userInfoWrapper">
		<h2 class="userPageUsername"><?php echo $this->user["username"][0]; ?></h2>
		<div class="userImageContainer">
			<img src="<?php echo $this->userImage(); ?>" class="userPageImage" style="<?php echo $this->imgStyle(); ?>"/>
		</div>
		<?php $this->userEditButtons($this->access); ?>
		<div class="userInfoContainer">
		<?php echo $this->listUserInfo(); ?>
		</div>
	</div>
	<?php $this->loadActionTemplate(); ?>
</section>