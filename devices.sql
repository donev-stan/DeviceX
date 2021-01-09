SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `device_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `device_kind_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `brand` varchar(32) DEFAULT NULL,
  `price` int(4) DEFAULT NULL,
  `info` text DEFAULT NULL,
  `picture` varchar(32) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`device_id`),
  KEY `device_kind_id` (`device_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `devices` (`device_id`, `device_kind_id`, `name`, `brand`, `price`, `info`, `picture`, `registration_date`) VALUES
(1, 1, 'iPhone XR', 'Apple', 499, NULL, 'iphonexr.jpg', '2019-10-10 12:15:40'),
(2, 1, 'Galaxy A50', 'Samsung', 299, 'The Galaxy A50 is a well-rounded smartphone packing as many cool specs as possible.', 'samsunga50.jpg', '2019-10-10 12:18:16'),
(3, 1, 'iPhone 8 Plus', 'Apple', 399, NULL, 'iphone8plus.jpg', '2019-10-10 12:19:42'),
(4, 1, 'Galaxy S10', 'Samsung', 799, NULL, 'samsungs10.jpg', '2019-01-12 20:36:23'),
(5, 1, 'Galaxy A71', 'Samsung', 369, NULL, 'samsunga71.jpg', '2019-02-05 20:51:38'),
(6, 1, 'Galaxy S8 Plus', 'Samsung', 300, NULL, 'samsungs8.jpg', '2019-10-10 12:20:40'),
(7, 1, 'Pixel 4', 'Google', 799, NULL, 'pixel4.jpg', '2019-10-10 12:21:24'),
(8, 1, 'Redmi Note 8 Pro', 'Xiaomi', 229, NULL, 'redmi8.jpg', '2019-03-26 23:13:52'),
(9, 2, 'Surface Pro 4', 'Microsoft', 399, NULL, 'surface4.jpg', '2019-03-26 23:13:52'),
(10, 2, 'Galaxy View 2', 'Samsung', 699, NULL, 'galaxyview2.jpg', '2019-03-26 23:13:52'),
(11, 3, 'XPS 13 9380', 'Dell', 1400, NULL, 'dellxps.jpg', '2019-03-26 23:13:52'),
(12, 3, 'VivoBook 15', 'Asus', 1400, NULL, 'asus.jpg', '2019-03-26 23:13:52'),
(13, 3, 'MacBook Air 2018', 'Apple', 999, NULL, 'macbookair.jpg', '2019-03-26 23:13:52'),
(14, 4, 'Extreme Gaming PC', 'CLX Set', 4999, NULL, 'pc.jpg', '2019-10-10 12:18:16'),
(15, 5, 'Apple Watch Series 5', 'Apple', 899, NULL, 'applewatch.jpg', '2019-10-10 12:18:16'),
(16, 6, 'Custom Qi', 'Custom', 25, NULL, 'powerbank.jpg', '2019-10-10 12:18:16');


DROP TABLE IF EXISTS `device_kinds`;
CREATE TABLE IF NOT EXISTS `device_kinds` (
  `device_kind_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kind` varchar(32) NOT NULL,
  PRIMARY KEY (`device_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `device_kinds` (`device_kind_id`, `kind`) VALUES
(1, 'Телефони'),
(2, 'Таблети'),
(3, 'Лаптопи'),
(4, 'PC Десктоп'),
(5, 'Smart Часовници'),
(6, 'Батерий');


DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `username`, `user_type`, `pass`, `name`) VALUES
(1, 'admin', 1, 'admin', 'admin');


ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`device_kind_id`) REFERENCES `device_kinds` (`device_kind_id`) ON UPDATE CASCADE;
COMMIT;