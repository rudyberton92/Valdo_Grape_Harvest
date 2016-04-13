drop trigger if exists after_socio_insert;

DELIMITER //
CREATE TRIGGER after_socio_insert
AFTER INSERT ON Socio
FOR EACH ROW 
BEGIN

	SET @numSoci=(SELECT COUNT(viticoltore)
		FROM Socio
		WHERE cantinaSociale=NEW.cantinaSociale);

	IF (@numSoci=8)

	THEN
		SET @NomeAz= (SELECT nomeAz
					FROM AziendaVinicola
					WHERE partitaIVA=NEW.cantinaSociale);

		CALL AumentoSociDi(@NomeAz);
		CALL AggiornamentoSaldoBonifico(@NomeAz);

	END IF;
	

END //

DELIMITER ;