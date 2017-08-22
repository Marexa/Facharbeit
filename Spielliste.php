<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


if(isset($_POST['Sportart'],$_POST['Spiel_ID'],$_POST['ToreTeam1'],$_POST['ToreTeam2'])){
    $Sportart = $_POST['Sportart'];
	$Sportart1 = $Sportart."_data";
	$Spiel_ID = $_POST['Spiel_ID'];
    $ToreTeam1 = $_POST['ToreTeam1'];
	$ToreTeam2 = $_POST['ToreTeam2'];
	$Tore = $ToreTeam1.":".$ToreTeam2;
	$sql = "UPDATE $Sportart1 SET Ergebnis = '$Tore' WHERE Spiel_ID = '$Spiel_ID'";
	$result = mysqli_query($connection, $sql);
	if($result == ""){
		echo "Fehler";
	}
}

?>