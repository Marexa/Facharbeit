<?php
$connection = mysqli_connect ("localhost", "root", "123456", "test" ) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


$sportartPlatzierung = array("Volleyball_platzierung","Fußball_platzierung","Basketball_platzeriung","Badminton_platzierung","Hockey_platzierung");
if(!empty($sportartPlatzierung)){
    for($i=0; $i<count($sportartPlatzierung);$i++){
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

$sportartData = array("Volleyball_Data", "Fußball_Data","Basketball_Data","Badminton_Data","Hockey_Data")
if(!empty($sportartData)){
    for($i=0; $i<count($sportartData);$i++){
		$sql = "CREATE TABLE $sportartData[$i] (Spiel_ID int Auto_Increment, Uhrzeit VARCHAR(20), Halle int, Mannschaft1 VARCHAR(10), Mannschaft2 VARCHAR(10), Ergebnis VARCHAR(10) DEFAULT'-',
				Schiedsrichter VARCHAR(10), Primary Key(Spiel_ID)";
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
$sql= "CREATE TABLE Sportarten (sportartname VARCHAR(20))";
$result = mysqli_query($connection, $sql);
		if ($result == 1){
           $json['success'] = 'Tabelle wurde erstellt';
		} else {
			$json['error']= 'Tabelle wurde nicht erstellt';
			break;
		}
$sql= "CREATE TABLE Mannschaft (Name VARCHAR(10), Lehrer VARCHAR(10))";	
$result = mysqli_query($connection, $sql);
		if ($result == 1){
           $json['success'] = 'Tabelle wurde erstellt';
		} else {
			$json['error']= 'Tabelle wurde nicht erstellt';
			break;
		}
$sql = "CREATE TABLE User (name VARCHAR(20), berechtigung VARCHAR(20), password VARCHAR(15))";
$result = mysqli_query($connection, $sql);
		if ($result == 1){
           $json['success'] = 'Tabelle wurde erstellt';
		} else {
			$json['error']= 'Tabelle wurde nicht erstellt';
			break;
		}
echo json_encode($json);
mysqli_close($connection);
?>