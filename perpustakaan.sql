-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 10:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `cover` varchar(100) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `count`, `cover`, `file`, `users_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Jumanji', 'Petualangan', 10, '1.jpg', '1.pdf', 1, 2, '2024-01-01 14:17:45', '2024-01-02 15:04:05'),
(2, 'Prince Charles', 'History of Prince Charles', 20, '2.jpg', '2.pdf', 2, 4, '2024-01-02 19:59:25', '2024-01-02 20:26:14'),
(3, 'Tom & Jerry', 'Cartoon cat and mouse', 12, '3.jpg', '3.pdf', 3, 3, '2024-01-03 01:41:18', '2024-01-03 01:41:18'),
(4, 'Chucky', 'Horror chucky', 8, '4.jpg', '4.pdf', 3, 1, '2024-01-03 01:50:59', '2024-01-03 01:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Horror', 'Horror is a genre of literature, film, and television that is meant to scare, startle, shock, and even repulse audiences.', '2024-01-01 13:45:45', '2024-01-01 13:45:45'),
(2, 'Adventure', 'Books where the protagonist goes on an epic journey, either personally or geographically. Often the protagonist has a mission and faces many obstacles in his way.', '2024-01-01 14:14:59', '2024-01-01 14:14:59'),
(3, 'Cartoon', 'A pictorial parody utilizing caricature, satire, and usually humour.', '2024-01-01 14:15:52', '2024-01-01 14:15:52'),
(4, 'Biography', 'A biography is a nonfiction account of a real person\'s life written by someone else. Biographies may offer detailed accounts on people\'s lives, specific important experiences, the historical impact of someone, and more.', '2024-01-01 14:16:13', '2024-01-01 14:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$c0JxYKIxe6AxgzxqiFbJSu3IsN2bxTJIT/rhrIHn1dl1/f21TPy82', 'admin', '2024-01-01 13:02:04', '2024-01-01 13:02:04'),
(2, 'Jerry Livano', 'jerrylivano7@gmail.com', '$2y$12$wclZ8yhQSscqUy42lycAbeQoZjFjOtJ/ijNpTBf.SgZbRxKMP4HM2', 'user', '2024-01-01 14:02:32', '2024-01-01 14:02:32'),
(3, 'John Doe', 'johndoe@gmail.com', '$2y$12$lgxxJJCMIhb.FFmsuTAusO2hd0f19vTAJ5B0gCv2WSZrATqPARff6', 'user', '2024-01-02 21:47:06', '2024-01-02 21:47:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_book_users_idx` (`users_id`),
  ADD KEY `fk_book_category1_idx` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
