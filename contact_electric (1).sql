-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 08:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_electric`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_logo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_logo`) VALUES
(1, 'Generac', NULL),
(2, 'Cummins', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_first_name` varchar(25) NOT NULL,
  `contact_last_name` varchar(50) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_street` varchar(255) NOT NULL,
  `contact_zip` varchar(18) NOT NULL,
  `contact_city` varchar(50) NOT NULL,
  `contact_state` varchar(2) NOT NULL,
  `contact_site_street` varchar(255) NOT NULL,
  `contact_site_zip` varchar(18) NOT NULL,
  `contact_site_city` varchar(50) NOT NULL,
  `contact_site_state` varchar(2) NOT NULL,
  `contact_submit_date` datetime NOT NULL,
  `contact_contacted_date` datetime DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_first_name`, `contact_last_name`, `contact_phone`, `contact_street`, `contact_zip`, `contact_city`, `contact_state`, `contact_site_street`, `contact_site_zip`, `contact_site_city`, `contact_site_state`, `contact_submit_date`, `contact_contacted_date`, `service_id`, `brand_id`, `product_id`) VALUES
(1, 'Gael', 'Rueda', '417-123-1342', '8598 BrookSide Str', '65708', 'Monett', 'MO', '8237 FreeWay Cir', '28371', 'Granby', 'MO', '2024-12-09 07:26:30', '2024-12-09 07:30:26', 0, 0, 0),
(2, 'Joe ', 'Bob', '123-231-1212', '1234 brook', '45356', 'Monett', 'FL', '1234 Books', '23124', 'Branson', 'KS', '2024-12-04 08:51:24', '2024-12-09 07:30:48', 0, 0, 0),
(3, 'Joe ', 'Bob', '123-231-1212', '1234 brook', '45356', 'Monett', 'FL', '1234 Books', '23124', 'Branson', 'KS', '2024-12-04 08:51:38', NULL, 0, 0, 0),
(4, 'Gael', 'R', '123-122-1234', '1231 btook', '12324', 'Monett', 'IN', 'frwfrv 56', '34325', 'free', 'NE', '2024-12-04 08:57:46', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_username` varchar(30) NOT NULL,
  `employee_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_username`, `employee_password`) VALUES
(1, 'admin', '$2y$10$M6ECixec9fQMgyFXAL43mOI88DXrwjsjMZVSNe8hOv8W/.ThHY0la'),
(5, 'emp1', '$2y$10$HRfp1PCRowKHAYs/fJHRwOQBnS7JTy1Iqawrl7btmPbOke1CfQkRe'),
(6, 'emp2', '$2y$10$LkIukY8ep6GnhsOcE9NaVe.sjbH5X/4LNBLPS1cS13UivMFSI4gTy');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL COMMENT 'input fk',
  `product_name` varchar(255) NOT NULL,
  `product_type_id` int(11) NOT NULL COMMENT 'input fk',
  `product_desc` tinytext NOT NULL,
  `product_img` int(11) DEFAULT NULL,
  `product_intended_use` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `brand_id`, `product_name`, `product_type_id`, `product_desc`, `product_img`, `product_intended_use`) VALUES
(1, 1, 'T Series', 2, 'Cool stuff', NULL, 'asdfssdfds'),
(2, 2, '', 2, 'asdsadasd', NULL, 'asdassdasdsa');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `product_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `product_type_name`) VALUES
(1, 'Generator'),
(2, 'Powerwasher');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_type`) VALUES
(1, 'Generator Repair'),
(2, 'Generator Install');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Brand` (`brand_id`),
  ADD KEY `Product_Type` (`product_type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `Product_Type` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`product_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
