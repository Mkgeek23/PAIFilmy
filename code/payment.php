<?php
	$sql="	
	INSERT INTO historiazakupow (idFilmu, idKlienta)
	SELECT idFilmu, idKlienta 
	FROM koszyk 
	WHERE idKlienta =".$_SESSION['id'];

	$sql2 = "DELETE FROM `koszyk` WHERE `koszyk`.`idKlienta` = ".$_SESSION['id'];

	$conn->query($sql); //przeniesienie do nowej tabeli
	$conn->query($sql2); //usuniecie ze starej
?>

<div class="payInfo">
	<h1>Pomyślnie zapłacono za pomocą: <?php echo $_POST['payMethod']?></h1>
	<h3>Automatyczne przekierowanie nastąpi za 3 sekundy...</h3>

</div>

<script type="text/javascript">
	setTimeout("location.href='index.php?a=mojabiblioteka';",3000);
</script>