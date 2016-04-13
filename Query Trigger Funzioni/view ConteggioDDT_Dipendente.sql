DROP VIEW IF EXISTS ConteggioDDT_Dipendente;

CREATE VIEW ConteggioDDT_Dipendente(Anno,Dipendente,Nfirme) 
AS
SELECT cdv.anno, DDT.dipendente, COUNT(*)
FROM DDT JOIN ContrattoDiVendita cdv ON DDT.contrattoVendita=cdv.codContratto
GROUP BY cdv.anno, DDT.dipendente;
