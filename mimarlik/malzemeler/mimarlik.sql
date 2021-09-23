-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Eyl 2021, 15:07:24
-- Sunucu sürümü: 10.4.20-MariaDB
-- PHP Sürümü: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ismek`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ekip`
--

CREATE TABLE `ekip` (
  `id` int(11) NOT NULL,
  `adsoyad` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `iletisim` varchar(150) COLLATE utf8mb4_turkish_ci NOT NULL,
  `gorev` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `resim` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `durum` varchar(5) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `adsoyad` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_turkish_ci NOT NULL,
  `konu` varchar(150) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `ipadres` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurumsal`
--

CREATE TABLE `kurumsal` (
  `icerik` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projeler`
--

CREATE TABLE `projeler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `resim` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `durum` varchar(5) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ekip`
--
ALTER TABLE `ekip`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `projeler`
--
ALTER TABLE `projeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ekip`
--
ALTER TABLE `ekip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `projeler`
--
ALTER TABLE `projeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
