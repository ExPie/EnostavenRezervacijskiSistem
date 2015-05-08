<?php
	function izris($conn, $kljuc=NULL)
	{
		if($kljuc==NULL)
		{
			$sql = "SELECT * FROM dejavnost;";
			$result = $conn -> query($sql);
			$result = $result -> fetch_all(MYSQLI_ASSOC);
		}
		else
		{
			$sql = "SELECT * FROM dejavnost WHERE (
				naslovD LIKE '%".$kljuc."%' OR
				MentorjiD LIKE '%".$kljuc."%' OR
				OrgOblikaD LIKE '%".$kljuc."%' OR
				NadarjenostD LIKE '%".$kljuc."%' OR
				OpombeD LIKE '%".$kljuc."%'
			);";
			$result = $conn -> query($sql);
			$result = $result -> fetch_all(MYSQLI_ASSOC);
		}
		if(!$result)
			echo'<table><tr><td>Ni  zadetkov.</tr></td></table>';
		else
		{
			echo'<table>';
			echo'<tr><td>Ime dejavnosti</td><td>Oblika</td><td>Namenjeno</td></tr>';
			foreach($result as $el)
			{
				echo'<tr><td>'.$el["naslovD"].'</td><td>'.$el["OrgOblikaD"].'</td><td>'.$el["PrimernostD"].'</td></td>';
			}
			echo'</table>';
		}
	}
	
	echo'
	<style>
		table, th, td
		{
			border: 1px solid black;
			border-collapse: collapse;
			background-color: white;
			padding: 5px;
		}
	</style>
	<form method="POST" action="pogled.php">
	<input type="text" name="search">
	<input type="submit" value="Iskanje">
	</form>';
	$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti');
	if (!$conn)
	{
		$returnString="Podatkovna baza je nedosegljiva: " . mysqli_connect_error();
		echo $returnString.'<br/>';
	}
	else
	{
		echo'<h1>Dejavnosti:<h1>';
		if(count($_POST)==0)
			izris($conn);
		else
			izris($conn, $_POST["search"]);
	}
?>