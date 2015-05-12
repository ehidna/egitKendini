-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 30, 2015 at 12:40 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `egitkendini`
--
CREATE DATABASE IF NOT EXISTS `egitkendini` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `egitkendini`;

-- --------------------------------------------------------

--
-- Table structure for table `branslar`
--

DROP TABLE IF EXISTS `branslar`;
CREATE TABLE `branslar` (
  `bransID` int(11) NOT NULL,
  `brans` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cezalilar`
--

DROP TABLE IF EXISTS `cezalilar`;
CREATE TABLE `cezalilar` (
  `uyeID` int(11) NOT NULL,
  `nedenID` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cezanedenleri`
--

DROP TABLE IF EXISTS `cezanedenleri`;
CREATE TABLE `cezanedenleri` (
  `nedenID` tinyint(4) NOT NULL,
  `ceza` varchar(10) NOT NULL,
  `durum` tinyint(4) NOT NULL,
  `cezaSuresi` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dersler`
--

DROP TABLE IF EXISTS `dersler`;
CREATE TABLE `dersler` (
  `dersID` int(11) NOT NULL,
  `ders` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dokumanlar`
--

DROP TABLE IF EXISTS `dokumanlar`;
CREATE TABLE `dokumanlar` (
  `dokumanID` int(11) NOT NULL,
  `konuID` int(11) NOT NULL,
  `baslik` varchar(20) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gorevler`
--

DROP TABLE IF EXISTS `gorevler`;
CREATE TABLE `gorevler` (
  `gorevID` tinyint(4) NOT NULL,
  `gorev` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `konular`
--

DROP TABLE IF EXISTS `konular`;
CREATE TABLE `konular` (
  `konuID` int(11) NOT NULL,
  `konu` varchar(30) NOT NULL,
  `dersID` int(11) NOT NULL,
  `sınıf` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meslekler`
--

DROP TABLE IF EXISTS `meslekler`;
CREATE TABLE `meslekler` (
  `meslekID` int(11) NOT NULL,
  `meslek` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modlar`
--

DROP TABLE IF EXISTS `modlar`;
CREATE TABLE `modlar` (
  `uyeID` int(11) NOT NULL,
  `gorevID` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ogretmenler`
--

DROP TABLE IF EXISTS `ogretmenler`;
CREATE TABLE `ogretmenler` (
  `uyeID` int(11) NOT NULL,
  `bransID` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `testID` int(11) NOT NULL,
  `sinif` int(11) NOT NULL,
  `uyeID` int(11) NOT NULL,
  `hit` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `testBaslik` varchar(10) NOT NULL,
  `dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testicerik`
--

DROP TABLE IF EXISTS `testicerik`;
CREATE TABLE `testicerik` (
  `testID` int(11) NOT NULL,
  `dersID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testistatistik`
--

DROP TABLE IF EXISTS `testistatistik`;
CREATE TABLE `testistatistik` (
  `uyeID` int(11) NOT NULL,
  `testID` int(11) NOT NULL,
  `puan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `udi`
--

DROP TABLE IF EXISTS `udi`;
CREATE TABLE `udi` (
  `uyeID` int(11) NOT NULL,
  `dokumanID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uyeler`
--

DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE `uyeler` (
  `uyeID` int(11) NOT NULL,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(15) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` varchar(32) NOT NULL,
  `meslekID` tinyint(4) NOT NULL,
  `dTarihi` date NOT NULL,
  `telNo` varchar(10) NOT NULL,
  `adres` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7123814 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uyeler`
--

INSERT INTO `uyeler` (`uyeID`, `ad`, `soyad`, `mail`, `sifre`, `meslekID`, `dTarihi`, `telNo`, `adres`) VALUES
(7123812, 'halo', 'len', 'halolenle@gmail.com', '202cb962ac59075b964b07152d234b70', 123, '2015-04-24', '5437598519', 'asdlaksdmasnasjfaksdk'),
(7123813, 'asd', 'dsa', 'asd@asd.com', '202cb962ac59075b964b07152d234b70', 124, '2015-04-29', '1231234533', 'asdasdasfasfasfasdas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branslar`
--
ALTER TABLE `branslar`
  ADD PRIMARY KEY (`bransID`);

--
-- Indexes for table `cezanedenleri`
--
ALTER TABLE `cezanedenleri`
  ADD PRIMARY KEY (`nedenID`);

--
-- Indexes for table `dersler`
--
ALTER TABLE `dersler`
  ADD PRIMARY KEY (`dersID`);

--
-- Indexes for table `dokumanlar`
--
ALTER TABLE `dokumanlar`
  ADD PRIMARY KEY (`dokumanID`);

--
-- Indexes for table `gorevler`
--
ALTER TABLE `gorevler`
  ADD PRIMARY KEY (`gorevID`);

--
-- Indexes for table `konular`
--
ALTER TABLE `konular`
  ADD PRIMARY KEY (`konuID`);

--
-- Indexes for table `meslekler`
--
ALTER TABLE `meslekler`
  ADD PRIMARY KEY (`meslekID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`testID`);

--
-- Indexes for table `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uyeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branslar`
--
ALTER TABLE `branslar`
  MODIFY `bransID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cezanedenleri`
--
ALTER TABLE `cezanedenleri`
  MODIFY `nedenID` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dersler`
--
ALTER TABLE `dersler`
  MODIFY `dersID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dokumanlar`
--
ALTER TABLE `dokumanlar`
  MODIFY `dokumanID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gorevler`
--
ALTER TABLE `gorevler`
  MODIFY `gorevID` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `konular`
--
ALTER TABLE `konular`
  MODIFY `konuID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meslekler`
--
ALTER TABLE `meslekler`
  MODIFY `meslekID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `testID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uyeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7123814;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
