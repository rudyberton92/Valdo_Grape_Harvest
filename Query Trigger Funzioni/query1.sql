SELECT cdd.Anno AS Anno, d.nome AS Nome, d.cognome AS Cognome, 
	   cdd.Nfirme AS Bolle_Firmate, azv.nomeAz AS Azienda
FROM ConteggioDDT_Dipendente cdd JOIN Dipendente d 
	 ON cdd.Dipendente=d.codFiscale, AziendaVinicola azv
WHERE d.aziendaVinicola= azv.partitaIVA 
	AND cdd.Nfirme IN (SELECT MAX(Nfirme)
				FROM ConteggioDDT_Dipendente
				GROUP BY Anno
				)
ORDER BY cdd.Anno ASC