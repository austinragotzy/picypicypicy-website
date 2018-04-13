-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2017 at 07:07 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs3500_ImageDB`
--
CREATE DATABASE IF NOT EXISTS `cs3500_ImageDB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs3500_ImageDB`;

-- --------------------------------------------------------

--
-- Table structure for table `CommentReply`
--

DROP TABLE IF EXISTS `CommentReply`;
CREATE TABLE `CommentReply` (
  `ReplyID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `CommentID` int(11) NOT NULL,
  `Likes` int(11) NOT NULL,
  `Dislikes` int(11) NOT NULL,
  `Comment` longtext NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
CREATE TABLE `Comments` (
  `CommentID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `Comment` longtext,
  `Likes` int(11) NOT NULL,
  `Dislikes` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `comments` VALUES (1,1,1,"Good Picture",0,0,'1998-05-04 00:00:00'),
(2,2,2,"Hahaha thats broken!",0,0,'1998-05-04 00:00:00');
-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
CREATE TABLE `Image` (
  `ImageID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Path` varchar(255) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text,
  `Likes` int(11) DEFAULT NULL,
  `Dislikes` int(11) DEFAULT NULL,
  `ViewCount` int(11) DEFAULT NULL,
  `Privacy` int(1) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `image` VALUES (1,1,"brokeCar.jpg","Broken Car","Its a car that is broken",0,0,0,1,'1998-05-04 00:00:00')
,(2,2,"brokeChair.jpg","Broken Chair","Its a chair",0,0,0,0,'1998-05-04 00:00:00')
,(3,2,"brokeHouse.jpg","Broken House","Its a house that is Broken",0,0,0,0,'1998-05-04 00:00:00');
-- --------------------------------------------------------

--
-- Table structure for table `ImageFavorite`
--

DROP TABLE IF EXISTS `ImageFavorite`;
CREATE TABLE `ImageFavorite` (
  `ImageFavoriteID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ImageTags`
--

DROP TABLE IF EXISTS `ImageTags`;
CREATE TABLE `ImageTags` (
  `ImageTagID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

DROP TABLE IF EXISTS `Tags`;
CREATE TABLE `Tags` (
  `TagID` int(11) NOT NULL,
  `Tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `UID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `DateOfRegistration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FisrtName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` VALUES (1,"Nick","Pass123","test@test.com",'1998-05-04 00:00:00',"Nick","Pawlawski"),
(2,"Austin","Pass123","test@test.com",'1998-05-04 00:00:00',"Austin","Ragotzy");

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CommentReply`
--
ALTER TABLE `CommentReply`
  ADD PRIMARY KEY (`ReplyID`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `ImageFavorite`
--
ALTER TABLE `ImageFavorite`
  ADD PRIMARY KEY (`ImageFavoriteID`);

--
-- Indexes for table `ImageTags`
--
ALTER TABLE `ImageTags`
  ADD PRIMARY KEY (`ImageTagID`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`TagID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CommentReply`
--
ALTER TABLE `CommentReply`
  MODIFY `ReplyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Image`
--
ALTER TABLE `Image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ImageFavorite`
--
ALTER TABLE `ImageFavorite`
  MODIFY `ImageFavoriteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ImageTags`
--
ALTER TABLE `ImageTags`
  MODIFY `ImageTagID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `TagID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

