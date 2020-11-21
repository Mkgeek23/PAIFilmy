<?php
	if(!czyZalogowano()) goToLocation("index.php?a=zaloguj"); 

	if(isset($_GET['del'])){
		$conn->query("DELETE FROM adresy where id=".$_GET['del']);
		goToLocation("index.php?a=ustawienia");
	} 

	$daneKonta = row("SELECT nazwaUzytkownika, email from uzytkownicy where id=".$_SESSION['id']);
?>


<div class="video-container">
	<div class="container">
		<div class="settigns-section">
			<header class="settigns-section-header clearfix">
				<h1>Konto</h1>
			</header>
			<section class="settigns-section-content">
			</section>
		</div>

		<div class="settigns-section">
			<header class="settigns-section-header">
				<h2>Szczegóły konta</h2>
			</header>
			<section class="settigns-section-content">
				<div class="settigns-subsection clearfix">
					<div class="clearfix">
						<div class="settings-section-group">
							<div class="settings-section-item">
								<strong><?php echo $daneKonta['email'] ?></strong>
							</div>
							<div class="settings-section-item">
								<strong>Nazwa konta:</strong> <?php echo $daneKonta['nazwaUzytkownika'] ?>
							</div>
							<div class="settings-section-item">
								<strong>Hasło:</strong> ********
							</div>
						</div>
						<div class="settings-section-group">
							<div class="settings-section-item">
								<a class="settings-section-link">Zmień adres email</a> 
							</div>
							<div class="settings-section-item">
								<br>
							</div>
							<div class="settings-section-item">
								<a class="settings-section-link">Zmień hasło</a> 
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="settigns-section">
			<header class="settigns-section-header">
				<h2>Adresy</h2>
			</header>
			<section class="settigns-section-content">
				<?php

					$result = $conn->query("SELECT * from adresy where idKlienta=".$_SESSION['id']);
			    	while($row = $result->fetch_assoc()){
			    		echo '
			    			<div class="settigns-subsection clearfix">
								<div class="clearfix">
									<div class="settings-section-group">
										<div class="settings-section-item">
											<strong>Imię i nazwisko:</strong> '.$row['imie'].' '.$row['nazwisko'].'
										</div>
										<div class="settings-section-item">
											<strong>Adres:</strong> ul. '.$row['ulica'].' '.$row['nrDomu'];

											if($row['nrMieszkania']!=null) echo '/'.$row['nrMieszkania'];

											echo ', '.$row['kodPocztowy'].' '.$row['miasto'].'
										</div>
										<div class="settings-section-item">
										</div>
									</div>

									<div class="settings-section-group">
										<div class="settings-section-item">
											<a href="index.php?a=ustawienia&del='.$row['id'].'" class="settings-section-link">Usuń adres</a> 
										</div>
									</div>
								</div>

							</div>
			    		';
			    	}

				?>

				
				
				<div class="settigns-subsection clearfix">
					<div class="clearfix">
						<a href="index.php?a=dodajadres">Dodaj adres</a> 
					</div>
				</div>
			</section>
		</div>

	</div>
</div>