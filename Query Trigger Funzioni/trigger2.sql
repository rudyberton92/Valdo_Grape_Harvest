drop trigger if exists before_contratto_insert;

DELIMITER //
CREATE TRIGGER before_contratto_insert
BEFORE INSERT ON ContrattoDiVendita
FOR EACH ROW
BEGIN

	IF(NEW.anno IN (SELECT anno
					FROM ContrattoDiVendita)
		AND
		NEW.aziendaVinicola IN (SELECT aziendaVinicola
								FROM ContrattoDiVendita
                                WHERE anno=NEW.anno)
		AND
		NEW.viticoltore IN (SELECT viticoltore
							FROM ContrattoDiVendita
                            WHERE anno=NEW.anno AND aziendaVinicola=NEW.aziendaVinicola)
		)

	THEN
		SET NEW.codContratto=(SELECT codContratto
							FROM ContrattoDiVendita
							WHERE anno=NEW.anno AND viticoltore=NEW.viticoltore AND aziendaVinicola=NEW.aziendaVinicola);
		
        
	END IF;

END //
DELIMITER ;