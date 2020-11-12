
<div class="itemsContainer">
	<div class="container">
		<h2 class="itemsContainerTitle">Filmy</h2>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM filmy";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img src="img/movies/'.$row['image'].'"></a>
							</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    }
			?>
			<?php
		
				$sql = "SELECT * FROM filmy";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img src="img/movies/'.$row['image'].'"></a>
							</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>
<div class="itemsContainer">
	<div class="container">
		<h2 class="itemsContainerTitle">Filmy</h2>
		<div class="catItems slick">
			<?php
		
				$sql = "SELECT * FROM filmy";
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img src="img/movies/'.$row['image'].'"></a>
							</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    }
			?>

		</div>
	</div>
</div>