<?php 
	include("../connDB.php");
	
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["nmcg"]))
			{$socio=explode(" ", $_POST["nmcg"]);
			$cognome=$socio[1]." ".$socio[2];
				
			$query="SELECT *
					FROM Viticoltore
					WHERE nome='".$socio[0]."' AND cognome='".addslashes($cognome)."'";
			
			$socio_presente=mysql_query($query, $conn) or die("Inserimento fallito". mysql_error($conn));		
			$sc=mysql_fetch_assoc($socio_presente);
			
			if(empty($sc))
				{header("location: a_soci.php?msg=Errore: viticoltore non ancora registrato nella propria sezione! ");
				}
				
			else
				{		
				$query2="SELECT *
						FROM Socio s JOIN AziendaVinicola az ON s.cantinaSociale=az.partitaIVA
						WHERE s.viticoltore='".$sc['partitaIVA']."' AND az.nomeAz='".addslashes($_POST["cnsoc"])."'";
				
				$testsocio=mysql_query($query2, $conn) or die("Inserimento fallito". mysql_error($conn));		
				$ts=mysql_fetch_assoc($testsocio);
				
				if(empty($ts))
					{$query3="SELECT partitaIVA
							FROM AziendaVinicola
							WHERE nomeAz='".addslashes($_POST["cnsoc"])."'";
							
					$parCan=mysql_query($query3, $conn) or die("Inserimento fallito". mysql_error($conn));
					$cant=mysql_fetch_assoc($parCan);
					
					
					$query4="INSERT INTO Socio(viticoltore,cantinaSociale)
								VALUES ('".$sc['partitaIVA']."','".$cant['partitaIVA']."')";
					
					mysql_query($query4, $conn) or die("Inserimento fallito". mysql_error($conn));
					
					header("location: a_soci.php?msg=Socio inserito con successo!");
					}
				
				else 
					{
					header("location: a_soci.php?msg=Errore: questo viticoltore è già socio della cantina sociale selezionata!");
					}
					
				}
			}
		else
			{header("location: a_soci.php?msg=Errore: dati inseriti non corretti! ");
			}
		}
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM Socio 
				WHERE viticoltore='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_soci.php?msg=Socio eliminato con successo!");
		}		
		
		
		
?>