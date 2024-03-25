-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 25 mars 2024 à 18:02
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testsymfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `business_account`
--

DROP TABLE IF EXISTS `business_account`;
CREATE TABLE IF NOT EXISTS `business_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `business_account`
--

INSERT INTO `business_account` (`id`, `name_account`) VALUES
(1, 'LABOHYMEA');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registration` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mileage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actual_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `release_date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `last_event_date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `event_date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `event_origin_id` int(11) NOT NULL,
  `event_account_id` int(11) NOT NULL,
  `last_event_account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_773DE69DD0374DF1` (`event_origin_id`),
  KEY `IDX_773DE69DC3858695` (`event_account_id`),
  KEY `IDX_773DE69DE5B60D79` (`last_event_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `create_invoice`
--

DROP TABLE IF EXISTS `create_invoice`;
CREATE TABLE IF NOT EXISTS `create_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  `file_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `business_account_id` int(11) NOT NULL,
  `prospect_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B25D80439395C3F3` (`customer_id`),
  KEY `IDX_B25D80438DE820D9` (`seller_id`),
  KEY `IDX_B25D8043C3C6F69F` (`car_id`),
  KEY `IDX_B25D80435BC85711` (`business_account_id`),
  KEY `IDX_B25D80436009C47` (`prospect_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civil_code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress_complement` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240322064326', '2024-03-22 06:43:40', 112),
('DoctrineMigrations\\Version20240322141603', '2024-03-22 14:16:32', 526),
('DoctrineMigrations\\Version20240322141944', '2024-03-22 14:19:49', 13),
('DoctrineMigrations\\Version20240323134732', '2024-03-23 13:47:54', 573),
('DoctrineMigrations\\Version20240325114020', '2024-03-25 11:40:42', 150);

-- --------------------------------------------------------

--
-- Structure de la table `event_account`
--

DROP TABLE IF EXISTS `event_account`;
CREATE TABLE IF NOT EXISTS `event_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `event_account`
--

INSERT INTO `event_account` (`id`, `name_account`) VALUES
(1, 'GIDAHYCOU'),
(2, 'GIDAHYMAX'),
(3, 'GIDAHYBEA'),
(4, 'VNVOHYBUS'),
(5, 'GIDAHYMEA'),
(6, 'VNVOHYMEA'),
(7, 'GIDACOU'),
(8, 'GIDAHYBUS'),
(9, 'GIDACARPRO'),
(10, 'VNVOHYMAX');

-- --------------------------------------------------------

--
-- Structure de la table `event_origin`
--

DROP TABLE IF EXISTS `event_origin`;
CREATE TABLE IF NOT EXISTS `event_origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_origin` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `event_origin`
--

INSERT INTO `event_origin` (`id`, `event_origin`) VALUES
(1, 'Atelier'),
(2, 'Véhicule neuf'),
(3, 'Véhicule d\'occasion'),
(4, 'Magasin');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prospect_type`
--

DROP TABLE IF EXISTS `prospect_type`;
CREATE TABLE IF NOT EXISTS `prospect_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_prospect` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `prospect_type`
--

INSERT INTO `prospect_type` (`id`, `name_prospect`) VALUES
(1, 'SOCIETE'),
(2, 'PARTICULIER');

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `folder_number_vnvo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sales_intermediary_vn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `FK_773DE69DC3858695` FOREIGN KEY (`event_account_id`) REFERENCES `event_account` (`id`),
  ADD CONSTRAINT `FK_773DE69DD0374DF1` FOREIGN KEY (`event_origin_id`) REFERENCES `event_origin` (`id`),
  ADD CONSTRAINT `FK_773DE69DE5B60D79` FOREIGN KEY (`last_event_account_id`) REFERENCES `event_account` (`id`);

--
-- Contraintes pour la table `create_invoice`
--
ALTER TABLE `create_invoice`
  ADD CONSTRAINT `FK_B25D80435BC85711` FOREIGN KEY (`business_account_id`) REFERENCES `business_account` (`id`),
  ADD CONSTRAINT `FK_B25D80436009C47` FOREIGN KEY (`prospect_type_id`) REFERENCES `prospect_type` (`id`),
  ADD CONSTRAINT `FK_B25D80438DE820D9` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`),
  ADD CONSTRAINT `FK_B25D80439395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_B25D8043C3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
