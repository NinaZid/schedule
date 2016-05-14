-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2016 at 09:10 AM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `day`, `hour`, `priority`, `name`, `user_id`) VALUES
(1, 1, 10, 'Danger', 'Meeting with Philip', 2),
(2, 3, 12, 'Info', 'Skype chat', 2),
(3, 3, 17, 'Success', 'Finished project', 2),
(32, 2, 12, 'Success', 'QA Testing', 2),
(33, 5, 9, 'Danger', 'Meeting with client', 2),
(37, 4, 11, 'Info', 'Testing the web app', 2),
(42, 3, 10, 'Danger', 'Fixing bugs', 2),
(43, 1, 13, 'Info', 'Lunch break', 2),
(44, 2, 13, 'Info', 'Lunch break', 2),
(45, 3, 13, 'Info', 'Lunch break', 2),
(46, 4, 13, 'Info', 'Lunch break', 2),
(47, 5, 13, 'Info', 'Lunch break', 2),
(48, 4, 15, 'Danger', 'Meeting with Anna', 2),
(49, 3, 15, 'Info', 'Meeting with An', 5),
(50, 5, 16, 'Danger', 'Meeting with Martin', 5),
(51, 2, 11, 'Info', 'Meeting with Bo', 5),
(52, 4, 13, 'Info', 'Lunch', 5),
(53, 1, 12, 'Success', 'Finished project', 5),
(54, 3, 9, 'Danger', 'Meeting with Joe', 5),
(59, 1, 9, 'Info', 'Just testing ', 5),
(75, 3, 13, 'Info', 'Lunch', 6),
(87, 1, 11, 'Success', 'Test', 13),
(88, 2, 9, 'Danger', 'Check', 13),
(91, 3, 13, 'Info', 'Lunch', 13),
(92, 2, 9, 'Info', 'Skype chat', 13),
(93, 1, 11, 'Danger', 'QA Testing', 13),
(95, 3, 13, 'Info', 'Lunch break', 13),
(96, 4, 9, 'Danger', 'Meeting with Anna', 13),
(97, 5, 14, 'Success', 'Finished project', 13),
(98, 1, 10, 'Danger', 'Fixing bugs', 16),
(99, 3, 12, 'Danger', 'Testing the web app', 16),
(100, 5, 15, 'Danger', 'Testing the web app', 16),
(101, 2, 11, 'Info', 'Skype chat', 16),
(102, 3, 13, 'Info', 'Lunch break', 16),
(103, 1, 13, 'Info', 'Lunch break', 16),
(104, 4, 11, 'Info', '	 Meeting with Philip', 16),
(105, 4, 11, 'Success', 'Meeting with Philip', 16),
(106, 1, 13, 'Info', 'Lunch', 6),
(107, 5, 13, 'Info', 'Lunch', 6),
(108, 1, 9, 'Danger', 'Fixing bugs', 6),
(109, 4, 9, 'Danger', 'Fixing bugs', 6),
(110, 2, 14, 'Success', 'Finished project', 6),
(111, 2, 11, 'Info', 'Meeting with Phil', 6),
(112, 3, 9, 'Info', 'Skype chat', 6),
(123, 1, 13, 'Info', 'Lunch break', 18),
(124, 3, 13, 'Info', 'Lunch break', 18),
(125, 4, 13, 'Info', 'Lunch break', 18),
(126, 1, 9, 'Danger', 'Testing the web app', 18),
(127, 5, 16, 'Danger', 'Testing the web app', 18),
(128, 2, 15, 'Success', 'Meeting with client', 18),
(130, 2, 9, 'Info', 'Testing', 2),
(131, 2, 11, 'Danger', 'Testing', 20),
(132, 2, 9, 'Danger', 'testin2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(115) NOT NULL,
  `password` varchar(115) NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `first_name`, `last_name`) VALUES
(2, 'james', '12345', 2, 'James', 'Bond'),
(4, 'nina', 'admin', 1, 'Nina', 'Zidrovska'),
(5, 'martin', 'admin', 1, 'Martin', 'Chandjukovski'),
(6, 'gary', '12345', 2, 'Gary', 'Davis'),
(13, 'john', '12345', 2, 'John', 'Johnson'),
(16, 'billy', '12345', 2, 'Billy', 'Turner'),
(18, 'alexandra', '12345', 2, 'Alexandra', 'Watts'),
(20, 'Alek', '12345', 2, 'Alek', 'Alekovski');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
