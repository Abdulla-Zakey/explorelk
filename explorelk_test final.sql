-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2025 at 06:59 PM
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
-- Table structure for table `accommodation_booking_notifications`
--

DROP TABLE IF EXISTS `accommodation_booking_notifications`;
CREATE TABLE IF NOT EXISTS `accommodation_booking_notifications` (
  `accommodation_booking_notification_Id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_Id` int(11) NOT NULL,
  `room_booking_Id` int(11) NOT NULL,
  PRIMARY KEY (`accommodation_booking_notification_Id`),
  KEY `notification_Id` (`notification_Id`),
  KEY `room_booking_Id` (`room_booking_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accommodation_booking_notifications`
--

INSERT INTO `accommodation_booking_notifications` (`accommodation_booking_notification_Id`, `notification_Id`, `room_booking_Id`) VALUES
(7, 10, 10000025),
(8, 13, 10000025),
(9, 14, 10000025),
(10, 27, 10000027),
(11, 28, 10000027),
(12, 30, 10000031),
(13, 31, 10000031),
(14, 32, 10000027),
(16, 36, 10000033),
(17, 37, 10000033),
(18, 38, 10000033),
(19, 41, 10000031),
(20, 43, 10000034),
(21, 45, 10000035),
(22, 46, 10000035),
(23, 47, 10000035);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(1024) NOT NULL DEFAULT 'profile.png',
  `gender` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `phoneNo` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstName`, `lastName`, `email`, `password`, `profile_picture`, `gender`, `dob`, `city`, `phoneNo`, `address`, `nic`) VALUES
(1, 'Mohamed Zakey', 'Abdulla', 'test@gmail.com', '$2y$10$X9MV9HXiJUo90OENaP1kcet5U5issFnwyJn3QVwLcl4VG6tPdB2Ee', '67b6c55a15c19_file.png', 'Male', '2002-05-23', 'Kandy', 762555148, '167/A, Kalubowila', '200214402017'),
(2, 'Nihmath', 'Jabir', 'ucsc@gmail.com', 'ucsc@123', 'profile.png', 'Male', '2025-01-08', 'Maligawatta', 771123445, '123/B, Main Road Maligawatta', '200145632155\r\n');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, 2, 'Lipton Seat', 'Step into the legacy of Sri Lankas tea history at Liptons Seat, a spectacular viewpoint in the hills near Haputale. Named after Sir Thomas Lipton, this serene spot offers unparalleled views of emerald tea estates, rolling hills, and distant mountains.', 'The journey to Liptons Seat is as enchanting as the destination, with winding roads through lush tea plantations and an opportunity to witness the everyday lives of local tea pluckers. Once you arrive, the breathtaking scenery and cool, crisp air provide a tranquil escape from the hustle and bustle of daily life.', 'Whether you are a tea lover, a history enthusiast, or simply in search of stunning vistas, Liptons Seat is a must-visit destination. Its peaceful charm and rich heritage make it a place that lingers in the hearts of all who visit.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.9096500883265!2d81.0129318749952!3d6.780849793216198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae46e34030893af:0x3886114faff7476b!2sLipton\'s%20Seat!5e0!3m2!1sen!2slk!4v1735185455494!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/liptonSeat.webp'),
(10, 3, ' Galle Face Green', 'Experience the vibrant spirit of Colombo at Galle Face Green, a breezy stretch of oceanfront bliss that blends colonial history with modern-day charm. Established in 1859, this sprawling urban park along the Indian Ocean is a haven for evening strolls, street food cravings, and soaking in breathtaking sunsets. As waves crash nearby and kites dance in the wind, the atmosphere is alive with the energy of locals and tourists unwinding by the sea.', 'The open lawns and coastal paths are perfect for families, couples, or solo wanderers looking to enjoy the simple joys of life. Try some spicy isso wade (prawn fritters) or a king coconut from a roadside vendor, and feel the pulse of Colombo\'s street culture in full swing. The colonial Galle Face Hotel stands tall nearby, whispering stories of a bygone era and adding timeless elegance to this lively spot.', 'Whether you are there for a morning jog, a lazy evening picnic, or to catch the golden hues of dusk, Galle Face Green offers a refreshing escape without leaving the city. It is not just a park, it is where Colombo breathes, laughs, and lives.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7220821445944!2d79.84493239999999!3d6.9237882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259396a72f305%3A0x5e7e24c6bf94136f!2sGalle%20Face%20Green!5e0!3m2!1sen!2slk!4v1745354347457!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/colombo/topAttractions/galleFaceGreen.jpg'),
(11, 3, 'Lotus Tower ', 'Rising gracefully above the Colombo skyline, the Lotus Tower (Nelum Kuluna) is a breathtaking blend of futuristic design and cultural symbolism. Shaped like a lotus bud, a flower of purity and progress this towering landmark stands as South Asias tallest structure, soaring to an impressive 351.5 meters. It is more than just a marvel of engineering; it is a symbol of Sri Lankas ambition reaching skyward.', 'Step inside and take a high-speed elevator to the observation deck for sweeping panoramic views of the city, ocean, and beyond. Whether it is sunrise painting the skyline in golden hues or the city lights twinkling at night, the tower offers a perspective like no other. With restaurants, retail spaces, and a luxury lounge, it is an attraction that fuses adventure and elegance in one unforgettable visit.', 'Perfect for photographers, couples, families, or anyone with a love for heights and cityscapes, the Lotus Tower is a must visit destination. It is not just an architectural wonder, it is a modern day icon standing tall in the heart of Sri Lankas capital.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.694816426838!2d79.85575987399757!3d6.927035493072762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259113a63055d%3A0x8f4e038124048b42!2sColombo%20Lotus%20Tower!5e0!3m2!1sen!2slk!4v1745354584988!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/colombo/topAttractions/lotusTower.jpg'),
(12, 3, 'Independence Square', 'Step into the graceful calm of Independence Square, a landmark that beautifully blends history, architecture, and tranquility. Nestled in the heart of Colombo, this grand site commemorates Sri Lankas freedom from colonial rule. With its stately open hall and stone lions guarding its steps, the monument exudes a quiet dignity a perfect retreat from the citys energetic pace.', 'Surrounded by manicured gardens and wide walking paths, Independence Square invites you to unwind under swaying trees or reflect on the nations journey while seated beneath its stunning columns. It is a favorite spot for joggers, families, and photographers, offering a scenic blend of heritage and modern leisure in the middle of a bustling metropolis.', 'Whether you are exploring on foot or relaxing in its peaceful shade, Independence Square gives you a moment of calm, history, and inspiration. It is not just a monument, it is a sanctuary that echoes with stories of courage and the dreams of a free nation.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.881573972627!2d79.86464337399734!3d6.90476259309459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2597b88958e0b%3A0xc1c5089f26bc260b!2sIndependence%20Square!5e0!3m2!1sen!2slk!4v1745354752642!5m2!1sen!2slk', 'assets/images/Travelers/topDistricts/colombo/topAttractions/independenceSquare.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(39, 9, 'assets/images/Travelers/topDistricts/badhulla/liptonSeat/image4.webp'),
(40, 10, 'assets/images/Travelers/topDistricts/colombo/galleFaceGreen/image1.jpg'),
(41, 10, 'assets/images/Travelers/topDistricts/colombo/galleFaceGreen/image2.jpg'),
(42, 10, 'assets/images/Travelers/topDistricts/colombo/galleFaceGreen/image3.jpg'),
(43, 10, 'assets/images/Travelers/topDistricts/colombo/galleFaceGreen/image4.jpg'),
(44, 10, 'assets/images/Travelers/topDistricts/colombo/galleFaceGreen/image5.jpg'),
(45, 11, 'assets/images/Travelers/topDistricts/colombo/lotusTower/image1.jpg'),
(46, 11, 'assets/images/Travelers/topDistricts/colombo/lotusTower/image2.jpg'),
(47, 11, 'assets/images/Travelers/topDistricts/colombo/lotusTower/image3.jpg'),
(48, 11, 'assets/images/Travelers/topDistricts/colombo/lotusTower/image4.jpeg'),
(49, 11, 'assets/images/Travelers/topDistricts/colombo/lotusTower/image5.jpg'),
(50, 12, 'assets/images/Travelers/topDistricts/colombo/independenceSquare/image1.jpeg'),
(51, 12, 'assets/images/Travelers/topDistricts/colombo/independenceSquare/image2.jpg'),
(52, 12, 'assets/images/Travelers/topDistricts/colombo/independenceSquare/image3.jpg'),
(53, 12, 'assets/images/Travelers/topDistricts/colombo/independenceSquare/image4.jpg'),
(54, 12, 'assets/images/Travelers/topDistricts/colombo/independenceSquare/image5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `commission_rates`
--

DROP TABLE IF EXISTS `commission_rates`;
CREATE TABLE IF NOT EXISTS `commission_rates` (
  `commission_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(50) NOT NULL,
  `commission_rate` int(11) NOT NULL,
  `last_updated` date NOT NULL,
  PRIMARY KEY (`commission_rate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commission_rates`
--

INSERT INTO `commission_rates` (`commission_rate_id`, `service_type`, `commission_rate`, `last_updated`) VALUES
(1, 'Hotels', 12, '2025-04-08'),
(2, 'Restaurants', 8, '2025-04-01'),
(3, 'Tour Guides', 15, '2025-04-05'),
(4, 'Car Rentals', 10, '2025-04-06'),
(5, 'Event Organizers', 18, '2025-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `common_room_amenities`
--

DROP TABLE IF EXISTS `common_room_amenities`;
CREATE TABLE IF NOT EXISTS `common_room_amenities` (
  `amenity_Id` int(11) NOT NULL AUTO_INCREMENT,
  `amenity_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`amenity_Id`),
  UNIQUE KEY `amenity_name` (`amenity_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `common_room_amenities`
--

INSERT INTO `common_room_amenities` (`amenity_Id`, `amenity_name`, `icon_class`) VALUES
(2, 'WiFi', 'fa-solid fa-wifi'),
(3, 'Air Conditioning', 'fa-solid fa-snowflake'),
(4, 'Attached Bathroom', 'fa-solid fa-bath'),
(5, 'Television', 'fa-solid fa-tv'),
(6, 'Refrigerator', 'fa-solid fa-temperature-low'),
(7, 'Room Service', 'fa-solid fa-bell-concierge'),
(8, 'Coffee Maker', 'fa-solid fa-mug-hot'),
(9, 'Work Desk', 'fa-solid fa-laptop'),
(10, 'Wardrobe/Closet', 'fa-solid fa-vest-patches'),
(11, 'Hair Dryer', 'fa-solid fa-wind'),
(12, 'Ironing Facilities', 'fa-solid fa-shirt'),
(13, 'Guest Toiletries', 'fa-solid fa-pump-soap'),
(14, 'Safe Box', 'fa-solid fa-lock'),
(15, 'Soundproofed', 'fa-solid fa-volume-mute');

-- --------------------------------------------------------

--
-- Table structure for table `common_room_types`
--

DROP TABLE IF EXISTS `common_room_types`;
CREATE TABLE IF NOT EXISTS `common_room_types` (
  `roomType_Id` int(11) NOT NULL AUTO_INCREMENT,
  `roomType_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`roomType_Id`),
  UNIQUE KEY `roomType_name` (`roomType_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `common_room_types`
--

INSERT INTO `common_room_types` (`roomType_Id`, `roomType_name`, `standard_description`) VALUES
(1, 'Single Room', 'A cozy room designed for solo travelers, featuring a single bed and basic amenities for comfort.'),
(2, 'Double Room', 'A spacious room with a double bed, ideal for couples or two guests, offering essential amenities.'),
(3, 'Triple Room', 'A room with either three single beds or a combination of beds, perfect for families or groups of three guests.'),
(4, 'Family Room', 'A large room designed for families, with multiple beds and additional space for added comfort.'),
(5, 'Deluxe Room', 'A luxurious room offering upgraded amenities, additional space, and premium furnishings for a superior stay.'),
(6, 'Executive Room', 'A premium room tailored for business travelers, featuring enhanced amenities, larger workspace, and access to executive services.'),
(7, 'Suite Room', 'A spacious and luxurious room with separate living and sleeping areas, designed for those seeking a more extravagant stay.');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(15, 2, 'assets/images/Travelers/topDistricts/badhulla/carousalGallery/Image5.jpg'),
(16, 3, 'assets/images/Travelers/topDistricts/colombo/carousalGallery/image1.webp'),
(17, 3, 'assets/images/Travelers/topDistricts/colombo/carousalGallery/image2.webp'),
(18, 3, 'assets/images/Travelers/topDistricts/colombo/carousalGallery/image3.jpg'),
(19, 3, 'assets/images/Travelers/topDistricts/colombo/carousalGallery/image4.webp'),
(20, 3, 'assets/images/Travelers/topDistricts/colombo/carousalGallery/image5.jpg');

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
  `eventType` enum('Carnival','Magic Show','Music Concert','Sports','Other') NOT NULL DEFAULT 'Other',
  `eventDate` date NOT NULL,
  `eventStartTime` time DEFAULT NULL,
  `eventEndTime` time NOT NULL,
  `eventLocation` varchar(255) NOT NULL,
  `eventStatus` enum('pending','approved','completed','cancelled','cancellation_pending') DEFAULT 'pending',
  `paymentAmount` int(11) DEFAULT NULL,
  `paymentStatus` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `rejection_reason` text,
  PRIMARY KEY (`event_Id`),
  KEY `organizer_Id` (`organizer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_Id`, `organizer_Id`, `eventWebBannerPath`, `eventThumnailPic`, `eventName`, `aboutEvent`, `eventType`, `eventDate`, `eventStartTime`, `eventEndTime`, `eventLocation`, `eventStatus`, `paymentAmount`, `paymentStatus`, `rejection_reason`) VALUES
(21, 9, '6783c77e62b0a_whimsicalWonderfestWebBanner.png', 'carnivalNew.jpg', 'Whimsical Wonderfest', 'Whimsical Wonderfest is a vibrant carnival filled with thrilling rides, dazzling light displays, live entertainment, and interactive games. Perfect for families and friends, it offers delicious treats, unique crafts, and magical experiences to create unforgettable memories. A celebration of joy, wonder, and togetherness!', 'Carnival', '2025-05-05', '19:00:00', '23:30:00', 'Nawagampura Playground, Colombo, Sri Lanka', 'approved', 3443, 'pending', NULL),
(23, 9, '6783cbd3041b7_Thundering Hooves Race.png', 'horseRace.jpg', 'Thundering Hooves Race', 'Thundering Hooves Race is a thrilling spectacle of speed and skill, featuring galloping horses and talented riders in an electrifying competition. Perfect for families and friends, enjoy exciting races, scenic views, and engaging activities. A celebration of energy, camaraderie, and the majestic spirit of equestrian sport!', 'Sports', '2025-05-10', '15:00:00', '17:30:00', 'Race Course Ground, Colombo, Sri Lanka', 'approved', NULL, 'pending', NULL),
(24, 9, '6783cebae0fd1_magicExtravaganzaWebBanner.png', 'magicShow.jpg', 'Great Magic Extravaganza', 'Get ready for a night of wonder at The Great Magic Extravaganza! Watch jaw-dropping illusions, mind-bending tricks, and a world of enchantment unfold before your eyes. It\'s a spellbinding experience you won\'t forget. Secure your tickets now for an unforgettable magical adventure!', 'Magic Show', '2025-05-15', '17:30:00', '20:30:00', 'SLECC, McCallum Road, Colombo, Sri Lanka', 'approved', NULL, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eventcommissions`
--

DROP TABLE IF EXISTS `eventcommissions`;
CREATE TABLE IF NOT EXISTS `eventcommissions` (
  `commission_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_Id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `payment_date` date NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `notes` text,
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commission_id`),
  KEY `fk_eventcommissions_event` (`event_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventcommissions`
--

INSERT INTO `eventcommissions` (`commission_id`, `event_Id`, `amount`, `reference_number`, `payment_date`, `receipt_path`, `notes`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 21, '3442.50', 'O500019329301', '2025-04-26', '/assets/commissions/eventCommissions/receipt_680cbf00a1479.Receipt432002020250418110813305000.pdf', 'Success everything', NULL, '2025-04-26 11:09:52', '2025-04-26 11:13:31'),
(2, NULL, '0.00', 'O500019329301', '2025-04-15', '/assets/commissions/eventCommissions/receipt_680d68f9d43f7.Receipt432002020250423094112578000.pdf', '', NULL, '2025-04-26 23:15:05', '2025-04-26 23:15:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_booking`
--

INSERT INTO `event_booking` (`booking_Id`, `event_Id`, `traveler_Id`, `referenceNum`, `purchasedDate`, `totalAmount`, `pathToQR`, `bookingStatus`) VALUES
(11, 21, 100020, 'WWF-6809acc392a72', '2025-04-24 08:45:15', '1400.00', 'assets/images/Travelers/generatedEventTickets/WWF-6809acc392a72_ticket.png', 'Completed'),
(12, 21, 100020, 'WWF-6809af7a4cbeb', '2025-04-24 08:56:50', '2000.00', 'assets/images/Travelers/generatedEventTickets/WWF-6809af7a4cbeb_ticket.png', 'Completed'),
(13, 21, 100020, 'WWF-6809f5074db93', '2025-04-24 13:53:35', '500.00', 'assets/images/Travelers/generatedEventTickets/WWF-6809f5074db93_ticket.png', 'Completed'),
(14, 21, 100020, 'WWF-680bb2e65f24f', '2025-04-25 21:35:58', '150.00', 'assets/images/Travelers/generatedEventTickets/WWF-680bb2e65f24f_ticket.png', 'Completed'),
(15, 21, 100001, 'WWF-680d755ac08a4', '2025-04-27 05:37:54', '150.00', 'assets/images/Travelers/generatedEventTickets/WWF-680d755ac08a4_ticket.png', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `event_booking_commission`
--

DROP TABLE IF EXISTS `event_booking_commission`;
CREATE TABLE IF NOT EXISTS `event_booking_commission` (
  `commission_Id` int(11) NOT NULL AUTO_INCREMENT,
  `event_Id` int(11) NOT NULL,
  `organizer_Id` int(11) NOT NULL,
  `totalSalesAmount` decimal(10,2) NOT NULL,
  `commissionPercentage` decimal(5,2) NOT NULL DEFAULT '8.00',
  `commissionAmount` decimal(10,2) NOT NULL,
  `payableAmount` decimal(10,2) NOT NULL,
  `paymentStatus` enum('Pending','Completed') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `paymentDate` datetime DEFAULT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commission_Id`),
  KEY `event_Id` (`event_Id`),
  KEY `organizer_Id` (`organizer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_booking_commission`
--

INSERT INTO `event_booking_commission` (`commission_Id`, `event_Id`, `organizer_Id`, `totalSalesAmount`, `commissionPercentage`, `commissionAmount`, `payableAmount`, `paymentStatus`, `paymentDate`, `createdDate`, `lastUpdated`) VALUES
(2, 21, 9, '4200.00', '8.00', '336.00', '3864.00', 'Pending', NULL, '2025-04-24 08:45:16', '2025-04-27 05:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `event_booking_notifications`
--

DROP TABLE IF EXISTS `event_booking_notifications`;
CREATE TABLE IF NOT EXISTS `event_booking_notifications` (
  `event_booking_notification_Id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_Id` int(11) DEFAULT NULL,
  `booking_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_booking_notification_Id`),
  KEY `notification_Id` (`notification_Id`),
  KEY `booking_Id` (`booking_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_booking_notifications`
--

INSERT INTO `event_booking_notifications` (`event_booking_notification_Id`, `notification_Id`, `booking_Id`) VALUES
(7, 24, 11),
(8, 25, 12),
(9, 26, 13),
(10, 34, 14),
(11, 39, 15);

-- --------------------------------------------------------

--
-- Table structure for table `event_cancellations`
--

DROP TABLE IF EXISTS `event_cancellations`;
CREATE TABLE IF NOT EXISTS `event_cancellations` (
  `cancellation_Id` int(11) NOT NULL AUTO_INCREMENT,
  `event_Id` int(11) NOT NULL,
  `organizer_Id` int(11) NOT NULL,
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_date` datetime NOT NULL,
  `admin_approval_status` enum('Pending','Approved','Rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  PRIMARY KEY (`cancellation_Id`),
  KEY `event_Id` (`event_Id`),
  KEY `organizer_Id` (`organizer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_cancellations`
--

INSERT INTO `event_cancellations` (`cancellation_Id`, `event_Id`, `organizer_Id`, `cancellation_reason`, `cancellation_date`, `admin_approval_status`) VALUES
(1, 23, 9, 'Unavoidable Circumtances', '2025-04-24 09:25:35', 'Pending');

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
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `company_logo` varchar(255) DEFAULT 'defaultLogo.png',
  `company_Address` varchar(255) NOT NULL,
  `organizer_Rating` decimal(2,1) DEFAULT NULL,
  `approved` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`organizer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_organizer`
--

INSERT INTO `event_organizer` (`organizer_Id`, `company_Email`, `company_Password`, `company_MobileNum`, `company_Name`, `status`, `company_logo`, `company_Address`, `organizer_Rating`, `approved`) VALUES
(9, 'test@gmail.com', '$2y$10$iVw3YNY2bQ/qwnsxH1qI2OvfImRKWidAwpFGzhdEI0cIIit38Toqe', '0747755123', 'Test Workflow', 'enabled', 'assets/images/eventOrganizers/logos/defaultLogo.png', 'J-4, Sirirajasiri 01, Rajamaga road, colombo-15', NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `event_organizer_bank`
--

DROP TABLE IF EXISTS `event_organizer_bank`;
CREATE TABLE IF NOT EXISTS `event_organizer_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organizer_id` int(11) NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organizer_id` (`organizer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `event_organizer_bank`
--

INSERT INTO `event_organizer_bank` (`id`, `organizer_id`, `account_name`, `account_number`, `bank_name`, `created_at`) VALUES
(10, 9, 'sarma', '8214659898', 'Commercial', '2025-04-25 12:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `event_refunds`
--

DROP TABLE IF EXISTS `event_refunds`;
CREATE TABLE IF NOT EXISTS `event_refunds` (
  `refund_Id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_Id` int(11) NOT NULL,
  `cancellation_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `refund_amount` decimal(10,2) NOT NULL,
  `refund_status` enum('Processing','Refunded','Not Eligible') COLLATE utf8mb4_unicode_ci DEFAULT 'Processing',
  `refund_initiated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`refund_Id`),
  KEY `booking_Id` (`booking_Id`),
  KEY `cancellation_Id` (`cancellation_Id`),
  KEY `traveler_Id` (`traveler_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_terms_conditions`
--

INSERT INTO `event_terms_conditions` (`termAndCond_Id`, `termAndCondition`, `created_at`, `updated_at`) VALUES
(1, 'Attendees must present a valid ticket (printed or electronic) at the event entrance.', '2025-01-10 12:08:47', '2025-01-10 12:08:47'),
(2, 'All ticket purchases are final and non-refundable unless the event is canceled or rescheduled by the organizer.', '2025-01-10 12:09:04', '2025-01-10 12:09:04'),
(3, 'Any individual engaging in inappropriate behavior, including disruption or violation of safety guidelines, may be denied entry or removed from the event without a refund.', '2025-01-10 12:09:18', '2025-01-10 12:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket_purchasers`
--

DROP TABLE IF EXISTS `event_ticket_purchasers`;
CREATE TABLE IF NOT EXISTS `event_ticket_purchasers` (
  `purchaser_Id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_Id` int(11) NOT NULL,
  `fullName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobileNum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchaser_Id`),
  KEY `booking_Id` (`booking_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_ticket_purchasers`
--

INSERT INTO `event_ticket_purchasers` (`purchaser_Id`, `booking_Id`, `fullName`, `nic`, `email`, `mobileNum`, `created_at`) VALUES
(8, 11, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490', '2025-04-24 08:45:16'),
(9, 12, 'Mubarak', '200412361088', 'mubarak11@gmail.com', '0773535351', '2025-04-24 08:56:50'),
(10, 13, 'Abdul Rahman', '200864128256', 'ya@gmail.com', '0789855890', '2025-04-24 13:53:36'),
(11, 14, 'nihmath jabir', '12345679900', 'test@gmail.com', '0756742490', '2025-04-25 21:35:59'),
(12, 15, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490', '2025-04-27 05:37:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_ticket_type`
--

INSERT INTO `event_ticket_type` (`eventTicketType_Id`, `event_Id`, `ticketTypeName`, `ticketTypeDescription`, `pricePerTicket`, `totalTickets`, `availableTickets`) VALUES
(4, 21, 'Kids Entance Ticket', 'Entrance fee for kids below 10 years of age', '150.00', 100, 97),
(5, 21, 'General Entrance Ticket', 'Entrance fee for individuals aged 10 years and above', '250.00', 100, 97),
(6, 21, 'Family Entrance Ticket', 'Discounted Entry for families with 2 adults and up to 3 kids', '1000.00', 50, 47),
(8, 23, 'General Admission', 'Access to the main viewing areas and event activities.', '300.00', 100, 100),
(9, 23, 'Trackside Experience', 'Up-close views near the track, meet-and-greet with riders, and a behind-the-scenes tour.', '750.00', 100, 100),
(10, 23, 'VIP Pass', 'Premium seating, exclusive lounge access, and complimentary refreshments.', '1500.00', 50, 50),
(11, 24, 'Standard Ticket', 'Experience the magic from a great spot at an affordable price.', '500.00', 250, 250),
(12, 24, 'Family Package', 'Enjoy a magical night for the whole family with 5 tickets at a discounted rate.', '2000.00', 100, 100),
(13, 24, 'VIP Ticket', 'Enjoy front-row seats and an exclusive meet with the magicians for a truly unforgettable experience.', '1000.00', 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotelName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serviceProviderName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelEmail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelPassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelMobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelAddress` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelLogo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelLatitude` decimal(15,10) DEFAULT NULL,
  `hotelLongtitude` decimal(15,10) DEFAULT NULL,
  `description_para1` text COLLATE utf8mb4_unicode_ci,
  `description_para2` text COLLATE utf8mb4_unicode_ci,
  `description_para3` text COLLATE utf8mb4_unicode_ci,
  `totalRooms` int(11) DEFAULT NULL,
  `BRNum` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearStarted` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `status` enum('enabled','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  PRIMARY KEY (`hotel_Id`),
  UNIQUE KEY `hotelEmail` (`hotelEmail`),
  UNIQUE KEY `hotelMobileNum` (`hotelMobileNum`),
  UNIQUE KEY `BRNum` (`BRNum`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_Id`, `hotelName`, `serviceProviderName`, `hotelEmail`, `hotelPassword`, `hotelMobileNum`, `hotelAddress`, `hotelLogo`, `district`, `province`, `hotelLatitude`, `hotelLongtitude`, `description_para1`, `description_para2`, `description_para3`, `totalRooms`, `BRNum`, `yearStarted`, `approved`, `status`) VALUES
(17, 'Test Hotel', 'Test User', 'test@gmail.com', '$2y$10$ASGRYZg8FMhlBunjYIq91.HQZBTwLOPmVnYOn34CLORRhhJ2GDWx6', '0112525444', 'J-4, Wanagampura 10, State Road, Colombo 12', NULL, 'Colombo', 'Western', NULL, NULL, NULL, NULL, NULL, NULL, '2022IS001', '2025', 'yes', 'enabled'),
(18, 'Araliya Green Hills Hotel', 'Dudley Sirisena', 'info@araliyagreenhills.com', '$2y$10$m8TdQk5UVV19Ds8AJIl/9.JyPh.pv7x8n7vTkOVhuTOvvBi5s/Dbu', '0522224150', 'NO: 10, Glenfall road Nuwara Eliya 22200, Sri Lanka', 'uploads/hotels/18/logo/araliyaLogo.jpg', 'Nuwara Eliya', 'Central', '6.9671096000', '80.7646179000', 'Nestled in the heart of Nuwara Eliya, Araliya Green Hills Hotel offers a perfect blend of luxury and relaxation. Surrounded by misty hill country landscapes, \r\nit provides an ideal retreat for travelers seeking comfort and elegance. Guests can enjoy well-appointed rooms, \r\nstunning views of rolling hills and vibrant gardens, and easy access to charming attractions of Nuwara Eliya, \r\nmaking it a haven for nature lovers and adventurers alike.', 'The hotel offers well-appointed rooms with modern amenities, providing a relaxing escape after exploring Nuwara Eliya. \r\nGuests can start their day with fresh mountain air and breathtaking views of misty hills and vibrant gardens. On-site dining options cater to diverse palates with a variety of local and international cuisines, while the cozy outdoor seating areas create a serene atmosphere to unwind and take in the stunning scenery.', 'Conveniently located near the towns iconic attractions, Araliya Green Hills Hotel is an ideal base for exploring Gregory Lake, Hakgala Botanical Garden, \r\nand Horton Plains National Park. \r\nWhether seeking a romantic escape, a family vacation, or a peaceful getaway, this luxurious hotel blends warm hospitality with unparalleled comfort, \r\nensuring a memorable stay in the heart of Sri Lankas hill country.', NULL, '2022IS045', '2013', 'yes', 'enabled'),
(19, 'The Heritage Grand Hotel', 'J. H. P. Ratnayeke', 'thegrand@slt.net', '$2y$10$3csF/gO71wUyJck9rJgMTel7UzbCXc7rq4vrjaEDJW9Cs/CG82P2q', '0522222881', 'No: 05, Grand Hotel Road Nuwara Eliya 22200, Sri Lanka â€‹', 'uploads/hotels/19/logo/heritageGrandLogo.jpg', 'Nuwara Eliya', 'Central', '6.9683571015', '80.7651287972', 'Steeped in colonial charm and nestled amidst the cool highlands of Nuwara Eliya, The Grand Hotel offers a timeless retreat where luxury meets history. Surrounded by beautifully manicured gardens and mist-kissed mountain scenery, perfect sanctuary for travelers seeking elegance, comfort, and a touch of heritage.', 'The hotel features tastefully designed rooms and suites that blend classic Victorian aesthetics with modern amenities. Guests can wake up to the soothing sound of nature and enjoy panoramic views of lush greenery and serene landscapes. With gourmet dining experiences ranging from international delicacies to authentic Sri Lankan cuisine, The Grand Hotel caters to every culinary desire, all in settings that radiate warmth and sophistication.', 'Ideally located close to popular attractions such as Gregory Lake, Victoria Park, and the Nuwara Eliya Golf Club, The Grand Hotel is a gateway to adventure and exploration in the hill country. Whether you are looking for a romantic escape, a relaxing family holiday, or a heritage-rich getaway, this iconic hotel promises a memorable and enchanting stay.', NULL, '2022IS033', '1891', 'yes', 'enabled'),
(20, 'thags', 'Sarma', 'H1@gmail.com', '$2y$10$glICf.gh5otYgdw9XGsTGuFuQUW8yTdjEaWWGi4h.7TM/5LlLh6Ta', '0760454548', 'sarma', NULL, 'jaffna', 'North West', NULL, NULL, NULL, NULL, NULL, NULL, 'serhf47', '2000', 'no', 'enabled');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_commissions`
--

DROP TABLE IF EXISTS `hotel_commissions`;
CREATE TABLE IF NOT EXISTS `hotel_commissions` (
  `commission_Id` int(11) NOT NULL AUTO_INCREMENT,
  `room_booking_Id` int(11) NOT NULL,
  `hotel_Id` int(11) NOT NULL,
  `batch_Id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT '8.00',
  `commission_amount` decimal(10,2) NOT NULL,
  `is_applicable_for_commission` int(11) NOT NULL DEFAULT '1',
  `if_not_applicable_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Approved','Pending','Denied') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`commission_Id`),
  KEY `room_booking_Id` (`room_booking_Id`),
  KEY `hotel_Id` (`hotel_Id`),
  KEY `batch_Id` (`batch_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_commissions`
--

INSERT INTO `hotel_commissions` (`commission_Id`, `room_booking_Id`, `hotel_Id`, `batch_Id`, `total_amount`, `commission_rate`, `commission_amount`, `is_applicable_for_commission`, `if_not_applicable_reason`, `created_at`, `status`) VALUES
(2, 10000001, 18, NULL, '10000.00', '8.00', '800.00', 1, NULL, '2025-04-17 18:34:51', 'Approved'),
(3, 10000002, 18, NULL, '70000.00', '8.00', '5600.00', 1, NULL, '2025-04-17 18:36:06', 'Approved'),
(4, 10000003, 18, NULL, '105000.00', '8.00', '8400.00', 1, NULL, '2025-04-17 18:37:06', 'Approved'),
(5, 10000005, 18, NULL, '105000.00', '8.00', '8400.00', 1, NULL, '2025-04-17 18:37:57', 'Approved'),
(18, 10000025, 19, NULL, '45000.00', '8.00', '3600.00', 0, 'Cancelled by traveler', '2025-04-20 01:35:00', 'Approved'),
(19, 10000027, 18, NULL, '30000.00', '8.00', '2400.00', 0, 'Cancelled by traveler', '2025-04-25 10:49:05', 'Approved'),
(20, 10000031, 18, NULL, '52500.00', '8.00', '4200.00', 0, 'Cancelled by traveler', '2025-04-25 21:25:32', 'Approved'),
(22, 10000033, 18, NULL, '40000.00', '8.00', '3200.00', 0, 'Cancelled by traveler', '2025-04-27 02:58:22', 'Approved'),
(23, 10000034, 18, NULL, '105000.00', '8.00', '8400.00', 1, NULL, '2025-04-28 01:46:33', 'Approved'),
(24, 10000035, 18, NULL, '60000.00', '8.00', '4800.00', 0, 'Cancelled by traveler', '2025-04-28 14:40:05', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_commission_payment_batches`
--

DROP TABLE IF EXISTS `hotel_commission_payment_batches`;
CREATE TABLE IF NOT EXISTS `hotel_commission_payment_batches` (
  `batch_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_Id` int(11) NOT NULL,
  `billing_period_start_date` date NOT NULL,
  `billing_period_end_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Paid','Partial','Waived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `due_date` date NOT NULL,
  `payment_paid_date` datetime DEFAULT NULL,
  `transaction_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`batch_Id`),
  KEY `hotel_Id` (`hotel_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_guests`
--

DROP TABLE IF EXISTS `hotel_guests`;
CREATE TABLE IF NOT EXISTS `hotel_guests` (
  `guest_Id` int(11) NOT NULL AUTO_INCREMENT,
  `room_booking_Id` int(11) NOT NULL,
  `guest_full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_nic` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_mobile_num` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`guest_Id`),
  KEY `room_booking_Id` (`room_booking_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_guests`
--

INSERT INTO `hotel_guests` (`guest_Id`, `room_booking_Id`, `guest_full_name`, `guest_nic`, `guest_email`, `guest_mobile_num`) VALUES
(15, 10000001, 'Hashir Ahmadh', '200210203040', 'hashir123@gmail.com', '0775400167'),
(16, 10000002, 'Abdul Raheem', '200220408016', 'raheem234@gmail.com', '0769634145'),
(17, 10000003, 'Hamdhi Hamza', '200105101520', 'hamdhi345@gmail.com', '0751626864'),
(19, 10000005, ' Amanda Nethmini', '200211223344', 'amanda456@gmail.com', '0701528048'),
(25, 10000015, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490'),
(26, 10000016, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490'),
(27, 10000017, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(28, 10000018, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(29, 10000019, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(30, 10000020, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(31, 10000021, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(32, 10000022, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(33, 10000023, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(34, 10000024, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(35, 10000025, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(36, 10000026, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(37, 10000026, 'Nihmath', '200209102877', 'mnnjabir@gmail.com', '0756742490'),
(38, 10000027, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490'),
(39, 10000028, 'thagshan', '200040008000', 'thagshan@gmail.com', '0745656658'),
(40, 10000029, 'Shimha', '200101020352', 'shim@gmail.com', '0789651452'),
(41, 10000030, 'sdfghjkl', '2000025555', 'mnnjabir@gmail.com', '0022255555'),
(42, 10000031, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490'),
(43, 10000032, 'Test User', '', 'test@gmail.com', '0715770109'),
(44, 10000033, 'Test User', '200209102877', 'test@gmail.com', '0715770109'),
(45, 10000034, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490'),
(46, 10000035, 'Nihmath Jabir', '200209102877', 'mnnjabir@gmail.com', '0756742490');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_pics`
--

DROP TABLE IF EXISTS `hotel_pics`;
CREATE TABLE IF NOT EXISTS `hotel_pics` (
  `hotel_pic_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_Id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`hotel_pic_Id`),
  KEY `hotel_id` (`hotel_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_pics`
--

INSERT INTO `hotel_pics` (`hotel_pic_Id`, `hotel_Id`, `image_path`) VALUES
(6, 18, 'uploads/hotels/18/hotelPics/image1.jpg'),
(7, 18, 'uploads/hotels/18/hotelPics/image2.jpg'),
(8, 18, 'uploads/hotels/18/hotelPics/image3.jpg'),
(9, 18, 'uploads/hotels/18/hotelPics/image4.jpg'),
(10, 18, 'uploads/hotels/18/hotelPics/image5.jpg'),
(11, 19, 'uploads/hotels/19/hotelPics/image1.jpg'),
(12, 19, 'uploads/hotels/19/hotelPics/image2.jpg'),
(13, 19, 'uploads/hotels/19/hotelPics/image3.jpg'),
(14, 19, 'uploads/hotels/19/hotelPics/image4.jpg'),
(15, 19, 'uploads/hotels/19/hotelPics/image5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_reviews`
--

DROP TABLE IF EXISTS `hotel_reviews`;
CREATE TABLE IF NOT EXISTS `hotel_reviews` (
  `review_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `room_booking_Id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_Id`),
  UNIQUE KEY `room_booking_Id` (`room_booking_Id`),
  KEY `hotel_Id` (`hotel_Id`),
  KEY `traveler_Id` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_reviews`
--

INSERT INTO `hotel_reviews` (`review_Id`, `hotel_Id`, `traveler_Id`, `room_booking_Id`, `rating`, `review_text`, `created_at`) VALUES
(5, 18, 100011, 10000001, 5, 'I had an amazing stay at Araliya Green Hills! The location is perfectâ€”surrounded by lush greenery and misty mountains. The rooms were spacious, cozy, and well-kept. The staff was incredibly warm and attentive. Highly recommend for a peaceful retreat in Nuwara Eliya!', '2025-04-03 14:39:13'),
(6, 18, 100012, 10000002, 4, 'The hotel is beautiful and has a calming atmosphere. The mountain views from the balcony were breathtaking. The rooms very clean. Would love to come back again, though a few more heaters would have been nice during the cold evenings.', '2025-04-07 10:48:51'),
(7, 18, 100013, 10000003, 5, 'Araliya Green Hills made our family trip unforgettable. Kids loved the indoor pool, and we appreciated the prompt service and cleanliness. Itâ€™s walking distance from Gregory Lake and the town, which made exploring easy. Great value for the expence', '2025-04-07 16:58:59'),
(9, 18, 100014, 10000005, 4, 'Our stay at Araliya Green Hills was nothing short of delightful. From the warm welcome at check-in to the beautifully maintained rooms, everything felt premium.  Would definitely come back for another relaxing holiday!', '2025-04-10 13:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_types`
--

DROP TABLE IF EXISTS `hotel_room_types`;
CREATE TABLE IF NOT EXISTS `hotel_room_types` (
  `hotel_roomType_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_Id` int(11) NOT NULL,
  `roomType_Id` int(11) NOT NULL,
  `customized_description` text COLLATE utf8mb4_unicode_ci,
  `pricePer_night` decimal(10,2) NOT NULL,
  `max_occupancy` int(11) NOT NULL,
  `thumbnail_picPath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rooms` int(11) DEFAULT NULL,
  PRIMARY KEY (`hotel_roomType_Id`),
  KEY `hotel_Id` (`hotel_Id`),
  KEY `roomType_Id` (`roomType_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_room_types`
--

INSERT INTO `hotel_room_types` (`hotel_roomType_Id`, `hotel_Id`, `roomType_Id`, `customized_description`, `pricePer_night`, `max_occupancy`, `thumbnail_picPath`, `total_rooms`) VALUES
(28, 17, 1, 'Test', '7500.00', 1, 'uploads/hotels/16/roomTypesImages/roomtype_67a8bb08d77e1_singleRoom.jpg', 5),
(29, 18, 1, 'A cozy and comfortable single room designed for solo travelers. Enjoy a restful stay with a plush bed, modern amenities, free Wi-Fi, and a private bathroom. ', '10000.00', 1, 'uploads/hotels/18/roomTypesImages/roomtype_67ab123b32d43_singleRoom.jpg', 5),
(30, 18, 2, 'A spacious and inviting double room, perfect for couples or friends. Featuring a comfortable double bed, modern amenities, free Wi-Fi, and a private bathroom for a relaxing stay. ', '17500.00', 2, 'uploads/hotels/18/roomTypesImages/roomtype_67ab12b7dba4e_doubleRoom.jpg', 5),
(31, 18, 4, 'Perfect for families or groups for a relaxing stay. Equipped with multiple beds, modern amenities, free Wi-Fi, and a private bathroom, ', '35000.00', 5, 'uploads/hotels/18/roomTypesImages/roomtype_67ab135d517e0_familyRoom.jpg', 5),
(33, 18, 5, 'Experience luxury in our Deluxe Room, offering a plush king-size bed, modern amenities, free Wi-Fi, and a private balcony with breathtaking scenic views.', '50000.00', 4, 'uploads/hotels/18/roomTypesImages/roomtype_67c5e734acdf4_img1.jpg', 5),
(34, 19, 5, 'Step into timeless charm with our Deluxe Rooms, featuring classic colonial dÃ©cor, cozy interiors, and views of lush gardens or misty hills. Ideal for couples or small families seeking relaxation in Nuwara Eliya\'s cool climate.', '45000.00', 3, 'uploads/hotels/19/roomTypesImages/roomtype_67fffd206b311_Grand-hotel-Deluxe-Room.jpg', 10),
(35, 19, 7, 'Experience grandeur in our lavish Presidential Suite with two bedrooms, a private lounge, fireplaces, and signature butler service. Designed for families or groups craving the ultimate indulgence in Nuwara Eliya.\r\n\r\n', '60000.00', 4, 'uploads/hotels/19/roomTypesImages/roomtype_67fffdefbd125_Grand-hotel-Suit-Room.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_type_amenities`
--

DROP TABLE IF EXISTS `hotel_room_type_amenities`;
CREATE TABLE IF NOT EXISTS `hotel_room_type_amenities` (
  `hotelRoomTypeAmenitie_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotelRoomType_Id` int(11) DEFAULT NULL,
  `amenity_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`hotelRoomTypeAmenitie_Id`),
  KEY `hotelRoomType_Id` (`hotelRoomType_Id`),
  KEY `amenity_Id` (`amenity_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_room_type_amenities`
--

INSERT INTO `hotel_room_type_amenities` (`hotelRoomTypeAmenitie_Id`, `hotelRoomType_Id`, `amenity_Id`) VALUES
(8, 14, 2),
(9, 14, 3),
(10, 13, 4),
(11, 13, 10),
(12, 15, 13),
(13, 29, 2),
(14, 29, 3),
(15, 29, 4),
(16, 30, 2),
(17, 30, 3),
(18, 30, 4),
(19, 30, 10),
(20, 30, 13),
(21, 31, 2),
(22, 31, 3),
(23, 31, 4),
(24, 31, 6),
(25, 31, 8),
(26, 31, 10),
(27, 31, 13),
(29, 33, 2),
(30, 33, 3),
(31, 33, 4),
(32, 33, 5),
(33, 33, 6),
(34, 33, 7),
(35, 34, 2),
(36, 34, 3),
(37, 34, 4),
(38, 34, 8),
(39, 34, 10),
(40, 34, 13),
(41, 35, 2),
(42, 35, 3),
(43, 35, 4),
(44, 35, 6),
(45, 35, 8),
(46, 35, 9),
(47, 35, 10),
(48, 35, 11),
(49, 35, 12),
(50, 35, 13);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `availability` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `restaurant_id`, `name`, `description`, `price`, `category`, `availability`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(15, 6, 'puttu', 'jafna', '123.00', 'Appetizer', 'breakfast', '/Uploads/menuItems/menu_680b96ab522811.58820933.jpg', 0, '2025-04-25 14:05:31', '2025-04-25 14:53:25'),
(17, 6, 'asdq', 'sfds', '123.00', 'Appetizer', 'breakfast', '/Uploads/menuItems/menu_680ba1957d30d4.95987927.jpg', 0, '2025-04-25 14:52:05', '2025-04-25 14:53:18'),
(20, 31, 'menu1', 'menu1', '100.00', 'Appetizer', 'breakfast', '/Uploads/menuItems/menu_680e04b0e332e4.72261816.png', 1, '2025-04-27 10:19:28', '2025-04-27 10:46:30'),
(21, 31, 'aa', 'aa', '12.00', 'Main Course', 'breakfast', '/Uploads/menuItems/menu_680e0bc764c1d3.54212120.png', 1, '2025-04-27 10:49:43', '2025-04-27 10:49:43'),
(22, 31, 'uytfdghjkl', 'ghjkilolukjhfg', '1234567.00', 'Main Course', 'alltime', '/Uploads/menuItems/680e0cb1806047.64555091.png', 0, '2025-04-27 10:53:37', '2025-04-27 11:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_Id` int(11) DEFAULT NULL,
  `traveler_Id` int(11) DEFAULT NULL,
  `sender_type` enum('hotel','traveler') COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `hotel_Id` (`hotel_Id`),
  KEY `traveler_Id` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `hotel_Id`, `traveler_Id`, `sender_type`, `conversations`, `timestamp`, `is_read`) VALUES
(1, 18, 100001, 'traveler', 'hi', '2025-04-19 01:29:31', 0),
(2, 18, 100001, 'hotel', 'hello', '2025-04-19 01:29:50', 0),
(3, 18, 100004, 'traveler', 'hi', '2025-04-19 01:29:31', 1),
(4, 18, 100009, 'traveler', 'hello', '2025-04-19 01:29:50', 0),
(5, 18, 100010, 'hotel', 'Hey, are you checked in already?', '2025-04-18 09:10:00', 0),
(6, 18, 100001, 'traveler', 'Yes, I arrived this morning.', '2025-04-18 09:11:30', 1),
(7, 18, 100001, 'hotel', 'Nice! Let’s meet in the lobby.', '2025-04-18 09:12:45', 0),
(8, 18, 100001, 'traveler', 'Your room service will arrive shortly.', '2025-04-18 14:20:00', 1),
(9, 18, 100001, 'hotel', 'Thanks, I’ll be waiting.', '2025-04-18 14:22:00', 0),
(10, 18, 100004, 'traveler', 'Can I get an early check-in tomorrow?', '2025-04-17 20:00:00', 1),
(11, 18, 100001, 'hotel', 'Sure, we’ll have it ready by 11 AM.', '2025-04-17 20:02:30', 0),
(12, 18, 100001, 'traveler', 'Please confirm your reservation details.', '2025-04-16 16:45:00', 1),
(13, 18, 100001, 'hotel', 'Reservation for 2 nights, correct?', '2025-04-16 16:46:10', 0),
(14, 18, 100001, 'traveler', 'Yes, that’s right. Thank you!', '2025-04-16 16:47:00', 1),
(49, 18, 100004, 'hotel', 'hi', '2025-04-27 13:39:20', 0),
(50, 18, 100010, 'hotel', 'heloo', '2025-04-28 13:56:59', 0),
(51, 18, 100004, 'hotel', 'hi', '2025-04-28 14:57:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_Id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_type` enum('admin','traveler','hotel','tourguide','event_organizer','travel_service_provider') COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_Id` int(11) NOT NULL,
  `notification_type` enum('accommodation_related','event_related','tourguide_related','vehicle_related') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notification_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_Id`, `recipient_type`, `recipient_Id`, `notification_type`, `notification_title`, `notification_text`, `is_read`, `created_at`) VALUES
(10, 'traveler', 100001, 'accommodation_related', 'Booking Request Submitted for The Heritage Grand Hotel', 'Your booking request for The Heritage Grand Hotel has been successfully submitted. \r\n                                                Please make the advance payment before April 23, 2025 at 11:59 PM to confirm your booking', 1, '2025-04-19 23:35:25'),
(13, 'traveler', 100001, 'accommodation_related', 'Advance Payment Received for The Heritage Grand Hotel', 'We have received your advance payment for The Heritage Grand Hotel. Your booking is now confirmed. Get ready for a memorable stay!', 1, '2025-04-20 12:01:43'),
(14, 'traveler', 100001, 'accommodation_related', 'Booking Canceled for The Heritage Grand Hotel', 'Your booking at The Heritage Grand Hotel has been successfully canceled. If eligible, you can track your refund status in the \"My Bookings\" section.', 1, '2025-04-20 12:56:53'),
(24, 'traveler', 100020, 'event_related', 'Ticket Purchase Confirmed for Whimsical Wonderfest', 'Your ticket purchase for Whimsical Wonderfest was successful. We are excited to have you join us. Get ready for an unforgettable experience!', 1, '2025-04-24 08:45:16'),
(25, 'traveler', 100020, 'event_related', 'Ticket Purchase Confirmed for Whimsical Wonderfest', 'Your ticket purchase for Whimsical Wonderfest was successful. We are excited to have you join us. Get ready for an unforgettable experience!', 1, '2025-04-24 08:56:50'),
(26, 'traveler', 100020, 'event_related', 'Ticket Purchase Confirmed for Whimsical Wonderfest', 'Your ticket purchase for Whimsical Wonderfest was successful. We are excited to have you join us. Get ready for an unforgettable experience!', 1, '2025-04-24 13:53:36'),
(27, 'traveler', 100020, 'accommodation_related', 'Booking Request Submitted for Araliya Green Hills Hotel', 'Your booking request for Araliya Green Hills Hotel has been successfully submitted. \r\n                                                Please make the advance payment before April 28, 2025 at 11:59 PM to confirm your booking', 1, '2025-04-25 10:49:05'),
(28, 'traveler', 100020, 'accommodation_related', 'Advance Payment Received for Araliya Green Hills Hotel', 'We have received your advance payment for Araliya Green Hills Hotel. Your booking is now confirmed. Get ready for a memorable stay!', 1, '2025-04-25 10:50:11'),
(29, 'traveler', 100020, 'tourguide_related', 'Booking Request Submitted for Ella Adventure', 'Your booking request for Ella Adventure byTest  User has been successfully submitted. Please make the advance payment upon approval.', 1, '2025-04-25 19:00:52'),
(30, 'traveler', 100020, 'accommodation_related', 'Booking Request Submitted for Araliya Green Hills Hotel', 'Your booking request for Araliya Green Hills Hotel has been successfully submitted. \r\n                                                Please make the advance payment before April 28, 2025 at 11:59 PM to confirm your booking', 1, '2025-04-25 21:25:32'),
(31, 'traveler', 100020, 'accommodation_related', 'Advance Payment Received for Araliya Green Hills Hotel', 'We have received your advance payment for Araliya Green Hills Hotel. Your booking is now confirmed. Get ready for a memorable stay!', 1, '2025-04-25 21:27:46'),
(32, 'traveler', 100020, 'accommodation_related', 'Booking Canceled for Araliya Green Hills Hotel', 'Your booking at Araliya Green Hills Hotel has been successfully canceled. If eligible, you can track your refund status in the \"My Bookings\" section.', 1, '2025-04-25 21:29:36'),
(33, 'traveler', 100020, 'tourguide_related', 'Booking Request Submitted for Ella Adventure', 'Your booking request for Ella Adventure byTest  User has been successfully submitted. Please make the advance payment upon approval.', 1, '2025-04-25 21:32:35'),
(34, 'traveler', 100020, 'event_related', 'Ticket Purchase Confirmed for Whimsical Wonderfest', 'Your ticket purchase for Whimsical Wonderfest was successful. We are excited to have you join us. Get ready for an unforgettable experience!', 1, '2025-04-25 21:35:59'),
(36, 'traveler', 100001, 'accommodation_related', 'Booking Request Submitted for Araliya Green Hills Hotel', 'Your booking request for Araliya Green Hills Hotel has been successfully submitted. \r\n                                                Please make the advance payment before April 30, 2025 at 11:59 PM to confirm your booking', 1, '2025-04-27 02:58:22'),
(37, 'traveler', 100001, 'accommodation_related', 'Advance Payment Received for Araliya Green Hills Hotel', 'We have received your advance payment for Araliya Green Hills Hotel. Your booking is now confirmed. Get ready for a memorable stay!', 1, '2025-04-27 03:55:19'),
(38, 'traveler', 100001, 'accommodation_related', 'Booking Canceled for Araliya Green Hills Hotel', 'Your booking at Araliya Green Hills Hotel has been successfully canceled. If eligible, you can track your refund status in the \"My Bookings\" section.', 0, '2025-04-27 04:51:29'),
(39, 'traveler', 100001, 'event_related', 'Ticket Purchase Confirmed for Whimsical Wonderfest', 'Your ticket purchase for Whimsical Wonderfest was successful. We are excited to have you join us. Get ready for an unforgettable experience!', 0, '2025-04-27 05:37:55'),
(40, 'traveler', 100001, 'tourguide_related', 'Booking Request Submitted for Ella Adventure', 'Your booking request for Ella Adventure byTest  User has been successfully submitted. Please make the advance payment upon approval.', 0, '2025-04-27 06:27:16'),
(41, 'traveler', 100020, 'accommodation_related', 'Booking Canceled for Araliya Green Hills Hotel', 'Your booking at Araliya Green Hills Hotel has been successfully canceled. If eligible, you can track your refund status in the \"My Bookings\" section.', 1, '2025-04-27 18:14:25'),
(42, 'traveler', 100020, 'tourguide_related', 'Booking Request Submitted for Ella Adventure', 'Your booking request for Ella Adventure byMohamed Zakey Abdulla has been successfully submitted. Please make the advance payment upon approval.', 1, '2025-04-28 01:34:42'),
(43, 'traveler', 100020, 'accommodation_related', 'Booking Request Submitted for Araliya Green Hills Hotel', 'Your booking request for Araliya Green Hills Hotel has been successfully submitted. \r\n                                                Please make the advance payment before May 01, 2025 at 11:59 PM to confirm your booking', 1, '2025-04-28 01:46:33'),
(44, 'traveler', 100020, 'tourguide_related', 'Booking Request Submitted for Ella Adventure', 'Your booking request for Ella Adventure byMohamed Zakey Abdulla has been successfully submitted. Please make the advance payment upon approval.', 1, '2025-04-28 02:39:43'),
(45, 'traveler', 100020, 'accommodation_related', 'Booking Request Submitted for Araliya Green Hills Hotel', 'Your booking request for Araliya Green Hills Hotel has been successfully submitted. \r\n                                                Please make the advance payment before May 01, 2025 at 11:59 PM to confirm your booking', 1, '2025-04-28 14:40:05'),
(46, 'traveler', 100020, 'accommodation_related', 'Advance Payment Received for Araliya Green Hills Hotel', 'We have received your advance payment for Araliya Green Hills Hotel. Your booking is now confirmed. Get ready for a memorable stay!', 1, '2025-04-28 14:42:14'),
(47, 'traveler', 100020, 'accommodation_related', 'Booking Canceled for Araliya Green Hills Hotel', 'Your booking at Araliya Green Hills Hotel has been successfully canceled. If eligible, you can track your refund status in the \"My Bookings\" section.', 1, '2025-04-28 14:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','open','closed') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `word_count` int(11) DEFAULT '0',
  `char_count` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `hotel_Id` int(11) NOT NULL,
  PRIMARY KEY (`report_id`),
  KEY `hotel_Id` (`hotel_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `category`, `subject`, `description`, `email`, `priority`, `status`, `word_count`, `char_count`, `created_at`, `updated_at`, `hotel_Id`) VALUES
(1, 'payment', 'To book my seats', 'hgchgjvjhj', 'test@gmail.com', 'low', 'pending', 1, 10, '2025-04-22 10:31:48', '2025-04-22 10:31:48', 16),
(2, 'technical', 'To book my seats', 'dqdqdwqd', 'test@gmail.com', 'high', 'pending', 1, 8, '2025-04-22 10:32:38', '2025-04-22 10:32:38', 16),
(3, 'technical', 'hojo', 'cfghjol;;lkhgc', 'test@gmail.com', 'medium', 'pending', 2, 14, '2025-04-22 10:55:55', '2025-04-22 10:55:55', 16),
(4, 'payment', 'To book my seats', '.klnkjbljklknl', 'hi@gmail.com', 'high', 'pending', 1, 14, '2025-04-22 10:56:59', '2025-04-22 10:56:59', 16),
(5, 'technical', 'To book my seats', '\\zsdfyjukolkjhbvcx', 'arulthags01@gmail.com', 'medium', 'pending', 1, 18, '2025-04-22 12:48:24', '2025-04-22 12:48:24', 16),
(6, 'other', 'ho', 'jhgffghjkl;&#039;', 'thagshan11@gmail.com', 'high', 'pending', 2, 12, '2025-04-23 00:32:49', '2025-04-23 00:32:49', 16);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `table_id`, `customer_name`, `date`, `start_time`, `end_time`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'sarma', '2025-04-23', '01:00:00', '02:00:00', 'sa', '2025-04-23 13:49:13', '2025-04-23 13:49:13'),
(5, 1, 'a', '2025-04-24', '01:00:00', '02:00:00', '', '2025-04-24 07:38:16', '2025-04-24 07:38:16'),
(6, 2, 'shayan', '2025-04-24', '13:00:00', '14:00:00', 'liauwgdf', '2025-04-24 12:05:27', '2025-04-24 12:05:27'),
(7, 1, 'sarma', '2025-04-25', '01:00:00', '02:00:00', 'sarma', '2025-04-25 02:09:45', '2025-04-25 02:09:45'),
(8, 1, 'thagshan', '2025-04-25', '18:00:00', '20:00:00', 'bday\r\n', '2025-04-25 01:27:28', '2025-04-25 01:27:28'),
(9, 2, 'anbashayan', '2025-04-25', '18:00:00', '20:00:00', 'wedding party', '2025-04-25 01:28:09', '2025-04-25 01:28:09'),
(10, 5, 'abdulla', '2025-04-25', '18:00:00', '20:00:00', 'birthday party', '2025-04-25 01:28:35', '2025-04-25 01:28:35'),
(11, 2, 'ajay', '2025-04-25', '13:00:00', '15:00:00', 'for lunch with family', '2025-04-25 05:03:22', '2025-04-25 05:03:22'),
(12, 6, 'jabir', '2025-04-25', '18:00:00', '20:00:00', 'jabirs', '2025-04-25 01:48:09', '2025-04-25 01:48:09'),
(14, 1, 'sdf', '2025-04-25', '03:00:00', '04:00:00', 'asd', '2025-04-25 14:58:26', '2025-04-25 14:58:26'),
(16, 1, 'aa', '2025-04-26', '07:01:00', '08:01:00', 's\r\n', '2025-04-25 21:56:02', '2025-04-26 03:27:31'),
(17, 1, 'sad', '2025-04-26', '18:00:00', '20:00:00', 'sdf', '2025-04-26 06:19:54', '2025-04-26 06:19:54'),
(18, 1, 'asdfghj', '2025-04-29', '18:00:00', '20:00:00', 's', '2025-04-26 06:24:10', '2025-04-26 06:24:10'),
(21, 21, 'boomer', '2025-04-27', '18:00:00', '20:00:00', 'aa', '2025-04-27 05:41:47', '2025-04-27 14:34:03'),
(22, 21, 'summa', '2025-04-27', '15:00:00', '16:00:00', '', '2025-04-27 09:14:59', '2025-04-27 09:14:59'),
(24, 12, 'fghjkl', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:39:58', '2025-04-27 13:39:58'),
(25, 12, 'fghjkl', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:40:35', '2025-04-27 13:40:35'),
(26, 12, 'dfghjkl', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:41:15', '2025-04-27 13:41:15'),
(27, 6, 'ghjkl', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:41:51', '2025-04-27 13:41:51'),
(28, 1, 'jyskguh', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:42:36', '2025-04-27 13:42:36'),
(29, 17, 'ertyuij', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:43:49', '2025-04-27 13:43:49'),
(30, 1, 'dsghhjkl', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:45:57', '2025-04-27 13:45:57'),
(31, 15, 'erugbjil', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:46:42', '2025-04-27 13:46:42'),
(32, 14, 'dsjhhbkjk', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:47:20', '2025-04-27 13:47:20'),
(33, 1, 'a', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:54:04', '2025-04-27 13:54:04'),
(34, 1, 'a', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:54:28', '2025-04-27 13:54:28'),
(35, 1, 'a', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 13:54:42', '2025-04-27 13:54:42'),
(36, 22, 'xxx', '2025-04-27', '01:00:00', '02:00:00', '', '2025-04-27 14:23:13', '2025-04-27 14:23:13'),
(37, 21, 'kkk', '2025-04-27', '01:00:00', '02:00:00', 'llalla', '2025-04-27 14:32:57', '2025-04-27 14:32:57'),
(38, 22, 'mooooooommmooo', '2025-04-27', '03:00:00', '04:00:00', '', '2025-04-27 14:34:30', '2025-04-27 14:34:30'),
(39, 16, 'sukumar', '2025-04-27', '18:00:00', '20:00:00', '', '2025-04-27 11:38:12', '2025-04-27 11:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerName` int(11) NOT NULL,
  `restaurantEmail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurantPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurantMobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurantAddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BRNum` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearStarted` year(4) DEFAULT NULL,
  `profilePhoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotelPhotos` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `approved` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `status` enum('enabled','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  PRIMARY KEY (`restaurant_id`),
  UNIQUE KEY `restaurantEmail` (`restaurantEmail`),
  UNIQUE KEY `BRNum` (`BRNum`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `restaurantName`, `ownerName`, `restaurantEmail`, `restaurantPassword`, `restaurantMobileNum`, `restaurantAddress`, `district`, `province`, `BRNum`, `yearStarted`, `profilePhoto`, `hotelPhotos`, `description`, `approved`, `status`) VALUES
(6, 'ghandhi', 0, 'sangeerththanasarma@gmail.com', '$2y$10$hZRl2hWqSYbrs78a1x38D.dWYqWU2cUGS3kIH2wK6LN0Nw2pnF/r.', '+94760454685', 'Colombo 06', 'jaffna', 'nothern', 'R154682E546A', 1999, '/uploads/rprofile/profile_680c1f0a44cfb_image2.jpg', '[\"\\/Uploads\\/rimages\\/hotel_680c1c5679470_image2.jpg\",\"\\/Uploads\\/rimages\\/hotel_680c1c567a90f_ChatGPTImageApr32025105234PM.png\"]', 'he', 'yes', 'enabled'),
(30, 'Hilltop cafe', 0, 'r1@gmail.com', '$2y$10$ZKYaf4GOjNjZpZPk9TUm8u1qtuTp1KOEhBditRixUIXLaXwrHLIfu', '0745454545', '23 Ridge Road', 'Nuwara Eliya', 'Central', 'BR012345', 2019, '/uploads/rprofile/profile_680c2b701ae1d_Screenshot2024-10-29224403.png', NULL, '', 'yes', 'enabled'),
(31, 'Saffron Kitchen', 0, 'r2@gmail.com', '$2y$10$sj3tRdRWGt2RwLutQmfHHeFWslx0Za0vZUWP.Uk4l7fUDmOy6eDzC', '+94774986598', '89 Main Street', 'Batticaloa', 'Eastern', 'BR678901', 2020, '/uploads/rprofile/profile_680c2cae6bcab_1-1.png', '[\"\\/Uploads\\/rimages\\/hotel_680e019b6d0c3_Screenshot2024-09-24123659.png\",\"\\/Uploads\\/rimages\\/hotel_680e019b6dd4f_Screenshot2024-09-24123709.png\",\"\\/Uploads\\/rimages\\/hotel_680e019b6e56c_Screenshot2024-09-24123719.png\",\"\\/Uploads\\/rimages\\/hotel_680e019b6efb1_Screenshot2024-09-24123730.png\"]', 'asuhfd gawieufas dh aefuzjsdkckaj efksdc flkasdflashdfjk ashldkj askldjh asksdfh aksjdfh aksjd aksh faklsjhdweuhp9awfnaksmnc lquh fp9quehf 9a dfp9awef pqiwhf [oqw f [oiwj 0ie  e0ij qwifj oijf oiofj aoasoj oasjf oiwjf joij', 'no', 'enabled'),
(32, 'Mango Tree', 0, 'r3@gmail.com', '$2y$10$mejVo5s5B3CiJS9VHTK9dObUfhiHdgA7vVAt3o4iiT8snKmsmhJJm', '+94760454545', '12 Orchard Road', 'Trincomalee', 'Eastern', 'BR234678', 2017, '/Uploads/rprofile/profile_680def795b127_Screenshot2024-09-16205658.png', '[\"\\/Uploads\\/rimages\\/hotel_680dee91c18aa_Screenshot2024-09-11112118.png\",\"\\/Uploads\\/rimages\\/hotel_680dee91c29dd_Screenshot2024-09-11141458.png\",\"\\/Uploads\\/rimages\\/hotel_680dee91c35f8_Screenshot2024-09-14112754.png\"]', 'aa', 'no', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_status`
--

DROP TABLE IF EXISTS `restaurant_status`;
CREATE TABLE IF NOT EXISTS `restaurant_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `status` enum('open','closed') COLLATE utf8mb4_unicode_ci DEFAULT 'open',
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_status`
--

INSERT INTO `restaurant_status` (`id`, `restaurant_id`, `status`, `open_time`, `close_time`, `updated_at`) VALUES
(1, 6, 'open', '09:00:00', '22:00:00', '2025-04-26 20:54:22'),
(3, 32, 'closed', '09:00:00', '23:00:00', '2025-04-27 09:16:49'),
(4, 31, 'open', '09:00:00', '22:00:00', '2025-04-27 10:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_Id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_roomType_Id` int(11) DEFAULT NULL,
  `room_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`room_Id`),
  KEY `hotel_roomType_Id` (`hotel_roomType_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_Id`, `hotel_roomType_Id`, `room_number`) VALUES
(6, 28, '101'),
(7, 28, '102'),
(8, 28, '103'),
(9, 28, '104'),
(10, 28, '105'),
(11, 29, '101'),
(12, 29, '102'),
(13, 29, '103'),
(14, 29, '104'),
(15, 29, '105'),
(16, 30, '201'),
(17, 30, '202'),
(18, 30, '203'),
(19, 30, '204'),
(20, 30, '205'),
(21, 31, '501'),
(22, 31, '502'),
(23, 31, '503'),
(24, 31, '504'),
(25, 31, '505'),
(28, 34, '301'),
(29, 34, '302'),
(30, 34, '303'),
(31, 34, '304'),
(32, 34, '305'),
(33, 34, '306'),
(34, 34, '307'),
(35, 34, '308'),
(36, 34, '309'),
(37, 34, '310'),
(38, 35, '626'),
(39, 35, '627'),
(40, 35, '628'),
(41, 35, '629'),
(42, 35, '630');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

DROP TABLE IF EXISTS `room_booking`;
CREATE TABLE IF NOT EXISTS `room_booking` (
  `roomBooking_Id` int(11) NOT NULL AUTO_INCREMENT,
  `room_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `bookedDate` date NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `bookingStatus` enum('Pending','Confirmed','Declined') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  PRIMARY KEY (`roomBooking_Id`),
  KEY `room_Id` (`room_Id`),
  KEY `traveler_Id` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_booking`
--

INSERT INTO `room_booking` (`roomBooking_Id`, `room_Id`, `traveler_Id`, `bookedDate`, `checkInDate`, `checkOutDate`, `bookingStatus`) VALUES
(1, 13, 100001, '2025-02-16', '2025-02-18', '2025-02-21', 'Confirmed'),
(2, 16, 100002, '2025-02-17', '2025-02-20', '2025-02-22', 'Confirmed'),
(3, 17, 100002, '2025-02-17', '2025-02-20', '2025-02-22', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `room_bookings_final`
--

DROP TABLE IF EXISTS `room_bookings_final`;
CREATE TABLE IF NOT EXISTS `room_bookings_final` (
  `room_booking_Id` int(11) NOT NULL AUTO_INCREMENT,
  `traveler_Id` int(11) DEFAULT NULL,
  `hotel_Id` int(11) NOT NULL,
  `hotel_roomType_Id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `special_requests` text COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(10,2) NOT NULL,
  `advance_payment_amount` decimal(10,2) NOT NULL,
  `paid_advance_payment_amount` decimal(10,2) DEFAULT '0.00',
  `advance_payment_status` enum('Pending','Paid','Unpaid') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `advance_payment_paid_date` timestamp NULL DEFAULT NULL,
  `path_to_payment_confirmation_QR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled','Completed') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `requested_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `advance_payment_deadline` timestamp NULL DEFAULT NULL,
  `is_archived` int(1) NOT NULL DEFAULT '0',
  `booking_source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Online',
  PRIMARY KEY (`room_booking_Id`),
  KEY `traveler_Id` (`traveler_Id`),
  KEY `hotel_Id` (`hotel_Id`),
  KEY `hotel_roomType_Id` (`hotel_roomType_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000036 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_bookings_final`
--

INSERT INTO `room_bookings_final` (`room_booking_Id`, `traveler_Id`, `hotel_Id`, `hotel_roomType_Id`, `check_in`, `check_out`, `total_rooms`, `special_requests`, `total_amount`, `advance_payment_amount`, `paid_advance_payment_amount`, `advance_payment_status`, `advance_payment_paid_date`, `path_to_payment_confirmation_QR`, `booking_status`, `requested_date`, `advance_payment_deadline`, `is_archived`, `booking_source`) VALUES
(10000001, 100011, 18, 29, '2025-04-01', '2025-04-02', 1, 'Room on a higher floor with a nice view', '10000.00', '2500.00', '2500.00', 'Paid', '2025-04-17 05:05:09', 'assets/images/Travelers/generatedEventTickets/16_ticket.png', 'Completed', '2025-03-25 05:02:26', '2025-03-28 18:29:59', 0, 'Online'),
(10000002, 100012, 18, 30, '2025-04-04', '2025-04-06', 2, 'Extra pillows and blankets, if available', '70000.00', '17500.00', '17500.00', 'Paid', '2025-04-17 05:17:03', 'assets/images/Travelers/generatedEventTickets/10000002_ticket.png', 'Completed', '2025-03-26 05:13:58', '2025-03-29 18:29:59', 0, 'Online'),
(10000003, 100013, 18, 31, '2025-04-03', '2025-04-06', 1, 'Quiet room away from elevator or street noise', '105000.00', '26250.00', '26250.00', 'Paid', '2025-04-17 05:25:57', 'assets/images/Travelers/generatedEventTickets/10000003_ticket.png', 'Completed', '2025-03-28 05:21:25', '2025-03-31 18:29:59', 0, 'Online'),
(10000005, 100014, 18, 30, '2025-04-04', '2025-04-07', 2, 'Room with walk-in shower (instead of a bathtub)', '105000.00', '26250.00', '26250.00', 'Paid', '2025-04-17 07:26:22', 'assets/images/Travelers/generatedEventTickets/10000005_ticket.png', 'Completed', '2025-03-28 07:22:25', '2025-03-31 18:29:59', 0, 'Online'),
(10000025, 100001, 19, 34, '2025-04-20', '2025-04-21', 1, 'Room with a balcony if possible', '45000.00', '11250.00', '11250.00', 'Paid', '2025-04-20 06:31:43', 'assets/images/Travelers/generatedEventTickets/10000025_ticket.png', 'Cancelled', '2025-04-19 20:05:00', '2025-04-23 18:29:00', 0, 'Online'),
(10000026, NULL, 17, 28, '2025-04-26', '2025-04-28', 1, 'sdfghjkl', '15000.00', '15000.00', '15000.00', 'Paid', NULL, NULL, 'Confirmed', '2025-04-24 18:30:00', NULL, 0, 'walk-in'),
(10000027, 100020, 18, 29, '2025-04-25', '2025-04-28', 1, 'sdfghjk', '30000.00', '7500.00', '7500.00', 'Paid', '2025-04-25 05:20:11', 'assets/images/Travelers/generatedEventTickets/10000027_ticket.png', 'Cancelled', '2025-04-25 05:19:05', '2025-04-28 18:29:00', 1, 'Online'),
(10000028, NULL, 17, 28, '2025-04-25', '2025-04-27', 1, 'dfghjkl', '15000.00', '15000.00', '15000.00', 'Paid', NULL, NULL, 'Confirmed', '2025-04-24 18:30:00', NULL, 0, 'walk-in'),
(10000029, NULL, 17, 28, '2025-04-25', '2025-04-27', 1, 'simple request', '15000.00', '3750.00', '3750.00', 'Paid', NULL, NULL, 'Confirmed', '2025-04-24 20:57:00', NULL, 0, 'phone'),
(10000030, NULL, 17, 28, '2025-04-25', '2025-04-27', 1, 'zhjk', '15000.00', '15000.00', '15000.00', 'Paid', NULL, NULL, 'Confirmed', '2025-04-24 21:05:00', NULL, 0, 'walk-in'),
(10000031, 100020, 18, 30, '2025-04-25', '2025-04-28', 1, 'dfghjk', '52500.00', '13125.00', '13125.00', 'Paid', '2025-04-25 15:57:46', 'assets/images/Travelers/generatedEventTickets/10000031_ticket.png', 'Cancelled', '2025-04-25 15:55:32', '2025-04-28 18:29:00', 1, 'Online'),
(10000033, 100001, 18, 29, '2025-04-27', '2025-04-29', 2, 'Special Request', '40000.00', '10000.00', '10000.00', 'Paid', '2025-04-26 22:25:19', 'assets/images/Travelers/generatedEventTickets/10000033_ticket.png', 'Cancelled', '2025-04-26 21:28:22', '2025-04-30 18:29:00', 0, 'Online'),
(10000034, 100020, 18, 31, '2025-05-01', '2025-05-04', 1, 'Quiet room away from elevators', '105000.00', '26250.00', '0.00', 'Pending', NULL, NULL, 'Pending', '2025-04-27 20:16:33', '2025-05-01 18:29:00', 0, 'Online'),
(10000035, 100020, 18, 29, '2025-05-01', '2025-05-04', 2, 'demo request', '60000.00', '15000.00', '15000.00', 'Paid', '2025-04-28 09:12:14', 'assets/images/Travelers/generatedEventTickets/10000035_ticket.png', 'Cancelled', '2025-04-28 09:10:05', '2025-05-01 18:29:00', 0, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_cancellations`
--

DROP TABLE IF EXISTS `room_booking_cancellations`;
CREATE TABLE IF NOT EXISTS `room_booking_cancellations` (
  `cancellation_Id` int(11) NOT NULL AUTO_INCREMENT,
  `room_booking_Id` int(11) NOT NULL,
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `cancellation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `refund_amount` decimal(10,2) DEFAULT '0.00',
  `refund_status` enum('Not Eligible','Processing','Refunded') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cancellation_Id`),
  KEY `room_booking_Id` (`room_booking_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_booking_cancellations`
--

INSERT INTO `room_booking_cancellations` (`cancellation_Id`, `room_booking_Id`, `cancellation_reason`, `cancellation_date`, `refund_amount`, `refund_status`) VALUES
(12, 10000025, 'Unavoidable circumtances', '2025-04-20 12:56:53', '0.00', 'Not Eligible'),
(13, 10000027, 'sdfghjk', '2025-04-25 21:29:36', '0.00', 'Not Eligible'),
(14, 10000033, 'blah blah', '2025-04-27 04:51:29', '0.00', 'Not Eligible'),
(15, 10000031, 'Test Cancellation', '2025-04-27 18:14:25', '0.00', 'Not Eligible'),
(16, 10000035, 'test cancellation', '2025-04-28 14:44:38', '7500.00', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_refunds`
--

DROP TABLE IF EXISTS `room_booking_refunds`;
CREATE TABLE IF NOT EXISTS `room_booking_refunds` (
  `refund_Id` int(11) NOT NULL AUTO_INCREMENT,
  `cancellation_Id` int(11) NOT NULL,
  `bank_detail_Id` int(11) NOT NULL,
  `refund_amount` decimal(10,2) NOT NULL,
  `refund_status` enum('Not Eligible','Processing','Refunded') COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_initiated_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`refund_Id`),
  KEY `cancellation_Id` (`cancellation_Id`),
  KEY `bank_detail_Id` (`bank_detail_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_refund_bank_details`
--

DROP TABLE IF EXISTS `room_booking_refund_bank_details`;
CREATE TABLE IF NOT EXISTS `room_booking_refund_bank_details` (
  `bank_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `traveler_Id` int(11) NOT NULL,
  `traveler_accountNum` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traveler_bankName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traveler_bankBranch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bank_detail_id`),
  UNIQUE KEY `account_number` (`traveler_accountNum`,`traveler_Id`),
  KEY `traveler_Id` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_booking_refund_bank_details`
--

INSERT INTO `room_booking_refund_bank_details` (`bank_detail_id`, `traveler_Id`, `traveler_accountNum`, `account_holder_name`, `traveler_bankName`, `traveler_bankBranch`) VALUES
(9, 100020, '020331031020', 'Nihmath Jabir', 'National Savings Bank', 'Maligawatte');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sold_event_tickets`
--

INSERT INTO `sold_event_tickets` (`sale_Id`, `booking_Id`, `eventTicketType_Id`, `quantity`) VALUES
(1, 11, 4, 1),
(2, 11, 5, 1),
(3, 11, 6, 1),
(4, 12, 6, 2),
(5, 13, 5, 2),
(6, 14, 4, 1),
(7, 15, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` enum('Indoor','Outdoor','VIP') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `restaurant_table_number` (`restaurant_id`,`number`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `restaurant_id`, `number`, `capacity`, `location`, `price`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 8, 'Outdoor', '100.00', '2025-04-23 13:48:56', '2025-04-26 21:39:09'),
(2, 6, 2, 4, 'VIP', '0.00', '2025-04-23 13:49:41', '2025-04-23 13:49:41'),
(5, 6, 3, 12, 'Outdoor', '450.00', '2025-04-24 07:51:44', '2025-04-24 07:51:44'),
(6, 6, 4, 3, 'Indoor', '50.00', '2025-04-24 07:52:13', '2025-04-24 07:52:13'),
(12, 6, 5, 6, 'Indoor', '10.00', '2025-04-25 01:55:37', '2025-04-25 01:55:37'),
(13, 6, 6, 4, 'Outdoor', '20.00', '2025-04-25 01:55:51', '2025-04-25 01:55:51'),
(14, 6, 7, 4, 'VIP', '20.00', '2025-04-25 01:55:57', '2025-04-25 01:55:57'),
(15, 6, 8, 7, 'Indoor', '25.00', '2025-04-25 01:56:18', '2025-04-25 01:56:18'),
(16, 6, 9, 4, 'Indoor', '20.00', '2025-04-25 04:46:21', '2025-04-25 04:46:21'),
(17, 6, 10, 15, 'VIP', '0.00', '2025-04-25 22:48:04', '2025-04-25 22:48:04'),
(20, 31, 1, 10, 'Indoor', '0.00', '2025-04-27 08:34:22', '2025-04-27 08:34:22'),
(21, 32, 1, 4, 'Indoor', '0.00', '2025-04-27 09:04:22', '2025-04-27 09:04:22'),
(22, 32, 2, 12, 'Outdoor', '0.00', '2025-04-27 09:27:18', '2025-04-27 09:27:18'),
(23, 32, 3, 15, 'VIP', '0.00', '2025-04-27 09:27:26', '2025-04-27 09:27:26'),
(24, 31, 2, 2, 'Indoor', '0.00', '2025-04-27 13:55:54', '2025-04-27 13:55:54'),
(25, 32, 4, 5, 'Outdoor', '0.00', '2025-04-27 14:36:14', '2025-04-27 14:36:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `districtLatitude` decimal(15,13) DEFAULT NULL,
  `districtLongitude` decimal(15,13) DEFAULT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_districts`
--

INSERT INTO `top_districts` (`district_id`, `district_name`, `about_the_district`, `coverPic`, `districtLatitude`, `districtLongitude`) VALUES
(1, 'Anuradhapura', 'Anuradhapura, a UNESCO World Heritage Site, is a sacred city steeped in history and culture in Sri Lanka\'s North Central Province. Renowned for its ancient ruins, sprawling monasteries, and iconic stupas like Ruwanwelisaya and Jetavanaramaya, it offers a glimpse into the island\'s rich Buddhist heritage. Visitors can marvel at the centuries-old Sri Maha Bodhi tree, believed to be the world\'s oldest historically documented tree, and explore intricate stone carvings and reservoirs. With its serene atmosphere, sacred landmarks, and timeless charm, Anuradhapura is a captivating journey into Sri Lanka\'s glorious past.', 'assets/images/Travelers/topDistricts/anuradhapura.jpg', '8.3115783006680', '80.4047131533955'),
(2, 'Badhulla', 'Badulla, nestled in Sri Lanka\'s Uva Province, is a serene town surrounded by lush greenery and rolling hills. Known for its natural beauty and historical significance, the area boasts attractions like the enchanting Dunhinda Falls and the ancient Muthiyangana Temple. Visitors can enjoy scenic hikes, tea estate tours, and panoramic views from Little Adam\'s Peak. The town\'s charming railway station is a gateway to breathtaking train journeys through misty mountains and verdant valleys. With its tranquil ambiance and cultural treasures, Badulla is a perfect retreat for nature lovers and history enthusiasts alike.', 'assets/images/Travelers/topDistricts/badhulla.jpg', '6.9937309267333', '81.0540376978820'),
(3, 'Colombo', 'Colombo, the vibrant capital of Sri Lanka, seamlessly blends modern sophistication with rich cultural heritage. This bustling metropolis is known for its iconic landmarks like the Lotus Tower, historic temples, and colonial-era buildings. Visitors can explore bustling markets in Pettah, relax by the Galle Face Green promenade, or indulge in world-class dining and shopping. Colombo\'s lively streets are adorned with art, while its museums and galleries offer glimpses into the island\'s history. With its dynamic cityscape, coastal charm, and cosmopolitan vibe, Colombo is a perfect introduction to Sri Lanka\'s diverse allure.', 'assets/images/Travelers/topDistricts/colombo.jpg', '6.9252397528531', '79.8726794886851'),
(4, 'Galle', 'Galle, a coastal gem in southern Sri Lanka, is renowned for its timeless charm and rich history. The iconic Galle Fort, a UNESCO World Heritage Site, stands as a testament to the islands colonial past, with cobblestone streets, quaint boutiques, and colonial architecture. Visitors can explore art galleries, vibrant cafes, and the lighthouse overlooking the turquoise waters. The towns golden beaches and serene surroundings offer a perfect escape for relaxation and exploration. With its blend of historical allure and coastal beauty, Galle is a captivating destination for travelers seeking culture and tranquility.\r\n', 'assets/images/Travelers/topDistricts/galle.jpg', '6.0329953445018', '80.2168607456179'),
(5, 'Hambantota', 'Hambantota, located on Sri Lanka’s southern coast, is a destination where untamed nature meets modern development. Known for its proximity to wildlife-rich national parks like Yala and Bundala, it’s a haven for nature enthusiasts and safari lovers. Visitors can explore the sprawling Hambantota Bird Park, walk through the landscaped paths of Dry Zone Botanical Gardens, or relax on pristine beaches. The area is also home to the modern Mattala Rajapaksa International Airport and the bustling Hambantota Port. With its unique blend of natural wonders and growing infrastructure, Hambantota offers a distinctive experience for travelers.', 'assets/images/Travelers/topDistricts/hambantota.jpg', '6.1442861018663', '81.1226339328756'),
(6, 'Jaffna', 'Jaffna, the cultural heart of Sri Lanka’s Northern Province, is a city steeped in history, tradition, and resilience. Known for its vibrant Tamil heritage, it features iconic landmarks such as the majestic Nallur Kandaswamy Temple and the historic Jaffna Fort. Visitors can savor authentic Jaffna cuisine, explore pristine islands like Delft, and discover ancient libraries and museums that narrate the region’s rich past. The city’s colorful markets and serene beaches add to its charm. With its unique culture, historic sites, and warm hospitality, Jaffna is a must-visit destination for those seeking an enriching travel experience.', 'assets/images/Travelers/topDistricts/jaffna.jpg', '9.6615803259818', '80.0260231004689'),
(7, 'Kandy', 'Kandy, nestled in Sri Lanka’s lush central hills, is a city of cultural and spiritual significance. Renowned as the home of the Sacred Tooth Relic, housed in the Temple of the Tooth, it is a UNESCO World Heritage Site and a major pilgrimage destination. Visitors can explore the serene Kandy Lake, vibrant botanical gardens in Peradeniya, and traditional dance performances that showcase the city’s rich heritage. Surrounded by misty mountains and tea plantations, Kandy offers breathtaking scenery and a peaceful retreat. With its blend of history, spirituality, and natural beauty, Kandy is a jewel of Sri Lanka\'s hill country.', 'assets/images/Travelers/topDistricts/kandy.jpg', '7.2904568868219', '80.6343631475940'),
(8, 'Kegalle', 'Kegalle, located in Sri Lanka’s scenic Sabaragamuwa Province, is a charming town known for its lush landscapes and cultural landmarks. Famous as the gateway to the Pinnawala Elephant Orphanage, it offers visitors the chance to get up close with Sri Lanka’s majestic elephants. Surrounded by verdant hills and rubber plantations, Kegalle is perfect for nature enthusiasts. The area also boasts ancient temples, such as Dedigama Kota Vehera, and serene waterfalls ideal for exploration. With its rich heritage and tranquil surroundings, Kegalle provides a delightful escape into the heart of Sri Lanka\'s natural beauty.', 'assets/images/Travelers/topDistricts/kegalle.jpg', '7.2513409477963', '80.3465857364578'),
(9, 'Nuwara Eliya', 'Nuwara Eliya, often called \"Little England,\" is a charming town nestled in the heart of Sri Lanka\'s hill country. Known for its cool climate, lush green tea plantations, and colonial architecture, this picturesque destination offers breathtaking landscapes and a tranquil escape. Visitors can explore vibrant gardens, visit historic tea estates, and enjoy scenic boat rides on Gregory Lake. With misty mountains, cascading waterfalls, and a touch of old-world charm, Nuwara Eliya is a perfect blend of natural beauty and cultural heritage.', 'assets/images/Travelers/topDistricts/nuwaraEliya.jpg', '6.9498308221091', '80.7912453103240'),
(10, 'Polonnaruwa', 'Polonnaruwa, a UNESCO World Heritage Site, is a treasure trove of ancient history and stunning architecture in Sri Lanka’s North Central Province. Once a thriving medieval capital, it boasts well-preserved ruins, including the iconic Gal Vihara rock carvings, royal palaces, and impressive stupas. Visitors can explore the vast archaeological site, marvel at intricate stone sculptures, and learn about the city’s rich past at the Polonnaruwa Museum. Surrounded by lush greenery and serene reservoirs, the area offers a harmonious blend of history and natural beauty. Polonnaruwa is a must-visit destination for history buffs and culture enthusiasts alike.', 'assets/images/Travelers/topDistricts/polonnaruwa.jpg', '7.9144789545136', '81.0033263041212'),
(11, 'Ratnapura', 'Ratnapura, often called the “City of Gems,” is a glittering jewel in Sri Lanka’s Sabaragamuwa Province. Renowned as the heart of the island’s gem trade, it offers visitors a chance to learn about the art of gem mining and explore bustling gem markets. The city is surrounded by lush landscapes, with attractions like the scenic Bopath Ella Falls and the sacred Adam’s Peak, a popular pilgrimage site. Rich in biodiversity, Ratnapura is also a gateway to Sinharaja Forest Reserve. With its sparkling heritage, natural wonders, and cultural significance, Ratnapura is a destination full of discovery and beauty.', 'assets/images/Travelers/topDistricts/ratnapura.jpg', '6.7063774134144', '80.3853899613720'),
(12, 'Trincomalee', 'Trincomalee, a picturesque coastal town on Sri Lanka’s northeastern shore, is a hidden gem known for its pristine beaches, rich history, and vibrant marine life. The town is home to the stunning Koneswaram Temple, perched on a cliff overlooking the Indian Ocean, and the historic Trincomalee Harbour, one of the world’s largest natural harbors. Visitors can unwind on the golden sands of Nilaveli and Uppuveli beaches, explore coral reefs, or visit the ancient hot springs at Kanniya. With its blend of natural beauty, cultural landmarks, and tranquil atmosphere, Trincomalee offers a perfect retreat for history lovers and beach enthusiasts alike.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'assets/images/Travelers/topDistricts/trincomalee.jpg', '8.5874329088951', '81.2170097347502');

-- --------------------------------------------------------

--
-- Table structure for table `tourbookings`
--

DROP TABLE IF EXISTS `tourbookings`;
CREATE TABLE IF NOT EXISTS `tourbookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `traveler_Id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `guide_id` int(11) DEFAULT NULL,
  `booking_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `tour_date` date NOT NULL,
  `start_time` time NOT NULL DEFAULT '06:00:00',
  `num_guests` int(11) NOT NULL,
  `special_instructions` text,
  `status` enum('upcoming','started','completed','cancelled') DEFAULT 'upcoming',
  `request_status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','refunded') DEFAULT 'pending',
  PRIMARY KEY (`booking_id`),
  KEY `traveler_Id` (`traveler_Id`),
  KEY `package_id` (`package_id`),
  KEY `tourbookings_ibfk_3` (`guide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourbookings`
--

INSERT INTO `tourbookings` (`booking_id`, `traveler_Id`, `package_id`, `guide_id`, `booking_date`, `tour_date`, `start_time`, `num_guests`, `special_instructions`, `status`, `request_status`, `total_price`, `payment_status`) VALUES
(1, 100020, 1, 1, '2025-04-25 06:55:00', '2025-04-27', '06:00:00', 12, 'One member has mobility issues', 'completed', 'accepted', '120000.00', 'paid'),
(2, 100020, 4, 1, '2025-04-25 07:00:00', '2025-05-03', '06:00:00', 15, 'Vegetarian meals required', 'started', 'accepted', '150000.00', 'paid'),
(3, 100020, 5, 1, '2025-04-25 09:32:00', '2025-05-05', '06:00:00', 10, 'Need child seats', 'upcoming', 'pending', '100000.00', 'pending'),
(4, 100001, 6, 1, '2025-04-27 06:27:00', '2025-05-15', '06:00:00', 10, NULL, 'upcoming', 'pending', '100000.00', 'pending'),
(5, 100020, 4, 1, '2025-04-28 01:34:00', '2025-05-20', '06:00:00', 10, 'Early check in needed', 'upcoming', 'pending', '100000.00', 'pending'),
(6, 100020, 1, 1, '2025-04-28 02:39:00', '2025-05-26', '06:00:00', 7, 'Allergic to nuts', 'upcoming', 'pending', '70000.00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tourguide`
--

DROP TABLE IF EXISTS `tourguide`;
CREATE TABLE IF NOT EXISTS `tourguide` (
  `guide_Id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `nic` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobileNum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profilePhoto` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT 'default.webp',
  `licenseNum` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `experience` int(11) DEFAULT NULL,
  `fieldsOfExpertise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languagesSpoken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guideBio` text COLLATE utf8mb4_unicode_ci,
  `guideRating` decimal(10,0) DEFAULT NULL,
  `guideLocation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourFrequencyPerMonth` int(11) DEFAULT NULL,
  `approved` enum('yes','no','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`guide_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tourguide`
--

INSERT INTO `tourguide` (`guide_Id`, `firstName`, `lastName`, `age`, `nic`, `username`, `email`, `password`, `mobileNum`, `profilePhoto`, `licenseNum`, `gender`, `status`, `experience`, `fieldsOfExpertise`, `languagesSpoken`, `guideBio`, `guideRating`, `guideLocation`, `tourFrequencyPerMonth`, `approved`) VALUES
(1, 'Mohamed', 'Zakey Abdulla', NULL, '200214402017', 'ucsc', 'test@gmail.com', '$2y$10$xQPXYM7cSVQzvdPh/fN4OuNT4rExyn8bQG5ud.kBX2EFxhJfH91hi', '0772062587', '67b6c588b1620_360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr-removebg-preview.png', 'jh255', 'male', 'disabled', 5, 'Hiking', NULL, 'This is a guide bio of the tour guide with the email address demo@gmail.com. And the name is Abdulla M.Z', NULL, '168, Hospital Road, kalubowila', 5, 'yes'),
(2, 'Abdulla M.Z', '', NULL, '111111111111', 'uocucsc', 'demo@gmail.com', '$2y$10$5PYZYRqC6bqw3oG0JyTyEOdTiYN26IZTy3cbjpYqezWNnl9QKnCc2', '0113218769', 'default.webp', 'as2445', NULL, 'enabled', 3, 'Hiking', NULL, 'This is a guide bio of the tour guide with the email address demo@gmail.com. And the name is Abdulla M.Z', NULL, 'Kegalle', 5, 'no'),
(27, 'Abdulla', 'Zakey', NULL, '200452811424', 'abdul_zakey', 'test1@gmail.com', '$2y$10$dUjl85xilwyjxsy7xe0JrOCSg4gyEKs.3qxNjikebzzPheAD0J.fK', '0781524235', '679fa319e23f9_IMG_9910.jpg', '32541525', 'male', 'disabled', 3, 'Religious Pilgrimages', NULL, 'A test guide user is this', NULL, '', 4, 'yes'),
(31, 'test', 'signup', 23, '200214402017', 'abcd@123', 'abcd@gmail.com', '$2y$10$tunl5hhu1uqTXuI5ltrB2uaBotPPg/DvPuMzRLYgZdTXje6FA2grG', '0772062587', 'default.webp', 'abcd123', 'male', 'enabled', 2, NULL, NULL, NULL, NULL, '', NULL, 'yes'),
(32, 'Test work', 'second test', 25, '200214402017', 'abcd@1', 'abcd1@gmail.com', '$2y$10$cVZNKmRdZNQIXSyvDGXFYOopJzvuLPqVZvcA0ppt1mcKqdM42mMIi', '0772062587', 'default.webp', 'sltda123', 'male', 'enabled', 3, NULL, NULL, NULL, NULL, '', NULL, 'no'),
(33, 'Mohamed', 'Zakey', 50, '200214402017', '2022is001', 'abdulmax3@gmail.com', '$2y$10$0uiL1z4CIIikf2OHUZopa.j7uFeVHYaCLhKoGjZjH.BvIsEgs5R/G', '0781524235', 'default.webp', 'sltda123', 'male', 'enabled', 2, NULL, NULL, NULL, NULL, '', NULL, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `tourguidebankaccount`
--

DROP TABLE IF EXISTS `tourguidebankaccount`;
CREATE TABLE IF NOT EXISTS `tourguidebankaccount` (
  `tourGuide_bankAccount_Id` int(11) NOT NULL,
  `guide_Id` int(11) NOT NULL,
  `tourGuide_accountNum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tourGuide_bankName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tourGuide_bankBranch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentMethod` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tourGuide_bankAccount_Id`),
  KEY `fk_guide_Id` (`guide_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tourguidebankaccount`
--

INSERT INTO `tourguidebankaccount` (`tourGuide_bankAccount_Id`, `guide_Id`, `tourGuide_accountNum`, `tourGuide_bankName`, `tourGuide_bankBranch`, `paymentMethod`, `created_at`, `updated_at`) VALUES
(1, 1, '93403200', 'Bank of Ceylon', 'Mawanella', NULL, '2025-01-29 16:39:26', '2025-02-02 16:48:36'),
(2, 2, '111233325', 'HNB', 'Kohuwala', NULL, '2025-01-30 14:35:58', '2025-01-30 14:35:58'),
(14, 27, '8013965484', 'Commercial Bank', 'Mawanella', NULL, '2025-02-02 17:01:29', '2025-02-02 17:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `tourguidecommissions`
--

DROP TABLE IF EXISTS `tourguidecommissions`;
CREATE TABLE IF NOT EXISTS `tourguidecommissions` (
  `commission_id` int(11) NOT NULL AUTO_INCREMENT,
  `guide_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `payment_date` date NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `notes` text,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commission_id`),
  KEY `guide_id` (`guide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourguidecommissions`
--

INSERT INTO `tourguidecommissions` (`commission_id`, `guide_id`, `amount`, `reference_number`, `payment_date`, `receipt_path`, `notes`, `status`, `verified_at`, `created_at`, `updated_at`) VALUES
(14, 1, '2000.00', 'O500019329301', '2025-04-23', '/assets/commissions/tourGuideCommissions/guide_id_1/receipt_680894321141b.Receipt432002020250413141349727000.pdf', 'First commission payment', 'approved', NULL, '2025-04-23 07:18:10', '2025-04-23 11:09:45'),
(15, 1, '5500.00', 'O500019900525', '2025-04-22', '/assets/commissions/tourGuideCommissions/guide_id_1/receipt_6808cb5296096.Receipt432002020250418110813305000.pdf', 'test', 'pending', NULL, '2025-04-23 11:13:22', '2025-04-25 22:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `tourguidecomplaints`
--

DROP TABLE IF EXISTS `tourguidecomplaints`;
CREATE TABLE IF NOT EXISTS `tourguidecomplaints` (
  `complaint_id` int(10) NOT NULL AUTO_INCREMENT,
  `guide_id` int(11) DEFAULT NULL,
  `date_submitted` date NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `booking_id` varchar(10) DEFAULT NULL,
  `resolution_details` text NOT NULL,
  `status` enum('Pending','Resolved') DEFAULT 'Pending',
  `resolution_note` text,
  `date_resolved` date DEFAULT NULL,
  PRIMARY KEY (`complaint_id`),
  KEY `guide_id` (`guide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourguidecomplaints`
--

INSERT INTO `tourguidecomplaints` (`complaint_id`, `guide_id`, `date_submitted`, `subject`, `message`, `booking_id`, `resolution_details`, `status`, `resolution_note`, `date_resolved`) VALUES
(1, 1, '2025-04-24', 'Room not as advertised', 'I booked a deluxe room with ocean view at Sunset Hotel, but when I arrived, I was given a standard room facing the parking lot. When I complained to the front desk, they said all deluxe rooms were booked despite my confirmation. I had to stay in the standard room but was charged the deluxe price. I want a refund for the price difference and compensation for the inconvenience.', NULL, 'test', 'Resolved', '', '2025-04-25'),
(2, 1, '2025-04-16', 'Incorrect booking information provided', '\'The booking details sent to me had the wrong group size. Expected 8 tourists but 15 showed up, and I wasn\\\'t prepared for such a large group.', '', '', 'Pending', NULL, NULL),
(3, 1, '2025-04-22', 'Incorrect pricing information', 'The system is displaying outdated entrance fees for National Museum. This caused an awkward situation when tourists were asked to pay more than quoted.', NULL, 'Price list updated in system. Guides provided with current fee chart until next app update.', 'Resolved', NULL, '2025-04-24'),
(4, 1, '2025-04-24', 'This is a test complaint made by tour guide', 'Admin can see the test complaint made by tour guides now and resolve them with a description', '', 'This test complaint of tour guide is now visible to admin and now this is a respond to the test complaint made by tour guide', 'Resolved', '', '2025-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `tourguideunavailability`
--

DROP TABLE IF EXISTS `tourguideunavailability`;
CREATE TABLE IF NOT EXISTS `tourguideunavailability` (
  `unavailability_id` int(11) NOT NULL AUTO_INCREMENT,
  `guide_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unavailability_id`),
  KEY `guide_id` (`guide_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tourguideunavailability`
--

INSERT INTO `tourguideunavailability` (`unavailability_id`, `guide_id`, `start_date`, `end_date`, `reason`, `created_at`, `updated_at`) VALUES
(5, 1, '2025-04-22', '2025-04-22', 'Family weekend getaway', '2025-04-20 19:25:25', '2025-04-20 19:25:25'),
(6, 1, '2025-04-29', '2025-04-29', 'Medical checkup', '2025-04-20 19:25:35', '2025-04-20 19:25:35'),
(7, 1, '2025-05-05', '2025-05-08', 'Summer vacation', '2025-04-20 19:25:54', '2025-04-20 19:25:54'),
(8, 1, '2025-04-30', '2025-05-01', 'Medical checkup', '2025-04-23 11:25:26', '2025-04-23 11:25:26'),
(9, 1, '2025-04-28', '2025-04-30', 'Test case testing', '2025-04-26 23:19:25', '2025-04-26 23:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `tourpackages`
--

DROP TABLE IF EXISTS `tourpackages`;
CREATE TABLE IF NOT EXISTS `tourpackages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `guide_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `group_size` varchar(100) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `inclusions` text,
  `exclusions` text,
  `additional_info` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`package_id`),
  KEY `guide_id` (`guide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourpackages`
--

INSERT INTO `tourpackages` (`package_id`, `guide_id`, `name`, `location`, `duration_days`, `group_size`, `package_price`, `languages`, `description`, `tags`, `inclusions`, `exclusions`, `additional_info`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ella Adventure', 'Ella, Sri Lanka', 2, '10', '10000.00', 'English, Sinhala, Tamil', 'Immerse yourself in the breathtaking beauty of lush green hills, cascading waterfalls, and serene tea plantations as you explore one of Sri Lankas most picturesque destinations. The Ella Adventure tour is designed for nature lovers, thrill-seekers, and anyone looking to escape the ordinary.\r\n\r\nThis comprehensive tour takes you through the iconic landmarks of Ella, including the famous Nine Arches Bridge, Little Adams Peak, Ella Rock, and the majestic Ravana Falls. Along the way, you will learn about the rich history and culture of the region from your knowledgeable guide.', 'Hiking,Nature,Photography', 'Professional English, Sinhala and Tamil speaking guide.\r\nOne night accommodation in Ella (3-star hotel).\r\nAll meals (1 breakfast, 2 lunches, 1 dinner).\r\nEntrance fees to all attractions mentioned in the itinerary.\r\nBottled water throughout the tour.\r\nPickup and drop-off from Ella Railway Station.\r\nSnacks and refreshments during hikes.', 'Personal expenses and souvenirs.\r\nAlcoholic beverages.\r\nTravel insurance.\r\nTips for guide (optional but appreciated).\r\nActivities not mentioned in the itinerary.\r\nTransportation to and from Ella.', 'One member of our group has mild mobility issues. Please ensure the hiking routes are suitable.', '2025-04-14 17:36:21', '2025-04-25 11:33:41'),
(4, 1, 'Sigiriya Rock Fortress Expedition', 'Sigiriya, Sri Lanka', 1, '4', '12000.00', 'English, Sinhala', 'Discover the ancient marvel of Sigiriya, a UNESCO World Heritage Site known as the &quot;Eighth Wonder of the World.&quot; Climb the 1,200 steps to the summit of this 5th-century rock fortress, adorned with frescoes and surrounded by stunning gardens. Learn about King Kasyapa&#039;s legendary reign and enjoy panoramic views of the surrounding jungle.', 'Historical, Trekking, Photography', '', '', NULL, '2025-04-14 20:10:59', '2025-04-14 20:10:59'),
(5, 1, 'Yala Wildlife Safari', 'Yala, Sri Lanka', 1, '8', '20000.00', 'English, Sinhala, Tamil', 'Embark on an unforgettable jeep safari through Yala National Park, home to leopards, elephants, crocodiles, and exotic birds. Experience the thrill of spotting wildlife in their natural habitat with an expert tracker. The tour includes a sunrise or sunset safari for optimal animal sightings.', 'Nature,Safari,Wildlife', '', '', NULL, '2025-04-14 20:20:25', '2025-04-14 20:20:25'),
(6, 1, 'Galle Coastal Explorer', 'Galle, Sri Lanka', 1, '5', '13500.00', 'English, Sinhala', 'Wander through the 17th-century Dutch Fort in Galle, a UNESCO site, before relaxing at Unawatuna or Mirissa Beach. Enjoy fresh seafood, lighthouse views, and optional whale watching (Dec-Apr).', 'Seafood,Colonial,Beach', '', '', NULL, '2025-04-14 20:23:21', '2025-04-27 14:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `tourpackage_activities`
--

DROP TABLE IF EXISTS `tourpackage_activities`;
CREATE TABLE IF NOT EXISTS `tourpackage_activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `activity_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `day_id` (`day_id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourpackage_activities`
--

INSERT INTO `tourpackage_activities` (`activity_id`, `day_id`, `title`, `description`, `activity_time`) VALUES
(11, 4, 'Sunrise Climb to Sigiriya Summit', 'Guided ascent with historical insights', 'Morning'),
(12, 4, 'Sigiriya Museum Visit', 'Learn about the site’s archaeology', 'Afternoon'),
(13, 5, 'Jeep Safari in Block 1', 'Best zone for leopard sightings', 'Early Morning'),
(14, 5, 'Picnic Breakfast by a Lake', 'Scenic stop with refreshments', 'Midday'),
(15, 5, 'Safari Resumes', 'Focus on elephants, crocodiles, and sloth bears', 'Afternoon'),
(123, 33, 'Little Adams Peak Adventure', 'Begin your journey with a scenic hike up Little Adams Peak. This moderate climb rewards you with panoramic views of the surrounding mountains and valleys. The hike takes about 2 hours round trip, allowing plenty of time to capture stunning photos and enjoy the fresh mountain air.', 'Morning'),
(124, 33, 'Local Cuisine Experience', 'Enjoy an authentic Sri Lankan lunch at a carefully selected local restaurant. Sample traditional rice and curry dishes made with fresh, local ingredients and learn about the unique spices that define Sri Lankan cuisine.', 'Lunch'),
(125, 33, 'Nine Arches Bridge Tea Plantation', 'Visit the iconic Nine Arches Bridge, one of Sri Lankas most photographed landmarks. Learn about the colonial history and engineering marvel of this century-old viaduct. Afterward, explore a working tea plantation and learn about the tea-making process from leaf to cup.', 'Afternoon'),
(126, 33, 'Accommodation Check-in Leisure Time', 'Check into your comfortable accommodation in Ella town. Spend the evening at leisure exploring the charming streets of Ella, where you can find souvenir shops, cafes, and restaurants. Your guide will recommend the best spots for dinner.', 'Evening'),
(127, 34, 'Ella Rock Expedition', 'After an early breakfast, embark on a guided hike to the summit of Ella Rock. This more challenging trek takes approximately 4 hours round trip and offers spectacular views of Ella Gap and the surrounding landscapes. Your guide will share fascinating insights about the local flora and fauna along the way.', 'Morning'),
(128, 34, 'Picnic with a View', 'Enjoy a packed picnic lunch at a scenic spot with breathtaking views. The specially prepared meal includes a variety of local delicacies and fresh fruits, providing the perfect energy boost for your afternoon activities.', 'Lunch'),
(129, 34, 'Ravana Falls Cave', 'Visit the majestic Ravana Falls, a 25-meter high cascade with a fascinating mythology. According to the Ramayana epic, the cave behind the waterfall was where King Ravana hid Princess Sita. Enjoy some time to relax by the falls and take refreshing photographs.', 'Afternoon'),
(130, 34, 'Farewell Departure', 'Conclude your Ella Adventure with a farewell tea ceremony. Your guide will drop you off at your accommodation or the Ella Railway Station, where you can continue your Sri Lankan journey with wonderful memories of Ella natural beauty.', 'Evening'),
(135, 39, 'Galle Fort Walking Tour', 'Dutch Reformed Church, lighthouse, and ramparts', 'Morning'),
(136, 39, 'Lunch at a Fort Café', 'Seafood or Dutch-inspired dishes', 'Afternoon'),
(137, 39, 'Sunset at Jungle Beach', 'Secluded cove near Galle', 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `tourpackage_images`
--

DROP TABLE IF EXISTS `tourpackage_images`;
CREATE TABLE IF NOT EXISTS `tourpackage_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT '0',
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourpackage_images`
--

INSERT INTO `tourpackage_images` (`image_id`, `package_id`, `image_path`, `is_primary`, `upload_date`) VALUES
(1, 1, '/assets/images/tourGuide/tourPackagePics/package_id_1/67fd4795c08b8_3206732018953679847927243669867831346765360n.jpg', 0, '2025-04-14 17:36:21'),
(2, 1, '/assets/images/tourGuide/tourPackagePics/package_id_1/67fd4795c2fa8_a-guide-to-the-best-hikes-in-ella-slider-1.jpg', 0, '2025-04-14 17:36:21'),
(3, 1, '/assets/images/tourGuide/tourPackagePics/package_id_1/67fd4795c38ab_caption.jpg', 0, '2025-04-14 17:36:21'),
(4, 1, '/assets/images/tourGuide/tourPackagePics/package_id_1/67fd4795c41d2_ella-sri-lanka-1.webp', 0, '2025-04-14 17:36:21'),
(5, 1, '/assets/images/tourGuide/tourPackagePics/package_id_1/67fd4795c4773_TheCommonWanderer-110.jpg', 0, '2025-04-14 17:36:21'),
(11, 4, '/assets/images/tourGuide/tourPackagePics/package_id_4/67fd6bd35111d_01.jpg', 0, '2025-04-14 20:10:59'),
(12, 4, '/assets/images/tourGuide/tourPackagePics/package_id_4/67fd6bd351f53_SigiriyaRock.jpg', 0, '2025-04-14 20:10:59'),
(13, 4, '/assets/images/tourGuide/tourPackagePics/package_id_4/67fd6bd352748_Sigiriya-4-1024x767.webp', 0, '2025-04-14 20:10:59'),
(14, 5, '/assets/images/tourGuide/tourPackagePics/package_id_5/67fd6e09dc780_LK81BI0200-03-E-1280-720.jpg', 0, '2025-04-14 20:20:25'),
(15, 5, '/assets/images/tourGuide/tourPackagePics/package_id_5/67fd6e09dd42c_TheCommonWanderer-8796-2.jpg', 0, '2025-04-14 20:20:25'),
(16, 5, '/assets/images/tourGuide/tourPackagePics/package_id_5/67fd6e09ddbdf_Yala-Deer.jpg', 0, '2025-04-14 20:20:25'),
(17, 5, '/assets/images/tourGuide/tourPackagePics/package_id_5/67fd6e09de6dc_Crowded-Yala-national-park.jpg', 0, '2025-04-14 20:20:25'),
(18, 6, '/assets/images/tourGuide/tourPackagePics/package_id_6/67fd6eb947d77_featured-img2.jpg', 0, '2025-04-14 20:23:21'),
(19, 6, '/assets/images/tourGuide/tourPackagePics/package_id_6/67fd6eb94bc7b_Galle-Fort.jpg', 0, '2025-04-14 20:23:21'),
(20, 6, '/assets/images/tourGuide/tourPackagePics/package_id_6/67fd6eb94c8d5_Galle-fort-02-1.jpg', 0, '2025-04-14 20:23:21'),
(21, 6, '/assets/images/tourGuide/tourPackagePics/package_id_6/67fd6eb94d23e_galle-fort-city-sri-lanka-drone-5.jpg.webp', 0, '2025-04-14 20:23:21'),
(22, 1, '/assets/images/tourGuide/tourPackagePics/package_id_1/680b706d58319_3b3a151d94508512e6e3546ad86fd353.jpg', 0, '2025-04-25 11:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `tourpackage_itinerary`
--

DROP TABLE IF EXISTS `tourpackage_itinerary`;
CREATE TABLE IF NOT EXISTS `tourpackage_itinerary` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  PRIMARY KEY (`day_id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourpackage_itinerary`
--

INSERT INTO `tourpackage_itinerary` (`day_id`, `package_id`, `day_number`) VALUES
(4, 4, 1),
(5, 5, 1),
(33, 1, 1),
(34, 1, 2),
(39, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_booking_notifications`
--

DROP TABLE IF EXISTS `tour_booking_notifications`;
CREATE TABLE IF NOT EXISTS `tour_booking_notifications` (
  `tour_booking_notification_Id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_Id` int(11) NOT NULL,
  `booking_Id` int(11) NOT NULL,
  PRIMARY KEY (`tour_booking_notification_Id`),
  KEY `notification_Id` (`notification_Id`),
  KEY `booking_Id` (`booking_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_booking_notifications`
--

INSERT INTO `tour_booking_notifications` (`tour_booking_notification_Id`, `notification_Id`, `booking_Id`) VALUES
(1, 29, 2),
(2, 33, 3),
(3, 40, 4),
(4, 42, 5),
(5, 44, 6);

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
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'defaultUserIcon.png',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `emailVerified` tinyint(1) NOT NULL DEFAULT '0',
  `verificationToken` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tokenExpiry` datetime DEFAULT NULL,
  `status` enum('Enabled','Disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enabled',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`traveler_Id`),
  UNIQUE KEY `travelerEmail` (`travelerEmail`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=100026 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traveler`
--

INSERT INTO `traveler` (`traveler_Id`, `fName`, `lName`, `username`, `travelerEmail`, `travelerPassword`, `travelerMobileNum`, `profilePicture`, `bio`, `emailVerified`, `verificationToken`, `tokenExpiry`, `status`, `created_at`, `updated_at`) VALUES
(100001, 'Test', 'User', 'Tester', 'test@gmail.com', '$2y$10$0Om1no9qLUU/p3TFZc3Fz.UKw84s90mp3eU7Tj9ib68IMD5y6uyuW', '0715770109', '680f08cf546a1_mechanicLogoo.jpg', 'This default user is used to test the interaction of traveler components with other components.', 1, NULL, NULL, 'Enabled', '2024-12-10 21:20:15', '2025-04-28 04:49:19'),
(100004, NULL, NULL, 'Sharma123', 'sharma@gmail.com', '$2y$10$KJzfheQik0te1.l179CAQe95pmNvRmr6ajDp5pD0wroh3nKFN/hei', NULL, NULL, NULL, 0, NULL, NULL, 'Enabled', '2024-12-10 21:29:14', '2024-12-27 10:49:31'),
(100009, '', '', 'Thugston', 'thagshan@gmail.com', '$2y$10$HSRpRt3kvK0vkjAI5SC3m.AaAWpLqUq/5jocDruTNVJ9Lrm/wB81G', NULL, NULL, NULL, 0, NULL, NULL, 'Enabled', '2025-01-19 06:01:49', '2025-01-19 06:01:49'),
(100010, '', '', 'sampleUser', 'sample@gmail.com', '$2y$10$dNfHi2B1.uCCv2IyV0p.7uzAmFLdwPc9L3o6nq2I0elGyQ9/la/ZC', NULL, NULL, NULL, 0, NULL, NULL, 'Enabled', '2025-01-30 10:43:39', '2025-01-30 10:43:39'),
(100011, 'Hashir', 'Ahmadh', 'Hashir75', 'hashir123@gmail.com', '$2y$10$2jv633wOfS6ojaUbPkn5CeFXxl26WnQh.Inj8wfnzWv5qRFpq/Y.C', '0775400167', '680084bcd8f7a_Hashir Ahmed.jpg', 'Always chasing the next sunrise. From mountains to markets, I believe the best stories come from the road. Pack light, live loud.', 0, NULL, NULL, 'Enabled', '2025-04-17 04:33:21', '2025-04-17 04:36:33'),
(100012, 'Abdul', 'Raheem', 'Raheem25', 'raheem234@gmail.com', '$2y$10$0M.e5rpP1ZdJSZAz.I3wAO62/7ZgKopUGDu3aVIohHJUYogFvmWU6', '0769634145', '680085fdcd3c9_Abdul Raheem.jpg', 'Working remotely, living globally. Coffee in one hand, camera in the other. Traveling not to escape life, but so life doesnâ€™t escape me.', 0, NULL, NULL, 'Enabled', '2025-04-17 04:37:38', '2025-04-17 04:39:25'),
(100013, 'Hamdhi', 'Hamza', 'Hamdhi50', 'hamdhi345@gmail.com', '$2y$10$CTQNEThp7YNA/e8POS6O0OInn3PUnGInknhYElwg6QYFCOnqOSfDG', '0751626864', '68008723b428e_Hamdhi Hamza.jpg', 'Just a guy with a backpack, good vibes, and a list of places to see before I settle down. Beaches, books, and bucket lists.', 0, NULL, NULL, 'Enabled', '2025-04-17 04:40:14', '2025-04-17 04:44:19'),
(100014, 'Amanda', 'Nethmini', 'Amandaaa', 'amanda456@gmail.com', '$2y$10$1yhiyTtdv.kY9wkVP9XS7OFwHotb/80YSCzgeT6Jnw75HB6LG8a9e', NULL, NULL, NULL, 0, NULL, NULL, 'Enabled', '2025-04-17 04:51:07', '2025-04-28 08:15:15'),
(100015, '', '', 'Anji118', 'anji567@gmail.com', '$2y$10$7rj0uXPt/FGseo6AeD/GSeupME0jLA1TiMWNjm3/lhGV.xRWTz5Wi', NULL, NULL, NULL, 0, NULL, NULL, 'Enabled', '2025-04-17 04:53:01', '2025-04-17 04:53:01'),
(100020, 'Nihmath', 'Jabir', 'Jabir31', 'mnnjabir@gmail.com', '$2y$10$J7tSDWFXxn7JYqmIVbbg9.Qs/.vWeuk17NWprKr5y4oM1oxkzV9WS', '0756742490', '680f06c96c108_Nihmath Jabir.jpg', 'Earn. Eat. Travel. Repeat. Living the Sri Lankan dream one adventure at a time.', 1, NULL, NULL, 'Enabled', '2025-04-22 13:44:14', '2025-04-28 04:40:41'),
(100022, '', '', 'AbdZak', 'mzabdulla25@gmail.com', '$2y$10$kPMCtA3yD3ZfZoKwSkWiq.kJfvW6LkOsbvWCOKMX3SZ9CvNm8jyvO', NULL, NULL, NULL, 0, '59266de53df65a086d91fbc54701c6c33de1ff213fca0d7030e0b10fff0139f6', '2025-04-24 16:47:55', 'Enabled', '2025-04-23 11:17:55', '2025-04-23 11:17:55'),
(100023, '', '', 'exploreLKAdmin', 'explorelk050@gmail.com', '$2y$10$d8Xx3qGHwBGW0rRXownJnOLPUszmL3t8BADy4pcBaph/4y2Rjb83e', NULL, NULL, NULL, 1, NULL, NULL, 'Enabled', '2025-04-23 11:20:16', '2025-04-23 11:20:44'),
(100024, '', '', 'newTestUser', '2022is036@stu.ucsc.cmb.ac.lk', '$2y$10$VaSOVicrDOQ.UTWKzmvAQekE3h4NYIdMpuy1KAI0tbfBm8nSv6vD6', NULL, NULL, NULL, 0, '59266de53df65a086d91fbc54701c6c33de1ff213fca0d7030e0b10fff0139f6', '2025-04-24 00:13:48', 'Enabled', '2025-04-26 18:32:24', '2025-04-26 18:43:54'),
(100025, '', '', 'Sangeerth', 'sangeerththanasarma@gmail.com', '$2y$10$T0Efda/qnZBTUDC7AjvFmO6IyjYGCkdpvTuKR4MU4CKwVgpE2T17W', NULL, 'defaultUserIcon.png', NULL, 0, '23c8721af2ae49aca97d98ac560074992530fafe3b8b3668c5b6b929e34fa4ce', '2025-04-29 14:11:12', 'Enabled', '2025-04-28 08:41:12', '2025-04-28 08:41:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traveler_bank_account`
--

INSERT INTO `traveler_bank_account` (`traveler_bankAccount_Id`, `traveler_Id`, `traveler_accountNum`, `traveler_bankName`, `traveler_bankBranch`, `created_at`, `updated_at`) VALUES
(1, 100001, '200209102877', 'Hatton National Bank', 'Maligawatte', '2024-12-17 05:57:44', '2024-12-27 10:24:29'),
(5, 100011, '111122223333', 'Commercial Bank', 'Mawanella', '2025-04-17 04:36:33', '2025-04-17 04:36:33'),
(6, 100012, '111122223344', 'Hatton National Bank', 'Mount Lavinia', '2025-04-17 04:39:25', '2025-04-17 04:39:25'),
(7, 100013, '111122224455', 'DFCC Bank', 'Galle', '2025-04-17 04:44:19', '2025-04-17 04:44:19'),
(8, 100020, '020331031020', 'National Savings Bank', 'Maligawatte', '2025-04-22 14:45:20', '2025-04-22 14:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `travelprovider`
--

DROP TABLE IF EXISTS `travelprovider`;
CREATE TABLE IF NOT EXISTS `travelprovider` (
  `travelagent_Id` int(11) NOT NULL AUTO_INCREMENT,
  `travelagentName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serviceProviderName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelagentEmail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelagentPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelagentMobileNum` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelagentAddress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalVechicle` int(11) DEFAULT NULL,
  `BRNum` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearStarted` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_para1` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`travelagent_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travelprovider`
--

INSERT INTO `travelprovider` (`travelagent_Id`, `travelagentName`, `serviceProviderName`, `travelagentEmail`, `travelagentPassword`, `travelagentMobileNum`, `travelagentAddress`, `district`, `province`, `totalVechicle`, `BRNum`, `yearStarted`, `description_para1`) VALUES
(1, 'Kamal Perera', 'Ceylon Travels', 'kamal@ceylontravels.lk', 'hashed_password_1', '0771234567', '123 Main Street, Colombo', 'Colombo', 'Western', 8, 'BR123456789', '2015', NULL),
(2, 'Shanika De Silva', 'Island Tours Pvt Ltd', 'shanika@islandtours.lk', 'hashed_password_2', '0777654321', '56 Galle Road, Galle', 'Galle', 'Southern', 5, 'BR987654321', '2018', NULL),
(3, 'Nimal Fernando', 'Heritage Voyages', 'nimal@heritagevoyages.lk', 'hashed_password_3', '0711122233', '78 Temple Road, Kandy', 'Kandy', 'Central', 10, 'BR112233445', '2012', NULL),
(4, 'Ruwan Jayasuriya', 'Hilltop Rides', 'ruwan@hilltoprides.lk', 'hashed_password_4', '0753344556', '22 Hill Street, Nuwara Eliya', 'Nuwara Eliya', 'Central', 4, 'BR556677889', '2020', NULL),
(5, 'Dilani Abeysekara', 'Tropical Wheels', 'dilani@tropicalwheels.lk', 'hashed_password_5', '0789988776', '99 Paradise Avenue, Trincomalee', 'Trincomalee', 'Eastern', 7, 'BR667788990', '2016', NULL),
(6, '', '', '', '', '', '', 'Colombo', 'Western', NULL, '2222222', '2023', NULL),
(7, '', '', '', '', '', '', 'Colombo', 'Western', NULL, '2022/is-085', '2025', NULL),
(8, '', '', '', '', '', '', 'Colombo', 'western', NULL, 'er34555', '2024', NULL),
(9, '', '', '', '', '', '', 'Colombo', 'Western', NULL, '2022is02', '2012', NULL),
(10, '', '', '', '', '', '', 'Nuwara Eliya', 'Central', NULL, '2022is036', '2022', NULL),
(12, 'abcdabcd', 'abcd', 'abcd@gmail.com', '$2y$10$AWO5SNta858xSNUItMmOD.Zxh5ecLSRTA.CCl5tUk/GTsGmeOdWYW', '0701524235', 'bsaiu12', 'Colombohihi', 'Western', NULL, '123abcd3', '2025', 'car rental'),
(13, 'abcdabcd', 'abcd', 'abcd@gmail.com', '$2y$10$ZTATFxAXIxv9Bo5QeKJ3IeG5PoAg66/1zkbpZrChR483qzlxu1thG', '0701524235', 'bsaiu12', 'Colombo', 'Western', NULL, '123abcd3', '2025', NULL),
(14, 'Araliya Green Hills Hotel', 'Sharma', 'sbd@gmail.com', '$2y$10$CcypUYlNB3HeyZejeJZiCuOBGxVLeTly3Ng70YzJqhcrebXY4bpb6', '0771144552', 'jkgudshlkoil', 'Nuwara Eliya', 'Western', NULL, '2022IS036', '2024', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travelprovider_reviews`
--

DROP TABLE IF EXISTS `travelprovider_reviews`;
CREATE TABLE IF NOT EXISTS `travelprovider_reviews` (
  `review_Id` int(11) NOT NULL AUTO_INCREMENT,
  `travelagent_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `vehicle_booking_Id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travelprovider_reviews`
--

INSERT INTO `travelprovider_reviews` (`review_Id`, `travelagent_Id`, `traveler_Id`, `vehicle_booking_Id`, `rating`, `review_text`, `created_at`) VALUES
(1, 13, 100001, 20001, 5, 'Amazing service! The booking process was smooth, and the vehicle was in excellent condition.', '2025-03-15 14:30:00'),
(2, 13, 100002, 20002, 3, 'Decent experience, but the vehicle was slightly delayed. Customer support was helpful.', '2025-03-20 09:45:00'),
(3, 13, 100003, 20003, 4, 'Great trip overall. The driver was professional, but the vehicle could have been cleaner.', '2025-04-01 18:20:00'),
(4, 13, 100004, 20004, 2, 'Disappointing experience. The booking was confirmed late, and communication was poor.', '2025-04-10 11:15:00'),
(5, 13, 100005, 20005, 5, 'Fantastic service! Everything was on time, and the staff was very friendly.', '2025-04-25 16:00:00');

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
  `foodPreference` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`trip_Id`),
  KEY `FK_Trips_Traveler` (`traveler_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_Id`, `traveler_Id`, `tripName`, `startingLocation`, `destination`, `startDate`, `endDate`, `departureTime`, `transportationMode`, `numberOfTravelers`, `budgetPerPerson`, `foodPreference`) VALUES
(2, 100001, 'Family Outing', 'Colombo', 'Haputale', '2025-05-02', '2025-05-04', '05:30:00', 'Van', 10, '12500.00', NULL),
(6, 100020, 'Code Check', 'UCSC, Reid Avenue, Colombo', 'Home', '2025-04-28', '2025-04-29', '16:30:00', 'Car', 1, '100.00', 'Vegetarian'),
(7, 100020, 'Check Trip', 'Colombo', 'Nuwara Eliya', '2025-04-28', '2025-04-29', '17:12:00', 'Car', 1, '1000.00', 'veg11'),
(8, 100020, 'new trip', 'Galle', 'Nuwara Eliya', '2025-04-28', '2025-04-30', '17:42:00', 'Van', 5, '10000.00', 'veg123');

-- --------------------------------------------------------

--
-- Table structure for table `trip_collaborators`
--

DROP TABLE IF EXISTS `trip_collaborators`;
CREATE TABLE IF NOT EXISTS `trip_collaborators` (
  `collaborator_Id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_Id` int(11) DEFAULT NULL,
  `collaborator_traveler_Id` int(11) NOT NULL,
  `trip_owner_Id` int(11) NOT NULL,
  `role` enum('editor','viewer') COLLATE utf8mb4_unicode_ci DEFAULT 'editor',
  `request_status` enum('pending','accepted','declined') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `invited_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collaborator_Id`),
  KEY `trip_Id` (`trip_Id`),
  KEY `traveler_Id` (`collaborator_traveler_Id`),
  KEY `trip_owner_Id` (`trip_owner_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_collaborators`
--

INSERT INTO `trip_collaborators` (`collaborator_Id`, `trip_Id`, `collaborator_traveler_Id`, `trip_owner_Id`, `role`, `request_status`, `invited_at`, `updated_at`) VALUES
(11, 10, 100002, 100001, 'editor', 'accepted', '2025-02-01 11:05:20', '2025-02-20 05:59:36'),
(12, 10, 100003, 100001, 'viewer', 'accepted', '2025-02-01 11:05:35', '2025-02-06 06:32:42'),
(13, 10, 100004, 100001, 'editor', 'pending', '2025-02-01 17:32:48', '2025-02-02 19:32:26'),
(20, 1, 100002, 100001, 'editor', 'accepted', '2025-04-17 15:08:23', '2025-04-17 15:09:45'),
(21, 3, 100001, 100020, 'editor', 'declined', '2025-04-25 16:08:46', '2025-04-26 20:48:46'),
(22, 3, 100004, 100020, 'viewer', 'pending', '2025-04-26 20:33:28', '2025-04-26 20:33:28'),
(23, 4, 100001, 100020, 'editor', 'accepted', '2025-04-28 09:18:35', '2025-04-28 09:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `trip_days`
--

DROP TABLE IF EXISTS `trip_days`;
CREATE TABLE IF NOT EXISTS `trip_days` (
  `day_Id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_Id` int(11) NOT NULL,
  `day_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`day_Id`),
  KEY `trip_Id` (`trip_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_days`
--

INSERT INTO `trip_days` (`day_Id`, `trip_Id`, `day_number`) VALUES
(1, 10, 1),
(2, 10, 2),
(6, 11, 1),
(7, 11, 1),
(8, 11, 2),
(9, 11, 3),
(10, 12, 1),
(11, 12, 2),
(12, 1, 1),
(13, 1, 2),
(14, 1, 3),
(15, 2, 1),
(16, 2, 2),
(17, 2, 3),
(18, 3, 1),
(19, 3, 2),
(20, 4, 1),
(21, 4, 2),
(22, 5, 1),
(23, 6, 1),
(24, 7, 1),
(25, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trip_places`
--

DROP TABLE IF EXISTS `trip_places`;
CREATE TABLE IF NOT EXISTS `trip_places` (
  `place_Id` int(11) NOT NULL AUTO_INCREMENT,
  `day_Id` int(11) NOT NULL,
  `place_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_order` int(11) DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  PRIMARY KEY (`place_Id`),
  UNIQUE KEY `day_Id` (`day_Id`,`place_order`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_places`
--

INSERT INTO `trip_places` (`place_Id`, `day_Id`, `place_name`, `place_order`, `arrival_time`, `departure_time`) VALUES
(1, 1, 'Ramboda Falls', 1, '10:30:00', '11:30:00'),
(2, 1, 'Blue Field Tea Factory ', 2, '12:00:00', '01:00:00'),
(3, 1, 'Lake Gregory, Nuwara Eliya', 3, '14:30:00', '16:30:00'),
(4, 2, 'Horton Plains National Park', 1, '07:30:00', '11:30:00'),
(5, 2, 'Seetha Amman Temple', 2, '12:45:00', '13:30:00'),
(6, 2, 'Victoria Park, Nuwara Eliya', 3, '14:30:00', '16:30:00'),
(10, 7, 'Liptonâ€™s Seat', 1, '13:00:00', '15:30:00'),
(11, 7, 'Dambatenne Tea Factory', 2, '16:15:00', '17:30:00'),
(12, 8, 'Prabhawa Mountain Viewpoint', 1, '06:00:00', '07:30:00'),
(13, 8, 'Adisham Bungalow', 2, '20:15:00', '10:30:00'),
(14, 8, 'Diyaluma Falls', 3, '12:00:00', '16:00:00'),
(15, 9, 'Horton Plains National Park', 1, '06:00:00', '10:00:00'),
(16, 9, 'Bakers Falls', 2, '11:00:00', '15:30:00'),
(17, 10, 'Gregory Lake, Nuwara Eliya', 1, '21:50:00', '02:55:00'),
(18, 11, 'Victoria Park, Peradeniya-Badulla-Chenkaladi Highway, Nuwara Eliya', 1, '20:54:00', '20:56:00'),
(19, 12, 'Wangedigala Nature cottage', 1, '11:00:00', '15:00:00'),
(20, 12, 'Surathali Ella, Belihuloya', 2, '15:30:00', '17:30:00'),
(21, 13, 'Bambarakanda Falls, Kalupahana', 1, '11:00:00', '13:00:00'),
(22, 13, 'Adisham Bungalow', 2, '14:00:00', '16:00:00'),
(23, 14, 'Haputale Railways Station', 1, '09:45:00', '10:10:00'),
(24, 14, 'Railway Station - Nanuoya', 2, '12:00:00', '15:00:00'),
(25, 15, 'Kalupahana Double Bridge', 1, '11:30:00', '12:00:00'),
(26, 15, 'Surathali Ella, Belihuloya', 2, '12:45:00', '14:00:00'),
(27, 15, 'Wangedigala Camp Site', 3, '16:00:00', '18:00:00'),
(28, 16, 'Adisham Bungalow', 1, '10:00:00', '11:00:00'),
(29, 16, 'Bambarakanda Falls, Kalupahana', 2, '12:00:00', '15:00:00'),
(30, 17, 'Haputale Railways Station', 1, '10:00:00', '10:15:00'),
(31, 17, 'Nanu Oya Railway Station', 2, '12:00:00', '12:15:00'),
(32, 17, 'Nanu Oya Water Falls', 3, '13:00:00', '15:00:00'),
(33, 17, 'Nanu Oya Railway Station', 4, '15:45:00', '16:00:00'),
(34, 17, 'Haputale Railways Station', 5, '17:45:00', '18:00:00'),
(35, 18, 'dfghj', 1, '21:44:00', '21:44:00'),
(36, 19, 'sdfghjkl', 1, '21:41:00', '23:38:00'),
(37, 20, 'Gregory Lake, Nuwara Eliya', 1, '10:00:00', '13:46:00'),
(38, 20, 'Victoria Park,', 2, '02:48:00', '14:48:00'),
(39, 20, 'sample', 3, '02:47:00', '02:47:00'),
(40, 21, 'test placw', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `vehicle_Id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleType_Id` int(11) NOT NULL,
  `registration_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','booked','maintenance') COLLATE utf8mb4_unicode_ci DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `travelagent_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`vehicle_Id`),
  UNIQUE KEY `registration_number` (`registration_number`),
  KEY `vehicleType_Id` (`vehicleType_Id`),
  KEY `fk_constraint_travelagent_Id` (`travelagent_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accommodation_booking_notifications`
--
ALTER TABLE `accommodation_booking_notifications`
  ADD CONSTRAINT `accommodation_booking_notifications_ibfk_1` FOREIGN KEY (`notification_Id`) REFERENCES `notifications` (`notification_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accommodation_booking_notifications_ibfk_2` FOREIGN KEY (`room_booking_Id`) REFERENCES `room_bookings_final` (`room_booking_Id`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer` (`organizer_Id`) ON DELETE CASCADE;

--
-- Constraints for table `eventcommissions`
--
ALTER TABLE `eventcommissions`
  ADD CONSTRAINT `fk_eventcommissions_event` FOREIGN KEY (`event_Id`) REFERENCES `event` (`event_Id`);

--
-- Constraints for table `event_booking_commission`
--
ALTER TABLE `event_booking_commission`
  ADD CONSTRAINT `event_booking_commission_ibfk_1` FOREIGN KEY (`event_Id`) REFERENCES `event` (`event_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_booking_commission_ibfk_2` FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer` (`organizer_Id`) ON DELETE CASCADE;

--
-- Constraints for table `event_booking_notifications`
--
ALTER TABLE `event_booking_notifications`
  ADD CONSTRAINT `event_booking_notifications_ibfk_1` FOREIGN KEY (`notification_Id`) REFERENCES `notifications` (`notification_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_booking_notifications_ibfk_2` FOREIGN KEY (`booking_Id`) REFERENCES `event_booking` (`booking_Id`) ON DELETE CASCADE;

--
-- Constraints for table `event_cancellations`
--
ALTER TABLE `event_cancellations`
  ADD CONSTRAINT `event_cancellations_ibfk_1` FOREIGN KEY (`event_Id`) REFERENCES `event` (`event_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_cancellations_ibfk_2` FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer` (`organizer_Id`) ON DELETE CASCADE;

--
-- Constraints for table `event_organizer_bank`
--
ALTER TABLE `event_organizer_bank`
  ADD CONSTRAINT `event_organizer_bank_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `event_organizer` (`organizer_Id`);

--
-- Constraints for table `event_refunds`
--
ALTER TABLE `event_refunds`
  ADD CONSTRAINT `event_refunds_ibfk_1` FOREIGN KEY (`booking_Id`) REFERENCES `event_booking` (`booking_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_refunds_ibfk_2` FOREIGN KEY (`cancellation_Id`) REFERENCES `event_cancellations` (`cancellation_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_refunds_ibfk_3` FOREIGN KEY (`traveler_Id`) REFERENCES `traveler` (`traveler_Id`) ON DELETE CASCADE;

--
-- Constraints for table `event_ticket_purchasers`
--
ALTER TABLE `event_ticket_purchasers`
  ADD CONSTRAINT `event_ticket_purchasers_ibfk_1` FOREIGN KEY (`booking_Id`) REFERENCES `event_booking` (`booking_Id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_status`
--
ALTER TABLE `restaurant_status`
  ADD CONSTRAINT `restaurant_status_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE;

--
-- Constraints for table `tourguidebankaccount`
--
ALTER TABLE `tourguidebankaccount`
  ADD CONSTRAINT `fk_guide_Id` FOREIGN KEY (`guide_Id`) REFERENCES `tourguide` (`guide_Id`) ON DELETE CASCADE;

--
-- Constraints for table `tourguidecommissions`
--
ALTER TABLE `tourguidecommissions`
  ADD CONSTRAINT `tourguidecommissions_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `tourguide` (`guide_Id`) ON DELETE CASCADE;

--
-- Constraints for table `tourguidecomplaints`
--
ALTER TABLE `tourguidecomplaints`
  ADD CONSTRAINT `tourguidecomplaints_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `tourguide` (`guide_Id`);

--
-- Constraints for table `tourpackages`
--
ALTER TABLE `tourpackages`
  ADD CONSTRAINT `tourpackages_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `tourguide` (`guide_Id`);

--
-- Constraints for table `tourpackage_activities`
--
ALTER TABLE `tourpackage_activities`
  ADD CONSTRAINT `tourpackage_activities_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `tourpackage_itinerary` (`day_id`) ON DELETE CASCADE;

--
-- Constraints for table `tourpackage_images`
--
ALTER TABLE `tourpackage_images`
  ADD CONSTRAINT `tourpackage_images_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tourpackages` (`package_id`) ON DELETE CASCADE;

--
-- Constraints for table `tourpackage_itinerary`
--
ALTER TABLE `tourpackage_itinerary`
  ADD CONSTRAINT `tourpackage_itinerary_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tourpackages` (`package_id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_booking_notifications`
--
ALTER TABLE `tour_booking_notifications`
  ADD CONSTRAINT `tour_booking_notifications_ibfk_1` FOREIGN KEY (`notification_Id`) REFERENCES `notifications` (`notification_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_booking_notifications_ibfk_2` FOREIGN KEY (`booking_Id`) REFERENCES `tourbookings` (`booking_id`) ON DELETE CASCADE;

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
