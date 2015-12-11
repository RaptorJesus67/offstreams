<?php require_once("config/config.php"); ?>
<?php $venue = $url->trimURL(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Offstreams - Discover Your Next Favorite Band</title>
		<?php require_once("css/styles.html"); ?>
		<?php require_once("javascript/javascript.html"); ?>
	</head>
	<body>
	<!-- HEADER -->
		<header>
			<table>
				<tr>
					<th width="33%">
						<a href="<?php echo BASE_URI; ?>">
							<img src="<?php echo BASE_URI; ?>images/Offstreams Logo New.jpg" style="height: 75px;" />
						</a>
					</th>
					<th width="34%" id="centerHeaderElement">
						<form action="<?php echo BASE_URI; ?>search/" method="post" class='searchbarForm'>
							<input type="text" name="siteSearch" class="search" id="searchbar" autocomplete="off" placeholder="Search..."/>
						</form>
					</th>
					<th width="33%">
					<?php if (isset($_SESSION['username'])) { # FIX IT LATER. CURRENTLY I AM LAZY ?>
						<div class="loginRegisterWrapper">
							<div class="usernameHeader">
								<a href="<?php echo BASE_URI . "user/" . strtolower($_SESSION['username']); ?>" class="aWhite">
									<?php echo $_SESSION['username']; ?>
								</a>
							</div>
							<div class="logoutButton">
								<a href="<?php echo BASE_URI . "logout"; ?>" class="aWhite">Logout</a>
							</div>
						</div>
					<?php } else { ?>
						<div class="loginRegisterWrapper">
							<div class="loginButton">
								<a href="<?php echo BASE_URI . "login"; ?>" class="aWhite">Login</a>
							</div>
							<div class="registerButton">
								<a href="<?php echo BASE_URI . "register"; ?>" class="aWhite">Register</a>
							</div>
						</div>
					<?php } ?>
					</th>
				</tr>
			</table>
		</header>
		