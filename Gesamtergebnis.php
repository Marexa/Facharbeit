<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");//Verbindungsaufbau zu Datenbank
$sportartPlatzierung = array("fußball_platzierung","volleyball_platzierung","basketball_platzierung","badminton_platzierung","hockey_platzierung");
$sql = "SELECT Mannschaft FROM gesamt_platzierung";
$result = mysqli_query($connection, $sql);//fragt die Mannschaften der Tabelle ab und speichert diese in einem Array
$mannschaften = array();
while($variable = mysqli_fetch_array($result)){
	array_push($mannschaften,$variable[0]);
}
	
for($i=0; $i<count($sportartPlatzierung);$i++){ //for-Schleife zum durchlaufen der Arrays
	for ($j=0; $j<count($mannschaften);$j++){
		$sql = "SELECT Punkte, Torverhaeltnis FROM $sportartPlatzierung[$i] WHERE Mannschaft = '$mannschaften[$j]'";//SQL-Anfrage um die Punkte und das Torverhaeltnis aus der Sportart zu bekommen
		$result = mysqli_query($connection, $sql);
		if($result == ""){
		echo "Fehler";
		}
		else{
		$row = mysqli_fetch_array($result);		
		$sql = "SELECT Punkte, Torverhaeltnis FROM gesamt_platzierung WHERE Mannschaft = '$mannschaften[$j]'"; //Fragt den aktuellen stand des Torverhaeltnis und der Punkte in der Gesamtplatzierung ab
		$result = mysqli_query ($connection, $sql);
		$array = mysqli_fetch_array($result);//speichert das Ergebnis im Array
		$row[0]= $row[0]+$array[0];//Punkte werden zusammengerechnet
		$torverhaeltnis = $row[1];
		list($tore1,$tore2) = explode(':',$torverhaeltnis);//der in $torverhaeltnis gespeicherte Wert wird am Doppelpunkt geteilt 
		$torverhaeltnis = $array[1];
		list($tore3,$tore4) = explode(':',$torverhaeltnis);
		$Tore1 = $tore1 +$tore3;//Torverhaeltnis wird ausgerechnet
		$Tore2 = $tore2 + $tore4;
		$Tore = $Tore1.":".$Tore2;
		$sql = "UPDATE gesamt_platzierung SET Punkte = $row[0], Torverhaeltnis ='$Tore' WHERE Mannschaft = '$mannschaften[$j]'";//Torverhaeltnis und Punkte wird aktualisiert
		$result = mysqli_query($connection, $sql);
			if($result == ""){
				echo "Fehler1";
			}
			else{
				$json['success'] = 'Gesamt_Platzierung wurde aktualisiert';//sollte hier weg
				echo json_encode($json);
			}
		}
	}
}

$sql= "SELECT * FROM gesamt_platzierung ORDER BY Punkte DESC"; 
$result = mysqli_query ($connection, $sql);
$response = array();
while($row = mysqli_fetch_array($result)){//speichern des Ergebnisses der SQL Abfrage im Array
	array_push($response, array('Mannschaft' =>$row[0],'Punkte' =>$row[1],'Torverhaeltnis' =>$row[2]));//Ausgabe des Arrays
}
echo json_encode($response);
mysqli_close($connection);	
?>