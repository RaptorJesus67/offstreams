<h2><?php echo $this->albumTitle(); ?></h2>
<div class='albumInfoContainer'>
	<div class='albumImageContainer'>
		<img src='<?php echo $this->albumImageSrc(); ?>' style="<?php echo $this->albumImageStyle(); ?>"/>
	</div>
	<div class="albumInfoWrapper">
		<?php echo $this->albumInfo(); ?>
	</div>
	<div class="merchButtonContainer">
		<?php $this->albumMerchButtons(); ?>
	</div>
</div>