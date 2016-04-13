<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Pagamenti - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina amministrativa dei pagamenti presenti nel sito Valdo Grape Harvest"/>
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
					<p> Ti trovi in: <a href="a_contratti.php"> Contratti di vendita</a> &gt;&gt; <span class="current_link"> Pagamenti  </span> </p>
				</div>
			</div>
			<div class="nav">
				<ul>					
					<li> <a href="a_viticoltori.php"> Viticoltori </a>
						<ul>
							<li> &gt;  <a href="a_operai.php"> Operai </a> </li>
						</ul>
					</li>
					<li> <a href="a_aziendeVinicole.php"> Aziende vinicole </a>
						<ul>
							<li> &gt; <a href="a_soci.php"> Soci delle cantine sociali </a> </li>
							<li> &gt;  <a href="a_dipendenti.php"> Dipendenti </a> </li>
						</ul>
					</li>
					<li> <a href="a_contratti.php"> Contratti di vendita </a>
						<ul>
							<li> &gt;  <a href="a_ddt.php"> Documenti di trasporto </a>  </li>
							<li> &gt;  Pagamenti </li>
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
					
					$query="SELECT nomeAz
							FROM AziendaVinicola
							ORDER BY nomeAz";
							
					$aziende= mysql_query($query, $conn) or die("Query fallita". mysql_error($conn));
					$az= mysql_fetch_assoc($aziende);
					
					$query2="SELECT	nome, cognome
							FROM Viticoltore
							ORDER BY cognome";
						
					$viticoltori= mysql_query($query2, $conn) or die("Query fallita". mysql_error($conn));
					$vit = mysql_fetch_assoc($viticoltori);
					
					
					
					echo "<form class=\"styleform\" action=\"bonifici_INDEL.php?inserisci\" method=\"post\">";
						echo "<fieldset>";
							echo "<legend> Inserimento nuovo pagamento </legend>";
							echo "<div>";
								echo "<label for=\"codice\">Codice del contratto: </label>";
								echo "<input class=\"anno\" type=\"text\" id=\"codice\" name=\"precod\" maxlength=\"4\" value=\"CV\"/>";
								echo " - ";
								echo "<input class=\"anno\" type=\"text\" id=\"codice\" name=\"cod\"  maxlength=\"3\" / > <span> * esempio: CV14 - 123 </span>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"saldo\">Saldo: </label>";
								echo "<input type=\"text\" id=\"saldo\" name=\"sal\"  maxlength=\"10\" /> &euro;";
							echo "</div>";
							
					
							echo "<div>";
								echo "<label  for=\"dataver\">Data del versamento (gg/mm/aaaa): </label>";
								
										echo "<input class=\"ggmm\" type=\"text\" name=\"ggv\" id=\"dataver\" maxlength=\"2\"/>";
										echo " / ";
										echo "<input class=\"ggmm\" type=\"text\" name=\"mmv\" id=\"dataver\" maxlength=\"2\"/>";
										echo " / ";										
										echo "<input class=\"anno\" type=\"text\" name=\"aav\" id=\"dataver\" maxlength=\"4\"/>";
							
							echo "</div>";
							echo "<div>";
								echo "<label  for=\"scadver\">Scadenza del versamento (gg/mm/aaaa): </label>";
								
										echo "<input class=\"ggmm\" type=\"text\" name=\"ggsc\" id=\"scadver\" maxlength=\"2\"/>";
										echo " / ";
										echo "<input class=\"ggmm\" type=\"text\" name=\"mmsc\" id=\"scadver\" maxlength=\"2\"/>";
										echo " / ";										
										echo "<input class=\"anno\"  type=\"text\" name=\"aasc\" id=\"scadver\" maxlength=\"4\"/>";
							
							echo "</div>";
							echo "<div>";
								echo "<input class=\"submit\" type=\"submit\" value=\"Inserisci\"/>";
							echo "</div>";
						echo "</fieldset>";			
					echo "</form>";
					
					
					
					
					
					
					echo "<h2 class=\"titolo2\"> Elenco dei pagamenti: </h2>";
					
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
						{echo "<a class=\"move\" href=\"a_bonifici.php#".$rif."\">".$anni['anno']."</a> ";
							echo "&nbsp; ";
						
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
							echo "<table summary=\"tabella dei pagamenti effettuati\" class=\"tabella\">";
							echo "<thead>";
							echo "<tr>
									<th> Codice del contratto </th>
									<th> Saldo </th>
									<th> Mittente </th>
									<th> Destinatario </th>
									<th> Data del versamento</th>
									<th> Scadenza versamento </th>
									<th></th>
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
									echo "<td> <a class=\"move\" href=\"bonifici_INDEL.php?elimina=".$bonifici["contrattoVendita"]."\"> Elimina </a></td>";
								echo "</tr>";
								$bonifici=mysql_fetch_assoc($pagamenti);
								echo "</tbody>";
								}
							echo "</table>";
							$anni=mysql_fetch_assoc($arrayAnni);
							$countAnno=$countAnno+1;;
							$rif="Anno".$countAnno;	
							echo "<a class=\"tornaSu\" href=\"a_bonifici.php\">Torna su</a>";
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