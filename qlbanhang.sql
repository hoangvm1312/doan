-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 09:28 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlbanhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `queue` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_07_25_074645_create_tbl_category_product', 1),
(4, '2020_07_26_024545_create_tbl_area', 1),
(5, '2020_07_26_071431_create_tbl_table', 1),
(6, '2020_09_25_085359_create_tbl_dvt', 2),
(7, '2020_09_25_090547_create_tbl_phieunhap', 2),
(8, '2020_09_25_090604_create_tbl_phieunhap_detail', 2),
(9, '2020_09_25_090613_create_tbl_phieuhuy', 2),
(10, '2020_09_25_090620_create_tbl_phieuhuy_detail', 2),
(11, '2020_09_25_090627_create_tbl_loaisanpham', 2),
(12, '2020_09_25_090633_create_tbl_bancafe', 2),
(13, '2020_09_25_090639_create_tbl_sanpham', 2),
(14, '2020_09_25_090647_create_tbl_phieudenbu', 2),
(15, '2020_09_25_090653_create_tbl_phieudenbu_detail', 2),
(16, '2020_09_25_091326_create_tbl_loaiphong', 2),
(17, '2020_09_25_091432_create_tbl_phong', 2),
(18, '2020_09_25_091639_create_tbl_phieubancafe', 2),
(19, '2020_09_25_091741_create_tbl_hoadoncafe', 2),
(20, '2020_09_25_091809_create_tbl_phieuthue', 2),
(21, '2020_09_25_091909_create_tbl_khachhang', 2),
(22, '2020_09_25_091931_create_tbl_chicongno', 2),
(23, '2020_09_25_092539_create_tbl_phieubancafe_detail', 2),
(24, '2020_09_25_092549_create_tbl_phieuthue_detail', 2),
(25, '2020_09_25_102335_create_tbl_thucongno', 2),
(26, '2020_09_26_092517_create_tbl_khuvuc', 3),
(27, '2020_09_26_093418_create_tbl_bancafe', 4),
(28, '2014_10_12_100000_create_password_resets_table', 5),
(29, '2020_09_28_184645_create_sp_table', 6),
(30, '2020_10_04_094437_create_tbl_hoadoncafe_detail', 7),
(31, '2020_10_25_033240_create_tbl_hoadonkaraoke', 8),
(32, '2020_10_25_033337_create_tbl_hoadonkaraoke_detail', 8),
(33, '2020_10_30_142858_create_tbl_congnocafe', 9),
(34, '2020_10_30_143247_create_tbl_congnokaraoke', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `admin_phone` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`) VALUES
(1, 'admin@gmail.com', '123456', 'Hoang', '078805');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bancafe`
--

CREATE TABLE `tbl_bancafe` (
  `bancafe_id` int(10) UNSIGNED NOT NULL,
  `bancafe_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bancafe_status` int(11) NOT NULL,
  `khuvuc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_bancafe`
--

INSERT INTO `tbl_bancafe` (`bancafe_id`, `bancafe_name`, `bancafe_status`, `khuvuc_id`) VALUES
(1, 'Bàn 11', 0, 1),
(2, 'Bàn 12', 1, 1),
(3, 'Bàn 13', 0, 1),
(4, 'Bàn 14', 0, 1),
(5, 'Bàn 21', 0, 2),
(6, 'Bàn 22', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_congnocafe`
--

CREATE TABLE `tbl_congnocafe` (
  `congnocafe_id` int(10) UNSIGNED NOT NULL,
  `hoadoncafe_id` int(11) NOT NULL,
  `congnocafe_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `congnocafe_status` int(11) NOT NULL,
  `congnocafe_time` datetime NOT NULL,
  `khachhang_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_congnocafe`
--

INSERT INTO `tbl_congnocafe` (`congnocafe_id`, `hoadoncafe_id`, `congnocafe_nguoi`, `congnocafe_status`, `congnocafe_time`, `khachhang_id`) VALUES
(2, 58, 'nhanvien', 1, '2020-11-03 22:04:23', '6'),
(3, 59, 'nhanvien', 1, '2020-11-03 22:05:51', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_congnokaraoke`
--

CREATE TABLE `tbl_congnokaraoke` (
  `congnokaraoke_id` int(10) UNSIGNED NOT NULL,
  `hoadonkaraoke_id` int(11) NOT NULL,
  `congnokaraoke_timein` datetime NOT NULL,
  `congnokaraoke_timeout` datetime NOT NULL,
  `congnokaraoke_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `congnokaraoke_status` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dvt`
--

CREATE TABLE `tbl_dvt` (
  `dvt_id` int(10) UNSIGNED NOT NULL,
  `dvt_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_dvt`
--

INSERT INTO `tbl_dvt` (`dvt_id`, `dvt_name`, `created_at`, `updated_at`) VALUES
(1, 'mieng', NULL, NULL),
(2, 'goi', NULL, NULL),
(3, 'coc', NULL, NULL),
(4, 'lon', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadoncafe`
--

CREATE TABLE `tbl_hoadoncafe` (
  `hoadoncafe_id` int(10) UNSIGNED NOT NULL,
  `bancafe_id` int(11) NOT NULL,
  `hoadoncafe_time` datetime NOT NULL,
  `hoadoncafe_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoadoncafe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoadoncafe_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_hoadoncafe`
--

INSERT INTO `tbl_hoadoncafe` (`hoadoncafe_id`, `bancafe_id`, `hoadoncafe_time`, `hoadoncafe_nguoi`, `hoadoncafe_price`, `hoadoncafe_status`) VALUES
(40, 1, '2020-10-29 22:36:27', 'nhan vien', '105000', 0),
(41, 1, '2020-10-29 22:42:48', 'nhan vien', '70000', 0),
(43, 2, '2020-10-29 22:43:21', 'nhan vien', '70000', 0),
(44, 1, '2020-10-29 22:48:51', 'nhan vien', '105000', 0),
(45, 1, '2020-10-29 22:49:38', 'nhan vien', '35000', 0),
(46, 1, '2020-10-29 22:50:43', 'nhan vien', '35000', 0),
(47, 1, '2020-10-29 22:52:06', 'nhan vien', '105000', 0),
(48, 1, '2020-10-29 22:58:44', 'nhan vien', '70000', 0),
(49, 1, '2020-10-29 23:14:41', 'nhan vien', '35000', 0),
(50, 1, '2020-10-30 20:58:18', 'nhan vien', '70000', 0),
(52, 2, '2020-11-01 21:51:31', 'nhan vien', '35000', 0),
(53, 3, '2020-11-02 20:28:32', 'nhan vien', '105000', 0),
(55, 2, '2020-11-03 15:46:51', 'nhan vien', '210000', 0),
(56, 1, '2020-11-03 16:09:05', 'nhan vien', '35000', 0),
(57, 1, '2020-11-03 20:25:55', 'nhan vien', '35000', 0),
(58, 2, '2020-11-03 22:04:13', 'nhan vien', '105000', 0),
(59, 2, '2020-11-03 22:05:39', 'nhan vien', '70000', 0),
(60, 1, '2020-11-03 22:50:36', 'nhan vien', '80000', 0),
(61, 2, '2020-11-08 14:38:45', 'nhan vien', '105000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadoncafedetail`
--

CREATE TABLE `tbl_hoadoncafedetail` (
  `hoadoncafeDetail_id` int(10) UNSIGNED NOT NULL,
  `hoadoncafe_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `hoadoncafeDetail_nums` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoadoncafeDetail_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_hoadoncafedetail`
--

INSERT INTO `tbl_hoadoncafedetail` (`hoadoncafeDetail_id`, `hoadoncafe_id`, `sanpham_id`, `hoadoncafeDetail_nums`, `hoadoncafeDetail_price`) VALUES
(41, 27, 8, '1', 30000),
(42, 27, 5, '4', 60000),
(79, 40, 1, '2', 70000),
(80, 40, 2, '1', 35000),
(81, 41, 2, '2', 70000),
(83, 43, 2, '1', 35000),
(84, 43, 1, '1', 35000),
(85, 44, 1, '2', 70000),
(86, 44, 2, '1', 35000),
(87, 45, 2, '1', 35000),
(88, 46, 1, '1', 35000),
(89, 47, 1, '2', 70000),
(90, 47, 2, '1', 35000),
(91, 48, 1, '2', 70000),
(92, 49, 2, '1', 35000),
(93, 50, 1, '1', 35000),
(94, 50, 2, '1', 35000),
(96, 52, 2, '1', 35000),
(97, 53, 1, '2', 70000),
(98, 53, 2, '1', 35000),
(100, 55, 1, '2', 70000),
(101, 55, 2, '4', 140000),
(102, 56, 2, '1', 35000),
(103, 57, 2, '1', 35000),
(104, 58, 2, '1', 35000),
(105, 58, 1, '2', 70000),
(106, 59, 2, '2', 70000),
(107, 60, 2, '1', 35000),
(108, 60, 4, '1', 20000),
(109, 60, 6, '1', 25000),
(110, 61, 2, '3', 105000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadonkaraoke`
--

CREATE TABLE `tbl_hoadonkaraoke` (
  `hoadonkaraoke_id` int(10) UNSIGNED NOT NULL,
  `phong_id` int(11) NOT NULL,
  `hoadonkaraoke_timein` datetime NOT NULL,
  `hoadonkaraoke_timeout` datetime NOT NULL,
  `hoadonkaraoke_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoadonkaraoke_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoadonkaraoke_status` int(11) NOT NULL,
  `hoadonkaraoke_time` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_hoadonkaraoke`
--

INSERT INTO `tbl_hoadonkaraoke` (`hoadonkaraoke_id`, `phong_id`, `hoadonkaraoke_timein`, `hoadonkaraoke_timeout`, `hoadonkaraoke_nguoi`, `hoadonkaraoke_price`, `hoadonkaraoke_status`, `hoadonkaraoke_time`) VALUES
(11, 1, '2020-11-02 21:59:57', '2020-11-02 22:00:02', 'nhan vien', '105000', 0, 0),
(12, 2, '2020-11-02 22:04:06', '2020-11-02 23:04:34', 'nhan vien', '170000', 0, 1),
(13, 5, '2020-11-02 18:19:04', '2020-11-02 18:50:18', 'nhan vien', '378333.33333333', 0, 0.516667),
(14, 4, '2020-11-02 18:53:26', '2020-11-02 18:53:30', 'nhan vien', '105000', 0, 0),
(15, 1, '2020-11-02 19:13:56', '2020-11-02 19:14:07', 'nhan vien', '135000', 0, 0),
(16, 1, '2020-11-02 19:17:56', '2020-11-02 19:18:13', 'nhan vien', '170000', 0, 0),
(17, 2, '2020-11-02 21:22:35', '2020-11-02 21:22:35', 'nhan vien', '70000', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadonkaraokedetail`
--

CREATE TABLE `tbl_hoadonkaraokedetail` (
  `hoadonkaraokeDetail_id` int(10) UNSIGNED NOT NULL,
  `hoadonkaraoke_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `hoadonkaraokeDetail_nums` int(11) NOT NULL,
  `hoadonkaraokeDetail_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_hoadonkaraokedetail`
--

INSERT INTO `tbl_hoadonkaraokedetail` (`hoadonkaraokeDetail_id`, `hoadonkaraoke_id`, `sanpham_id`, `hoadonkaraokeDetail_nums`, `hoadonkaraokeDetail_price`) VALUES
(24, 11, 2, 1, '35000'),
(25, 11, 1, 2, '70000'),
(26, 12, 2, 1, '35000'),
(27, 12, 1, 1, '35000'),
(28, 13, 2, 3, '105000'),
(29, 13, 1, 3, '105000'),
(30, 13, 7, 1, '25000'),
(31, 13, 6, 1, '25000'),
(32, 13, 5, 1, '15000'),
(33, 14, 2, 1, '35000'),
(34, 14, 1, 2, '70000'),
(35, 15, 2, 2, '70000'),
(36, 15, 1, 1, '35000'),
(37, 15, 8, 1, '30000'),
(38, 16, 2, 1, '35000'),
(39, 16, 1, 1, '35000'),
(40, 16, 6, 4, '100000'),
(41, 17, 2, 1, '35000'),
(42, 17, 1, 1, '35000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `khachhang_id` int(10) UNSIGNED NOT NULL,
  `khachhang_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_sdt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`khachhang_id`, `khachhang_name`, `khachhang_sdt`) VALUES
(6, 'Vũ Minh Hoàng', '0788058989'),
(7, 'Vũ Minh Hoàng', '0788058989');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khuvuc`
--

CREATE TABLE `tbl_khuvuc` (
  `khuvuc_id` int(10) UNSIGNED NOT NULL,
  `khuvuc_name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_khuvuc`
--

INSERT INTO `tbl_khuvuc` (`khuvuc_id`, `khuvuc_name`) VALUES
(1, 'Tầng 1'),
(2, 'Tầng 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaiphong`
--

CREATE TABLE `tbl_loaiphong` (
  `loaiphong_id` int(10) UNSIGNED NOT NULL,
  `loaiphong_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loaiphong_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_loaiphong`
--

INSERT INTO `tbl_loaiphong` (`loaiphong_id`, `loaiphong_name`, `loaiphong_price`) VALUES
(1, 'VIP 1', 100000),
(2, 'VIP 2', 200000),
(3, 'VIP 3', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaisanpham`
--

CREATE TABLE `tbl_loaisanpham` (
  `loaisanpham_id` int(10) UNSIGNED NOT NULL,
  `loaisanpham_name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_loaisanpham`
--

INSERT INTO `tbl_loaisanpham` (`loaisanpham_id`, `loaisanpham_name`) VALUES
(1, 'Bánh '),
(2, 'Cafe'),
(3, 'Sinh tố'),
(4, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nguyenlieu`
--

CREATE TABLE `tbl_nguyenlieu` (
  `nguyenlieu_id` int(11) NOT NULL,
  `nguyenlieu_name` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `dvt` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `nguyenlieu_nums` int(11) NOT NULL,
  `nguyenlieu_price` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `nguyenlieu_image` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `nguyenlieu_ngaynhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieudenbu`
--

CREATE TABLE `tbl_phieudenbu` (
  `phieudenbu_id` int(10) UNSIGNED NOT NULL,
  `phieudenbu_time` datetime NOT NULL,
  `phieudenbu_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phieudenbu`
--

INSERT INTO `tbl_phieudenbu` (`phieudenbu_id`, `phieudenbu_time`, `phieudenbu_nguoi`) VALUES
(3, '2020-09-09 20:00:00', 'Hue'),
(4, '2020-09-09 14:25:00', 'Hue');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieudenbudetail`
--

CREATE TABLE `tbl_phieudenbudetail` (
  `phieudenbuDetail_id` int(10) UNSIGNED NOT NULL,
  `phieudenbu_id` int(11) NOT NULL,
  `phieudenbuDetail_thietbi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieudenbuDetail_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieudenbuDetail_nums` int(11) NOT NULL,
  `phieudenbuDetail_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieudenbuDetail_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phieudenbudetail`
--

INSERT INTO `tbl_phieudenbudetail` (`phieudenbuDetail_id`, `phieudenbu_id`, `phieudenbuDetail_thietbi`, `phieudenbuDetail_cost`, `phieudenbuDetail_nums`, `phieudenbuDetail_reason`, `phieudenbuDetail_price`) VALUES
(1, 1, 'coc thuy tinh', '30000', 3, 'lam vo', '90000'),
(2, 2, 'micro', '600000', 1, 'hong', '600000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieuhuy`
--

CREATE TABLE `tbl_phieuhuy` (
  `phieuhuy_id` int(10) UNSIGNED NOT NULL,
  `phieuhuy_time` date NOT NULL,
  `phieuhuy_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieuhuy_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phieuhuy`
--

INSERT INTO `tbl_phieuhuy` (`phieuhuy_id`, `phieuhuy_time`, `phieuhuy_nguoi`, `phieuhuy_price`) VALUES
(1, '2020-09-09', 'Hung', '20000'),
(2, '2020-09-09', 'Hung', '25000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieuhuydetail`
--

CREATE TABLE `tbl_phieuhuydetail` (
  `phieuhuyDetail_id` int(10) UNSIGNED NOT NULL,
  `phieuhuy_id` int(11) NOT NULL,
  `nguyenlieu_id` int(11) NOT NULL,
  `phieuhuyDetail_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieuhuyDetail_nums` int(11) NOT NULL,
  `phieuhuyDetail_dvt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieuhuyDetail_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieuhuyDetail_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phieuhuydetail`
--

INSERT INTO `tbl_phieuhuydetail` (`phieuhuyDetail_id`, `phieuhuy_id`, `nguyenlieu_id`, `phieuhuyDetail_cost`, `phieuhuyDetail_nums`, `phieuhuyDetail_dvt`, `phieuhuyDetail_reason`, `phieuhuyDetail_price`) VALUES
(1, 1, 4, '10000', 2, '', 'het han su dung', '20000'),
(2, 2, 5, '5000', 5, '', 'rach bao bi', '25000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieunhap`
--

CREATE TABLE `tbl_phieunhap` (
  `phieunhap_id` int(10) UNSIGNED NOT NULL,
  `phieunhap_nguoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieunhap_price` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieunhap_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phieunhap`
--

INSERT INTO `tbl_phieunhap` (`phieunhap_id`, `phieunhap_nguoi`, `phieunhap_price`, `phieunhap_time`) VALUES
(1, 'Hung', '500000', '2020-07-07'),
(2, 'Hung', '300000', '2020-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieunhapdetail`
--

CREATE TABLE `tbl_phieunhapdetail` (
  `phieunhapDetail_id` int(10) UNSIGNED NOT NULL,
  `phieunhap_id` int(11) NOT NULL,
  `nguyenlieu_id` int(11) NOT NULL,
  `phieunhapDetail_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieunhap_nums` int(11) NOT NULL,
  `phieuhuyDetail_dvt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phieunhapDetail_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phieunhapdetail`
--

INSERT INTO `tbl_phieunhapdetail` (`phieunhapDetail_id`, `phieunhap_id`, `nguyenlieu_id`, `phieunhapDetail_cost`, `phieunhap_nums`, `phieuhuyDetail_dvt`, `phieunhapDetail_price`) VALUES
(1, 2, 4, '10000', 30, '', '300000'),
(2, 1, 5, '5000', 100, '', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phong`
--

CREATE TABLE `tbl_phong` (
  `phong_id` int(10) UNSIGNED NOT NULL,
  `loaiphong_id` int(11) NOT NULL,
  `phong_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phong_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_phong`
--

INSERT INTO `tbl_phong` (`phong_id`, `loaiphong_id`, `phong_name`, `phong_status`) VALUES
(1, 1, 'King 1', 0),
(2, 1, 'King 2', 0),
(3, 2, 'King 3', 0),
(4, 3, 'King 4', 0),
(5, 2, 'King 5', 0),
(6, 2, 'King 6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `sanpham_id` int(10) UNSIGNED NOT NULL,
  `loaisanpham_id` int(11) NOT NULL,
  `dvt_id` int(11) NOT NULL,
  `sanpham_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`sanpham_id`, `loaisanpham_id`, `dvt_id`, `sanpham_name`, `sanpham_price`, `sanpham_image`) VALUES
(1, 1, 1, 'Bánh cookies', '35000', 'banhcookies.jpg'),
(2, 1, 1, 'Bán flan', '35000', 'banhflan.jpg'),
(3, 2, 1, 'Cafe sữa đá', '20000', 'cafesuada.jpg'),
(4, 2, 2, 'Cafe sữa nóng', '20000', 'cafesuanong.jpg'),
(5, 3, 2, 'Nước cam ép', '15000', 'nuoccamep.jpg'),
(6, 3, 3, 'Nước chanh', '25000', 'nuocchanh.jpg'),
(7, 3, 3, 'Nước chanh dây', '25000', 'nuocchanhday.jpg'),
(8, 4, 3, 'Thuốc lá 1', '30000', 'thuocla.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_bancafe`
--
ALTER TABLE `tbl_bancafe`
  ADD PRIMARY KEY (`bancafe_id`);

--
-- Indexes for table `tbl_congnocafe`
--
ALTER TABLE `tbl_congnocafe`
  ADD PRIMARY KEY (`congnocafe_id`);

--
-- Indexes for table `tbl_congnokaraoke`
--
ALTER TABLE `tbl_congnokaraoke`
  ADD PRIMARY KEY (`congnokaraoke_id`);

--
-- Indexes for table `tbl_dvt`
--
ALTER TABLE `tbl_dvt`
  ADD PRIMARY KEY (`dvt_id`);

--
-- Indexes for table `tbl_hoadoncafe`
--
ALTER TABLE `tbl_hoadoncafe`
  ADD PRIMARY KEY (`hoadoncafe_id`);

--
-- Indexes for table `tbl_hoadoncafedetail`
--
ALTER TABLE `tbl_hoadoncafedetail`
  ADD PRIMARY KEY (`hoadoncafeDetail_id`);

--
-- Indexes for table `tbl_hoadonkaraoke`
--
ALTER TABLE `tbl_hoadonkaraoke`
  ADD PRIMARY KEY (`hoadonkaraoke_id`);

--
-- Indexes for table `tbl_hoadonkaraokedetail`
--
ALTER TABLE `tbl_hoadonkaraokedetail`
  ADD PRIMARY KEY (`hoadonkaraokeDetail_id`);

--
-- Indexes for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Indexes for table `tbl_khuvuc`
--
ALTER TABLE `tbl_khuvuc`
  ADD PRIMARY KEY (`khuvuc_id`);

--
-- Indexes for table `tbl_loaiphong`
--
ALTER TABLE `tbl_loaiphong`
  ADD PRIMARY KEY (`loaiphong_id`);

--
-- Indexes for table `tbl_loaisanpham`
--
ALTER TABLE `tbl_loaisanpham`
  ADD PRIMARY KEY (`loaisanpham_id`);

--
-- Indexes for table `tbl_nguyenlieu`
--
ALTER TABLE `tbl_nguyenlieu`
  ADD PRIMARY KEY (`nguyenlieu_id`);

--
-- Indexes for table `tbl_phieudenbu`
--
ALTER TABLE `tbl_phieudenbu`
  ADD PRIMARY KEY (`phieudenbu_id`);

--
-- Indexes for table `tbl_phieudenbudetail`
--
ALTER TABLE `tbl_phieudenbudetail`
  ADD PRIMARY KEY (`phieudenbuDetail_id`);

--
-- Indexes for table `tbl_phieuhuy`
--
ALTER TABLE `tbl_phieuhuy`
  ADD PRIMARY KEY (`phieuhuy_id`);

--
-- Indexes for table `tbl_phieuhuydetail`
--
ALTER TABLE `tbl_phieuhuydetail`
  ADD PRIMARY KEY (`phieuhuyDetail_id`);

--
-- Indexes for table `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  ADD PRIMARY KEY (`phieunhap_id`);

--
-- Indexes for table `tbl_phieunhapdetail`
--
ALTER TABLE `tbl_phieunhapdetail`
  ADD PRIMARY KEY (`phieunhapDetail_id`);

--
-- Indexes for table `tbl_phong`
--
ALTER TABLE `tbl_phong`
  ADD PRIMARY KEY (`phong_id`);

--
-- Indexes for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`sanpham_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bancafe`
--
ALTER TABLE `tbl_bancafe`
  MODIFY `bancafe_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_congnocafe`
--
ALTER TABLE `tbl_congnocafe`
  MODIFY `congnocafe_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_congnokaraoke`
--
ALTER TABLE `tbl_congnokaraoke`
  MODIFY `congnokaraoke_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dvt`
--
ALTER TABLE `tbl_dvt`
  MODIFY `dvt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_hoadoncafe`
--
ALTER TABLE `tbl_hoadoncafe`
  MODIFY `hoadoncafe_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_hoadoncafedetail`
--
ALTER TABLE `tbl_hoadoncafedetail`
  MODIFY `hoadoncafeDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbl_hoadonkaraoke`
--
ALTER TABLE `tbl_hoadonkaraoke`
  MODIFY `hoadonkaraoke_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_hoadonkaraokedetail`
--
ALTER TABLE `tbl_hoadonkaraokedetail`
  MODIFY `hoadonkaraokeDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `khachhang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_khuvuc`
--
ALTER TABLE `tbl_khuvuc`
  MODIFY `khuvuc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_loaiphong`
--
ALTER TABLE `tbl_loaiphong`
  MODIFY `loaiphong_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_loaisanpham`
--
ALTER TABLE `tbl_loaisanpham`
  MODIFY `loaisanpham_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nguyenlieu`
--
ALTER TABLE `tbl_nguyenlieu`
  MODIFY `nguyenlieu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phieudenbu`
--
ALTER TABLE `tbl_phieudenbu`
  MODIFY `phieudenbu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_phieudenbudetail`
--
ALTER TABLE `tbl_phieudenbudetail`
  MODIFY `phieudenbuDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_phieuhuy`
--
ALTER TABLE `tbl_phieuhuy`
  MODIFY `phieuhuy_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_phieuhuydetail`
--
ALTER TABLE `tbl_phieuhuydetail`
  MODIFY `phieuhuyDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  MODIFY `phieunhap_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_phieunhapdetail`
--
ALTER TABLE `tbl_phieunhapdetail`
  MODIFY `phieunhapDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_phong`
--
ALTER TABLE `tbl_phong`
  MODIFY `phong_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `sanpham_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
