<?php

	function data_it($data)
	{
	  // Creo una array dividendo la data YYYY-MM-DD sulla base del trattino
	  $array = explode("-", $data); 

	  // Riorganizzo gli elementi in stile DD/MM/YYYY
	  $data_it = $array[2]."/".$array[1]."/".$array[0]; 

	  // Restituisco il valore della data in formato italiano
	  return $data_it; 
	}
	
	
	function dataora_it($dataOra)
	{$array = preg_split("/[-\s:]+/", $dataOra); 
	$data_it = $array[2]."/".$array[1]."/".$array[0]; 
	$time_it= $array[3].":".$array[4];
	
	return $data_it." ".$time_it;
	}
	
	function check_data($giorno,$mese,$anno)
	{if($giorno<=0 or $mese<=0 or $giorno>31 or $mese>12)
		{return false;}
	else
		{switch($mese) 
			{case "01":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
				
			case "02":
				if($giorno<=28) 
					{return true;}
				else
				{return false;};
				break;
			
			case "03":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
				
			case "04":
				if($giorno<=30) 
					{return true;}
				else
				{return false;};
				break;
				
			case "05":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
				
			case "06":
				if($giorno<=30) 
					{return true;}
				else
				{return false;};
				break;
			
			case "07":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
			
			case "08":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
				
			case "09":
				if($giorno<=30) 
					{return true;}
				else
				{return false;};
				break;
			
			case "10":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
				
			case "11":
				if($giorno<=30) 
					{return true;}
				else
				{return false;};
				break;
				
			case "12":
				if($giorno<=31) 
					{return true;}
				else
				{return false;};
				break;
				
			default: return false;

			}
		}
		
	}
	
		
	function check_time($ora,$minuto)
		{ if($ora<0 or $ora>23 or $minuto<0 or $minuto>59)
			{return false;
			}
		else
			{return true;
			}
		}
		
	
	function beforeOf($giorno1,$mese1,$anno1,$giorno2,$mese2,$anno2)
		{
		if(($mese1>$mese2 and $anno1==$anno2) or $anno1>$anno2)
			{return false;
			}
		else	
			{if($giorno1>$giorno2 and $mese1==$mese2 and $anno1==$anno2)
				{return false;
				}
			else
				{return true;
				}
			}					
		}
	
	function lunMin	($dato, $lung) 
		{$num=strlen($dato);
		if ($num>=$lung)
			{return true;
			}
		else
			{return false;
			}
	
		}
		
		
	
	
	
?>