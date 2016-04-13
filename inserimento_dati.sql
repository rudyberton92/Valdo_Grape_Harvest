set foreign_key_checks=0;

truncate Viticoltore;
truncate AziendaVinicola;
truncate AziendaPrivata;
truncate CantinaSociale;
truncate Dipendente;
truncate DDT;
truncate ContrattoDiVendita;
truncate Operaio;
truncate Bonifico;
truncate Socio;

truncate AdminWeb;

insert into Viticoltore(nome, cognome, partitaIVA, dataNascita, indirizzo, ettari,password)
values
('Romeo','Berton',56819440314, 
str_to_date('07/04/1961','%d/%m/%Y'),
'Via Villanova 67', 40000,'vrb1122'),

('Alessandro','Rossi', 49552600187,
str_to_date('17/02/1954','%d/%m/%Y'),
'Via Erizzo 10', 50000,'var2233'),

('Flavio', 'Vedova', 11469023318,
str_to_date('23/10/1965','%d/%m/%Y'),
'Via Ponteggio 32', 20000,'vfv3344'),

('Maurizio', 'Berton', 85384931017,
str_to_date('13/09/1964','%d/%m/%Y'),
'Via Villanova 110', 10000,'vmb4455'),

('Alberto', 'Frare', 53926619030,
str_to_date('24/03/1970','%d/%m/%Y'),
'Via Erizzo 64',40000,'vaf5566'),

('Paolo', 'Reghini', 82034992313,
str_to_date('03/12/1962','%d/%m/%Y'),
'Via San Giacomo 11', 20000,'vpr6677'),

('Valentina','Cargnel',70430299194,
str_to_date('23/07/1958','%d/%m/%Y'),
'Via Spinade 45', 20000,'vvc7788'),

('Antonio', 'Bianchi',99468262163,
str_to_date('29/08/1986','%d/%m/%Y'),
'Via Erizzo 120',10000,'vab8899'),

('Carmen', 'Bronca', 37429197425,
str_to_date('06/10/1963','%d/%m/%Y'),
'Via Santo Stefano 111',50000,'vcb9911'),

('Fiorella', 'Vedova', 87340929311,
str_to_date('02/06/1957','%d/%m/%Y'),
'Via Europa 34',40000,'vfv1010');


insert into Socio (viticoltore, cantinaSociale) 
values
(56819440314,50163544802),
(70430299194,50163544802),
(37429197425,50163544802),
(49552600187,72428461418),
(53926619030,72428461418),
(99468262163,72428461418),
(56819440314,93655927485),
(49552600187,93655927485),
(11469023318,93655927485),
(85384931017,93655927485),
(37429197425,93655927485),
(49552600187,82517484911),
(53926619030,82517484911),
(37429197425,82517484911);


insert into AziendaVinicola(nomeAz,partitaIVA,indirizzo,email,telefono,password)
values
('Le Bertole',92729174618,
'Via Europa 35', null, 0423968472,'av1122lb'),

('La Casa Vecchia',27381779216,
'Via Callonga 8','lacasavecchia@gmail.com',
0423876753,'av2233lcv'),

('San Gregorio',37529642992,
'Via San Gregorio 8', null, 0423994612,'av3344sg'),

('Il Follo', 24285618390,
'Via Follo 36','ilfollo@gmail.com',
0423972453,'av4455if'),

('Foss Marai',83517481901,
'Via Strada delle Treziese 1', null,
0423861183,'av5566fm'),

('Marsuret',46283072039,
'Via Colderove 4', null,
0423863911,'av6677m'),

('Ruggeri',50163544802,
'Via Fontana 15','ruggieri@gmail.com',
0423678217,'av7788r'),

('Valdo Spumanti',72428461418,
'Via Tessere 18', null,0423896317,'av8899vs'),

('Val D\'Oca', 93655927485,
'Via San Giovanni 45','valdoca@gmail.com',
0423982045,'av9911vo'),

('Bortolomiol', 82517484911,
'Via Roma 48', null,0423758891,'av1010b');


insert into AziendaPrivata(nomeImpr, cognomeImpr,dataNascita, aziendaVinicola)
values
('Francesco', 'Bortolin',
str_to_date('17/05/1967','%d/%m/%Y'),
92729174618),

('Emanuele', 'Follador',
str_to_date('18/01/1952','%d/%m/%Y'),
27381779216),

('Alberto', 'Frare',
str_to_date('02/08/1950','%d/%m/%Y'),
37529642992),

('Enrico','Bassi',
str_to_date('10/06/1961','%d/%m/%Y'),
24285618390),

('Paolo', 'Sanzovo',
str_to_date('16/11/1967','%d/%m/%Y'),
83517481901),

('Fabio', 'Marsuret', 
str_to_date('27/04/1960','%d/%m/%Y'),
46283072039);


insert into CantinaSociale(nomePres, cognomePres, annoFond,aziendaVinicola)
values
('Paolo', 'Bisol',1950,50163544802),
('Pierluigi','Bolla',1926,72428461418),
('Franco','Varaschin',1932,93655927485),
('Ottavia','Scagliotti',1945,82517484911);

insert into Dipendente(nome,cognome,codFiscale,dataNascita,aziendaVinicola)
values
('Andrea','Rizzo','RZZNDR76C52L565S',
str_to_date('12/03/1976','%d/%m/%Y'),
27381779216),

('Ettore','Bronca','BRNTTR58S43L565S',
str_to_date('03/11/1958','%d/%m/%Y'),
27381779216),

('Matteo', 'Bello','BLLMTT92L50L565G',
str_to_date('10/07/1992','%d/%m/%Y'),
37529642992),

('Riccardo','Bucco','BCCRCR86H69L565C',
str_to_date('29/06/1986','%d/%m/%Y'),
37529642992),

('Marco','Giorgio','GRGMRC90P54L565U',
str_to_date('14/09/1990','%d/%m/%Y'),
37529642992),

('Paolo','Berton','BRTPLA88R47L565T',
str_to_date('07/10/1988','%d/%m/%Y'),
50163544802),

('Antonio','Franco','FRNNTN79C58L565G',
str_to_date('18/03/1979','%d/%m/%Y'),
50163544802),

('Renato', 'Bisol', 'BSLRNT94E64L565O',
str_to_date('24/05/1994','%d/%m/%Y'),
72428461418),

('Giovanni','Bronca','BRNGNN89A67L565P',
str_to_date('27/01/1989','%d/%m/%Y'),
72428461418),

('Thomas','Nardi','NRDTMS83D62L565A',
str_to_date('22/04/1983','%d/%m/%Y'),
72428461418),

('Carlo','Mattiola','MTTCRL80T41L565W',
str_to_date('01/12/1980','%d/%m/%Y'),
93655927485),

('Federico','Busetto','BSTFRC92M55L565T',
str_to_date('15/08/1992','%d/%m/%Y'),
93655927485),

('Giacomo','Nardi','NRDGCM86E48L565L',
str_to_date('08/05/1986','%d/%m/%Y'),
93655927485),

('Stefano','Prosdocimo','PRSSFN60B49L565D',
str_to_date('09/02/1960','%d/%m/%Y'),
93655927485),

('Luca', 'De Stefani', 'DSTLCU68D50L565Y',
str_to_date('10/04/1968','%d/%m/%Y'),
82517484911),

('Mario','De Stefani','DSTMRA84H46L565F',
str_to_date('06/06/1984','%d/%m/%Y'),
82517484911),

('Stefano','Rossi','RSSSFN69C17L565Q',
str_to_date('17/03/1969','%d/%m/%Y'),
92729174618),

('Gianni','Dall\'Acqua','DLLGNN74L12L565F',
str_to_date('12/07/1974','%d/%m/%Y'),
24285618390),

('Alessio','Mariuzzo','MRZLSS85C04L565Y',
str_to_date('04/03/1985','%d/%m/%Y'),
83517481901),

('Omar','Zago','ZGAMRO89P08L565B',
str_to_date('08/09/1989','%d/%m/%Y'),
46283072039);

insert into ContrattoDiVendita(codContratto, anno, quintaliUva,prezzoUva_Quintale,viticoltore,aziendaVinicola)
values
('CV13-007',2013,120,117,56819440314,92729174618),
('CV13-622',2013,220,160,56819440314,50163544802),
('CV13-833',2013,200,135,56819440314,93655927485),
('CV14-019',2014,300,185,56819440314,50163544802),
('CV14-417',2014,240,160,56819440314,93655927485),
('CV13-844',2013,250,130,49552600187,72428461418),
('CV13-163',2013,200,125,49552600187,93655927485),
('CV13-846',2013,75,117,49552600187,83517481901),
('CV13-281',2013,150,114,49552600187,46283072039),
('CV14-627',2014,290,190,49552600187,72428461418),
('CV14-312',2014,290,175,49552600187,93655927485),
('CV14-152',2014,185,180,49552600187,82517484911),
('CV13-722',2013,100,113,11469023318,37529642992),
('CV13-015',2013,170,145,11469023318,93655927485),
('CV14-429',2014,130,160,11469023318,93655927485),
('CV14-831',2014,70,120,11469023318,27381779216),
('CV14-190',2014,70,121,11469023318,92729174618),
('CV13-165',2013,100,137,85384931017,93655927485),
('CV13-525',2013,35,113,85384931017,46283072039),
('CV14-341',2014,65,140,85384931017,93655927485),
('CV14-029',2014,70,122,85384931017,46283072039),
('CV13-415',2013,240,145,53926619030,82517484911),
('CV13-932',2013,40,113,53926619030,83517481901),
('CV13-115',2013,260,155,53926619030,72428461418),
('CV14-107',2014,220,177,53926619030,82517484911),
('CV14-111',2014,60,121,53926619030,24285618390),
('CV14-102',2014,260,175,53926619030,72428461418),
('CV13-272',2013,20,109,82034992313,24285618390),
('CV14-002',2014,30,120,82034992313,92729174618),
('CV13-122',2013,200,160,70430299194,50163544802),
('CV13-091',2013,70,111,70430299194,83517481901),
('CV14-281',2014,270,190,70430299194,50163544802),
('CV13-109',2013,135,163,99468262163,72428461418),
('CV14-034',2014,110,187,99468262163,72428461418),
('CV14-623',2014,25,117,99468262163,37529642992),
('CV13-718',2013,300,140,37429197425,50163544802),
('CV13-911',2013,200,138,37429197425,93655927485),
('CV13-038',2013,135,135,37429197425,82517484911),
('CV13-771',2013,40,115,37429197425,83517481901),
('CV14-519',2014,450,185,37429197425,50163544802),
('CV14-321',2014,150,170,37429197425,93655927485),
('CV14-632',2014,75,163,37429197425,82517484911),
('CV13-967',2013,40,109,87340929311,24285618390),
('CV13-728',2013,150,114,87340929311,92729174618),
('CV14-523',2014,90,123,87340929311,37529642992),
('CV14-235',2014,50,119,87340929311,27381779216);


insert into DDT(codBolla, quantitaCarico,luogo,dataOra,dipendente,contrattoVendita)
values
('BL7281',60,'Via Tessere',
str_to_date('10/09/13 17.45','%d/%m/%Y %H.%i'),
'RSSSFN69C17L565Q','CV13-007'),

('BL8362',60,'Via Tessere',
str_to_date('11/09/13 18.15','%d/%m/%Y %H.%i'),
'RSSSFN69C17L565Q','CV13-007'),

('BL0173',75, 'Via Tessere',
str_to_date('11/09/13 13.00','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV13-622'),

('BL7215',75,'Via San Giacomo',
str_to_date('12/09/13 13.45','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV13-622'),

('BL9216',70,'Via San Giacomo',
str_to_date('12/09/13 18.30','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV13-622'),

('BL0192',105,'Via Tessere',
str_to_date('05/09/13 18.00','%d/%m/%Y %H.%i'),
'BSTFRC92M55L565T','CV13-833'),

('BL5142',95,'Via San Giacomo',
str_to_date('07/09/13 17.30','%d/%m/%Y %H.%i'),
'PRSSFN60B49L565D','CV13-833'),

('BL4421',100,'Via Saccol',
str_to_date('10/09/13 19.05','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV13-844'),

('BL6178',85,'Via Saccol',
str_to_date('12/09/13 18.00','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV13-844'),

('BL4163',65,'Via Bach',
str_to_date('13/09/13 16.15','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV13-844'),

('BL7816',100,'Via Bach',
str_to_date('15/09/13 18.50','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV13-163'),

('BL0237',100,'Via Bach',
str_to_date('16/09/13 19.30','%d/%m/%Y %H.%i'),
'PRSSFN60B49L565D','CV13-163'),

('BL0751',75,'Via Saccol',
str_to_date('17/09/13 17.00','%d/%m/%Y %H.%i'),
'MRZLSS85C04L565Y','CV13-846'),

('BL0013',80,'Via Saccol',
str_to_date('18/09/13 18.15','%d/%m/%Y %H.%i'),
'ZGAMRO89P08L565B','CV13-281'),

('BL0217',70,'Via Saccol',
str_to_date('19/09/13 18.05','%d/%m/%Y %H.%i'),
'ZGAMRO89P08L565B','CV13-281'),

('BL0927',100,'Via San Pietro',
str_to_date('17/09/13 19.00','%d/%m/%Y %H.%i'),
'GRGMRC90P54L565U','CV13-722'),

('BL1621',80,'Via San Pietro',
str_to_date('08/09/13 17.30','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV13-015'),

('BL5132',90,'Via San Pietro',
str_to_date('09/09/13 18.20','%d/%m/%Y %H.%i'),
'BSTFRC92M55L565T','CV13-015'),

('BL5631',100,'Via Ponteggio',
str_to_date('06/09/13 19.25','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV13-165'),

('BL8371',35,'Via Ponteggio',
str_to_date('08/09/13 14.35','%d/%m/%Y %H.%i'),
'ZGAMRO89P08L565B','CV13-525'),

('BL4132',60,'Via Saccol',
str_to_date('11/09/13 17.00','%d/%m/%Y %H.%i'),
'DSTLCU68D50L565Y','CV13-415'),

('BL8721',100,'Via Saccol',
str_to_date('12/09/13 18.55','%d/%m/%Y %H.%i'),
'DSTMRA84H46L565F','CV13-415'),

('BL7721',80,'Via Saccol',
str_to_date('13/09/13 17.45','%d/%m/%Y %H.%i'),
'DSTLCU68D50L565Y','CV13-415'),

('BL7121',40,'Via Saccol',
str_to_date('16/09/13 15.45','%d/%m/%Y %H.%i'),
'MRZLSS85C04L565Y','CV13-932'),

('BL7151',90,'Via Erizzo',
str_to_date('14/09/13 18.00','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV13-115'),

('BL6152',75,'Via Erizzo',
str_to_date('15/09/13 17.05','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV13-115'),

('BL0142',95,'Via Erizzo',
str_to_date('17/09/13 19.35','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV13-115'),

('BL6013',20,'Via Giuseppe Garibaldi',
str_to_date('13/09/13 12.00','%d/%m/%Y %H.%i'),
'DLLGNN74L12L565F','CV13-272'),

('BL8161',95,'Via Tessere',
str_to_date('10/09/13 18.25','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV13-122'),

('BL6101',105,'Via Tessere',
str_to_date('11/09/13 19.50','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV13-122'),

('BL7253',70,'Via Tessere',
str_to_date('05/09/13 17.55','%d/%m/%Y %H.%i'),
'MRZLSS85C04L565Y','CV13-091'),

('BL6301',70,'Via Callonga',
str_to_date('10/09/13 18.10','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV13-109'),

('BL0021',65,'Via Callonga',
str_to_date('11/09/13 17.40','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV13-109'),

('BL6401',100,'Via Campion',
str_to_date('08/09/13 19.10','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV13-718'),

('BL3512',110,'Via Campion',
str_to_date('09/09/13 19.35','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV13-718'),

('BL0402',90,'Via Campion',
str_to_date('10/09/13 18.30','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV13-718'),

('BL0526',95,'Via Europa',
str_to_date('11/09/13 18.50','%d/%m/%Y %H.%i'),
'BSTFRC92M55L565T','CV13-911'),

('BL6271',105,'Via Europa',
str_to_date('12/09/13 19.25','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV13-911'),

('BL8013',70,'Via Europa',
str_to_date('13/09/13 17.20','%d/%m/%Y %H.%i'),
'DSTMRA84H46L565F','CV13-038'),

('BL3621',65,'Via Europa',
str_to_date('14/09/13 17.00','%d/%m/%Y %H.%i'),
'DSTLCU68D50L565Y','CV13-038'),

('BL0181',40,'Via Europa',
str_to_date('15/09/13 15.10','%d/%m/%Y %H.%i'),
'MRZLSS85C04L565Y','CV13-771'),

('BL4152',40,'Via Tessere',
str_to_date('14/09/13 19.30','%d/%m/%Y %H.%i'),
'DLLGNN74L12L565F','CV13-967'),

('BL6183',90,'Via Tessere',
str_to_date('15/09/13 18.40','%d/%m/%Y %H.%i'),
'RSSSFN69C17L565Q','CV13-728'),

('BL0178',60,'Via Tessere',
str_to_date('16/09/13 17.00','%d/%m/%Y %H.%i'),
'RSSSFN69C17L565Q','CV13-728'),

('BL1628',105,'Via San Giacomo',
str_to_date('03/09/14 19.15','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV14-019'),

('BL0184',100,'Via San Giacomo',
str_to_date('04/09/14 18.55','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-019'),

('BL8173',95,'Via Tessere',
str_to_date('05/09/14 18.20','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-019'),

('BL7168',130,'Via Tessere',
str_to_date('06/09/14 20.10','%d/%m/%Y %H.%i'),
'PRSSFN60B49L565D','CV14-417'),

('BL9388',110,'Via San Giacomo',
str_to_date('07/09/14 19.45','%d/%m/%Y %H.%i'),
'PRSSFN60B49L565D','CV14-417'),

('BL3312',100,'Via Bach',
str_to_date('03/09/14 19.10','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV14-627'),

('BL8112',100,'Via Bach',
str_to_date('04/09/14 18.55','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV14-627'),

('BL0881',90,'Via Saccol',
str_to_date('05/09/14 17.45','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV14-627'),

('BL0672',110,'Via Bach',
str_to_date('10/09/14 19.35','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV14-312'),

('BL5261',90,'Via Bach',
str_to_date('11/09/14 18.25','%d/%m/%Y %H.%i'),
'BSTFRC92M55L565T','CV14-312'),

('BL0016',90,'Via Saccol',
str_to_date('12/09/14 18.30','%d/%m/%Y %H.%i'),
'PRSSFN60B49L565D','CV14-312'),

('BL1562',90,'Via Saccol',
str_to_date('06/09/14 18.15','%d/%m/%Y %H.%i'),
'DSTMRA84H46L565F','CV14-152'),

('BL1152',95,'Via Saccol',
str_to_date('07/09/14 18.00','%d/%m/%Y %H.%i'),
'DSTMRA84H46L565F','CV14-152'),

('BL7162',70,'Via San Pietro',
str_to_date('05/09/14 17.00','%d/%m/%Y %H.%i'),
'BSTFRC92M55L565T','CV14-429'),

('BL7677',60,'Via San Pietro',
str_to_date('06/09/14 16.15','%d/%m/%Y %H.%i'),
'BSTFRC92M55L565T','CV14-429'),

('BL4442',70,'Via San Pietro',
str_to_date('04/09/14 17.25','%d/%m/%Y %H.%i'),
'RZZNDR76C52L565S','CV14-831'),

('BL5162',70,'Via San Pietro',
str_to_date('07/09/14 17.45','%d/%m/%Y %H.%i'),
'RSSSFN69C17L565Q','CV14-190'),

('BL6571',65,'Via Ponteggio',
str_to_date('08/09/14 16.10','%d/%m/%Y %H.%i'),
'PRSSFN60B49L565D','CV14-341'),

('BL3211',70,'Via Ponteggio',
str_to_date('05/09/14 17.30','%d/%m/%Y %H.%i'),
'ZGAMRO89P08L565B','CV14-029'),

('BL5612',90,'Via Saccol',
str_to_date('05/09/14 19.00','%d/%m/%Y %H.%i'),
'DSTMRA84H46L565F','CV14-107'),

('BL6653',85,'Via Saccol',
str_to_date('06/09/14 18.45','%d/%m/%Y %H.%i'),
'DSTLCU68D50L565Y','CV14-107'),

('BL3523',45,'Via Saccol',
str_to_date('07/09/14 14.00','%d/%m/%Y %H.%i'),
'DSTLCU68D50L565Y','CV14-107'),

('BL2332',60,'Via Saccol',
str_to_date('04/09/14 18.00','%d/%m/%Y %H.%i'),
'DLLGNN74L12L565F','CV14-111'),

('BL5517',90,'Via Erizzo',
str_to_date('10/09/14 18.35','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV14-102'),

('BL0799',70,'Via Erizzo',
str_to_date('11/09/14 17.30','%d/%m/%Y %H.%i'),
'NRDTMS83D62L565A','CV14-102'),

('BL1052',100,'Via Erizzo',
str_to_date('12/09/14 19.20','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV14-102'),

('BL0444',30,'Via Giuseppe Garibaldi',
str_to_date('03/09/14 11.15','%d/%m/%Y %H.%i'),
'RSSSFN69C17L565Q','CV14-002'),

('BL3168',90,'Via Tessere',
str_to_date('03/09/14 18.35','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-281'),

('BL9719',95,'Via Tessere',
str_to_date('04/09/14 19.00','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV14-281'),

('BL7001',85,'Via Tessere',
str_to_date('05/09/14 18.05','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-281'),

('BL5179',60,'Via Callonga',
str_to_date('06/09/14 16.35','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV14-034'),

('BL5164',50,'Via Callonga',
str_to_date('07/09/14 15.30','%d/%m/%Y %H.%i'),
'BSLRNT94E64L565O','CV14-034'),

('BL7791',25,'Via Callonga',
str_to_date('05/09/14 11.05','%d/%m/%Y %H.%i'),
'BLLMTT92L50L565G','CV14-623'),

('BL4562',100,'Via Campion',
str_to_date('03/09/14 19.40','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-519'),

('BL1234',95,'Via Campion',
str_to_date('04/09/14 18.55','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV14-519'),

('BL6154',100,'Via Campion',
str_to_date('05/09/14 19.15','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-519'),

('BL6543',95,'Via Europa',
str_to_date('06/09/14 19.00','%d/%m/%Y %H.%i'),
'BRTPLA88R47L565T','CV14-519'),

('BL9871',60,'Via Campion',
str_to_date('07/09/14 17.40','%d/%m/%Y %H.%i'),
'FRNNTN79C58L565G','CV14-519'),

('BL6781',70,'Via Europa',
str_to_date('09/09/14 18.15','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV14-321'),

('BL1479',80,'Via Campion',
str_to_date('10/09/14 18.50','%d/%m/%Y %H.%i'),
'MTTCRL80T41L565W','CV14-321'),

('BL8624',75,'Via Europa',
str_to_date('08/09/14 18.10','%d/%m/%Y %H.%i'),
'DSTMRA84H46L565F','CV14-632'),

('BL8472',90,'Via Tessere',
str_to_date('06/09/14 18.30','%d/%m/%Y %H.%i'),
'GRGMRC90P54L565U','CV14-523'),

('BL8355',50,'Via San Giacomo',
str_to_date('05/09/14 17.00','%d/%m/%Y %H.%i'),
'BRNTTR58S43L565S','CV14-235');


insert into Bonifico(saldo, dataVersamento,dataTermine,contrattoVendita)
values
(14040,str_to_date('13/03/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-007'),

(35200,str_to_date('01/02/14','%d/%m/%Y'),
str_to_date('30/04/14','%d/%m/%Y'),'CV13-622'),

(27000,str_to_date('30/03/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-833'),

(55500,str_to_date('27/01/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-019'),

(38400,str_to_date('15/04/15','%d/%m/%Y'),
str_to_date('30/04/15','%d/%m/%Y'),'CV14-417'),

(32500,str_to_date('10/04/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-844'),

(25000,str_to_date('12/04/14','%d/%m/%Y'),
str_to_date('15/05/14','%d/%m/%Y'),'CV13-163'),

(8775,str_to_date('27/03/14','%d/%m/%Y'),
str_to_date('30/04/14','%d/%m/%Y'),'CV13-846'),

(17100,str_to_date('24/01/14','%d/%m/%Y'),
str_to_date('15/02/14','%d/%m/%Y'),'CV13-281'),

(55100,str_to_date('15/03/15','%d/%m/%Y'),
str_to_date('01/04/15','%d/%m/%Y'),'CV14-627'),

(50750,str_to_date('10/04/15','%d/%m/%Y'),
str_to_date('15/05/15','%d/%m/%Y'),'CV14-312'),

(33300,str_to_date('03/03/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-152'),

(11300,str_to_date('13/04/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-722'),

(24650,str_to_date('25/02/14','%d/%m/%Y'),
str_to_date('15/03/14','%d/%m/%Y'),'CV13-015'),

(20800,str_to_date('02/03/15','%d/%m/%Y'),
str_to_date('15/03/15','%d/%m/%Y'),'CV14-429'),

(8400,str_to_date('18/03/15','%d/%m/%Y'),
str_to_date('30/04/15','%d/%m/%Y'),'CV14-831'),

(8470,str_to_date('30/03/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-190'),

(13700,str_to_date('01/03/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-165'),

(3955,str_to_date('20/04/14','%d/%m/%Y'),
str_to_date('30/04/14','%d/%m/%Y'),'CV13-525'),

(9100,str_to_date('11/03/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-341'),

(8540,str_to_date('10/04/15','%d/%m/%Y'),
str_to_date('30/04/15','%d/%m/%Y'),'CV14-029'),

(34800,str_to_date('15/03/14','%d/%m/%Y'),
str_to_date('01/04/14','%d/%m/%Y'),'CV13-415'),

(4520,str_to_date('21/02/14','%d/%m/%Y'),
str_to_date('15/03/14','%d/%m/%Y'),'CV13-932'),

(40300,str_to_date('05/03/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-115'),

(38940,str_to_date('15/01/15','%d/%m/%Y'),
str_to_date('01/04/15','%d/%m/%Y'),'CV14-107'),

(7260,str_to_date('13/04/15','%d/%m/%Y'),
str_to_date('15/05/15','%d/%m/%Y'),'CV14-111'),

(45500,str_to_date('01/02/15','%d/%m/%Y'),
str_to_date('15/03/15','%d/%m/%Y'),'CV14-102'),

(2180,str_to_date('02/04/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-272'),

(3600,str_to_date('25/02/15','%d/%m/%Y'),
str_to_date('01/04/15','%d/%m/%Y'),'CV14-002'),

(32000,str_to_date('12/03/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-122'),

(7770,str_to_date('26/03/14','%d/%m/%Y'),
str_to_date('30/04/14','%d/%m/%Y'),'CV13-091'),

(51300,str_to_date('13/03/15','%d/%m/%Y'),
str_to_date('01/04/15','%d/%m/%Y'),'CV14-281'),

(22005,str_to_date('01/04/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-109'),

(20570,str_to_date('10/04/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-034'),

(2925,str_to_date('13/03/15','%d/%m/%Y'),
str_to_date('30/04/15','%d/%m/%Y'),'CV14-623'),

(42000,str_to_date('27/02/14','%d/%m/%Y'),
str_to_date('15/03/14','%d/%m/%Y'),'CV13-718'),

(27600,str_to_date('20/03/14','%d/%m/%Y'),
str_to_date('31/03/14','%d/%m/%Y'),'CV13-911'),

(18225,str_to_date('24/03/14','%d/%m/%Y'),
str_to_date('15/04/14','%d/%m/%Y'),'CV13-038'),

(4600,str_to_date('30/03/14','%d/%m/%Y'),
str_to_date('30/04/14','%d/%m/%Y'),'CV13-771'),

(83250,str_to_date('25/03/15','%d/%m/%Y'),
str_to_date('01/04/15','%d/%m/%Y'),'CV14-519'),

(25500,str_to_date('10/03/15','%d/%m/%Y'),
str_to_date('30/04/15','%d/%m/%Y'),'CV14-321'),

(12225,str_to_date('15/03/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-632'),

(4360,str_to_date('15/03/14','%d/%m/%Y'),
str_to_date('01/04/14','%d/%m/%Y'),'CV13-967'),

(17100,str_to_date('25/04/14','%d/%m/%Y'),
str_to_date('15/05/14','%d/%m/%Y'),'CV13-728'),

(11070,str_to_date('30/03/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-523'),

(5950,str_to_date('10/04/15','%d/%m/%Y'),
str_to_date('15/04/15','%d/%m/%Y'),'CV14-235');



insert into Operaio(nome,cognome,codFiscale,indirizzo,dataNascita,viticoltore)
values
('Vanda','Dall\'Acqua',
'DLLVND56L58L565A',
'Via Erizzo 17',
str_to_date('21/11/1953','%d/%m/%Y'),
56819440314),

('Jessica','Berton',
'BRTJSC84C61L565B',
'Via Villanova 67',
str_to_date('13/07/1984','%d/%m/%Y'),
56819440314),

('Benedetta','Dall\'Acqua',
'DLLBDT62P59L565I',
'Via Villanova 67 ',
str_to_date('19/09/1962','%d/%m/%Y'),
56819440314),

('Andrea','Dal Molin',
'DLMNDR91C01L565N',
'Via Erizzo 88',
str_to_date('01/03/1991','%d/%m/%Y'),
56819440314),

('Leonardo','Collavo',
'CLLLRD91E25L565B',
'Via Piva 11',
str_to_date('24/05/1991','%d/%m/%Y'),
53926619030),

('Felice', 'Bortolin',
'BRTFLC44M08L565F',
'Via Strada Rosa 03',
str_to_date('08/08/1944','%d/%m/%Y'),
53926619030),

('Aldo','Franco',
'FRNLDA69T17L565L',
'Via Tessere 02',
str_to_date('17/12/1969','%d/%m/%Y'),
53926619030),

('Matteo','Franco',
'FRNMTT82B14L565N',
'Via Tessere 02',
str_to_date('14/02/1982','%d/%m/%Y'),
53926619030),

('Maria','Mattiola',
'MTTMRA64L70L565P',
'Via Erizzo 31',
str_to_date('30/07/1964','%d/%m/%Y'),
11469023318),

('Elio','Vedova',
'VDVLEI90A02L565R',
'Via Europa 13',
str_to_date('02/01/1990','%d/%m/%Y'),
11469023318),

('Matilde','Miuzzi',
'MZZMLD89P47L565Y',
'Via Roma 04',
str_to_date('07/09/1989','%d/%m/%Y'),
11469023318),

('Francesca','Bernardi',
'BRNFNC96M56L565Q',
'Via Giuseppe Garibaldi 14',
str_to_date('16/08/1996','%d/%m/%Y'),
85384931017),

('Fabio','Pavanello',
'PVNFBA92A19L565I',
'Via Maggiore 03',
str_to_date('19/01/1992','%d/%m/%Y'),
85384931017),

('Marco','Rubin',
'RBNMRC82D27L565L',
'Via Piva 09',
str_to_date('27/04/1982','%d/%m/%Y'),
85384931017),

('Simone','Barco',
'BRCSMN65E06L565C',
'Via Roccat e Ferrari 20',
str_to_date('06/05/1965','%d/%m/%Y'),
82034992313),

('Francesco','Pastro',
'PSTFNC91L04L565K',
'Via Villanova 76',
str_to_date('04/07/1991','%d/%m/%Y'),
82034992313),

('Annachiara','Pastro',
'PSTNCH95S66L565G',
'Via Villanova 76',
str_to_date('26/11/1995','%d/%m/%Y'),
82034992313),

('Paolo','Rossi',
'RSSPLA75P11L565W',
'Via Erizzo 26',
str_to_date('11/09/1975','%d/%m/%Y'),
49552600187),

('Anna','Bianchi',
'BNCNNA96B47L565M',
'Via Tessere 18',
str_to_date('07/02/1996','%d/%m/%Y'),
49552600187),

('Giulia', 'Biasuzzi',
'BSZGLI92H59L565M',
'Via Strada Rosa 12',
str_to_date('19/06/1992','%d/%m/%Y'),
49552600187),

('Sandro','Zanella',
'ZNLSDR63D23L565D',
'Via Santo Stefano 111',
str_to_date('23/04/1963','%d/%m/%Y'),
37429197425),

('Aurora','Vedova',
'VDVRRA91E65L565L',
'Via Maggiore 51',
str_to_date('25/05/1991','%d/%m/%Y'),
37429197425),

('Silvia','Tonin',
'TNNSLV90B42L565H',
'Via Vicolo Zen 13',
str_to_date('02/02/1990','%d/%m/%Y'),
37429197425),

('Chiara','De Francesco',
'DFRCHR50E45L565I',
'Via Europa 01',
str_to_date('05/05/1950','%d/%m/%Y'),
99468262163),

('Elena','Antiga',
'NTGLNE83H53L565B',
'Via Ponteggio 17',
str_to_date('13/06/1983','%d/%m/%Y'),
99468262163),

('Erica','Comarella',
'CMRRCE81R44L565F',
'Via Giuseppe Garibaldi 25',
str_to_date('04/10/1981','%d/%m/%Y'),
99468262163),

('Sophia','Mattiola',
'MTTSPH68M49L565G',
'Via Erizzo 120',
str_to_date('09/08/1968','%d/%m/%Y'),
99468262163),

('Elena','De Salvador',
'DSLLNE93H54L565G',
'Via Santo Stefano 54',
str_to_date('14/06/1993','%d/%m/%Y'),
87340929311),

('Dino','Vedova', 
'VDVDNI70B07L565B',
'Via delle Cente 08',
str_to_date('07/02/1970','%d/%m/%Y'),
87340929311),

('Roberto','Bronca',
'BRNRRT77T15L565U',
'Via Roma 41',
str_to_date('15/12/1977','%d/%m/%Y'),
87340929311),

('Aldo','Bortolin',
'BRTLDA61A03L565M',
'Via Spinade 45',
str_to_date('03/01/1961','%d/%m/%Y'),
70430299194),

('Alberto','Guizzo',
'GZZLRT80P14L565U',
'Via Piva 43',
str_to_date('14/09/1980','%d/%m/%Y'),
70430299194);

insert into AdminWeb(nome,cognome,username,password,dataNascita,sesso) 
values
('Rudy','Berton', 'rberton', '123456', str_to_date('19/01/1992','%d/%m/%Y'), 'M'),
('Anna', 'Gregoletto', 'agrego', '123456',str_to_date('27/07/1990','%d/%m/%Y'),'F');

set foreign_key_checks=1;
