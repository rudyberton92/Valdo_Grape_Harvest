SELECT  v.nome AS Nome,v.cognome AS Cognome, cdv.codContratto AS Contratto, azv.nomeAz AS Azienda
FROM ContrattoDiVendita cdv JOIN Viticoltore v ON cdv.viticoltore=v.partitaIVA,AziendaVinicola azv
WHERE cdv.quintaliUva>=200 AND cdv.aziendaVinicola=azv.partitaIVA
	AND v.partitaIVA <>ALL (SELECT v2.partitaIVA
							FROM Viticoltore v2 JOIN Operaio op ON op.viticoltore=v2.partitaIVA
							GROUP BY op.viticoltore
							HAVING COUNT(*) >3
							)

