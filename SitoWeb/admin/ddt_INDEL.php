<?php 
	include("../connDB.php");
	include("../functions.php");
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["precod"]) and !empty($_POST["cod"]) and !empty($_POST["codbolla"]) /*and !empty($_POST["azv"])*/ and !empty($_POST["qta"])
			and !empty($_POST["luo"]) and !empty($_POST["gg"]) and !empty($_POST["mm"]) and !empty($_POST["aa"]) 
			and !empty($_POST["hh"]) and !empty($_POST["min"]) and !empty($_POST["dip"]) and lunMin($_POST["precod"],4) and lunMin($_POST["cod"],3) and
			lunMin($_POST["codbolla"],6))
			{$codContr=$_POST["precod"]."-".$_POST["cod"];
			
			$query="SELECT *
					FROM AziendaVinicola az JOIN ContrattoDiVendita cdv ON az.partitaIva=cdv.aziendaVinicola
					WHERE cdv.codContratto='".$codContr."'";
					
			$codice=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
			$cod = mysql_fetch_assoc($codice);
			
			if(!empty($cod))
				{ if(check_data($_POST["gg"],$_POST["mm"],$_POST["aa"]) and beforeOf($_POST["gg"],$_POST["mm"],$_POST["aa"],date("d"),date("m"),date("Y")) and check_time($_POST["hh"],$_POST["min"]))
					{
					$dipendente=explode(" ", $_POST["dip"]);
					$cognome=$dipendente[1]." ".$dipendente[2];
					
					
					$query3="SELECT	codFiscale
							FROM Dipendente
							WHERE aziendaVinicola='".$cod["partitaIVA"]."' and nome='".$dipendente[0]."' and cognome='".addslashes($cognome)."'";
						
					$dipen=mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
					$dip = mysql_fetch_assoc($dipen);
						
					if($dip["codFiscale"])
						{$query4="SELECT codBolla
								FROM DDT	
								WHERE codBolla='".$_POST["codbolla"]."'";
							
						$bolla=mysql_query($query4,$conn) or die("Query fallita" . mysql_error($conn));
						$bol = mysql_fetch_assoc($bolla);		
							
						if($bol['codBolla'])
							{header("location: a_ddt.php?msg=Errore: codice ddt gi&agrave; utilizzato!");
							}
						else
							{$query5="INSERT INTO DDT(codBolla,quantitaCarico,luogo,dataOra,dipendente,contrattoVendita)
									VALUES ('".$_POST["codbolla"]."','".$_POST["qta"]."','".$_POST["luo"]."',
										str_to_date('".$_POST["gg"]."/".$_POST["mm"]."/".$_POST["aa"]." ".$_POST["hh"].".".$_POST["min"]."','%d/%m/%Y %H.%i'),
										'".$dip["codFiscale"]."','".$codContr."')";
				
							mysql_query($query5, $conn) or die("Inserimento fallito". mysql_error($conn));
							header("location: a_ddt.php?msg=Documento di trasporto inserito con successo!");
							}
						}
					else
						{header("location: a_ddt.php?msg=Errore: il dipendente in questione non lavora per ".$_POST["azv"]."!");
						}
						
					}
				else
					{header("location: a_ddt.php?msg=Errore: data e/o ora inserita non corretta!");
					}
				}
			else	
				{header("location: a_ddt.php?msg=Errore: codice del contratto non esistente!");
				}
			}		
			
		else
			{header("location: a_ddt.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM DDT 
				WHERE codBolla='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_ddt.php?msg=Documento di trasporto eliminato con successo!");
		}		
		
		
?>