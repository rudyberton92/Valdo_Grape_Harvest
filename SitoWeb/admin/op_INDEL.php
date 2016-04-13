<?php 
	include("../connDB.php");
	include("../functions.php");
	
	if(isset($_GET['inserisci']))
		{if(!empty($_POST["nm"]) and !empty($_POST["cgnm"]) and !empty($_POST["CF"])
			and !empty($_POST["gg"]) and !empty($_POST["mm"]) and !empty($_POST["aa"]) and !empty($_POST["ind"]) and !empty($_POST["OpDi"]) and lunMin($_POST["CF"],16))
			{	$query="SELECT codFiscale
					FROM Operaio
					WHERE codFiscale='".$_POST["CF"]."'";
		 
				$codFiscale=mysql_query($query,$conn) or die("Query fallita" . mysql_error($conn));
				$CF = mysql_fetch_assoc($codFiscale);
				
				$vit=explode(" ", $_POST["OpDi"]);
				$cognome=$vit[1]." ".$vit[2];
				
				$query3="SELECT partitaIVA
						FROM Viticoltore
						WHERE nome='".$vit[0]."' AND cognome='".addslashes($cognome)."'";

				$viticoltoreCapo=mysql_query($query3,$conn) or die("Query fallita" . mysql_error($conn));
				$vitCapo = mysql_fetch_assoc($viticoltoreCapo);
						
				if(empty($CF))
					{if(check_data($_POST["gg"],$_POST["mm"],$_POST["aa"]) and beforeOf($_POST["gg"],$_POST["mm"],$_POST["aa"],date("d"),date("m"),date("Y")-18))
						{$query4=" INSERT INTO Operaio(nome,cognome,codFiscale,indirizzo,dataNascita,viticoltore)
								VALUES ('".$_POST["nm"]."','".addslashes($_POST["cgnm"])."','".$_POST["CF"]."', '".$_POST["ind"]."',
										str_to_date('".$_POST["gg"]."/".$_POST["mm"]."/".$_POST["aa"]."','%d/%m/%Y'),
										'".$vitCapo['partitaIVA']."')";
					
			
						mysql_query($query4, $conn) or die("Inserimento fallito". mysql_error($conn));
						header("location: a_operai.php?msg=Operaio inserito con successo!");
						}
					else
						{header("location: a_operai.php?msg=Errore: data di nascita non valida!");
						}
					}
					
				else
					{$query2="SELECT v.nome,v.cognome
								FROM Viticoltore v JOIN Operaio o ON o.viticoltore=v.partitaIVA
								WHERE o.codFiscale='".$_POST["CF"]."'";
					
					$Padrone=mysql_query($query2,$conn) or die("Query fallita" . mysql_error($conn));
					$Capo = mysql_fetch_assoc($Padrone);
					
					header("location: a_operai.php?msg=Errore: Questo operaio lavora già per ".$Capo['nome']." ".$Capo['cognome']."!");
					}
			}
			
		else
			{header("location: a_operai.php?msg=Errore: dati inseriti non corretti!");
			}
		}
		
		
		
	if(isset($_GET['elimina'])) 
		{$query="DELETE FROM Operaio 
				WHERE codFiscale='".$_GET["elimina"]."'";
		
		mysql_query($query, $conn) or die("Eliminazione fallita". mysql_error($conn));
		header("location: a_operai.php?msg=Operaio eliminato con successo!");
		}		
	
	
?>