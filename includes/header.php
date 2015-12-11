<!DOCTYPE html>
<html ng-app="ostrApp">
	<head>
		<title><?php echo $this->title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URI; ?>css/desktopStyle.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URI; ?>css/strudel.css" />
		<?php require_once(BASE_CLIENT . "javascript/js.html"); ?>
	</head>
</html>
<body>
	<header>
		<table class='headerTable'>
			<tr>
				<th class='headerLeft'>
					<a href="<?php echo BASE_URI; ?>">
						<img src='<?php echo BASE_URI; ?>images/OffStreams Logo New.jpg' class='siteLogo' />
					</a>
				</th>
				<th class='headerCenter'>
					<form action="<?php echo BASE_URI; ?>search/" method="post">
						<input type="text" name="searchbar" id="searchbar" placeholder="Search..." />
					</form>
				</th>
				<th class='headerRight'>
					<?php if (isset($_SESSION['username'])) { ?>
						<div>
							<p>
								<a href='<?php echo BASE_URI . "user/" . strtolower($_SESSION['username']); ?>' class='aWhite'>
									<?php echo $_SESSION['username']; ?>
								</a>
							</p>
						</div>
						<div>
							<p>
								<a href='<?php echo BASE_URI . "logout"; ?>' class='aWhite'>
									Logout
								</a>
							</p>
						</div>
					<?php } else { ?>
						<div>
							<p>
								<a href="<?php echo BASE_URI; ?>login" class='aWhite'>
									Login
								</a>
							</p>
						</div>
						<div>
							<p>
								<a href="<?php echo BASE_URI; ?>register" class='aWhite'>
									Register
								</a>
							</p>
						</div>
					<?php } ?>
				</th>
			</tr>
		</table>
	</header>
	<nav ng-controller="Navigation as nav">
		<ul>
			<li ng-repeat="nav in names">
				<a href="<?php echo BASE_URI; ?>{{nav.href}}" class='aWhite'>
					{{nav.name}}
				</a>
			</li>
		</ul>
	</nav>
