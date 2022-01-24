-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 03:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) NOT NULL,
  `type` enum('service','merchandise','food','beverage') NOT NULL,
  `category` enum('Car','Motorcycle') NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `status` enum('active','inactive','out of stock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `type`, `category`, `name`, `price`, `image`, `description`, `stock`, `status`) VALUES
(28, 'service', 'Car', 'Express', '22000', 'Express.jpg', 'Layanan cuci mobil express seharga 22 ribu : Exterior saja', NULL, 'active'),
(29, 'service', 'Car', 'Express Plus', '25000', 'Express Plus.jpg', 'Layanan cuci mobil prima dengan treatmen untuk exterior dan interior mobil anda', NULL, 'active'),
(30, 'service', 'Motorcycle', 'Express Bike', '11000', 'Express Bike.jpg', 'Layanan Cuci Motor 10 ribuan', NULL, 'active'),
(31, 'service', 'Motorcycle', 'Express 250', '15000', 'Express 250.jpg', 'Layanan cuci motor untuk motor 250cc', NULL, 'active');

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
(1, 'Administrator', 'admin@washinngarage.com', 'n/a', 'admin', 'admin', '$2y$10$o.Pnh051BudSekKDe1tmM.9wE1j7dtUHftovikPH0wNK9DZ9/0noK'),
(2, 'Wash Inn Crew', 'pisangbenyek0@gmail.com', '628979565131', 'operator', 'operator', '$2y$10$j4n6F00paRuUZSSR/V2C5.7pu.oou3PTgk0vFzmRUzW1w4ITBpOWi'),
(3, 'Ibrahim', 'ibrahim@gmail.com', 'n/a', 'ibrahim23', 'operator', '$2y$10$NOKoM1TDkrTqF1Z.NAkUx.9zcu0PqIyVop.LFDI5pVbvSzsn.Y3ra'),
(8, 'Andi Lisandi', 'fikri.droid16@gmail.com', '628979565131', 'andilisandi', 'operator', '$2y$10$kXroDnUpr0zrw7jq74uTZeOLh/LDgipXkEtXDGSeuQ5FCp9HuXWX.'),
(11, 'Abdul Rojak', 'site.karcisku@gmail.com', '38276423', 'abdulrojali', 'operator', '$2y$10$0zrIYG1iTHayMMDeOv4FGOWk.seuDe/nRT1nCVTfk8r8KmxwUqBcO'),
(15, 'Bukan Administrator ke 2', 'pisangbenyek0@gmail.com', '6281295127634', 'adminke2', 'operator', '$2y$10$f0PndkNQGllaKpJDclQ7.ej9Rqv/ujFY.41IpYZhCqK4EP68lMca2'),
(21, 'Abdul Fattah', 'pisangbenyek0@gmail.com', '26626262', 'abdulfattah', 'admin', '$2y$10$A5kx6rwzDiaCcldYhvKRU.mg8gWSs6mtWGRIgN0Fbq2ZFMez.64N6'),
(22, 'Developer Account', 'pisangbenyek0@gmail.com', '6281299648963', 'dev', 'admin', '$2y$10$mweySBnxh8MbGCKY8t6TbOrcmuE6LdGd/8N1Ah7byQxwTnJOM2VwW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
