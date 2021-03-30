-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Mar 30, 2021 at 09:51 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(8, 'Admin', 'User', 'admin@cse340.net', '$2y$10$p0l1P4PJmaHpUNFMviqjP.xwMTZtv5k6Wp/XhugERcBk/uRbHsCG2', '3', NULL),
(13, 'Zachary', 'Hull', '999hull86@gmail.com', '$2y$10$/fgHOSkclWAddG/cIJMHqOwBEITDkqnUkCtCRYJ9YEIKeVOGqIcUC', '1', NULL),
(15, 'Zachary', 'Hull', 'hull86@gmail.com', '$2y$10$ckfh9QtUD5T.8XVH9xcpG.9C8R4aKj1eNmyhOFXn.IeYjT0m7.cCm', '1', NULL),
(16, 'Melissa', 'Hull', 'melissahull87@gmail.com', '$2y$10$0u3OCAoZk4JMNIEP09SfU.1XnwSJtab6DMPGe33b0Es9eOJx28fS6', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgid` int UNSIGNED NOT NULL,
  `invid` int UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgid`, `invid`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(101, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-03-19 01:34:36', 1),
(102, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-03-19 01:34:36', 1),
(107, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-03-19 01:35:13', 1),
(108, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-03-19 01:35:13', 1),
(117, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-03-19 01:36:24', 1),
(118, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-03-19 01:36:24', 1),
(119, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-03-19 01:37:42', 1),
(120, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-03-19 01:37:42', 1),
(123, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-03-19 01:39:00', 1),
(124, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-03-19 01:39:00', 1),
(131, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-03-19 01:40:41', 1),
(132, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-03-19 01:40:41', 1),
(133, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-03-19 01:41:06', 1),
(134, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-03-19 01:41:06', 1),
(135, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-03-19 01:41:14', 1),
(136, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-03-19 01:41:14', 1),
(137, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2021-03-19 01:41:27', 1),
(138, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2021-03-19 01:41:27', 1),
(139, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-03-19 01:41:39', 1),
(140, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-03-19 01:41:39', 1),
(141, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-03-19 01:42:00', 1),
(142, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-03-19 01:42:00', 1),
(143, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-03-19 01:42:09', 1),
(144, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-03-19 01:42:09', 1),
(145, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-03-19 01:42:18', 1),
(146, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-03-19 01:42:18', 1),
(147, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-03-19 01:42:30', 1),
(148, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-03-19 01:42:30', 1),
(149, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-03-19 01:42:45', 1),
(150, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-03-19 01:42:45', 1),
(151, 19065, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-03-19 01:42:55', 1),
(152, 19065, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-03-19 01:42:55', 1),
(153, 2, 'modeltfront.jpg', '/phpmotors/images/vehicles/modeltfront.jpg', '2021-03-20 18:19:27', 0),
(154, 2, 'modeltfront-tn.jpg', '/phpmotors/images/vehicles/modeltfront-tn.jpg', '2021-03-20 18:19:27', 0),
(155, 4, 'monster-truck-2578685_640.jpg', '/phpmotors/images/vehicles/monster-truck-2578685_640.jpg', '2021-03-20 18:19:42', 0),
(156, 4, 'monster-truck-2578685_640-tn.jpg', '/phpmotors/images/vehicles/monster-truck-2578685_640-tn.jpg', '2021-03-20 18:19:42', 0),
(157, 4, 'monstertrucktire.jpg', '/phpmotors/images/vehicles/monstertrucktire.jpg', '2021-03-20 18:19:52', 0),
(158, 4, 'monstertrucktire-tn.jpg', '/phpmotors/images/vehicles/monstertrucktire-tn.jpg', '2021-03-20 18:19:52', 0),
(159, 4, 'toys-4565719_640.jpg', '/phpmotors/images/vehicles/toys-4565719_640.jpg', '2021-03-20 18:20:02', 0),
(160, 4, 'toys-4565719_640-tn.jpg', '/phpmotors/images/vehicles/toys-4565719_640-tn.jpg', '2021-03-20 18:20:02', 0),
(163, 1, 'jeepheadlight.jpg', '/phpmotors/images/vehicles/jeepheadlight.jpg', '2021-03-20 18:23:53', 0),
(164, 1, 'jeepheadlight-tn.jpg', '/phpmotors/images/vehicles/jeepheadlight-tn.jpg', '2021-03-20 18:23:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045.00', 1, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it&#39;s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000.00', 3, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100.00', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000.00', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000.00', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000.00', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000.00', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000.00', 1, 'Brown', 2),
(19065, 'DMC', 'DeLorean', 'Time Traveler&#39;s Special', '/phpmotors/images/vehicles/delorean.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '54000.00', 1, 'Gray', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int UNSIGNED NOT NULL,
  `clientId` int UNSIGNED NOT NULL,
  `invId` int UNSIGNED NOT NULL,
  `reviewdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `clientId`, `invId`, `reviewdate`, `review`) VALUES
(2, 16, 6, '2021-03-25 22:03:21', '\r\nfun.'),
(3, 16, 6, '2021-03-25 22:04:49', 'Super fast. Super fun.'),
(4, 16, 19065, '2021-03-29 21:46:36', 'Time travel!'),
(7, 16, 6, '2021-03-30 20:10:18', 'Batman'),
(8, 16, 6, '2021-03-30 20:10:54', 'testing ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgid`),
  ADD KEY `FK_inv_images` (`invid`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`) USING BTREE,
  ADD KEY `FK_client_id` (`clientId`),
  ADD KEY `FK_inv_id` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19067;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invid`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_client_id` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inv_id` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
