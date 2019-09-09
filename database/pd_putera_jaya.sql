-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 02:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siap`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`password`) VALUES
('ac1a49d3e80e374a34d959a46ec44aaf');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_akun` char(3) NOT NULL,
  `nama_akun` varchar(30) DEFAULT NULL,
  `header_akun` char(1) NOT NULL,
  `saldo_awal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_akun`, `nama_akun`, `header_akun`, `saldo_awal`) VALUES
('111', 'Kas', '1', 0),
('112', 'Piutang', '1', 0),
('211', 'Utang', '2', 0),
('411', 'Penjualan', '4', 0),
('511', 'Pembelian', '5', 0),
('512', 'Potongan Pembelian', '5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` char(6) NOT NULL,
  `nama_barang` varchar(30) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `harga`) VALUES
('BR-001', 'Pisang Nangka', 7000),
('BR-002', 'Pisang Ambon', 7000),
('BR-003', 'Pisang Cere', 12000),
('BR-004', 'Pisang Bulu', 10000),
('BR-005', 'Pisang Tanduk', 14000),
('BR-006', 'Pisang Muli', 8000),
('BR-007', 'Pisang Kepok', 7000),
('BR-008', 'Pisang Siem', 6000),
('BR-009', 'Pisang Kapas', 7000),
('BR-010', 'Pisang Bangka', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian_kredit`
--

CREATE TABLE `detail_pembelian_kredit` (
  `kd_pembelian` char(6) NOT NULL,
  `kd_barang` char(6) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian_kredit`
--

INSERT INTO `detail_pembelian_kredit` (`kd_pembelian`, `kd_barang`, `jumlah`, `subtotal`) VALUES
('PB-001', 'BR-009', 100, 700000),
('PB-001', 'BR-005', 200, 2800000),
('PB-001', 'BR-001', 150, 1050000),
('PB-001', 'BR-004', 50, 500000),
('PB-002', 'BR-009', 500, 3500000),
('PB-002', 'BR-002', 300, 2100000),
('PB-002', 'BR-003', 300, 3600000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_kredit`
--

CREATE TABLE `detail_penjualan_kredit` (
  `kd_penjualan` char(6) DEFAULT NULL,
  `kd_barang` char(6) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan_kredit`
--

INSERT INTO `detail_penjualan_kredit` (`kd_penjualan`, `kd_barang`, `jumlah`, `subtotal`) VALUES
('PJ-001', 'BR-002', 100, 700000),
('PJ-002', 'BR-009', 250, 1750000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `no` int(11) NOT NULL,
  `kd_transaksi` char(6) NOT NULL,
  `no_akun` char(6) DEFAULT NULL,
  `tanggal_jurnal` date DEFAULT NULL,
  `posisi` char(6) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`no`, `kd_transaksi`, `no_akun`, `tanggal_jurnal`, `posisi`, `nominal`) VALUES
(1, 'PB-001', '511', '2018-11-22', 'debit', 5050000),
(2, 'PB-001', '211', '2018-11-22', 'kredit', 5050000),
(3, 'PB-002', '511', '2018-11-22', 'debit', 9200000),
(4, 'PB-002', '211', '2018-11-22', 'kredit', 9200000),
(5, 'PJ-001', '112', '2018-11-22', 'debit', 700000),
(6, 'PJ-001', '411', '2018-11-22', 'kredit', 700000),
(7, 'PJ-002', '112', '2018-11-22', 'debit', 1750000),
(8, 'PJ-002', '411', '2018-11-22', 'kredit', 1750000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(6) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_telp`, `alamat`) VALUES
('PL-001', 'Okta Pascal', '085213485640', 'RT07 RW01 Gili, Kel Linggis, Kec Rawamangu. Bandung'),
('PL-002', 'Ais', '087365887410', 'Jl. Cijeungjing No 50, Desa Sukasari, Kel. Cipoa, Kec. Rawamangu Kabupaten Tuluanggung'),
('PL-003', 'Amel', '035998740356', 'RT 69 RW 96, Desa Manakan, Kel. Kolotok, Kec. Gurame, Kota Los Enjles'),
('PL-004', 'Billy', '056989999641', 'Jl. CicagoKapayunSaalit, Desa Somalia, Kel. DesPerados, Kec. KidulnaLondon, Kabupaten Moskow');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` char(6) NOT NULL,
  `nama_pemasok` varchar(30) DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `no_telp`, `alamat`) VALUES
('PM-001', 'PD Angga Anggi', '082213485763', 'Jl. Perintis Kemerdekaan No 10, Kel Renda, Kec Sukamenak, Tasikmalaya'),
('PM-002', 'PD Sanjaya', '087523665410', 'Jl. Bebenyit No. 05, Kel. Kersen, Kec. Cecenet, Cianjur'),
('PM-003', 'PD Sunyi Berseri', '089369885444', 'Jl. Banjaran No. 244 Kel. Cucunguk, Kec. Cigantar, Sukabumi'),
('PM-004', 'Pirman', '084231569821', 'Jl. Pucuk Agung No. 99 Kel. Cibenyu Kec. Kolotok, Garut');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_kredit`
--

CREATE TABLE `pembelian_kredit` (
  `kd_pembelian` char(6) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` char(5) DEFAULT NULL,
  `kondisi` char(6) NOT NULL,
  `tanggal_pelunasan` date NOT NULL,
  `potongan` int(11) NOT NULL,
  `pelunasan` int(11) NOT NULL,
  `id_pemasok` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_kredit`
--

INSERT INTO `pembelian_kredit` (`kd_pembelian`, `tanggal_pembelian`, `total`, `status`, `kondisi`, `tanggal_pelunasan`, `potongan`, `pelunasan`, `id_pemasok`) VALUES
('PB-001', '2018-11-22', 5050000, 'BL', '5/5', '0000-00-00', 0, 0, 'PM-001'),
('PB-002', '2018-11-22', 9200000, 'BL', 'N/A', '0000-00-00', 0, 0, 'PM-001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_kredit`
--

CREATE TABLE `penjualan_kredit` (
  `kd_penjualan` char(6) NOT NULL,
  `tanggal_penjualan` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` char(5) DEFAULT NULL,
  `tanggal_pelunasan` date NOT NULL,
  `id_pelanggan` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_kredit`
--

INSERT INTO `penjualan_kredit` (`kd_penjualan`, `tanggal_penjualan`, `total`, `status`, `tanggal_pelunasan`, `id_pelanggan`) VALUES
('PJ-001', '2018-11-22', 700000, 'BL', '0000-00-00', 'PL-001'),
('PJ-002', '2018-11-22', 1750000, 'BL', '0000-00-00', 'PL-002'),
('PJ-003', '0000-00-00', 0, 'BS', '0000-00-00', 'XXX');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`password`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `pembelian_kredit`
--
ALTER TABLE `pembelian_kredit`
  ADD PRIMARY KEY (`kd_pembelian`);

--
-- Indexes for table `penjualan_kredit`
--
ALTER TABLE `penjualan_kredit`
  ADD PRIMARY KEY (`kd_penjualan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
