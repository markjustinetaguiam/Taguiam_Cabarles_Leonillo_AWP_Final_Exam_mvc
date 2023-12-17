-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 02:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ArchiveStudentProcedure` (IN `p_student_id` INT)   BEGIN
    UPDATE students SET archived = 1 WHERE student_id = p_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateStudentProcedure` (IN `p_name` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_phone` VARCHAR(20))   BEGIN
    INSERT INTO students (student_name, email, phone) VALUES (p_name, p_email, p_phone);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllStudentsProcedure` ()   BEGIN
    SELECT * FROM students WHERE archived = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAttendanceByDateProcedure` (IN `p_selected_date` DATE)   BEGIN
    SELECT students.student_name,
        CASE WHEN attendance.present_count = 1 THEN students.student_name ELSE NULL END AS present,
        CASE WHEN attendance.absent_count = 1 THEN students.student_name ELSE NULL END AS absent
    FROM students
    LEFT JOIN attendance ON students.student_id = attendance.student_id
    WHERE attendance.date = p_selected_date;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDistinctAttendanceDatesProcedure` ()   BEGIN
    SELECT DISTINCT date FROM attendance;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStudentByIdProcedure` (IN `p_student_id` INT)   BEGIN
    SELECT * FROM students WHERE student_id = p_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStudentsProcedure` ()   BEGIN
    SELECT * FROM students;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUnarchivedStudentsProcedure` ()   BEGIN
    SELECT * FROM students WHERE archived = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SaveAttendanceProcedure` (IN `p_date` DATE, IN `p_student_id` INT, IN `p_present_count` INT, IN `p_absent_count` INT)   BEGIN
    INSERT INTO attendance (date, student_id, present_count, absent_count)
    VALUES (p_date, p_student_id, p_present_count, p_absent_count);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateStudentProcedure` (IN `p_student_id` INT, IN `p_name` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_phone` VARCHAR(20))   BEGIN
    UPDATE students SET student_name = p_name, email = p_email, phone = p_phone WHERE student_id = p_student_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `present_count` int(11) DEFAULT NULL,
  `absent_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `date`, `present_count`, `absent_count`) VALUES
(1, 1, '2023-12-16', 1, 0),
(2, 2, '2023-12-16', 0, 1),
(3, 3, '2023-12-16', 0, 1),
(4, 1, '2023-12-15', 1, 0),
(5, 2, '2023-12-15', 1, 0),
(6, 3, '2023-12-15', 1, 0),
(7, 1, '2023-12-14', 0, 1),
(8, 2, '2023-12-14', 1, 0),
(9, 3, '2023-12-14', 1, 0),
(10, 1, '2023-12-11', 1, 0),
(11, 2, '2023-12-11', 1, 0),
(12, 3, '2023-12-11', 0, 1),
(13, 1, '2023-12-07', 1, 0),
(14, 2, '2023-12-07', 1, 0),
(15, 3, '2023-12-07', 0, 1),
(16, 6, '2023-12-07', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Student_ID` int(6) NOT NULL,
  `student_name` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Student_ID`, `student_name`, `email`, `phone`, `archived`) VALUES
(1, 'Mark Justine Taguiam', 'mark@gmail.com', '09277556088', 0),
(2, 'Michelle Cabarles', 'michelle@gmail.com', '09557716422', 0),
(3, 'Christine Joy Leonillo', 'christine@gmail.com', '09557716422', 0),
(4, 'Krisha Mae Dalire', 'krishamae@gmail.com', '09656685204', 1),
(5, 'Shella Gazmen', 'shella@gmail.com', '09557716422', 1),
(6, 'Jonalyn Maramag', 'jonalyn@gmail.com', '09557716422', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(3) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `username`, `password`) VALUES
(1, 'instructor1', 'password1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `Student_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`Student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
