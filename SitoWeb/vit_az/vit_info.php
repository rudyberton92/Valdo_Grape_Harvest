<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Informazioni personali - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina con le informazioni sull'amministratore del sito Valdo Grape Harvest"/>
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
							echo "<p>Sei loggato come:
									<span id=\"idUt\"> ".$_SESSION["nome"]." ".$_SESSION["cognome"]."</span></p>";
						?> 
						 <a class="move" href="../logout.php">Esci</a> 
					</div>
					<h1 id="titolo"> Valdo <span xml:lang="en"> Grape Harvest </span> </h1>
					
				</div>
				
				<div id="path">
					<p> Ti trovi in: <span class="current_link">  Informazioni personali </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul> 
					<li> <a href="va_viticoltori.php">  Viticoltori </a> 
						<ul>
							<li> &gt;  <a href="va_operai.php?"> Operai </a> </li>
						</ul>
					</li>
					<li> <a href="va_aziendeVinicole.php"> Aziende vinicole </a>
						<ul>
							<li> &gt; <a href="va_aziendeVinicole.php#AZP"> Aziende private</a></li>
							<li> &gt;  <a href="va_aziendeVinicole.php#CS"> Cantine sociali</a></li>
							<li>	
								<ul>
									<li> &gt;&gt;  <a href="va_soci.php"> Soci ordinari </a> </li>
								</ul>
							</li>
							
							<li> &gt;  <a href="va_dipendenti.php"> Dipendenti </a> </li>
						</ul>
					</li>
					<li> <a href="va_contratti.php"> Contratti di vendita </a>
						<ul>
							<li> &gt;  <a href="va_ddt.php"> Documenti di trasporto </a> </li>
							<li> &gt;  <a href="va_bonifici.php"> Pagamenti </a> </li>
						</ul>
					</li>
					<li> Informazioni personali </li>
				</ul> 
			</div>
			
			<div class="content">
				<h2> Informazioni personali </h2>
				<?php
					include("../connDB.php");
					include("../functions.php");
					
				
					$query="SELECT *
							FROM Viticoltore
							WHERE partitaIVA='".$_SESSION["username"]."'";
				
					$datipersonali= mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
					$dati=mysql_fetch_assoc($datipersonali);
					
					$query1="SELECT COUNT(*) AS numero
							FROM ContrattoDiVendita
							WHERE viticoltore='".$_SESSION["username"]."'";
					
					$numeroContr= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$numC=mysql_fetch_assoc($numeroContr);
					
					$query2="SELECT SUM(quintaliUva) AS quintali
							FROM ContrattoDiVendita cdv
							WHERE cdv.viticoltore='".$_SESSION["username"]."'";
							
					$quintaliUva= mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$Quva=mysql_fetch_assoc($quintaliUva);		
					
					$query3="SELECT COUNT(*) AS operai
							FROM Operaio
							WHERE viticoltore='".$_SESSION["username"]."'";
						
					$numeroOperai= mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
					$NOp=mysql_fetch_assoc($numeroOperai);	
					
					$query4="SELECT SUM(b.saldo) AS saldo
							FROM ContrattoDiVendita cdv JOIN Bonifico b ON cdv.codContratto=b.contrattoVendita
							WHERE cdv.viticoltore='".$_SESSION["username"]."'";
							
					$Totsoldi= mysql_query($query4,$conn) or die("Query fallita" . mysql_error($conn));
					$Soldi=mysql_fetch_assoc($Totsoldi);
					
					$query5="SELECT azv.nomeAz
							FROM Socio s JOIN AziendaVinicola azv ON s.cantinaSociale=azv.partitaIVA
							WHERE s.viticoltore='".$_SESSION["username"]."'";
							
					$Cantine= mysql_query($query5,$conn) or die("Query fallita" . mysql_error($conn));
					$CS=mysql_fetch_assoc($Cantine);
					
					echo "<dl  id=\"datiInfo\">";
						echo "<dt> I tuoi dati</dt>";
						echo "<dd> Nome: ".$dati["nome"]."</dd>";
						echo "<dd> Cognome: ".$dati["cognome"]."</dd>";
						echo "<br/>";
						if($CS!=NULL) 
							{echo "<dd> Socio presso le cantine: ";
							while($CS)
								{echo "<dd class=\"elencoSocioDi\">".$CS["nomeAz"]."</dd>";
								$CS=mysql_fetch_assoc($Cantine);
								}
							echo "</dd>";
							}
						echo "<dd> Numero di operaio : ".$NOp["operai"]."</dd>";
						echo "<dd> Contratti stipulati: ".$numC["numero"]."</dd>";
						echo "<dd> Uva venduta: ".$Quva["quintali"]." quintali </dd>";
						echo "<dd> Guadagno attuale: ".$Soldi["saldo"]." &euro; </dd>";
						echo "<br/>";
						echo "<dd> Username: ".$dati['partitaIVA']."</dd>";
						echo "<dd> Password: ".$dati['password']."</dd>";
					echo "</dl>";
					
					echo "<div class=\"spaziomex\">";
					if(isset($_REQUEST['msg'])) 
								{echo "<div class=\"messaggio\"> <p>".$_REQUEST['msg']."</p></div>";
								}
					echo "</div>";
					
					
						echo "<form class=\"styleform\" action=\"../cambiopw.php?user=viticoltore\" method=\"post\">";
							echo "<fieldset >";
							echo "<legend> Modifica Password </legend>";
							echo "<input type=\"hidden\" name=\"usnm\" value=\"".$dati['partitaIVA']."\"/>";
							echo "<div>";
								echo "<label for=\"password\"> Nuova password: </label>";
								echo "<input type=\"password\" id=\"password\" name=\"pw\" maxlength=\"10\"/> <span> * la nuova password deve contenere da 6 a 10 caratteri</span>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"confpassword\"> Conferma password: </label>";
								echo "<input type=\"password\" id=\"confpassword\" name=\"cnpw\"  maxlength=\"10\"/>";
							echo "</div>";
							echo "<div>";
								echo "<input class=\"submit\" type=\"submit\" value=\"Modifica\"/>";
							echo "</div>";
							echo "</fieldset>";
						echo "</form>";
					
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