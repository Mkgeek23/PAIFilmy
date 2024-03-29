<?php
	session_start();
	require_once("api/inc.php");
?>


<!DOCTYPE html>
<html lang="PL">
<head>
	<meta charset="utf-8">
	<title>PAIF - oglądaj filmy online</title>
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
					<li><a href="index.php" style="padding-top: 8px;"><img alt="logo" height="32" src="img/logo<?php echo (isset($_SESSION['light-theme']))?"-black":"";?>.png" style="padding-top: 6px"></a></li>
					<li><a href="index.php?a=katalog">Katalog</a></li>
					<li><a href="index.php?a=motyw&p=<?php echo $_GET['a']?>"><?php if(isset($_SESSION['light-theme'])) echo'<strong>';?>Jasny<?php if(isset($_SESSION['light-theme'])) echo'</strong>';?>/<?php if(!isset($_SESSION['light-theme'])) echo'<strong>';?>Ciemny<?php if(!isset($_SESSION['light-theme'])) echo'</strong>';?></a></li>
				</ul>
			</div>
			
			<div class="nav-bar-right">
				<ul>
					<li>
						<div class="serviceSearch">
						    <form id="searchBar-1" class="searchBar" method="post" action="index.php?a=szukaj">
						        <input id="searchText" class="searchInfo info" name="search" type="text" placeholder="Szukaj filmu..." autocomplete="off" minlength="3" maxlength="24" required>
						        <input type="submit" class="btn-submit-empty searchLens" value="Szukaj">
						    </form>
						</div>
					</li>
					<?php if(!czyZalogowano()): ?>
						<li><a href="index.php?a=zarejestruj">Zarejestruj się</a></li>
						<li><a href="index.php?a=zaloguj">Zaloguj się</a></li>
					</ul>
					<?php endif;?>
					<?php if(czyZalogowano()): ?>
				
					<?php if(czyAdmin()): ?>
						<li><a class="admin" href="index.php?a=admin">Zarządzaj stroną</a></li>
					<?php endif;?>
					<?php
						$ileKoszyk = countRows("SELECT id from koszyk WHERE idKlienta=".$_SESSION['id']);
					?>
					<li><a href="index.php?a=mojabiblioteka">Moje filmy</a></li>
					<li class="dropdown">
						<button class="dropbtn"><?php echo $_SESSION['username'].(($ileKoszyk>0)?" <strong><span style='color:#8900c4'>(".$ileKoszyk.")</span></strong>":""); ?>
					      <i class="fa fa-caret-down"></i>
					    </button>
					    <div class="dropdown-content">
					      <a href="index.php?a=koszyk">Koszyk <?php echo (($ileKoszyk>0)?"<strong><span style='color:#8900c4'>(".$ileKoszyk.")</span></strong>":"") ?></a>
					      <a href="index.php?a=ustawienia">Ustawienia</a>
					      <a href="index.php?a=wyloguj">Wyloguj się</a>
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
					case 'dodajadres': 			require_once('code/address_add.php'); 		break;
					case 'ustawienia': 			require_once('code/settings.php'); 			break;
					case 'motyw': 				require_once('code/theme-change.php'); 		break;
					case 'koszyk': 				require_once('code/shoppingcart.php'); 		break;
					case 'dodajdokoszyka': 		require_once('code/cart-add.php'); 			break;
					case 'dokonajZakupu': 		require_once('code/payment.php'); 			break;
					case 'mojabiblioteka': 		require_once('code/library.php'); 			break;
					case 'obejrzyj': 			require_once('code/watch.php'); 			break;
					case 'zmien_adres_email': 	require_once('code/email_change.php'); 		break;
					case 'zmien_haslo': 		require_once('code/password_change.php');	break;
					case 'szukaj': 				require_once('code/search.php');			break;
					default	: 					require_once('code/home.php');				break;
				}
			?>
			<footer><span>© Maciej Olech</span></footer>
		</div>


		

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="js/myScripts.js"></script>

</body>
</html>


<?php
	mysqli_close($conn);
?>