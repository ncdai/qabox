-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 01, 2023 at 06:12 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `QAReviewerDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `ANSWERS`
--

CREATE TABLE `ANSWERS` (
  `AnswerID` int(11) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `Answer` varchar(255) DEFAULT NULL,
  `Reference` varchar(255) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `NumberEvaluaters` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ANSWERS`
--

INSERT INTO `ANSWERS` (`AnswerID`, `QuestionID`, `Answer`, `Reference`, `UserID`, `CreatedDate`, `NumberEvaluaters`) VALUES
(1, 1, 'The current president of the United States is Joe Biden.', 'Source 1', 2, '2023-07-01 11:49:29', 2),
(2, 1, 'Joe Biden is the president of the United States.', 'Source 2', 3, '2023-07-01 11:49:29', 2),
(3, 1, 'Donald Trump is the former president of the United States.', 'Source 3', 4, '2023-07-01 11:49:29', 1),
(4, 2, 'The capital city of France is Paris.', 'Source 4', 1, '2023-07-01 11:49:29', 0),
(5, 2, 'Paris is the capital of France.', 'Source 5', 3, '2023-07-01 11:49:29', 0),
(6, 2, 'France has Paris as its capital city.', 'Source 6', 5, '2023-07-01 11:49:29', 0),
(7, 3, 'Photosynthesis is the process by which green plants use sunlight to synthesize foods.', 'Source 7', 2, '2023-07-01 11:49:29', 0),
(8, 3, 'Plants convert carbon dioxide and water into glucose and oxygen during photosynthesis.', 'Source 8', 4, '2023-07-01 11:49:29', 0),
(9, 3, 'Sunlight is necessary for photosynthesis to occur in plants.', 'Source 9', 5, '2023-07-01 11:49:29', 0),
(10, 4, 'Smartphones have features such as a touchscreen, camera, internet connectivity, and apps.', 'Source 10', 1, '2023-07-01 11:49:29', 0),
(11, 4, 'They can be used for communication, entertainment, and productivity.', 'Source 11', 3, '2023-07-01 11:49:29', 0),
(12, 5, 'To bake a chocolate cake, you need ingredients such as flour, sugar, cocoa powder, eggs, and butter.', 'Source 12', 2, '2023-07-01 11:49:29', 0),
(13, 5, 'Mix the dry and wet ingredients, then bake the batter in a preheated oven.', 'Source 13', 4, '2023-07-01 11:49:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ANSWER_EVALUATES`
--

CREATE TABLE `ANSWER_EVALUATES` (
  `EvaluateID` int(11) NOT NULL,
  `AnswerID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `RateCategory` varchar(30) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ANSWER_EVALUATES`
--

INSERT INTO `ANSWER_EVALUATES` (`EvaluateID`, `AnswerID`, `UserID`, `RateCategory`, `CreatedDate`) VALUES
(1, 1, 3, '5STAR', '2023-07-01 11:49:29'),
(2, 1, 4, '4STAR', '2023-07-01 11:49:29'),
(3, 2, 1, '3STAR', '2023-07-01 11:49:29'),
(4, 2, 2, '2STAR', '2023-07-01 11:49:29'),
(5, 3, 5, '1STAR', '2023-07-01 11:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `QUESTIONS`
--

CREATE TABLE `QUESTIONS` (
  `QuestionID` int(11) NOT NULL,
  `Question` varchar(255) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Tags` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `NumberAnswerers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `QUESTIONS`
--

INSERT INTO `QUESTIONS` (`QuestionID`, `Question`, `UserID`, `Tags`, `CreatedDate`, `NumberAnswerers`) VALUES
(1, 'Who is the president of the United States?', 1, 'Politics, Government', '2023-07-01 11:49:29', 3),
(2, 'What is the capital city of France?', 2, 'Geography, Travel', '2023-07-01 11:49:29', 3),
(3, 'How does photosynthesis work?', 3, 'Biology, Science', '2023-07-01 11:49:29', 3),
(4, 'What are the main features of a smartphone?', 4, 'Technology, Gadgets', '2023-07-01 11:49:29', 2),
(5, 'How do you bake a chocolate cake?', 5, 'Baking, Food', '2023-07-01 11:49:29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Role` varchar(30) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`UserID`, `UserName`, `Role`, `Password`) VALUES
(1, 'User1', 'Questioner', 'password1'),
(2, 'User2', 'Answerer', 'password2'),
(3, 'User3', 'Evaluater', 'password3'),
(4, 'User4', 'Answerer', 'password4'),
(5, 'User5', 'Questioner', 'password5'),
(6, 'Admin1', 'Admin', 'admin1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ANSWERS`
--
ALTER TABLE `ANSWERS`
  ADD PRIMARY KEY (`AnswerID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `ANSWER_EVALUATES`
--
ALTER TABLE `ANSWER_EVALUATES`
  ADD PRIMARY KEY (`EvaluateID`),
  ADD KEY `AnswerID` (`AnswerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ANSWERS`
--
ALTER TABLE `ANSWERS`
  MODIFY `AnswerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ANSWER_EVALUATES`
--
ALTER TABLE `ANSWER_EVALUATES`
  MODIFY `EvaluateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ANSWERS`
--
ALTER TABLE `ANSWERS`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`QuestionID`) REFERENCES `QUESTIONS` (`QuestionID`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `USERS` (`UserID`);

--
-- Constraints for table `ANSWER_EVALUATES`
--
ALTER TABLE `ANSWER_EVALUATES`
  ADD CONSTRAINT `answer_evaluates_ibfk_1` FOREIGN KEY (`AnswerID`) REFERENCES `ANSWERS` (`AnswerID`),
  ADD CONSTRAINT `answer_evaluates_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `USERS` (`UserID`);

--
-- Constraints for table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `USERS` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
