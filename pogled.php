<?php
	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti');

  	if (!$conn)
	{
   		$returnString="Connection failed: " . mysqli_connect_error();
 	}
	else
	{
    		$sql = "SELECT *
     		FROM dejavnost;";
		$result = $conn -> query($sql);
  		$result = $result -> fetch_all(MYSQLI_ASSOC);
 	}
	//print_r($result);
	
	echo'<h1>Dejavnosti:<h1><br>';
	echo'<table>';
	foreach($result as $el)
	{
		echo'<tr><td>'.$el["naslovD"].'</td></td>';
	}
	echo'</table>';
?>