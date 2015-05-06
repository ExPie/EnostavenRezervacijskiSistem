<?php
	//print_r($result);
	echo'
	<form method="POST" action="pogled.php">
	<input type="text" name="search">
	<input type="submit" value="Iskanje">
	</form>';
	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti');
	if(count($_POST)==0)
	{
		if (!$conn)
		{
   			$returnString="Connection failed: " . mysqli_connect_error();
 		}
		else
		{
    		$sql = "SELECT * FROM dejavnost;";
			$result = $conn -> query($sql);
  			$result = $result -> fetch_all(MYSQLI_ASSOC);
 		}
		echo'<h1>Dejavnosti:<h1><br>';
		echo'<table>';
		foreach($result as $el)
		{
			echo'<tr><td>'.$el["naslovD"].'</td></td>';
		}
		echo'</table>';
	}
	else
	{
	  	if (!$conn)
		{
   			$returnString="Connection failed: " . mysqli_connect_error();
 		}
		else
		{
    		$sql = "SELECT * FROM dejavnost WHERE (
				naslovD LIKE '%".$_POST["search"]."%' OR
				MentorjiD LIKE '%".$_POST["search"]."%' OR
				OrgOblikaD LIKE '%".$_POST["search"]."%' OR
				NadarjenostD LIKE '%".$_POST["search"]."%' OR
				OpombeD LIKE '%".$_POST["search"]."%'
			);";
			$result = $conn -> query($sql);
			if(!$result)
				echo'<table><tr><td>Ni  zadetkov.</tr></td></table>';
			else
			{
				$result = $result -> fetch_all(MYSQLI_ASSOC);
				echo'<table>';
				foreach($result as $el)
				{
					echo'<tr><td>'.$el["naslovD"].'</td></td>';
				}
				echo'</table>';
			}
 		}
	}
?>