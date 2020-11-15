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

    function zalozZdejmij($conn, $id, $used){
    	$result = $conn->query("SELECT items.type FROM items inner join inventory on items.id = inventory.iid where inventory.id='".$id."' AND inventory.uid = ".$_SESSION['id']);
	    while($row = $result->fetch_assoc()){
	    	$result2 = $conn->query("SELECT inventory.id FROM items inner join inventory on items.id = inventory.iid where inventory.used=1 AND items.type='".$row['type']."' AND inventory.uid = ".$_SESSION['id']);
		    while($row2 = $result2->fetch_assoc()){
		    	$conn->query("UPDATE inventory SET used = 0 where id='".$row2['id']."' AND uid = ".$_SESSION['id']);
		    }
	    }
    	$result = $conn->query("UPDATE inventory SET used = '".$used."' where id='".$id."' AND uid = ".$_SESSION['id']);
    }

    function kupPrzedmiot($conn, $id){
    	$result = $conn->query("SELECT cost FROM items WHERE id=".$id);
	    while($row = $result->fetch_assoc()){
	    	$result2 = $conn->query("SELECT gold FROM stats WHERE uid = ".$_SESSION['id']);
		    while($row2 = $result2->fetch_assoc()){
		    	if($row['cost']<=$row2['gold']){
		    		$newGold = $row2['gold'] - $row['cost'];
		    		$conn->query("UPDATE stats SET gold = ".$newGold." WHERE uid=".$_SESSION['id']);
		    		$conn->query("INSERT INTO inventory(uid, iid) VALUES (".$id.", ".$_SESSION['id'].")");
		    		echo "Zakupiono przedmiot.";
		    	}
		    	else{
		    		echo 'Nie masz wystarczająco pieniędzy.';
		    	}
		    }
	    }
    	$result = $conn->query("UPDATE inventory SET used = '".$used."' where id='".$id."' AND uid = ".$_SESSION['id']);
    }

    function invUsedShow($conn, $name, $type){
    	$result = $conn->query("SELECT * FROM items inner join inventory on items.id = inventory.iid where items.type='".$type."' AND inventory.used=1 AND inventory.uid = ".$_SESSION['id']);
    	$znaleziono = 0;
	    while($row = $result->fetch_assoc()){
	    	$znaleziono++;
		        echo '
				<div class="inventory-slot-on">
				<a href="index.php?a=ekwipunek&i='.$row['id'].'&u=0" alt="Zdejmij przedmiot">
					<div class="inventory-slot-on-img">
						<div class="inventory-slot-on-img-title">'.$row['name'].'</div>
						<img class="inventory-slot-on-img-image" src="images/'.$row['type'].'/'.$row['img'].'.png">
						<div class="progBar_background" style="width: 115px">
							<div class="progBar night" style="width:'.$row['stamina'].'%;"></div>
							<div class="progBar_text" style="width:115px;">'.$row['stamina'].'%</div>
						</div>
					</div>
				</a>
					<div class="inventory-slot-on-cnt">
						';
						//Obrażenia od przedmiotu
						if($row['min_dmg']!=0)
							echo '<div class="inventory-slot-on-cnt-stat"><div class="inventory-slot-on-cnt-statname">Obrażenia</div><div class="inventory-slot-on-cnt-statvalue">'.$row['min_dmg'].'-'.$row['max_dmg'].'</div></div>';
						echo '<div class="inventory-slot-on-cnt-stat">
							<div class="inventory-slot-on-cnt-statname">Wytrzymałość</div><div class="inventory-slot-on-cnt-statvalue">'.$row['stamina'].'%</div>
						</div>
					</div>
				</div>
		        ';
	    }
	    if(!$znaleziono)
	    	echo '
				<div class="inventory-slot-on">
		    		<div class="inventory-slot-on-img">
			    		<div class="inventory-slot-on-img-title">'.$name.'</div>
						<img class="inventory-slot-on-img-image" src="images/items/none.png">
					</div>
					<div class="inventory-slot-on-cnt">
					</div>
				</div>
	    	';
    }




    function add_user_to_database($username, $email, $pwd_hashed){
    	global $conn;
    	$conn->query("INSERT INTO uzytkownicy(nazwaUzytkownika, email, haslo) VALUES ('".$username."', '".$email."', '".$pwd_hashed."')");

    }
?>