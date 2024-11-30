CREATE TABLE `traveler` (
  `traveler_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `fName` VARCHAR(25),
  `lName` VARCHAR(25),
  `travelerEmail` VARCHAR(50) NOT NULL,
  `travelerPassword` VARCHAR(255) NOT NULL,
  `travelerMobileNum` VARCHAR(15),
  `homeDistrict` VARCHAR(100) NOT NULL,
  `travelPreferences` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`traveler_Id`)
);


CREATE TABLE `traveler_bank_account` (
  `traveler_bankAccount_Id` int(11) NOT NULL,
  `traveler_Id` int(11) NOT NULL,
  `traveler_accountNum` varchar(20) NOT NULL,
  `traveler_bankName` varchar(100) NOT NULL,
  `traveler_bankBranch` varchar(100) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
   FOREIGN KEY (`traveler_Id`) REFERENCES `traveler`(`traveler_Id`) ON DELETE CASCADE
) ;

CREATE TABLE `event_organizer` (
  `organizer_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `organizer_Name` VARCHAR(50) NOT NULL,
  `organizer_Email` VARCHAR(50) NOT NULL,
  `organizer_Password` VARCHAR(255) NOT NULL,
  `organizer_MobileNum` VARCHAR(10) NOT NULL,
  `company_Name` VARCHAR(100) NOT NULL,
  `office_Address` VARCHAR(255) NOT NULL,
  `organizer_Rating` DECIMAL(2,1),
  PRIMARY KEY (`organizer_Id`)
);

CREATE TABLE `event_organizer_bank_account` (
  `organizer_bankAccount_Id` int(11) NOT NULL,
  `organizer_Id` int(11) NOT NULL,
  `organizer_accountNum` varchar(20) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankBranch` varchar(100) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer`(`organizer_Id`) ON DELETE CASCADE
);

CREATE TABLE `event` (
  `event_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `organizer_Id` INT(11) NOT NULL,
  `eventName` VARCHAR(100) NOT NULL,
  `eventDescription` TEXT NOT NULL,
  `eventDate` DATE NOT NULL,
  `eventLocation` VARCHAR(255) NOT NULL,
  `eventMaxAttendees` INT(11) NOT NULL,
  `eventStatus` VARCHAR(25) NOT NULL,
  `isCompleted` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`event_Id`),
  FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer`(`organizer_Id`) ON DELETE CASCADE
); 

CREATE TABLE `event_booking` (
  `booking_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `event_Id` INT(11) NOT NULL,
  `traveler_Id` INT(11) NOT NULL,
  `bookedDate` DATE NOT NULL,
  `totalTickets` INT(11) NOT NULL,
  `totalPrice` DECIMAL(10,2) NOT NULL,
  `bookingStatus` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`booking_Id`),
  FOREIGN KEY (`event_Id`) REFERENCES `event`(`event_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`traveler_Id`) REFERENCES `traveler`(`traveler_Id`) ON DELETE CASCADE
); 

CREATE TABLE `event_cancellation` (
  `event_cancellation_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `event_Id` INT(11) NOT NULL,
  `cancellationReason` TEXT NOT NULL,
  `cancellationDate` DATETIME NOT NULL,
  PRIMARY KEY (`event_cancellation_Id`),
  FOREIGN KEY (`event_Id`) REFERENCES `event`(`event_Id`) ON DELETE CASCADE
) ;

CREATE TABLE `event_commission_record` (
  `commission_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `payout_Id` INT(11) DEFAULT NULL,
  `commissionAmount` DECIMAL(10,2) NOT NULL,
  `commissionDate` DATE NOT NULL,
  PRIMARY KEY (`commission_Id`)
) ;

CREATE TABLE `event_payment_received` (
  `payment_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `booking_Id` INT(11) NOT NULL,
  `paymentDate` DATE NOT NULL,
  `paymentAmount` DECIMAL(10,2) NOT NULL,
  `paymentMethod` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`payment_Id`),
  FOREIGN KEY (`booking_Id`) REFERENCES `event_booking`(`booking_Id`) ON DELETE CASCADE
) ;

CREATE TABLE `event_refund` (
  `refund_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `event_cancellation_Id` INT(11) NOT NULL,
  `traveler_bankAccount_Id` INT(11) NOT NULL,
  `refundAmount` DECIMAL(10,2) NOT NULL,
  `refundDate` DATETIME NOT NULL,
  `refundStatus` ENUM('Pending','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `refundEligibility` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`refund_Id`),
  FOREIGN KEY (`event_cancellation_Id`) REFERENCES `event_cancellation`(`event_cancellation_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`traveler_bankAccount_Id`) REFERENCES `traveler_bank_account`(`traveler_bankAccount_Id`) ON DELETE CASCADE
) ;


CREATE TABLE `event_payout` (
  `payout_Id` int(11) NOT NULL,
  `event_Id` int(11) NOT NULL,
  `organizer_Id` int(11) NOT NULL,
  `organizer_bankAccount_Id` int(11) NOT NULL,
  `totalSales` decimal(10,2) NOT NULL,
  `commisionAmount` decimal(10,2) NOT NULL,
  `netAmmount` decimal(10,2) NOT NULL,
  `payoutDate` date NOT NULL,
  `payoutStatus` varchar(50) NOT NULL,
  PRIMARY KEY (`payout_Id`),
  FOREIGN KEY (`event_Id`) REFERENCES `event`(`event_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`organizer_Id`) REFERENCES `event_organizer`(`organizer_Id`) ON DELETE CASCADE
) ;


CREATE TABLE `ticket_type` (
  `ticketType_Id` int(11) NOT NULL,
  `event_Id` int(11) NOT NULL,
  `ticketTypeName` varchar(50) NOT NULL,
  `ticketPrice` decimal(10,2) NOT NULL,
  `availableTickets` int(11) NOT NULL,
  PRIMARY KEY (`ticketType_Id`)

) ;

CREATE TABLE `ticket` (
  `ticket_ID` int(11) NOT NULL,
  `booking_Id` int(11) NOT NULL,
  `ticketType_Id` int(11) NOT NULL,
  `ticketNumber` varchar(50) NOT NULL,
  `ticketStatus` varchar(50) NOT NULL,
  PRIMARY KEY (`ticket_Id`),
  FOREIGN KEY (`booking_Id`) REFERENCES `event_booking`(`booking_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`ticketType_Id`) REFERENCES `ticket_type`(`ticketType_Id`) ON DELETE CASCADE,
) ;



-- Table structure for table `tourguide`-----------------------------------------------------------
CREATE TABLE `tourguide` (
  `guide_Id` INT(11) NOT NULL,
  `guide_Name` CHAR(50) ,
  `guide_Age` CHAR(50) ,
  `guide_Email` VARCHAR(50) ,
  `guide_MobileNum` VARCHAR(10) ,
  `guide_Password` VARCHAR(255) ,
  `guide_Bio` TEXT NOT ,
  `languages_Spoken` VARCHAR(100) ,
  `expertised_Regions` VARCHAR(100) ,
  `guide_Rating` DECIMAL(2,1) ,
  PRIMARY KEY (`guide_Id`)
);

CREATE TABLE `tour_type` (
  `tourType_Id` INT(11) NOT NULL,
  `guide_Id` INT(11) NOT NULL,
  `tourName` VARCHAR(25) ,
  `tourDescription` TEXT ,
  PRIMARY KEY (`tourType_Id`),
  FOREIGN KEY (`guide_Id`) REFERENCES `tourguide`(`guide_Id`) ON DELETE CASCADE
);

CREATE TABLE `tour_package` (
  `tourPackage_Id` INT(11) NOT NULL,
  `tourType_Id` INT(11) NOT NULL,
  `packageName` VARCHAR(25) NOT NULL,
  `tourLocation` VARCHAR(25) NOT NULL,
  `duration` VARCHAR(10) NOT NULL,
  `difficultyLevel` VARCHAR(10) NOT NULL,
  `groupSize` VARCHAR(25) NOT NULL,
  `pricePerPerson` DECIMAL(10,2) NOT NULL,
  `keyHighlights` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`tourPackage_Id`),
  FOREIGN KEY (`tourType_Id`) REFERENCES `tour_type`(`tourType_Id`) ON DELETE CASCADE
);

-- Dependent Tables
CREATE TABLE `tour` (
  `tour_Id` INT(11) NOT NULL,
  `guide_Id` INT(11) NOT NULL,
  `tourType_Id` INT(11) NOT NULL,
  `tourPackage_Id` INT(11) NOT NULL,
  `tourStartDate` DATE NOT NULL,
  `tourEndDate` DATE NOT NULL,
  PRIMARY KEY (`tour_Id`),
  FOREIGN KEY (`guide_Id`) REFERENCES `tourguide`(`guide_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`tourType_Id`) REFERENCES `tour_type`(`tourType_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`tourPackage_Id`) REFERENCES `tour_package`(`tourPackage_Id`) ON DELETE CASCADE
);

CREATE TABLE `tour_booking` (
  `tourBooking_Id` INT(11) NOT NULL,
  `tour_Id` INT(11) NOT NULL,
  `traveler_Id` INT(11) NOT NULL,
  `bookedDate` DATE NOT NULL,
  `numberOfPeople` INT(11) NOT NULL,
  `bookingStatus` VARCHAR(100) NOT NULL,
  `specialRequests` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`tourBooking_Id`),
  FOREIGN KEY (`tour_Id`) REFERENCES `tour`(`tour_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`traveler_Id`) REFERENCES `traveler`(`traveler_Id`) ON DELETE CASCADE
);

CREATE TABLE `tour_review` (
  `tourReview_Id` INT(11) NOT NULL,
  `tour_id` INT(11) NOT NULL,
  `traveler_Id` INT(11) NOT NULL,
  `tourReview` TEXT NOT NULL,
  `tourReview_Date` DATE NOT NULL,
  PRIMARY KEY (`tourReview_Id`),
  FOREIGN KEY (`tour_id`) REFERENCES `tour`(`tour_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`traveler_Id`) REFERENCES `traveler`(`traveler_Id`) ON DELETE CASCADE
);

CREATE TABLE `tour_cancellation` (
  `tour_cancellation_Id` INT(11) NOT NULL,
  `cancellationReason` TEXT NOT NULL,
  `cancellationDate` DATETIME NOT NULL,
  PRIMARY KEY (`tour_cancellation_Id`)
);

CREATE TABLE `tourguide_tour_cancellation` (
  `guide_tour_cancellation_Id` INT(11) NOT NULL,
  `tour_cancellation_Id` INT(11) NOT NULL,
  `guide_Id` INT(11) NOT NULL,
  `tour_id` INT(11) NOT NULL,
  PRIMARY KEY (`guide_tour_cancellation_Id`),
  FOREIGN KEY (`tour_cancellation_Id`) REFERENCES `tour_cancellation`(`tour_cancellation_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`guide_Id`) REFERENCES `tourguide`(`guide_Id`) ON DELETE CASCADE,
  FOREIGN KEY (`tour_id`) REFERENCES `tour`(`tour_Id`) ON DELETE CASCADE
);

CREATE TABLE `tour_refund` (
  `refund_Id` INT(11) NOT NULL,
  `tour_cancellation_Id` INT(11) NOT NULL,
  `traveler_bankAccount_Id` INT(11) NOT NULL,
  `refundAmount` DECIMAL(10,2) NOT NULL,
  `refundDate` DATETIME NOT NULL,
  `refundStatus` ENUM('Pending','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `refundEligibility` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`refund_Id`),
  FOREIGN KEY (`tour_cancellation_Id`) REFERENCES `tour_cancellation`(`tour_cancellation_Id`) ON DELETE CASCADE
);



