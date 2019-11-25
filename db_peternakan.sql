-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2019 pada 14.25
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peternakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ayam`
--

CREATE TABLE `tbl_ayam` (
  `id_ayam` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `umur` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_doc`
--

CREATE TABLE `tbl_doc` (
  `id_doc` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `id_supplier` varchar(18) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `umur` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kandang`
--

CREATE TABLE `tbl_kandang` (
  `id_kandang` int(11) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `jml_ayam` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kandang`
--

INSERT INTO `tbl_kandang` (`id_kandang`, `kapasitas`, `jml_ayam`) VALUES
(13, '900', '500'),
(19, '536', '656'),
(24, '300', '200'),
(25, '434', '344'),
(26, '424', '344'),
(27, '433', '100'),
(28, '438', '943'),
(29, '600', '560'),
(30, '500', '250');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelola`
--

CREATE TABLE `tbl_kelola` (
  `id_kelola` int(11) NOT NULL,
  `id_kandang` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pakan`
--

CREATE TABLE `tbl_pakan` (
  `kd_pakan` varchar(10) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `merk` int(30) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `nama`, `alamat`, `no_hp`, `username`, `password`, `foto`) VALUES
(3, 'Saipul Muiz', 'St. Simpang Tiga, Sindangherang, Panumbangan.', '081312962137', 'ipul', '21232f297a57a5a743894a0e4a801fc3', ''),
(6, 'Shella Sariyanti', 'Jln. Gunung Daning 44 Setiajaya Cibeureum', '0811211255', 'ccstmiktsm', '05d251ea28c5be9426611a121db0c92a', ''),
(19, 'Dede', 'Jln. Gunung Daning 44 Setiajaya Cibeureum', '0811211255', 'admin', '21232f297a57a5a743894a0e4a801fc3', '55dc37df57c449.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_supply` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_telur`
--

CREATE TABLE `tbl_telur` (
  `id_telur` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `kualitas` int(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_ayam`
--
ALTER TABLE `tbl_ayam`
  ADD PRIMARY KEY (`id_ayam`);

--
-- Indeks untuk tabel `tbl_doc`
--
ALTER TABLE `tbl_doc`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `fk_idsup_doc` (`id_supplier`);

--
-- Indeks untuk tabel `tbl_kandang`
--
ALTER TABLE `tbl_kandang`
  ADD PRIMARY KEY (`id_kandang`);

--
-- Indeks untuk tabel `tbl_kelola`
--
ALTER TABLE `tbl_kelola`
  ADD PRIMARY KEY (`id_kelola`),
  ADD KEY `fk_idkandang` (`id_kandang`),
  ADD KEY `fk_idpetugas` (`id_petugas`);

--
-- Indeks untuk tabel `tbl_pakan`
--
ALTER TABLE `tbl_pakan`
  ADD PRIMARY KEY (`kd_pakan`),
  ADD KEY `fk_idsup_pakan` (`id_supplier`);

--
-- Indeks untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tbl_telur`
--
ALTER TABLE `tbl_telur`
  ADD PRIMARY KEY (`id_telur`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_ayam`
--
ALTER TABLE `tbl_ayam`
  MODIFY `id_ayam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_doc`
--
ALTER TABLE `tbl_doc`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_kandang`
--
ALTER TABLE `tbl_kandang`
  MODIFY `id_kandang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelola`
--
ALTER TABLE `tbl_kelola`
  MODIFY `id_kelola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_telur`
--
ALTER TABLE `tbl_telur`
  MODIFY `id_telur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_doc`
--
ALTER TABLE `tbl_doc`
  ADD CONSTRAINT `fk_idsup_doc` FOREIGN KEY (`id_supplier`) REFERENCES `tbl_supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_kelola`
--
ALTER TABLE `tbl_kelola`
  ADD CONSTRAINT `fk_idkandang` FOREIGN KEY (`id_kandang`) REFERENCES `tbl_kandang` (`id_kandang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idpetugas` FOREIGN KEY (`id_petugas`) REFERENCES `tbl_petugas` (`id_petugas`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pakan`
--
ALTER TABLE `tbl_pakan`
  ADD CONSTRAINT `fk_idsup_pakan` FOREIGN KEY (`id_supplier`) REFERENCES `tbl_supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
