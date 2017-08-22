<?php

function updateDatabase($mannschaft, $value){
    global $connection;
    $sql = "SELECT Punkte FROM Volleyball_data  WHERE Mannschaft = '$mannschaft'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $punkte = $row["Punkte"]+ $value;
    $sql = "UPDATE Volleyball_data SET Punkte = '$punkte' WHERE Mannschaft = '$mannschaft'";
    $result = mysqli_query($connection, $sql);
}


$connection =  mysqli_connect ("localhost", "root", "123456", "test" ) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

if(isset($_POST['mannschaft'],$_POST['value'])){
    $mannschaft = $_POST['mannschaft'];
    $value = $_POST['value'];
    if(!empty($mannschaft) && !empty($value)){
        updateDatabase($mannschaft, $value);
    }
}
mysqli_close($connection);





?>