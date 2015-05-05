<?php
	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti');

  	if (!$conn)
	{
   		$returnString="Connection failed: " . mysqli_connect_error();
 	}
	else
	{
    		$sql = "SELECT userID, username, userPriimek, userIme, userStatus
     		FROM user;";
		$result = $conn -> query($sql);
  		$result = $result -> fetch_all(MYSQLI_ASSOC);
 	}
	//print_r($result);
	echo'<table>';
	foreach($result as $el)
	{
	}
	echo'</table>';
?>