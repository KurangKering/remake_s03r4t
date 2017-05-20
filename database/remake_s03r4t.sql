-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5169
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for remake_s03r4t
DROP DATABASE IF EXISTS `remake_s03r4t`;
CREATE DATABASE IF NOT EXISTS `remake_s03r4t` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `remake_s03r4t`;

-- Dumping structure for table remake_s03r4t.groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.groups: ~2 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator'),
	(2, 'members', 'General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.login_attempts
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.login_attempts: ~0 rows (approximately)
DELETE FROM `login_attempts`;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `access` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.menus: ~14 rows (approximately)
DELETE FROM `menus`;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`, `access`) VALUES
	(1, NULL, 'Dashboard', 'fa fa-home', 'Dashboard', 1, '0'),
	(2, NULL, 'Surat Masuk', 'fa fa-envelope', 'surat_masuk', 2, '2,10,30,40,50,60'),
	(3, NULL, 'Surat Keluar', 'fa fa-envelope-o', 'surat_keluar', 3, '2,10,30,40,50,60,70,80,90,100'),
	(4, NULL, 'Arsip', 'fa fa-book', 'arsip', 4, '70,80,90,100'),
	(6, NULL, 'Manage', 'fa fa-group', 'users', 6, '2'),
	(14, 2, 'Data Surat Masuk', '', 'surat_masuk/lihat', 1, '2,10,30,40,50,60'),
	(15, 2, 'Tambah Surat Masuk', '', 'surat_masuk/tambah', 2, '2'),
	(16, 3, 'Data Surat Keluar', '', 'surat_keluar/lihat', 1, '2,10,30,40,50,60,70,80,90,100,110,120,130,140'),
	(17, 3, 'Tambah Surat Keluar', '', 'surat_keluar/tambah', 2, '2,70,80,90,100,110,120,130,140'),
	(18, 4, 'Data Arsip', '', 'arsip/lihat', 1, '70,80,90,100,110,120,130,140'),
	(19, 4, 'Tambah Arsip', '', 'arsip/tambah', 2, '70,80,90,100,110,120,130,140'),
	(21, 6, 'Manage Users', '', 'users/lihat', 1, '2'),
	(22, 6, 'Manage Groups', '', 'groups/lihat', 2, '-1'),
	(23, NULL, 'Profile', 'fa fa-user', 'profile', 7, '0');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.ref_eselon
DROP TABLE IF EXISTS `ref_eselon`;
CREATE TABLE IF NOT EXISTS `ref_eselon` (
  `id` int(11) unsigned NOT NULL COMMENT 'Primary key (by system)',
  `kode` varchar(10) DEFAULT NULL COMMENT 'Kode Tahapan: isian bebas',
  `nama` varchar(100) NOT NULL DEFAULT '' COMMENT 'Nama Tahapan: isian bebas',
  `keterangan` varchar(255) DEFAULT NULL COMMENT 'Keterangan: isian bebas',
  `urutan` int(11) unsigned DEFAULT NULL COMMENT 'Urutan: (by system)',
  `aktif` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Status Aktif: pilihan Y=Ya; T=Tidak',
  `diedit_oleh` varchar(30) DEFAULT NULL COMMENT 'Diedit Oleh: (by system)',
  `diedit_tanggal` datetime DEFAULT NULL COMMENT 'Diedit Tanggal: (by system)',
  `diinput_oleh` varchar(30) DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `diinput_tanggal` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `diperbaharui_oleh` varchar(30) DEFAULT NULL COMMENT 'Diperbaharui Oleh: (by system)',
  `diperbaharui_tanggal` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Referensi tahapan proses perkara';

-- Dumping data for table remake_s03r4t.ref_eselon: ~14 rows (approximately)
DELETE FROM `ref_eselon`;
/*!40000 ALTER TABLE `ref_eselon` DISABLE KEYS */;
INSERT INTO `ref_eselon` (`id`, `kode`, `nama`, `keterangan`, `urutan`, `aktif`, `diedit_oleh`, `diedit_tanggal`, `diinput_oleh`, `diinput_tanggal`, `diperbaharui_oleh`, `diperbaharui_tanggal`) VALUES
	(1, 'ESELEON I', 'KETUA PENGADILAN TINGGI', NULL, 1, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'ESELON I', 'WAKIL KETUA PENGADILAN TINGGI', NULL, 2, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'ESELON II', 'PANITERA', NULL, 3, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'ESELON II', 'SEKRETARIS', NULL, 4, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'ESELEON II', 'Kepala Bagian Perencanaan Dan Kepegawaian', NULL, 5, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'ESELON III', 'Kepala Bagian Umum Dan Keuangan', NULL, 6, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'ESELON IV', 'Kepala Sub Bagian Rencana Program Dan Anggaran', NULL, 7, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'ESELON IV', 'Kepala Sub Bagian Kepegawaian Dan Teknologi Informasi', NULL, 8, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'ESELON IV', 'Kepala Sub Bagian Tatausaha Dan Rumah Tangga', NULL, 9, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'ESELON IV', 'Kepala Sub Bagian Keuangan Dan Pelaporan', NULL, 10, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'ESELON IV', 'Kepala Sub Bagian Muda Perdata', NULL, 11, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 'ESELON IV', 'Kepala Sub Bagian Muda Pidana', NULL, 12, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'ESELON IV', 'Kepala Sub Bagian Muda Tindak Pidana Korupsi', NULL, 13, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'ESELON IV', 'Kepala Sub Bagian Muda Hukum', NULL, 14, 'Y', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ref_eselon` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.ref_tahapan_proses
DROP TABLE IF EXISTS `ref_tahapan_proses`;
CREATE TABLE IF NOT EXISTS `ref_tahapan_proses` (
  `Id` int(11) unsigned NOT NULL COMMENT 'Primary key (by system)',
  `kode` varchar(10) DEFAULT NULL COMMENT 'Kode Tahapan: isian bebas',
  `nama` varchar(100) NOT NULL DEFAULT '' COMMENT 'Nama Tahapan: isian bebas',
  `keterangan` varchar(255) DEFAULT NULL COMMENT 'Keterangan: isian bebas',
  `urutan` int(11) unsigned DEFAULT NULL COMMENT 'Urutan: (by system)',
  `aktif` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Status Aktif: pilihan Y=Ya; T=Tidak',
  `diedit_oleh` varchar(30) DEFAULT NULL COMMENT 'Diedit Oleh: (by system)',
  `diedit_tanggal` datetime DEFAULT NULL COMMENT 'Diedit Tanggal: (by system)',
  `diinput_oleh` varchar(30) DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `diinput_tanggal` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `diperbaharui_oleh` varchar(30) DEFAULT NULL COMMENT 'Diperbaharui Oleh: (by system)',
  `diperbaharui_tanggal` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`Id`),
  KEY `kode` (`kode`),
  KEY `nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Referensi tahapan proses perkara';

-- Dumping data for table remake_s03r4t.ref_tahapan_proses: ~8 rows (approximately)
DELETE FROM `ref_tahapan_proses`;
/*!40000 ALTER TABLE `ref_tahapan_proses` DISABLE KEYS */;
INSERT INTO `ref_tahapan_proses` (`Id`, `kode`, `nama`, `keterangan`, `urutan`, `aktif`, `diedit_oleh`, `diedit_tanggal`, `diinput_oleh`, `diinput_tanggal`, `diperbaharui_oleh`, `diperbaharui_tanggal`) VALUES
	(1, NULL, 'Register', NULL, 1, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'Disposisi Tahap I', NULL, 2, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, 'Disposisi Tahap II', NULL, 3, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, NULL, 'Disposisi Tahap III', NULL, 4, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, NULL, 'Kembali Ke TU Untuk Distribusikan', NULL, 5, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, NULL, 'Penyerahan Ke Panmud/Kasub', NULL, 6, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(7, NULL, 'Pembuatan Instruksi Kerja', NULL, 7, 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
	(8, NULL, 'Arsip', NULL, 8, 'Y', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ref_tahapan_proses` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.surat_arsip
DROP TABLE IF EXISTS `surat_arsip`;
CREATE TABLE IF NOT EXISTS `surat_arsip` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_ruang` tinyint(4) DEFAULT NULL,
  `no_lemari` tinyint(4) DEFAULT NULL,
  `no_rak` tinyint(4) DEFAULT NULL,
  `no_berkas` int(11) DEFAULT NULL,
  `nomor_arsip` varchar(100) DEFAULT NULL,
  `tanggal_masuk_arsip` date DEFAULT NULL,
  `nama_penerima` int(10) DEFAULT NULL COMMENT 'mengacu pada user_id pada table sysusers',
  `nama_penyerah` varchar(50) DEFAULT NULL,
  `lengkap` enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` tinyint(1) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `diinput_oleh` varchar(30) DEFAULT NULL,
  `diinput_tanggal` datetime DEFAULT NULL,
  `diperbaharui_oleh` datetime DEFAULT NULL,
  `diperbaharui_tanggal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_arsip` (`nomor_arsip`),
  KEY `FK_surat_arsip_sys_box_name` (`no_berkas`),
  KEY `FK_surat_arsip_sys_users` (`nama_penerima`),
  CONSTRAINT `FK_surat_arsip_sys_box_name` FOREIGN KEY (`no_berkas`) REFERENCES `sys_box_name` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_surat_arsip_sys_users` FOREIGN KEY (`nama_penerima`) REFERENCES `sys_users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table remake_s03r4t.surat_arsip: ~3 rows (approximately)
DELETE FROM `surat_arsip`;
/*!40000 ALTER TABLE `surat_arsip` DISABLE KEYS */;
INSERT INTO `surat_arsip` (`id`, `no_ruang`, `no_lemari`, `no_rak`, `no_berkas`, `nomor_arsip`, `tanggal_masuk_arsip`, `nama_penerima`, `nama_penyerah`, `lengkap`, `status`, `keterangan`, `diinput_oleh`, `diinput_tanggal`, `diperbaharui_oleh`, `diperbaharui_tanggal`) VALUES
	(8, 1, 1, 1, 1, '4', '2017-05-17', 1, '213', 'Y', 1, ' 1', 'administrator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2017-05-17 14:38:15'),
	(10, 1, 1, 1, 1, '1231231212', '2017-05-17', 1, 'qweq', 'Y', 1, ' ', 'administrator', '2017-05-17 14:29:23', '0000-00-00 00:00:00', '2017-05-17 14:36:36');
/*!40000 ALTER TABLE `surat_arsip` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.surat_disposisi
DROP TABLE IF EXISTS `surat_disposisi`;
CREATE TABLE IF NOT EXISTS `surat_disposisi` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id table disposisi',
  `id_surat_masuk` int(10) NOT NULL COMMENT 'mengacu pada table surat masuk id_surat_masuk',
  `tahapan_disposisi` int(10) DEFAULT NULL COMMENT '1:ketua/wakil,2:panitera/sekrataris,3:kabag,4:kasubab',
  `disposisi_dari_id` int(10) DEFAULT NULL COMMENT 'pemberi disposisi (id user)',
  `disposisi_dari_text` varchar(50) DEFAULT NULL COMMENT 'Pemberi disposisi Jabatan',
  `disposisi_ke_id` int(10) DEFAULT NULL COMMENT 'penerima disposisi (id user)',
  `disposisi_ke_text` varchar(50) DEFAULT NULL COMMENT 'penerima disposisi (jabatan)',
  `tanggal_disposisi` datetime DEFAULT NULL COMMENT 'tanggal disposisi',
  `isi_disposisi` varchar(50) DEFAULT NULL COMMENT 'isi disposisi',
  `created_by` varchar(50) DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `created_on` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `modified_by` varchar(30) DEFAULT NULL COMMENT 'Diperbaharui oleh: (by system)',
  `modified_on` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_surat_masuk_tahapan_disposisi` (`id_surat_masuk`,`tahapan_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.surat_disposisi: ~4 rows (approximately)
DELETE FROM `surat_disposisi`;
/*!40000 ALTER TABLE `surat_disposisi` DISABLE KEYS */;
INSERT INTO `surat_disposisi` (`id`, `id_surat_masuk`, `tahapan_disposisi`, `disposisi_dari_id`, `disposisi_dari_text`, `disposisi_ke_id`, `disposisi_ke_text`, `tanggal_disposisi`, `isi_disposisi`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
	(7, 17, 1, 2, 'Ketua/Wakil Ketua Pengadilan Tinggi', 0, '', '2017-05-20 00:00:00', 'cececececece', 'ketua', '2017-05-20 19:17:22', NULL, NULL),
	(8, 17, 2, 4, 'Sekretaris', 0, '', '2017-05-20 20:35:11', 'jangan dimakan', 'sekretaris', '2017-05-20 20:35:11', NULL, NULL),
	(9, 17, 3, 5, 'Kabag Umum Dan Keuangan', 0, '', '2017-05-20 21:28:43', 'selamatkan bumi dari dunia', 'umum', '2017-05-20 21:28:43', NULL, NULL),
	(10, 19, 1, 2, 'Ketua/Wakil Ketua Pengadilan Tinggi', 0, '', '2017-05-20 21:32:45', 'asdasdsad', 'ketua', '2017-05-20 21:32:45', NULL, NULL);
/*!40000 ALTER TABLE `surat_disposisi` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.surat_keluar
DROP TABLE IF EXISTS `surat_keluar`;
CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `id_surat_keluar` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id surat keluar auto inc',
  `no_surat_keluar` int(10) NOT NULL COMMENT 'nomorsurat keluar',
  `jenis_surat_keluar_id` int(3) NOT NULL COMMENT '1:surat keluar biasa, 2:surat internal (contoh SK)',
  `tgl_surat` date NOT NULL COMMENT 'tanggal surat masuk',
  `tujuan_id` int(11) DEFAULT NULL COMMENT '1:internal,2:lain-lain',
  `tujuan_text` varchar(50) DEFAULT NULL COMMENT 'surat ditujukan kepada',
  `perihal` varchar(50) DEFAULT NULL COMMENT 'perihal surat',
  `file` varchar(50) NOT NULL COMMENT 'nama file setelah discan, autogenerate name',
  `path_file` varbinary(255) DEFAULT NULL COMMENT 'nama folder penyimpanan',
  `dikirim_via` varchar(30) DEFAULT NULL COMMENT '1:POS,2:Expedisi Nasional, 3:Fax, 4:Email, 5:Expedisi Personal',
  `no_resi_pengiriman` varchar(50) DEFAULT NULL COMMENT 'nomor resi pengiriman',
  `tanggal_pengiriman` date DEFAULT NULL,
  `catatan_tambahan` varchar(100) DEFAULT NULL,
  `status_surat_id` int(11) DEFAULT NULL COMMENT 'mengacu pada id ref_tahapan_proses',
  `status_surat` varchar(50) DEFAULT NULL COMMENT 'mengacu pada nama ref_tahapan_proses',
  `pembuat_surat_id` int(10) NOT NULL COMMENT '1:Panitera Muda Perdata, 2:Panitera Muda Pidana, 3:Panitera Muda Tipikor, 4:Panitera Mudah Hukum, 5:Kepegawaian, 6:Perencanaan, 7:Keuangan, 8:Umum;',
  `pembuat_surat_text` varchar(30) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL COMMENT 'Diinput Oleh: (username)',
  `created_on` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `modified_by` varchar(30) DEFAULT NULL COMMENT 'Diperbaharui oleh: (username)',
  `modified_on` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id_surat_keluar`),
  UNIQUE KEY `no_surat_keluar` (`no_surat_keluar`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.surat_keluar: ~7 rows (approximately)
DELETE FROM `surat_keluar`;
/*!40000 ALTER TABLE `surat_keluar` DISABLE KEYS */;
INSERT INTO `surat_keluar` (`id_surat_keluar`, `no_surat_keluar`, `jenis_surat_keluar_id`, `tgl_surat`, `tujuan_id`, `tujuan_text`, `perihal`, `file`, `path_file`, `dikirim_via`, `no_resi_pengiriman`, `tanggal_pengiriman`, `catatan_tambahan`, `status_surat_id`, `status_surat`, `pembuat_surat_id`, `pembuat_surat_text`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
	(2, 2, 1, '2222-02-02', 1, 'Internal', '2', '', _binary '', '1', '2', '0000-00-00', NULL, NULL, NULL, 2, '22', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
	(7, 1231, 1, '2017-01-01', 1, 'Internal', '2112', '', _binary '', '1', '21312312', '2018-10-01', NULL, NULL, 'Register', 21, '211', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
	(8, 111, 1, '2019-01-01', 1, 'Internal', '2', '09221cddbb9a2913542c03c29f0a83b4.pdf', _binary '', '1', '2', '2019-01-01', NULL, 1, 'Register', 2, '2', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
	(9, 1, 1, '2017-05-17', 1, 'Internal', '123', 'b55259a42d718cb5fae6d7e01367de60.pdf', _binary '', '1', '123', '2017-05-17', NULL, 1, 'Register', 123, '123', 'administrator', '2017-05-17 14:49:24', 'administrator', '2017-05-17 14:51:55'),
	(10, 1222, 1, '2017-05-17', 1, 'Internal', '2131', '', _binary '', '1', '1231', '2017-05-17', NULL, 1, 'Register', 1231, '12312', 'administrator', '2017-05-17 18:23:21', 'administrator', '2017-05-17 20:04:42'),
	(11, 12312, 1, '2017-05-17', 1, 'Internal', '131', '', _binary '', '1', '12312', '2017-05-17', NULL, 1, 'Register', 13, '1231', 'administrator', '2017-05-17 19:55:03', NULL, NULL),
	(15, 1231322, 1, '2017-05-17', 1, 'Internal', '12313', '', _binary '', '1', '2311', '2017-05-17', NULL, 1, 'Register', 1, 'administrator', 'administrator', '2017-05-17 20:04:24', NULL, NULL);
/*!40000 ALTER TABLE `surat_keluar` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.surat_masuk
DROP TABLE IF EXISTS `surat_masuk`;
CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id_surat_masuk` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id surat masuk auto inc',
  `no_lembar_disposisi` varchar(50) NOT NULL COMMENT 'nomor lemar disposisi',
  `tgl_masuk` date NOT NULL COMMENT 'tanggal surat masuk',
  `tujuan_id` int(11) DEFAULT NULL COMMENT '1:utama,2:tembusan',
  `tujuan_text` varchar(50) DEFAULT NULL COMMENT 'surat ditujukan kepada',
  `pengirim` varchar(50) DEFAULT NULL COMMENT 'pengirim surat (dari)',
  `perihal` varchar(50) DEFAULT NULL COMMENT 'perihal surat',
  `file` varchar(50) NOT NULL COMMENT 'nama file setelah discan, autogenerate name',
  `status_id` int(10) DEFAULT NULL COMMENT 'mengacu pada id ref_tahapan_proses',
  `status_text` varchar(50) DEFAULT NULL COMMENT 'mengacu pada nama ref_tahapan_proses',
  `disposisi_terakhir_text` varchar(50) DEFAULT NULL COMMENT 'mengacu pada table disposisi field dipsoisi terakhir',
  `disposisi_tujuan_id` int(10) DEFAULT NULL COMMENT 'mengacu pada bagian_id pada table eselon IV',
  `catatan_tambahan` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `created_by` varchar(50) DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `modified_by` varchar(30) DEFAULT NULL COMMENT 'Diperbaharui oleh: (by system)',
  `modified_on` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id_surat_masuk`),
  UNIQUE KEY `no_lembar_disposisi` (`no_lembar_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.surat_masuk: ~2 rows (approximately)
DELETE FROM `surat_masuk`;
/*!40000 ALTER TABLE `surat_masuk` DISABLE KEYS */;
INSERT INTO `surat_masuk` (`id_surat_masuk`, `no_lembar_disposisi`, `tgl_masuk`, `tujuan_id`, `tujuan_text`, `pengirim`, `perihal`, `file`, `status_id`, `status_text`, `disposisi_terakhir_text`, `disposisi_tujuan_id`, `catatan_tambahan`, `created_on`, `created_by`, `modified_by`, `modified_on`) VALUES
	(17, '1', '2017-10-10', 1, 'Utama', '121', '1', '', 4, 'Disposisi Tahap III', 'selamatkan bumi dari dunia', 7, ' 1', '0000-00-00 00:00:00', '1', '1', '0000-00-00 00:00:00'),
	(19, '2342324', '2017-05-20', 1, 'Utama', 'eweqrwqe', 'qwerwq', '', 2, 'Disposisi Tahap I', 'asdasdsad', 7, ' wqrwq', '2017-05-20 21:32:02', 'administrator', NULL, NULL);
/*!40000 ALTER TABLE `surat_masuk` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.surat_proses
DROP TABLE IF EXISTS `surat_proses`;
CREATE TABLE IF NOT EXISTS `surat_proses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `surat_id` int(10) unsigned NOT NULL COMMENT 'Id Perkara: merujuk ke tabel surat masuk kolom id surat masuk (by system)',
  `tahapan_id` int(11) DEFAULT NULL COMMENT 'Id Tahapan proses: merujuk ke tabel tahapan_proses kolom tahapan_id(by system',
  `tahapan_nama` varchar(50) DEFAULT NULL COMMENT 'Nama Tahapan Proses: merujuk ke tabel tahapan_proses kolom nama (by system)',
  `proses_id` int(11) unsigned NOT NULL COMMENT 'Id Proses: merujuk ke tabel proses kolom id (by system)',
  `proses_nama` varchar(100) DEFAULT NULL COMMENT 'Nama Proses : merujuk ke tabel proses kolom nama (by system)',
  `tanggal` datetime DEFAULT NULL COMMENT 'Tanggal Proses: (by system)',
  `keterangan` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Keterangan: (by system)',
  `urutan` int(11) unsigned NOT NULL COMMENT 'Urutan proses(by system)',
  `diinput_oleh` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `diinput_tanggal` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `diperbaharui_oleh` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Diperbaharui Oleh: (by system)',
  `diperbaharui_tanggal` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Data Riwayat Proses Perkara(generate by system)';

-- Dumping data for table remake_s03r4t.surat_proses: ~4 rows (approximately)
DELETE FROM `surat_proses`;
/*!40000 ALTER TABLE `surat_proses` DISABLE KEYS */;
INSERT INTO `surat_proses` (`id`, `surat_id`, `tahapan_id`, `tahapan_nama`, `proses_id`, `proses_nama`, `tanggal`, `keterangan`, `urutan`, `diinput_oleh`, `diinput_tanggal`, `diperbaharui_oleh`, `diperbaharui_tanggal`) VALUES
	(5, 17, NULL, NULL, 2, 'Disposisi Tahap I', '2017-05-20 19:17:22', NULL, 0, 'ketua', '2017-05-20 19:17:22', NULL, NULL),
	(6, 17, NULL, NULL, 3, 'Disposisi Tahap II', '2017-05-20 20:35:11', NULL, 0, 'sekretaris', '2017-05-20 20:35:11', NULL, NULL),
	(7, 17, NULL, NULL, 4, 'Disposisi Tahap III', '2017-05-20 21:28:43', NULL, 0, 'umum', '2017-05-20 21:28:43', NULL, NULL),
	(8, 19, NULL, NULL, 2, 'Disposisi Tahap I', '2017-05-20 21:32:45', NULL, 0, 'ketua', '2017-05-20 21:32:45', NULL, NULL);
/*!40000 ALTER TABLE `surat_proses` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_audittrail
DROP TABLE IF EXISTS `sys_audittrail`;
CREATE TABLE IF NOT EXISTS `sys_audittrail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key: (by system)',
  `datetime` datetime NOT NULL COMMENT 'Waktu Aktifitas: (by system)',
  `ipaddress` varchar(15) NOT NULL DEFAULT '' COMMENT 'Alamat IP: (by system)',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT 'Username: (by system)',
  `tablename` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nama Tabel: (by system)',
  `formname` varchar(250) DEFAULT '' COMMENT 'Nama Form Aplikasi: (by system)',
  `action` varchar(250) NOT NULL DEFAULT '' COMMENT 'Aktifitas: (by system)',
  `title` varchar(250) NOT NULL DEFAULT '' COMMENT 'Keterangan Aktifitas: (by system)',
  `description` longtext COMMENT 'Informasi detil Aktifitas: (by system)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Data Audittrail';

-- Dumping data for table remake_s03r4t.sys_audittrail: ~0 rows (approximately)
DELETE FROM `sys_audittrail`;
/*!40000 ALTER TABLE `sys_audittrail` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_audittrail` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_box_name
DROP TABLE IF EXISTS `sys_box_name`;
CREATE TABLE IF NOT EXISTS `sys_box_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_box` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='untuk keperluan no_berkas pada surat arsip';

-- Dumping data for table remake_s03r4t.sys_box_name: ~2 rows (approximately)
DELETE FROM `sys_box_name`;
/*!40000 ALTER TABLE `sys_box_name` DISABLE KEYS */;
INSERT INTO `sys_box_name` (`id`, `nama_box`) VALUES
	(1, 'Box Cuti'),
	(2, 'Box Laporan');
/*!40000 ALTER TABLE `sys_box_name` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_config
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE IF NOT EXISTS `sys_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primari Key',
  `category` varchar(50) NOT NULL DEFAULT 'System' COMMENT 'Kategori Konfigurasi',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nama Konfigurasi',
  `value` varchar(255) DEFAULT NULL,
  `ordering` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Urutan',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1 COMMENT='Data Konfigurasi Sistem';

-- Dumping data for table remake_s03r4t.sys_config: ~77 rows (approximately)
DELETE FROM `sys_config`;
/*!40000 ALTER TABLE `sys_config` DISABLE KEYS */;
INSERT INTO `sys_config` (`id`, `category`, `name`, `value`, `ordering`) VALUES
	(1, 'Site', 'OfflineMessage', '<p>Situs ini sedang dalam perbaikan.<br />Silahkan periksa kembali beberapa saat lagi.</p>', 7),
	(2, 'Site', 'ContentRight', 'asdasd', 6),
	(3, 'Site', 'MetaDescription', 'Surat', 5),
	(4, 'Site', 'MetaKeyWords', 'Surat', 4),
	(5, 'Site', 'SiteName', 'Sistem Informasi Penelusuran Perkara', 2),
	(6, 'Site', 'SiteOffline', '0', 3),
	(7, 'Site', 'SiteTitle', 'Sistem Informasi Persuratan & Kearsipan', 1),
	(8, 'System', 'SessionTimeOut', '360', 1),
	(12, 'System', 'BlockSizePacket', '65536', 4),
	(13, 'System', 'TrackFailedAttempts', '1', 5),
	(14, 'System', 'MaximumFailedAttempts', '5', 6),
	(15, 'System', 'FailedAttempsTime', '15', 7),
	(16, 'System', 'AllowConcurentLogin', '1', 8),
	(17, 'System', 'OverrideSessionLogin', '1', 9),
	(18, 'System', 'EnableAuditTrail', '1', 10),
	(19, 'System', 'EnableRecordLocking', '1', 11),
	(20, 'System', 'EnableResetPassword', '1', 12),
	(21, 'System', 'UserMustChangePassword', '1', 13),
	(22, 'System', 'EnableChangePassword', '1', 14),
	(23, 'System', 'PasswordExpired', '0', 15),
	(24, 'System', 'PasswordExpiredReminder', '0', 16),
	(25, 'System', 'CountSaveOldPassword', '10', 17),
	(26, 'System', 'MaxFileUploads', '2097152', 18),
	(27, 'EMAIL', 'SMTP_Server', '127.0.0.1', 1),
	(28, 'EMAIL', 'SMTP_Port', '25', 2),
	(29, 'EMAIL', 'SMTP_User', '', 3),
	(30, 'EMAIL', 'SMTP_Password', '', 4),
	(31, 'EMAIL', 'SMTP_Email', '', 5),
	(32, 'EMAIL', 'PROXY_Server', '', 6),
	(33, 'EMAIL', 'PROXY_Gateway', '', 7),
	(34, 'EMAIL', 'PROXY_User', '', 8),
	(35, 'EMAIL', 'PROXY_Password', '', 9),
	(36, 'EMAIL', 'Email_ConfirmNewUser', '<p><strong>#FULLNAME#</strong>,</p>\r\n<p>Anda telah terdaftar sebagai user(pengguna) pada aplikasi <strong>#SITENAME#</strong> dengan alamat <strong>#SITEADDRESS#</strong> .</p>\r\n<p>Untuk mengaktifkannya silahkan kunjungi alamat <strong>#LINKACTIVATION#&lt', 10),
	(37, 'EMAIL', 'Email_ChangePassword', '<div><strong>#FULLNAME#</strong>,</div>\r\n<div>Berikut ini adalah informasi perubahan password user(pengguna) pada aplikasi <strong>#SITENAME#</strong></div>\r\n<div>Untuk login ke aplikasi silahkan kunjungi alamat #LINKLOGIN# kemudian masukan username dan p', 11),
	(38, 'Site', 'SiteAddress', 'http://server/cts', 8),
	(39, 'EMAIL', 'Email_InfoLogin', '<div><strong>#FULLNAME#</strong>,</div>\r\n<div>Anda telah berhasil melakukan aktivasi sebagai user(pengguna) pada aplikasi <strong>#SITENAME#</strong></div>\r\n<div>Untuk login ke aplikasi silahkan kunjungi alamat <strong>#SITEADDRESS#</strong> kemudian masu', 12),
	(40, 'EMAIL', 'Email_BlockUser', '<div><strong>#FULLNAME#</strong>,</div>\r\n<div>User anda pada aplikasi <strong>#SITENAME#</strong> dengan username <strong>#USERNAME#</strong> telah dinonaktifkan oleh Administrator&nbsp;</div>\r\n<div>Email ini hanya pemberitahuan, Anda tidak perlu membalas', 13),
	(41, 'EMAIL', 'Email_UnBlockUser', '<div><strong>#FULLNAME#</strong>,</div>\r\n<div>User Anda pada aplikasi <strong>#SITENAME#</strong> telah diaktifkan kembali.</div>\r\n<div>Untuk login ke aplikasi silahkan kunjungi alamat <strong>#LINKLOGIN#</strong> kemudian masukan username dan password di', 14),
	(42, 'EMAIL', 'Email_ForgotPassword', '<p><strong>#FULLNAME#</strong>,<br />Anda/orang lain telah&nbsp; meminta password Anda apada aplikasi <strong>#SITENAME#</strong> yang dikirim kepada Anda melalui<br />email. Untuk alasan keamanan, kami telah menciptakan sebuah sandi acak yang baru<br />u', 15),
	(43, 'EMAIL', 'Email_InfoNewUser', '<div><strong>#FULLNAME#</strong>,</div>\r\n<div>Anda telah terdaftar sebagai user(pengguna) pada aplikasi <strong>#SITENAME#</strong> dengan alamat <strong>#SITEADDRESS#</strong> .</div>\r\n<div>Untuk login ke aplikasi silahkan kunjungi alamat <strong>#LINKLO', 16),
	(48, 'System', 'MaxBannerUpload', '256000', 19),
	(49, 'System', 'MaxPhotoUpload', '1048576', 20),
	(50, 'LCD', 'ToleranceOnTime', '15', 21),
	(51, 'LCD', 'FIDSAutoRefresh', '30', 22),
	(52, 'LCD', 'WebAutoRefresh', '15', 0),
	(53, 'LCD', 'PathSynchronization', 'C:\\Sinkronisasi\\CTS2_PN', 23),
	(54, 'LCD', 'BannerAutoRefresh', '300', 24),
	(55, 'LCD', 'NewsAutoRefresh', '120', 25),
	(57, 'LCD', 'NewsRunningTextSpeed', '3', 26),
	(58, 'LCD', 'PathSJA', 'C:\\Program Files\\SQLyog\\SJA.exe', 27),
	(61, 'Site', 'KodePN', 'PBR', 22),
	(62, 'Site', 'NamaPN', 'PENGADILAN TINGGI PEKANBARU', 23),
	(63, 'Site', 'AlamatPN', 'Jalan Jend. Sudirman No. 315, Pekanbaru, Riau, Telp (0761) 21523 Fax. 21523', 24),
	(64, 'Site', 'KetuaPNNama', 'I PUTU WIDNYA,SH.,MH.', 25),
	(65, 'Site', 'KetuaPNNIP', '195004121979111', 26),
	(66, 'Site', 'WakilKetuaPNNama', 'SYAFRULLAH SUMAR,SH,MH', 27),
	(67, 'Site', 'WakilKetuaPNNIP', '195402211984031003', 28),
	(68, 'Site', 'PanSekNama', 'Hj. MERI ULFA,SH,MH.', 29),
	(69, 'Site', 'PanSekNIP', '195703011985032', 30),
	(70, 'Site', 'WaPanNama', 'xxxxx', 31),
	(71, 'Site', 'WaPanNIP', '195402211984031003', 32),
	(72, 'Site', 'WaSekNama', 'MAIYEFI, SE,M.SI.', 33),
	(73, 'Site', 'WaSekNIP', '196105051983032', 34),
	(74, 'LCD', 'LCDAutoRefresh', '0', 28),
	(75, 'Site', 'ZonaWaktu', 'WIB/WIT/WITA', 35),
	(76, 'Site', 'NamaPT', 'PENGADILAN TINGGI PEKANBARU', 36),
	(77, 'Site', 'AlamatPT', 'Jalan Jend. Sudirman No. 315, Pekanbaru, Riau, Telp (0761) 21523 Fax. 21523', 37),
	(78, 'Site', 'UmurDewasa', '17', 38),
	(80, 'system', 'app_version', '3.1.3', 21),
	(81, 'site', 'IDPN', '0', 0),
	(82, 'site', 'kode_satker', NULL, 0),
	(83, 'System', 'jenis_pengadilan', '5', 0),
	(84, 'Site', 'PangkatKetua', '', 0),
	(85, 'System', 'pangkat_wakil_ketua', '', 0),
	(86, 'System', 'pangkat_panitera', '', 0),
	(87, 'System', 'pangkat_wakil_panitera', '', 0),
	(88, 'Site', 'IDBanding', '4', 0);
/*!40000 ALTER TABLE `sys_config` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_forms
DROP TABLE IF EXISTS `sys_forms`;
CREATE TABLE IF NOT EXISTS `sys_forms` (
  `name` varchar(150) NOT NULL DEFAULT '' COMMENT 'Nama Form Aplikasi',
  `description` varchar(255) DEFAULT NULL COMMENT 'Keterangan',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Data form aplikasi';

-- Dumping data for table remake_s03r4t.sys_forms: ~0 rows (approximately)
DELETE FROM `sys_forms`;
/*!40000 ALTER TABLE `sys_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_forms` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_groups
DROP TABLE IF EXISTS `sys_groups`;
CREATE TABLE IF NOT EXISTS `sys_groups` (
  `id` int(11) NOT NULL COMMENT 'Primary Key: (by system)',
  `parent_id` int(11) DEFAULT NULL COMMENT 'Grup induk: merujuk ke tabel sys_groups kolom groupid',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Level tree (by system)',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set left:(by system)',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set right:(by system)',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Nama Grup: isian bebas',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT 'Keterangan: isian bebas',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Aktif: pilihan 1=Ya; 0=Tidak',
  `ordering` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Urutan Grup Per Induknya',
  `lock_by` varchar(30) NOT NULL DEFAULT '' COMMENT 'Diedit Oleh: (by system)',
  `lock_on` datetime DEFAULT NULL COMMENT 'Diedit Tanggal: (by system)',
  `created_by` varchar(30) DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `created_on` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `modified_by` varchar(30) DEFAULT NULL COMMENT 'Diperbaharui Oleh: (by system)',
  `modified_on` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_groups_parent_title_lookup` (`parent_id`,`name`),
  KEY `idx_groups_title_lookup` (`name`),
  KEY `idx_groups_adjacency_lookup` (`parent_id`),
  KEY `level` (`level`),
  KEY `ordering` (`ordering`),
  KEY `idx_groups_nested_set_lookup` (`lft`,`rgt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Data Grup User aplikasi';

-- Dumping data for table remake_s03r4t.sys_groups: ~23 rows (approximately)
DELETE FROM `sys_groups`;
/*!40000 ALTER TABLE `sys_groups` DISABLE KEYS */;
INSERT INTO `sys_groups` (`id`, `parent_id`, `level`, `lft`, `rgt`, `name`, `description`, `enable`, `ordering`, `lock_by`, `lock_on`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
	(2, 1, 2, 3, 92, 'Administrator', 'Administrator', 1, 1, 'admin', '2015-11-09 06:43:40', NULL, NULL, 'admin', '2015-10-22 09:07:14'),
	(10, 2, 3, 4, 91, 'Ketua/Wakil Ketua Pengadilan Tinggi', 'Ketua/Wakil Ketua Pengadilan Tinggi', 1, 1, '', NULL, NULL, NULL, 'system', '2015-12-16 05:57:00'),
	(20, 10, 4, 5, 6, 'Hakim', 'Hakim', 1, 1, 'taufik', '2012-12-20 04:42:55', 'system', '2012-03-09 01:16:47', 'system', '2012-11-15 16:13:24'),
	(30, 10, 4, 7, 90, 'Panitera', 'Panitera ', 1, 2, '', NULL, 'system', '2012-03-09 01:17:18', 'system', '2012-11-24 11:47:00'),
	(40, 10, 4, 10, 100, 'Sekretaris', 'Sekretaris Pengadilan Tinggi Pekanbaru', 1, 0, 'system', NULL, 'system', '2017-04-03 09:36:12', NULL, NULL),
	(50, 10, 4, 10, 101, 'Kabag Perencanaan Dan Kepegawaian', 'Kepala Bagian Perencanaan Dan Kepegawaian', 1, 0, '', NULL, NULL, NULL, NULL, NULL),
	(60, 10, 4, 10, 102, 'Kabag Umum Dan Keuangan', 'Kepala Bagian Umum Dan Keuangan', 1, 0, '', NULL, NULL, NULL, NULL, NULL),
	(70, 10, 4, 10, 103, 'Kasubbag Rencana Program Dan Anggaran', 'Kepala Sub Bagian Rencana Program Dan Anggaran', 1, 0, '', NULL, NULL, NULL, NULL, NULL),
	(80, 10, 4, 10, 104, 'Kasubbag Kepegawaian Dan Teknologi Informasi', 'Kepala Sub Bagian Kepegawaian Dan Teknologi Informasi', 1, 0, '', NULL, NULL, NULL, NULL, NULL),
	(90, 10, 4, 10, 105, 'Kasubbag Tatausaha Dan Rumah Tangga', 'Kepala Sub Bagian Tatausaha Dan Rumah Tangga', 1, 0, '', NULL, NULL, NULL, NULL, NULL),
	(100, 10, 4, 10, 106, 'Kasubbag Keuangan Dan Pelaporan', 'Kepala Sub Bagian Keuangan Dan Pelaporan', 1, 0, '', NULL, NULL, NULL, NULL, NULL),
	(110, 30, 5, 8, 17, 'Panitera Muda Perdata', 'Panitera Muda Perdata', 1, 1, 'admin', '2012-11-16 17:49:15', 'system', '2012-03-09 01:17:29', 'system', '2012-11-15 20:05:04'),
	(111, 410, 6, 9, 10, 'Staf Panitera Perdata', 'Staf Panitera Perdata', 1, 1, '', NULL, 'admin', '2012-07-11 14:58:44', 'system', '2012-11-15 20:42:50'),
	(120, 30, 5, 18, 25, 'Panitera Muda Pidana', 'Panitera Muda Pidana', 1, 2, '', NULL, 'system', '2012-03-09 01:17:41', 'system', '2012-11-15 20:06:19'),
	(121, 420, 6, 19, 20, 'Staf Panitera Pidana', 'Staf Panitera Pidana', 1, 1, '', NULL, 'admin', '2012-07-11 14:59:25', 'admin', '2012-11-15 20:08:27'),
	(130, 30, 5, 26, 29, 'Panitera Muda Hukum', 'Panitera Muda Hukum', 1, 3, '', NULL, 'system', '2012-03-09 01:18:29', 'system', '2012-11-15 20:13:10'),
	(131, 430, 6, 27, 28, 'Staf Panitera Hukum', 'Staf Panitera Hukum', 1, 1, '', NULL, 'system', '2012-07-11 15:04:20', 'system', '2012-11-15 19:33:04'),
	(140, 30, 5, 46, 53, 'Panitera Muda Pidana Khusus Tipikor', 'Panitera Muda Pidana Khusus Tipikor', 1, 6, '', NULL, 'system', '2012-06-03 20:46:16', 'admin', '2012-11-15 20:41:49'),
	(141, 460, 6, 47, 48, 'Staf Panitera Pidana Khusus Tipikor', 'Staf Panitera Pidana Khusus Tipikor', 1, 1, '', NULL, 'system', '2012-07-11 15:07:00', 'system', '2012-11-15 20:41:17'),
	(150, 30, 5, 70, 71, 'Panitera Pengganti', 'Panitera Pengganti', 1, 9, 'admin', '2015-10-26 07:52:18', 'system', '2012-07-11 15:08:09', 'system', '2015-07-07 08:46:14'),
	(200, 800, 6, 83, 84, 'Informasi', 'Meja Informasi', 1, 2, '', NULL, 'system', '2012-08-30 10:03:28', '', '2012-09-05 18:32:05');
/*!40000 ALTER TABLE `sys_groups` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_menus
DROP TABLE IF EXISTS `sys_menus`;
CREATE TABLE IF NOT EXISTS `sys_menus` (
  `id` int(11) unsigned NOT NULL COMMENT 'Primary Key: (by system)',
  `menutype` varchar(24) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'Type Menu: merujuk ke tabel sys_menu_type kolom menutype',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT 'Induk Menu: merujuk ke tabel sys_menus kolom id (tree)',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Level: (by system)',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft: (by system)',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt: (by system)',
  `title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'Judul Menu: isian text bebas',
  `language` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Bahasa: (by system)',
  `link` varchar(1024) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'Link: isian bebas',
  `params` text CHARACTER SET utf8 NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `target` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `access` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'The image of the menu item.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `lock_by` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Diedit Oleh: (by system)',
  `lock_on` datetime DEFAULT NULL COMMENT 'Diedit Tanggal: (by system)',
  `created_by` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `created_on` datetime DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `modified_by` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Diperbaharui Oleh: (by system)',
  `modified_on` datetime DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `parent_id` (`parent_id`,`title`),
  KEY `menutype` (`menutype`),
  KEY `parent_id_2` (`parent_id`),
  KEY `level` (`level`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `ordering` (`ordering`),
  KEY `published` (`published`),
  KEY `idx_menus_nested_set_lookup` (`lft`,`rgt`),
  CONSTRAINT `sys_menus_fk` FOREIGN KEY (`menutype`) REFERENCES `sys_menu_type` (`menutype`) ON UPDATE CASCADE,
  CONSTRAINT `sys_menus_fk1` FOREIGN KEY (`parent_id`) REFERENCES `sys_menus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=378 COMMENT='Data Menu Aplikasi';

-- Dumping data for table remake_s03r4t.sys_menus: ~0 rows (approximately)
DELETE FROM `sys_menus`;
/*!40000 ALTER TABLE `sys_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_menus` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_pesan
DROP TABLE IF EXISTS `sys_pesan`;
CREATE TABLE IF NOT EXISTS `sys_pesan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `dari_userid` int(11) DEFAULT NULL,
  `ke_userid` varchar(1000) DEFAULT NULL,
  `subjek` varchar(250) DEFAULT NULL,
  `isi_pesan` text,
  `tanggal_kirim` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'Satatus Pesan : -1: Hapus, 0=Draft,1=Kirim',
  `diinput_oleh` varchar(30) DEFAULT NULL,
  `diinput_tanggal` datetime DEFAULT NULL,
  `diperbaharui_tanggal` datetime DEFAULT NULL,
  `diperbaharui_oleh` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dari_userid` (`dari_userid`),
  KEY `tanggal_kirim` (`tanggal_kirim`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table remake_s03r4t.sys_pesan: ~0 rows (approximately)
DELETE FROM `sys_pesan`;
/*!40000 ALTER TABLE `sys_pesan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_pesan` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_users
DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'UserId: (by system)',
  `ip_address` varchar(45) NOT NULL DEFAULT '0' COMMENT 'bawaan Ion Auth',
  `fullname` varchar(255) NOT NULL DEFAULT '' COMMENT 'Nama Lengkap: isian bebas',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT 'Nama User: isian bebas',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT 'Password: sudah di-encript',
  `salt` varchar(100) NOT NULL DEFAULT '' COMMENT 'bawaan Ion Auth',
  `old_password` varchar(400) NOT NULL DEFAULT '' COMMENT 'Password Lama: menggunakan separator semicolon (by system)',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'Alamat Email: format email',
  `activation_code` varchar(40) DEFAULT '' COMMENT 'bawaan Ion Auth',
  `forgotten_password_code` varchar(40) DEFAULT '' COMMENT 'bawaan Ion Auth',
  `forgotten_password_time` int(11) DEFAULT NULL COMMENT 'bawaan Ion Auth',
  `remember_code` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT 'bawaan Ion Auth',
  `first_name` varchar(50) DEFAULT '' COMMENT 'bawaan Ion Auth',
  `last_name` varchar(50) DEFAULT '' COMMENT 'bawaan Ion Auth',
  `company` varchar(100) DEFAULT '' COMMENT 'bawaan Ion Auth',
  `phone` varchar(20) DEFAULT '' COMMENT 'bawaan Ion Auth',
  `alternative_email` varchar(255) NOT NULL DEFAULT '' COMMENT 'Alamat Email Alternatif: menggunakan separator semicolon',
  `allow_concurrent_login` tinyint(1) NOT NULL DEFAULT '-1' COMMENT 'Diperbolehkan Login Bersamaan: Pilihan (-1=global; 0=single login 1=multiple login)',
  `has_change_password` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Sudah Ganti Password: 0=belum 1=sudah (by system)',
  `enable_change_password` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Diperbolehkan Ganti Password: pilihan 0=Tidak; 1=Ya',
  `last_change_password` datetime DEFAULT NULL COMMENT 'Waktu Terakhir Ganti Password: (by system)',
  `password_expired_remainder` int(11) NOT NULL DEFAULT '-1' COMMENT 'Pengingat Password Kadaluarsa: Pilihan \r\n(-1=ikut ke global konfigurasi)',
  `attemp_count` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah Kesalahan Password',
  `attemp_time` datetime DEFAULT NULL COMMENT 'Waktu Terakhir Kesalahan Password',
  `user_expired` datetime DEFAULT NULL COMMENT 'Waktu Kadaluarsa User: isian tanggal',
  `last_login` int(11) DEFAULT NULL COMMENT 'Tanggal Terakhir Login: (by system)',
  `block` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Blok User: pilihan 0=Tidak; 1=ya',
  `code_activation` varchar(100) DEFAULT NULL COMMENT 'kode aktivasi',
  `params` text NOT NULL COMMENT 'parameter lain',
  `lock_by` varchar(30) NOT NULL DEFAULT '' COMMENT 'Diedit Oleh: (by system)',
  `lock_on` datetime DEFAULT NULL COMMENT 'Diedit Tanggal: (by system)',
  `created_by` varchar(30) DEFAULT NULL COMMENT 'Diinput Oleh: (by system)',
  `created_on` int(11) DEFAULT NULL COMMENT 'Diinput Tanggal: (by system)',
  `modified_by` varchar(50) DEFAULT NULL COMMENT 'Diperbaharui oleh: (by system)',
  `modified_on` int(11) DEFAULT NULL COMMENT 'Diperbaharui Tanggal: (by system)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=372 COMMENT='Data User';

-- Dumping data for table remake_s03r4t.sys_users: ~6 rows (approximately)
DELETE FROM `sys_users`;
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;
INSERT INTO `sys_users` (`id`, `ip_address`, `fullname`, `username`, `password`, `salt`, `old_password`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `active`, `first_name`, `last_name`, `company`, `phone`, `alternative_email`, `allow_concurrent_login`, `has_change_password`, `enable_change_password`, `last_change_password`, `password_expired_remainder`, `attemp_count`, `attemp_time`, `user_expired`, `last_login`, `block`, `code_activation`, `params`, `lock_by`, `lock_on`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
	(1, '127.0.0.1', 'Admin', 'administrator', '$2y$08$HSZjHc9PC6yNSVUv5tMs1OuwBvFDz5qedPPPSHWvKdxmgBgszLNAC', '', '', 'admin@admin.com', '', NULL, NULL, 'mIJgjwdK1.q/AlDojhepte', 1, 'Admin', 'istrator', 'ADMIN', '076123456', '', -1, 0, 1, NULL, -1, 0, NULL, NULL, 1495297670, 0, NULL, '', '', NULL, NULL, 1268889823, NULL, NULL),
	(2, '::1', 'Ketua', 'ketua', '$2y$08$2Jqoc2LfNeT/zhECQqfJHeCHiToZQU0gjErtqfTPurGON9gEP4KMS', '', '', 'asdf@adfasd.com', NULL, '', NULL, NULL, 1, 'Ketua', 'Wakil', '21', 'saf', '', -1, 0, 1, NULL, -1, 0, NULL, NULL, 1495290741, 0, NULL, '', '', NULL, NULL, 1494502784, NULL, NULL),
	(4, '::1', 'Sekretaris', 'sekretaris', '$2y$08$ynW/tsgzgx24qz01N6Uy5.1Eh0c/e6KA4VJVG8jb0fNf2zTjMUWMO', '', '', 'sekretaris@gmail.com', '', '', NULL, NULL, 1, 'Sekretaris', 'Tarisss', 'mewmew', '0000', '', -1, 0, 1, NULL, -1, 0, NULL, NULL, 1495282770, 0, NULL, '', '', NULL, NULL, 1494925841, NULL, NULL),
	(5, '::1', 'Umum', 'umum', '$2y$08$GVKqCGsqc4jlN6OV3HbFUe38RIyGcRDPDzoATkx1UgDBzivp6nu2e', '', '', 'uu@gmail.com', '', '', NULL, NULL, 2, 'kabag', 'Umum', 'uuum', '123123', '', -1, 0, 1, NULL, -1, 0, NULL, NULL, 1495290133, 0, NULL, '', '', NULL, NULL, 1494925886, NULL, NULL),
	(6, '::1', 'msdfs', 'cicak', '$2y$08$r0zmGPkWJBigYzfrIvBMA.fYWGoACFQk/qsTwuH662Vx7gCI03THy', '', '', 'ads@asd.com', '', '', NULL, NULL, 1, '', '', '', '0000', '', -1, 0, 1, NULL, -1, 0, NULL, NULL, NULL, 0, NULL, '', '', NULL, NULL, 1495026737, NULL, NULL),
	(7, '::1', '1231', '123121', '$2y$08$u.8BxLIbCGqU5Hc/u8zXU.ZbG3iT/hwS0IyVYW4Vv8ue.XHiigkFm', '', '', '1231@dss.com', '', '', NULL, NULL, 1, '', '', '', '12312', '', -1, 0, 1, NULL, -1, 0, NULL, NULL, NULL, 0, NULL, '', '', NULL, NULL, 1495028956, NULL, NULL);
/*!40000 ALTER TABLE `sys_users` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_user_group
DROP TABLE IF EXISTS `sys_user_group`;
CREATE TABLE IF NOT EXISTS `sys_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT 'UserId: merujuk ke tabel sys_users kolom userid',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT 'Foreign Key to groups.groupid',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid_groupid` (`userid`,`groupid`),
  KEY `FK_sys_user_group_sys_groups` (`groupid`),
  KEY `userid` (`userid`),
  CONSTRAINT `FK_sys_user_group_sys_groups` FOREIGN KEY (`groupid`) REFERENCES `sys_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sys_user_group_sys_users` FOREIGN KEY (`userid`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 COMMENT='Data Hubungan User Dengan Grup';

-- Dumping data for table remake_s03r4t.sys_user_group: ~6 rows (approximately)
DELETE FROM `sys_user_group`;
/*!40000 ALTER TABLE `sys_user_group` DISABLE KEYS */;
INSERT INTO `sys_user_group` (`id`, `userid`, `groupid`) VALUES
	(23, 1, 2),
	(12, 2, 10),
	(17, 4, 40),
	(44, 5, 60),
	(25, 6, 2),
	(26, 7, 2);
/*!40000 ALTER TABLE `sys_user_group` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.sys_user_online
DROP TABLE IF EXISTS `sys_user_online`;
CREATE TABLE IF NOT EXISTS `sys_user_online` (
  `session_id` char(32) NOT NULL DEFAULT '' COMMENT 'SessionId (by system)',
  `userid` int(11) NOT NULL COMMENT 'UserId: merujuk ke tabel sys_users ke kolom userid (by system)',
  `host_address` varchar(50) NOT NULL DEFAULT '' COMMENT 'Alamat IP (by system)',
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu login (by system)',
  `user_agent` varchar(255) NOT NULL DEFAULT '' COMMENT 'Jenis browser (by system)',
  `uri` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Alamat URL (by system)',
  `current_page` varchar(50) NOT NULL DEFAULT '' COMMENT 'Halaman saat ini (by system)',
  `last_visit` datetime DEFAULT NULL COMMENT 'Terakhir Berkunjung (by system)',
  `data` text COMMENT 'Data Lain (by system)',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Data User Yang Sedang Online';

-- Dumping data for table remake_s03r4t.sys_user_online: ~0 rows (approximately)
DELETE FROM `sys_user_online`;
/*!40000 ALTER TABLE `sys_user_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_user_online` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1492270899, 1, 'Admin', 'istrator', 'ADMIN', '0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table remake_s03r4t.users_groups
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table remake_s03r4t.users_groups: ~2 rows (approximately)
DELETE FROM `users_groups`;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(3, 1, 1),
	(4, 1, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
