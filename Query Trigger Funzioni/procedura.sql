/*procedura*/
drop procedure if exists AumentoSociDi;
drop procedure if exists AggiornamentoSaldoBonifico;

DELIMITER //
CREATE PROCEDURE AumentoSociDi(NomeAzienda VARCHAR(20))
BEGIN 
	
	UPDATE ContrattoDiVendita cdv
	SET prezzoUva_Quintale = prezzoUva_Quintale + (10*prezzoUva_Quintale/100)
	WHERE cdv.aziendaVinicola=(SELECT partitaIVa
								FROM AziendaVinicola
								WHERE nomeAz= NomeAzienda);
END //


CREATE PROCEDURE AggiornamentoSaldoBonifico(NomeAzienda VARCHAR(20))
BEGIN

	DECLARE indexContratto INT;
	DECLARE nuovoSaldo FLOAT(10,2);

	SET indexContratto=1;


	WHILE (indexContratto <= (SELECT COUNT(*)
							 FROM ContrattoDiVendita cdv
							 WHERE cdv.aziendaVinicola=(SELECT partitaIVa
														FROM AziendaVinicola
														WHERE nomeAz= NomeAzienda)
						    )	
		 )

	DO
		SET @riga:=0;	
		SET @riga2:=0;

		SET nuovoSaldo=(SELECT (cdv2.quintaliUva * cdv2.prezzoUva_Quintale)
						FROM ContrattoDiVendita AS cdv2 JOIN (SELECT @riga:=@riga+1 AS indiceRiga, codContratto 
															FROM ContrattoDiVendita 
															WHERE aziendaVinicola =(SELECT partitaIVa
																					FROM AziendaVinicola
																					WHERE nomeAz= NomeAzienda)
															) AS cdv_enum 
														ON cdv2.codContratto=cdv_enum.codContratto
						WHERE cdv_enum.indiceRiga=indexContratto
						);
				 

		UPDATE Bonifico b
		SET saldo=nuovoSaldo
		WHERE b.contrattoVendita=(SELECT cdv3.codContratto
								  FROM ContrattoDiVendita AS cdv3 JOIN (SELECT @riga2:=@riga2+1 AS indiceRiga, codContratto 
																	   FROM ContrattoDiVendita 
																	   WHERE aziendaVinicola =(SELECT partitaIVa
																								FROM AziendaVinicola
																								WHERE nomeAz= NomeAzienda)
																	   ) AS cdv_enum
																	ON cdv3.codContratto=cdv_enum.codContratto
									WHERE cdv_enum.indiceRiga=indexContratto
								  );
		

		SET indexContratto = indexContratto + 1;

	END WHILE;
	
	
END // 
DELIMITER ;


/*call AumentoSociDi('Foss Marai');
call AggiornamentoSaldoBonifico('Foss Marai');

*/