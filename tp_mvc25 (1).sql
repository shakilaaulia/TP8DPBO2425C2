-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 05:52 PM
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
-- Database: `tp_mvc25`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credit` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_code`, `course_name`, `credit`, `semester`, `lecturer_id`, `description`) VALUES
(2, 'CS101', 'Algoritma dan Struktur Data', 3, 1, 101, 'Mempelajari dasar-dasar algoritma searching, sorting, dan struktur data linear.'),
(3, 'CS202', 'Jaringan Komputer Lanjut', 4, 3, 103, 'Fokus pada routing, protokol TCP/IP, dan keamanan jaringan.'),
(4, 'CS301', 'Pemrograman Berorientasi Objek', 3, 2, 102, 'Konsep OOP (Encapsulation, Inheritance, Polymorphism) dengan Java/Python.'),
(5, 'IS405', 'Sistem Basis Data', 3, 4, 104, 'Mencakup perancangan basis data relasional, normalisasi, dan SQL tingkat lanjut.'),
(6, 'CS208', 'Pengantar Kecerdasan Buatan', 3, 5, 102, 'Mengenal konsep dasar AI, machine learning, dan neural network.'),
(7, 'EL110', 'Dasar Elektronika Digital', 3, 1, 101, 'Analisis sirkuit digital dan implementasi logika Boolean.');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `nidn`, `phone`, `join_date`) VALUES
(101, 'Dr. Budi Santoso, M.Kom.', '0012345601', '081123456789', '2015-08-17'),
(102, 'Prof. Lina Wijaya, Ph.D.', '0098765402', '081298765432', '2005-01-10'),
(103, 'Ahmad Fikri, S.T., M.Eng.', '0033445503', '087855443322', '2020-09-01'),
(104, 'Dewi Kartika, M.Sc.', '0067891004', '089911223344', '2018-02-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
