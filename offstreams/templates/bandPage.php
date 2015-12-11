<!-- BAND PAGE -->
<!-- BAND NAME/TITLE -->
<h2 class="pageTitle noMargin"><?php echo $this->bandPageTitle(); ?></h2>

<!-- BAND INFO -->
<main class='bandPageWrapper'>
	
	<!-- INFO WRAPPER -->
	<section class="bandInfoWrapper">
		
		<!-- BAND IMAGE -->
		<div class="bandInfoImageWrapper">
			<img src="<?php echo $this->getBandImage(); ?>" style="<?php echo $this->imageSpecs; ?>" class='bandImage'/>
		</div>
		
		<!-- BAND INFO -->
		<div class="bandInfoContainer">
			<?php $this->displayBandInformation(); ?>
		</div>
		
		<!-- BAND BIO -->
		<div class='bandBioSection'>
			<h3 class='noMargin bandBioTitle'>Bio</h3>
			<?php echo $this->bandBio(); ?>
		</div>
	</section>
	
	<!-- GENRE/MERCH WRAPPER -->
	<section class='genreMerchWrapper'>
	
		<!-- GENRE CIRCLE -->
		<div class='genreWrapperBandPage'>
			<h2 class="pageTitle noMargin bandPageGenreTitle">Genres</h2>
			<div class='genreCircleWrapper'>
				<img src="<?php echo BASE_URI; ?>images/colorWheel.png" style="height: 200px; width: 200px; float: right" />
			</div>
			
			<!-- GENRE LISTING -->
			<div class='genreListBandPage'>
				<h1 class='topGenreH1'>Garage Rock</h1>
				<h3 class='genreH3'>Blues Rock</h3>
				<h4 class='genreH4'>Psychedelic Rock</h4>
				<h5 class='genreH5'>Blues</h5>
			</div>
		</div>
		
		<!-- MERCH AREA -->
		<div class='merchAreaBandPage'>
			
			<!-- MERCH BUTTON -->
			<div class='bandMerchButtonArea'>
				<div class="bandMerchButtonContainer">
					<h3>Support <br/><em><?php echo $this->bandPageTitle(); ?></em></h3>
					<div class='bandMerchButtonDiv'>
						<a target="_blank" href="<?php echo $this->band["band_merchLink"][0]; ?>">
							<img src="<?php echo BASE_URI; ?>images/Merch Unclicked.png" />
						</a>
					</div>
				</div>
			</div>
			
			<!-- THIRD PARTY MUSIC LINKS -->
			<div class='bandPageThirdPartyMusic'>
				<div class='bandPageUlCenter'>
					<ul class='thirdPartyUlBandPage'>
						<?php $this->listThirdPartyMusic(); ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
</main>

<!-- ALBUMS -->
<h2 class='pageTitle noMargin albumTitleBandPage'>Albums</h2>
<section class="albumSectionBandPage">
	<?php $this->listAlbums(); ?>
</section>

