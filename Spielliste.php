<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");


if(isset($_POST['sport'],$_POST['spielId'],$_POST['t1'],$_POST['t2'])){
    $Sportart = $_POST['sport'];
	$Sportart1 = $Sportart."_spielplan";
	$Spiel_ID = $_POST['spielId'];
    $ToreTeam1 = $_POST['t1'];
	$ToreTeam2 = $_POST['t2'];
	$Tore = $ToreTeam1.":".$ToreTeam2;
	$sql = "UPDATE $Sportart1 SET Ergebnis = '$Tore' WHERE Spiel_ID = '$Spiel_ID'";
	$result = mysqli_query($connection, $sql);
	if($result == ""){
		echo "Fehler";
	}
}
//Dieses Skript ist unnötig
?>