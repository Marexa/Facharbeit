<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


$sportartPlatzierung = array("fußball_platzierung","volleyball_platzierung",//"basketball_platzierung","badminton_platzierung","hockey_platzierung"
);
$sql = "SELECT Mannschaft FROM gesamt_platzierung";
$result = mysqli_query($connection, $sql);
//$respone = mysqli_fetch_array($result);
$mannschaften = array();
while($variable = mysqli_fetch_array($result)){
	array_push($mannschaften,$variable[0]);
}
	
for($i=0; $i<count($sportartPlatzierung);$i++){ 
	for ($j=0; $j<count($mannschaften);$j++){
		$sql = "SELECT Punkte, Torverhaeltnis FROM $sportartPlatzierung[$i] WHERE Mannschaft = '$mannschaften[$j]'";
		$result = mysqli_query($connection, $sql);

		if($result == ""){
		echo "Fehler";
		}
		else{
		$row = mysqli_fetch_array($result);		
		$sql = "SELECT Punkte, Torverhaeltnis FROM gesamt_platzierung WHERE Mannschaft = '$mannschaften[$j]'";
		$result = mysqli_query ($connection, $sql);
		$array = mysqli_fetch_array($result);
		$row[0]= $row[0]+$array[0];
		$torverhaeltnis = $row[1];
		list($tore1,$tore2) = explode(':',$torverhaeltnis);
		$torverhaeltnis = $array[1];
		list($tore3,$tore4) = explode(':',$torverhaeltnis);
		$Tore1 = $tore1 +$tore3;
		$Tore2 = $tore2 + $tore4;
		$Tore = $Tore1.":".$Tore2;
		$sql = "UPDATE gesamt_platzierung SET Punkte = $row[0], Torverhaeltnis ='$Tore' WHERE Mannschaft = '$mannschaften[$j]'";
		$result = mysqli_query($connection, $sql);
			if($result == ""){
				echo "Fehler1";
			}
			else{
				$json['success'] = 'Gesamt_Platzierung wurde aktualisiert';//muss hier weg
				echo json_encode($json);
			}
		}
	}
}


mysqli_close($connection);	


?>