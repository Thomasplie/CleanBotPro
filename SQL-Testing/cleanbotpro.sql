-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2025 at 11:21 AM
-- Server version: 8.4.2
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleanbotpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `robot_tasks`
--

CREATE TABLE `robot_tasks` (
  `id` int NOT NULL,
  `task_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `day` tinyint NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `robot_tasks`
--

INSERT INTO `robot_tasks` (`id`, `task_name`, `day`, `time`) VALUES
(1, 'Vacuum living room', 1, '09:00:00'),
(2, 'Check battery levels', 1, '18:30:00'),
(3, 'Water plants', 3, '08:00:00'),
(4, 'Dust shelves', 3, '14:15:00'),
(5, 'Grocery check', 6, '10:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `robot_tasks`
--
ALTER TABLE `robot_tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `robot_tasks`
--
ALTER TABLE `robot_tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
