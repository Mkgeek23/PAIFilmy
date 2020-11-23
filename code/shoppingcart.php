<?php
	if(!czyZalogowano()) goToLocation("index.php?a=logowanie");

	if(isset($_GET['did']) && is_numeric($_GET['did'])){
		$conn->query("DELETE FROM koszyk WHERE idKlienta=".$_SESSION['id']." AND idFilmu=".$_GET['did']);
	}
?>


<div class="video-container">
	<div class="container">
		<h1 class="web-header">Koszyk</h1>

		<div class="cart-items-container">

			<?php
				$sql = "SELECT * FROM koszyk INNER JOIN filmy on filmy.id = koszyk.idFilmu WHERE idKlienta=".$_SESSION['id'];
				//echo $sql;
				//echo $sql;
				$doZaplaty = 0;
			    $result = $conn->query($sql);
			    $id = 0;
			    while($row = $result->fetch_assoc()){
			    	$doZaplaty += $row['cenaZakupu'];
			    	echo '
			    		<div class="cart-item">
							<span class="cart-item-id">'.++$id.'</span>
							<div class="cart-item-poster">
								<a href="index.php?a=film&fid='.$row['id'].'"><img alt="poster" class="fade-in" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cart-item-info">
								<a href="index.php?a=film&fid='.$row['id'].'"><div class="cart-item-info-header">
									<h2 class="cart-item-info-header-h2">'.$row['tytul'].'</h2>
									<p class="cart-item-info-header-p">'.$row['orgTytul'].'</p>
								</div></a>
								<div class="cart-item-info-"></div>
							</div>
							<div class="cart-item-info2">
								<div class="price">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
								<div class="del"><a href="index.php?a=koszyk&did='.$row['id'].'">Usuń</a></div>
							</div>
						</div>
			    	';
			    }
			?>
		</div>
		<?php if($id==0) echo '<div style="text-align: center; color: white">Koszyk jest pusty.</div>'?>
		<?php if($doZaplaty>0): ?>
		<div class="cart-result">
			<div class="clearfix" style="position: absolute;width: 100%; text-align: center">Łącznie do zapłaty:&nbsp<strong><?php echo number_format((float)$doZaplaty, 2, '.', ''); ?> PLN</strong>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div style="clear: both"></div>

				<a href="index.php?a=koszyk" style="width: 100%; margin-top: 45px;"><button class="btn-submit btn">Przejdź do płatności</button></a>
		</div>
		<?php
			endif;
		?>
		
	</div>
</div>