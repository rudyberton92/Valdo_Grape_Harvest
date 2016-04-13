<?php 
	include("../connDB.php");
	include("../functions.php");
	
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["nm"]) and !empty($_POST["piva"]) and !empty($_POST["ind"]) and !empty($_POST["tel"])and !empty($_POST["pw"]) and lunMin($_POST["piva"],11) and lunMin($_POST["tel"],8) and lunMin($_POST["pw"],6)  )
			{$query="SELECT *
					FROM Viticoltore v, AziendaVinicola azv
					WHERE v.partitaIVA='".$_POST["piva"]."' OR azv.partitaIVA='".$_POST["piva"]."' OR v.password='".$_POST["pw"]."' OR azv.password='".$_POST["pw"]."'";
		 
				$partitaIVA=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
				$pIVA = mysql_fetch_assoc($partitaIVA);
				
			if(empty($pIVA))
				{$query1="INSERT INTO AziendaVinicola(nomeAz,partitaIVA,indirizzo,email,telefono,password)
										VALUES ('".addslashes($_POST["nm"])."','".$_POST["piva"]."','".$_POST["ind"]."', '".$_POST["em"]."',
												'".$_POST["tel"]."','".$_POST["pw"]."')";
				
				
				
					if($_POST["tipoAzienda"]=="cantina_sociale")
						{if(!empty($_POST["nmpr"]) and !empty($_POST["cgnmpr"]) and !empty($_POST["aafn"]))
							{										
							mysql_query($query1, $conn) or die("Inserimento fallito". mysql_error($conn));					
												
							$query2="INSERT INTO CantinaSociale(nomePres,cognomePres,annoFond,aziendaVinicola)
									VALUES ('".$_POST["nmpr"]."','".addslashes($_POST["cgnmpr"])."','".$_POST["aafn"]."', '".$_POST["piva"]."')";
							
							mysql_query($query2, $conn) or die("Inserimento fallito". mysql_error($conn));					
							header("location: a_aziendeVinicole.php?msg=Azienda inserita con successo!");
							}
							
						else
							{header("location: a_aziendeVinicole.php?msg=Errore: dati inseriti non corretti!");
							}
						}
					else
						{if($_POST["tipoAzienda"]=="azienda_privata")
							{if(!empty($_POST["nmimpr"]) and !empty($_POST["cgnmimpr"]) and !empty($_POST["gg"]) and !empty($_POST["mm"]) and !empty($_POST["aa"]))
								{if(check_data($_POST["gg"],$_POST["mm"],$_POST["aa"]) and beforeOf($_POST["gg"],$_POST["mm"],$_POST["aa"],date("d"),date("m"),date("Y")-18))
									{										
									mysql_query($query1, $conn) or die("Inserimento fallito". mysql_error($conn));	
									
									$query3="INSERT INTO AziendaPrivata(nomeImpr,cognomeImpr,dataNascita,aziendaVinicola)
									VALUES ('".$_POST["nmimpr"]."','".addslashes($_POST["cgnmimpr"])."',str_to_date('".$_POST["gg"]."/".$_POST["mm"]."/".$_POST["aa"]."','%d/%m/%Y'),
											'".$_POST["piva"]."')";
							
									mysql_query($query3, $conn) or die("Inserimento fallito". mysql_error($conn));		
									header("location: a_aziendeVinicole.php");

									}
								
								else 
									{header("location: a_aziendeVinicole.php?msg=Errore: data di nascita non valida!");
									}
								
								}
							
							else
								{header("location: a_aziendeVinicole.php?msg=Errore: dati inseriti non corretti!");
								}
							}
						
						else 
							{header("location: a_aziendeVinicole.php?msg=Errore: Tipo di azienda non selezionata! ");
							}
						}
						
				}
					
				else
					{header("location: a_aziendeVinicole.php?msg=Errore: partita IVA e/o password già assegnata! ");
					}
			
			}
			
		else
			{ header("location: a_aziendeVinicole.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM AziendaVinicola 
				WHERE partitaIVA='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_aziendeVinicole.php?msg=Azienda eliminata con successo!");
		}		
	
?>