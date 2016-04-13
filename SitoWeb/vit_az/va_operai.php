<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Operai - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista degli operai per ogni viticoltore"/>
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
					<p> Ti trovi in: <a href="va_viticoltori.php"> Viticoltori </a> &gt;&gt;<span class="current_link">  Operai </span> </p>
				</div>
			</div>
			
			<div class="nav">
				<ul> 
					<li> <a href="va_viticoltori.php"> Viticoltori </a>
						<ul>
							<li> &gt; Operai  </li>
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
					
					echo "<h2> Elenco degli operai alle dipendenze dei viticoltori: </h2>";
					
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
					
					$cont=0;
					$ident="A".$cont;
					
					if($num_righe==0)
						{echo "<p class=\"nessuno\"> Non sono presenti operai </p>";
						}
					else
						{while($arrayVit['partitaIVA'])
							{echo "<div class=\"areaDati\">";
							echo "<h3 id=\"".$ident."\"> Operai di <strong>".$arrayVit['nome']." ".$arrayVit['cognome']."</strong>:</h3>";
								echo "<div class=\"riquadro\">";
								while($arrayOp['viticoltore']==$arrayVit['partitaIVA'])
									{
									echo "<dl class=\"listaO\">";
									echo "<dt><strong>".$arrayOp['nome']." ".$arrayOp['cognome']."</strong></dt>";
									echo "<dd> Codice fiscale:".$arrayOp['codFiscale']."</dd>";
									echo "<dd> Data di nascita:".data_it($arrayOp['dataNascita'])."</dd>";
									echo "<dd> Indirizzo:".$arrayOp['indirizzo']."</dd>";
									$arrayOp=mysql_fetch_assoc($operai);
									echo "</dl>";
									
									}
								$arrayVit=mysql_fetch_assoc($viticoltori);
								$cont=$cont+1;
								$ident="A".$cont;
								echo "<a class=\"tornaSu\" href=\"va_operai.php\">Torna su</a>";
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
