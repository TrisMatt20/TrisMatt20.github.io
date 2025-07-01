-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 04:21 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(11) NOT NULL,
  `organizerId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `address` varchar(255) NOT NULL,
  `venue` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `organizerId`, `name`, `category`, `description`, `image`, `date`, `time`, `latitude`, `longitude`, `address`, `venue`) VALUES
(1, 2, 'Watercolor Basics: Florals & Landscapes', 'Creative & Arts', 'Discover the joy of watercolor painting in this beginner-friendly workshop focused on florals and landscapes. Learn essential techniques, brush handling, and color blending as you create your own art pieces.', 'event1.png', '2025-07-20', '10:00:00', 14.65340000, 121.06840000, 'Quezon City', 'UP Diliman'),
(2, 1, 'Build Your First Website (HTML & CSS)', 'Tech & Digital Skills', 'Learn the basics of web development and create your first webpage using HTML and CSS. Perfect for beginners with zero coding experience.', 'event2.png', '2025-07-28', '09:00:00', 14.60910000, 121.02150000, 'Manila', 'Technological Institute of the Philippines'),
(3, 1, 'Start Your Online Business (Simula sa Sa Sarili)', 'Business & Career Development', 'A step-by-step workshop to help you launch your online business using practical tools and local resources.', 'event3.png', '2025-08-10', '10:00:00', 15.03420000, 120.68470000, 'San Fernando, Pampanga', 'Negosyo Center'),
(4, 1, 'Barista Skills & Latte Art 101', 'Lifestyle & Hobbies', 'Master barista techniques and learn the fundamentals of brewing and latte art in this hands-on workshop.', 'event4.png', '2025-08-11', '10:00:00', 14.45000000, 120.98000000, 'Las Piñas City', 'Coffee Project'),
(5, 2, 'Indoor Plants 101: Care & Styling', 'Lifestyle & Hobbies', 'Explore the basics of indoor plant care, placement, and styling to elevate your space with greenery.', 'event5.png', '2025-08-16', '09:00:00', 14.60190000, 121.03320000, 'San Juan City', 'Green Haus Café'),
(6, 1, 'Debate & Public Speaking for Teens', 'Academic & Skills Boosters', 'A confidence-building workshop designed to teach teens effective communication, argument structure, and public speaking skills.', 'event6.png', '2025-08-18', '10:00:00', 14.58960000, 121.03590000, 'Mandaluyong City', 'La Salle Green Hills'),
(7, 1, 'Pottery Basics: Pottery and Clay Handbuilding ', 'Creative & Arts', 'Learn to shape, mold, and create pottery using clay handbuilding techniques. A calming, hands-on class perfect for beginners exploring creativity and craftsmanship through functional and decorative pieces.', 'pottery.png', '2024-07-20', '10:00:00', 14.65390000, 121.06850000, 'Quezon City', 'University of the Philippines'),
(8, 1, 'Introduction to Canva for Design', 'Design', 'Create stunning visuals using Canvas easy tools. Learn basic design principles like layout and color to make posters, social media graphics, and more ideal for beginners with no design experience.', 'canva.png', '2022-07-28', '13:00:00', 14.59530000, 120.98800000, 'Manila', 'Technology Institute of the Philippines'),
(9, 1, 'Basic HTML & CSS', 'Tech & Digital Skills', 'Build simple web pages using HTML for structure and CSS for style. This course introduces essential coding concepts, perfect for beginners interested in web development and design fundamentals.', 'htmlCss.png', '2022-08-10', '09:00:00', 14.59530000, 120.98800000, 'Manila', 'Technology Institute of the Philippines'),
(10, 1, 'Introduction to Graphic Design with Photoshop', 'Design', 'Start your design journey with Photoshop basics. Learn how to edit images, add effects, and apply creative techniques to produce graphics for digital projects, school, or personal use.', 'photoshop.png', '2024-08-11', '14:00:00', 14.59790000, 121.01080000, 'Manila', 'Polytechnic University of the Philippines'),
(11, 1, 'First Aid and Basic Life Support', 'Health', 'Gain essential life-saving skills. Learn to give CPR, treat injuries, and respond in emergencies. This course prepares you to act quickly and confidently when someone needs urgent help.', 'firstAid.png', '2023-08-16', '11:00:00', 14.20640000, 121.15300000, 'Calamba City', 'Calamba Medical Center'),
(12, 1, 'Leadership 101', 'Business & Career Development', 'Develop leadership skills through practical lessons on communication, decision-making, and teamwork. Perfect for aspiring leaders seeking to improve confidence, guide others effectively, and make a positive impact.', 'leadership.png', '2023-08-18', '15:00:00', 14.60110000, 121.04780000, 'Mandaluyong City', 'La Salle Green Hills');

-- --------------------------------------------------------

--
-- Table structure for table `guestanswers`
--

CREATE TABLE `guestanswers` (
  `guestAnswerId` int(11) NOT NULL,
  `guestId` int(11) NOT NULL,
  `eventQuestionId` int(11) NOT NULL,
  `answerText` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guestID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `firstName` varchar(80) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizerinfo`
--

CREATE TABLE `organizerinfo` (
  `organizerInfoId` int(11) NOT NULL,
  `organizerId` int(255) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizerinfo`
--

INSERT INTO `organizerinfo` (`organizerInfoId`, `organizerId`, `firstName`, `lastName`, `contact`) VALUES
(1, 1, 'John ', 'Doe', '09123456789'),
(2, 2, 'Jane', 'Smith', '09999999999');

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE `organizers` (
  `organizerId` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizers`
--

INSERT INTO `organizers` (`organizerId`, `username`, `email`, `password`) VALUES
(1, 'organizer1', 'organizer1@example.com', 'password1'),
(2, 'janesmith', 'jane@example.com', 'password2');

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
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `organizerId` (`organizerId`);

--
-- Indexes for table `guestanswers`
--
ALTER TABLE `guestanswers`
  ADD PRIMARY KEY (`guestAnswerId`),
  ADD KEY `guestId` (`guestId`),
  ADD KEY `eventQuestionId` (`eventQuestionId`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guestID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `organizerinfo`
--
ALTER TABLE `organizerinfo`
  ADD PRIMARY KEY (`organizerInfoId`),
  ADD KEY `organizerId` (`organizerId`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`organizerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventquestions`
--
ALTER TABLE `eventquestions`
  MODIFY `eventQuestionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `guestanswers`
--
ALTER TABLE `guestanswers`
  MODIFY `guestAnswerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizerinfo`
--
ALTER TABLE `organizerinfo`
  MODIFY `organizerInfoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `organizerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventquestions`
--
ALTER TABLE `eventquestions`
  ADD CONSTRAINT `eventquestions_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `events` (`eventId`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizerId`) REFERENCES `organizers` (`organizerId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guestanswers`
--
ALTER TABLE `guestanswers`
  ADD CONSTRAINT `guestanswers_ibfk_1` FOREIGN KEY (`guestId`) REFERENCES `guests` (`guestID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `guestanswers_ibfk_2` FOREIGN KEY (`eventQuestionId`) REFERENCES `eventquestions` (`eventQuestionId`) ON DELETE NO ACTION;

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventId`) ON DELETE NO ACTION;

--
-- Constraints for table `organizerinfo`
--
ALTER TABLE `organizerinfo`
  ADD CONSTRAINT `organizerinfo_ibfk_1` FOREIGN KEY (`organizerId`) REFERENCES `organizers` (`organizerId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
