-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 10:33 PM
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

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `phone`, `email`, `membership`, `membership_point`) VALUES
(1, 'Adi Subhani', '628128888001', 'andisubhani@gmail.com', 'customer', 0),
(2, 'Indra Birawa', '628128888002', 'indrabirawa@gmail.com', 'member', 40),
(3, 'Budi Pranowo', '628128888003', 'budipranowo@gmail.com', 'customer', 0),
(4, 'Tyrania Azyta', '628128888004', 'tyraniaazyta@gmail.com', 'member', 0),
(5, 'Putri Astari', '628128888005', 'putriastari@gmail.com', 'customer', 0),
(6, 'Nadira Reskika', '628128888006', 'nadirareskika@gmail.com', 'member', 0);

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
(8, 'merchandise', NULL, 'Kaos Merchandise Wash Inn Garage Hitam', 65000, 'Kaos Merchandise Wash Inn Garage Hitam.jpg', 'Kaos Merchandise Wash Inn Garage Hitam', 25, 65, 'active'),
(9, 'merchandise', NULL, 'Mug Hitam Keramik Cantik', 25000, 'Mug Hitam Keramik Cantik.jpg', 'Mug Hitam Keramik Cantik', 25, 25, 'active'),
(10, 'food', NULL, 'Mr. P : Honey Roasted Peanut', 7500, 'MrP.jpg', 'Mr. P : Honey Roasted Peanut', 50, 7, 'active'),
(11, 'food', NULL, 'Lays Classic : All Flavour', 12000, 'Lays Classic.jpg', 'Lays Classic : All Flavour', 50, 12, 'active'),
(12, 'food', NULL, 'Sukro Oven', 8000, 'Sukro Oven.jpg', 'Sukro Oven', 50, 8, 'active'),
(13, 'beverage', NULL, 'Susu Ultra UHT Milk', 7000, 'Susu Ultra UHT Milk.jpg', 'Susu Ultra UHT Milk : All Variants', 60, 7, 'active'),
(14, 'beverage', NULL, 'Kopi Hitam Kapal Api', 5000, 'Kopi Hitam Kapal Api.jpg', 'Kopi Hitam Kapal Api : Dengan atau Tanpa Gula', 999998, 5, 'active'),
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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `trx_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_id`, `menu_id`, `platnomor`, `amount`, `order_time`, `order_status`) VALUES
(1, 1, 'Adi Subhani', '628128888001', 'andisubhani@gmail.com', 1, 1, 'AD 5038 HNI', 1, '2022-02-04 15:11:11.915086', 'completed'),
(2, 2, 'Indra Birawa', '628128888002', 'indrabirawa@gmail.com', 2, 3, 'AB 8798 HHJ', 1, '2022-02-04 15:11:50.611223', 'completed'),
(3, 3, 'Budi Pranowo', '628128888003', 'budipranowo@gmail.com', 3, 5, 'BH 9087 GFD', 1, '2022-02-04 15:12:32.702842', 'active'),
(4, 4, 'Tyrania Azyta', '628128888004', 'tyraniaazyta@gmail.com', 4, 2, 'AA 6678 CFD', 1, '2022-02-04 15:13:12.754074', 'active'),
(5, 5, 'Putri Astari', '628128888005', 'putriastari@gmail.com', 5, 1, 'B 6638 FFF', 1, '2022-02-04 15:13:42.323992', 'active'),
(6, 6, 'Nadira Reskika', '628128888006', 'nadirareskika@gmail.com', 6, 3, 'N 1111 R', 1, '2022-02-04 15:14:19.912762', 'active'),
(7, 2, 'Indra Birawa', '628128888002', 'indrabirawa@gmail.com', 2, 14, 'AB 8798 HHJ', 1, '2022-02-04 15:16:50.150417', 'completed'),
(8, 2, 'Indra Birawa', '628128888002', 'indrabirawa@gmail.com', 2, 17, 'AB 8798 HHJ', 1, '2022-02-04 15:17:05.665293', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(20) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `receipt_number` int(15) DEFAULT NULL,
  `completedate` date DEFAULT NULL,
  `completetime` time DEFAULT NULL,
  `operator_name` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `trx_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `invoice_number`, `receipt_number`, `completedate`, `completetime`, `operator_name`, `customer_name`, `trx_status`) VALUES
(1, 'INV/2022/0204/1', 1, '2022-02-04', '22:15:00', 'Fikri Miftah Akmaludin', 'Adi Subhani', 'completed'),
(2, 'INV/2022/0204/2', 2, '2022-02-04', '22:19:00', 'Fikri Miftah Akmaludin', 'Indra Birawa', 'completed'),
(3, 'INV/2022/0204/3', NULL, NULL, NULL, NULL, 'Budi Pranowo', 'active'),
(4, 'INV/2022/0204/4', NULL, NULL, NULL, NULL, 'Tyrania Azyta', 'active'),
(5, 'INV/2022/0204/5', NULL, NULL, NULL, NULL, 'Putri Astari', 'unconfirmed'),
(6, 'INV/2022/0204/6', NULL, NULL, NULL, NULL, 'Nadira Reskika', 'unconfirmed');

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
(1, 'System Administrator', 'dev.washinngarage@gmail.com', 'n/a', 'admin', 'admin', '$2y$10$o.Pnh051BudSekKDe1tmM.9wE1j7dtUHftovikPH0wNK9DZ9/0noK'),
(2, 'Hafidz Abdillah Masruri', 'pisangbenyek0@gmail.com', '08979565131', 'hfdzam', 'operator', '$2y$10$Bsne1rFgkcYWBpzRPO5nJujNLBjEW/Ckf0f85iLYXZhfYPIg2jxAe'),
(3, 'Fikri Miftah Akmaludin', 'fikri.droid16@gmail.com', '08979565131', 'fma', 'operator', '$2y$10$qvL.tiBTIidb72qrvujVQ.W0HIrqudmCkNNQ5HzXArBVA6YxpRFgW');

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
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicletype`, `platnomor`, `owner_id`) VALUES
(1, 'Mobil', 'AD 5038 HNI', 1),
(2, 'Mobil', 'AB 8798 HHJ', 2),
(3, 'Motor', 'BH 9087 GFD', 3),
(4, 'Mobil', 'AA 6678 CFD', 4),
(5, 'Mobil', 'B 6638 FFF', 5),
(6, 'Mobil', 'N 1111 R', 6);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
