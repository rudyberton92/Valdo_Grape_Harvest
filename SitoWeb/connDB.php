<?php

	$host="basidati.studenti.math.unipd.it" ; /* server MySQL */
	$user="rberton"; /* utente */
	$pwd="ufGp2agV"; /* password */

	/*connessione al server */
	$conn=mysql_connect($host, $user, $pwd) or die($_SERVER['PHP_SELF'] . ": $msg<br />"."Connessione fallita!");
	
	$dbname="rberton-PR";
	mysql_select_db($dbname);
	

?>
