-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 05:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermart`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_bill`
--

CREATE TABLE `customer_bill` (
  `id` int(20) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  `without_gst` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `cash` float DEFAULT NULL,
  `upi` float DEFAULT NULL,
  `card` float DEFAULT NULL,
  `entry_date_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_bill`
--

INSERT INTO `customer_bill` (`id`, `customer_id`, `billdate`, `without_gst`, `amount`, `user_id`, `cash`, `upi`, `card`, `entry_date_time`) VALUES
(1, NULL, '2022-12-21', 8.93, 10, '13', 10, 0, 0, '2022-12-20 18:30:00'),
(2, 1, '2022-12-21', 30, 30, '13', 30, 0, 0, '2022-12-20 18:30:00'),
(3, 1, '2022-12-20', 8.93, 10, '13', 10, 0, 0, '2022-12-20 18:30:00'),
(4, 1, '2022-12-21', 200, 200, '13', 190, 10, 0, '2022-12-21 11:10:05'),
(5, 1, '2022-12-21', 230, 230, '13', 200, 30, 0, '2022-12-21 11:14:13'),
(6, 0, '2022-12-21', 141.64, 165, '13', 150, 15, 0, '2022-12-21 11:18:32'),
(7, 1, '2022-12-21', 17.86, 20, '13', 20, 0, 0, '2022-12-21 11:23:23'),
(8, 2, '2022-12-21', 8.93, 10, '13', 10, 0, 0, '2022-12-21 11:24:11'),
(9, 2, '2022-12-21', 17.86, 20, '13', 20, 0, 0, '2022-12-21 11:24:59'),
(10, 0, '2022-12-21', 8.93, 10, '13', 10, 0, 0, '2022-12-21 11:26:25'),
(11, 0, '2022-12-21', 35.71, 40, '13', 40, 0, 0, '2022-12-21 13:00:04'),
(12, 0, '2022-12-29', 35.71, 40, '13', 40, 0, 0, '2022-12-21 13:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_bill_details`
--

CREATE TABLE `customer_bill_details` (
  `id` int(20) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `hsn` int(100) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `without_gst` float DEFAULT NULL,
  `gst_percentage` float DEFAULT NULL,
  `bill_no` int(11) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `entry_date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_bill_details`
--

INSERT INTO `customer_bill_details` (`id`, `employee_id`, `product_id`, `product_name`, `hsn`, `rate`, `qty`, `amount`, `without_gst`, `gst_percentage`, `bill_no`, `bill_date`, `entry_date_time`) VALUES
(1, 14, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, NULL, NULL, '2022-12-21 02:19:57'),
(6, 13, 6, 'Parle G 500Gm', 123465, 10, 3, 75, 75, 12, 16, '2022-12-21', '2022-12-21 04:51:41'),
(8, 13, 3, 'KURKURE', 1214151613, 25, 3, 75, 75, 18, 16, '2022-12-21', '2022-12-21 06:45:09'),
(9, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 16, '2022-12-21', '2022-12-21 06:57:40'),
(10, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 16, '2022-12-21', '2022-12-21 06:58:42'),
(11, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 16, '2022-12-21', '2022-12-21 06:59:38'),
(12, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 16, '2022-12-21', '2022-12-21 07:03:00'),
(13, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 1, '2022-12-21', '2022-12-21 07:10:18'),
(14, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 1, '2022-12-21', '2022-12-21 07:10:55'),
(15, 13, 6, 'Parle G 500Gm', 123465, 10, 3, 30, 30, 12, 2, '2022-12-21', '2022-12-21 09:44:53'),
(16, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 3, '2022-12-20', '2022-12-21 10:25:45'),
(17, 13, 6, 'Parle G 500Gm', 123465, 10, 4, 100, 100, 12, 4, '2022-12-21', '2022-12-21 11:03:56'),
(18, 13, 3, 'KURKURE', 1214151613, 25, 4, 100, 100, 18, 4, '2022-12-21', '2022-12-21 11:04:18'),
(23, 13, 3, 'KURKURE', 1214151613, 25, 6, 150, 150, 18, 5, '2022-12-21', '2022-12-21 11:13:39'),
(24, 13, 6, 'Parle G 500Gm', 123465, 10, 8, 80, 80, 12, 5, '2022-12-21', '2022-12-21 11:13:50'),
(27, 13, 3, 'KURKURE', 1214151613, 25, 5, 125, 105.93, 18, 6, '2022-12-21', '2022-12-21 11:18:13'),
(28, 13, 6, 'Parle G 500Gm', 123465, 10, 4, 40, 35.71, 12, 6, '2022-12-21', '2022-12-21 11:18:19'),
(29, 13, 6, 'Parle G 500Gm', 123465, 10, 2, 20, 17.86, 12, 7, '2022-12-21', '2022-12-21 11:22:24'),
(30, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 8, '2022-12-21', '2022-12-21 11:24:02'),
(31, 13, 6, 'Parle G 500Gm', 123465, 10, 2, 20, 17.86, 12, 9, '2022-12-21', '2022-12-21 11:24:56'),
(32, 13, 6, 'Parle G 500Gm', 123465, 10, 1, 10, 8.93, 12, 10, '2022-12-21', '2022-12-21 11:26:21'),
(34, 13, 6, 'Parle G 500Gm', 123465, 10, 4, 40, 35.71, 12, 11, '2022-12-21', '2022-12-21 12:59:55'),
(35, 13, 6, 'Parle G 500Gm', 123465, 10, 4, 40, 35.71, 12, 12, '2022-12-21', '2022-12-21 13:00:30'),
(36, 13, 3, 'KURKURE', 1214151613, 25, 2, 50, 42.37, 18, NULL, NULL, '2022-12-29 16:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `name`, `city`, `mobile`) VALUES
(1, 'Hemant Divekar', 'Kolhapur', '8007002203'),
(2, 'Hemant Divekar', 'Kolhapur', '08007002203');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `hsn` varchar(50) DEFAULT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `purchase_price` double NOT NULL,
  `product_weight` varchar(50) NOT NULL,
  `Net_weight` varchar(50) NOT NULL,
  `manufacturing_date` date DEFAULT NULL,
  `Expiry_date` date DEFAULT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `gst`, `hsn`, `barcode`, `selling_price`, `purchase_price`, `product_weight`, `Net_weight`, `manufacturing_date`, `Expiry_date`, `quantity`) VALUES
(3, 'KURKURE', '18', '1214151613', '2147483647', 25, 7, '100 gram', '100 gram', '0000-00-00', '0000-00-00', 500),
(6, 'Parle G 500Gm', '12', '123465', '1234', 10, 0, '510', '500 gm', '2022-12-20', '2024-01-15', 8);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bill`
--

CREATE TABLE `purchase_bill` (
  `id` int(20) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  `without_gst` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `cash` float DEFAULT NULL,
  `upi` float DEFAULT NULL,
  `card` float DEFAULT NULL,
  `entry_date_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_bill`
--

INSERT INTO `purchase_bill` (`id`, `vendor_id`, `billdate`, `without_gst`, `amount`, `user_id`, `cash`, `upi`, `card`, `entry_date_time`) VALUES
(1, 17, '2022-12-28', 48.56, 56.5, '13', 56.5, 0, 0, '2022-12-28 18:03:31'),
(2, 17, '2022-12-29', 231.36, 273, '13', 273, 0, 0, '2022-12-29 16:11:12'),
(3, 7, '2022-12-29', 152.54, 180, '13', 180, 0, 0, '2022-12-29 16:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bill_details`
--

CREATE TABLE `purchase_bill_details` (
  `id` int(20) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `hsn` int(100) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `without_gst` float DEFAULT NULL,
  `gst_percentage` float DEFAULT NULL,
  `bill_no` int(11) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `entry_date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_bill_details`
--

INSERT INTO `purchase_bill_details` (`id`, `employee_id`, `product_id`, `product_name`, `hsn`, `rate`, `qty`, `amount`, `without_gst`, `gst_percentage`, `bill_no`, `bill_date`, `entry_date_time`) VALUES
(25, 13, 3, 'KURKURE', 1214151613, 4.15, 10, 41.5, 35.17, 18, 1, '2022-12-28', '2022-12-28 18:01:19'),
(26, 13, 6, 'Parle G 500Gm', 123465, 5, 3, 15, 13.39, 12, 1, '2022-12-28', '2022-12-28 18:03:20'),
(27, 13, 3, 'KURKURE', 1214151613, 13, 21, 273, 231.36, 18, 2, '2022-12-29', '2022-12-29 16:10:40'),
(28, 13, 3, 'KURKURE', 1214151613, 18, 10, 180, 152.54, 18, 3, '2022-12-29', '2022-12-29 16:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(250) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `password` varchar(50) NOT NULL DEFAULT '1111',
  `dob` date DEFAULT NULL,
  `roll` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `number`, `password`, `dob`, `roll`, `address`) VALUES
(10, 'vaishnavi', 'kadam', '1234567890', '1111', '2022-12-15', 'ShopKeeper', 'pune'),
(13, 'Hemant', 'Divekar', '8007002203', '1010', '2000-01-01', 'Admin', 'Rajendranagar\r\nMahadev Nivas'),
(14, 'Hemant', 'Divekar', '9876543210', '1111', '2022-12-20', 'Cashier', 'Rajendranagar\r\nMahadev Nivas');

-- --------------------------------------------------------

--
-- Table structure for table `vender`
--

CREATE TABLE `vender` (
  `id` int(250) NOT NULL,
  `firm_name` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vender`
--

INSERT INTO `vender` (`id`, `firm_name`, `contact_name`, `gst`, `number`, `address`) VALUES
(7, 'More collection', 'anada more', '0', '8888228211', 'udyam nagar kolhapur'),
(13, 'sathe collection', 'abhishek kale', '0', '8080228211', 'kolkatta'),
(17, 'KOP Super Mart', 'Hemant Divekar', 'AZk1234321S', '8007002203', 'Kolhapur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_bill`
--
ALTER TABLE `customer_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_bill_details`
--
ALTER TABLE `customer_bill_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_bill`
--
ALTER TABLE `purchase_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_bill_details`
--
ALTER TABLE `purchase_bill_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vender`
--
ALTER TABLE `vender`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_bill`
--
ALTER TABLE `customer_bill`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_bill_details`
--
ALTER TABLE `customer_bill_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_bill`
--
ALTER TABLE `purchase_bill`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_bill_details`
--
ALTER TABLE `purchase_bill_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vender`
--
ALTER TABLE `vender`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
