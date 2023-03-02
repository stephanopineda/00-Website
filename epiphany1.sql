-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 02:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(17, 38, 12, 1, '2023-03-01 13:09:12', 'Received', '2023-03-01 22:34:25'),
(18, 38, 17, 1, '2023-03-01 13:09:12', 'Received', '2023-03-01 22:26:04'),
(19, 38, 16, 1, '2023-03-02 06:57:25', 'Received', '2023-03-02 14:58:13'),
(21, 38, 15, 1, '2023-03-02 07:10:39', 'Received', '2023-03-02 15:21:52'),
(24, 38, 16, 1, '2023-03-02 07:39:15', 'Received', '2023-03-02 16:06:26'),
(28, 38, 15, 3, '2023-03-02 07:59:30', 'Received', '2023-03-02 16:06:28'),
(29, 38, 17, 2, '2023-03-02 08:03:03', 'Received', '2023-03-02 16:06:29'),
(32, 38, 15, 5, '2023-03-02 09:38:31', 'Pending', NULL),
(33, 38, 12, 1, '2023-03-02 09:38:31', 'Pending', NULL);

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
(28, 'Stephano', 'Pineda', 'stephanopineda', 'denniel.step@gmail.com', 'asd', '2023-02-22 19:22:40', 'user', 9953853832, '', '2001-03-24'),
(29, 'Stephano', 'Pineda', 'adminako', 's@gmail.com', 'asd', '2023-02-22 19:22:40', 'sAdmin', 9953853832, '', NULL),
(38, 'sha', 'bu', 'shabu', 'sh@bu.com', 'S', '2023-02-24 14:18:57', 'user', 9953853832, '', NULL),
(39, 'nice', 'nice', 'nice', 'a@aas.com', 'aa', '2023-02-24 17:24:30', 'admin', 0, '', NULL),
(40, 'abdul', 'admin', 'adminabdul', 'admin@bd.ul', 'yes', '2023-02-24 19:11:12', 'admin', 0, '', NULL),
(41, 'Stephano', 's', 's', 's@s.c', 'ugFrh6Wzy88A5r9', '2023-03-02 16:17:32', 'user', 9234567890, '', NULL),
(42, 'sha', 's', 'daas', 's@s.ca', 'asd', '2023-03-02 16:21:42', 'user', 9234567890, '', NULL),
(43, 'asd', 'asd', 'ssf', 'd@asd.com', 'asd', '2023-03-02 20:21:18', 'user', 9953853832, '', NULL),
(44, 'asds', 'asa', 'gga', 'gas@ga.c', 'yes', '2023-03-02 20:22:48', 'user', 9953853832, '', NULL),
(45, 'te', 'te', 'te', 'te@te.mo', 'ass', '2023-03-02 20:28:46', 'admin', 0, '', NULL);

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
(12, 'laplace', 'transform', 90, '500.00', '320410350_5696086537172108_8210637093430714788_n.jpg'),
(15, 'dog', 'iro', 123, '123.00', 'c90a15f1c67863ea32846f5f14dc4897.jpg'),
(16, 'shiba inu', 'dog', 123, '11.00', '0305a6654ff5fa22e6e47d5d1d1b4d13.jpg'),
(17, 'pine tree', 'meme', 12121, '111.00', '311889924_586055786652955_3998794895178176438_n.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `registeredusers`
--
ALTER TABLE `registeredusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `storecontent`
--
ALTER TABLE `storecontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
