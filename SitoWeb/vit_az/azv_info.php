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
									<span id=\"idUt\"> ".$_SESSION["nomeAz"]."</span></p>";
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
							<li> &gt;  <a href="va_operai.php"> Operai </a> </li>
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
							FROM AziendaVinicola
							WHERE partitaIVA='".$_SESSION["username"]."'";
				
					$datipersonali= mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
					$dati=mysql_fetch_assoc($datipersonali);
					
					$query1="SELECT COUNT(*) as dip
							FROM Dipendente
							WHERE aziendaVinicola='".$_SESSION["username"]."'";
				
					$numeroDip= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$NDip=mysql_fetch_assoc($numeroDip);
					
					
					$query2="SELECT COUNT(*) AS numero
							FROM ContrattoDiVendita
							WHERE aziendaVinicola='".$_SESSION["username"]."'";
					
					$numeroContr= mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$numC=mysql_fetch_assoc($numeroContr);
					
					$query3="SELECT SUM(quintaliUva) AS quintali
							FROM ContrattoDiVendita cdv
							WHERE cdv.aziendaVinicola='".$_SESSION["username"]."'";
							
					$quintaliUva= mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
					$Quva=mysql_fetch_assoc($quintaliUva);

					$query4="SELECT SUM(b.saldo) AS saldo
							FROM ContrattoDiVendita cdv JOIN Bonifico b ON cdv.codContratto=b.contrattoVendita
							WHERE cdv.aziendaVinicola='".$_SESSION["username"]."'";
							
					$Totsoldi= mysql_query($query4,$conn) or die("Query fallita" . mysql_error($conn));
					$Soldi=mysql_fetch_assoc($Totsoldi);
					
					$query5="SELECT COUNT(*) as numero
							FROM Socio 
							WHERE cantinaSociale='".$_SESSION["username"]."'";
							
					$numSoci= mysql_query($query5,$conn) or die("Query fallita" . mysql_error($conn));
					$nS=mysql_fetch_assoc($numSoci);
					
					
					echo "<dl  id=\"datiInfo\">";
						echo "<dt> I tuoi dati</dt>";
						echo "<dd> Nome azienda: ".$dati['nomeAz']."</dd>";
						echo "<br/>";
						if($nS["numero"]!=0) 
							{echo "<dd> Numero di soci iscritti: ".$nS["numero"]."</dd>";
							}
						echo "<dd> Numero di dipendenti: ".$NDip["dip"]."</dd>";
						echo "<dd> Contratti stipulati: ".$numC["numero"]."</dd>";
						echo "<dd> Uva acquistata: ".$Quva["quintali"]." quintali</dd>";
						echo "<dd> Saldo uscite attuale: ".$Soldi["saldo"]." &euro; </dd>";
						echo "<br/>";
						echo "<dd> Username: ".$dati['partitaIVA']."</dd>";
						echo "<dd> Password: ".$dati['password']."</dd>";
					echo "</dl>";
					
					echo "<div class=\"spaziomex\">";
					if(isset($_REQUEST['msg'])) 
								{echo "<div class=\"messaggio\"> <p>".$_REQUEST['msg']."</p></div>";
								}
					echo "</div>";
					
					
						echo "<form class=\"styleform\" action=\"../cambiopw.php?user=aziendavinicola\" method=\"post\">";
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