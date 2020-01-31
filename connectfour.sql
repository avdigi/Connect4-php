-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2019 at 02:49 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectfour`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `RoomID` int(11) NOT NULL,
  `Message` varchar(1600) DEFAULT NULL,
  `Username` varchar(64) NOT NULL,
  `msgID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`RoomID`, `Message`, `Username`, `msgID`) VALUES
(1, 'Test 1', 'avdigi', 1),
(1, 'test2', 'avdigi', 3),
(1, 'asdf', 'avdigi', 4),
(1, 'asdfsdf', 'avdigi', 5),
(1, 'asdfsdfsdf', 'avdigi', 6),
(1, 'asdads', 'avdigi', 7),
(1, 'asfdsdf', 'avdigi', 8),
(1, 'hello', 'avdigi', 9),
(1, 'yo', 'avdigi', 10),
(1, 'yello', 'avdigi', 11),
(1, 'asdfsdf', 'avdigi', 12),
(1, 'sdfsdf', 'avdigi', 13),
(1, 'asdfsdf', 'avdigi', 14),
(1, 'asdfsdfsdf', 'avdigi', 15),
(1, 'test', 'avdigi', 16),
(1, 'sdfafsd', 'avdigi', 17),
(1, 'easdfsdf', 'avdigi', 18),
(1, 'wow this works now!!!', 'avdigi', 19),
(1, 'YES!', 'avdigi', 20),
(1, 'Test', 'avdigi', 37),
(92, 'sdafsdf', 'avdigi', 38),
(92, 'asdfsdf', 'avdigi', 39),
(92, 'room test', 'avdigi', 40),
(92, 'yea', 'avdigi', 41);

-- --------------------------------------------------------

--
-- Table structure for table `checkers_games`
--

CREATE TABLE `checkers_games` (
  `game_id` int(10) NOT NULL,
  `whoseTurn` int(1) NOT NULL DEFAULT '0',
  `player0_name` varchar(65) NOT NULL DEFAULT '',
  `player0_pieceID` text,
  `player0_boardI` varchar(255) DEFAULT NULL,
  `player0_boardJ` varchar(255) DEFAULT NULL,
  `player1_name` varchar(65) NOT NULL DEFAULT '',
  `player1_pieceID` text,
  `player1_boardI` varchar(255) DEFAULT NULL,
  `player1_boardJ` varchar(255) DEFAULT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkers_games`
--

INSERT INTO `checkers_games` (`game_id`, `whoseTurn`, `player0_name`, `player0_pieceID`, `player0_boardI`, `player0_boardJ`, `player1_name`, `player1_pieceID`, `player1_boardI`, `player1_boardJ`, `last_updated`) VALUES
(38, 1, 'Dan', NULL, NULL, NULL, 'Fred', NULL, NULL, NULL, '2019-12-14 04:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `PersonID` mediumint(9) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Password` char(100) NOT NULL,
  `OnlineStatus` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`PersonID`, `Username`, `Email`, `Password`, `OnlineStatus`) VALUES
(1, 'defaultUser', 'default@email.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 1),
(18, 'avdigi', 'avdigiovanniv@gmail.com', '77794c082a9bb1692db6444a406d070d9ee9cdf0395510b4229f81b64ed11890', 1),
(46, 'Blonde_baller10', 'Sara.wnek10@gmail.com', '1284cf1487916ccfa444e964eee6807e8aaa0772986f4d2b2d76a35a366fd541', 0),
(49, 'defaultUser2', 'default2@email.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`msgID`),
  ADD KEY `msgID` (`msgID`);

--
-- Indexes for table `checkers_games`
--
ALTER TABLE `checkers_games`
  ADD PRIMARY KEY (`game_id`),
  ADD UNIQUE KEY `player0_name` (`player0_name`),
  ADD UNIQUE KEY `player1_name` (`player1_name`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`PersonID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `msgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `checkers_games`
--
ALTER TABLE `checkers_games`
  MODIFY `game_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `PersonID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
