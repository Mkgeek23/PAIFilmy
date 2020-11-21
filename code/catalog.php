
<div class="itemsContainer container-background">
	<div class="container">
		<h2 class="itemsContainerTitle">Wszystkie filmy</h2>
		<div class="clearfix">
			<form id="filmyFilter">
				<div class="styled-select">
					<select name="sort" id="sort" class="sort filter">
						<option value="date">Ostatnio dodane</option>
			            <option value="popularity"<?php if(isset($_GET['sort']) && $_GET['sort']=="popularity") echo " selected";?>>Najpopularniejsze</option>
			            <option value="alpha"<?php if(isset($_GET['sort']) && $_GET['sort']=="alpha") echo " selected";?>>Alfabetycznie</option>
					</select>
					<span class="arrow"></span>
				</div>

				<div class="styled-select">
					<select name="genres" id="genres" class="genres filter">
						<option value="0">Dowolny gatunek</option>
						<?php
							$sql = "SELECT nazwaGatunku FROM gatunek ORDER BY nazwaGatunku";
						    $result = $conn->query($sql);
						    while($row = $result->fetch_assoc()){
						    	echo '<option value="'.$row['nazwaGatunku'].'" ';
						    	if(isset($_GET['genres']) && $_GET['genres']==$row['nazwaGatunku']) echo "selected";
						    	echo '>'.$row['nazwaGatunku'].'</option>';
						    }
						?>
					</select>
					<span class="arrow"></span>
				</div>

				<div class="styled-select">
					<select name="country" id="country" class="country filter">
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
		
				$sql = "SELECT * FROM filmy ".((isset($_GET['country'])&&$_GET['country']=="pl")?" WHERE krajProdukcji='Polska'":((isset($_GET['country'])&&$_GET['country']=="npl")?" WHERE krajProdukcji!='Polska'":""))." ORDER BY ".((isset($_GET['sort'])&&$_GET['sort']=="popularity")?"odslony DESC":((isset($_GET['sort'])&&$_GET['sort']=="alpha")?"tytul":"id DESC"));
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
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    		}
			    	}
			    	else{
			    		echo '
			    		<div class="catItem">
							<div class="simplePoster">
								<a href="index.php?a=film&fid='.$row['id'].'" class="itemPosterLink"><img alt="plakat" src="img/movies/'.$row['image'].'"></a>
							</div>
							<div class="cena">'.number_format((float)$row['cenaZakupu'], 2, '.', '').' PLN</div>
							<a href="index.php?a=film&fid='.$row['id'].'" class="itemLink"><h3>'.$row['tytul'].'</h3></a>
						</div>
			    		';
			    	}
			    	
			    }
			?>
		</div>

	</div>
</div>

