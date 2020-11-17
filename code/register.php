<?php
	//sprawdzanie czy uzytkownik jest juz zalogowany
	if(czyZalogowano()){
		goToLocation("index.php");
	}

	$validate = true;
	if(!empty($_POST['password'])){

		//Walidacja adresu email
		$email = $_POST['email'];

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		} else {
		  $validate = false;
		  $emailErr = "Adres email '".$email."' nie jest poprawny";
		}

		//Walidacja hasła
		if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
		    $password = $_POST["password"];
		    $cpassword = $_POST["cpassword"];
		    if (strlen($_POST["password"]) < '6') {
		        $passwordErr = "Twoje hasło musi się składać z min. 6 znaków!";
		    }
		    elseif(!preg_match("#[0-9]+#",$password)) {
		        $passwordErr = "Twoje hasło musi zawierać conajmniej 1 cyfrę!";
		    }
		    elseif(!preg_match("#[A-Z]+#",$password)) {
		        $passwordErr = "Twoje hasło musi zawierać conajmniej 1 dużą literę.";
		    }
		    elseif(!preg_match("#[a-z]+#",$password)) {
		        $passwordErr = "Twoje hasło musi zawierać conajmniej 1 małą literę.";
		    }
		}
		elseif(!empty($_POST["password"])) {
		    $cpasswordErr = "Pole 'Potwierdź hasło' musi być takie samo jak pole 'Hasło'!";
		    $passwordErr = "Pole 'Hasło' musi być takie samo jak pole 'Potwierdź hasło'!";
		} else {
		     $passwordErr = "Nie wprowadzono hasła!";
		}

		if($passwordErr!="" || $cpasswordErr!="") $validate = false;

		//Walidacja nazwy uzytkownika
		$uname = $_POST['uname'];
		if(!preg_match('/^[a-zA-Z0-9\-\_\.]{3,}$/', $uname)) {
			$unameErr = "Nazwa użytkownika '".$uname."' jest niepoprawna";
			$validate = false;
		}

		//Szukanie w bazie
		$sql = "SELECT nazwaUzytkownika, email FROM uzytkownicy";
	    $result = $conn->query($sql);
	    while($row = $result->fetch_assoc()){
	    	//nazwy uzytkownika
	    	if($uname==$row['nazwaUzytkownika']){
				$unameErr = "Nazwa użytkownika: '".$uname."' - jest już zajęta przez innego użytkownika.";
	    		$validate = false;
	    	}
	    	//adresu email
	    	if($email==$row['email']){
		  		$emailErr = "Adres email '".$email."' jest już zajęty przez innego użytkownika.";
	    		$validate = false;
	    	}
	    }

		//Szukanie loginu w bazie

		//Szyfrowanie hasła

	    if($validate){
	    	//Szyfrowanie hasła
			$pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
			add_user_to_database($uname, $email, $pwd_hashed);

			echo (password_verify($password, $pwd_hashed));
			echo "<br>";
			echo strlen($pwd_hashed);

			$allCorrect = true;
		}
		
	}
?>
<?php
	if($allCorrect):
?>
<div class="form-container">
	<h1>Gratulację!</h1>
	<p>Twoje konto zostało założone pomyślnie.</p>
	<h5>Teraz możesz się <a href="index.php?a=logowanie">zalogować</a>.</h5>
</div>

<?php
	endif;
	if(!$allCorrect):
?>
<form method="POST" action="index.php?a=zarejestruj">
  <div class="form-background">
  <div class="form-container">
    <h1>Rejestracja</h1>
    <p>W celu rejestracji proszę wypełnić wszystkie pola w formularzu.</p>

    <div class="form-field <?php if($unameErr!="") echo"err";?> <?php if(!$validate && $unameErr=="") echo 'focus'?>">
    	<input class="input form-input form-input-icon" type="text" name="uname" id="uname" minlength="3" maxlength="24" autocomplete="off" required <?php if(!$validate && $unameErr=="") echo 'value="'.$uname.'"'?>>
    	<label class="form-label <?php if($unameErr!="") echo 'hidden'?>">Nazwa użytkownika</label>
    	<label class="form-label-err <?php if($unameErr=="") echo 'hidden' ?>"><?php echo $unameErr; ?></label>
    	<div class="form-input-info">
    		<div class="tooltip">
    			<span class="tooltiptext">Nazwa użytkownika powinna wynosić min. 3 znaki. Możesz użyć liter, cyfr oraz znaków: [.-_].</span>
    			<i class="ico ico--info icon-info" style="font-size:1.5rem;"></i>
    		</div>
    	</div>
    </div>

    <div class="form-field <?php if($emailErr!="") echo"err";?> <?php if(!$validate && $emailErr=="") echo 'focus'?>">
    	<input class="input form-input form-input-icon" type="text" name="email" id="email" maxlength="30" autocomplete="off" required <?php if(!$validate && $emailErr=="") echo 'value="'.$email.'"'?>>
    	<label class="form-label <?php if($emailErr!="") echo 'hidden'?>">Adres email</label>
    	<label class="form-label-err <?php if($emailErr=="") echo 'hidden' ?>"><?php echo $emailErr; ?></label>
    </div>

    <div class="form-field <?php if($passwordErr!="") echo"err";?>">
    	<input class="form-input form-input-icon" type="password" name="password" id="password" minlength="6" maxlength="24" autocomplete="off" required>
    	<label class="form-label <?php if($passwordErr!="") echo 'hidden'?>">Hasło</label>
    	<label class="form-label-err <?php if($passwordErr=="") echo 'hidden' ?>"><?php echo $passwordErr; ?></label>
    	<div class="form-input-info">
    		<div class="tooltip">
    			<span class="tooltiptext">Hasło musi się składać z min. 6 znaków. Musi zawierać conajmniej 1 literę dużą, 1 literę małą oraz cyfrę.</span>
    			<i class="ico ico--info icon-info" style="font-size:1.5rem;"></i>
    		</div>
    	</div>
    </div>

    <div class="form-field <?php if($cpasswordErr!="") echo"err";?>">
    	<input class="form-input form-input-icon" type="password" name="cpassword" id="cpassword" maxlength="24" autocomplete="off" required>
    	<label class="form-label <?php if($cpasswordErr!="") echo 'hidden'?>">Potwierdź hasło</label>
    	<label class="form-label-err <?php if($cpasswordErr=="") echo 'hidden' ?>"><?php echo $cpasswordErr; ?></label>
    </div>
    
    <br>
    <br>
    
    <div class="btn-field">
    	<input type="submit" class="btn-submit btn" value="Załóż nowe konto">
    </div>

    <h5>Posiadasz już konto? Przejdź do <a href="index.php?a=zaloguj">strony logowania</a>.</h5>

  </div>
  </div>
</form>

<?php
	endif;
?>