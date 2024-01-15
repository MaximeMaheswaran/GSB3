--
-- Base de données : `gsb3` test
--

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mdp` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secretaire` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `login`, `mdp`, `secretaire`) VALUES
(1, 'Calvo', 'Maxence', 'mcalvo', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 1),
(2, 'Mahesweran', 'Maxime', 'mmaheswaran', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 0),
(3, 'Dubois', 'Marie', 'mdubois', '2787cd24530df2d03d28c73fe21823e3a9ebed6f3434b034479e19d7029aa052', 0),
(4, 'Lefevre', 'Antoine', 'alefevre', '73318d822f7d96ec75f5911a2728512a83eaae89da6e1bbbbcd79c0003bf5125', 0),
(5, 'Martin', 'Sophie', 'smartin', 'eaf1330f33a0f84a493b379f6363c6de3d491aa27daaa02374303e8453702e5d', 0),
(6, 'Bernard', 'Thomas', 'tbernard', 'fdc08798d2fba98f7fabeed3c6efe7951eaf145891e3a3ffb3b397492d51452a', 0),
(7, 'Dupont', 'Camille', 'cdupont', '83979d9b9bad211352e5dcf8e4368e65f7efca069e30eaa1cd28bf2cef69867a', 0);


-- --------------------------------------------------------

--
-- Structure de la table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `id` int NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conference`
--

INSERT INTO `conference` (`id`, `theme`) VALUES
(1, 'Test'),
(2, 'test'),
(3, 'testdeux'),
(4, 'testtrois'),
(5, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE IF NOT EXISTS `intervenant` (
  `id` int NOT NULL,
  FOREIGN KEY (`id`) REFERENCES `personne`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`id`) VALUES
(2);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capaciteMax` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `nom`, `capaciteMax`) VALUES
(1, 'D-203', 18),
(2, 'D-201', 32);

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

DROP TABLE IF EXISTS `presentation`;
CREATE TABLE IF NOT EXISTS `presentation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datee` date DEFAULT NULL,
  `nbPlacesDispo` int DEFAULT NULL,
  `horaire` time DEFAULT NULL,
  `dureePrevue` time DEFAULT NULL,
  `salle_id` int DEFAULT NULL,
  `conference_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`salle_id`) REFERENCES `salle`(`id`),
  FOREIGN KEY (`conference_id`) REFERENCES `conference`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `presentation`
--

INSERT INTO `presentation` (`id`, `datee`, `nbPlacesDispo`, `horaire`, `dureePrevue`, `salle_id`, `conference_id`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 2),
(2, NULL, NULL, NULL, NULL, NULL, 3),
(3, NULL, NULL, NULL, NULL, NULL, 4),
(4, NULL, NULL, NULL, NULL, NULL, 4),
(5, NULL, NULL, NULL, NULL, NULL, 5),
(6, NULL, NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `intervenant_id` int NOT NULL,
  `presentation_id` int NOT NULL,
  PRIMARY KEY (`intervenant_id`,`presentation_id`),
  FOREIGN KEY (`presentation_id`) REFERENCES `presentation`(`id`),
  FOREIGN KEY (`intervenant_id`) REFERENCES `intervenant`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `animateur`
--

DROP TABLE IF EXISTS `animateur`;
CREATE TABLE IF NOT EXISTS `animateur` (
  `id` int NOT NULL,
  FOREIGN KEY (`id`) REFERENCES `personne`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animateur`
--

INSERT INTO `animateur` (`id`) VALUES
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Structure de la table `animer`
--

DROP TABLE IF EXISTS `animer`;
CREATE TABLE IF NOT EXISTS `animer` (
  `animateur_id` int NOT NULL,
  `presentation_id` int NOT NULL,
  PRIMARY KEY (`animateur_id`,`presentation_id`),
  FOREIGN KEY (`presentation_id`) REFERENCES `presentation`(`id`),
  FOREIGN KEY (`animateur_id`) REFERENCES `animateur`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animer`
--

INSERT INTO `animer` (`animateur_id`, `presentation_id`) VALUES
(3, 1);


-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` char(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` char(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mdp` char(99) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` char(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cp` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ville` char(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21'),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23'),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12'),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01'),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09'),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11'),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21'),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'paris', '2010-12-05'),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris', '2009-11-12'),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris', '2008-09-23'),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris', '2005-11-12'),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville', '2003-08-11'),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18'),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11'),
('c3', 'De', 'Philippe', 'pde', 'pde', '13 rue Barthes', '94000', 'Créteil', '2010-12-14'),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23'),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11'),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17'),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans', '2005-11-12'),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05'),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01'),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10'),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret', '1995-09-01'),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille', '1999-11-01'),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10'),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh', '1998-10-01'),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre', '1985-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE IF NOT EXISTS `reserver` (
  `id_visiteur` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `id_presentation` int NOT NULL,
  `visiter` int(1) NOT NULL DEFAULT(0),
  PRIMARY KEY (`id_visiteur`,`id_presentation`),
  FOREIGN KEY (`id_presentation`) REFERENCES `presentation`(`id`),
  FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `visiter`
--

INSERT INTO `reserver` (`id_visiteur`, `id_presentation`) VALUES
('b16', 2),
('b13', 4),
('c3', 4);
