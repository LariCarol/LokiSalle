-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2024 at 02:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lokisalles`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES
(1, 1, 1, '2024-09-13 08:47:35'),
(2, 2, 2, '2024-09-13 08:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('h','f') NOT NULL,
  `statut` int(1) NOT NULL DEFAULT 2,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(1, 'mcurie', '$2y$10$/7Y.qLzSvaxqc49nR2pSWuHY6xR1hEecXWb1dv.l.Gsfz/uX1hVxO', 'Curie', 'Marie', 'mariecurie@gmail.com', 'f', 2, '2024-09-12 18:15:20'),
(2, 'gustaveeiffel', '$2y$10$xoHHoFVeMK7z2Ka/Km3cJ.oSk4cVsdz2XRDwCBWoDjaW8UaizTFuq', 'Eiffel', 'Gustave', 'gustaveeiffel@gmail.com', 'h', 2, '2024-09-12 18:20:09'),
(3, 'admin', '$2y$10$N/R8xwm6oWG.evPO3yEaAOftqowA49nQzgNTi4lZGHcqW2UqC7ag2', 'admin', 'admin', 'admin@gmail.com', 'h', 1, '2024-09-12 19:40:22'),
(5, 'vhugo', '$2y$10$wX0qfvaHstOu/WqOn9fIv.oVnUfJFshXeTkD10cVHRXTtCbb2HLxW', 'Hugo', 'Victor', 'victorhugo@gmail.com', 'h', 2, '2024-09-12 20:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrive` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') NOT NULL DEFAULT 'libre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrive`, `date_depart`, `prix`, `etat`) VALUES
(1, 130, '2024-09-13 00:00:00', '2024-09-21 00:00:00', 1300, 'reservation'),
(2, 693, '2024-09-25 00:00:00', '2024-09-28 00:00:00', 1500, 'reservation'),
(3, 751, '2024-09-13 09:00:00', '2024-09-21 17:00:00', 1800, 'libre');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(5) NOT NULL,
  `categorie` enum('réunion','bureau','formation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(130, 'Salle Cézanne', 'Aussi calme, idéale pour une réunion.', 'salle_cezanne.jpg', 'France', 'Marseille', '4 Avenue Marie Curie', 13010, 10, 'réunion'),
(131, 'Salle Rubens', 'Dans un décor de goût, la salle est adapté pour faire une réunion, formation ou une video-conference.', 'salle_rubens.jpg', 'France', 'Marseille', '11 Avenue Kléber', 13001, 10, 'formation'),
(690, 'Bureau Bazille', 'Salle standard moderne et flexible, idéal pour vos réunions professionnelles.', 'bureau_bazille.jpg', 'France', 'Lyon', '5 Avenue Jean Jacques', 69001, 5, 'bureau'),
(692, 'Salle Renoir', 'Cet espace est idéale pour une réunion ou formation.', 'salle_renoir.jpg', 'France', 'Lyon', '6 Rue des Oiseaux', 69003, 8, 'formation'),
(693, 'Salle Duchamp', 'Parfait pour une réunion ou formation.', 'salle_duchamp.jpg', 'France', 'Lyon', '66 Rue François Mitterand', 69020, 8, 'formation'),
(750, 'Bureau Picasso', 'Parfait pour vos formations professionnelles.', 'bureau_picasso.jpg', 'France', 'Paris', '50 Rue du Temple', 75007, 15, 'bureau'),
(751, 'Salle Van Gogh', 'Placé au coeur de la capitale. Quelques pas de tous le transports en communs, centres commerciaux.', 'salle_vangogh.jpg', 'France', 'Paris', '100 Avenue champs de mars', 75007, 40, 'réunion'),
(752, 'Salle Klee', 'Situé dans un immeuble haut de gamme. Idéale pour une réunion.', 'salle_klee.jpg', 'France', 'Paris', '44 Rue Pierre Brosolet', 75006, 6, 'réunion'),
(753, 'Salle Monet', 'Une salle idéale, située en plein cour du centre-ville, parfaitement acessible pour tous les transports. Les instalations sont modernes et l\'environnement est proprice aux échanges professionnels.', 'salle_monet.jpg', 'France', 'Paris', '1 Avenue Charles de Gaulle', 75001, 30, 'réunion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `FK_SALLE` (`id_salle`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=757;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
