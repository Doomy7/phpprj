-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 07:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `aid` int(10) NOT NULL,
  `log` varchar(500) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`aid`, `log`, `time`) VALUES
(3, 'Teacher teacher logged in!', '2020/02/23 05:33:53pm'),
(4, 'Student Student1 logged in!', '2020/02/23 05:34:00pm'),
(5, 'Admin admin logged in!', '2020/02/23 05:34:13pm'),
(6, 'Admin admin logged in!', '2020/02/23 05:41:48pm'),
(7, 'Teacher teacher logged in!', '2020/02/23 05:43:12pm'),
(8, 'Teacher  made following changes 55 3 4', '2020/02/23 05:43:25pm'),
(9, 'Teacher teacher logged in!', '2020/02/23 05:45:57pm'),
(10, 'Teacher  made following changes 99 2 3', '2020/02/23 05:46:05pm'),
(11, 'Teacher teacher made following changes. Student: Student1 Student1 New mark: 59 On Lesson: Java I : 1', '2020/02/23 05:49:57pm'),
(12, 'Teacher teacher made following changes. Student: Student1 Student1 New mark: 45 On Lesson: Java I : 59', '2020/02/23 05:50:59pm'),
(16, 'Admin admin rejected George Psaraklas testteacher@test.com testteacher registration as teachers!', '2020/02/23 07:03:28pm'),
(17, 'Admin admin rejected George Psaraklas teststudent@test.com teststudent registration as students!', '2020/02/23 07:03:39pm'),
(18, 'Admin admin accepted timestud timestud timestud@time.cim timestud registration as students!', '2020/02/23 07:27:58pm'),
(19, 'timestud timestud timestud@time.cim timestud added as students!', '2020/02/23 07:27:58pm'),
(20, 'Admin admin rejected Exipnos Exipnakias exipnos@idiofiia.com mathiths registration as teachers!', '2020/02/23 07:28:18pm'),
(21, 'Admin admin accepted timeteach timetre timeteach@time.com timeteach registration as teachers!', '2020/02/23 07:28:32pm'),
(22, 'timeteach timetre timeteach@time.com timeteach added as teachers!', '2020/02/23 07:28:32pm');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `name`, `surname`, `email`, `password`, `username`) VALUES
(1, 'fdgfdgh', 'dfghdgf', 'admin@email.com', '$2y$10$dfs.yVCD0Y7gqE.XL4qVB.ZVyIvoWl3Tpj2UmAr7Bea4ZbWbMQMnS', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_hashes`
--

CREATE TABLE `admin_hashes` (
  `hash_id` int(10) NOT NULL,
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_hashes`
--

INSERT INTO `admin_hashes` (`hash_id`, `hash`) VALUES
(1, '1'),
(2, '2'),
(3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lid` int(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lid`, `name`) VALUES
(1, 'Java I'),
(2, 'Java II'),
(3, 'Introduction to Computer Science'),
(4, 'Discrete Mathematics'),
(5, 'Algorithms');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `sid` int(5) NOT NULL,
  `lid` int(5) NOT NULL,
  `mark` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`sid`, `lid`, `mark`) VALUES
(2, 1, 45),
(2, 2, 65),
(2, 3, 99),
(3, 2, 75),
(3, 4, 55),
(3, 5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sid` int(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `name`, `surname`, `email`, `password`, `username`) VALUES
(2, 'Student1', 'Student1', 'Student1@school.com', '$2y$10$wMj8hDwzgSUvBX8yZwGUguYpOUEbd5c90otzi0ZrooFWJ80pRIRv.', 'Student1'),
(3, 'Student2', 'Student2', 'Student2@school.com', '$2y$10$v8yTvwCeterF9aY2H/EuGuknO9KockevTAqWNSsIE2T5AzEO8JnpC', 'Student2'),
(4, 'Student3', 'Student3', 'Student3@school.com', '$2y$10$ecaxR/kKIKYee/Sv6ll88ejjM9hFR.T2ykTqrnoprcd/OUFNYzPLS', 'Student3'),
(5, 'Psaraki', 'Psaraklas', 'fish@sea.com', '$2y$10$d3VcGpD3SigJQKtZKtNRdO65IHuK0LGVU43tKQyIKM8uV7yz8YP2u', 'Fish'),
(9, 'timestud', 'timestud', 'timestud@time.cim', '$2y$10$1rHFqrMwHyPGvWplM9CFLuwoc5rwrhS47Sn7Sj6D5yY6hJRIZOVKW', 'timestud');

-- --------------------------------------------------------

--
-- Table structure for table `students_verify`
--

CREATE TABLE `students_verify` (
  `vid` int(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_verify`
--

INSERT INTO `students_verify` (`vid`, `name`, `surname`, `email`, `password`, `username`, `time`) VALUES
(7, 'student', 'student', 'asfafa@email.com', '$2y$10$Su0F.iTrbO.Uju.wDuCBsOK4XdgC/52Vrp5ZQNbkc3N/.KgaCUjWq', 'iamastudent', '2020/02/23 07:30:29pm');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tid` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tid`, `name`, `surname`, `email`, `password`, `username`) VALUES
(1, 'sdfas', 'asdfas', 'dm@email.com', '$2y$10$J6qIjV/IxtJipWHuMsakAeec5ynxIGy2tY9Tx/of3wF6xIc0Ww252', 'legit'),
(2, 'Teacher1', 'Teacher1', 'Teacher1@school.com', '$2y$10$8l8mB4rwGsXVulbVlYLGUeQQxegauuqBY6DKTomiiv.CSBrauZ1xG', 'Teacher1'),
(3, 'Teacher2', 'Teacher2', 'Teacher2@school.com', '$2y$10$yzxC9zmtla3hg.WTGNFTfO3NyDa/RhtpWfWHTV/lpIvdv0XFIjFYO', 'Teacher2'),
(4, 'timeteach', 'timetre', 'timeteach@time.com', '$2y$10$n8oWFaCrb/OQP43eT1MRpuaVm5WBT/ogvxRGYY0gS6jvWH10m93mO', 'timeteach');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_verify`
--

CREATE TABLE `teachers_verify` (
  `vid` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers_verify`
--

INSERT INTO `teachers_verify` (`vid`, `name`, `surname`, `email`, `password`, `username`, `time`) VALUES
(11, 'teasasd', 'dsfsdfsd', 'teacher2131@email.com', '$2y$10$c5Lo7Bwy0hNnafraKgubT.q0zeGNyYgoY2fpvrS4nUT.i47HsjZAm', 'teacher2131', '2020/02/23 07:30:51pm');

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `tid` int(3) NOT NULL,
  `lid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `admin_hashes`
--
ALTER TABLE `admin_hashes`
  ADD PRIMARY KEY (`hash_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`sid`,`lid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `students_verify`
--
ALTER TABLE `students_verify`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `teachers_verify`
--
ALTER TABLE `teachers_verify`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD PRIMARY KEY (`tid`,`lid`),
  ADD KEY `lid` (`lid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_hashes`
--
ALTER TABLE `admin_hashes`
  MODIFY `hash_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students_verify`
--
ALTER TABLE `students_verify`
  MODIFY `vid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers_verify`
--
ALTER TABLE `teachers_verify`
  MODIFY `vid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin_hashes` (`hash_id`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `students` (`sid`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `lessons` (`lid`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `teachers` (`tid`),
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `lessons` (`lid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
