<?php
	session_start();


	$returnString = "";

	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti'); // Povezava z bazo

		if (!$conn) {
			$returnString="Connection failed: " . mysqli_connect_error(); // Če ne uspe
		} else {
			if($_SESSION["status"] == 3) { // Querry, če je uporabnik admin
				$sql = "SELECT userID, username, userPriimek, userIme, userStatus
					FROM user;";
			}
			else { // Če ni admin
				$sql = "SELECT username, userPriimek, userIme, userStatus
					FROM user WHERE userStatus < 2;";
			}

			$result = $conn -> query($sql);
			$result = $result -> fetch_all(MYSQLI_ASSOC);
		}

	echo '<h1>SPREMEMBA STATUSA</h1>';

	echo '<form action="vnosStatusa.php" method="POST" id="vnos2">';
	echo 'Uporabnik: 
  		  <select id="uporabniki" name="uporabniki" >
     		<option value="-1">Izberi uporabnika</option>';
     		
  	foreach ($result as $key => $value) { // V prvi combobox vnesemo vse uporabnike, ki jim trenutni prijavljeni uporabnik lahko spreminja status
		echo '<option value='.$value['userID'].'>'.$value['username'].' - '.$value['userIme'].' '.$value['userPriimek']. ' ('; 
		switch($value['userStatus']) {
			case 0:
				echo 'dijak';
				break;
			case 1:
				echo 'ucitelj';
				break;
			case 2:
				echo 'mentor';
				break;
			case 3:
				echo 'admin';
				break;
			default:
				echo 'UsER UnkN0wN!!1one';
		}
		echo ')</option>';
	}

  	echo '</select>
  	<br/>


  	Nov status:  
  		<select id="status" name="status" >
     		<option value="-1">Izberi status</option>
     		<option value="0">Dijak</option>
     		<option value="1">Ucitelj</option>';

    if($_SESSION['status'] == 3) { // Če je uprabnik admin, ima na volje šr ta 2 statusa
		echo '<option value="2">Mentor</option>
     			<option value="3">Admin</option>';
     }
 		
     

     echo '
     	</select>


  	<br/><br/>

		  <input type="submit" name="submit" value="Do it"/>';

	echo '</form>';

	mysqli_close($conn); // Zapre povezavo
?>
