-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2022 at 05:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `washinngarage`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `membership` enum('member','customer') NOT NULL DEFAULT 'customer',
  `membership_point` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) NOT NULL,
  `type` enum('service','merchandise','food','beverage','promotion') NOT NULL,
  `category` enum('Car','Motorcycle') DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(100) DEFAULT 'no-thumbnail.jpg',
  `description` varchar(1000) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `poin` int(11) NOT NULL,
  `status` enum('active','inactive','out of stock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `type`, `category`, `name`, `price`, `image`, `description`, `stock`, `poin`, `status`) VALUES
(1, 'service', 'Car', 'Express', 22000, 'Express.jpg', 'Cuci Kilat : <br> Ada 2 paket untuk jenis pencucian yang satu ini yaitu, <ul><li>Express</li><li>Express Plus</li></ul> . <br> Untuk paket Express treatment yang kami berikan mencakup : <br><ul><li>Exterior Cleaning</li></ul> <br> Sedangkan untuk paket Express Plus kami menawarkan layanan yang mencakup <ul><li>cuci eksterior</li><li>pembersihan interior mobil.</li></ul> ', NULL, 22, 'active'),
(2, 'service', 'Car', 'Express Plus', 25000, 'Express Plus.jpg', 'Cuci Kilat : <br> Ada 2 paket untuk jenis pencucian yang satu ini yaitu, <ul><li>Express</li><li>Express Plus</li></ul> . <br> Untuk paket Express treatment yang kami berikan mencakup : <br><ul><li>Exterior Cleaning</li></ul><br> Sedangkan untuk paket Express Plus kami menawarkan layanan yang mencakup <ul><li>cuci eksterior</li><li>pembersihan interior mobil.</li></ul> ', NULL, 25, 'active'),
(3, 'service', 'Car', 'Hydraulic Wash', 35000, 'Hydraulic Wash.jpg', 'Cuci Kolong : <br> Untuk jenis ini hanya ada 1 paket yang kami tawarkan yaitu, <ul><li>Hydraulic</li></ul> <br> Paket ini menawarkan beberapa treatment, diantaranya : <ul><li>cuci eksterior</li><li>cuci kolong/bawah mobil</li><li>pembersihan interior mobil</li></ul>', NULL, 35, 'active'),
(4, 'service', 'Motorcycle', 'Express Bike', 10000, 'Express Bike.jpg', 'Cuci Kilat : <br> Untuk jenis ini ada 3 paket yang kami tawakan yaitu, <ul><li>Express Bike</li><li>Express 250</li><li>Express Moge</li></ul>', NULL, 10, 'active'),
(5, 'service', 'Motorcycle', 'Express 250', 15000, 'Express 250.jpg', 'Cuci Kilat : <br> Untuk jenis ini ada 3 paket yang kami tawakan yaitu, <ul><li>Express Bike</li><li>Express 250</li><li>Express Moge</li></ul>', NULL, 15, 'active'),
(6, 'service', 'Motorcycle', 'Express Moge', 20000, 'Express Moge.jpg', 'Cuci Kilat : <br> Untuk jenis ini ada 3 paket yang kami tawakan yaitu, <ul><li>Express Bike</li><li>Express 250</li><li>Express Moge</li></ul>', NULL, 20, 'active'),
(7, 'service', 'Car', 'Detailing - Small', 450000, 'Detailing - Small.jpg', 'Cuci Detailing : <br> Kami menawarkan 2 paket yaitu,<ul><li>Platinum</li><li>Diamond</li></ul> <br> <ul><li>Untuk paket Platinum kami memberikan semua treatment yang ada pada paket Hydraulic dan ada tambahan express interior detailig dan body spray wax.</li><li>Untuk paket Diamond, kami memberikan semua treatment yang ada pada paket Platinum dan ada tambahan seat cleaning dan interior fogging.</li></ul> ', NULL, 450, 'active'),
(8, 'merchandise', NULL, 'Kaos Merchandise Wash Inn Garage Hitam', 65000, 'Kaos Merchandise Wash Inn Garage Hitam.jpg', 'Kaos Merchandise Wash Inn Garage Hitam', 24, 65, 'active'),
(9, 'merchandise', NULL, 'Mug Hitam Keramik Cantik', 25000, 'Mug Hitam Keramik Cantik.jpg', 'Mug Hitam Keramik Cantik', 24, 25, 'active'),
(10, 'food', NULL, 'Mr. P : Honey Roasted Peanut', 7500, 'MrP.jpg', 'Mr. P : Honey Roasted Peanut', 48, 7, 'active'),
(11, 'food', NULL, 'Lays Classic : All Flavour', 12000, 'Lays Classic.jpg', 'Lays Classic : All Flavour', 49, 12, 'active'),
(12, 'food', NULL, 'Sukro Oven', 8000, 'Sukro Oven.jpg', 'Sukro Oven', 42, 8, 'active'),
(13, 'beverage', NULL, 'Susu Ultra UHT Milk', 7000, 'Susu Ultra UHT Milk.jpg', 'Susu Ultra UHT Milk : All Variants', 55, 7, 'active'),
(14, 'beverage', NULL, 'Kopi Hitam Kapal Api', 5000, 'Kopi Hitam Kapal Api.jpg', 'Kopi Hitam Kapal Api : Dengan atau Tanpa Gula', 999994, 5, 'active'),
(15, 'promotion', NULL, 'Discount Rp 5.000', -5000, 'no-thumbnail.jpg', 'Redeem 50 Points = Rp 5.000 Discount', NULL, -50, 'active'),
(16, 'promotion', NULL, 'Discount Rp 10.000', -10000, 'no-thumbnail.jpg', 'Redeem 100 Points = Rp 10.000 Discount', NULL, -100, 'active'),
(17, 'promotion', NULL, 'Promo Valentine', -14000, 'no-thumbnail.jpg', 'Khusus Bagi Yang Datang Bawa Pasangan ', NULL, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `trx_id` int(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `platnomor` varchar(12) DEFAULT NULL,
  `amount` int(5) NOT NULL DEFAULT 1,
  `order_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(20) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `receipt_number` varchar(15) DEFAULT NULL,
  `completedate` date DEFAULT NULL,
  `completetime` time DEFAULT NULL,
  `operator_name` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `trx_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT 'n/a',
  `username` varchar(50) NOT NULL,
  `role` enum('admin','operator') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `username`, `role`, `password`) VALUES
(1, 'System Administrator', 'dev.washinngarage@gmail.com', '628128888000', 'admin', 'admin', '$2y$10$o.Pnh051BudSekKDe1tmM.9wE1j7dtUHftovikPH0wNK9DZ9/0noK'),
(2, 'Hafidz Abdillah Masruri', 'pisangbenyek0@gmail.com', '08979565131', 'hfdzam', 'operator', '$2y$10$Bsne1rFgkcYWBpzRPO5nJujNLBjEW/Ckf0f85iLYXZhfYPIg2jxAe'),
(3, 'Fikri Miftah Akmaludin', 'pisangbenyek0@gmail.com', '08979565131', 'fma', 'operator', '$2y$10$qvL.tiBTIidb72qrvujVQ.W0HIrqudmCkNNQ5HzXArBVA6YxpRFgW');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) NOT NULL,
  `vehicletype` varchar(10) NOT NULL,
  `platnomor` varchar(12) NOT NULL,
  `owner_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
