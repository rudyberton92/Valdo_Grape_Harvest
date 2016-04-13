<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Dipendenti - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista dei dipendenti per ogni azienda vinicola"/>
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
							if($_SESSION['tipoUser']=="viticoltore")
								{echo "<p>Sei loggato come: <span id=\"idUt\"> ".$_SESSION["nome"]." ".$_SESSION["cognome"]."</span></p>";}
							else
								{echo "<p>Sei loggato come: <span id=\"idUt\"> ".$_SESSION["nomeAz"]."</span></p>";}
						?> 
						 <a class="move" href="../logout.php">Esci</a> 
					</div>
					<h1 id="titolo"> Valdo <span xml:lang="en"> Grape Harvest </span> </h1>
				</div>
				
				<div id="path">
					<p> Ti trovi in: <a href="va_aziendeVinicole.php"> Aziende vinicole </a> &gt;&gt; <span class="current_link" > Dipendenti </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul> 
					<li>  <a href="va_viticoltori.php"> Viticoltori </a>
						<ul>
							<li> &gt; <a href="va_operai.php"> Operai </a> </li>
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
							
							<li> &gt;  Dipendenti  </li>
						</ul>
					</li>
					<li> <a href="va_contratti.php"> Contratti di vendita </a>
						<ul>
							<li> &gt;  <a href="va_ddt.php"> Documenti di trasporto </a> </li>
							<li> &gt;  <a href="va_bonifici.php"> Pagamenti </a> </li>
						</ul>
					</li>
					<?php
						if($_SESSION['tipoUser']=="viticoltore")
							{echo "<li> <a href=\"vit_info.php\"> Informazioni personali </a> </li>";}
						else
							{echo "<li> <a href=\"azv_info.php\"> Informazioni personali </a> </li>";}
					?>
				</ul>
			</div>
			
			<div class="content">
				<?php 
					include("../connDB.php");
					include("../functions.php");
					
					echo "<h2> Elenco dei dipendenti che lavorano presso le aziende vinicole: </h2>";
					
					$query1="SELECT partitaIVA, nomeAz
							FROM AziendaVinicola azV, CantinaSociale cs
							WHERE azV.partitaIVA=cs.aziendaVinicola 
							ORDER BY nomeAz";
							
					$query2="SELECT partitaIVA, nomeAz
							FROM AziendaVinicola azV, AziendaPrivata azP
							WHERE azV.partitaIVA=azP.aziendaVinicola 
							ORDER BY nomeAz";
							
					$query3="SELECT nome, cognome,codFiscale,dataNascita, aziendaVinicola
							FROM Dipendente d JOIN AziendaVinicola az ON d.aziendaVinicola=az.partitaIVA
							WHERE az.partitaIVA IN (SELECT aziendaVinicola
													FROM CantinaSociale)
							ORDER BY az.nomeAz";
						
					$query4="SELECT nome, cognome,codFiscale,dataNascita,aziendaVinicola
							FROM Dipendente d JOIN AziendaVinicola az ON d.aziendaVinicola=az.partitaIVA
							WHERE az.partitaIVA IN (SELECT aziendaVinicola
													FROM AziendaPrivata)
							ORDER BY az.nomeAz";
					
					$cantine= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$azprivate=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$dipendentiCS=mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
					$dipendentiAZP=mysql_query($query4,$conn) or die("Query fallita" . mysql_error($conn));
					$num_righe1=mysql_num_rows($dipendentiCS);
					$num_righe2=mysql_num_rows($dipendentiAZP);
					
					$cs=mysql_fetch_assoc($cantine);
					$azp=mysql_fetch_assoc($azprivate);
					$dipCS=mysql_fetch_assoc($dipendentiCS);
					$dipAZP=mysql_fetch_assoc($dipendentiAZP);
						
					$cont=0;
					
					$ident="A".$cont;
					$ident2="B".$cont;
					
					
					if($num_righe1==0 and $num_righe2==0)
						{echo "<p class=\"nessuno\"> Nessun dipendente in elenco </p>";
						}
					else
						{while($cs['partitaIVA'])
							{
							echo "<div class=\"blocco\">";
								echo "<h3 id=\"".$ident."\"> Dipendenti dell'azienda <strong>".$cs['nomeAz']."</strong>:</h3>";
								echo "<div class=\"riquadro\">";
									echo "<dl class=\"dip\">";
									while($dipCS['aziendaVinicola']==$cs['partitaIVA'])
										{echo "<dt><strong>".$dipCS['nome']." ".$dipCS['cognome']."</strong></dt>";
											echo "<dd> Codice Fiscale: ".$dipCS['codFiscale']."</dd>";
											echo "<dd> Data di nascita: ".data_it($dipCS['dataNascita'])."</dd>";
										$dipCS=mysql_fetch_assoc($dipendentiCS);
										}
									$cs=mysql_fetch_assoc($cantine);
									$cont=$cont+1;
									$ident="A".$cont;
									echo "</dl>";
								echo "</div>";
								echo "<a class=\"tornaSu\" href=\"va_dipendenti.php\">Torna su</a>";
							echo "</div>";
							}
							
						while($azp['partitaIVA'])
							{
							echo "<div class=\"blocco\">";
								echo "<h3 id=\"".$ident2."\" > Dipendenti dell'azienda <strong>".$azp['nomeAz']."</strong></h3>";
								echo "<div class=\"riquadro\">";
									echo "<dl class=\"dip\">";
									while($dipAZP['aziendaVinicola']==$azp['partitaIVA'])
										{echo "<dt><strong>".$dipAZP['nome']." ".$dipAZP['cognome']."</strong></dt>";
											echo "<dd> Codice Fiscale: ".$dipAZP['codFiscale']."</dd>";
											echo "<dd> Data di nascita: ".data_it($dipAZP['dataNascita'])."</dd>";
										$dipAZP=mysql_fetch_assoc($dipendentiAZP);
										}
									$azp=mysql_fetch_assoc($azprivate);
									$cont=$cont+1;
									$ident2="B".$cont;
									echo "</dl>";
								echo "</div>";
							echo "<a class=\"tornaSu\" href=\"va_dipendenti.php\">Torna su</a>";
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