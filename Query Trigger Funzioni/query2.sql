SELECT v.nome AS Nome, v.cognome AS Cognome, SUM(b.saldo) AS Guadagno
FROM Viticoltore v JOIN ContrattoDiVendita cdv ON v.partitaIVA=cdv.viticoltore, Bonifico b
WHERE cdv.codContratto=b.contrattoVendita 
     AND 
     cdv.viticoltore NOT IN (SELECT viticoltore
			    FROM ContrattoDiVendita
			    WHERE aziendaVinicola IN (SELECT aziendaVinicola
							  FROM CantinaSociale
							)
                            )
GROUP BY cdv.viticoltore