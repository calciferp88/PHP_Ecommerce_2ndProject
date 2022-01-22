-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 12:10 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `culturesneakerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`) VALUES
(18, 'ERKE'),
(19, 'Adidas'),
(20, 'Vans'),
(21, 'NIKE'),
(22, 'TimberLand'),
(23, 'Balenciaga');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `Category`) VALUES
(14, 'Pillsmoll'),
(15, 'Boosts'),
(16, 'Slip On'),
(17, 'School '),
(18, 'Leather '),
(19, 'Shoe');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(30) NOT NULL,
  `Address` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `Email`, `PhoneNo`, `Address`, `Password`) VALUES
(21, 'Pyae Thuta', 'pyaethuta881@gmail.com', '09  787878', 'Yangon, Thingangyun, Yadana Rd, Myawittyee St', '228b524fc083637709130b63056562dc'),
(22, 'ivan@gmail.com', 'ivan@gmail.com', '09 7655332112', 'Thingangyun, Yangon', '2c42e5cf1cdbafea04ed267018ef1511');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` varchar(30) NOT NULL,
  `OrderID` varchar(30) NOT NULL,
  `StaffID` int(10) NOT NULL,
  `DeliveryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `OrderID`, `StaffID`, `DeliveryDate`) VALUES
('DeliID_000001', 'ORID_000001', 16, '2020-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` varchar(50) NOT NULL,
  `CustomerID` int(30) NOT NULL,
  `Address` text NOT NULL,
  `PhoneNo` varchar(30) NOT NULL,
  `OrderDate` date NOT NULL,
  `TotalPrice` float NOT NULL,
  `PaymentType` varchar(50) NOT NULL,
  `CardNumber` varchar(50) NOT NULL,
  `SecurityCode` int(10) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CustomerID`, `Address`, `PhoneNo`, `OrderDate`, `TotalPrice`, `PaymentType`, `CardNumber`, `SecurityCode`, `Status`) VALUES
('ORID_000001', 21, 'Yangon, Thingangyun, Yadana Rd, Myawittyee St', '09  787878', '2020-05-30', 1702, 'Visa', '11112222333344445555', 2147483647, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `ordersneaker`
--

CREATE TABLE `ordersneaker` (
  `OrderID` varchar(50) NOT NULL,
  `SneakerID` int(30) NOT NULL,
  `Quantity` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordersneaker`
--

INSERT INTO `ordersneaker` (`OrderID`, `SneakerID`, `Quantity`) VALUES
('ORID_000001', 43, 2),
('ORID_000001', 41, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseID` varchar(50) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `TotalPrice` int(30) NOT NULL,
  `StaffID` int(30) NOT NULL,
  `SupplierID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseID`, `PurchaseDate`, `TotalPrice`, `StaffID`, `SupplierID`) VALUES
('PurID_000001', '2020-05-30', 44060, 12, 3),
('PurID_000002', '2020-05-30', 7689, 12, 2),
('PurID_000003', '2020-05-30', 2976, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchasesneaker`
--

CREATE TABLE `purchasesneaker` (
  `PurchaseID` varchar(30) NOT NULL,
  `SneakerID` int(30) NOT NULL,
  `Quantity` int(30) NOT NULL,
  `TotalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasesneaker`
--

INSERT INTO `purchasesneaker` (`PurchaseID`, `SneakerID`, `Quantity`, `TotalPrice`) VALUES
('PurID_000001', 40, 20, 4660),
('PurID_000001', 41, 40, 24800),
('PurID_000001', 42, 20, 12400),
('PurID_000001', 43, 30, 1560),
('PurID_000001', 44, 20, 640),
('PurID_000002', 40, 33, 7689),
('PurID_000003', 45, 32, 2976);

-- --------------------------------------------------------

--
-- Table structure for table `sneaker`
--

CREATE TABLE `sneaker` (
  `SneakerID` int(11) NOT NULL,
  `SneakerName` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `BuyPrice` float NOT NULL,
  `SellStockPrice` float NOT NULL,
  `InstockQTY` int(11) NOT NULL,
  `Image` text NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sneaker`
--

INSERT INTO `sneaker` (`SneakerID`, `SneakerName`, `Description`, `BuyPrice`, `SellStockPrice`, `InstockQTY`, `Image`, `CategoryID`, `BrandID`) VALUES
(40, 'Adidas Supersta', '<p>Adidas Super is still trending</p>\r\n\r\n<p>Because of&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Light and comfort</li>\r\n	<li>Strong and good look</li>\r\n</ul>\r\n', 233, 255, 53, '../sneaker/_sn1.jpeg', 19, 19),
(41, 'Adidas Yeezy Boost 700 Salt', '<p>The adidas Yeezy Boost 700 &quot;Salt&quot; is the third colorway released of Kanye West&rsquo;s famous chunky runner. The silhouette features a clean all-grey &ldquo;Salt&rdquo; upper built of premium leather and suede with a mesh base. Like the previous two colorways, the Yeezy 700 &ldquo;Salt&rdquo; also includes reflective detailing for the oval-shaped accents on the heel and Three Stripes branding hidden under the mesh panels on the midfoot. The tonal grey look is contrasted with just a touch of black on the midsole, as well as the rubber outsole. The adidas Yeezy Boost 700 &quot;Salt&quot; released on February 23, 2019, in limited quantities, making them yet another coveted sneaker from Kanye and adidas.</p>\r\n\r\n<ul>\r\n	<li>Manufactured by&nbsp;<strong>ADIDAS</strong></li>\r\n	<li>Department :&nbsp;Mens</li>\r\n</ul>\r\n', 620, 789, 38, '../sneaker/_sn4.jpeg', 15, 19),
(43, 'Vans Unisex Old Skool', '<p>The Vans Old Skool, with the iconic side stripe, is a low top lace-up with re-enforced toecaps to withstand repeated wear, signature rubber waffle outsoles, and padded collars for support and flexibility.</p>\r\n\r\n<ul>\r\n	<li>For Men &amp; Women</li>\r\n	<li>All size available</li>\r\n	<li>Product by VANS</li>\r\n</ul>\r\n', 52, 62, 28, '../sneaker/_sn5.jpeg', 14, 20),
(44, 'Vans Classic Slip-On', '<p>The Vans Old Skool, with the iconic side stripe, is a low top lace-up with re-enforced toecaps to withstand repeated wear, signature rubber waffle outsoles, and padded collars for support and flexibility.</p>\r\n\r\n<ul>\r\n	<li>For Men &amp; Women</li>\r\n	<li>Product by VANS</li>\r\n	<li>All size available</li>\r\n</ul>\r\n', 32, 50, 20, '../sneaker/_sn6.jpeg', 16, 20),
(45, 'NIKE Air Force 1', '<p>Nike air force 1 mid &#39;07 for men is a streetwear legend. First made in 1982, now still modern, he can wear this shoe as a classic sneaker or basketball shoe. More features: leather upper, mid collar keeps your ankle covered, perforations provide ventilation, foam sole includes encapsulated air cushioning, non-marking rubber outsole for traction and durability, padding at collar for a snug, comfortable fit.</p>\r\n\r\n<ul>\r\n	<li>Department:&nbsp;Mens</li>\r\n	<li>Manufacturer:&nbsp;NIKE</li>\r\n</ul>\r\n', 93, 109, 32, '../sneaker/_sn9.jpeg', 15, 21),
(47, 'Adidas Ultraboost', '<ul>\r\n	<li>100&nbsp;leather</li>\r\n	<li>Imported</li>\r\n	<li>Synthetic sole</li>\r\n	<li>Shaft measures app</li>\r\n</ul>\r\n', 300, 359, 0, '../sneaker/_sn3.jpeg', 15, 19);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(11) NOT NULL,
  `staffname` varchar(50) NOT NULL,
  `staffemail` varchar(50) NOT NULL,
  `staffphone` varchar(20) NOT NULL,
  `role` varchar(30) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `staffemail`, `staffphone`, `role`, `password`) VALUES
(12, 'Pyae Thuta', 'pyaethuta881@gmail.com', '09787878789', 'Manager', '249e9b262165def72454a66ca04c93d3'),
(13, 'Thuta Sann', 'thutasann@gmail.com', '09 443145218', 'General Staff', '249e9b262165def72454a66ca04c93d3'),
(14, 'Hsu Myat Win', 'hmw2002@gmail.com', '09 441278661', 'Admin', '249e9b262165def72454a66ca04c93d3'),
(15, 'Kyaw Kyaw Linn', 'kyawkl@gmail.com', '09 7876543', 'Admin', '249e9b262165def72454a66ca04c93d3'),
(16, 'Kaung Myat', 'kmyat@gmail.com', '09 652245511', 'Delivery Staff', '3a05c15df913d2eb2ea6924ec3848401');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(30) NOT NULL,
  `SupplierName` varchar(50) NOT NULL,
  `CompanyName` varchar(50) NOT NULL,
  `ContactNo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `CompanyName`, `ContactNo`) VALUES
(2, 'Min Thuta', 'Min Sneaker Distribution', '09 2553312'),
(3, 'Hsu Myat ', 'Haweii Sneaker', '09 77812366'),
(4, 'Moe Moe ', 'TBZ Company Limited', '096444111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Indexes for table `sneaker`
--
ALTER TABLE `sneaker`
  ADD PRIMARY KEY (`SneakerID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sneaker`
--
ALTER TABLE `sneaker`
  MODIFY `SneakerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
