-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 05:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actinology_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `actinology_center`
--

CREATE TABLE `actinology_center` (
  `name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actinology_center`
--

INSERT INTO `actinology_center` (`name`, `last_name`, `email`, `password`) VALUES
('ntinos', 'xikis', 'ntinos@gmail.com', '$2y$10$kCj3OoOsdSK78RoIBXsS4u0.lXoH/pYy8fp1JMf02VZmoCr.EUurG');

-- --------------------------------------------------------

--
-- Table structure for table `actinology_requests`
--

CREATE TABLE `actinology_requests` (
  `id` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `priority` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `examination` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `suggested_date` date NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `patient_ssn` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `doctor` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `approval` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actinology_requests`
--

INSERT INTO `actinology_requests` (`id`, `priority`, `date_sent`, `examination`, `suggested_date`, `description`, `patient_ssn`, `doctor`, `approval`) VALUES
('ex1478962484', 'low', '2020-05-05 03:59:24', '1', '2020-05-23', 'dafa', '4545454', 'kati@gmail.com', 1),
('ex3532870249', 'low', '2020-05-16 05:12:00', 'MRI', '2020-05-21', 'kostakis', '12345', 'kostaschikis@gmail.com', 0),
('ex4653652368', 'high', '2020-05-04 09:36:04', '5', '2020-05-10', 'Critical', '9587575', 'kostaschikis@gmail.com', 1),
('ex5970300166', 'high', '2020-05-04 09:18:36', '2', '2020-05-14', 'lol', '12345', 'kostaschikis@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `request_id` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `priority` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `exam_date` datetime NOT NULL,
  `radiologist` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `patient_ssn` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `comments` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `request_id`, `priority`, `exam_date`, `radiologist`, `patient_ssn`, `comments`, `completed`) VALUES
('ap2950363361', 'ex1478962484', 'low', '2020-05-15 19:30:53', 'actino2@lab', '4545454', 'ds', 1),
('ap9371693614', 'ex4653652368', 'high', '2020-05-21 12:05:00', 'actino1@lab', '9587575', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut accumsan mi. Suspendisse ultrices augue sed nibh rutrum, in volutpat elit interdum. Integer quis cursus eros, sed maximus arcu. Etiam.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`name`, `last_name`, `email`, `password`) VALUES
('ty', 'ty', 'kati@gmail.com', '$2y$10$CV59od1RUq0U8tkWs4k/dOfiEK81Lukd7zDhA2Wfv.iKFRYMv8SGS'),
('kostas', 'xikis', 'kostaschikis@gmail.com', '$2y$10$xj/5QI3HxV7JicZS0G3or.1JpXYqfB0Kcw78z9PRDUFDAwYROGf6q');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ssn` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `lastname` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `father_name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `mother_name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `insurance_id` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `birth_date` date NOT NULL,
  `home_address` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `home_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exams` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ssn`, `name`, `lastname`, `father_name`, `mother_name`, `insurance_id`, `gender`, `birth_date`, `home_address`, `home_number`, `work_number`, `mobile_number`, `exams`) VALUES
('12345', 'Kostas', 'Chikimtzis', 'rt', 'rt', 'yyy6', 'male', '2020-01-06', 'fdfds', '342423432', '+30 6985916881', '423432452', NULL),
('3141414', 'maria', 'ty', 'bill', 'maria', 'ext566434', 'Female', '1976-05-21', 'Sintagmatarxou Dabaki 62', '6262', '626262', '626262', NULL),
('4545454', 'ui', 'uitr', 'bill', 'maria', 'ext556573', 'Male', '1998-05-21', 'Sintagmatarxou Dabaki 62', '2105316991', '+30 6943728735', '+30 6943728735', NULL),
('67890', 'George', 'Giamouridis', 'gh', 'gh', 'uuu6', 'female', '2020-03-22', 'gfdgfd', '532534', '+30 6983945881', '5245234', NULL),
('9587575', 'Basilis', 'Kafanelis', 'maria', 'nikos', 'ext5323232', 'Male', '1998-05-31', 'SKG', '+30 6943728735', '+30 6943728735', '+30 6943728735', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `radiologist`
--

CREATE TABLE `radiologist` (
  `name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `appointments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radiologist`
--

INSERT INTO `radiologist` (`name`, `last_name`, `email`, `password`, `appointments`) VALUES
('actino1', 'actino1', 'actino1@lab', '$2y$10$4uoIDxvIqA029/0Kn3RXu.w9ufi9PTJi71TlSCXZCX8jlyrfzZ3Jm', '[\"ap9371693614\"]'),
('actino2', 'actino2', 'actino2@lab', '$2y$10$4uoIDxvIqA029/0Kn3RXu.w9ufi9PTJi71TlSCXZCX8jlyrfzZ3Jm', '[]'),
('actino3', 'actino3lol', 'actino3@lab.com', '$2y$10$4uoIDxvIqA029/0Kn3RXu.w9ufi9PTJi71TlSCXZCX8jlyrfzZ3Jm', '[]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actinology_center`
--
ALTER TABLE `actinology_center`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `actinology_requests`
--
ALTER TABLE `actinology_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_fk` (`doctor`),
  ADD KEY `patient_req_fk` (`patient_ssn`) USING BTREE;

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actinologist_fk` (`radiologist`),
  ADD KEY `patient_app_fk` (`patient_ssn`) USING BTREE,
  ADD KEY `request_id_fk` (`request_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `radiologist`
--
ALTER TABLE `radiologist`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actinology_requests`
--
ALTER TABLE `actinology_requests`
  ADD CONSTRAINT `doctor_fk` FOREIGN KEY (`doctor`) REFERENCES `doctor` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_fk` FOREIGN KEY (`patient_ssn`) REFERENCES `patient` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `actinologist_fk` FOREIGN KEY (`radiologist`) REFERENCES `radiologist` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ssn_fk` FOREIGN KEY (`patient_ssn`) REFERENCES `patient` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `actinology_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
