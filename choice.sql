-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 08:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `choice`
--

-- --------------------------------------------------------

--
-- Table structure for table `champs`
--

CREATE TABLE `champs` (
  `id_champ` int(11) NOT NULL,
  `nom_champ` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `champs`
--

INSERT INTO `champs` (`id_champ`, `nom_champ`) VALUES
(63, 'navire'),
(64, 'navire'),
(65, 'cr_sortie_GO'),
(66, 'cr_sortie_S/P'),
(67, 'wr_recu_GO'),
(68, 'cr_sortie_GO'),
(69, 'cr_sortie_GO'),
(70, 'cr recu GO'),
(71, 'cr recu GO'),
(72, 'wr_recu_GO'),
(73, 'cr recu GO'),
(74, 'cr_sortie_GO'),
(75, 'cr recu GO'),
(76, 'wr_recu_GO');

-- --------------------------------------------------------

--
-- Table structure for table `donnees`
--

CREATE TABLE `donnees` (
  `id_donnee` int(11) NOT NULL,
  `id_wilaya` int(11) DEFAULT NULL,
  `id_champ` int(11) DEFAULT NULL,
  `dat` date DEFAULT NULL,
  `valeur_mensul` varchar(20) DEFAULT NULL,
  `valeur_quotidien` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donnees`
--

INSERT INTO `donnees` (`id_donnee`, `id_wilaya`, `id_champ`, `dat`, `valeur_mensul`, `valeur_quotidien`) VALUES
(77, 128, 63, '2023-01-01', '4', '0'),
(78, 128, 0, '2024-09-11', '1576', '96'),
(79, 128, 0, '2023-01-01', '298', '10'),
(82, 133, 65, '2024-09-09', '200', '20'),
(83, 128, 0, '2024-09-09', '298', '13'),
(84, 133, 70, '2024-09-09', '199', '23'),
(85, 133, 67, '2024-09-09', '400', '45'),
(86, 132, 70, '2024-09-09', '200', '21'),
(87, 133, 65, '2024-11-11', '298', '16'),
(88, 133, 70, '2024-11-11', '58', '3'),
(89, 133, 67, '2024-11-11', '200', '10');

-- --------------------------------------------------------

--
-- Table structure for table `wilayas`
--

CREATE TABLE `wilayas` (
  `id_wilaya` int(10) NOT NULL,
  `nom_wilaya` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wilayas`
--

INSERT INTO `wilayas` (`id_wilaya`, `nom_wilaya`) VALUES
(128, 'Bejaia'),
(129, 'Bejaia'),
(130, 'Bejaia'),
(131, 'Bejaia'),
(132, 'msila'),
(133, 'BBA'),
(134, 'BBA'),
(135, 'Bejaia'),
(136, 'BBA'),
(137, 'BBA'),
(138, 'msila'),
(139, 'BBA'),
(140, 'BBA'),
(141, 'BBA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `champs`
--
ALTER TABLE `champs`
  ADD PRIMARY KEY (`id_champ`);

--
-- Indexes for table `donnees`
--
ALTER TABLE `donnees`
  ADD PRIMARY KEY (`id_donnee`),
  ADD KEY `id_wilaya` (`id_wilaya`);

--
-- Indexes for table `wilayas`
--
ALTER TABLE `wilayas`
  ADD PRIMARY KEY (`id_wilaya`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `champs`
--
ALTER TABLE `champs`
  MODIFY `id_champ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `donnees`
--
ALTER TABLE `donnees`
  MODIFY `id_donnee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `wilayas`
--
ALTER TABLE `wilayas`
  MODIFY `id_wilaya` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donnees`
--
ALTER TABLE `donnees`
  ADD CONSTRAINT `donnees_ibfk_1` FOREIGN KEY (`id_wilaya`) REFERENCES `wilayas` (`id_wilaya`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
