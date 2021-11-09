-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2021 at 10:09 AM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theplyxu_hung_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_stripe_card`
--

CREATE TABLE `user_stripe_card` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `stripe_card_id` varchar(255) DEFAULT NULL,
  `last_4_digit` varchar(255) DEFAULT NULL,
  `stripe_customer_id` varchar(255) DEFAULT NULL,
  `stripe_card_expiry_year` varchar(255) DEFAULT NULL,
  `stripe_card_expiry_month` varchar(255) DEFAULT NULL,
  `card_brand` varchar(255) DEFAULT NULL,
  `stripe_card_funding` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `date_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_stripe_card`
--

INSERT INTO `user_stripe_card` (`id`, `user_id`, `stripe_card_id`, `last_4_digit`, `stripe_customer_id`, `stripe_card_expiry_year`, `stripe_card_expiry_month`, `card_brand`, `stripe_card_funding`, `status`, `date_time`) VALUES
(1, 1, '1', '1', '1', '1', '1', '1', '1', 1, '0000-00-00 00:00:00'),
(2, 1, 'stripe_card_id', 'last_4_digit', 'cus_KZ34DoIiuRDRf1', 'stripe_card_expiry_year', 'stripe_card_expiry_month', 'card_brand', 'stripe_card_funding', 1, '2021-11-09 09:07:12'),
(3, 1, 'cus_KZ34DoIiuRDRf1', 'last_4_digit_2', 'cus_KZ3AAiK0elbYBr', 'stripe_card_expiry_year_2', 'stripe_card_expiry_month_2', 'card_brand_2', 'stripe_card_funding_2', 1, '2021-11-09 09:12:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_stripe_card`
--
ALTER TABLE `user_stripe_card`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_stripe_card`
--
ALTER TABLE `user_stripe_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
