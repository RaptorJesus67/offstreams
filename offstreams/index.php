<?php require_once("includes/header.php"); ?>

	<?php 
		
		require_once("libs/bootstrap.php"); 
		require_once("libs/controller.php");
		require_once("libs/model.php");	
		require_once("libs/view.php"); 
		
	
		# Control where the page will be sent
		$bootstrap = new Bootstrap($conn);
		
	?>

<?php require_once("includes/footer.php"); ?>