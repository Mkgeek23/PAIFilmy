<?php
    if(!czyZalogowano()) goToLocation("index.php?a=zaloguj");


    if(isset($_POST['fImie'])){
    	//Imie
        $imie = $_POST['fImie'];

        $imie = trim(preg_replace('/\s+/', ' ', $imie));
        $imie = ucfirst($imie);
        
    	//Nazwisko
        $nazwisko = $_POST['fNazwisko'];
        
        $nazwisko = trim(preg_replace('/\s+/', ' ', $nazwisko));
        $nazwisko = ucfirst($nazwisko);
        
    	//Ulica
        $ulica = $_POST['fUlica'];

        $ulica = trim(preg_replace('/\s+/', ' ', $ulica));
        
    	//Numer domu
        $numerDomu = $_POST['fNDomu'];
        
    	//Numer mieszkania
    	if(!isset($_POST['fNMieszkania'])) $numerMieszkania = null;
    	else $numerMieszkania = $_POST['fNMieszkania'];
        
    	//Kod pocztowy
        $kodPocztowy = $_POST['fKodP'];
        
    	//Miasto
        $miasto = $_POST['fMiasto'];
        $miasto = trim(preg_replace('/\s+/', ' ', $miasto));

        $idKlienta = $_SESSION['id'];
        

        if($numerMieszkania == null) $conn->query("INSERT INTO adresy (idKlienta, imie, nazwisko, ulica, nrDomu, nrMieszkania, kodPocztowy, miasto) VALUES ('$idKlienta', '$imie', '$nazwisko', '$ulica', $numerDomu, null, '$kodPocztowy', '$miasto')");

        else $conn->query("INSERT INTO adresy (idKlienta, imie, nazwisko, ulica, nrDomu, nrMieszkania, kodPocztowy, miasto) VALUES ('$idKlienta', '$imie', '$nazwisko', '$ulica', $numerDomu, $numerMieszkania, '$kodPocztowy', '$miasto')");

        goToLocation("index.php?a=ustawienia");



    }

?>

<?php
    if(!isset($_POST['fImie'])):
?>

<form method="POST" action="index.php?a=dodajadres">
  <div class="form-background">
  <div class="form-container">
    <h1>Nowy Adres Kontaktowy</h1>
    <p>* - pola obowiązkowe</p>

    <div class="form-field" style="width: 49%; float: left;">
    	<input class="input form-input form-input-icon" type="text" name="fImie" id="fImie" maxlength="30" autocomplete="off" required>
    	<label class="form-label">*Imię</label>
    	<label class="form-label-err hidden"></label>
    </div>

    <div class="form-field" style="width: 49%; float: right;">
    	<input class="input form-input form-input-icon" type="text" name="fNazwisko" id="fNazwisko" maxlength="30" autocomplete="off" required>
    	<label class="form-label">*Nazwisko</label>
    	<label class="form-label-err hidden"></label>
    </div>
    <div style="clear:both"></div>

    <div class="form-field" style="width: 100%; float: left;">
        <input class="input form-input form-input-icon" type="text" name="fImie" id="fImie" maxlength="30" autocomplete="off" required>
        <label class="form-label">*Numer karty</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field" style="width: 100%; float: left;">
        <input class="input form-input form-input-icon" type="text" name="fImie" id="fImie" maxlength="30" autocomplete="off" required>
        <label class="form-label">*Data wygaśnięcia (MM/DD)</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field" style="width: 100%; float: left;">
        <input class="input form-input form-input-icon" type="text" name="fImie" id="fImie" maxlength="30" autocomplete="off" required>
        <label class="form-label">*Kod zabezpieczający (CVV)</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div style="clear:both"></div>
    <br>
    
    <div class="btn-field">
    	<input type="submit" name="submit" class="btn-submit btn" value="Dodaj adres">
    </div>
  </div>
  </div>
</form>

<?php
	endif;
?>