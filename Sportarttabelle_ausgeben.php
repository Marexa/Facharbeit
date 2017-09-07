<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");



if(isset($_POST['sport'])){//Formulardaten werden ausgelesen 
	$Sportart = $_POST['sport'];
	$Sportart1 = $Sportart."_platzierung";
	$sql = "SELECT * FROM $Sportart1 Order BY Punkte DESC";//Abfrage der Tabelle und Sortierung nach Punkte 
	$result = mysqli_query($connection, $sql);
	if($result == ""){
		echo "Fehler";
	}
	else{	
		$response = array();
		while($row = mysqli_fetch_array($result)){//speichern des Ergebnisses der SQL Abfrage im Array
		array_push($response, array('Mannschaft' =>$row[0],'Punkte' =>$row[1],'Torverhaeltnis' =>$row[2],));//Ausgabe des Arrays
		}
		echo json_encode($response);
	}
}


?>