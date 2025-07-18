-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 02:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry_dianti`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Muhammad Siddiq', '089684758768', 'Jakarta Timur', '2024-11-29 17:37:19', '2025-07-14 02:51:37', 0),
(23, 'Abdullah Faqih', '085810382828', 'Jakarta Barat', '2025-07-14 02:41:02', '2025-07-14 02:41:02', 0),
(24, 'Agra Saputra', '087887695252', 'Sawangan, Depok', '2025-07-14 02:41:51', '2025-07-14 02:41:51', 0),
(25, 'Aldo Rio Prayoga', '081317487094', 'Bekasi Kota', '2025-07-14 02:42:55', '2025-07-14 02:42:55', 0),
(26, 'Ananda Nabilla Luthfiyyah', '0895341021748', 'Jakarta Selatan', '2025-07-14 02:43:52', '2025-07-14 02:43:52', 0),
(27, 'Angela', '085776355608', 'Jakarta', '2025-07-14 02:45:02', '2025-07-14 02:45:02', 0),
(28, 'Aryo putranto', '08987002882', 'Jakarta Timur', '2025-07-14 02:45:42', '2025-07-14 02:45:51', 0),
(29, 'Diriansyah', '082297789349', 'Jakarta Pusat', '2025-07-14 02:46:35', '2025-07-14 02:46:35', 0),
(30, 'Erssa Istrary Yusuf', '0895331020847', 'Jakarta Selatan', '2025-07-14 02:48:14', '2025-07-14 02:48:14', 0),
(31, 'Hardianti', '0857 2224 0065', 'Jakarta Selatan', '2025-07-14 02:48:47', '2025-07-14 02:48:47', 0),
(32, 'Intan Dwi Yasarah', '087788541945', 'Jakarta Selatan', '2025-07-14 02:49:38', '2025-07-14 02:49:38', 0),
(33, 'Muhammad Raihan', '085710690044', 'Jakarta Utara', '2025-07-14 02:50:26', '2025-07-14 02:50:26', 0),
(34, 'Raihan Adliansyah', '0895403953788', 'Jakarta Selatan', '2025-07-14 02:51:23', '2025-07-14 02:51:23', 0),
(35, 'Raymond Agung Nugroho', '09988877666', 'Jakarta', '2025-07-14 02:52:06', '2025-07-14 02:52:06', 0),
(36, 'Salsabila Suci Gustiani', '082114816010', 'Jakarta Selatan', '2025-07-14 03:40:49', '2025-07-14 03:40:49', 0),
(37, 'Sayyid Hamzah Azzami', ' 085715303916', 'Jakarta Selatan', '2025-07-14 03:42:17', '2025-07-14 03:42:17', 0),
(38, 'Sayyid Umar ', ' 085772169466', 'Jakarta Timur', '2025-07-14 03:43:27', '2025-07-14 03:43:27', 0),
(39, 'Soffian Al Fikri', ' 089687960758', 'Jakarta Utara', '2025-07-14 03:44:13', '2025-07-14 03:44:13', 0),
(40, 'William Setiady', '081384606268', 'Jakarta Selatan', '2025-07-14 03:44:59', '2025-07-14 03:44:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2024-11-11 02:11:05', '2024-12-02 02:07:59', 0),
(2, 'Operator', '2024-11-11 02:11:05', '2025-07-14 02:07:03', 0),
(3, 'Leader', '2025-07-14 02:06:49', '2025-07-14 02:08:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trans_laundry_pickup`
--

CREATE TABLE `trans_laundry_pickup` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_laundry_pickup`
--

INSERT INTO `trans_laundry_pickup` (`id`, `id_order`, `id_customer`, `pickup_date`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, 119, 37, '2025-07-17', NULL, '2025-07-15 12:13:15', '2025-07-15 12:13:15', 0),
(27, 123, 31, '2025-07-17', NULL, '2025-07-15 12:25:39', '2025-07-15 12:25:39', 0),
(28, 124, 28, '2025-07-16', NULL, '2025-07-15 12:27:25', '2025-07-15 12:27:25', 0),
(29, 125, 33, '2025-07-18', NULL, '2025-07-15 12:29:07', '2025-07-15 12:29:07', 0),
(30, 126, 24, '2025-07-17', NULL, '2025-07-15 13:03:20', '2025-07-15 13:03:20', 0),
(31, 130, 23, '2025-07-17', NULL, '2025-07-15 13:55:23', '2025-07-15 13:55:23', 0),
(32, 132, 33, '2025-07-17', NULL, '2025-07-15 14:22:19', '2025-07-15 14:22:19', 0),
(33, 131, 24, '2025-07-18', NULL, '2025-07-15 14:22:30', '2025-07-15 14:22:30', 0),
(34, 139, 32, '2025-07-24', NULL, '2025-07-15 14:47:14', '2025-07-15 14:47:14', 0),
(35, 140, 40, '2025-07-17', NULL, '2025-07-15 22:54:16', '2025-07-15 22:54:16', 0),
(36, 141, 31, '2025-07-16', NULL, '2025-07-15 22:57:28', '2025-07-15 22:57:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trans_order`
--

CREATE TABLE `trans_order` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_end_date` date DEFAULT NULL,
  `order_status` tinyint(11) NOT NULL DEFAULT 0,
  `deskripsi` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_pay` int(11) DEFAULT NULL,
  `order_change` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order`
--

INSERT INTO `trans_order` (`id`, `id_customer`, `order_code`, `order_date`, `order_end_date`, `order_status`, `deskripsi`, `total_price`, `order_pay`, `order_change`, `created_at`, `updated_at`, `deleted_at`) VALUES
(141, 31, 'HDR-250716-055556', '2025-07-15 22:55:56', '2025-07-17', 1, 'harus bersih', 8500, 10000, 1500, '2025-07-15 22:55:56', '2025-07-15 22:57:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trans_order_detail`
--

CREATE TABLE `trans_order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order_detail`
--

INSERT INTO `trans_order_detail` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(129, 118, 9, 2, 10000, NULL, '2025-07-15 12:04:53', '2025-07-15 12:04:53', 0),
(130, 119, 9, 1, 5000, NULL, '2025-07-15 12:12:03', '2025-07-15 12:12:03', 0),
(131, 120, 9, 12, 60000, NULL, '2025-07-15 12:17:18', '2025-07-15 12:17:18', 0),
(132, 121, 9, 2, 10000, NULL, '2025-07-15 12:19:36', '2025-07-15 12:19:36', 0),
(133, 122, 11, 2, 50000, NULL, '2025-07-15 12:21:41', '2025-07-15 12:21:41', 0),
(134, 123, 9, 2, 10000, NULL, '2025-07-15 12:22:30', '2025-07-15 12:22:30', 0),
(135, 124, 13, 2222, 33330000, NULL, '2025-07-15 12:26:08', '2025-07-15 12:26:08', 0),
(136, 125, 9, 1, 5000, NULL, '2025-07-15 12:28:33', '2025-07-15 12:28:33', 0),
(137, 126, 13, 1, 15000, NULL, '2025-07-15 12:44:47', '2025-07-15 12:44:47', 0),
(138, 127, 14, 2, 40000, NULL, '2025-07-15 13:11:09', '2025-07-15 13:11:09', 0),
(139, 128, 23, 1, 4500, NULL, '2025-07-15 13:30:37', '2025-07-15 13:30:37', 0),
(140, 129, 23, 1, 4500, NULL, '2025-07-15 13:32:41', '2025-07-15 13:32:41', 0),
(141, 130, 9, 12, 60000, NULL, '2025-07-15 13:54:57', '2025-07-15 13:54:57', 0),
(142, 131, 14, 12, 240000, NULL, '2025-07-15 13:55:54', '2025-07-15 13:55:54', 0),
(143, 132, 9, 2, 10000, NULL, '2025-07-15 14:21:57', '2025-07-15 14:21:57', 0),
(144, 133, 13, 2, 30000, NULL, '2025-07-15 14:32:26', '2025-07-15 14:32:26', 0),
(145, 134, 9, 2, 10000, NULL, '2025-07-15 14:37:17', '2025-07-15 14:37:17', 0),
(146, 135, 9, 1, 5000, NULL, '2025-07-15 14:40:23', '2025-07-15 14:40:23', 0),
(147, 136, 9, 1, 5000, NULL, '2025-07-15 14:41:28', '2025-07-15 14:41:28', 0),
(148, 137, 9, 1, 5000, NULL, '2025-07-15 14:41:44', '2025-07-15 14:41:44', 0),
(149, 138, 13, 12, 180000, NULL, '2025-07-15 14:42:49', '2025-07-15 14:42:49', 0),
(150, 139, 12, 1, 9100, NULL, '2025-07-15 14:46:56', '2025-07-15 14:46:56', 0),
(151, 140, 12, 2, 14000, NULL, '2025-07-15 22:53:23', '2025-07-15 22:53:23', 0),
(152, 141, 17, 2, 8500, NULL, '2025-07-15 22:55:56', '2025-07-15 22:55:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_service`
--

CREATE TABLE `type_of_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_service`
--

INSERT INTO `type_of_service` (`id`, `service_name`, `price`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'Cuci Setrika', 7000, 'Cuci Setrika Rp.7000/Kg', '2025-07-14 07:42:47', '2025-07-14 07:42:47', 0),
(15, 'Cuci dan Gosok', 5000, 'harga per kg', '2025-07-15 15:50:47', '2025-07-15 15:51:15', 0),
(16, 'Hanya Cuci', 4500, 'Harga per kg', '2025-07-15 15:52:43', '2025-07-15 15:52:43', 0),
(17, 'Hanya Gosok', 5000, 'Harga untuk Pakaian Kaos oblong dan kemeja', '2025-07-15 15:53:35', '2025-07-15 15:53:35', 0),
(18, 'Laundry Besar', 7000, 'Selimut, Karpet, Mantel, dan Sprey my love', '2025-07-15 15:55:29', '2025-07-15 15:55:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_picture` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `username`, `email`, `password`, `profile_picture`, `created_at`, `tanggal`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '123', 'profile_picture1.jpg', '2024-11-11 02:30:45', NULL, '2025-06-17 07:21:51', 0),
(14, 2, 'Hardianti', 'operator@gmail.com', '123', 'profile_picture14.jpg', '2024-11-28 12:16:42', NULL, '2025-07-15 14:16:08', 0),
(17, 3, 'Leader', 'leader@gmail.com', '123', '', '2025-07-14 02:09:24', NULL, '2025-07-14 02:09:59', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_order`
--
ALTER TABLE `trans_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_service`
--
ALTER TABLE `type_of_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `trans_order`
--
ALTER TABLE `trans_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `type_of_service`
--
ALTER TABLE `type_of_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
