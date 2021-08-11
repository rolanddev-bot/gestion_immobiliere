-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 déc. 2020 à 16:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheters`
--

DROP TABLE IF EXISTS `acheters`;
CREATE TABLE IF NOT EXISTS `acheters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `locataire_id` bigint(20) UNSIGNED NOT NULL,
  `date_vente` date DEFAULT NULL,
  `autres` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `locataire_id` (`locataire_id`),
  KEY `vente_id` (`vente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

DROP TABLE IF EXISTS `agences`;
CREATE TABLE IF NOT EXISTS `agences` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `denomination` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `numero_registre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `siege` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forme` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capital` int(10) DEFAULT NULL,
  `telephone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `numero_agrement` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_rccm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `representer_par` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poste_representant` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexe_representant` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_agence` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_relance` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id`, `denomination`, `numero_registre`, `siege`, `forme`, `capital`, `telephone`, `adresse`, `detail`, `numero_agrement`, `num_rccm`, `representer_par`, `poste_representant`, `sexe_representant`, `email_agence`, `date_relance`) VALUES
(1, 'Sini Property', 'CF098H6766', 'Abidjan', 'SARL', 100000, '+225 22343455', 'Abidjan 01', 'Agence immbilière de référence', '445', 'R', 'KONE Epouse DIABY Mariam', 'Gérante', 'Madame', 'info@gmail.com', '2020-11-25');

-- --------------------------------------------------------

--
-- Structure de la table `appartements`
--

DROP TABLE IF EXISTS `appartements`;
CREATE TABLE IF NOT EXISTS `appartements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `libelle` varchar(255) NOT NULL,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `nbre_piece` int(20) NOT NULL,
  `details` varchar(255) NOT NULL,
  `autres` varchar(255) NOT NULL,
  `balcon` tinyint(1) DEFAULT '0',
  `cuisine` tinyint(1) DEFAULT '0',
  `libre` tinyint(1) DEFAULT '0',
  `piscine` tinyint(1) DEFAULT '0',
  `meuble` tinyint(1) DEFAULT '0',
  `detail` text,
  `surface` int(10) DEFAULT '0',
  `surface_habitable` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appartenirs`
--

DROP TABLE IF EXISTS `appartenirs`;
CREATE TABLE IF NOT EXISTS `appartenirs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proprietaire_id` bigint(20) UNSIGNED NOT NULL,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proprietaire_id` (`proprietaire_id`),
  KEY `bien_id` (`bien_id`),
  KEY `proprietaire_id_2` (`proprietaire_id`,`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appartenirs`
--

INSERT INTO `appartenirs` (`id`, `proprietaire_id`, `bien_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `appliquers`
--

DROP TABLE IF EXISTS `appliquers`;
CREATE TABLE IF NOT EXISTS `appliquers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `charge_id` bigint(20) UNSIGNED NOT NULL,
  `montant_charge` decimal(65,0) NOT NULL,
  `date_charge` date NOT NULL,
  `autres` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charge_id` (`charge_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appliquers`
--

INSERT INTO `appliquers` (`id`, `location_id`, `charge_id`, `montant_charge`, `date_charge`, `autres`) VALUES
(1, 1, 19, '2000', '2020-12-01', NULL),
(2, 1, 20, '3000', '2020-12-01', NULL),
(3, 1, 22, '1000', '2020-12-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `autresparties`
--

DROP TABLE IF EXISTS `autresparties`;
CREATE TABLE IF NOT EXISTS `autresparties` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `autre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `banques`
--

DROP TABLE IF EXISTS `banques`;
CREATE TABLE IF NOT EXISTS `banques` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `masquer` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `banques`
--

INSERT INTO `banques` (`id`, `libelle`, `detail`, `masquer`) VALUES
(1, 'Aucune', NULL, 0),
(2, 'BACI', NULL, 0),
(3, 'UBA', NULL, 0),
(4, 'BNI', NULL, 0),
(5, 'BCEAO', NULL, 0),
(6, 'ECOBANK', NULL, 0),
(7, 'BANK OF AFRICA', NULL, 0),
(8, 'BHCI', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `besoins`
--

DROP TABLE IF EXISTS `besoins`;
CREATE TABLE IF NOT EXISTS `besoins` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `typebien_id` bigint(20) UNSIGNED NOT NULL,
  `locataire_id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `nbre_piece` varchar(5) DEFAULT NULL,
  `superficie` varchar(10) DEFAULT NULL,
  `delai_acquisition` date NOT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `etat_budget` tinyint(1) NOT NULL DEFAULT '0',
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `typebien_id` (`typebien_id`),
  KEY `locataire_id` (`locataire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `besoins`
--

INSERT INTO `besoins` (`id`, `typebien_id`, `locataire_id`, `libelle`, `adresse`, `nbre_piece`, `superficie`, `delai_acquisition`, `detail`, `etat_budget`, `statut`, `archiver`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'qhqh', 'TTT', '2', '200', '2020-12-31', NULL, 0, 0, 0, '2020-12-10 15:48:01', '2020-12-10 15:48:01'),
(2, 4, 3, 'hshsh', 'ABidjan', '3', '2000', '2020-12-09', 'Yesss', 1, 0, 0, '2020-12-10 15:48:44', '2020-12-10 15:49:13');

-- --------------------------------------------------------

--
-- Structure de la table `bienimms`
--

DROP TABLE IF EXISTS `bienimms`;
CREATE TABLE IF NOT EXISTS `bienimms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `immeuble_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`),
  KEY `immeuble_id` (`immeuble_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `biens`
--

DROP TABLE IF EXISTS `biens`;
CREATE TABLE IF NOT EXISTS `biens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `etat_mandat` tinyint(1) DEFAULT '0',
  `ref` varchar(50) DEFAULT NULL,
  `typebien_id` bigint(20) UNSIGNED NOT NULL,
  `immeuble_id` bigint(20) NOT NULL,
  `immeuble` varchar(220) DEFAULT NULL,
  `libelle` varchar(50) NOT NULL,
  `lot` varchar(255) DEFAULT NULL,
  `ilot` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `parcelle` varchar(255) DEFAULT NULL,
  `surface` varchar(10) DEFAULT NULL,
  `surface_habitable` varchar(10) NOT NULL DEFAULT '0',
  `nbre_piece` int(11) DEFAULT NULL,
  `meuble` tinyint(1) DEFAULT '0',
  `detail` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `libre` tinyint(1) DEFAULT '0',
  `viabilise` tinyint(1) DEFAULT '0',
  `cuisine` tinyint(1) DEFAULT '0',
  `piscine` tinyint(1) DEFAULT '0',
  `terrasse` tinyint(1) DEFAULT '0',
  `garage` tinyint(1) DEFAULT '0',
  `balcon` tinyint(1) DEFAULT '0',
  `parking` tinyint(1) DEFAULT '0',
  `ascenseur` tinyint(1) DEFAULT '0',
  `type_commerce` varchar(100) DEFAULT NULL,
  `type_maison` varchar(50) DEFAULT NULL,
  `parking_externe` tinyint(1) DEFAULT '0',
  `type_immeuble` varchar(20) DEFAULT NULL,
  `adresse` varchar(225) DEFAULT NULL,
  `mandat` tinyint(1) DEFAULT '0' COMMENT 'Verifie que le bien a déjà fait l''objet d''un mandat',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `typebien_id` (`typebien_id`),
  KEY `immeuble_id` (`immeuble_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `biens`
--

INSERT INTO `biens` (`id`, `etat_mandat`, `ref`, `typebien_id`, `immeuble_id`, `immeuble`, `libelle`, `lot`, `ilot`, `section`, `parcelle`, `surface`, `surface_habitable`, `nbre_piece`, `meuble`, `detail`, `date`, `archiver`, `libre`, `viabilise`, `cuisine`, `piscine`, `terrasse`, `garage`, `balcon`, `parking`, `ascenseur`, `type_commerce`, `type_maison`, `parking_externe`, `type_immeuble`, `adresse`, `mandat`, `created_at`, `updated_at`) VALUES
(1, 0, '-1220', 2, 0, '', 'Villa', '6', '6', '2', '2', '700', '500', 5, 0, NULL, NULL, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, '', 'Villa', 0, '', 'Bingerville', 1, '2020-12-01 14:59:54', '2020-12-07 10:44:43'),
(2, 0, '1-1220', 5, 0, '', 'Shop Lary', '4', '4', '4', '4', '0', '0', 0, 1, 'RAS', NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'Magasin', '', 0, '', 'Treichville', 1, '2020-12-03 12:49:08', '2020-12-03 17:39:26'),
(3, 0, '2-1220', 1, 0, '', 'Terrain Moussa', '5', '5', '45', '55', '1000', '0', 0, 0, 'RAS', NULL, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 'BP 34 Abidjan 01', 0, '2020-12-04 11:32:19', '2020-12-04 11:32:19');

-- --------------------------------------------------------

--
-- Structure de la table `budgets`
--

DROP TABLE IF EXISTS `budgets`;
CREATE TABLE IF NOT EXISTS `budgets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `besoin_id` bigint(10) NOT NULL,
  `mode_id` int(10) NOT NULL,
  `montant` decimal(65,0) NOT NULL,
  `modalite` varchar(50) NOT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `besoin_id` (`besoin_id`),
  KEY `mode_id` (`mode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `budgets`
--

INSERT INTO `budgets` (`id`, `besoin_id`, `mode_id`, `montant`, `modalite`, `detail`, `archiver`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2000000000', '3 tranches', 'ras', 0, '2020-12-10 11:13:49', '2020-12-10 11:58:33'),
(2, 1, 1, '2000000000', '2 tranches', 'ras', 0, '2020-12-10 11:59:16', '2020-12-10 12:00:35'),
(3, 2, 3, '3000000', '2 tranches', 'RAS', 0, '2020-12-10 15:49:13', '2020-12-10 15:49:13');

-- --------------------------------------------------------

--
-- Structure de la table `charges`
--

DROP TABLE IF EXISTS `charges`;
CREATE TABLE IF NOT EXISTS `charges` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_charge` varchar(50) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `autres` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `charges`
--

INSERT INTO `charges` (`id`, `type_charge`, `libelle`, `autres`, `created_at`, `updated_at`) VALUES
(19, 'Locataire', 'Frais d\'entretien', NULL, '2020-10-15 19:05:44', '2020-10-15 19:05:44'),
(20, 'Locataire', 'Frais d\'enlèvement ordure', NULL, '2020-10-16 00:14:21', '2020-10-16 00:24:00'),
(22, 'Locataire', 'Consommation courant', NULL, '2020-10-16 00:18:17', '2020-10-16 00:18:17');

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

DROP TABLE IF EXISTS `communes`;
CREATE TABLE IF NOT EXISTS `communes` (
  `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `libelle`) VALUES
(1, 'Adjamé'),
(2, 'Cocody'),
(3, 'Yopougon'),
(4, 'Treichville'),
(5, 'Bassam'),
(6, 'Marcory'),
(7, 'Port Bouet'),
(8, 'Gonzacquville');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `avoir` int(11) NOT NULL DEFAULT '0',
  `reste` int(11) NOT NULL DEFAULT '0',
  `etat` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `location_id`, `avoir`, `reste`, `etat`, `created_at`, `updated_at`) VALUES
(1, 2, 100000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 200000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 300000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 350000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 8, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 0, 5000, 'Non soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 212000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 319000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 105000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 426000, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 3, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 0, 0, 'Soldé', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `contenirs`
--

DROP TABLE IF EXISTS `contenirs`;
CREATE TABLE IF NOT EXISTS `contenirs` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `immeuble_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`),
  KEY `immeuble_id` (`immeuble_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `effectuers`
--

DROP TABLE IF EXISTS `effectuers`;
CREATE TABLE IF NOT EXISTS `effectuers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `locataire_id` bigint(20) UNSIGNED NOT NULL,
  `nbre_client` int(50) NOT NULL,
  `date_effectuer` date NOT NULL,
  `autres` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locataire_id` (`locataire_id`),
  KEY `vente_id` (`vente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `elements`
--

DROP TABLE IF EXISTS `elements`;
CREATE TABLE IF NOT EXISTS `elements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `elements`
--

INSERT INTO `elements` (`id`, `libelle`, `detail`, `archiver`) VALUES
(1, 'Porte', NULL, 0),
(2, 'Fenêtre', NULL, 0),
(3, 'Placard', NULL, 0),
(4, 'Revêtement mural', NULL, 0),
(5, 'Revêtement sol', NULL, 0),
(6, 'Plafond', NULL, 0),
(7, 'Etagère', NULL, 1),
(8, 'Mur', NULL, 0),
(9, 'Electricité', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

DROP TABLE IF EXISTS `equipements`;
CREATE TABLE IF NOT EXISTS `equipements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `autres` varchar(255) DEFAULT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipements`
--

INSERT INTO `equipements` (`id`, `libelle`, `autres`, `archiver`) VALUES
(1, 'Chambre 1', NULL, 1),
(2, 'Chambre 2', NULL, 1),
(3, 'Chambre 3', NULL, 0),
(4, 'Chambre 4', NULL, 0),
(5, 'Chambre 5', NULL, 0),
(6, 'Chambre 6', NULL, 0),
(7, 'Terrasse', NULL, 0),
(8, 'Salon/Séjour', NULL, 0),
(9, 'Chambre enfant', NULL, 0),
(10, 'Chambre ami', NULL, 0),
(11, 'WC', NULL, 0),
(13, 'Salle de jeu', NULL, 0),
(14, 'Salle de bain', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `equipers`
--

DROP TABLE IF EXISTS `equipers`;
CREATE TABLE IF NOT EXISTS `equipers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `equipement_id` bigint(20) UNSIGNED NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `equipement_id` (`equipement_id`),
  KEY `bien_id` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `equipers`
--

INSERT INTO `equipers` (`id`, `bien_id`, `equipement_id`, `detail`, `created_at`, `updated_at`) VALUES
(1, 10, 1, NULL, '2020-11-30 11:02:17', '2020-11-30 11:02:17'),
(2, 10, 7, NULL, '2020-11-30 11:02:29', '2020-11-30 11:02:29'),
(3, 11, 1, NULL, '2020-11-30 11:06:02', '2020-11-30 11:06:02'),
(4, 15, 11, NULL, '2020-11-30 11:18:16', '2020-11-30 11:18:16'),
(5, 15, 13, NULL, '2020-11-30 11:18:23', '2020-11-30 11:18:23');

-- --------------------------------------------------------

--
-- Structure de la table `etat1s`
--

DROP TABLE IF EXISTS `etat1s`;
CREATE TABLE IF NOT EXISTS `etat1s` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) DEFAULT NULL,
  `archiver` tinyint(4) NOT NULL DEFAULT '0',
  `entree_sortie` varchar(10) DEFAULT NULL,
  `mandat_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cloture` tinyint(1) NOT NULL DEFAULT '0',
  `date_etat` date NOT NULL,
  `avis_locataire` text,
  `avis_bailleur` text,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`mandat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

DROP TABLE IF EXISTS `etats`;
CREATE TABLE IF NOT EXISTS `etats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) DEFAULT NULL,
  `archiver` tinyint(4) NOT NULL DEFAULT '0',
  `entree_sortie` varchar(10) DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cloture` tinyint(1) NOT NULL DEFAULT '0',
  `date_etat` date NOT NULL,
  `avis_locataire` text,
  `avis_bailleur` text,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) NOT NULL,
  `solde` tinyint(1) NOT NULL DEFAULT '0',
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `date_facture` date NOT NULL,
  `montant` varchar(200) NOT NULL,
  `autre` varchar(255) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `nature` varchar(255) DEFAULT NULL,
  `mois` int(2) DEFAULT NULL,
  `bimestriel` varchar(5) DEFAULT NULL,
  `annee` int(4) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL,
  `montant_lettre` text,
  `periodicite_loyer` varchar(20) DEFAULT NULL,
  `user_nom` varchar(200) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `locataire_id` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `ref`, `solde`, `location_id`, `archiver`, `date_facture`, `montant`, `autre`, `date_debut`, `date_fin`, `nature`, `mois`, `bimestriel`, `annee`, `etat`, `montant_lettre`, `periodicite_loyer`, `user_nom`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'AL-001-2020', 0, 1, 0, '2020-12-07', '85000', NULL, '2021-01-01', '2021-01-31', 'Janvier 2021', 1, NULL, 2021, 0, NULL, 'mensuel', NULL, NULL, '2020-12-07 10:44:43', '2020-12-07 10:44:43');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `honoraires`
--

DROP TABLE IF EXISTS `honoraires`;
CREATE TABLE IF NOT EXISTS `honoraires` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ref` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reversement_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delai` date DEFAULT NULL,
  `nom_agent` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montant_lettre` text COLLATE utf8_unicode_ci,
  `detail` text COLLATE utf8_unicode_ci,
  `archiver` tinyint(1) DEFAULT '0',
  `mode` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reversement_id` (`reversement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `honoraires`
--

INSERT INTO `honoraires` (`id`, `ref`, `reversement_id`, `created_at`, `updated_at`, `delai`, `nom_agent`, `montant_lettre`, `detail`, `archiver`, `mode`) VALUES
(1, NULL, 1, '2020-12-04 01:40:03', '2020-12-04 01:40:03', '2020-12-04', 'Yaya', 'TTT', 'TT', 0, 'UUUU'),
(2, NULL, 1, '2020-12-04 02:09:39', '2020-12-04 02:09:39', '2020-12-01', 'Konan', 'TTTTT', 'UUUU', 0, 'TYYY'),
(3, '122020', 1, '2020-12-04 02:10:51', '2020-12-04 02:10:51', '2020-12-03', 'shshsh', 'gsgsgg', 'gsgsg', 0, 'hdhdh');

-- --------------------------------------------------------

--
-- Structure de la table `immeubles`
--

DROP TABLE IF EXISTS `immeubles`;
CREATE TABLE IF NOT EXISTS `immeubles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL,
  `part` int(2) DEFAULT NULL,
  `section` varchar(20) NOT NULL,
  `parcelle` varchar(20) NOT NULL,
  `lot` varchar(20) NOT NULL,
  `ilot` varchar(20) NOT NULL,
  `commune_id` bigint(10) UNSIGNED NOT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `adresse` varchar(200) NOT NULL,
  `detail` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `immeubles`
--

INSERT INTO `immeubles` (`id`, `libelle`, `part`, `section`, `parcelle`, `lot`, `ilot`, `commune_id`, `archiver`, `adresse`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'Aucun', NULL, '2', '', '', '', 1, 0, '', NULL, '2020-11-12 23:18:21', '2020-11-12 23:18:21'),
(2, 'Alpha 2000', NULL, '2', '3', '23', '21', 2, 0, 'Abidjan', NULL, '2020-11-12 23:19:18', '2020-11-12 23:19:18');

-- --------------------------------------------------------

--
-- Structure de la table `local_elements`
--

DROP TABLE IF EXISTS `local_elements`;
CREATE TABLE IF NOT EXISTS `local_elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `element_id` int(10) NOT NULL,
  `equipement_id` bigint(20) UNSIGNED NOT NULL,
  `equiper_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `detail` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `element_id` (`element_id`),
  KEY `equipement_id` (`equipement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locataires`
--

DROP TABLE IF EXISTS `locataires`;
CREATE TABLE IF NOT EXISTS `locataires` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `type_locataire_acq` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `mob1` varchar(20) DEFAULT NULL,
  `mob2` varchar(20) DEFAULT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `type_piece` varchar(25) DEFAULT NULL,
  `numero_piece` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `compte_contribuable` varchar(100) DEFAULT NULL,
  `compte_bancaire` varchar(200) DEFAULT NULL,
  `banque_id` int(10) DEFAULT '1',
  `photo` varchar(255) DEFAULT NULL,
  `autres` varchar(255) DEFAULT NULL,
  `client` varchar(50) DEFAULT NULL,
  `locataire` varchar(50) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `sexe` varchar(20) DEFAULT NULL,
  `nom_societe` varchar(100) DEFAULT NULL,
  `adresse_societe` varchar(100) DEFAULT NULL,
  `telephone_societe` varchar(50) DEFAULT NULL,
  `numero_registre` varchar(20) DEFAULT NULL,
  `nom_representant` varchar(55) DEFAULT NULL,
  `contact1_representant` varchar(50) DEFAULT NULL,
  `contact2_representant` varchar(50) DEFAULT NULL,
  `acquereur` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `banque_id` (`banque_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `locataires`
--

INSERT INTO `locataires` (`id`, `actif`, `type_locataire_acq`, `nom`, `prenom`, `mob1`, `mob2`, `archiver`, `type_piece`, `numero_piece`, `date_naissance`, `compte_contribuable`, `compte_bancaire`, `banque_id`, `photo`, `autres`, `client`, `locataire`, `adresse`, `sexe`, `nom_societe`, `adresse_societe`, `telephone_societe`, `numero_registre`, `nom_representant`, `contact1_representant`, `contact2_representant`, `acquereur`, `created_at`, `updated_at`) VALUES
(1, 0, 'personne physique', 'Konan', 'Bernadette Rosine', '09098899', '90909900', 0, 'cni', 'C00555555', '1989-08-01', NULL, NULL, 1, 'aucun', 'konan22@gmail.com', NULL, NULL, 'ABidjan', 'Mdme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-12-01 15:03:21', '2020-12-10 16:02:02'),
(2, 0, 'personne physique', 'Soumangourou', 'Kanté', '09099900', '55676767', 0, 'cni', 'C00675656', '2004-01-27', NULL, '', 1, 'aucun', 'kante@gmail.com', NULL, NULL, 'Marcory Rue 12', 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-12-03 12:51:21', '2020-12-03 12:51:21'),
(3, 0, 'personne physique', 'RAIMI', 'Yzyzy', '78898990', '9090988', 0, 'cni', 'C001787889', '2020-12-10', NULL, NULL, NULL, 'aucun', 'uu@gmail.com', NULL, NULL, 'Abidjan Cocody Angré', 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-12-10 15:36:48', '2020-12-10 16:03:14');

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `locataire_id` bigint(20) UNSIGNED NOT NULL,
  `date_location` date NOT NULL,
  `caution` varchar(200) NOT NULL,
  `delai_location` varchar(50) DEFAULT NULL,
  `detail` text,
  `autre` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ref` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `etat` varchar(20) DEFAULT NULL,
  `date_resiliation` date DEFAULT NULL,
  `loyer` int(11) NOT NULL,
  `revision_annuelle_loyer` int(11) NOT NULL,
  `frais_agence` int(11) DEFAULT NULL,
  `periodicite_loyer` varchar(20) DEFAULT NULL,
  `charge` int(11) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `frais_enregistrement` int(11) DEFAULT NULL,
  `date_echeance` date DEFAULT NULL,
  `frais_timbre` decimal(65,0) DEFAULT NULL,
  `jour_paiement` int(2) DEFAULT NULL,
  `mode_paiement` varchar(25) DEFAULT NULL,
  `taux_penalite` decimal(65,0) DEFAULT NULL,
  `mode_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nbre_depot` int(11) DEFAULT NULL,
  `ref_depot_garantie` varchar(30) DEFAULT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`),
  KEY `locataire_id` (`locataire_id`),
  KEY `id_user` (`user_id`),
  KEY `mode_id` (`mode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`id`, `bien_id`, `locataire_id`, `date_location`, `caution`, `delai_location`, `detail`, `autre`, `user_id`, `ref`, `type`, `etat`, `date_resiliation`, `loyer`, `revision_annuelle_loyer`, `frais_agence`, `periodicite_loyer`, `charge`, `duree`, `frais_enregistrement`, `date_echeance`, `frais_timbre`, `jour_paiement`, `mode_paiement`, `taux_penalite`, `mode_id`, `created_at`, `updated_at`, `nbre_depot`, `ref_depot_garantie`, `archiver`) VALUES
(1, 1, 1, '2020-12-07', '160000', NULL, NULL, NULL, 1, 'LSP-001-2020', 'Habitation', 'En cours', NULL, 80000, 1, 80000, 'Mensuel', 5000, 1, 2000, '2020-12-07', '10000', 5, NULL, '10', 5, '2020-12-07 10:44:43', '2020-12-07 10:46:18', 2, 'DG-001-2020-001', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mandats`
--

DROP TABLE IF EXISTS `mandats`;
CREATE TABLE IF NOT EXISTS `mandats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_reversement_loyer` varchar(100) DEFAULT NULL,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `ref` varchar(200) NOT NULL,
  `date_mandat` date NOT NULL,
  `commission` int(50) NOT NULL,
  `honnoraire` int(50) NOT NULL,
  `date_prise_effet` date NOT NULL,
  `nbre_renouvellement` int(20) NOT NULL,
  `duree` int(10) NOT NULL,
  `frequence_compte_rendu` varchar(20) NOT NULL,
  `autres_mandats` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_mandat` varchar(20) NOT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `date_enregistrement` date NOT NULL,
  `detail` text,
  `frais_cloture` int(20) DEFAULT '0',
  `doc1` varchar(100) DEFAULT NULL,
  `doc2` varchar(100) DEFAULT NULL,
  `impot` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mandats`
--

INSERT INTO `mandats` (`id`, `ref_reversement_loyer`, `bien_id`, `ref`, `date_mandat`, `commission`, `honnoraire`, `date_prise_effet`, `nbre_renouvellement`, `duree`, `frequence_compte_rendu`, `autres_mandats`, `created_at`, `updated_at`, `type_mandat`, `archiver`, `date_enregistrement`, `detail`, `frais_cloture`, `doc1`, `doc2`, `impot`) VALUES
(1, 'SP-001-2020', 1, 'SP-001-2020', '0000-00-00', 1000, 10, '2020-08-03', 2, 1, '1', NULL, '2020-12-01 15:00:52', '2020-12-03 18:10:23', 'Habitation', 0, '2020-08-03', NULL, 25000, NULL, NULL, 1),
(2, 'SP-002-2020', 2, 'SP-002-2020', '0000-00-00', 20000, 10, '2020-11-02', 1, 2, '1', NULL, '2020-12-03 12:50:00', '2020-12-03 12:50:00', 'Habitation', 0, '2020-11-02', NULL, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_08_110305_create_proprietaires_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `modes`
--

DROP TABLE IF EXISTS `modes`;
CREATE TABLE IF NOT EXISTS `modes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `masquer` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modes`
--

INSERT INTO `modes` (`id`, `libelle`, `masquer`) VALUES
(1, 'Chèque', 0),
(2, 'Virement', 0),
(3, 'Espèce', 0),
(4, 'Orange Money', 0),
(5, 'MTN Money', 0),
(6, 'FLOOZ', 0),
(7, 'Western union', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rolandgerard55@gmail.com', '$2y$10$jyRuRytbSrOSDrJXuP7zIunz9tFI.vtj9rThS80KIHRhkt5HB.v1u', '2020-09-07 15:06:38');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaires`
--

DROP TABLE IF EXISTS `proprietaires`;
CREATE TABLE IF NOT EXISTS `proprietaires` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_proprietaire` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `mobile1` varchar(2025) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile2` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compte_bancaire` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banque_id` int(10) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `telephone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compte_contribuable` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_piece` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_piece` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activ` tinyint(1) DEFAULT NULL,
  `emailto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_societe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_registre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_societe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_societe` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_representant` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact1_representant` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact2_representant` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banque_id` (`banque_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `proprietaires`
--

INSERT INTO `proprietaires` (`id`, `type_proprietaire`, `nom`, `prenom`, `date_naissance`, `mobile1`, `mobile2`, `compte_bancaire`, `banque_id`, `actif`, `archiver`, `telephone`, `adresse`, `sexe`, `compte_contribuable`, `numero_piece`, `type_piece`, `photo`, `document`, `activ`, `emailto`, `nom_societe`, `numero_registre`, `telephone_societe`, `adresse_societe`, `nom_representant`, `contact1_representant`, `contact2_representant`, `email`, `created_at`, `updated_at`) VALUES
(1, 'personne physique', 'GNEKOHI', 'Poté Amaud', '2006-02-08', '49231058', NULL, '', 1, 0, 0, NULL, 'Abidjan Cocody Angré', 'Monsieur', NULL, 'C00343456', 'cni', 'aucun', '[]', NULL, 'gnekinter@yahoo.fr', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '2020-12-01 14:51:02', '2020-12-01 14:51:02'),
(2, 'personne physique', 'TOURE', 'Moussa Serge', NULL, '5656778899', '09098989', '', 1, 0, 0, NULL, 'BP 34 Abidjan 01', 'Monsieur', '', 'C004545770', 'cni', 'aucun', '[]', NULL, 'moussa22@gmail.com', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '2020-12-04 11:26:56', '2020-12-04 11:27:48');

-- --------------------------------------------------------

--
-- Structure de la table `quittances`
--

DROP TABLE IF EXISTS `quittances`;
CREATE TABLE IF NOT EXISTS `quittances` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `verser` tinyint(1) NOT NULL DEFAULT '0',
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `ref` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facture_id` bigint(20) NOT NULL,
  `bien_id` bigint(20) DEFAULT NULL,
  `date_quittance` date NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `facture_id` (`facture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `quittances`
--

INSERT INTO `quittances` (`id`, `verser`, `archiver`, `ref`, `facture_id`, `bien_id`, `date_quittance`, `mois`, `annee`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'QL-001-2020-001', 1, 2, '2020-12-03', 1, 2021, '2020-12-03 18:21:05', '2020-12-03 18:21:05'),
(2, 1, 0, 'QL-001-2020-002', 1, 2, '2020-12-03', 1, 2021, '2020-12-03 23:07:06', '2020-12-03 23:07:06');

-- --------------------------------------------------------

--
-- Structure de la table `reglements`
--

DROP TABLE IF EXISTS `reglements`;
CREATE TABLE IF NOT EXISTS `reglements` (
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) DEFAULT NULL,
  `facture_id` bigint(20) NOT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `date_reglement` date NOT NULL,
  `montant` decimal(65,0) NOT NULL,
  `user_id` int(20) NOT NULL,
  `user_nom` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `facture_id` (`facture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reglementventes`
--

DROP TABLE IF EXISTS `reglementventes`;
CREATE TABLE IF NOT EXISTS `reglementventes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `date_reglement` date NOT NULL,
  `montant_reglement` decimal(10,0) NOT NULL,
  `user_id` int(20) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vente_id` (`vente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reglementventes`
--

INSERT INTO `reglementventes` (`id`, `vente_id`, `date_reglement`, `montant_reglement`, `user_id`, `user_nom`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-11-12', '10000', 1, 'Poté', '2020-11-12 17:55:44', '2020-11-12 17:55:44');

-- --------------------------------------------------------

--
-- Structure de la table `relances`
--

DROP TABLE IF EXISTS `relances`;
CREATE TABLE IF NOT EXISTS `relances` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_relance` date NOT NULL,
  `etat` tinyint(1) DEFAULT '0',
  `facture_id` bigint(20) NOT NULL,
  `archiver` tinyint(1) DEFAULT '0',
  `ref` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `facture_id` (`facture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reversements`
--

DROP TABLE IF EXISTS `reversements`;
CREATE TABLE IF NOT EXISTS `reversements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mandat_id` bigint(20) UNSIGNED NOT NULL,
  `tva` varchar(5) COLLATE utf8_unicode_ci DEFAULT '0',
  `impot` varchar(5) COLLATE utf8_unicode_ci DEFAULT '0',
  `remise` int(11) DEFAULT '0',
  `date_revers` date NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  `ref` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reversements`
--

INSERT INTO `reversements` (`id`, `mandat_id`, `tva`, `impot`, `remise`, `date_revers`, `detail`, `archiver`, `ref`, `created_at`, `updated_at`) VALUES
(1, 2, '0', '0', 0, '2020-12-03', NULL, 0, 'RL-001-2020-002', '2020-12-03 18:21:34', '2020-12-03 18:21:34'),
(2, 2, '3', '10', 0, '2020-12-04', 'RAS', 0, 'RL-002-2020-002', '2020-12-04 00:19:59', '2020-12-04 00:51:33');

-- --------------------------------------------------------

--
-- Structure de la table `typebiens`
--

DROP TABLE IF EXISTS `typebiens`;
CREATE TABLE IF NOT EXISTS `typebiens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(150) NOT NULL,
  `details` varchar(255) NOT NULL,
  `autres` varchar(255) DEFAULT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typebiens`
--

INSERT INTO `typebiens` (`id`, `libelle`, `details`, `autres`, `archiver`) VALUES
(1, 'Terrain', 'Un terrain est un terrain nu  à bâtir ou un terrain non constructible disposant déjà d\' une construction immobilière', NULL, 0),
(2, 'Maison', 'La villa est dotée de grands espaces et d\'un nombre important de pièces de plain-pied ou avec des étages', NULL, 0),
(3, 'Appartement', 'Local logé au sein d\'un immeuble', NULL, 0),
(4, 'Immeuble', 'Test', NULL, 0),
(5, 'Commerce', 'Il s\'agit ici d\'un Magasin', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mobile1`, `mobile2`, `nom`, `prenom`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '89507479', '49231058', 'Gnekohi', 'Poté Amaud', 'Poté', 'apo@enical-group.com', NULL, '$2y$10$eWvGYboMH5gEWyHYNvrF9eITOtL621O/u1uOqanyDCL6qUsNFa1XO', '4Bs9uIWaPUotdJU0X095VDuAlzyUYOienMK6xMBen7RQEcwpnP83z0ZLj8pS', '2020-09-07 10:29:46', '2020-09-07 10:29:46');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(150) NOT NULL,
  `date_vente` date NOT NULL,
  `remise` decimal(65,0) DEFAULT NULL,
  `quantité` int(25) DEFAULT NULL,
  `condition_vente` varchar(255) DEFAULT NULL,
  `prix_unitaire` decimal(65,0) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `bien_id` bigint(20) UNSIGNED NOT NULL,
  `montant_total` decimal(65,0) DEFAULT NULL,
  `tva` int(15) DEFAULT NULL,
  `reste_payer` decimal(65,0) DEFAULT NULL,
  `payer` decimal(65,0) DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bien_id` (`bien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `versements`
--

DROP TABLE IF EXISTS `versements`;
CREATE TABLE IF NOT EXISTS `versements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quittance_id` bigint(20) NOT NULL,
  `reversement_id` bigint(20) NOT NULL,
  `taux` decimal(10,0) NOT NULL DEFAULT '0',
  `montant` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `quittance_id` (`quittance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `versements`
--

INSERT INTO `versements` (`id`, `quittance_id`, `reversement_id`, `taux`, `montant`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0', 106000, '2020-12-03 18:21:34', '2020-12-03 18:21:34'),
(2, 2, 2, '0', 106000, '2020-12-04 00:19:59', '2020-12-04 00:19:59');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acheters`
--
ALTER TABLE `acheters`
  ADD CONSTRAINT `acheters_ibfk_1` FOREIGN KEY (`locataire_id`) REFERENCES `locataires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acheters_ibfk_2` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `appartements`
--
ALTER TABLE `appartements`
  ADD CONSTRAINT `appartements_ibfk_1` FOREIGN KEY (`bien_id`) REFERENCES `biens` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `appartenirs`
--
ALTER TABLE `appartenirs`
  ADD CONSTRAINT `appartenirs_ibfk_1` FOREIGN KEY (`proprietaire_id`) REFERENCES `proprietaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appartenirs_ibfk_2` FOREIGN KEY (`bien_id`) REFERENCES `biens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `appliquers`
--
ALTER TABLE `appliquers`
  ADD CONSTRAINT `appliquers_ibfk_1` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appliquers_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `autresparties`
--
ALTER TABLE `autresparties`
  ADD CONSTRAINT `autresparties_ibfk_1` FOREIGN KEY (`bien_id`) REFERENCES `biens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD CONSTRAINT `besoins_ibfk_2` FOREIGN KEY (`typebien_id`) REFERENCES `typebiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `besoins_ibfk_3` FOREIGN KEY (`locataire_id`) REFERENCES `locataires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `bienimms`
--
ALTER TABLE `bienimms`
  ADD CONSTRAINT `bienimms_ibfk_1` FOREIGN KEY (`immeuble_id`) REFERENCES `immeubles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `biens`
--
ALTER TABLE `biens`
  ADD CONSTRAINT `biens_ibfk_1` FOREIGN KEY (`typebien_id`) REFERENCES `typebiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`besoin_id`) REFERENCES `besoins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `budgets_ibfk_2` FOREIGN KEY (`mode_id`) REFERENCES `modes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Contraintes pour la table `equipers`
--
ALTER TABLE `equipers`
  ADD CONSTRAINT `equipers_ibfk_1` FOREIGN KEY (`equipement_id`) REFERENCES `equipements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipers_ibfk_2` FOREIGN KEY (`bien_id`) REFERENCES `biens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etat1s`
--
ALTER TABLE `etat1s`
  ADD CONSTRAINT `etat1s_ibfk_1` FOREIGN KEY (`mandat_id`) REFERENCES `mandats` (`id`);

--
-- Contraintes pour la table `etats`
--
ALTER TABLE `etats`
  ADD CONSTRAINT `etats_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Contraintes pour la table `honoraires`
--
ALTER TABLE `honoraires`
  ADD CONSTRAINT `honoraires_ibfk_1` FOREIGN KEY (`reversement_id`) REFERENCES `reversements` (`id`);

--
-- Contraintes pour la table `local_elements`
--
ALTER TABLE `local_elements`
  ADD CONSTRAINT `local_elements_ibfk_1` FOREIGN KEY (`equipement_id`) REFERENCES `equipements` (`id`),
  ADD CONSTRAINT `local_elements_ibfk_2` FOREIGN KEY (`element_id`) REFERENCES `elements` (`id`);

--
-- Contraintes pour la table `locataires`
--
ALTER TABLE `locataires`
  ADD CONSTRAINT `locataires_ibfk_1` FOREIGN KEY (`banque_id`) REFERENCES `banques` (`id`);

--
-- Contraintes pour la table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`mode_id`) REFERENCES `modes` (`id`),
  ADD CONSTRAINT `locations_ibfk_2` FOREIGN KEY (`bien_id`) REFERENCES `biens` (`id`),
  ADD CONSTRAINT `locations_ibfk_3` FOREIGN KEY (`locataire_id`) REFERENCES `locataires` (`id`);

--
-- Contraintes pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  ADD CONSTRAINT `proprietaires_ibfk_1` FOREIGN KEY (`banque_id`) REFERENCES `banques` (`id`);

--
-- Contraintes pour la table `quittances`
--
ALTER TABLE `quittances`
  ADD CONSTRAINT `quittances_ibfk_1` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`);

--
-- Contraintes pour la table `relances`
--
ALTER TABLE `relances`
  ADD CONSTRAINT `relances_ibfk_1` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`);

--
-- Contraintes pour la table `versements`
--
ALTER TABLE `versements`
  ADD CONSTRAINT `versements_ibfk_2` FOREIGN KEY (`quittance_id`) REFERENCES `quittances` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
