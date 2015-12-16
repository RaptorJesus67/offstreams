<div class='wrapper'>
	<h2 class='pageTitle'>Bands</h2>
	
	<!-- BAND WRAPPER -->
	<div class='bandLinkToPage' ng-controller="bandHomePage as band">
		
		
		<!-- BAND LINK MULTIPLES -->
		<a href="<?php echo BASE_URI; ?>band/{{band.href}}" ng-repeat="band in bands">
			<div class='bandLinkContainer'>
				<div class='bandLinkShade'></div>
				<p class='bandLinkText aWhite' id="bandLinkName">{{band.name}}</p>
				<p class='bandLinkText aWhite' id="bandLinkLocation">{{band.location}}</p>
				<img src="<?php BASE_URI; ?>images/bands/{{band.image}}" class='bandLinkImg' style="{{band.size}}: 100%;"/>
			</div>
		</a>
		
		
		
	</div>
</div>
