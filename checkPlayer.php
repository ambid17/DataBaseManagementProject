<html>
<body>

<?php
if($_SERVER["REQUEST_METHOD"]== "POST") {
$conn = new mysqli('localhost', 'root', 'password', "dndtest");

if ($conn->connect_error) {
echo "connection failed";
die("Connection failed: " . $conn->connect_error);
}

$Player_Name = (!empty($_POST["player_name"]) ? $_POST["player_name"] : null);

$Player_Query = "SELECT * FROM player WHERE Player_Name='$Player_Name'";


if(!$Player_Result = mysqli_query($conn, $Player_Query)){
	echo "Error: " . $Player_Query . "<br>" . mysqli_error($conn);
}else{
	$Player_Rows = $Player_Result->fetch_assoc();
}

if($Player_Result->num_rows != 0){
	$Player_ID = $Player_Rows['Player_ID'];
	$Character_Query = "SELECT * FROM characters WHERE Player_ID=$Player_ID";
	if($Character_Result = mysqli_query($conn, $Character_Query)){
		if($Character_Result->num_rows != 0){
			while($Character_Rows = $Character_Result->fetch_assoc()){
				$Char_name = $Character_Rows['Char_name'];
				$Char_level = $Character_Rows['Char_level'];
				$P_ID = $Character_Rows['Player_ID'];
				echo "<p>Player's ID: $P_ID <br>Character Name: $Char_name<br>Character Level: $Char_level<br><br></p>";
			}
		}
		else{
			echo "This Account posseses no characters. Try again, Redirecting in 5 seconds.";
			header("refresh:5; url=index.html");
		}
		
	}
	else{
		echo "Error: " . $Character_Query . "<br>" . mysqli_error($conn);
	}
}
else{
	echo "<p>No Player Found by the name $Player_Name</p>";
}

mysqli_close($conn);
}
else{
	echo "search didnt get hit";
}

?>

</html>
</body>
