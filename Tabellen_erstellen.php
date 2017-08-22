<?php
$connection = mysqli_connect ("localhost", "root", "123456", "test" ) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


    $sportartPlatzierung = array("Volleyball_Punkte","Fußball_Punkte","Basketball_Punkte");
    if(!empty($sportartPlatzierung)){
        for($i=0; $i<count(array);$i++){
			$sql = "CREATE TABLE $sportartPlatzierung[$i] (mannschaft VARCHAR(20), punkte int, torverhaeltnis VARCHAR(15))";
			$result = mysqli_query($connection, $sql);
			if ($result == 1){
            $json['success'] = 'Tabelle wurde erstellt';
			} else {
				$json['error']= 'Tabelle wurde nicht erstellt';
				break;
			}
		}
    }else{
        $json["error"] = "Keine Tabellenname angegeben";
    }

		


echo json_encode($json);
mysqli_close($connection);
?>