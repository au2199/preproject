-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2019 at 05:06 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `group_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `name_project` varchar(100) NOT NULL,
  `info_project` text NOT NULL,
  `check1` tinyint(1) NOT NULL,
  `check2` tinyint(1) NOT NULL,
  `teacher_teacher_id` int(11) DEFAULT NULL,
  `student_student_id_1` int(11) DEFAULT NULL,
  `student_student_id_2` int(11) DEFAULT NULL,
  `student_student_id_3` int(11) DEFAULT NULL,
  `request_request_id` int(11) NOT NULL,
  `score_score_id` int(11) NOT NULL,
  `teacher_commit_id_1` int(11) DEFAULT NULL,
  `teacher_commit_id_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `data`, `name_project`, `info_project`, `check1`, `check2`, `teacher_teacher_id`, `student_student_id_1`, `student_student_id_2`, `student_student_id_3`, `request_request_id`, `score_score_id`, `teacher_commit_id_1`, `teacher_commit_id_2`) VALUES
(1, 'www.googledrive.com', 'Ant', 'animal', 0, 0, 1, 1, 2, 3, 1, 1, 1, 1),
(2, 'www.googledrive.com', 'Bird', 'biology', 0, 0, 2, 7, 3, 10, 2, 2, 2, 2),
(3, 'www.googledrive.com', 'Cat', 'catagoly', 0, 0, 6, 1, 4, 9, 3, 3, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `topic` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info_notice` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `topic`, `info_notice`) VALUES
(1, 'A', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `piority` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `piority`) VALUES
(1, NULL),
(2, NULL),
(3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL,
  `document` int(11) DEFAULT NULL,
  `knowledge` int(11) DEFAULT NULL,
  `completly` int(11) DEFAULT NULL,
  `present` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`score_id`, `document`, `knowledge`, `completly`, `present`) VALUES
(1, 2, 3, 3, 2),
(2, 3, 3, 4, 4),
(3, 2, 9, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `title`, `fname`, `lname`, `email`) VALUES
(1, 'Ms.', 'Mack ', 'Randolph', 'Mack Randolph@ku.th'),
(2, 'Ms.', 'Raees ', 'Gibbons', 'Raees Gibbons@ku.th'),
(3, 'Mr.', 'Dora ', 'Zhang', 'Dora Zhang@ku.th'),
(4, 'Ms.', 'Humza ', 'Parker', 'Humza Parker@ku.th'),
(5, 'Ms.', 'Cloe ', 'Delacruz', 'Cloe Delacruz@ku.th'),
(6, 'Mr.', 'Milo ', 'Nicholson', 'Milo Nicholson@ku.th'),
(7, 'Mr.', 'Elysha ', 'Mcdaniel', 'Elysha Mcdaniel@ku.th'),
(8, 'Mr.', 'Asiyah ', 'Grimes', 'Asiyah Grimes@ku.th'),
(9, 'Mr.', 'Daanish ', 'Redfern', 'Daanish Redfern@ku.th'),
(10, 'Ms.', 'Enya ', 'Wolfe', 'Enya Wolfe@ku.th');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `ability` varchar(45) DEFAULT NULL,
  `adviser` int(11) DEFAULT NULL,
  `committee` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `type`, `title`, `fname`, `lname`, `ability`, `adviser`, `committee`, `email`) VALUES
(1, 1, 'Mr.', 'Zhang', 'Dora', 'OS', NULL, NULL, 'Mr.Zhang@ku.th'),
(2, 2, 'Mr.', 'Gibbons', 'Raees', 'AI', NULL, NULL, 'Mr.Gibbons@ku.th'),
(3, 3, 'Ms.', 'Daanish', 'Wolfe', 'Game', NULL, NULL, 'Ms.Daanish@ku.th'),
(5, 5, 'Mr.', 'Peter', 'Parker', 'Image', NULL, NULL, 'Mr.Peter@ku.th'),
(6, 6, 'Mr.', 'Macko88', 'Wolfe', 'Unity', NULL, NULL, 'Mr.Mack @ku.th');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `fk_group_teacher_idx` (`teacher_teacher_id`),
  ADD KEY `fk_group_student1_idx` (`student_student_id_1`),
  ADD KEY `fk_group_request1_idx` (`request_request_id`),
  ADD KEY `fk_group_student2_idx` (`student_student_id_2`) USING BTREE,
  ADD KEY `fk_group_student3_idx` (`student_student_id_3`) USING BTREE,
  ADD KEY `fk_group_score_idx` (`score_score_id`) USING BTREE,
  ADD KEY `fk_group_commit1` (`teacher_commit_id_1`) USING BTREE,
  ADD KEY `fk_group_commit2` (`teacher_commit_id_2`) USING BTREE;

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`) USING BTREE;

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `fk_group_commit1` FOREIGN KEY (`teacher_commit_id_1`) REFERENCES `teacher` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_commit2` FOREIGN KEY (`teacher_commit_id_2`) REFERENCES `teacher` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_request1` FOREIGN KEY (`request_request_id`) REFERENCES `request` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_score` FOREIGN KEY (`score_score_id`) REFERENCES `score` (`score_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_student1` FOREIGN KEY (`student_student_id_1`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_student2` FOREIGN KEY (`student_student_id_2`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_student3` FOREIGN KEY (`student_student_id_3`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_teacher` FOREIGN KEY (`teacher_teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
