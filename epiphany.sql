-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 02:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiphany`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(255) NOT NULL,
  `date_received` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `date_added`, `order_status`, `date_received`) VALUES
(42, 46, 21, 1, '2023-03-02 15:58:06', 'Received', '2023-03-03 02:27:50'),
(43, 46, 22, 15, '2023-03-02 18:25:36', 'To be delivered', NULL),
(44, 46, 20, 7, '2023-03-02 19:25:54', 'Pending', NULL),
(45, 46, 21, 1, '2023-03-02 19:25:54', 'Pending', NULL),
(46, 46, 22, 1, '2023-03-02 19:25:54', 'To be delivered', NULL),
(47, 48, 22, 8, '2023-03-03 00:06:42', 'Received', '2023-03-03 08:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `registeredusers`
--

CREATE TABLE `registeredusers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(20) NOT NULL,
  `phone_num` bigint(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registeredusers`
--

INSERT INTO `registeredusers` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `date_registered`, `user_type`, `phone_num`, `address`, `birthdate`) VALUES
(16, 'Ernesto IV', 'Ilagan', 'extolhim8', 'ernestoilagan08@gmail.com', 'pass123', '2023-03-02 21:39:30', 'admin', 9167813909, 'Road 5, Brgy. Bagong Silangan, QC', '2001-09-15'),
(17, 'ERNESTO IV', 'ILAGAN', 'admin1', 'ernesto@gmail.com', 'admin1', '2023-03-02 21:42:00', 'sAdmin', 2418523457, 'Road X, Brgy. Bagong Silangan, QC', '2001-09-16'),
(29, 'Stephano', 'Pineda', 'adminako', 's@gmail.com', 'asd', '2023-02-22 19:22:40', 'sAdmin', 9953853832, 'QC', '2000-12-12'),
(46, 'Anthony', 'Ilagan', 'anthony', 'anthony@gmail.com', 'anthony', '2023-03-02 21:42:46', 'user', 9356781542, 'Road 6', '2023-03-06'),
(48, 'Joshua', 'Ilagan', 'joshua', 'joshua@gmail.com', 'joshua', '2023-03-03 08:06:14', 'user', 9657458211, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`, `product_id`, `quantity`, `date_added`) VALUES
(62, 46, 24, 25, '2023-03-02 20:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `storecontent`
--

CREATE TABLE `storecontent` (
  `id` int(11) NOT NULL,
  `product_name` varchar(31) NOT NULL,
  `description` varchar(127) NOT NULL,
  `stock` int(3) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storecontent`
--

INSERT INTO `storecontent` (`id`, `product_name`, `description`, `stock`, `price`, `file_name`) VALUES
(20, 'Epiphany Pumpkin Spice', 'Pumpkin, Citrus and Woody', 500, '200.00', 'prod1.jpg'),
(21, 'Epiphany Sweet Pea', 'Sweet, Floral and Fresh', 5, '500.00', 'prod2.jpg'),
(22, 'Epiphany Morning Dew', 'Floral & Citrus', 95, '400.00', 'prod3.jpg'),
(23, 'Epiphany Honey Bunch', 'Rose and Oriental', 400, '999.00', 'prod5.jpg'),
(24, 'Epiphany Snow Punch', 'Aromatic Vanilla', 9975, '60.00', 'prod4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `registeredusers`
--
ALTER TABLE `registeredusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `storecontent`
--
ALTER TABLE `storecontent`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `registeredusers`
--
ALTER TABLE `registeredusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `storecontent`
--
ALTER TABLE `storecontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registeredusers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `storecontent` (`id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registeredusers` (`id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `storecontent` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
