<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Operai - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina amministrativa degli operai presenti nel sito Valdo Grape Harvest"/>
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
					<p> Ti trovi in:<a href="a_viticoltori.php"> Viticoltori </a> &gt;&gt; <span class="current_link" > Operai </span> </p>
				</div>
			</div>
			
			<div class="nav">
				<ul>					
					<li> <a href="a_viticoltori.php"> Viticoltori </a>
						<ul>
							<li> &gt; Operai </li>
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
					
					$query="SELECT	nome, cognome
							FROM Viticoltore
							ORDER BY cognome";
						
					$viticoltori= mysql_query($query, $conn) or die("Query fallita". mysql_error($conn));
					$vit = mysql_fetch_assoc($viticoltori);
					
					echo "<div class=\"spaziomex\">";
						if(isset($_REQUEST['msg'])) 
						{echo "<div class=\"messaggio\"> <p>".$_REQUEST['msg']."</p></div>";
						}
					echo  "</div>";
					
					//inserimento nuovo operaio
					echo "<form class=\"styleform\" action=\"op_INDEL.php?inserisci\" method=\"post\">";
						echo "<fieldset>";
							echo "<legend> Inserimento nuovo operaio </legend>";
							echo "<div>";
								echo "<label for=\"nome\"> Nome: </label>";
								echo "<input type=\"text\" id=\"nome\" name=\"nm\" maxlength=\"20\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"cognome\"> Cognome: </label>";
								echo "<input type=\"text\" id=\"cognome\" name=\"cgnm\" maxlength=\"20\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"codicefiscale\"> Codice fiscale: </label>";
								echo "<input type=\"text\" id=\"codicefiscale\" name=\"CF\" maxlength=\"16\"/><span> * immettere 16 caratteri </span>  ";
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
								echo "<label for=\"operaioDi\"> Operaio di: </label>";
								echo "<select name=\"OpDi\" id=\"operaioDi\">";
								echo "<option> </option>";
								while($vit)
									{echo "<option>".$vit['nome']." ".$vit['cognome']."</option>";
									$vit = mysql_fetch_assoc($viticoltori);
									}
								echo "</select>";
							echo "</div>";
							echo "<div>";
								echo "<input  class=\"submit\" type=\"submit\" value=\"Inserisci\"/>";
							echo "</div>";
						echo "</fieldset>";
					echo "</form>";
					
					
					

					
					echo "<h2 class=\"titolo2\"> Elenco degli operai alle dipendenze dei viticoltori: </h2>";
					
					$query1="SELECT o.*, v.nome as vitnome, v.cognome as vitcognome
							FROM Operaio o join Viticoltore v on o.viticoltore=v.partitaIVA
							ORDER BY v.cognome,v.nome";
					
					$query2="SELECT partitaIVA, nome, cognome
							FROM Viticoltore
							ORDER BY cognome,nome";
							
					$operai = mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn)); //esecuzione della query
					$viticoltori=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$num_righe=mysql_num_rows($operai);
					
					$arrayVit=mysql_fetch_assoc($viticoltori);
					$arrayOp=mysql_fetch_assoc($operai);
					
					
				
					if($num_righe==0)
						{echo "<p class=\"nessuno\"> Non sono presenti operai </p>";
						}
					else
						{while($arrayVit['partitaIVA'])
							{echo "<div class=\"areaDati\">";
								echo "<h3 > Operai di <strong>".$arrayVit['nome']." ".$arrayVit['cognome']." </strong>:</h3>";
								echo "<div class=\"riquadro\">";
								while($arrayOp['viticoltore']==$arrayVit['partitaIVA'])
									{
									echo "<dl class=\"listaO\">";
									echo "<dt><strong>".$arrayOp['nome']." ".$arrayOp['cognome']."</strong></dt>";
							
									echo "<dd> Codice fiscale:".$arrayOp['codFiscale']."<a class=\"move\" href=\"op_INDEL.php?elimina=".$arrayOp["codFiscale"]."\">Elimina</a></dd>";
									echo "<dd> Data di nascita:".data_it($arrayOp['dataNascita'])."</dd>";
									echo "<dd> Indirizzo:".$arrayOp['indirizzo']."</dd>";
									$arrayOp=mysql_fetch_assoc($operai);
									echo "</dl>";
									
									}
								$arrayVit=mysql_fetch_assoc($viticoltori);
								echo "<a class=\"tornaSu\" href=\"a_operai.php\">Torna su</a>";
								echo "</div>";
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