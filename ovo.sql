-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2020 pada 14.20
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ovo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bantuan`
--

CREATE TABLE `bantuan` (
  `id_bantuan` int(11) NOT NULL,
  `judul_bantuan` text NOT NULL,
  `jenis_bantuan` text NOT NULL,
  `sub_jenisbantuan` text NOT NULL,
  `deskripsi_bantuan` text NOT NULL,
  `icon_bantuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bantuan`
--

INSERT INTO `bantuan` (`id_bantuan`, `judul_bantuan`, `jenis_bantuan`, `sub_jenisbantuan`, `deskripsi_bantuan`, `icon_bantuan`) VALUES
(1, 'Info Umum', 'Transaksi di Merchant', 'Bagaimana melakukan transaksi di merchant?', 'Sebelum melakukan transaksi di merchant, pastikan merchant tersebut sudah terdaftar menjadi merchant rekanan OVO.', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deals`
--

CREATE TABLE `deals` (
  `id_deals` int(11) NOT NULL,
  `nama_merchant` varchar(255) NOT NULL,
  `cashback` varchar(255) NOT NULL,
  `vouchers` varchar(255) NOT NULL,
  `my_vouchers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nominal_transaksi` int(8) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_jenis_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jenis_transaksi` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_transaksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_user`
--

CREATE TABLE `jenis_user` (
  `jenis_ovo` int(11) NOT NULL,
  `nama_ovo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_user`
--

INSERT INTO `jenis_user` (`jenis_ovo`, `nama_ovo`) VALUES
(1, 'Premier'),
(2, 'Reguler');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merchant`
--

CREATE TABLE `merchant` (
  `id_merchant` int(11) NOT NULL,
  `nama_merchant` varchar(255) NOT NULL,
  `gambar_merchant` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `merchant`
--

INSERT INTO `merchant` (`id_merchant`, `nama_merchant`, `gambar_merchant`, `is_active`) VALUES
(1, 'PLN', 'https://img.icons8.com/dusk/96/000000/electricity.png', 1),
(2, 'Pulsa', 'https://img.icons8.com/cute-clipart/96/000000/cell-phone.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `no_referensi` int(11) NOT NULL,
  `nama_merchant` varchar(255) NOT NULL,
  `id_jenis_transaksi` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nominal` int(8) NOT NULL,
  `biaya` int(8) NOT NULL,
  `total` int(11) NOT NULL,
  `status_transaksi` text NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `waktu_transaksi` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `isi_notifikasi` varchar(255) NOT NULL,
  `isi_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `nomor_ponsel` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `jenis_ovo` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_pengguna`, `nama_lengkap`, `nomor_ponsel`, `email`, `password`, `img`, `jenis_ovo`, `is_active`, `date_created`) VALUES
(1, 'Fenni Kristiani', '2147483647', 'fennikris@gmail.com', '111100', '', 0, 0, 0),
(2, 'Meily Benedicta', '2147483647', 'meily@gmail.com', '123456', '', 0, 0, 0),
(10, 'Fenni Sarumaha', '083192164289', 'fenni@gmail.com', '$2y$10$HukCyHhZIv93u7PCIbZDOOtvYaloNzHqWdCJJIv5ch7oPXnFgsV6K', 'default.jpg', 2, 1, 1608281230),
(11, 'Vania Miranda', '081912032288', 'vania12@gmail.com', '$2y$10$7orpvWI3Oap6K9aIgoBufOjgA1LyiC5.ciCyYuQjhpyQDV5MiGQyG', 'default.jpg', 1, 1, 1608557612),
(12, 'Adib', '091823445677', 'adibs@gmail.com', '$2y$10$kmqA6ilM/FBXoMJFj3FcdukFKoqQrZYTLrTzjq0z9963WZgVskyWG', 'default.jpg', 2, 1, 1608622086),
(13, 'Daniel', '087766546677', 'daniel@gmail.com', '$2y$10$nqKu2rbOfA0/kRrwUJb.w.Vr7LfLONtHj.xe58qJ8rSXSOqaFSSi6', 'default.jpg', 2, 1, 1608622265),
(14, 'Jason', '085234567788', 'jason@gmail.com', '$2y$10$R12lH2596eyLbOYx47zvd.oFEtfd9PO26w32nDAufdBKZ/RZM7lxG', 'default.jpg', 2, 1, 1608622381),
(15, 'Jason Fay', '089766445536', 'jasonf@gmail.com', '$2y$10$gBtIqpLlXzU1vXJQTtgE/OJRlv9FfONyj0NGpv3baNHHIL4AinXg6', 'default.jpg', 2, 1, 1608622631),
(16, 'Jason Fay', '081967554433', 'jasonfay@gmail.com', '$2y$10$9xO6BnMdKwRQFmBQ1/5puus7I7YQsr01.fY3Zb8TsHp1g6IWkplkO', 'default.jpg', 2, 1, 1608623515),
(17, 'Fenni Sarumaha', '096745673344', 'fennikrist@gmail.com', '$2y$10$BDUcOk91Jacg5WM7mD2/duv03sGtc86sCkBymrvnsYsHyymT1Pqkq', 'default.jpg', 2, 1, 1608623691),
(18, 'Handa Yani', '098878667556', 'handays@gmail.com', '$2y$10$SX7/63UM2Ra2ZqJfEFRw.eLDgGapR7Tu5FKHQmXjkGxU6lM75jKqK', 'default.jpg', 2, 1, 1608625122),
(19, 'Yuli Yanti', '098878667656', 'yuliy@gmail.com', '$2y$10$PctLy9OsqJyziocViAIKQusMMaR2TSY6bqT7VXvL7gCc61Mffx.c.', 'default.jpg', 2, 1, 1608625808);

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `nama_promo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `jumlah_saldo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo`
--

INSERT INTO `saldo` (`id`, `id_pengguna`, `jumlah_saldo`) VALUES
(1, 0, ''),
(2, 0, ''),
(3, 0, ''),
(4, 19, '50000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scan`
--

CREATE TABLE `scan` (
  `id_scan` int(11) NOT NULL,
  `id_merchant` int(11) NOT NULL,
  `barcode_nomor_ponsel` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `top_up`
--

CREATE TABLE `top_up` (
  `id_top_up` int(11) NOT NULL,
  `nominal_top_up` int(8) NOT NULL,
  `kartu_debit` int(11) NOT NULL,
  `waktu_top_up` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `top_up`
--

INSERT INTO `top_up` (`id_top_up`, `nominal_top_up`, `kartu_debit`, `waktu_top_up`, `id_pengguna`) VALUES
(10, 1200000, 0, '2020-12-22 17:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer`
--

CREATE TABLE `transfer` (
  `id_transfer` int(11) NOT NULL,
  `nomor_ponsel_penerima` bigint(12) NOT NULL,
  `bank_tujuan` text NOT NULL,
  `nomor_rekening` bigint(30) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nominal` int(8) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id_bantuan`);

--
-- Indeks untuk tabel `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id_deals`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indeks untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jenis_transaksi`);

--
-- Indeks untuk tabel `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`jenis_ovo`);

--
-- Indeks untuk tabel `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`id_merchant`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`no_referensi`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id_scan`);

--
-- Indeks untuk tabel `top_up`
--
ALTER TABLE `top_up`
  ADD PRIMARY KEY (`id_top_up`);

--
-- Indeks untuk tabel `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id_bantuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `deals`
--
ALTER TABLE `deals`
  MODIFY `id_deals` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jenis_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `jenis_ovo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `merchant`
--
ALTER TABLE `merchant`
  MODIFY `id_merchant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `no_referensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `top_up`
--
ALTER TABLE `top_up`
  MODIFY `id_top_up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
