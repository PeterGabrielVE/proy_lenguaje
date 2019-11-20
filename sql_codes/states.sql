-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2017 at 07:18 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hermesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `abbreviation` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `abbreviation`) VALUES
(1, 'Alabama\n', 'AL'),
(2, 'Alaska\n', 'AK'),
(3, 'Arizona\n', 'AZ'),
(4, 'Arkansas\n', 'AR'),
(5, 'California\n', 'CA'),
(6, 'Colorado\n', 'CO'),
(7, 'Connecticut\n', 'CT'),
(8, 'Delaware\n', 'DE'),
(9, 'Florida\n', 'FL'),
(10, 'Georgia\n', 'GA'),
(11, 'Hawaii\n', 'HI'),
(12, 'Idaho\n', 'ID'),
(13, 'Illinois\n', 'IL'),
(14, 'Indiana\n', 'IN'),
(15, 'Iowa\n', 'IA'),
(16, 'Kansas\n', 'KS'),
(17, 'Kentucky\n', 'KY'),
(18, 'Louisiana\n', 'LA'),
(19, 'Maine\n', 'ME'),
(20, 'Maryland\n', 'MD'),
(21, 'Massachusetts\n', 'MA'),
(22, 'Michigan\n', 'MI'),
(23, 'Minnesota\n', 'MN'),
(24, 'Mississippi\n', 'MS'),
(25, 'Missouri\n', 'MO'),
(26, 'Montana\n', 'MT'),
(27, 'Nebraska\n', 'NE'),
(28, 'Nevada\n', 'NV'),
(29, 'New Hampshire\n', 'NH'),
(30, 'New Jersey\n', 'NJ'),
(31, 'New Mexico\n', 'NM'),
(32, 'New York\n', 'NY'),
(33, 'North Carolina\n', 'NC'),
(34, 'North Dakota\n', 'ND'),
(35, 'Ohio\n', 'OH'),
(36, 'Oklahoma\n', 'OK'),
(37, 'Oregon\n', 'OR'),
(38, 'Pennsylvania\n', 'PA'),
(39, 'Rhode Island\n', 'RI'),
(40, 'South Carolina\n', 'SC'),
(41, 'South Dakota\n', 'SD'),
(42, 'Tennessee\n', 'TN'),
(43, 'Texas\n', 'TX'),
(44, 'Utah\n', 'UT'),
(45, 'Vermont\n', 'VT'),
(46, 'Virginia\n', 'VA'),
(47, 'Washington\n', 'WA'),
(48, 'West Virginia\n', 'WV'),
(49, 'Wisconsin\n', 'WI'),
(50, 'Wyoming', 'WY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
