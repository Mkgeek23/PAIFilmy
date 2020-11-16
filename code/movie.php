

<?php
	if(!isset($_GET['fid'])) {echo 'noe nie jest'; goToLocation('index.php?a=katalog');}
	//Wybieranie filmu z tablicy
	//$_GET['fid']
	$row = row("SELECT * FROM `filmy` WHERE filmy.id = ".$_GET['fid']);
	if($row == null) goToLocation('index.php?a=katalog');
	$gatunki = rowArray("SELECT nazwaGatunku FROM `filmy` JOIN gatunki ON filmy.id = gatunki.idFilmu JOIN gatunek ON gatunki.idGatunku=gatunek.id WHERE filmy.id = ".$_GET['fid'], array("nazwaGatunku"));
	$rezyserzy = rowArray("SELECT imie, imie2, nazwisko FROM `ludziekina` JOIN filmrezyser ON filmrezyser.idRezysera=ludziekina.idlu  JOIN filmy ON filmy.id = filmrezyser.idFilmu WHERE filmy.id = ".$_GET['fid'], array("imie", "imie2", "nazwisko"));
	$scenarzysci = rowArray("SELECT imie, imie2, nazwisko FROM `ludziekina` JOIN filmscenarzysta ON filmscenarzysta.idScenarzysty=ludziekina.idlu  JOIN filmy ON filmy.id = filmscenarzysta.idFilmu WHERE filmy.id = ".$_GET['fid'], array("imie", "imie2", "nazwisko"));
?>

<div class="video-container">
	<div class="container">
		<div class="video-cont">
			<div class="video-container-video">
				<iframe src="//www.youtube.com/embed/<?php echo $row['zwiastun']?>" frameborder="0" allowfullscreen class="video"></iframe>
			</div>
		</div>
		
		<div class="video-container-details">
			<div class="video-container-details-title">
				<h2>
					<?php echo $row['tytul']?>
					<span class="video-container-details-title-org"><?php echo $row['orgTytul']?></span>
				</h2>
			</div>
			<ul class="attributes">
				<li><?php echo date('Y', strtotime($row['dataProdukcji']))?></li>
				<li><?php echo $row['krajProdukcji']?></li>
				<li><?php echo ($row['lektor']?"Lektor PL".($row['dubbing']?" / Dubbing PL".($row['napisy']?" / Napisy PL":""):($row['napisy']?" / Napisy PL":"")):($row['dubbing']?"Dubbing PL".($row['napisy']?" / Napisy PL":""):($row['napisy']?"Napisy PL":"Oryginalny PL")))?></li>
			</ul>
			<div class="movie-info">
				<div class="listInline">
					<h3>Gatunek</h3>
					<?php 
						foreach ($gatunki as $key => $value) {
							echo $value;
							if($key+1!=count($gatunki)) echo ', ';
						}
					?>
				</div>
				<div class="listInline">
					<h3>Reżyseria</h3>
					<?php 
						foreach ($rezyserzy as $key => $value) {
							echo $value;
							if($key%3==2 && $key+1!=count($rezyserzy)) echo ', ';
							else echo ' ';
						}
					?>
				</div>
				<div class="listInline">
					<h3>Scenariusz</h3>
					<?php 
						foreach ($scenarzysci as $key => $value) {
							echo $value;
							if($key%3==2 && $key+1!=count($scenarzysci)) echo ', ';
							else echo ' ';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="video-container">
	<div class="container">
		<hr>
	</div>
</div>


<div class="video-container">
	<div class="container">
		<div class="poster">
			<img src="img/movies/<?php echo $row['image']?>">
		</div>
		<div class="videoFullInfo">
			<h1><?php echo $row['tytul']?></h1>
			<span class="orgTitle"><?php echo $row['orgTytul']?></span>
			<ul class="attributes">
				<li><?php echo date('Y', strtotime($row['dataProdukcji']))?></li>
				<li><?php echo $row['krajProdukcji']?></li>
				<li><?php echo ($row['lektor']?"Lektor PL".($row['dubbing']?" / Dubbing PL".($row['napisy']?" / Napisy PL":""):($row['napisy']?" / Napisy PL":"")):($row['dubbing']?"Dubbing PL".($row['napisy']?" / Napisy PL":""):($row['napisy']?"Napisy PL":"Oryginalny PL")))?></li>
			</ul>
			<div class="movie-info">
				<h2>Twórcy:</h2>
				<div class="listInline">
					<h3>Gatunek</h3>
					<?php 
						foreach ($gatunki as $key => $value) {
							echo $value;
							if($key+1!=count($gatunki)) echo ', ';
						}
					?>
				</div>
				<div class="listInline">
					<h3>Reżyseria</h3>
					<?php 
						foreach ($rezyserzy as $key => $value) {
							echo $value;
							if($key%3==2 && $key+1!=count($rezyserzy)) echo ', ';
							else echo ' ';
						}
					?>
				</div>
				<div class="listInline">
					<h3>Scenariusz</h3>
					<?php 
						foreach ($scenarzysci as $key => $value) {
							echo $value;
							if($key%3==2 && $key+1!=count($scenarzysci)) echo ', ';
							else echo ' ';
						}
					?>
				</div>
			</div>
			<div class="movie-info">
				<h2>Opis filmu:</h2>
				<p><?php echo $row['opisFilmu']?></p>
			</div>
		</div>
	</div>
</div>
