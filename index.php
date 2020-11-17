<?php
	session_start();
	require_once("api/inc.php");
?>


<!DOCTYPE html>
<html lang="PL">
<head>
	<meta charset="utf-8">
	<title>Filmy - sklep/wyporzyczalnia</title>
	<link rel="stylesheet" type="text/css" href="style/fontello.css">
	<link rel="stylesheet" type="text/css" href="style/style-items.css">

	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<?php if(isset($_SESSION['light-theme'])) echo '<link rel="stylesheet" type="text/css" href="style/style-light.css">';?>

</head>
<body class='index'>
	<nav id="nav-bar">
		<div class="container">
			<div class="nav-bar-left">
				<ul>
					<li><a href="index.php?a=katalog">Katalog</a></li>
					<li><a href="index.php?a=motyw&p=<?php echo $_GET['a']?>"><?php if(isset($_SESSION['light-theme'])) echo'<strong>';?>Jasny<?php if(isset($_SESSION['light-theme'])) echo'</strong>';?>/<?php if(!isset($_SESSION['light-theme'])) echo'<strong>';?>Ciemny<?php if(!isset($_SESSION['light-theme'])) echo'</strong>';?></a></li>
				</ul>
			</div>
			
			<div class="nav-bar-right">
				<?php if(!czyZalogowano()): ?>
				<ul>
					<li><a href="index.php?a=zarejestruj">Zarejestruj się</a></li>
					<li><a href="index.php?a=zaloguj">Zaloguj się</a></li>
				</ul>
				<?php endif;?>
				<?php if(czyZalogowano()): ?>
				<ul>
					<?php if(czyAdmin()): ?>
						<li><a class="admin" href="index.php?a=admin">Zarządzaj stroną</a></li>
					<?php endif;?>

					<li class="dropdown">
						<button class="dropbtn">Konto 
					      <i class="fa fa-caret-down"></i>
					    </button>
					    <div class="dropdown-content">
					      <a href="#">Ustawienia</a>
					      <a href="index.php?a=wyloguj">Wyloguj się</a>
					    </div>
					  </div> 
					</li>
				</ul>
				<?php endif;?>
			</div>
		</div>
	</nav>
		

		<div id=content class="box">
			<?php
				switch ($_GET['a']) {
					case 'home': 				require_once('code/home.php'); 				break;
					case 'katalog': 			require_once('code/catalog.php'); 			break;
					case 'zaloguj': 			require_once('code/login.php'); 			break;
					case 'film': 				require_once('code/movie.php'); 			break;
					case 'zarejestruj': 		require_once('code/register.php'); 			break;
					case 'wyloguj': 			require_once('code/logout.php'); 			break;
					case 'admin': 				require_once('code/admin.php'); 			break;
					case 'dodajfilm': 			require_once('code/addmovie.php'); 			break;
					case 'motyw': 				require_once('code/theme-change.php'); 		break;
					default	: 					require_once('code/catalog.php');			break;
				}
			?>
		</div>
		
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/myScripts.js"></script>

</body>
</html>


<?php
	mysqli_close($conn);
?>