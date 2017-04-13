<html>
<body>

<?php
if($_SERVER["REQUEST_METHOD"]== "POST") {
$conn = new mysqli('localhost', 'root', 'password', "dndtest");

if ($conn->connect_error) {
echo "connection failed";
die("Connection failed: " . $conn->connect_error);
}

$Player_Name = (!empty($_POST["p_name"]) ? $_POST["p_name"] : null);
$Player_ID = (!empty($_POST["p_id"]) ? $_POST["p_id"] : null);
$Timestamp = date("Y-m-d h:i:s");

$sql = "INSERT INTO player (Player_ID, Player_Name, Last_played_time) VALUES ('$Player_ID','$Player_Name','$Timestamp')";

if(!mysqli_query($conn, $sql)){
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
else{
	echo "Inserted";
}

mysqli_close($conn);
}
else{
echo "search didnt get hit";
}
?>

</html>
</body>
