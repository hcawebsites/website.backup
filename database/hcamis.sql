-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2023 at 01:17 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20628338_hcamis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_list`
--

CREATE TABLE `academic_list` (
  `ID` int(11) NOT NULL,
  `School_Year` varchar(255) NOT NULL DEFAULT '',
  `Semester` varchar(255) NOT NULL DEFAULT '',
  `Total_Student_Enrolled` int(11) NOT NULL DEFAULT 0,
  `is_default` int(11) NOT NULL DEFAULT 0,
  `Evaluation` int(11) NOT NULL DEFAULT 0,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_list`
--

INSERT INTO `academic_list` (`ID`, `School_Year`, `Semester`, `Total_Student_Enrolled`, `is_default`, `Evaluation`, `Status`) VALUES
(2, '2023-2024', '1st Semester', 0, 0, 2, 0),
(3, '2022-2023', '1st Semester', 0, 0, 0, 0),
(5, '2024-2025', '1st Semester', 0, 0, 0, 0),
(6, '2026-2027', '1st Semester', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Admin_ID` varchar(255) NOT NULL DEFAULT '',
  `Salutation` varchar(255) NOT NULL DEFAULT '',
  `Lastname` varchar(255) NOT NULL DEFAULT '',
  `Firstname` varchar(255) NOT NULL DEFAULT '',
  `Middlename` varchar(255) NOT NULL DEFAULT '',
  `Suffix` varchar(255) NOT NULL DEFAULT '',
  `DOB` date DEFAULT NULL,
  `Age` int(2) NOT NULL DEFAULT 0,
  `Gender` varchar(255) NOT NULL DEFAULT '',
  `Status` varchar(255) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `Nationality` varchar(255) NOT NULL DEFAULT '',
  `Contact` bigint(12) NOT NULL DEFAULT 0,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Picture` varchar(255) NOT NULL DEFAULT '',
  `QR_Code` varchar(255) NOT NULL DEFAULT '',
  `Archived` bigint(2) NOT NULL DEFAULT 0,
  `RDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Admin_ID`, `Salutation`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `DOB`, `Age`, `Gender`, `Status`, `Address`, `Nationality`, `Contact`, `Email`, `Picture`, `QR_Code`, `Archived`, `RDate`) VALUES
(1, 'A0001', 'Mr', 'Desamito', 'Spencer', 'Solis', '', '1999-12-02', 23, 'Male', 'Single', 'Rosario, Pozorrubio, Pangasinan', 'Filipino', 92123456780, 'spencer.desamito.19@gmail.com', 'IMG-63f5fd143e29a7.03388093.jpg', 'A0001.png', 0, '2022-08-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `ID` int(11) NOT NULL,
  `Question_ID` varchar(255) NOT NULL DEFAULT '',
  `Multiple` varchar(255) NOT NULL DEFAULT '',
  `Identification` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`ID`, `Question_ID`, `Multiple`, `Identification`) VALUES
(1, '6461034dadd97', '', 'SAMPLE'),
(2, '6461034db20a7', '6461034db20a9', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Reasons` varchar(255) NOT NULL DEFAULT '',
  `Bully_Name` varchar(255) NOT NULL DEFAULT '',
  `Concerns` varchar(500) NOT NULL DEFAULT '',
  `Status` bigint(3) NOT NULL DEFAULT 0,
  `Date_Time` varchar(255) NOT NULL DEFAULT '',
  `Date_Approved` date NOT NULL DEFAULT current_timestamp(),
  `Date_Created` date NOT NULL DEFAULT current_timestamp(),
  `Date_Settled` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `Student_ID`, `Reasons`, `Bully_Name`, `Concerns`, `Status`, `Date_Time`, `Date_Approved`, `Date_Created`, `Date_Settled`) VALUES
(1, '2023-0005', 'Need some advice.', '', 'Family problem', 0, '2023-05-16 01:00:pm', '2023-05-15', '2023-05-15', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL DEFAULT '',
  `Instruction` varchar(1000) NOT NULL DEFAULT '',
  `File` varchar(255) NOT NULL DEFAULT '',
  `Date_Created` date NOT NULL DEFAULT current_timestamp(),
  `Due` date DEFAULT NULL,
  `Score` int(3) NOT NULL DEFAULT 0,
  `Time` time DEFAULT NULL,
  `Code` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`ID`, `Title`, `Instruction`, `File`, `Date_Created`, `Due`, `Score`, `Time`, `Code`) VALUES
(1, 'Sample', 'Sample', 'None', '2023-05-14', '2023-12-12', 100, '00:12:00', '49AFyq');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_comments`
--

CREATE TABLE `assignment_comments` (
  `ID` int(11) NOT NULL,
  `Body` varchar(255) NOT NULL DEFAULT '',
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Teacher_ID` varchar(255) NOT NULL DEFAULT '',
  `Date_Post` datetime NOT NULL DEFAULT current_timestamp(),
  `Post_ID` varchar(255) NOT NULL DEFAULT '',
  `Picture` varchar(255) NOT NULL DEFAULT '',
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_comments`
--

INSERT INTO `assignment_comments` (`ID`, `Body`, `Code`, `Name`, `Student_ID`, `Teacher_ID`, `Date_Post`, `Post_ID`, `Picture`, `Status`) VALUES
(1, 'hi', 'G11ELS', 'Sample Sample', '2023-0001', 'T-545540646382', '2023-05-14 14:45:15', '1', 'IMG-644746e24e30c7.04206757.jpg', 1),
(2, 'hi', '49AFyq', 'Sample Sample', '', '', '2023-05-14 14:45:19', '1', 'IMG-644746e24e30c7.04206757.jpg', 0),
(3, 'Hello', '49AFyq', 'Mr. Spencer Desamito', '2023-0001', 'T-545540646382', '2023-05-14 14:45:39', '1', 'IMG-645b8409e266b4.64317881.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ID` int(11) NOT NULL,
  `ISBN` varchar(255) NOT NULL DEFAULT '',
  `Title` varchar(255) NOT NULL DEFAULT '',
  `Subtitle` varchar(255) NOT NULL DEFAULT '',
  `Author` varchar(255) NOT NULL DEFAULT '',
  `Sub_Author` varchar(255) NOT NULL DEFAULT '',
  `Category` varchar(255) NOT NULL DEFAULT '',
  `Total` bigint(3) NOT NULL DEFAULT 0,
  `Date_Publish` date DEFAULT NULL,
  `Available` bigint(3) NOT NULL DEFAULT 0,
  `Borrowed` bigint(3) NOT NULL DEFAULT 0,
  `Call_Number` varchar(255) NOT NULL DEFAULT '',
  `Status` int(11) NOT NULL DEFAULT 0,
  `QR_Code` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ID`, `ISBN`, `Title`, `Subtitle`, `Author`, `Sub_Author`, `Category`, `Total`, `Date_Publish`, `Available`, `Borrowed`, `Call_Number`, `Status`, `QR_Code`, `Date`) VALUES
(6, '978-93-8067-432-3', '.NET Framework & C#', '', 'Sun India Publication', '', 'Programming', 5, '2009-03-20', 5, 0, 'Bookshelf 5', 1, '978-93-8067-432-3.png', '2023-03-21'),
(7, '978-93-8067-432-2', 'Client Server Computing', '', 'Sun India Publication', '', 'Networking', 4, '2012-04-19', 3, 1, 'Bookshelf 5', 1, '978-93-8067-432-2.png', '2023-03-21'),
(8, ' 978-93-5163-389-1', ' Data Structure Using C', '', 'Thakur Publications ', '', 'Networking', 5, '2015-05-12', 5, 0, 'Bookshelf 5', 1, ' 978-93-5163-389-1.png', '2023-03-21'),
(9, '1-86092-012-100', 'Sample', '', 'Sample Sample', '', 'Sample', 5, '2018-12-02', 5, 0, 'Sampe 4', 1, '1-86092-012-100.png', '2023-04-25'),
(10, '1-0000000-111', 'Sample', '', 'Test Sample', '', 'Sample', 5, '2023-12-12', 5, 0, 'Sample', 1, '1-0000000-111.png', '2023-05-14'),
(11, '1-0000000-222', 'Test', '', 'Sample Sample', '', 'Test', 7, '1999-12-02', 7, 0, 'Sample', 1, '1-0000000-222.png', '2023-05-14'),
(12, '1-0000000-333', 'Sa Sa', '', 'test SA', '', 'SA TE', 1, '1999-12-12', 1, 0, 'Sample', 0, '1-0000000-333.png', '2023-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_books`
--

CREATE TABLE `borrow_books` (
  `ID` int(11) NOT NULL,
  `ISBN` varchar(255) NOT NULL DEFAULT '',
  `Title` varchar(255) NOT NULL DEFAULT '',
  `Author` varchar(255) NOT NULL DEFAULT '',
  `Borrowers_ID` varchar(255) NOT NULL DEFAULT '',
  `Fullname` varchar(255) NOT NULL DEFAULT '',
  `Contact` bigint(12) NOT NULL DEFAULT 0,
  `Date_Borrow` date NOT NULL DEFAULT current_timestamp(),
  `Date_Returned` date DEFAULT NULL,
  `Status` bigint(1) NOT NULL DEFAULT 0,
  `QR_Code` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow_books`
--

INSERT INTO `borrow_books` (`ID`, `ISBN`, `Title`, `Author`, `Borrowers_ID`, `Fullname`, `Contact`, `Date_Borrow`, `Date_Returned`, `Status`, `QR_Code`) VALUES
(1, '978-93-8067-432-3', '.NET Framework & C#', 'Sun India Publication', '2023-0006', 'Spencer Desamito', 9123456789, '2023-03-21', '2023-03-30', 0, ''),
(3, '978-93-8067-432-3', '.NET Framework & C#', 'Sun India Publication', '2023-0006', 'Spencer Solis Desamito', 9123456789, '2023-03-30', '2023-03-30', 0, ''),
(4, '978-93-8067-432-3', '.NET Framework & C#', 'Sun India Publication', '2023-0005', 'Stephanie Balleras', 9123456789, '2023-03-30', '2023-03-31', 0, ''),
(5, '978-93-8067-432-3', '.NET Framework & C#', 'Sun India Publication', '2023-0006', 'Spencer Desamito', 9123456789, '2023-03-30', '2023-03-30', 0, ''),
(6, '978-93-8067-432-2', 'Client Server Computing', 'Sun India Publication', '2023-0001', 'Sample Sample Sample', 912345678, '2023-04-25', NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `ID` int(11) NOT NULL,
  `Qid` varchar(255) NOT NULL DEFAULT '',
  `Choices` varchar(255) NOT NULL DEFAULT '',
  `Cid` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`ID`, `Qid`, `Choices`, `Cid`) VALUES
(1, '6461034db20a7', 'Sample', '6461034db20a9'),
(2, '6461034db20a7', 'Sample', '6461034db20aa'),
(3, '6461034db20a7', 'Sample', '6461034db20ab'),
(4, '6461034db20a7', 'Sample', '6461034db20ac');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `ID` int(11) NOT NULL,
  `Sched_ID` int(11) DEFAULT NULL,
  `Classname` varchar(255) NOT NULL DEFAULT '',
  `Code` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`ID`, `Sched_ID`, `Classname`, `Code`) VALUES
(1, 5, 'G11ELS_HUMSS', '49AFyq'),
(2, 9, 'G11PSHUMMS', 'tRGsML');

-- --------------------------------------------------------

--
-- Table structure for table `class_attendance`
--

CREATE TABLE `class_attendance` (
  `ID` int(11) NOT NULL,
  `Sched_ID` bigint(20) DEFAULT NULL,
  `Status` int(2) DEFAULT NULL,
  `Start_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_attendance`
--

INSERT INTO `class_attendance` (`ID`, `Sched_ID`, `Status`, `Start_Time`) VALUES
(1, 7, 0, NULL),
(5, 1, 0, NULL),
(6, 2, 0, NULL),
(7, 3, 0, NULL),
(8, 4, 0, NULL),
(9, 5, 0, '00:00:00'),
(10, 6, 0, NULL),
(11, 9, 0, '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_appointments`
--

CREATE TABLE `clinic_appointments` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Reason` varchar(255) NOT NULL DEFAULT '',
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Date_Created` date NOT NULL DEFAULT current_timestamp(),
  `Status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic_appointments`
--

INSERT INTO `clinic_appointments` (`ID`, `Student_ID`, `Reason`, `Date`, `Time`, `Date_Created`, `Status`) VALUES
(1, '2023-0001', 'Medical Check up', '2023-12-05', '10:00:00', '2023-05-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_record`
--

CREATE TABLE `clinic_record` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Illness` varchar(255) NOT NULL DEFAULT '',
  `Medicine` varchar(255) NOT NULL DEFAULT '',
  `Total` bigint(11) NOT NULL DEFAULT 0,
  `Date_Created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic_record`
--

INSERT INTO `clinic_record` (`ID`, `Student_ID`, `Illness`, `Medicine`, `Total`, `Date_Created`) VALUES
(1, '2023-0005', 'Headache', '1', 1, '2023-05-19'),
(2, '2023-0001', 'Flu', '1', 1, '2023-05-19'),
(3, '2023-0005', 'flu', '1', 1, '2023-05-19'),
(4, '2023-0007', 'Headache', '3', 1, '2023-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `Body` varchar(255) NOT NULL DEFAULT '',
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Posted_Name` varchar(255) NOT NULL DEFAULT '',
  `Image` varchar(255) NOT NULL DEFAULT '',
  `Date_Post` datetime NOT NULL DEFAULT current_timestamp(),
  `Post_ID` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `Body`, `Code`, `Posted_Name`, `Image`, `Date_Post`, `Post_ID`) VALUES
(1, 'hi', '49AFyq', 'Carl Justine Fernandez', 'IMG-644746e24e30c7.04206757.jpg', '2023-05-19 03:42:36', 4),
(2, 'hello sir', '49AFyq', 'Carl Justine Fernandez', 'IMG-644746e24e30c7.04206757.jpg', '2023-05-19 10:12:47', 4),
(3, 'hello', '49AFyq', 'Sample Sample', 'IMG-644746e24e30c7.04206757.jpg', '2023-05-20 12:01:16', 4);

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `ID` int(11) NOT NULL,
  `Criteria` varchar(255) NOT NULL DEFAULT '',
  `Order_BY` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`ID`, `Criteria`, `Order_BY`) VALUES
(1, 'Teacher Ability', 0);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Status` int(2) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`ID`, `Name`, `Status`, `Date`) VALUES
(1, 'K TO 12 BASIC CURRICULUM', 1, '2023-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subjects`
--

CREATE TABLE `curriculum_subjects` (
  `ID` int(11) NOT NULL,
  `Curriculum_ID` int(3) NOT NULL DEFAULT 0,
  `Subjects` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curriculum_subjects`
--

INSERT INTO `curriculum_subjects` (`ID`, `Curriculum_ID`, `Subjects`) VALUES
(1, 1, 'Mother Tounge'),
(2, 1, 'Filipino'),
(3, 1, 'English'),
(4, 1, 'Mathematics'),
(5, 1, 'Science'),
(6, 1, 'Araling Panlipunan'),
(7, 1, 'EsP'),
(8, 1, 'MAPEH'),
(9, 1, 'EPP'),
(10, 1, 'TLE'),
(11, 1, 'Oral Communication'),
(12, 1, 'Reading and Writing'),
(13, 1, 'Komunikasyon at Pananaliksik'),
(14, 1, '21st Century'),
(15, 1, 'Contemporary Philippine Arts'),
(16, 1, 'Media and Information Literacy'),
(17, 1, 'General Mathematics'),
(18, 1, 'Statistics and Probability'),
(19, 1, 'Earth and Life Science'),
(20, 1, 'Physical Science'),
(21, 1, 'Philosophy'),
(22, 1, 'Physical education and Health'),
(23, 1, 'Personal Development'),
(24, 1, 'Earth Science (For STEM)'),
(25, 1, 'Disaster Readiness');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `Dept_Code` varchar(255) NOT NULL DEFAULT '',
  `Department` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `Dept_Code`, `Department`) VALUES
(1, 'ELDEPT', 'Elementary Department'),
(2, 'JHSDEPT', 'Junior High Department'),
(3, 'SHSDEPT', 'Senior High Department');

-- --------------------------------------------------------

--
-- Table structure for table `disqualified_enrollment`
--

CREATE TABLE `disqualified_enrollment` (
  `ID` int(11) NOT NULL,
  `Reg_Number` varchar(255) NOT NULL DEFAULT '',
  `Reason` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disqualified_enrollment`
--

INSERT INTO `disqualified_enrollment` (`ID`, `Reg_Number`, `Reason`, `Date`) VALUES
(1, '2023-0001', 'Information invalid', '2023-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `ID` int(11) NOT NULL,
  `Emp_ID` varchar(255) NOT NULL DEFAULT '',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Time_In` time DEFAULT NULL,
  `Time_Out` time DEFAULT NULL,
  `Status` int(1) NOT NULL DEFAULT 0,
  `Access` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_attendance`
--

INSERT INTO `emp_attendance` (`ID`, `Emp_ID`, `Name`, `Time_In`, `Time_Out`, `Status`, `Access`, `Date`) VALUES
(1, 'A0001', 'Spencer Solis Desamito', '12:46:17', NULL, 1, 'Admin', '2023-05-14'),
(2, 'T-545540646382', 'Spencer Solis Desamito', '12:46:24', NULL, 1, 'Teacher', '2023-05-14'),
(3, 'T-579921288473', 'Jonabelle Selga Balleras', NULL, NULL, 0, 'Teacher', '2023-05-14'),
(4, 'T-221395181552', 'Jimmy Reola De Juan', NULL, NULL, 0, 'Teacher', '2023-05-14'),
(5, 'T-075815128259', 'Stephanie Selga Balleras', NULL, NULL, 0, 'Teacher', '2023-05-14'),
(6, 'F-57004563', 'Jonabelle Selga Balleras', NULL, NULL, 0, 'Cashier', '2023-05-14'),
(7, 'F-72821350', 'Christine Laarni Selga Balleras', NULL, NULL, 0, 'Librarian', '2023-05-14'),
(8, 'F-88472087', 'Spencer Solis Desamito', NULL, NULL, 0, 'Cashier', '2023-05-14'),
(9, 'F-45380623', 'Jimmy Reola De Juan ', NULL, NULL, 0, 'Counselor', '2023-05-14'),
(10, 'F-34058091', 'Stephanie Selga Balleras', NULL, NULL, 0, 'Nurse', '2023-05-14'),
(11, 'A0001', 'Spencer Solis Desamito', '16:23:22', '16:24:43', 1, 'Admin', '2023-05-15'),
(12, 'T-545540646382', 'Spencer Solis Desamito', '16:24:31', NULL, 1, 'Teacher', '2023-05-15'),
(13, 'T-579921288473', 'Jonabelle Selga Balleras', NULL, NULL, 0, 'Teacher', '2023-05-15'),
(14, 'T-221395181552', 'Jimmy Reola De Juan', NULL, NULL, 0, 'Teacher', '2023-05-15'),
(15, 'T-075815128259', 'Stephanie Selga Balleras', NULL, NULL, 0, 'Teacher', '2023-05-15'),
(16, 'F-57004563', 'Jonabelle Selga Balleras', NULL, NULL, 0, 'Cashier', '2023-05-15'),
(17, 'F-72821350', 'Christine Laarni Selga Balleras', NULL, NULL, 0, 'Librarian', '2023-05-15'),
(18, 'F-88472087', 'Spencer Solis Desamito', NULL, NULL, 0, 'Cashier', '2023-05-15'),
(19, 'F-45380623', 'Jimmy Reola De Juan ', NULL, NULL, 0, 'Counselor', '2023-05-15'),
(20, 'F-34058091', 'Stephanie Selga Balleras', NULL, NULL, 0, 'Nurse', '2023-05-15'),
(21, 'T-00340', 'Carl Justine Fernandez Desamito', NULL, NULL, 0, 'Teacher', '2023-05-15'),
(22, 'F-854117', 'Carl Justine Fernandez Desamito', NULL, NULL, 0, 'Counselor', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_list`
--

CREATE TABLE `evaluation_list` (
  `Evaluation_ID` int(11) NOT NULL,
  `Class_ID` bigint(11) NOT NULL DEFAULT 0,
  `Strand` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Teacher_ID` varchar(255) NOT NULL DEFAULT '',
  `Subject` varchar(255) NOT NULL DEFAULT '',
  `Comments` varchar(1000) NOT NULL DEFAULT '',
  `Date_Taken` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation_list`
--

INSERT INTO `evaluation_list` (`Evaluation_ID`, `Class_ID`, `Strand`, `Student_ID`, `Teacher_ID`, `Subject`, `Comments`, `Date_Taken`) VALUES
(1, 11, 'GAS', '2023-0006              ', 'T-545540646382', 'G11OC', '', '2023-03-20 15:22:32'),
(2, 7, '', '2023-0004              ', 'T-221395181552', 'G7MAPEH', '', '2023-03-20 15:22:46'),
(3, 7, '', '2023-0004              ', 'T-221395181552', 'G7MAPEH', 'Keep up the good work sir!', '2023-03-20 15:29:10'),
(4, 11, 'HUMSS', '2023-0001', 'T-545540646382', 'G11CPAR', 'Keep up the good work!', '2023-05-14 08:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `ev_answer`
--

CREATE TABLE `ev_answer` (
  `Evaluation_ID` int(11) NOT NULL,
  `Questionnaire_ID` bigint(11) NOT NULL DEFAULT 0,
  `Rate` bigint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ev_answer`
--

INSERT INTO `ev_answer` (`Evaluation_ID`, `Questionnaire_ID`, `Rate`) VALUES
(1, 1, 5),
(1, 2, 4),
(1, 3, 3),
(1, 4, 2),
(1, 5, 1),
(2, 1, 1),
(2, 2, 2),
(2, 3, 3),
(2, 4, 4),
(2, 5, 5),
(3, 1, 4),
(3, 2, 3),
(3, 3, 5),
(3, 4, 3),
(3, 5, 1),
(4, 1, 5),
(4, 2, 5),
(4, 3, 5),
(4, 4, 5),
(4, 5, 5),
(4, 6, 5),
(4, 7, 5),
(4, 8, 5),
(4, 9, 4),
(4, 10, 4),
(4, 11, 4),
(4, 12, 4),
(4, 13, 4),
(4, 14, 4),
(4, 15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ev_questionnaire`
--

CREATE TABLE `ev_questionnaire` (
  `ID` int(11) NOT NULL,
  `Question` varchar(255) NOT NULL DEFAULT '',
  `Order_By` bigint(11) NOT NULL DEFAULT 0,
  `Criteria_ID` bigint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ev_questionnaire`
--

INSERT INTO `ev_questionnaire` (`ID`, `Question`, `Order_By`, `Criteria_ID`) VALUES
(1, 'Treated students with respects', 0, 1),
(2, 'Made students feel free to ask questions', 1, 1),
(3, 'Was capable of answering questions', 2, 1),
(4, 'Communicated clearly', 3, 1),
(5, 'Assigned homework that was relevant to course material', 4, 1),
(6, 'Allowed sufficient time to complete homework assignments', 5, 1),
(7, 'Gave exams that reflected the material covered in lectures	', 6, 1),
(8, 'Provided constructive feedback on graded material', 7, 1),
(9, 'Kept students informed about their class grades and progress', 8, 1),
(10, 'Was available outside of lecture	', 9, 1),
(11, 'Set and followed clearly defined grading criteria	', 10, 1),
(12, 'Utilized the entire allotted lecture time	', 11, 1),
(13, 'Was enthusiastic about teaching the course	', 12, 1),
(14, 'Completed the objectives outlined in the course description	', 13, 1),
(15, 'I would recommend this instructor to other students	', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `ID` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL DEFAULT '',
  `Amount` int(11) NOT NULL DEFAULT 0,
  `Grade_ID` int(11) NOT NULL DEFAULT 0,
  `Date_Created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`ID`, `Description`, `Amount`, `Grade_ID`, `Date_Created`) VALUES
(1, 'Tuition Fee', 3000, 1, '2023-04-22'),
(2, 'Tuition Fee', 4000, 2, '2023-04-22'),
(3, 'Tuition Fee', 5000, 3, '2023-04-22'),
(4, 'Tuition Fee', 6000, 4, '2023-04-22'),
(5, 'Tuition Fee', 7000, 5, '2023-04-22'),
(6, 'Tuition Fee', 8000, 6, '2023-04-22'),
(7, 'Tuition Fee', 8100, 7, '2023-04-22'),
(8, 'Tuition Fee', 8200, 8, '2023-04-22'),
(9, 'Tuition Fee', 8300, 9, '2023-04-22'),
(10, 'Tuition Fee', 8400, 10, '2023-04-22'),
(11, 'Tuition Fee', 9000, 11, '2023-04-22'),
(12, 'Tuition Fee', 9500, 12, '2023-04-22'),
(13, 'Miscellaneous Fee ', 1000, 1, '2023-04-22'),
(14, 'Miscellaneous Fee ', 1100, 2, '2023-04-22'),
(15, 'Miscellaneous Fee ', 1300, 3, '2023-04-22'),
(16, 'Miscellaneous Fee ', 1400, 4, '2023-04-22'),
(17, 'Miscellaneous Fee ', 1500, 5, '2023-04-22'),
(18, 'Miscellaneous Fee ', 1600, 6, '2023-04-22'),
(19, 'Miscellaneous Fee ', 1700, 7, '2023-04-22'),
(20, 'Miscellaneous Fee ', 1800, 8, '2023-04-22'),
(21, 'Miscellaneous Fee ', 1900, 9, '2023-04-22'),
(22, 'Miscellaneous Fee ', 2000, 10, '2023-04-22'),
(23, 'Miscellaneous Fee ', 2100, 11, '2023-04-22'),
(24, 'Miscellaneous Fee ', 2200, 12, '2023-04-22'),
(25, 'Registration Fee', 150, 0, '2023-04-22'),
(26, 'Computer Fee', 3000, 11, '2023-04-22'),
(27, 'Computer Fee', 3000, 12, '2023-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Section` varchar(255) NOT NULL DEFAULT '',
  `Department` varchar(255) NOT NULL DEFAULT '',
  `Total_Student_Enrolled` bigint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`ID`, `Name`, `Section`, `Department`, `Total_Student_Enrolled`) VALUES
(1, 'Grade 1', 'St. Clare', 'ELDEPT', 2),
(2, 'Grade 2', 'St. Maria Goretti', 'ELDEPT', 0),
(3, 'Grade 3', 'Our lady of lourdes', 'ELDEPT', 0),
(4, 'Grade 4', 'St. Martha', 'ELDEPT', 0),
(5, 'Grade 5', 'St. Agnes', 'ELDEPT', 0),
(6, 'Grade 6', 'St. Catherine', 'ELDEPT', 0),
(7, 'Grade 7', 'St. Scholastica', 'JHSDEPT', 2),
(8, 'Grade 8', 'St. Lorenzo Ruiz', 'JHSDEPT', 0),
(9, 'Grade 9', 'St. Augustine', 'JHSDEPT', 0),
(10, 'Grade 10', 'St. Thomas Aquinas', 'JHSDEPT', 0),
(11, 'Grade 11', 'St. Peter', 'SHSDEPT', 5),
(12, 'Grade 12', 'St. Matthew', 'SHSDEPT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `ID` int(11) NOT NULL,
  `Sched_ID` bigint(20) DEFAULT NULL,
  `GC_Name` varchar(255) NOT NULL DEFAULT '',
  `G_Code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_chat`
--

INSERT INTO `group_chat` (`ID`, `Sched_ID`, `GC_Name`, `G_Code`) VALUES
(1, 5, 'G11St.Peter - ELSHUMSS', 'BVKshR'),
(2, 4, 'G11St.Peter - SAPHUMSS', 'nv5zeF');

-- --------------------------------------------------------

--
-- Table structure for table `group_member`
--

CREATE TABLE `group_member` (
  `ID` int(11) NOT NULL,
  `GC_ID` bigint(20) DEFAULT NULL,
  `Member_ID` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_member`
--

INSERT INTO `group_member` (`ID`, `GC_ID`, `Member_ID`) VALUES
(1, 1, '2023-0001'),
(2, 1, '2023-0005'),
(3, 2, '2023-0001'),
(4, 2, '2023-0005');

-- --------------------------------------------------------

--
-- Table structure for table `guidance`
--

CREATE TABLE `guidance` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Violation` varchar(255) NOT NULL DEFAULT '',
  `Offense` varchar(255) NOT NULL DEFAULT '',
  `Punishment` varchar(255) NOT NULL DEFAULT '',
  `Status` int(11) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Date_Resolved` varchar(255) NOT NULL DEFAULT '',
  `Notif_ID` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guidance`
--

INSERT INTO `guidance` (`ID`, `Student_ID`, `Name`, `Violation`, `Offense`, `Punishment`, `Status`, `Date`, `Date_Resolved`, `Notif_ID`) VALUES
(1, '2023-0006', 'Spencer Desamito', 'Bullying', '1st offense', 'Suspension', 0, '2023-03-25', '2023-04-02', '431803'),
(2, '2023-0006', 'Spencer Solis Desamito', 'Bullying', '2nd Offense', 'Suspension', 0, '2023-03-26', '2023-03-26', ''),
(3, '2023-0005', 'Stephanie Balleras', 'Sample', 'Sample', 'Sample', 0, '2023-03-26', '2023-03-26', ''),
(4, '2023-0001', 'Sample Sample', 'Cheating', '1st offense', '1 week cleaners', 0, '2023-05-14', '2023-05-14', ''),
(5, '2023-0001', 'Sample', 'Bullying', '2nd offense', 'Suspension for 1 week', 0, '2023-05-15', '2023-05-15', '');

-- --------------------------------------------------------

--
-- Table structure for table `handle_student`
--

CREATE TABLE `handle_student` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL,
  `Sched_ID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `handle_student`
--

INSERT INTO `handle_student` (`ID`, `Student_ID`, `Sched_ID`) VALUES
(1, '2023-0007', 1),
(2, '2023-0001', 2),
(3, '2023-0005', 2),
(4, '2023-0001', 4),
(5, '2023-0005', 4),
(6, '2023-0001', 5),
(7, '2023-0005', 5),
(8, '2023-0002', 2),
(9, '2023-0002', 4),
(10, '2023-0002', 5),
(11, '2023-0003', 1),
(12, '2023-0007', 6),
(13, '2023-0003', 6),
(14, '2023-0001', 9),
(15, '2023-0005', 9),
(16, '2023-0002', 9);

-- --------------------------------------------------------

--
-- Table structure for table `health_record`
--

CREATE TABLE `health_record` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Illness` varchar(255) NOT NULL DEFAULT '',
  `Medical_History` varchar(255) NOT NULL DEFAULT '',
  `Medication_Taken` varchar(255) NOT NULL DEFAULT '',
  `Operations` varchar(255) NOT NULL DEFAULT '',
  `Family_History` varchar(255) NOT NULL DEFAULT '',
  `Height` float NOT NULL DEFAULT 0,
  `Weight` bigint(11) NOT NULL DEFAULT 0,
  `BMI` float NOT NULL DEFAULT 0,
  `Classification` varchar(255) NOT NULL DEFAULT '',
  `Smoking` varchar(255) NOT NULL DEFAULT '',
  `Drinking` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_record`
--

INSERT INTO `health_record` (`ID`, `Student_ID`, `Illness`, `Medical_History`, `Medication_Taken`, `Operations`, `Family_History`, `Height`, `Weight`, `BMI`, `Classification`, `Smoking`, `Drinking`, `Date`) VALUES
(3, '2023-0001', 'None', 'Allergy,Asthma,Eye Problem,Allergy,Asthma,Eye Problem,Allergy,', 'None', 'None', 'Allergy,Asthma,', 1.75, 55, 17.96, 'Under weight', 'None', 'None', '2023-05-08'),
(4, '2023-0005', 'Sample', 'Allergy,Asthma,', 'Sample', 'None', 'Allergy,Asthma,', 1.75, 60, 19.59, 'Healthy weight', '', '', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `joinclass`
--

CREATE TABLE `joinclass` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `joinclass`
--

INSERT INTO `joinclass` (`ID`, `Code`, `Student_ID`) VALUES
(1, '49AFyq', '2023-0001'),
(2, '49AFyq', '2023-0005'),
(3, 'tRGsML', '2023-0005');

-- --------------------------------------------------------

--
-- Table structure for table `main_notification`
--

CREATE TABLE `main_notification` (
  `ID` int(11) NOT NULL,
  `Notification_ID` varchar(255) NOT NULL DEFAULT '',
  `_status` varchar(255) NOT NULL DEFAULT '',
  `isread` int(11) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_notification`
--

INSERT INTO `main_notification` (`ID`, `Notification_ID`, `_status`, `isread`, `Date`) VALUES
(1, '3', 'Payment', 0, '2023-04-14'),
(2, '18', 'Send Payment', 0, '2023-04-14'),
(3, '9', 'Enrollment', 0, '2023-04-16'),
(4, '2', 'Payment', 0, '2023-04-16'),
(5, '21', 'Send Payment', 0, '2023-04-17'),
(6, '10', 'Enrollment', 0, '2023-04-20'),
(7, '11', 'Enrollment', 0, '2023-04-21'),
(8, '12', 'Enrollment', 0, '2023-04-21'),
(9, '2', 'Payment', 0, '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Mg` varchar(255) NOT NULL DEFAULT '',
  `Type` varchar(255) NOT NULL DEFAULT '',
  `Total` bigint(10) NOT NULL DEFAULT 0,
  `Date_Created` date NOT NULL DEFAULT current_timestamp(),
  `Date_Expiration` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`ID`, `Name`, `Mg`, `Type`, `Total`, `Date_Created`, `Date_Expiration`) VALUES
(1, 'BioFlu', '500mg', 'Tablet', 12, '2023-03-27', '2025-03-27'),
(3, 'Paracetamol', '125mg/5ml', 'Liquid', 9, '2023-03-27', '2025-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `my_friends`
--

CREATE TABLE `my_friends` (
  `ID` int(11) NOT NULL,
  `My_ID` varchar(255) NOT NULL DEFAULT '',
  `Friend_ID` varchar(255) NOT NULL DEFAULT '',
  `Status` varchar(255) NOT NULL DEFAULT '',
  `Conversation_ID` bigint(11) NOT NULL DEFAULT 0,
  `My_Type` varchar(255) NOT NULL DEFAULT '',
  `Friend_Type` varchar(255) NOT NULL DEFAULT '',
  `isread` bigint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_friends`
--

INSERT INTO `my_friends` (`ID`, `My_ID`, `Friend_ID`, `Status`, `Conversation_ID`, `My_Type`, `Friend_Type`, `isread`) VALUES
(1, '2023-0001', '2023-0005', 'Friend', 1, 'Student', 'Student', 1),
(2, '2023-0005', '2023-0001', 'Friend', 1, 'Student', 'Student', 1),
(3, '2023-0005', 'T-075815128259', 'Friend', 3, 'Student', 'Teacher', 0),
(4, 'T-075815128259', '2023-0005', 'Friend', 3, 'Teacher', 'Student', 0),
(5, '2023-0001', 'T-075815128259', 'Friend_Request_Sent', 5, 'Student', 'Teacher', 0),
(6, 'T-075815128259', '2023-0001', 'Pending', 5, 'Teacher', 'Student', 0),
(7, '2023-0001', 'A0001', 'Friend', 7, 'Student', 'Admin', 1),
(8, 'A0001', '2023-0001', 'Friend', 7, 'Admin', 'Student', 1),
(9, 'A0001', '2023-0005', 'Friend', 9, 'Admin', 'Student', 1),
(10, '2023-0005', 'A0001', 'Friend', 9, 'Student', 'Admin', 1),
(11, 'A0001', 'T-075815128259', 'Friend_Request_Sent', 11, 'Admin', 'Teacher', 0),
(12, 'T-075815128259', 'A0001', 'Pending', 11, 'Teacher', 'Admin', 0),
(13, 'A0001', 'T-545540646382', 'Friend', 13, 'Admin', 'Teacher', 1),
(14, 'T-545540646382', 'A0001', 'Friend', 13, 'Teacher', 'Admin', 1),
(15, 'T-545540646382', '2023-0001', 'Friend_Request_Sent', 15, 'Teacher', 'Student', 0),
(16, '2023-0001', 'T-545540646382', 'Pending', 15, 'Student', 'Teacher', 0),
(17, '2023-0001', '2023-0002', 'Friend_Request_Sent', 17, 'Student', 'Student', 0),
(18, '2023-0002', '2023-0001', 'Pending', 17, 'Student', 'Student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification_history`
--

CREATE TABLE `notification_history` (
  `ID` int(11) NOT NULL,
  `Notification_ID` bigint(3) NOT NULL DEFAULT 0,
  `User_ID` varchar(255) NOT NULL DEFAULT '',
  `Access` varchar(255) NOT NULL DEFAULT '',
  `_Status` varchar(255) NOT NULL DEFAULT '',
  `isread` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification_history`
--

INSERT INTO `notification_history` (`ID`, `Notification_ID`, `User_ID`, `Access`, `_Status`, `isread`) VALUES
(1, 3, '2023-0006              ', 'Student', 'Payment', 0),
(2, 2, '2023-0005              ', 'Student', 'Payment', 0),
(3, 2, '2023-0005', 'Student', 'Payment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_chat`
--

CREATE TABLE `online_chat` (
  `ID` int(11) NOT NULL,
  `Conversation_ID` int(255) NOT NULL DEFAULT 0,
  `User_ID` varchar(255) NOT NULL DEFAULT '',
  `Message` varchar(255) NOT NULL DEFAULT '',
  `Type` varchar(255) NOT NULL DEFAULT '',
  `isread` int(2) NOT NULL DEFAULT 0,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_chat`
--

INSERT INTO `online_chat` (`ID`, `Conversation_ID`, `User_ID`, `Message`, `Type`, `isread`, `Date`) VALUES
(1, 1, '2023-0001', 'hii', 'Student', 1, '2023-05-07 11:27:54'),
(2, 1, '2023-0005', 'hello', 'Student', 1, '2023-05-07 11:28:13'),
(3, 1, '2023-0001', 'hello', 'Student', 0, '2023-05-07 12:11:46'),
(4, 1, '2023-0001', 'hi', 'Student', 0, '2023-05-08 01:38:03'),
(5, 7, 'A0001', 'hii', 'Admin', 0, '2023-05-08 11:01:23'),
(6, 13, 'T-545540646382', 'hello sir', 'Teacher', 1, '2023-05-08 11:02:22'),
(7, 13, 'A0001', 'hii', 'Admin', 0, '2023-05-08 11:02:57'),
(8, 1, '2023-0001', 'hello', 'Student', 0, '2023-05-14 03:58:34'),
(9, 1, '2023-0005', 'hii', 'Student', 1, '2023-05-14 05:25:30'),
(10, 1, '2023-0001', 'hello', 'Student', 0, '2023-05-14 05:25:54'),
(11, 7, 'A0001', 'hi student', 'Admin', 0, '2023-05-14 09:09:10'),
(12, 13, 'A0001', 'hi teacher', 'Admin', 0, '2023-05-14 09:09:19'),
(13, 13, 'T-545540646382', 'hello sir', 'Teacher', 0, '2023-05-14 23:36:01'),
(14, 1, '2023-0005', 'hii', 'Student', 0, '2023-05-19 08:50:55'),
(15, 1, '2023-0001', 'hi', 'Student', 0, '2023-05-20 08:59:55'),
(16, 1, '2023-0001', 'anu na ginagawa mo', 'Student', 0, '2023-05-20 09:00:51'),
(17, 1, '2023-0001', 'hello', 'Student', 0, '2023-05-20 09:52:48'),
(18, 1, '2023-0001', 'hoy', 'Student', 0, '2023-05-20 10:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `patience_record`
--

CREATE TABLE `patience_record` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Medicine` varchar(255) NOT NULL DEFAULT '',
  `Quantity` bigint(255) NOT NULL DEFAULT 0,
  `Illness` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `Due_Date` date DEFAULT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Total` bigint(12) NOT NULL DEFAULT 0,
  `Balance` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`ID`, `Due_Date`, `Student_ID`, `Total`, `Balance`) VALUES
(1, '2023-05-25', '2023-0001', 14100, 13100),
(2, '2023-06-15', '2023-0005', 10000, 7500),
(8, '2023-06-08', '2023-0007', 8500, 8400),
(9, '2023-06-13', '2023-0002', 14100, 14000),
(10, '2023-06-15', '2023-0010', 14100, 13100),
(11, '2023-06-15', '2023-0003', 8500, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `OR_Number` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Account_Name` varchar(255) NOT NULL DEFAULT '',
  `Account_Email` varchar(255) NOT NULL DEFAULT '',
  `Cashier_ID` varchar(255) NOT NULL DEFAULT '',
  `Payment_Type` varchar(255) NOT NULL DEFAULT '',
  `Paid_Amount` bigint(11) NOT NULL DEFAULT 0,
  `Balance` bigint(20) NOT NULL DEFAULT 0,
  `QR_Code` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`ID`, `Date`, `OR_Number`, `Student_ID`, `Account_Name`, `Account_Email`, `Cashier_ID`, `Payment_Type`, `Paid_Amount`, `Balance`, `QR_Code`) VALUES
(1, '2023-04-25', '001-533806225626', '2023-0001', 'Holy Child Academy', 'hca100146@gmail.com', '', 'Partial Payment', 1000, 13100, '1682393844.png'),
(2, '2023-04-25', '014-222932472847', '2023-0005', 'Holy Child Academy', 'hca100146@gmail.com', '', 'Partial Payment', 1500, 8500, '1682428409.png'),
(10, '2023-05-08', '010-826687209316', '2023-0007', 'hca', 'hca100146@gmail.com', '', 'Partial Payment', 100, 8400, '1683588106.png'),
(11, '2023-05-13', '013-990498754307', '2023-0002', 'hca', 'hca@gmail.com', '', 'Partial Payment', 100, 14000, '1683985011.png'),
(14, '2023-05-15', 'IHM-818083399845', '2023-0005', 'hcamis', 'hca100146@gmailcom', '', 'Partial Payment', 1000, 7500, '1684126040.png'),
(15, '2023-05-15', '016-126649698571', '2023-0010', 'hcamisportal', 'hca100146@gmail.com', '', 'Partial Payment', 1000, 13100, '1684138069.png'),
(16, '2023-05-15', '001-992172456345', '2023-0003', 'Holy Child Academy', 'hca100146@gmail.com', '', 'Partial Payment', 1500, 7000, '1684138510.png');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `Body` varchar(255) NOT NULL DEFAULT '',
  `Post_By` varchar(255) NOT NULL DEFAULT '',
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Date_Post` datetime NOT NULL DEFAULT current_timestamp(),
  `Files` varchar(255) NOT NULL DEFAULT '',
  `Destination` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `Body`, `Post_By`, `Code`, `Date_Post`, `Files`, `Destination`) VALUES
(2, 'hii', 'T-545540646382', 'OeiP38', '2023-05-11 23:20:40', 'None', 'None'),
(3, 'Hii', 'T-545540646382', '0jKuHl', '2023-05-12 12:14:15', 'None', 'None'),
(4, 'Hii Students. Kindly click scan your attendance for your attendance.', 'T-545540646382', '49AFyq', '2023-05-14 04:52:23', 'None', 'None'),
(5, 'Hello Class', 'T-545540646382', 'tRGsML', '2023-05-19 04:04:48', 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Contact` bigint(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Message` varchar(255) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`ID`, `Name`, `Contact`, `Email`, `Message`, `Date`) VALUES
(1, 'Spencer Desamito', 9514762573, 'spencer.desamito.02@gmail.com', 'Your school is very beautiful.', '2023-05-13 22:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `Quiz_ID` varchar(255) NOT NULL DEFAULT '',
  `Question_ID` varchar(255) NOT NULL DEFAULT '',
  `Question` varchar(255) NOT NULL DEFAULT '',
  `Choices` bigint(11) NOT NULL DEFAULT 0,
  `Points` int(11) NOT NULL DEFAULT 0,
  `Counts` bigint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ID`, `Quiz_ID`, `Question_ID`, `Question`, `Choices`, `Points`, `Counts`) VALUES
(1, '645d929433afc', '645d92a85784a', 'Sample', 0, 2, 1),
(2, '645d929433afc', '645d92a8ac54a', 'Sample', 0, 2, 2),
(3, '645dc4f92442c', '645dc4fa2f944', '', 0, 0, 1),
(4, '645dc52eca1ab', '645dc53a198a1', 'Sample', 0, 2, 1),
(5, '64610333d60d6', '6461034dadd97', 'Sample', 0, 2, 1),
(6, '64610333d60d6', '6461034db20a7', 'Sample', 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `queuing`
--

CREATE TABLE `queuing` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Contact` varchar(13) NOT NULL DEFAULT '',
  `Purpose` varchar(255) NOT NULL DEFAULT '',
  `Number` varchar(13) NOT NULL DEFAULT '',
  `Status` bigint(2) NOT NULL DEFAULT 0,
  `Cashier` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queuing`
--

INSERT INTO `queuing` (`ID`, `Student_ID`, `Contact`, `Purpose`, `Number`, `Status`, `Cashier`, `Date`) VALUES
(1, '2023-0006              ', '09514762574', 'Payment', '0001', 1, 'F-57004563', '2023-04-24'),
(2, '2023-0005', '09383304572', 'Payment', '0002', 1, 'F-57004563', '2023-04-21'),
(3, '2023-0005              ', '09514762574', 'Payment', '0003', 1, 'F-57004563', '2023-04-21'),
(4, '2023-0001              ', '09383304572', 'Payment', '0004', 1, 'F-57004563', '2023-04-21'),
(5, '2023-0001', '09514762574', 'Payment', '0001', 1, 'F-57004563', '2023-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `ID` int(11) NOT NULL,
  `Quiz_ID` varchar(255) NOT NULL DEFAULT '',
  `Title` varchar(255) NOT NULL DEFAULT '',
  `Questions` bigint(3) NOT NULL DEFAULT 0,
  `Score` bigint(3) NOT NULL DEFAULT 0,
  `Minus` bigint(3) NOT NULL DEFAULT 0,
  `Time_Limit` bigint(3) NOT NULL DEFAULT 0,
  `Due_Date` date DEFAULT NULL,
  `Due_Time` time DEFAULT NULL,
  `Description` varchar(255) NOT NULL DEFAULT '',
  `Date` datetime DEFAULT current_timestamp(),
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`ID`, `Quiz_ID`, `Title`, `Questions`, `Score`, `Minus`, `Time_Limit`, `Due_Date`, `Due_Time`, `Description`, `Date`, `Code`, `Status`) VALUES
(1, '64610333d60d6', 'Sample', 2, 0, 0, 5, '2023-02-02', '00:12:00', 'sa', '2023-05-14 15:50:11', '49AFyq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ID` int(11) NOT NULL,
  `Teacher_ID` varchar(255) NOT NULL DEFAULT '',
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Class_ID` bigint(11) NOT NULL DEFAULT 0,
  `Strand` varchar(255) NOT NULL DEFAULT '',
  `Room` varchar(255) NOT NULL DEFAULT '',
  `Day` varchar(255) NOT NULL DEFAULT '',
  `Department` varchar(255) NOT NULL DEFAULT '',
  `Semester` varchar(255) DEFAULT NULL,
  `Time_ID` bigint(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`ID`, `Teacher_ID`, `Code`, `Class_ID`, `Strand`, `Room`, `Day`, `Department`, `Semester`, `Time_ID`) VALUES
(1, 'T-579921288473', 'G5ENG', 5, '', 'St. Agnes', 'M,T,W,TH,F', 'ELDEPT', NULL, 1),
(2, 'T-545540646382', 'G11CPAR', 11, 'HUMSS', 'St. Peter', 'M,T,W,TH,F', 'SHSDEPT', NULL, 2),
(3, 'T-545540646382', 'G11CPAR', 11, 'GAS', 'St. Peter', 'M,T,W,TH,F', 'SHSDEPT', NULL, 1),
(4, 'T-545540646382', 'G11SAS', 11, 'HUMSS', 'St. Peter', 'M,T,W,TH,F', 'SHSDEPT', NULL, 5),
(5, 'T-545540646382', 'G11ELS', 11, 'HUMSS', 'Online', 'M,T,W,TH,F', 'SHSDEPT', NULL, 8),
(7, 'T-545540646382', 'G11ELS', 11, 'ABM', 'St. Peter', 'M,T,W,TH,F', 'SHSDEPT', NULL, 6),
(8, 'T-545540646382', 'G11SAS', 11, 'GAS', 'St. Peter', 'M,T,W,TH,F', 'SHSDEPT', '1st Semester', 7),
(9, 'T-545540646382', 'G11PS', 11, 'HUMSS', 'Online', 'M,T,W,TH,F', 'SHSDEPT', '1st Semester', 3);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `ID` int(11) NOT NULL,
  `Quiz_ID` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Scores` bigint(11) NOT NULL DEFAULT 0,
  `Time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shs_grade`
--

CREATE TABLE `shs_grade` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Subject` varchar(255) NOT NULL DEFAULT '',
  `Sched_ID` bigint(2) DEFAULT NULL,
  `Class_ID` bigint(2) DEFAULT NULL,
  `Prelim` bigint(5) NOT NULL DEFAULT 0,
  `Midterm` bigint(5) NOT NULL DEFAULT 0,
  `Final` bigint(5) NOT NULL DEFAULT 0,
  `Overall` float NOT NULL DEFAULT 0,
  `AY` varchar(255) NOT NULL DEFAULT '',
  `Semester` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shs_grade`
--

INSERT INTO `shs_grade` (`ID`, `Student_ID`, `Subject`, `Sched_ID`, `Class_ID`, `Prelim`, `Midterm`, `Final`, `Overall`, `AY`, `Semester`, `Date`) VALUES
(1, '2023-0002', 'G11CPAR', 2, 11, 90, 90, 75, 85, '2026-2027', '1st Semester', '2023-05-18'),
(2, '2023-0005', 'G11CPAR', 2, 11, 85, 90, 95, 90, '2026-2027', '1st Semester', '2023-05-18'),
(3, '2023-0001', 'G11CPAR', 2, 11, 80, 90, 90, 87, '2026-2027', '1st Semester', '2023-05-18'),
(4, '2023-0005', 'G11PS', 9, 11, 90, 0, 0, 30, '2026-2027', '1st Semester', '2023-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tb`
--

CREATE TABLE `staff_tb` (
  `ID` int(11) NOT NULL,
  `Emp_ID` varchar(255) NOT NULL DEFAULT '',
  `Salutation` varchar(255) NOT NULL DEFAULT '',
  `Lastname` varchar(255) NOT NULL DEFAULT '',
  `Firstname` varchar(255) NOT NULL DEFAULT '',
  `Middlename` varchar(255) NOT NULL DEFAULT '',
  `Suffix` varchar(255) NOT NULL DEFAULT '',
  `DOB` date DEFAULT NULL,
  `Age` int(2) DEFAULT 0,
  `Gender` varchar(255) NOT NULL DEFAULT '',
  `Status` varchar(255) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `Nationality` varchar(255) NOT NULL DEFAULT '',
  `Contact` bigint(12) NOT NULL DEFAULT 0,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Cashier` varchar(255) NOT NULL DEFAULT '',
  `Picture` varchar(255) NOT NULL DEFAULT '',
  `QR_Code` varchar(255) NOT NULL DEFAULT '',
  `Date` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tb`
--

INSERT INTO `staff_tb` (`ID`, `Emp_ID`, `Salutation`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `DOB`, `Age`, `Gender`, `Status`, `Address`, `Nationality`, `Contact`, `Email`, `Cashier`, `Picture`, `QR_Code`, `Date`) VALUES
(1, 'F-57004563', 'Ms', 'Balleras', 'Jonabelle', 'Selga', '', '2001-06-22', 21, 'Female', 'Single', 'San Manuel, Pangasinan', 'Filipino', 9123456789, 'spencer.desamito.02@gmail.com', 'Cashier 1', 'IMG-6419005ee28763.16191861.png', 'F-57004563.png', 'March 21, 2023 08:54 AM'),
(2, 'F-72821350', 'Ms', 'Balleras', 'Christine Laarni', 'Selga', '', '1999-08-30', 23, 'Female', 'Single', 'San Manuel, Pangasinan', 'Filipino', 9123456789, 'hca100146@gmail.com', '', 'IMG-64191d44249203.41176973.png', 'F-72821350.png', 'March 21, 2023 10:57 AM'),
(3, 'F-88472087', 'Mr', 'Desamito', 'Spencer', 'Solis', '', '1999-12-02', 23, 'Male', 'Single', 'Rosario, Pozorrubio, Pangasinan', 'Filipino', 9123456789, 'spencer.desamito.19@gmail.com', 'Cashier 2', 'IMG-641e57a7dac8e2.90850035.png', 'F-88472087.png', 'March 25, 2023 10:07 AM'),
(4, 'F-45380623', 'Mr', 'De Juan ', 'Jimmy', 'Reola', '', '2001-12-12', 21, 'Male', 'Single', 'Binalonan', 'Filipino', 9123456789, 'habibabe.babemahal082219@gmail.com', '', 'IMG-641e58625e4bb7.63691679.png', 'F-45380623.png', 'March 25, 2023 10:11 AM'),
(5, 'F-34058091', 'Ms', 'Balleras', 'Stephanie', 'Selga', '', '2002-09-09', 20, 'Female', 'Single', 'San Roque, San Manuel, Pangasinan', 'Filipino', 9123456789, 'spencer.desamito.02@yahoo.com', '', 'IMG-641fa60de780c1.60415650.png', 'F-34058091.png', 'March 26, 2023 09:54 AM'),
(6, 'F-854117', 'Mr ', 'Desamito', 'Carl Justine', 'Fernandez', '', '2007-06-01', 15, 'Male', 'Single', 'Rosario, Pozorrubio, Pangasinan', 'Filipino', 909090909, 'da377288@gmail.com', '', 'IMG-64609a08deada7.43937271.png', 'F-854117.png', 'May 14, 2023 04:20 PM');

-- --------------------------------------------------------

--
-- Table structure for table `std_account`
--

CREATE TABLE `std_account` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Firstname` varchar(255) NOT NULL DEFAULT '',
  `Middlename` varchar(255) NOT NULL DEFAULT '',
  `Lastname` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Password` varchar(255) NOT NULL DEFAULT '',
  `Default_Password` varchar(255) NOT NULL DEFAULT '',
  `Access` varchar(255) NOT NULL DEFAULT '',
  `Status` bigint(11) NOT NULL DEFAULT 0,
  `Otp` bigint(12) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_account`
--

INSERT INTO `std_account` (`ID`, `Student_ID`, `Firstname`, `Middlename`, `Lastname`, `Email`, `Password`, `Default_Password`, `Access`, `Status`, `Otp`, `Date`) VALUES
(4, '2023-0001', 'Sample', 'Sample', 'Sample', 'spencer.desamito.02@gmail.com', '$2y$10$1FOb4LfL6pExvlUL0rsHbeCfvlqWuH8UmL.4iMbr.jAVa0u5YHtbO', '', 'Student', 0, 635009, '2023-04-24'),
(5, '2023-0005', 'Carl Justine', 'Desamito', 'Fernandez', 'habibabe.babemahal082219@gmail.com', '$2y$10$1FOb4LfL6pExvlUL0rsHbeCfvlqWuH8UmL.4iMbr.jAVa0u5YHtbO', '', 'Student', 0, 214904, '2023-04-24'),
(6, '2023-0007', 'Test', 'Test', 'Test', 'spencer.desamito.02@gmail.com', '$2y$10$gkF0aSAzdKNNvQUPTyGykeYRWTtR17gvLOl2EFZG99KrJptpBxX6a', '', 'Student', 0, 616254, '2023-05-08'),
(8, '2023-0002', 'Spencer', 'Solis', 'Desamito', 'spencer.desamito.02@gmail.com', '$2y$10$2Dq91wVsVmRVqeiEivQd.ew.HCCy/dPflfwboLIr7Vbm4fE9f7sbO', '', 'Student', 0, 0, '2023-05-13'),
(9, '2023-0003', 'Jonabelle', 'Selga', 'Balleras', 'jonabelle.balleras.22@gmail.com', '$2y$10$mlAp//fdOx6Gvs2Tbh0Hk.1GXvc7CL/PxBovOnkFCqOUOtqsAiWwC', '', 'Student', 0, 0, '2023-05-14'),
(10, '2023-0010', 'Test', 'Test', 'Test', 'spencer.desamito.02@gmail.com', '$2y$10$GEV70OXhF2dyhJCij3wJfeE7iTermqNGh3zsU6O2O1BPw37mBepJm', '', 'Student', 0, 0, '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `std_assign`
--

CREATE TABLE `std_assign` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Ass_ID` bigint(255) NOT NULL DEFAULT 0,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Answer` varchar(255) NOT NULL DEFAULT '',
  `Score` int(3) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_assign`
--

INSERT INTO `std_assign` (`ID`, `Code`, `Ass_ID`, `Student_ID`, `Answer`, `Score`, `Date`) VALUES
(1, '49AFyq', 1, '2023-0001', 'admin.png', 90, '2023-05-14'),
(2, '49AFyq', 1, '2023-0005', 'admin.png', 88, '2023-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `std_attendance`
--

CREATE TABLE `std_attendance` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Sched_ID` int(11) DEFAULT NULL,
  `Time_In` time DEFAULT NULL,
  `Time_Out` time DEFAULT NULL,
  `Status` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_attendance`
--

INSERT INTO `std_attendance` (`ID`, `Student_ID`, `Sched_ID`, `Time_In`, `Time_Out`, `Status`, `Date`) VALUES
(1, '2023-0001', 5, '17:05:22', '17:06:34', 'On Time', '2023-05-14'),
(2, '2023-0005', 5, NULL, NULL, 'Absent', '2023-05-14'),
(3, '2023-0002', 5, NULL, NULL, 'Absent', '2023-05-14'),
(4, '2023-0005', 9, '09:15:44', '09:16:06', 'On Time', '2023-05-19'),
(5, '2023-0001', 9, NULL, NULL, 'Absent', '2023-05-19'),
(6, '2023-0002', 9, NULL, NULL, 'Absent', '2023-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `std_grade`
--

CREATE TABLE `std_grade` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Class_ID` int(11) DEFAULT NULL,
  `Sched_ID` int(11) DEFAULT NULL,
  `Subject` varchar(255) NOT NULL DEFAULT '',
  `First` bigint(5) NOT NULL DEFAULT 0,
  `Second` bigint(5) NOT NULL DEFAULT 0,
  `Third` bigint(5) NOT NULL DEFAULT 0,
  `Fourth` bigint(5) NOT NULL DEFAULT 0,
  `Final` float NOT NULL DEFAULT 0,
  `SY` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_grade`
--

INSERT INTO `std_grade` (`ID`, `Student_ID`, `Class_ID`, `Sched_ID`, `Subject`, `First`, `Second`, `Third`, `Fourth`, `Final`, `SY`, `Date`) VALUES
(1, '2023-0007', 5, 1, 'G5ENG', 90, 90, 92, 93, 91, '2026-2027', '2023-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `std_quiz`
--

CREATE TABLE `std_quiz` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL DEFAULT '',
  `Quiz_ID` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Score` bigint(3) NOT NULL DEFAULT 0,
  `Wrong` int(3) NOT NULL DEFAULT 0,
  `Files` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_quiz`
--

INSERT INTO `std_quiz` (`ID`, `Code`, `Quiz_ID`, `Student_ID`, `Score`, `Wrong`, `Files`, `Date`) VALUES
(1, '49AFyq', '64610333d60d6', '2023-0001', 2, 0, '', '2023-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `strands`
--

CREATE TABLE `strands` (
  `ID` int(11) NOT NULL,
  `Strands` varchar(255) NOT NULL DEFAULT '',
  `Description` varchar(255) NOT NULL DEFAULT '',
  `Grade` varchar(255) NOT NULL DEFAULT '',
  `Total_Students_Enrolled` bigint(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strands`
--

INSERT INTO `strands` (`ID`, `Strands`, `Description`, `Grade`, `Total_Students_Enrolled`) VALUES
(1, 'GAS', 'General Academic Strand', 'Grade 11', 0),
(2, 'ABM', 'Accountancy and Business Management', 'Grade 11', 0),
(3, 'HUMSS', 'Humanities and Social Sciences', 'Grade 11', 0),
(4, 'TVL', 'Technical Vocation and Livelihood', 'Grade 11', 0),
(5, 'ABM', 'Accountancy and Business Management', 'Grade 12', 0),
(6, 'GAS', 'General Academic Strand', 'Grade 12', 0),
(7, 'HUMSS', 'Humanities and Social Sciences', 'Grade 12', 0),
(8, 'TVL', 'Technical Vocation and Livelihood', 'Grade 12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `str_staff_attendance`
--

CREATE TABLE `str_staff_attendance` (
  `ID` int(11) NOT NULL,
  `Status` int(2) NOT NULL DEFAULT 0,
  `Start_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `str_staff_attendance`
--

INSERT INTO `str_staff_attendance` (`ID`, `Status`, `Start_Time`) VALUES
(1, 0, '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `Student_ID` tinytext NOT NULL DEFAULT '',
  `Lastname` tinytext NOT NULL DEFAULT '',
  `Firstname` tinytext NOT NULL DEFAULT '',
  `Middlename` tinytext NOT NULL DEFAULT '',
  `Suffix` tinytext DEFAULT '',
  `DOB` date DEFAULT NULL,
  `Age` int(2) NOT NULL DEFAULT 0,
  `POB` tinytext NOT NULL DEFAULT '',
  `Gender` tinytext NOT NULL DEFAULT '',
  `Phone` bigint(12) NOT NULL DEFAULT 0,
  `Email` tinytext NOT NULL DEFAULT '',
  `Picture` tinytext NOT NULL DEFAULT '',
  `QR_Code` tinytext NOT NULL DEFAULT '',
  `Grade` tinytext NOT NULL DEFAULT '',
  `Strand` tinytext NOT NULL DEFAULT '',
  `Status` tinytext NOT NULL DEFAULT '',
  `Nationality` tinytext NOT NULL DEFAULT '',
  `Address` tinytext NOT NULL DEFAULT '',
  `LRN` tinytext NOT NULL DEFAULT '',
  `Student_Type` tinytext NOT NULL DEFAULT '',
  `Enrollment_Status` tinytext NOT NULL DEFAULT '',
  `Enrolled_Month` text NOT NULL DEFAULT '',
  `Enrolled_Year` year(4) DEFAULT NULL,
  `Enrolled_Date` date DEFAULT NULL,
  `SLA` tinytext NOT NULL DEFAULT '',
  `LSYA` tinytext NOT NULL DEFAULT '',
  `LGC` tinytext NOT NULL DEFAULT '',
  `Gen_Ave` int(11) NOT NULL DEFAULT 0,
  `Semester` tinytext NOT NULL DEFAULT '',
  `SY` tinytext NOT NULL DEFAULT '',
  `Application_Date` date NOT NULL DEFAULT current_timestamp(),
  `Date_Approve` text NOT NULL DEFAULT '',
  `GLastname` tinytext NOT NULL DEFAULT '',
  `GFirstname` tinytext NOT NULL DEFAULT '',
  `GMiddlename` tinytext NOT NULL DEFAULT '',
  `GContact` tinytext NOT NULL DEFAULT '',
  `Reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Student_ID`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `DOB`, `Age`, `POB`, `Gender`, `Phone`, `Email`, `Picture`, `QR_Code`, `Grade`, `Strand`, `Status`, `Nationality`, `Address`, `LRN`, `Student_Type`, `Enrollment_Status`, `Enrolled_Month`, `Enrolled_Year`, `Enrolled_Date`, `SLA`, `LSYA`, `LGC`, `Gen_Ave`, `Semester`, `SY`, `Application_Date`, `Date_Approve`, `GLastname`, `GFirstname`, `GMiddlename`, `GContact`, `Reference`) VALUES
(1, '2023-0001', 'Sample', 'Sample', 'Sample', '', '1999-12-02', 23, 'Sample', 'Male', 912345678, 'spencer.desamito.02@gmail.com', 'IMG-644746e24e30c7.04206757.jpg', '2023-0001.png', 'Grade 11', 'HUMSS', 'Single', 'Sample', '', '100146042591', 'Transferee', 'Enrolled', 'April', 2023, '2023-04-25', 'Sample', 'Sample', 'Sample', 80, '1st Semester', '2026-2027', '2023-04-24', 'April 24, 2023', 'Sample', 'Sample', 'Sample', '1231231312', '6460d00a6a5cf'),
(2, '2023-0002', 'Desamito', 'Spencer', 'Solis', '', '1999-12-02', 23, 'Pozorrubio', 'Male', 9514762574, 'spencer.desamito.02@gmail.com', 'IMG-644746e24e30c7.04206757.jpg', '2023-0002.png', 'Grade 11', 'HUMSS', 'Single', 'Filipino', '1 Test Test Test Test Test 123', '100146193140', 'Transferee', 'Enrolled', 'May', 2023, '2023-05-13', 'Rosario Elementary School', '2016-2017', 'Grade 6', 90, '1st Semester', '2026-2027', '2023-04-24', 'May 13, 2023', 'Desamito', 'Jocelyn', 'Solis', '09123456789', '6460d05177b49'),
(3, '2023-0003', 'Balleras', 'Jonabelle', 'Selga', '', '2001-06-22', 21, 'San Manuel, Pangasinan', 'Female', 9514762574, 'jonabelle.balleras.22@gmail.com', 'IMG-644746e24e30c7.04206757.jpg', '2023-0003.png', 'Grade 5', '', 'Single', 'Filipino', '', '100146362190', 'Transferee', 'Enrolled', 'May', 2023, '2023-05-15', 'Bobon Elementary School', '2015-2016', 'Grade 4', 80, '', '2026-2027', '2023-04-24', 'May 14, 2023', 'Balleras', 'Marilyn', 'Selga', '0912345678', '6460d059392ee'),
(4, '2023-0004', 'Balleras', 'Stephanie', 'Selga', '', '2003-12-02', 19, 'San Manuel, Pangasinan', 'Female', 9212345678, 'hca100146@gmail.com', 'IMG-644746e24e30c7.04206757.jpg', '', 'Grade 11', 'HUMSS', 'Single', 'Filipino', '', '100146738192', 'Transferee', 'Pending', '', 0000, '0000-00-00', 'Sample', 'Sample', 'Sample', 90, '', '2026-2027', '2023-04-24', 'April 24, 2023', 'Balleras', 'Marilyn', 'Selga', '09123456789', '5ece4797eaf5e'),
(5, '2023-0005', 'Fernandez', 'Carl Justine', 'Desamito', '', '2007-06-01', 15, 'Pozorrubio', 'Male', 9514762574, 'habibabe.babemahal082219@gmail.com', 'IMG-644746e24e30c7.04206757.jpg', '2023-0005.png', 'Grade 11', 'HUMSS', 'Single', 'Filipino', '', '100146154332', 'Transferee', 'Enrolled', 'April', 2023, '2023-04-25', 'Rosario National High School', '2021-2022', 'Grade 7', 90, '1st Semester', '2026-2027', '2023-04-24', 'April 24, 2023', 'Desamito', 'Jocelyn', 'Solis', '0912345678', '6460d06eaf9d9'),
(7, '2023-0007', 'Test', 'Test', 'Test', '', '1999-02-01', 24, 'Test', 'Male', 9514762574, '', 'IMG-644746e24e30c7.04206757.jpg', '2023-0007.png', 'Grade 5', '', 'Single', 'Test', '1 Test Test Test Test Test 123', '100146750040', 'Transferee', 'Enrolled', 'May', 2023, '2023-05-08', 'Test', 'Test', 'Test', 96, '', '2026-2027', '2023-05-08', 'May 8, 2023', 'Test', 'Test', 'Test', '09514762574', '412601547931'),
(10, '2023-0010', 'Test', 'Test', 'Test', '', '2000-12-12', 22, 'Test', 'Female', 9090909090, 'spencer.desamito.02@gmail.com', 'IMG-6461e5bfdb0584.08185028.png', '2023-0010.png', 'Grade 11', 'ABM', 'Single', 'Test', '00 test test test test test 0000', '100146439438', 'New', 'Enrolled', 'May', 2023, '2023-05-15', 'test', 'test', 'test', 90, '1st Semester', '2026-2027', '2023-05-15', 'May 15, 2023', 'test', 'test', 'test', '0000000000', '6461e5bfdb04c');

-- --------------------------------------------------------

--
-- Table structure for table `student_bmi`
--

CREATE TABLE `student_bmi` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `Contact` bigint(255) NOT NULL DEFAULT 0,
  `Gender` varchar(255) NOT NULL DEFAULT '',
  `Guardian_Name` varchar(255) NOT NULL DEFAULT '',
  `Guardian_Number` bigint(255) NOT NULL DEFAULT 0,
  `Height` varchar(255) NOT NULL DEFAULT '',
  `Weight` bigint(255) NOT NULL DEFAULT 0,
  `BMI` varchar(255) NOT NULL DEFAULT '',
  `History_Illness` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_bmi`
--

INSERT INTO `student_bmi` (`ID`, `Name`, `Student_ID`, `Address`, `Contact`, `Gender`, `Guardian_Name`, `Guardian_Number`, `Height`, `Weight`, `BMI`, `History_Illness`) VALUES
(1, 'Spencer Solis Desamito', '2023-0006', 'Rosario, Pozorrubio, Pangasinan', 9123456789, 'Male', 'Sample Sample Sample', 9123456789, '1.75', 55, 'Under Weight', 'Headache');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Total_Fees` bigint(11) NOT NULL DEFAULT 0,
  `Status` int(11) NOT NULL DEFAULT 0,
  `Date_Created` date NOT NULL DEFAULT current_timestamp(),
  `Due_Date` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE `student_grade` (
  `ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL DEFAULT '',
  `Class_ID` bigint(11) NOT NULL DEFAULT 0,
  `Strand` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`ID`, `Student_ID`, `Class_ID`, `Strand`, `Date`) VALUES
(1, '2023-0001', 11, 'HUMSS', '2023-04-24'),
(2, '2023-0005', 11, 'HUMSS', '2023-04-24'),
(9, '2023-0007', 5, '', '2023-05-08'),
(12, '2023-0002', 11, 'HUMSS', '2023-05-13'),
(13, '2023-0003', 5, '', '2023-05-14'),
(14, '2023-0010', 11, 'ABM', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `ID` int(11) NOT NULL,
  `Subject_Code` varchar(255) NOT NULL DEFAULT '',
  `Description` varchar(255) NOT NULL DEFAULT '',
  `Level` varchar(255) NOT NULL DEFAULT '',
  `Department` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`ID`, `Subject_Code`, `Description`, `Level`, `Department`) VALUES
(1, 'G1MT', 'Mother Tounge', 'Grade 1', 'ELDEPT'),
(2, 'G11OC', 'Oral Communication', 'Grade 11', 'SHSDEPT'),
(3, 'G7MAPEH', 'MAPEH', 'Grade 7', 'JHSDEPT'),
(4, 'G7AP', 'Araling Panlipunan', 'Grade 7', 'JHSDEPT'),
(5, 'G1FIL', 'Filipino', 'Grade 1', 'ELDEPT'),
(6, 'G7SCIE', 'Science', 'Grade 7', 'JHSDEPT'),
(7, 'G12PD', 'Personal Development', 'Grade 12', 'SHSDEPT'),
(8, 'G11CPAR', 'Contemporary Arts', 'Grade 11', 'SHSDEPT'),
(9, 'G8FIL', 'Filipino', 'Grade 8', 'JHSDEPT'),
(10, 'G11ELS', 'Earth and Life Science', 'Grade 11', 'SHSDEPT'),
(11, 'G11PS', 'Physical Science', 'Grade 11', 'SHSDEPT'),
(12, 'G11SAS', 'Statistics and Probability', 'Grade 11', 'SHSDEPT'),
(13, 'G5ENG', 'English', 'Grade 5', 'ELDEPT'),
(14, 'G5MAPEH', 'MAPEH', 'Grade 5', 'ELDEPT');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Access` varchar(255) NOT NULL DEFAULT '',
  `Purpose` varchar(255) NOT NULL DEFAULT '',
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`ID`, `Name`, `Access`, `Purpose`, `Date`) VALUES
(1, 'Justine', 'Student', 'Enrollment', '2023-03-16 20:16:29'),
(2, 'Spencer', 'Student', 'Enrollment', '2023-03-16 21:18:47'),
(3, 'Manuel Dave', 'Student', 'Enrollment', '2023-03-17 07:15:28'),
(4, 'Larylyn', 'Student', 'Enrollment', '2023-03-17 07:30:36'),
(5, 'Christine Laarni', 'Student', 'Enrollment', '2023-03-17 07:35:49'),
(6, 'Stephanie', 'Student', 'Enrollment', '2023-03-17 07:39:54'),
(7, 'Sample', 'Student', 'Enrollment', '2023-03-18 19:14:23'),
(8, 'Justine', 'Student', 'Enrollment', '2023-03-18 21:03:30'),
(9, 'Justine', 'Student', 'Enrollment', '2023-04-16 16:30:08'),
(10, 'Stephanie', '', 'Login', '2023-04-17 08:48:06'),
(11, 'Spencer', '', 'Login', '2023-04-17 08:48:59'),
(12, 'Justine', '', 'Login', '2023-04-18 18:56:55'),
(13, 'Stephanie', '', 'Login', '2023-04-18 19:12:53'),
(14, 'Spencer', '', 'Login', '2023-04-20 06:44:47'),
(15, 'Sample', '', 'Login', '2023-04-20 06:54:42'),
(16, 'Sample', '', 'Login', '2023-04-20 07:05:57'),
(17, 'Sample', '', 'Login', '2023-04-20 07:08:54'),
(18, 'Spencer', '', 'Login', '2023-04-20 17:32:14'),
(19, 'Jonabelle', '', 'Login', '2023-04-20 17:35:31'),
(20, 'Spencer', '', 'Login', '2023-04-21 08:39:34'),
(21, 'Spencer', '', 'Login', '2023-04-21 09:16:11'),
(22, 'Sample', '', 'Login', '2023-04-21 09:34:35'),
(23, 'Sample', '', 'Login', '2023-04-21 09:51:16'),
(24, 'Sample', '', 'Login', '2023-04-21 09:55:00'),
(25, 'Sample', '', 'Login', '2023-04-21 09:57:00'),
(26, 'Jonabelle', '', 'Login', '2023-04-21 10:02:13'),
(27, 'Sample', '', 'Login', '2023-04-21 14:08:44'),
(28, 'Spencer', '', 'Login', '2023-04-21 14:10:00'),
(29, 'Jonabelle', '', 'Login', '2023-04-21 14:15:16'),
(30, 'Jonabelle', '', 'Login', '2023-04-22 07:06:33'),
(31, 'Spencer', '', 'Login', '2023-04-22 19:13:18'),
(32, 'Spencer', '', 'Login', '2023-04-23 09:38:32'),
(33, 'Spencer', '', 'Login', '2023-04-23 14:33:53'),
(34, 'Spencer', '', 'Login', '2023-04-24 08:28:37'),
(35, 'Jonabelle', '', 'Login', '2023-04-24 09:00:36'),
(36, 'Spencer', '', 'Login', '2023-04-24 09:38:22'),
(37, 'Spencer', '', 'Login', '2023-04-24 16:49:51'),
(38, 'Spencer', '', 'Login', '2023-04-24 19:45:51'),
(39, 'Sample', '', 'Login', '2023-04-24 21:18:29'),
(40, 'Sample', '', 'Login', '2023-04-24 21:21:29'),
(41, 'Sample', '', 'Login', '2023-04-24 21:27:59'),
(42, 'Carl Justine', '', 'Login', '2023-04-24 22:43:04'),
(43, 'Sample', '', 'Login', '2023-04-25 11:34:06'),
(44, 'Sample', '', 'Login', '2023-04-25 11:38:00'),
(45, 'Spencer', '', 'Login', '2023-04-25 11:55:33'),
(46, 'Christine Laarni', '', 'Login', '2023-04-25 17:02:52'),
(47, 'Spencer', '', 'Login', '2023-04-25 19:18:05'),
(48, 'Sample', '', 'Login', '2023-04-25 19:24:08'),
(49, 'Carl Justine', '', 'Login', '2023-04-25 21:10:55'),
(50, 'Carl Justine', '', 'Login', '2023-04-25 21:14:15'),
(51, 'Christine Laarni', '', 'Login', '2023-04-25 21:38:03'),
(52, 'Spencer', '', 'Login', '2023-05-10 11:54:55'),
(53, 'Spencer', '', 'Login', '2023-05-10 12:06:47'),
(54, 'Spencer', '', 'Login', '2023-05-10 17:49:02'),
(55, 'Spencer', '', 'Login', '2023-05-10 19:46:02'),
(56, 'Jonabelle', '', 'Login', '2023-05-10 22:22:38'),
(57, 'Stephanie', '', 'Login', '2023-05-10 22:24:14'),
(58, 'Spencer', '', 'Login', '2023-05-11 10:57:32'),
(59, 'Spencer', '', 'Login', '2023-05-11 11:42:19'),
(60, 'Spencer', '', 'Login', '2023-05-11 19:15:44'),
(61, 'Spencer', '', 'Login', '2023-05-11 21:52:50'),
(62, 'Spencer', '', 'Login', '2023-05-11 22:06:16'),
(63, 'Jonabelle', '', 'Login', '2023-05-11 22:08:05'),
(64, 'Jonabelle', '', 'Login', '2023-05-12 06:58:37'),
(65, 'Spencer', '', 'Login', '2023-05-12 06:58:56'),
(66, 'Sample', '', 'Login', '2023-05-12 11:39:18'),
(67, 'Sample', '', 'Login', '2023-05-12 11:42:39'),
(68, 'Test', '', 'Login', '2023-05-12 13:50:51'),
(69, 'Sample', '', 'Login', '2023-05-13 13:59:47'),
(70, 'Test', '', 'Login', '2023-05-13 14:13:33'),
(71, 'Spencer', '', 'Login', '2023-05-13 14:15:47'),
(72, 'Spencer', '', 'Login', '2023-05-13 15:18:14'),
(73, 'Jonabelle', '', 'Login', '2023-05-13 16:08:46'),
(74, 'Jonabelle', '', 'Login', '2023-05-13 17:34:22'),
(75, 'Spencer', '', 'Login', '2023-05-13 19:23:54'),
(76, 'Spencer', '', 'Login', '2023-05-13 21:18:56'),
(77, 'Spencer', '', 'Login', '2023-05-13 21:38:47'),
(78, 'Spencer', '', 'Login', '2023-05-13 22:24:20'),
(79, 'Sample', '', 'Login', '2023-05-14 03:49:56'),
(80, 'Sample', '', 'Login', '2023-05-14 03:52:52'),
(81, 'Sample', '', 'Login', '2023-05-14 03:53:53'),
(82, 'Sample', '', 'Login', '2023-05-14 03:54:44'),
(83, 'Sample', '', 'Login', '2023-05-14 03:55:12'),
(84, 'Sample', '', 'Login', '2023-05-14 03:56:27'),
(85, 'Spencer', '', 'Login', '2023-05-14 04:07:22'),
(86, 'Spencer', '', 'Login', '2023-05-14 04:50:42'),
(87, 'Spencer', '', 'Login', '2023-05-14 05:27:23'),
(88, 'Spencer', '', 'Login', '2023-05-14 06:37:59'),
(89, 'Spencer', '', 'Login', '2023-05-14 08:58:55'),
(90, 'Spencer', '', 'Login', '2023-05-14 16:18:59'),
(91, 'Spencer', '', 'Login', '2023-05-14 16:20:08'),
(92, 'Spencer', '', 'Login', '2023-05-14 23:32:36'),
(93, 'Spencer', '', 'Login', '2023-05-15 00:01:04'),
(94, 'Jimmy', '', 'Login', '2023-05-15 00:47:23'),
(95, 'Christine Laarni', '', 'Login', '2023-05-15 01:10:41'),
(96, 'Stephanie', '', 'Login', '2023-05-15 01:12:11'),
(97, 'Jonabelle', '', 'Login', '2023-05-15 01:45:47'),
(98, 'Spencer', '', 'Login', '2023-05-15 07:59:21'),
(99, 'Spencer', '', 'Login', '2023-05-16 11:49:10'),
(100, 'Spencer', '', 'Login', '2023-05-18 12:29:14'),
(101, 'Spencer', '', 'Login', '2023-05-19 00:56:50'),
(102, 'Spencer', '', 'Login', '2023-05-19 01:02:26'),
(103, 'Stephanie', '', 'Login', '2023-05-19 06:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `sys_image`
--

CREATE TABLE `sys_image` (
  `ID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL DEFAULT '',
  `Status` int(2) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sys_image`
--

INSERT INTO `sys_image` (`ID`, `Image`, `Status`, `Date`) VALUES
(1, 'IMG-6443f2ddcd32c9.85764729.jpg', 1, '2023-04-22'),
(3, 'IMG-6443f7b50626f2.24887369.jpg', 1, '2023-04-22'),
(4, 'IMG-6443f7c67b6059.98737893.jpg', 1, '2023-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `sys_video`
--

CREATE TABLE `sys_video` (
  `ID` int(11) NOT NULL,
  `Video` varchar(255) NOT NULL DEFAULT '',
  `Status` int(2) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sys_video`
--

INSERT INTO `sys_video` (`ID`, `Video`, `Status`, `Date`) VALUES
(1, '2023-04-22.mp4', 0, '2023-04-22'),
(3, '2023-04-25.mp4', 1, '2023-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tb`
--

CREATE TABLE `teacher_tb` (
  `ID` int(11) NOT NULL,
  `Emp_ID` varchar(255) NOT NULL DEFAULT '',
  `Salutation` varchar(255) NOT NULL DEFAULT '',
  `Lastname` varchar(255) NOT NULL DEFAULT '',
  `Firstname` varchar(255) NOT NULL DEFAULT '',
  `Middlename` varchar(255) NOT NULL DEFAULT '',
  `Suffix` varchar(255) NOT NULL DEFAULT '',
  `DOB` date DEFAULT NULL,
  `Age` int(2) NOT NULL DEFAULT 0,
  `Gender` varchar(255) NOT NULL DEFAULT '',
  `Status` varchar(255) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `Nationality` varchar(255) NOT NULL DEFAULT '',
  `Contact` bigint(12) NOT NULL DEFAULT 0,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Department` varchar(255) NOT NULL DEFAULT '',
  `Picture` varchar(255) NOT NULL DEFAULT '',
  `QR_Code` varchar(255) NOT NULL DEFAULT '',
  `Date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_tb`
--

INSERT INTO `teacher_tb` (`ID`, `Emp_ID`, `Salutation`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `DOB`, `Age`, `Gender`, `Status`, `Address`, `Nationality`, `Contact`, `Email`, `Department`, `Picture`, `QR_Code`, `Date`) VALUES
(1, 'T-579921288473', 'Ms', 'Balleras', 'Jonabelle', 'Selga', '', '2001-06-22', 21, 'Female', 'Single', 'Brgy. San Roque, San Manuel Pangasinan', 'Filipino', 9383304572, 'jonabelle.balleras.22@gmail.com', 'ELDEPT', 'IMG-645d97b46955d1.42199093.png', 'T-579921288473.png', 'March 16, 2023 08:01 PM'),
(2, 'T-221395181552', 'Mr', 'De Juan', 'Jimmy', 'Reola', '', '2001-02-10', 22, 'Male', 'Single', 'Brgy. San Roque, San Manuel Pangasinan', 'Filipino', 9123456789, 'spencer.desamito.02@gmail.com', 'JHSDEPT', 'IMG-641306656c0635.36270252.png', 'T-221395181552.png', 'March 16, 2023 08:06 PM'),
(3, 'T-545540646382', 'Mr', 'Desamito', 'Spencer', 'Solis', '', '1999-12-02', 23, 'Male', 'Single', 'Brgy. San Roque, San Manuel Pangasinan', 'Filipino', 9514762574, 'spencer.desamito.19@gmail.com', 'SHSDEPT', 'IMG-645b8409e266b4.64317881.png', 'T-545540646382.png', 'March 16, 2023 08:07 PM'),
(4, 'T-075815128259', 'Ms', 'Balleras', 'Stephanie', 'Selga', '', '2002-12-12', 20, 'Female', 'Single', 'San Roque, San Manuel, Pangasinan', 'Filipino', 912345678, 'habibabe.babemahal082219@gmail.com', 'JHSDEPT', 'IMG-645bb885f09291.60523101.png', 'T-075815128259.png', 'March 17, 2023 10:01 AM'),
(5, 'T-00340', 'Mr ', 'Desamito', 'Carl Justine', 'Fernandez', '', '2007-06-01', 15, 'Male', 'Single', 'Rosario, Pozorrubio, Pangasinan', 'Filipino', 9514762574, 'da377288@gmail.com', 'ELDEPT', 'IMG-64609656185458.14148974.png', 'T-00340.png', 'May 14, 2023 04:04 PM');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(11) NOT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL,
  `days` varchar(15) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `time_start`, `time_end`, `days`) VALUES
(1, '08:00 AM', '09:00 AM', 'mtwthf'),
(2, '09:00 AM', '10:00 AM', 'mtwthf'),
(3, '10:00 AM', '11:00 AM', 'mtwthf'),
(4, '11:00 AM', '12:00 PM', 'mtwthf'),
(5, '1:00 PM', '2:00 PM', 'mtwthf'),
(6, '2:00 PM', '3:00 PM', 'mtwthf'),
(7, '3:00 PM', '4:00 PM', 'mtwthf'),
(8, '4:00 PM', '5:00 PM', 'mtwthf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL DEFAULT '',
  `Lastname` varchar(255) NOT NULL DEFAULT '',
  `Firstname` varchar(255) NOT NULL DEFAULT '',
  `Middlename` varchar(255) NOT NULL DEFAULT '',
  `Contact` varchar(13) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Password` varchar(255) NOT NULL DEFAULT '',
  `NPassword` varchar(255) NOT NULL DEFAULT '',
  `Access` varchar(255) NOT NULL DEFAULT '',
  `Otp` varchar(255) NOT NULL DEFAULT '',
  `AStatus` bigint(255) NOT NULL DEFAULT 0,
  `RDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Lastname`, `Firstname`, `Middlename`, `Contact`, `Email`, `Password`, `NPassword`, `Access`, `Otp`, `AStatus`, `RDate`) VALUES
(1, 'A0001', 'Desamito', 'Spencer', 'Solis', '09514762574', 'spencer.desamito.02@gmail.com', '$2y$10$twi2efV7Gru3sZwGBzHGv.vWroxNtdqA10Iuujvtsf1OceuijRtzG', '', 'Admin', '', 1, '2023-03-16 20:00:09'),
(2, 'T-579921288473', 'Balleras', 'Jonabelle', 'Selga', '09383304572', 'jonabelle.balleras.22@gmail.com', '$2y$10$5d22TQISbbaaGlpEHNB9T.7nmP7BmM0vdsocfrXh6oLym4Ajgby4i', '', 'Teacher', '', 1, '2023-03-16 20:04:00'),
(3, 'T-221395181552', 'De Juan', 'Jimmy', 'Reola', '09123456789', 'spencer.desamito.02@gmail.com', '$2y$10$5d22TQISbbaaGlpEHNB9T.7nmP7BmM0vdsocfrXh6oLym4Ajgby4i', '', 'Teacher', '', 1, '2023-03-16 20:07:01'),
(4, 'T-545540646382', 'Desamito', 'Spencer', 'Solis', '09514762574', 'spencer.desamito.19@gmail.com', '$2y$10$cv/pV9iaxY.Mlmg33ybL4u903YZM8GCnVQC7ddGnuRtkDAUoy1xmC', '', 'Teacher', '', 1, '2023-03-16 20:08:07'),
(5, 'T-075815128259', 'Balleras', 'Stephanie', 'Selga', '0912345678', 'habibabe.babemahal082219@gmail.com', '$2y$10$5d22TQISbbaaGlpEHNB9T.7nmP7BmM0vdsocfrXh6oLym4Ajgby4i', '', 'Teacher', '', 1, '2023-03-17 10:02:22'),
(8, 'F-57004563', 'Balleras', 'Jonabelle', 'Selga', '09123456789', 'spencer.desamito.02@gmail.com', '$2y$10$D7sL8hPULflyQClSoKFr0ur25Ld5vhPPOS6gn1hpHT041M9JJgbUG', '', 'Cashier', '', 1, '2023-03-21 08:54:55'),
(9, 'F-72821350', 'Balleras', 'Christine Laarni', 'Selga', '09123456789', 'hca100146@gmail.com', '$2y$10$JsnHWNjZBZ69pduUAJZlHeGQ8656P3qWztG1opKP4b/OgLBrDUy5y', '', 'Librarian', '', 1, '2023-03-21 10:58:13'),
(10, 'F-88472087', 'Desamito', 'Spencer', 'Solis', '09123456789', 'spencer.desamito.19@gmail.com', '$2y$10$JsnHWNjZBZ69pduUAJZlHeGQ8656P3qWztG1opKP4b/OgLBrDUy5y', '', 'Cashier', '', 1, '2023-03-25 10:08:41'),
(11, 'F-45380623', 'De Juan ', 'Jimmy', 'Reola', '09123456789', 'habibabe.babemahal082219@gmail.com', '$2y$10$gk29EuOBtKRfjCiESUmscO2XpedZ3vs9Gse3W.xOx5K1ACkJAZIgK', '', 'Counselor', '', 1, '2023-03-25 10:11:48'),
(12, 'F-34058091', 'Balleras', 'Stephanie', 'Selga', '09123456789', 'spencer.desamito.02@yahoo.com', '$2y$10$JsnHWNjZBZ69pduUAJZlHeGQ8656P3qWztG1opKP4b/OgLBrDUy5y', '', 'Nurse', '', 1, '2023-03-26 09:55:25'),
(13, 'T-00340', 'Desamito', 'Carl Justine', 'Fernandez', '09514762574', 'da377288@gmail.com', '$2y$10$WnYGranNxSg80.RtWIkppe6bKLzolAin14BESvnsLI0fsjfMbYJ3m', '', 'Teacher', '', 1, '2023-05-14 08:05:42'),
(14, 'F-854117', 'Desamito', 'Carl Justine', 'Fernandez', '0909090909', 'da377288@gmail.com', '$2y$10$id6THIU0T.7uUVuHmhddROuMfN0.kyRxCb1UyvEW03L8reTtxRu1G', '', 'Counselor', '', 1, '2023-05-14 08:21:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_list`
--
ALTER TABLE `academic_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `assignment_comments`
--
ALTER TABLE `assignment_comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `borrow_books`
--
ALTER TABLE `borrow_books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class_attendance`
--
ALTER TABLE `class_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clinic_appointments`
--
ALTER TABLE `clinic_appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clinic_record`
--
ALTER TABLE `clinic_record`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `disqualified_enrollment`
--
ALTER TABLE `disqualified_enrollment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evaluation_list`
--
ALTER TABLE `evaluation_list`
  ADD PRIMARY KEY (`Evaluation_ID`);

--
-- Indexes for table `ev_questionnaire`
--
ALTER TABLE `ev_questionnaire`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `group_member`
--
ALTER TABLE `group_member`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `guidance`
--
ALTER TABLE `guidance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `handle_student`
--
ALTER TABLE `handle_student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `health_record`
--
ALTER TABLE `health_record`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `joinclass`
--
ALTER TABLE `joinclass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `main_notification`
--
ALTER TABLE `main_notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `my_friends`
--
ALTER TABLE `my_friends`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notification_history`
--
ALTER TABLE `notification_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `online_chat`
--
ALTER TABLE `online_chat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patience_record`
--
ALTER TABLE `patience_record`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `queuing`
--
ALTER TABLE `queuing`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shs_grade`
--
ALTER TABLE `shs_grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff_tb`
--
ALTER TABLE `staff_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `std_account`
--
ALTER TABLE `std_account`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `std_assign`
--
ALTER TABLE `std_assign`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `std_attendance`
--
ALTER TABLE `std_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `std_grade`
--
ALTER TABLE `std_grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `std_quiz`
--
ALTER TABLE `std_quiz`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `strands`
--
ALTER TABLE `strands`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `str_staff_attendance`
--
ALTER TABLE `str_staff_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_bmi`
--
ALTER TABLE `student_bmi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_grade`
--
ALTER TABLE `student_grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sys_image`
--
ALTER TABLE `sys_image`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sys_video`
--
ALTER TABLE `sys_video`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teacher_tb`
--
ALTER TABLE `teacher_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_list`
--
ALTER TABLE `academic_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_comments`
--
ALTER TABLE `assignment_comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `borrow_books`
--
ALTER TABLE `borrow_books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_attendance`
--
ALTER TABLE `class_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clinic_appointments`
--
ALTER TABLE `clinic_appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clinic_record`
--
ALTER TABLE `clinic_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disqualified_enrollment`
--
ALTER TABLE `disqualified_enrollment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `evaluation_list`
--
ALTER TABLE `evaluation_list`
  MODIFY `Evaluation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ev_questionnaire`
--
ALTER TABLE `ev_questionnaire`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_member`
--
ALTER TABLE `group_member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guidance`
--
ALTER TABLE `guidance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `handle_student`
--
ALTER TABLE `handle_student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `health_record`
--
ALTER TABLE `health_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `joinclass`
--
ALTER TABLE `joinclass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_notification`
--
ALTER TABLE `main_notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `my_friends`
--
ALTER TABLE `my_friends`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notification_history`
--
ALTER TABLE `notification_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `online_chat`
--
ALTER TABLE `online_chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patience_record`
--
ALTER TABLE `patience_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `queuing`
--
ALTER TABLE `queuing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shs_grade`
--
ALTER TABLE `shs_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_tb`
--
ALTER TABLE `staff_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `std_account`
--
ALTER TABLE `std_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `std_assign`
--
ALTER TABLE `std_assign`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `std_attendance`
--
ALTER TABLE `std_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `std_grade`
--
ALTER TABLE `std_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `std_quiz`
--
ALTER TABLE `std_quiz`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `strands`
--
ALTER TABLE `strands`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `str_staff_attendance`
--
ALTER TABLE `str_staff_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_bmi`
--
ALTER TABLE `student_bmi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_grade`
--
ALTER TABLE `student_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `sys_image`
--
ALTER TABLE `sys_image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_video`
--
ALTER TABLE `sys_video`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_tb`
--
ALTER TABLE `teacher_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
