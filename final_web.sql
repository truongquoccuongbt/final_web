-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2017 at 06:07 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id_chapter` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_course` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `name_chapter` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id_chapter`, `id_course`, `name_chapter`) VALUES
('C0001', 'VN', 'Basics1'),
('C0002', 'VN', 'Alphabet1'),
('C0003', 'ENG', 'Cơ bản 1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_course` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `name_course` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_course`, `name_course`) VALUES
('ENG', 'English'),
('VN', 'Việt Nam');

-- --------------------------------------------------------

--
-- Table structure for table `learning`
--

CREATE TABLE `learning` (
  `id_user` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_course` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `learned_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `learning`
--

INSERT INTO `learning` (`id_user`, `id_course`, `learned_lesson`) VALUES
('quoccuong', 'VN', 'L0001'),
('trungtin', 'VN', 'L0001');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_chapter` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `content_lesson` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id_lesson`, `id_chapter`, `content_lesson`) VALUES
('L0001', 'C0001', 'Tôi, bạn, là, đàn ông, phụ nữ, người'),
('L0002', 'C0001', 'Anh ấy, cô ấy, táo, ăn, bánh mì'),
('L0003', 'C0002', 'Và, cái, con, một, cá, ca'),
('L0004', 'C0003', 'Man, woman, I, am, a, boy, girl'),
('L0005', 'C0003', 'He, is, she, an apple, and, eat');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `date` date NOT NULL,
  `id_user` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`date`, `id_user`, `score`) VALUES
('2017-04-25', 'quoccuong', 0),
('2017-04-25', 'trungtin', 100);

-- --------------------------------------------------------

--
-- Table structure for table `question_choices`
--

CREATE TABLE `question_choices` (
  `id_question_choice` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `content_question` text COLLATE utf8_vietnamese_ci NOT NULL,
  `choice_1` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `choice_2` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `choice_3` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `picture_1` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `picture_2` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `picture_3` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `answer` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `question_choices`
--

INSERT INTO `question_choices` (`id_question_choice`, `id_lesson`, `content_question`, `choice_1`, `choice_2`, `choice_3`, `picture_1`, `picture_2`, `picture_3`, `answer`) VALUES
('QC001', 'L0001', 'Select translation of Man', 'nước', 'người đàn ông', 'bé gái', 'none', 'none', 'none', '2'),
('QC002', 'L0001', 'Select translation of Woman', 'phụ nữ', 'bánh mì', 'nước ép', 'none', 'none', 'none', '1'),
('QC003', 'L0002', 'Select translation of Bread', 'bánh mì', 'nước ép', 'đứa trẻ', 'none', 'none', 'none', '1'),
('QC004', 'L0002', 'Select translation of Apple', 'cậu bé', 'người đàn ông', 'táo', 'none', 'none', 'none', '3'),
('QC005', 'L0003', 'Select translation of Fish', 'ô', 'cá', 'gà', 'none', 'none', 'none', '2'),
('QC006', 'L0003', 'Select translation of Chicken', 'cá', 'gà', 'ô', 'none', 'none', 'none', '2'),
('QC007', 'L0004', 'Chọn nghĩa của từ Phụ Nữ', 'wonman', 'apple', 'man', 'none', 'none', 'none', '1'),
('QC008', 'L0004', 'Chọn nghĩa của từ Cô Gái', 'apple', 'girl', 'woman', 'none', 'none', 'none', '2'),
('QC009', 'L0005', 'Chọn nghĩa của từ Táo', 'apple', 'woman', 'man', 'none', 'none', 'none', '1');

-- --------------------------------------------------------

--
-- Table structure for table `question_writes`
--

CREATE TABLE `question_writes` (
  `id_question_write` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `content_question` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `answer` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `question_writes`
--

INSERT INTO `question_writes` (`id_question_write`, `id_lesson`, `content_question`, `answer`) VALUES
('QW001', 'L0001', 'Tôi là người', 'I am a human'),
('QW002', 'L0001', 'Translate Woman', 'Phụ nữ'),
('QW003', 'L0001', 'Translate Man', 'Đàn ông'),
('QW004', 'L0002', 'Cô ấy là tôi', 'She is me'),
('QW005', 'L0002', 'Anh ấy là tôi', 'Hee is me'),
('QW006', 'L0002', 'Cô ấy ăn táo', 'She eats an apple'),
('QW007', 'L0003', 'Và', 'And'),
('QW008', 'L0003', 'Một', 'One'),
('QW009', 'L0004', 'A man, a woman', 'Một người đàn ông, một người phụ nữ'),
('QW010', 'L0004', 'I am a man', 'Tôi là người đàn ông'),
('QW011', 'L0005', 'I eat', 'Tôi ăn'),
('QW012', 'L0005', 'An apple', 'Một trái táo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_vietnamese_ci NOT NULL,
  `first_name` text COLLATE utf8_vietnamese_ci NOT NULL,
  `last_name` text COLLATE utf8_vietnamese_ci NOT NULL,
  `total_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `password`, `email`, `first_name`, `last_name`, `total_score`) VALUES
('admin', 'admin', 'abc@gmail.com', 'admin', 'admin', 0),
('quoccuong', 'cuong123', 'cuong123@gmail.com', 'Cường', 'Quốc', 50),
('trungtin', 'tin123', 'tin123@gmail.com', 'Tín', 'Trần', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `FK_chapter_courses` (`id_course`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`);

--
-- Indexes for table `learning`
--
ALTER TABLE `learning`
  ADD PRIMARY KEY (`id_user`,`id_course`),
  ADD KEY `FK_learning_course` (`id_course`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `FK_lessons_chapters` (`id_chapter`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`date`,`id_user`),
  ADD KEY `FK_progress_users` (`id_user`);

--
-- Indexes for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id_question_choice`),
  ADD KEY `FK_qschoises_lessons` (`id_lesson`);

--
-- Indexes for table `question_writes`
--
ALTER TABLE `question_writes`
  ADD PRIMARY KEY (`id_question_write`),
  ADD KEY `FK_qswrites_lessons` (`id_lesson`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `FK_chapter_courses` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`);

--
-- Constraints for table `learning`
--
ALTER TABLE `learning`
  ADD CONSTRAINT `FK_learning_course` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`),
  ADD CONSTRAINT `FK_learning_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `FK_lessons_chapters` FOREIGN KEY (`id_chapter`) REFERENCES `chapters` (`id_chapter`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `FK_progress_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD CONSTRAINT `FK_qschoises_lessons` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`);

--
-- Constraints for table `question_writes`
--
ALTER TABLE `question_writes`
  ADD CONSTRAINT `FK_qswrites_lessons` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
