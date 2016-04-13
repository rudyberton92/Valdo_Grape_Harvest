<?php
	include("connDB.php");
	if(isset($_POST["usn"]) and isset($_POST["pw"]))
		{$query="SELECT * 
				FROM AdminWeb 
				WHERE username = '".$_POST['usn']."'";
		
		$login = mysql_query($query, $conn) or die("Query fallita". mysql_error($conn));
		
		if ($row = mysql_fetch_assoc($login))
			{if($row['password'] and $row['password']==$_POST['pw'])
				{session_start();
				$_SESSION['nome']=$row['nome'];
				$_SESSION['cognome']=$row['cognome'];
				$_SESSION['username']=$row['username'];
				header("location: admin/admin_info.php");
				}
			
			else 
				{header("location: accesso.php?msg=password errata");
				}
			}
		else
			{$query1="SELECT *
					FROM Viticoltore
					WHERE partitaIVA ='".$_POST['usn']."'";
				
			$login = mysql_query($query1, $conn) or die("Query fallita". mysql_error($conn));
			if ($row = mysql_fetch_assoc($login))
				{if($row['password'] and $row['password']==$_POST['pw'])
					{$tipoUser="viticoltore";
					session_start();
					$_SESSION['nome']=$row['nome'];
					$_SESSION['cognome']=$row['cognome'];
					$_SESSION['username']=$row['partitaIVA'];
					$_SESSION['tipoUser']=$tipoUser;
					header("location: vit_az/vit_info.php");
					}
			
				else 
					{header("location: accesso.php?msg=password errata");
					}
				}
			else 
				{$query2="SELECT *
					FROM AziendaVinicola
					WHERE partitaIVA ='".$_POST['usn']."'";
				
				$login = mysql_query($query2, $conn) or die("Query fallita". mysql_error($conn));
				if ($row = mysql_fetch_assoc($login))
					{if($row['password'] and $row['password']==$_POST['pw'])
						{$tipoUser="aziendavinicola";
						session_start();
						$_SESSION['nomeAz']=$row['nomeAz'];
						$_SESSION['username']=$row['partitaIVA'];
						$_SESSION['tipoUser']=$tipoUser;
						header("location: vit_az/azv_info.php");
						}
				
					else 
						{header("location: accesso.php?msg=password errata");
						}
					}
				else
					header("location: accesso.php?msg=reinserire username e password");
			
				}
				
			}
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Area riservata - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina per l'amministrazione del sito Valdo Grape Harvest"/>
		<meta name="keywords" content="Valdo, Valdobbiadene, grape, harvest, vendemmia, viticoltori, aziende vinicole"/>
		<meta name="language" content="italian"/>
		<meta name="author" content="Berton" />
		
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>

	<body>	
		<div class="container">
			<div class="sfondoSup">
				<div class="title">
					<img id="logo" alt="immagine del logo" src="immagini/logo.png"/>
					<h1> Valdo <span xml:lang="en"> Grape Harvest </span> </h1>
				</div>
				
				<div id="path">
					<p> Ti trovi in: <span class="current_link" > Area riservata </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul> 
					<li> <a href="home.html" xml:lang="en"> Home </a> </li>
					<li> <a href="viticoltori.php">  Viticoltori </a> </li>
					<li> <a href="aziendeVinicole.php"> Aziende vinicole </a>
						<ul>
							<li> &gt; <a href="aziendeVinicole.php#AZP"> Aziende private</a></li>
							<li> &gt;  <a href="aziendeVinicole.php#CS"> Cantine sociali</a></li>
							
						</ul>
					</li>
					
					<li> Area riservata</li>
				</ul>
			</div>
			
			<div class="content">
				<h2> Area del sito riservata! </h2>
				<h3 id="avviso"> Se non sei autorizzato ad accedervi torna alla <a class="move" href="home.html" xml:lang="en"><strong>Home</strong></a>!</h3>
				<?php 
				
				echo "<div class=\"spaziomex\">";
				if(isset($_REQUEST['msg'])) 
					{echo "<div class=\"messaggio\"> <p>Accesso negato: ".$_REQUEST['msg']."</p></div>";
					}
				echo  "</div>";	
				?>
				<div id="zonaAccesso">
					
					<form id="accesso" action="accesso.php" method="post">
						<fieldset id="togliRiquadro">
							<legend> Dati per l'accesso </legend>
							<div>
								<label for="username"> Username: </label>
								<input type="text" id="username" name="usn" maxlength="11"/>
							</div>
							<div> 
								<label for="password"> Password: </label>
								<input type="password" id="password" name="pw" maxlength="10"/>
							</div>
							<div>
								<input id="invio" type="submit" value="Accedi"/>
							</div>
						</fieldset>
					</form>
					<span id="keyIm"> </span>
					
					<div class="clear-float"></div>
				</div>
			
			</div>
			
			<div class="footer">
				<div id="collaborazione">
					<div class="patrocinio"> 
						<p> In collaborazione con:</p>
						<img id="logoComune" alt="stemma del comune di Valdobbiadene" src="immagini/stemma.png"/>
						<p> Comune di Valdobbiadene</p>	
					</div>	
				</div>
				<p> &copy; Valdo <span xml:lang="en">Grape Harvest</span> - Tutti i diritti sono riservati. </p>
				<p> <span xml:lang="en">E-mail</span>: <strong>valdograpeharvest@gmail.com </strong></p>
				<img class="val" alt="validazione xhtml certificata" src="immagini/xhtml.png"/>
				<img class="val" alt="validazione css certificata" src="immagini/css.gif"/> 
			</div>
	
		</div>
	</body>
</html>