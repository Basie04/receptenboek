-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Mar 22, 2023 at 04:13 PM
-- Server version: 10.4.28-MariaDB-1:10.4.28+maria~ubu2004
-- PHP Version: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `receptenboek`
--

-- --------------------------------------------------------

--
-- Table structure for table `gebruiker`
--

CREATE TABLE `gebruiker` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(100) NOT NULL,
  `achternaam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` enum('gebruiker','kok','manager','eigenaar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gebruiker`
--

INSERT INTO `gebruiker` (`id`, `voornaam`, `achternaam`, `email`, `rol`) VALUES
(1, 'Cornelius', 'Arne', 'cornelius.Arne@hotmail.nl', 'eigenaar'),
(2, 'Pascal-Anne', 'Stá', 'Pascal-Anne.Stá@outlook.com', 'manager'),
(3, 'Sebastiaan', 'van Bruggen', 'sebastiaan.vanbruggen@gmail.com', 'kok'),
(4, 'Gerard', 'Molen', 'gerard.molen@gmail.com', 'gebruiker');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `naam`) VALUES
(1, 'vlees'),
(2, 'aardapel'),
(3, 'rijst'),
(4, 'rode saus'),
(5, 'bruine saus'),
(6, 'banaan'),
(7, 'tomaat'),
(8, 'prei'),
(9, 'ei'),
(10, 'komkommer');

-- --------------------------------------------------------

--
-- Table structure for table `recept`
--

CREATE TABLE `recept` (
  `id` int(11) NOT NULL,
  `maker` int(11) NOT NULL,
  `titel` varchar(100) NOT NULL,
  `instructies` text NOT NULL,
  `foto_path` varchar(255) NOT NULL,
  `duur_in_minuten` int(11) NOT NULL,
  `aantal_ingredienten` int(11) NOT NULL,
  `menugang` int(11) NOT NULL,
  `moeilijkheid` enum('makkerlijk','gemideld','moeilijk') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `recept`
--

INSERT INTO `recept` (`id`, `maker`, `titel`, `instructies`, `foto_path`, `duur_in_minuten`, `aantal_ingredienten`, `menugang`, `moeilijkheid`) VALUES
(1, 3, 'Goulash', 'Snijd de uien en paprika’s in stukjes.\r\nSnijd ook het vlees in stukken en haal het vlees door de bloem.\r\nVerwarm een beetje boter/vloeibare margarine in een pan.\r\nBak het vlees rondom bruin en voeg dan de uien, paprika’s en paprikapoeder toe. Bak dit een paar minuten mee en voeg dan de tomatenpuree toe. Meng alles door elkaar en voeg na 1 minuut de rest van de ingrediënten toe.\r\n\r\nBreng het geheel aan de kook, zet de deksel op de pan en laat dit ongeveer 2,5 tot 3 uur zachtjes pruttelen.\r\nHaal de deksel van de pan en laat de stoofschotel nog even inkoken, dit duurt ongeveer 15 minuutjes.\r\nVerwijder dan het laurierblaadje en serveer de goulash bijvoorbeeld met rijst of aardappeltjes.', './images/goulash.jpg', 20, 3, 2, 'gemideld'),
(2, 3, 'Chicken Paprikash', '', './images/Chicken_Paprikash.png', 35, 2, 2, 'moeilijk'),
(3, 3, 'Kurtoskalacs', '', './images/Kurtoskalacs.png', 15, 4, 3, 'makkerlijk');

-- --------------------------------------------------------

--
-- Table structure for table `recept_ingredienten`
--

CREATE TABLE `recept_ingredienten` (
  `recept_id` int(11) NOT NULL,
  `hoeveelheid` varchar(100) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `recept_ingredienten`
--

INSERT INTO `recept_ingredienten` (`recept_id`, `hoeveelheid`, `ingredient_id`) VALUES
(2, '3ST', 9),
(2, '500G', 3),
(1, '300G', 1),
(1, '1KG', 3),
(1, '3ST', 7),
(3, '600G', 3),
(3, '400ML', 5),
(3, '200G', 2),
(3, '6ST', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recept`
--
ALTER TABLE `recept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maker` (`maker`);

--
-- Indexes for table `recept_ingredienten`
--
ALTER TABLE `recept_ingredienten`
  ADD KEY `recept` (`recept_id`),
  ADD KEY `ingredient` (`ingredient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recept`
--
ALTER TABLE `recept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recept`
--
ALTER TABLE `recept`
  ADD CONSTRAINT `maker` FOREIGN KEY (`maker`) REFERENCES `gebruiker` (`id`);

--
-- Constraints for table `recept_ingredienten`
--
ALTER TABLE `recept_ingredienten`
  ADD CONSTRAINT `ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `recept` FOREIGN KEY (`recept_id`) REFERENCES `recept` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
