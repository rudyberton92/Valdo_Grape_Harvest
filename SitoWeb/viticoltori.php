<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Viticoltori - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista di viticoltori"/>
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
					<p> Ti trovi in: <span class="current_link" > Viticoltori </span> </p>
				</div>
			</div>
			
			
			<div class="nav">
				<ul> 
					<li> <a xml:lang="en" href="home.html"> Home </a> </li>
					<li>  Viticoltori </li>
					<li> <a href="aziendeVinicole.php"> Aziende vinicole </a>
						<ul>
							<li> &gt; <a href="aziendeVinicole.php#AZP"> Aziende private</a></li>
							<li> &gt;  <a href="aziendeVinicole.php#CS"> Cantine sociali</a></li>
				
						</ul>
					</li>
					<li> <a href="accesso.php"> Area riservata </a> </li>
				</ul>
			</div>
			
			<div class="content">
				<?php 
					include("connDB.php");
					include("functions.php");
					
					echo "<h2> Elenco dei viticoltori in attività: </h2>";
					
					$query="SELECT *
							FROM Viticoltore
							ORDER BY cognome,nome";
					
					$viticoltori = mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn)); //esecuzione della query
					$num_righe=mysql_num_rows($viticoltori);
					
					$vit = mysql_fetch_assoc($viticoltori);
	
										
					if($num_righe==0)
						{echo "<p class=\"nessuno\"> Non sono presenti viticoltori </p>";
						}
					else
						{
						while($vit)
							{echo "<div class=\"listaV\">";
							echo "<dl>";
								echo "<dt><strong>".$vit['nome']." ".$vit['cognome']."</strong></dt>";
								echo "<dd> Partita IVA: ".$vit['partitaIVA']."</dd>";
								echo "<dd> Data di nascita: ".data_it($vit['dataNascita'])."</dd>";
								echo "<dd> Indirizzo: ".$vit['indirizzo'].", Valdobbiadene</dd>";
								echo "<dd> Ettari in possesso: ".$vit['ettari']." mq</dd>";
								
							$vit= mysql_fetch_assoc($viticoltori);
							
							
							echo "</dl>";
							echo "<a class=\"tornaSu\" href=\"viticoltori.php\">Torna su</a>";
							echo "</div>";
							}
					
						}	
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