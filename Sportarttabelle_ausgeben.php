<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


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