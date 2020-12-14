<?php
	$sortArray = array("date", "popularity", "alpha");

	$genresArray = array();

	$sql = "SELECT nazwaGatunku FROM gatunek ORDER BY nazwaGatunku";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    	array_push($genresArray, $row['nazwaGatunku']);
    }

	$countryArray = array("0", "pl", "npl");
	if(isset($_GET['sort']) && !in_array($_GET['sort'], $sortArray) || isset($_GET['genres']) && !in_array($_GET['genres'], $genresArray) || isset($_GET['country']) && !in_array($_GET['country'], $countryArray))
		goToLocation("index.php?a=mojabiblioteka")
?>
<div class="itemsContainer container-background">
	<div class="container">
		<h2 class="itemsContainerTitle">Moje filmy</h2>
		<div class="clearfix">
			<form id="filmyFilter">
				<div class="styled-select">
					<select name="sort" id="sort" class="sort filterslib">
						<option value="date">Ostatnio dodane</option>
			            <option value="popularity"<?php if(isset($_GET['sort']) && $_GET['sort']=="popularity") echo " selected";?>>Najpopularniejsze</option>
			            <option value="alpha"<?php if(isset($_GET['sort']) && $_GET['sort']=="alpha") echo " selected";?>>Alfabetycznie</option>
					</select>
					<span class="arrow"></span>
				</div>

				<div class="styled-select">
					<select name="genres" id="genres" class="genres filterslib">
						<option value="0">Dowolny gatunek</option>
						<?php
						    foreach ($genresArray as $key => $value){
						    	echo '<option value="'.$value.'" ';
						    	if(isset($_GET['genres']) && $_GET['genres']==$value) echo "selected";
						    	echo '>'.$value.'</option>';
						    }
						?>
					</select>
					<span class="arrow"></span>
				</div>

				<div class="styled-select">
					<select name="country" id="country" class="country filterslib">
						<option value="0">Polskie i zagraniczne</option>
			            <option value="pl"<?php if(isset($_GET['country']) && $_GET['country']=="pl") echo " selected";?>>Polskie</option>
			            <option value="npl"<?php if(isset($_GET['country']) && $_GET['country']=="npl") echo " selected";?>>Zagraniczne</option>
					</select>
					<span class="arrow"></span>
				</div>
			</form>
		</div>
		<div class="clearfix" style="margin-top: 45px; min-height: 100%;">
			<?php
		
				$sql = "SELECT * FROM historiazakupow inner join filmy on filmy.id = historiazakupow.idFilmu WHERE historiazakupow.idKlienta = ".$_SESSION['id']."".((isset($_GET['country'])&&$_GET['country']=="pl")?" AND krajProdukcji='Polska'":((isset($_GET['country'])&&$_GET['country']=="npl")?" AND krajProdukcji!='Polska'":""))." ORDER BY ".((isset($_GET['sort'])&&$_GET['sort']=="popularity")?"odslony DESC":((isset($_GET['sort'])&&$_GET['sort']=="alpha")?"tytul":"historiazakupow.id DESC"));
				//echo $sql;
				//echo $sql;
			    $result = $conn->query($sql);
			    while($row = $result->fetch_assoc()){
			    	if(isset($_GET['genres']) && $_GET['genres']!="0"){
			    	$gatunek = row("SELECT id FROM gatunek WHERE nazwaGatunku='".$_GET['genres']."'");
			    	//echo $gatunek['id'];
			    	 if (isExist("SELECT * from gatunki WHERE idFilmu=".$row['id']." AND idGatunku=".$gatunek['id'], ['idGatunku'], [$gatunek['id']])){
			    		echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=obejrzyj&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">Obejrzyj</div>
							<a href="index.php?a=obejrzyj&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
							<a href="index.php?a=mojabiblioteka"><div  class="status-icon"><img alt="status zakupienia" src="img/accept.png"><span>Posiadane</span></div></a>
						</div>
			    		';
			    		}
			    	}
			    	else{
			    		echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=obejrzyj&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">Obejrzyj</div>
							<a href="index.php?a=obejrzyj&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
							<a href="index.php?a=mojabiblioteka"><div  class="status-icon"><img alt="status zakupienia" src="img/accept.png"><span>Posiadane</span></div></a>
						</div>
			    		';
			    	}
			    	
			    }
			?>
		</div>

	</div>
</div>

