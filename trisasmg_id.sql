-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 04:37 AM
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
-- Database: `trisasmg_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `grafik`
--

CREATE TABLE `grafik` (
  `name_product` varchar(255) NOT NULL,
  `jumlah_product_terjual` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grafik`
--

INSERT INTO `grafik` (`name_product`, `jumlah_product_terjual`) VALUES
('BAKSO MERCON', 1),
('CEKER MERCON', 1),
('SAYAP MERCON', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `pertanyaan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `pemesan_id` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `pemesan_id`, `nama_produk`, `jumlah`, `harga`, `total_harga`, `created_at`) VALUES
(27, 10, 'CEKER MERCON', 1, 15000.00, 15000.00, '2024-12-08 19:41:25'),
(28, 10, 'BAKSO MERCON', 1, 13000.00, 13000.00, '2024-12-08 19:41:25'),
(29, 10, 'SAYAP MERCON', 1, 25000.00, 25000.00, '2024-12-08 19:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_pesan` date NOT NULL,
  `tgl_ambil` date NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id`, `nama_pemesan`, `no_telp`, `alamat`, `tgl_pesan`, `tgl_ambil`, `metode_bayar`, `bukti_bayar`, `created_at`) VALUES
(10, 'bani', '085265486315', 'tembalang', '2024-12-09', '2024-12-09', 'shopeepay', 'uploads/70ede02eb69383021d9072e3dceea4ea (2).jpg', '2024-12-08 19:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `stock`) VALUES
(1, 'CEKER MERCON', 15000.00, 'img/products/ceker.jpg', 'diolah dengan kualitas terbaik dan cocok untuk teman laparmu', 49),
(2, 'BAKSO MERCON', 13000.00, 'img/products/bakso.jpg', 'homemade dengan bumbu rahasia yang siap manjakan lidahmu', 49),
(3, 'SAYAP MERCON', 25000.00, 'img/products/sayap.jpg', 'sensasi sayap pedas yang menggugah selera', 49),
(4, 'MIX MERCON', 20000.00, 'img/products/mix.jpg', 'perpaduan ceker dan bakso yang bikin mood naik', 50),
(5, 'SPESIAL MERCON', 25000.00, 'img/products/spesial.jpg', 'kombinasi ceker, bakso, dan sayap yang bikin ketagihan', 50),
(6, 'NASCOK CUMI CABE IJO', 6000.00, 'img/products/nasi.jpg', 'rasa cumi cabe ijo solusi tepat untuk kamu pecinta pedas', 50),
(7, 'NASCOK AYAM TERIYAKI', 6000.00, 'img/products/nasi.jpg', 'rasa ayam teriyaki yang praktis dan siap santap', 50),
(8, 'NASCOK BAKSO PEDAS', 6000.00, 'img/products/nasi.jpg', 'rasa bakso pedas yang kenyal dan nikmat', 50),
(9, 'ESMUT CHOCOLATE', 6000.00, 'img/products/susu.jpg', 'es lumut susu jelly rasa coklat siap hadapi panasnya dunia', 50),
(10, 'ESMUT RED VELVET', 6000.00, 'img/products/susu.jpg', 'es lumut susu jelly rasa red velvet siap hadapi panasnya dunia', 50),
(11, 'ESMUT MELON', 6000.00, 'img/products/susu.jpg', 'es lumut susu jelly rasa melon siap hadapi panasnya dunia', 50),
(12, 'ESMUT VANILA', 6000.00, 'img/products/susu.jpg', 'es lumut susu jelly rasa vanilla late siap hadapi panasnya dunia', 50),
(13, 'ESMUT MANGGA', 6000.00, 'img/products/susu.jpg', 'es lumut susu jelly rasa mangga siap hadapi panasnya dunia', 50),
(14, 'ESMUT TARO', 6000.00, 'img/products/susu.jpg', 'es lumut susu jelly rasa taro siap hadapi panasnya dunia', 50);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `after_product_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
    DECLARE sold_qty INT DEFAULT 0;

    IF OLD.stock > NEW.stock THEN
        -- Jika stock berkurang
        SET sold_qty = OLD.stock - NEW.stock;

        -- Update jumlah_product_terjual di tabel grafik
        INSERT INTO grafik (name_product, jumlah_product_terjual)
        VALUES (NEW.name, sold_qty)
        ON DUPLICATE KEY UPDATE jumlah_product_terjual = jumlah_product_terjual + sold_qty;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `username`, `password`, `created_at`) VALUES
(1, 'budi', '085212365985', 'bud123', '$2y$10$lcV/gddi3f3BuMKWNRcIHeP7VsasG7bmxv3RdYSDN76VaryqarWQW', '2024-12-05 16:16:36'),
(3, 'bani', '085212365985', 'bani1212', '$2y$10$k3udVVQ7v99FTitkRyZR6.4sU4Ww1d65tUUZfFyHWHm3pW.lKNRZe', '2024-12-05 16:29:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grafik`
--
ALTER TABLE `grafik`
  ADD PRIMARY KEY (`name_product`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesan_id` (`pemesan_id`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grafik`
--
ALTER TABLE `grafik`
  ADD CONSTRAINT `grafik_ibfk_1` FOREIGN KEY (`name_product`) REFERENCES `products` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`pemesan_id`) REFERENCES `pemesan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
