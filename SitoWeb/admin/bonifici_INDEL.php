<?php 
	include("../connDB.php");
	include("../functions.php");
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["precod"]) and !empty($_POST["cod"]) and !empty($_POST["sal"]) and !empty($_POST["ggv"]) and !empty($_POST["mmv"])
			and !empty($_POST["aav"]) and !empty($_POST["ggsc"]) and !empty($_POST["mmsc"]) and !empty($_POST["aasc"])
			and lunMin($_POST["precod"],4) and lunMin($_POST["cod"],3) )
			{$codContr=$_POST["precod"]."-".$_POST["cod"];
			
			$query="SELECT *
					FROM ContrattoDiVendita
					WHERE codContratto='".$codContr."'";
					
			$codice=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
			$cod = mysql_fetch_assoc($codice);
			
			if(!empty($cod))
				{$query3="SELECT *
					FROM Bonifico
					WHERE contrattoVendita='".$codContr."'";
					
				$bonifico=mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
				$bon = mysql_fetch_assoc($bonifico);
				
				if(empty($bon))
					{if (check_data($_POST["ggv"],$_POST["mmv"],$_POST["aav"]) and check_data($_POST["ggsc"],$_POST["mmsc"],$_POST["aasc"]) and
						beforeOf($_POST["ggv"],$_POST["mmv"],$_POST["aav"],$_POST["ggsc"],$_POST["mmsc"],$_POST["aasc"]) and beforeOf($_POST["ggv"],$_POST["mmv"],$_POST["aav"],date("d"),date("m"),date("Y")))
						{
						$query2="INSERT INTO Bonifico(saldo, dataVersamento, contrattoVendita, dataTermine)
								VALUES ('".$_POST["sal"]."',str_to_date('".$_POST["ggv"]."/".$_POST["mmv"]."/".$_POST["aav"]."','%d/%m/%Y'),
									'".$codContr."',str_to_date('".$_POST["ggsc"]."/".$_POST["mmsc"]."/".$_POST["aasc"]."','%d/%m/%Y'))";
						
						mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
						header("location: a_bonifici.php?msg=Pagamento inserito con successo!");				
						}
					
					else 
						{header("location: a_bonifici.php?msg=Errore: date inserite non corrette!");
						}					
					}
					
				else
					{header("location: a_bonifici.php?msg=Errore: pagamento gi&agrave; effettuato per questo contratto!");
					}
				}
				
			else	
				{header("location: a_bonifici.php?msg=Errore: codice del contratto non esistente!");
				}				
				
		
			}		
			
		else
			{header("location: a_bonifici.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM Bonifico 
				WHERE contrattoVendita='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_bonifici.php?msg=Pagamento eliminato con successo!");
		}	
	
?>