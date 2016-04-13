<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Aziende Vinicole - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina amministrativa delle aziende vinicole presenti nel sito Valdo Grape Harvest"/>
		<meta name="keywords" content="Valdo, Valdobbiadene, grape, harvest, vendemmia, viticoltori, aziende vinicole"/>
		<meta name="language" content="italian"/>
		<meta name="author" content="Berton" />
		
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
	</head>

	<body>	
		<div class="container">
			<div class="sfondoSup">
				<div class="title">
					<img id="logo" alt="immagine del logo" src="../immagini/logo.png"/>
					<div class="loginInfo">
						 <?php
							session_start();
							echo "<p>Sei loggato come: <span id=\"idUt\"> ".$_SESSION["nome"]." ".$_SESSION["cognome"]."</span></p>";
						?> 
						 <a class="move" href="../logout.php">Esci</a> 
					</div>
					<h1 id="titolo"> Valdo <span xml:lang="en"> Grape Harvest </span> </h1>
					
				</div>
				
				<div id="path">
					<p> Ti trovi in: <span class="current_link"> Aziende vinicole </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul>					
					<li> <a href="a_viticoltori.php"> Viticoltori </a>
						<ul>
							<li> &gt;  <a href="a_operai.php"> Operai </a> </li>
						</ul>
					</li>
					<li> Aziende Vinicole 
						<ul>
							<li> &gt; <a href="a_soci.php"> Soci delle cantine sociali </a> </li>
							<li> &gt;  <a href="a_dipendenti.php"> Dipendenti </a> </li>
						</ul>
					</li>
					<li> <a href="a_contratti.php"> Contratti di vendita </a>
						<ul>
							<li> &gt;  <a href="a_ddt.php"> Documenti di trasporto </a> </li>
							<li> &gt;  <a href="a_bonifici.php"> Pagamenti </a> </li>
						</ul>
					</li>
					<li> <a href="admin_info.php">  Informazioni personali </a></li>
				</ul> 
			</div>
			
			<div class="content">
				<?php 
					include("../connDB.php");
					include("../functions.php");
					
				
					echo "<div class=\"spaziomex\">";
						if(isset($_REQUEST['msg'])) 
						{echo "<div class=\"messaggio\"> <p>".$_REQUEST['msg']."</p></div>";
						}
					echo  "</div>";
					
					//inserimento nuovo viticoltore
					echo "<form class=\"styleform\" action=\"azv_INDEL.php?inserisci\" method=\"post\">";
						echo "<fieldset>";
							echo "<legend> Inserimento nuova azienda vinicola </legend>";
							echo "<div>";
								echo "<label for=\"nome\"> Nome dell'azienda: </label>";
								echo "<input type=\"text\" id=\"nome\" name=\"nm\" maxlength=\"20\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"partitaIVA\"> Partita IVA: </label>";
								echo "<input type=\"text\" id=\"partitaIVA\" name=\"piva\"  maxlength=\"11\"/> <span> * immettere 11 caratteri </span>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"indirizzo\"> Indirizzo: </label>";
								echo "<input type=\"text\" id=\"indirizzo\" name=\"ind\" maxlength=\"30\"/>, Valdobbiadene";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"telefono\"> Telefono: (+39) </label>";
								echo "<input type=\"text\" id=\"telefono\" name=\"tel\"  maxlength=\"10\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"email\"> Email: </label>";
								echo "<input type=\"text\" id=\"email\" name=\"em\" maxlength=\"30\"/> <span> * opzionale </span>";
							echo "</div>";
				
							echo "<div>";
								echo "<label for=\"password\"> Password iniziale d'accesso: </label>";
								echo "<input type=\"text\" id=\"password\" name=\"pw\" maxlength=\"10\"/> <span> * la password deve contenere da 6 a 10 caratteri</span> ";
							echo "</div>";
							echo "<div>";
						
									echo "<p> Tipo di azienda: </p>";
									echo "<span class=\"opzione\">";
										echo "<label for=\"aziendaP\">Azienda privata </label>";
										echo "<input type=\"radio\" id=\"aziendaP\" name=\"tipoAzienda\" value=\"azienda_privata\" checked=\"checked\" /> ";
									echo "</span>";
									echo "<span class=\"opzione\">";
										echo "<label for=\"cantinaS\"> Cantina sociale </label>";
										echo "<input type=\"radio\" id=\"cantinaS\" name=\"tipoAzienda\" value=\"cantina_sociale\" />";
									echo "</span>";
									
							echo "</div>";							
							
							echo "<div>";
								echo "<p> Campi solo per Aziende Private </p>";
								echo "<div>";
									echo "<label for=\"nomeimpr\"> Nome dell'imprenditore: </label>";
									echo "<input type=\"text\" id=\"nomeimpr\" name=\"nmimpr\" maxlength=\"20\"/>";
								echo "</div>";
								echo "<div>";
									echo "<label for=\"cognomeimpr\"> Cognome dell'imprenditore: </label>";
									echo "<input type=\"text\" id=\"cognomeimpr\" name=\"cgnmimpr\" maxlength=\"20\"/>";
								echo "</div>";
							echo "<div>";
								echo "<label  for=\"data\">Data di nascita (gg/mm/aaaa): </label>";
								
										echo "<input class=\"ggmm\" type=\"text\" name=\"gg\" id=\"data\" maxlength=\"2\"/>";
										echo " / ";
										echo "<input class=\"ggmm\" type=\"text\" name=\"mm\" id=\"data\" maxlength=\"2\"/>";
										echo " / ";										
										echo "<input  class=\"anno\" type=\"text\" name=\"aa\" id=\"data\" maxlength=\"4\"/>";
							
							echo "</div>";
								
							echo "</div>";
							echo "<div>";
								echo "<p> Campi solo per Cantine Sociali </p>";
								echo "<div>";
									echo "<label for=\"nomepr\"> Nome del presidente: </label>";
									echo "<input type=\"text\" id=\"nomepr\" name=\"nmpr\" maxlength=\"20\"/>";
								echo "</div>";
								echo "<div>";
									echo "<label for=\"cognomepre\"> Cognome del presidente: </label>";
									echo "<input type=\"text\" id=\"cognomepre\" name=\"cgnmpr\" maxlength=\"20\"/>";
								echo "</div>";
								echo "<div>";
									echo "<label for=\"annofond\"> Anno di fondazione </label>";
									echo "<input class=\"anno\"  type=\"text\"  id=\"annofond\" name=\"aafn\" maxlength=\"4\"/>";
								echo "</div>";
							echo "</div>";
							echo "<div>";
								echo "<input class=\"submit\" type=\"submit\" value=\"Inserisci\"/>";
							echo "</div>";
						echo "</fieldset>";
					echo "</form>";
	
					
					echo "<h2 class=\"titolo2\"> Elenco delle aziende vinicole: </h2>";
					$cont=0;
					$cont2=50;
					
					echo "<div class=\"areaDati\">";
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
									echo "<dd> Data di nascita: ".data_it($private['dataNascita'])."<a class=\"move\" href=\"azv_INDEL.php?elimina=".$private["partitaIVA"]."\">Elimina</a></dd>";
									echo "<dd> Indirizzo: ".$private['indirizzo'].", Valdobbiadene</dd>";
									if($private['email']!=NULL)
										{echo "<dd> Email: ".$private['email']."</dd>";}
									echo "<dd> Telefono: ".$private['telefono']."</dd>";
									$private = mysql_fetch_assoc($aziendePrivate);
								$cont2=$cont2+1;
								echo "</dl>";
								
								}
							echo "<a class=\"tornaSu\" href=\"a_aziendeVinicole.php\">Torna su</a>";
							echo "</div>";
							}	
					echo "</div>";
					
					
					
					
					echo "<div class=\"areaDati\">";
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
							
									echo "<dt><strong>".$cantine['nomeAz']."</strong> </dt>";
									
										echo "<dd> Partita IVA: ".$cantine['partitaIVA']."</dd>";
										echo "<dd> Indirizzo: ".$cantine['indirizzo'].", Valdobbiadene</dd>";
										if($cantine['email'] !=NULL)
											{echo "<dd> Email: ".$cantine['email']."</dd>";}
										echo "<dd> Telefono: ".$cantine['telefono']."<a class=\"move\" href=\"azv_INDEL.php?elimina=".$cantine["partitaIVA"]."\">Elimina</a></dd>";
										echo "<dd> Presidente: ".$cantine['nomePres']." ".$cantine['cognomePres']."</dd>";
										echo "<dd> Anno di fondazione: ".$cantine['annoFond']."</dd>";
										
								$cantine = mysql_fetch_assoc($cantineSociali);
								$cont=$cont+1;
								echo "</dl>";
			
								}
							echo "<a class=\"tornaSu\" href=\"a_aziendeVinicole.php\">Torna su</a>";
							echo "</div>";
							
							}
												
					echo "</div>";
					
					
					
					
				?>
			</div>
			
			<div class="footer">
				<div id="collaborazione">
					<div class="patrocinio"> 
						<p> In collaborazione con:</p>
						<img id="logoComune" alt="stemma del comune di Valdobbiadene" src="../immagini/stemma.png"/>
						<p> Comune di Valdobbiadene</p>	
					</div>	
				</div>
				<p> &copy; Valdo <span xml:lang="en">Grape Harvest</span> - Tutti i diritti sono riservati. </p>
				<p> <span xml:lang="en">E-mail</span>: <strong>valdograpeharvest@gmail.com </strong></p>
				<img class="val" alt="validazione xhtml certificata" src="../immagini/xhtml.png"/>
				<img class="val" alt="validazione css certificata" src="../immagini/css.gif"/> 
			</div>
	
		</div>
	</body>
</html>