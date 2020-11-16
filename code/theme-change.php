<?php 
	if(isset($_SESSION['light-theme'])) unset($_SESSION['light-theme']);
	else $_SESSION['light-theme'] = true;
	goToLocation("index.php?a=".$_GET['p']);

?>