-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2022 at 06:30 AM
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
  `point` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) NOT NULL,
  `type` enum('service','merchandise','food','beverage') NOT NULL,
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
(1, 'service', 'Car', 'Express', 22000, 'Express.jpg', 'Cuci Mobil Express 22K<br>Paket layanan ini mencakup : <br><ul><li>Cuci Exterior</li></ul>', NULL, 0, 'active'),
(2, 'service', 'Motorcycle', 'Express Bike', 10000, 'Express Bike.jpg', 'Cuci Motor Express 10K<br>Paket layanan ini mencakup : <br><ul><li>Cuci Mesin Motor</li><li>Cuci Body Motor</li></ul>', NULL, 0, 'active'),
(3, 'beverage', NULL, 'Kopi Hitam', 5000, 'Kopi Hitam.jpg', 'Kopi Hitam Kapal Api<br>Bisa request takaran gula<br>Tidak request maka dibuatkan takaran 1:1 antara gula:kopi', 9999, 7, 'active'),
(4, 'service', 'Motorcycle', 'Express 250', 15000, 'Express 250.jpg', 'Cuci Motor 250cc', NULL, 17, 'active'),
(5, 'merchandise', NULL, 'Kaos Hitam', 85000, 'Kaos Hitam.jpg', 'Kaos hitam Polos', 90, 27, 'active'),
(6, 'merchandise', NULL, 'Mug Hitam', 55000, 'Mug Hitam.jpg', 'Mug Hitam Biasa', 21, 33, 'active'),
(7, 'food', NULL, 'Lays Classic', 10000, 'Lays Classic.jpg', 'Lays all variant', 55, 12, 'active');

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
  `platnomor` varchar(10) DEFAULT NULL,
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
  `receipt_number` int(10) DEFAULT NULL,
  `completetime` date DEFAULT NULL,
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
(1, 'System Administrator', 'dev.washinngarage@gmail.com', 'n/a', 'admin', 'admin', '$2y$10$o.Pnh051BudSekKDe1tmM.9wE1j7dtUHftovikPH0wNK9DZ9/0noK'),
(2, 'Hafidz Abdillah Masruri', 'pisangbenyek0@gmail.com', '08979565131', 'hfdzam', 'operator', '$2y$10$Bsne1rFgkcYWBpzRPO5nJujNLBjEW/Ckf0f85iLYXZhfYPIg2jxAe');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) NOT NULL,
  `vehicletype` varchar(10) NOT NULL,
  `platnomor` varchar(10) NOT NULL,
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
