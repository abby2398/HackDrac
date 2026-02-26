-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2026 at 07:53 AM
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
-- Database: `hackdrac`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_queries`
--

CREATE TABLE `contact_queries` (
  `id` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Message` varchar(10000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_queries`
--

INSERT INTO `contact_queries` (`id`, `Name`, `Email`, `Message`, `created_at`) VALUES
(582, 'admin', 'admin@hackdrac', 'just for testing.', '2025-03-24 05:22:17'),
(714, 'user1', 'user1@gmail.com', 'unable to change my password', '2025-03-24 05:22:13'),
(717, 'test', 'test@test.com', 'unable to register my account', '2024-10-21 10:32:04'),
(719, 'fdh', 'ef@g.com', 'fknwefn', '2026-02-12 12:30:52'),
(720, 'dwede', 'dede@yopmail.com', 'dede', '2026-02-13 09:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `message_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`message_id`, `message`, `created_at`, `user_id`) VALUES
(1, 'My first note.\r\nLets try to change the note of another user by IDOR vulnerability.', '2024-10-21 15:31:32', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_images`
--

CREATE TABLE `uploaded_images` (
  `image_id` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_images`
--

INSERT INTO `uploaded_images` (`image_id`, `image_path`) VALUES
(3, 'images/uploads/650e7f08dc80a_download.jpg'),
(4, 'images/uploads/650e7f0f6bc08_download (1).jpg'),
(5, 'images/uploads/650e7f1bcf5ad_download (2).jpg'),
(6, 'images/uploads/650e7f204b3cb_download (3).jpg'),
(7, 'images/uploads/650e7f3f6bdd5_download (4).jpg'),
(8, 'images/uploads/650e7f4419558_download (5).jpg'),
(9, 'images/uploads/650e7f47ae84f_download (6).jpg'),
(26, 'images/uploads/65437ff603ce6_matt_balck_lamborghini-1920x1080.jpg'),
(27, 'images/uploads/65438e8da3e8b_new xs.svg'),
(28, 'images/uploads/65705688316b5_IMG_4244.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `ProfileImage` varchar(255) DEFAULT 'images/default.jpg',
  `session_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `Password`, `ProfileImage`, `session_id`, `email`) VALUES
(1, 'admin', 'admin123', 'images/uploads/gear-and-the-word-admin-3d-illustration-R5YAEG.jpg', '7pnkdvnohqg17ldj262b620a7e', 'admin@hackdrac.com'),
(2, 'user1', 'user1', 'images/uploads/gear-and-the-word-admin-3d-illustration-R5YAEG.jpg', 'mlpd3ctfurh74lt1n64ok5kv3v', 'user1@gmail.com'),
(3, NULL, 'hackdrac', 'images/default.jpg', NULL, 'hackdrac@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `request_method` varchar(10) DEFAULT NULL,
  `request_uri` text DEFAULT NULL,
  `query_string` text DEFAULT NULL,
  `post_data` longtext DEFAULT NULL,
  `referrer` text DEFAULT NULL,
  `suspicious_flag` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `country`, `city`, `user_agent`, `request_method`, `request_uri`, `query_string`, `post_data`, `referrer`, `suspicious_flag`, `created_at`) VALUES
(1, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/registration.php', '', '[]', '', 0, '2026-02-12 18:00:48'),
(2, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'POST', '/contact.php', '', '{\"name\":\"fdh\",\"email\":\"ef@g.com\",\"message\":\"fknwefn\",\"submit\":\"submit\"}', 'http://localhost/contact.php', 0, '2026-02-12 18:00:52'),
(3, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '[]', 'http://localhost/thank_you.php', 0, '2026-02-12 18:00:54'),
(4, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:01:55'),
(5, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:02:54'),
(6, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:04:16'),
(7, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:04:18'),
(8, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/admin.php', '', '[]', 'http://localhost/registration.php', 0, '2026-02-12 18:04:21'),
(9, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/admin.php', '', '[]', 'http://localhost/registration.php', 0, '2026-02-12 18:04:21'),
(10, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/admin.php', '', '[]', 'http://localhost/registration.php', 0, '2026-02-12 18:04:21'),
(11, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/admin.php', '', '[]', 'http://localhost/registration.php', 0, '2026-02-12 18:04:21'),
(12, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:04:32'),
(13, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:04:47'),
(14, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:04:56'),
(15, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:05:07'),
(16, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:05:23'),
(17, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:05:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_queries`
--
ALTER TABLE `contact_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `uploaded_images`
--
ALTER TABLE `uploaded_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ip` (`ip_address`),
  ADD KEY `idx_suspicious` (`suspicious_flag`),
  ADD KEY `idx_created` (`created_at`),
  ADD KEY `idx_country` (`country`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_queries`
--
ALTER TABLE `contact_queries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=721;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uploaded_images`
--
ALTER TABLE `uploaded_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
