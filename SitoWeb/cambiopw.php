<?php
	include("connDB.php");
	include("functions.php");
	
	if($_REQUEST['user']=='admin')
		{if(!empty($_POST["usnm"]) and !empty($_POST["pw"]) and !empty($_POST["cnpw"]) and $_POST["pw"]==$_POST["cnpw"] and lunMin($_POST["pw"],6) and lunMin($_POST["cnpw"],6))
			{$query=" UPDATE AdminWeb
					SET password='".$_POST["pw"]."'
					WHERE username='".$_POST["usnm"]."'";
				
			$nuovapw = mysql_query($query, $conn) or die("Inserimento fallito". mysql_error($conn));
			header("location: admin/admin_info.php");
			}
			
		else 
			{header("location: admin/admin_info.php?msg=Errore: dati inseriti non corretti!");
			}
		}
			
	else 
		{if($_REQUEST['user']=='viticoltore')
			{if(!empty($_POST["usnm"]) and !empty($_POST["pw"]) and !empty($_POST["cnpw"]) and $_POST["pw"]==$_POST["cnpw"] and lunMin($_POST["pw"],6) and lunMin($_POST["cnpw"],6))
				{$query=" UPDATE Viticoltore
						SET password='".$_POST["pw"]."'
						WHERE partitaIVA ='".$_POST["usnm"]."'";
			
				$nuovapw = mysql_query($query, $conn) or die("Inserimento fallito". mysql_error($conn));
				header("location: vit_az/vit_info.php");
				}
			else 
				{header("location: vit_az/vit_info.php?msg=Errore: dati inseriti non corretti!");
				}
			}
			
		else
			{if($_REQUEST['user']=='aziendavinicola')
				{if(!empty($_POST["usnm"]) and !empty($_POST["pw"]) and !empty($_POST["cnpw"]) and $_POST["pw"]==$_POST["cnpw"] and lunMin($_POST["pw"],6) and lunMin($_POST["cnpw"],6))
					{$query=" UPDATE AziendaVinicola
							SET password='".$_POST["pw"]."'
							WHERE partitaIVA ='".$_POST["usnm"]."'";
					
					$nuovapw = mysql_query($query, $conn) or die("Inserimento fallito". mysql_error($conn));
					header("location: vit_az/azv_info.php");
					}
				else 
					{header("location: vit_az/azv_info.php?msg=Errore: dati inseriti non corretti!");
					}
				
		
				}
				
			}
		}

		
?>