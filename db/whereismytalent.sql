-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2016 at 10:41 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whereismytalent`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `job` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `resume_path` text COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `birth_date`, `job`, `source`, `resume_path`, `profile`, `create_date`, `status_id`) VALUES
(11, 'ali dei', '1981-06-11', 5, 1, '', '', '2016-06-29 00:00:00', 1),
(12, 'ali deis', '1977-06-18', 5, 1, '', '', '2016-06-29 00:00:00', 1),
(13, 'ali deishidi', '1984-08-09', 5, 1, '', 'http://ali.com?as', '2016-06-29 00:00:00', 1),
(14, 'ali deishidi', '1974-06-05', 5, 1, 'resumes/5773dbf3302d2.txt', 'asasasas', '2016-06-29 00:00:00', 1),
(15, 'ali', '1980-06-18', 5, 1, 'resumes/5773dc1aed412.pdf', '', '2016-06-29 00:00:00', 7),
(16, 'Bahar', '1976-07-15', 7, 2, '', 'www.zoraq.com', '2016-07-01 00:00:00', 3),
(17, 'amir ahmadi', '1973-07-04', 6, 1, '', 'aaa', '2016-07-01 00:00:00', 4),
(18, 'Helia /khadem sameni', '1992-07-16', 7, 2, 'resumes/577686f37a39f.pdf', '', '2016-07-01 05:06:27', 2),
(19, 'Ghazal Maghsoudi', '1979-07-18', 6, 2, 'resumes/577759085bd86.pdf', '', '2016-07-02 08:02:48', 6);

-- --------------------------------------------------------

--
-- Table structure for table `candidate_history`
--

CREATE TABLE IF NOT EXISTS `candidate_history` (
  `candidate_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `candidate_history`
--

INSERT INTO `candidate_history` (`candidate_id`, `comment`, `created_by`, `created_date`, `status_id`) VALUES
(16, 'Good, ASAP.', 1, '2016-07-01 02:23:19', 2),
(16, 'Tomorrow she will come to office', 1, '2016-07-01 02:23:44', 4),
(16, 'Nahhh, she is not good, who recommended her?', 1, '2016-07-01 05:03:51', 6),
(18, 'Cool, she seems fine.', 1, '2016-07-01 05:10:34', 2),
(19, 'She seems fine.', 1, '2016-07-02 08:04:32', 2),
(19, 'She is so great and fun', 1, '2016-07-02 08:05:07', 7),
(19, '', 1, '2016-07-08 12:10:48', 6),
(16, '', 1, '2016-07-08 07:57:27', 3),
(17, '', 1, '2016-07-08 07:59:50', 5),
(15, '', 1, '2016-07-08 08:02:36', 7),
(17, 'Interview was set for Sunday morning.', 3, '2016-07-08 10:36:50', 4);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
`id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `description`) VALUES
(1, 'IT'),
(2, 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`description`, `id`) VALUES
('Back-end', 5),
('Front-end', 6),
('accountant', 7),
('sales accountant', 8);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_to_departments`
--

CREATE TABLE IF NOT EXISTS `jobs_to_departments` (
  `department` int(11) NOT NULL,
  `job` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs_to_departments`
--

INSERT INTO `jobs_to_departments` (`department`, `job`) VALUES
(1, 5),
(2, 8),
(1, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
`id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `description`) VALUES
(1, 'Iran Talent'),
(2, 'Job Inja');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `color_style` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'status-white'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `description`, `color_style`) VALUES
(1, 'not reviewed', 'status-red'),
(2, 'interview request', 'status-green'),
(3, 'hmm, pending', 'status-gold'),
(4, 'interview set', 'status-green'),
(5, 'reject offer', 'status-gray'),
(6, 'reject by zoraq', 'status-gray'),
(7, 'approved', 'status-blue');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`) VALUES
(1, 'adeishidi@zoraq.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Ali Deishidi'),
(3, 'mranjbar@zoraq.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Mahvash Ranjbar'),
(5, 'gmaghsoudi@zoraq.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Ghazal Maghsoudi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
