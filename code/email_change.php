<?php
    //sprawdzanie czy uzytkownik jest zalogowany
    if(!czyZalogowano()){
        goToLocation("index.php?a=logowanie");
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

        //Szukanie w bazie
        $sql = "SELECT email FROM uzytkownicy";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            //adresu email
            if($email==$row['email']){
                $emailErr = "Adres email '".$email."' jest już zajęty przez innego użytkownika.";
                $validate = false;
            }
        }
        
        if($validate == true){
            $sql = "SELECT haslo FROM uzytkownicy WHERE id=".$_SESSION['id'];
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
                if(password_verify($_POST['password'], $row['haslo'])){
                    //Zmiana adresu email
                    $conn->query("UPDATE `uzytkownicy` SET `email` = '".$email."' WHERE `uzytkownicy`.`id` = ".$_SESSION['id']);
                    
                    goToLocation("index.php?a=ustawienia");
                }else{
                    $passwordErr = "Podane hasło jest niepoprawne. (Podaj swoje hasło)";
                    $validate = false;
                }
                break;
            }
        }
        
    }

?>
<form method="POST" action="index.php?a=zmien_adres_email">
  <div class="form-background">
  <div class="form-container">
    <h1>Zmiana adresu email</h1>
    <p>W celu zmiany adresu email proszę wypełnić wszystkie pola w formularzu.</p>

    <div class="form-field <?php if($emailErr!="") echo"err";?> <?php if(!$validate && $emailErr=="") echo 'focus'?>">
    	<input class="input form-input form-input-icon" type="text" name="email" id="email" maxlength="30" autocomplete="off" required <?php if(!$validate && $emailErr=="") echo 'value="'.$email.'"'?>>
    	<label class="form-label <?php if($emailErr!="") echo 'hidden'?>">Nowy adres email</label>
    	<label class="form-label-err <?php if($emailErr=="") echo 'hidden' ?>"><?php echo $emailErr; ?></label>
    </div>

    <div class="form-field <?php if($passwordErr!="") echo"err";?>">
        <input class="form-input form-input-icon" type="password" name="password" id="password" minlength="6" maxlength="24" autocomplete="off" required>
        <label class="form-label <?php if($passwordErr!="") echo 'hidden'?>">Twoje hasło</label>
        <label class="form-label-err <?php if($passwordErr=="") echo 'hidden' ?>"><?php echo $passwordErr; ?></label>
    </div>
    
    <br>
    <br>
    
    <div class="btn-field">
        <input type="submit" class="btn-submit btn" value="Zmień adres email">
    </div>

  </div>
  </div>
</form>