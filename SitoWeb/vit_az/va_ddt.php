<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Documenti di trasporto - ValdoGrapeHarvest </title>

		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina contenente la lista dei documenti di trasporto"/>
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
					<p> Ti trovi in: <a href="va_contratti.php"> Contratti di vendita </a> &gt;&gt; <span class="current_link"> Documenti di trasporto </span> </p>
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
							<li> &gt; Documenti di trasporto </li>
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
					echo "<h2> Elenco dei documenti di trasporto: </h2>";

					$query1="SELECT DISTINCT anno
							FROM ContrattoDiVendita";

					$query2="SELECT ddt.*, az.nomeAz, dp.nome, dp.cognome
							FROM DDT ddt,ContrattoDiVendita cdv, AziendaVinicola az, Dipendente dp
							WHERE cdv.aziendaVinicola=az.partitaIVA AND ddt.contrattoVendita=cdv.codContratto AND dp.codFiscale= ddt.dipendente
							ORDER BY cdv.anno,cdv.codContratto";

					$query3="SELECT cdv.*,az.nomeAz,v.nome,v.cognome
							FROM ContrattoDiVendita cdv, Viticoltore v, AziendaVinicola az
							WHERE cdv.viticoltore=v.partitaIVA AND cdv.aziendaVinicola=az.partitaIVA
							ORDER BY anno, codContratto";

					


					$arrayAnni= mysql_query($query1,$conn) or die("Query 1 fallita" . mysql_error($conn));
					$documenti=mysql_query($query2,$conn) or die("Query 2 fallita" . mysql_error($conn));
					$contratti=mysql_query($query3,$conn) or die("Query 3 fallita" . mysql_error($conn));
					
					$num_righe=mysql_num_rows($documenti);

					$anni=mysql_fetch_assoc($arrayAnni);
					$ddt=mysql_fetch_assoc($documenti);
					$contr=mysql_fetch_assoc($contratti);
					
					$countAnno=0;
					$rif="Anno".$countAnno;
					
					echo "<p class=\"aiuto\"> Vai all'anno: ";
					while ($anni['anno'])
						{echo "<a class=\"move\" href=\"va_ddt.php#".$rif."\">".$anni['anno']."</a> ";
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
						{echo "<p class=\"nessuno\"> Nessun documento di trasporto presente nell'elenco </p>";
						}
					else
						{while($anni['anno'])
							{echo "<div class=\"areaDDT\">";
							echo "<h3 id=\"".$rif."\"> <strong> Vendemmia anno ".$anni['anno']."</strong></h3>";
							
							echo "<table class=\"intestazione\">";	
								echo "<tr >
										<td class=\"int1\"> Codice contratto </td>
										<td  colspan=\"6\"> Codice ddt 
											<td  colspan=\"5\"> Quantit&agrave; carico  
												<td colspan=\"4\">Luogo di raccolta 
												
													<td class=\"int3\" colspan=\"3\">Data e Ora 
													<td class=\"int3\" colspan=\"2\">Azienda destinataria
													<td class=\"int1\">Dipendente firmatario  	
													</td>
													</td>
													</td>
												</td>
											</td>
										</td>	
									</tr>";
									
							echo "</table>";
								
								
							echo "<table class=\"DDT\">";
								
								while($contr['codContratto'] and $contr['anno']==$anni['anno'])
									{
									$query4="SELECT *
												FROM DDT
												WHERE contrattoVendita='".$contr['codContratto']."'";
									
									$righe= mysql_query($query4,$conn) or die("Query 4 fallita" . mysql_error($conn));
									$num=mysql_num_rows($righe);
									
									if($num!=0)
										{$query5="SELECT az.nomeAz
												FROM ContrattoDiVendita cdv JOIN AziendaVinicola az ON cdv.aziendaVinicola=az.partitaIVA
												WHERE cdv.codContratto='".$contr['codContratto']."'";
											
										$aziende=mysql_query($query5,$conn) or die ("Query 4 fallita" . mysql_error($conn));
										$az=mysql_fetch_assoc($aziende);
										
										echo "<tbody class=\"evidenzia\">";
										echo "<tr>
												<td class=\"codice\" rowspan=\"".$num."\">".$contr['codContratto']."</td>
												<td>".$ddt['codBolla']."</td>
												<td class=\"spazio\">".$ddt['quantitaCarico']." q."."</td>
												<td>".$ddt['luogo']."</td>
												<td>".dataora_it($ddt['dataOra'])."</td>
												<td rowspan=\"".$num."\">".$az['nomeAz']."</td>
												<td>".$ddt['nome']." ".$ddt['cognome']."</td>								
											</tr>";
										
										$num=$num-1;
										$ddt=mysql_fetch_assoc($documenti);
										
										while($num!=0)
											{echo "<tr>
														<td>".$ddt['codBolla']."</td>
														<td>".$ddt['quantitaCarico']." q."."</td>
														<td>".$ddt['luogo']."</td>
														<td>".dataora_it($ddt['dataOra'])."</td>
														<td>".$ddt['nome']." ".$ddt['cognome']."</td>
												</tr>";
											$num=$num-1;
											$ddt=mysql_fetch_assoc($documenti);
											}
										$contr=mysql_fetch_assoc($contratti);
										echo "</tbody>";
										}
									else
										{$contr=mysql_fetch_assoc($contratti);
										}
									}
								
								echo "</table>";
								$anni=mysql_fetch_assoc($arrayAnni);
								$countAnno=$countAnno+1;;
								$rif="Anno".$countAnno;
								echo "<a class=\"tornaSu\" href=\"va_ddt.php\">Torna su</a>";
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