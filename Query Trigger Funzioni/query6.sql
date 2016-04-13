SELECT cdv.anno AS Anno, azv.nomeAz AS Azienda, AVG(cdv.quintaliUva) AS mediaQuintali
FROM ContrattoDiVendita cdv JOIN AziendaVinicola azv ON cdv.aziendaVinicola=azv.partitaIVA
WHERE azv.email IS NOT NULL AND cdv.viticoltore IN (SELECT partitaIVA
													FROM Viticoltore
													WHERE ettari<10000 OR ettari>40000)
GROUP BY cdv.anno,azv.partitaIVA
