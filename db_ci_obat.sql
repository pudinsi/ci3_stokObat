-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2023 pada 08.12
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ci_obat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `obat_kode` varchar(100) NOT NULL,
  `obat_nama` varchar(150) NOT NULL,
  `obat_satuan` varchar(20) NOT NULL,
  `obat_stok` int(11) NOT NULL,
  `obat_create` datetime NOT NULL,
  `obat_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `obat_kode`, `obat_nama`, `obat_satuan`, `obat_stok`, `obat_create`, `obat_update`) VALUES
(1, 'O-1', 'Paramex', 'Pcs', 0, '2023-04-13 07:40:55', '2023-04-13 06:11:57'),
(2, 'O-2', 'Oskadon', 'Pak', 0, '2023-04-13 12:58:34', '2023-04-13 06:11:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obatkeluar`
--

CREATE TABLE `obatkeluar` (
  `id_ok` int(11) NOT NULL,
  `ok_obatkode` varchar(100) NOT NULL,
  `ok_tanggal` date NOT NULL,
  `ok_jumlah` int(11) NOT NULL,
  `ok_create` datetime NOT NULL,
  `ok_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `obatkeluar`
--
DELIMITER $$
CREATE TRIGGER `KurangiStokObat` AFTER INSERT ON `obatkeluar` FOR EACH ROW BEGIN
	UPDATE obat set obat_stok = obat_stok - NEW.ok_jumlah
	WHERE obat_kode = NEW.ok_obatkode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `KurangiStokObatDelete` AFTER DELETE ON `obatkeluar` FOR EACH ROW BEGIN
    UPDATE obat SET obat.obat_stok=obat.obat_stok + old.ok_jumlah
    WHERE obat.obat_kode= old.ok_obatkode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `KurangiStokObatUpdateAfter` AFTER UPDATE ON `obatkeluar` FOR EACH ROW BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok + old.ok_jumlah
	WHERE obat.obat_kode = old.ok_obatkode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `KurangiStokObatUpdateBefore` BEFORE UPDATE ON `obatkeluar` FOR EACH ROW BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok - new.ok_jumlah
	WHERE obat.obat_kode = new.ok_obatkode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obatmasuk`
--

CREATE TABLE `obatmasuk` (
  `id_om` int(11) NOT NULL,
  `om_obatkode` varchar(100) NOT NULL,
  `om_tanggal` date NOT NULL,
  `om_jumlah` int(11) NOT NULL,
  `om_create` datetime NOT NULL,
  `om_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `obatmasuk`
--
DELIMITER $$
CREATE TRIGGER `TambahObatMasuk` AFTER INSERT ON `obatmasuk` FOR EACH ROW BEGIN
	UPDATE obat set obat_stok = obat_stok + NEW.om_jumlah
	WHERE obat_kode = NEW.om_obatkode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TambahObatMasukUpdateAfter` AFTER UPDATE ON `obatmasuk` FOR EACH ROW BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok - old.om_jumlah
	WHERE obat.obat_kode = old.om_obatkode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TambahObatMasukUpdateBefore` BEFORE UPDATE ON `obatmasuk` FOR EACH ROW BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok + new.om_jumlah
	WHERE obat.obat_kode = new.om_obatkode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TambahStokObatDelete` AFTER DELETE ON `obatmasuk` FOR EACH ROW BEGIN
    UPDATE obat SET obat.obat_stok=obat.obat_stok - old.om_jumlah
    WHERE obat.obat_kode= old.om_obatkode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) UNSIGNED NOT NULL,
  `users_nama` varchar(128) NOT NULL,
  `users_email` varchar(128) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_active` tinyint(1) UNSIGNED NOT NULL,
  `users_level` enum('Admin','Guest') NOT NULL,
  `users_token` varchar(255) NOT NULL,
  `users_tgl_input` datetime NOT NULL,
  `users_tgl_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `users_nama`, `users_email`, `users_password`, `users_active`, `users_level`, `users_token`, `users_tgl_input`, `users_tgl_edit`) VALUES
(1, 'Admin Utama', 'admin@email.id', '$2y$10$YJx2/v2TlngG5HgmQwMf1Onmd2iARDaXf7ZVpStmvXaGD2y57q2lW', 1, 'Admin', '6fd2dcdeffedd7017f65ad2787d422a0', '2021-05-21 23:51:23', '2023-04-13 04:27:39');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_j_obatkeluar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_j_obatkeluar` (
`id_ok` int(11)
,`ok_obatkode` varchar(100)
,`ok_tanggal` date
,`ok_jumlah` int(11)
,`obat_nama` varchar(150)
,`obat_satuan` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_j_obatmasuk`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_j_obatmasuk` (
`id_om` int(11)
,`om_obatkode` varchar(100)
,`om_tanggal` date
,`om_jumlah` int(11)
,`obat_nama` varchar(150)
,`obat_satuan` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_obat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_obat` (
`id_obat` int(11)
,`obat_kode` varchar(100)
,`obat_nama` varchar(150)
,`obat_stok` int(11)
,`obat_satuan` varchar(20)
,`om_jml` decimal(32,0)
,`ok_jml` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_obatkeluar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_obatkeluar` (
`ok_obatkode` varchar(100)
,`ok_jml` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_obatmasuk`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_obatmasuk` (
`om_obatkode` varchar(100)
,`om_jml` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_j_obatkeluar`
--
DROP TABLE IF EXISTS `v_j_obatkeluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_j_obatkeluar`  AS SELECT `tb1`.`id_ok` AS `id_ok`, `tb1`.`ok_obatkode` AS `ok_obatkode`, `tb1`.`ok_tanggal` AS `ok_tanggal`, `tb1`.`ok_jumlah` AS `ok_jumlah`, `tb2`.`obat_nama` AS `obat_nama`, `tb2`.`obat_satuan` AS `obat_satuan` FROM (`obatkeluar` `tb1` left join `obat` `tb2` on(`tb1`.`ok_obatkode` = `tb2`.`obat_kode`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_j_obatmasuk`
--
DROP TABLE IF EXISTS `v_j_obatmasuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_j_obatmasuk`  AS SELECT `tb1`.`id_om` AS `id_om`, `tb1`.`om_obatkode` AS `om_obatkode`, `tb1`.`om_tanggal` AS `om_tanggal`, `tb1`.`om_jumlah` AS `om_jumlah`, `tb2`.`obat_nama` AS `obat_nama`, `tb2`.`obat_satuan` AS `obat_satuan` FROM (`obatmasuk` `tb1` left join `obat` `tb2` on(`tb1`.`om_obatkode` = `tb2`.`obat_kode`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_obat`
--
DROP TABLE IF EXISTS `v_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_obat`  AS SELECT `tb1`.`id_obat` AS `id_obat`, `tb1`.`obat_kode` AS `obat_kode`, `tb1`.`obat_nama` AS `obat_nama`, `tb1`.`obat_stok` AS `obat_stok`, `tb1`.`obat_satuan` AS `obat_satuan`, `tb2`.`om_jml` AS `om_jml`, `tb3`.`ok_jml` AS `ok_jml` FROM ((`obat` `tb1` left join `v_obatmasuk` `tb2` on(`tb1`.`obat_kode` = `tb2`.`om_obatkode`)) left join `v_obatkeluar` `tb3` on(`tb1`.`obat_kode` = `tb3`.`ok_obatkode`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_obatkeluar`
--
DROP TABLE IF EXISTS `v_obatkeluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_obatkeluar`  AS SELECT `obatkeluar`.`ok_obatkode` AS `ok_obatkode`, sum(`obatkeluar`.`ok_jumlah`) AS `ok_jml` FROM `obatkeluar` GROUP BY `obatkeluar`.`ok_obatkode` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_obatmasuk`
--
DROP TABLE IF EXISTS `v_obatmasuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_obatmasuk`  AS SELECT `obatmasuk`.`om_obatkode` AS `om_obatkode`, sum(`obatmasuk`.`om_jumlah`) AS `om_jml` FROM `obatmasuk` GROUP BY `obatmasuk`.`om_obatkode` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD UNIQUE KEY `uc_obat_kode` (`obat_kode`),
  ADD KEY `obat_kode` (`obat_kode`);

--
-- Indeks untuk tabel `obatkeluar`
--
ALTER TABLE `obatkeluar`
  ADD PRIMARY KEY (`id_ok`),
  ADD KEY `fk_obat_obatkeluar1` (`ok_obatkode`);

--
-- Indeks untuk tabel `obatmasuk`
--
ALTER TABLE `obatmasuk`
  ADD PRIMARY KEY (`id_om`),
  ADD KEY `fk_obat_obatmasuk1` (`om_obatkode`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `obatkeluar`
--
ALTER TABLE `obatkeluar`
  MODIFY `id_ok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `obatmasuk`
--
ALTER TABLE `obatmasuk`
  MODIFY `id_om` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `obatkeluar`
--
ALTER TABLE `obatkeluar`
  ADD CONSTRAINT `fk_obat_obatkeluar1` FOREIGN KEY (`ok_obatkode`) REFERENCES `obat` (`obat_kode`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `obatmasuk`
--
ALTER TABLE `obatmasuk`
  ADD CONSTRAINT `fk_obat_obatmasuk1` FOREIGN KEY (`om_obatkode`) REFERENCES `obat` (`obat_kode`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
