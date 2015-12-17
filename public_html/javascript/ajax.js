$(document).ready(function(){
	
	var base_uri = "http://localhost/";
	
	
	// UPDATE USER EDIT PROFILE EVERYTIME AN INPUT IS CHANGED
	$(".userEditProfileForm input, .userEditProfileForm select").bind("change paste keyup", function() {
		
		var bDay = $("#uBdayMonth").val() + $("#uBdayDay").val() + $("#uBdayYear").val();
		
		var formValues = {
							"fName": 	$("#fName").val(),
							"lName": 	$("#lName").val(),
							"city":		$("#uCity").val(),
							"state":	$("#uStateSelect option:selected").text(),
							"country":	$("#uCountrySelect option:selected").text(),
							"birthday":	bDay
						};
		
		$.ajax({
		
			url: base_uri + "user",
			type: 'POST',
			data: {update: formValues},
			success: function(value){
			
				
				
			}
			
		});
		
	});
	
	
	
	
	$("#registerForm").on("submit", function(e) {
		
		e.preventDefault();
		
		var formValues = {
							"username":		$("#username").val(),
							"email":		$("#email").val(),
							"password":		$("#password").val(),
							"confirm":		$("#confirm").val()
						};
						
						
		$.ajax({
			
			url: $("#registerForm").attr("action"),
			method: 'POST',
			data: {regData: formValues},
			success: function(data) {
			
				console.log(data);
				
			}
			
		});	
		
	});
	
});

