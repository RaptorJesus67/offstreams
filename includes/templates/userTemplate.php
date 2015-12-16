<div class='wrapper'>
	<!-- USERNAME -->
	<h2 class='pageTitle'><?php echo $this->user["username"][0]; ?></h2>
	
	<div class='userProfileSection' ng-controller="userProfile as profile">
	
	
		<!-- USER INFO -->
		<div class='userInfoContainer'>
			
			<!-- USER IMAGE -->
			<div class='userImageWrapper'>
				<img src='<?php echo BASE_URI . "images/users/" . $this->user["user_image"][0]; ?>' class='userProfilePicture' />
			</div>
			
			<span id='userProfileInfoTag'>
				<p>Profile Info</p>
			</span>
			
			<!-- USER INFO SECTION -->
			<div class='userProfileBasicInfo'>
				<!-- NAME -->
				<div class="userInfoRow">
					<div class='userInfoLeft'>Name</div>
					<div class='userInfoRight'>
						<span id='userfNameSpan' ng-model="profile.fName">
							{{profile.fName}}
						</span>
						<span id='userlNameSpan' ng-model="profle.lName">
							{{profile.lName}}
						</span>
					</div>
				</div>
				<!-- LOCATION -->
				<div class="userInfoRow">
					<div class='userInfoLeft'>Location</div>
					<div class='userInfoRight' id='userProfileLocation'>{{location}}<!--{{profile.city}}, {{profile.state}}, {{profile.country}}--></div>
				</div>
				<!-- ACC. TYPE -->
				<div class="userInfoRow">
					<div class='userInfoLeft'>Acc. Type</div>
					<div class='userInfoRight'>{{profile.accType}}</div>
				</div>
				<!-- BIRTHDAY -->
				<div class="userInfoRow">
					<div class='userInfoLeft'>Birthday</div>
					<div class='userInfoRight'>{{profile.birthday}}</div>
				</div>
			</div>
			
			<!-- EDIT BUTTON -->
			<a class='aWhite' ng-show="showEditButton == true" href='<?php echo BASE_URI . "user/" . $this->url[1] . "/edit"; ?>'>
				<button id='editProfileInfoWidgetButton' class='greenButtonStyle'>
					Edit Profile
				</button>
			</a>
		</div>
		
		
		
		<!-- LOAD EDIT FORM -->
		<div class='editFormUserContainer' ng-show="showEdit == true">
			
			<h3 class='center'>Edit Profile</h3>
			
			<!-- EDIT PROFILE FORM -->
			<form action="#" method="post" ng-submit="updateProfile()" class='userEditProfileForm'>
				
				<!-- FIRST NAME -->
				<div class="ng-row-2">
					<label for="fName">First Name</label>
					<input type="text" name="fName" ng-model="profile.fName" value="{{profile.fName}}" class='inputBox' id="fName" placeholder="First Name" />
				</div>
				
				<!-- LAST NAME -->
				<div class="ng-row-2">
					<label for="fName">Last Name</label>
					<input type="text" name="lName" ng-model="profile.lName" value="{{profile.lName}}" class='inputBox' id="lName" placeholder="Last Name" />
				</div>
				
				<!-- CITY -->
				<div class="ng-row-3">
					<label for="uCity">City</label>
					<input type="text" name="uCity" ng-model="profile.city" value="{{profile.city}}" class='inputBox' id="uCity" placeholder="City" />
				</div>
				
				<!-- STATE -->
				<div class="ng-row-3">
					<label for="uState">State</label>
					<select class='selectBox' ng-model="profile.state" name="uState" id='uStateSelect'>
						<?php
						foreach ($this->stateSelectList() as $state):
							echo "<option value='" . $state . "'>" . $state . "</option>";
						endforeach; 
						?>
					</select>
					<p id='uStateHidden'>--</p>
				</div>
				
				<!-- COUNTRY-->
				<div class="ng-row-3">
					<label for="uCountry">Country</label>
					<select class='selectBox' ng-model="profile.country" name="uCountry" id='uCountrySelect'>
						<?php
						foreach ($this->countrySelectList() as $country):
							echo "<option value='" . $country . "'>" . $country . "</option>";
						endforeach; 
						?>
					</select>
				</div>
				
				<!-- BIRTHDAY -->
				<div class="ng-row-2" id='uBdayRow'>
					<label>Birthday</label>
					<div class="ng-row-3">
						<input type="text" name="uBdayMonth" size="2" maxlength="2" ng-model="profile.month" id='uBdayMonth' placeholder="MM" class='inputBox' />
					</div>
					<div class="ng-row-3">
						<input type="text" name="uBdayDay" size="2" maxlength="2" ng-model="profile.day" id='uBdayDay' placeholder="DD" class='inputBox' />
					</div>
					<div class="ng-row-3">
						<input type="text" name="uBdayYear" size="4" maxlength="4" ng-model="profile.year" id='uBdayYear' placeholder="YYYY" class='inputBox' />
					</div>
				</div>
				
				<div class="ng-row-2" id="uGender">
					<label for="uGender">Gender</label>
					<select class='selectBox' ng-model="profile.gender" name="uGender" id='uGenderSelect'>
						<option value='martian'>Martian</option>
						<option value='female'>Female</option>
						<option value='male'>Male</option>
					</select>
				</div>
				
				
			</form>
			
			<a href="<?php echo BASE_URI . "user/" . $this->url[1];?>" id='backToProfileLink'>
				<button id="editBackToProfile" class='greenButtonStyle'>
					Back To Profile
				</button>
			</a>
			<p id='editProfileNote'>Profile Updates Automatically</p>
		</div>
		
		
	</div>
	
</div>
