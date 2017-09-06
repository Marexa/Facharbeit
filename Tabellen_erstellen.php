<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");


$sportartPlatzierung = array("Volleyball_platzierung","Fußball_platzierung","Basketball_platzierung","Badminton_platzierung","Hockey_platzierung","Gesamt_platzierung");//array mit Namen für Tabellen
echo "$sportartPlatzierung";
for($i=0; $i<count($sportartPlatzierung);$i++){//for-Schleife durchläuft den Array
	$sql = "CREATE TABLE $sportartPlatzierung[$i] (mannschaft VARCHAR(20), punkte int, torverhaeltnis VARCHAR(15))";
	$result = mysqli_query($connection, $sql);
	if ($result == 1){
          $json['success'] = 'Tabelle wurde erstellt';
	} else {
		$json['error']= 'Tabelle wurde nicht erstellt';
		break;
	}
}
//Platzierungstabellen wurden erstellt

$sportartSpielplan = array("Volleyball_spielplan", "Fußball_spielplan","Basketball_spielplan","Badminton_spielplan","Hockey_spielplan");
for($i=0; $i<count($sportartSpielplan);$i++){
	$sql = "CREATE TABLE $sportartSpielplan[$i] (Spiel_ID int Auto_Increment, Uhrzeit VARCHAR(20), Halle int, Mannschaft1 VARCHAR(10), Mannschaft2 VARCHAR(10), Ergebnis VARCHAR(10) DEFAULT'-',
			Schiedsrichter VARCHAR(10), Gruppe VARCHAR(1), Primary Key(Spiel_ID))";
	$result = mysqli_query($connection, $sql);
	if ($result == 1){
        $json['success'] = 'Tabelle wurde erstellt';
	} else {
		$json['error']= 'Tabelle wurde nicht erstellt';
		break;
	}
}
//Hier ist das selbe wie von Zeile 6-17 passiert, aber mit anderen Tabellennamen und andern Tabellenspalten 
$sql= "CREATE TABLE Sportarten (sportartname VARCHAR(20))";
$result = mysqli_query($connection, $sql);
	if ($result == 1){
        $json['success'] = 'Tabelle wurde erstellt';
	} else {
		$json['error']= 'Tabelle wurde nicht erstellt';
	}
$sql= "CREATE TABLE Mannschaft (Name VARCHAR(10), Lehrer VARCHAR(10))";	
$result = mysqli_query($connection, $sql);
	if ($result == 1){
        $json['success'] = 'Tabelle wurde erstellt';
	} else {
		$json['error']= 'Tabelle wurde nicht erstellt';
	}
$sql = "CREATE TABLE User (name VARCHAR(20), berechtigung VARCHAR(20), password VARCHAR(15))";
$result = mysqli_query($connection, $sql);
	if ($result == 1){
        $json['success'] = 'Tabelle wurde erstellt';
	} else {
		$json['error']= 'Tabelle wurde nicht erstellt';
	}
//Hier werden ebenfalls Tabellen erstellt, aber alle mit unterschiedlichen Werten für die Tabellenspalten	
echo json_encode($json);
mysqli_close($connection);
?>