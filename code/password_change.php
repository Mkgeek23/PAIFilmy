<?php
    //sprawdzanie czy uzytkownik jest zalogowany
    if(!czyZalogowano()){
        goToLocation("index.php?a=logowanie");
    }

    $validate = true;
    if(!empty($_POST['password'])){

        //Walidacja hasła
        if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            if (strlen($_POST["password"]) < '6') {
                $passwordErr = "Twoje nowe hasło musi się składać z min. 6 znaków!";
            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                $passwordErr = "Twoje nowe hasło musi zawierać conajmniej 1 cyfrę!";
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                $passwordErr = "Twoje nowe hasło musi zawierać conajmniej 1 dużą literę.";
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                $passwordErr = "Twoje nowe hasło musi zawierać conajmniej 1 małą literę.";
            }
        }
        elseif(!empty($_POST["password"])) {
            $cpasswordErr = "Pole 'Potwierdź nowe hasło' musi być takie samo jak pole 'Nowe hasło'!";
            $passwordErr = "Pole 'Nowe hasło' musi być takie samo jak pole 'Potwierdź nowe hasło'!";
        } else {
             $passwordErr = "Nie wprowadzono hasła!";
        }

        if($passwordErr!="" || $cpasswordErr!="") $validate = false;

        //koniec walidacji hasła
        
        if($validate == true){
            $sql = "SELECT haslo FROM uzytkownicy WHERE id=".$_SESSION['id'];
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
                if(password_verify($_POST['oldPassword'], $row['haslo'])){
                    //Zmiana adresu email
                    $conn->query("UPDATE `uzytkownicy` SET `haslo` = '".password_hash($password, PASSWORD_DEFAULT)."' WHERE `uzytkownicy`.`id` = ".$_SESSION['id']);
                    
                    goToLocation("index.php?a=ustawienia");
                }else{
                    $oldPasswordErr = "Podane hasło jest niepoprawne. (Podaj swoje stare hasło)";
                    $validate = false;
                }
                break;
            }
        }
        
    }

?>
<form method="POST" action="index.php?a=zmien_haslo">
  <div class="form-background">
  <div class="form-container">
    <h1>Zmiana hasła</h1>
    <p>W celu zmiany hasła proszę wypełnić wszystkie pola w formularzu.</p>

    <div class="form-field <?php if($oldPasswordErr!="") echo"err";?>">
        <input class="form-input form-input-icon" type="password" name="oldPassword" id="oldPassword" minlength="6" maxlength="24" autocomplete="off" required>
        <label class="form-label <?php if($oldPasswordErr!="") echo 'hidden'?>">Stare hasło</label>
        <label class="form-label-err <?php if($oldPasswordErr=="") echo 'hidden' ?>"><?php echo $oldPasswordErr; ?></label>
    </div>

    <div class="form-field <?php if($passwordErr!="") echo"err";?>">
        <input class="form-input form-input-icon" type="password" name="password" id="password" minlength="6" maxlength="24" autocomplete="off" required>
        <label class="form-label <?php if($passwordErr!="") echo 'hidden'?>">Nowe hasło</label>
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
        <label class="form-label <?php if($cpasswordErr!="") echo 'hidden'?>">Potwierdź nowe hasło</label>
        <label class="form-label-err <?php if($cpasswordErr=="") echo 'hidden' ?>"><?php echo $cpasswordErr; ?></label>
    </div>
    
    <br>
    <br>
    
    <div class="btn-field">
        <input type="submit" class="btn-submit btn" value="Zmień hasło">
    </div>

  </div>
  </div>
</form>