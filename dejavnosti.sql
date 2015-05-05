-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 05. maj 2015 ob 10.12
-- Različica strežnika: 5.6.21
-- Različica PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Zbirka podatkov: `dejavnosti`
--

-- --------------------------------------------------------

--
-- Struktura tabele `dejavnost`
--

CREATE TABLE IF NOT EXISTS `dejavnost` (
`dejavnostID` int(11) NOT NULL,
  `naslovD` varchar(20) NOT NULL,
  `MentorjiD` varchar(200) NOT NULL,
  `steviloSrecanjD` varchar(20) NOT NULL,
  `govUreD` varchar(20) DEFAULT NULL,
  `mailD` varchar(20) DEFAULT NULL,
  `telefonD` varchar(15) DEFAULT NULL,
  `DrugoD` varchar(50) NOT NULL,
  `OrgOblikaD` varchar(200) NOT NULL,
  `PrimernostD` varchar(200) NOT NULL,
  `NadarjenostD` varchar(300) NOT NULL,
  `OpombeD` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `dejavnost`
--

INSERT INTO `dejavnost` (`dejavnostID`, `naslovD`, `MentorjiD`, `steviloSrecanjD`, `govUreD`, `mailD`, `telefonD`, `DrugoD`, `OrgOblikaD`, `PrimernostD`, `NadarjenostD`, `OpombeD`) VALUES
(2, 'Koesarjenje', '', 'poDogovoru', 'asda', 'sdas@gmail.com', '0311231231', '', 'projektnoDelo-, eUcenje', 'Za Dijake raÄunalniÅ¡kih programov in dijake vseh letnikov', 'voditeljsko, literarno, filmsko', 'asdsadasd');

-- --------------------------------------------------------

--
-- Struktura tabele `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `userIme` varchar(20) NOT NULL,
  `userPriimek` varchar(20) NOT NULL,
  `userGeslo` varchar(50) NOT NULL,
  `userStatus` int(11) NOT NULL,
  `userMail` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `user`
--

INSERT INTO `user` (`userID`, `username`, `userIme`, `userPriimek`, `userGeslo`, `userStatus`, `userMail`) VALUES
(1, 'volko', 'Jan', 'Novak', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 2, 'volko@test.com'),
(2, 'admin', 'Adko', 'Adolko', 'f865b53623b121fd34ee5426c792e5c33af8c227', 3, 'admin@admin.net'),
(3, 'vrto92', 'Matic', 'Vrtacnik', '195c264b25c99e83c8375a6e90b4e685b372d87d', 1, 'test@test.com');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `dejavnost`
--
ALTER TABLE `dejavnost`
 ADD PRIMARY KEY (`dejavnostID`);

--
-- Indeksi tabele `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `dejavnost`
--
ALTER TABLE `dejavnost`
MODIFY `dejavnostID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT tabele `user`
--
ALTER TABLE `user`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
