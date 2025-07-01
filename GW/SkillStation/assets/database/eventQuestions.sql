-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 09:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillstation`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventquestions`
--

CREATE TABLE `eventquestions` (
  `eventQuestionId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `isRequired` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventquestions`
--

INSERT INTO `eventquestions` (`eventQuestionId`, `eventId`, `question`, `isRequired`) VALUES
(1, 1, 'Have you tried watercolor painting before?', 'yes'),
(2, 1, 'Do you already have watercolor materials?', 'yes'),
(3, 1, 'What subjects do you enjoy painting the most?', 'yes'),
(4, 1, 'What do you hope to learn from this workshop?', 'yes'),
(5, 2, 'Do you have any prior coding experience?', 'yes'),
(6, 2, 'Do you own a computer or laptop you can use for practice?', 'yes'),
(7, 2, 'What website would you like to create first?', 'yes'),
(8, 3, 'Do you already have a business idea in mind?', 'yes'),
(9, 3, 'Are you familiar with online selling platforms?', 'yes'),
(10, 3, 'What do you hope to achieve by joining this workshop?', 'yes'),
(11, 3, 'Have you ever attended a business seminar before?', 'yes'),
(12, 4, 'Have you used an espresso machine before?', 'yes'),
(13, 4, 'Do you currently drink coffee regularly?', 'yes'),
(14, 4, 'Are you interested in working in a café or opening one?', 'yes'),
(15, 5, 'Do you own any indoor plants currently?', 'yes'),
(16, 5, 'Have you experienced caring for a plant before?', 'yes'),
(17, 5, 'Which plant do you find most appealing?', 'yes'),
(18, 5, 'Are you joining to improve plant styling at home?', 'yes'),
(19, 6, 'Have you participated in a school debate or speaking contest?', 'yes'),
(20, 6, 'Do you want to improve your confidence in speaking?', 'yes'),
(21, 6, 'What do you think is your weakness in public speaking?', 'yes'),
(22, 7, 'Have you done any form of pottery or clay art before?', 'yes'),
(23, 7, 'Are you more interested in functional or decorative pieces?', 'yes'),
(24, 7, 'What are you excited to create during the workshop?', 'yes'),
(25, 7, 'Do you have access to a pottery studio or tools at home?', 'yes'),
(26, 8, 'Have you used Canva before for designing?', 'yes'),
(27, 8, 'Do you create posters or social media graphics?', 'yes'),
(28, 8, 'Are you familiar with basic design principles like layout and color?', 'yes'),
(29, 9, 'Do you understand how websites work behind the scenes?', 'yes'),
(30, 9, 'Are you willing to practice coding outside the workshop?', 'yes'),
(31, 9, 'Have you ever tried creating a website using a code editor?', 'yes'),
(32, 9, 'What kind of website would you like to build?', 'yes'),
(33, 10, 'Have you ever tried editing images using any software?', 'yes'),
(34, 10, 'Do you plan to use Photoshop for school or work projects?', 'yes'),
(35, 10, 'Are you familiar with layers and tools in Photoshop?', 'yes'),
(36, 11, 'Have you ever attended a medical emergency training?', 'yes'),
(37, 11, 'Are you physically able to perform CPR if needed?', 'yes'),
(38, 11, 'Why do you want to learn first aid?', 'yes'),
(39, 11, 'Do you want to be certified in Basic Life Support?', 'yes'),
(40, 12, 'Have you taken on leadership roles in school or community?', 'yes'),
(41, 12, 'What leadership qualities do you value most?', 'yes'),
(42, 12, 'Do you find it challenging to make decisions as a leader?', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventquestions`
--
ALTER TABLE `eventquestions`
  ADD PRIMARY KEY (`eventQuestionId`),
  ADD KEY `eventId` (`eventId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventquestions`
--
ALTER TABLE `eventquestions`
  MODIFY `eventQuestionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventquestions`
--
ALTER TABLE `eventquestions`
  ADD CONSTRAINT `eventquestions_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `events` (`eventId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
