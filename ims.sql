-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 02:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(100) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `adminPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `adminName`, `adminPassword`) VALUES
(1, 'IMSAdmin', '0123');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `quantity`) VALUES
(4, 'Mouse', 18),
(5, 'Keyboard', 22),
(6, 'Graphics Card', 12),
(8, 'Monitor', 15),
(9, 'Laptop', 8);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(100) NOT NULL,
  `purchaseDate` date NOT NULL,
  `productName` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `purchaseDate`, `productName`, `quantity`, `supplier`) VALUES
(2, '2024-05-21', 'Graphics Card', 12, 'Amrit Supplier'),
(3, '2024-05-20', 'Keyboard', 22, 'Dipesh Suppp'),
(4, '2024-05-21', 'Monitor', 8, 'Suyog Traders'),
(5, '2024-05-20', 'Monitor', 6, 'Apple Store');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesID` int(100) NOT NULL,
  `salesDate` date NOT NULL,
  `productName` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `buyer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesID`, `salesDate`, `productName`, `quantity`, `buyer`) VALUES
(3, '2024-05-20', 'Mouse', 2, 'Satkar Sub'),
(4, '2024-05-20', 'Keyboard', 4, 'Ram Hari'),
(5, '2024-05-21', 'Monitor', 3, 'Harama');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(100) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierEmail` varchar(100) NOT NULL,
  `supplierAddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `supplierEmail`, `supplierAddress`) VALUES
(1, 'Dipesh Suppp', 'Dip@g.com', 'Koliya'),
(2, 'Amrit Supplier', 'amr@g.com', 'Koliya'),
(3, 'Suyog Traders', 'suyog@trader.com', 'Thori'),
(4, 'Apple Store', 'contact@apple.com', 'Bharatpur');

-- --------------------------------------------------------

--
-- Table structure for table `userregister`
--

CREATE TABLE `userregister` (
  `fullName` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`fullName`, `userName`, `email`, `password`) VALUES
('Bibek Pandey', 'Bibek365', 'bib365@gmail.com', '$2y$10$2sw1eBBtCtBFmOchMWsI5uJG18lfQ6iQqkxzq3ZF3qGTetdpFVZiu'),
('Hari Laal', 'Haal', 'haal@g.com', '$2y$10$gDw74Q.o80zb2N2gG5XUUOZtC8uArgn2lLWOVVdGTvcMI7rt2qEe6'),
('Ram Kumar', 'Ram1', 'ram1@gmail.com', '$2y$10$bHMLCiGzs7MRkgxjUn9i3ewj1VSOUandioxrGdq/nxHSicBGw8PmC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productName` (`productName`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `userregister`
--
ALTER TABLE `userregister`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
