-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. Mrz 2015 um 17:44
-- Server-Version: 10.0.17-MariaDB-log
-- PHP-Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `ci_blog`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
  `id` int(10) unsigned NOT NULL,
  `post` int(10) unsigned NOT NULL COMMENT 'id of post record',
  `tag` int(10) unsigned NOT NULL COMMENT 'id of tag record',
  KEY id(id),
  FOREIGN KEY fk_post(post) REFERENCES post(id),
  FOREIGN KEY fk_tag(tag) REFERENCES tag(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
