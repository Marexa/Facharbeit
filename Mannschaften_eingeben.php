<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

if(isset($_POST['Lehrer'])&& isset($_POST['Mannschaft'])){
	$Mannschaft = $_POST['Mannschaft'];
	$Lehrer = $_POST['Lehrer'];
	$sql = "Insert Into mannschaft Values ('$Mannschaft', '$Lehrer')";
	$result = mysqli_query($connection, $sql);
	if ($result == ""){
		$json['error'] = "Tabelle wurde nicht aktualisiert";
	}
	else {
		$json['success'] = "Mannschaft und Lehrer wurden eingegeben";
	}
	$sql = "Insert Into gesamt_platzierung (Mannschaft) Values ('$Mannschaft')";
	echo "$sql";
	$result = mysqli_query($connection, $sql);
	if ($result == ""){
		$json1['error'] = "Tabelle wurde nicht aktualisiert";
	}
	else {
		$json1['success'] = "Mannschaft wurde eingegeben";
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



