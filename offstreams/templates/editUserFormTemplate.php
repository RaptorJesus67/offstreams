<div class='editUserFormContainer'>
	<h2 class="center noMargin">Edit Profile</h2>
	<form action="<?php echo BASE_URI . "user/" . $this->url[1] . "/update" ;?>" method="post" class="editUserForm" >
		<table class="editUserTable">
			<tr>
				<th id="userFullNameText">
					<p>Name</p>
				</th>
				<th id="userGenderText">
					<p>Gender</p>
				</th>
			</tr>
			<tr>
				<th id="userFullNameInput">
					<input type="text" name="userFullName" class="inputBox" placeholder="Name" <?php echo $this->editUserName(); ?>/>
				</th>
				<th id="userGenderInput">
					<select id="userGenderInput" class="selectBox">
						<option <?php echo $this->editUserGender(); ?>>--</option>
						<option <?php echo $this->editUserGender(); ?> value="male">Male</option>
						<option <?php echo $this->editUserGender(); ?> value="female">Female</option>
						<option <?php echo $this->editUserGender(); ?> value="martian">Martian</option>
					</select>
				</th>
			</tr>
			<tr>
				<th id="userLocationText" colspan="3">
					<p>Location</p>
				</th>
			</tr>
			<tr>
				<th id="userCityInput">
					<input type="text" name="userCity" class="inputBox" placeholder="City" <?php echo $this->editFieldValue("user_city"); ?>/>
				</th>
				<th id="userStateInput">
					<select class='selectBox' name='userState' id='userState'>
						<?php $this->loadUserPage(BASEPATH . "widgets/stateList.php"); ?>
					</select>
				</th>
				<th id="userCountryInput">
					<select class='selectBox' name='userCountry' id='userCountry'>
						<?php $this->loadUserPage(BASEPATH . "widgets/countryList.php"); ?>
					</select>
				</th>
			</tr>
			<tr>
				<th id="userSubmitInput" colspan="2">
					<input type="submit" name="userEditProfile" class="editButton" value="Update Profile" />
				</th>
			</tr>
		</table>
	</form>
</div>