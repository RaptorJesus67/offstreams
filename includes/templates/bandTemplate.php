<div class='wrapper'>
	
	<div id='bandPageContainer' ng-controller="bandPage as band">
	
		<h2 class='pageTitle'><?php echo $this->band_name; ?></h2>
		
		<!-- TOP HALF OF BAND INFO -->
		<div class='bandPageInfoTop'>
			<!-- BAND IMAGE -->
			<div class='bandPageImgWrapper'>
				<img src="<?php echo BASE_URI . "images/bands/" . $this->band["band_image"][0]; ?>" class='bandPageImage'/>
			</div>
			
			<!-- GENRE WRAPPER -->
			<div class='bandPageGenreWrapper'>
				
				
				
			</div>
		</div>
		
		
		<!-- BOTTOM HALF OF BAND INFO -->
		<div class='bandPageInfoBottom' ng-repeat="band in bands">
			
			<!-- BAND INFO -->
			<div class='bandInfoLeft'>
				
				<!-- INFO TABLE -->
				<div class='bandInfoLeftTable'>
					
					<div class='bandInfoHeader'>
						Band Info
					</div>
					
					<div class='bandInfoLeftTblRow' id='bandRowLocation'>
						<div id='bandLocationTag'>
							Hometown:
						</div>
						<div id="bandLocationValue">
							{{location()}}
						</div>
					</div>
					
					<div class='bandInfoLeftTblRow' id='bandRowLocation'>
						<div id='bandFormationTag'>
							Formed:
						</div>
						<div id="bandFormationValue">
							{{bandDate() | date : 'MMM d, y'}}
						</div>
					</div>
					
					<div class='bandInfoLeftTblRow' id='bandRowLocation'>
						<div id='bandWebsiteTag'>
							Website:
						</div>
						<div id="bandWebsiteValue">
							<a href='{{band.website}}' target="_blank">
								{{band.website}}
							</a>
						</div>
					</div>
					
					<div class='bandInfoLeftTblRow' id='bandRowLocation'>
						<div id='bandEmailTag'>
							Email:
						</div>
						<div id="bandEmailValue">
							{{band.email}}
						</div>
					</div>
					
				</div>
				
			</div>
			
			<!-- BAND DONATION/PURCHASE -->
			<div class='bandInfoRight'>
				<div class='bandInfoRightTop'>
					<div class='bandInfoDonate'>
						<h3>Donate</h3>
						<h4 style="text-align: center;">N/A</h4>
					</div>
					<div class='bandInfoMerch'>
						<h3>Merchandise</h3>
						<img src='<?php echo BASE_URI;?>images/Merch Unclicked.png' class='merchButtonUnclicked' />
					</div>
				</div>
				<div class='bandInfoRightBottom'>
					<div class='bandInfoPurchMusic'>
						<h3>Purchase Music</h3>
						<div class='purchaseImageWrapper' ng-repeat="img in images">
							<img src="<?php echo BASE_URI; ?>images/{{img.src}}" class='purchaseMusicImage' />
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		
		<!-- BAND PAGE DIVIDER CONTAINER -->
		<input type="hidden" class='bandIdHidden' value="<?php echo $this->band['band_id'][0]; ?>" />
		<div class='bandPageDividerContainer'>
			<img src='<?php echo BASE_URI . "images/Band Drop Info Button.png"; ?>' class='bandPageDropDown' title="More Info/Donate" />
			<div class='bandPageInfoDivider'></div>
		</div>
		
		<div class='bandPageToolbar'>
			<ul class='tabs'>
				<li class='tab active'>
					<div class='tab-box' ng-click="loadBandWidget('Albums', <?php echo $this->band["band_id"][0]; ?>)"></div>
				</li>
				<li class='tab'>
					<div class='tab-box' ng-click="loadBandWidget('Singles', <?php echo $this->band["band_id"][0]; ?>)"></div>
				</li>
				<li class='tab'>
					<div class='tab-box' ng-click="loadBandWidget('Videos', <?php echo $this->band["band_id"][0]; ?>)"></div>
				</li>
			</ul>
			<ul class='tabs tabWordsParent'>
				<li class='tabWords'>
					<span>Albums</span>
				</li>
				<li class='tabWords'>
					<span>Singles</span>
				</li>
				<li class='tabWords'>
					<span>Videos</span>
				</li>
			</ul>
		</div>
		<div class="bandPageContent">
			
			<!-- ALBUM -->
			<div class='bandPageAlbumWidget' ng-show="widget == 'Albums'">
				<div class='albumWidgetIteration' ng-repeat="album in albums">
					<div class='albumWidgetContainer'>
						<div class='albumWidgetHeader'>
							<h2>{{album.year}} &nbsp; - &nbsp; {{album.name}} ({{albumType(album.type)}})</h2>
						</div>
						<div class='albumWidgetBody'>
							<div class='albumWidgetImageContainer'>
								<img src='{{albumImage(album.image)}}' class='albumWidgetImage' />
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- SINGLES -->
			<div class='bandPageSinglesWidget' ng-show="widget == 'Singles'">
				Super Jesus
			</div>
			
			<!-- VIDEOS -->
			<div class='bandPageVideosWidget' ng-show="widget == 'Videos'">
				<div class='videoWidgetIteration' ng-repeat="video in band">
					<div class='videoWidgetContainer'>
						<img src="<?php echo BASE_URI . "images/YouTube Video Icon.png"; ?>" class='videoYoutubeIcon' />
						<img src="<?php echo BASE_URI . "images/thumbnails/"; ?>{{video.thumbnail}}" class='videoImageBG' id="{{video.linkID}}" />
					</div>
					<p><strong>Song Name:</strong> {{video.name}}</strong></p>
					<p><strong>Album:</strong> {{video.album}}</strong></p>
					<p><strong>Year:</strong> {{video.year}}</strong></p>
				</div>
			</div>
			
			
		</div>
	
	</div>
	
	
	<!-- YOUTUBE VIDEO POPUP -->
	<div class='youtubePopup'>
		
	</div>
	
</div>
