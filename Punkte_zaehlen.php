<?php
//Torverhältnis integrieren
function updatePunkte($Mannschaft, $Punkte, $Sportart1){
	global $connection;
	global $json;
	$sql = "SELECT Punkte FROM $Sportart1  WHERE Mannschaft = '$Mannschaft'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
	$punkte = $row["Punkte"]+ $Punkte;
	if($row["Punkte"]==""){
		$json["error"] = "Punkte wurden nicht aktualisiert";
	}else{
		$json["success"] = "Punkte wurden aktualisiert";
	}
	$sql = "UPDATE $Sportart1 SET Punkte = $punkte WHERE Mannschaft = '$Mannschaft'";
	$result = mysqli_query($connection, $sql);
}
function updateDatabase($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2, $Mannschaft2){
	global $json;	
	if ($ToreTeam1<$ToreTeam2){
		$Mannschaft = $Mannschaft2;
		$Punkte = 3;
		updatePunkte($Mannschaft, $Punkte, $Sportart1);
		
	}
	elseif ($ToreTeam1>$ToreTeam2){
		$Mannschaft=$Mannschaft1;
		$Punkte = 3;
		updatePunkte($Mannschaft, $Punkte, $Sportart1);
	}
	elseif($ToreTeam1==$ToreTeam2){
		$Punkte = 1;
		$Mannschaft = $Mannschaft1;
		updatePunkte($Mannschaft, $Punkte, $Sportart1);
		$Mannschaft = $Mannschaft2;
		updatePunkte($Mannschaft, $Punkte, $Sportart1);
		
	}		
	else{
		$json["error"] = "Kein Fall trifft zu";
	}
}

$connection =  mysqli_connect ("localhost", "root", "123456", "test" ) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

if(isset($_POST['Sportart'],$_POST['Mannschaft1'],$_POST['Mannschaft2'] ,$_POST['ToreTeam1'],$_POST['ToreTeam2'])){
    $Sportart = $_POST['Sportart'];
    $Mannschaft1 = $_POST['Mannschaft1'];
	$Mannschaft2 = $_POST['Mannschaft2'];
	$ToreTeam1 = $_POST ['ToreTeam1'];
	$ToreTeam2 = $_POST ['ToreTeam2'];
	$Sportart1 = $Sportart."_platzierung";
    if(!empty($Sportart) && !empty($Mannschaft1) && !empty($ToreTeam1) && !empty($ToreTeam2) && !empty($Mannschaft1)){
       updateDatabase($Sportart1, $Mannschaft1, $ToreTeam1, $ToreTeam2, $Mannschaft2);
    }
	else{
		$json["error"]= "Fehlender Parameter";
	}
}

echo json_encode($json);
mysqli_close($connection);

?>