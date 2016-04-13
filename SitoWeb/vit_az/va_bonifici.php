<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Pagamenti - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista dei pagamenti"/>
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
					<p> Ti trovi in: <a href="va_contratti.php"> Contratti di vendita </a> &gt;&gt; <span class="current_link"> Pagamenti </span> </p>
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
									<li> &gt;&gt;  <a href="va_soci.php"> Soci ordinari </a> </li>
								</ul>
							</li>
							
							<li> &gt;  <a href="va_dipendenti.php"> Dipendenti </a> </li>
						</ul>
					</li>
					<li> <a href="va_contratti.php"> Contratti di vendita </a>
						<ul>
							<li> &gt;  <a href="va_ddt.php"> Documenti di trasporto </a> </li>
							<li> &gt;  Pagamenti</li>
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
					
					echo "<h2> Elenco dei pagamenti: </h2>";
					
					$query1="SELECT DISTINCT anno
							FROM ContrattoDiVendita";
							
					$query2="SELECT b.*, az.nomeAz, v.nome, v.cognome, cdv.anno as anno
							 FROM Bonifico b, ContrattoDiVendita cdv, AziendaVinicola az, Viticoltore v
							WHERE b.contrattoVendita=cdv.codContratto AND cdv.aziendaVinicola=az.partitaIVA 
									AND cdv.viticoltore=v.partitaIVA
							ORDER BY cdv.anno, az.nomeAz, cdv.codContratto";
					
					
						
									
					$arrayAnni= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$pagamenti=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					
					$num_righe=mysql_num_rows($pagamenti);
					
					$anni=mysql_fetch_assoc($arrayAnni);
					$bonifici=mysql_fetch_assoc($pagamenti);
					
					$countAnno=0;
					$rif="Anno".$countAnno;
					
					echo "<p class=\"aiuto\"> Vai all'anno: ";
					while ($anni['anno'])
						{echo "<a class=\"move\" href=\"va_bonifici.php#".$rif."\">".$anni['anno']."</a> ";
						echo "&nbsp;  ";
						$anni=mysql_fetch_assoc($arrayAnni);
						$countAnno=$countAnno+1;;
						$rif="Anno".$countAnno;
						}
					echo "</p>";
					
					$arrayAnni= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$anni=mysql_fetch_assoc($arrayAnni);
					
					$countAnno=0;
					$rif="Anno".$countAnno;
					
					
					if($num_righe==0)
						{echo "<p class=\"nessuno\"> Nessun pagamento presente nell'elenco </p>";
						}
					else
						{while($anni['anno'])
							{echo "<div class=\"areatabella\">";
							echo "<h3 id=\"".$rif."\"><strong> Vendemmia anno ".$anni['anno']."</strong></h3>";
							echo "<table summary=\"tabella con i dati dei pagamenti effettuati\" class=\"tabella\">";
							echo "<thead>";
							echo "<tr>
									<th> Codice del contratto </th>
									<th> Saldo </th>
									<th> Mittente </th>
									<th> Destinatario </th>
									<th> Data del versamento</th>
									<th> Scadenza versamento </th>
								</tr>";
							
							echo "</thead>";
							while($bonifici['anno']==$anni['anno'] and $bonifici['contrattoVendita'])
								{echo "<tbody>";
									echo "<tr>";
										echo "<td>".$bonifici['contrattoVendita']."</td>";
										echo "<td>".$bonifici['saldo']." &euro;"."</td>";
										echo "<td>".$bonifici['nomeAz']."</td>";
										echo "<td>".$bonifici['nome']." ".$bonifici['cognome']."</td>";
										echo "<td>".data_it($bonifici['dataVersamento'])."</td>";
										echo "<td>".data_it($bonifici['dataTermine'])."</td>";
									echo "</tr>";
									$bonifici=mysql_fetch_assoc($pagamenti);
								echo "</tbody>";
								}
							echo "</table>";
							$anni=mysql_fetch_assoc($arrayAnni);
							$countAnno=$countAnno+1;;
							$rif="Anno".$countAnno;
							echo "<a class=\"tornaSu\" href=\"va_bonifici.php\">Torna su</a>";
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