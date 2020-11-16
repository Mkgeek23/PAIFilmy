<div class="itemsContainer container-background">
	<div class="container">
		<h2 class="itemsContainerTitle">Najnowsze filmy</h2>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM filmy ORDER BY id DESC LIMIT 24";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>
<div class="itemsContainer container-background">
	<div class="container">
		<h2 class="itemsContainerTitle">Najtańsze filmy</h2>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM filmy ORDER BY cenaZakupu ASC LIMIT 24";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>