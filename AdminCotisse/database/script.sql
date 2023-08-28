create database cotisse;

\c cotisse ;

CREATE SEQUENCE seqclient
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 9999
    CACHE 1;

-- Create the function
CREATE OR REPLACE FUNCTION getseqclient()
    RETURNS integer AS $$
    DECLARE
        seq integer;
    BEGIN
        SELECT nextval('seqclient') INTO seq;
        RETURN seq;
    END;
$$ LANGUAGE plpgsql;


create table client(
     id varchar(50) primary key not null,
     nom varchar(50) not null,
     prenoms varchar(50),
     email varchar(100) unique not null,
     mdp varchar(50) not null,
     cin bigint not null,
     contact varchar(15) not null
);

CREATE TABLE typemembre(
     id SERIAL primary key not null,
     type VARCHAR(100)
);

CREATE SEQUENCE seqmembre
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 9999
    CACHE 1;

-- Create the function
CREATE OR REPLACE FUNCTION getseqmembre()
    RETURNS integer AS $$
    DECLARE
        seq integer;
    BEGIN
        SELECT nextval('seqmembre') INTO seq;
        RETURN seq;
    END;
$$ LANGUAGE plpgsql;

CREATE TABLE membre(
     id varchar(50) primary key not null,
     nom VARCHAR(50),
     prenom VARCHAR(50),
     idtypemembre INT REFERENCES typemembre(id),
     salaire double precision
);

CREATE TABLE statusmembre(
     id SERIAL PRIMARY KEY not null,
     idmembre VARCHAR(50) REFERENCES membre(id),
     datedebut TIMESTAMP without time zone not null,
     datefin TIMESTAMP without time zone
);

create table typetransport(
     id serial primary key not null,
     nom varchar(50) not null
);

create table bus(
     id serial primary key not null,
     nom varchar(50) not null,
     iddtypetransport int references typetransport(id)
);

create table ville(
     id serial primary key not null,
     nom varchar(50) not null
);

create table voyage(
     id serial primary key not null,
     idbus int references bus(id),
     idchauffeur VARCHAR(6) references membre(id),
     depart int references ville(id),
     arrive int references ville(id),
     datedepart timestamp without time zone not null,
     datearrive timestamp without time zone not null,
     prix decimal(14,2) not null
);

create table place(
     id serial primary key not null,
     numero int not null
);

create table reservation(
    id serial primary key not null,
    idclient varchar(50) references client(id),
    idvoyage int references voyage(id),
    methode varchar(200),
    argent decimal(14,2) not null,
    daty timestamp without time zone not null
);

create table detailreservation(
     idreservation int references reservation(id),
     idplace int references place(id)
);

create table sms(
     id serial primary key not null,
     contact varchar(15) not null,
     argent decimal(14,2) not null,
     dateheure timestamp without time zone not null,
     reference int not null
);

insert into sms values(default,0380734855,'120000','2023-07-04 14:30',124576);
insert into sms values(default,0380734855,'180000','2023-07-04 14:30',124576);
insert into sms values(default,0380734855,'60000','2023-07-04 14:30',987654);

create table paiement(
     idclient varchar(50) references client(id),
     montant decimal(14,2) not null,
     idreservation int references reservation(id),
     idsms int references sms(id)
);

create table commentaire(
    idclient varchar(50) references client(id),
    coms varchar(500),
    daty timestamp without time zone not null
);


CREATE OR REPLACE view v_statusmembre AS
SELECT sm.id as idstatusmembre,m.id as idmembre,m.nom,m.prenom,m.idtypemembre,m.salaire, sm.datedebut,sm.datefin
FROM membre AS m
JOIN statusmembre AS sm ON m.id = sm.idmembre;

CREATE SEQUENCE seqadmin
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 9999
    CACHE 1;

-- Create the function
CREATE OR REPLACE FUNCTION getseqadmin()
    RETURNS integer AS $$
    DECLARE
        seq integer;
    BEGIN
        SELECT nextval('seqadmin') INTO seq;
        RETURN seq;
    END;
$$ LANGUAGE plpgsql;


create table admin(
     id varchar(50) primary key not null,
     nom varchar(50) not null,
     email varchar(100) unique not null,
     mdp varchar(50) not null
);

insert into admin values('ADM01','Tafitasoa','tafitasoa@gmail.com','tft12345');
