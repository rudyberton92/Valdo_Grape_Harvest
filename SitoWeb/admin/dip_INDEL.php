<?php 
	include("../connDB.php");
	include("../functions.php");
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["nm"]) and !empty($_POST["cgnm"]) and !empty($_POST["CF"])
			and !empty($_POST["gg"]) and !empty($_POST["mm"]) and !empty($_POST["aa"]) 
			and !empty($_POST["DipDi"]) and lunMin($_POST["CF"],16))
			{$query="SELECT codFiscale
					FROM Dipendente
					WHERE codFiscale='".$_POST["CF"]."'";
				
			$codFiscale=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
			$CF = mysql_fetch_assoc($codFiscale);
			
			$query2="SELECT partitaIVA
					FROM AziendaVinicola
					WHERE nomeAz='".addslashes($_POST["DipDi"])."'";
			
			$aziendaCapo=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
			$azCapo = mysql_fetch_assoc($aziendaCapo);
			
			if(empty($CF))
					{if(check_data($_POST["gg"],$_POST["mm"],$_POST["aa"]) and beforeOf($_POST["gg"],$_POST["mm"],$_POST["aa"],date("d"),date("m"),date("Y")-18))
						{$query3=" INSERT INTO Dipendente(nome,cognome,codFiscale,dataNascita,aziendaVinicola)
								VALUES ('".$_POST["nm"]."','".addslashes($_POST["cgnm"])."','".$_POST["CF"]."',
										str_to_date('".$_POST["gg"]."/".$_POST["mm"]."/".$_POST["aa"]."','%d/%m/%Y'),
										'".$azCapo['partitaIVA']."')";
					
			
						mysql_query($query3, $conn) or die("Inserimento fallito". mysql_error($conn));
						header("location: a_dipendenti.php?msg=Dipendente inserito con successo!");
						}
					else
						{header("location: a_dipendenti.php?msg=Errore: data di nascita non valida!");
						}
					}
			else
					{$query4="SELECT azv.nomeAz
								FROM AziendaVinicola azv JOIN Dipendente d ON d.aziendaVinicola=azv.partitaIVA
								WHERE d.codFiscale='".$_POST["CF"]."'";
					
					$Padrone=mysql_query($query4,$conn) or die("Query fallita" . mysql_error($conn));
					$Capo = mysql_fetch_assoc($Padrone);
					
					header("location: a_dipendenti.php?msg=Errore: Questo dipendente lavora già per ".$Capo['nomeAz']."!");
					}
	
			}
		
		else
			{header("location: a_dipendenti.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM Dipendente 
				WHERE codFiscale='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_dipendenti.php?msg=Dipendente eliminato con successo!");
		}		
			
?>