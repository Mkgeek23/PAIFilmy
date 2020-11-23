<?php
	if(!czyZalogowano()) goToLocation("index.php?a=logowanie");
	if(!isExist("SELECT * from koszyk WHERE idFilmu=".$_GET['fid']." AND idKlienta=".$_SESSION['id'], ['idKlienta', 'idFilmu'], [$_SESSION['id'], $_GET['fid']]) && is_numeric($_GET['fid'])){
		$conn->query("INSERT INTO koszyk (idKlienta, idFilmu) VALUES ('".$_SESSION['id']."', '".$_GET['fid']."')");
	}
	goToLocation("index.php?a=film&fid=".$_GET['fid']);
?>
<h2 class="itemsContainerTitle">Dodano do koszyka.</h2>

<div class="btn-field">
	<a href="index.php?a=film&fid=<?php echo $_GET['fid'];?>" style="width: 300px; margin: 0 auto;"><button class="btn-submit btn">Powrót</button></a>
</div>
<br>
<div class="btn-field">
	<a href="index.php?a=koszyk" style="width: 300px; margin: 0 auto;"><button class="btn-submit btn">Przejdź do koszyka</button></a>
</div>