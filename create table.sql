set foreign_key_checks=0;

drop table if exists AziendaVinicola;
drop table if exists AziendaPrivata;
drop table if exists CantinaSociale;
drop table if exists ContrattoDiVendita;
drop table if exists Viticoltore;
drop table if exists Operaio;
drop table if exists Bonifico;
drop table if exists DDT;
drop table if exists Dipendente;
drop table if exists Socio;

drop table if exists AdminWeb;



create table AziendaVinicola (
	nomeAz			varchar(20) not null,
	partitaIVA		char(11),
	indirizzo		varchar(30) not null,
	email			varchar(30),
	telefono		int not null,
    password		varchar(10) not null unique,

	primary key(partitaIVA)
)engine=InnoDB;


create table AziendaPrivata (
	nomeImpr			varchar(20) not null,
	cognomeImpr			varchar(20) not null,
	dataNascita			date not null,
	aziendaVinicola		char(11),
    

	primary key(aziendaVinicola),
	foreign key(aziendaVinicola) references AziendaVinicola(partitaIVA) on delete cascade on update cascade
)engine=InnoDB;
	

create table CantinaSociale (
	nomePres			varchar(20) not null,
	cognomePres			varchar(20) not null,
	annoFond			int not null,
	aziendaVinicola		char(11),

	primary key(aziendaVinicola),
	foreign key(aziendaVinicola) references AziendaVinicola(partitaIVA) on delete cascade on update cascade
)engine=InnoDB;


create table ContrattoDiVendita (
	codContratto			char(8),
	anno					int not null,
	quintaliUva				int not null,
	prezzoUva_Quintale		float(7,2) not null,
	aziendaVinicola			char(11) not null,
	viticoltore				char(11) not null,
	
	primary key(codContratto),
	foreign key(aziendaVinicola) references AziendaVinicola(partitaIVA) on delete cascade on update cascade,
	foreign key(viticoltore) references Viticoltore(partitaIVA) on delete cascade on update cascade
)Engine=InnoDB;


create table Viticoltore (
	nome			varchar(20) not null,
	cognome			varchar(20) not null,
	partitaIVA		char(11),
	dataNascita		date not null,
	indirizzo		varchar(30) not null,
	ettari			int not null,
	password		varchar(10) not null unique,
    
	primary key(partitaIVA)
)engine=InnoDB;


create table Operaio (
	nome			varchar(20) not null,
	cognome			varchar(20) not null,
	codFiscale		char(16),
	indirizzo		varchar(30) not null,
	dataNascita		date not null,
	viticoltore		char(11) not null,

	primary key(codFiscale),
	foreign key(viticoltore) references Viticoltore(partitaIVA) on delete cascade
)engine=InnoDB;


create table Bonifico (
	saldo				float(10,2) not null,
	dataVersamento		date not null,
	contrattoVendita	char(8),
	dataTermine			date not null,

	primary key(contrattoVendita),
	foreign key(contrattoVendita) references ContrattoDiVendita(codContratto) on delete cascade on update cascade
)engine=innoDB;


create table Socio (
	viticoltore			char(11),
	cantinaSociale		char(11),
	
	primary key(viticoltore,cantinaSociale),
	foreign key(viticoltore) references Viticoltore(partitaIVA) on delete cascade,
	foreign key(cantinaSociale) references CantinaSociale(aziendaVinicola) on delete cascade
)Engine=InnoDB;


create table DDT (
	codBolla			char(6),
	quantitaCarico		int not null,	
	luogo				varchar(30) not null,
	dataOra				datetime not null,
	dipendente			char(16) not null,
	contrattoVendita	char(8) not null,

	primary key(codBolla),
	foreign key(dipendente) references Dipendente(codFiscale) on delete cascade,
	foreign key(contrattoVendita) references ContrattoDiVendita(codContratto) on delete cascade
) engine=InnoDB;


create table Dipendente (
	nome				varchar(20) not null,
	cognome				varchar(20) not null,
	codFiscale			char(16),
	dataNascita			date not null,
	aziendaVinicola		char(11) not null,
	
	primary key(codFiscale),
	foreign key(aziendaVinicola) references AziendaVinicola(partitaIVA) on delete cascade
)engine=InnoDB;


create table  AdminWeb(
	nome 		varchar(20) not null,
	cognome		varchar(20) not null,
    username	varchar(10) not null,
    password	varchar(10) not null,
    dataNascita date not null,
    sesso char(1) CHECK (sesso IN (‘M’,‘F’)),
    
	primary key(username, password)
)engine=InnoDB;
    


set foreign_key_checks=1;
