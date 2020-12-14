<?php
    function goToLocation($location){
        echo '<script>window.location = "'.$location.'"; </script>';
    }

    function czyZalogowano(){
    	return isset($_SESSION['id']);
    }

    function czyAdmin(){

    	if(czyZalogowano()){
	    	$row = row("SELECT * FROM uzytkownicy where id=".$_SESSION['id']);
	    	return $row['rola']=="admin";
    	}
    	return false;
    }

    function row($sql){
    	global $conn;
    	$result = $conn->query($sql);
    	while($row = $result->fetch_assoc()){
    		break;
    	}
    	return $row;
    }

    function rowArray($sql, $items){
    	global $conn;

    	$ritems = array();
    	
    	$result = $conn->query($sql);
    	
    	while($row = $result->fetch_assoc()){
    		foreach ($items as $key => $value) {
    			array_push($ritems, $row[$value]);
    		}
    		
    	}
    	return $ritems;
    }

    function countRows($sql){
        global $conn;
        
        $result = $conn->query($sql);
        $ile = 0;
        while($row = $result->fetch_assoc()){
            $ile++;
        }
        return $ile;
    }

    function isExist($sql, $itemsId, $itemsVal){
        global $conn;
        
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $ile=0;
            foreach ($itemsId as $key => $value) {
                if($row[$value]==$itemsVal[$key]) $ile++;
                else break;
            }
            if($ile==count($itemsId)){
                return true;
            }
            
        }
        return false;
    }

    //Funkcja dodająca użytkownika do bazy danych
    function add_user_to_database($username, $email, $pwd_hashed){
        global $conn;
        $conn->query("INSERT INTO uzytkownicy(nazwaUzytkownika, email, haslo) VALUES ('".$username."', '".$email."', '".$pwd_hashed."')");
    }

    //Funkcja dodająca użytkownika do bazy danych
    function policzRekordy($table, $kolumna, $wartosc){
        global $conn;
        $row = $conn->query("SELECT count(id) as ile from ".$table." WHERE ".$kolumna." = ".$wartosc);

        return $row->fetch_assoc()['ile'];
    }

    //Funkcja dodająca użytkownika do bazy danych
    function czyFilmZakupiony($idFilmu){
        global $conn;
        $result = $conn->query("SELECT * FROM historiazakupow WHERE idFilmu=".$idFilmu." AND idKlienta=".$_SESSION['id']);
        return mysqli_num_rows($result);
    }
?>