-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2023 at 09:42 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20104436_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(20) UNSIGNED NOT NULL,
  `gender` enum('male','female') NOT NULL COMMENT 'm => male\r\nf => female',
  `age` tinyint(3) UNSIGNED NOT NULL,
  `role` enum('user','admin','superadmin') NOT NULL,
  `image` blob DEFAULT NULL,
  `country` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `national_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `gender`, `age`, `role`, `image`, `country`, `city`, `created_at`, `updated_at`, `national_id`) VALUES
(37, 'adel el3raky', 'kameladel339@gmail.com', 1554138144, 'male', 22, 'superadmin', NULL, 'egypt', 'elmahalla', '2023-01-04 02:12:13', '2023-01-05 18:35:07', 30101201601814),
(41, 'alo', 'aklsdf@deaio.com', 1236548957, 'male', 22, 'admin', NULL, 'egypt', 'ijpgs', '2023-01-05 15:12:35', '2023-01-05 17:19:54', 35648795210325),
(45, 'Saif Waleed', 'swaifweaa@gmail.com', 1097232046, 'male', 21, 'user', NULL, 'Egypt', 'Mansoura', '2023-01-06 07:14:26', NULL, 30110011231653);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
