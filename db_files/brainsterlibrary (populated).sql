-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 11:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainsterlibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(48) NOT NULL,
  `about` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `about`, `is_deleted`, `created_at`) VALUES
(1, 'J. K.', 'Rowling', 'Joanne Rowling (born 31 July 1965), better known by her pen name J. K. Rowling, is a British author and philanthropist. She wrote Harry Potter, a seven-volume fantasy series published from 1997 to 2007. ', 0, '2023-11-28 23:33:03'),
(2, 'George', 'R. R. Martin', 'George Raymond Richard Martin (born September 20, 1948), also known as GRRM, 	is an American novelist, screenwriter, television producer and short story writer. He is the author of Game of Thrones.', 0, '2023-11-29 00:14:29'),
(3, 'Alison', 'Gaylin', 'Alison Gaylin is the author of the Edgar-nominated thriller Hide Your Eyes and its sequel You Kill Me, the stand-alone Edgar-nominated What Remains of Me, and the Brenna Spector series: And She Was (winner of the Shamus Award), Into the Dark, and the Edgar-nominated Stay With Me. A graduate of Northwestern University and Columbia University\'s Graduate School of Journalism, she lives with her husband and daughter in Woodstock, New York.', 0, '2023-11-29 00:29:25'),
(4, 'Anne', 'Frank', 'Anne Frank, a Jew of Germany, fled from Nazis to Amsterdam in 1934 and kept a diary during her years in hiding from 1942 until people captured her family in August 1944 and sent to concentration camps, where she died of typhus at Belsen; survivors published her posthumously in 1947.', 0, '2023-11-29 12:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `existing_author_id` int(10) UNSIGNED DEFAULT NULL,
  `category` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `published` year(4) NOT NULL,
  `pages` smallint(5) UNSIGNED NOT NULL,
  `cover_image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `code` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `existing_author_id`, `category`, `title`, `published`, `pages`, `cover_image`, `created_at`, `code`) VALUES
(1, 1, 4, 'Harry Potter and the Philosopher\'s Stone', '1997', 223, 'https://upload.wikimedia.org/wikipedia/en/6/6b/Harry_Potter_and_the_Philosopher%27s_Stone_Book_Cover.jpg', '2023-11-28 23:35:43', 'h9Tp6M'),
(2, 1, 4, 'Harry Potter and the Chamber of Secrets', '1998', 251, 'https://upload.wikimedia.org/wikipedia/en/5/5c/Harry_Potter_and_the_Chamber_of_Secrets.jpg', '2023-11-28 23:43:37', 'f9Yl1M'),
(3, 1, 4, 'Harry Potter and the Prisoner of Azkaban', '1999', 317, 'https://upload.wikimedia.org/wikipedia/en/a/a0/Harry_Potter_and_the_Prisoner_of_Azkaban.jpg', '2023-11-28 23:44:40', 'h5Vq4K'),
(4, 1, 4, 'Harry Potter and the Goblet of Fire', '2000', 636, 'https://upload.wikimedia.org/wikipedia/en/b/b6/Harry_Potter_and_the_Goblet_of_Fire_cover.png', '2023-11-28 23:53:23', 'r9Oq3G'),
(5, 1, 4, 'Harry Potter and the Order of the Phoenix', '2003', 766, 'https://upload.wikimedia.org/wikipedia/en/7/70/Harry_Potter_and_the_Order_of_the_Phoenix.jpg', '2023-11-28 23:54:09', 'q8Zx2Y'),
(6, 1, 4, 'Harry Potter and the Half-Blood Prince', '2005', 607, 'https://upload.wikimedia.org/wikipedia/en/thumb/b/b5/Harry_Potter_and_the_Half-Blood_Prince_cover.png/220px-Harry_Potter_and_the_Half-Blood_Prince_cover.png', '2023-11-28 23:54:55', 'g4Cr0T'),
(7, 1, 4, 'Harry Potter and the Deathly Hallows', '2007', 607, 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a9/Harry_Potter_and_the_Deathly_Hallows.jpg/220px-Harry_Potter_and_the_Deathly_Hallows.jpg', '2023-11-28 23:55:29', 'y8Ti0U'),
(8, 2, 6, 'Game of Thrones', '1996', 694, 'https://upload.wikimedia.org/wikipedia/en/9/93/AGameOfThrones.jpg', '2023-11-29 00:16:35', 'g5Zq8D'),
(9, 2, 6, 'Clash of Kings', '1998', 761, 'https://upload.wikimedia.org/wikipedia/en/3/39/AClashOfKings.jpg', '2023-11-29 00:17:52', 'x9Ue8G'),
(10, 2, 6, 'Storm of Swords', '2000', 973, 'https://upload.wikimedia.org/wikipedia/en/2/24/AStormOfSwords.jpg', '2023-11-29 00:18:44', 'c9Tc6A'),
(11, 2, 4, 'Feast for Crows', '2005', 753, 'https://upload.wikimedia.org/wikipedia/en/a/a3/AFeastForCrows.jpg', '2023-11-29 00:20:02', 'a4Cy6M'),
(12, 2, 4, 'Dance with Dragons', '2011', 1016, 'https://upload.wikimedia.org/wikipedia/en/5/5d/A_Dance_With_Dragons_US.jpg', '2023-11-29 00:20:57', 't0Qu9B'),
(14, 3, 3, 'The Collective', '2021', 352, 'https://images-us.bookshop.org/ingram/9780063083158.jpg?height=500&v=v2', '2023-11-29 12:17:04', 'v2Am7G'),
(15, 4, 7, 'The Diary of a Young Girl', '1947', 283, 'https://upload.wikimedia.org/wikipedia/en/thumb/4/47/Het_Achterhuis_%28Diary_of_Anne_Frank%29_-_front_cover%2C_first_edition.jpg/220px-Het_Achterhuis_%28Diary_of_Anne_Frank%29_-_front_cover%2C_first_edition.jpg', '2023-11-29 12:49:39', 'v8Ii8K');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `is_deleted`, `created_at`) VALUES
(1, 'adventure stories', 0, '2023-11-28 23:29:23'),
(2, 'classics', 0, '2023-11-28 23:29:41'),
(3, 'crime', 0, '2023-11-28 23:29:57'),
(4, 'fantasy', 0, '2023-11-28 23:30:08'),
(5, 'historical', 0, '2023-11-28 23:30:20'),
(6, 'epic fantasy', 0, '2023-11-29 00:15:22'),
(7, 'autobiography', 0, '2023-11-29 12:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `existing_user_id` int(10) UNSIGNED DEFAULT NULL,
  `commented_on_book` int(10) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `is_approved` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `existing_user_id`, `commented_on_book`, `comment`, `is_approved`, `created_at`) VALUES
(1, 2, 1, 'Comment for Philosopher\'s Stone, first book of Harry Potter', 1, '2023-11-29 12:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `existing_user_id` int(10) UNSIGNED DEFAULT NULL,
  `note_on_book` int(10) UNSIGNED DEFAULT NULL,
  `note_text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `existing_user_id`, `note_on_book`, `note_text`, `created_at`) VALUES
(1, 2, 14, 'Note for The Collective book from author Alison Gaylin', '2023-11-29 12:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(244) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `is_admin`, `created_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$KZUB10rqBaQqNHXrMRrFiujeRSEpAuos1ZuJC2FDZkFOsqXCKgzb.', 1, '2023-11-24 20:41:08'),
(2, 'Stamko Boshkov', 'stamenco@gmail.com', '$2a$12$n6X0nkjTq3rZk/nG/kxoYeAdkk.HDllN0wEgryHVL..8diypZogHe', 0, '2023-11-23 00:24:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `existing_author_id` (`existing_author_id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `existing_user_id` (`existing_user_id`),
  ADD KEY `commented_on_book` (`commented_on_book`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `existing_user_id` (`existing_user_id`),
  ADD KEY `note_on_book` (`note_on_book`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`existing_author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`existing_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`commented_on_book`) REFERENCES `books` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`existing_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`note_on_book`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
