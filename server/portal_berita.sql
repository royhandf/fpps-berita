-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2022 at 01:54 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_berita`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `email`, `pass`, `phone`) VALUES
(1, 'royhan', 'royhandf@gmail.com', '202cb962ac59075b964b07152d234b70', '0895396002259'),
(2, 'budi', 'budi@gmail.com', '202cb962ac59075b964b07152d234b70', '081239681997');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `photo` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `author_id`, `category`, `title`, `content`, `photo`, `created_at`) VALUES
(1, 1, 'Game', 'Oddballers, Game Dodgeball Gila Akan Rilis Awal Tahun Depan!', 'Setelah Rollers Champion, Ubisoft kembali luncurkan game multiplayer/co-op inovatif lainnya berjudul Oddballers!\\n\\nGameplay selengkapnya bisa kalian lihat di video di bawah ini:\\n\\nhttps://youtu.be/KgMTgMG-K_E\\n\\nOddBallers adalah sebuah game party di mana para pemainnya bisa menantang...', '', '2022-12-13 00:22:37'),
(2, 2, 'Teknologi', 'GIGABYTE Luncurkan Kartu Grafis AORUS Terbaru Berbasis NVIDIA GeForce RTX 40 Series!', 'Selasa, 20 September 2022 - GIGABYTE, umumkan kartu grafis terbaru berbasis Nvidia GeForce RTX 40 series! Lini kartu grafis yang sudah ditunggu-tunggu kedatangannya ini akhirnya tiba untuk memenuhi performa teknologi generasi...', '', '2022-12-13 00:22:37'),
(5, 2, 'Olahraga', 'shishishi', 'hahahaha', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
