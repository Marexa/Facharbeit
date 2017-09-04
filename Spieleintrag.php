<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


if(isset($_POST['Sportart'])){
	$Sportart = $_POST['Sportart'];
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