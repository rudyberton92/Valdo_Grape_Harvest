<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Contratti di vendita - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina amministrativa dei contratti presenti nel sito Valdo Grape Harvest"/>
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
					<p> Ti trovi in: <span class="current_link"> Contratti di vendita </span> </p>
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
					<li> Contratti di vendita 
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
					
					$query1="SELECT DISTINCT anno
							FROM ContrattoDiVendita
							ORDER BY anno";
					
					$arrayAnni= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$anni=mysql_fetch_assoc($arrayAnni);
					
					$query2="SELECT nomeAz
							FROM AziendaVinicola
							ORDER BY nomeAz";
							
					$aziende= mysql_query($query2, $conn) or die("Query fallita". mysql_error($conn));
					$az= mysql_fetch_assoc($aziende);
					
					$query3="SELECT	nome, cognome
							FROM Viticoltore
							ORDER BY cognome";
						
					$viticoltori= mysql_query($query3, $conn) or die("Query fallita". mysql_error($conn));
					$vit = mysql_fetch_assoc($viticoltori);
					
					//inserimento nuovo contratto
					echo "<form  class=\"styleform\" action=\"contr_INDEL.php?inserisci\" method=\"post\">";
						echo "<fieldset>";
							echo "<legend> Inserimento nuovo contratto di vendita </legend>";
							echo "<div>";
								echo "<label for=\"codice\">Codice del contratto: </label>";
								echo "<input class=\"anno\" type=\"text\" id=\"codice\" name=\"precod\"  maxlength=\"4\" value=\"CV\"/>";
								echo " - ";
								echo "<input class=\"anno\" type=\"text\" id=\"codice\" name=\"cod\" maxlength=\"3\" / > <span> * esempio: CV14 - 123 </span>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"anno\"> Anno (aaaa): </label>";
								echo "<input class=\"anno\" type=\"text\" id=\"anno\" name=\"aa\" maxlength=\"4\"/>";
							echo "</div>";
							echo "<div>";
								echo "<p> Stipulatori del contratto: </p>";
								echo "<label for=\"azienda\"> Azienda vinicola: </label>";
								echo "<select name=\"azv\" id=\"azienda\">";
									echo "<option> </option>";
									while($az)
										{echo "<option>".$az['nomeAz']."</option>";
										$az= mysql_fetch_assoc($aziende);
										}			
								echo "</select>";
								
								echo "<label for=\"viticoltore\"> Viticoltore: </label>";
								echo "<select name=\"vit\" id=\"viticoltore\">";
									echo "<option> </option>";
									while($vit)
										{echo "<option>".$vit['nome']." ".$vit['cognome']."</option>";
										$vit = mysql_fetch_assoc($viticoltori);
										}
								echo "</select>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"quintali\">Quintali d'uva venduti: </label>";
								echo "<input class=\"campopiccolo\" type=\"text\" id=\"quintali\" name=\"qnt\" maxlength=\"8\"/>";
							echo "</div>";
							echo "<div>";
								echo "<label for=\"prezzo\">Prezzo di vendita al quintale: </label>";
								echo "<input class=\"campopiccolo\" type=\"text\" id=\"prezzo\" name=\"prz\" maxlength=\"8\"/> &euro;";
							echo "</div>";
							echo "<div>";
								echo "<input class=\"submit\" type=\"submit\" value=\"Inserisci\"/>";
							echo "</div>";
							
						echo "</fieldset>";
					echo "</form>";
					
					
					
					
					
					echo "<h2 class=\"titolo2\"> Elenco dei contratti di vendita: </h2>";
											
					$query2="SELECT cdv.*,az.nomeAz,v.nome,v.cognome 
							FROM ContrattoDiVendita cdv, Viticoltore v, AziendaVinicola az
							WHERE cdv.viticoltore=v.partitaIVA AND cdv.aziendaVinicola=az.partitaIVA
							ORDER BY anno, az.nomeAz, codContratto";
				
					
					$arrayAnni= mysql_query($query1,$conn) or die("Query fallita" . mysql_error($conn));
					$contratti=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$num_righe=mysql_num_rows($contratti);
					
					$anni=mysql_fetch_assoc($arrayAnni);
					$contr=mysql_fetch_assoc($contratti);
					
					$countAnno=0;
					$rif="Anno".$countAnno;
					
					echo "<p class=\"aiuto\"> Vai all'anno: ";
					while ($anni['anno'])
						{echo "<a class=\"move\" href=\"a_contratti.php#".$rif."\">".$anni['anno']."</a> ";
						echo "&nbsp;";
						
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
						{echo "<p class=\"nessuno\"> Nessun contratto presente nell'elenco </p>";
						}
					else
						{while($anni['anno'])
							{echo "<div class=\"areatabella\">";
							echo "<h3 id=\"".$rif."\"> <strong>Vendemmia anno ".$anni['anno']."</strong></h3>";
							echo "<table summary=\"tabella dei contratti di vendita stipulati\" class=\"tabella\" >";
							echo "<thead>";
								echo "<tr>
											<th>Codice del contratto</th> 
										  <th> Azienda </th>
										  <th> Viticoltore </th>
										  <th> Quintali d'uva </th>
										  <th> Prezzo al quintale </th>
										  <th></th>
									</tr>";
							echo "</thead>";		  
							while($contr['anno']==$anni['anno'])
								{echo "<tbody>";
									echo "<tr>";
										echo "<td>".$contr['codContratto']."</td>";
										echo "<td>".$contr['nomeAz']."</td>";
										echo "<td>".$contr['nome']." ".$contr['cognome']."</td>";
										echo "<td>".$contr['quintaliUva']."</td>";
										echo "<td>".$contr['prezzoUva_Quintale']." &euro;</td>";
										echo "<td><a class=\"move\" href=\"contr_INDEL.php?elimina=".$contr["codContratto"]."\"> Elimina </a></td>";
									echo "</tr>";
								echo "</tbody>";
								$contr=mysql_fetch_assoc($contratti);
								}
							echo "</table>";
							$anni=mysql_fetch_assoc($arrayAnni);
							$countAnno=$countAnno+1;;
							$rif="Anno".$countAnno;
							echo "<a class=\"tornaSu\" href=\"a_contratti.php\">Torna su</a>";
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