/*Written By Marcus */

/*Creating Schema for LOCAL ONLY*/
drop database `HappyHome`;
CREATE SCHEMA `HappyHome` ;
USE `HappyHome`;

/*Creating Tables*/
/*User Table Table*/
CREATE TABLE users
(
		`id` int(10) NOT NULL AUTO_INCREMENT,
	  `first_name` varchar(191) NOT NULL,
	  `last_name` varchar(191) NOT NULL,
	  `type` enum('owner','sitter') DEFAULT NULL,
	  `email` varchar(191) NOT NULL,
	  `password` varchar(191) NOT NULL,
	  `contact_number` varchar(20) NOT NULL,
	  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		CONSTRAINT id_pk primary key(id)
);


/*Creating House*/
/*User House Table*/
CREATE TABLE houses
(
	`id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_no` varchar(191) DEFAULT NULL,
  `full_address` varchar(191) NOT NULL,
  `street_number` varchar(191) NOT NULL,
  `route` varchar(191) NOT NULL,
  `locality` varchar(191) NOT NULL,
  `administrative_area_level_1` varchar(191) NOT NULL,
  `postal_code` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `description` mediumtext,
  `pet` tinyint(1) NOT NULL DEFAULT '0',
  `plant` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `cover_image` varchar(191) DEFAULT NULL,
  `owner` int(10) NOT NULL,


    Constraint id_pk primary key(ID),
    CONSTRAINT `created_by_user_id_fk` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

CREATE TABLE house_listing
(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `house_id` int(10) NOT NULL,
    `taken_by_user_id` int(10) DEFAULT NULL,
     `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
     `start_date` date DEFAULT '0000-00-00',
     `end_date` date DEFAULT '0000-00-00',
     `status` enum('available','taken','finished') NOT NULL DEFAULT 'available',
     `review_score` double DEFAULT NULL,
     `review` mediumtext,
     `price` double NOT NULL,

    CONSTRAINT id_pk primary key(id),
    CONSTRAINT `id_fk` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
    CONSTRAINT `rented_by_user_id_fk` FOREIGN KEY (`taken_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE

);