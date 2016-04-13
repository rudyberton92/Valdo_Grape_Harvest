<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Viticoltori - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina amministrativa dei viticoltori presenti nel sito Valdo Grape Harvest"/>
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
							echo "<p>Sei loggato come:<span id=\"idUt\"> ".$_SESSION["nome"]." ".$_SESSION["cognome"]."</span></p>";
						?> 
						 <a class="move" href="../logout.php">Esci</a> 
					</div>
					<h1 id="titolo"> Valdo <span xml:lang="en"> Grape Harvest </span> </h1>
					
				</div>
				
				<div id="path">
					<p> Ti trovi in: <span class="current_link"> Viticoltori </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul>					
					<li> Viticoltori
						<ul>
							<li> &gt;  <a href="a_operai.php"> Operai </a> </li>
						</ul>
					</li>
					<li> <a href="a_aziendeVinicole.php"> Aziende vinicole </a>
						<ul>
							<li> &gt;  <a href="a_soci.php"> Soci delle cantine sociali </a> </li>
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
					echo "<form class=\"styleform\" action=\"vit_INDEL.php?inserisci\" method=\"post\">";
						echo "<fieldset>";
							echo "<legend> Inserimento nuovo viticoltore </legend>";
							echo "<div>";
								echo "<label for=\"nome\"> Nome: </label>";
								echo "<input type=\"text\" id=\"nome\" name=\"nm\" maxlength=\"20\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"cognome\"> Cognome: </label>";
								echo "<input type=\"text\" id=\"cognome\" name=\"cgnm\" maxlength=\"20\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"partitaIVA\"> Partita IVA: </label>";
								echo "<input type=\"text\" id=\"partitaIVA\" name=\"piva\" maxlength=\"11\"/> <span> * immettere 11 caratteri </span>";
							echo "</div>";
							echo "<div>";
								echo "<label  for=\"data\">Data di nascita (gg/mm/aaaa): </label>";
								
										echo "<input class=\"ggmm\" type=\"text\" name=\"gg\" id=\"data\" maxlength=\"2\"/>";
										echo " / ";
										echo "<input class=\"ggmm\" type=\"text\" name=\"mm\" id=\"data\" maxlength=\"2\"/>";
										echo " / ";										
										echo "<input class=\"anno\" type=\"text\" name=\"aa\" id=\"data\" maxlength=\"4\"/>";
							
							echo "</div>";
							echo "<div>";
								echo "<label for=\"indirizzo\"> Indirizzo: </label>";
								echo "<input type=\"text\" id=\"indirizzo\" name=\"ind\" maxlength=\"30\"/>, Valdobbiadene";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"ettari\"> Ettari in possesso: </label>";
								echo "<input class=\"campopiccolo\" type=\"text\" id=\"ettari\" name=\"ett\" maxlength=\"8\"> </input>  mq";
							echo "</div>";
						
							echo "<div>";
								echo "<label for=\"password\"> Password iniziale d'accesso: </label>";
								echo "<input type=\"text\" id=\"password\" name=\"pw\" maxlength=\"10\"/> <span> * la password deve contenere da 6 a 10 caratteri</span> ";
							echo "</div>";
							echo "<div>";
								echo "<input class=\"submit\" type=\"submit\" name=\"inserimento\" value=\"Inserisci\"/>";
							echo "</div>";
						echo "</fieldset>";
					echo "</form>";
			
					
					
					echo "<h2 class=\"titolo2\"> Elenco dei viticoltori in attività: </h2>";
					
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
							echo "<dl >";
								echo "<dt><strong>".$vit['nome']." ".$vit['cognome']."</strong></dt>";
								
								echo "<dd> Partita IVA: ".$vit['partitaIVA']."</dd>";
								echo "<dd> Data di nascita: ".data_it($vit['dataNascita'])."<a class=\"move\" href=\"vit_INDEL.php?elimina=".$vit["partitaIVA"]."\">Elimina</a></dd>";
								echo "<dd> Indirizzo: ".$vit['indirizzo'].", Valdobbiadene</dd>";
								echo "<dd> Ettari in possesso: ".$vit['ettari']." mq</dd>";
							$vit= mysql_fetch_assoc($viticoltori);
							echo "</dl>";
							echo "<a class=\"tornaSu\" href=\"a_viticoltori.php\">Torna su</a>";
							echo "</div>";
							
							}
						
						}	
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