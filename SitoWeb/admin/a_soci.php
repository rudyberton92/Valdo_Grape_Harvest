<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >
	<head>
		<title> Soci delle cantine sociali - ValdoGrapeHarvest </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="pagina amministrativa dei soci presenti nel sito Valdo Grape Harvest"/>
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
					<p> Ti trovi in: <a href="a_aziendeVinicole.php"> Aziende vinicole </a> &gt;&gt;<span class="current_link"> Soci delle cantine sociali </span> </p>
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
							<li> &gt;  Soci delle cantine sociali  </li>
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

					echo "<div class=\"spaziomex\">";
						if(isset($_REQUEST['msg'])) 
						{echo "<div class=\"messaggio\"> <p>".$_REQUEST['msg']."</p></div>";
						}
					echo  "</div>";
						
					$query3="SELECT nomeAz
							FROM CantinaSociale cs JOIN AziendaVinicola azv ON cs.aziendaVinicola=azv.partitaIVA 
							ORDER BY nomeAz";
					
					$Cantine= mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
					$CS=mysql_fetch_assoc($Cantine);
					
					//inserimento nuovo socio
					echo "<form class=\"styleform\" action=\"soci_INDEL.php?inserisci\" method=\"post\">";
						echo "<fieldset>";
							echo "<legend> Inserimento nuovo socio </legend>";
							echo "<div>";
								echo "<label for=\"nomecognome\"> Nome e Cognome: </label>";
								echo "<input type=\"text\" id=\"nomecognome\" name=\"nmcg\" maxlength=\"20\"/>";
								echo "<label for=\"cs\"> socio della cantina: </label>";
								echo "<select id=\"cs\" name=\"cnsoc\">";
									echo "<option> </option>";
									while ($CS['nomeAz'])
										{echo "<option>".$CS['nomeAz']."</option>";
										$CS=mysql_fetch_assoc($Cantine);
										}
								echo "</select>";
							echo "</div>";
							echo "<div>";
								echo "<input class=\"submit\" type=\"submit\" value=\"Inserisci\"/>";
							echo "</div>";
						echo "</fieldset>";
					echo "</form>";
					
					
					
					
					
					
					echo "<h2 class=\"titolo2\"> Elenco dei soci ordinari: </h2>";
					
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
									{echo "<li><strong>".$arraySoci['vitNome']." ".$arraySoci['vitCognome']."</strong>,  partita IVA: ".$arraySoci['vitParIVA']."<a class=\"move\"href=\"soci_INDEL.php?elimina=".$arraySoci["vitParIVA"]."\">Elimina</a></li>";
							
									$arraySoci=mysql_fetch_assoc($soci);
									}
							echo "</ul>";
							$arrayCS=mysql_fetch_assoc($cantine);
							echo "<a class=\"tornaSu\" href=\"a_soci.php\">Torna su</a>";
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