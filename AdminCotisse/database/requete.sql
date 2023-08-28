INSERT INTO typetransport (nom) VALUES
('VIP'),
('Premium'),
('Simple');

insert into ville(nom) values('Antananarivo');
insert into ville(nom) values('Fianarantsoa');
insert into ville(nom) values('Mahajanga');
insert into ville(nom) values('Toamasina');
insert into ville(nom) values('Toliara');
insert into ville(nom) values('Manakara');

INSERT INTO bus (nom, iddtypetransport) VALUES
('VIP A', 1),
('VIP B', 1),
('VIP C', 1),
('VIP D', 1),
('VIP E', 1),
('VIP F', 1),
('VIP G', 1),

('Premuim M', 2),
('Premuim N', 2),
('Premuim O', 2),
('Premuim P', 2),
('Premuim Q', 2),
('Premuim R', 2),

('Simple 1', 3),
('Simple 2', 3),
('Simple 3', 3),
('Simple 4', 3);

insert into place(numero) values(1);
insert into place(numero) values(2);
insert into place(numero) values(3);
insert into place(numero) values(4);
insert into place(numero) values(5);
insert into place(numero) values(6);
insert into place(numero) values(7);
insert into place(numero) values(8);
insert into place(numero) values(9);
insert into place(numero) values(10);
insert into place(numero) values(11);
insert into place(numero) values(12);
insert into place(numero) values(13);
insert into place(numero) values(14);
insert into place(numero) values(15);
insert into place(numero) values(16);

INSERT INTO typemembre VALUES(DEFAULT,'Chauffeur');
INSERT INTO typemembre VALUES(DEFAULT,'Agents du service clientele');
INSERT INTO typemembre VALUES(DEFAULT,'Personnel administratif');
INSERT INTO typemembre VALUES(DEFAULT,'Techniciens de maintenance');


INSERT INTO Membre VALUES('MBR901', 'Dubois', 'Pierre', 1, 100000);
INSERT INTO Membre VALUES('MBR902', 'McCarty', 'Henry', 1, 120000);
INSERT INTO Membre VALUES('MBR903', 'Leroy', 'Sane', 1, 115000);
INSERT INTO Membre VALUES('MBR904', 'Lambert', 'Maxime', 1, 155000);
INSERT INTO Membre VALUES('MBR905', 'Martin', 'Alexandre', 1, 900000);
INSERT INTO Membre VALUES('MBR906', 'Lefèvre', 'Camille', 2, 120000);
INSERT INTO Membre VALUES('MBR907', 'Martine', 'Linda', 3, 120000);
INSERT INTO Membre VALUES('MBR908', 'Girard', 'Sébastien', 4, 120000);
INSERT INTO Membre VALUES('MBR909', 'Dupont', 'Marie', 2, 130000);
INSERT INTO Membre VALUES('MBR910', 'Roux', 'Thomas', 3, 140000);
INSERT INTO Membre VALUES('MBR911', 'Lefebvre', 'Sophie', 4, 110000);
INSERT INTO Membre VALUES('MBR912', 'Martin', 'Julie', 1, 120000);
INSERT INTO Membre VALUES('MBR913', 'Girard', 'Nicolas', 2, 135000);
INSERT INTO Membre VALUES('MBR914', 'Renaud', 'Céline', 3, 125000);
INSERT INTO Membre VALUES('MBR915', 'Moreau', 'Alexandre', 4, 130000);
INSERT INTO Membre VALUES('MBR916', 'Fournier', 'Laura', 1, 150000);
INSERT INTO Membre VALUES('MBR917', 'Garcia', 'Antoine', 2, 155000);
INSERT INTO Membre VALUES('MBR919', 'Lambert', 'Paul', 4, 128000);
INSERT INTO Membre VALUES('MBR921', 'Gagnon', 'Simon', 2, 136000);
INSERT INTO Membre VALUES('MBR922', 'Lavoie', 'Marie-Pierre', 3, 144000);
INSERT INTO Membre VALUES('MBR923', 'Tremblay', 'Philippe', 4, 122000);
INSERT INTO Membre VALUES('MBR924', 'Lapointe', 'Isabelle', 1, 138000);
INSERT INTO Membre VALUES('MBR925', 'Roy', 'Alex', 2, 150000);
INSERT INTO Membre VALUES('MBR926', 'Bouchard', 'Valérie', 3, 142000);
INSERT INTO Membre VALUES('MBR927', 'Gauthier', 'Jonathan', 4, 130000);
INSERT INTO Membre VALUES('MBR928', 'Bergeron', 'Catherine', 1, 136000);
INSERT INTO Membre VALUES('MBR929', 'Lemieux', 'Marie', 2, 132000);
INSERT INTO Membre VALUES('MBR930', 'Deschênes', 'Pierre', 3, 140000);

INSERT INTO statusmembre (idmembre, datedebut, datefin) VALUES
('MBR901', '2023-01-01', null),
('MBR902', '2023-01-01', '2023-02-28'),
('MBR903', '2023-01-01', null),
('MBR904', '2023-01-01', null),
('MBR905', '2023-01-01', null),
('MBR906', '2022-04-01', '2022-10-28'),
('MBR906', '2023-03-01', null),
('MBR907', '2023-01-01', '2023-02-28'),
('MBR908', '2023-01-01', null),
('MBR909', '2021-03-01', '2022-02-28'),
('MBR909', '2023-03-01',null),
('MBR910', '2023-01-01', null);

INSERT INTO voyage (idbus, idchauffeur, depart, arrive, datedepart, datearrive, prix) VALUES
(1, 'MBR901', 1, 2, '2023-07-05 09:00:00', '2023-07-06 12:00:00', 60000),
(2, 'MBR902', 3, 4, '2023-07-06 14:00:00', '2023-07-07 17:00:00', 60000),
(3, 'MBR903', 2, 5, '2023-07-07 11:30:00', '2023-07-08 15:30:00', 60000),
(4, 'MBR904', 4, 1, '2023-07-08 08:45:00', '2023-07-09 12:45:00', 60000),
(5, 'MBR905', 5, 3, '2023-07-09 13:15:00', '2023-07-10 17:15:00', 60000),
(6, 'MBR906', 1, 4, '2023-07-10 10:30:00', '2023-07-11 14:30:00', 60000),
(7, 'MBR907', 2, 3, '2023-07-11 09:30:00', '2023-07-12 12:30:00', 60000),
(8, 'MBR908', 4, 5, '2023-07-12 15:30:00', '2023-07-13 18:30:00', 60000),
(1, 'MBR909', 1, 3, '2023-07-13 10:45:00', '2023-07-14 14:45:00', 60000),
(2, 'MBR910', 3, 1, '2023-07-14 13:30:00', '2023-07-15 17:30:00', 60000),
(3, 'MBR911', 5, 2, '2023-07-15 11:15:00', '2023-07-16 15:15:00', 60000),
(4, 'MBR912', 1, 2, '2023-07-16 09:00:00', '2023-07-17 12:00:00', 60000),
(5, 'MBR913', 3, 4, '2023-07-17 14:00:00', '2023-07-18 17:00:00', 60000),
(6, 'MBR914', 2, 5, '2023-07-18 11:30:00', '2023-07-19 15:30:00', 60000),
(7, 'MBR915', 4, 1, '2023-07-19 08:45:00', '2023-07-20 12:45:00', 60000),
(8, 'MBR916', 5, 3, '2023-07-20 13:15:00', '2023-07-21 17:15:00', 60000),
(9, 'MBR917', 1, 4, '2023-07-21 10:30:00', '2023-07-22 14:30:00', 60000);


