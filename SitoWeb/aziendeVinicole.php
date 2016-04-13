<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Aziende Vinicole - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista di aziende vinicole"/>
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
					<p> Ti trovi in: <span class="current_link" > Aziende vinicole </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul> 
					<li> <a href="home.html" xml:lang="en"> Home </a> </li>
					<li> <a href="viticoltori.php">  Viticoltori </a> </li>
					<li>  Aziende vinicole 
						<ul>
							<li> &gt;  Aziende private</li>
							<li> &gt;  Cantine sociali</li>
							
						</ul>
					</li>
					
					<li > <a href="accesso.php"> Area riservata </a> </li>
				</ul>
			</div>
			
			<div class="content">
				<?php 
					include("connDB.php");
					include("functions.php");
					
					echo "<h2> Elenco delle aziende vinicole: </h2>";
					
					echo "<div id=\"AZP\" class=\"areaDati\">";
					echo "<h3> <strong>Aziende Private </strong></h3>";
						
						$query="SELECT *
								FROM AziendaPrivata azp JOIN AziendaVinicola az ON az.partitaIVA=azp.aziendaVinicola
								ORDER BY az.nomeAz";
						
						$aziendePrivate = mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn)); //esecuzione della query
						$num_righe=mysql_num_rows($aziendePrivate);
						
						$private = mysql_fetch_assoc($aziendePrivate);
						
						
						if($num_righe==0)
							{echo "<p class=\"nessuno\"> Non è presente alcuna azienda privata </p>";
							}
						else
							{echo "<div>";
							while($private)
								{
								echo "<dl class=\"listaAZV\">";
									echo "<dt><strong>".$private['nomeAz']."</strong></dt>";
									echo "<dd> Partita IVA: ".$private['partitaIVA']."</dd>";
									echo "<dd> Imprenditore: ".$private['nomeImpr']." ".$private['cognomeImpr']."</dd>";
									echo "<dd> Data di nascita: ".data_it($private['dataNascita'])."</dd>";
									echo "<dd> Indirizzo: ".$private['indirizzo'].", Valdobbiadene</dd>";
									if($private['email']!=NULL)
										{echo "<dd> Email: ".$private['email']."</dd>";}
									echo "<dd> Telefono: ".$private['telefono']."</dd>";
									
								$private = mysql_fetch_assoc($aziendePrivate);
							
								echo "</dl>";
								
								}
							echo "<a class=\"tornaSu\" href=\"aziendeVinicole.php\">Torna su</a>";
							echo "</div>";
							}	
					echo "</div>";
					
					
					
					echo "<div id=\"CS\" class=\"areaDati\">";
						echo "<h3> <strong>Cantine Sociali </strong></h3>";
						$query="SELECT *
								FROM CantinaSociale cs JOIN AziendaVinicola az ON az.partitaIVA=cs.aziendaVinicola
								ORDER BY az.nomeAz";
						

						$cantineSociali = mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn)); //esecuzione della query
						$num_righe=mysql_num_rows($cantineSociali);
						
						$cantine = mysql_fetch_assoc($cantineSociali);
						
						
						if($num_righe==0)
							{echo "<p class=\"nessuno\"> Non è presente alcuna cantina sociale </p>";
							}
						else
							{echo "<div>";
							while($cantine)
								{echo "<dl class=\"listaAZV\">";
							
									echo "<dt><strong>".$cantine['nomeAz']."</strong></dt>";
										echo "<dd> Partita IVA: ".$cantine['partitaIVA']."</dd>";
										echo "<dd> Indirizzo: ".$cantine['indirizzo'].", Valdobbiadene</dd>";
										if($cantine['email'] !=NULL)
											{echo "<dd> Email: ".$cantine['email']."</dd>";}
										echo "<dd> Telefono: ".$cantine['telefono']."</dd>";
										echo "<dd> Presidente: ".$cantine['nomePres']." ".$cantine['cognomePres']."</dd>";
										echo "<dd> Anno di fondazione: ".$cantine['annoFond']."</dd>";
										
								$cantine = mysql_fetch_assoc($cantineSociali);
							
								echo "</dl>";
								
								}
							echo "<a class=\"tornaSu\" href=\"aziendeVinicole.php\">Torna su</a>";
							echo "</div>";
							
							}
												
					echo "</div>";
					
					
					
					
				?>
				
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