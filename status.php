<?php
	/*session_start();
	if ($_SESSION["stutus"] < 2)
		header("location: index.php");
*/

	$returnString = "";

	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti');

		if (!$conn) {
			$returnString="Connection failed: " . mysqli_connect_error();
		}
		else {
			$sql = "SELECT userID, username, userPriimek, userIme, userStatus
					FROM user;";
			/*if($_SESSION["stutus"] != 3)
				$sql = "SELECT username, userPriimek, userIme, userStatus
					FROM user WHERE userStatus < 2;";
*/
			$result = $conn -> query($sql);
			$result = $result -> fetch_all(MYSQLI_ASSOC);
		}

	print_r($result);

	echo '<br/> <br/> <br/> <br/> <br/> <br/>';

	echo '<form action="vnosStatusa.php" method="POST" id="vnos2">';
	echo 'Uporabnik : 
  		  <select id="uporabniki" name="uporabniki" >
     		<option value="-1">Izberi uporabnika</option>';
     		
  	foreach ($result as $key => $value) {
		echo '<option value='.$value['userID'].'>'.$value['username'].' - '.$value['userIme'].' '.$value['userPriimek'].'</option>';
	}

  	echo '</select>
  	<br/>


  	Uporabnik : 
  		<select id="status" name="status" >
     		<option value="-1">Izberi status</option>
     		<option value="0">Dijak</option>
     		<option value="1">Ucitelj</option>';

    /*if($_SESSION["stutus"] = 3)
				echo '<option value="2">Mentor</option>
     				<option value="3">Admin</option>';
*/ 		
     

     echo '
     	</select>


  	<br/><br/>

		  <input type="submit" name="submit" value="Do it"/>';

	echo '</form>';

	mysqli_close($conn);
?>
