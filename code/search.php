<?php
	if(!isset($_POST['search'])) goToLocation("index.php?a=katalog");
?>
<div class="itemsContainer container-background">
	<div class="container">
		<h2 class="itemsContainerTitle">Wyszukiwanie filmu zawierającego frazę: '<?php echo $_POST['search'] ?>'</h2>
		<div class="clearfix" style="margin-top: 45px; min-height: 100%;">
			<?php
				
				$sql = "SELECT * FROM filmy WHERE tytul LIKE '%".$_POST['search']."%' OR  orgTytul LIKE '%".$_POST['search']."%'";

			    $result = $conn->query($sql);
			    
			    while($row = $result->fetch_assoc()){
		    		echo '
		    		<div class="catItem">
						<div class="simplePoster">
							<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
						</div>
						<div class="cena">'.(!czyFilmZakupiony($row['id'])?number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN':"Obejrzyj").'</div>
						<a href="index.php?a='.(czyFilmZakupiony($row['id'])?"obejrzyj":"film").'&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						'.(czyFilmZakupiony($row['id'])?'<a href="index.php?a=mojabiblioteka"><div  class="status-icon"><img alt="status zakupienia" src="img/accept.png"><span>Posiadane</span></div></a>':"").'
					</div>
		    		';
			    }
			?>
		</div>

	</div>
</div>

