<?php
   session_start();
?>
<!DOCTYPE html>
<html>

<head> 
<style>
ul 
{
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
	float: right;
	color: #000000;
}
li:hover
{
	background-color: #ffff00;
}
iframe:hover
{
	transition-duration: 10s;
}
li 
{
    float: left;
	padding: 10px;
	background-color: #ffffd0;
}
</style>

<h2>
<ul style="float:left">
	<div>
		<li onclick="openPrijava();" id="prijava">  
			PRIJAVA
		</li>
	</div>
</ul>
<ul>
	<div>
		<li onclick="openUporabniki();" id="uporabniki" >  
			UPORABNIKI 
		</li>
		<li onclick="openVnos();" id="vnos" >  
			VNOS 
		</li>
		<li onclick="openPogled();" id="pogled"> 
			POGLED 
		</li>
		<li onclick="openRegister();" id="registracija"> 
			REGISTRACIJA 
		</li>
	</div>
</ul>
</h2>

</head>

<body style="background-color:#d0e0ff;" >
<div>

<iframe src="prijava.php" style="background-color:#e0f0ff; width:100%; height:1500px;"  seamless id="frame"> </iframe>

</div>

<script type="text/javascript">
	var loggedIn=-1;
	checkLogin('test',3);
	
	function checkLogin(ime, status)
	{					
		if( ime != false && ime!="")
		{
			if(status==0)
			{
				document.getElementById('frame').src='pogled.php';
			}
			else
			{
				document.getElementById('frame').src='vnos.html';
			}
			var state="";
			switch(status)
			{
				case 0: state="dijak"; break;
				case 1: state="učitelj"; break;
				case 2: state="mentor"; break;
				case 3: state="admin"; break;
			}
			document.getElementById('prijava').innerHTML="Prijavljen/-a kot "+ime+' ('+ state + ')';
			document.getElementById('registracija').innerHTML="ODJAVA";
			loggedIn=status;
		}
		else
		{
			odjava();
		}
	}
	
	function odjava()
	{
		loggedIn=-1;
		document.getElementById('frame').src='prijava.php';
		document.getElementById('prijava').innerHTML="PRIJAVA";
		document.getElementById('registracija').innerHTML="REGISTRACIJA";
		<?php session_destroy(); ?>;
	}
	
	function openRegister()
	{
		var name= document.getElementById('registracija').innerHTML;
		
		if(name=="REGISTRACIJA")
		{
			document.getElementById('frame').src='registracija.php';
		}
		else
		{
			if (confirm("Potrdi odjavljanje!") == true) 
			{
				odjava();
			}
		}
	}
	
	function openUporabniki()
	{
		if(loggedIn<2)
		{
			alert("Za pogled uporabnikov moraš biti mentor ali administrator!");
		}
		else
		{
			document.getElementById('frame').src='status.php';
		}
	}
	
	function openVnos()
	{
		if(loggedIn>=1)//1 = status mentorja??
		{
			document.getElementById('frame').src='vnos.html';
		}
		else if(loggedIn==0)
		{
			alert("Za dodajanje dogodkov moraš biti mentor ali administrator!");
		}
		else
		{
			alert("Za dodajanje dogodkov se moraš prijaviti!");
		}
	}
	
	function openPogled()
	{
		if(loggedIn==-1)
		{
			alert("Za pregled dogodkov se moraš prijaviti!");
		} 
		else
		{
			document.getElementById('frame').src='pogled.php';
		}
	}
	
	function openPrijava()
	{
		if(loggedIn==-1)
		{
			document.getElementById('frame').src='prijava.php';
		} 
	}
</script>

</body>
</html>