<?php
	print_r($_POST);


	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti');

		if (!$conn) {
			$returnString="Connection failed: " . mysqli_connect_error();
		}
		else {
			$sql = 'UPDATE user SET userStatus ='.$_POST['status'].' WHERE userID = '.$_POST['uporabniki'].';';

			$result = $conn -> query($sql);
		}


	mysqli_close($conn);
?>