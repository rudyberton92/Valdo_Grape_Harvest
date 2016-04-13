<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Soci ordinari - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista dei soci ordinari delle cantine sociali"/>
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
					<p> Ti trovi in:  <a href="va_aziendeVinicole.php">Aziende vinicole </a> &gt;&gt; <a href="va_aziendeVinicole.php#CS"> Cantine sociali </a> &gt;&gt; <span class="current_link"> Soci ordinari</span> </p>
				</div>
			</div>
			<div class="nav">
				<ul> 
					<li> <a href="va_viticoltori.php"> Viticoltori </a>
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
									<li> &gt;&gt;  Soci ordinari  </li>
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
					
					echo "<h2> Elenco dei soci ordinari: </h2>";
					
					$query1="SELECT azV.partitaIVA as AZpartitaIVA, v.nome as vitNome, v.cognome as vitCognome, v.partitaIVA as vitParIVA
							FROM Socio s JOIN Viticoltore v ON s.viticoltore=v.partitaIVA, AziendaVinicola azV
							WHERE s.cantinaSociale=azV.partitaIVA
							ORDER BY azV.nomeAz, v.cognome";
					
					$query2="SELECT partitaIVA, nomeAz
							 FROM CantinaSociale cs JOIN AziendaVinicola azV ON cs.aziendaVinicola=azV.partitaIVA
							 ORDER BY azV.nomeAz";
							 
					
					$soci= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$cantine=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$num_righe=mysql_num_rows($soci);
					
					$arraySoci=mysql_fetch_assoc($soci);
					$arrayCS=mysql_fetch_assoc($cantine);
					
					
					if($num_righe==0)
						{echo "<p class=\"nessuno\"> Non ci sono soci iscritti </p>";
						}
					else
						{while ($arrayCS['partitaIVA'])
							{echo "<div class=\"descr\">";
							echo "<p > Soci ordinari della cantina sociale <strong>".$arrayCS['nomeAz']."</strong>:</p>";
							echo "<ul>";
								while($arraySoci['AZpartitaIVA']==$arrayCS['partitaIVA'])
									{echo "<li><strong>".$arraySoci['vitNome']." ".$arraySoci['vitCognome']."</strong>,  partita IVA: ".$arraySoci['vitParIVA']."</li>";
									$arraySoci=mysql_fetch_assoc($soci);
									}
							echo "</ul>";
							$arrayCS=mysql_fetch_assoc($cantine);
							echo "<a class=\"tornaSu\" href=\"va_soci.php\">Torna su</a>";
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