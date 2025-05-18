-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 18 mai 2025 à 20:28
-- Version du serveur : 8.0.42-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `footracker`
--

-- --------------------------------------------------------

--
-- Structure de la table `areas`
--

CREATE TABLE `areas` (
  `id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `drapeau_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classements`
--

CREATE TABLE `classements` (
  `id` int NOT NULL,
  `season` int DEFAULT NULL,
  `competition_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `tla` varchar(3) DEFAULT NULL,
  `stade_id` int DEFAULT NULL,
  `blason_url` varchar(255) DEFAULT NULL,
  `fondation` int DEFAULT NULL,
  `coach_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coachs`
--

CREATE TABLE `coachs` (
  `id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `date_naissance` varchar(50) DEFAULT NULL,
  `nationalite` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `competitions`
--

CREATE TABLE `competitions` (
  `id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `url_emblem` varchar(255) DEFAULT NULL,
  `area_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

CREATE TABLE `experiences` (
  `id` int NOT NULL,
  `auteur_id` int DEFAULT NULL,
  `match_id` int DEFAULT NULL,
  `note` int DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `user_id` int NOT NULL,
  `club_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `date_naissance` varchar(50) DEFAULT NULL,
  `nationalite` varchar(100) DEFAULT NULL,
  `club_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `id` int NOT NULL,
  `utc_date` varchar(30) DEFAULT NULL,
  `competition_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `matchday` int DEFAULT NULL,
  `stage` varchar(50) DEFAULT NULL,
  `stade_id` int DEFAULT NULL,
  `club_domicile_id` int DEFAULT NULL,
  `club_exterieur_id` int DEFAULT NULL,
  `mitemps_score_id` int DEFAULT NULL,
  `final_score_id` int DEFAULT NULL,
  `winner` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `placements`
--

CREATE TABLE `placements` (
  `classement_id` int NOT NULL,
  `club_id` int NOT NULL,
  `position` int DEFAULT NULL,
  `matchsJoues` int DEFAULT NULL,
  `forme` varchar(20) DEFAULT NULL,
  `victoires` int DEFAULT NULL,
  `egalites` int DEFAULT NULL,
  `defaites` int DEFAULT NULL,
  `points` int DEFAULT NULL,
  `butsMarques` int DEFAULT NULL,
  `butsEncaisses` int DEFAULT NULL,
  `butsDifference` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `scores`
--

CREATE TABLE `scores` (
  `id` int NOT NULL,
  `domicile` int DEFAULT NULL,
  `exterieur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stades`
--

CREATE TABLE `stades` (
  `id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `username`, `password`) VALUES
(1, 'admin@example.com', 'admin', 'admin'),
(2, 'user1@example.com', 'user1', 'mypassword1'),
(3, 'user2@example.com', 'user2', 'mypassword2'),
(4, 'guest@example.com', 'guest', 'guestpassword');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classements`
--
ALTER TABLE `classements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competition_id` (`competition_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stade_id` (`stade_id`),
  ADD KEY `coach_id` (`coach_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Index pour la table `coachs`
--
ALTER TABLE `coachs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Index pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auteur_id` (`auteur_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`user_id`,`club_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competition_id` (`competition_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `stade_id` (`stade_id`),
  ADD KEY `club_domicile_id` (`club_domicile_id`),
  ADD KEY `club_exterieur_id` (`club_exterieur_id`),
  ADD KEY `mitemps_score_id` (`mitemps_score_id`),
  ADD KEY `final_score_id` (`final_score_id`);

--
-- Index pour la table `placements`
--
ALTER TABLE `placements`
  ADD PRIMARY KEY (`classement_id`,`club_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stades`
--
ALTER TABLE `stades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `coachs`
--
ALTER TABLE `coachs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classements`
--
ALTER TABLE `classements`
  ADD CONSTRAINT `classements_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`),
  ADD CONSTRAINT `classements_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Contraintes pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_ibfk_1` FOREIGN KEY (`stade_id`) REFERENCES `stades` (`id`),
  ADD CONSTRAINT `clubs_ibfk_2` FOREIGN KEY (`coach_id`) REFERENCES `coachs` (`id`),
  ADD CONSTRAINT `clubs_ibfk_3` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Contraintes pour la table `competitions`
--
ALTER TABLE `competitions`
  ADD CONSTRAINT `competitions_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Contraintes pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `experiences_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);

--
-- Contraintes pour la table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`stade_id`) REFERENCES `stades` (`id`),
  ADD CONSTRAINT `matches_ibfk_4` FOREIGN KEY (`club_domicile_id`) REFERENCES `clubs` (`id`),
  ADD CONSTRAINT `matches_ibfk_5` FOREIGN KEY (`club_exterieur_id`) REFERENCES `clubs` (`id`),
  ADD CONSTRAINT `matches_ibfk_6` FOREIGN KEY (`mitemps_score_id`) REFERENCES `scores` (`id`),
  ADD CONSTRAINT `matches_ibfk_7` FOREIGN KEY (`final_score_id`) REFERENCES `scores` (`id`);

--
-- Contraintes pour la table `placements`
--
ALTER TABLE `placements`
  ADD CONSTRAINT `placements_ibfk_1` FOREIGN KEY (`classement_id`) REFERENCES `classements` (`id`),
  ADD CONSTRAINT `placements_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
