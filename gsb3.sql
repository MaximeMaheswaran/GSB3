-- Adminer 4.8.1 MySQL 8.2.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;



DROP TABLE IF EXISTS `conference`;
CREATE TABLE `conference` (
  `id` int NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `conference` (`id`, `theme`) VALUES
(7,	'Covid-19');



DROP TABLE IF EXISTS `personne`;
CREATE TABLE `personne` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mdp` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secretaire` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `personne` (`id`, `nom`, `prenom`, `login`, `mdp`, `secretaire`) VALUES
(1,	'Calvo',	'Maxence',	'mcalvo',	'4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2',	1),
(2,	'Mahesweran',	'Maxime',	'mmaheswaran',	'04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb',	0),
(3,	'Dubois',	'Marie',	'mdubois',	'2787cd24530df2d03d28c73fe21823e3a9ebed6f3434b034479e19d7029aa052',	0),
(4,	'Lefevre',	'Antoine',	'alefevre',	'73318d822f7d96ec75f5911a2728512a83eaae89da6e1bbbbcd79c0003bf5125',	0),
(5,	'Martin',	'Sophie',	'smartin',	'eaf1330f33a0f84a493b379f6363c6de3d491aa27daaa02374303e8453702e5d',	0),
(6,	'Bernard',	'Thomas',	'tbernard',	'fdc08798d2fba98f7fabeed3c6efe7951eaf145891e3a3ffb3b397492d51452a',	0),
(7,	'Dupont',	'Camille',	'cdupont',	'83979d9b9bad211352e5dcf8e4368e65f7efca069e30eaa1cd28bf2cef69867a',	0);


DROP TABLE IF EXISTS `agent`;
CREATE TABLE `agent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`id`) REFERENCES `personne`(`id`)
);

INSERT INTO `agent` VALUES 
(2, 001);

DROP TABLE IF EXISTS `animateur`;
CREATE TABLE `animateur` (
  `id` int NOT NULL,
  KEY `id` (`id`),
  CONSTRAINT `animateur_ibfk_1` FOREIGN KEY (`id`) REFERENCES `personne` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `animateur` (`id`) VALUES
(3),
(4),
(5),
(6),
(7);


DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE `intervenant` (
  `id` int NOT NULL,
  KEY `id` (`id`),
  CONSTRAINT `intervenant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `personne` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






DROP TABLE IF EXISTS `salle`;
CREATE TABLE `salle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capaciteMax` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `salle` (`id`, `nom`, `capaciteMax`) VALUES
(1,	'D-203',	18),
(2,	'D-201',	32);



DROP TABLE IF EXISTS `presentation`;
CREATE TABLE `presentation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datee` date DEFAULT NULL,
  `nbPersonneInscrite` int DEFAULT NULL,
  `horaire` time DEFAULT NULL,
  `dureePrevue` time DEFAULT NULL,
  `salle_id` int DEFAULT NULL,
  `conference_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salle_id` (`salle_id`),
  KEY `conference_id` (`conference_id`),
  CONSTRAINT `presentation_ibfk_1` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`),
  CONSTRAINT `presentation_ibfk_2` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `presentation` (`id`, `datee`, `nbPersonneInscrite`, `horaire`, `dureePrevue`, `salle_id`, `conference_id`) VALUES
(7,	'2024-01-16',	8,	'08:00:00',	'01:00:00',	1,	7),
(8,	'2024-01-17',	16,	'09:00:00',	'01:30:00',	2,	7);

DROP TABLE IF EXISTS `animer`;
CREATE TABLE `animer` (
  `animateur_id` int NOT NULL,
  `presentation_id` int NOT NULL,
  PRIMARY KEY (`animateur_id`,`presentation_id`),
  KEY `presentation_id` (`presentation_id`),
  CONSTRAINT `animer_ibfk_1` FOREIGN KEY (`presentation_id`) REFERENCES `presentation` (`id`),
  CONSTRAINT `animer_ibfk_2` FOREIGN KEY (`animateur_id`) REFERENCES `animateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `participer`;
CREATE TABLE `participer` (
  `intervenant_id` int NOT NULL,
  `presentation_id` int NOT NULL,
  PRIMARY KEY (`intervenant_id`,`presentation_id`),
  KEY `presentation_id` (`presentation_id`),
  CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`presentation_id`) REFERENCES `presentation` (`id`),
  CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`intervenant_id`) REFERENCES `intervenant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE `visiteur` (
  `id` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mdp` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cp` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ville` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`) VALUES
('a131',	'Villechalane',	'Louis',	'lvillachane',	'ca3983640f22d6a38a0708731ac697146026828b88594f9522ae5517960bd56d',	'8 rue des Charmes',	'46000',	'Cahors'),
('a17',	'Andre',	'David',	'dandre',	'165a63d5371a0ccb21b23e8881d59116bfd8377d9cad418de1215da4af09e39d',	'1 rue Petit',	'46200',	'Lalbenque'),
('a55',	'Bedos',	'Christian',	'cbedos',	'7461ef03c6debab576933c6e42e71bfdd9f070da3abbb5d8758fa1fc3fe65fc0',	'1 rue Peranud',	'46250',	'Montcuq'),
('a93',	'Tusseau',	'Louis',	'ltusseau',	'227daca101749f45a829988faf79144d87d1d2e7a90ce07896ec56e697b7a449',	'22 rue des Ternes',	'46123',	'Gramat'),
('b13',	'Bentot',	'Pascal',	'pbentot',	'e0020387b3eaa7414296fdfa7af5cfe48f6cf514f4350df2ff23b138e5e80e9e',	'11 allée des Cerises',	'46512',	'Bessines'),
('b16',	'Bioret',	'Luc',	'lbioret',	'4dcb2c67707621b6bfa81c71db8ea33f6bfe217275bad06241d1f0cdd9171fd3',	'1 Avenue gambetta',	'46000',	'Cahors'),
('b19',	'Bunisset',	'Francis',	'fbunisset',	'57b592489c1851ed5db43ab164cb2e3fbf88a3eeeba963518f41798260d0fdaa',	'10 rue des Perles',	'93100',	'Montreuil'),
('b25',	'Bunisset',	'Denise',	'dbunisset',	'4de535fc4bb81bf16f8396701c72b84dbcfaa1232823cbc62fbf9d8295840921',	'23 rue Manin',	'75019',	'paris'),
('b28',	'Cacheux',	'Bernard',	'bcacheux',	'9be0be929c729fe93b16b974b6a7f79ce77ecb399135f23ba8c47318bc3f0885',	'114 rue Blanche',	'75017',	'Paris'),
('b34',	'Cadic',	'Eric',	'ecadic',	'ed5c1022a39ba567bf81c922e7bebcefe1ae1bb29f1ee4d68cb571096ab699cd',	'123 avenue de la République',	'75011',	'Paris'),
('b4',	'Charoze',	'Catherine',	'ccharoze',	'659d7ec12a1ed4710ca30bacba2049029cba5f6f8946f55d5150301b2c2bb620',	'100 rue Petit',	'75019',	'Paris'),
('b50',	'Clepkens',	'Christophe',	'cclepkens',	'7e9353475b3d90a2ffbedd346b8fd143ff42d8808b43aa8b804465d98827925c',	'12 allée des Anges',	'93230',	'Romainville'),
('b59',	'Cottin',	'Vincenne',	'vcottin',	'264fa0634d763fefc9de03d9412af78b553304a1e59bc7c1faf8fd5b4fd26e48',	'36 rue Des Roches',	'93100',	'Monteuil'),
('c14',	'Daburon',	'François',	'fdaburon',	'2558ad19d564eeafadc7395065d14f6fc244e21c9510079838d5d5c2aa660385',	'13 rue de Chanzy',	'94000',	'Créteil'),
('c3',	'De',	'Philippe',	'pde',	'758fadae004390fa50e7bc21155d18d87455ec1da11d220b451347ffa94c3fc4',	'13 rue Barthes',	'94000',	'Créteil'),
('c54',	'Debelle',	'Michel',	'mdebelle',	'e87f267d00031b3853d13ea6c4abd3aa8ba9a7362f151b23b1d8ab7a36237661',	'181 avenue Barbusse',	'93210',	'Rosny'),
('d13',	'Debelle',	'Jeanne',	'jdebelle',	'8447a77dcc8a1ab290625d2de92107ad506fe226f21ccc7b94db5576957371e9',	'134 allée des Joncs',	'44000',	'Nantes'),
('d51',	'Debroise',	'Michel',	'mdebroise',	'd908f177158faee7d45535e52ca19d1182a4cfc2ac2c44cc6d56540a36b43e08',	'2 Bld Jourdain',	'44000',	'Nantes'),
('e22',	'Desmarquest',	'Nathalie',	'ndesmarquest',	'045758ae4faff6e3a69776daea65b425c06df1806fb9fee23001b51ce8ad92f7',	'14 Place d Arc',	'45000',	'Orléans'),
('e24',	'Desnost',	'Pierre',	'pdesnost',	'9afdf4579e4688162115b09e0a72a810a3a0db98c3142d2a524d2fbb7a1d83a9',	'16 avenue des Cèdres',	'23200',	'Guéret'),
('e39',	'Dudouit',	'Frédéric',	'fdudouit',	'82189fa33089b33bda4fe93c84cc0ef3e9b5746222735ea948f85aa4faa92b8c',	'18 rue de l église',	'23120',	'GrandBourg'),
('e49',	'Duncombe',	'Claude',	'cduncombe',	'1a96aed84026e53d447df5b3501f468b6b1a104d496183b80010aec0ed6e57e3',	'19 rue de la tour',	'23100',	'La souteraine'),
('e5',	'Enault-Pascreau',	'Céline',	'cenault',	'5044827970b11b704c3f4bd8025c38a334df3a194247e6b03c3a330eab07316c',	'25 place de la gare',	'23200',	'Gueret'),
('e52',	'Eynde',	'Valérie',	'veynde',	'9d3744e22dcada1717408fdf079bff21f3f8cb514e3402b19d990df01f33325e',	'3 Grand Place',	'13015',	'Marseille'),
('f21',	'Finck',	'Jacques',	'jfinck',	'577d67f320202216ee7f2fe26b363daada983b0d06521a7c89aeb049eafc97f5',	'10 avenue du Prado',	'13002',	'Marseille'),
('f39',	'Frémont',	'Fernande',	'ffremont',	'b409a4db2e8a88fb10f427ef3ff3452dd3489b75648a7593f6ad74d4572ae06b',	'4 route de la mer',	'13012',	'Allauh'),
('f4',	'Gest',	'Alain',	'agest',	'a8a5b00ccbc425791ae7e9bdca16fc7e108c9d58e6d70b0c66f327b82b083ec9',	'30 avenue de la mer',	'13025',	'Berre');


DROP TABLE IF EXISTS `siege`;
CREATE TABLE `siege` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salle_id` int DEFAULT NULL,
  `visiteur_id` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salle_id` (`salle_id`),
  KEY `fk_siege_visiteur` (`visiteur_id`),
  CONSTRAINT `fk_siege_salle` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`),
  CONSTRAINT `fk_siege_visiteur` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `siege` (`id`, `salle_id`, `visiteur_id`) VALUES
(1,	1,	'a17'),
(2,	1,	'a131'),
(3,	1,	'a55'),
(4,	1,	'b13'),
(5,	1,	'e22'),
(6,	1,	'b16'),
(7,	1,	'b19'),
(8,	1,	'b25'),
(9,	1,	'b28'),
(10,	1,	'b50'),
(11,	1,	'b4'),
(12,	1,	'c14'),
(13,	1,	NULL),
(14,	1,	NULL),
(15,	1,	NULL),
(16,	1,	NULL),
(17,	1,	NULL),
(18,	1,	NULL);

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE `reserver` (
  `id_visiteur` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_presentation` int NOT NULL,
  `id_siege` int DEFAULT NULL,
  PRIMARY KEY (`id_visiteur`,`id_presentation`),
  KEY `id_presentation` (`id_presentation`),
  KEY `id_siege` (`id_siege`),
  CONSTRAINT `reserver_ibfk_1` FOREIGN KEY (`id_presentation`) REFERENCES `presentation` (`id`),
  CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`),
  CONSTRAINT `reserver_ibfk_3` FOREIGN KEY (`id_siege`) REFERENCES `siege` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', 'Cahors'),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque'),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', 'Montcuq'),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', 'Gramat'),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines'),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors'),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil'),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'Paris'),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris'),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris'),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris'),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville'),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil'),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil'),
('c3', 'De', 'Philippe', 'pde', 'pde', '13 rue Barthes', '94000', 'Créteil', '2010-12-14'),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny'),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes'),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes'),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans'),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret'),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg'),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine'),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret'),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille'),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille'),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh'),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre');

*/