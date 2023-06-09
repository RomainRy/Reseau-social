-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 26 mai 2023 à 20:12
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `titre` varchar(140) NOT NULL,
  `contenu` text NOT NULL,
  `pseudo` varchar(55) DEFAULT NULL,
  `date` datetime NOT NULL,
  `tag` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `pseudo`, `date`, `tag`) VALUES
(141, 'test', 'test', 'Romain', '2023-05-26 21:41:59', 'Sport'),
(142, 'test', 'test', 'Romain', '2023-05-26 21:42:04', 'Informatique'),
(143, 'test', 'test', 'Romain', '2023-05-26 21:42:08', 'Environnement'),
(144, 'test', 'test', 'Hugo', '2023-05-26 22:11:43', 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `pseudo` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nom` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `nom`, `email`, `password`, `avatar`) VALUES
(19, 'Romain', 'Romain', 'romain.royer78@gmail.com', 'test', 'avatars/51rebKIc+VL._SX355_.jpg'),
(20, 'Hugo', 'Hugo', 'Hugo@gmail.com', 'Hugo', '../avatars/istockphoto-1202740292-612x612.jpg'),
(21, 'tt', 'tt', 'tt@gmail.com', 'tt', '../avatars/Apple-logo-1.jpg'),
(23, 'Rom', 'Rom', 'rom@gmail.com', 'test', '../avatars/51rebKIc+VL._SX355_.jpg'),
(24, 'azerty', 'azerty', 'azerty@gmail', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(27, 'azerty', 'azerty', 'azerty@gmail.com', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(28, 'azerty', 'azerty', 'azerty@gmail.com', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(29, 'azerty', 'azerty', 'azerty@gmail.com', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(30, 'azerty', 'azerty', 'azerty@gmail.com', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(31, 'azerty', 'azerty', 'azerty@gmail.com', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(32, 'azertty', 'azerty', 'azerty@gmail.com', 'azerty', '../avatars/51rebKIc+VL._SX355_.jpg'),
(33, 'test', 'test', 'test@gmail.com', 'test', '../avatars/51rebKIc+VL._SX355_.jpg'),
(34, 'alex', 'alex', 'alex@alex.fr', 'alex', '../avatars/istockphoto-1202740292-612x612.jpg'),
(35, 'blaise', 'blaise', 'blaise@gmail', 'test', '../avatars/51rebKIc+VL._SX355_.jpg'),
(36, '1', '1', '1@gmail', '1', '../avatars/51rebKIc+VL._SX355_.jpg'),
(37, 'tom', 'tom', 'tom@gmail.com', 'tom', '../avatars/51rebKIc+VL._SX355_.jpg'),
(38, 'jule', 'jule', 'jule@gmail.com', 'jule', '../avatars/51rebKIc+VL._SX355_.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
