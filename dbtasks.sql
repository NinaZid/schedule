-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 10:43 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

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
(51, 2, 9, 'Info', 'Meeting with Me', 5),
(52, 4, 11, 'Danger', 'Lunch', 5),
(53, 1, 12, 'Success', 'Finished project', 5),
(54, 3, 9, 'Danger', 'Alooo', 5),
(55, 4, 9, 'Danger', 'eeeeej', 2),
(56, 5, 9, 'Danger', 'Testing', 5);

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
  PRIMARY KEY (`id`),
  KEY `role_id_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'John', '12345', 2),
(2, 'nina', '12345', 2),
(4, 'admin', 'admin', 1),
(5, 'martin', '11111', 2);

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
