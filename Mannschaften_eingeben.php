<?php
require_once 'Verbindung_herstellen.php';
$connection = mysqli_connect(hostname, username, password, db_name)or die("Could not connect to db");

if(isset($_POST['Lehrer'])&& isset($_POST['Mannschaft'])){//überprüfung ob Formulardaten vorhanden sind
	$Mannschaft = $_POST['Mannschaft'];
	$Lehrer = $_POST['Lehrer'];
	$sql = "Insert Into mannschaft Values ('$Mannschaft', '$Lehrer')";//SQL-Befehl um die Daten in die Tabelle einzugeben
	$result = mysqli_query($connection, $sql);
	if ($result == ""){
		$json['error'] = "Tabelle wurde nicht aktualisiert";//Fehlermeldung
	}
	else {
		$json['success'] = "Mannschaft und Lehrer wurden eingegeben";//Erfolgsmeldung 
	}
	$sql = "Insert Into gesamt_platzierung (Mannschaft) Values ('$Mannschaft')";//Mannschaften werden auch in die Gesamttabelle eingegeben
	echo "$sql";
	$result = mysqli_query($connection, $sql);
	if ($result == ""){
		$json1['error'] = "Tabelle wurde nicht aktualisiert";//Fehlermeldung
	}
	else {
		$json1['success'] = "Mannschaft wurde eingegeben";//Erfolgsmeldung 
	}
	
echo json_encode ($json);
echo json_encode ($json1);
}

mysqli_close($connection);
	
?>
<!--$jsonString = [{"name":"10D3","lehrer":"Niehaus"},{"name":"10D3","lehrer":"Niehaus"},{"name":"10D3","lehrer":"Niehaus"},{"name":"10D3","lehrer":"Niehaus"}]
$jsonArray = json_decode($jsonString,true);
$Mannschaft= $jsonArray[0]["name"];
$Lehrer = $jsonArray[0]["lehrer"];-->



