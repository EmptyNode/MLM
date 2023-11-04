/*
SQLyog Community v9.63 
MySQL - 5.5.27 : Database - mlm_database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mlm_database` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mlm_database`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

insert  into `admin`(`id`,`first_name`,`last_name`,`username`,`password`) values (1,'admin','admin','admin','$2y$10$GVsYW.DdSs/0NkdMoY9JbOfUUGrctGAXQPTrlEpJyJUtIKGNmgTbq');

/*Table structure for table `service_category` */

DROP TABLE IF EXISTS `service_category`;

CREATE TABLE `service_category` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `service_category` */

insert  into `service_category`(`sc_id`,`s_category`) values (1,'Car'),(2,'House'),(3,'Hotel'),(4,'Restaurant'),(5,'Hospital'),(6,'Collage'),(7,'Astrology'),(8,'Bakery'),(9,'Bank'),(10,'Computer');

/*Table structure for table `service_master` */

DROP TABLE IF EXISTS `service_master`;

CREATE TABLE `service_master` (
  `sm_id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `img` text,
  `user_id` int(11) DEFAULT NULL,
  `iTime` datetime NOT NULL,
  PRIMARY KEY (`sm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `service_master` */

insert  into `service_master`(`sm_id`,`service`,`location`,`addr`,`pin`,`mobile`,`whatsapp`,`email`,`img`,`user_id`,`iTime`) values (1,'House','Jadavpur','Cccc','781452','2323223232','4465645646','a@gm.com','/AnkanDa/uinclude/userUploads/../userUploads/20230916225613_6630d__favicon.png',1,'2023-09-17 02:26:13'),(2,'Car','Rajpur','Bally, Bridge','775588','2222222222','4465645646','ab@gm.com','/AnkanDa/uinclude/userUploads/../userUploads/20230916232037_8bafe__c2.jpg',1,'2023-09-17 02:50:37'),(3,'Hotel','Garia','Rajpur, Beside HDFC Bank','775588','6666666666','2121212121','img@gmail.com','/AnkanDa/uinclude/userUploads/../userUploads/20230916232302_a47a7__favicon.png',1,'2023-09-17 02:53:02'),(4,'Astrology','Bally','Baruipur, Bazaar','700140','9999999999','5565656566','a@gm.com','/AnkanDa1/uinclude/userUploads/../userUploads/20230917160415_88473__c2.jpg',1,'2023-09-17 19:34:15');

/*Table structure for table `user_tbl` */

DROP TABLE IF EXISTS `user_tbl`;

CREATE TABLE `user_tbl` (
  `uId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `addr` varchar(500) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `whatsApp` varchar(20) DEFAULT NULL,
  `referralCode` varchar(20) DEFAULT NULL,
  `auto_referralCode` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pan` varchar(20) DEFAULT NULL,
  `aadhaar` varchar(20) DEFAULT NULL,
  `bank_name` varchar(20) DEFAULT NULL,
  `ac_number` varchar(25) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `verification_img` text,
  `bank_img` text,
  `profile_img` text,
  `approval_status` tinyint(1) NOT NULL,
  `iTime` datetime DEFAULT NULL,
  PRIMARY KEY (`uId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_tbl` */

insert  into `user_tbl`(`uId`,`firstName`,`lastName`,`addr`,`mobile`,`phone`,`whatsApp`,`referralCode`,`auto_referralCode`,`password`,`email`,`dob`,`pan`,`aadhaar`,`bank_name`,`ac_number`,`ifsc_code`,`verification_img`,`bank_img`,`profile_img`,`approval_status`,`iTime`) values (1,'ABC',NULL,NULL,NULL,NULL,NULL,NULL,'ABC123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-09-21 22:29:47'),(2,NULL,NULL,NULL,'2323223232',NULL,NULL,'ABC123','8KD552','$2y$10$n5qwj01x4q6eywhKvfDDCOHZHxKVyYerh0Py6pGngLTGawDpobL/.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-09-21 22:30:12'),(3,NULL,NULL,NULL,'2323223232',NULL,NULL,'8KD552','86HZXU','$2y$10$E98JWY6so9Ev.yGIytKTVelGiqMmGpPGASb.0JrIg8oiq2y7MTB1.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-21 22:46:46'),(4,'Raju',NULL,NULL,'2323223232',NULL,NULL,'86HZXU','6W9T97','$2y$10$1OQpsg7RR9EuQFWvYsAXMulxNhUIRJt/fFG7vCiW17IWH23E.wARa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-22 18:14:54'),(5,'Saikat',NULL,NULL,'2323223232',NULL,NULL,'8KD552','KYCBSP','$2y$10$phx2oz0nXrq45DvbULR97uydi1nNzTgiHZSxCaVtwP1lvcR7PpiRO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-22 18:16:53'),(6,NULL,NULL,NULL,'2323223232',NULL,NULL,'6W9T97','14V1QM','$2y$10$LcXvC90iJ4D6vMKEKWWBzeESTOFN6AEDU55TB4rLMlrgWSCjMkOEe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-22 18:17:34'),(7,NULL,NULL,NULL,'1111111111',NULL,NULL,'86HZXU','XYJ3QB','$2y$10$mGNc.XjOcelIlIUvaLciQuPfTtnBMDZG8LpFZ12sLkk8.W9jKfB.6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-24 21:35:36'),(8,NULL,NULL,NULL,'4546464646',NULL,NULL,'XYJ3QB','OUF3K0','$2y$10$Ko6QJc8uvJSeQbYHYAHFbO1o7SfT30pa1Q5ls7CkdAvZ2eYJemkoG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-24 23:05:22'),(9,NULL,NULL,NULL,'1212121221',NULL,NULL,'14V1QM','VZM2Q3','$2y$10$ZBxR4f..LIpzKxSIVRRsXOY3w2zZwVBW0BxXYzFTm1ndWtjs1VZ9G',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-24 23:14:19'),(10,NULL,NULL,NULL,'2323223232',NULL,NULL,'VZM2Q3','BCNPEG','$2y$10$uZl40NBYAoHKyzUoCsVmce32Jpr8.3Bh3feujf/FPbPFdreql8EMe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-25 00:04:09'),(11,NULL,NULL,NULL,'1111111111',NULL,NULL,'KYCBSP','Q56JVK','$2y$10$zPy0BGXKhs9LPZ9x3uggGOQfItRvp4Aib4paaLwZyGeY8YNuHsOae',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-25 00:21:49'),(12,NULL,NULL,NULL,'2323223233',NULL,NULL,'XYJ3QB','EDIK02','$2y$10$yr/NyjXVAngoUN8HuShlj.JulaE0fsW4yig0HhBgvdGWceXoyMoJe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-09-25 16:39:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
