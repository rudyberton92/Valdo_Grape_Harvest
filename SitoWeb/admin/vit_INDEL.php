<?php 
	include("../connDB.php");
	include("../functions.php");
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["nm"]) and !empty($_POST["cgnm"]) and !empty($_POST["piva"])
			and !empty($_POST["gg"]) and !empty($_POST["mm"]) and !empty($_POST["aa"]) and !empty($_POST["ind"]) and !empty($_POST["ett"]) and !empty($_POST["pw"]) and lunMin($_POST["piva"],11) and lunMin($_POST["pw"],6) )
			{	$query="SELECT partitaIVA
					FROM Viticoltore
					WHERE partitaIVA='".$_POST["piva"]."' OR password='".$_POST["pw"]."'";
		 
				$partitaIVA=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
				$pIVA = mysql_fetch_assoc($partitaIVA);

				if(empty($pIVA))
					{if(check_data($_POST["gg"],$_POST["mm"],$_POST["aa"]) and beforeOf($_POST["gg"],$_POST["mm"],$_POST["aa"],date("d"),date("m"),date("Y")-18))
						{$query=" INSERT INTO Viticoltore(nome,cognome,partitaIVA,dataNascita,indirizzo,ettari,password)
								VALUES ('".$_POST["nm"]."','".addslashes($_POST["cgnm"])."','".$_POST["piva"]."',
								str_to_date('".$_POST["gg"]."/".$_POST["mm"]."/".$_POST["aa"]."','%d/%m/%Y'),
								'".$_POST["ind"]."','".$_POST["ett"]."','".$_POST["pw"]."')";
					
						mysql_query($query, $conn) or die("Inserimento fallito". mysql_error($conn));
						header("location: a_viticoltori.php?msg=Viticoltore inserito con successo!");
						}
					else
						{header("location: a_viticoltori.php?msg=Errore: data di nascita non valida!");
						}
					}
					
				else
					{header("location: a_viticoltori.php?msg=Errore: partita IVA e/o password già assegnata! ");
					}
			}
			
		else
			{header("location: a_viticoltori.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM Viticoltore 
				WHERE partitaIVA='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_viticoltori.php?msg=Viticoltore eliminato con successo!");
		}		
	
	
?>