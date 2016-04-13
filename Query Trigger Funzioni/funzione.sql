DROP FUNCTION IF EXISTS mediaUsciteAziende;

DELIMITER //

CREATE FUNCTION mediaUsciteAziende(daMese INT, aMese INT, anno INT) 
	RETURNS FLOAT(10,2)

BEGIN
	DECLARE sommaSaldo FLOAT(10,2);
	DECLARE numAziende INT;
	DECLARE media FLOAT(10,2); 

	IF (daMese<aMese) 
	THEN
		SET numAziende= (SELECT COUNT(*)
						FROM AziendaVinicola);
	
		SET sommaSaldo= (SELECT SUM(saldo)
						FROM Bonifico
						WHERE MONTH(dataVersamento)>= daMese AND MONTH(dataVersamento)<=aMese AND YEAR(dataVersamento)=anno
						);
	
		SET media= sommaSaldo/numAziende;

		RETURN media;
	END IF;

END //

DELIMITER ;

/*SELECT mediaUsciteAziende(1,4,2014);*/