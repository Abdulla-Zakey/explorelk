-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2025 at 11:33 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `explorelk_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `activity_Id` int(11) NOT NULL,
  `activity_Name` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tourPackage_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_Id`),
  KEY `tourPackage_Id` (`tourPackage_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attractions`
--

DROP TABLE IF EXISTS `attractions`;
CREATE TABLE IF NOT EXISTS `attractions` (
  `attraction_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) DEFAULT NULL,
  `attraction_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_paragraph1` text COLLATE utf8mb4_unicode_ci,
  `description_paragraph2` text COLLATE utf8mb4_unicode_ci,
  `description_paragraph3` text COLLATE utf8mb4_unicode_ci,
  `iframe` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`attraction_id`),
  KEY `district_id` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attractions`
--

INSERT INTO `attractions` (`attraction_id`, `district_id`, `attraction_name`, `description_paragraph1`, `description_paragraph2`, `description_paragraph3`, `iframe`, `image_path`) VALUES
(1, 9, 'Gregory Lake', 'Discover the serene beauty of Gregory Lake, a jewel in the heart of Nuwara Eliya. This stunning man-made lake, built in the 19th century during the British colonial era, is a perfect blend of natural charm and leisurely allure. Surrounded by rolling hills and lush greenery, it offers an idyllic escape for anyone seeking relaxation amidst nature\'s tranquility.', 'Discover the serene beauty of Gregory Lake, a jewel in the heart of Nuwara Eliya. This stunning man-made lake, built in the 19th century during the British colonial era, is a perfect blend of natural charm and leisurely allure. Surrounded by rolling hills and lush greenery, it offers an idyllic escape for anyone seeking relaxation amidst nature\'s tranquility.', 'Whether you\'re looking for adventure, relaxation, or a romantic getaway, Gregory Lake promises an unforgettable experience. Its enchanting scenery and versatile activities make it a must-visit destination in the cool, misty landscapes of Nuwara Eliya.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31683.563495645103!2d80.75773365606011!3d6.956666104786141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae380f70b675859%3A0x3362d6f28dc32189!2sLake%20Gregory!5e0!3m2!1sen!2slk!4v1731819821558!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/gregoryLake.jpg'),
(2, 9, 'Horton Plains', 'Explore the breathtaking allure of Horton Plains, a pristine highland sanctuary nestled in the heart of Sri Lankas central hills. This UNESCO World Heritage site is a haven of natural beauty, where mist-covered grasslands, cloud forests, and crystal-clear streams create an enchanting landscape. Known for its unique biodiversity, Horton Plains is home to a variety of flora and fauna, some of which are found nowhere else on earth.', 'One of the most captivating features of Horton Plains is Worlds End, a dramatic cliff with a sheer drop of over 800 meters. As you stand at the edge, the panoramic views of the verdant valleys and distant mountains are nothing short of mesmerizing. Equally captivating is Bakers Falls, a cascading waterfall surrounded by lush greenery, offering a tranquil spot for nature lovers and photography enthusiasts alike.', 'Whether you are an avid hiker, a nature enthusiast, or someone seeking solitude in a serene setting, Horton Plains offers an unforgettable escape. Its ethereal beauty, combined with the cool climate of the central highlands, makes it an essential stop for anyone exploring the enchanting landscapes of Sri Lanka.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126769.38149692012!2d80.56867579726563!3d6.825277800000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae38f535203dda3%3A0x9e2456fee60625f3!2sHorton%20Plains!5e0!3m2!1sen!2slk!4v1734026391862!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/nuwaraEliya/hortonPlains/hortonPlains.jpg'),
(3, 9, 'Victoria Park', 'Discover the enchanting charm of Victoria Park, a botanical haven nestled in the heart of Nuwara Eliya. Named after Queen Victoria to commemorate her 60th jubilee, this lush, well-manicured park is a delightful blend of natural beauty and colonial history. With vibrant flower beds, towering trees, and scenic walking paths, Victoria Park offers a refreshing escape into a serene and picturesque paradise.', 'As you wander through its winding pathways, you will be greeted by the mesmerizing sights and fragrances of seasonal blooms. The park is a sanctuary for birdwatchers too, as it hosts a variety of exotic and migratory bird species that add to its lively charm. Its cool, misty air and tranquil ponds create the perfect backdrop for a leisurely stroll or a peaceful picnic, making it an ideal spot to unwind and soak in Nuwara Eliyas enchanting ambiance.', 'Whether you are seeking a family-friendly outing, a romantic retreat, or simply a quiet moment to connect with nature, Victoria Park is a must-visit destination. Its captivating beauty and timeless elegance make it a crown jewel of Nuwara Eliya, leaving visitors with unforgettable memories and a deep desire to return to its magical embrace.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.34805808106!2d80.76591837448315!3d6.968202367836888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3805288fa714b%3A0xbb44afbf5324004c!2sVictoria%20Park%20-%20Nuwaraeliya!5e0!3m2!1sen!2slk!4v1735011491876!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/nuwaraEliya/victoriaPark/victoriaPark.jpg'),
(4, 1, 'Mihintale', 'Discover the sacred beauty of Mihintale, a revered site nestled amidst the lush hills of Sri Lankas Cultural Triangle. This ancient pilgrimage destination, believed to be the cradle of Buddhism in Sri Lanka, is a harmonious blend of spiritual significance and natural splendor.', 'Surrounded by serene landscapes and dotted with stupas, meditation caves, and ancient ruins, Mihintale offers a tranquil escape for those seeking peace and reflection. The breathtaking views from its hilltop summit provide a captivating glimpse of the countryside, making it a sanctuary for both the soul and the senses.', 'Whether you are drawn by its rich history, spiritual ambiance, or awe-inspiring scenery, Mihintale promises an unforgettable journey. Its timeless charm and profound legacy make it a must-visit destination for anyone exploring the heart of Sri Lanka.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63160.384046039784!2d80.4237823486328!3d8.350000000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afc8a602fea94e7%3A0x91aa2c8ae1175a9!2sMihintale!5e0!3m2!1sen!2slk!4v1735143556370!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/anuradhapura/mihintale/mihintale.jpg'),
(5, 1, 'Ruwanwelisaya', 'Discover the timeless magnificence of Ruwanwelisaya, a revered gem in the sacred city of Anuradhapura. Built in the 2nd century BC by King Dutugemunu, this iconic stupa stands as a testament to ancient Sri Lankan craftsmanship and spiritual devotion. Towering amidst the historic ruins, it radiates a serene beauty that captivates both pilgrims and history enthusiasts alike.', 'Encircled by white-clad devotees and framed by the lush greenery of Anuradhapura, Ruwanwelisaya offers a tranquil sanctuary that echoes the whispers of a rich Buddhist heritage. Its gleaming white dome and intricate stone carvings evoke a sense of awe and reverence, making it a place of both spiritual reflection and architectural wonder.', 'Whether you seek spiritual enlightenment, cultural enrichment, or simply a moment of peace, Ruwanwelisaya promises an unforgettable journey into the heart of Sri Lanka\'s ancient legacy. Its sacred ambiance and majestic presence make it an essential stop in the timeless landscapes of Anuradhapura.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.5138742447525!2d80.39527607501107!3d8.351001541685715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afcf590bd385055%3A0x83c9c19bb0577609!2sRuwanweli%20Seya!5e0!3m2!1sen!2slk!4v1735145407331!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/anuradhapura/ruwanweliseya/ruwanweliseya.jpg'),
(6, 1, 'Vessagiriya', 'Discover the tranquil charm of Vessagiriya, a hidden gem nestled in the ancient city of Anuradhapura. This captivating archaeological site, a part of Sri Lanka\'s rich Buddhist heritage, seamlessly blends history with the serenity of nature. Once a flourishing monastic complex, it features a network of caves that were used by monks for meditation and living centuries ago.', 'Surrounded by natural rock formations and lush greenery, Vessagiriya offers a peaceful retreat for history enthusiasts and nature lovers alike. The intricate carvings on the rock walls and the remnants of ancient stone architecture whisper tales of a bygone era.', 'Whether you are seeking a spiritual connection, a walk through history, or a moment of quiet reflection, Vessagiriya promises an experience that resonates with the soul. Its serene ambiance and timeless allure make it an essential destination in the cultural heartland of Anuradhapura.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.748260283406!2d80.38732672501084!3d8.327794291708155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afcf5b5daffffff%3A0xc24e60e66edbf618!2sVessagiriya!5e0!3m2!1sen!2slk!4v1735150181952!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/anuradhapura/vessagiriya/vessagiriya.jpg'),
(7, 2, 'Dunhinda Falls', 'Unveil the captivating beauty of Dunhinda Falls, one of Sri Lankas most iconic waterfalls, nestled in the lush greenery of the Badulla District. Known for its misty spray resembling a veil. This breathtaking cascade drops gracefully from a height of 64 meters, creating a mesmerizing spectacle of water and nature.', 'A scenic trek through verdant forests and along a winding trail leads you to this natural marvel, offering glimpses of exotic flora and fauna along the way. The sound of rushing water grows louder as you approach, building anticipation for the magnificent view that awaits.', 'Whether you are a nature enthusiast or a photography lover, Dunhinda Falls provides an unforgettable experience. Its serene surroundings and enchanting atmosphere make it an ideal destination for relaxation and exploration in the heart of Sri Lanka\'s highlands.\r\n\r\n', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7919.800843693119!2d81.05538139129496!3d7.02099022192256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae489128c5dab27%3A0x6ba769480f37b6fa!2sDunhinda%20Waterfall!5e0!3m2!1sen!2slk!4v1735183916544!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/badhulla/dunhindaFalls/dunhindaFalls.jpg'),
(8, 2, 'Ella Rock', 'Immerse yourself in the panoramic vistas of Ella Rock, a trekking paradise in the picturesque town of Ella. This iconic hiking spot offers a rewarding adventure for those seeking breathtaking views of rolling hills, tea plantations, and mist-covered valleys.', 'The journey to Ella Rock begins with a peaceful walk through local villages, lush greenery, and railway tracks, culminating in a moderately challenging ascent. Once at the summit, you will be greeted with sweeping landscapes that capture the essence of Sri Lankas hill country, making the effort entirely worthwhile.', 'Whether you are an avid hiker or a casual traveler, Ella Rock promises an unforgettable experience. It is the perfect place to connect with nature, enjoy a peaceful retreat, and marvel at the islands natural splendor.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.930336877587!2d81.03182828176091!3d6.862706090171939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae465c0fe922235%3A0xf370ad6d3d2303c9!2sElla%20rock%20trail!5e0!3m2!1sen!2slk!4v1735184569753!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/badhulla/ellaRock/ellaRock.png'),
(9, 2, 'Lipton Seat', 'Step into the legacy of Sri Lankas tea history at Liptons Seat, a spectacular viewpoint in the hills near Haputale. Named after Sir Thomas Lipton, this serene spot offers unparalleled views of emerald tea estates, rolling hills, and distant mountains.', 'The journey to Liptons Seat is as enchanting as the destination, with winding roads through lush tea plantations and an opportunity to witness the everyday lives of local tea pluckers. Once you arrive, the breathtaking scenery and cool, crisp air provide a tranquil escape from the hustle and bustle of daily life.', 'Whether you are a tea lover, a history enthusiast, or simply in search of stunning vistas, Liptons Seat is a must-visit destination. Its peaceful charm and rich heritage make it a place that lingers in the hearts of all who visit.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.9096500883265!2d81.0129318749952!3d6.780849793216198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae46e34030893af:0x3886114faff7476b!2sLipton\'s%20Seat!5e0!3m2!1sen!2slk!4v1735185455494!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/liptonSeat.webp');

-- --------------------------------------------------------

--
-- Table structure for table `attraction_pics`
--

DROP TABLE IF EXISTS `attraction_pics`;
CREATE TABLE IF NOT EXISTS `attraction_pics` (
  `attraction_pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `attraction_id` int(11) DEFAULT NULL,
  `image_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`attraction_pic_id`),
  KEY `attraction_id` (`attraction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attraction_pics`
--

INSERT INTO `attraction_pics` (`attraction_pic_id`, `attraction_id`, `image_location`) VALUES
(1, 1, 'assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/Image5.jpg'),
(2, 1, 'assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/Image1.jpg'),
(3, 1, 'assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/Image7.jpg'),
(4, 1, 'assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/Image8.jpg'),
(5, 1, 'assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/Image4.jpg'),
(6, 2, 'assets/images/Travelers/topDistricts/nuwaraEliya/hortonPlains/Image1.jpg'),
(7, 2, 'assets/images/Travelers/topDistricts/nuwaraEliya/hortonPlains/Image2.jpg'),
(8, 2, 'assets/images/Travelers/topDistricts/nuwaraEliya/hortonPlains/Image3.jpg'),
(9, 2, 'assets/images/Travelers/topDistricts/nuwaraEliya/hortonPlains/Image4.jpg'),
(10, 2, 'assets/images/Travelers/topDistricts/nuwaraEliya/hortonPlains/Image5.webp'),
(11, 3, 'assets/images/Travelers/topDistricts/nuwaraEliya/victoriaPark/Image1.jpg'),
(12, 3, 'assets/images/Travelers/topDistricts/nuwaraEliya/victoriaPark/Image2.jpg'),
(13, 3, 'assets/images/Travelers/topDistricts/nuwaraEliya/victoriaPark/Image3.jpg'),
(14, 3, 'assets/images/Travelers/topDistricts/nuwaraEliya/victoriaPark/Image4.jpg'),
(15, 3, 'assets/images/Travelers/topDistricts/nuwaraEliya/victoriaPark/Image5.jpg'),
(16, 4, 'assets/images/Travelers/topDistricts/anuradhapura/mihintale/image1.jpg'),
(17, 4, 'assets/images/Travelers/topDistricts/anuradhapura/mihintale/image2.jpg'),
(18, 4, 'assets/images/Travelers/topDistricts/anuradhapura/mihintale/image3.jpg'),
(19, 5, 'assets/images/Travelers/topDistricts/anuradhapura/ruwanweliseya/image1.jpg'),
(20, 5, 'assets/images/Travelers/topDistricts/anuradhapura/ruwanweliseya/image2.jpg'),
(21, 5, 'assets/images/Travelers/topDistricts/anuradhapura/ruwanweliseya/image3.webp'),
(22, 5, 'assets/images/Travelers/topDistricts/anuradhapura/ruwanweliseya/image4.png'),
(23, 5, 'assets/images/Travelers/topDistricts/anuradhapura/ruwanweliseya/image5.jpg'),
(24, 6, 'assets/images/Travelers/topDistricts/anuradhapura/vessagiriya/image1.jpg'),
(25, 6, 'assets/images/Travelers/topDistricts/anuradhapura/vessagiriya/image2.jpg'),
(26, 6, 'assets/images/Travelers/topDistricts/anuradhapura/vessagiriya/image3.jpg'),
(27, 7, 'assets/images/Travelers/topDistricts/badhulla/dunhindaFalls/image1.jpg'),
(28, 7, 'assets/images/Travelers/topDistricts/badhulla/dunhindaFalls/image2.jpg'),
(29, 7, 'assets/images/Travelers/topDistricts/badhulla/dunhindaFalls/image3.jpg'),
(30, 7, 'assets/images/Travelers/topDistricts/badhulla/dunhindaFalls/image4.jpg'),
(31, 8, 'assets/images/Travelers/topDistricts/badhulla/ellaRock/image1.jpg'),
(32, 8, 'assets/images/Travelers/topDistricts/badhulla/ellaRock/image2.jpg'),
(33, 8, 'assets/images/Travelers/topDistricts/badhulla/ellaRock/image3.jpg'),
(34, 8, 'assets/images/Travelers/topDistricts/badhulla/ellaRock/image4.jpg'),
(35, 8, 'assets/images/Travelers/topDistricts/badhulla/ellaRock/image5.jpg'),
(36, 9, 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/image1.jpg'),
(37, 9, 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/image2.jpg'),
(38, 9, 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/image3.jpg'),
(39, 9, 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/image4.webp');

-- --------------------------------------------------------

--
-- Table structure for table `district_pics`
--

DROP TABLE IF EXISTS `district_pics`;
CREATE TABLE IF NOT EXISTS `district_pics` (
  `district_pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) DEFAULT NULL,
  `image_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`district_pic_id`),
  KEY `district_id` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district_pics`
--

INSERT INTO `district_pics` (`district_pic_id`, `district_id`, `image_location`) VALUES
(1, 9, 'assets/images/Travelers/topDistricts/nuwaraEliya/carousalGallery/Image1.jpg'),
(2, 9, 'assets/images/Travelers/topDistricts/nuwaraEliya/carousalGallery/Image2.jpg'),
(3, 9, 'assets/images/Travelers/topDistricts/nuwaraEliya/carousalGallery/Image3.jpg'),
(4, 9, 'assets/images/Travelers/topDistricts/nuwaraEliya/carousalGallery/Image4.jpg'),
(5, 9, 'assets/images/Travelers/topDistricts/nuwaraEliya/carousalGallery/Image5.jpg'),
(6, 1, 'assets/images/Travelers/topDistricts/anuradhapura/carousalGallery/Image1.jpg'),
(7, 1, 'assets/images/Travelers/topDistricts/anuradhapura/carousalGallery/Image2.jpg'),
(8, 1, 'assets/images/Travelers/topDistricts/anuradhapura/carousalGallery/Image3.jpg'),
(9, 1, 'assets/images/Travelers/topDistricts/anuradhapura/carousalGallery/Image4.jpg'),
(10, 1, 'assets/images/Travelers/topDistricts/anuradhapura/carousalGallery/Image5.jpg'),
(11, 2, 'assets/images/Travelers/topDistricts/badhulla/carousalGallery/Image1.webp'),
(12, 2, 'assets/images/Travelers/topDistricts/badhulla/carousalGallery/Image2.jpg'),
(13, 2, 'assets/images/Travelers/topDistricts/badhulla/carousalGallery/Image3.jpg'),
(14, 2, 'assets/images/Travelers/topDistricts/badhulla/carousalGallery/Image4.webp'),
(15, 2, 'assets/images/Travelers/topDistricts/badhulla/carousalGallery/Image5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_Id` int(11) NOT NULL AUTO_INCREMENT,
  `organizer_Id` int(11) NOT NULL,
  `eventWebBannerPath` varchar(255) DEFAULT NULL,
  `eventThumnailPic` varchar(255) DEFAULT NULL,
  `eventName` varchar(100) NOT NULL,
  `aboutEvent` text NOT NULL,
  `eventDate` date NOT NULL,
  `eventStartTime` time DEFAULT NULL,
  `eventEndTime` time NOT NULL,
  `eventLocation` varchar(255) NOT NULL,
  `eventStatus` varchar(25) DEFAULT NULL,
  `isCompleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`event_Id`),
  KEY `organizer_Id` (`organizer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_Id`, `organizer_Id`, `eventWebBannerPath`, `eventThumnailPic`, `eventName`, `aboutEvent`, `eventDate`, `eventStartTime`, `eventEndTime`, `eventLocation`, `eventStatus`, `isCompleted`) VALUES
(21, 9, '6783c77e62b0a_whimsicalWonderfestWebBanner.png', 'carnivalNew.jpg', 'Whimsical Wonderfest', 'Whimsical Wonderfest is a vibrant carnival filled with thrilling rides, dazzling light displays, live entertainment, and interactive games. Perfect for families and friends, it offers delicious treats, unique crafts, and magical experiences to create unforgettable memories. A celebration of joy, wonder, and togetherness!', '2025-02-18', '19:00:00', '23:30:00', 'Nawagampura Playground, Colombo, Sri Lanka', 'approved', 0),
(23, 9, '6783cbd3041b7_Thundering Hooves Race.png', 'horseRace.jpg', 'Thundering Hooves Race', 'Thundering Hooves Race is a thrilling spectacle of speed and skill, featuring galloping horses and talented riders in an electrifying competition. Perfect for families and friends, enjoy exciting races, scenic views, and engaging activities. A celebration of energy, camaraderie, and the majestic spirit of equestrian sport!', '2025-04-04', '15:00:00', '17:30:00', 'Race Course Ground, Colombo, Sri Lanka', 'approved', 0),
(24, 9, '6783cebae0fd1_magicExtravaganzaWebBanner.png', 'magicShow.jpg', 'The Great Magic Extravaganza', 'Get ready for a night of wonder at The Great Magic Extravaganza! Watch jaw-dropping illusions, mind-bending tricks, and a world of enchantment unfold before your eyes. It\'s a spellbinding experience you won\'t forget. Secure your tickets now for an unforgettable magical adventure!', '2025-03-31', '17:30:00', '20:30:00', 'SLECC, McCallum Road, Colombo, Sri Lanka', 'approved', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_booking`
--

DROP TABLE IF EXISTS `event_booking`;
CREATE TABLE IF NOT EXISTS `event_booking` (
  `booking_Id` int(11) NOT NULL AUTO_INCREMENT,
  `event_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `referenceNum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchasedDate` datetime NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `pathToQR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bookingStatus` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`booking_Id`),
  KEY `event_Id` (`event_Id`),
  KEY `traveler_Id` (`traveler_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_booking`
--

INSERT INTO `event_booking` (`booking_Id`, `event_Id`, `traveler_Id`, `referenceNum`, `purchasedDate`, `totalAmount`, `pathToQR`, `bookingStatus`) VALUES
(18, 23, 100001, 'WWF-678bfa81e7c92', '2025-01-19 00:31:21', '4500.00', 'assets/images/Travelers/generatedEventTickets/WWF-678bfa81e7c92_ticket.png', 'Completed'),
(17, 23, 100001, 'WWF-678a41f6b6c7b', '2025-01-17 17:11:42', '900.00', 'assets/images/Travelers/generatedEventTickets/WWF-678a41f6b6c7b_ticket.png', 'Completed'),
(16, 24, 100008, 'WWF-678908a3189b9', '2025-01-16 18:54:51', '500.00', 'assets/images/Travelers/generatedEventTickets/WWF-678908a3189b9_ticket.png', 'Completed'),
(15, 23, 100001, 'WWF-6788c59add3d1', '2025-01-16 14:08:50', '3000.00', 'assets/images/Travelers/generatedEventTickets/WWF-6788c59add3d1_ticket.png', 'Completed'),
(14, 21, 100001, 'WWF-6788919538c21', '2025-01-16 10:26:53', '900.00', 'assets/images/Travelers/generatedEventTickets/WWF-6788919538c21_ticket.png', 'Completed'),
(13, 23, 100001, 'WWF-67880c0decd14', '2025-01-16 00:57:09', '600.00', 'assets/images/Travelers/generatedEventTickets/WWF-67880c0decd14_ticket.png', 'Completed'),
(12, 21, 100001, 'WWF-678758c0361ee', '2025-01-15 12:12:08', '1400.00', 'assets/images/Travelers/generatedEventTickets/WWF-678758c0361ee_ticket.png', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `event_organizer`
--

DROP TABLE IF EXISTS `event_organizer`;
CREATE TABLE IF NOT EXISTS `event_organizer` (
  `organizer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `company_Email` varchar(50) NOT NULL,
  `company_Password` varchar(255) NOT NULL,
  `company_MobileNum` varchar(10) NOT NULL,
  `company_Name` varchar(100) NOT NULL,
  `company_Address` varchar(255) NOT NULL,
  `organizer_Rating` decimal(2,1) DEFAULT NULL,
  PRIMARY KEY (`organizer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_organizer`
--

INSERT INTO `event_organizer` (`organizer_Id`, `company_Email`, `company_Password`, `company_MobileNum`, `company_Name`, `company_Address`, `organizer_Rating`) VALUES
(1, 'sarma@gmail.com', '$2y$10$/ZE1MxVmjDmz1U4Wjm3aOendZlZmyr9pLMGf7iE1FHyLXmtt/4nCu', '0760454696', 'sarma & co', 'colombo', '4.0'),
(2, 'ASHGDF@gmail.com', '123123', '34736', 'ASHGD', 'uefgi vq', NULL),
(3, 'asd@gmail.com', '123123', '28356863', 'gajsh', 'serhf ', NULL),
(4, 'niro@gmail.com', '123456', '1231546562', 'niroooshan', 'khsdf ishdf ', NULL),
(5, 'enchant@gmail.com', '$2y$10$w3W93hnK4elA9mbD3GdDfuW71idrmodbD/RujKQ7RpRjxO579TTQi', '0773537929', 'Enchant Events', 'No 35, reid avenue, colombo 7', NULL),
(6, 'key@gmail.com', '$2y$10$QaRgrAwmm3SbpcpFPPVcGO9.08i1YWHnpLkJJ393QM.sDUK9uLbbG', '0723866695', 'Startup', 'thannila vada sudura company ki ithan vali', NULL),
(7, 'mnfdummy@gmail.com', '$2y$10$H6Rp7Q1.Y34.dtl13lbPTOD9j/Jpk9APy3r1AyNGTHqDwbRAa5fuG', '0774546984', 'Dummy Trade Center', 'no 88, maligawatte rd, colombo 10 ', NULL),
(8, 'mnnjabir@gmail.com', '$2y$10$ztOuhigW48vKMYxhPZX1Su0HsF7Ufn98cvbd2od8E9t4PfD0rO7iG', '0756742490', 'Jabirs Events', 'powerfull place', NULL),
(9, 'test@gmail.com', '$2y$10$iVw3YNY2bQ/qwnsxH1qI2OvfImRKWidAwpFGzhdEI0cIIit38Toqe', '0747755123', 'Test Workflow', 'J-4, Sirirajasiri 01, Rajamaga road, colombo-15', NULL),
(10, 'sa@gmail.com', '$2y$10$0UvFBeud5XM44W3EMQfXF.RmmDBzmbLUxJbSlC8i.ZBZTCFHcarum', '#45677743', 'asdfghjkl', 'J-4, Sirirajasiri 01, Rajamaga road, colombo-15', NULL),
(11, '5mcrfts@gmail.com', '$2y$10$U7IGPsY9MA7qkt1vVEC9MeRNdatSic.8HuIx2OHyoY19hy567llkC', '0777755555', '5 Minutes Crafts', 'abc road, pqr city, xyz', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_terms_conditions`
--

DROP TABLE IF EXISTS `event_terms_conditions`;
CREATE TABLE IF NOT EXISTS `event_terms_conditions` (
  `termAndCond_Id` int(11) NOT NULL AUTO_INCREMENT,
  `termAndCondition` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`termAndCond_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_terms_conditions`
--

INSERT INTO `event_terms_conditions` (`termAndCond_Id`, `termAndCondition`, `created_at`, `updated_at`) VALUES
(1, 'Attendees must present a valid ticket (printed or electronic) at the event entrance.', '2025-01-10 12:08:47', '2025-01-10 12:08:47'),
(2, 'All ticket purchases are final and non-refundable unless the event is canceled or rescheduled by the organizer.', '2025-01-10 12:09:04', '2025-01-10 12:09:04'),
(3, 'Any individual engaging in inappropriate behavior, including disruption or violation of safety guidelines, may be denied entry or removed from the event without a refund.', '2025-01-10 12:09:18', '2025-01-10 12:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket_type`
--

DROP TABLE IF EXISTS `event_ticket_type`;
CREATE TABLE IF NOT EXISTS `event_ticket_type` (
  `eventTicketType_Id` int(11) NOT NULL AUTO_INCREMENT,
  `event_Id` int(11) NOT NULL,
  `ticketTypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticketTypeDescription` text COLLATE utf8mb4_unicode_ci,
  `pricePerTicket` decimal(10,2) NOT NULL,
  `totalTickets` int(11) NOT NULL,
  `availableTickets` int(11) NOT NULL,
  PRIMARY KEY (`eventTicketType_Id`),
  KEY `fk_event` (`event_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_ticket_type`
--

INSERT INTO `event_ticket_type` (`eventTicketType_Id`, `event_Id`, `ticketTypeName`, `ticketTypeDescription`, `pricePerTicket`, `totalTickets`, `availableTickets`) VALUES
(4, 21, 'Kids Entance Ticket', 'Entrance fee for kids below 10 years of age', '150.00', 100, 100),
(5, 21, 'General Entrance Ticket', 'Entrance fee for individuals aged 10 years and above', '250.00', 200, 198),
(6, 21, 'Family entrance Ticket', 'Discounted Entry for families with 2 adults and up to 3 kids', '900.00', 50, 48),
(7, 22, 'General Entrance Ticket', 'Entrance fee for anyone', '500.00', 250, 250),
(8, 23, 'General Admission', 'Access to the main viewing areas and event activities.', '300.00', 200, 195),
(9, 23, 'Trackside Experience', 'Up-close views near the track, meet-and-greet with riders, and a behind-the-scenes tour.', '750.00', 100, 100),
(10, 23, 'VIP Pass', 'Premium seating, exclusive lounge access, and complimentary refreshments.', '1500.00', 50, 45),
(11, 24, 'Standard Ticket', 'Experience the magic from a great spot at an affordable price.', '500.00', 250, 249),
(12, 24, 'Family Package', 'Enjoy a magical night for the whole family with 5 tickets at a discounted rate.', '2000.00', 100, 100),
(13, 24, 'VIP Ticket', 'Enjoy front-row seats and an exclusive meet with the magicians for a truly unforgettable experience.', '1000.00', 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
  `feature_Id` int(11) NOT NULL,
  `featureName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotelName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelEmail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelPassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelMobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelAddress` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalRooms` int(11) DEFAULT NULL,
  `hotelDescription` text COLLATE utf8mb4_unicode_ci,
  `serviceProviderName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BRNum` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearStarted` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hotel_Id`),
  UNIQUE KEY `hotelEmail` (`hotelEmail`),
  UNIQUE KEY `hotelMobileNum` (`hotelMobileNum`),
  UNIQUE KEY `BRNum` (`BRNum`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_Id`, `hotelName`, `hotelEmail`, `hotelPassword`, `hotelMobileNum`, `hotelAddress`, `district`, `province`, `totalRooms`, `hotelDescription`, `serviceProviderName`, `BRNum`, `yearStarted`) VALUES
(1, 'Cardomon Grand', 'mnnjabir@gmail.com', '$2y$10$QwMKIL4rx7Mr1X21O62st.zm2I.VaEdw82bjKwcYwY8Qez9KP9e.m', '0756742490', 'J-4, Nawagampura, Colombo - 14', 'Colombo', 'Western', NULL, NULL, 'signup/signup', '2022IS036', '2022'),
(8, 'Queens Cherry', 'abdulla@gmail.com', '$2y$10$iD70dJDjXikysN0Bfd2zQuVXlWBkYE4fmL3htnaISHL9hfQweLzBq', '0723877706', 'No 75, Marine Drive, Colombo - 6', 'Colombo', 'Western', NULL, NULL, 'Aurad Abdulla', '2022IS045', '2022'),
(9, 'Fangrilla', 'tga@gmail.com', '$2y$10$gofnna8AHGZczghI0o70nu1HIuEQJgw7SNNLNRC7GIa.InVFjJU9W', '0774546095', 'Maha Buthgamuva Mw, Kotikawatte', 'Colombo', 'Western', NULL, NULL, 'Thagshan', '2022CS100', '2018'),
(10, 'Tata Groups', 'tata@gmail.com', '$2y$10$8QBXH4CqoGW9knL05ZnLPO1NtejThsIZhCk6J6i/lYh2TZSxIVJq2', '0759845615', 'sri vihar, colombo - 7', 'Colombo', 'Western', NULL, NULL, 'Rathan Tata', '1998VSCode', '2000'),
(11, 'Testing Workflow Hotel', 'test@gmail.com', '$2y$10$Enk6/1vX.02JwupX7fivpeht10Nw2zx4tM5EyjkJl22Aqo8Fcg9W.', '0743297890', 'N0 55, Delta lane, Gama road, Kaluthara', 'Kaluthara', 'Western', NULL, NULL, 'Test User', 'testBRnum', '2018'),
(12, 'Lanka Hotels', 'sw23@gmail.com', '$2y$10$beWRdCVP79IshCRk7.vcKeEu6UTW4a33NKDkrIeCC.XLLSH8Y7l1W', '0794561238', 'No 88, Siri dhamma mw, Puttalam', 'Puttalam', 'North West', NULL, NULL, 'Sadheera Samarawikrama', 'slf20241225', '2018');

-- --------------------------------------------------------

--
-- Table structure for table `hotelroom_type`
--

DROP TABLE IF EXISTS `hotelroom_type`;
CREATE TABLE IF NOT EXISTS `hotelroom_type` (
  `hotelRoomType_Id` int(11) NOT NULL,
  `hotel_Id` int(11) NOT NULL,
  `roomType_Id` int(11) NOT NULL,
  `customDescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pricePerDay` decimal(10,2) NOT NULL,
  `maxOccupancy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bank_account`
--

DROP TABLE IF EXISTS `hotel_bank_account`;
CREATE TABLE IF NOT EXISTS `hotel_bank_account` (
  `hotel_bankAccount_Id` int(11) NOT NULL,
  `hotel_Id` int(11) NOT NULL,
  `hotel_accountNum` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankBranch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentMethod` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_commission_record`
--

DROP TABLE IF EXISTS `hotel_commission_record`;
CREATE TABLE IF NOT EXISTS `hotel_commission_record` (
  `hotelCommisition_Id` int(11) NOT NULL,
  `hotelPayout_Id` int(11) DEFAULT NULL,
  `commissionAmount` decimal(10,2) NOT NULL,
  `commissionDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

DROP TABLE IF EXISTS `main`;
CREATE TABLE IF NOT EXISTS `main` (
  `traveler_Id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lName` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travelerEmail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelerPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelerMobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeDistrict` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`traveler_Id`),
  UNIQUE KEY `travelerEmail` (`travelerEmail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomType` text NOT NULL,
  `roomPrice` int(11) NOT NULL,
  `roomDescription` text NOT NULL,
  `roomNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roomfeature`
--

DROP TABLE IF EXISTS `roomfeature`;
CREATE TABLE IF NOT EXISTS `roomfeature` (
  `roomFeature_Id` int(11) NOT NULL,
  `feature_Id` int(11) NOT NULL,
  `hotelRoomType_Id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

DROP TABLE IF EXISTS `room_booking`;
CREATE TABLE IF NOT EXISTS `room_booking` (
  `roomBooking_Id` int(11) NOT NULL,
  `room_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `bookedDate` date NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `bookingStatus` enum('Pending','Booked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `paymentStatus` enum('Pending','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_cancellation`
--

DROP TABLE IF EXISTS `room_booking_cancellation`;
CREATE TABLE IF NOT EXISTS `room_booking_cancellation` (
  `roomBookingCancellation_Id` int(11) NOT NULL,
  `roomBooking_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `cancellationReason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellationDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_refund`
--

DROP TABLE IF EXISTS `room_booking_refund`;
CREATE TABLE IF NOT EXISTS `room_booking_refund` (
  `roomBookingRefund_Id` int(11) NOT NULL,
  `roomBookingCancellation_Id` int(11) NOT NULL,
  `traveler_bankAccount_Id` int(11) NOT NULL,
  `refundAmount` decimal(10,2) NOT NULL,
  `refundDate` datetime NOT NULL,
  `refundStatus` enum('Pending','Completed','Failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `refundEligibility` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_payment_recieved`
--

DROP TABLE IF EXISTS `room_payment_recieved`;
CREATE TABLE IF NOT EXISTS `room_payment_recieved` (
  `payment_Id` int(11) NOT NULL,
  `roomBooking_Id` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentAmount` decimal(10,2) NOT NULL,
  `paymentMethod` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
CREATE TABLE IF NOT EXISTS `room_type` (
  `roomType_Id` int(11) NOT NULL,
  `typeName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standardDescription` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sold_event_tickets`
--

DROP TABLE IF EXISTS `sold_event_tickets`;
CREATE TABLE IF NOT EXISTS `sold_event_tickets` (
  `sale_Id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_Id` int(11) NOT NULL,
  `eventTicketType_Id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`sale_Id`),
  KEY `booking_Id` (`booking_Id`),
  KEY `eventTicketType_Id` (`eventTicketType_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sold_event_tickets`
--

INSERT INTO `sold_event_tickets` (`sale_Id`, `booking_Id`, `eventTicketType_Id`, `quantity`) VALUES
(12, 16, 11, 1),
(11, 15, 10, 2),
(10, 14, 6, 1),
(9, 13, 8, 2),
(8, 12, 6, 1),
(7, 12, 5, 2),
(13, 17, 8, 3),
(14, 18, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `things_to_do`
--

DROP TABLE IF EXISTS `things_to_do`;
CREATE TABLE IF NOT EXISTS `things_to_do` (
  `todo_id` int(11) NOT NULL AUTO_INCREMENT,
  `attraction_id` int(11) DEFAULT NULL,
  `icon_class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`todo_id`),
  KEY `attraction_id` (`attraction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `things_to_do`
--

INSERT INTO `things_to_do` (`todo_id`, `attraction_id`, `icon_class`, `activity_name`, `activity_description`) VALUES
(1, 1, 'fas fa-ship', 'Boat Rides', 'Enjoy a leisurely pedal boat or motorboat ride across the calm, picturesque waters of the lake, perfect for soaking in the surrounding beauty.'),
(2, 1, 'fas fa-horse', 'Horseback Riding', 'Explore the lakes scenic trails on horseback, a popular and charming activity for visitors of all ages.'),
(3, 1, 'fas fa-water', 'Water Sports', 'Thrill-seekers can indulge in activities like jet skiing and windsurfing for an adrenaline-pumping experience.'),
(4, 1, 'fas fa-utensils', 'Picnics and Relaxation', 'Pack a picnic and unwind on the well-maintained grassy banks, enjoying the fresh mountain air and serene environment.'),
(5, 1, 'fas fa-bicycle', 'Cycling Around the Lake', 'Rent a bicycle and pedal along the scenic pathways, taking in the lush greenery and stunning views of the surrounding hills.'),
(6, 2, 'fa-solid fa-paw', 'Wildlife Spotting', 'Explore the rich biodiversity, home to species like the sambar deer, purple-faced langur, and a variety of endemic birds. Early morning visits are ideal for spotting wildlife in their natural habitat.'),
(7, 2, 'fa-solid fa-person-hiking', 'Hiking to Worlds End', 'Embark on an exhilarating hike to Worlds End, a stunning cliff with a dramatic 800-meter drop. The journey offers breathtaking views of misty valleys, lush greenery, and the distant ocean on clear days.'),
(8, 2, 'fas fa-water', 'Visit Bakers Falls', 'Marvel at the beauty of Bakers Falls, a picturesque waterfall surrounded by dense vegetation. The soothing sound of cascading water makes this spot a must-visit for nature lovers and photographers.'),
(9, 2, 'fa-solid fa-mountain', 'Explore Kirigalpoththa Trail', 'Challenge yourself with a trek to Kirigalpoththa, the second-highest peak in Sri Lanka. The trail winds through diverse terrains, including montane forests and grasslands, offering panoramic views of the surrounding landscape.'),
(10, 2, 'fa-solid fa-camera', 'Nature Photography', 'Capture the ethereal beauty of Horton Plains through your lens. From vibrant wildflowers to the serene landscapes shrouded in mist, every corner presents a perfect shot for photography enthusiasts.'),
(11, 3, 'fas fa-tree', 'Nature Walks', 'Begin your visit with a leisurely stroll through the park\'s lush pathways, surrounded by vibrant flowers and towering trees, immersing yourself in the serene beauty of nature.'),
(12, 3, 'fas fa-seedling', ' Seasonal Flower Displays', 'Marvel at the park\'s stunning seasonal blooms, from delicate roses to vibrant chrysanthemums, offering a feast for the eyes and perfect spots for capturing memorable photos.'),
(13, 3, 'fas fa-dove', 'Bird Watching', 'Discover the park\'s rich biodiversity as you spot colorful bird species and listen to their melodious songs, creating a peaceful and enchanting experience.'),
(14, 3, 'fa-solid fa-camera', 'Photography Spots', 'Capture the charm of meticulously landscaped gardens, charming bridges, and serene ponds, ensuring you take home unforgettable memories of this picturesque location.'),
(15, 3, 'fas fa-utensils', 'Picnic Areas', 'Wrap up your visit by relaxing in designated picnic spots, enjoying a delightful meal amidst the fresh mountain air and the parks breathtaking scenery.'),
(16, 4, 'fas fa-landmark', 'Explore the Monastery Complex', 'Begin your journey by exploring the ruins of the monastery complex. Walk through the meditation caves, ancient stupas, and stone inscriptions to gain a deeper understanding of the site\'s history and significance.'),
(17, 4, 'fas fa-place-of-worship', 'Visit the Kantaka Chetiya Stupa', 'Proceed to this well-preserved stupa to admire its intricate carvings and learn about its spiritual importance in early Buddhism.'),
(18, 4, 'fas fa-water', 'Visit Naga Pokuna', 'Take a peaceful moment at the Snake Pond, appreciating the ancient engineering skills and the tranquil surroundings.'),
(19, 4, 'fas fa-person-hiking', 'Climb the Aradhana Gala', 'Embark on the climb to the Rock of Invitation, soaking in the historical significance and enjoying the panoramic views along the way.'),
(20, 4, 'fas fa-sun', 'Sunset from Mihintale Summit', 'Conclude your visit by watching the magical sunset from the summit, a perfect way to reflect on the spiritual and historical depth of your journey.'),
(21, 5, 'fa-solid fa-landmark', 'Explore the Ancient Architecture', 'Begin your visit by marveling at the intricate carvings and the majestic structure of Ruwanwelisaya. Learn about its historical and architectural significance as you walk around the stupa'),
(22, 5, 'fa-solid fa-hands-praying', 'Participate in Religious Offerings', 'After appreciating the stupa grandeur, engage in the sacred rituals of offering flowers, incense, and prayers. This will allow you to immerse yourself in the spiritual atmosphere and connect with the devotion of the pilgrims.'),
(23, 5, 'fa-solid fa-leaf', 'Meditation and Reflection', 'Conclude your visit by finding a quiet spot around the stupa to meditate or simply reflect. Let the serene environment and spiritual energy help you achieve a sense of peace and mindfulness.'),
(24, 6, 'fas fa-monument', 'Explore Ancient Cave Monasteries', 'Begin your visit by delving into the historical significance of Vessagiriya. Explore the ancient rock-cut caves that served as meditation and living quarters for Buddhist monks. '),
(25, 6, 'fa-solid fa-camera', 'Photograph Historical Ruins', 'After exploring the caves, take some time to capture the site beauty. The blend of natural rocky formations, historical ruins, and lush greenery provides the perfect setting for breathtaking photographs.'),
(26, 6, 'fas fa-tree', 'Enjoy a Peaceful Nature Walk', 'Conclude your visit with a leisurely stroll around the serene surroundings. The calm atmosphere, complemented by the beauty of nature, offers a moment of relaxation and reflection, making it an ideal way to end your trip to Vessagiriya.'),
(27, 7, 'fas fa-hiking', 'Nature Hiking', 'Embark on a scenic 1.5 km trail through lush greenery to reach the falls, enjoying the serenity of the forest and occasional glimpses of exotic birds and wildlife.'),
(28, 7, 'fas fa-swimmer', 'Stream Dipping', 'Safely dip your feet or splash around in calmer areas along the stream before the falls. Bathing directly at Dunhinda Falls is not recommended due to its strong currents and deep waters. Always follow local safety guidelines.'),
(29, 7, 'fas fa-leaf', 'Relax by the Falls', 'Sit back and unwind to the soothing sounds of the cascading water while taking in the breathtaking views of one of Sri Lanka\'s most iconic waterfalls.'),
(30, 7, 'fas fa-camera', 'Photography', 'Capture the mesmerizing beauty of the 63-meter cascade enveloped in mist, framed by the surrounding rocky terrain and verdant landscape.'),
(31, 8, 'fas fa-hiking', 'Hiking to the Summit', 'Begin your journey with an adventurous hike through scenic tea plantations, lush forests, and misty trails. The climb to the top is invigorating and sets the stage for a memorable experience.'),
(32, 8, 'fas fa-dove', 'Bird Watching', 'Along the trail and at the summit, take time to spot and admire the diverse bird species that inhabit the area. Their cheerful melodies add a soothing touch to your adventure.'),
(33, 8, 'fas fa-camera', 'Photography', 'Conclude your trip by capturing the mesmerizing views from the summit, including rolling hills, picturesque valleys, and vibrant sunsets. The natural beauty makes for incredible photo opportunities.'),
(34, 9, 'fas fa-hiking', 'Scenic Hike to Lipton Seat', 'Start your visit with a refreshing hike through the lush tea plantations. The trail leads you through picturesque landscapes and offers a peaceful walk surrounded by greenery.'),
(35, 9, 'fas fa-binoculars', 'Panoramic View at the Summit', 'Once you reach Lipton Seat, enjoy the breathtaking panoramic views of the surrounding tea estates, valleys, and distant mountains. This is the highlight of the visit, offering a stunning visual treat.'),
(36, 9, 'fas fa-camera', 'Photography and Relaxation', 'After soaking in the views, take some time to capture the beauty of the landscape and enjoy the tranquil environment. It\'s the perfect spot to relax and connect with nature.');

-- --------------------------------------------------------

--
-- Table structure for table `top_districts`
--

DROP TABLE IF EXISTS `top_districts`;
CREATE TABLE IF NOT EXISTS `top_districts` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_the_district` text COLLATE utf8mb4_unicode_ci,
  `coverPic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_districts`
--

INSERT INTO `top_districts` (`district_id`, `district_name`, `about_the_district`, `coverPic`) VALUES
(9, 'Nuwara Eliya', 'Nuwara Eliya, often called \"Little England,\" is a charming town nestled in the heart of Sri Lanka\'s hill country. Known for its cool climate, lush green tea plantations, and colonial architecture, this picturesque destination offers breathtaking landscapes and a tranquil escape. Visitors can explore vibrant gardens, visit historic tea estates, and enjoy scenic boat rides on Gregory Lake. With misty mountains, cascading waterfalls, and a touch of old-world charm, Nuwara Eliya is a perfect blend of natural beauty and cultural heritage.', 'assets/images/Travelers/topDistricts/nuwaraEliya.jpg'),
(1, 'Anuradhapura', 'Anuradhapura, a UNESCO World Heritage Site, is a sacred city steeped in history and culture in Sri Lanka\'s North Central Province. Renowned for its ancient ruins, sprawling monasteries, and iconic stupas like Ruwanwelisaya and Jetavanaramaya, it offers a glimpse into the island\'s rich Buddhist heritage. Visitors can marvel at the centuries-old Sri Maha Bodhi tree, believed to be the world\'s oldest historically documented tree, and explore intricate stone carvings and reservoirs. With its serene atmosphere, sacred landmarks, and timeless charm, Anuradhapura is a captivating journey into Sri Lanka\'s glorious past.', 'assets/images/Travelers/topDistricts/anuradhapura.jpg'),
(2, 'Badhulla', 'Badulla, nestled in Sri Lanka\'s Uva Province, is a serene town surrounded by lush greenery and rolling hills. Known for its natural beauty and historical significance, the area boasts attractions like the enchanting Dunhinda Falls and the ancient Muthiyangana Temple. Visitors can enjoy scenic hikes, tea estate tours, and panoramic views from Little Adam\'s Peak. The town\'s charming railway station is a gateway to breathtaking train journeys through misty mountains and verdant valleys. With its tranquil ambiance and cultural treasures, Badulla is a perfect retreat for nature lovers and history enthusiasts alike.', 'assets/images/Travelers/topDistricts/badhulla.jpg'),
(3, 'Colombo', 'Colombo, the vibrant capital of Sri Lanka, seamlessly blends modern sophistication with rich cultural heritage. This bustling metropolis is known for its iconic landmarks like the Lotus Tower, historic temples, and colonial-era buildings. Visitors can explore bustling markets in Pettah, relax by the Galle Face Green promenade, or indulge in world-class dining and shopping. Colombo\'s lively streets are adorned with art, while its museums and galleries offer glimpses into the island\'s history. With its dynamic cityscape, coastal charm, and cosmopolitan vibe, Colombo is a perfect introduction to Sri Lanka\'s diverse allure.', 'assets/images/Travelers/topDistricts/colombo.jpg'),
(4, 'Galle', 'Galle, a coastal gem in southern Sri Lanka, is renowned for its timeless charm and rich history. The iconic Galle Fort, a UNESCO World Heritage Site, stands as a testament to the islands colonial past, with cobblestone streets, quaint boutiques, and colonial architecture. Visitors can explore art galleries, vibrant cafes, and the lighthouse overlooking the turquoise waters. The towns golden beaches and serene surroundings offer a perfect escape for relaxation and exploration. With its blend of historical allure and coastal beauty, Galle is a captivating destination for travelers seeking culture and tranquility.\r\n', 'assets/images/Travelers/topDistricts/galle.jpg'),
(5, 'Hambantota', 'Hambantota, located on Sri Lanka’s southern coast, is a destination where untamed nature meets modern development. Known for its proximity to wildlife-rich national parks like Yala and Bundala, it’s a haven for nature enthusiasts and safari lovers. Visitors can explore the sprawling Hambantota Bird Park, walk through the landscaped paths of Dry Zone Botanical Gardens, or relax on pristine beaches. The area is also home to the modern Mattala Rajapaksa International Airport and the bustling Hambantota Port. With its unique blend of natural wonders and growing infrastructure, Hambantota offers a distinctive experience for travelers.', 'assets/images/Travelers/topDistricts/hambantota.jpg'),
(6, 'Jaffna', 'Jaffna, the cultural heart of Sri Lanka’s Northern Province, is a city steeped in history, tradition, and resilience. Known for its vibrant Tamil heritage, it features iconic landmarks such as the majestic Nallur Kandaswamy Temple and the historic Jaffna Fort. Visitors can savor authentic Jaffna cuisine, explore pristine islands like Delft, and discover ancient libraries and museums that narrate the region’s rich past. The city’s colorful markets and serene beaches add to its charm. With its unique culture, historic sites, and warm hospitality, Jaffna is a must-visit destination for those seeking an enriching travel experience.', 'assets/images/Travelers/topDistricts/jaffna.jpg'),
(7, 'Kandy', 'Kandy, nestled in Sri Lanka’s lush central hills, is a city of cultural and spiritual significance. Renowned as the home of the Sacred Tooth Relic, housed in the Temple of the Tooth, it is a UNESCO World Heritage Site and a major pilgrimage destination. Visitors can explore the serene Kandy Lake, vibrant botanical gardens in Peradeniya, and traditional dance performances that showcase the city’s rich heritage. Surrounded by misty mountains and tea plantations, Kandy offers breathtaking scenery and a peaceful retreat. With its blend of history, spirituality, and natural beauty, Kandy is a jewel of Sri Lanka\'s hill country.', 'assets/images/Travelers/topDistricts/kandy.jpg'),
(8, 'Kegalle', 'Kegalle, located in Sri Lanka’s scenic Sabaragamuwa Province, is a charming town known for its lush landscapes and cultural landmarks. Famous as the gateway to the Pinnawala Elephant Orphanage, it offers visitors the chance to get up close with Sri Lanka’s majestic elephants. Surrounded by verdant hills and rubber plantations, Kegalle is perfect for nature enthusiasts. The area also boasts ancient temples, such as Dedigama Kota Vehera, and serene waterfalls ideal for exploration. With its rich heritage and tranquil surroundings, Kegalle provides a delightful escape into the heart of Sri Lanka\'s natural beauty.', 'assets/images/Travelers/topDistricts/kegalle.jpg'),
(10, 'Polonnaruwa', 'Polonnaruwa, a UNESCO World Heritage Site, is a treasure trove of ancient history and stunning architecture in Sri Lanka’s North Central Province. Once a thriving medieval capital, it boasts well-preserved ruins, including the iconic Gal Vihara rock carvings, royal palaces, and impressive stupas. Visitors can explore the vast archaeological site, marvel at intricate stone sculptures, and learn about the city’s rich past at the Polonnaruwa Museum. Surrounded by lush greenery and serene reservoirs, the area offers a harmonious blend of history and natural beauty. Polonnaruwa is a must-visit destination for history buffs and culture enthusiasts alike.', 'assets/images/Travelers/topDistricts/polonnaruwa.jpg'),
(11, 'Ratnapura', 'Ratnapura, often called the “City of Gems,” is a glittering jewel in Sri Lanka’s Sabaragamuwa Province. Renowned as the heart of the island’s gem trade, it offers visitors a chance to learn about the art of gem mining and explore bustling gem markets. The city is surrounded by lush landscapes, with attractions like the scenic Bopath Ella Falls and the sacred Adam’s Peak, a popular pilgrimage site. Rich in biodiversity, Ratnapura is also a gateway to Sinharaja Forest Reserve. With its sparkling heritage, natural wonders, and cultural significance, Ratnapura is a destination full of discovery and beauty.', 'assets/images/Travelers/topDistricts/ratnapura.jpg'),
(12, 'Trincomalee', 'Trincomalee, a picturesque coastal town on Sri Lanka’s northeastern shore, is a hidden gem known for its pristine beaches, rich history, and vibrant marine life. The town is home to the stunning Koneswaram Temple, perched on a cliff overlooking the Indian Ocean, and the historic Trincomalee Harbour, one of the world’s largest natural harbors. Visitors can unwind on the golden sands of Nilaveli and Uppuveli beaches, explore coral reefs, or visit the ancient hot springs at Kanniya. With its blend of natural beauty, cultural landmarks, and tranquil atmosphere, Trincomalee offers a perfect retreat for history lovers and beach enthusiasts alike.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'assets/images/Travelers/topDistricts/trincomalee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tourguide`
--

DROP TABLE IF EXISTS `tourguide`;
CREATE TABLE IF NOT EXISTS `tourguide` (
  `guide_Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nic` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `licenseNum` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `fieldsOfExpertise` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tourFrequencyPerMonth` int(11) DEFAULT NULL,
  `guideRating` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`guide_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tourguide`
--

INSERT INTO `tourguide` (`guide_Id`, `name`, `nic`, `mobileNum`, `username`, `email`, `password`, `licenseNum`, `experience`, `fieldsOfExpertise`, `tourFrequencyPerMonth`, `guideRating`) VALUES
(1, 'Test User', '200210107777', '0723866695', 'testUser', 'test@gmail.com', '$2y$10$31h7JzHfN0KedivXDPn4F../1D1DqTvAT7ISFMF0op6bvJPvNqV/6', '2022Is036', 5, 'Hiking', 5, NULL),
(2, 'Aurad Abdulla', '200210204080', '0774546984', 'abdul1124', 'aurudu@gmail.com', '$2y$10$enGarbILSdDQxM6.geqcZeCQNE3xeleh76h59G59NfLxXtYwq9dW.', '2022CS001', 2, 'Wild Life', 10, NULL),
(3, 'Ashfaq Mohamed', '200010203040', '0751233212', 'ashfaq1226', 'ashfaq@femail.com', '$2y$10$.i/i8MUT3XXjJcDXM0tkku7DHezmNEz8DEEQ0s/2zjoawmcZbPrnC', '2022SE009', 3, 'Religious Pilgrimages', 7, NULL),
(4, 'abdkiug ioyfikiki', '200000000000', '0114445550', 'kjhkvi', 'kjabxvy@gmail.com', '$2y$10$SDluhsLrmLZqMmA4nr2Ppe9to5/okg0O8MQ/HiQWFOGrEFizGMQva', '10245', 2, 'Hiking', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour_package`
--

DROP TABLE IF EXISTS `tour_package`;
CREATE TABLE IF NOT EXISTS `tour_package` (
  `tourPackage_Id` int(11) NOT NULL,
  `guide_Id` int(11) NOT NULL,
  `packageName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourLocation` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numberOfPeople` int(11) NOT NULL,
  `packagePrice` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`tourPackage_Id`),
  KEY `guide_Id` (`guide_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

DROP TABLE IF EXISTS `tour_packages`;
CREATE TABLE IF NOT EXISTS `tour_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL,
  `tour_location` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `activity_name` text,
  `images` varchar(1024) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `package_name`, `tour_location`, `duration`, `number_of_people`, `rate`, `description`, `activity_name`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Horton Plains', '', 2, 7, '10000.00', 'Tour to horton plains nuwaraeliya', NULL, NULL, '2024-12-01 19:59:10', '2024-12-01 20:18:56'),
(2, 'Gartmore Falls', 'Hatton', 1, 9, '4500.00', 'Best Waterfall in sri lanka', 'Bathing', '/assets/images/tour_image_674cc2712b94d9.31835338.png,/assets/images/tour_image_674cc2712baf06.56280721.png', '2024-12-01 20:09:21', '2024-12-01 20:09:21'),
(3, 'Moon Plains', 'Gampola', 10, 15, '45000.00', 'Tour to gampola Moon PLains and Ambuluwawa', 'Hiking', '/assets/images/tour_image_674cc52e9892f2.56676786.png', '2024-12-01 20:21:02', '2024-12-01 20:21:02'),
(4, 'hiking', 'nuwaraeliya', 5, 3, '25000.00', 'sdfghjkl;/.,mnbvcxzxcvbnm,', 'qwertyuiop', '/assets/images/tour_image_674d51cde6eeb0.74649327.png', '2024-12-02 06:21:01', '2024-12-02 06:21:01'),
(5, 'ammmata', 'hu', 3, 5, '25000.00', 'asdfghjk', 'qwertyuiop', '/assets/images/tour_image_674d5842898d79.26502900.jpg', '2024-12-02 06:48:34', '2024-12-02 06:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `traveler`
--

DROP TABLE IF EXISTS `traveler`;
CREATE TABLE IF NOT EXISTS `traveler` (
  `traveler_Id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lName` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travelerEmail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travelerPassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travelerMobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`traveler_Id`),
  UNIQUE KEY `travelerEmail` (`travelerEmail`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=100010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traveler`
--

INSERT INTO `traveler` (`traveler_Id`, `fName`, `lName`, `username`, `travelerEmail`, `travelerPassword`, `travelerMobileNum`, `profilePicture`, `bio`, `created_at`, `updated_at`) VALUES
(100001, 'Test', 'User', 'Tester', 'test@gmail.com', '$2y$10$0Om1no9qLUU/p3TFZc3Fz.UKw84s90mp3eU7Tj9ib68IMD5y6uyuW', '0715770109', '678a4401bd42c_675e7ec2103db_profilePic.jpeg', 'This default user is used to test the interaction of traveler components with other components.', '2024-12-10 21:20:15', '2025-01-17 11:52:12'),
(100002, 'Nihmath', 'Jabir', 'Jabir31', 'mnnjabir@gmail.com', '$2y$10$BvXRYXbqBqcbaOIAzIWJSuDyZE2GH7oq9ButbFtq47imCsuHp2rUW', '0756742490', '6774f24a88b72_myPic2.jpg', 'Passionate traveler with an insatiable curiosity for exploring new destinations, cultures, and cuisines.', '2024-12-10 21:24:08', '2025-01-17 11:52:26'),
(100003, 'Abdhulla', 'Zakey', 'AbdZak', 'mzabdulla25@gmail.com', '$2y$10$KOH63zwmJBNyERJZ71FCauFQpLKhxGeRyFdgTVqRxCYO04DguDfWq', '0701524235', '676e8726a80ff_chatIcon6.png', 'I am a traveler from Mawanella', '2024-12-10 21:26:50', '2024-12-27 10:53:26'),
(100004, NULL, NULL, 'Sharma123', 'sharma@gmail.com', '$2y$10$KJzfheQik0te1.l179CAQe95pmNvRmr6ajDp5pD0wroh3nKFN/hei', NULL, NULL, NULL, '2024-12-10 21:29:14', '2024-12-27 10:49:31'),
(100009, '', '', 'Thugston', 'thagshan@gmail.com', '$2y$10$HSRpRt3kvK0vkjAI5SC3m.AaAWpLqUq/5jocDruTNVJ9Lrm/wB81G', NULL, NULL, NULL, '2025-01-19 06:01:49', '2025-01-19 06:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `traveler_bank_account`
--

DROP TABLE IF EXISTS `traveler_bank_account`;
CREATE TABLE IF NOT EXISTS `traveler_bank_account` (
  `traveler_bankAccount_Id` int(11) NOT NULL AUTO_INCREMENT,
  `traveler_Id` int(11) NOT NULL,
  `traveler_accountNum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traveler_bankName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traveler_bankBranch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`traveler_bankAccount_Id`),
  UNIQUE KEY `traveler_accountNum` (`traveler_accountNum`),
  KEY `FK_Traveler` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traveler_bank_account`
--

INSERT INTO `traveler_bank_account` (`traveler_bankAccount_Id`, `traveler_Id`, `traveler_accountNum`, `traveler_bankName`, `traveler_bankBranch`, `created_at`, `updated_at`) VALUES
(1, 100001, '200209102877', 'Hatton National Bank', 'Maligawatte', '2024-12-17 05:57:44', '2024-12-27 10:24:29'),
(2, 100002, '020331031020', 'National Savings Bank', 'Maligawatte', '2024-12-27 10:35:27', '2024-12-27 10:46:41'),
(4, 100003, '121324253637', 'Peoples Bank', 'Mawanella', '2024-12-27 10:53:07', '2024-12-27 10:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `trip_Id` int(11) NOT NULL AUTO_INCREMENT,
  `traveler_Id` int(11) NOT NULL,
  `tripName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startingLocation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `departureTime` time DEFAULT NULL,
  `transportationMode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numberOfTravelers` int(11) DEFAULT NULL,
  `budgetPerPerson` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`trip_Id`),
  KEY `FK_Trips_Traveler` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_Id`, `traveler_Id`, `tripName`, `startingLocation`, `destination`, `startDate`, `endDate`, `departureTime`, `transportationMode`, `numberOfTravelers`, `budgetPerPerson`) VALUES
(5, 100001, 'Ambuluvava Hike', 'Colombo, Sri Lanka', 'Ambuluwawa Tower', '2025-01-04', '2025-01-04', '05:30:00', 'Bus', 35, '2000.00'),
(6, 100002, 'First TM Trip', 'Colombo', 'Ambuluwawa Trait', '2025-01-04', '2025-01-04', '05:30:00', 'Bus', 30, '2000.00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer` (`organizer_Id`) ON DELETE CASCADE;

--
-- Constraints for table `traveler_bank_account`
--
ALTER TABLE `traveler_bank_account`
  ADD CONSTRAINT `FK_Traveler` FOREIGN KEY (`traveler_Id`) REFERENCES `traveler` (`traveler_Id`) ON DELETE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `FK_Trips_Traveler` FOREIGN KEY (`traveler_Id`) REFERENCES `traveler` (`traveler_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
