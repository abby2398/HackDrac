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
-- Database: `hackdrac_logs`
--

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
  `created_at` datetime DEFAULT current_timestamp(),
  `honeypot_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `country`, `city`, `user_agent`, `request_method`, `request_uri`, `query_string`, `post_data`, `referrer`, `suspicious_flag`, `created_at`, `honeypot_flag`) VALUES
(1, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'POST', '/contact.php', '', '{\"name\":\"fdh\",\"email\":\"ef@g.com\",\"message\":\"fknwefn\",\"submit\":\"submit\"}', 'http://localhost/contact.php', 0, '2026-02-12 17:43:57', 0),
(2, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 17:51:05', 0),
(3, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 17:51:10', 0),
(4, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:03:05', 0),
(5, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:03:13', 0),
(6, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:03:18', 0),
(7, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:03:18', 0),
(8, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', '', 0, '2026-02-12 18:03:30', 0),
(9, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:03:46', 0),
(10, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:06:02', 0),
(11, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:06:18', 0),
(12, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:06:33', 0),
(13, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:06:49', 0),
(14, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:07:05', 0),
(15, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:07:21', 0),
(16, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:07:37', 0),
(17, '::1', 'INDIA', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:07:53', 0),
(18, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:08:09', 0),
(19, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:08:25', 0),
(20, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:08:41', 0),
(21, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:08:57', 0),
(22, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:09:13', 0),
(23, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:09:29', 0),
(24, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:09:45', 0),
(25, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:10:01', 0),
(26, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:10:17', 0),
(27, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:10:33', 0),
(28, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:10:49', 0),
(29, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:11:05', 0),
(30, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:11:21', 0),
(31, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:11:37', 0),
(32, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:11:53', 0),
(33, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:12:09', 0),
(34, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:12:25', 0),
(35, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:12:41', 0),
(36, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:12:57', 0),
(37, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:13:13', 0),
(38, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:13:29', 0),
(39, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:13:45', 0),
(40, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:14:01', 0),
(41, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:14:17', 0),
(42, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:14:33', 0),
(43, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:14:49', 0),
(44, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:15:05', 0),
(45, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:15:21', 0),
(46, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:15:37', 0),
(47, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:15:53', 0),
(48, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:16:09', 0),
(49, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:16:25', 0),
(50, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:16:41', 0),
(51, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:16:57', 0),
(52, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:17:13', 0),
(53, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:17:29', 0),
(54, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:17:45', 0),
(55, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:18:01', 0),
(56, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:18:17', 0),
(57, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:18:33', 0),
(58, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:18:49', 0),
(59, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:19:05', 0),
(60, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:19:21', 0),
(61, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:19:37', 0),
(62, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:19:53', 0),
(63, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:20:09', 0),
(64, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:20:25', 0),
(65, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:20:41', 0),
(66, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:20:57', 0),
(67, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:21:13', 0),
(68, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:21:29', 0),
(69, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:21:45', 0),
(70, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:22:01', 0),
(71, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:22:17', 0),
(72, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:22:33', 0),
(73, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:22:49', 0),
(74, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:23:05', 0),
(75, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:23:21', 0),
(76, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:23:37', 0),
(77, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:23:53', 0),
(78, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:24:09', 0),
(79, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:24:25', 0),
(80, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:24:41', 0),
(81, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:24:57', 0),
(82, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:25:13', 0),
(83, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:25:29', 0),
(84, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:25:45', 0),
(85, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:26:01', 0),
(86, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:26:17', 0),
(87, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:26:33', 0),
(88, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:26:49', 0),
(89, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:27:05', 0),
(90, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:27:20', 0),
(91, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:27:36', 0),
(92, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:27:52', 0),
(93, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:28:08', 0),
(94, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:28:24', 0),
(95, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:28:40', 0),
(96, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:28:56', 0),
(97, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:29:12', 0),
(98, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:29:28', 0),
(99, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:29:44', 0),
(100, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:30:00', 0),
(101, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:30:16', 0),
(102, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:30:24', 0),
(103, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:30:39', 0),
(104, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-12 18:30:42', 0),
(105, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:53:36', 0),
(106, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:55:23', 0),
(107, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '[]', '', 0, '2026-02-13 14:55:26', 0),
(108, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '[]', 'http://localhost/', 0, '2026-02-13 14:55:29', 0),
(109, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/about.php', '', '[]', 'http://localhost/contact.php', 0, '2026-02-13 14:55:29', 0),
(110, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '[]', 'http://localhost/about.php', 0, '2026-02-13 14:55:30', 0),
(111, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:55:32', 0),
(112, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'POST', '/contact.php', '', '{\"name\":\"dwede\",\"email\":\"dede@yopmail.com\",\"message\":\"dede\",\"submit\":\"submit\"}', 'http://localhost/contact.php', 0, '2026-02-13 14:55:40', 0),
(113, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/thank_you.php', '', '[]', 'http://localhost/contact.php', 0, '2026-02-13 14:55:40', 0),
(114, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '[]', 'http://localhost/thank_you.php', 0, '2026-02-13 14:55:41', 0),
(115, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:55:43', 0),
(116, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php?q=12121', 'q=12121', '[]', '', 0, '2026-02-13 14:55:54', 0),
(117, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:55:57', 0),
(118, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:59:05', 0),
(119, '172.30.61.149', 'India', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '[]', '', 1, '2026-02-13 14:59:08', 0),
(120, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '[]', '', 0, '2026-02-13 14:59:13', 0),
(121, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '[]', 'http://127.0.0.1/', 0, '2026-02-13 14:59:15', 0),
(122, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/index.php', '', '[]', 'http://127.0.0.1/contact.php', 0, '2026-02-13 14:59:15', 0),
(123, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/about.php', '', '[]', 'http://127.0.0.1/index.php', 0, '2026-02-13 14:59:16', 0),
(124, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 14:59:18', 0),
(125, '172.30.61.149', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '[]', '', 1, '2026-02-13 14:59:19', 0),
(126, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '[]', '', 0, '2026-02-13 15:04:13', 0),
(127, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '[]', 'http://localhost/', 0, '2026-02-13 15:04:15', 0),
(128, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/about.php', '', '[]', 'http://localhost/contact.php', 0, '2026-02-13 15:04:16', 0),
(129, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/admin.php', 0, '2026-02-13 15:09:00', 0),
(130, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=', 'country=Unknown&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-13 15:09:08', 0),
(131, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=1', 'country=Unknown&suspicious=1', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=', 0, '2026-02-13 15:09:11', 0),
(132, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=1', 'country=Unknown&suspicious=1', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=', 0, '2026-02-13 15:16:11', 0),
(133, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=1', 0, '2026-02-13 15:16:19', 0),
(134, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=1', 0, '2026-02-13 15:17:12', 0),
(135, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=Unknown&suspicious=1', 0, '2026-02-13 15:18:23', 0),
(136, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 'country=INDIA&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-13 15:18:26', 0),
(137, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 'country=INDIA&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php', 0, '2026-02-13 15:22:04', 0),
(138, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 15:22:10', 0),
(139, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 15:22:55', 0),
(140, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 16:58:40', 0),
(141, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:01:11', 0),
(142, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:09:16', 0),
(143, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:09:49', 0),
(144, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:10:03', 0),
(145, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:11:27', 0),
(146, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:13:00', 0),
(147, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?country=&suspicious=', 'country=&suspicious=', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=INDIA&suspicious=', 0, '2026-02-13 17:15:04', 0),
(148, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php?suspicious=1', 'suspicious=1', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?country=&suspicious=', 0, '2026-02-13 17:15:07', 0),
(149, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '[]', 'http://localhost/admin/SOC_admin_Dashboard.php?suspicious=1', 0, '2026-02-13 17:15:13', 0),
(150, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '[]', '', 0, '2026-02-13 17:21:11', 0),
(151, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php', '', '[]', '', 0, '2026-02-13 17:21:17', 0),
(152, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?page=3', 'page=3', '[]', 'http://localhost/admin/dashboard.php', 0, '2026-02-13 17:21:27', 0),
(153, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?ip=&country=INDIA&suspicious=', 'ip=&country=INDIA&suspicious=', '[]', 'http://localhost/admin/dashboard.php?page=3', 0, '2026-02-13 17:21:49', 0),
(154, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?', '', '[]', 'http://localhost/admin/dashboard.php?ip=&country=INDIA&suspicious=', 0, '2026-02-13 17:21:53', 0),
(155, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/SOC_admin_Dashboard.php', '', '', 'http://localhost/admin/SOC_admin_Dashboard.php?suspicious=1', 0, '2026-02-13 17:24:41', 0),
(156, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?', '', '', 'http://localhost/admin/dashboard.php?ip=&country=INDIA&suspicious=', 0, '2026-02-13 17:24:47', 0),
(157, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?', '', '', 'http://localhost/admin/dashboard.php?ip=&country=INDIA&suspicious=', 0, '2026-02-13 17:24:55', 0),
(158, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/', '', '', '', 0, '2026-02-13 17:25:05', 0),
(159, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '', 'http://127.0.0.1/', 0, '2026-02-13 17:25:07', 0),
(160, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/about.php', '', '', 'http://127.0.0.1/contact.php', 0, '2026-02-13 17:25:08', 0),
(161, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '', 'http://127.0.0.1/about.php', 0, '2026-02-13 17:25:08', 0),
(162, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '', 'http://127.0.0.1/contact.php', 0, '2026-02-13 17:25:09', 0),
(163, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '', 'http://127.0.0.1/contact.php', 0, '2026-02-13 17:25:09', 0),
(164, '127.0.0.1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/contact.php', '', '', 'http://127.0.0.1/contact.php', 0, '2026-02-13 17:25:09', 0),
(165, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?', '', '', 'http://localhost/admin/dashboard.php?ip=&country=INDIA&suspicious=', 0, '2026-02-13 17:25:11', 0),
(166, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/dashboard.php?', '', '', 'http://localhost/admin/dashboard.php?ip=&country=INDIA&suspicious=', 0, '2026-02-13 17:26:06', 0),
(167, '::1', 'Unknown', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'GET', '/admin/export_logs.php', '', '', 'http://localhost/admin/dashboard.php?', 0, '2026-02-13 17:26:11', 0),
(168, '172.30.61.149', 'Unknown', 'Unknown', 'Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'GET', '/', '', '', '', 1, '2026-02-23 12:21:24', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
