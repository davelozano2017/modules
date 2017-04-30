-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2016 at 01:13 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modules`
--

-- --------------------------------------------------------

--
-- Table structure for table `generated_tbl`
--

CREATE TABLE `generated_tbl` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `case_link` varchar(255) NOT NULL,
  `require_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members_tbl`
--

CREATE TABLE `members_tbl` (
  `id` int(11) NOT NULL,
  `photos` char(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `security_tbl`
--

CREATE TABLE `security_tbl` (
  `id` int(11) NOT NULL,
  `security` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_tbl`
--

INSERT INTO `security_tbl` (`id`, `security`) VALUES
(3, 'ssl');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_server_tbl`
--

CREATE TABLE `smtp_server_tbl` (
  `id` int(11) NOT NULL,
  `smtp_socket` varchar(255) NOT NULL,
  `smtp_security` varchar(255) NOT NULL,
  `smtp_email` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `smtp_from` varchar(255) NOT NULL,
  `smtp_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smtp_server_tbl`
--

INSERT INTO `smtp_server_tbl` (`id`, `smtp_socket`, `smtp_security`, `smtp_email`, `smtp_password`, `smtp_from`, `smtp_status`) VALUES
(1, 'smtp.gmail.com:465', 'ssl', 'metrocakeshop@gmail.com', 'password!@#$', 'admin@noreply.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `socket_tbl`
--

CREATE TABLE `socket_tbl` (
  `id` int(11) NOT NULL,
  `socket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `socket_tbl`
--

INSERT INTO `socket_tbl` (`id`, `socket`) VALUES
(3, 'smtp.gmail.com:465');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `generated_tbl`
--
ALTER TABLE `generated_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_tbl`
--
ALTER TABLE `members_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_tbl`
--
ALTER TABLE `security_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_server_tbl`
--
ALTER TABLE `smtp_server_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socket_tbl`
--
ALTER TABLE `socket_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generated_tbl`
--
ALTER TABLE `generated_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `members_tbl`
--
ALTER TABLE `members_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `security_tbl`
--
ALTER TABLE `security_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `smtp_server_tbl`
--
ALTER TABLE `smtp_server_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `socket_tbl`
--
ALTER TABLE `socket_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
