-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for books
DROP DATABASE IF EXISTS `books`;
CREATE DATABASE IF NOT EXISTS `books` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `books`;


-- Dumping structure for table books.authors
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Dumping data for table books.authors: 12 rows
DELETE FROM `authors`;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`author_id`, `author_name`) VALUES
	(35, 'Стивън Кинг'),
	(34, 'Явор Цанев'),
	(33, 'Линкълн Чайлд'),
	(32, 'Дъглас Престън'),
	(31, 'Жауме Кабре'),
	(30, 'Андре Мороа'),
	(29, 'Антъни Доер'),
	(28, 'Елинор Катън'),
	(27, 'Сали Грийн');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;


-- Dumping structure for table books.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(250) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- Dumping data for table books.books: 18 rows
DELETE FROM `books`;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`book_id`, `book_title`) VALUES
	(86, 'Сблъсък'),
	(85, 'Избранникът'),
	(84, 'Белият огън'),
	(83, 'Изкуството да се живее'),
	(82, 'Изповядвам'),
	(80, 'Полудив');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;


-- Dumping structure for table books.books_authors
DROP TABLE IF EXISTS `books_authors`;
CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table books.books_authors: 44 rows
DELETE FROM `books_authors`;
/*!40000 ALTER TABLE `books_authors` DISABLE KEYS */;
INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
	(86, 35),
	(85, 34),
	(84, 32),
	(84, 33),
	(83, 30),
	(82, 31),
	(80, 27);
/*!40000 ALTER TABLE `books_authors` ENABLE KEYS */;


-- Dumping structure for table books.com
DROP TABLE IF EXISTS `com`;
CREATE TABLE IF NOT EXISTS `com` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Dumping data for table books.com: 32 rows
DELETE FROM `com`;
/*!40000 ALTER TABLE `com` DISABLE KEYS */;
INSERT INTO `com` (`comment_id`, `book_id`, `comment`, `time`, `user_id`) VALUES
	(39, 80, 'Прекрасна книга!', '2016-03-01 16:11:53', 6),
	(42, 85, 'Удивителна книга! Чете се на един дъх.', '2016-03-01 16:27:07', 7),
	(41, 80, 'Очаквах повече...', '2016-03-01 16:14:25', 7),
	(43, 86, 'Уникална книга!', '2016-03-01 16:30:56', 8);
/*!40000 ALTER TABLE `com` ENABLE KEYS */;


-- Dumping structure for table books.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table books.users: 5 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `password`) VALUES
	(8, 'Svetla', 'Markova'),
	(7, 'Ivan1', 'Ivanov'),
	(6, 'Peter', 'Belakov');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
