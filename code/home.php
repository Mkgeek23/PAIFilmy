<?php
	if(!empty($_SESSION['id']) && policzRekordy("historiazakupow", "idKlienta", $_SESSION['id'])>0):
?>

<div class="itemsContainer container-background">
	<div class="container">
		<a href="index.php?a=mojabiblioteka"><h2 class="itemsContainerTitle">Moja biblioteka</h2></a>
		<div></div>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM historiazakupow inner join filmy on filmy.id = historiazakupow.idFilmu where idKlienta=".$_SESSION['id']." ORDER BY historiazakupow.id DESC LIMIT 24";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">Obejrzyj</div>
							<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
							'.(czyFilmZakupiony($row['id'])?'<a href="index.php?a=mojabiblioteka"><div  class="status-icon"><img src="img/accept.png"><span>Posiadane</span></div></a>':"").'
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>

<?php
	endif;
?>

<div class="itemsContainer container-background">
	<div class="container">
		<a href="index.php?a=katalog"><h2 class="itemsContainerTitle">Ostatnio dodane</h2></a>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM filmy ORDER BY id DESC LIMIT 24";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
							<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
							'.(czyFilmZakupiony($row['id'])?'<a href="index.php?a=mojabiblioteka"><div  class="status-icon"><img src="img/accept.png"><span>Posiadane</span></div></a>':"").'
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>

<div class="itemsContainer container-background">
	<div class="container">
		<a href="index.php?a=katalog&sort=popularity&genres=0&country=0"><h2 class="itemsContainerTitle">Najpopularniejsze</h2></a>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM filmy ORDER BY odslony DESC LIMIT 24";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
							<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
							'.(czyFilmZakupiony($row['id'])?'<a href="index.php?a=mojabiblioteka"><div  class="status-icon"><img src="img/accept.png"><span>Posiadane</span></div></a>':"").'
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>
