<?php
//Dieses Skript ermittelt den Gewinner, rechnet die Punkte und das Toreverhältnis zusammen und trägt diese Daten dann in der Datenbamk ein
function torverhaeltnisEintragen ($Sportart1, $Mannschaft, $ToreTeam1, $ToreTeam2 ){//Funktion torverhaeltnisEintragen rechnet und aktualisiert das Toreverhältnis
global $connection;
$sql= "SELECT Torverhaeltnis FROM $Sportart1 WHERE Mannschaft = '$Mannschaft'";//
$result = mysqli_query($connection, $sql);
$torverhaeltnis = mysqli_fetch_array($result);
list($tore3,$tore4) = explode(':',$torverhaeltnis[0]);
$Tore1 = $tore3 + $ToreTeam1;
$Tore2 = $tore4 + $ToreTeam2;
$Tore = $Tore1.":".$Tore2;
$sql = "UPDATE $Sportart1 SET Torverhaeltnis = '$Tore' WHERE Mannschaft = '$Mannschaft'";
$result = mysqli_query($connection, $sql);
	if ($result == ""){
		$json2 ['error'] = "Torverhaeltnis wurde nicht gesetzt";
		echo json_encode($json2);
	}
	else {
		$json2 ['success'] = "Torverhaeltnis wurde gesetzt";
		echo json_encode($json2);
	}
}

function updatePunkte($Mannschaft, $Punkte, $Sportart1){
	global $connection;
	$sql = "SELECT Punkte FROM $Sportart1  WHERE Mannschaft = '$Mannschaft'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
	$punkte = $row["Punkte"]+ $Punkte;
	$sql = "UPDATE $Sportart1 SET Punkte = $punkte WHERE Mannschaft = '$Mannschaft'";
	$result = mysqli_query($connection, $sql);
	if($result==""){
		$json["error"] = "Punkte wurden nicht aktualisiert";
		echo json_encode($json);
	}else{
		$json["success"] = "Punkte wurden aktualisiert";
		echo json_encode($json);
	}
}

function updateDatabase($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2, $Mannschaft2){
	
	if ($ToreTeam1<$ToreTeam2){
		$Punkte = 3;
		updatePunkte($Mannschaft2, $Punkte, $Sportart1);
		torverhaeltnisEintragen($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2 );
		$tor1 = $ToreTeam2;
		$tor2 = $ToreTeam1;
		$ToreTeam1 = $tor1;
		$ToreTeam2 = $tor2;
		torverhaeltnisEintragen($Sportart1, $Mannschaft2, $ToreTeam1, $ToreTeam2 );
	}
	elseif ($ToreTeam1>$ToreTeam2){
		$Punkte = 3;
		updatePunkte($Mannschaft1, $Punkte, $Sportart1);
		torverhaeltnisEintragen($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2 );
		$tor1 = $ToreTeam2;
		$tor2 = $ToreTeam1;
		$ToreTeam1 = $tor1;
		$ToreTeam2 = $tor2;
		torverhaeltnisEintragen($Sportart1, $Mannschaft2, $ToreTeam1, $ToreTeam2 );
	}
	elseif($ToreTeam1==$ToreTeam2){
		$Punkte = 1;
		updatePunkte($Mannschaft1, $Punkte, $Sportart1);
		updatePunkte($Mannschaft2, $Punkte, $Sportart1);
		torverhaeltnisEintragen($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2 );
		torverhaeltnisEintragen($Sportart1, $Mannschaft2, $ToreTeam1, $ToreTeam2 );
		
	}		
	else{
		$json["error"] = "Kein Fall trifft zu";
		echo json_encode($json);
	}
}


require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");
if(isset($_POST['sport'],$_POST['m1'],$_POST['m2'] ,$_POST['t1'],$_POST['t2'],$_POST['spielId'])){
    $Sportart = $_POST['sport'];
    $Mannschaft1 = $_POST['m1'];
	$Mannschaft2 = $_POST['m2'];
	$ToreTeam1 = $_POST ['t1'];
	$ToreTeam2 = $_POST ['t2'];
	$Spiel_ID = $_POST ['spielId'];
	$Sportart1 = $Sportart."_platzierung";
    if(!empty($Sportart) && !empty($Mannschaft1) && !empty($ToreTeam1) && !empty($ToreTeam2) && !empty($Mannschaft1) && !empty($Spiel_ID)){
       updateDatabase($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2, $Mannschaft2);
		$Sportart2 = $Sportart."_spielplan";
		$Ergebnis = $ToreTeam1.":".$ToreTeam2;
		$sql= "UPDATE $Sportart2 SET Ergebnis = '$Ergebnis' WHERE Spiel_ID = $Spiel_ID";
		$result = mysqli_query($connection, $sql);
		if ($result == ""){
			$json1 ['error'] = "Ergebnis wurde nicht gesetzt";
			echo json_encode($json1);
		}
		else {
			$json1 ['success'] = "Ergebnis wurde gesetzt";
			echo json_encode($json1);
		}
	}
	else{
		$json["error"]= "Fehlender Parameter";
		echo json_encode($json);
	}
	


}



mysqli_close($connection);

?>