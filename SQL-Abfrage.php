<?php
$connection = mysqli_connect ("localhost", "root", "123456", "Test" )
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

$sql = "SELECT * FROM sportart1";
$result = mysqli_query($connection, $sql);
if($result == ""){
	echo "Fehler";
}
$response = array();
while($row = mysqli_fetch_array($result)){
	array_push($response, array('mannschaft' =>$row[0],'punkte' =>$row[1],'torverhaeltnis' =>$row[2])
	);
}
echo json_encode($response);

?>
