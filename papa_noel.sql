-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 15 jan. 2024 à 18:36
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `papa_noel`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Jouets éducatifs'),
(2, 'Jeux de société'),
(3, 'Peluches'),
(4, 'Livres pour enfants'),
(5, 'Jeux de construction');

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `speudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(450) NOT NULL,
  `validate` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `speudo`, `description`, `validate`) VALUES
(19, 'Ethan', 'Bonjour je voudrais juste dire que je trouve la période de noel extraordinaire, j&#039;aime me retrouver en famille pour les fête ! ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gift`
--

CREATE TABLE `gift` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommended_age` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gift`
--

INSERT INTO `gift` (`id`, `name`, `recommended_age`, `description`, `category_id`) VALUES
(43, 'Puzzle ABC', 3, 'Un puzzle éducatif pour apprendre l\'alphabet', 1),
(44, 'Livre de contes', 5, 'Un livre magique rempli d\'histoires captivantes', 4),
(45, 'Jeu de construction en bois', 4, 'Un ensemble de blocs en bois pour stimuler la créativité', 5),
(46, 'Peluche ourson', 2, 'Une adorable peluche ourson pour câliner', 3),
(47, 'Jeu de société familial', 6, 'Un jeu de société pour des heures de plaisir en famille', 2),
(48, 'Casse-tête spatial', 8, 'Un casse-tête captivant avec des images spatiales', 1),
(49, 'Livre de coloriage interactif', 4, 'Un livre de coloriage interactif avec des jeux intégrés', 4),
(50, 'Jouet musical pour bébé', 1, 'Un jouet musical doux pour les tout-petits', 1),
(51, 'Ensemble de voitures miniatures', 5, 'Un ensemble de voitures miniatures pour les passionnés de véhicules', 5),
(52, 'Doudou éléphant', 1, 'Un doudou éléphant tout doux', 3),
(53, 'Jeu de construction magnétique', 7, 'Des pièces magnétiques pour créer des formes variées', 5),
(54, 'Livre éducatif sur les animaux', 6, 'Un livre qui enseigne les animaux du monde', 4),
(55, 'Poupée en peluche', 3, 'Une poupée en peluche avec des vêtements amovibles', 3),
(56, 'Set de crayons de couleur', 5, 'Un ensemble de crayons de couleur pour l\'artiste en herbe', 4),
(57, 'Robot interactif', 8, 'Un robot intelligent avec des fonctionnalités interactives', 1),
(58, 'Jeu de cartes classique', 10, 'Un jeu de cartes classique pour des parties amusantes', 2),
(59, 'Livre pop-up pour enfants', 4, 'Un livre pop-up avec des illustrations 3D', 4),
(60, 'Circuit de voiture électrique', 7, 'Un circuit de voiture électrique pour les amateurs de vitesse', 5),
(61, 'Doudou lapin', 2, 'Un doudou lapin tout doux', 3),
(62, 'Jouet de bain pour bébé', 1, 'Un jouet de bain coloré et sûr', 1),
(63, 'Puzzle 3D', 8, 'Un puzzle en trois dimensions pour un défi supplémentaire', 1),
(64, 'Cahier d\'activités pour enfants', 6, 'Un cahier d\'activités pour stimuler la créativité', 4),
(65, 'Puzzle en bois animaux', 4, 'Un puzzle en bois avec des formes d\'animaux', 5),
(66, 'Jeu de mémoire pour enfants', 5, 'Un jeu de mémoire pour développer les compétences cognitives', 2),
(67, 'Dinosaure en peluche', 3, 'Un dinosaure en peluche pour les amateurs de dinosaures', 3),
(68, 'Set de dessin pour enfants', 7, 'Un ensemble de dessin complet pour les jeunes artistes', 4);

-- --------------------------------------------------------

--
-- Structure de la table `image_gift`
--

CREATE TABLE `image_gift` (
  `gift_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image_gift`
--

INSERT INTO `image_gift` (`gift_id`, `path`) VALUES
(67, 'uploads/Dinosaureenpeluche.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `letter`
--

CREATE TABLE `letter` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `letter_gift`
--

CREATE TABLE `letter_gift` (
  `letter_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role_id`, `username`, `password`) VALUES
(1, 1, 'PapaNoel', '$2y$10$xUrQ0VBstL8nhD30LDQ/U.SqmSBsYCX1flLH2mXuOjfCKeCm.0FVG'),
(56, 2, 'Lutin3', '$2y$10$8PEAKl42o6gyMk2Na4RZTulhk/ov8FelrlIRInrOvDYVwzqDKR44q');

-- --------------------------------------------------------

--
-- Structure de la table `wanted_gift`
--

CREATE TABLE `wanted_gift` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wanted_gift_letter`
--

CREATE TABLE `wanted_gift_letter` (
  `letter_id` int(11) NOT NULL,
  `wanted_gift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Index pour la table `image_gift`
--
ALTER TABLE `image_gift`
  ADD PRIMARY KEY (`gift_id`);

--
-- Index pour la table `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `letter_gift`
--
ALTER TABLE `letter_gift`
  ADD PRIMARY KEY (`letter_id`,`gift_id`),
  ADD KEY `fk_gift_id_2` (`gift_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Index pour la table `wanted_gift`
--
ALTER TABLE `wanted_gift`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wanted_gift_letter`
--
ALTER TABLE `wanted_gift_letter`
  ADD PRIMARY KEY (`letter_id`,`wanted_gift_id`),
  ADD KEY `fk_wanted_gift_id` (`wanted_gift_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `gift`
--
ALTER TABLE `gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT pour la table `letter`
--
ALTER TABLE `letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `wanted_gift`
--
ALTER TABLE `wanted_gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gift`
--
ALTER TABLE `gift`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `image_gift`
--
ALTER TABLE `image_gift`
  ADD CONSTRAINT `fk_gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `letter_gift`
--
ALTER TABLE `letter_gift`
  ADD CONSTRAINT `fk_gift_id_2` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`),
  ADD CONSTRAINT `fk_letter_id_2` FOREIGN KEY (`letter_id`) REFERENCES `letter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wanted_gift_letter`
--
ALTER TABLE `wanted_gift_letter`
  ADD CONSTRAINT `fk_letter_id` FOREIGN KEY (`letter_id`) REFERENCES `letter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wanted_gift_id` FOREIGN KEY (`wanted_gift_id`) REFERENCES `wanted_gift` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
