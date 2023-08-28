-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Agu 2023 pada 22.23
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dana`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode` varchar(100) NOT NULL,
  `id_barang` int NOT NULL,
  `nm_barang` varchar(125) NOT NULL,
  `kategori` int NOT NULL,
  `harga` double NOT NULL,
  `stok` double NOT NULL,
  `image` varchar(225) NOT NULL,
  `urutan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode`, `id_barang`, `nm_barang`, `kategori`, `harga`, `stok`, `image`, `urutan`) VALUES
('BR-1001', 9, 'Lemari', 0, 10000000, 2, '', 1001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `nm_perusahaan_cabang` varchar(125) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `kode`, `nama`, `nm_perusahaan_cabang`, `alamat`, `no_hp`) VALUES
(1, 'SBY', 'Cabang Surabaya', '', 'Surabaya', '0878282828'),
(2, 'BJM', 'Cabang Banjarmasin', '', 'jln hksn komplek herlina rt 15 rw 02', '0878763737'),
(3, 'PLK', 'Cabang Palangka', '', 'jl dsada', '0878763737'),
(4, 'PULPIS2', 'Cabang Pulang pisau', '', 'jl pulang pisau', '0878787878');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int NOT NULL,
  `nama_departemen` varchar(120) NOT NULL,
  `lokasi` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`, `lokasi`) VALUES
(1, 'Keungan', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris_dipinjam`
--

CREATE TABLE `inventaris_dipinjam` (
  `id_peminjaman_inv` int NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `qty` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_peminjam` int NOT NULL,
  `nik` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_cabang` int NOT NULL,
  `nota_peminjaman` varchar(100) NOT NULL,
  `status_pinjam` enum('dipinjam','kembali') NOT NULL,
  `ket` enum('pengajuan','setuju','tidak_setuju') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `inventaris_dipinjam`
--

INSERT INTO `inventaris_dipinjam` (`id_peminjaman_inv`, `kode_barang`, `qty`, `tgl_pinjam`, `tgl_kembali`, `id_peminjam`, `nik`, `id_cabang`, `nota_peminjaman`, `status_pinjam`, `ket`, `lampiran`, `admin`) VALUES
(3, 'BR-1001', 1, '2023-08-26', '2023-09-26', 0, 'KRY-5001', 2, '', 'dipinjam', 'tidak_setuju', '', 'KRY-5002'),
(4, 'BR-1001', 2, '2023-08-28', '2023-09-09', 0, 'KRY-5001', 2, '', 'dipinjam', 'setuju', 'undangan_2.png', 'KRY-5002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int NOT NULL,
  `nik` varchar(100) NOT NULL,
  `id_level_karyawan` int NOT NULL,
  `nm_karyawan` varchar(125) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `id_departemen` int NOT NULL,
  `foto` varchar(225) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `urutan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `id_level_karyawan`, `nm_karyawan`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `id_departemen`, `foto`, `tgl_bergabung`, `urutan`) VALUES
(6, 'KRY-5001', 8, 'Nanda Wahyudi', 'L', '2023-08-26', 'Testing', 1, 'default.png', '2023-08-26', 5001),
(7, 'KRY-5002', 7, 'RIzal', 'L', '2023-08-26', 'GAS', 1, 'default.png', '2023-08-26', 5002);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nm_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_karyawan`
--

CREATE TABLE `level_karyawan` (
  `id_level_karyawan` int NOT NULL,
  `nm_level` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `level_karyawan`
--

INSERT INTO `level_karyawan` (`id_level_karyawan`, `nm_level`) VALUES
(6, 'Super admin'),
(7, 'Admin GA'),
(8, 'Manajer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `opname`
--

CREATE TABLE `opname` (
  `id_opname` int NOT NULL,
  `no_nota_opname` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `qty_program` double NOT NULL,
  `qty_aktual` double NOT NULL,
  `tgl` date NOT NULL,
  `admin` varchar(50) NOT NULL,
  `urutan` int NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemusnahan_barang`
--

CREATE TABLE `pemusnahan_barang` (
  `id_pemusnahan_barang` int NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `ket` varchar(125) NOT NULL,
  `tgl_pemusnahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan_barang`
--

CREATE TABLE `perbaikan_barang` (
  `id_perbaikan_barang` int NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `ket` varchar(125) NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` enum('pengajuan','diperbaiki','ditolak','rusak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dari` enum('1','2') NOT NULL,
  `id_cabang` int DEFAULT '0',
  `id_vendor` int NOT NULL,
  `lampiran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `perbaikan_barang`
--

INSERT INTO `perbaikan_barang` (`id_perbaikan_barang`, `kode_barang`, `qty`, `ket`, `tgl_perbaikan`, `tgl_selesai`, `status`, `dari`, `id_cabang`, `id_vendor`, `lampiran`) VALUES
(4, 'BR-1001', 2, 'rusak dibagian atas', '2023-08-30', '0000-00-00', 'pengajuan', '1', 0, 1, 'undangan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` int NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `masuk` double NOT NULL,
  `keluar` double NOT NULL,
  `ket` varchar(110) NOT NULL,
  `opname` enum('T','Y') NOT NULL,
  `id_cabang` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id_stok`, `kode_barang`, `masuk`, `keluar`, `ket`, `opname`, `id_cabang`) VALUES
(20, 'BR-1001', 2, 0, 'Stok awal', 'T', 0),
(21, 'BR-1001', 0, 2, 'Peminjaman', 'T', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_stok_masuk` int NOT NULL,
  `tgl` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `qty_sebelum` double NOT NULL,
  `urutan` int NOT NULL,
  `no_nota_masuk` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_role` int NOT NULL,
  `is_active` int NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `id_role`, `is_active`, `email`, `image`) VALUES
(1, 'Admin', 'admin', '$2y$10$VQcGKHiC21omQwWRYXNrpeAMsAt7V8jQq1iyw46OinjBQQ5qHx0Jy', 1, 1, '', 'user1.png'),
(18, 'KRY-5001', 'Nanda Wahyudi', '$2y$10$MF6NZ1RAUlihD0J9271RJu7Pj5rNHw9FazUzs6PFDLq9LBfULK.Da', 2, 1, NULL, 'default.jpg'),
(19, 'KRY-5002', 'RIzal', '$2y$10$ejW0yhFugW6WQdIMhVt9z.uEY/Qm2AT9vx5stwDW8SDSx9jGajI6.', 3, 1, NULL, 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int NOT NULL,
  `nm_vendor` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(125) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nm_vendor`, `alamat`, `email`, `no_telp`) VALUES
(1, 'XYZ Electronics', 'Surabayadsa', 'XYZ@gmail.com', '085751609104');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indeks untuk tabel `inventaris_dipinjam`
--
ALTER TABLE `inventaris_dipinjam`
  ADD PRIMARY KEY (`id_peminjaman_inv`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `level_karyawan`
--
ALTER TABLE `level_karyawan`
  ADD PRIMARY KEY (`id_level_karyawan`);

--
-- Indeks untuk tabel `opname`
--
ALTER TABLE `opname`
  ADD PRIMARY KEY (`id_opname`);

--
-- Indeks untuk tabel `pemusnahan_barang`
--
ALTER TABLE `pemusnahan_barang`
  ADD PRIMARY KEY (`id_pemusnahan_barang`);

--
-- Indeks untuk tabel `perbaikan_barang`
--
ALTER TABLE `perbaikan_barang`
  ADD PRIMARY KEY (`id_perbaikan_barang`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indeks untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `inventaris_dipinjam`
--
ALTER TABLE `inventaris_dipinjam`
  MODIFY `id_peminjaman_inv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `level_karyawan`
--
ALTER TABLE `level_karyawan`
  MODIFY `id_level_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `opname`
--
ALTER TABLE `opname`
  MODIFY `id_opname` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemusnahan_barang`
--
ALTER TABLE `pemusnahan_barang`
  MODIFY `id_pemusnahan_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `perbaikan_barang`
--
ALTER TABLE `perbaikan_barang`
  MODIFY `id_perbaikan_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_stok_masuk` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
