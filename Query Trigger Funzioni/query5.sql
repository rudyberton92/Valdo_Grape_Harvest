SELECT azv.nomeAz AS Azienda, v.nome AS nomeViticoltore, v.cognome AS cognomeViticoltore
FROM Viticoltore v, AziendaVinicola azv
WHERE (v.partitaIVA,azv.partitaIVA) IN
		(SELECT cdv.viticoltore, cdv.aziendaVinicola
		FROM Bonifico b JOIN ContrattoDiVendita cdv ON b.contrattoVendita=cdv.codContratto
		WHERE EXTRACT(MONTH FROM DataVersamento)<=EXTRACT(MONTH FROM DATE_SUB(dataTermine, INTERVAL 2 MONTH))
				AND
			EXTRACT(YEAR FROM DataVersamento)=EXTRACT(YEAR FROM DATE_SUB(dataTermine, INTERVAL 2 MONTH))
		)