-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 12:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clr`
--

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `clearance_id` int(11) NOT NULL,
  `lesson_plan_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `remarks` enum('Complete','Incomplete','Pending') NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`clearance_id`, `lesson_plan_id`, `student_id`, `remarks`, `comment`, `date_time_created`, `date_time_updated`) VALUES
(78, 1, 3, 'Incomplete', 'Wala laging assignment', '2021-11-03 01:50:38', '2021-11-03 02:38:40'),
(79, 5, 3, 'Pending', '', '2021-11-03 01:50:38', '0000-00-00 00:00:00'),
(80, 1010, 3, 'Complete', 'Matalinong bata', '2021-11-03 01:50:39', '2021-11-03 17:05:11'),
(81, 1015, 3, 'Pending', '', '2021-11-03 01:50:39', '0000-00-00 00:00:00'),
(82, 1016, 3, 'Pending', '', '2021-11-03 01:50:39', '0000-00-00 00:00:00'),
(83, 1019, 3, 'Complete', 'Napakabait na bata neto', '2021-11-03 01:52:03', '2021-11-03 02:32:03'),
(84, 1, 18, 'Pending', '', '2021-11-03 02:11:32', '0000-00-00 00:00:00'),
(85, 5, 18, 'Pending', '', '2021-11-03 02:11:32', '0000-00-00 00:00:00'),
(86, 1010, 18, 'Pending', '', '2021-11-03 02:11:32', '0000-00-00 00:00:00'),
(87, 1015, 18, 'Pending', '', '2021-11-03 02:11:32', '0000-00-00 00:00:00'),
(88, 1016, 18, 'Pending', '', '2021-11-03 02:11:32', '0000-00-00 00:00:00'),
(89, 1019, 18, 'Pending', '', '2021-11-03 02:11:33', '0000-00-00 00:00:00'),
(90, 2, 16, 'Pending', '', '2021-11-03 02:16:27', '0000-00-00 00:00:00'),
(91, 1017, 16, 'Pending', '', '2021-11-03 02:16:27', '0000-00-00 00:00:00'),
(92, 1018, 16, 'Pending', '', '2021-11-03 02:16:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan`
--

CREATE TABLE `lesson_plan` (
  `lesson_plan_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `advisory_section_id` int(11) DEFAULT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lesson_plan`
--

INSERT INTO `lesson_plan` (`lesson_plan_id`, `teacher_id`, `subject_id`, `advisory_section_id`, `section_id`) VALUES
(1, 1, 103, 1, 1),
(2, 2, 102, 2, 2),
(3, 3, 103, 3, 3),
(5, 5, 105, NULL, 1),
(1010, 12, 106, NULL, 1),
(1012, 14, 104, 4, 4),
(1015, 18, 101, NULL, 1),
(1016, 19, 104, NULL, 1),
(1017, 20, 107, NULL, 2),
(1018, 21, 104, NULL, 2),
(1019, 22, 107, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`) VALUES
(1, 'Alpha'),
(2, 'Bravo'),
(3, 'Charlie'),
(4, 'Delta');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `grade` int(2) NOT NULL,
  `section_id` int(11) NOT NULL,
  `lrn` bigint(15) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact_number` bigint(15) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('Pending','Verified') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `first_name`, `middle_name`, `last_name`, `grade`, `section_id`, `lrn`, `gender`, `contact_number`, `birthday`, `address`, `username`, `password`, `status`) VALUES
(2, 'Juana', '', 'Maria', 10, 1, 38273832565, 'Female', 98423648, '2000-04-20', 'Mandaluyong', 'Maria', '123', 'Pending'),
(3, 'Mc', 'Dark', 'Kenny', 10, 1, 3434345343, 'Female', 6, '2000-02-22', 'Jaan Lang', 'Mc', '123', 'Verified'),
(5, '1', '1', '1', 10, 1, 1, 'Male', 1, '2021-10-22', '1', '1', '1', 'Pending'),
(6, 'Prince', 'Dark', 'Past', 10, 1, 5251545615498, 'Male', 45484, '2000-07-18', 'rfgrutqwdwe', 'dark', '123', 'Pending'),
(15, 'Student1', '', 'Student1', 10, 2, 2, 'Female', 2, '2021-10-27', 'Jaan Lang', 'Student1', '123', 'Pending'),
(16, 'Jhon', '', 'Cablay', 10, 2, 5425556255, 'Male', 543298, '2000-01-29', 'Mandaluyong', 'Jhon', '123', 'Verified'),
(17, 'Carl', '', 'Wheeze', 10, 1, 123546745754746, 'Male', 6541544, '2021-10-29', 'Mandaluyong', 'carl', '123', 'Pending'),
(18, 'inot', 'pandak', 'balatbat', 10, 1, 2535423452345, 'Female', 231655252, '2004-02-11', 'jgfgjkdhgshdsfdg', 'inot', '123', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
(101, 'Filipino'),
(102, 'English'),
(103, 'Mathematics'),
(104, 'Science'),
(105, 'AP'),
(106, 'TLE'),
(107, 'ESP'),
(108, 'MAPEH');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `first_name`, `middle_name`, `last_name`, `contact_number`, `birthday`, `address`, `username`, `password`) VALUES
(1, 'Primo', 'Uno', 'Vongola', 2147483647, '1983-06-08', 'Mandaluyong City', 'Primo', '123'),
(2, 'Seconda', 'Dos', 'Oga', 97243728, '1970-10-05', 'Mandaluyong City', 'Seconda', '123'),
(3, 'Terza', 'Tres', 'Elric', 9425728, '1965-10-05', 'Makati City', 'Terza', '123'),
(5, 'Cinque', 'Lima', 'Rockbell', 944572824, '1965-10-05', 'Mandaluyon City', 'Cinque', '123'),
(12, 'Marco', '', 'Miranda', 5, '2021-10-21', 'Jaan Lang', 'marco', '123'),
(14, 'Quatro', '', 'Apat', 2147483647, '1975-03-22', 'Jaan Lang', 'Quatro', '123'),
(18, 'Tim', '', 'motty', 4, '2002-02-27', 'Jaan Lang', 'Tim', '123'),
(19, 'Mat', '', 'Sci', 6, '2021-10-01', 'Jaan Lang', 'Mat', '123'),
(20, 'Ronie', '', 'Otod', 2147483647, '1990-03-17', 'Makati', 'Ronie', '123'),
(21, 'Science', '', 'Sineskwela', 6, '2021-10-12', 'Pasig City', 'Science', '123'),
(22, 'Rafael', '', 'Ricablanca', 23, '2021-11-03', 'Mandaluyong', 'rafael', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`clearance_id`),
  ADD KEY `lesson_plan_id` (`lesson_plan_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD PRIMARY KEY (`lesson_plan_id`),
  ADD UNIQUE KEY `advisory_section_id_2` (`advisory_section_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `advisory_section_id` (`advisory_section_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD UNIQUE KEY `section_name` (`section_name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `lrn` (`lrn`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `clearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  MODIFY `lesson_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clearance`
--
ALTER TABLE `clearance`
  ADD CONSTRAINT `clearance_ibfk_1` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`lesson_plan_id`),
  ADD CONSTRAINT `clearance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD CONSTRAINT `lesson_plan_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `lesson_plan_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `lesson_plan_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `lesson_plan_ibfk_4` FOREIGN KEY (`advisory_section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
