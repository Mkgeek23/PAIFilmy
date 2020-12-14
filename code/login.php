<?php
	//sprawdzanie czy uzytkownik jest juz zalogowany
	if(czyZalogowano()){
		goToLocation("index.php");
	}


	$zalogowano = false;
	if(!empty($_POST['password'])){

		//Szukanie w bazie
		$sql = "SELECT nazwaUzytkownika, haslo, id, rola FROM uzytkownicy";
	    $result = $conn->query($sql);
	    $unameErr = "Użytkowni o nazwie '".$_POST['uname']."' nie istnieje.";
	    while($row = $result->fetch_assoc()){
	    	//nazwy uzytkownika
	    	if($_POST['uname']==$row['nazwaUzytkownika']){
	    		$unameErr = "";
	    		$existUser = true;
	    		if(password_verify($_POST['password'], $row['haslo'])){
	    			$zalogowano = true;
	    			$_SESSION['id'] = $row['id'];
	    			$_SESSION['rola'] = $row['rola'];
	    			$_SESSION['username'] = $row['nazwaUzytkownika'];
	    			goToLocation("index.php");
	    		}else{
	    			$passwordErr = "Podane hasło jest niepoprawne.";
	    		}
	    		break;
	    	}
	    }
		
	}
?>
<?php
	if($zalogowano):
?>
<div class="form-container">
	<h1>Gratulację!</h1>
	<p>Logowanie przebiegło pomyślnie.</p>
</div>

<?php
	endif;
	if(!$zalogowano):
?>
<form method="POST" action="index.php?a=zaloguj">
  <div class="form-background">
  <div class="form-container">
    <h1>Logowanie</h1>
    <p>Zaloguj się do swojego konta PAIFilmy.</p>

    <div class="form-field <?php if($unameErr!="") echo"err";?> <?php if($existUser && $unameErr=="") echo 'focus'?>">
    	<input class="input form-input form-input-icon" type="text" name="uname" id="uname" minlength="3" maxlength="24" autocomplete="off" required <?php if($existUser) echo 'value="'.$_POST['uname'].'"'?>>
    	<label class="form-label <?php if($unameErr!="") echo 'hidden'?>">Nazwa użytkownika</label>
    	<label class="form-label-err <?php if($unameErr=="") echo 'hidden' ?>"><?php echo $unameErr; ?></label>
    </div>

    <div class="form-field <?php if($passwordErr!="") echo"err";?>">
    	<input class="form-input form-input-icon" type="password" name="password" id="password" minlength="6" maxlength="24" autocomplete="off" required>
    	<label class="form-label <?php if($passwordErr!="") echo 'hidden'?>">Hasło</label>
    	<label class="form-label-err <?php if($passwordErr=="") echo 'hidden' ?>"><?php echo $passwordErr; ?></label>
    </div>
    
    <br>
    <br>
    
    <div class="btn-field">
    	<input type="submit" class="btn-submit btn" value="Zalgouj się">
    </div>

    <h5>Nie masz jeszcze konta? Przejdź do <a href="index.php?a=zarejestruj">rejestracji</a>.</h5>

  </div>
  </div>
</form>

<?php
	endif;
?>