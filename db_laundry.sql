-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 08:10 AM
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
-- Database: `db_laundry`
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
(27, 'Farel agasta', '0876543321', 'bandung', '2025-06-23 04:27:49', '2025-06-26 02:08:18', 0),
(28, 'mario teguh', '08765456789', 'kebon bacang jakpus', '2025-06-23 04:30:40', '2025-06-23 04:43:27', 0),
(30, 'toro', '08777788888', 'kembang', '2025-06-23 04:34:23', '2025-06-23 04:34:23', 0),
(31, 'nanda', '0876544321', 'mangga dua', '2025-06-23 06:23:48', '2025-06-23 06:23:48', 0),
(32, 'Hardianti', '085722240065', 'buncit raya', '2025-06-26 03:01:56', '2025-06-26 03:01:56', 0),
(33, 'Pak TRi', '08876', 'bogor', '2025-06-26 04:36:17', '2025-06-26 04:36:17', 0),
(34, 'tess', '234234', 'tess', '2025-07-14 06:35:25', '2025-07-14 06:35:25', 0);

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
(2, 'Operator', '2024-11-11 02:11:05', '2024-11-15 01:36:53', 0),
(3, 'Pimpinan', '2024-11-11 02:11:24', '2024-12-02 02:08:28', 0),
(12, 'customer', '2025-06-26 04:35:44', '2025-06-26 04:35:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(100) NOT NULL,
  `total_transaksi` int(100) NOT NULL,
  `total_pendapatan` int(100) NOT NULL,
  `pesanan_aktif` int(100) NOT NULL,
  `pesanan_selesai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 59, 28, '2025-06-26', NULL, '2025-06-26 02:26:42', '2025-06-26 02:26:42', 0),
(12, 60, 31, '2025-06-26', NULL, '2025-06-26 02:29:43', '2025-06-26 02:29:43', 0),
(13, 58, 27, '2025-06-27', NULL, '2025-06-26 02:37:12', '2025-06-26 02:37:12', 0),
(14, 61, 32, '2025-06-20', NULL, '2025-06-26 03:05:30', '2025-06-26 03:05:30', 0);

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
  `total_price` int(11) NOT NULL,
  `order_pay` int(11) DEFAULT NULL,
  `order_change` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order`
--

INSERT INTO `trans_order` (`id`, `id_customer`, `order_code`, `order_date`, `order_end_date`, `order_status`, `total_price`, `order_pay`, `order_change`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(61, 32, 'LNDRY-2025062605033061', '2025-06-18', '2025-06-20', 1, 140, 150, 10, NULL, '2025-06-26 03:04:16', '2025-06-26 03:05:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trans_order_detail`
--

CREATE TABLE `trans_order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order_detail`
--

INSERT INTO `trans_order_detail` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, 58, 21, 2, 30.00, NULL, '2025-06-26 02:13:17', '2025-06-26 02:13:17', 0),
(55, 59, 17, 5, 20.00, NULL, '2025-06-26 02:25:31', '2025-06-26 02:25:31', 0),
(56, 60, 18, 20, 100.00, NULL, '2025-06-26 02:28:19', '2025-06-26 02:28:19', 0),
(57, 61, 25, 20, 140.00, NULL, '2025-06-26 03:04:16', '2025-06-26 03:04:16', 0),
(58, 62, 23, 5, 22.50, NULL, '2025-06-26 04:38:05', '2025-06-26 04:38:05', 0),
(59, 63, 24, 1, 5.00, NULL, '2025-06-26 04:38:27', '2025-06-26 04:38:27', 0);

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
(22, 'cuci dan gosok', 5000, 'kaos oblong', '2025-06-26 02:59:28', '2025-06-26 02:59:28', 0),
(23, 'hanya cuci', 4500, 'semua jenis baju', '2025-06-26 03:00:06', '2025-06-26 03:00:06', 0),
(24, 'Gosok', 5000, 'rapih dan licin', '2025-06-26 03:00:29', '2025-06-26 03:00:29', 0),
(25, 'laundry Besar', 7000, 'Selimut, Karpet, Mantel, Sprei my love', '2025-06-26 03:01:19', '2025-06-26 03:01:19', 0),
(26, 'Setrika', 4000, 'kemeja', '2025-06-26 04:36:56', '2025-06-26 04:36:56', 0);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', '123', '2024-11-11 02:30:45', '2025-06-24 03:28:24', 0),
(14, 2, 'dianti', 'operator@gmail.com', '123', '2024-11-28 12:16:42', '2025-06-24 03:28:24', 0),
(21, 3, 'Ibu Kartini', 'kartini@gmail.com', '123', '2025-06-26 01:01:18', '2025-06-26 01:01:18', 0),
(23, 1, 'MUHAMMAD SIDDIQ', 'sidik@gmail.com', '123', '2025-06-26 01:47:44', '2025-06-26 01:48:11', 0),
(24, 3, 'Hardianti', 'pimpinan@gmail.com', '123', '2025-06-26 02:39:24', '2025-06-26 02:39:24', 0),
(25, 2, 'Soekarno', 'operator@gmail.com', '123', '2025-06-26 04:35:14', '2025-06-26 04:35:14', 0);

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
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trans_order`
--
ALTER TABLE `trans_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `type_of_service`
--
ALTER TABLE `type_of_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
