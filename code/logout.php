<?php
	if(czyZalogowano()){
		session_destroy();
	}
	goToLocation("index.php");
?>