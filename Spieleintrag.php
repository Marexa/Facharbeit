<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");


if(isset($_POST['sport'])){
	$Sportart = $_POST['sport'];
	$Sportart1 = $Sportart."_spielplan";
	$sql = "SELECT * FROM $Sportart1";
	$result = mysqli_query($connection, $sql);
	if($result == ""){
		echo "Fehler";
	}
	else{	
		$response = array();
		while($row = mysqli_fetch_array($result)){
		array_push($response, array('Spiel_ID' =>$row[0],'Uhrzeit' =>$row[1],'Halle' =>$row[2], 'Mannschaft1'=>$row[3], 'Mannschaft2'=>$row[4], 'Ergebnis'=>$row[5], 'Schiedsrichter'=>$row[6], 'Gruppe'=>$row[7]));
		}
		echo json_encode($response);
	}
}


?>