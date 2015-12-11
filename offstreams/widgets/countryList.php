<?php

	$country_array = array(
	null, "United States", "Canada", "Australia", "Belgium", "Brazil", "China", "Czech Republic", 
	"Denmark", "Finland", "France", "Germany", "Greece", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Ireland", 
	"Israel", "Italy", "Jamaica", "Japan", "Mexico", "Netherlands", "New Zealand", "Norway", "South Korea", "Spain", 
	"Sweden", "Switzerland", "United Kingdom");
	
	foreach ($country_array as $country) {
		
		echo "<option value='$country'>$country</option>";
		
	}

?>