-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 04, 2017 lúc 09:07 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `final_web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chapters`
--

CREATE TABLE `chapters` (
  `id_chapter` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_course` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `name_chapter` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chapters`
--

INSERT INTO `chapters` (`id_chapter`, `id_course`, `name_chapter`) VALUES
('C0001', 'VN', 'Basics1'),
('C0002', 'VN', 'Alphabet1'),
('C0003', 'ENG', 'Cơ bản 1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id_course` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `name_course` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id_course`, `name_course`) VALUES
('ENG', 'English'),
('VN', 'Việt Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `learning`
--

CREATE TABLE `learning` (
  `id_user` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_course` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `learned_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `learning`
--

INSERT INTO `learning` (`id_user`, `id_course`, `learned_lesson`) VALUES
('quoccuong', 'VN', 'L0001'),
('trungtin', 'VN', 'L0001');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_chapter` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `content_lesson` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lessons`
--

INSERT INTO `lessons` (`id_lesson`, `id_chapter`, `content_lesson`) VALUES
('L0001', 'C0001', 'Tôi, bạn, là, đàn ông, phụ nữ, người'),
('L0002', 'C0001', 'Anh ấy, cô ấy, táo, ăn, bánh mì'),
('L0003', 'C0002', 'Và, cái, con, một, cá, ca'),
('L0004', 'C0003', 'Man, woman, I, am, a, boy, girl'),
('L0005', 'C0003', 'He, is, she, an apple, and, eat');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `progress`
--

CREATE TABLE `progress` (
  `date` date NOT NULL,
  `id_user` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `progress`
--

INSERT INTO `progress` (`date`, `id_user`, `score`) VALUES
('2017-04-25', 'quoccuong', 0),
('2017-04-25', 'trungtin', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question_choices`
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
-- Đang đổ dữ liệu cho bảng `question_choices`
--

INSERT INTO `question_choices` (`id_question_choice`, `id_lesson`, `content_question`, `choice_1`, `choice_2`, `choice_3`, `picture_1`, `picture_2`, `picture_3`, `answer`) VALUES
('QC001', 'L0001', 'Select translation of Man', 'nước', 'người đàn ông', 'bé gái', '../public/image/l1_q1_a1.PNG', '../public/image/l1_q1_a2.PNG\r\n', '../public/image/l1_q1_a3.PNG', '2'),
('QC002', 'L0001', 'Select translation of Woman', 'phụ nữ', 'bánh mì', 'nước ép', '../public/image/l1_q2_a1.PNG\r\n', '../public/image/l1_q2_a2.PNG\r\n', '../public/image/l1_q2_a3.PNG\r\n', '1'),
('QC003', 'L0002', 'Select translation of Bread', 'bánh mì', 'nước ép', 'đứa trẻ', '../public/image/l2_q1_a1.PNG', '../public/image/l2_q1_a2.PNG', '../public/image/l2_q1_a3.PNG', '1'),
('QC004', 'L0002', 'Select translation of Apple', 'cậu bé', 'người đàn ông', 'táo', '../public/image/l2_q2_a1.PNG\r\n', '../public/image/l2_q2_a2.PNG\r\n', '../public/image/l2_q2_a3.PNG', '3'),
('QC005', 'L0003', 'Select translation of Fish', 'ô', 'cá', 'gà', '../public/image/l3_q1_a1.PNG\r\n', '../public/image/l3_q1_a2.PNG\r\n', '../public/image/l3_q1_a3.PNG', '2'),
('QC006', 'L0003', 'Select translation of Chicken', 'cá', 'gà', 'ô', '../public/image/l3_q1_a2.PNG', '../public/image/l3_q1_a3.PNG', '../public/image/l3_q1_a1.PNG', '2'),
('QC007', 'L0004', 'Chọn nghĩa của từ Phụ Nữ', 'wonman', 'apple', 'man', '../public/image/l1_q2_a1.PNG', '../public/image/l2_q2_a3.PNG', '../public/image/l2_q2_a2.PNG', '1'),
('QC008', 'L0004', 'Chọn nghĩa của từ Cô Gái', 'apple', 'girl', 'woman', '../public/image/l2_q2_a3.PNG', '../public/image/l1_q1_a3.PNG', '../public/image/l1_q2_a1.PNG', '2'),
('QC009', 'L0005', 'Chọn nghĩa của từ Táo', 'apple', 'woman', 'man', '../public/image/l2_q2_a3.PNG', '../public/image/l1_q2_a1.PNG', '../public/image/l2_q2_a2.PNG', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question_writes`
--

CREATE TABLE `question_writes` (
  `id_question_write` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_lesson` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `content_question` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `answer` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `question_writes`
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
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `password`, `email`, `first_name`, `last_name`, `total_score`) VALUES
('admin', 'admin', 'abc@gmail.com', 'admin', 'admin', 0),
('quoccuong', 'cuong123', 'cuong123@gmail.com', 'Cường', 'Quốc', 50),
('trungtin', 'tin123', 'tin123@gmail.com', 'Tín', 'Trần', 100);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `FK_chapter_courses` (`id_course`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`);

--
-- Chỉ mục cho bảng `learning`
--
ALTER TABLE `learning`
  ADD PRIMARY KEY (`id_user`,`id_course`),
  ADD KEY `FK_learning_course` (`id_course`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `FK_lessons_chapters` (`id_chapter`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`date`,`id_user`),
  ADD KEY `FK_progress_users` (`id_user`);

--
-- Chỉ mục cho bảng `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id_question_choice`),
  ADD KEY `FK_qschoises_lessons` (`id_lesson`);

--
-- Chỉ mục cho bảng `question_writes`
--
ALTER TABLE `question_writes`
  ADD PRIMARY KEY (`id_question_write`),
  ADD KEY `FK_qswrites_lessons` (`id_lesson`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `FK_chapter_courses` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`);

--
-- Các ràng buộc cho bảng `learning`
--
ALTER TABLE `learning`
  ADD CONSTRAINT `FK_learning_course` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`),
  ADD CONSTRAINT `FK_learning_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `FK_lessons_chapters` FOREIGN KEY (`id_chapter`) REFERENCES `chapters` (`id_chapter`);

--
-- Các ràng buộc cho bảng `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `FK_progress_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `question_choices`
--
ALTER TABLE `question_choices`
  ADD CONSTRAINT `FK_qschoises_lessons` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`);

--
-- Các ràng buộc cho bảng `question_writes`
--
ALTER TABLE `question_writes`
  ADD CONSTRAINT `FK_qswrites_lessons` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
