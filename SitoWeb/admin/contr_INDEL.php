<?php 
	include("../connDB.php");
	include("../functions.php");
	
	
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["precod"]) and !empty($_POST["cod"]) and !empty($_POST["aa"]) and !empty($_POST["azv"])
			and !empty($_POST["vit"]) and !empty($_POST["qnt"]) and !empty($_POST["prz"]) and lunMin($_POST["precod"],4) and
			lunMin($_POST["cod"],3) and lunMin($_POST["aa"],4))
			{$codContr=$_POST["precod"]."-".$_POST["cod"];

			$query="SELECT *
					FROM ContrattoDiVendita
					WHERE codContratto='".$codContr."'";
					
			$codice=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
			$cod = mysql_fetch_assoc($codice);		
				
			if(!empty($cod))
				{header("location: a_contratti.php?msg=Errore: codice del contratto già utilizzato!");
				}
				
			else
				{$query3="SELECT partitaIVA
						FROM AziendaVinicola
						WHERE nomeAz='".addslashes($_POST["azv"])."'";
						
				$azienda=mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
				$az = mysql_fetch_assoc($azienda);		
					
					
				$viticoltore=explode(" ", $_POST["vit"]);
				$cognome=$viticoltore[1]." ".$viticoltore[2];
				
				
				$query4="SELECT partitaIVA
						FROM Viticoltore
						WHERE nome='".$viticoltore[0]."' AND cognome='".addslashes($cognome)."'";
						
				$vitic=mysql_query($query4,$conn) or die("Query fallita" . mysql_error($conn));
				$vit = mysql_fetch_assoc($vitic);		
				
				
			
				$query2="INSERT INTO ContrattoDiVendita(codContratto,anno,quintaliUva,prezzoUva_Quintale,aziendaVinicola,viticoltore)
								VALUES ('".$codContr."','".$_POST["aa"]."','".$_POST["qnt"]."','".$_POST["prz"]."','".$az["partitaIVA"]."','".$vit["partitaIVA"]."')";
					
				mysql_query($query2,$conn) or die(header("location: a_contratti.php?msg=Errore:Il viticoltore e l'azienda selezionati hanno già stipulato un contratto in quest'anno!"). mysql_error($conn));	
				
				header("location: a_contratti.php?msg=Contratto di vendita inserito con successo!");	
				
					
				}
			}		
			
		else
			{header("location: a_contratti.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM ContrattoDiVendita 
				WHERE codContratto='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_contratti.php?msg=Contratto di vendita eliminato con successo!");
		}	
?>