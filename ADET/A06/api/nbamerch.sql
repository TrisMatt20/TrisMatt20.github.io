-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 10:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nbamerch`
--

-- --------------------------------------------------------

--
-- Table structure for table `merchandises`
--

CREATE TABLE `merchandises` (
  `merchID` int(11) NOT NULL,
  `playerID` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `merchIcon` varchar(50) NOT NULL,
  `playerCode` varchar(50) NOT NULL,
  `merchCode` varchar(50) NOT NULL,
  `price` float(30,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchandises`
--

INSERT INTO `merchandises` (`merchID`, `playerID`, `type`, `merchIcon`, `playerCode`, `merchCode`, `price`) VALUES
(1, 1, 'jersey', 'luka-jersey.webp', 'LUKA', 'LUKA-JRSY', 6720.90),
(2, 1, 'shorts', 'luka-sh.webp', 'LUKA', 'LUKA-SHORTS', 3250.00),
(3, 1, 'jacket', 'lakers-jacket.webp', 'LUKA', 'LA-JKT', 4950.00),
(4, 1, 'shoes', 'luka-shoes.webp', 'LUKA', 'LUKA-SHOE', 4437.00),
(5, 2, 'jersey', 'curry-jersey.webp', 'STEPH', 'STEPH-JRSY', 6720.00),
(6, 2, 'shorts', 'curry-sh.webp', 'STEPH', 'STEPH-SHORTS', 3250.25),
(7, 2, 'jacket', 'gsw-jacket.jpg', 'STEPH', 'GSW-JKT', 4950.00),
(8, 2, 'shoes', 'curry-shoes.webp', 'STEPH', 'STEPH-SHOE', 8960.00),
(9, 3, 'jersey', 'lebron.webp', 'LEBRON', 'LEBRON-JRSY', 8499.25),
(10, 3, 'shorts', 'lebron-sh.webp', 'LEBRON', 'LEBRON-SHORTS', 3250.00),
(11, 3, 'jacket', 'lakers-jacket.webp', 'LEBRON', 'LA-JKT', 4950.00),
(12, 3, 'shoes', 'lebron-shoes.webp', 'LEBRON', 'LEBRON-SHOE', 11495.50),
(13, 4, 'jersey', 'tatum-jersey.webp', 'TATUM', 'TATUM-JRSY', 6720.00),
(14, 4, 'shorts', 'tatum-sh.webp', 'TATUM', 'TATUM-SHORTS', 3360.50),
(15, 4, 'jacket', 'boston-jacket.webp', 'TATUM', 'CELTIC-JKT', 7240.00),
(16, 4, 'shoes', 'tatum-shoes.webp', 'TATUM', 'TATUM-SHOE', 7280.95),
(17, 5, 'jersey', 'wemb-jersey.webp', 'WEMB', 'WEMB-JRSY', 7000.00),
(18, 5, 'shorts', 'wemb-sh.webp', 'WEMB', 'WEMB-SHORTS', 3360.00),
(19, 5, 'jacket', 'spurs.jpg', 'WEMB', 'SPURS-JKT', 7240.00),
(20, 6, 'jersey', 'jokic-jersey.webp', 'JOKIC', 'JOKIC-JRSY', 6720.75),
(21, 6, 'shorts', 'jokic-sh.avif', 'JOKIC', 'JOKIC-SHORTS', 3360.00),
(22, 6, 'jacket', 'nuggets.webp', 'JOKIC', 'DEN-JKT', 7240.00),
(23, 7, 'jersey', 'giannis-jersey.webp', 'GIANN', 'GIANN-JRSY', 6500.00),
(24, 7, 'shorts', 'giannis-sh.webp', 'GIANN', 'GIANN-SHORTS', 3360.50),
(25, 7, 'jacket', 'bucks.jpg', 'GIANN', 'BUCKS-JKT', 7240.00),
(26, 7, 'shoes', 'giannis-shoes.webp', 'GIANN', 'GIANN-SHOE', 7395.00),
(27, 8, 'jersey', 'kd-jersey.webp', 'KD', 'KD-JRSY', 7499.75),
(28, 8, 'shorts', 'kd-sh.webp', 'KD', 'KD-SHORTS', 3360.00),
(29, 8, 'jacket', 'phoenix-jacket.webp', 'KD', 'SUNS-JKT', 7240.50),
(30, 8, 'shoes', 'nike-kd-17.webp', 'KD', 'KD-SHOE', 8960.00);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerID` int(11) NOT NULL,
  `playerName` varchar(50) NOT NULL,
  `playerCode` varchar(50) NOT NULL,
  `playerIcon` varchar(50) DEFAULT NULL,
  `playerTeam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `playerName`, `playerCode`, `playerIcon`, `playerTeam`) VALUES
(1, 'Luka Doncic', 'LUKA', '', 'Lakers'),
(2, 'Stephen Curry', 'STEPH', '', 'GSW'),
(3, 'LeBron James', 'LEBRON', '', 'Lakers'),
(4, 'Jayson Tatum', 'TATUM', '', 'Celtics'),
(5, 'Victor Wembanyama', 'WEMB', '', 'Spurs'),
(6, 'Nikola Jokic', 'JOKIC', '', 'Nuggets'),
(7, 'Giannis Antetokounmpo', 'GIANN', '', 'Bucks'),
(8, 'Kevin Durant', 'KD', '', 'Suns');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeID` int(11) NOT NULL,
  `merchID` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`sizeID`, `merchID`, `size`) VALUES
(1, 1, 'Small'),
(2, 1, 'Medium'),
(3, 1, 'Large'),
(4, 1, 'XL'),
(5, 2, 'Small'),
(6, 2, 'Medium'),
(7, 2, 'Large'),
(8, 2, 'XL'),
(9, 3, 'Medium'),
(10, 3, 'Large'),
(11, 3, 'XL'),
(12, 4, '8'),
(13, 4, '9'),
(14, 4, '10'),
(15, 4, '11'),
(16, 4, '12'),
(17, 4, '13'),
(18, 5, 'Medium'),
(19, 5, 'Large'),
(20, 5, 'XL'),
(21, 6, 'Small'),
(22, 6, 'Medium'),
(23, 6, 'Large'),
(24, 6, 'XL'),
(25, 7, 'Medium'),
(26, 7, 'Large'),
(27, 7, 'XL'),
(28, 8, '8'),
(29, 8, '9'),
(30, 8, '10'),
(31, 8, '11'),
(32, 8, '12'),
(33, 8, '13'),
(34, 9, 'Small'),
(35, 9, 'Medium'),
(36, 9, 'Large'),
(37, 9, 'XL'),
(38, 10, 'Small'),
(39, 10, 'Medium'),
(40, 10, 'Large'),
(41, 10, 'XL'),
(42, 11, 'Medium'),
(43, 11, 'Large'),
(44, 11, 'XL'),
(45, 12, '9'),
(46, 12, '10'),
(47, 12, '11'),
(48, 12, '12'),
(49, 12, '13'),
(50, 13, 'Small'),
(51, 13, 'Medium'),
(52, 13, 'Large'),
(53, 13, 'XL'),
(54, 14, 'Small'),
(55, 14, 'Medium'),
(56, 14, 'Large'),
(57, 14, 'XL'),
(58, 15, 'Medium'),
(59, 15, 'Large'),
(60, 15, 'XL'),
(61, 16, '8'),
(62, 16, '9'),
(63, 16, '10'),
(64, 16, '11'),
(65, 16, '12'),
(66, 17, 'Small'),
(67, 17, 'Medium'),
(68, 17, 'Large'),
(69, 17, 'XL'),
(70, 18, 'Small'),
(71, 18, 'Medium'),
(72, 18, 'Large'),
(73, 18, 'XL'),
(74, 19, 'Medium'),
(75, 19, 'Large'),
(76, 19, 'XL'),
(77, 20, 'Small'),
(78, 20, 'Medium'),
(79, 20, 'Large'),
(80, 20, 'XL'),
(81, 21, 'Small'),
(82, 21, 'Medium'),
(83, 21, 'Large'),
(84, 21, 'XL'),
(85, 22, 'Medium'),
(86, 22, 'Large'),
(87, 22, 'XL'),
(88, 23, 'Small'),
(89, 23, 'Medium'),
(90, 23, 'XL'),
(91, 24, 'Small'),
(92, 24, 'Medium'),
(93, 24, 'Large'),
(94, 24, 'XL'),
(95, 25, 'Medium'),
(96, 25, 'Large'),
(97, 25, 'XL'),
(98, 26, '8'),
(99, 26, '9'),
(100, 26, '10'),
(101, 26, '12'),
(102, 26, '13'),
(103, 27, 'Small'),
(104, 27, 'Medium'),
(105, 27, 'Large'),
(106, 27, 'XL'),
(107, 28, 'Small'),
(108, 28, 'Medium'),
(109, 29, 'Medium'),
(110, 29, 'Large'),
(111, 29, 'XL'),
(112, 30, '12'),
(113, 30, '13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `merchandises`
--
ALTER TABLE `merchandises`
  ADD PRIMARY KEY (`merchID`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerID`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`sizeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `merchandises`
--
ALTER TABLE `merchandises`
  MODIFY `merchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `sizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
