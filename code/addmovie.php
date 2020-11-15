<?php
    if(!czyAdmin()) goToLocation("index.php");
?>

<?php
    if(isset($_POST['fTitle'])){
        //Tytuł
        $tytul = $_POST['fTitle'];

        //Tytuł oryginalny
        $tytulOrg = $_POST['fTitleOrg'];
        if($tytulOrg=="") $tytulOrg=null;

        //Plakat filmu
        $target_dir = "img/movies/";
        $target_file = $target_dir . basename($_FILES["fImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fImage"]["tmp_name"]);
          if($check !== false) {
            move_uploaded_file($_FILES["fImage"]["tmp_name"], $target_file);
          } 
        }

        $image = $_FILES["fImage"]["name"];

        //Zwiastun
        $zwiastun = $_POST['fZwiastun'];

        //Kraj produkcji
        $kraj = $_POST['fKraj'];

        //Opis
        $opis = $_POST['fOpis'];

        //Data
        $data = $_POST['fData'];

        //Cena
        $cena = $_POST['fCena'];

        if(isset($_POST['lektor'])) $lektor = 1; else $lektor = 0;
        if(isset($_POST['napisy'])) $napisy = 1; else $napisy = 0;


        //$sql = "INSERT";
        if(!isExist("SELECT * FROM filmy", ['image', 'zwiastun'], [$image, $zwiastun]))
            $conn->query("INSERT INTO filmy (tytul, orgTytul, image, zwiastun, krajProdukcji, opisFilmu, dataProdukcji, cenaWyporzyczenia, cenaZakupu, lektor, napisy) VALUES ('$tytul', '$tytulOrg', '$image', '$zwiastun', '$kraj', '$opis', '$data', '$cena', '$cena', '$lektor', '$napisy')");

        $row = row("SELECT * from filmy where image='$image'");
        $filmId = $row['id'];
        //Tworcy
        foreach ($_POST['fTworcy'] as $key => $value) {
            //Usuwanie zbędnych spacji
            $value = trim(preg_replace('/\s+/', ' ', $value));
            $fullName = explode ( " " , $value, 3 );

            //Usuwanie pustych rekordów
            $imie = $fullName[0];
            if(count($fullName)>2){$imie2=$fullName[1]; $nazwisko=$fullName[2];}
            else {$imie2=null; $nazwisko=$fullName[1];}

            if(!isExist("SELECT * from ludziekina", ['imie', 'imie2', 'nazwisko'], [$imie, $imie2, $nazwisko])){
                echo "Będzie dodawanko";
                if($imie2!='') $conn->query("INSERT INTO ludziekina (imie, imie2, nazwisko) VALUES ('$imie', '$imie2', '$nazwisko')");
                else $conn->query("INSERT INTO ludziekina (imie, nazwisko) VALUES ('$imie', '$nazwisko')");
            }
            $row = row("SELECT idlu FROM ludziekina where imie='$imie' and nazwisko='$nazwisko'");
            $idLudzia = $row['idlu'];

            if(isset($_POST['scenarzysta'][$key]))
                if(!isExist("SELECT * from filmscenarzysta", ['idFilmu', 'idScenarzysty'], [$filmId, $idLudzia]))
                    $conn->query("INSERT INTO filmscenarzysta (idFilmu, idScenarzysty) VALUES ('$filmId', '$idLudzia')");

            if(isset($_POST['rezyser'][$key])) 
                if(!isExist("SELECT * from filmrezyser", ['idFilmu', 'idRezysera'], [$filmId, $idLudzia]))
                    $conn->query("INSERT INTO filmrezyser (idFilmu, idRezysera) VALUES ('$filmId', '$idLudzia')");

        }

        //Gatunki
        foreach ($_POST['fGatunki'] as $value) {
            //Usuwanie zbędnych spacji
            $nazwaGatunku = trim(preg_replace('/\s+/', '', $value));

            $row = row("SELECT id FROM gatunek where nazwaGatunku='$nazwaGatunku'");
            $idGatunku = $row['id'];

            if(!isExist("SELECT * from gatunek", ['nazwaGatunku'], [$nazwaGatunku])){
                $conn->query("INSERT INTO gatunek (nazwaGatunku) VALUES ('$nazwaGatunku')");
            }
            if(!isExist("SELECT * from gatunki", ['idFilmu', 'idGatunku'], [$filmId, $idGatunku]))
                $conn->query("INSERT INTO gatunki (idFilmu, idGatunku) VALUES ($filmId, $idGatunku)");
        }

        goToLocation("index.php?a=film&fid=".$filmId);
    }
    if(!isset($_POST['fTitle'])):
?>


<form method="POST" action="index.php?a=dodajfilm" enctype="multipart/form-data">
  <div class="form-background">
  <div class="form-container">
    <h1>Dodawanie filmu</h1>
    <p>* - pola obowiązkowe</p>

    <div class="form-field">
    	<input class="input form-input form-input-icon" type="text" name="fTitle" id="fTitle" maxlength="90" autocomplete="off" required>
    	<label class="form-label">*Tytuł filmu</label>
    	<label class="form-label-err hidden"></label>
    </div>

    <div class="form-field">
        <input class="input form-input form-input-icon" type="text" name="fTitleOrg" id="fTitleOrg" maxlength="90" autocomplete="off">
        <label class="form-label">Oryginalny tytuł filmu</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field form-file">
        <input class="input form-input form-input-icon form-input-image"  type="file" accept="image/*" name="fImage" id="fImage" required>
        <label class="form-label <?php if($emailErr!="") echo 'hidden'?>">*Plakat filmu</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field">
        <input class="input form-input form-input-icon" type="text" name="fZwiastun" id="fZwiastun" maxlength="11" autocomplete="off" required>
        <label class="form-label">*Zwiastun</label>
        <label class="form-label-err hidden"></label>
        <div class="form-input-info">
            <div class="tooltip">
                <span class="tooltiptext">11-znakowy ciąg znaków, prowadzący do filmiku na youtubie. (https://www.youtube.com/watch?v=...)</span>
                <i class="ico ico--info icon-info" style="font-size:1.5rem;"></i>
            </div>
        </div>
    </div>

    <div class="form-field focus-block">
        <div id="tworcy"></div>
            <div><input class="input form-input form-input-icon tworca" type="text" name="fTworcy[]" id="fTworcy" maxlength="40" autocomplete="off" required></div>
            <label class="form-label">Twórcy</label>
            <div style="float: left; margin-top: 5px;"><label><input type="checkbox" name="scenarzysta[]" id="scenarzysta">Scenarzysta</label>
        <label><input type="checkbox" name="rezyser[]" id="rezyser">Reżyser</label></div>
        
        
        <label class="form-label-err hidden"></label>
        <div class="form-input-info">
            <div class="tooltip">
                <span class="tooltiptext">Aby dodać kolejnego twórcę naciśnij przycisk. Jeśli dodałeś za dużo, po prostu pozostaw pole puste.</span>
                <i class="ico ico--info icon-info" style="font-size:1.5rem;"></i>
            </div>
        </div><div style="clear: both;"></div><br>
        <label class="form-add" onclick="dodajTworce('tworcy', 'fTworcy', 'scenarzysta', 'rezyser')"><a href="#">Dodaj twórcę</a></label>
    </div>

    <div class="form-field focus-block">
        <div id="gatunki"></div>
            <div><input class="input form-input form-input-icon gatunek" type="text" name="fGatunki[]" id="fGatunki" maxlength="30" autocomplete="off" required></div>
            <label class="form-label">Gatunki</label>
        <label class="form-label-err hidden"></label>
        <div class="form-input-info">
            <div class="tooltip">
                <span class="tooltiptext">Aby dodać kolejny gatunek naciśnij przycisk. Jeśli dodałeś/aś za dużo, po prostu pozostaw pole puste.</span>
                <i class="ico ico--info icon-info" style="font-size:1.5rem;"></i>
            </div>
        </div><div style="clear: both;"></div><br>
        <label class="form-add" onclick="dodajGatunek('gatunki', 'fGatunki')"><a href="#">Dodaj gatunek</a></label>
    </div>

    <div class="form-field">
        <input class="input form-input form-input-icon" type="text" name="fKraj" id="fKraj" maxlength="20" autocomplete="off" required>
        <label class="form-label">*Kraj Produkcji</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field">
        <textarea class="form-input" id="fOpis" name="fOpis" rows="4" cols="55" required></textarea>
        <label class="form-label">*Opis filmu</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field form-file">
        <input class="input form-input form-input-icon" type="date" name="fData" id="fData" maxlength="8" autocomplete="off" required>
        <label class="form-label">*Data produkcji</label>
        <label class="form-label-err hidden"></label>
    </div>

    <div class="form-field">
        <input class="input form-input form-input-icon" type="number" step="0.01" name="fCena" id="fCena" maxlength="8" autocomplete="off" required>
        <label class="form-label">*Cena</label>
        <label class="form-label-err hidden"></label>
        <div class="form-input-info">
            PLN
        </div>
    </div>

    <div class="form-field">
        <label class="form-label">Wersja językowa</label><br>
        <div style="float: left; margin-top: 5px;"><label><input type="checkbox" name="lektor">Lektor</label>
        <label><input type="checkbox" name="napisy">Napisy</label></div>
        <label class="form-label-err hidden"></label>
    </div>
    
    <div class="btn-field">
    	<input type="submit" name="submit" class="btn-submit btn" value="Dodaj film">
    </div>
  </div>
  </div>
</form>
<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript">
    var tworcy = [<?php
        $tworcy = rowArray("SELECT * FROM ludziekina", ['imie', 'imie2', 'nazwisko']);
        foreach ($tworcy as $key => $value) {
            if($key%3==0) echo "'";
            echo $value;
            echo ($key%3==2)?(($key+1!=count($tworcy))?"', ":"'"):(($value=="")?"":" ");
        }
    ?>];
    var gatunki = [<?php
        $tworcy = rowArray("SELECT nazwaGatunku FROM gatunek", ['nazwaGatunku']);
        foreach ($tworcy as $key => $value) {
            
            echo "'".$value."'";
            if($key+1!=count($tworcy)) echo ", ";
        }
    ?>];
function dodajTworce(id, srcId, srcSc, srcRe){
  var input = document.createElement('input');
  input.setAttribute('type', 'text');
  input.setAttribute('name', 'fTworcy[]');
  input.setAttribute('maxlength', '40');
  input.setAttribute('autocomplete', 'off');
  input.value = document.getElementById(srcId).value;
  document.getElementById(srcId).value = "";
  input.className = 'input form-input form-input-icon tworca';
  var kontener = document.getElementById(id);
  kontener.appendChild(input);
  
  var div = document.createElement('div');
  div.style.marginTop = "5px";
  div.style.marginTop = "5px";
  div.style.float = "left";

  var label1 = document.createElement('label');
  var input1 = document.createElement('input');
  input1.setAttribute('type', 'checkbox');
  input1.setAttribute('name', 'scenarzysta[]');
  if(document.getElementById(srcSc).checked) input1.setAttribute('checked', 'checked');

  document.getElementById(srcSc).checked = false

  label1.appendChild(input1);
  label1.innerHTML += "Scenarzysta";

  var label2 = document.createElement('label');
  var input2 = document.createElement('input');

  input2.setAttribute('type', 'checkbox');
  input2.setAttribute('name', 'rezyser[]');
  
  if(document.getElementById(srcRe).checked) input2.setAttribute('checked', 'checked');

  document.getElementById(srcRe).checked = false

  label2.appendChild(input2);
  label2.innerHTML += "Rezyser";

  div.appendChild(label1);
  div.appendChild(label2);

  kontener.appendChild(div);
    /*var kropka = document.createElement('div');
    kropka.setAttribute('style', 'clear:both; height: 28px;');
    kropka.innerHTML = "<b>•</b>";
    var kropki = document.getElementById("kropki");
    kropki.appendChild(kropka)*/
  input2.checked = true
}
function dodajGatunek(id, srcId){
  var input = document.createElement('input');
  input.setAttribute('type', 'text');
  input.setAttribute('name', 'fGatunki[]');
  input.setAttribute('maxlength', '30');
  input.setAttribute('autocomplete', 'off');
  input.value = document.getElementById(srcId).value;
  document.getElementById(srcId).value = "";
  input.className = 'input form-input form-input-icon tworca';
  var kontener = document.getElementById(id);
  kontener.appendChild(input);
  
  
}

function test(el){
    el.innerHTML = "test";
}
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("fTworcy"), tworcy);
autocomplete(document.getElementById("fGatunki"), gatunki);
</script>
<?php endif; ?>