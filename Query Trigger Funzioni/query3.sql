SELECT v.nome AS Nome, v.cognome AS Cognome,
    date_format(v.dataNascita, '%d/%m/%Y') AS DataNascita, 
  		    azv.nomeAz AS Azienda
FROM Viticoltore v, AziendaVinicola azv
WHERE v.partitaIVA 
IN (SELECT viticoltore
				       FROM Socio
				       WHERE cantinaSociale = (SELECT aziendaVinicola
								      FROM Dipendente
WHERE nome="Federico" AND 
cognome="Busetto"
								      )
				     )
	AND  azv.partitaIVA=(SELECT aziendaVinicola
						    FROM Dipendente
						    WHERE nome="Federico" AND cognome="Busetto"
						    )

UNION

SELECT v.nome AS Nome, v.cognome AS Cognome,
    date_format(v.dataNascita, '%d/%m/%Y') AS DataNascita,
    azv.nomeAz AS Azienda
FROM Viticoltore v, AziendaVinicola azv
WHERE v.partitaIVA 
		IN (SELECT viticoltore
		       FROM Socio
		       WHERE cantinaSociale = (SELECT aziendaVinicola
						     FROM Dipendente
     WHERE nome="Antonio" AND cognome="Franco"
						    )
		    )
	   AND azv.partitaIVA = (SELECT aziendaVinicola
				        FROM Dipendente
			                    WHERE nome="Antonio" AND cognome="Franco"
			                   );
