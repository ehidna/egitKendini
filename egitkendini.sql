-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Nis 2015, 12:20:37
-- Sunucu sürümü: 5.6.17
-- PHP Sürümü: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `egitkendini`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branslar`
--

CREATE TABLE IF NOT EXISTS `branslar` (
  `bransID` int(11) NOT NULL AUTO_INCREMENT,
  `brans` varchar(10) NOT NULL,
  PRIMARY KEY (`bransID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cezalılar`
--

CREATE TABLE IF NOT EXISTS `cezalılar` (
  `uyeID` int(11) NOT NULL,
  `nedenID` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cezanedenleri`
--

CREATE TABLE IF NOT EXISTS `cezanedenleri` (
  `nedenID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ceza` varchar(10) NOT NULL,
  `drum` tinyint(4) NOT NULL,
  `cezaSuresi` tinyint(4) NOT NULL,
  PRIMARY KEY (`nedenID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

CREATE TABLE IF NOT EXISTS `dersler` (
  `dersID` int(11) NOT NULL AUTO_INCREMENT,
  `ders` varchar(20) NOT NULL,
  PRIMARY KEY (`dersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dokumanlar`
--

CREATE TABLE IF NOT EXISTS `dokumanlar` (
  `dokumanID` int(11) NOT NULL AUTO_INCREMENT,
  `konuID` int(11) NOT NULL,
  `baslik` varchar(20) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  PRIMARY KEY (`dokumanID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gorevler`
--

CREATE TABLE IF NOT EXISTS `gorevler` (
  `gorevID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `gorev` varchar(10) NOT NULL,
  PRIMARY KEY (`gorevID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konular`
--

CREATE TABLE IF NOT EXISTS `konular` (
  `konuID` int(11) NOT NULL AUTO_INCREMENT,
  `konu` varchar(30) NOT NULL,
  `dersID` int(11) NOT NULL,
  `sınıf` tinyint(4) NOT NULL,
  PRIMARY KEY (`konuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `meslkeler`
--

CREATE TABLE IF NOT EXISTS `meslkeler` (
  `meslekID` int(11) NOT NULL AUTO_INCREMENT,
  `meslek` varchar(15) NOT NULL,
  PRIMARY KEY (`meslekID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `modlar`
--

CREATE TABLE IF NOT EXISTS `modlar` (
  `uyeID` int(11) NOT NULL,
  `gorevID` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmenler`
--

CREATE TABLE IF NOT EXISTS `ogretmenler` (
  `uyeID` int(11) NOT NULL,
  `bransID` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `testID` int(11) NOT NULL AUTO_INCREMENT,
  `sınıf` int(11) NOT NULL,
  `uyeID` int(11) NOT NULL,
  `hit` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `testBaslik` varchar(10) NOT NULL,
  `dislike` int(11) NOT NULL,
  PRIMARY KEY (`testID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testicerik`
--

CREATE TABLE IF NOT EXISTS `testicerik` (
  `testID` int(11) NOT NULL,
  `dersID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testistatistik`
--

CREATE TABLE IF NOT EXISTS `testistatistik` (
  `uyeID` int(11) NOT NULL,
  `testID` int(11) NOT NULL,
  `puan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `udi`
--

CREATE TABLE IF NOT EXISTS `udi` (
  `uyeID` int(11) NOT NULL,
  `dokumanID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE IF NOT EXISTS `uyeler` (
  `uyeID` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(15) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` varchar(12) NOT NULL,
  `meslekID` tinyint(4) NOT NULL,
  `dTarihi` date NOT NULL,
  `telNo` varchar(10) NOT NULL,
  `adres` tinytext NOT NULL,
  PRIMARY KEY (`uyeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
