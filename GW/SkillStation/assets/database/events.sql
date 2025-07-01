-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 08:20 PM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(4) NOT NULL,
  `organizerId` int(4) NOT NULL,
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
(1, 1, 'Watercolor Basics: Florals & Landscapes', 'Creative & Arts', 'Discover the joy of watercolor painting in this beginner-friendly workshop focused on florals and landscapes. Learn essential techniques, brush handling, and color blending as you create your own art pieces.', 'event1.png', '2025-07-20', '10:00:00', 14.65340000, 121.06840000, 'Quezon City', 'UP Diliman'),
(2, 1, 'Build Your First Website (HTML & CSS)', 'Tech & Digital Skills', 'Learn the basics of web development and create your first webpage using HTML and CSS. Perfect for beginners with zero coding experience.', 'event2.png', '2025-07-28', '09:00:00', 14.60910000, 121.02150000, 'Manila', 'Technological Institute of the Philippines'),
(3, 1, 'Start Your Online Business (Simula sa Sa Sarili)', 'Business & Career Development', 'A step-by-step workshop to help you launch your online business using practical tools and local resources.', 'event3.png', '2025-08-10', '10:00:00', 15.03420000, 120.68470000, 'San Fernando, Pampanga', 'Negosyo Center'),
(4, 1, 'Barista Skills & Latte Art 101', 'Lifestyle & Hobbies', 'Master barista techniques and learn the fundamentals of brewing and latte art in this hands-on workshop.', 'event4.png', '2025-08-11', '10:00:00', 14.45000000, 120.98000000, 'Las Piñas City', 'Coffee Project'),
(5, 1, 'Indoor Plants 101: Care & Styling', 'Lifestyle & Hobbies', 'Explore the basics of indoor plant care, placement, and styling to elevate your space with greenery.', 'event5.png', '2025-08-16', '09:00:00', 14.60190000, 121.03320000, 'San Juan City', 'Green Haus Café'),
(6, 1, 'Debate & Public Speaking for Teens', 'Academic & Skills Boosters', 'A confidence-building workshop designed to teach teens effective communication, argument structure, and public speaking skills.', 'event6.png', '2025-08-18', '10:00:00', 14.58960000, 121.03590000, 'Mandaluyong City', 'La Salle Green Hills'),
(7, 1, 'Pottery Basics: Pottery and Clay Handbuilding ', 'Creative & Arts', 'Learn to shape, mold, and create pottery using clay handbuilding techniques. A calming, hands-on class perfect for beginners exploring creativity and craftsmanship through functional and decorative pieces.', 'pottery.png', '2024-07-20', '10:00:00', 14.65390000, 121.06850000, 'Quezon City', 'University of the Philippines'),
(8, 1, 'Introduction to Canva for Design', 'Design', 'Create stunning visuals using Canvas easy tools. Learn basic design principles like layout and color to make posters, social media graphics, and more ideal for beginners with no design experience.', 'canva.png', '2022-07-28', '13:00:00', 14.59530000, 120.98800000, 'Manila', 'Technology Institute of the Philippines'),
(9, 1, 'Basic HTML & CSS', 'Tech & Digital Skills', 'Build simple web pages using HTML for structure and CSS for style. This course introduces essential coding concepts, perfect for beginners interested in web development and design fundamentals.', 'htmlCss.png', '2022-08-10', '09:00:00', 14.59530000, 120.98800000, 'Manila', 'Technology Institute of the Philippines'),
(10, 1, 'Introduction to Graphic Design with Photoshop', 'Design', 'Start your design journey with Photoshop basics. Learn how to edit images, add effects, and apply creative techniques to produce graphics for digital projects, school, or personal use.', 'photoshop.png', '2024-08-11', '14:00:00', 14.59790000, 121.01080000, 'Manila', 'Polytechnic University of the Philippines'),
(11, 1, 'First Aid and Basic Life Support', 'Health', 'Gain essential life-saving skills. Learn to give CPR, treat injuries, and respond in emergencies. This course prepares you to act quickly and confidently when someone needs urgent help.', 'firstAid.png', '2023-08-16', '11:00:00', 14.20640000, 121.15300000, 'Calamba City', 'Calamba Medical Center'),
(12, 1, 'Leadership 101', 'Business & Career Development', 'Develop leadership skills through practical lessons on communication, decision-making, and teamwork. Perfect for aspiring leaders seeking to improve confidence, guide others effectively, and make a positive impact.', 'leadership.png', '2023-08-18', '15:00:00', 14.60110000, 121.04780000, 'Mandaluyong City', 'La Salle Green Hills');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `organizerId` (`organizerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
