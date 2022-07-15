-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2022 pada 18.38
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andry_laundry`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `jmlPenghasilan` (`tanggal_awal` DATETIME, `tanggal_akhir` DATETIME) RETURNS INT(11)  BEGIN 
	DECLARE jmlHasil INT;
	SELECT sum(
			(
			((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) - 
			(((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) * transaksi.diskon / 100)
			) 
			+ 
			((
			(((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) - 
			(((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) * transaksi.diskon / 100)) 
			* transaksi.pajak
			) / 100)
		) as penghasilan INTO jmlHasil
		FROM transaksi
		INNER JOIN user ON transaksi.id_user = user.id_user 
		INNER JOIN member ON transaksi.id_member = member.id_member 
		INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi 
		INNER JOIN paket ON detail_transaksi.id_paket = paket.id_paket 
		INNER JOIN jenis_paket ON paket.id_jenis_paket = jenis_paket.id_jenis_paket 
		INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE transaksi.tanggal_transaksi 
		BETWEEN tanggal_awal AND tanggal_akhir;
	RETURN jmlHasil;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jmlStatusTanggal` (`st` ENUM('proses','dicuci','siap diambil','sudah diambil'), `tgl` DATE) RETURNS INT(11) NO SQL BEGIN
DECLARE jmlHasil INT;
SELECT COUNT(*) AS jml INTO jmlHasil FROM transaksi WHERE status_transaksi = st AND date(tanggal_transaksi) = tgl;
RETURN jmlHasil;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jmlTransPaket` (`idPaket` INT) RETURNS INT(11)  BEGIN
DECLARE jmlHasil INT;
	SELECT COUNT(*) as jml INTO jmlHasil FROM detail_transaksi WHERE id_paket = idPaket;
    RETURN jmlHasil;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata`
--

CREATE TABLE `biodata` (
  `id_biodata` int(11) NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('pria','wanita') COLLATE utf8_unicode_ci NOT NULL,
  `golongan_darah` enum('o','a','b','ab') COLLATE utf8_unicode_ci DEFAULT NULL,
  `telepon` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `biodata`
--

INSERT INTO `biodata` (`id_biodata`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `golongan_darah`, `telepon`, `email`, `alamat`, `foto`, `id_user`) VALUES
(1, 'Andri Firman Saputra', 'Jakarta', '2002-01-29', 'pria', '', '087808675313', 'andri.firman.saputra.56@gmail.com', 'Jl. AMD Babakan Pocis No. 100 RT02/RW02 Bakti Jaya Kec. Setu Kota. Tangerang Selatan Prov. Banten Jawa Barat 15433', 'andri_foto6.png', 1),
(2, 'Andre Farhan Saputra', 'Jakarta', '2002-01-29', 'pria', '', '087853132111', 'andrefarhansaputra@gmail.com', 'Jl. AMD Babakan Pocis', '5cd9bfce39cac1.jpg', 2),
(3, 'Muhammad Irgi Al Ghitraf', 'Jakarta', '2002-08-28', 'pria', '', '085942442210', 'irgibungsu@gmail.com', 'Perum Puri Serpong 1 Blok D5 No. 7 RT 08 / RW 02 Setu', 'IMG_20200210_0724522.jpg', 3),
(4, 'Salsa Rahma Fathansa', 'Jakarta', '2002-08-09', 'wanita', '', '085823266575', 'salsa24@gmail.com', 'JL. MARUGA RAYA NO 17 RT 06/04 SERUA CIPUTAT TANGERANG SELATAN', 'default.png', 4),
(5, 'Indah Permata Sari', 'Tangerang', '2004-03-03', 'wanita', '', '087832134541', 'indahpermata25@gmail.com', 'KP. CIATER BARAT RT 02/01 CIATER SERPONG TANGERANG SELATAN 15317', 'default.png', 5),
(6, 'Rian Febri Alfiarudin', 'Tangerang', '2002-02-13', 'pria', '', '089631348598', 'rianfebri13@gmail.com', 'Kelurahan Setu Rt 16/04 Setu Tangerang Selatan', 'default.png', 6),
(7, 'FEBY FEBRIYANTY', 'Tangerang', '2002-02-21', 'wanita', '', '085978983093', 'febyfebrianti97@gmail.com', 'JL. PAMULANG 2 RT 03/09 BENDA BARU PAMULANG', 'default.png', 7),
(8, 'GITA AGUSTIN', 'Tangerang', '2002-08-01', 'wanita', '', '081244583209', 'gitaagustin32@gmail.com', 'Jl. Salak Kp. Buaran Rt 04/04 No. 001 Pondok Benda Pamulang', 'default.png', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `kuantitas` float NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `kuantitas`, `keterangan`, `id_transaksi`, `id_paket`) VALUES
(1, 2, 'baju x2', 1, 2),
(2, 1, 'baju x2', 3, 1),
(3, 3, 'baju x3', 4, 2),
(4, 2, 'baju x2', 5, 2),
(5, 2, 'baju x12', 7, 1),
(6, 2, 'baju x2', 8, 1),
(7, 1, 'baju x1', 8, 2),
(8, 2, 'baju x3', 9, 1),
(9, 2, 'jaket x2', 9, 2),
(10, 2, 'selimut x2', 9, 3),
(11, 1, 'baju x1', 10, 2),
(12, 2, 'baju x3', 11, 4),
(13, 2, 'baju x6', 12, 4),
(14, 2, 'jaket x2', 12, 5),
(15, 2, 'baju x2', 15, 1),
(16, 3, 'baju x3', 16, 2),
(17, 2, 'baju x2', 17, 1),
(18, 2, 'baju x2\r\n', 18, 2),
(19, 3, 'Baju x3, celana x5', 19, 1),
(20, 2, 'Jaket merah x2', 19, 2),
(21, 2, 'Selimut x1,\r\nbed cover hijau x1', 19, 3),
(22, 2, 'baju x3', 21, 1),
(23, 2, 'bed cover x2', 24, 3),
(36, 2, 'baju x2', 27, 1),
(37, 2, 'baju x3', 28, 1),
(38, 3, 'jaket x1, sweater x1, jeans x1', 28, 2),
(39, 2, 'bed cover x2', 28, 3),
(40, 2, 'baju x2', 29, 2),
(41, 2, 'baju x3', 29, 1),
(42, 2, 'baju x2', 30, 5),
(43, 6, 'baju x3, celana x6, jaket x1', 32, 1),
(44, 2, 'baju x4', 33, 1),
(45, 1, 'jaket x1', 33, 2),
(46, 2, 'bed cover x2', 33, 3),
(47, 3, 'baju x5, celana x6', 34, 4),
(49, 3, 'baju x5, celana x5', 35, 6),
(50, 2, 'kaos kaki x2', 34, 5),
(51, 5, '', 36, 4),
(52, 2, 'Baju x5, Celana x3', 37, 1),
(53, 1, 'baju x3', 38, 4),
(54, 2, 'kaos kaki x5 pasang', 38, 5),
(55, 2, 'baju 2x', 39, 2),
(56, 2, 'kaos kaki 2x', 40, 2),
(57, 2, 'baju x4', 40, 1),
(58, 2, 'jaket x2', 7, 2),
(59, 2, 'jaket x2', 41, 2),
(60, 1, 'baju x3', 42, 1),
(61, 5, 'O9I9', 43, 2),
(62, 4, 'kaos kaki (4) pasang', 44, 5),
(63, 5, 'baju', 45, 1),
(64, 4, 'kemeja', 45, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'super administrator'),
(2, 'administrator'),
(3, 'kasir'),
(4, 'owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_paket`
--

CREATE TABLE `jenis_paket` (
  `id_jenis_paket` int(11) NOT NULL,
  `nama_jenis_paket` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jenis_paket`
--

INSERT INTO `jenis_paket` (`id_jenis_paket`, `nama_jenis_paket`) VALUES
(1, 'kiloan'),
(2, 'selimut'),
(3, 'bed cover'),
(4, 'Kaos'),
(6, 'Celana'),
(8, 'satuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_log` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tanggal_log`, `id_user`) VALUES
(1, 'Pengguna super_administrator berhasil login', '2020-03-02 14:28:37', 1),
(2, 'Biodata Pengguna Andri Firman Saputra berhasil ditambahkan', '2020-03-02 14:31:04', 1),
(3, 'Outlet Andry Laundry Pamulang berhasil ditambahkan', '2020-03-02 14:32:18', 1),
(4, 'Pengguna andre975 berhasil ditambahkan', '2020-03-02 14:32:42', 1),
(5, 'Pengguna super_administrator berhasil logout', '2020-03-02 14:33:33', 1),
(6, 'Pengguna andre975 berhasil login', '2020-03-02 14:35:28', 2),
(7, 'Biodata Pengguna Andre Farhan Saputra berhasil ditambahkan', '2020-03-02 14:36:25', 2),
(8, 'Print profile', '2020-03-02 14:36:37', 2),
(9, 'Pengguna irgi12 berhasil ditambahkan', '2020-03-02 14:37:55', 2),
(10, 'Biodata Pengguna Muhammad Irgi Al Ghitraf berhasil ditambahkan', '2020-03-02 14:40:15', 2),
(11, 'Print profile', '2020-03-02 14:40:23', 2),
(12, 'Paket Kiloan Biasa AJA berhasil ditambahkan', '2020-03-02 14:43:08', 2),
(13, 'Paket satuan baju aja mas berhasil ditambahkan', '2020-03-02 14:45:42', 2),
(14, 'Paket Satuan baju aja mas berhasil diubah', '2020-03-02 14:45:49', 2),
(15, 'Paket WoW! Bed cover Ada disini! berhasil ditambahkan', '2020-03-02 14:46:30', 2),
(16, 'Pengguna andre975 berhasil login', '2020-03-02 14:47:48', 2),
(17, 'Member Salsa Rahma Fathansa berhasil ditambahkan', '2020-03-02 14:49:25', 2),
(18, 'Member Muhammad Fikri berhasil ditambahkan', '2020-03-02 14:50:37', 2),
(19, 'Transaksi 02032020122T0001 berhasil ditambahkan', '2020-03-02 14:52:26', 2),
(20, 'Transaksi 02032020122T0001 berhasil diubah', '2020-03-02 14:52:51', 2),
(21, 'Transaksi 02032020122T0001 berhasil diubah', '2020-03-02 14:53:06', 2),
(22, 'Transaksi 02032020122T0001 berhasil diubah', '2020-03-02 14:53:18', 2),
(23, 'Transaksi 02032020122T0001 berhasil dihapus', '2020-03-02 14:54:12', 2),
(24, 'Transaksi 02032020121T0001 berhasil ditambahkan', '2020-03-02 14:55:07', 2),
(25, 'Member Nazira Apriliani berhasil diubah', '2020-03-02 14:58:43', 2),
(26, 'Pengguna salsa321 berhasil ditambahkan', '2020-03-02 14:59:04', 2),
(27, 'Biodata Pengguna Salsa Rahma Fathansa berhasil ditambahkan', '2020-03-02 15:01:51', 2),
(28, 'Detail Transaksi 02032020121T0001 berhasil ditambahkan', '2020-03-02 15:02:41', 2),
(29, 'Pengguna andre975 berhasil logout', '2020-03-02 15:05:40', 2),
(30, 'Pengguna super_administrator berhasil login', '2020-03-02 15:05:46', 1),
(31, 'Pengguna indah76 berhasil ditambahkan', '2020-03-02 15:07:56', 1),
(32, 'Biodata Pengguna Indah Permata Sari berhasil ditambahkan', '2020-03-02 15:10:40', 1),
(33, 'Pengguna rian43 berhasil ditambahkan', '2020-03-02 15:11:34', 1),
(34, 'Biodata Pengguna Rian Febri Alfiarudin berhasil ditambahkan', '2020-03-02 15:12:26', 1),
(35, 'Pengguna febyfeb09 berhasil ditambahkan', '2020-03-02 15:12:57', 1),
(36, 'Biodata Pengguna FEBY FEBRIYANTY berhasil ditambahkan', '2020-03-02 15:14:49', 1),
(37, 'Pengguna super_administrator berhasil logout', '2020-03-02 15:16:26', 1),
(38, 'Pengguna irgi12 berhasil login', '2020-03-03 23:29:52', 3),
(39, 'Pengguna irgi12 berhasil login', '2020-03-03 23:35:09', 3),
(40, 'Transaksi  berhasil diubah statusnya', '2020-03-03 23:44:12', 3),
(41, 'Transaksi  berhasil diubah statusnya', '2020-03-03 23:46:35', 3),
(42, 'Transaksi  berhasil diubah statusnya', '2020-03-03 23:47:15', 3),
(43, 'Pengguna irgi12 berhasil logout', '2020-03-03 23:50:38', 3),
(44, 'Pengguna super_administrator berhasil login', '2020-03-03 23:50:44', 1),
(45, 'Transaksi 02032020121T0001 berhasil diubah', '2020-03-03 23:58:05', 1),
(46, 'Transaksi  berhasil diubah statusnya', '2020-03-03 23:58:27', 1),
(47, 'Transaksi 02032020121T0001 berhasil diubah', '2020-03-03 23:59:28', 1),
(48, 'Transaksi 02032020121T0001 berhasil diubah', '2020-03-03 23:59:35', 1),
(49, 'Transaksi  berhasil diubah statusnya', '2020-03-03 23:59:43', 1),
(50, 'Transaksi 02032020121T0001 berhasil diubah', '2020-03-04 00:00:39', 1),
(51, 'Transaksi 02032020121T0001 berhasil dihapus', '2020-03-04 00:00:45', 1),
(52, 'Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 00:01:16', 1),
(53, 'Transaksi  berhasil diubah statusnya', '2020-03-04 00:05:42', 1),
(54, 'Transaksi 04032020112T0002 berhasil ditambahkan', '2020-03-04 00:06:34', 1),
(55, 'Transaksi  berhasil diubah status transaksinya', '2020-03-04 00:10:37', 1),
(56, 'Transaksi 04032020112T0003 berhasil ditambahkan', '2020-03-04 00:17:04', 1),
(57, 'Pengguna super_administrator berhasil login', '2020-03-04 00:25:03', 1),
(58, 'Member Bintang Shakila Akassah berhasil ditambahkan', '2020-03-04 00:26:56', 1),
(59, 'Transaksi 04032020211T0004 berhasil ditambahkan', '2020-03-04 00:59:50', 1),
(60, 'Pengguna super_administrator berhasil login', '2020-03-04 01:04:21', 1),
(61, 'Transaksi 04032020113T0004 berhasil ditambahkan', '2020-03-04 01:04:42', 1),
(62, 'Transaksi 04032020113T0005 berhasil ditambahkan', '2020-03-04 01:04:52', 1),
(63, 'Pengguna super_administrator berhasil login', '2020-03-04 01:27:40', 1),
(64, 'Transaksi 04032020113T0005 berhasil ditambahkan', '2020-03-04 01:28:51', 1),
(65, 'Transaksi 04032020113T0005 berhasil dihapus', '2020-03-04 01:29:59', 1),
(66, 'Pengguna super_administrator berhasil login', '2020-03-04 01:31:25', 1),
(67, 'Transaksi 04032020112T0005 berhasil ditambahkan', '2020-03-04 01:31:35', 1),
(68, 'Pengguna super_administrator berhasil login', '2020-03-04 01:33:37', 1),
(69, 'Transaksi 04032020113T0005 berhasil ditambahkan', '2020-03-04 01:33:54', 1),
(70, 'Transaksi 04032020113T0005 berhasil dihapus', '2020-03-04 01:34:00', 1),
(71, 'Transaksi 04032020113T0005 berhasil ditambahkan', '2020-03-04 01:34:35', 1),
(72, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 02:32:41', 1),
(73, 'Transaksi 04032020112T0006 berhasil ditambahkan', '2020-03-04 02:33:11', 1),
(74, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 02:33:18', 1),
(75, 'Transaksi 04032020113T0006 berhasil ditambahkan', '2020-03-04 02:34:12', 1),
(76, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 02:34:19', 1),
(77, 'Pengguna super_administrator berhasil login', '2020-03-04 02:36:01', 1),
(78, 'Transaksi 04032020113T0007 berhasil ditambahkan', '2020-03-04 02:36:15', 1),
(79, 'Pengguna super_administrator berhasil login', '2020-03-04 02:38:14', 1),
(80, 'Transaksi 04032020111T0008 berhasil ditambahkan', '2020-03-04 02:38:28', 1),
(81, 'Transaksi 04032020111T0008 berhasil ditambahkan', '2020-03-04 02:39:05', 1),
(82, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 02:39:48', 1),
(83, 'Pengguna super_administrator berhasil login', '2020-03-04 02:41:43', 1),
(84, 'Transaksi 04032020113T0008 berhasil ditambahkan', '2020-03-04 02:41:56', 1),
(85, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 02:42:16', 1),
(86, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 02:42:40', 1),
(87, 'Pengguna super_administrator berhasil login', '2020-03-04 02:53:35', 1),
(88, 'Pengguna super_administrator berhasil logout', '2020-03-04 02:55:30', 1),
(89, 'Pengguna indah76 berhasil login', '2020-03-04 02:55:33', 5),
(90, 'Paket Reguler Kiloan berhasil ditambahkan', '2020-03-04 02:55:58', 5),
(91, 'Paket Reguler Satuan berhasil ditambahkan', '2020-03-04 02:56:23', 5),
(92, 'Pengguna indah76 berhasil logout', '2020-03-04 02:56:47', 5),
(93, 'Pengguna indah76 berhasil login', '2020-03-04 02:57:04', 5),
(94, 'Pengguna indah76 berhasil logout', '2020-03-04 02:58:14', 5),
(95, 'Pengguna super_administrator berhasil login', '2020-03-04 02:58:19', 1),
(96, 'Transaksi 04032020113T0009 berhasil ditambahkan', '2020-03-04 03:02:57', 1),
(97, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 03:06:55', 1),
(98, 'Pengguna super_administrator berhasil login', '2020-03-04 12:58:14', 1),
(99, 'Transaksi 04032020112T0010 berhasil ditambahkan', '2020-03-04 12:59:19', 1),
(100, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-04 12:59:33', 1),
(101, 'Pengguna super_administrator berhasil login', '2020-03-05 06:35:34', 1),
(102, 'Member Bintang Shakila Akassah berhasil diubah', '2020-03-05 06:38:19', 1),
(103, 'Pengguna super_administrator berhasil logout', '2020-03-05 06:40:23', 1),
(104, 'Pengguna andre975 berhasil login', '2020-03-05 06:40:30', 2),
(105, 'Transaksi 05032020122T0001 berhasil ditambahkan', '2020-03-05 06:41:41', 2),
(106, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-05 06:42:36', 2),
(107, 'Paket Satuan aja mas berhasil diubah', '2020-03-05 06:56:08', 2),
(108, 'Transaksi 05032020122T0001 berhasil dihapus', '2020-03-05 06:57:31', 2),
(109, 'Transaksi 05032020122T0001 berhasil ditambahkan', '2020-03-05 06:58:55', 2),
(110, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-05 07:00:20', 2),
(111, 'Pengguna andre975 berhasil logout', '2020-03-05 07:00:39', 2),
(112, 'Pengguna andre975 berhasil login', '2020-03-05 07:00:45', 2),
(113, 'Transaksi 05032020122T0002 berhasil ditambahkan', '2020-03-05 07:01:36', 2),
(114, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-05 07:01:53', 2),
(115, 'Transaksi 05032020122T0003 berhasil ditambahkan', '2020-03-05 07:02:45', 2),
(116, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-05 07:04:40', 2),
(117, 'Detail Transaksi 04032020111T0001 berhasil ditambahkan', '2020-03-05 07:14:10', 2),
(118, 'Transaksi 05032020122T0001 berhasil ditambahkan', '2020-03-05 07:20:07', 2),
(119, 'Detail Transaksi 05032020122T0001 berhasil ditambahkan', '2020-03-05 07:20:18', 2),
(120, 'Pengguna andre975 berhasil login', '2020-03-06 06:52:35', 2),
(121, 'Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 06:55:39', 2),
(122, 'Detail Transaksi 05032020122T0001 berhasil ditambahkan', '2020-03-06 06:58:41', 2),
(123, 'Pembayaran Transaksi 06032020123T0001 berhasil', '2020-03-06 07:30:21', 2),
(124, 'Pembayaran Transaksi 06032020123T0001 berhasil', '2020-03-06 07:31:22', 2),
(125, 'Pembayaran Transaksi 06032020123T0001 berhasil', '2020-03-06 07:32:33', 2),
(126, 'Pembayaran Transaksi 06032020123T0001 berhasil', '2020-03-06 07:35:00', 2),
(127, 'Pengguna andre975 berhasil logout', '2020-03-06 07:37:35', 2),
(128, 'Pengguna andre975 berhasil login', '2020-03-06 07:37:41', 2),
(129, 'Transaksi 06032020121T0002 berhasil ditambahkan', '2020-03-06 07:38:22', 2),
(130, 'Detail Transaksi 05032020122T0001 berhasil ditambahkan', '2020-03-06 07:38:28', 2),
(131, 'Pembayaran Transaksi 06032020121T0002 berhasil', '2020-03-06 07:38:36', 2),
(132, 'Pembayaran Transaksi 06032020121T0002 gagal! uang yang dibayar kurang dari total harga', '2020-03-06 07:42:56', 2),
(133, 'Pembayaran Transaksi 06032020121T0002 gagal! uang yang dibayar kurang dari total harga', '2020-03-06 07:44:11', 2),
(134, 'Pembayaran Transaksi 06032020121T0002 berhasil', '2020-03-06 07:45:59', 2),
(135, 'Pengguna andre975 berhasil logout', '2020-03-06 07:50:57', 2),
(136, 'Pengguna andre975 berhasil login', '2020-03-06 07:51:04', 2),
(137, 'Transaksi 06032020121T0001 berhasil ditambahkan', '2020-03-06 07:51:16', 2),
(138, 'Detail Transaksi 06032020121T0001 berhasil ditambahkan', '2020-03-06 07:51:35', 2),
(139, 'Pengguna andre975 berhasil logout', '2020-03-06 07:52:51', 2),
(140, 'Pengguna andre975 berhasil login', '2020-03-06 07:53:18', 2),
(141, 'Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 07:53:44', 2),
(142, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 07:54:55', 2),
(143, 'Pembayaran Transaksi 06032020123T0001 gagal! uang yang dibayar kurang dari total harga', '2020-03-06 08:00:33', 2),
(144, 'Pembayaran Transaksi 06032020123T0001 berhasil', '2020-03-06 08:01:31', 2),
(145, 'Cetak Invoice 06032020123T0001 Bintang Shakila Akassah', '2020-03-06 08:22:02', 2),
(146, 'Cetak Invoice  ', '2020-03-06 08:22:02', 2),
(147, 'Cetak Invoice 06032020123T0001 Bintang Shakila Akassah', '2020-03-06 08:22:38', 2),
(148, 'Pengguna andre975 berhasil login', '2020-03-06 10:46:22', 2),
(149, 'Transaksi 06032020122T0002 berhasil ditambahkan', '2020-03-06 10:46:55', 2),
(150, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 10:50:13', 2),
(151, 'Transaksi 06032020123T0002 berhasil ditambahkan', '2020-03-06 10:50:57', 2),
(152, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 10:51:07', 2),
(153, 'Pembayaran Transaksi 06032020123T0002 berhasil', '2020-03-06 10:51:35', 2),
(154, 'Cetak Invoice 06032020123T0002 Bintang Shakila Akassah', '2020-03-06 10:51:46', 2),
(155, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:53:12', 2),
(156, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:54:57', 2),
(157, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:55:09', 2),
(158, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:56:11', 2),
(159, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:58:36', 2),
(160, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:58:55', 2),
(161, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:59:11', 2),
(162, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:59:19', 2),
(163, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:59:32', 2),
(164, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 10:59:49', 2),
(165, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:01:04', 2),
(166, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:01:45', 2),
(167, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:04:55', 2),
(168, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:05:37', 2),
(169, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:06:56', 2),
(170, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:11:19', 2),
(171, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:12:06', 2),
(172, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:12:09', 2),
(173, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:12:22', 2),
(174, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:12:24', 2),
(175, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:12:30', 2),
(176, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:13:02', 2),
(177, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:13:18', 2),
(178, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:13:45', 2),
(179, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:14:04', 2),
(180, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:14:42', 2),
(181, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:14:46', 2),
(182, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:14:58', 2),
(183, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:16:01', 2),
(184, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:16:19', 2),
(185, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:16:28', 2),
(186, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:19:16', 2),
(187, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:19:27', 2),
(188, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:19:29', 2),
(189, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:29:06', 2),
(190, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:31:02', 2),
(191, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:31:17', 2),
(192, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:31:31', 2),
(193, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:31:40', 2),
(194, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:31:53', 2),
(195, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:32:06', 2),
(196, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:32:19', 2),
(197, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:33:03', 2),
(198, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:33:12', 2),
(199, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:33:31', 2),
(200, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:33:39', 2),
(201, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:36:06', 2),
(202, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:36:25', 2),
(203, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:36:39', 2),
(204, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:36:49', 2),
(205, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:37:00', 2),
(206, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:37:34', 2),
(207, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:38:15', 2),
(208, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:38:54', 2),
(209, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:39:35', 2),
(210, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:39:42', 2),
(211, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:39:49', 2),
(212, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:39:56', 2),
(213, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:40:34', 2),
(214, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:40:38', 2),
(215, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:40:52', 2),
(216, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:43:59', 2),
(217, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:46:41', 2),
(218, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:46:50', 2),
(219, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:46:53', 2),
(220, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:47:39', 2),
(221, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:47:50', 2),
(222, 'Cetak Invoice - 06032020123T0002 - Bintang Shakila Akassah', '2020-03-06 11:47:53', 2),
(223, 'Member Bintang Shakila Akassah berhasil diubah', '2020-03-06 11:48:31', 2),
(224, 'Member Bintang Shakila Akassah berhasil diubah', '2020-03-06 11:48:54', 2),
(225, 'Pengguna andre975 berhasil logout', '2020-03-06 11:49:11', 2),
(226, 'Pengguna andre975 berhasil login', '2020-03-06 19:21:55', 2),
(227, 'Transaksi  berhasil diubah statusnya', '2020-03-06 19:25:53', 2),
(228, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-06 19:26:30', 2),
(229, 'Transaksi 06032020123T0003 berhasil ditambahkan', '2020-03-06 19:26:44', 2),
(230, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 19:26:51', 2),
(231, 'Pembayaran Transaksi 06032020123T0003 berhasil', '2020-03-06 19:31:22', 2),
(232, 'Cetak Invoice - 06032020123T0003 - Bintang Shakila Akassah', '2020-03-06 19:31:25', 2),
(233, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:34:53', 2),
(234, 'Cetak Invoice - 06032020123T0003 - Bintang Shakila Akassah', '2020-03-06 19:37:43', 2),
(235, 'Pembayaran Transaksi 06032020122T0002 berhasil', '2020-03-06 19:46:00', 2),
(236, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:48:15', 2),
(237, 'Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 19:52:58', 2),
(238, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 19:55:17', 2),
(239, 'Pembayaran Transaksi 06032020123T0001 berhasil', '2020-03-06 19:55:27', 2),
(240, 'Cetak Invoice - 06032020123T0001 - Bintang Shakila Akassah', '2020-03-06 19:55:30', 2),
(241, 'Transaksi 06032020122T0002 berhasil ditambahkan', '2020-03-06 19:55:56', 2),
(242, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 19:56:18', 2),
(243, 'Pembayaran Transaksi 06032020122T0002 berhasil', '2020-03-06 19:56:24', 2),
(244, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:56:29', 2),
(245, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:57:19', 2),
(246, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:57:28', 2),
(247, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:57:33', 2),
(248, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:57:37', 2),
(249, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:58:38', 2),
(250, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:58:40', 2),
(251, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:58:48', 2),
(252, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:58:52', 2),
(253, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:58:55', 2),
(254, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:59:17', 2),
(255, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:59:24', 2),
(256, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 19:59:29', 2),
(257, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:00', 2),
(258, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:03', 2),
(259, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:08', 2),
(260, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:26', 2),
(261, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:32', 2),
(262, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:45', 2),
(263, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:00:53', 2),
(264, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:01:03', 2),
(265, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:01:09', 2),
(266, 'Transaksi  berhasil diubah status transaksinya', '2020-03-06 20:01:45', 2),
(267, 'Transaksi  berhasil diubah status transaksinya', '2020-03-06 20:01:48', 2),
(268, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-06 20:13:30', 2),
(269, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-06 20:15:15', 2),
(270, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-06 20:15:22', 2),
(271, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-06 20:15:46', 2),
(272, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-06 20:17:31', 2),
(273, 'Cetak Invoice -  - ', '2020-03-06 20:18:37', 2),
(274, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:19:33', 2),
(275, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:20:01', 2),
(276, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:20:21', 2),
(277, 'Transaksi 06032020123T0001 berhasil diubah', '2020-03-06 20:20:44', 2),
(278, 'Cetak Invoice - 06032020123T0001 - Bintang Shakila Akassah', '2020-03-06 20:21:00', 2),
(279, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:21:14', 2),
(280, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 20:25:29', 2),
(281, 'Transaksi 06032020123T0001 berhasil diubah', '2020-03-06 20:40:29', 2),
(282, 'Transaksi 06032020123T0001 berhasil diubah', '2020-03-06 20:41:11', 2),
(283, 'Transaksi 06032020123T0001 berhasil diubah', '2020-03-06 20:42:00', 2),
(284, 'Transaksi 06032020123T0001 berhasil diubah', '2020-03-06 20:42:06', 2),
(285, 'Pengguna andre975 berhasil login', '2020-03-06 20:45:13', 2),
(286, 'Pengguna andre975 berhasil login', '2020-03-06 20:46:01', 2),
(287, 'Pengguna andre975 berhasil login', '2020-03-06 20:46:22', 2),
(288, 'Transaksi 06032020121T0002 berhasil ditambahkan', '2020-03-06 21:15:57', 2),
(289, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 21:16:06', 2),
(290, 'Pembayaran Transaksi 06032020121T0002 berhasil', '2020-03-06 21:16:10', 2),
(291, 'Cetak Invoice - 06032020121T0002 - Nazira Apriliani', '2020-03-06 21:16:14', 2),
(292, 'Transaksi 06032020122T0002 berhasil ditambahkan', '2020-03-06 21:16:48', 2),
(293, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 21:17:02', 2),
(294, 'Pengguna andre975 berhasil login', '2020-03-06 21:28:30', 2),
(295, 'Pengguna indah76 berhasil login', '2020-03-06 21:59:17', 5),
(296, 'Pengguna indah76 berhasil login', '2020-03-06 22:00:01', 5),
(297, 'Member Namira Nindya Fitri berhasil ditambahkan', '2020-03-06 22:04:05', 5),
(298, 'Member Yos Hermawan berhasil ditambahkan', '2020-03-06 22:05:17', 5),
(299, 'Member Arum Diah Ariyanti berhasil ditambahkan', '2020-03-06 22:06:00', 5),
(300, 'Transaksi 06032020256T0002 berhasil ditambahkan', '2020-03-06 22:06:32', 5),
(301, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 22:06:53', 5),
(302, 'Pembayaran Transaksi 06032020256T0002 berhasil', '2020-03-06 22:07:00', 5),
(303, 'Cetak Invoice - 06032020256T0002 - Arum Diah Ariyanti', '2020-03-06 22:07:08', 5),
(304, 'Transaksi 06032020254T0003 berhasil ditambahkan', '2020-03-06 22:11:09', 5),
(305, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 22:34:46', 5),
(306, 'Pembayaran Transaksi 06032020254T0003 berhasil', '2020-03-06 22:35:10', 5),
(307, 'Cetak Invoice - 06032020254T0003 - Namira Nindya Fitri', '2020-03-06 22:35:13', 5),
(308, 'Transaksi 06032020256T0003 berhasil ditambahkan', '2020-03-06 22:35:29', 5),
(309, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 22:35:36', 5),
(310, 'Cetak Invoice -  - ', '2020-03-06 22:36:03', 5),
(311, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 22:36:08', 5),
(312, 'Cetak Invoice - 06032020122T0002 - Muhammad Fikri', '2020-03-06 22:36:11', 5),
(313, 'Cetak Invoice - 06032020256T0003 - Arum Diah Ariyanti', '2020-03-06 22:36:27', 5),
(314, 'Cetak Invoice - 06032020121T0002 - Nazira Apriliani', '2020-03-06 23:15:44', 5),
(315, 'Cetak Invoice - 06032020121T0002 - Nazira Apriliani', '2020-03-06 23:15:49', 5),
(316, 'Pengguna indah76 berhasil logout', '2020-03-06 23:23:31', 5),
(317, 'Pengguna andre975 berhasil login', '2020-03-06 23:23:36', 2),
(318, 'Transaksi 06032020126T0004 berhasil ditambahkan', '2020-03-06 23:24:10', 2),
(319, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 23:24:26', 2),
(320, 'Pembayaran Transaksi 06032020126T0004 berhasil', '2020-03-06 23:24:31', 2),
(321, 'Cetak Invoice - 06032020126T0004 - Arum Diah Ariyanti', '2020-03-06 23:24:33', 2),
(322, 'Transaksi 06032020123T0004 berhasil ditambahkan', '2020-03-06 23:25:12', 2),
(323, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-06 23:25:33', 2),
(324, 'Pengguna andre975 berhasil logout', '2020-03-06 23:45:55', 2),
(325, 'Pengguna super_administrator berhasil login', '2020-03-06 23:46:01', 1),
(326, 'Pembayaran Transaksi 06032020123T0004 berhasil', '2020-03-06 23:49:29', 2),
(327, 'Cetak Invoice - 06032020123T0004 - Bintang Shakila Akassah', '2020-03-06 23:49:33', 1),
(328, 'Pembayaran Transaksi 06032020256T0003 berhasil', '2020-03-06 23:51:31', 1),
(329, 'Cetak Invoice - 06032020256T0003 - Arum Diah Ariyanti', '2020-03-06 23:51:33', 1),
(330, 'Pengguna super_administrator berhasil logout', '2020-03-06 23:52:30', 1),
(331, 'Pengguna andre975 berhasil login', '2020-03-07 12:57:55', 2),
(332, 'Transaksi  berhasil diubah status transaksinya', '2020-03-07 13:21:21', 2),
(333, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-07 13:24:47', 2),
(334, 'Detail Transaksi 06032020123T0001 berhasil ditambahkan', '2020-03-07 13:25:05', 2),
(335, 'Detail Transaksi 06032020121T0002 berhasil ditambahkan', '2020-03-07 13:28:25', 2),
(336, 'Detail Transaksi 06032020122T0002 berhasil dihapus', '2020-03-07 13:28:48', 2),
(337, 'Detail Transaksi  berhasil dihapus', '2020-03-07 13:28:51', 2),
(338, 'Detail Transaksi  berhasil dihapus', '2020-03-07 13:28:57', 2),
(339, 'Cetak Invoice - 06032020126T0004 - Arum Diah Ariyanti', '2020-03-07 13:29:29', 2),
(340, 'Cetak Invoice - 06032020123T0004 - Bintang Shakila Akassah', '2020-03-07 13:29:50', 2),
(341, 'Detail Transaksi 06032020126T0004 berhasil ditambahkan', '2020-03-07 13:30:40', 2),
(342, 'Pengguna andre975 berhasil login', '2020-03-08 09:09:59', 2),
(343, 'Transaksi 06032020123T0004 berhasil diubah', '2020-03-08 09:11:37', 2),
(344, 'Transaksi 06032020123T0004 berhasil diubah', '2020-03-08 09:12:05', 2),
(345, 'Transaksi 06032020123T0004 berhasil diubah', '2020-03-08 09:14:58', 2),
(346, 'Transaksi 06032020122T0002 berhasil diubah', '2020-03-08 09:15:18', 2),
(347, 'Transaksi 08032020126T0001 berhasil ditambahkan', '2020-03-08 09:18:07', 2),
(348, 'Detail Transaksi 08032020126T0001 berhasil ditambahkan', '2020-03-08 09:18:48', 2),
(349, 'Transaksi 08032020126T0001 berhasil diubah', '2020-03-08 09:19:46', 2),
(350, 'Pengguna andre975 berhasil logout', '2020-03-08 09:22:43', 2),
(351, 'Pengguna andre975 berhasil login', '2020-03-08 09:22:48', 2),
(352, 'Transaksi 08032020126T0001 berhasil diubah', '2020-03-08 09:23:00', 2),
(353, 'Pembayaran Transaksi 08032020126T0001 berhasil', '2020-03-08 09:23:10', 2),
(354, 'Cetak Invoice - 08032020126T0001 - Arum Diah Ariyanti', '2020-03-08 09:23:14', 2),
(355, 'Cetak Invoice - 08032020126T0001 - Arum Diah Ariyanti', '2020-03-08 09:24:05', 2),
(356, 'Cetak Invoice - 08032020126T0001 - Arum Diah Ariyanti', '2020-03-08 09:24:36', 2),
(357, 'Cetak Invoice - 08032020126T0001 - Arum Diah Ariyanti', '2020-03-08 09:26:07', 2),
(358, 'Transaksi 08032020123T0002 berhasil ditambahkan', '2020-03-08 09:26:36', 2),
(359, 'Detail Transaksi 08032020123T0002 berhasil ditambahkan', '2020-03-08 09:28:07', 2),
(360, 'Pembayaran Transaksi 08032020123T0002 berhasil', '2020-03-08 09:28:18', 2),
(361, 'Cetak Invoice - 08032020123T0002 - Bintang Shakila Akassah', '2020-03-08 09:28:33', 2),
(362, 'Transaksi  berhasil diubah status transaksinya', '2020-03-08 09:33:14', 2),
(363, 'Transaksi 08032020122T0002 berhasil ditambahkan', '2020-03-08 09:34:07', 2),
(364, 'Detail Transaksi 08032020122T0002 berhasil ditambahkan', '2020-03-08 09:34:14', 2),
(365, 'Pengguna andre975 berhasil logout', '2020-03-08 09:40:56', 2),
(366, 'Pengguna andre975 berhasil login', '2020-03-08 09:41:01', 2),
(367, 'Transaksi 08032020123T0002 berhasil ditambahkan', '2020-03-08 09:41:16', 2),
(368, 'Detail Transaksi 08032020123T0002 berhasil ditambahkan', '2020-03-08 09:41:27', 2),
(369, 'Pengguna andre975 berhasil login', '2020-03-08 09:42:49', 2),
(370, 'Transaksi 08032020123T0001 berhasil ditambahkan', '2020-03-08 09:43:03', 2),
(371, 'Detail Transaksi 08032020123T0001 berhasil ditambahkan', '2020-03-08 09:43:19', 2),
(372, 'Pembayaran Transaksi 08032020123T0001 berhasil', '2020-03-08 09:49:52', 2),
(373, 'Cetak Invoice - 08032020123T0001 - Bintang Shakila Akassah', '2020-03-08 09:51:25', 2),
(374, 'Cetak Invoice - 08032020123T0001 - Bintang Shakila Akassah', '2020-03-08 09:52:06', 2),
(375, 'Cetak Invoice - 08032020123T0001 - Bintang Shakila Akassah', '2020-03-08 09:52:20', 2),
(376, 'Cetak Invoice - 08032020123T0001 - Bintang Shakila Akassah', '2020-03-08 09:52:31', 2),
(377, 'Cetak Invoice - 08032020123T0001 - Bintang Shakila Akassah', '2020-03-08 09:54:44', 2),
(378, 'Cetak Invoice - 08032020123T0001 - Bintang Shakila Akassah', '2020-03-08 09:56:41', 2),
(379, 'Transaksi 08032020124T0001 berhasil ditambahkan', '2020-03-08 09:57:27', 2),
(380, 'Detail Transaksi 08032020124T0001 berhasil ditambahkan', '2020-03-08 09:57:42', 2),
(381, 'Pembayaran Transaksi 08032020124T0001 gagal! uang yang dibayar kurang dari total harga', '2020-03-08 10:00:40', 2),
(382, 'Pembayaran Transaksi 08032020124T0001 berhasil', '2020-03-08 10:00:45', 2),
(383, 'Cetak Invoice - 08032020124T0001 - Namira Nindya Fitri', '2020-03-08 10:00:48', 2),
(384, 'Cetak Invoice - 08032020124T0001 - Namira Nindya Fitri', '2020-03-08 10:01:21', 2),
(385, 'Cetak Invoice - 08032020124T0001 - Namira Nindya Fitri', '2020-03-08 10:01:34', 2),
(386, 'Cetak Invoice - 08032020124T0001 - Namira Nindya Fitri', '2020-03-08 10:02:13', 2),
(387, 'Transaksi  berhasil diubah status transaksinya', '2020-03-08 10:02:31', 2),
(388, 'Transaksi  berhasil diubah status transaksinya', '2020-03-08 10:02:33', 2),
(389, 'Transaksi 08032020122T0002 berhasil ditambahkan', '2020-03-08 10:06:02', 2),
(390, 'Detail Transaksi 08032020122T0002 gagal ditambahkan', '2020-03-08 10:14:43', 2),
(391, 'Detail Transaksi 08032020122T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:15:14', 2),
(392, 'Detail Transaksi 08032020122T0002 berhasil ditambahkan', '2020-03-08 10:15:26', 2),
(393, 'Transaksi 08032020123T0002 berhasil ditambahkan', '2020-03-08 10:18:51', 2),
(394, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:38:22', 2),
(395, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:38:30', 2),
(396, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:42:25', 2),
(397, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:43:30', 2),
(398, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:43:37', 2),
(399, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:43:40', 2),
(400, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:44:41', 2),
(401, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:44:44', 2),
(402, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:45:50', 2),
(403, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:45:58', 2),
(404, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:46:57', 2),
(405, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:49:39', 2),
(406, 'Detail Transaksi 08032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:49:42', 2),
(407, 'Detail Transaksi 08032020123T0002 berhasil ditambahkan', '2020-03-08 10:49:51', 2),
(408, 'Pengguna andre975 berhasil logout', '2020-03-08 10:50:16', 2),
(409, 'Pengguna rian43 berhasil login', '2020-03-08 10:50:28', 6),
(410, 'Transaksi 08032020264T0002 berhasil ditambahkan', '2020-03-08 10:50:43', 6),
(411, 'Detail Transaksi 08032020264T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 10:50:46', 6),
(412, 'Detail Transaksi 08032020264T0002 berhasil ditambahkan', '2020-03-08 10:51:00', 6),
(413, 'Pembayaran Transaksi 08032020264T0002 berhasil', '2020-03-08 10:51:12', 6),
(414, 'Cetak Invoice - 08032020264T0002 - Namira Nindya Fitri', '2020-03-08 10:51:16', 6),
(415, 'Transaksi 08032020264T0002 berhasil diubah', '2020-03-08 10:52:02', 6),
(416, 'Pengguna rian43 berhasil logout', '2020-03-08 10:52:11', 6),
(417, 'Pengguna rian43 berhasil login', '2020-03-08 10:56:34', 6),
(418, 'Transaksi 08032020264T0002 berhasil diubah', '2020-03-08 10:56:51', 6),
(419, 'Transaksi 08032020266T0003 berhasil ditambahkan', '2020-03-08 10:57:05', 6),
(420, 'Detail Transaksi 08032020266T0003 berhasil ditambahkan', '2020-03-08 10:57:10', 6),
(421, 'Transaksi 08032020266T0003 berhasil diubah', '2020-03-08 10:57:32', 6),
(422, 'Pembayaran Transaksi 08032020266T0003 berhasil', '2020-03-08 10:57:38', 6),
(423, 'Cetak Invoice - 08032020266T0003 - Arum Diah Ariyanti', '2020-03-08 10:57:42', 6),
(424, 'Transaksi 08032020263T0004 berhasil ditambahkan', '2020-03-08 10:58:05', 6),
(425, 'Detail Transaksi 08032020263T0004 berhasil ditambahkan', '2020-03-08 10:58:20', 6),
(426, 'Transaksi  berhasil diubah statusnya', '2020-03-08 11:00:03', 6),
(427, 'Transaksi 08032020263T0004 berhasil diubah', '2020-03-08 11:02:47', 6),
(428, 'Pembayaran Transaksi 08032020263T0004 berhasil', '2020-03-08 11:04:23', 6),
(429, 'Cetak Invoice - 08032020263T0004 - Bintang Shakila Akassah', '2020-03-08 11:04:26', 6),
(430, 'Cetak Invoice - 08032020263T0004 - Bintang Shakila Akassah', '2020-03-08 11:04:32', 6),
(431, 'Transaksi 08032020262T0004 berhasil ditambahkan', '2020-03-08 11:04:55', 6),
(432, 'Detail Transaksi 08032020262T0004 gagal ditambahkan! isi minimal 1 paket', '2020-03-08 11:04:58', 6),
(433, 'Detail Transaksi 08032020262T0004 berhasil ditambahkan', '2020-03-08 11:05:04', 6),
(434, 'Transaksi 08032020262T0004 berhasil ditambahkan', '2020-03-08 11:07:04', 6),
(435, 'Detail Transaksi 08032020262T0004 berhasil ditambahkan', '2020-03-08 11:07:09', 6),
(436, 'Transaksi 08032020262T0005 berhasil ditambahkan', '2020-03-08 11:17:55', 6),
(437, 'Detail Transaksi 08032020262T0005 berhasil ditambahkan', '2020-03-08 11:18:06', 6),
(438, 'Transaksi 08032020261T0001 berhasil ditambahkan', '2020-03-08 11:19:04', 6),
(439, 'Detail Transaksi 08032020261T0001 berhasil ditambahkan', '2020-03-08 11:19:26', 6),
(440, 'Pembayaran Transaksi 08032020261T0001 berhasil', '2020-03-08 11:19:39', 6),
(441, 'Cetak Invoice - 08032020261T0001 - Nazira Apriliani', '2020-03-08 11:19:42', 6),
(442, 'Cetak Invoice - 08032020261T0001 - Nazira Apriliani', '2020-03-08 11:23:30', 6),
(443, 'Transaksi  berhasil diubah status transaksinya', '2020-03-08 11:24:24', 6),
(444, 'Transaksi  berhasil diubah status transaksinya', '2020-03-08 11:24:28', 6),
(445, 'Transaksi 08032020265T0002 berhasil ditambahkan', '2020-03-08 11:24:44', 6),
(446, 'Detail Transaksi 08032020265T0002 berhasil ditambahkan', '2020-03-08 11:24:52', 6),
(447, 'Pengguna andre975 berhasil login', '2020-03-08 15:33:23', 2),
(448, 'Transaksi 08032020125T0003 berhasil ditambahkan', '2020-03-08 15:34:02', 2),
(449, 'Detail Transaksi 08032020125T0003 berhasil ditambahkan', '2020-03-08 15:34:39', 2),
(450, 'Cetak Invoice - 08032020125T0003 - Yos Hermawan', '2020-03-08 15:37:48', 2),
(451, 'Pembayaran Transaksi 08032020125T0003 berhasil', '2020-03-08 15:38:15', 2),
(452, 'Cetak Invoice - 08032020125T0003 - Yos Hermawan', '2020-03-08 15:38:25', 2),
(453, 'Pengguna rian43 berhasil login', '2020-03-08 15:39:43', 6),
(454, 'Transaksi 08032020264T0004 berhasil ditambahkan', '2020-03-08 15:40:05', 6),
(455, 'Detail Transaksi 08032020264T0004 berhasil ditambahkan', '2020-03-08 15:40:12', 6),
(456, 'Pembayaran Transaksi 08032020264T0004 berhasil', '2020-03-08 15:40:20', 6),
(457, 'Cetak Invoice - 08032020264T0004 - Namira Nindya Fitri', '2020-03-08 15:40:23', 6),
(458, 'Pembayaran Transaksi 08032020265T0002 berhasil', '2020-03-08 15:40:47', 6),
(459, 'Cetak Invoice - 08032020265T0002 - Yos Hermawan', '2020-03-08 15:40:50', 6),
(460, 'Pengguna andre975 berhasil login', '2020-03-08 16:38:32', 2),
(461, 'Pengguna andre975 berhasil logout', '2020-03-08 16:38:48', 2),
(462, 'Pengguna andre975 berhasil login', '2020-03-08 16:39:25', 2),
(463, 'Transaksi 08032020125T0003 berhasil diubah', '2020-03-08 16:40:07', 2),
(464, 'Pembayaran Transaksi 08032020125T0003 berhasil', '2020-03-08 16:40:11', 2),
(465, 'Cetak Invoice - 08032020125T0003 - Yos Hermawan', '2020-03-08 16:40:16', 2),
(466, 'Transaksi 08032020125T0005 berhasil ditambahkan', '2020-03-08 16:40:52', 2),
(467, 'Detail Transaksi 08032020125T0005 berhasil ditambahkan', '2020-03-08 16:40:57', 2),
(468, 'Transaksi 08032020125T0005 berhasil diubah', '2020-03-08 16:44:45', 2),
(469, 'Pembayaran Transaksi 08032020125T0005 berhasil', '2020-03-08 16:46:54', 2),
(470, 'Cetak Invoice - 08032020125T0005 - Yos Hermawan', '2020-03-08 16:46:56', 2),
(471, 'Transaksi 08032020123T0006 berhasil ditambahkan', '2020-03-08 16:47:19', 2),
(472, 'Detail Transaksi 08032020123T0006 berhasil ditambahkan', '2020-03-08 16:48:27', 2),
(473, 'Pembayaran Transaksi 08032020123T0006 berhasil', '2020-03-08 16:48:47', 2),
(474, 'Cetak Invoice - 08032020123T0006 - Bintang Shakila Akassah', '2020-03-08 16:48:51', 2),
(475, 'Cetak Invoice - 08032020123T0006 - Bintang Shakila Akassah', '2020-03-08 16:50:20', 2),
(476, 'Pengguna andre975 berhasil login', '2020-03-09 08:22:11', 2),
(477, 'Transaksi 09032020123T0001 berhasil ditambahkan', '2020-03-09 08:24:24', 2),
(478, 'Detail Transaksi 09032020123T0001 berhasil ditambahkan', '2020-03-09 08:24:32', 2),
(479, 'Transaksi 09032020123T0001 berhasil diubah', '2020-03-09 08:24:53', 2),
(480, 'Pembayaran Transaksi 09032020123T0001 berhasil', '2020-03-09 08:24:57', 2),
(481, 'Cetak Invoice - 09032020123T0001 - Bintang Shakila Akassah', '2020-03-09 08:25:00', 2),
(482, 'Pembayaran Transaksi 08032020123T0006 berhasil', '2020-03-09 08:27:36', 2),
(483, 'Cetak Invoice - 08032020123T0006 - Bintang Shakila Akassah', '2020-03-09 08:27:39', 2),
(484, 'Transaksi 09032020122T0002 berhasil ditambahkan', '2020-03-09 08:28:05', 2),
(485, 'Detail Transaksi 09032020122T0002 berhasil ditambahkan', '2020-03-09 08:28:13', 2),
(486, 'Transaksi 09032020122T0002 berhasil diubah', '2020-03-09 08:28:31', 2),
(487, 'Pembayaran Transaksi 09032020122T0002 berhasil', '2020-03-09 08:28:35', 2),
(488, 'Cetak Invoice - 09032020122T0002 - Muhammad Fikri', '2020-03-09 08:28:38', 2),
(489, 'Transaksi 09032020123T0003 berhasil ditambahkan', '2020-03-09 08:32:06', 2),
(490, 'Detail Transaksi 09032020123T0003 berhasil ditambahkan', '2020-03-09 08:32:13', 2),
(491, 'Pembayaran Transaksi 09032020123T0003 berhasil', '2020-03-09 08:32:32', 2),
(492, 'Cetak Invoice - 09032020123T0003 - Bintang Shakila Akassah', '2020-03-09 08:32:35', 2),
(493, 'Cetak Invoice - 09032020123T0003 - Bintang Shakila Akassah', '2020-03-09 08:33:29', 2),
(494, 'Transaksi 09032020121T0004 berhasil ditambahkan', '2020-03-09 08:34:05', 2),
(495, 'Detail Transaksi 09032020121T0004 berhasil ditambahkan', '2020-03-09 08:34:16', 2),
(496, 'Pembayaran Transaksi 09032020121T0004 berhasil', '2020-03-09 08:34:48', 2),
(497, 'Cetak Invoice - 09032020121T0004 - Nazira Apriliani', '2020-03-09 08:34:50', 2),
(498, 'Transaksi 09032020123T0005 berhasil ditambahkan', '2020-03-09 08:35:09', 2),
(499, 'Detail Transaksi 09032020123T0005 berhasil ditambahkan', '2020-03-09 08:35:28', 2),
(500, 'Pembayaran Transaksi 09032020123T0005 berhasil', '2020-03-09 08:35:34', 2),
(501, 'Cetak Invoice - 09032020123T0005 - Bintang Shakila Akassah', '2020-03-09 08:35:39', 2),
(502, 'Transaksi 09032020126T0006 berhasil ditambahkan', '2020-03-09 08:36:04', 2),
(503, 'Detail Transaksi 09032020126T0006 berhasil ditambahkan', '2020-03-09 08:36:13', 2),
(504, 'Transaksi 09032020126T0006 berhasil diubah', '2020-03-09 08:36:23', 2),
(505, 'Pembayaran Transaksi 09032020126T0006 berhasil', '2020-03-09 08:36:26', 2),
(506, 'Cetak Invoice - 09032020126T0006 - Arum Diah Ariyanti', '2020-03-09 08:36:29', 2),
(507, 'Detail Transaksi 09032020126T0006 berhasil ditambahkan', '2020-03-09 10:46:30', 2),
(508, 'Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 11:32:20', 2),
(509, 'Detail Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 11:32:26', 2),
(510, 'Pembayaran Transaksi 09032020126T0001 berhasil', '2020-03-09 11:33:04', 2),
(511, 'Cetak Invoice - 09032020126T0001 - Arum Diah Ariyanti', '2020-03-09 11:33:13', 2),
(512, 'Cetak Invoice - 09032020126T0001 - Arum Diah Ariyanti', '2020-03-09 11:34:09', 2),
(513, 'Cetak Invoice - 09032020126T0001 - Arum Diah Ariyanti', '2020-03-09 11:34:48', 2),
(514, 'Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 11:35:33', 2),
(515, 'Detail Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 11:35:40', 2),
(516, 'Pembayaran Transaksi 09032020123T0002 berhasil', '2020-03-09 11:35:59', 2),
(517, 'Cetak Invoice - 09032020123T0002 - Bintang Shakila Akassah', '2020-03-09 11:36:03', 2),
(518, 'Transaksi 09032020122T0003 berhasil ditambahkan', '2020-03-09 11:36:42', 2),
(519, 'Detail Transaksi 09032020122T0003 berhasil ditambahkan', '2020-03-09 11:36:49', 2),
(520, 'Pembayaran Transaksi 09032020122T0003 berhasil', '2020-03-09 11:37:07', 2),
(521, 'Cetak Invoice - 09032020122T0003 - Muhammad Fikri', '2020-03-09 11:37:11', 2),
(522, 'Transaksi 09032020125T0004 berhasil ditambahkan', '2020-03-09 11:37:37', 2),
(523, 'Detail Transaksi 09032020125T0004 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 11:37:42', 2),
(524, 'Detail Transaksi 09032020125T0004 berhasil ditambahkan', '2020-03-09 11:37:49', 2),
(525, 'Transaksi 09032020125T0004 berhasil diubah', '2020-03-09 11:38:24', 2),
(526, 'Pembayaran Transaksi 09032020125T0004 berhasil', '2020-03-09 11:38:29', 2),
(527, 'Cetak Invoice - 09032020125T0004 - Yos Hermawan', '2020-03-09 11:38:32', 2),
(528, 'Transaksi 09032020123T0005 berhasil ditambahkan', '2020-03-09 11:38:46', 2),
(529, 'Detail Transaksi 09032020123T0005 berhasil ditambahkan', '2020-03-09 11:39:13', 2),
(530, 'Cetak Invoice - 09032020123T0005 - Bintang Shakila Akassah', '2020-03-09 11:39:22', 2),
(531, 'Pengguna andre975 berhasil logout', '2020-03-09 12:42:29', 2),
(532, 'Pengguna andre975 berhasil login', '2020-03-09 12:42:42', 2),
(533, 'Transaksi 09032020123T0006 berhasil ditambahkan', '2020-03-09 13:01:52', 2),
(534, 'Detail Transaksi 09032020123T0006 berhasil ditambahkan', '2020-03-09 13:03:42', 2),
(535, 'Pembayaran Transaksi 09032020123T0006 berhasil', '2020-03-09 13:03:49', 2),
(536, 'Cetak Invoice - 09032020123T0006 - Bintang Shakila Akassah', '2020-03-09 13:03:56', 2),
(537, 'Transaksi 09032020125T0007 berhasil ditambahkan', '2020-03-09 13:44:39', 2),
(538, 'Pengguna andre975 berhasil logout', '2020-03-09 13:52:03', 2),
(539, 'Pengguna andre975 berhasil login', '2020-03-09 13:52:11', 2),
(540, 'Transaksi 09032020125T0008 berhasil ditambahkan', '2020-03-09 14:03:56', 2),
(541, 'Detail Transaksi 09032020125T0008 berhasil ditambahkan', '2020-03-09 14:06:30', 2),
(542, 'Pembayaran Transaksi 09032020125T0008 berhasil', '2020-03-09 14:06:42', 2),
(543, 'Cetak Invoice - 09032020125T0008 - Yos Hermawan', '2020-03-09 14:06:46', 2),
(544, 'Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:07:31', 2),
(545, 'Detail Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:07:38', 2),
(546, 'Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:08:19', 2),
(547, 'Detail Transaksi 09032020126T0001 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:08:22', 2),
(548, 'Detail Transaksi 09032020126T0001 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:09:10', 2),
(549, 'Detail Transaksi 09032020126T0001 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:09:26', 2),
(550, 'Detail Transaksi 09032020126T0001 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:09:36', 2),
(551, 'Transaksi 09032020126T0001 berhasil dihapus', '2020-03-09 14:09:45', 2),
(552, 'Pengguna andre975 berhasil logout', '2020-03-09 14:11:59', 2),
(553, 'Pengguna andre975 berhasil login', '2020-03-09 14:12:06', 2),
(554, 'Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:12:45', 2),
(555, 'Detail Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:14:38', 2),
(556, 'Pembayaran Transaksi 09032020126T0001 berhasil', '2020-03-09 14:14:47', 2),
(557, 'Cetak Invoice - 09032020126T0001 - Arum Diah Ariyanti', '2020-03-09 14:14:49', 2),
(558, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 14:14:58', 2),
(559, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 14:15:01', 2),
(560, 'Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 14:15:13', 2),
(561, 'Detail Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 14:15:18', 2),
(562, 'Transaksi 09032020124T0003 berhasil ditambahkan', '2020-03-09 14:16:03', 2),
(563, 'Detail Transaksi 09032020124T0003 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:16:07', 2),
(564, 'Detail Transaksi 09032020124T0003 berhasil ditambahkan', '2020-03-09 14:16:12', 2),
(565, 'Cetak Invoice - 09032020126T0001 - Arum Diah Ariyanti', '2020-03-09 14:25:14', 2),
(566, 'Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:25:59', 2),
(567, 'Detail Transaksi 09032020126T0001 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:26:02', 2),
(568, 'Detail Transaksi 09032020126T0001 berhasil ditambahkan', '2020-03-09 14:26:09', 2),
(569, 'Pembayaran Transaksi 09032020126T0001 berhasil', '2020-03-09 14:26:14', 2),
(570, 'Cetak Invoice - 09032020126T0001 - Arum Diah Ariyanti', '2020-03-09 14:26:17', 2),
(571, 'Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 14:26:38', 2),
(572, 'Detail Transaksi 09032020123T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:26:41', 2),
(573, 'Transaksi 09032020123T0002 berhasil dihapus', '2020-03-09 14:26:46', 2),
(574, 'Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 14:26:52', 2),
(575, 'Detail Transaksi 09032020123T0002 berhasil ditambahkan', '2020-03-09 14:27:00', 2),
(576, 'Transaksi 09032020122T0003 berhasil ditambahkan', '2020-03-09 14:34:13', 2),
(577, 'Detail Transaksi 09032020122T0003 berhasil ditambahkan', '2020-03-09 14:34:18', 2),
(578, 'Pembayaran Transaksi 09032020122T0003 berhasil', '2020-03-09 14:34:29', 2),
(579, 'Cetak Invoice - 09032020122T0003 - Muhammad Fikri', '2020-03-09 14:34:31', 2),
(580, 'Transaksi 09032020123T0002 berhasil diubah', '2020-03-09 14:34:47', 2),
(581, 'Pembayaran Transaksi 09032020123T0002 berhasil', '2020-03-09 14:34:50', 2),
(582, 'Cetak Invoice - 09032020123T0002 - Bintang Shakila Akassah', '2020-03-09 14:34:53', 2),
(583, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 14:35:02', 2),
(584, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 14:35:06', 2),
(585, 'Cetak Invoice - 09032020123T0002 - Bintang Shakila Akassah', '2020-03-09 14:36:01', 2),
(586, 'Transaksi 09032020126T0004 berhasil ditambahkan', '2020-03-09 14:36:32', 2),
(587, 'Detail Transaksi 09032020126T0004 berhasil ditambahkan', '2020-03-09 14:36:39', 2),
(588, 'Pembayaran Transaksi 09032020126T0004 berhasil', '2020-03-09 14:36:42', 2),
(589, 'Cetak Invoice - 09032020126T0004 - Arum Diah Ariyanti', '2020-03-09 14:36:44', 2),
(590, 'Transaksi 09032020125T0005 berhasil ditambahkan', '2020-03-09 14:37:10', 2),
(591, 'Detail Transaksi 09032020125T0005 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:37:12', 2),
(592, 'Transaksi 09032020125T0005 berhasil dihapus', '2020-03-09 14:37:15', 2),
(593, 'Transaksi 09032020121T0005 berhasil ditambahkan', '2020-03-09 14:37:54', 2),
(594, 'Detail Transaksi 09032020121T0005 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 14:38:05', 2),
(595, 'Detail Transaksi 09032020121T0005 berhasil ditambahkan', '2020-03-09 14:38:37', 2);
INSERT INTO `log` (`id_log`, `isi_log`, `tanggal_log`, `id_user`) VALUES
(596, 'Transaksi 09032020123T0006 berhasil ditambahkan', '2020-03-09 14:38:47', 2),
(597, 'Detail Transaksi 09032020123T0006 berhasil ditambahkan', '2020-03-09 14:38:56', 2),
(598, 'Transaksi 09032020122T0007 berhasil ditambahkan', '2020-03-09 14:51:02', 2),
(599, 'Detail Transaksi 09032020122T0007 berhasil ditambahkan', '2020-03-09 14:51:20', 2),
(600, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 16:11:48', 2),
(601, 'Transaksi 09032020124T0008 berhasil ditambahkan', '2020-03-09 16:14:10', 2),
(602, 'Detail Transaksi 09032020124T0008 gagal ditambahkan! isi minimal 1 paket', '2020-03-09 16:14:13', 2),
(603, 'Detail Transaksi 09032020124T0008 berhasil ditambahkan', '2020-03-09 16:14:21', 2),
(604, 'Pembayaran Transaksi 09032020124T0008 berhasil', '2020-03-09 16:14:25', 2),
(605, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:14:28', 2),
(606, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:15:53', 2),
(607, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:16:28', 2),
(608, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:16:54', 2),
(609, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:18:24', 2),
(610, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:18:36', 2),
(611, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:19:10', 2),
(612, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:20:10', 2),
(613, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:20:22', 2),
(614, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:21:01', 2),
(615, 'Cetak Invoice - 09032020124T0008 - Namira Nindya Fitri', '2020-03-09 16:21:14', 2),
(616, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 16:22:02', 2),
(617, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 16:22:05', 2),
(618, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 16:22:09', 2),
(619, 'Pembayaran Transaksi 09032020122T0007 berhasil', '2020-03-09 16:22:24', 2),
(620, 'Cetak Invoice - 09032020122T0007 - Muhammad Fikri', '2020-03-09 16:22:27', 2),
(621, 'Cetak Invoice - 09032020122T0007 - Muhammad Fikri', '2020-03-09 16:25:10', 2),
(622, 'Pengguna andre975 berhasil logout', '2020-03-09 17:47:31', 2),
(623, 'Pengguna super_administrator berhasil login', '2020-03-09 17:47:38', 1),
(624, 'Pengguna super_administrator berhasil logout', '2020-03-09 17:47:46', 1),
(625, 'Pengguna rian43 berhasil login', '2020-03-09 17:47:59', 6),
(626, 'Member Jasmine Aulia Syahrami berhasil ditambahkan', '2020-03-09 17:49:36', 6),
(627, 'Member Febby Anggraeni berhasil ditambahkan', '2020-03-09 17:50:42', 6),
(628, 'Member Edwan Syawal berhasil ditambahkan', '2020-03-09 17:51:58', 6),
(629, 'Member Tyo Hafiad Noerman berhasil ditambahkan', '2020-03-09 17:52:53', 6),
(630, 'Member Roro Dana Iswara Aditya Bakti berhasil ditambahkan', '2020-03-09 17:55:11', 6),
(631, 'Transaksi 09032020268T0009 berhasil ditambahkan', '2020-03-09 17:55:33', 6),
(632, 'Detail Transaksi 09032020268T0009 berhasil ditambahkan', '2020-03-09 17:55:39', 6),
(633, 'Transaksi 090320202611T0010 berhasil ditambahkan', '2020-03-09 17:56:11', 6),
(634, 'Detail Transaksi 090320202611T0010 berhasil ditambahkan', '2020-03-09 17:56:26', 6),
(635, 'Pembayaran Transaksi 090320202611T0010 berhasil', '2020-03-09 17:56:32', 6),
(636, 'Cetak Invoice - 090320202611T0010 - Roro Dana Iswara Aditya Bakti', '2020-03-09 17:56:36', 6),
(637, 'Cetak Invoice - 090320202611T0010 - Roro Dana Iswara Aditya Bakti', '2020-03-09 17:56:46', 6),
(638, 'Print profile', '2020-03-09 17:57:15', 6),
(639, 'Print profile', '2020-03-09 17:57:20', 6),
(640, 'Print profile', '2020-03-09 17:57:24', 6),
(641, 'Print profile', '2020-03-09 17:57:28', 6),
(642, 'Biodata Pengguna rian43 berhasil diubah', '2020-03-09 17:57:44', 6),
(643, 'Biodata Pengguna rian43 berhasil diubah', '2020-03-09 17:57:56', 6),
(644, 'Biodata Pengguna rian43 berhasil diubah', '2020-03-09 17:58:04', 6),
(645, 'Print profile', '2020-03-09 17:58:10', 6),
(646, 'Biodata Pengguna rian43 berhasil diubah', '2020-03-09 17:59:31', 6),
(647, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 17:59:57', 6),
(648, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 18:00:00', 6),
(649, 'Pengguna rian43 berhasil logout', '2020-03-09 18:00:33', 6),
(650, 'Pengguna super_administrator berhasil login', '2020-03-09 18:00:41', 1),
(651, 'Member Shelina berhasil ditambahkan', '2020-03-09 18:01:52', 1),
(652, 'Transaksi 090320201112T0011 berhasil ditambahkan', '2020-03-09 18:07:48', 1),
(653, 'Pengguna super_administrator berhasil logout', '2020-03-09 18:08:04', 1),
(654, 'Pengguna super_administrator berhasil login', '2020-03-09 18:08:56', 1),
(655, 'Transaksi 090320201112T0011 berhasil dihapus', '2020-03-09 18:09:29', 1),
(656, 'Transaksi 090320201112T0011 berhasil ditambahkan', '2020-03-09 18:11:05', 1),
(657, 'Detail Transaksi 090320201112T0011 berhasil ditambahkan', '2020-03-09 18:13:03', 1),
(658, 'Pembayaran Transaksi 090320201112T0011 berhasil', '2020-03-09 18:13:10', 1),
(659, 'Cetak Invoice - 090320201112T0011 - Shelina', '2020-03-09 18:13:12', 1),
(660, 'Transaksi 09032020114T0012 berhasil ditambahkan', '2020-03-09 18:14:23', 1),
(661, 'Detail Transaksi 09032020114T0012 berhasil ditambahkan', '2020-03-09 18:14:30', 1),
(662, 'Pembayaran Transaksi 09032020114T0012 berhasil', '2020-03-09 18:14:34', 1),
(663, 'Cetak Invoice - 09032020114T0012 - Namira Nindya Fitri', '2020-03-09 18:14:36', 1),
(664, 'Pembayaran Transaksi 09032020268T0009 berhasil', '2020-03-09 18:14:58', 1),
(665, 'Cetak Invoice - 09032020268T0009 - Febby Anggraeni', '2020-03-09 18:15:00', 1),
(666, 'Transaksi  berhasil diubah status transaksinya', '2020-03-09 18:15:12', 1),
(667, 'Paket Kiloan Raja Laut berhasil ditambahkan', '2020-03-09 18:16:03', 1),
(668, 'Pengguna super_administrator berhasil logout', '2020-03-09 18:20:26', 1),
(669, 'Pengguna rian43 berhasil login', '2020-03-09 18:20:33', 6),
(670, 'Pengguna rian43 berhasil logout', '2020-03-09 18:21:01', 6),
(671, 'Pengguna andre975 berhasil login', '2020-03-09 18:21:07', 2),
(672, 'Pengguna andre975 berhasil logout', '2020-03-09 18:21:28', 2),
(673, 'Pengguna super_administrator berhasil login', '2020-03-09 18:21:35', 1),
(674, 'Pengguna gita32 berhasil ditambahkan', '2020-03-09 18:22:21', 1),
(675, 'Biodata Pengguna GITA AGUSTIN berhasil ditambahkan', '2020-03-09 18:23:28', 1),
(676, 'Pengguna super_administrator berhasil logout', '2020-03-09 18:23:44', 1),
(677, 'Pengguna gita32 berhasil login', '2020-03-09 18:23:48', 8),
(678, 'Pengguna gita32 berhasil logout', '2020-03-09 18:28:35', 8),
(679, 'Pengguna super_administrator berhasil login', '2020-03-09 18:28:59', 1),
(680, 'Transaksi 09032020119T0013 berhasil ditambahkan', '2020-03-09 18:31:42', 1),
(681, 'Detail Transaksi 09032020119T0013 berhasil ditambahkan', '2020-03-09 18:32:07', 1),
(682, 'Pembayaran Transaksi 09032020119T0013 berhasil', '2020-03-09 18:32:11', 1),
(683, 'Cetak Invoice - 09032020119T0013 - Edwan Syawal', '2020-03-09 18:32:14', 1),
(684, 'Transaksi 09032020117T0014 berhasil ditambahkan', '2020-03-09 18:32:33', 1),
(685, 'Detail Transaksi 09032020117T0014 berhasil ditambahkan', '2020-03-09 18:32:39', 1),
(686, 'Transaksi 09032020117T0014 berhasil diubah', '2020-03-09 18:33:19', 1),
(687, 'Pembayaran Transaksi 09032020117T0014 berhasil', '2020-03-09 18:33:23', 1),
(688, 'Cetak Invoice - 09032020117T0014 - Jasmine Aulia Syahrami', '2020-03-09 18:33:25', 1),
(689, 'Cetak Invoice - 09032020117T0014 - Jasmine Aulia Syahrami', '2020-03-09 18:33:39', 1),
(690, 'Pengguna super_administrator berhasil logout', '2020-03-09 18:34:58', 1),
(691, 'Pengguna andre975 berhasil login', '2020-03-10 08:47:58', 2),
(692, 'Transaksi 09032020117T0014 berhasil diubah', '2020-03-10 08:49:53', 2),
(693, 'Transaksi 09032020117T0014 berhasil diubah', '2020-03-10 08:50:03', 2),
(694, 'Member Muhammad Irgi Al Ghitraf berhasil ditambahkan', '2020-03-10 08:55:20', 2),
(695, 'Transaksi 100320201213T0001 berhasil ditambahkan', '2020-03-10 08:56:12', 2),
(696, 'Detail Transaksi 100320201213T0001 berhasil ditambahkan', '2020-03-10 08:56:44', 2),
(697, 'Transaksi  berhasil diubah status transaksinya', '2020-03-10 09:01:22', 2),
(698, 'Pembayaran Transaksi 100320201213T0001 gagal! uang yang dibayar kurang dari total harga', '2020-03-10 09:01:35', 2),
(699, 'Pembayaran Transaksi 100320201213T0001 gagal! uang yang dibayar kurang dari total harga', '2020-03-10 09:02:37', 2),
(700, 'Pembayaran Transaksi 100320201213T0001 gagal! uang yang dibayar kurang dari total harga', '2020-03-10 09:02:42', 2),
(701, 'Pembayaran Transaksi 100320201213T0001 berhasil', '2020-03-10 09:02:49', 2),
(702, 'Cetak Invoice - 100320201213T0001 - Muhammad Irgi Al Ghitraf', '2020-03-10 09:02:52', 2),
(703, 'Transaksi 10032020127T0002 berhasil ditambahkan', '2020-03-10 09:03:06', 2),
(704, 'Detail Transaksi 10032020127T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-10 09:03:11', 2),
(705, 'Transaksi 10032020127T0002 berhasil dihapus', '2020-03-10 09:03:17', 2),
(706, 'Pengguna andre975 berhasil login', '2020-03-10 12:50:38', 2),
(707, 'Pengguna andre975 berhasil login', '2020-03-10 19:21:25', 2),
(708, 'Pembayaran Transaksi 09032020123T0006 berhasil', '2020-03-10 19:55:33', 2),
(709, 'Cetak Invoice - 09032020123T0006 - Bintang Shakila Akassah', '2020-03-10 19:55:39', 2),
(710, 'Pengguna andre975 berhasil logout', '2020-03-10 19:57:03', 2),
(711, 'Pengguna super_administrator berhasil login', '2020-03-10 19:57:10', 1),
(712, 'Pengguna super_administrator berhasil logout', '2020-03-10 19:59:12', 1),
(713, 'Pengguna febyfeb09 berhasil login', '2020-03-10 19:59:16', 7),
(714, 'Print profile', '2020-03-10 21:15:39', 7),
(715, 'Pengguna febyfeb09 berhasil logout', '2020-03-10 21:16:32', 7),
(716, 'Pengguna febyfeb09 berhasil logout', '2020-03-10 21:16:32', 7),
(717, 'Pengguna andre975 berhasil login', '2020-03-10 21:37:18', 2),
(718, 'Pengguna andre975 berhasil login', '2020-03-11 10:16:02', 2),
(719, 'Transaksi 11032020127T0001 berhasil ditambahkan', '2020-03-11 10:16:28', 2),
(720, 'Detail Transaksi 11032020127T0001 berhasil ditambahkan', '2020-03-11 10:17:42', 2),
(721, 'Transaksi 11032020123T0002 berhasil ditambahkan', '2020-03-11 10:24:53', 2),
(722, 'Pengguna andre975 berhasil logout', '2020-03-11 10:25:00', 2),
(723, 'Pengguna andre975 berhasil login', '2020-03-11 10:25:07', 2),
(724, 'Transaksi 11032020125T0003 berhasil ditambahkan', '2020-03-11 10:29:22', 2),
(725, 'Pengguna andre975 berhasil logout', '2020-03-11 10:29:39', 2),
(726, 'Pengguna andre975 berhasil login', '2020-03-11 10:29:43', 2),
(727, 'Pengguna andre975 berhasil logout', '2020-03-11 10:34:30', 2),
(728, 'Pengguna andre975 berhasil login', '2020-03-11 10:34:36', 2),
(729, 'Pengguna andre975 berhasil logout', '2020-03-11 10:35:10', 2),
(730, 'Pengguna andre975 berhasil login', '2020-03-11 10:35:15', 2),
(731, 'Transaksi 11032020125T0003 berhasil dihapus', '2020-03-11 10:35:31', 2),
(732, 'Transaksi 11032020123T0002 berhasil dihapus', '2020-03-11 10:35:46', 2),
(733, 'Detail Transaksi 11032020127T0001 gagal ditambahkan! isi minimal 1 paket', '2020-03-11 10:38:10', 2),
(734, 'Transaksi 11032020127T0002 berhasil ditambahkan', '2020-03-11 10:59:07', 2),
(735, 'Detail Transaksi 11032020127T0002 berhasil ditambahkan', '2020-03-11 10:59:21', 2),
(736, 'Pengguna andre975 berhasil logout', '2020-03-11 10:59:37', 2),
(737, 'Pengguna andre975 berhasil login', '2020-03-11 10:59:44', 2),
(738, 'Member Rayhan Aditya Syahputra berhasil ditambahkan', '2020-03-11 11:01:25', 2),
(739, 'Transaksi 110320201214T0003 berhasil ditambahkan', '2020-03-11 11:01:50', 2),
(740, 'Detail Transaksi 110320201214T0003 berhasil ditambahkan', '2020-03-11 11:02:13', 2),
(741, 'Pengguna andre975 berhasil logout', '2020-03-11 11:07:26', 2),
(742, 'Pengguna rian43 berhasil login', '2020-03-11 11:07:39', 6),
(743, 'Transaksi 11032020261T0004 berhasil ditambahkan', '2020-03-11 11:09:07', 6),
(744, 'Detail Transaksi 11032020261T0004 berhasil ditambahkan', '2020-03-11 11:10:28', 6),
(745, 'Detail Transaksi  gagal ditambahkan! isi minimal 1 paket', '2020-03-11 11:23:13', 6),
(746, 'Detail Transaksi 11032020261T0004 gagal ditambahkan! isi minimal 1 paket', '2020-03-11 11:33:54', 6),
(747, 'Detail Transaksi 11032020261T0004 gagal ditambahkan! isi minimal 1 paket', '2020-03-11 11:36:50', 6),
(748, 'Detail Transaksi 11032020261T0004 berhasil dimanipulasi', '2020-03-11 11:38:03', 6),
(749, 'Detail Transaksi 11032020261T0004 berhasil dimanipulasi', '2020-03-11 11:38:26', 6),
(750, 'Detail Transaksi 11032020261T0004 berhasil dimanipulasi', '2020-03-11 11:38:51', 6),
(751, 'Pengguna rian43 berhasil logout', '2020-03-11 11:39:50', 6),
(752, 'Pengguna indah76 berhasil login', '2020-03-11 11:40:03', 5),
(753, 'Transaksi 11032020261T0004 berhasil dihapus', '2020-03-11 11:40:17', 5),
(754, 'Pengguna indah76 berhasil logout', '2020-03-11 12:47:56', 5),
(755, 'Pengguna andre975 berhasil login', '2020-03-11 12:48:18', 2),
(756, 'Detail Transaksi 110320201214T0003 berhasil dimanipulasi', '2020-03-11 12:57:22', 2),
(757, 'Detail Transaksi 110320201214T0003 berhasil dimanipulasi', '2020-03-11 13:03:47', 2),
(758, 'Detail Transaksi 110320201214T0003 berhasil dimanipulasi', '2020-03-11 13:04:01', 2),
(759, 'Detail Transaksi 110320201214T0003 berhasil dimanipulasi', '2020-03-11 13:05:14', 2),
(760, 'Detail Transaksi 110320201214T0003 berhasil dimanipulasi', '2020-03-11 13:05:37', 2),
(761, 'Pengguna andre975 berhasil logout', '2020-03-11 13:08:28', 2),
(762, 'Pengguna andre975 berhasil login', '2020-03-11 13:08:52', 2),
(763, 'Pengguna andre975 berhasil logout', '2020-03-11 13:09:28', 2),
(764, 'Pengguna salsa321 berhasil login', '2020-03-11 13:09:33', 4),
(765, 'Pengguna salsa321 berhasil logout', '2020-03-11 13:25:10', 4),
(766, 'Pengguna andre975 berhasil login', '2020-03-11 13:25:14', 2),
(767, 'Transaksi 11032020123T0004 berhasil ditambahkan', '2020-03-11 13:25:25', 2),
(768, 'Detail Transaksi 11032020123T0004 berhasil ditambahkan', '2020-03-11 13:25:31', 2),
(769, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:32:51', 2),
(770, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:33:38', 2),
(771, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:34:22', 2),
(772, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:34:34', 2),
(773, 'Transaksi 11032020123T0005 berhasil ditambahkan', '2020-03-11 13:39:53', 2),
(774, 'Detail Transaksi 11032020123T0005 berhasil ditambahkan', '2020-03-11 13:41:15', 2),
(775, 'Pembayaran Transaksi 11032020123T0005 berhasil', '2020-03-11 13:41:23', 2),
(776, 'Cetak Invoice - 11032020123T0005 - Bintang Shakila Akassah', '2020-03-11 13:41:38', 2),
(777, 'Pembayaran Transaksi 11032020123T0004 berhasil', '2020-03-11 13:45:31', 2),
(778, 'Cetak Invoice - 11032020123T0004 - Bintang Shakila Akassah', '2020-03-11 13:45:34', 2),
(779, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:45:40', 2),
(780, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:45:45', 2),
(781, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:45:54', 2),
(782, 'Transaksi 110320201214T0003 berhasil dihapus', '2020-03-11 13:48:42', 2),
(783, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:49:19', 2),
(784, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:49:22', 2),
(785, 'Pembayaran Transaksi 11032020127T0002 berhasil', '2020-03-11 13:49:54', 2),
(786, 'Cetak Invoice - 11032020127T0002 - Jasmine Aulia Syahrami', '2020-03-11 13:49:57', 2),
(787, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:50:13', 2),
(788, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:50:27', 2),
(789, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:50:33', 2),
(790, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:52:14', 2),
(791, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:52:18', 2),
(792, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:52:23', 2),
(793, 'Cetak Invoice - 11032020123T0005 - Bintang Shakila Akassah', '2020-03-11 13:52:27', 2),
(794, 'Transaksi 110320201211T0006 berhasil ditambahkan', '2020-03-11 13:53:17', 2),
(795, 'Pengguna andre975 berhasil logout', '2020-03-11 13:53:28', 2),
(796, 'Pengguna andre975 berhasil login', '2020-03-11 13:53:35', 2),
(797, 'Detail Transaksi 110320201211T0006 berhasil ditambahkan', '2020-03-11 13:54:00', 2),
(798, 'Detail Transaksi 110320201211T0006 berhasil dimanipulasi', '2020-03-11 13:54:37', 2),
(799, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:57:28', 2),
(800, 'Transaksi  berhasil diubah status transaksinya', '2020-03-11 13:57:35', 2),
(801, 'Pengguna andre975 berhasil login', '2020-03-11 14:00:42', 2),
(802, 'Pengguna andre975 berhasil login', '2020-03-11 16:34:43', 2),
(803, 'Pengguna andre975 berhasil logout', '2020-03-11 16:35:07', 2),
(804, 'Pengguna rian43 berhasil login', '2020-03-11 16:35:12', 6),
(805, 'Pengguna rian43 berhasil logout', '2020-03-11 16:35:35', 6),
(806, 'Pengguna andre975 berhasil login', '2020-03-11 16:35:43', 2),
(807, 'Pengguna andre975 berhasil logout', '2020-03-11 16:53:52', 2),
(808, 'Pengguna rian43 berhasil login', '2020-03-11 16:53:59', 6),
(809, 'Pengguna rian43 berhasil logout', '2020-03-11 17:08:14', 6),
(810, 'Pengguna andre975 berhasil login', '2020-03-11 17:08:19', 2),
(811, 'Pengguna andre975 berhasil logout', '2020-03-11 17:09:58', 2),
(812, 'Pengguna rian43 berhasil login', '2020-03-11 17:10:03', 6),
(813, 'Transaksi 11032020263T0007 berhasil ditambahkan', '2020-03-11 17:10:46', 6),
(814, 'Detail Transaksi 11032020263T0007 berhasil ditambahkan', '2020-03-11 17:10:53', 6),
(815, 'Pembayaran Transaksi 11032020263T0007 berhasil', '2020-03-11 17:10:59', 6),
(816, 'Cetak Invoice - 11032020263T0007 - Bintang Shakila Akassah', '2020-03-11 17:11:03', 6),
(817, 'Pengguna rian43 berhasil logout', '2020-03-11 17:11:14', 6),
(818, 'Pengguna andre975 berhasil login', '2020-03-11 17:11:18', 2),
(819, 'Pengguna andre975 berhasil logout', '2020-03-11 17:16:38', 2),
(820, 'Pengguna rian43 berhasil login', '2020-03-11 17:16:43', 6),
(821, 'Pengguna rian43 berhasil logout', '2020-03-11 17:55:04', 6),
(822, 'Pengguna super_administrator berhasil login', '2020-03-11 17:55:10', 1),
(823, 'Pengguna super_administrator berhasil logout', '2020-03-11 17:56:26', 1),
(824, 'Pengguna andre975 berhasil login', '2020-03-11 17:56:31', 2),
(825, 'Pengguna andre975 berhasil logout', '2020-03-11 17:56:47', 2),
(826, 'Pengguna super_administrator berhasil login', '2020-03-11 17:56:54', 1),
(827, 'Pengguna andre975 berhasil login', '2020-03-12 08:17:13', 2),
(828, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 08:17:33', 2),
(829, 'Member Himdan Al Ghozan berhasil ditambahkan', '2020-03-12 08:32:02', 2),
(830, 'Transaksi 120320201215T0001 berhasil ditambahkan', '2020-03-12 08:43:13', 2),
(831, 'Pengguna andre975 berhasil logout', '2020-03-12 08:43:54', 2),
(832, 'Pengguna andre975 berhasil login', '2020-03-12 08:44:07', 2),
(833, 'Transaksi 120320201215T0001 berhasil dihapus', '2020-03-12 08:44:37', 2),
(834, 'Transaksi 120320201215T0001 berhasil ditambahkan', '2020-03-12 08:52:43', 2),
(835, 'Detail Transaksi 120320201215T0001 berhasil ditambahkan', '2020-03-12 08:53:00', 2),
(836, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 08:53:30', 2),
(837, 'Member Muhammad Faisal Achramsyah berhasil ditambahkan', '2020-03-12 09:03:59', 2),
(838, 'Transaksi 120320201216T0002 berhasil ditambahkan', '2020-03-12 09:04:42', 2),
(839, 'Detail Transaksi 120320201216T0002 berhasil ditambahkan', '2020-03-12 09:05:05', 2),
(840, 'Pembayaran Transaksi 120320201216T0002 gagal! uang yang dibayar kurang dari total harga', '2020-03-12 09:05:22', 2),
(841, 'Pembayaran Transaksi 120320201216T0002 berhasil', '2020-03-12 09:06:42', 2),
(842, 'Cetak Invoice - 120320201216T0002 - Muhammad Faisal Achramsyah', '2020-03-12 09:06:50', 2),
(843, 'Transaksi 120320201215T0001 berhasil diubah', '2020-03-12 09:07:53', 2),
(844, 'Detail Transaksi 120320201215T0001 berhasil dimanipulasi', '2020-03-12 09:08:31', 2),
(845, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 09:10:50', 2),
(846, 'Pengguna andre975 berhasil login', '2020-03-12 11:21:22', 2),
(847, 'Pengguna andre975 berhasil logout', '2020-03-12 11:35:27', 2),
(848, 'Pengguna super_administrator berhasil login', '2020-03-12 11:35:33', 1),
(849, 'Pengguna super_administrator berhasil logout', '2020-03-12 11:36:06', 1),
(850, 'Pengguna indah76 berhasil login', '2020-03-12 11:36:11', 5),
(851, 'Transaksi 12032020253T0003 berhasil ditambahkan', '2020-03-12 11:36:45', 5),
(852, 'Detail Transaksi 12032020253T0003 berhasil ditambahkan', '2020-03-12 11:37:26', 5),
(853, 'Detail Transaksi 12032020253T0003 berhasil dimanipulasi', '2020-03-12 11:37:51', 5),
(854, 'Detail Transaksi 12032020253T0003 gagal ditambahkan! isi minimal 1 paket', '2020-03-12 11:38:04', 5),
(855, 'Transaksi 120320202513T0004 berhasil ditambahkan', '2020-03-12 11:38:39', 5),
(856, 'Detail Transaksi 120320202513T0004 berhasil ditambahkan', '2020-03-12 11:38:53', 5),
(857, 'Pembayaran Transaksi 120320202513T0004 gagal! uang yang dibayar kurang dari total harga', '2020-03-12 11:39:03', 5),
(858, 'Pembayaran Transaksi 120320202513T0004 berhasil', '2020-03-12 11:39:13', 5),
(859, 'Cetak Invoice - 120320202513T0004 - Muhammad Irgi Al Ghitraf', '2020-03-12 11:39:18', 5),
(860, 'Cetak Invoice - 120320202513T0004 - Muhammad Irgi Al Ghitraf', '2020-03-12 11:39:43', 5),
(861, 'Detail Transaksi 12032020253T0003 berhasil dimanipulasi', '2020-03-12 11:40:49', 5),
(862, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:41:13', 5),
(863, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:49:44', 5),
(864, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:49:49', 5),
(865, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:49:52', 5),
(866, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:49:57', 5),
(867, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:50:00', 5),
(868, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 11:50:03', 5),
(869, 'Transaksi 120320202515T0005 berhasil ditambahkan', '2020-03-12 13:09:33', 5),
(870, 'Detail Transaksi 120320202515T0005 berhasil ditambahkan', '2020-03-12 13:10:26', 5),
(871, 'Pengguna indah76 berhasil logout', '2020-03-12 13:13:01', 5),
(872, 'Pengguna andre975 berhasil login', '2020-03-12 21:44:23', 2),
(873, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 21:49:42', 2),
(874, 'Pengguna andre975 berhasil logout', '2020-03-12 21:49:54', 2),
(875, 'Pengguna super_administrator berhasil login', '2020-03-12 21:50:03', 1),
(876, 'Transaksi  berhasil diubah status transaksinya', '2020-03-12 21:50:15', 1),
(877, 'Pengguna andre975 berhasil login', '2020-03-13 08:26:29', 2),
(878, 'Transaksi 130320201213T0001 berhasil ditambahkan', '2020-03-13 08:46:20', 2),
(879, 'Detail Transaksi 130320201213T0001 berhasil ditambahkan', '2020-03-13 08:46:33', 2),
(880, 'Pembayaran Transaksi 130320201213T0001 berhasil', '2020-03-13 08:46:39', 2),
(881, 'Cetak Invoice - 130320201213T0001 - Muhammad Irgi Al Ghitraf', '2020-03-13 08:46:42', 2),
(882, 'Transaksi  berhasil diubah status transaksinya', '2020-03-13 08:47:20', 2),
(883, 'Transaksi  berhasil diubah status transaksinya', '2020-03-13 08:47:24', 2),
(884, 'Transaksi  berhasil diubah status transaksinya', '2020-03-13 08:48:45', 2),
(885, 'Pengguna andre975 berhasil login', '2020-03-13 08:51:03', 2),
(886, 'Pengguna salsa321 berhasil login', '2020-03-14 11:17:36', 4),
(887, 'Pengguna salsa321 berhasil logout', '2020-03-14 12:09:14', 4),
(888, 'Pengguna indah76 berhasil login', '2020-03-14 12:09:27', 5),
(889, 'Transaksi 14032020253T0001 berhasil ditambahkan', '2020-03-14 12:09:50', 5),
(890, 'Detail Transaksi 14032020253T0001 berhasil ditambahkan', '2020-03-14 12:10:23', 5),
(891, 'Pembayaran Transaksi 14032020253T0001 berhasil', '2020-03-14 12:10:31', 5),
(892, 'Cetak Invoice - 14032020253T0001 - Bintang Shakila Akassah', '2020-03-14 12:10:34', 5),
(893, 'Transaksi  berhasil diubah status transaksinya', '2020-03-14 12:11:58', 5),
(894, 'Pengguna indah76 berhasil logout', '2020-03-14 12:12:17', 5),
(895, 'Pengguna super_administrator berhasil login', '2020-03-14 12:12:42', 1),
(896, 'Pengguna super_administrator berhasil logout', '2020-03-14 12:22:46', 1),
(897, 'Pengguna andre975 berhasil login', '2020-03-14 12:22:52', 2),
(898, 'Pengguna andre975 berhasil login', '2020-03-15 13:56:44', 2),
(899, 'Pengguna andre975 berhasil logout', '2020-03-15 13:56:56', 2),
(900, 'Pengguna irgi12 berhasil login', '2020-03-15 13:56:58', 3),
(901, 'Transaksi  berhasil diubah status transaksinya', '2020-03-15 13:57:03', 3),
(902, 'Pengguna irgi12 berhasil login', '2020-03-15 14:04:35', 3),
(903, 'Pembayaran Transaksi 120320201215T0001 berhasil', '2020-03-15 14:18:01', 3),
(904, 'Cetak Invoice - 120320201215T0001 - Himdan Al Ghozan', '2020-03-15 14:18:08', 3),
(905, 'Cetak Invoice - 120320201215T0001 - Himdan Al Ghozan', '2020-03-15 14:18:41', 3),
(906, 'Cetak Invoice - 130320201213T0001 - Muhammad Irgi Al Ghitraf', '2020-03-15 14:19:06', 3),
(907, 'Pengguna andre975 berhasil login', '2020-03-15 14:39:24', 2),
(908, 'Pengguna andre975 berhasil login', '2020-03-15 14:45:59', 2),
(909, 'Pengguna andre975 berhasil login', '2020-03-15 14:59:59', 2),
(910, 'Pengguna andre975 berhasil login', '2020-03-15 15:00:36', 2),
(911, 'Cetak Invoice - 130320201213T0001 - Muhammad Irgi Al Ghitraf', '2020-03-15 15:10:31', 2),
(912, 'Cetak Invoice - 130320201213T0001 - Muhammad Irgi Al Ghitraf', '2020-03-15 15:11:15', 2),
(913, 'Cetak Laporan - 2020-03-01 - 2020-03-15', '2020-03-15 15:19:55', 2),
(914, 'Pengguna andre975 berhasil login', '2020-03-16 08:33:16', 2),
(915, 'Member Putri Larasati berhasil ditambahkan', '2020-03-16 08:40:24', 2),
(916, 'Transaksi 160320201217T0001 berhasil ditambahkan', '2020-03-16 08:40:46', 2),
(917, 'Detail Transaksi 160320201217T0001 berhasil ditambahkan', '2020-03-16 08:40:58', 2),
(918, 'Pembayaran Transaksi 160320201217T0001 berhasil', '2020-03-16 08:41:03', 2),
(919, 'Pengguna andre975 berhasil logout', '2020-03-16 09:20:26', 2),
(920, 'Pengguna super_administrator berhasil login', '2020-03-16 09:20:34', 1),
(921, 'Transaksi  berhasil diubah status transaksinya', '2020-03-16 09:23:00', 1),
(922, 'Pengguna super_administrator berhasil logout', '2020-03-16 09:23:31', 1),
(923, 'Pengguna andre975 berhasil login', '2020-03-16 09:23:36', 2),
(924, 'Pengguna andre975 berhasil login', '2020-03-16 09:25:54', 2),
(925, 'Pengguna andre975 berhasil logout', '2020-03-16 09:35:03', 2),
(926, 'Pengguna super_administrator berhasil login', '2020-03-16 09:35:10', 1),
(927, 'Transaksi 160320201217T0001 berhasil diubah', '2020-03-16 09:39:04', 1),
(928, 'Transaksi 160320201217T0001 berhasil diubah', '2020-03-16 09:39:12', 1),
(929, 'Transaksi  berhasil diubah status transaksinya', '2020-03-16 09:39:18', 1),
(930, 'Biodata Pengguna super_administrator berhasil diubah', '2020-03-16 09:40:46', 1),
(931, 'Cetak Laporan - 2020-03-01 - 2020-03-16', '2020-03-16 09:41:50', 1),
(932, 'Print profile', '2020-03-16 09:49:40', 1),
(933, 'Cetak Laporan - 2020-03-01 - 2020-03-16', '2020-03-16 09:50:13', 1),
(934, 'Cetak Laporan - 2020-03-01 - 2020-03-16', '2020-03-16 09:51:23', 1),
(935, 'Cetak Laporan - 2020-03-01 - 2020-03-16', '2020-03-16 09:52:14', 1),
(936, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:54:04', 1),
(937, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:54:24', 1),
(938, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:55:20', 1),
(939, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:55:30', 1),
(940, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:55:35', 1),
(941, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:55:39', 1),
(942, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:55:49', 1),
(943, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:56:22', 1),
(944, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:57:06', 1),
(945, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:57:38', 1),
(946, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:57:46', 1),
(947, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:57:57', 1),
(948, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:58:04', 1),
(949, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:58:33', 1),
(950, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:58:47', 1),
(951, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:58:53', 1),
(952, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:59:01', 1),
(953, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 09:59:28', 1),
(954, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:01:50', 1),
(955, 'Pengguna super_administrator berhasil logout', '2020-03-16 10:02:05', 1),
(956, 'Pengguna andre975 berhasil login', '2020-03-16 10:02:10', 2),
(957, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:02:16', 2),
(958, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:02:37', 2),
(959, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:04:35', 2),
(960, 'Cetak Laporan - 2020-03-14 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:04:48', 2),
(961, 'Cetak Laporan - 2020-03-14 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:04:51', 2),
(962, 'Cetak Laporan - 2020-03-14 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:05:08', 2),
(963, 'Cetak Laporan - 2020-03-14 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:05:42', 2),
(964, 'Cetak Laporan - 2020-03-14 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:05:52', 2),
(965, 'Cetak Laporan - 2020-03-14 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:06:03', 2),
(966, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:06:44', 2),
(967, 'Print profile', '2020-03-16 10:08:35', 2),
(968, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:08:57', 2),
(969, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:09:13', 2),
(970, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:09:18', 2),
(971, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:09:33', 2),
(972, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:09:40', 2),
(973, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:09:46', 2),
(974, 'Cetak Laporan - 2020-03-01 00:00:00 - 2020-03-16 23:59:59', '2020-03-16 10:12:11', 2),
(975, 'Transaksi  berhasil diubah status transaksinya', '2020-03-16 10:14:51', 2),
(976, 'Transaksi  berhasil diubah status transaksinya', '2020-03-16 10:14:56', 2),
(977, 'Pengguna andre975 berhasil logout', '2020-03-16 10:15:18', 2),
(978, 'Pengguna rian43 berhasil login', '2020-03-16 10:15:22', 6),
(979, 'Pengguna rian43 berhasil logout', '2020-03-16 10:15:55', 6),
(980, 'Pengguna andre975 berhasil login', '2020-03-16 10:16:02', 2),
(981, 'Member Ikbal berhasil ditambahkan', '2020-03-16 10:19:06', 2),
(982, 'Transaksi 160320201218T0002 berhasil ditambahkan', '2020-03-16 10:19:32', 2),
(983, 'Detail Transaksi 160320201218T0002 berhasil ditambahkan', '2020-03-16 10:19:43', 2),
(984, 'Detail Transaksi 160320201218T0002 berhasil dimanipulasi', '2020-03-16 10:19:56', 2),
(985, 'Pengguna andre975 berhasil logout', '2020-03-16 10:34:13', 2),
(986, 'Pengguna andre975 berhasil login', '2020-03-16 10:57:56', 2),
(987, 'Transaksi  berhasil diubah status transaksinya', '2020-03-16 10:58:27', 2),
(988, 'Transaksi  berhasil diubah status transaksinya', '2020-03-16 10:58:33', 2),
(989, 'Pengguna andre975 berhasil logout', '2020-03-16 11:00:19', 2),
(990, 'Pengguna andre975 berhasil login', '2020-03-16 11:00:28', 2),
(991, 'Pengguna andre975 berhasil login', '2020-03-16 11:00:41', 2),
(992, 'Pengguna irgi12 berhasil diubah', '2020-03-16 11:09:48', 2),
(993, 'Pengguna irgi12 berhasil diubah', '2020-03-16 11:09:53', 2),
(994, 'Pengguna andre975 berhasil logout', '2020-03-16 11:11:13', 2),
(995, 'Pengguna super_administrator berhasil login', '2020-03-16 11:11:19', 1),
(996, 'Jabatan administrator3 berhasil diubah', '2020-03-16 11:16:55', 1),
(997, 'Jabatan administrator berhasil diubah', '2020-03-16 11:17:00', 1),
(998, 'Jenis Paket kiloan2 berhasil diubah', '2020-03-16 11:19:40', 1),
(999, 'Jenis Paket kiloan berhasil diubah', '2020-03-16 11:19:44', 1),
(1000, 'Paket Kiloan Biasa AJAa! berhasil diubah', '2020-03-16 11:20:57', 1),
(1001, 'Paket Kiloan Biasa AJA berhasil diubah', '2020-03-16 11:21:01', 1),
(1002, 'Pengguna super_administrator berhasil logout', '2020-03-16 11:28:21', 1),
(1003, 'Pengguna andre975 berhasil login', '2020-03-16 11:28:26', 2),
(1004, 'Pengguna andre975 berhasil logout', '2020-03-16 11:29:06', 2),
(1005, 'Pengguna andre975 berhasil login', '2020-03-16 11:31:12', 2),
(1006, 'Pengguna andre975 berhasil login', '2020-03-16 20:04:56', 2),
(1007, 'Pengguna andre975 berhasil logout', '2020-03-16 20:56:25', 2),
(1008, 'Pengguna andre975 berhasil login', '2020-03-16 20:57:20', 2),
(1009, 'Cetak Invoice - 120320201215T0001 - Himdan Al Ghozan', '2020-03-16 21:05:52', 2),
(1010, 'Cetak Invoice - 120320201216T0002 - Muhammad Faisal Achramsyah', '2020-03-16 21:06:26', 2),
(1011, 'Cetak Invoice - 120320201216T0002 - Muhammad Faisal Achramsyah', '2020-03-16 21:07:36', 2),
(1012, 'Pengguna andre975 berhasil login', '2020-03-17 01:17:02', 2),
(1013, 'Cetak Invoice - 160320201217T0001 - Putri Larasati', '2020-03-17 01:28:45', 2),
(1014, 'Cetak Invoice - 160320201217T0001 - Putri Larasati', '2020-03-17 01:29:39', 2),
(1015, 'Cetak Invoice - 160320201217T0001 - Putri Larasati', '2020-03-17 01:37:05', 2),
(1016, 'Cetak Invoice - 160320201218T0002 - Ikbal', '2020-03-17 01:37:08', 2),
(1017, 'Cetak Invoice - 160320201218T0002 - Ikbal', '2020-03-17 01:38:51', 2),
(1018, 'Cetak Invoice - 160320201217T0001 - Putri Larasati', '2020-03-17 01:39:18', 2),
(1019, 'Detail Transaksi 09032020121T0005 berhasil dimanipulasi', '2020-03-17 02:11:21', 2),
(1020, 'Transaksi  berhasil diubah status transaksinya', '2020-03-17 02:13:48', 2),
(1021, 'Transaksi 17032020123T0001 berhasil ditambahkan', '2020-03-17 02:14:16', 2),
(1022, 'Detail Transaksi 17032020123T0001 berhasil ditambahkan', '2020-03-17 02:14:21', 2),
(1023, 'Transaksi  berhasil diubah status transaksinya', '2020-03-17 02:14:38', 2),
(1024, 'Pembayaran Transaksi 17032020123T0001 berhasil', '2020-03-17 02:16:27', 2),
(1025, 'Cetak Invoice - 17032020123T0001 - Bintang Shakila Akassah', '2020-03-17 02:16:33', 2),
(1026, 'Transaksi 17032020123T0001 berhasil diubah', '2020-03-17 02:17:00', 2),
(1027, 'Transaksi 17032020128T0002 berhasil ditambahkan', '2020-03-17 02:19:19', 2),
(1028, 'Detail Transaksi 17032020128T0002 berhasil ditambahkan', '2020-03-17 02:19:23', 2),
(1029, 'Detail Transaksi 17032020128T0002 gagal ditambahkan! isi minimal 1 paket', '2020-03-17 02:19:32', 2),
(1030, 'Transaksi 17032020128T0002 berhasil diubah', '2020-03-17 02:30:03', 2),
(1031, 'Transaksi 17032020128T0002 berhasil diubah', '2020-03-17 02:30:09', 2),
(1032, 'Transaksi 17032020128T0002 berhasil diubah', '2020-03-17 02:32:12', 2),
(1033, 'Transaksi 17032020128T0002 berhasil diubah', '2020-03-17 02:33:05', 2),
(1034, 'Transaksi 17032020128T0002 berhasil diubah', '2020-03-17 02:33:20', 2),
(1035, 'Pengguna andre975 berhasil login', '2020-03-17 13:15:04', 2),
(1036, 'Transaksi 17032020126T0003 berhasil ditambahkan', '2020-03-17 13:58:29', 2),
(1037, 'Detail Transaksi 17032020126T0003 berhasil ditambahkan', '2020-03-17 13:58:37', 2),
(1038, 'Transaksi  berhasil diubah status transaksinya', '2020-03-17 13:58:47', 2),
(1039, 'Pengguna andre975 berhasil logout', '2020-03-17 14:01:35', 2),
(1040, 'Pengguna rian43 berhasil login', '2020-03-17 14:01:54', 6),
(1041, 'Transaksi  berhasil diubah status transaksinya', '2020-03-17 14:40:45', 6),
(1042, 'Pembayaran Transaksi 120320202515T0005 berhasil', '2020-03-17 14:41:14', 6),
(1043, 'Cetak Invoice - 120320202515T0005 - Himdan Al Ghozan', '2020-03-17 14:41:24', 6),
(1044, 'Transaksi  berhasil diubah status transaksinya', '2020-03-17 14:42:01', 6),
(1045, 'Transaksi 17032020263T0004 berhasil ditambahkan', '2020-03-17 14:59:47', 6),
(1046, 'Detail Transaksi 17032020263T0004 berhasil ditambahkan', '2020-03-17 15:00:34', 6),
(1047, 'Pembayaran Transaksi 17032020263T0004 gagal! uang yang dibayar kurang dari total harga', '2020-03-17 15:00:58', 6),
(1048, 'Pembayaran Transaksi 17032020263T0004 berhasil', '2020-03-17 15:02:30', 6),
(1049, 'Cetak Invoice - 17032020263T0004 - Bintang Shakila Akassah', '2020-03-17 15:03:30', 6),
(1050, 'Pengguna andre975 berhasil login', '2020-03-17 18:36:52', 2),
(1051, 'Pengguna super_administrator berhasil login', '2021-12-17 22:54:53', 1),
(1052, 'Transaksi 17122021118T0001 berhasil ditambahkan', '2021-12-17 22:55:40', 1),
(1053, 'Detail Transaksi 17122021118T0001 berhasil ditambahkan', '2021-12-17 22:55:59', 1),
(1054, 'Transaksi  berhasil diubah status transaksinya', '2021-12-17 22:59:20', 1),
(1055, 'Pembayaran Transaksi 17122021118T0001 berhasil', '2021-12-17 23:14:47', 1),
(1056, 'Cetak Invoice - 17122021118T0001 - Febby Anggraeni', '2021-12-17 23:14:51', 1),
(1057, 'Cetak Laporan - 2017-12-31 00:00:00 - 2021-12-17 23:59:59', '2021-12-17 23:18:23', 1),
(1058, 'Cetak Laporan - 2017-12-31 00:00:00 - 2021-12-17 23:59:59', '2021-12-17 23:18:41', 1),
(1059, 'Pengguna super_administrator berhasil logout', '2021-12-17 23:19:09', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_kelamin` enum('pria','wanita') COLLATE utf8_unicode_ci NOT NULL,
  `telepon_member` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email_member` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat_member` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `jenis_kelamin`, `telepon_member`, `email_member`, `alamat_member`) VALUES
(1, 'Nazira Apriliani', 'wanita', '085826875457', 'naziraap21@gmail.com', 'Gg. Kesadaran No. 32 RT 04 / RW 02'),
(2, 'Muhammad Fikri', 'pria', '087842349805', 'fikrimuh8@gmail.com', 'Gg. Salak 5 No. 45 RT 04 / RW 02'),
(3, 'Bintang Shakila Akassah', 'wanita', '087851253899', 'bintang.22.syakila@gmail.com', 'Jl. AMD Babakan Pocis RT04/01 No. 200'),
(4, 'Namira Nindya Fitri', 'wanita', '081245725233', '', 'Pondok Benda Buaran Serpong Rt 01/04 Buaran Serpong Tangerang Selatan'),
(5, 'Yos Hermawan', 'pria', '0895454288024', 'yos.herm31@gmail.com', 'Jl. Kesadaran 2 No. 4 Rt 04/13 Pondok Petir, Bojongsari'),
(6, 'Arum Diah Ariyanti', 'wanita', '085812554231', '', 'Benda Baru No 97 Rt 02/09 Benda Baru Pamulang'),
(7, 'Jasmine Aulia Syahrami', 'wanita', '085642130220', 'jasmineaul25@gmail.com', 'Jl. Otista Gg. Saktirt 09/09 Kedaung, Pamulang Tangerang Selatan 15413'),
(8, 'Febby Anggraeni', 'wanita', '085721350253', 'febbya79@yahoo.co.id', 'Jl. Raya Puspiptek Gg. Masjid Rt.16/04'),
(9, 'Edwan Syawal', 'pria', '082125653821', 'edo42@gmail.com', 'Kp. Pengasinan Rt 05/01 Pengasinan, Gunung Sindur'),
(10, 'Tyo Hafiad Noerman', 'pria', '089542351005', 'tyohafiad4@gmail.com', 'Jl. Kesadaran Rt 05/03 No .72 Pondok Benda, Pamulang'),
(11, 'Roro Dana Iswara Aditya Bakti', 'wanita', '087821350255', 'roro32@yahoo.com', 'Jl. Ciater Barat No. 28 Rt 11/01 Ciater , Serpong'),
(12, 'Shelina', 'wanita', '08582135562', 'shelina87@gmail.com', 'Jl. Hk Kademangan, No. 30 Rt 05/01 Kademangan, Setu'),
(13, 'Muhammad Irgi Al Ghitraf', 'pria', '087853239481', 'irgibungsu@gmail.com', 'Puri Serpong 2'),
(14, 'Rayhan Aditya Syahputra', 'pria', '0896343114653', 'rehanadit0981@gmail.com', 'Desa Pamulang Barat Rt 02/07 No 59 Pamulang Barat, Pamulang'),
(15, 'Himdan Al Ghozan', 'pria', '089743766739', '', 'rawakalong'),
(16, 'Muhammad Faisal Achramsyah', 'pria', '0878324624782', 'faisalach2@gmail.com', 'Perum Batan Indah Blok H No. 37 Rt 13/04 Kademangan, Setu'),
(17, 'Putri Larasati', 'wanita', '087851347522', 'putrilara@gmail.com', 'Viladago Parangtritis C7 1h Rt 01/20 Benda Baru Pamulang Tangerang Selatan 15433'),
(18, 'Ikbal', 'pria', '08787836542', '', 'pamulang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama_outlet` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telepon_outlet` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `alamat_outlet` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `telepon_outlet`, `alamat_outlet`) VALUES
(1, 'Andry Laundry Pocis', '087808675313', 'Jl. AMD Babakan Pocis No. 100 RT02/RW02 Bakti Jaya Kec. Setu Kota. Tangerang Selatan Prov. Banten Jawa Barat 15433'),
(2, 'Andry Laundry Pamulang', '081213145521', 'Jl. Jendral Sudirman No. 12 RT02/RW03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_jenis_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`, `id_outlet`, `id_jenis_paket`) VALUES
(1, 'Kiloan Biasa AJA', 8000, 1, 1),
(2, 'Satuan aja mas', 4000, 1, 8),
(3, 'WoW! Bed cover Ada disini!', 25000, 1, 3),
(4, 'Reguler Kiloan', 7000, 2, 1),
(5, 'Reguler Satuan', 2500, 2, 8),
(6, 'Kiloan Raja Laut', 10000, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `uang_yg_dibayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `id_user`, `total_harga`, `uang_yg_dibayar`, `kembalian`) VALUES
(1, 1, 2, 8800, 10000, 1200),
(2, 4, 2, 13200, 15000, 1800),
(3, 3, 2, 8800, 10000, 1200),
(4, 5, 2, 8800, 10000, 1200),
(5, 10, 2, 4400, 5000, 600),
(6, 9, 2, 81400, 90000, 8600),
(7, 12, 6, 20900, 21000, 100),
(8, 15, 1, 17600, 20000, 2400),
(9, 16, 1, 13200, 15000, 1800),
(10, 11, 1, 15400, 20000, 4600),
(11, 17, 1, 17600, 20000, 2400),
(12, 18, 1, 8800, 10000, 1200),
(13, 19, 2, 95700, 100000, 4300),
(14, 8, 2, 22000, 25000, 3000),
(15, 28, 2, 85800, 90000, 4200),
(16, 27, 2, 19800, 20000, 200),
(17, 24, 2, 56200, 57000, 800),
(18, 30, 6, 16500, 17000, 500),
(19, 33, 2, 75800, 76000, 200),
(20, 35, 5, 33000, 50000, 17000),
(21, 37, 2, 18900, 20000, 1100),
(22, 38, 5, 13200, 13500, 300),
(23, 32, 3, 52800, 60000, 7200),
(24, 39, 2, 8800, 10000, 1200),
(25, 41, 2, 8800, 10000, 1200),
(26, 36, 6, 36200, 100000, 63800),
(27, 44, 6, 11500, 12000, 500),
(28, 45, 1, 56500, 100000, 43500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_invoice` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `diskon` float NOT NULL,
  `pajak` int(11) NOT NULL,
  `status_transaksi` enum('proses','dicuci','siap diambil','sudah diambil') COLLATE utf8_unicode_ci NOT NULL,
  `status_bayar` enum('belum dibayar','sudah dibayar') COLLATE utf8_unicode_ci NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_invoice`, `tanggal_transaksi`, `batas_waktu`, `tanggal_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status_transaksi`, `status_bayar`, `id_member`, `id_outlet`, `id_user`) VALUES
(1, '09032020126T0001', '2020-03-07 00:00:00', '2020-03-09 14:25:00', '2020-03-09 14:26:14', 0, 0, 10, 'siap diambil', 'sudah dibayar', 6, 1, 2),
(3, '09032020123T0002', '2020-03-09 14:26:52', '2020-03-09 14:26:00', '2020-03-09 14:34:50', 0, 0, 10, 'dicuci', 'sudah dibayar', 3, 1, 2),
(4, '09032020122T0003', '2020-03-09 14:34:13', '2020-03-10 09:00:00', '2020-03-09 14:34:29', 0, 0, 10, 'siap diambil', 'sudah dibayar', 2, 1, 2),
(5, '09032020126T0004', '2020-03-09 14:36:32', '2020-03-10 09:00:00', '2020-03-09 14:36:42', 0, 0, 10, 'dicuci', 'sudah dibayar', 6, 1, 2),
(7, '09032020121T0005', '2020-03-09 14:37:54', '2020-03-09 14:37:00', '0000-00-00 00:00:00', 0, 0, 10, 'dicuci', 'belum dibayar', 1, 1, 2),
(8, '09032020123T0006', '2020-03-09 14:38:47', '2020-03-09 14:38:00', '2020-03-10 19:55:33', 0, 0, 10, 'proses', 'sudah dibayar', 3, 1, 2),
(9, '09032020122T0007', '2020-03-09 14:51:02', '2020-03-09 14:50:00', '2020-03-09 16:22:24', 0, 0, 10, 'dicuci', 'sudah dibayar', 2, 1, 2),
(10, '09032020124T0008', '2020-03-09 16:14:10', '2020-03-10 09:00:00', '2020-03-09 16:14:25', 0, 0, 10, 'sudah diambil', 'sudah dibayar', 4, 1, 2),
(11, '09032020268T0009', '2020-03-09 17:55:33', '2020-03-10 09:00:00', '2020-03-09 18:14:58', 3000, 5, 10, 'sudah diambil', 'sudah dibayar', 8, 2, 6),
(12, '090320202611T0010', '2020-03-09 17:56:11', '2020-03-11 09:00:00', '2020-03-09 17:56:32', 0, 0, 10, 'siap diambil', 'sudah dibayar', 11, 2, 6),
(15, '090320201112T0011', '2020-03-09 18:11:05', '2020-03-10 09:00:00', '2020-03-09 18:13:10', 0, 0, 10, 'proses', 'sudah dibayar', 12, 1, 1),
(16, '09032020114T0012', '2020-03-09 18:14:23', '2020-03-10 09:00:00', '2020-03-09 18:14:34', 0, 0, 10, 'proses', 'sudah dibayar', 4, 1, 1),
(17, '09032020119T0013', '2020-03-09 18:31:42', '2020-03-10 09:00:00', '2020-03-09 18:32:11', 0, 0, 10, 'proses', 'sudah dibayar', 9, 1, 1),
(18, '09032020117T0014', '2020-03-09 18:32:33', '2020-03-10 09:00:00', '2020-03-09 18:33:23', 0, 0, 10, 'sudah diambil', 'sudah dibayar', 7, 1, 1),
(19, '100320201213T0001', '2020-03-10 08:56:12', '2020-03-09 09:00:00', '2020-03-10 09:02:49', 5000, 0, 10, 'sudah diambil', 'sudah dibayar', 13, 1, 2),
(21, '11032020127T0001', '2020-03-11 10:16:28', '2020-03-12 09:00:00', '0000-00-00 00:00:00', 0, 0, 10, 'siap diambil', 'belum dibayar', 7, 1, 2),
(24, '11032020127T0002', '2020-03-11 10:59:07', '2020-03-12 09:00:00', '2020-03-11 13:49:54', 1002, 0, 10, 'sudah diambil', 'sudah dibayar', 7, 1, 2),
(27, '11032020123T0004', '2020-03-11 13:25:25', '2020-03-11 13:25:00', '2020-03-11 13:45:31', 2000, 0, 10, 'sudah diambil', 'sudah dibayar', 3, 1, 2),
(28, '11032020123T0005', '2020-03-11 13:39:53', '2020-03-12 09:00:00', '2020-03-11 13:41:23', 0, 0, 10, 'sudah diambil', 'sudah dibayar', 3, 1, 2),
(29, '110320201211T0006', '2020-03-11 13:53:17', '2020-03-11 13:53:00', '0000-00-00 00:00:00', 0, 0, 10, 'siap diambil', 'belum dibayar', 11, 1, 2),
(30, '11032020263T0007', '2020-03-11 17:10:46', '2020-03-12 09:00:00', '2020-03-11 17:10:59', 10000, 0, 10, 'siap diambil', 'sudah dibayar', 3, 2, 6),
(32, '120320201215T0001', '2020-03-12 08:52:43', '2020-03-13 09:00:00', '2020-03-15 14:18:01', 0, 0, 10, 'siap diambil', 'sudah dibayar', 15, 1, 2),
(33, '120320201216T0002', '2020-03-12 09:04:42', '2020-03-15 09:00:00', '2020-03-12 09:06:42', 2500, 5, 10, 'siap diambil', 'sudah dibayar', 16, 1, 2),
(34, '12032020253T0003', '2020-03-12 11:36:45', '2020-03-13 09:00:00', '0000-00-00 00:00:00', 2000, 5, 10, 'siap diambil', 'belum dibayar', 3, 2, 5),
(35, '120320202513T0004', '2020-03-12 11:38:39', '2020-03-13 10:00:00', '2020-03-12 11:39:13', 0, 0, 10, 'dicuci', 'sudah dibayar', 13, 2, 5),
(36, '120320202515T0005', '2020-03-12 13:09:33', '2020-03-12 13:08:00', '2020-03-17 14:41:14', 0, 6, 10, 'sudah diambil', 'sudah dibayar', 15, 2, 5),
(37, '130320201213T0001', '2020-03-13 08:46:20', '2020-03-14 09:00:00', '2020-03-13 08:46:39', 2000, 5, 10, 'siap diambil', 'sudah dibayar', 13, 1, 2),
(38, '14032020253T0001', '2020-03-14 12:09:50', '2020-03-15 12:09:00', '2020-03-14 12:10:31', 0, 0, 10, 'proses', 'sudah dibayar', 3, 2, 5),
(39, '160320201217T0001', '2020-03-16 08:40:46', '2020-03-17 09:00:00', '2020-03-16 08:41:03', 0, 0, 10, 'siap diambil', 'sudah dibayar', 17, 1, 2),
(40, '160320201218T0002', '2020-03-16 10:19:32', '2020-03-17 09:00:00', '0000-00-00 00:00:00', 2000, 0, 10, 'siap diambil', 'belum dibayar', 18, 1, 2),
(41, '17032020123T0001', '2020-03-17 02:14:16', '2020-03-17 09:00:00', '2020-03-17 02:16:27', 0, 0, 10, 'dicuci', 'sudah dibayar', 3, 1, 2),
(42, '17032020128T0002', '2020-03-17 02:19:19', '2020-03-17 09:00:00', '0000-00-00 00:00:00', 5000, 2, 12, 'proses', 'belum dibayar', 8, 1, 2),
(43, '17032020126T0003', '2020-03-17 13:58:29', '2020-03-17 13:58:00', '0000-00-00 00:00:00', 0, 0, 10, 'dicuci', 'belum dibayar', 6, 1, 2),
(44, '17032020263T0004', '2020-03-17 14:59:47', '2020-03-18 09:00:00', '2020-03-17 15:02:30', 1000, 5, 10, 'proses', 'sudah dibayar', 3, 2, 6),
(45, '17122021118T0001', '2021-12-17 22:55:40', '2021-12-18 22:55:00', '2021-12-17 23:14:47', 1000, 10, 10, 'dicuci', 'belum dibayar', 8, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_outlet`, `id_jabatan`) VALUES
(1, 'super_administrator', '$2y$10$.zk2CNXlXauzDhI38F721.2ExLvw3hvDxE4hA.v/m.ANSGrPiPleC', 1, 1),
(2, 'andre975', '$2y$10$pFEavlHoN3M8NqpoW.XfGOZ7lBnWngElDkijqaBoAs4uwEpS1HrBq', 1, 2),
(3, 'irgi12', '$2y$10$z6U4gqlXkVHxVn9DeR5wveVUPvkWcscdODMoK4Xdzcj256mkbg666', 1, 3),
(4, 'salsa321', '$2y$10$LLS4fpdOsBbDjFjHwtEh3OwsFNILOAOJ6JEGga3zE1HupDLq/7wpa', 1, 4),
(5, 'indah76', '$2y$10$yUxIEeuKhyKhY0lb9yF9puoiiTIEf1hHMoffBDRm.B4XPfBOL76mi', 2, 2),
(6, 'rian43', '$2y$10$8VkjMkKQAwT/ZrX51WjSMOzeLTPpczX96FT87BFawgiBumVBDR6u.', 2, 3),
(7, 'febyfeb09', '$2y$10$/TSrLFZd8Gv.4jayCmp/FOezrEmsWGcVgWU/Pn89PdWfJFlkpY8DO', 2, 4),
(8, 'gita32', '$2y$10$o23vOagRlojnwlOQdBYQbuRCCC17eSmLyXytEC0o1ITwmjCPTgT7W', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id_biodata`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jenis_paket`
--
ALTER TABLE `jenis_paket`
  ADD PRIMARY KEY (`id_jenis_paket`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_jenis_paket` (`id_jenis_paket`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_paket`
--
ALTER TABLE `jenis_paket`
  MODIFY `id_jenis_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1060;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`id_jenis_paket`) REFERENCES `jenis_paket` (`id_jenis_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_ibfk_2` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
