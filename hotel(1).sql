-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 25 août 2023 à 17:26
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
-- Base de données : `hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `client_name` varchar(250) NOT NULL,
  `client_email` varchar(250) NOT NULL,
  `room_type` varchar(10) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `number_of_adults` int(11) NOT NULL,
  `number_of_children` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `cin` varchar(20) DEFAULT NULL,
  `ucode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `client_name`, `client_email`, `room_type`, `phone_number`, `check_in`, `check_out`, `number_of_adults`, `number_of_children`, `room_id`, `cin`, `ucode`) VALUES
(15, 'asmae', 'asmae@gmail.com', 'Double', 6777554, '2023-09-30', '2023-10-02', 2, 1, 1, '43255', 987200729);

-- --------------------------------------------------------

--
-- Structure de la table `reserved_rooms`
--

CREATE TABLE `reserved_rooms` (
  `id_room` int(11) DEFAULT NULL,
  `room_reserved_check_in` date DEFAULT NULL,
  `room_reserved_check_out` date DEFAULT NULL,
  `ucode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reserved_rooms`
--

INSERT INTO `reserved_rooms` (`id_room`, `room_reserved_check_in`, `room_reserved_check_out`, `ucode`) VALUES
(1, '2023-09-15', '2023-09-22', 485149702),
(2, '2023-09-15', '2023-09-22', 753582840),
(1, '2023-09-30', '2023-10-02', 987200729);

-- --------------------------------------------------------

--
-- Structure de la table `roomshotel`
--

CREATE TABLE `roomshotel` (
  `id_room` int(11) NOT NULL,
  `room_type` varchar(20) DEFAULT NULL CHECK (`room_type` in ('single','double')),
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roomshotel`
--

INSERT INTO `roomshotel` (`id_room`, `room_type`, `adults`, `children`) VALUES
(1, 'single', 1, 0),
(2, 'double', 1, 1),
(3, 'single', 1, 1),
(4, 'single', 1, 0),
(5, 'double', 2, 1),
(6, 'single', 2, 1),
(7, 'double', 2, 1),
(8, 'single', 2, 1),
(9, 'double', 2, 1),
(10, 'single', 2, 0),
(11, 'single', 1, 0),
(12, 'double', 1, 0),
(13, 'single', 1, 0),
(14, 'single', 2, 0),
(15, 'double', 2, 1),
(16, 'double', 2, 1),
(17, 'single', 2, 0),
(18, 'double', 2, 1),
(19, 'single', 1, 1),
(20, 'double', 2, 1),
(21, 'single', 1, 0),
(22, 'double', 1, 1),
(23, 'single', 1, 0),
(24, 'double', 2, 1),
(25, 'double', 1, 1),
(26, 'single', 1, 0),
(27, 'double', 2, 1),
(28, 'single', 1, 2),
(29, 'single', 1, 1),
(30, 'double', 2, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reserved_rooms`
--
ALTER TABLE `reserved_rooms`
  ADD KEY `id_room` (`id_room`);

--
-- Index pour la table `roomshotel`
--
ALTER TABLE `roomshotel`
  ADD PRIMARY KEY (`id_room`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `roomshotel`
--
ALTER TABLE `roomshotel`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reserved_rooms`
--
ALTER TABLE `reserved_rooms`
  ADD CONSTRAINT `reserved_rooms_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `roomshotel` (`id_room`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
