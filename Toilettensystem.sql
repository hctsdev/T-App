-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 05. Okt 2020 um 12:27
-- Server-Version: 5.7.31-0ubuntu0.18.04.1
-- PHP-Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `Toilettensystem`
--

DELIMITER $$
--
-- Prozeduren
--
CREATE DEFINER=`heinelt`@`localhost` PROCEDURE `ResetToiletten` ()  MODIFIES SQL DATA
UPDATE toilette SET besetzt = -1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `ID` int(11) NOT NULL,
  `Vorname` varchar(40) NOT NULL,
  `Nachname` varchar(40) NOT NULL,
  `benutzername` varchar(30) NOT NULL,
  `passwort` mediumtext NOT NULL,
  `privilegien` enum('normal','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`ID`, `Vorname`, `Nachname`, `benutzername`, `passwort`, `privilegien`) VALUES
(2, 'Admin', 'Admin', 'Ekimike', '98fa003731a2b4447e338c97598454d7a33e7548', 'admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `klassenzimmer`
--

CREATE TABLE `klassenzimmer` (
  `ID` int(11) NOT NULL,
  `Raum` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `klassenzimmer`
--

INSERT INTO `klassenzimmer` (`ID`, `Raum`) VALUES
(21, '210'),
(22, '211'),
(23, '213'),
(25, '212'),
(26, '209'),
(27, '208'),
(28, '207'),
(29, '206'),
(30, '201'),
(31, '214'),
(32, '101'),
(33, '106'),
(34, '107'),
(35, '108'),
(36, '109'),
(37, '110'),
(38, '111'),
(39, '112'),
(40, '113'),
(41, '114'),
(42, '120'),
(43, '121'),
(44, '122'),
(45, '123'),
(46, '124'),
(47, '125'),
(48, '233'),
(49, '234'),
(50, '235'),
(51, '236'),
(52, '237'),
(53, '238'),
(54, '133'),
(55, '134'),
(56, '135'),
(57, '136'),
(58, '137'),
(59, '138'),
(60, 'E18'),
(61, 'E24'),
(62, 'E28'),
(66, 'E17'),
(67, 'E36'),
(68, 'E33'),
(69, 'E42'),
(70, 'E44'),
(71, '119'),
(72, '128'),
(73, '130'),
(74, '118'),
(75, 'E35'),
(76, 'E38'),
(77, 'U06');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `klassenzimmer_toilette`
--

CREATE TABLE `klassenzimmer_toilette` (
  `KlassenzimmerID` int(11) NOT NULL,
  `ToiletteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `klassenzimmer_toilette`
--

INSERT INTO `klassenzimmer_toilette` (`KlassenzimmerID`, `ToiletteID`) VALUES
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(58, 4),
(59, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 4),
(75, 4),
(76, 4),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(58, 5),
(59, 5),
(67, 5),
(68, 5),
(69, 5),
(70, 5),
(75, 5),
(76, 5),
(42, 7),
(43, 7),
(44, 7),
(45, 7),
(46, 7),
(47, 7),
(54, 7),
(55, 7),
(56, 7),
(57, 7),
(58, 7),
(59, 7),
(67, 7),
(68, 7),
(69, 7),
(70, 7),
(71, 7),
(72, 7),
(73, 7),
(74, 7),
(75, 7),
(76, 7),
(42, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(54, 8),
(55, 8),
(56, 8),
(57, 8),
(58, 8),
(59, 8),
(67, 8),
(68, 8),
(70, 8),
(71, 8),
(72, 8),
(73, 8),
(74, 8),
(75, 8),
(76, 8),
(21, 12),
(22, 12),
(23, 12),
(25, 12),
(26, 12),
(27, 12),
(28, 12),
(29, 12),
(30, 12),
(31, 12),
(32, 12),
(33, 12),
(34, 12),
(35, 12),
(36, 12),
(37, 12),
(38, 12),
(39, 12),
(40, 12),
(41, 12),
(60, 12),
(61, 12),
(62, 12),
(66, 12),
(21, 13),
(22, 13),
(23, 13),
(25, 13),
(26, 13),
(27, 13),
(28, 13),
(29, 13),
(30, 13),
(31, 13),
(21, 14),
(22, 14),
(23, 14),
(25, 14),
(26, 14),
(27, 14),
(28, 14),
(29, 14),
(30, 14),
(31, 14),
(21, 15),
(22, 15),
(23, 15),
(25, 15),
(26, 15),
(27, 15),
(28, 15),
(29, 15),
(30, 15),
(31, 15),
(32, 15),
(33, 15),
(34, 15),
(35, 15),
(36, 15),
(37, 15),
(38, 15),
(39, 15),
(40, 15),
(41, 15),
(60, 15),
(61, 15),
(62, 15),
(66, 15),
(42, 16),
(43, 16),
(44, 16),
(45, 16),
(46, 16),
(47, 16),
(48, 16),
(49, 16),
(50, 16),
(51, 16),
(52, 16),
(53, 16),
(54, 16),
(55, 16),
(56, 16),
(57, 16),
(58, 16),
(59, 16),
(69, 16),
(70, 16),
(72, 16),
(76, 16),
(42, 17),
(43, 17),
(44, 17),
(45, 17),
(46, 17),
(47, 17),
(48, 17),
(49, 17),
(50, 17),
(51, 17),
(52, 17),
(53, 17),
(54, 17),
(55, 17),
(56, 17),
(57, 17),
(58, 17),
(59, 17),
(69, 17),
(70, 17),
(72, 17),
(76, 17),
(32, 18),
(33, 18),
(34, 18),
(35, 18),
(36, 18),
(37, 18),
(38, 18),
(39, 18),
(40, 18),
(41, 18),
(60, 18),
(61, 18),
(62, 18),
(66, 18),
(67, 18),
(68, 18),
(71, 18),
(73, 18),
(74, 18),
(75, 18),
(32, 19),
(33, 19),
(34, 19),
(35, 19),
(36, 19),
(37, 19),
(38, 19),
(39, 19),
(40, 19),
(41, 19),
(60, 19),
(61, 19),
(62, 19),
(66, 19),
(67, 19),
(68, 19),
(71, 19),
(73, 19),
(74, 19),
(75, 19);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `navigation`
--

CREATE TABLE `navigation` (
  `sortierung` tinyint(4) NOT NULL DEFAULT '0',
  `text` varchar(30) NOT NULL DEFAULT '',
  `aktion` varchar(80) DEFAULT NULL,
  `kommentar` varchar(80) DEFAULT NULL,
  `ebene` tinyint(4) NOT NULL DEFAULT '0',
  `rechte` set('normal','admin') NOT NULL DEFAULT 'normal'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Navigationsspalte';

--
-- Daten für Tabelle `navigation`
--

INSERT INTO `navigation` (`sortierung`, `text`, `aktion`, `kommentar`, `ebene`, `rechte`) VALUES
(3, 'Klassenzimmer', 'index.php?aktion=adminKlassenzimmer&', NULL, 2, 'admin'),
(4, 'Räume', 'index.php?aktion=RaeumeEinsehen&', NULL, 1, 'normal,admin'),
(2, 'Toiletten', 'index.php?aktion=adminToiletten&', NULL, 2, 'admin'),
(1, 'Verwaltung', '', NULL, 1, 'admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `toilette`
--

CREATE TABLE `toilette` (
  `ID` int(11) NOT NULL,
  `Raum` varchar(35) NOT NULL,
  `Geschlecht` enum('Mädchen','Jungen') NOT NULL,
  `besetzt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `toilette`
--

INSERT INTO `toilette` (`ID`, `Raum`, `Geschlecht`, `besetzt`) VALUES
(4, 'E52 Mensa', 'Mädchen', 53),
(5, 'E54 Mensa', 'Jungen', 76),
(7, 'E39', 'Mädchen', 76),
(8, '127', 'Jungen', -1),
(12, '103', 'Mädchen', -1),
(13, '203', 'Mädchen', -1),
(14, '205', 'Jungen', 25),
(15, '105', 'Jungen', -1),
(16, '140 Lift', 'Jungen', 53),
(17, '240 Lift', 'Mädchen', -1),
(18, 'E20 Pausenhalle', 'Mädchen', 41),
(19, 'E23 Pausenhalle', 'Jungen', -1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `benutzername` (`benutzername`);

--
-- Indizes für die Tabelle `klassenzimmer`
--
ALTER TABLE `klassenzimmer`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `klassenzimmer_toilette`
--
ALTER TABLE `klassenzimmer_toilette`
  ADD PRIMARY KEY (`KlassenzimmerID`,`ToiletteID`),
  ADD KEY `ToiletteKlassenzimmer` (`ToiletteID`);

--
-- Indizes für die Tabelle `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`sortierung`);

--
-- Indizes für die Tabelle `toilette`
--
ALTER TABLE `toilette`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `klassenzimmer`
--
ALTER TABLE `klassenzimmer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT für Tabelle `toilette`
--
ALTER TABLE `toilette`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `klassenzimmer_toilette`
--
ALTER TABLE `klassenzimmer_toilette`
  ADD CONSTRAINT `ToiletteKlassenzimmer` FOREIGN KEY (`ToiletteID`) REFERENCES `toilette` (`ID`) ON UPDATE CASCADE;

DELIMITER $$
--
-- Ereignisse
--
CREATE DEFINER=`heinelt`@`localhost` EVENT `cleanup_event` ON SCHEDULE EVERY 1 DAY STARTS '2020-05-24 04:00:00' ON COMPLETION NOT PRESERVE ENABLE DO call ResetToiletten()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
