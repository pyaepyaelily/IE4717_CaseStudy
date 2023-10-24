-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 05:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `javajam`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `name` char(50) NOT NULL,
  `des` char(255) NOT NULL,
  `type` char(100) NOT NULL,
  `price` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`name`, `des`, `type`, `price`) VALUES
('Just Java', 'Regular house blend, decaffeinated coffee, or flavor of the day.', 'Endless Cup', '2.00'),
('Cafe au Lait', 'House blended coffee infused into a smooth steamed milk.', 'Single', '2.00'),
('Cafe au Lait', 'House blended coffee infused into a smooth steamed milk.', 'Double', '3.00'),
('Iced Cappuccino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass.', 'Single', '4.75'),
('Iced Cappuccino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass.', 'Double', '5.75');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `name` char(50) NOT NULL,
  `type` char(100) NOT NULL,
  `price` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `type`, `price`) VALUES
('Just Java', 'Endless Cup', '6.00'),
('Cafe au Lait', 'Single', '2.00'),
('Cafe au Lait', 'Double', '4.00'),
('Iced Cappuccino', 'Single', '4.75'),
('Iced Cappuccino', 'Double', '5.75');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
