<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");


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

?>