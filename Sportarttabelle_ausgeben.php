<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");



if(isset($_POST['Sportart'])){
	$Sportart = $_POST['Sportart'];
	$Sportart1 = $Sportart."_platzierung";
	$sql = "SELECT * FROM $Sportart1 Order BY Punkte DESC";
	$result = mysqli_query($connection, $sql);
	if($result == ""){
		echo "Fehler";
	}
	else{	
		$response = array();
		while($row = mysqli_fetch_array($result)){
		array_push($response, array('Mannschaft' =>$row[0],'Punkte' =>$row[1],'Torverhaeltnis' =>$row[2],));
		}
		echo json_encode($response);
	}
}


?>