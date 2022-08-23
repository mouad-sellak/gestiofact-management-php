-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 08:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionfacture`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartenance`
--

CREATE TABLE `appartenance` (
  `IdApp` int(11) NOT NULL,
  `IdS` int(10) NOT NULL,
  `IdO` int(10) NOT NULL,
  `Qte` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appartenance`
--

INSERT INTO `appartenance` (`IdApp`, `IdS`, `IdO`, `Qte`) VALUES
(9, 5, 13, 0),
(10, 7, 11, 0),
(11, 3, 2, 0),
(12, 5, 2, 0),
(13, 7, 2, 0),
(14, 3, 1, 3),
(15, 3, 5, 3),
(16, 5, 1, 2),
(17, 10, 1, 3),
(18, 10, 1, 10),
(19, 10, 1, 3),
(20, 10, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `IdC` int(10) NOT NULL,
  `NomClient` varchar(50) DEFAULT NULL,
  `NumClient` varchar(50) NOT NULL,
  `Tel` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Addresse` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`IdC`, `NomClient`, `NumClient`, `Tel`, `Email`, `Addresse`) VALUES
(31, 'Sofax', 'ID0394959059403', '0658493029', 'sofix@gmail.com', 'Hay al Azhar-FES'),
(33, ' Sellak', 'V355832', '0637499636', 'mouad.sellak@usmba.ac.ma', 'Mont-Fleuri-FES'),
(34, 'Mouad sellak', 'V367879', '0658473756', 'saadS12@gmail.com', 'Hay Al adarissa'),
(35, 'WebRasma', 'ICE19238383939202', '0557485749', 'webrasma@hotmail.com', 'Avenue 3 CasaBlanca'),
(36, 'DigiWeb', 'IC394002303020', '0568473948', 'digiw@gmail.com', 'Avenue23-Meknes'),
(37, 'Soukaina Idrissi', 'CD485849', '0658494943', 'sg.idrissi@gmail.com', 'Route-AinChkf-Fes'),
(38, 'Yousssera Alami', 'CD485394', '0568495949', 'youssera@gmail.com', 'HayAdarissa-Fes'),
(39, 'Youssef Fatihi', 'X384494', '0658674859', 'youss@gmail.com', 'Route-Sefrou-Fes'),
(40, 'Yassir Write', 'N384388', '0657485789', 'yassirW@gmail.com', 'Q-Adarissa-Fes'),
(41, 'KaraMIX', 'ICE458458452093409', '0567586957', 'kara@gmail.com', 'Route Ain Hajjaj Fes'),
(42, 'Arizonix', 'IC4889394949934', '0657684058', 'ari@gmail.com', 'Hay-Atlas-Fes'),
(43, 'AfixMoler', 'ID45759495854', '0658475859', 'afix@gmail.com', 'Hay-AlFath-Fes'),
(44, 'SalimMoxi', 'ID3944848438343', '06345668475', 'salim@gm.com', 'Hay-Adarissa-Meknes'),
(45, 'Agence WebOrio', 'ICE574534344834', '0657483928', 'webo@gmail.com', 'hayAdarissry-Fes'),
(46, 'Billal sellak', 'V457839', '0659483526', 'bilal12@gmail.com', 'Ait-Mansor-khnifra'),
(47, 'Ramses ilija', 'XV483330', '0657483928', 'rams@yahoo.com', 'Nijirya-hynag'),
(48, 'Mohmad rachidi', 'CD23298', '06212134565', 'mohRachid@gmail.com', 'Imouzzar-fes'),
(50, 'Yanix mathieu', 'ZT232323', '0760404003', 'yanix@hotmail.fr', 'Touleuse-France'),
(53, 'Club FP', '4945940943', '065959404', 'c.futurepioneers@gmail.com', 'Centre fes');

-- --------------------------------------------------------

--
-- Table structure for table `devis`
--

CREATE TABLE `devis` (
  `IdD` int(10) NOT NULL,
  `DateD` date DEFAULT NULL,
  `Avance` double DEFAULT NULL,
  `TypeA` varchar(50) DEFAULT NULL,
  `FK_Obj` int(10) NOT NULL,
  `FK_Cli` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devis`
--

INSERT INTO `devis` (`IdD`, `DateD`, `Avance`, `TypeA`, `FK_Obj`, `FK_Cli`) VALUES
(5, '2021-06-14', 350, 'Espèce', 3, 43),
(6, '2021-07-20', 340, 'Espèce', 5, 42),
(7, '2021-07-20', 333, 'Espèce', 5, 46),
(8, '2021-07-22', 2000, 'Cache', 6, 53),
(9, '2021-07-14', 3333, 'Virement', 14, 36),
(10, '2021-07-08', 33333, 'Cache', 14, 41),
(12, '2021-07-14', 23, 'Cache', 1, 48),
(13, '2021-07-21', 2373, 'Cache', 7, 33),
(14, '2021-07-21', 200, 'Cache', 6, 47),
(15, '2021-07-07', 646, 'Cache', 11, 34),
(16, '2021-07-15', 1000, 'Virement', 8, 44),
(17, '2021-07-13', 300, 'Cache', 11, 37),
(18, '2021-08-02', 300, 'Virement', 7, 31),
(19, '2021-08-19', 300, 'Virement', 10, 45);

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `IdF` int(10) NOT NULL,
  `IdC` int(10) NOT NULL,
  `IdO` int(11) DEFAULT NULL,
  `dateFac` date ,
  `MontantHT` double DEFAULT NULL,
  `TVA` double DEFAULT NULL,
  `Remise` float DEFAULT NULL,
  `MontantTTC` float DEFAULT NULL,
  `typePay` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`IdF`, `IdC`, `IdO`, `dateFac`, `MontantHT`, `TVA`, `Remise`, `MontantTTC`, `typePay`) VALUES
(14, 41, 7, '2021-04-09', 0, 0, 0, 0, 'Cache'),
(15, 36, 5, '2020-05-11', 0, 0, 0, 0, 'Virement'),
(16, 33, 8, '2021-08-09', 0, 0, 0, 0, 'Espèce'),
(17, 44, 14, '2021-10-06', 0, 0, 0, 0, 'Cache'),
(18, 42, 4, '2021-10-23', 0, 0, 0, 0, 'Cache'),
(19, 35, 3, '2022-03-24', 0, 0, 0, 0, 'Virement'),
(20, 31, 11, '2021-12-01', 0, 0, 0, 0, 'Cache'),
(21, 43, 1, '2022-01-12', 0, 0, 0, 0, 'Transfert'),
(22, 38, 10, '2021-10-23', 0, 0, 0, 0, 'Espèce'),
(24, 33, 5, '2021-07-19', 0, 0, 0, 0, 'Cache'),
(25, 40, 3, '2021-08-26', 0, 0, 0, 0, 'Transfert'),
(27, 45, 4, '2021-08-01', 0, 0, 0, 0, 'Transfert'),
(28, 46, 4, '2021-08-09', 0, 0, 0, 0, 'Virement'),
(29, 36, 2, '2021-08-01', 0, 0, 0, 0, 'Transfert'),
(30, 35, 5, '2021-08-28', 0, 0, 0, 0, 'Cache'),
(32, 38, 2, '2021-08-26', 0, 0, 0, 0, 'Cache'),
(33, 43, 3, '2021-08-18', 0, 0, 0, 0, 'Transfert'),
(34, 35, 7, '2021-08-16', 0, 0, 0, 0, 'Cache'),
(35, 53, 8, '2021-08-18', 0, 0, 0, 0, 'Cache'),
(36, 46, 8, '2021-08-11', 0, 0, 0, 0, 'Espèce'),
(37, 31, 10, '2021-08-20', 0, 0, 0, 0, 'Espèce'),
(38, 31, 14, '2021-08-10', 0, 0, 0, 0, 'Espèce'),
(39, 31, 1, '2021-08-18', NULL, NULL, NULL, NULL, 'Espèce'),
(40, 36, 8, '2021-08-03', 0, 0, 0, 0, 'Cache');

-- --------------------------------------------------------

--
-- Table structure for table `objet`
--

CREATE TABLE `objet` (
  `IdO` int(10) NOT NULL,
  `NomObjet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `objet`
--

INSERT INTO `objet` (`IdO`, `NomObjet`) VALUES
(1, 'App de gestion de facturation'),
(2, 'Application de gestion de stock'),
(3, 'Applications mobiles'),
(4, 'Boutique en ligne'),
(5, 'Creation d\'un site web e-commerce'),
(6, 'Creation d\'un site web touristique'),
(7, 'creation d\'une plateforme de gestion des etudiants'),
(8, 'Design des logos'),
(9, 'Hybergement du serveur locale'),
(10, 'Installation et maintenance d\'un serveur web'),
(11, 'maintenance d\'un site web des annonces immobiliers'),
(12, 'onnnn'),
(13, 'Site vitrine'),
(14, 'Site web d\'heberegement des serveurs'),
(15, 'Vente des serveurs mutualises');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `idS` int(10) NOT NULL,
  `Designation` varchar(50) NOT NULL,
  `Prix` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`idS`, `Designation`, `Prix`) VALUES
(3, 'Nom de domaine ', 2500),
(5, 'Creation de logo', 2000),
(7, 'Test et maintenance ', 4500),
(8, 'elimination des gugs', 6530),
(9, 'Maintenance et super', 2000),
(10, 'conception de strteg', 1000),
(11, 'Design de logo', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `suivre`
--

CREATE TABLE `suivre` (
  `IdSui` int(10) NOT NULL,
  `IdO` int(10) NOT NULL,
  `IdC` int(10) NOT NULL,
  `dateRdv` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suivre`
--

INSERT INTO `suivre` (`IdSui`, `IdO`, `IdC`, `dateRdv`) VALUES
(1, 5, 36, '2021-07-27 12:53:43'),
(2, 8, 34, '2021-07-27 12:53:43'),
(3, 11, 48, '2021-07-27 12:54:15'),
(4, 3, 33, '2021-07-27 12:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `login`, `role`, `etat`, `email`, `pwd`) VALUES
(1, 'Sellak', 'Mouad', 'mouad', 'Admin', 1, 'mouaadsellak123@gmail.com', '11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartenance`
--
ALTER TABLE `appartenance`
  ADD PRIMARY KEY (`IdApp`),
  ADD KEY `IdS` (`IdS`),
  ADD KEY `IdO` (`IdO`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`IdC`),
  ADD UNIQUE KEY `NumClient` (`NumClient`);

--
-- Indexes for table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`IdD`),
  ADD KEY `devis_ibfk_1` (`FK_Obj`),
  ADD KEY `devis_ibfk_2` (`FK_Cli`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`IdF`),
  ADD KEY `facture_ibfk_2` (`IdO`),
  ADD KEY `facture_ibfk_3` (`IdC`);

--
-- Indexes for table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`IdO`),
  ADD UNIQUE KEY `NomObjet` (`NomObjet`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idS`),
  ADD UNIQUE KEY `Designation` (`Designation`);

--
-- Indexes for table `suivre`
--
ALTER TABLE `suivre`
  ADD PRIMARY KEY (`IdSui`),
  ADD KEY `suivre_ibfk_1` (`IdO`),
  ADD KEY `suivre_ibfk_2` (`IdC`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appartenance`
--
ALTER TABLE `appartenance`
  MODIFY `IdApp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `IdC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `devis`
--
ALTER TABLE `devis`
  MODIFY `IdD` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `IdF` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `objet`
--
ALTER TABLE `objet`
  MODIFY `IdO` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=702;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `idS` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suivre`
--
ALTER TABLE `suivre`
  MODIFY `IdSui` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appartenance`
--
ALTER TABLE `appartenance`
  ADD CONSTRAINT `appartenance_ibfk_1` FOREIGN KEY (`IdS`) REFERENCES `service` (`idS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appartenance_ibfk_2` FOREIGN KEY (`IdS`) REFERENCES `service` (`idS`),
  ADD CONSTRAINT `appartenance_ibfk_3` FOREIGN KEY (`IdO`) REFERENCES `objet` (`IdO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `devis_ibfk_1` FOREIGN KEY (`FK_Obj`) REFERENCES `objet` (`IdO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devis_ibfk_2` FOREIGN KEY (`FK_Cli`) REFERENCES `client` (`IdC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_2` FOREIGN KEY (`IdO`) REFERENCES `objet` (`IdO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facture_ibfk_3` FOREIGN KEY (`IdC`) REFERENCES `client` (`IdC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `suivre_ibfk_1` FOREIGN KEY (`IdO`) REFERENCES `objet` (`IdO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suivre_ibfk_2` FOREIGN KEY (`IdC`) REFERENCES `client` (`IdC`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
