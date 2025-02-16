-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Feb 2025 pada 01.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radityaholding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_menus`
--

CREATE TABLE `access_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `access_menus`
--

INSERT INTO `access_menus` (`id`, `id_jabatan`, `id_menu`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10, 63, 1, '2024-12-08 06:50:00', '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(11, 63, 2, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(12, 63, 3, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(13, 63, 4, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(14, 63, 5, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(15, 63, 6, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(16, 63, 7, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(17, 63, 8, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(18, 63, 9, NULL, '2024-12-07 19:18:19', '2024-12-07 19:18:19'),
(19, 64, 1, NULL, '2024-12-10 23:16:12', '2024-12-10 23:16:12'),
(20, 64, 2, NULL, '2024-12-10 23:16:12', '2024-12-10 23:16:12'),
(21, 64, 3, NULL, '2024-12-10 23:16:12', '2024-12-10 23:16:12'),
(22, 64, 4, NULL, '2024-12-10 23:16:12', '2024-12-10 23:16:12'),
(23, 64, 5, NULL, '2024-12-10 23:16:12', '2024-12-10 23:16:12'),
(24, 64, 6, NULL, '2024-12-10 23:16:12', '2024-12-10 23:16:12'),
(25, 61, 1, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(26, 61, 2, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(27, 61, 3, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(28, 61, 4, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(29, 61, 5, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(30, 61, 6, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(31, 61, 7, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(32, 61, 8, NULL, '2024-12-11 01:39:24', '2024-12-11 01:39:24'),
(33, 65, 1, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(34, 65, 2, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(35, 65, 3, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(36, 65, 4, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(37, 65, 5, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(38, 65, 6, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(39, 65, 7, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(40, 65, 8, NULL, '2024-12-11 01:39:43', '2024-12-11 01:39:43'),
(63, 160, 1, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(64, 160, 2, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(65, 160, 3, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(66, 160, 4, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(67, 160, 5, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(68, 160, 6, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(69, 160, 7, NULL, '2024-12-22 04:56:51', '2024-12-22 04:56:51'),
(70, 154, 1, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(71, 154, 2, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(72, 154, 3, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(73, 154, 4, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(74, 154, 5, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(75, 154, 6, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(76, 154, 7, NULL, '2024-12-22 04:57:20', '2024-12-22 04:57:20'),
(77, 153, 1, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(78, 153, 2, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(79, 153, 3, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(80, 153, 4, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(81, 153, 5, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(82, 153, 6, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(83, 153, 7, NULL, '2024-12-22 05:33:00', '2024-12-22 05:33:00'),
(84, 6, 1, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(85, 6, 2, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(86, 6, 3, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(87, 6, 4, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(88, 6, 5, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(89, 6, 6, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(90, 6, 7, NULL, '2024-12-22 09:03:47', '2024-12-22 09:03:47'),
(91, 3, 1, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(92, 3, 2, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(93, 3, 3, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(94, 3, 4, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(95, 3, 5, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(96, 3, 6, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(97, 3, 7, NULL, '2024-12-23 05:03:54', '2024-12-23 05:03:54'),
(98, 66, 1, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(99, 66, 2, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(100, 66, 3, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(101, 66, 4, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(102, 66, 5, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(103, 66, 6, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(104, 66, 7, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(105, 66, 8, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(106, 66, 10, NULL, '2024-12-25 01:02:36', '2024-12-25 01:02:36'),
(137, 1, 1, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(138, 1, 2, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(139, 1, 3, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(140, 1, 4, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(141, 1, 5, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(142, 1, 6, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(143, 1, 7, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(144, 1, 8, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(145, 1, 9, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(146, 1, 10, NULL, '2025-01-19 01:46:54', '2025-01-19 01:46:54'),
(147, 68, 1, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(148, 68, 2, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(149, 68, 3, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(150, 68, 4, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(151, 68, 5, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(152, 68, 6, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(153, 68, 7, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(154, 68, 8, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(155, 68, 9, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(156, 68, 10, NULL, '2025-01-19 05:17:25', '2025-01-19 05:17:25'),
(157, 69, 1, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(158, 69, 2, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(159, 69, 3, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(160, 69, 4, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(161, 69, 5, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(162, 69, 6, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(163, 69, 7, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(164, 69, 8, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(165, 69, 9, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(166, 69, 10, NULL, '2025-01-19 05:22:36', '2025-01-19 05:22:36'),
(167, 70, 1, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(168, 70, 2, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(169, 70, 3, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(170, 70, 4, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(171, 70, 5, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(172, 70, 6, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(173, 70, 7, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(174, 70, 8, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(175, 70, 9, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(176, 70, 10, NULL, '2025-01-19 09:23:52', '2025-01-19 09:23:52'),
(177, 71, 1, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(178, 71, 2, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(179, 71, 3, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(180, 71, 4, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(181, 71, 5, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(182, 71, 6, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(183, 71, 7, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(184, 71, 8, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(185, 71, 9, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53'),
(186, 71, 10, NULL, '2025-01-19 09:33:53', '2025-01-19 09:33:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_document`
--

CREATE TABLE `approval_document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_surat` int(11) NOT NULL DEFAULT 0,
  `id_jabatan` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `next_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `approval_document`
--

INSERT INTO `approval_document` (`id`, `nama`, `id_surat`, `id_jabatan`, `status`, `deleted_at`, `created_at`, `updated_at`, `note`, `title`, `next_id`) VALUES
(1, 'Surat Pengadaan Berhasil Dibuat', 3, 61, 1, NULL, '2024-12-11 08:00:16', '2024-12-11 08:00:23', '', 'Myrl Beatty', 0),
(3, 'Surat disetujui oleh General Manager <br />( General Manager 003 ) ', 3, 64, 1, NULL, '2024-12-11 00:59:30', '2024-12-11 00:59:30', 'tidak ada', 'General Manager 003 ', 0),
(4, 'Surat disetujui oleh PIC Unit ( One Of The BOD ) ( PIC Unit 001 ) ', 3, 65, 1, NULL, '2024-12-11 01:58:16', '2024-12-11 01:58:16', 'tidak ada catatan tambahan', 'PIC Unit 001', 0),
(5, 'Surat Pengadaan Berhasil Dibuat', 6, 61, 1, NULL, '2024-12-11 15:53:18', NULL, '-', 'Myrl Beattie', 0),
(6, 'Surat disetujui oleh General Manager ( General Manager 003 ) ', 6, 64, 1, NULL, '2024-12-11 07:58:29', '2024-12-11 07:58:29', 'tidak ada catatan', 'General Manager 003', 0),
(7, 'Surat disetujui oleh PIC Unit ( One Of The BOD ) ( PIC Unit New ) ', 6, 65, 1, NULL, '2024-12-11 07:59:33', '2024-12-11 07:59:33', 'tidak ada catatan dari PIC', 'PIC Unit New', 0),
(8, 'Surat disetujui oleh Sekretariat ( Sekretariat Edit ) ', 6, 66, 1, NULL, '2024-12-22 04:13:06', '2024-12-22 04:13:06', 'Surat Permohonan Disetujui', 'Sekretariat Edit', 3),
(10, 'Surat disetujui oleh Board Of Finance ( Board Of Director ) ', 6, 8, 1, NULL, '2024-12-22 07:26:31', '2024-12-22 07:26:31', 'Mantapp bosku', 'Board Of Director', 4),
(11, 'Surat disetujui oleh Presiden Direktur ( Manager 01 ) ', 6, 4, 1, NULL, '2024-12-22 09:50:53', '2024-12-22 09:50:53', 'Lanjutt', 'Manager 01', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_doc_pembayaran`
--

CREATE TABLE `approval_doc_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_surat` int(11) NOT NULL DEFAULT 0,
  `id_jabatan` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `note` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `is_next` int(11) NOT NULL DEFAULT 0,
  `is_before` int(11) NOT NULL DEFAULT 0,
  `approved_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_doc_pembayarans`
--

CREATE TABLE `approval_doc_pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_surat` int(11) NOT NULL DEFAULT 0,
  `id_jabatan` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `next_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_doc_pengadaan`
--

CREATE TABLE `approval_doc_pengadaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_surat` int(11) NOT NULL DEFAULT 0,
  `id_jabatan` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `note` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `is_next` int(11) NOT NULL DEFAULT 0,
  `is_before` int(11) NOT NULL DEFAULT 0,
  `approved_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_doc_pettycash`
--

CREATE TABLE `approval_doc_pettycash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_surat` int(11) NOT NULL DEFAULT 0,
  `id_jabatan` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_next` int(11) NOT NULL,
  `is_before` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `approval_doc_pettycash`
--

INSERT INTO `approval_doc_pettycash` (`id`, `nama`, `id_surat`, `id_jabatan`, `status`, `deleted_at`, `created_at`, `updated_at`, `note`, `title`, `is_next`, `is_before`, `approved_by`) VALUES
(1, 'Surat Pengadaan Berhasil Dibuat', 4, 68, 1, NULL, '2025-01-19 07:40:06', '2025-01-19 07:40:06', '-', 'Hal Torphy', 0, 0, 168),
(2, 'Surat Pengadaan Berhasil Dibuat', 4, 69, 1, NULL, '2025-01-19 07:40:06', '2025-01-19 09:15:02', '-', 'Rodrigo Bradtke', 0, 1, 168),
(3, 'Surat Pengadaan Berhasil Dibuat', 4, 70, 1, NULL, '2025-01-19 07:40:06', '2025-01-19 09:24:25', 'tidak ada', 'Roberta Pagac', 0, 1, 168),
(4, 'Surat telah disetujui oleh General Cashier', 4, 71, 1, NULL, '2025-01-19 07:40:06', '2025-01-19 09:36:14', 'tidak ada', 'Elenora Toy', 0, 1, 168),
(5, 'Surat Pengadaan Berhasil Dibuat', 5, 68, 1, NULL, '2025-01-20 08:22:10', '2025-01-20 08:22:10', '-', 'Hal Torphy', 0, 0, 168),
(6, 'Surat telah disetujui oleh manager of finance', 5, 69, 1, NULL, '2025-01-20 08:22:10', '2025-01-20 08:24:11', '-', 'Armani Barrows', 0, 1, 168),
(7, 'Surat telah disetujui oleh Brand of finance', 5, 70, 1, NULL, '2025-01-20 08:22:10', '2025-01-20 08:34:42', 'tes', 'Roberta Pagac', 0, 1, 168),
(8, '-', 5, 71, 0, NULL, '2025-01-20 08:22:10', '2025-01-20 08:34:42', 'tes', 'Elenora Toy', 1, 0, 168),
(9, 'Surat Pengadaan Berhasil Dibuat', 6, 68, 1, NULL, '2025-01-20 11:48:54', '2025-01-20 11:48:54', '-', 'Hal Torphy', 0, 0, 168),
(10, 'Surat telah disetujui oleh manager of finance', 6, 69, 1, NULL, '2025-01-20 11:48:54', '2025-01-20 11:49:35', '-', 'Armani Barrows', 0, 1, 168),
(11, 'Surat telah disetujui oleh Brand of finance', 6, 70, 1, NULL, '2025-01-20 11:48:54', '2025-01-20 12:05:20', 'tidak ada', 'Roberta Pagac', 0, 1, 170),
(12, 'Surat Pengadaan Berhasil Dibuat', 7, 68, 1, NULL, '2025-01-22 08:15:13', '2025-01-22 08:15:13', '-', 'Hal Torphy', 0, 0, 0),
(13, '-', 7, 69, 0, NULL, '2025-01-22 08:15:13', '2025-01-22 08:15:13', '-', 'Armani Barrows', 1, 0, 0),
(14, '-', 7, 70, 0, NULL, '2025-01-22 08:15:13', '2025-01-22 08:15:13', '-', 'Roberta Pagac', 0, 0, 0),
(15, 'Surat Pengadaan Berhasil Dibuat', 8, 68, 1, NULL, '2025-01-22 08:17:45', '2025-01-22 08:17:45', '-', 'Hal Torphy', 0, 0, 167),
(16, 'Surat telah disetujui oleh manager of finance', 8, 69, 1, NULL, '2025-01-22 08:17:45', '2025-01-22 08:20:00', '-', 'Armani Barrows', 0, 1, 168),
(17, 'Surat telah disetujui oleh Brand of finance', 8, 70, 1, NULL, '2025-01-22 08:17:45', '2025-01-22 08:22:01', 'baguss', 'Roberta Pagac', 0, 1, 170);

-- --------------------------------------------------------

--
-- Struktur dari tabel `doc_petty_cashes`
--

CREATE TABLE `doc_petty_cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_surat` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doc_petty_cashes`
--

INSERT INTO `doc_petty_cashes` (`id`, `id_surat`, `nama_dokumen`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'TZW3RA0yd62UxVbX75h9DbUeVNvqhSUcVE15YzFf.png', NULL, '2024-12-23 05:08:00', '2024-12-23 05:08:00'),
(2, 4, 'AtNWOQEovarpLYU484R7X8jF7CDc0HQnCHbetRJc.pdf', NULL, '2025-01-19 07:40:06', '2025-01-19 07:40:06'),
(3, 5, 'Gc9zpB2urr7ulkAYSsskN1kuSaMdnYwiQqYDf5MY.pdf', NULL, '2025-01-20 08:22:10', '2025-01-20 08:22:10'),
(4, 6, 'p3abOd34592u8SOmfXtpDFEmLqOmPUvKxLyxH9OV.pdf', NULL, '2025-01-20 11:48:54', '2025-01-20 11:48:54'),
(5, 7, 'yHHMzZNJsz6QDU58By0U7rdNyWCW6pwZQS9WWirK.pdf', NULL, '2025-01-22 08:15:13', '2025-01-22 08:15:13'),
(6, 8, 'p6CvpKw98yz47k5fcKxtEwCQNgM70CkHljSR075g.pdf', NULL, '2025-01-22 08:17:45', '2025-01-22 08:17:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_surat` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id`, `id_surat`, `nama_dokumen`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'I7DzU88opof7uFmQGAvP18EpmChSaF0tOAFZ9dZQ.png', NULL, '2024-12-06 20:37:10', '2024-12-06 20:37:10'),
(2, 2, 'vL4QdcmskrZ2Xyq3cDzHoXI44O3Zvu4AMTQQZo8B.jpg', NULL, '2024-12-06 20:40:13', '2024-12-06 20:40:13'),
(3, 3, '6rUoZK6mMhVqVcG6OsGvy55yQTpyqUvvBtSMdP8M.jpg', NULL, '2024-12-10 02:20:19', '2024-12-10 02:20:19'),
(4, 6, 'ldy0wpcGS6xxnDdwGRWuvZZcGHZusHEPLNKUxL7o.png', NULL, '2024-12-11 07:50:24', '2024-12-11 07:50:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_persetujuan`
--

CREATE TABLE `dokumen_persetujuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_surat` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `section` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama`, `url`, `parent_id`, `is_active`, `status`, `deleted_at`, `created_at`, `updated_at`, `section`, `icon`) VALUES
(1, 'Overview', 'dashboard', 0, 1, 0, NULL, NULL, NULL, '1', 'micon bi bi-house'),
(2, 'Laporan', 'laporan', 0, 1, 1, NULL, NULL, NULL, '1', 'micon bi bi-file-pdf'),
(3, 'Daftar Surat', 'surat', 0, 1, 2, NULL, NULL, NULL, '2', 'micon bi bi-envelope-paper'),
(4, 'Permohonan', 'pengadaan', 0, 1, 3, NULL, NULL, NULL, '2', 'micon bi bi-cash-stack'),
(5, 'Pembayaran', 'pembayaran', 0, 1, 4, NULL, NULL, NULL, '2', 'micon bi bi-cash-stack'),
(6, 'Petty Cash', 'petty_cash', 0, 1, 5, NULL, NULL, NULL, '2', 'micon bi bi-cash-stack'),
(7, 'Template Surat', 'template_surat', 0, 1, 6, NULL, NULL, NULL, '2', 'micon bi bi-envelope'),
(8, 'Unit Usaha', 'unit-usaha', 0, 1, 7, NULL, NULL, NULL, '2', 'micon bi bi-layout-text-window-reverse'),
(9, 'Pengaturan', 'settings', 0, 1, 9, NULL, NULL, NULL, '2', 'micon bi bi-gear-fill'),
(10, 'Holding', 'viewHolding', 0, 1, 8, NULL, NULL, NULL, '2', 'micon bi bi-layout-text-window-reverse');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_20_083856_create_positions_table', 1),
(6, '2024_10_22_072111_add_role_to_users_table', 1),
(7, '2024_10_26_182358_soft_delete_users', 1),
(8, '2024_10_26_182449_soft_delete_jabatan', 1),
(9, '2024_11_11_062809_add_column_add_is_verified_users', 1),
(10, '2024_11_11_142315_add_column_reset_password_token', 1),
(11, '2024_11_16_131957_unit_usaha_table', 1),
(12, '2024_11_22_163811_update_users_add_role_status_migration', 1),
(13, '2024_11_22_180450_update_users_add_role_id_migration', 1),
(14, '2024_11_22_181525_update_users_add_status_migration', 1),
(15, '2024_11_23_120052_create_tipe_migration', 1),
(16, '2024_11_23_120505_add_new_column_jabatan_migration', 1),
(17, '2024_11_25_054314_create_access_menus_table', 1),
(18, '2024_11_25_055330_add_signature_fieldusers', 1),
(19, '2024_11_27_113744_create_pengadaan_migration', 1),
(20, '2024_11_27_114825_dokumen_upload_migration', 1),
(21, '2024_11_27_115230_status_dokumen_migration', 1),
(22, '2024_11_27_160925_add_column_tanggal_pengajuan_pengadaan', 1),
(23, '2024_11_29_114838_create_template_surats_table', 1),
(24, '2024_11_29_135848_add_alias_name_tipe_surat', 1),
(25, '2024_11_30_053704_create_jenis_surats_table', 1),
(26, '2024_11_30_074105_create_role_unit_usahas_table', 1),
(27, '2024_11_30_075300_create_role_holdings_table', 1),
(28, '2024_11_30_081852_create_roles_table', 2),
(31, '2024_12_07_025142_menu_migration', 3),
(32, '2024_12_07_025143_add_column_section_menu', 3),
(33, '2024_12_10_035632_add_icon_menu_migration', 4),
(34, '2024_12_10_070043_approval_document_migration', 5),
(35, '2024_12_10_081321_positio_doc_migration', 6),
(36, '2024_12_10_083132_add_doc_approval_migration', 7),
(37, '2024_12_11_093017_next_approve_migration', 8),
(38, '2024_12_13_184552_add_unit_bisnis_id_migration', 8),
(39, '2024_12_13_184610_unit_bisnis_migration', 8),
(41, '2024_12_16_182742_add_role_status_migration', 9),
(42, '2024_12_20_143809_surat_persetujuan_controller', 10),
(43, '2024_12_22_065242_create_dokumen_persetujuans_table', 11),
(44, '2024_12_22_111231_add_tanggal_persetujuan', 12),
(45, '2024_12_23_122312_create_petty_cashes_table', 13),
(46, '2024_12_23_125444_create_doc_petty_cashes_table', 14),
(47, '2024_12_23_173202_position_petty_cash', 15),
(48, '2024_12_24_122348_add_additional_column_is_permohonan', 16),
(49, '2024_12_24_122710_add_additional_column_approved', 17),
(50, '2024_12_25_074250_create_approval_doc_pembayarans_table', 18),
(51, '2024_12_25_074600_approval_document_next', 19),
(52, '2025_01_15_163341_role_petty_cash', 20),
(53, '2025_01_19_104437_add_status_role_migration_petty_cash', 21),
(54, '2025_01_19_132418_add_approval_surat_petty_cash', 21),
(55, '2025_01_19_151026_add_param_approval_petty_cash', 22),
(56, '2025_01_19_162131_add_before_migration_status', 23),
(57, '2025_01_20_194351_add_apporved_by_role_status_pt_cash', 24),
(58, '2025_01_22_183931_add_role_pengadaan_list', 25),
(59, '2025_01_31_151859_role_pengadaan_migration', 25),
(60, '2025_01_31_174912_role_pembayaran_migration', 26),
(61, '2025_02_08_165854_add_tipe_surat_role_pengadaan', 27),
(62, '2025_02_09_112258_approval_doc_pengadaan', 28),
(63, '2025_02_09_112511_approval_doc_pembayaran', 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_unit_usaha` int(11) NOT NULL,
  `unit_usaha` varchar(255) NOT NULL,
  `diajukan` varchar(255) NOT NULL,
  `tipe_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `nominal_pengajuan` bigint(20) NOT NULL,
  `detail` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `isPermohonan` tinyint(1) NOT NULL DEFAULT 0,
  `approvedPermohonan` tinyint(1) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengadaan`
--

INSERT INTO `pengadaan` (`id`, `no_surat`, `title`, `id_unit_usaha`, `unit_usaha`, `diajukan`, `tipe_surat`, `perihal`, `nominal_pengajuan`, `detail`, `deleted_at`, `created_at`, `updated_at`, `tanggal`, `position`, `isPermohonan`, `approvedPermohonan`, `approved`) VALUES
(6, 'Inv/001/9CSIO866', 'Permohonan pembelian 100 printer', 2, 'Raditya Unit Perkasa', 'Myrl Beatty', '1', 'Permohonan pembelian 100 printer', 1000000, '<p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Dengan Hormat, </span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Menindaklanjuti Surat yang masuk dari PT. Raditya Dewata Perkasa Cabang Gianyar pada tanggal 15 Oktober 2024 dengan nomor Surat 210/RDT/GYR/X/2024 Perihal Permohonan Persetujuan Pemberian Dana Duka untuk karyawan Raditya Gianyar yang Orang Tua Kandung Meninggal Dunia (I Made Merta) pada tanggal 13 Oktober 2024. Karyawan tersebut a/n I Ketut Arimbawa Jabatan Sebagai AO (Account Officer) (Join/Masa Kerja dari tanggal 25 Maret 2014 s/d Sekarang). </span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Berdasarkan Surat Keputusan yang berlaku No.648/Holding/HRD/VI/2023 tentang Pedoman Pemberian Manfaat Dana Duka /Dana Sosial bagi karyawan yang orang tua kandung meninggal dunia akan mendapatkan dana sosial, maka yang bersangkutan akan diberikan dana sebesar Rp 500.000,- (Lima Ratus Ribu Rupiah) dan sudah dikoordinasikan bersama pihak HRD sesuai dengan peraturan yang berlaku di perusahaan. Adapun Rincian sebagai berikut :</span></p><table><tbody><tr><td data-row=\"1\" class=\"ql-align-center\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">No</strong></td><td data-row=\"1\" class=\"ql-align-center\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">KETERANGAN</strong></td><td data-row=\"1\" class=\"ql-align-center\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">TOTAL</strong></td></tr><tr><td data-row=\"2\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> 1</span></td><td data-row=\"2\" class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Permohonan Persetujuan Pemberian Dana Duka untuk karyawan Raditya Gianyar yang Orang Tua Kandung Meninggal Dunia (I Made Merta) pada tanggal 13 Oktober 2024. Karyawan tersebut a/n I Ketut Arimbawa Jabatan Sebagai AO (Account Officer) (Join/Masa Kerja dari tanggal 25 Maret 2014 s/d Sekarang). </span></td><td data-row=\"2\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Rp     500.000,-</strong></td></tr><tr><td data-row=\"3\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> </span><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Terbilang : Lima Ratus Ribu Rupiah </strong></td><td data-row=\"3\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Rp      500.000,-</strong></td></tr></tbody></table><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Bersama dengan ini kami mohon persetujuan dari Ibu Direksi untuk memberikan dana berdasarkan permohonan di atas.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Demikian permohonan ini kami sampaikan, atas perhatian dari Ibu Direksi kami haturkan terima kasih</span></p><p><br></p>', NULL, '2024-12-11 07:50:24', '2024-12-22 09:50:53', '2024-12-11 00:00:00', 5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `persetujuan`
--

CREATE TABLE `persetujuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_unit_usaha` int(11) NOT NULL,
  `unit_usaha` varchar(255) NOT NULL,
  `diajukan` varchar(255) NOT NULL,
  `tipe_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `nominal_pengajuan` bigint(20) NOT NULL,
  `detail` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `persetujuan`
--

INSERT INTO `persetujuan` (`id`, `id_permohonan`, `no_surat`, `title`, `id_unit_usaha`, `unit_usaha`, `diajukan`, `tipe_surat`, `perihal`, `nominal_pengajuan`, `detail`, `deleted_at`, `created_at`, `updated_at`, `tanggal`) VALUES
(2, 6, '1009/001/555/456', 'Persetujuan pembelian 20 printer', 158, 'Raditya Unit Perkasa', 'Sekretariat Edit', 'Pengadaan', 'Persetujuan pembelian 20 printer', 10000000, '<p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Dengan Hormat, </span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Menindaklanjuti Surat yang masuk dari PT. Raditya Dewata Perkasa Cabang Gianyar pada tanggal 15 Oktober 2024 dengan nomor Surat 210/RDT/GYR/X/2024 Perihal Permohonan Persetujuan Pemberian Dana Duka untuk karyawan Raditya Gianyar yang Orang Tua Kandung Meninggal Dunia (I Made Merta) pada tanggal 13 Oktober 2024. Karyawan tersebut a/n I Ketut Arimbawa Jabatan Sebagai AO (Account Officer) (Join/Masa Kerja dari tanggal 25 Maret 2014 s/d Sekarang). </span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Berdasarkan Surat Keputusan yang berlaku No.648/Holding/HRD/VI/2023 tentang Pedoman Pemberian Manfaat Dana Duka /Dana Sosial bagi karyawan yang orang tua kandung meninggal dunia akan mendapatkan dana sosial, maka yang bersangkutan akan diberikan dana sebesar Rp 500.000,- (Lima Ratus Ribu Rupiah) dan sudah dikoordinasikan bersama pihak HRD sesuai dengan peraturan yang berlaku di perusahaan. Adapun Rincian sebagai berikut :</span></p><table><tbody><tr><td data-row=\"1\" class=\"ql-align-center\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">No</strong></td><td data-row=\"1\" class=\"ql-align-center\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">KETERANGAN</strong></td><td data-row=\"1\" class=\"ql-align-center\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">TOTAL</strong></td></tr><tr><td data-row=\"2\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> 1</span></td><td data-row=\"2\" class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Permohonan Persetujuan Pemberian Dana Duka untuk karyawan Raditya Gianyar yang Orang Tua Kandung Meninggal Dunia (I Made Merta) pada tanggal 13 Oktober 2024. Karyawan tersebut a/n I Ketut Arimbawa Jabatan Sebagai AO (Account Officer) (Join/Masa Kerja dari tanggal 25 Maret 2014 s/d Sekarang). </span></td><td data-row=\"2\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Rp     500.000,-</strong></td></tr><tr><td data-row=\"3\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> </span><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Terbilang : Lima Ratus Ribu Rupiah </strong></td><td data-row=\"3\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Rp      500.000,-</strong></td></tr></tbody></table><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Bersama dengan ini kami mohon persetujuan dari Ibu Direksi untuk memberikan dana berdasarkan permohonan di atas.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Demikian permohonan ini kami sampaikan, atas perhatian dari Ibu Direksi kami haturkan terima kasih</span></p><p><br></p>', NULL, '2024-12-22 04:13:06', '2024-12-22 04:13:06', '2024-12-22 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petty_cashes`
--

CREATE TABLE `petty_cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_unit_usaha` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `unit_usaha` varchar(255) NOT NULL,
  `diajukan` varchar(255) NOT NULL,
  `tipe_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `nominal_pengajuan` bigint(20) NOT NULL,
  `detail` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petty_cashes`
--

INSERT INTO `petty_cashes` (`id`, `no_surat`, `title`, `id_unit_usaha`, `tanggal`, `unit_usaha`, `diajukan`, `tipe_surat`, `perihal`, `nominal_pengajuan`, `detail`, `deleted_at`, `created_at`, `updated_at`, `position`) VALUES
(4, '0001-0002-003', 'Surat Permohonan Petty Cash 2025', 168, '2025-01-19 00:00:00', 'Raditya Unit Perkasa', 'Manager Finance 01', '0', 'Surat Permohonan Petty Cash 2025', 10000000, '<p>tess</p>', NULL, '2025-01-19 07:40:06', '2025-01-19 07:40:06', 0),
(5, 'Inv/001/PTSIOFF', 'Permohonan pembelian 40 printer', 168, '2025-01-21 00:00:00', 'Raditya Unit Perkasa', 'Manager Finance 01', '0', 'Permohonan pembelian 40 printer', 1000000, '<p>yrd</p>', NULL, '2025-01-20 08:22:10', '2025-01-20 08:22:10', 0),
(6, 'Inv/001/PTSIOCC', 'Permohonan pembelian 80 printer', 170, '2025-01-21 00:00:00', 'Raditya Unit Perkasa', 'Brand Finance 01', '0', 'Permohonan pembelian 80 printer', 1000000, '<p>tesss</p>', NULL, '2025-01-20 11:48:54', '2025-01-20 12:05:20', 1),
(7, '0888/0002/11DF', 'new permohonan 001', 167, '2025-01-23 00:00:00', 'Raditya Unit Perkasa', 'agoes vinance', '0', 'new permohonan 001', 10000000, '<p>tesss</p>', NULL, '2025-01-22 08:15:13', '2025-01-22 08:15:13', 0),
(8, '0982/7786/OOPU', 'tess pengadaan', 167, '2025-01-23 00:00:00', 'Raditya Unit Perkasa', 'agoes vinance', '0', 'tess pengadaan', 5000000, '<p>tesss aa</p>', NULL, '2025-01-22 08:17:45', '2025-01-22 08:22:01', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_unit_usaha` int(11) NOT NULL DEFAULT 0,
  `is_unit_usaha` tinyint(1) NOT NULL DEFAULT 0,
  `aktif` tinyint(1) NOT NULL DEFAULT 0,
  `signature` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`id`, `uuid`, `name`, `note`, `created_at`, `updated_at`, `deleted_at`, `id_unit_usaha`, `is_unit_usaha`, `aktif`, `signature`) VALUES
(1, '433581cd-6967-47b3-8282-a850ebf706c9', 'admin', 'Input Data', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(2, '2e06a06d-a57c-4814-97e4-764a736016ff', 'VD of Accounting', 'Staff Akuntan', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(3, 'b67ccd35-4509-48ab-88d8-b6cfcd85b2c8', 'VD of Accounting - Finance', 'Penanggung Jawab Barang Keluar/Masuk', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(4, '29baae70-c5cb-402b-83f0-b76577c735b2', 'Manager Of Finance', 'Input Data Keluar/Masuk', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(5, '5b17aae3-b73c-4f3e-b50b-fcac63708939', 'General Cashier', 'General Cashier', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(6, 'b434c2c5-e217-459a-ab06-9829566f41ee', 'manager', 'Manager', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(7, '93b40807-3d3f-4beb-b6dd-83ceba3d7e58', 'pic inventory', 'PIC Inventory', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(8, '9b6ae34c-ac53-439d-8ad4-d448d4942988', 'Board Of Finance', 'Board Of Finance', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(9, 'bd6ddd27-61da-4469-ad7b-d0ba4083b1ca', 'super admin', 'Penanggung Jawab Penuh Data', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(10, 'b2f5c8c3-8bd8-40a5-bbc2-acf306449504', 'owner/ceo', 'Pemilih Usaha', '2024-12-06 18:56:46', '2024-12-06 18:56:46', NULL, 0, 0, 0, 0),
(61, '3ce4a9f4-2176-4825-bea8-83aaf3af0b4c', 'Branch Manager', 'Branch Manager', '2024-12-06 21:17:24', '2024-12-06 21:17:24', NULL, 63, 1, 1, 1),
(63, '0b87ef13-4bf7-4036-8eea-a573fe2fced4', 'Assets', 'Assets', NULL, '2024-12-07 02:20:25', NULL, 0, 0, 1, 0),
(64, '2ef0bbea-a108-48ab-b5cf-639f2b7cd4bd', 'General Manager', 'General Manager', '2024-12-09 02:20:34', '2024-12-09 02:20:34', NULL, 63, 1, 1, 1),
(65, 'ea750c46-9e90-47c1-beb1-94aa50bcb024', 'PIC Unit ( One Of The BOD )', 'PIC Unit ( One Of The BOD )', '2024-12-09 02:21:24', '2024-12-09 02:21:24', NULL, 63, 1, 1, 1),
(66, 'bc44469f-90bf-44a1-8756-e1f219e9be63', 'Sekretariat', 'Sekretariat', '2024-12-09 02:21:37', '2024-12-09 02:21:37', NULL, 63, 1, 1, 1),
(68, '7a3ecfea-ebff-404c-a333-ccaeca516300', 'Vd of Accounting finance', 'Vd of Accounting finance New', NULL, NULL, NULL, 0, 0, 0, 0),
(69, 'd8cb40df-9242-4db0-8658-b8b3bc0f3e09', 'manager of finance', 'manager of finance', NULL, NULL, NULL, 0, 0, 0, 0),
(70, '1f2d632f-04cd-4b50-af88-f9a89cf492f0', 'Brand of finance', 'Brand of finance', NULL, NULL, NULL, 0, 0, 0, 0),
(71, 'fd3430d8-bf9e-4c15-aad7-07c9fa3ff41f', 'General Cashier', 'General Cashier', NULL, NULL, NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_holding`
--

CREATE TABLE `role_holding` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roleId` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_pembayaran`
--

CREATE TABLE `role_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_unit_usaha` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_pembayaran`
--

INSERT INTO `role_pembayaran` (`id`, `id_user`, `id_unit_usaha`, `id_role`, `urutan`, `aktif`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 63, 65, 0, 1, NULL, '2025-02-03 08:03:51', '2025-02-03 08:03:51'),
(2, 0, 63, 8, 0, 1, NULL, '2025-02-03 08:04:14', '2025-02-03 08:04:14'),
(3, 0, 63, 71, 0, 1, NULL, '2025-02-14 08:13:37', '2025-02-14 08:13:37'),
(4, 0, 63, 64, 0, 1, NULL, '2025-02-14 08:13:50', '2025-02-14 08:13:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_pengadaan`
--

CREATE TABLE `role_pengadaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_unit_usaha` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipe_surat` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_pengadaan`
--

INSERT INTO `role_pengadaan` (`id`, `id_user`, `id_unit_usaha`, `id_role`, `urutan`, `aktif`, `deleted_at`, `created_at`, `updated_at`, `tipe_surat`) VALUES
(1, 0, 63, 61, 1, 1, NULL, '2025-02-01 01:12:57', '2025-02-15 02:52:23', 0),
(3, 0, 63, 4, 1, 1, NULL, '2025-02-09 02:43:07', '2025-02-09 10:14:50', 1),
(4, 0, 63, 65, 4, 1, NULL, '2025-02-09 02:45:34', '2025-02-15 02:52:23', 0),
(7, 0, 63, 68, 1, 1, NULL, '2025-02-09 09:18:40', '2025-02-09 10:14:50', 1),
(9, 0, 63, 5, 3, 1, NULL, '2025-02-09 09:22:20', '2025-02-15 02:52:23', 0),
(10, 0, 63, 4, 2, 1, NULL, '2025-02-09 09:23:04', '2025-02-15 02:52:23', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_petty_cash`
--

CREATE TABLE `role_petty_cash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_unit_usaha` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_petty_cash`
--

INSERT INTO `role_petty_cash` (`id`, `id_user`, `id_unit_usaha`, `id_role`, `urutan`, `deleted_at`, `created_at`, `updated_at`, `aktif`) VALUES
(3, 0, 63, 68, 1, NULL, '2025-01-19 01:49:36', '2025-01-20 10:57:44', 1),
(4, 0, 63, 69, 2, NULL, '2025-01-19 01:49:56', '2025-01-20 10:57:44', 1),
(5, 0, 63, 70, 3, NULL, '2025-01-19 01:50:17', '2025-01-20 10:57:44', 1),
(6, 0, 63, 71, 4, NULL, '2025-01-19 01:51:05', '2025-01-20 10:57:44', 0),
(7, 0, 63, 65, 0, NULL, '2025-01-20 10:30:12', '2025-01-20 10:57:44', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_unit_usaha`
--

CREATE TABLE `role_unit_usaha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roleId` int(11) NOT NULL,
  `idUnitUsaha` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `statusdokumen`
--

CREATE TABLE `statusdokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `template_surat`
--

CREATE TABLE `template_surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tmplName` varchar(255) NOT NULL,
  `tipeSurat` int(11) NOT NULL,
  `isiSurat` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alias` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tipe`
--

INSERT INTO `tipe` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`, `alias`) VALUES
(1, 'Pengadaan', NULL, NULL, NULL, 'Pengadaan'),
(2, 'Pembayaran', NULL, NULL, NULL, 'Pembayaran'),
(3, 'Petty Cash', NULL, NULL, NULL, 'Petty Cash');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_bisnis`
--

CREATE TABLE `unit_bisnis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_usaha`
--

CREATE TABLE `unit_usaha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `limit_petty_cash` bigint(20) NOT NULL,
  `jumlah_unit` smallint(6) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_unit_bisnis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `unit_usaha`
--

INSERT INTO `unit_usaha` (`id`, `name`, `limit_petty_cash`, `jumlah_unit`, `status`, `created_at`, `updated_at`, `id_unit_bisnis`) VALUES
(1, 'Dr. Demarcus Bechtelar DVM', 88948158, 5, 0, NULL, NULL, 0),
(2, 'Karine Kunde', 145130332, 14, 0, NULL, NULL, 0),
(3, 'William Pfeffer V', 34993973, 8, 1, NULL, NULL, 0),
(4, 'Stone Walsh', 71128888, 10, 0, NULL, NULL, 0),
(5, 'Roderick Aufderhar IV', 27366551, 2, 0, NULL, NULL, 0),
(6, 'Salvatore Mann MD', 184196027, 8, 1, NULL, NULL, 0),
(7, 'Sigmund Effertz', 97919234, 18, 1, NULL, NULL, 0),
(8, 'Loyce Cormier', 146504227, 5, 1, NULL, NULL, 0),
(9, 'Abigail Runte', 190112723, 7, 1, NULL, NULL, 0),
(10, 'Abigale Ebert III', 60634922, 7, 1, NULL, NULL, 0),
(11, 'Grace Kiehn', 85372644, 15, 0, NULL, NULL, 0),
(12, 'Hillary McClure', 133664922, 5, 0, NULL, NULL, 0),
(13, 'Dr. Sim Hickle', 126346427, 18, 0, NULL, NULL, 0),
(14, 'Ms. Arvilla Wehner II', 60659302, 3, 0, NULL, NULL, 0),
(15, 'Shanelle Emmerich', 123937625, 3, 1, NULL, NULL, 0),
(16, 'Bonita Schroeder', 120595705, 19, 0, NULL, NULL, 0),
(17, 'Giovanny Hammes', 35105023, 16, 1, NULL, NULL, 0),
(18, 'Mr. Marshall Ullrich IV', 184025070, 12, 1, NULL, NULL, 0),
(19, 'Russell Powlowski', 38269940, 1, 0, NULL, NULL, 0),
(20, 'Melvina Morar', 84794007, 12, 0, NULL, NULL, 0),
(21, 'Alba Hoppe', 64974752, 11, 0, NULL, NULL, 0),
(22, 'Gaylord Feil', 70249691, 2, 1, NULL, NULL, 0),
(23, 'Bobby Larson', 82709606, 17, 0, NULL, NULL, 0),
(24, 'Dr. Daron Brown', 193257556, 15, 0, NULL, NULL, 0),
(25, 'Lolita Borer', 27798528, 20, 0, NULL, NULL, 0),
(26, 'Zella Lebsack', 84128753, 11, 0, NULL, NULL, 0),
(27, 'Aidan Cassin', 176837562, 13, 1, NULL, NULL, 0),
(28, 'Sydnie Kautzer', 73908213, 6, 1, NULL, NULL, 0),
(29, 'Ila Kling', 68145514, 10, 1, NULL, NULL, 0),
(30, 'Catherine Kemmer', 21285603, 10, 0, NULL, NULL, 0),
(31, 'Marlene Ratke V', 151309895, 7, 0, NULL, NULL, 0),
(32, 'Pattie Paucek DDS', 140867482, 5, 1, NULL, NULL, 0),
(33, 'Louie Gottlieb', 98832543, 4, 0, NULL, NULL, 0),
(34, 'Prof. Corene Langosh', 119614932, 18, 0, NULL, NULL, 0),
(35, 'Angelita Witting', 134301108, 11, 1, NULL, NULL, 0),
(36, 'Annette Lubowitz I', 73409355, 4, 1, NULL, NULL, 0),
(37, 'Shayna Powlowski', 191961326, 5, 1, NULL, NULL, 0),
(38, 'Ms. Noemie Wisoky II', 155297086, 15, 0, NULL, NULL, 0),
(39, 'Miss Jackeline Krajcik DVM', 149525740, 7, 1, NULL, NULL, 0),
(40, 'Prof. Carleton Hane', 172356262, 9, 1, NULL, NULL, 0),
(41, 'Brayan Ward PhD', 123299629, 8, 0, NULL, NULL, 0),
(42, 'Keira Dooley', 69766657, 4, 1, NULL, NULL, 0),
(43, 'Jon Funk', 183419413, 0, 1, NULL, NULL, 0),
(44, 'Kennedi D\'Amore', 186682741, 14, 0, NULL, NULL, 0),
(45, 'Mikel Hammes', 189352814, 2, 1, NULL, NULL, 0),
(46, 'Macy Hettinger', 31906664, 2, 1, NULL, NULL, 0),
(47, 'Andre Lind', 198995979, 18, 1, NULL, NULL, 0),
(48, 'Taryn Gleichner I', 52035539, 13, 0, NULL, NULL, 0),
(49, 'Oda Rutherford', 71052790, 0, 1, NULL, NULL, 0),
(50, 'Amber McDermott', 187322278, 19, 0, NULL, NULL, 0),
(51, 'Ms. Crystal Ledner V', 124848399, 5, 1, NULL, NULL, 0),
(52, 'Fritz Emard', 179118716, 16, 0, NULL, NULL, 0),
(53, 'Miss Rose Konopelski', 181725683, 19, 0, NULL, NULL, 0),
(54, 'Kasey Thompson', 181322547, 10, 1, NULL, NULL, 0),
(55, 'Kenna Nicolas', 179126839, 20, 1, NULL, NULL, 0),
(56, 'Rhoda Robel II', 53637158, 13, 1, NULL, NULL, 0),
(57, 'Dorris Roberts', 103077460, 2, 1, NULL, NULL, 0),
(58, 'Erin Lockman', 169315720, 19, 1, NULL, NULL, 0),
(59, 'Keith Mayer', 177434301, 12, 1, NULL, NULL, 0),
(60, 'Mr. Columbus Steuber DVM', 39963424, 2, 0, NULL, NULL, 0),
(61, 'Susie Ferry', 156419062, 0, 1, NULL, NULL, 0),
(62, 'Wendy Dicki', 102234148, 13, 1, NULL, NULL, 0),
(63, 'Raditya Unit Perkasa', 145744111, 3, 1, NULL, '2024-12-14 22:39:04', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_positions` varchar(255) NOT NULL DEFAULT 'user',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `reset_password_token` varchar(255) NOT NULL,
  `role_pengadaan` smallint(6) NOT NULL DEFAULT 0,
  `role_pembayaran` smallint(6) NOT NULL DEFAULT 0,
  `role_id` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `signature_url` varchar(255) NOT NULL,
  `role_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_positions`, `role`, `deleted_at`, `is_verified`, `reset_password_token`, `role_pengadaan`, `role_pembayaran`, `role_id`, `status`, `signature_url`, `role_status`) VALUES
(1, 'Raditya Perkasa Unit', 'ibasmara@gmail.com', NULL, '$2y$10$G9UBa0zY1VYxnB8PC/AvJ.fpZ2AFv0WjbGM4mrb9yDJX91k/wwT46', NULL, '2024-12-06 18:57:54', '2025-01-14 07:06:17', '-1', 'admin', NULL, 1, '-', 0, 0, 0, 1, 'signatures/signature_67867d69040141.26630350.png', 0),
(2, 'Gusmang BM', 'hal83@gmail.com', NULL, '$2y$10$AOIYHEWIGR89INwHpCRN8uHe4r.Cf7ZPIy3kCHPBVdR9tiKDBBYO6', NULL, '2024-12-06 18:57:54', '2024-12-24 22:22:53', '63', 'Branch Manager', NULL, 1, '-', 1, 0, 61, 1, 'signatures/signature_676ba4bd6cb1a9.22355710.png', 1),
(3, 'Prof. Michale Wintheiser I', 'bgleichner@turcotte.com', NULL, '$2y$10$fQfyNuZGlHplC6Ny7zC.xuEA2AITdeHeBL/LykVRth2O1RR3TjYHW', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '3', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(4, 'Rodrigo Bradtke', 'rbednar@gmail.com', NULL, '$2y$10$9qVxcJW07ImmMcSg5iBP2OkfmPOQ8I6U3B2pwhvWHes1ewrAB6Yz6', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '4', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(5, 'Santino Schowalter MD', 'buford69@kessler.com', NULL, '$2y$10$G/UtQ7vIdCk.vZZMoGGSl.7DmB49hsLTOjxSWSy1v0U1TF6a0UWBu', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '5', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(6, 'Mrs. Aurelie Kassulke IV', 'iroob@yahoo.com', NULL, '$2y$10$SwMPal9hsJXZGmkWX654hOteXQFaXrOc6WWGErZ8es87OBPSU1WBu', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '6', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(7, 'Alejandrin Cole', 'douglas.bruen@gmail.com', NULL, '$2y$10$ZwBvmLeUsWBoedzMf7z4AuoJ0OLAVXB0pMgFSqhaK.cVPRdIz/HsO', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '7', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(8, 'Gregory DuBuque', 'mortimer.armstrong@gmail.com', NULL, '$2y$10$WKHF5WdNxT.i9ocK4EJ7W.kCnrSbcxQ2LkISyeR5hpzOnHInfzh5q', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '8', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(9, 'Jermaine Kuhlman IV', 'andres51@yahoo.com', NULL, '$2y$10$NMuLb.ACchg27LgWH7r8YOFUlouZ5bqvq2PWSODtKdJNkm4ySFPWu', NULL, '2024-12-06 18:57:54', '2024-12-06 18:57:54', '9', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(10, 'Mrs. Evangeline Johnston', 'destin73@hotmail.com', NULL, '$2y$10$aS/CfWD.u2Zrz5DENitIt.LLTHiv.0mLKOM2wEzTTYIp01ISBcKw.', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '10', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(11, 'Miss Bonnie Carter I', 'qromaguera@gmail.com', NULL, '$2y$10$WZjFd4Rr0qTb8AefvfIKvuoH8h1Bcciu/Op6EUECzHKvLcnavzKRi', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '11', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(12, 'Bette Kunze', 'kristofer73@emmerich.com', NULL, '$2y$10$.4CdLFFF4iPW2jMkTb8KpOWwyOaPp3ydl0NJWZ9VSrJm7CDxUXetG', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '12', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(13, 'Anissa Corwin', 'skiles.jessy@lemke.biz', NULL, '$2y$10$WmcjmADuj.NttbOn1Beh..0KSqo/HpLZeEtVk0aXtfGgN1AwvM0/W', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '13', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(14, 'Mckenna Kub IV', 'patrick.powlowski@rowe.com', NULL, '$2y$10$/q6Fty5t7cAqzdm0n/ViluFV1m9rkCO3UiXfHqe3unHA80CoLx/iO', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '14', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(15, 'Jeffery Zulauf', 'bertha.upton@pagac.net', NULL, '$2y$10$cY5DZrExiQYaSbxdDoU0POAAAdxL0/gwF/qIBgI3PP/ljCHECrctG', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '15', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(16, 'Corrine Pfeffer', 'dhermann@gmail.com', NULL, '$2y$10$DQ.HJDbKfNXUI/qjwffWyurq7Dsq5Wrt2XLKTSJ/Deqmf3vuo4/x6', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '16', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(17, 'Vida Brakus', 'frolfson@yahoo.com', NULL, '$2y$10$pibT0MKOQhooEg3l1cifI.ll2hD1qh5MkEn7tLi0c3L1/3NwwUKEC', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '17', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(18, 'Gaylord McGlynn', 'bette.balistreri@hotmail.com', NULL, '$2y$10$MCKsdYLr0/3.FRCF7y9BCOB3HCAVs/ENutfWGm.S3URj/oA2Xlm2O', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '18', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(19, 'Prof. Kelsi Ward III', 'fannie93@bauch.net', NULL, '$2y$10$.NvwrtLqHgjuiyXCJw2T2OdRMejU1QsVJx58U7MD8ICd1Cn9reZ7W', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '19', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(20, 'Nash Runolfsdottir II', 'sister86@terry.com', NULL, '$2y$10$MihVIja.a9DRnhfB/gNN8.Uo0kQq4JpzVJ1cZHf4Kopt/hMaeId2a', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '20', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(21, 'Prof. Rudy Hodkiewicz DDS', 'dwight.bauch@gmail.com', NULL, '$2y$10$4fA0PZAbT8WOdcLQitSk3uN39UZbQJUnSag27jHFhbzuZLdR7GeA6', NULL, '2024-12-06 18:57:55', '2024-12-06 18:57:55', '21', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(22, 'Sheila Cummerata', 'ihilpert@hotmail.com', NULL, '$2y$10$RXmFlOOA7GlspPQZMgmFQe8iNzRscJ0wD5S4HYWh4/JS0fSXUsL.6', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '22', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(23, 'Jessy Kuvalis DVM', 'owaters@hackett.info', NULL, '$2y$10$K6GlhcF/qQR.zS5SEFx.tuV.JOd4lBAVaORtKWc.leKF3kjbstj0K', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '23', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(24, 'Katlynn Gerlach MD', 'casandra.adams@cummings.net', NULL, '$2y$10$g3/CFLRrcP19V9FLFY1K2OV4B80z7aX1hFbCLCZarMqfHS5TOLSHu', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '24', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(25, 'Kira Cremin', 'kian42@hartmann.org', NULL, '$2y$10$I12OEvYWw3iwJux4R1LZTuBcA.s0SmLaYEut0WcwaMKhT0diJ6Fku', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '25', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(26, 'Dr. Jerome Gaylord', 'waters.makenzie@nader.com', NULL, '$2y$10$kxfehvjKzAG0plgsaxurjOA3H6hwP2Dvz8lAQVczP0/EXvAsWPGbO', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '26', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(27, 'Cody Nitzsche IV', 'wreynolds@jerde.net', NULL, '$2y$10$RZ3URKlqJOQwmZLBNzguquvMjZhjktLO2uhPDl549wwy4v1e66ckO', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '27', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(28, 'Ms. Mikayla Marquardt I', 'jarvis.harris@gmail.com', NULL, '$2y$10$mY.WJTSy6ZNKJQFiuQQB1.ImScBJLfdmMg9C1FwdDkioSCOlyEglq', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '28', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(29, 'Harley Dibbert', 'lesch.roma@okeefe.biz', NULL, '$2y$10$Oz2H06yxWUFHgTbiZsEuBuP0.YO83GAe2kJ7SJabhxeniIYq7ww6m', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '29', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(30, 'Kenton Kub', 'cronin.reese@baumbach.com', NULL, '$2y$10$c0vDDflJa3Rujo3qQX1kWup.Fxr2YqAc6toYdYAfdteAWFj0STpna', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '30', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(31, 'Arielle Murphy', 'wintheiser.kraig@beahan.net', NULL, '$2y$10$yUMv1onmzI8XQe5oGjWRt.UHCpssVu/HSCFL6avw9WGFcXDNxhEmS', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '31', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(32, 'Mack Gottlieb', 'satterfield.barry@yahoo.com', NULL, '$2y$10$RBuuIPy8Zky2GNukYrnfnO7rBi0tB3rdgKOyCkXSkbDBD6d4tUJwq', NULL, '2024-12-06 18:57:56', '2024-12-06 18:57:56', '32', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(33, 'Dr. Marilyne Senger', 'djohnston@hotmail.com', NULL, '$2y$10$XQYsxbXbu0ImcaOTIXuhBO44EvKmHU4anQPeDh9xxSkOwupaUmgze', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '33', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(34, 'Sidney Jones', 'larson.jazlyn@yahoo.com', NULL, '$2y$10$pi716aEPHWWTVDHGJZp21ul7mBSpLHEuTD8Pnj.e2GbjTNXcYM5wS', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '34', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(35, 'Talia Rolfson', 'waylon54@gmail.com', NULL, '$2y$10$//aN0kb9sTkwxovVNTw3AOwwfwezGzeV5.QgV5esC0X.DSLS7SHBW', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '35', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(36, 'Andre Conroy I', 'vprosacco@blick.com', NULL, '$2y$10$ASHTjhWdZgXNe/Jj9Me45.N/HRixgpdKclGNe/gF6Yr7HqBov02pq', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '36', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(37, 'Daryl Daniel', 'katelyn.abshire@gmail.com', NULL, '$2y$10$Sh8i9qmo2Cs7f53O8aDuxuGihXqvz9m.tfp.xN0zPR48QLQ.pYUOS', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '37', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(38, 'Ms. Maryse Ullrich', 'dbartoletti@yahoo.com', NULL, '$2y$10$JRFRjmKf5/6qblCNQMqtme1i0twaOQr1Y2WbfzHQuNOwSPLM8/DKS', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '38', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(39, 'Hugh Cole', 'eichmann.wyman@hotmail.com', NULL, '$2y$10$RpL7WZBgCn8mjcxqYFUTN.XletnbIYaO8jkYL8KQiJp4N13A8ioQi', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '39', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(40, 'Alden Bechtelar', 'angeline19@moen.com', NULL, '$2y$10$8M6BUl0Wve3aBxTQVdmP8.wPh9l8Z3lfI5Dg5JbzcB0NgWhF1YLSq', NULL, '2024-12-06 18:57:57', '2024-12-06 18:57:57', '40', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(41, 'Miss Adella Kuvalis', 'legros.winona@gmail.com', NULL, '$2y$10$xl3yiT59LKrz2q4bcI7T0ef5tVRFL1T3/FMe0dQOdcsTypL8CmwzW', NULL, '2024-12-06 19:00:00', '2024-12-06 19:00:00', '1', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(42, 'Prof. Alden Roberts', 'bulah73@weimann.com', NULL, '$2y$10$Dfy7Eo46lJhxQAsF0LA77eyw.yZU4uBgY6taaRrDruGY.1QAvlPjm', NULL, '2024-12-06 19:00:00', '2024-12-06 19:00:00', '2', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(43, 'Rowena Collins', 'emerson.waters@hotmail.com', NULL, '$2y$10$bh.7BwXDWkS4NEnOBINYTOVbPEEKSzTN9c.bojhulGy0P0nF9c4fi', NULL, '2024-12-06 19:00:00', '2024-12-06 19:00:00', '3', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(44, 'Drew Dooley IV', 'alene00@christiansen.org', NULL, '$2y$10$7R/eU.5y1H5UxWsnZkSf1eAzNXZExFAKMSDZiCSkM7PNGjXHQ5g9S', NULL, '2024-12-06 19:00:00', '2024-12-06 19:00:00', '4', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(45, 'Prof. Stephen Rogahn', 'gia54@hirthe.com', NULL, '$2y$10$DVgUoQcpWFAyOV2eq5RHFONmrGW3wpj1eD0EIBO0up7EcZ1Lx3hH.', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '5', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(46, 'Kali Morar', 'bdickens@gmail.com', NULL, '$2y$10$DsTJoWbJT0ArakM9CPYr9eEdM91jIQA/fEmhRo6qPcw7pEVlAn7tm', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '6', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(47, 'Emanuel Watsica', 'aritchie@hotmail.com', NULL, '$2y$10$njWj8TuxVRnQrikYVaw0re7hSioRD2KImTSObVTGBIeStnu6FMN6W', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '7', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(48, 'Rudy Bradtke PhD', 'johnson.gottlieb@dickinson.com', NULL, '$2y$10$0L6wSUhUjIROntMIBqJP8ez0N0xctR74wX/ytNn7gaF3/J71lwDWi', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '8', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(49, 'Jairo Beahan', 'kemmer.geovanny@hotmail.com', NULL, '$2y$10$RP.OPupsdqBwFY2Qf1UtjOGZ5UnvK4DS2dIzLtNNS2otroKMwdDCS', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '9', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(50, 'Mr. Andrew Koepp I', 'ckassulke@hermann.org', NULL, '$2y$10$/ugL6PmYzB.YnV3GLQOzdO/ViNyFxF3n1.ctV4jMfMscRvEDhvFSa', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '10', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(51, 'Ernesto Greenfelder Jr.', 'amber52@feeney.org', NULL, '$2y$10$VzRf3jcV.cu2QmJcTeWNl.kjLtYtp5GkKjn.F8gRbuwMjBVgXE4Uu', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '11', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(52, 'Ludwig Runte', 'madison31@tremblay.com', NULL, '$2y$10$DLC.7/toUFCzgvxIDDoigeHYLrmLSaZr740QDwhu6To8n/677Oqp6', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '12', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(53, 'Devyn Jacobson DDS', 'arlo05@tillman.biz', NULL, '$2y$10$YGcAdClu3XbQbWQpVy27u.uJZnEcipGJnLxe.IwnMGssMhoJBOf4i', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '13', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(54, 'Afton Stracke PhD', 'ofeest@veum.com', NULL, '$2y$10$NY28Qzq3.Qf7w3.QMhNBFuZwWkmXhvN7PW3n1N5XwBP28JYcGjRZG', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '14', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(55, 'Brandt Beier', 'willard78@gorczany.biz', NULL, '$2y$10$OPYj/IXrXkLKGmZdebP1gebu5637P7SGimcf55Zp4M2isGGvmwnHW', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '15', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(56, 'Mr. Toby Legros DDS', 'coy83@eichmann.com', NULL, '$2y$10$f.rJxshzmoaaRDn4yA9ouen1nEyVqn2J4n8QO4SjFfwLmhPT3K4vG', NULL, '2024-12-06 19:00:01', '2024-12-06 19:00:01', '16', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(57, 'Lily Nikolaus I', 'diego.gusikowski@heathcote.com', NULL, '$2y$10$WjFqwT.d3D1Jo5nu3KQfn.y6rqwlIgZVSz4YtYUo58mgO9dA5tQUa', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '17', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(58, 'Mr. Zachery Bode', 'gweber@gmail.com', NULL, '$2y$10$Z4D3QzLaLDER5Kj5mxlJfOKml7aLxPW.dEDNQp87Sd92XSlfMP8F.', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '18', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(59, 'Prof. Vicenta Beahan Jr.', 'loy24@yahoo.com', NULL, '$2y$10$Alwg8ec.SFjQd.ET0MI/JOJSdsY/CyrfNqJXe97BFsca4lGAkhFBa', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '19', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(60, 'Arlo Fisher', 'pkozey@yahoo.com', NULL, '$2y$10$9u7mknemu8R2k/.gMOrfauig6ba5wlSFk3Ey.nv6wy3ybxMlK.Lc6', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '20', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(61, 'Mrs. Evangeline Mohr', 'gloria05@yahoo.com', NULL, '$2y$10$vqtMpY.WgDjETbusjuHpNeWpzaiLIl11VfMuB85ZpTj8fwebnLHpO', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '21', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(62, 'Mrs. Wilhelmine Thiel MD', 'olga.monahan@harvey.com', NULL, '$2y$10$O58zVvqEeHSN/21OZxciVehmsFUJaTBbrnIzKxrrhfJSSZUecjZ4u', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '22', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(63, 'Miss Alejandra Kuhlman DDS', 'jonas.padberg@yahoo.com', NULL, '$2y$10$rkqS5rksZvQF7YJHILZEROA6TfR34giGA5/Al96ctAvCZOxl78CDu', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '23', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(64, 'Myah Ernser', 'tyra.hickle@hotmail.com', NULL, '$2y$10$uiP/ksC2Pu55TOQ9H592XuwtlW37C0pfSQMVEVfZfi2VP1OTmmfgu', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '24', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(65, 'Myrl Powlowski', 'adriel.morissette@bins.com', NULL, '$2y$10$ZrxiErDi4U6v0TAP4evwMOZ0oGY85RWDy5o4qlwLdpy1PBDZtyFAC', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '25', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(66, 'Lorenza Schmidt Sr.', 'aditya.rempel@rodriguez.biz', NULL, '$2y$10$JJgTaL4YUzMMQLlgh2SDW.eb7YX.dUZHj3VyrBxtyDL3R6sA0vVla', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '26', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(67, 'Carlo Schamberger', 'shyann52@gutmann.com', NULL, '$2y$10$p7/24tufETf84j.gdrxuC.4jP5tjooj5fhr6rRPoFT.q99Vu2axI6', NULL, '2024-12-06 19:00:02', '2024-12-06 19:00:02', '27', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(68, 'Hal Torphy', 'thomas.labadie@smitham.org', NULL, '$2y$10$Z5hG2IUnMncnJtUjLYRogOJ1.ctUK.cC7NysNgUBLb6IOh6rzkr8i', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '28', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(69, 'Armani Barrows', 'xander.larkin@yahoo.com', NULL, '$2y$10$0s4wXLS8AORKf2g72O3/UedOWfQmqPYogXiQqnwOvi2g/Q8/8cnsC', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '29', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(70, 'Roberta Pagac', 'jcasper@gmail.com', NULL, '$2y$10$tRP8/q9DpxGgkRhIvbw8dOKiZad9ONNDUv7f66SVjDNqr10mXxJtO', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '30', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(71, 'Elenora Toy', 'qturner@kunze.com', NULL, '$2y$10$tSbIwGnjxiz51.K7pu70P.uVfJlKLFbWaNo2UFAc83UXSz2WiDL3e', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '31', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(72, 'Rashawn Batz', 'qbechtelar@grady.com', NULL, '$2y$10$nQCLx3AbdxkpugmT9XU3XOiWSl0MSRqAA4zz571Oxy.n3PnWrocaG', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '32', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(73, 'Dr. Maxwell Ruecker', 'franecki.kenyon@gmail.com', NULL, '$2y$10$46ArWDXdV95KZCa/SvUwPOJORnGMPSAZIO.o.rh.8xh0dfJgIAKYu', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '33', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(74, 'Isidro Cormier V', 'cristobal.veum@bayer.com', NULL, '$2y$10$/e3ooMzdWrjgnJaoLH9d/uqY/7KhCEVHsS4XYqK6zRGobKi.jt.ee', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '34', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(75, 'Gordon Schamberger', 'aaron.kreiger@hotmail.com', NULL, '$2y$10$aEw8J0ecxZU5.9NjOvEw1u/ORn4IvVUPtCit2O0XjvjsWAPSF/1hG', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '35', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(76, 'Kole Batz', 'vincent26@yahoo.com', NULL, '$2y$10$u7M.7jsxvztSCsc4rWC7Xu./OIp2iu.UAsJdz5odQ6ZPRn5U7Nroi', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '36', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(77, 'Heidi McCullough', 'roscoe.kerluke@gmail.com', NULL, '$2y$10$CbFVAF5EdjsXy5lNQDjds.FcQu4GGhtFu6BpfAAC1oDfwukXDyTra', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '37', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(78, 'Dr. Oren Okuneva', 'okuneva.zola@rutherford.net', NULL, '$2y$10$vRcVccEMj3gke0GsbLkJkO1o3cHahZ4rbwUkdMzo5/AI/DfEhljQG', NULL, '2024-12-06 19:00:03', '2024-12-06 19:00:03', '38', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(79, 'Selena Schiller', 'mmaggio@gmail.com', NULL, '$2y$10$9NyNYRtMYuFNHRjdjOFtYO/D4Nr6zZGu4x3cOI3GFMx.eEspYQIBK', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '39', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(80, 'Mr. Rico Bosco DDS', 'braun.agnes@gmail.com', NULL, '$2y$10$/xFt74eHxz75uZZ3OuyUx.6CrW.OHzFHIO8a.qSzrQk9WsOjdv0U6', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '40', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(81, 'Keira Bogisich', 'jrogahn@gmail.com', NULL, '$2y$10$gpKOk8MMMqG9CBF9OWv5KO7sVx4whq1u1uUS3LbYmyhSgm2i/fgVK', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '41', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(82, 'Prof. Theo Braun Jr.', 'kara.kozey@yahoo.com', NULL, '$2y$10$aNownYcoCmPtKqA0KDOHJuLWy.zbcPSXKk5eqIZQZREYlMZAIogGS', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '42', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(83, 'Ceasar Walter', 'norris00@osinski.com', NULL, '$2y$10$qkfvvGAf7OeXJLORipetR.zxSwisXWZavx6n1ODlxwqYPGlGyAHbW', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '43', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(84, 'Torey Zulauf', 'brenner@gmail.com', NULL, '$2y$10$W76XP5JJsfr1.TmTpSiYpO3JsZgwPvlXG94jPqRiQXHI2Sl.fFyNS', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '44', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(85, 'Avis Turner', 'michele.hand@hotmail.com', NULL, '$2y$10$6.VVLhaOBHwZFtITssW9keRmYvpNtZK1S/NNrm1cK7rIrjbbSp3NS', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '45', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(86, 'Jamil Effertz PhD', 'melisa.simonis@hotmail.com', NULL, '$2y$10$61EJAelMLOV99R68lBaUbeFlAv/64ihcVYJapDBKKS7x3OoD./FAq', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '46', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(87, 'Alexandra Ernser DDS', 'streich.cleo@weissnat.com', NULL, '$2y$10$sCqZ62fbXlDcxtAaooL/FuD5FX2dpHxb5uQB/gOZkx6u3lHzCENx.', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '47', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(88, 'Helga Howell', 'svonrueden@heaney.com', NULL, '$2y$10$z21z08yoHvZWmKWkJ38foefombzE4UG2EYAmP/a2UspZA8Y8okIxC', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '48', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(89, 'Elda Erdman', 'josue33@funk.net', NULL, '$2y$10$5/Ry9a2w0oextzokkGCzvuFf0cKUQLyC6oOzqHQST/5xqVltS96Ja', NULL, '2024-12-06 19:00:04', '2024-12-06 19:00:04', '49', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(90, 'Anais Jerde', 'goyette.mireya@balistreri.biz', NULL, '$2y$10$yjFVOK6ElajC.OI/ro2IeO8wrOjYLf/J5gdlspiDyyoswJbWVERGy', NULL, '2024-12-06 19:00:05', '2024-12-06 19:00:05', '50', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(91, 'Alexandre Harvey', 'bogan.lambert@gmail.com', NULL, '$2y$10$eX9yQHGbF5ZC5yryLQAf5..UwrTG3HEbX2WjpPHK0oV9LpmISlw32', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '1', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(92, 'Mr. Ross Parker', 'heathcote.kaelyn@braun.com', NULL, '$2y$10$JDZU0RvL8X9CbxR4nmdGsedLd8tjKQOMylp0MToAJ0kjawcn.vVWC', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '2', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(93, 'Nella Barton', 'ankunding.kariane@raynor.com', NULL, '$2y$10$zb8Ju1nD/xO6SvYPprIqB.p2Jvy9uQ.ZWehii4rQCnJceGEsQ6xq.', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '3', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(94, 'Ms. Ana Dickens PhD', 'udenesik@yahoo.com', NULL, '$2y$10$/F2u53TJBuiFk2Ivls8JlOJ6JxaXIRmdZBA/K3yex1bxJ09jrYSMa', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '4', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(95, 'Petra Stehr', 'nolan.jovani@hettinger.org', NULL, '$2y$10$gnxw28OQYNLig.AFS9IvkeVryiKiNpVI1pCTOZnvtMuSxk71RmtSm', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '5', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(96, 'Brenda Jast', 'ahmed.torphy@yahoo.com', NULL, '$2y$10$IAqf23P7JVD2Gc2A2es7WOVFSds/tUOVhLOa5xIfavNlX9DLqQici', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '6', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(97, 'Nat Gulgowski', 'dayne78@johnston.org', NULL, '$2y$10$UPV4bfI6ch1nP1KoS7hj.egzwHN5niwots1DCxZOIFXlrSBpYMhmu', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '7', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(98, 'Janick Windler', 'qlehner@treutel.net', NULL, '$2y$10$vt626qoPxtHmW9dLUNjKC.BLfAW7o03th6q84tfg5fvgG/MnK0Uni', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '8', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(99, 'Mertie Wilderman Sr.', 'gerson.marvin@hartmann.com', NULL, '$2y$10$S2Mjh/tn3bQ7rMSSYXW.seg5mRC96E3W.kLwxuAMwTho8yDsRrtmO', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '9', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(100, 'Lew Rohan', 'zwatsica@williamson.com', NULL, '$2y$10$m/OijH/qoIkFWTQYdnQ1ZO1xRy.lLbcD4HQsfmcUwuW4QzLcqgfCa', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '10', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(101, 'Dr. Krystel Moen I', 'jaeden.upton@yahoo.com', NULL, '$2y$10$AqFFPP941jwDpqGdz.rhrOtRWJABQDo2XhA0s8UM1iYxfJWQFKDPW', NULL, '2024-12-06 19:00:55', '2024-12-06 19:00:55', '11', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(102, 'Lazaro Sipes', 'anya.quigley@murazik.org', NULL, '$2y$10$2diu1HORa/alXmjpxS8dvuALLyyj7WbqzWqCvgiP.AGNXT7SKfx.6', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '12', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(103, 'Piper Wilderman', 'cormier.maximus@gmail.com', NULL, '$2y$10$te23hbtHxSxhYBXfQ4AOX.1OcXprqDtKhGLXROWABF.uZKzKtQYLe', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '13', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(104, 'Jennyfer Durgan MD', 'alycia25@yahoo.com', NULL, '$2y$10$rWwoYbNsg8X2G1qIJgqfp.5qgj1QA91j8Fjs265aZahpvwbvQwOES', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '14', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(105, 'Prof. Margaretta Deckow Sr.', 'margaret.mcdermott@gmail.com', NULL, '$2y$10$em3CEmQitvwCJvIpX5KlS.jWgqTW3c2SAjklV6qrX7WLs9WrGjDzC', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '15', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(106, 'Dr. Princess Lehner', 'gfadel@hotmail.com', NULL, '$2y$10$4AprGQ7hDOo04v8tOTiUoOdrvbQmXWATTVFjHgyJ6ow1e5569ZRcu', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '16', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(107, 'Cierra Heidenreich', 'caleb.watsica@yahoo.com', NULL, '$2y$10$Ktft9N.BU2KOafjY1JEIb.ap8WHiAuFToLpqvvhCXWMH0O9zdwHsu', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '17', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(108, 'Nona Turner IV', 'wharris@gmail.com', NULL, '$2y$10$HOBzhYjmqkTAAfC8MZMsneKCJxjy1hyo.QvtS6.mY8y91aQTrfuzS', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '18', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(109, 'Prof. Stella Metz', 'eberge@gmail.com', NULL, '$2y$10$jajWMN7HJXgSJEdY8jiPguKrU/I9K6Dt1mf9jb84TsWVNFEQwV2O6', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '19', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(110, 'Mrs. Magnolia Lubowitz IV', 'watson.littel@gibson.biz', NULL, '$2y$10$9zBuLqm2NNR/BpAxdeRrUeIDtpc5vjXYG.GrehzV5bhlBNUvF/EkK', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '20', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(111, 'Magali Dicki', 'carlotta.kirlin@rempel.com', NULL, '$2y$10$BMy2dnGqZ5xuf1DtIpD6JOP4oxzRcoUBcudy6QHQgV7tH//ZH3Lrm', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '21', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(112, 'Ephraim Nikolaus', 'estel07@gmail.com', NULL, '$2y$10$gBJRCPYjkn0K.pTFLdVlQ.oRbGds7GHg/2INFYvh9Amh.elIhdjyy', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '22', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(113, 'Felipa Pfannerstill Jr.', 'halle.mclaughlin@towne.com', NULL, '$2y$10$GoLLoCcEvClK1pX4nS5O3uarz86iRuwxXu1qGetDqjpxw72M8X5BO', NULL, '2024-12-06 19:00:56', '2024-12-06 19:00:56', '23', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(114, 'Tony Konopelski', 'ortiz.kayli@collier.com', NULL, '$2y$10$CvOmT3n8Gn1v5ito8qw53O3/ZL5AT5krXOGRkfulvRBNN.ImivFZ.', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '24', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(115, 'Damian Cole', 'harry16@gleason.biz', NULL, '$2y$10$2AkLBnvUlz4UzJlTMxr7ve.dDbRCo0i/cBePIonNP9El6CGI.SzCa', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '25', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(116, 'Miss Adriana Tremblay DVM', 'dolly.hickle@yahoo.com', NULL, '$2y$10$8IJvdW7AIM9ZiJ8ZY9ofQONF1IddpLm9aynQVBn2bQw3Tjvzxc4a2', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '26', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(117, 'Hailee Grady', 'bauch.sean@toy.com', NULL, '$2y$10$iflke.aPqi1PB.cfi2wAO.NtFJ.IDAoYFBQtclfE.kJevGKD7j4km', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '27', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(118, 'Miss Marge Rutherford', 'vfay@white.com', NULL, '$2y$10$JygRjgIVA0R5mmLM/RGJE.8qjm9nlUJ.54jkwzIZYs8TwRA5WViVe', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '28', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(119, 'Donny Hirthe', 'chadd.wuckert@hansen.com', NULL, '$2y$10$Qs5Ls37uie/SXmap6wez7O5SOEo7wLcQp9murv7/M/JnnIvfB/IXG', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '29', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(120, 'Jany Leannon', 'larson.brando@lesch.biz', NULL, '$2y$10$/3RKG8sw2rIgtg/5gFUT9u6CetDka6UerKsH7fvq4BiTTeV0ZBISK', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '30', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(121, 'Davin Morar', 'dschoen@rau.com', NULL, '$2y$10$fP64pk1xaUBkD.vEo4x1G.nC9Mx/KK92OIpEQaS1UFWYLh3q/aOm2', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '31', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(122, 'Pearl Gibson', 'eriberto.brown@gmail.com', NULL, '$2y$10$drsQE79m2dq/6SknPwPjye7AG7IwDy/tktU7FuLNaduI2U1/SYTPG', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '32', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(123, 'Therese Price', 'leffler.alexys@yahoo.com', NULL, '$2y$10$u2VfZQiDX8sn9MvFY503sesAoI8ToWESFMlp.PDM.S6OE3fSc6J0S', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '33', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(124, 'Dr. Andy Romaguera II', 'valentina99@mohr.com', NULL, '$2y$10$cwcnKiq4Krv9tWLP9UfTJ.B8s/OEyf1ECHnq2QSpt9T31cZLXKPmu', NULL, '2024-12-06 19:00:57', '2024-12-06 19:00:57', '34', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(125, 'Miss Nichole Konopelski', 'kole36@carter.info', NULL, '$2y$10$cC70eE.6/NpyZMV0iIckEewKhhHvUj2kdVMdm1rCyWTNcpkiUOE7a', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '35', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(126, 'Arjun Lang', 'reanna.funk@gorczany.com', NULL, '$2y$10$zhYIJdkTk7lz/P6XAJySIeIg8pqZc1LJIFVtEVqDzJMqjjYqXn5Nm', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '36', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(127, 'Immanuel Doyle', 'lola.emmerich@yahoo.com', NULL, '$2y$10$A17GqTZSb.d4iLrn.0DHP.hj7j9vBHfulA7FIQN4nAaJGgi02W2JG', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '37', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(128, 'Araceli Kessler', 'chelsey.huel@robel.com', NULL, '$2y$10$V9MmZyUwsJPBATlcH9rbfuHi/gUjgn5pnnLqw7ilf1hhsU.O5N.Vi', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '38', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(129, 'Ena White', 'bartholome66@greenfelder.com', NULL, '$2y$10$zkmcCKkEbG0QAWUoeI9G5O65ZP9CKYcxHWaKE0HFT1PIcGjz2xbcq', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '39', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(130, 'Darby Prosacco', 'ansley.douglas@reinger.org', NULL, '$2y$10$9ck5rL6ieqmOID2PzMTX3ezTutb7eYwewqcGGl4KDUzngqED1ua0a', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '40', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(131, 'Abner Doyle', 'mtoy@yahoo.com', NULL, '$2y$10$X1v8bo9xwH3LUB4cWOQPBO2k.2hMPNy3fjHXsUIHM/F.VDmZkNj5a', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '41', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(132, 'Sasha Mills', 'sabrina.vandervort@hane.info', NULL, '$2y$10$KL9I/X.SD9nLl.xUxaffFOfb5CBd7.5e5Dptt7xU.2wRu5kEBi4Aa', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '42', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(133, 'Miss Laurine O\'Kon', 'amaggio@gmail.com', NULL, '$2y$10$sDPjRDCDJmXGLPZBq/4GeOwKnsOMw3nEXsPx9A9i/MLiLVJ5EpRQG', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '43', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(134, 'Daniela Emmerich', 'kristoffer.pfeffer@durgan.net', NULL, '$2y$10$cb6WSKmUPh8YmtvyCFCCKu2nb.fk9exrsOYTuigqLgi.iDKynFz/.', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '44', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(135, 'Prof. Paris Conn', 'ariane71@gmail.com', NULL, '$2y$10$XhNkix2RKuJvuSzdmKiFr.yIqJkDfDvuMIXNWJzO1Q58471YD4JOO', NULL, '2024-12-06 19:00:58', '2024-12-06 19:00:58', '45', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(136, 'Carissa Wisozk II', 'katarina23@schiller.com', NULL, '$2y$10$mPUJwEwowNNrvVVhJ00mcONflDxLLN7iD9w9vowdkUeh7ziyIvqLq', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '46', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(137, 'Brook Von III', 'roxane.stamm@hotmail.com', NULL, '$2y$10$rlslF1CnVmU.LLEcYs43nOSLkv3P6g2IhLyKN.LxIr5PaDOIVxGFK', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '47', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(138, 'Price Eichmann', 'lowe.icie@gmail.com', NULL, '$2y$10$FIBVXrWgbUWeT6gTwS4mSuiEbBpJAdy/.9dKdqf0XvkaaS62H0cXi', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '48', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(139, 'Alisha Graham III', 'nya.waters@jerde.com', NULL, '$2y$10$nZBPQLEKcHCDCSeEJupL4.VpQrwUs3KJjgKfrouS9ZyPb7Z4pr92K', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '49', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(140, 'Mr. Madisen DuBuque', 'crooks.mabelle@yahoo.com', NULL, '$2y$10$ABg3RO0I4Z5ty2TKn6vgKub3./9N0yene/L0u8OzwENbueC5If6eW', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '50', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(141, 'Maryam O\'Reilly', 'ghaley@lowe.biz', NULL, '$2y$10$fhjpJR1cuR8rXKrPeQufdeCsNC9aVligh/N.GKMAcFeE6SsKIABLC', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '51', 'admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(142, 'Hal Shields', 'delbert01@jerde.com', NULL, '$2y$10$ZXi.qClymBQ1WTttXDvaV.IFFmRs2AhiJogQKo1cJg5u6MUU3G0Ue', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '52', 'accounting', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(143, 'Isidro Lebsack', 'rowe.sunny@barrows.com', NULL, '$2y$10$PZWdf5R6ULGpygXf6/a.vOyI3m3UvnYth55wd4w.fEpoeQIQxsUJq', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '53', 'inventory staff', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(144, 'Dr. Jimmy Bernier', 'alberta79@hotmail.com', NULL, '$2y$10$yr0T98C5hbPatAD6r2YTpeoysLK2C/cPgBfyJAOpcF4u9TKJmQrDG', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '54', 'cashier', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(145, 'Yvette O\'Hara', 'bernardo.gerhold@trantow.com', NULL, '$2y$10$LpQLIvwSyHB3ouZox0G1fe5U0k3DlE.XAqIPhLoLC9RqpJ0WYd3Ym', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '55', 'it development', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(146, 'Houston Borer', 'fay.dashawn@wintheiser.com', NULL, '$2y$10$jQ.jyhg1SEU1S6XY8Bh2S.1oKcer/fZhGiV79BOiqF8kP/J3m7eIq', NULL, '2024-12-06 19:00:59', '2024-12-06 19:00:59', '56', 'manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(147, 'Norris Padberg', 'muller.margarita@gmail.com', NULL, '$2y$10$4t6KxMnVqjJgubWwSVObs.fhn9Rit7jrBw0KEjKH2W9K0ls6iFcL.', NULL, '2024-12-06 19:01:00', '2024-12-06 19:01:00', '57', 'pic inventory', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(148, 'Maiya Ryan', 'qstracke@aufderhar.com', NULL, '$2y$10$yG7EPg8uFMddaxXAbpEvce2vGn4tkpUyovcY6aEU2.B9YzFJFAkPu', NULL, '2024-12-06 19:01:00', '2024-12-06 19:01:00', '58', 'head manager', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(149, 'Dewayne Hauck MD', 'yrau@gmail.com', NULL, '$2y$10$QteozRAF3nHR.9ZtCTz87.XqNa1qH7kZqRttgfbOB.u5hVVcBJsZC', NULL, '2024-12-06 19:01:00', '2024-12-06 19:01:00', '59', 'super admin', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(150, 'Lorenzo Marquardt II', 'rasheed.walker@kub.com', NULL, '$2y$10$wB9xRmfKYNBuVfZUsII8J.4uyKO/4gfnArqd6paO2C921F/0So8La', NULL, '2024-12-06 19:01:00', '2024-12-06 19:01:00', '60', 'owner/ceo', NULL, 1, '-', 0, 0, 0, 0, '-', 0),
(153, 'Manager 01', 'manager01@gmail.com', NULL, '$2y$10$eNKcK3r4NeY2j3eM9I1Q7eOJsM6g4HX177sxo9yjtubt328a5je9i', NULL, '2024-12-06 21:09:56', '2024-12-22 09:49:35', '0', 'Presiden Direktur', NULL, 1, '-', 6, 0, 4, 1, 'signatures/signature_6768512f473945.29085833.png', 1),
(154, 'Board Of Director', 'board001@gmail.com ', NULL, '$2y$10$eNKcK3r4NeY2j3eM9I1Q7eOJsM6g4HX177sxo9yjtubt328a5je9i', NULL, '2024-12-06 21:10:24', '2024-12-22 09:49:14', '0', 'Board Of Finance', NULL, 1, '-', 5, 0, 8, 1, 'signatures/signature_6768511aa92b55.53515557.png', 1),
(156, 'General Manager 003', 'general003@gmail.com', NULL, '$2y$10$eNKcK3r4NeY2j3eM9I1Q7eOJsM6g4HX177sxo9yjtubt328a5je9i', NULL, '2024-12-09 02:21:03', '2025-01-20 08:01:35', '63', 'General Manager', NULL, 1, '-', 2, 0, 64, 1, 'signatures/signature_678e735f13b385.86960607.png', 1),
(157, 'PIC Unit New', 'picunit001@gmail.com', NULL, '$2y$10$eNKcK3r4NeY2j3eM9I1Q7eOJsM6g4HX177sxo9yjtubt328a5je9i', NULL, '2024-12-09 02:22:00', '2025-01-20 08:01:56', '63', 'PIC Unit ( One Of The BOD )', NULL, 1, '-', 3, 0, 65, 1, 'signatures/signature_678e73745c9b17.96366875.png', 1),
(158, 'Sekretariat Edit', 'sekretariat001@gmail.com', NULL, '$2y$10$eNKcK3r4NeY2j3eM9I1Q7eOJsM6g4HX177sxo9yjtubt328a5je9i', NULL, '2024-12-09 02:22:20', '2024-12-22 04:34:51', '0', 'Sekretariat', NULL, 1, '-', 4, 0, 66, 1, 'signatures/signature_6759a1af775331.58479441.png', 1),
(160, 'Assetsss', 'assets01@gmail.com', NULL, '$2y$10$9xI5Afgv.bdS7QQBYd7cF.UlsXl2wMBJ54vHu5qNjlEU5qoKG5CNm', NULL, '2024-12-11 06:54:36', '2024-12-25 00:41:58', '0', 'General Manager', NULL, 1, '-', 7, 0, 64, 0, 'signatures/signature_676851493c0086.03861021.png', 0),
(161, 'VD OF Finance Person', 'vdofga@gmail.com', NULL, '$2y$10$eNKcK3r4NeY2j3eM9I1Q7eOJsM6g4HX177sxo9yjtubt328a5je9i', NULL, '2024-12-18 07:14:03', '2024-12-23 04:06:23', '63', 'VD of Accounting - Finance', NULL, 1, '-', 0, 1, 3, 1, '-', 2),
(164, '-', '2024121816145785746@email.com', NULL, '$2y$10$eokAv.9xgP.KrRfYb0aFAOiUOYHBvseyMie0DCwp.e/TtEaiZ8GsW', NULL, '2024-12-18 08:14:57', '2024-12-23 04:06:23', '63', 'Manager Of Finance', NULL, 1, '-', 0, 2, 4, 1, '-', 2),
(165, '-', '2024122312054658152@email.com', NULL, '$2y$10$ZiIKDYQ5onYwxJtbqDayquOlAkYNyfJFZtRmcwSTn6TPzd0Qozou6', NULL, '2024-12-23 04:05:46', '2024-12-23 04:06:23', '63', 'Board Of Finance', NULL, 1, '-', 0, 3, 8, 1, '-', 2),
(166, '-', '2024122312061050202@email.com', NULL, '$2y$10$gOfNqKMde4IzWCzikfkMZuXKpdrhlG4qnDtRVMtjiaZPGG767VF32', NULL, '2024-12-23 04:06:10', '2024-12-23 04:06:23', '63', 'General Cashier', NULL, 1, '-', 0, 4, 5, 1, '-', 2),
(167, 'agoes vinance', 'agoes01@gmail.com', NULL, '$2y$10$itnXd3bzdw8OKWnnQ6FgE.EcTxISXWH43DSdEM2eIzlrqJz7bUJ3e', NULL, '2025-01-19 03:39:54', '2025-01-20 09:30:43', '63', 'Vd of Accounting finance', NULL, 1, '-', 0, 0, 68, 1, 'signatures/signature_678e8843e3fec9.14389618.png', 0),
(168, 'Manager Finance 01', 'managerfinance01@gmail.com', NULL, '$2y$10$itnXd3bzdw8OKWnnQ6FgE.EcTxISXWH43DSdEM2eIzlrqJz7bUJ3e', NULL, '2025-01-19 03:40:34', '2025-01-22 08:13:05', '63', 'manager of finance', NULL, 1, '-', 0, 0, 69, 1, 'signatures/signature_67911911014061.96681026.png', 0),
(170, 'Brand Finance 01', 'brandfinance01@gmail.com', NULL, '$2y$10$itnXd3bzdw8OKWnnQ6FgE.EcTxISXWH43DSdEM2eIzlrqJz7bUJ3e', NULL, '2025-01-19 03:42:04', '2025-01-22 08:13:13', '63', 'Brand of finance', NULL, 1, '-', 0, 0, 70, 1, 'signatures/signature_67911919684619.82186224.png', 0),
(171, 'General Cashier 01', 'generalcashier01@gmail.com', NULL, '$2y$10$itnXd3bzdw8OKWnnQ6FgE.EcTxISXWH43DSdEM2eIzlrqJz7bUJ3e', NULL, '2025-01-19 03:42:39', '2025-01-22 08:13:22', '63', 'General Cashier', NULL, 1, '-', 0, 0, 71, 1, 'signatures/signature_67911922217420.90427579.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_menus`
--
ALTER TABLE `access_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `approval_document`
--
ALTER TABLE `approval_document`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `approval_doc_pembayaran`
--
ALTER TABLE `approval_doc_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `approval_doc_pembayarans`
--
ALTER TABLE `approval_doc_pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `approval_doc_pengadaan`
--
ALTER TABLE `approval_doc_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `approval_doc_pettycash`
--
ALTER TABLE `approval_doc_pettycash`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doc_petty_cashes`
--
ALTER TABLE `doc_petty_cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_persetujuan`
--
ALTER TABLE `dokumen_persetujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_surat` (`no_surat`);

--
-- Indeks untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `petty_cashes`
--
ALTER TABLE `petty_cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_holding`
--
ALTER TABLE `role_holding`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_pembayaran`
--
ALTER TABLE `role_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_pengadaan`
--
ALTER TABLE `role_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_petty_cash`
--
ALTER TABLE `role_petty_cash`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_unit_usaha`
--
ALTER TABLE `role_unit_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `statusdokumen`
--
ALTER TABLE `statusdokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `template_surat`
--
ALTER TABLE `template_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unit_bisnis`
--
ALTER TABLE `unit_bisnis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unit_usaha`
--
ALTER TABLE `unit_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `access_menus`
--
ALTER TABLE `access_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT untuk tabel `approval_document`
--
ALTER TABLE `approval_document`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `approval_doc_pembayaran`
--
ALTER TABLE `approval_doc_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `approval_doc_pembayarans`
--
ALTER TABLE `approval_doc_pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `approval_doc_pengadaan`
--
ALTER TABLE `approval_doc_pengadaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `approval_doc_pettycash`
--
ALTER TABLE `approval_doc_pettycash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `doc_petty_cashes`
--
ALTER TABLE `doc_petty_cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dokumen_persetujuan`
--
ALTER TABLE `dokumen_persetujuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petty_cashes`
--
ALTER TABLE `petty_cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role_holding`
--
ALTER TABLE `role_holding`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role_pembayaran`
--
ALTER TABLE `role_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role_pengadaan`
--
ALTER TABLE `role_pengadaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `role_petty_cash`
--
ALTER TABLE `role_petty_cash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `role_unit_usaha`
--
ALTER TABLE `role_unit_usaha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `statusdokumen`
--
ALTER TABLE `statusdokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `template_surat`
--
ALTER TABLE `template_surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `unit_bisnis`
--
ALTER TABLE `unit_bisnis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `unit_usaha`
--
ALTER TABLE `unit_usaha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
