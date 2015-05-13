<?php
	print_r($_POST);


	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti'); // Povezava z bazo

		if (!$conn) {
			$returnString="Connection failed: " . mysqli_connect_error(); // Če ne uspe
		}
		else {
			$sql = 'UPDATE user SET userStatus ='.$_POST['status'].' WHERE userID = '.$_POST['uporabniki'].';';

			$result = $conn -> query($sql); // Se izvede querry (posodobi status)
		}


	mysqli_close($conn);
?>
