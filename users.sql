-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 02:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('faiqa', '$2y$10$V8/HpGEp09DeLL2GeCmoTOT6dVPGp3jqQCbwa.faKxjqtslYoNNrq'),
('husain', '$2y$10$DowAjDDJ28Tojth9KFf.Vu1OrPXOhZbLlgCZSXRBrsTsONjBp5qBW'),
('eduardo', '$2y$10$CShvKy.I5lZruQ1UCeBXwuKgbze/7S488ElqGMpcyFBK6IN3zsF1G'),
('sujesh', '$2y$10$F1teiyFEnEF66ZdpUHW6Au/ThXT2Kuvzvrel7qqXm0i4UQG9avRAi'),
('angelina', '$2y$10$PgQzCdhtl9TwP4s1Yzc5g.9sPAesfMtrpqzIm9V49WK.xowNhYxly'),
('fathima', '$2y$10$VZNVou6l2Uv9y9YirvZZvOHVcp7HnQjPnDrgoTyMtSXD08.UKzZfi'),
('tarin', '$2y$10$lza0MCNcqbCZq8jlRYaivObkzysN/bzgnz52VOkSt5Mhjvu8IQ/1u'),
('joginder', '$2y$10$oARAXz7MVBtm4NtTxZDbiOhTr535LnFY56uQ4g6hpOfw0JPPQW6SO'),
('mahmood', '$2y$10$X6c9D7.dvMdP3QZQqLWmWOVBqC5xI5Z3RyG9A66ad7vGOZc3uGmPe'),
('silvia', '$2y$10$vuiZ/nNRbppzDj8Fq30XdO3gCO6ad6V3X83N8ntAFYV9KBEdX1t3i'),
('hassan', '$2y$10$yUwlEVurvTwrTZidrf28rOh9hojd4oq6B3CBNU.XN966pLaS9cR2W'),
('niyaz', '$2y$10$78Lmw/HcrnXEv/qG8PG6C.k4g/ppnTr/NrGJVJB9091clvCOcHYCS'),
('khalid', '$2y$10$jQY7kTCJTdWoIqHgdSCaxO..yON0QNwq3HWPu2plISo7SWl2ifIe2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
