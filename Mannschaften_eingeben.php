<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");

if(isset($_POST['teams'])){//&& isset($_POST['Mannschaft'])){//überprüfung ob Formulardaten vorhanden sind
	$jsonArray = json_decode($_POST['teams'],true);
	for( $j=0;$j<count($jsonArray);$j++){
		$Mannschaft= $jsonArray[$j]["name"];
		$Lehrer = $jsonArray[$j]["lehrer"];
		$sql = "Insert Into mannschaft Values ('$Mannschaft', '$Lehrer')";//SQL-Befehl um die Daten in die Tabelle einzugeben
		$result = mysqli_query($connection, $sql);
		if ($result == ""){
			$json['error'] = "Tabelle wurde nicht aktualisiert";//Fehlermeldung
		}
		else {
			$json['success'] = "Mannschaft und Lehrer wurden eingegeben";//Erfolgsmeldung 
		}
		$sportartPlatzierung = array("volleyball_platzierung","fußball_platzierung","basketball_platzierung","badminton_platzierung","hockey_platzierung","gesamt_platzierung");
		for($i=0; $i<count($sportartPlatzierung);$i++){//for-Schleife durchläuft den Array
			$sql = "Insert Into $sportartPlatzierung[$i] (Mannschaft) Values ('$Mannschaft')";//Mannschaften werden auch in die Platzierungstabellen eingegeben
			$result = mysqli_query($connection, $sql);
			if ($result == ""){
				$json1['error'] = "Mannschaft wurde nicht eingegeben";//Fehlermeldung
			}
			else {
				$json1['success'] = "Mannschaft wurde eingegeben";//Erfolgsmeldung 
			
			}
		echo json_encode ($json1);
		}
	echo json_encode ($json);
	}
}

mysqli_close($connection);
	
?>



