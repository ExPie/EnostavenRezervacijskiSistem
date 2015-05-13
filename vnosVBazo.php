<?php
	echo '<head> <meta charset="UTF-8"> </head>';
	print_r($_POST);

	function parse() // podatki se sparsajo
	{
		$result=array();
		$result['naslov']=$_POST['naslovDejavnosti'];
		$stringStart=0;
		$imena=array();
		$priimki=array();

		for($i=0; $i<strlen($_POST['mentorIme']); $i++)
		{
			if($_POST['mentorIme'][$i]==',')
			{
				$priimki[]=substr($_POST['mentorIme'],$stringStart,$i-$stringStart);
				$stringStart=$i+1;
			}
		}
		$stringStart=0;
		
		for($i=0; $i<strlen($_POST['mentorPriimek']); $i++)
		{
			if($_POST['mentorPriimek'][$i]==',')
			{
				$imena[]=substr($_POST['mentorPriimek'],$stringStart,$i-$stringStart);
				$stringStart=$i+1;
			}
		}
		
		$size=count($imena);
		$result['mentorji']="";
		for( $i=0 ; $i<$size ; $i++)
		{
			$result['mentorji'].=$imena[$i].' '.$priimki[$i].', ';
		}
		if($size>=1)
		{
			$result['mentorji']=substr($result['oblike'],0,-2);
		}			
		
		if(strcmp($_POST['nacinSrecanja'],"poDogovoru")==0)
			$result['nacinSrecanja']=$_POST['nacinSrecanja'];
		else
			$result['nacinSrecanja']=$_POST['nacinSrecanja'].','.$_POST['casSrecanja'];
		
		if($_POST['srecanjaDrugo']!="")
		{
			$result['nacinSrecanja'].=', drugo: '.$_POST['srecanjaDrugo'];
		}
		
		
		$result['govorilneUre']=$_POST['govorilneUre'];
		$result['ePosta']=$_POST['ePosta'];
		$result['telefon']=$_POST['telefon'];
		$result['vpisDrugo']=$_POST['vpisDrugo'];
		
		
		if(isset($_POST['oblike']))
		{
			$oblikeTmp=$_POST['oblike'];
			
			if(empty($oblikeTmp))
			{
				$result['oblike']="/";
			}
			else
			{
				$result['oblike']="";

				$found=array_search("pripraveNaTekmovanje",$oblikeTmp);
				if(gettype($found)!="boolean")
				{
					$oblikeTmp[$found].='-'.$_POST['pripraveNaTekmovanjeSelect'];
				}
				$found=array_search("projektnoDelo",$oblikeTmp);
				if(gettype($found)!="boolean")
				{
					$oblikeTmp[$found].='-'.$_POST['projektnoDeloSelect'];
				}
			
				$n=count($oblikeTmp);
				for($i=0 ; $i<$n ; $i++)
				{
					$result['oblike'].=$oblikeTmp[$i].', ';
				}
			}
		}
		
		if($_POST['oblikeDrugo']!="")
		{
			$result['oblike'].='drugo: '.$_POST['oblikeDrugo'];
		}
		else
		{
			$result['oblike']=substr($result['oblike'],0,-2);
		}
	
		$result['primernost']="";
		$primernostTmp;
		if(isset($_POST['primernost']))
		{
			$primernostTmp=$_POST['primernost'];
		}
		
		$programTmp;
		if(isset($_POST['program']))
		{
			$programTmp=$_POST['program'];
		}
		
		$letnikTmp;
		if(isset($_POST['letnik']))
		{
			$letnikTmp=$_POST['letnik'];
		}
		
		if(isset($primernostTmp))
			$found=array_search("dijakeVsehProgramov",$primernostTmp);
		else
			$found=false;
		
		if(gettype($found)!="boolean")
		{
			$result['primernost'].="Za Dijake vseh programov ";
		}
		else
		{
			if(isset($programTmp))
			{
				$result['primernost'].="Za Dijake ";
				if(count($programTmp)==3)
				{
					$result['primernost'].="vseh programov ";
				}
				else
				{
					foreach ($programTmp as $prog)
					{
						$result['primernost'].=$prog.', ';
					}
					$result['primernost']=substr($result['primernost'],0,-2);
					$result['primernost'].=' programov ';
				}
			}
		}
		
		if(isset($primernostTmp))
			$found=array_search("dijakeVsehLetnikov",$primernostTmp);
		else
			$found=false;
		
		if(gettype($found)!="boolean")
		{
			$result['primernost'].="in dijake vseh letnikov";
		}
		else
		{
			if(isset($letnikTmp))
			{
				$result['primernost'].="in dijake ";
				if(count($letnikTmp)==4)
				{
					$result['primernost'].="vseh letnikov";
				}
				else
				{
					foreach ($letnikTmp as $let)
					{
						$result['primernost'].=$let.', ';
					}
					$result['primernost']=substr($result['primernost'],0,-2);
					$result['primernost'].=' letnikov';
				}
			}
		}
		
		if($result['primernost']=="")
		{
			$result['primernost']="/";
		}
		
		if($_POST['primernostDrugo']!="")
		{
			$result['primernost'].=", drugo: ".$_POST['primernostDrugo'];
		}
		
		if(isset($_POST['razvoj']))
		{
			$razvojTmp=$_POST['razvoj'];
			if(empty($razvojTmp))
			{
				$result['razvoj']="/";
			}
			else
			{
				$result['razvoj']="";
				
				$n=count($razvojTmp);
				for($i=0 ; $i<$n ; $i++)
				{
					$result['razvoj'].=$razvojTmp[$i].', ';
				}
			}
			
			$result['razvoj']=substr($result['razvoj'],0,-2);
		}
		
		if(isset($_POST['pomembneOpombe']))
		{
			$result['pomembneOpombe']=$_POST['pomembneOpombe'];
		}
		
		return $result;
	}
	echo '<br><br><br>';
	$data=parse(); // V tej spremenjivki so sparsani podatki
	
	function zapisi($data) // Zapise v bazo
	{
		$returnString="";

		$conn = mysqli_connect('localhost', 'root', '', 'dejavnosti'); // Povezava z bazo

		if (!$conn) {
			$returnString="Connection failed: " . mysqli_connect_error(); // če ne uspe
		}
		else
		{
			// Noben ne zna uporabljat trojnih narekovajov
			$na = $data['naslov'];
			$me = $data['mentorji'];
			$naS = $data['nacinSrecanja'];
			$go = $data['govorilneUre'];
			$eP = $data['ePosta'];
			$te = $data['telefon'];
			$vp = $data['vpisDrugo'];
			$ob = $data['oblike'];
			$pr = $data['primernost'];
			$ra = $data['razvoj'];
			$po = $data['pomembneOpombe'];

			// SQL querry
			$sql = "INSERT INTO dejavnost (naslovD, MentorjiD, steviloSrecanjD, govUreD, mailD, telefonD, DrugoD, OrgOblikaD, PrimernostD, NadarjenostD, OpombeD)
			VALUES ('$na', '$me', '$naS', '$go', '$eP', '$te', '$vp', '$ob', '$pr', '$ra', '$po')";

			if (mysqli_query($conn, $sql)) {
				$returnString = "Dogodek uspešno dodan!"; // Če se izvede pravlino
			} else {
				$returnString = "Error: " . $sql . "<br>" . mysqli_error($conn); // Če se ne
			}

			mysqli_close($conn); // Zapre povezavo
		}
	
		return $returnString;
	}
	
	$result = zapisi($data);
	print_r($data);
	
	echo '<body><h1><b><center>'.$result.'</center></b></h1></body>';
?>
