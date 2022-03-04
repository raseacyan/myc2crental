-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 11:46 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_myc2crental`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `image`, `category`, `status`, `user_id`, `created_on`) VALUES
(1, 'Sofa Set', '100.00', 'Sofa set for rent. 100 per month', '1645675558_sofa.jpg', 'category 1', 'available', 1, '2022-02-24 04:05:58'),
(2, 'test 2', '2.00', 'test product\r\ndont buy', '1645680120_H68d40b682a144e63b2b900cdc689b2efe.jpg_200x200.jpg', 'category 3', 'available', 1, '2022-02-24 04:27:01'),
(3, 'cat', '2000.00', 'cat for rent. 2000 mmk per month', '1646370416_cat.jpeg', 'category 2', 'available', 1, '2022-03-04 05:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `amount`, `rental_id`, `created_on`) VALUES
(2, '2022-03-01', '300.00', 4, '0000-00-00 00:00:00'),
(3, '0000-00-00', '300.00', 4, '0000-00-00 00:00:00'),
(4, '2022-03-06', '6000.00', 5, '0000-00-00 00:00:00'),
(5, '2022-03-07', '6000.00', 5, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(16) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `start_date`, `end_date`, `duration`, `total_amount`, `status`, `owner_id`, `customer_id`, `item_id`, `created_on`) VALUES
(4, '2022-03-06', '2022-03-06', 6, '600.00', 'confirmed', 1, 2, 1, '2022-03-03 09:03:02'),
(5, '2022-03-07', '2022-03-07', 6, '12000.00', 'confirmed', 1, 2, 3, '2022-03-04 05:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `created_on`) VALUES
(1, 'Effy Stonem', 'effy@skins.co.uk', '11111111', '1, Test Drive, Bristol, UK', 'cc03e747a6afbbcbf8be7668acfebee5', '2022-02-23 15:41:32'),
(2, 'Emily Fitch', 'emily@skins.co.uk', '22222222', '1, Downton Avenue, Bristol, UK', 'cc03e747a6afbbcbf8be7668acfebee5', '2022-03-03 05:34:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
