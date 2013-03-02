/*
SQLyog Ultimate v9.01 
MySQL - 5.5.17 : Database - simkesbaru
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`simkesbaru` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `simkesbaru`;

/*Table structure for table `bagian_karyawan` */

DROP TABLE IF EXISTS `bagian_karyawan`;

CREATE TABLE `bagian_karyawan` (
  `id_bagian` int(8) NOT NULL AUTO_INCREMENT,
  `nama_bagian` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bagian_karyawan` */

insert  into `bagian_karyawan`(`id_bagian`,`nama_bagian`) values (1,'Engginering'),(2,'Teknisi Jaringan '),(3,'manager pemasaran'),(4,'Ahli Madya Enginering Listrik'),(5,'Ahli Madya Enginering Kimia');

/*Table structure for table `dosis_item` */

DROP TABLE IF EXISTS `dosis_item`;

CREATE TABLE `dosis_item` (
  `id_item` int(8) DEFAULT NULL,
  `id_dosis` int(8) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  KEY `fk_dosis_item_master_dosis1` (`id_dosis`),
  KEY `fk_dosis_item_transaksi1` (`id_transaksi`),
  KEY `fk_dosis_item_master_item1` (`id_item`),
  KEY `fk_id_transaksi` (`id_transaksi`),
  CONSTRAINT `fk_dosis_item_master_dosis1` FOREIGN KEY (`id_dosis`) REFERENCES `master_dosis` (`id_dosis`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosis_item` */

insert  into `dosis_item`(`id_item`,`id_dosis`,`id_transaksi`) values (255,6,1),(255,11,2),(257,4,5),(260,6,9),(255,6,10),(260,3,10),(11,3,10),(232,3,10),(9,3,10),(1,3,10),(9,3,10),(1,3,10),(1,3,10),(9,3,10),(232,3,9),(9,3,10),(1,3,10),(1,3,9),(1,3,10),(9,3,9),(9,3,9),(1,3,10),(1,3,10),(3,11,13),(1,6,14),(3,6,15),(260,3,16),(232,9,17),(260,3,18),(8,10,18),(232,3,19),(9,3,10);

/*Table structure for table `golongan_dokter` */

DROP TABLE IF EXISTS `golongan_dokter`;

CREATE TABLE `golongan_dokter` (
  `gol_dokter` int(2) NOT NULL AUTO_INCREMENT,
  `gol_nama` varchar(20) NOT NULL,
  PRIMARY KEY (`gol_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `golongan_dokter` */

insert  into `golongan_dokter`(`gol_dokter`,`gol_nama`) values (1,'dak'),(2,'rmh sakit'),(3,'klinik');

/*Table structure for table `item_transaksi_apotek` */

DROP TABLE IF EXISTS `item_transaksi_apotek`;

CREATE TABLE `item_transaksi_apotek` (
  `id_item_transaksi_apotek` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `disetujui` char(1) DEFAULT NULL,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `racikan` varchar(45) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_apotek`),
  KEY `fk_item_transaksi_apotek_master_item1` (`id_item`),
  KEY `fk_item_transaksi_apotek_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_apotek_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_apotek_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_apotek_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_apotek_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_apotek` */

insert  into `item_transaksi_apotek`(`id_item_transaksi_apotek`,`id_transaksi`,`disetujui`,`hrg_satuan`,`jumlah`,`racikan`,`id_item`,`id_rekomendasi`,`total`) values (62,10,'y',11000,5,NULL,255,2,55000),(63,10,'y',5000,5,'',260,2,NULL),(66,10,'y',4000,5,'',11,2,NULL),(74,10,'y',11000,6,'',232,2,NULL),(77,10,'y',1000,2,'',1,2,NULL),(78,13,'y',17000,1,'t',3,1,NULL),(79,14,'t',1500,10,'t',1,1,NULL),(80,15,'t',20000,1,'t',3,1,NULL),(81,16,'y',6000,5,'r',260,2,NULL),(82,17,'y',12000,5,'',232,1,NULL),(83,18,'y',7000,5,'t',260,2,NULL),(84,18,'y',6000,5,'r',8,2,NULL),(85,19,'y',11000,5,'r',232,2,NULL);

/*Table structure for table `item_transaksi_dak` */

DROP TABLE IF EXISTS `item_transaksi_dak`;

CREATE TABLE `item_transaksi_dak` (
  `id_item_transaksi_dak` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `jumlah` varchar(45) DEFAULT NULL,
  `racikan` char(1) DEFAULT NULL,
  `disetujui` char(1) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_dak`),
  KEY `fk_item_transaksi_dak_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_dak_master_item1` (`id_item`),
  KEY `fk_item_transaksi_dak_transaksi2` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_dak_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_dak_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_dak_transaksi2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_dak` */

insert  into `item_transaksi_dak`(`id_item_transaksi_dak`,`id_transaksi`,`jumlah`,`racikan`,`disetujui`,`id_item`,`id_rekomendasi`,`total`) values (13,2,'6','t','y',255,2,66000);

/*Table structure for table `item_transaksi_dokter` */

DROP TABLE IF EXISTS `item_transaksi_dokter`;

CREATE TABLE `item_transaksi_dokter` (
  `id_transaksi_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `disetujui` varchar(45) DEFAULT NULL,
  `racikan` char(1) DEFAULT NULL,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_dokter`),
  KEY `fk_item_transaksi_dokter_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_dokter_master_item1` (`id_item`),
  KEY `fk_item_transaksi_dokter_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_dokter_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_dokter_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_dokter_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_dokter` */

insert  into `item_transaksi_dokter`(`id_transaksi_dokter`,`id_transaksi`,`disetujui`,`racikan`,`hrg_satuan`,`jumlah`,`id_item`,`id_rekomendasi`,`total`) values (15,9,'t','y',6000,1,260,5,6000),(18,9,'y',NULL,11000,5,232,2,NULL),(19,10,'y',NULL,5000,5,9,2,NULL),(20,9,'y',NULL,1000,5,1,2,NULL),(21,9,'y',NULL,5000,1,9,2,NULL);

/*Table structure for table `item_transaksi_gigi` */

DROP TABLE IF EXISTS `item_transaksi_gigi`;

CREATE TABLE `item_transaksi_gigi` (
  `id_item_transaksi_gigi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `disetujui` char(1) DEFAULT NULL,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_gigi`),
  KEY `fk_item_transaksi_gigi_master_item1` (`id_item`),
  KEY `fk_item_transaksi_gigi_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_dak_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_dak_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_gigi_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_gigi` */

insert  into `item_transaksi_gigi`(`id_item_transaksi_gigi`,`id_transaksi`,`disetujui`,`hrg_satuan`,`jumlah`,`satuan`,`id_item`,`id_rekomendasi`,`total`) values (3,3,'y',11000,5,'0',232,2,NULL);

/*Table structure for table `item_transaksi_lab` */

DROP TABLE IF EXISTS `item_transaksi_lab`;

CREATE TABLE `item_transaksi_lab` (
  `id_item_transaksi_lab` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `hasil` varchar(45) DEFAULT NULL,
  `nilai` varchar(45) DEFAULT NULL,
  `rontgen` varchar(45) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_lab`),
  KEY `fk_item_transaksi_lab_master_item1` (`id_item`),
  KEY `fk_item_transaksi_lab_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_lab_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_lab_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_lab` */

insert  into `item_transaksi_lab`(`id_item_transaksi_lab`,`id_transaksi`,`hasil`,`nilai`,`rontgen`,`id_item`,`total`) values (4,4,'asam sekali','90','40',253,NULL);

/*Table structure for table `item_transaksi_lain` */

DROP TABLE IF EXISTS `item_transaksi_lain`;

CREATE TABLE `item_transaksi_lain` (
  `id_item_transaksi_lain` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `disetujui` varchar(45) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_lain`),
  KEY `fk_item_transaksi_lain_master_item1` (`id_item`),
  KEY `fk_item_transaksi_lain_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_lain_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_lain_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_lain_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_lain_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_lain` */

insert  into `item_transaksi_lain`(`id_item_transaksi_lain`,`id_transaksi`,`hrg_satuan`,`jumlah`,`disetujui`,`id_item`,`id_rekomendasi`,`total`) values (1,5,11000,1,'t',257,5,11000);

/*Table structure for table `item_transaksi_optik` */

DROP TABLE IF EXISTS `item_transaksi_optik`;

CREATE TABLE `item_transaksi_optik` (
  `id_item_transaksi_optik` int(11) NOT NULL AUTO_INCREMENT,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `disetujui` char(1) DEFAULT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_optik`),
  KEY `fk_item_transaksi_optik_master_item1` (`id_item`),
  KEY `fk_item_transaksi_optik_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_optik_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_optik_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_optik_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_optik_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_optik` */

insert  into `item_transaksi_optik`(`id_item_transaksi_optik`,`hrg_satuan`,`jumlah`,`disetujui`,`id_transaksi`,`id_item`,`id_rekomendasi`,`total`) values (1,125000,1,'y',6,258,5,125000);

/*Table structure for table `item_transaksi_penunjang` */

DROP TABLE IF EXISTS `item_transaksi_penunjang`;

CREATE TABLE `item_transaksi_penunjang` (
  `id_item_transaksi_penunjang` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `disetujui` char(1) DEFAULT NULL,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kesimpulan` varchar(45) DEFAULT NULL,
  `nilai` varchar(45) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_penunjang`),
  KEY `fk_item_transaksi_penunjang_master_item1` (`id_item`),
  KEY `fk_item_transaksi_penunjang_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_penunjang_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_penunjang_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_penunjang_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_penunjang_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_penunjang` */

insert  into `item_transaksi_penunjang`(`id_item_transaksi_penunjang`,`id_transaksi`,`disetujui`,`hrg_satuan`,`jumlah`,`kesimpulan`,`nilai`,`id_item`,`id_rekomendasi`,`total`) values (1,7,'y',117875,1,'sakit',NULL,259,5,NULL);

/*Table structure for table `item_transaksi_rs` */

DROP TABLE IF EXISTS `item_transaksi_rs`;

CREATE TABLE `item_transaksi_rs` (
  `id_item_transaksi_rs` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `tgl_resep` varchar(45) DEFAULT NULL,
  `hrg_satuan` int(15) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `disetujui` char(1) DEFAULT NULL,
  `kandungan` varchar(45) DEFAULT NULL,
  `nilai` varchar(45) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_item` int(8) DEFAULT NULL,
  `id_rekomendasi` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item_transaksi_rs`),
  KEY `fk_item_transaksi_rs_master_dokter1` (`id_dokter`),
  KEY `fk_item_transaksi_rs_master_item1` (`id_item`),
  KEY `fk_item_transaksi_rs_master_rekomendasi1` (`id_rekomendasi`),
  KEY `fk_item_transaksi_rs_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_item_transaksi_rs_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_rs_master_item1` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id_item`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_rs_master_rekomendasi1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_item_transaksi_rs_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `item_transaksi_rs` */

insert  into `item_transaksi_rs`(`id_item_transaksi_rs`,`id_transaksi`,`tgl_resep`,`hrg_satuan`,`jumlah`,`disetujui`,`kandungan`,`nilai`,`id_dokter`,`id_item`,`id_rekomendasi`,`total`) values (1,11,NULL,150000,4,'t',NULL,NULL,NULL,236,5,600000),(2,11,NULL,NULL,1,'t',NULL,NULL,NULL,237,NULL,1528300),(3,11,NULL,NULL,NULL,'t',NULL,NULL,NULL,238,NULL,483400),(4,11,NULL,NULL,NULL,'t',NULL,NULL,NULL,239,NULL,115000),(5,11,NULL,NULL,NULL,'t',NULL,NULL,NULL,240,NULL,75000),(6,11,NULL,NULL,NULL,'t',NULL,NULL,NULL,241,NULL,300000),(7,11,NULL,NULL,NULL,'t',NULL,NULL,NULL,242,NULL,155085);

/*Table structure for table `jenis_item` */

DROP TABLE IF EXISTS `jenis_item`;

CREATE TABLE `jenis_item` (
  `idjns_item` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_item` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idjns_item`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_item` */

insert  into `jenis_item`(`idjns_item`,`jenis_item`) values (1,'apotek'),(2,'alkes'),(3,'gigi'),(4,'kamar'),(5,'optik'),(6,'penunjang'),(7,'tindakan'),(8,'lain-lain'),(9,'dokter');

/*Table structure for table `jenis_kunjungan` */

DROP TABLE IF EXISTS `jenis_kunjungan`;

CREATE TABLE `jenis_kunjungan` (
  `idjenis_kunjungan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kunjungan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idjenis_kunjungan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_kunjungan` */

insert  into `jenis_kunjungan`(`idjenis_kunjungan`,`nama_kunjungan`) values (1,'Konsultasi'),(2,'Berobat'),(3,'Proaktif'),(4,'24 Jam'),(5,'Kunjungan Rumah'),(6,'Kunjungan RS');

/*Table structure for table `jenis_provider` */

DROP TABLE IF EXISTS `jenis_provider`;

CREATE TABLE `jenis_provider` (
  `idjenis_provider` int(2) NOT NULL AUTO_INCREMENT,
  `jenis_provider` varchar(20) NOT NULL,
  PRIMARY KEY (`idjenis_provider`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_provider` */

insert  into `jenis_provider`(`idjenis_provider`,`jenis_provider`) values (1,'apotek'),(2,'lab gigi'),(3,'laboratorium'),(4,'optik'),(5,'rumah sakit');

/*Table structure for table `jenis_rawat` */

DROP TABLE IF EXISTS `jenis_rawat`;

CREATE TABLE `jenis_rawat` (
  `idjenis_rawat` int(11) NOT NULL,
  `nama_rawat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idjenis_rawat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jenis_rawat` */

insert  into `jenis_rawat`(`idjenis_rawat`,`nama_rawat`) values (1,'Rawat Inap'),(2,'Rawat Jalan');

/*Table structure for table `kategori_dokter` */

DROP TABLE IF EXISTS `kategori_dokter`;

CREATE TABLE `kategori_dokter` (
  `kat_dokter` int(2) NOT NULL AUTO_INCREMENT,
  `kat_nama` varchar(20) NOT NULL,
  PRIMARY KEY (`kat_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_dokter` */

insert  into `kategori_dokter`(`kat_dokter`,`kat_nama`) values (1,'spesialis'),(2,'umum'),(3,'gigi'),(4,'laboratorium'),(5,'dak'),(6,'rumah sakit');

/*Table structure for table `level_user` */

DROP TABLE IF EXISTS `level_user`;

CREATE TABLE `level_user` (
  `user_level` int(2) NOT NULL,
  `name_level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `level_user` */

insert  into `level_user`(`user_level`,`name_level`) values (1,'Admin'),(2,'Mitra'),(3,'Operator Mitra'),(4,'Wilayah'),(5,'Operator Wilayah'),(6,'Rayon'),(7,'Operator Rayon');

/*Table structure for table `master_buku_besar` */

DROP TABLE IF EXISTS `master_buku_besar`;

CREATE TABLE `master_buku_besar` (
  `id_transaksi` int(11) NOT NULL,
  `buku_besar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  CONSTRAINT `fk_master_buku_besar_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_buku_besar` */

insert  into `master_buku_besar`(`id_transaksi`,`buku_besar`) values (1,'123'),(3,'123'),(4,'123'),(5,'123'),(6,'123'),(7,'123'),(9,'123'),(10,'123'),(11,'123'),(13,'qwqwqw'),(14,'qwqwqw'),(15,'qwqwqw'),(16,'321'),(17,'321'),(18,'1234'),(19,'1234');

/*Table structure for table `master_diagnosa` */

DROP TABLE IF EXISTS `master_diagnosa`;

CREATE TABLE `master_diagnosa` (
  `id_diagnosa` int(8) NOT NULL AUTO_INCREMENT,
  `nama_diagnosa` varchar(20) DEFAULT NULL,
  `jenis_penyakit` varchar(20) DEFAULT 'non degeneratif',
  `kelompok_penyakit` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `master_diagnosa` */

insert  into `master_diagnosa`(`id_diagnosa`,`nama_diagnosa`,`jenis_penyakit`,`kelompok_penyakit`) values (1,'otitis externa','non degeneratif','penyakit'),(2,'pusing','non degeneratif','penyakit'),(3,'batuk','non degeneratif','penyakit'),(4,'pilek','non degeneratif','penyakit'),(47,'ISPA','non degeneratif','penyakit'),(48,'Dermatitis Alergi','Degeneratif','Penyakit'),(49,'DEMAM TYFOID ','non degeneratif','penyakit'),(50,'FRAKTUR CLAVICULA ','kecelakaan','penyakit'),(51,'Abces Lien','degeneratif','penyakit'),(52,'Cenat-cenut','Non Degeneratif','Penyakit'),(53,'Asam Bonkiale','Degeneratif','Penyakit'),(54,'Abses Vasculer','non degeneratif','penyakit'),(55,'Wahing','Non Degeneratif','Penyakit'),(56,'patah kaki','kecelakaan','penyakit'),(58,'otitis externa','non degeneratif','penyakit');

/*Table structure for table `master_dokter` */

DROP TABLE IF EXISTS `master_dokter`;

CREATE TABLE `master_dokter` (
  `id_dokter` int(8) NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(50) NOT NULL,
  `langg_dokter` char(1) DEFAULT NULL,
  `tarif_dokter` varchar(10) DEFAULT NULL,
  `tarif_standar` varchar(10) DEFAULT NULL,
  `gol_dokter` int(1) DEFAULT '1',
  `kat_dokter` int(1) DEFAULT '2',
  PRIMARY KEY (`id_dokter`),
  UNIQUE KEY `id_dokter_UNIQUE` (`id_dokter`),
  KEY `fk_master_dokter_golongan_dokter1` (`gol_dokter`),
  KEY `fk_master_dokter_kategori_dokter1` (`kat_dokter`),
  CONSTRAINT `fk_master_dokter_golongan_dokter1` FOREIGN KEY (`gol_dokter`) REFERENCES `golongan_dokter` (`gol_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_master_dokter_kategori_dokter1` FOREIGN KEY (`kat_dokter`) REFERENCES `kategori_dokter` (`kat_dokter`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `master_dokter` */

insert  into `master_dokter`(`id_dokter`,`nama_dokter`,`langg_dokter`,`tarif_dokter`,`tarif_standar`,`gol_dokter`,`kat_dokter`) values (46,'DR.H.MOCHAMAD ISMAIL',NULL,'10000','10000',1,2),(47,'dr Maria',NULL,'10000','10000',1,2),(48,'DR.HIDAYAT,Sp.THT ',NULL,'10000','10000',1,2),(50,'DR.TIMOTIUS SUSANTIYA,Med',NULL,'10000','10000',1,2),(51,'Drg.ARIEF GUNAWAN ',NULL,NULL,NULL,1,2),(52,'DR.ARJU ANITA,Sp.OG ','n','20000',NULL,1,2),(53,'dr Ali Oke','n','20000',NULL,2,1),(54,'dr Catra BGR',NULL,NULL,NULL,1,2),(55,'Laboran Llina BLR',NULL,NULL,NULL,1,2),(57,'Lab Gigi',NULL,NULL,NULL,1,4);

/*Table structure for table `master_dosis` */

DROP TABLE IF EXISTS `master_dosis`;

CREATE TABLE `master_dosis` (
  `id_dosis` int(8) NOT NULL AUTO_INCREMENT,
  `nama_dosis` varchar(50) NOT NULL,
  `jml_dosis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dosis`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `master_dosis` */

insert  into `master_dosis`(`id_dosis`,`nama_dosis`,`jml_dosis`) values (1,'-1','3'),(2,'-18','2'),(3,'1/2','3'),(4,'3DD1','2'),(5,'2DD1','3'),(6,'1DD1/2','3'),(7,'3DDCTH11/2','4'),(8,'4DD1','2'),(9,'1/2s','1'),(10,'1/2d','2'),(11,'1dd2','3');

/*Table structure for table `master_item` */

DROP TABLE IF EXISTS `master_item`;

CREATE TABLE `master_item` (
  `id_item` int(8) NOT NULL AUTO_INCREMENT,
  `nama_item` varchar(100) NOT NULL,
  `hba_item` int(7) DEFAULT NULL,
  `harga_item` int(7) DEFAULT NULL,
  `frm_item` char(1) DEFAULT NULL,
  `oral_item` char(1) DEFAULT NULL,
  `kls_item` int(1) DEFAULT NULL,
  `provider_item` varchar(50) DEFAULT NULL,
  `entri_item` varchar(50) DEFAULT NULL,
  `idjns_item` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_master_item_jenis_item1` (`idjns_item`),
  CONSTRAINT `fk_master_item_jenis_item1` FOREIGN KEY (`idjns_item`) REFERENCES `jenis_item` (`idjns_item`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=latin1;

/*Data for the table `master_item` */

insert  into `master_item`(`id_item`,`nama_item`,`hba_item`,`harga_item`,`frm_item`,`oral_item`,`kls_item`,`provider_item`,`entri_item`,`idjns_item`) values (1,'Bodrexin ',1000,900,'t','y',1,'','manual',1),(2,'Vitacimin',900,800,'t','y',NULL,NULL,NULL,1),(3,'OBH',20000,17000,'t','y',NULL,NULL,NULL,1),(4,'Paracetamol',500,300,'y','y',NULL,NULL,NULL,2),(5,'Gelas Ukur',10000,11000,'t','t',NULL,NULL,NULL,8),(6,'Lensa Cembung',50000,55000,'t','t',NULL,NULL,NULL,5),(7,'Tandu',190000,200000,'t','t',NULL,NULL,NULL,2),(8,'Perban',5000,5500,'t','t',NULL,NULL,NULL,2),(9,'Betadin',4000,4500,'t','t',NULL,NULL,NULL,1),(10,'OBP',15000,16000,'t','y',NULL,NULL,NULL,1),(11,'Mixagrib',3000,3500,'t','y',NULL,NULL,NULL,1),(230,'THIAMYCIN SYN',40000,41000,NULL,'y',NULL,NULL,'otomatis',1),(231,'SANADRYL EXP SYR',17000,17500,NULL,'t',NULL,NULL,'otomatis',1),(232,'ALBIOTIN 300 MG',9800,10000,NULL,'t',NULL,NULL,'otomatis',1),(233,'PAMOL TAB',390,400,NULL,'y',NULL,NULL,'otomatis',1),(234,'TREMENZA 3/4 TAB',3000,3100,NULL,'y',NULL,NULL,'otomatis',1),(235,'Periksa',90000,100000,NULL,'t',NULL,NULL,'otomatis',1),(236,'KAMAR PERAWATAN KELAS II',NULL,NULL,NULL,'',NULL,NULL,'otomatis',4),(237,'MATROSET ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',1),(238,'LABORATORIUM',NULL,NULL,NULL,'',NULL,NULL,'otomatis',6),(239,'RADIOLOGI ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',6),(240,'JASA DOKTER THT',NULL,NULL,NULL,'',NULL,NULL,'otomatis',9),(241,'JASA DOKTER PENYAKIT DALAM ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',9),(242,'ADMINISTRASI',NULL,NULL,NULL,'',NULL,NULL,'otomatis',8),(243,'LABORATORIUM ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',8),(244,'PHOTO RADIOLOGI ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',8),(245,'BIAYA KAMAR OPERASI ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',4),(246,'PERALATAN OPERASI ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',4),(247,'JASA DOKTER ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',4),(248,'SCREW ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',1),(249,'SAVOFLURANE ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',1),(250,'PERAWATAN PASCA OPERASI',NULL,NULL,NULL,'',NULL,NULL,'otomatis',4),(251,'BIAYA LAINYA ',NULL,NULL,NULL,'',NULL,NULL,'otomatis',4),(252,'Paracetamol',1000,1000,NULL,'t',NULL,NULL,'otomatis',1),(253,'asam urat',NULL,NULL,NULL,NULL,NULL,NULL,NULL,6),(254,'tester',1500,2555,'y','y',NULL,NULL,'otomatis',3),(255,'FG Troces',9700,10000,NULL,'y',NULL,NULL,'otomatis',1),(256,'Adona Forte 30 Mg Tab',4800,4800,'y','y',NULL,NULL,'otomatis',3),(257,'cek darah',10000,10000,NULL,'y',NULL,NULL,'otomatis',7),(258,'KONSULTASI',124000,125000,NULL,'t',NULL,NULL,'otomatis',5),(259,'Glukosa strip',NULL,NULL,NULL,'t',NULL,NULL,'otomatis',6),(260,'Adona Forte 30 Mg Tab',4800,4800,'y','y',NULL,NULL,'otomatis',1),(263,'dfsafsda 3r',4231,4213,'y','y',2,'fsdaf','manual',1);

/*Table structure for table `master_karyawan` */

DROP TABLE IF EXISTS `master_karyawan`;

CREATE TABLE `master_karyawan` (
  `id_karyawan` int(8) NOT NULL AUTO_INCREMENT,
  `nip` varchar(45) DEFAULT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `ttl` varchar(100) DEFAULT NULL,
  `ap` char(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `kelas_kamar` int(2) DEFAULT NULL,
  `id_rayon` int(8) DEFAULT NULL,
  `id_bagian` int(8) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`),
  KEY `fk_master_karyawan_rayon_karyawan1` (`id_rayon`),
  KEY `fk_master_karyawan_bagian_karyawan1` (`id_bagian`),
  KEY `fk_status` (`status`),
  CONSTRAINT `fk_master_karyawan_bagian_karyawan1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian_karyawan` (`id_bagian`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_master_karyawan_rayon_karyawan1` FOREIGN KEY (`id_rayon`) REFERENCES `rayon_karyawan` (`id_rayon`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `status_karyawan` (`id_status`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Data for the table `master_karyawan` */

insert  into `master_karyawan`(`id_karyawan`,`nip`,`nama_karyawan`,`alamat`,`sex`,`telp`,`ttl`,`ap`,`status`,`kelas_kamar`,`id_rayon`,`id_bagian`,`tgl_lahir`) values (1,'07650075','Perdana Khairul HP','jl sentani 4','l','5352454','Malang','a',NULL,NULL,1,1,'1989-01-06'),(2,'7650080','Iqbal Fahmi','jl lamongan 3','l','5425424','LAMONGAN','p',NULL,NULL,NULL,2,'1989-01-06'),(50,'7650090','ABDUL GHOFAR','JL DANAU RANAU','L','8090833','LAMONGAN','a',4,1,11,3,'1989-01-01'),(51,'0765001','Perdana Menikah','JL DANAU RANAU','l','8090833','LAMONGAN ','a',4,1,11,3,'1989-01-01'),(52,'0765002','Perdana Single','JL DANAU RANAU','L','8090833','LAMONGAN','a',5,2,11,3,'1989-01-02'),(53,'0765003','Perdana Pipit','JL DANAU RANAU','L','8090833','LAMONGAN','a',2,3,11,3,'1989-01-03'),(54,'0765004','Perdana KHP Suami','JL DANAU RANAU','L','8090833','LAMONGAN','a',1,1,11,3,'1989-01-04'),(55,'0765005','Perdana Junior','JL DANAU RANAU','L','8090833','LAMONGAN','a',3,2,11,3,'1989-01-05'),(56,'0765006','Perdana Senior','JL DANAU RANAU','L','8090833','LAMONGAN','p',5,2,11,3,'1989-01-06'),(57,'7494117H','I KADEK SUDARMANTO','jl sawojajar 2','l','5452644','LAMONGAN','a',NULL,1,1,NULL,'1989-01-06'),(58,'35235435','JOKO WAHYUDI','JL DANAU RANAU','l','5254264','LAMONGAN','p',NULL,2,1,NULL,'1989-01-06'),(59,'5984167F','Umar Fauzi','JL DANAU RANAU','l','2452424','LAMONGAN','a',NULL,3,1,NULL,'1989-01-06'),(61,'7393275K3','ACHMAD PRIADI','jl sawojajar 2','l','5245242','Malang','a',NULL,2,1,NULL,'1989-01-06'),(62,'6082231K3','DEDEN DIANA, Bc.Ak.','jl danau bratan','l','2426724','Malang','a',NULL,1,1,NULL,'1989-01-06'),(63,'7393222K3','SEMIAWAN','jl tambingan','l','2421642','Malang','p',NULL,2,1,NULL,'1989-01-06'),(64,'4277302F','H. MUH. SULTHAN','JL DANAU RANAU','l','5242542','Malang','p',NULL,3,1,NULL,'1989-01-06'),(65,'765003','Perdana Pipit','jl sawojajar 2','l','4267354','Malang','p',1,2,1,2,'1989-01-06'),(71,'5325324','pipit','fsadf','p','5342523','0','p',2,3,11,4,NULL);

/*Table structure for table `master_provider` */

DROP TABLE IF EXISTS `master_provider`;

CREATE TABLE `master_provider` (
  `id_provider` int(10) NOT NULL AUTO_INCREMENT,
  `nama_provider` varchar(50) DEFAULT NULL,
  `langg_provider` char(1) DEFAULT NULL,
  `almt_provider` varchar(100) DEFAULT NULL,
  `email_provider` varchar(50) DEFAULT NULL,
  `tlp_provider` varchar(20) DEFAULT NULL,
  `fax_provider` varchar(20) DEFAULT NULL,
  `idjenis_provider` int(2) DEFAULT '1',
  PRIMARY KEY (`id_provider`),
  KEY `fk_master_provider_jenis_provider1` (`idjenis_provider`),
  CONSTRAINT `fk_master_provider_jenis_provider1` FOREIGN KEY (`idjenis_provider`) REFERENCES `jenis_provider` (`idjenis_provider`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=latin1;

/*Data for the table `master_provider` */

insert  into `master_provider`(`id_provider`,`nama_provider`,`langg_provider`,`almt_provider`,`email_provider`,`tlp_provider`,`fax_provider`,`idjenis_provider`) values (200,'APOTEK DAHLIA II','y','sawojajar','prdn.salam1jiwa@gmail.com','5154246','54264262',1),(201,'rs saiful anwar','y','blimbing','iqbal89@gmail.com','4216445','52446246',1),(202,'APOTEK DAHLIA II','y','sukun','simkes@gmail.com','5246164','51151646',5),(204,'RS.MEDIROS ','y','sawojajar','prdn.salam1jiwa@gmail.com','5436164','42424642',5),(205,'KLINIK LABORATORIUM PRODIA ','y','blimbing','iqbal89@gmail.com','6272624','53462672',5),(206,'KLINIK DAK','y','sulfat','simplesolution@gmail.com','2461672','45236427',2),(207,'APOTEK KIMIA FARMA ','y','sukun','simkes@gmail.com','5246166','52526172',2),(208,'Apotek Pandalu','y','sawojajar','prdn.salam1jiwa@gmail.com','5416432','42524627',1),(209,'Lab Gigi Oke','n','blimbing','simplesolution@gmail.com','14135164','4264643',2),(210,'Lab. Klinik Prodia','y','sulfat','iqbal89@gmail.com','5245626','52524327',2),(211,'Optik Melawai','y','sukun','simkes@gmail.com','2646264','42627724',4),(212,'RS. Sari Mulia','y','sawojajar','prdn.salam1jiwa@gmail.com','6264242','42242477',5),(214,'Optik Sehat Bugar','n','Jl Danau Bratan','prdn.salam1jiwa@gmail.com','876384737','768768767',4),(215,'Laboratorium Kimia','y','jl dalau sentani ','asha@gmail.com','87978988','73783878',3),(216,'Laboratorium Mata Oe','n','jl sulfat','pipit_uye@gmail.com','98789886','69888986',3),(217,'Apotek  2000','y','Jl Danau Sentani ','prdn.salam1jiwa@gmail.com','0341715976','85749045429',1),(223,'RSU Cahaya','y','Jl Danau Sentani ','prdn.salam1jiwa@gmail.com','85749045429','0341715976',5),(224,'nlknklnl','n','','','','',3),(225,'jghgh','n','','','1233','',3);

/*Table structure for table `master_rekomendasi` */

DROP TABLE IF EXISTS `master_rekomendasi`;

CREATE TABLE `master_rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rekomendasi` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_rekomendasi`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `master_rekomendasi` */

insert  into `master_rekomendasi`(`id_rekomendasi`,`nama_rekomendasi`) values (1,'Tidak Disertai Kelengkapan Administrasi'),(2,'Harga Obat'),(3,'Hasil laborat/penunjang'),(4,'Lain - lain'),(5,'Tarif Dokter'),(6,'Tarif Kamar'),(7,'Tarif Tindakan'),(8,'Tidak Ada Progress'),(9,'Tidak Sesuai Data Penanggung'),(10,'Tidak Sesuai dg Kesesuaian Terapi'),(11,'Tidak Sesuai dn Kompetensi');

/*Table structure for table `master_restitusi` */

DROP TABLE IF EXISTS `master_restitusi`;

CREATE TABLE `master_restitusi` (
  `id_restitusi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `restitusi` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_restitusi`),
  KEY `idtransaksi` (`id_transaksi`),
  CONSTRAINT `idtransaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_restitusi` */

/*Table structure for table `master_rujukan` */

DROP TABLE IF EXISTS `master_rujukan`;

CREATE TABLE `master_rujukan` (
  `id_rujukan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rujukan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_rujukan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `master_rujukan` */

insert  into `master_rujukan`(`id_rujukan`,`nama_rujukan`) values (1,'DAK'),(2,'Dokter Spesialis'),(3,'Rumah Sakit'),(4,'Laboraturium'),(5,'Dokter Umum'),(6,'Lainnya'),(7,'Gigi');

/*Table structure for table `master_tertanggung` */

DROP TABLE IF EXISTS `master_tertanggung`;

CREATE TABLE `master_tertanggung` (
  `id_tertanggung` int(8) NOT NULL AUTO_INCREMENT,
  `nama_tertanggung` varchar(100) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'ybs',
  `usia` varchar(3) DEFAULT NULL,
  `ditanggung` varchar(20) DEFAULT NULL,
  `id_karyawan` int(8) NOT NULL,
  PRIMARY KEY (`id_tertanggung`),
  KEY `fk_master_tertanggung_master_karyawan1` (`id_karyawan`),
  CONSTRAINT `fk_master_tertanggung_master_karyawan1` FOREIGN KEY (`id_karyawan`) REFERENCES `master_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

/*Data for the table `master_tertanggung` */

insert  into `master_tertanggung`(`id_tertanggung`,`nama_tertanggung`,`sex`,`tgl_lahir`,`status`,`usia`,`ditanggung`,`id_karyawan`) values (77,'SIPIT',NULL,'1989-01-06','ISTRI',NULL,NULL,1),(86,'I NYOMAN ARDI WIBAWA',NULL,NULL,'ANAK',NULL,NULL,57),(87,'JOKO WAHYUDI',NULL,'1989-01-06','YBS',NULL,NULL,58),(88,'M. FARHAN FAUZAN',NULL,NULL,'anak',NULL,NULL,59),(89,'NURHAENI ADJIS',NULL,NULL,'anak',NULL,NULL,59),(90,'ACHAMAD PRIADI ',NULL,'1989-01-06','YBS ',NULL,NULL,61),(92,'DEDEN DIANA ',NULL,NULL,'YBS ',NULL,NULL,62),(93,'ALYA KHANSA S ',NULL,NULL,'ANAK ',NULL,NULL,63),(94,'H. MUH. SULTHAN',NULL,NULL,'ybs',NULL,NULL,64),(95,'Pipit',NULL,'1989-01-06','istri',NULL,NULL,54),(97,'PERDANA PIPIT',NULL,NULL,'YBS',NULL,NULL,53),(98,'Perdana Pipit',NULL,NULL,'ybs',NULL,NULL,65),(100,'pipittt','p','2013-01-09','istri',NULL,NULL,2),(107,'fsddfa','l','2013-02-14','ybs',NULL,'y',1),(109,'fasfsdasf','l',NULL,'istri',NULL,'y',1),(112,'afdsfsa','l',NULL,'ybs',NULL,'y',50),(113,'fdasfas','l',NULL,'ybs',NULL,'y',1),(114,'fsdfasfa','l',NULL,'ybs',NULL,'y',1),(115,'dfasdfdasf','p','2013-02-27','istri',NULL,'t',1);

/*Table structure for table `mitra_karyawan` */

DROP TABLE IF EXISTS `mitra_karyawan`;

CREATE TABLE `mitra_karyawan` (
  `id_mitra` int(8) NOT NULL AUTO_INCREMENT,
  `nama_mitra` varchar(100) NOT NULL,
  PRIMARY KEY (`id_mitra`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mitra_karyawan` */

insert  into `mitra_karyawan`(`id_mitra`,`nama_mitra`) values (1,'Semen Gresik'),(2,'PLN');

/*Table structure for table `periksa_dak` */

DROP TABLE IF EXISTS `periksa_dak`;

CREATE TABLE `periksa_dak` (
  `id_transaksi` int(11) NOT NULL,
  `kondisi` varchar(45) DEFAULT NULL,
  `berat` varchar(45) DEFAULT NULL,
  `tinggi` varchar(45) DEFAULT NULL,
  `kesadaran` varchar(45) DEFAULT NULL,
  `suhu` varchar(45) DEFAULT NULL,
  `sistole` varchar(45) DEFAULT NULL,
  `diastole` varchar(45) DEFAULT NULL,
  `anamnesis` varchar(45) DEFAULT NULL,
  `pernafasan` varchar(45) DEFAULT NULL,
  `nadi` varchar(45) DEFAULT NULL,
  `riwayat_alergi` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `idjenis_kunjungan` int(11) DEFAULT NULL,
  KEY `fk_periksa_dak_transaksi1` (`id_transaksi`),
  KEY `fk_periksa_dak_jenis_kunjungan1` (`idjenis_kunjungan`),
  CONSTRAINT `fk_periksa_dak_jenis_kunjungan1` FOREIGN KEY (`idjenis_kunjungan`) REFERENCES `jenis_kunjungan` (`idjenis_kunjungan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_periksa_dak_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `periksa_dak` */

insert  into `periksa_dak`(`id_transaksi`,`kondisi`,`berat`,`tinggi`,`kesadaran`,`suhu`,`sistole`,`diastole`,`anamnesis`,`pernafasan`,`nadi`,`riwayat_alergi`,`keterangan`,`idjenis_kunjungan`) values (2,'SEHAT','55','170','SADAR','37','100','100','100','100','100','GATAL','SEHAT',1);

/*Table structure for table `periksa_kunjungan_rs` */

DROP TABLE IF EXISTS `periksa_kunjungan_rs`;

CREATE TABLE `periksa_kunjungan_rs` (
  `id_transaksi` int(11) NOT NULL,
  `diagnosa_masuk` varchar(50) DEFAULT NULL,
  `kondisi` varchar(45) DEFAULT NULL,
  `dokter_rawat` char(1) DEFAULT NULL,
  `jenis_jml_obat` varchar(45) DEFAULT NULL,
  `tindakan` varchar(45) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  KEY `fk_periksa_kunjungan_rs_master_dokter1` (`id_dokter`),
  KEY `fk_periksa_kunjungan_rs_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_periksa_kunjungan_rs_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_periksa_kunjungan_rs_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `periksa_kunjungan_rs` */

insert  into `periksa_kunjungan_rs`(`id_transaksi`,`diagnosa_masuk`,`kondisi`,`dokter_rawat`,`jenis_jml_obat`,`tindakan`,`id_dokter`) values (12,'pilek','pilek',NULL,NULL,NULL,46);

/*Table structure for table `periksa_optik` */

DROP TABLE IF EXISTS `periksa_optik`;

CREATE TABLE `periksa_optik` (
  `id_periksa_optik` int(11) NOT NULL AUTO_INCREMENT,
  `cylinder` varchar(45) DEFAULT NULL,
  `axis` varchar(45) DEFAULT NULL,
  `prisma` varchar(45) DEFAULT NULL,
  `basis` varchar(45) DEFAULT NULL,
  `pupil_distance` varchar(45) DEFAULT NULL,
  `spher` int(11) DEFAULT NULL,
  `id_transaksi` int(11) NOT NULL,
  `mata` char(1) DEFAULT NULL,
  `jns_periksa` varchar(2) NOT NULL,
  PRIMARY KEY (`id_periksa_optik`),
  KEY `fk_periksa_optik_transaksi1` (`id_transaksi`),
  KEY `tes` (`id_transaksi`),
  CONSTRAINT `tes` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `periksa_optik` */

insert  into `periksa_optik`(`id_periksa_optik`,`cylinder`,`axis`,`prisma`,`basis`,`pupil_distance`,`spher`,`id_transaksi`,`mata`,`jns_periksa`) values (1,'1','1','1','1','1',-1,6,'l','a'),(2,'1','1','1','1','1',-1,6,'r','a');

/*Table structure for table `periksa_rekam_medis` */

DROP TABLE IF EXISTS `periksa_rekam_medis`;

CREATE TABLE `periksa_rekam_medis` (
  `id_transaksi` int(11) NOT NULL,
  `diagnosa_masuk` varchar(45) DEFAULT NULL,
  `diagnosa_keluar` varchar(45) DEFAULT NULL,
  `riwayat` varchar(45) DEFAULT NULL,
  `periksa_fisik` varchar(45) DEFAULT NULL,
  `hasil_lab` varchar(45) DEFAULT NULL,
  `hasil_rontgen` varchar(45) DEFAULT NULL,
  `hasil_lain` varchar(45) DEFAULT NULL,
  `progres_harian` varchar(45) DEFAULT NULL,
  `pasca_rawat` varchar(45) DEFAULT NULL,
  `tindakan` varchar(45) DEFAULT NULL,
  KEY `fk_periksa_rekam_medis_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_periksa_rekam_medis_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `periksa_rekam_medis` */

insert  into `periksa_rekam_medis`(`id_transaksi`,`diagnosa_masuk`,`diagnosa_keluar`,`riwayat`,`periksa_fisik`,`hasil_lab`,`hasil_rontgen`,`hasil_lain`,`progres_harian`,`pasca_rawat`,`tindakan`) values (8,'asam urat','asam urat','mencret','sudah diperiksa fisi','hasil lab 1','hasil rontgen10','hasil pemeriksaan lain','sehat','tetap sakit','opname');

/*Table structure for table `rayon_karyawan` */

DROP TABLE IF EXISTS `rayon_karyawan`;

CREATE TABLE `rayon_karyawan` (
  `id_rayon` int(8) NOT NULL AUTO_INCREMENT,
  `nama_rayon` varchar(100) NOT NULL,
  `id_wilayah` int(8) NOT NULL,
  PRIMARY KEY (`id_rayon`),
  KEY `fk_rayon_karyawan_wilayah_karyawan1` (`id_wilayah`),
  KEY `wilayah` (`id_wilayah`),
  CONSTRAINT `wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah_karyawan` (`id_wilayah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `rayon_karyawan` */

insert  into `rayon_karyawan`(`id_rayon`,`nama_rayon`,`id_wilayah`) values (1,'PLN Samaan',1),(8,'PLN Klojen',1),(9,'PLN Lowokwaru',1),(11,'PLN Blimbing',1),(12,'PLN Singosari',1),(14,'PLN Sawojajar',1),(15,'PLN Sumbersari',1),(17,'kab malang',3);

/*Table structure for table `status_karyawan` */

DROP TABLE IF EXISTS `status_karyawan`;

CREATE TABLE `status_karyawan` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `status_karyawan` */

insert  into `status_karyawan`(`id_status`,`nama_status`) values (1,'suami'),(2,'istri'),(3,'anak'),(4,'menikah'),(5,'single');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date DEFAULT NULL,
  `tgl_kunjungan` date DEFAULT NULL,
  `id_tertanggung` int(8) NOT NULL,
  PRIMARY KEY (`id_transaksi`,`id_tertanggung`),
  KEY `fk_transaksi_master_tertanggung1` (`id_tertanggung`),
  CONSTRAINT `fk_transaksi_master_tertanggung1` FOREIGN KEY (`id_tertanggung`) REFERENCES `master_tertanggung` (`id_tertanggung`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`tgl_transaksi`,`tgl_kunjungan`,`id_tertanggung`) values (1,'2013-01-11','2013-01-10',95),(2,'2013-01-07','2013-01-03',97),(3,'2013-01-12','2013-01-12',97),(4,'2013-01-12','2013-01-12',98),(5,'2013-01-12','2013-01-12',97),(6,'2013-01-12','2013-01-12',95),(7,'2013-01-12','2013-01-12',97),(8,'2013-01-12','2013-01-12',97),(9,'2013-01-12','2013-01-12',97),(10,'2013-01-11','2013-01-10',95),(11,'2013-01-19','2013-01-19',90),(12,'2013-01-13','2013-01-27',86),(13,'2013-01-07','2013-01-07',87),(14,'2013-01-01','2013-01-01',90),(15,'2013-01-01','2013-01-01',77),(16,'2013-01-02','2013-01-01',97),(17,'2013-01-17','2013-01-01',95),(18,'2013-02-08','2013-02-01',97),(19,'2013-02-01','2013-02-07',97);

/*Table structure for table `transaksi_apotek` */

DROP TABLE IF EXISTS `transaksi_apotek`;

CREATE TABLE `transaksi_apotek` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `no_dak` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_rujukan` int(11) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_apotek_master_rujukan1` (`id_rujukan`),
  KEY `fk_transaksi_apotek_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_apotek_master_provider1` (`id_provider`),
  KEY `tran` (`id_transaksi`),
  KEY `rujukan` (`id_rujukan`),
  KEY `id_dokter` (`id_dokter`),
  KEY `foreignkey_transapotek_provider` (`id_provider`),
  CONSTRAINT `foreignkey_transapotek_provider` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `id_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `rujukan` FOREIGN KEY (`id_rujukan`) REFERENCES `master_rujukan` (`id_rujukan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tran` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_apotek` */

insert  into `transaksi_apotek`(`id_transaksi`,`no_surat`,`no_bukti`,`no_dak`,`restitusi`,`id_rujukan`,`id_dokter`,`id_provider`) values (10,'lkfddlksaf','142334',NULL,'y',2,53,208),(13,'1111','2222','3333','y',5,47,208),(14,'1111','2222','3333','y',2,46,200),(15,'1111','2222','3333','y',5,47,208),(16,'421','4132','1243','y',2,53,200),(17,'fsaf','dsfaa','fdsa','t',5,47,200),(18,'4143','2314','124','y',2,47,217),(19,'4321','41243','2314','y',2,47,208);

/*Table structure for table `transaksi_dak` */

DROP TABLE IF EXISTS `transaksi_dak`;

CREATE TABLE `transaksi_dak` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `id_rujukan` int(11) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_dak_master_rujukan1` (`id_rujukan`),
  KEY `fk_transaksi_dak_master_dokter1` (`id_dokter`),
  CONSTRAINT `fk_transaksi_dak_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_dak_master_rujukan1` FOREIGN KEY (`id_rujukan`) REFERENCES `master_rujukan` (`id_rujukan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_dak_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_dak` */

insert  into `transaksi_dak`(`id_transaksi`,`no_surat`,`no_bukti`,`id_rujukan`,`id_dokter`) values (2,'erwqr','fsaf',2,53);

/*Table structure for table `transaksi_diagnosa` */

DROP TABLE IF EXISTS `transaksi_diagnosa`;

CREATE TABLE `transaksi_diagnosa` (
  `id_transaksi_diagnosa` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_diagnosa` int(8) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_diagnosa`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_diagnosa` (`id_diagnosa`),
  CONSTRAINT `id_diagnosa` FOREIGN KEY (`id_diagnosa`) REFERENCES `master_diagnosa` (`id_diagnosa`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=423 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_diagnosa` */

insert  into `transaksi_diagnosa`(`id_transaksi_diagnosa`,`id_transaksi`,`id_diagnosa`) values (359,1,1),(360,2,1),(363,5,1),(364,6,1),(365,7,1),(366,9,53),(368,10,1),(369,10,2),(391,10,3),(394,3,2),(399,3,4),(401,4,3),(402,4,4),(406,6,2),(408,7,3),(410,5,3),(411,11,49),(412,11,2),(413,11,3),(414,13,3),(415,13,2),(416,14,2),(417,15,4),(418,9,3),(419,9,2),(420,16,2),(421,17,3),(422,18,3);

/*Table structure for table `transaksi_dokter` */

DROP TABLE IF EXISTS `transaksi_dokter`;

CREATE TABLE `transaksi_dokter` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `tarif_satuan_dokter` int(11) DEFAULT NULL,
  `tarif_standar_dokter` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_dokter_master_dokter1` (`id_dokter`),
  KEY `dokter` (`id_dokter`),
  CONSTRAINT `dokter` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_dokter_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_dokter` */

insert  into `transaksi_dokter`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`id_dokter`,`tarif_satuan_dokter`,`tarif_standar_dokter`) values (9,NULL,'3244dd','y',57,30000,25000);

/*Table structure for table `transaksi_gigi` */

DROP TABLE IF EXISTS `transaksi_gigi`;

CREATE TABLE `transaksi_gigi` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_gigi_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_gigi_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_gigi_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_gigi_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_gigi_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_gigi` */

insert  into `transaksi_gigi`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`id_dokter`,`id_provider`) values (3,'123','3244dd','y',54,209);

/*Table structure for table `transaksi_kunjungan_rs` */

DROP TABLE IF EXISTS `transaksi_kunjungan_rs`;

CREATE TABLE `transaksi_kunjungan_rs` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_kunjungan_rs_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_kunjungan_rs_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_kunjungan_rs_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_kunjungan_rs` */

insert  into `transaksi_kunjungan_rs`(`id_transaksi`,`no_surat`,`tgl_masuk`,`tgl_keluar`,`id_provider`) values (12,'42','2012-02-10','2012-02-13',202);

/*Table structure for table `transaksi_lab` */

DROP TABLE IF EXISTS `transaksi_lab`;

CREATE TABLE `transaksi_lab` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_rujukan` int(11) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_lab_master_rujukan1` (`id_rujukan`),
  KEY `fk_transaksi_lab_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_lab_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_lab_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_lab_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_lab_master_rujukan1` FOREIGN KEY (`id_rujukan`) REFERENCES `master_rujukan` (`id_rujukan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_lab_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_lab` */

insert  into `transaksi_lab`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`id_rujukan`,`id_dokter`,`id_provider`) values (4,'3434fdsr','4566','t',4,55,210);

/*Table structure for table `transaksi_lain` */

DROP TABLE IF EXISTS `transaksi_lain`;

CREATE TABLE `transaksi_lain` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_rujukan` int(11) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_lain_master_rujukan1` (`id_rujukan`),
  KEY `fk_transaksi_lain_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_lain_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_lain_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_lain_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_lain_master_rujukan1` FOREIGN KEY (`id_rujukan`) REFERENCES `master_rujukan` (`id_rujukan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_lain_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_lain` */

insert  into `transaksi_lain`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`id_rujukan`,`id_dokter`,`id_provider`) values (5,'fvf23','rf23','y',2,NULL,210);

/*Table structure for table `transaksi_optik` */

DROP TABLE IF EXISTS `transaksi_optik`;

CREATE TABLE `transaksi_optik` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_optik_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_optik_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_optik_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_optik_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_optik_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_optik` */

insert  into `transaksi_optik`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`id_dokter`,`id_provider`) values (6,'','46547','y',NULL,211);

/*Table structure for table `transaksi_ov` */

DROP TABLE IF EXISTS `transaksi_ov`;

CREATE TABLE `transaksi_ov` (
  `id_transaksi_ov` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `ov` char(1) DEFAULT NULL,
  `disetujui` varchar(45) DEFAULT NULL,
  `hrg_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `d_rekomendasi` int(11) DEFAULT NULL,
  `hrg_standar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_ov`),
  KEY `fk_transaksi_ov_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_ov_master_rekomendasi1` (`d_rekomendasi`),
  KEY `fk_transaksi_ov_transaksi1` (`id_transaksi`),
  CONSTRAINT `fk_transaksi_ov_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_ov_master_rekomendasi1` FOREIGN KEY (`d_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_ov_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_ov` */

insert  into `transaksi_ov`(`id_transaksi_ov`,`id_transaksi`,`ov`,`disetujui`,`hrg_satuan`,`jumlah`,`id_dokter`,`d_rekomendasi`,`hrg_standar`) values (1,11,'o','y',30000,3,47,2,25000);

/*Table structure for table `transaksi_penunjang` */

DROP TABLE IF EXISTS `transaksi_penunjang`;

CREATE TABLE `transaksi_penunjang` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  `id_dokter` int(8) DEFAULT NULL,
  `id_rujukan` int(11) DEFAULT '6',
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_penunjang_master_rujukan1` (`id_rujukan`),
  KEY `fk_transaksi_penunjang_master_dokter1` (`id_dokter`),
  KEY `fk_transaksi_penunjang_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_penunjang_master_dokter1` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_penunjang_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_penunjang_master_rujukan1` FOREIGN KEY (`id_rujukan`) REFERENCES `master_rujukan` (`id_rujukan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_penunjang_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_penunjang` */

insert  into `transaksi_penunjang`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`id_provider`,`id_dokter`,`id_rujukan`) values (7,'gsdfgfds','rgr233','t',210,NULL,2);

/*Table structure for table `transaksi_rekam_medis` */

DROP TABLE IF EXISTS `transaksi_rekam_medis`;

CREATE TABLE `transaksi_rekam_medis` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `no_kamar` varchar(40) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_rekam_medis_master_provider1` (`id_provider`),
  CONSTRAINT `fk_transaksi_rekam_medis_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_rekam_medis_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_rekam_medis` */

insert  into `transaksi_rekam_medis`(`id_transaksi`,`tgl_masuk`,`no_kamar`,`tgl_keluar`,`id_provider`) values (8,'2012-12-12','123',NULL,212);

/*Table structure for table `transaksi_rmh_sakit` */

DROP TABLE IF EXISTS `transaksi_rmh_sakit`;

CREATE TABLE `transaksi_rmh_sakit` (
  `id_transaksi` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `restitusi` char(1) DEFAULT NULL,
  `rawat` varchar(45) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `idjenis_rawat` int(11) DEFAULT NULL,
  `id_provider` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_rmh_sakit_master_provider1` (`id_provider`),
  KEY `fk_transaksi_rmh_sakit_jenis_rawat1` (`idjenis_rawat`),
  CONSTRAINT `fk_transaksi_rmh_sakit_jenis_rawat1` FOREIGN KEY (`idjenis_rawat`) REFERENCES `jenis_rawat` (`idjenis_rawat`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_rmh_sakit_master_provider1` FOREIGN KEY (`id_provider`) REFERENCES `master_provider` (`id_provider`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_rmh_sakit_transaksi1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_rmh_sakit` */

insert  into `transaksi_rmh_sakit`(`id_transaksi`,`no_surat`,`no_bukti`,`restitusi`,`rawat`,`tgl_masuk`,`tgl_keluar`,`idjenis_rawat`,`id_provider`) values (11,'4321','1234','',NULL,NULL,NULL,1,204);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_level` int(2) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_level_user1` (`user_level`),
  KEY `level` (`user_level`),
  CONSTRAINT `level` FOREIGN KEY (`user_level`) REFERENCES `level_user` (`user_level`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_username`,`user_password`,`user_name`,`user_level`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','Perdana',1),(2,'gresikpusat','1deb2a53610e4430763940597685ba98','Petrokimia Gresik',2),(3,'plnpusat','a1427d67e72199d2cbc7925fdc465514','PLN Pusat',2),(4,'plnjawatimur','5a65643f996a783d26e45ef62fc0abd2','PLN Jawa Timur',4),(5,'plnjawabarat','2d725757b30cc936090e8a7079a0d98f','PLN Jawa Barat',4),(6,'operatorgresikpusat','7178fb63e52216d63d67dd58fb0221a6','Operator Gresik',3),(7,'operatorplnpusat','3011caab519ae33c5dc6ac4f5b89a5a1','Operator PLN',3),(8,'operatorplnjawatimur','3499d83ce5aff5c908da4c5eafc970a1','Operator Jawa Timur',5),(9,'operatorplnsamaan','b23400c32b09a8988b2f7683e36321fd','Operator PLN Samaan',7),(10,'plnsamaan','74344aa2044b53ae1ae9a63743709cb2','PLN Samaan',6),(11,'plnklojen','0b44b3708153f09c4f5aee105a27a421','pln klojen',7),(12,'plnjawatimur2','bfe5f8b5aed28572754d7d98723409ca','pln jawa timur 2',5),(13,'plnpusat2','44db00924526dcfcdcb42c3b512ca260','plnpusat2',3),(14,'plnjawatimur2client','af2de01c079fc94cfac6c7ef9982e0af','plnjawatimur2',5),(24,'agsdadsg','f36ad1e97a04211fe337982187cfb8b2','agasdg',5),(27,'fsda','8a6d90a9d07c91076d361699d9831b96','fsad',3),(28,'sdaf','7d70663568cac5af684503681e3a4d41','fdsa',2),(29,'fdsaf','ec37aa25501f5aea74d5eb3d19b08333','fsdafda',5),(30,'fddf','c942e86d920a7331682d7674cac6f3b0','fasf',4),(31,'fdfd','44f21d5190b5a6df8089f54799628d7e','fsafdds',7),(32,'fdfd','5dfe651f7f42f348ff61384efeeb42da','fsdf',6);

/*Table structure for table `user_mitra` */

DROP TABLE IF EXISTS `user_mitra`;

CREATE TABLE `user_mitra` (
  `user_id` int(8) NOT NULL,
  `id_mitra` int(8) NOT NULL,
  PRIMARY KEY (`user_id`,`id_mitra`),
  KEY `fk_user_mitra_mitra_karyawan1` (`id_mitra`),
  CONSTRAINT `fk_user_mitra_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_mitra_mitra_karyawan1` FOREIGN KEY (`id_mitra`) REFERENCES `mitra_karyawan` (`id_mitra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_mitra` */

insert  into `user_mitra`(`user_id`,`id_mitra`) values (2,1),(6,1),(3,2),(7,2),(13,2),(27,2),(28,2);

/*Table structure for table `user_rayon` */

DROP TABLE IF EXISTS `user_rayon`;

CREATE TABLE `user_rayon` (
  `user_id` int(8) NOT NULL,
  `id_rayon` int(8) NOT NULL,
  PRIMARY KEY (`user_id`,`id_rayon`),
  KEY `fk_user_rayon_rayon_karyawan1` (`id_rayon`),
  CONSTRAINT `fk_user_rayon_rayon_karyawan1` FOREIGN KEY (`id_rayon`) REFERENCES `rayon_karyawan` (`id_rayon`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_rayon_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_rayon` */

insert  into `user_rayon`(`user_id`,`id_rayon`) values (9,1),(10,1),(31,1),(11,8),(32,11);

/*Table structure for table `user_wilayah` */

DROP TABLE IF EXISTS `user_wilayah`;

CREATE TABLE `user_wilayah` (
  `user_id` int(8) NOT NULL,
  `id_wilayah` int(8) NOT NULL,
  PRIMARY KEY (`user_id`,`id_wilayah`),
  KEY `fk_user_wilayah_wilayah_karyawan1` (`id_wilayah`),
  CONSTRAINT `fk_user_wilayah_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_wilayah_wilayah_karyawan1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah_karyawan` (`id_wilayah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_wilayah` */

insert  into `user_wilayah`(`user_id`,`id_wilayah`) values (4,1),(8,1),(12,1),(14,1),(29,1),(30,1),(5,4);

/*Table structure for table `wilayah_karyawan` */

DROP TABLE IF EXISTS `wilayah_karyawan`;

CREATE TABLE `wilayah_karyawan` (
  `id_wilayah` int(8) NOT NULL AUTO_INCREMENT,
  `nama_wilayah` varchar(100) NOT NULL,
  `id_mitra` int(8) NOT NULL,
  PRIMARY KEY (`id_wilayah`,`id_mitra`),
  KEY `fk_wilayah_karyawan_mitra_karyawan` (`id_mitra`),
  CONSTRAINT `fk_wilayah_karyawan_mitra_karyawan` FOREIGN KEY (`id_mitra`) REFERENCES `mitra_karyawan` (`id_mitra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `wilayah_karyawan` */

insert  into `wilayah_karyawan`(`id_wilayah`,`nama_wilayah`,`id_mitra`) values (1,'PLN Jawa Timur',2),(2,'PLN KAlimantan Barat',2),(3,'Semen Gresik Jawa Timur',1),(4,'PLN Jawa Barat',2);

/*Table structure for table `transaksi apotek` */

DROP TABLE IF EXISTS `transaksi apotek`;

/*!50001 DROP VIEW IF EXISTS `transaksi apotek` */;
/*!50001 DROP TABLE IF EXISTS `transaksi apotek` */;

/*!50001 CREATE TABLE  `transaksi apotek`(
 `nama_item` varchar(100) ,
 `jenis_item` varchar(45) ,
 `harga_item` int(7) ,
 `frm_item` char(1) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksiapotek` */

DROP TABLE IF EXISTS `v_detail_item_transaksiapotek`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksiapotek` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksiapotek` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksiapotek`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `id_item_transaksi_apotek` int(11) ,
 `hrg_satuan` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `total` int(11) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksidak` */

DROP TABLE IF EXISTS `v_detail_item_transaksidak`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksidak` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksidak` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksidak`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `jumlah` varchar(45) ,
 `harga_item` int(7) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksidokter` */

DROP TABLE IF EXISTS `v_detail_item_transaksidokter`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksidokter` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksidokter` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksidokter`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `id_transaksi_dokter` int(11) ,
 `hrg_satuan` int(11) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksigigi` */

DROP TABLE IF EXISTS `v_detail_item_transaksigigi`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksigigi` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksigigi` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksigigi`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `id_item_transaksi_gigi` int(11) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksilab` */

DROP TABLE IF EXISTS `v_detail_item_transaksilab`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksilab` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksilab` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksilab`(
 `id_transaksi` int(11) ,
 `id_item_transaksi_lab` int(11) ,
 `nama_item` varchar(100) ,
 `idjns_item` int(11) ,
 `nilai` varchar(45) ,
 `rontgen` varchar(45) ,
 `jenis_item` varchar(45) ,
 `hasil` varchar(45) 
)*/;

/*Table structure for table `v_detail_item_transaksilain` */

DROP TABLE IF EXISTS `v_detail_item_transaksilain`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksilain` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksilain` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksilain`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksioptik` */

DROP TABLE IF EXISTS `v_detail_item_transaksioptik`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksioptik` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksioptik` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksioptik`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item_transaksi_optik` int(11) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksipenunjang` */

DROP TABLE IF EXISTS `v_detail_item_transaksipenunjang`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksipenunjang` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksipenunjang` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksipenunjang`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item_transaksi_penunjang` int(11) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_detail_item_transaksirs` */

DROP TABLE IF EXISTS `v_detail_item_transaksirs`;

/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksirs` */;
/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksirs` */;

/*!50001 CREATE TABLE  `v_detail_item_transaksirs`(
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item_transaksi_rs` int(11) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(15) ,
 `total` int(11) ,
 `nama_rekomendasi` varchar(45) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_diagnosa` */

DROP TABLE IF EXISTS `v_diagnosa`;

/*!50001 DROP VIEW IF EXISTS `v_diagnosa` */;
/*!50001 DROP TABLE IF EXISTS `v_diagnosa` */;

/*!50001 CREATE TABLE  `v_diagnosa`(
 `id_transaksi` int(11) ,
 `nama_diagnosa` varchar(20) ,
 `id_diagnosa` int(8) ,
 `id_transaksi_diagnosa` int(11) 
)*/;

/*Table structure for table `v_hasiltransaksiapotek` */

DROP TABLE IF EXISTS `v_hasiltransaksiapotek`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksiapotek` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksiapotek` */;

/*!50001 CREATE TABLE  `v_hasiltransaksiapotek`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `buku_besar` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_rujukan` varchar(45) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `no_dak` varchar(45) ,
 `id_transaksi_diagnosa` int(11) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `id_item_transaksi_apotek` int(11) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `koreksi` bigint(21) ,
 `selisih` bigint(22) 
)*/;

/*Table structure for table `v_hasiltransaksidak` */

DROP TABLE IF EXISTS `v_hasiltransaksidak`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksidak` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksidak` */;

/*!50001 CREATE TABLE  `v_hasiltransaksidak`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `idjenis_kunjungan` int(11) ,
 `nama_kunjungan` varchar(45) ,
 `no_bukti` varchar(45) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `id_rujukan` int(11) ,
 `nama_rujukan` varchar(45) ,
 `nama_dokter` varchar(50) ,
 `anamnesis` varchar(45) ,
 `kondisi` varchar(45) ,
 `kesadaran` varchar(45) ,
 `suhu` varchar(45) ,
 `berat` varchar(45) ,
 `tinggi` varchar(45) ,
 `nadi` varchar(45) ,
 `sistole` varchar(45) ,
 `diastole` varchar(45) ,
 `pernafasan` varchar(45) ,
 `riwayat_alergi` varchar(45) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_hasiltransaksidokter` */

DROP TABLE IF EXISTS `v_hasiltransaksidokter`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksidokter` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksidokter` */;

/*!50001 CREATE TABLE  `v_hasiltransaksidokter`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `buku_besar` varchar(45) ,
 `nama_diagnosa` text ,
 `nama_dokter` varchar(50) ,
 `total` int(11) ,
 `jumlah` int(11) ,
 `total_satuan` decimal(43,0) ,
 `total_standar` decimal(43,0) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `id_item` int(8) 
)*/;

/*Table structure for table `v_hasiltransaksigigi` */

DROP TABLE IF EXISTS `v_hasiltransaksigigi`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksigigi` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksigigi` */;

/*!50001 CREATE TABLE  `v_hasiltransaksigigi`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `buku_besar` varchar(45) 
)*/;

/*Table structure for table `v_hasiltransaksikunjunganrs` */

DROP TABLE IF EXISTS `v_hasiltransaksikunjunganrs`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksikunjunganrs` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksikunjunganrs` */;

/*!50001 CREATE TABLE  `v_hasiltransaksikunjunganrs`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_masuk` date ,
 `tgl_keluar` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_provider` varchar(50) ,
 `diagnosa_masuk` varchar(50) ,
 `kondisi` varchar(45) ,
 `dokter_rawat` char(1) ,
 `nama_dokter` varchar(50) ,
 `tindakan` varchar(45) ,
 `jenis_jml_obat` varchar(45) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_hasiltransaksilab` */

DROP TABLE IF EXISTS `v_hasiltransaksilab`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksilab` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksilab` */;

/*!50001 CREATE TABLE  `v_hasiltransaksilab`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `buku_besar` varchar(45) 
)*/;

/*Table structure for table `v_hasiltransaksilain` */

DROP TABLE IF EXISTS `v_hasiltransaksilain`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksilain` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksilain` */;

/*!50001 CREATE TABLE  `v_hasiltransaksilain`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_rujukan` varchar(45) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `buku_besar` varchar(45) 
)*/;

/*Table structure for table `v_hasiltransaksioptik` */

DROP TABLE IF EXISTS `v_hasiltransaksioptik`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksioptik` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksioptik` */;

/*!50001 CREATE TABLE  `v_hasiltransaksioptik`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `buku_besar` varchar(45) 
)*/;

/*Table structure for table `v_hasiltransaksipenunjang` */

DROP TABLE IF EXISTS `v_hasiltransaksipenunjang`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksipenunjang` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksipenunjang` */;

/*!50001 CREATE TABLE  `v_hasiltransaksipenunjang`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `id_rujukan` int(11) ,
 `nama_rujukan` varchar(45) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `buku_besar` varchar(45) 
)*/;

/*Table structure for table `v_hasiltransaksirm` */

DROP TABLE IF EXISTS `v_hasiltransaksirm`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksirm` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksirm` */;

/*!50001 CREATE TABLE  `v_hasiltransaksirm`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_masuk` date ,
 `tgl_keluar` date ,
 `no_rm` varchar(40) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `nama_provider` varchar(50) ,
 `diagnosa_masuk` varchar(45) ,
 `diagnosa_keluar` varchar(45) ,
 `riwayat` varchar(45) ,
 `periksa_fisik` varchar(45) ,
 `hasil_lab` varchar(45) ,
 `hasil_rontgen` varchar(45) ,
 `hasil_lain` varchar(45) ,
 `progres_harian` varchar(45) ,
 `pasca_rawat` varchar(45) ,
 `tindakan` varchar(45) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_hasiltransaksirs` */

DROP TABLE IF EXISTS `v_hasiltransaksirs`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksirs` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksirs` */;

/*!50001 CREATE TABLE  `v_hasiltransaksirs`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `no_surat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `restitusi` char(1) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `tgl_masuk` date ,
 `tgl_keluar` date ,
 `nama_rawat` varchar(45) ,
 `nama_provider` varchar(50) ,
 `nama_diagnosa` text ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `buku_besar` varchar(45) 
)*/;

/*Table structure for table `v_hasiltransapotek` */

DROP TABLE IF EXISTS `v_hasiltransapotek`;

/*!50001 DROP VIEW IF EXISTS `v_hasiltransapotek` */;
/*!50001 DROP TABLE IF EXISTS `v_hasiltransapotek` */;

/*!50001 CREATE TABLE  `v_hasiltransapotek`(
 `tgl_transaksi` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_rujukan` varchar(45) ,
 `nama_dokter` varchar(50) ,
 `nama_provider` varchar(50) ,
 `no_bukti` varchar(45) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `oral_item` char(1) ,
 `hba_item` int(7) ,
 `harga_item` int(7) ,
 `jumlah` int(11) ,
 `disetujui` char(1) ,
 `jml_dosis` varchar(50) ,
 `nama_diagnosa` varchar(20) ,
 `jenis_penyakit` varchar(20) 
)*/;

/*Table structure for table `v_item_transaksi_all` */

DROP TABLE IF EXISTS `v_item_transaksi_all`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_all` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_all` */;

/*!50001 CREATE TABLE  `v_item_transaksi_all`(
 `id_transaksi` int(11) ,
 `nama_item` varchar(100) ,
 `harga_item` int(11) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `hba_item` int(11) ,
 `idjns_item` int(11) 
)*/;

/*Table structure for table `v_item_transaksi_apotek` */

DROP TABLE IF EXISTS `v_item_transaksi_apotek`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_apotek` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_apotek` */;

/*!50001 CREATE TABLE  `v_item_transaksi_apotek`(
 `id_item_transaksi_apotek` int(11) ,
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item` int(8) ,
 `nama_item` varchar(100) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `selisih` bigint(22) ,
 `racikan` varchar(45) ,
 `disetujui` char(1) ,
 `nama_dosis` varchar(50) ,
 `nama_rekomendasi` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_dak` */

DROP TABLE IF EXISTS `v_item_transaksi_dak`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_dak` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_dak` */;

/*!50001 CREATE TABLE  `v_item_transaksi_dak`(
 `id_item_transaksi_dak` int(11) ,
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item` int(8) ,
 `nama_item` varchar(100) ,
 `jumlah` varchar(45) ,
 `racikan` char(1) ,
 `disetujui` char(1) ,
 `nama_dosis` varchar(50) ,
 `nama_rekomendasi` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_dokter` */

DROP TABLE IF EXISTS `v_item_transaksi_dokter`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_dokter` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_dokter` */;

/*!50001 CREATE TABLE  `v_item_transaksi_dokter`(
 `id_transaksi_dokter` int(11) ,
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item` int(8) ,
 `nama_item` varchar(100) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `selisih` bigint(22) ,
 `disetujui` varchar(45) ,
 `nama_dosis` varchar(50) ,
 `nama_rekomendasi` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_lab` */

DROP TABLE IF EXISTS `v_item_transaksi_lab`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_lab` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_lab` */;

/*!50001 CREATE TABLE  `v_item_transaksi_lab`(
 `id_item_transaksi_lab` int(11) ,
 `id_transaksi` int(11) ,
 `nama_item` varchar(100) ,
 `hasil` varchar(45) ,
 `nilai` varchar(45) ,
 `rontgen` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_lain` */

DROP TABLE IF EXISTS `v_item_transaksi_lain`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_lain` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_lain` */;

/*!50001 CREATE TABLE  `v_item_transaksi_lain`(
 `id_item_transaksi_lain` int(11) ,
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `id_item` int(8) ,
 `nama_item` varchar(100) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `selisih` bigint(22) ,
 `disetujui` varchar(45) ,
 `nama_dosis` varchar(50) ,
 `nama_rekomendasi` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_optik` */

DROP TABLE IF EXISTS `v_item_transaksi_optik`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_optik` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_optik` */;

/*!50001 CREATE TABLE  `v_item_transaksi_optik`(
 `id_item_transaksi_optik` int(11) ,
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `nama_item` varchar(100) ,
 `harga_item` int(7) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `selisih` bigint(22) ,
 `disetujui` char(1) ,
 `nama_rekomendasi` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_ov` */

DROP TABLE IF EXISTS `v_item_transaksi_ov`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_ov` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_ov` */;

/*!50001 CREATE TABLE  `v_item_transaksi_ov`(
 `id_transaksi_ov` int(11) ,
 `nama_dokter` varchar(50) ,
 `tarif_standar` varchar(10) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `ov` char(1) ,
 `nama_rekomendasi` varchar(45) ,
 `disetujui` varchar(45) 
)*/;

/*Table structure for table `v_item_transaksi_penunjang` */

DROP TABLE IF EXISTS `v_item_transaksi_penunjang`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_penunjang` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_penunjang` */;

/*!50001 CREATE TABLE  `v_item_transaksi_penunjang`(
 `id_item_transaksi_penunjang` int(11) ,
 `id_transaksi` int(11) ,
 `disetujui` char(1) ,
 `jumlah` int(11) ,
 `kesimpulan` varchar(45) ,
 `nilai` varchar(45) ,
 `hrg_satuan` int(11) ,
 `id_item` int(8) ,
 `nama_item` varchar(100) ,
 `harga_item` int(7) ,
 `jenis_item` varchar(45) ,
 `nama_rekomendasi` varchar(45) ,
 `total` bigint(21) ,
 `selisih` bigint(22) 
)*/;

/*Table structure for table `v_item_transaksi_rs` */

DROP TABLE IF EXISTS `v_item_transaksi_rs`;

/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_rs` */;
/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_rs` */;

/*!50001 CREATE TABLE  `v_item_transaksi_rs`(
 `id_item_transaksi_rs` int(11) ,
 `id_transaksi` int(11) ,
 `tgl_resep` varchar(45) ,
 `hrg_satuan` int(15) ,
 `jumlah` int(11) ,
 `nama_item` varchar(100) ,
 `harga_item` int(7) ,
 `total` bigint(21) ,
 `selisih` bigint(26) ,
 `idjns_item` int(11) ,
 `jenis_item` varchar(45) ,
 `disetujui` char(1) ,
 `kandungan` varchar(45) ,
 `nilai` varchar(45) ,
 `nama_dokter` varchar(50) ,
 `nama_rekomendasi` varchar(45) ,
 `id_item` int(8) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_laporan_biaya` */

DROP TABLE IF EXISTS `v_laporan_biaya`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_biaya` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_biaya` */;

/*!50001 CREATE TABLE  `v_laporan_biaya`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `buku_besar` varchar(45) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(11) ,
 `hrg_satuan` int(11) ,
 `selisih` bigint(22) ,
 `disetujui` varchar(45) ,
 `nama_rekomendasi` varchar(45) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_detail` */

DROP TABLE IF EXISTS `v_laporan_detail`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_detail` */;

/*!50001 CREATE TABLE  `v_laporan_detail`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `buku_besar` varchar(45) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(11) ,
 `hrg_satuan` int(11) ,
 `total` bigint(21) ,
 `nama_diagnosa` varchar(20) ,
 `disetujui` varchar(45) ,
 `nama_rekomendasi` varchar(45) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_detail_bukubesar` */

DROP TABLE IF EXISTS `v_laporan_detail_bukubesar`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_detail_bukubesar` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_detail_bukubesar` */;

/*!50001 CREATE TABLE  `v_laporan_detail_bukubesar`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `rawat` varchar(45) ,
 `no_bukti` varchar(45) ,
 `no_surat` varchar(45) ,
 `restitusi` char(1) ,
 `kunjungan` varchar(11) ,
 `total` decimal(46,0) ,
 `ap` char(1) ,
 `buku_besar` varchar(45) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_lebihhet` */

DROP TABLE IF EXISTS `v_laporan_lebihhet`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_lebihhet` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_lebihhet` */;

/*!50001 CREATE TABLE  `v_laporan_lebihhet`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_provider` varchar(50) ,
 `rawat` varchar(45) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `het` decimal(15,0) ,
 `hrg_satuan` int(11) ,
 `selisih` bigint(22) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_obatberlebih` */

DROP TABLE IF EXISTS `v_laporan_obatberlebih`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_obatberlebih` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_obatberlebih` */;

/*!50001 CREATE TABLE  `v_laporan_obatberlebih`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(11) ,
 `hrg_satuan` int(11) ,
 `nama_dosis` varchar(50) ,
 `selisih` bigint(22) ,
 `jumlah_hari` double ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_obatkeluarga` */

DROP TABLE IF EXISTS `v_laporan_obatkeluarga`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_obatkeluarga` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_obatkeluarga` */;

/*!50001 CREATE TABLE  `v_laporan_obatkeluarga`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `kategori` varchar(9) ,
 `biaya` decimal(42,0) ,
 `selisih` decimal(43,0) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_laporan_polifarmasi` */

DROP TABLE IF EXISTS `v_laporan_polifarmasi`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_polifarmasi` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_polifarmasi` */;

/*!50001 CREATE TABLE  `v_laporan_polifarmasi`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `jumlah_item` bigint(21) ,
 `biaya` decimal(42,0) ,
 `selisih` decimal(43,0) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_laporan_postbiaya` */

DROP TABLE IF EXISTS `v_laporan_postbiaya`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_postbiaya` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_postbiaya` */;

/*!50001 CREATE TABLE  `v_laporan_postbiaya`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `buku_besar` varchar(45) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `biaya` decimal(46,0) ,
 `nama_diagnosa` varchar(20) ,
 `jenis_penyakit` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_resepmahal` */

DROP TABLE IF EXISTS `v_laporan_resepmahal`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_resepmahal` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_resepmahal` */;

/*!50001 CREATE TABLE  `v_laporan_resepmahal`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `kategori` varchar(9) ,
 `biaya` decimal(42,0) ,
 `selisih` decimal(43,0) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporan_shopingdokter` */

DROP TABLE IF EXISTS `v_laporan_shopingdokter`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_shopingdokter` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_shopingdokter` */;

/*!50001 CREATE TABLE  `v_laporan_shopingdokter`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `jumlah_hari` double ,
 `biaya` decimal(42,0) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_laporan_transaksi_all` */

DROP TABLE IF EXISTS `v_laporan_transaksi_all`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_transaksi_all` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_transaksi_all` */;

/*!50001 CREATE TABLE  `v_laporan_transaksi_all`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `kategori` varchar(9) ,
 `biaya` decimal(42,0) ,
 `selisih` decimal(43,0) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_laporan_verifikasi` */

DROP TABLE IF EXISTS `v_laporan_verifikasi`;

/*!50001 DROP VIEW IF EXISTS `v_laporan_verifikasi` */;
/*!50001 DROP TABLE IF EXISTS `v_laporan_verifikasi` */;

/*!50001 CREATE TABLE  `v_laporan_verifikasi`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `biaya` decimal(46,0) ,
 `disetujui` varchar(45) ,
 `nama_rekomendasi` varchar(45) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_laporandiagnosa` */

DROP TABLE IF EXISTS `v_laporandiagnosa`;

/*!50001 DROP VIEW IF EXISTS `v_laporandiagnosa` */;
/*!50001 DROP TABLE IF EXISTS `v_laporandiagnosa` */;

/*!50001 CREATE TABLE  `v_laporandiagnosa`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `nama_diagnosa` varchar(20) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `status` varchar(20) ,
 `nama_tertanggung` varchar(100) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_laporankunjungandak` */

DROP TABLE IF EXISTS `v_laporankunjungandak`;

/*!50001 DROP VIEW IF EXISTS `v_laporankunjungandak` */;
/*!50001 DROP TABLE IF EXISTS `v_laporankunjungandak` */;

/*!50001 CREATE TABLE  `v_laporankunjungandak`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `nama_diagnosa` varchar(20) ,
 `idjenis_kunjungan` int(11) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `ap` char(1) 
)*/;

/*Table structure for table `v_laporankunjungankesehatan` */

DROP TABLE IF EXISTS `v_laporankunjungankesehatan`;

/*!50001 DROP VIEW IF EXISTS `v_laporankunjungankesehatan` */;
/*!50001 DROP TABLE IF EXISTS `v_laporankunjungankesehatan` */;

/*!50001 CREATE TABLE  `v_laporankunjungankesehatan`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `nama_dokter` varchar(50) ,
 `status` varchar(20) ,
 `restitusi` char(1) ,
 `ditanggung` varchar(20) ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) ,
 `jenis_transaksi` varchar(2) ,
 `idjenis_rawat` varchar(1) 
)*/;

/*Table structure for table `v_laporanperiksadak` */

DROP TABLE IF EXISTS `v_laporanperiksadak`;

/*!50001 DROP VIEW IF EXISTS `v_laporanperiksadak` */;
/*!50001 DROP TABLE IF EXISTS `v_laporanperiksadak` */;

/*!50001 CREATE TABLE  `v_laporanperiksadak`(
 `id_transaksi` int(11) ,
 `id_rayon` int(8) ,
 `nama_wilayah` varchar(100) ,
 `id_mitra` int(8) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `idjenis_kunjungan` int(11) 
)*/;

/*Table structure for table `v_laporanrawatinap` */

DROP TABLE IF EXISTS `v_laporanrawatinap`;

/*!50001 DROP VIEW IF EXISTS `v_laporanrawatinap` */;
/*!50001 DROP TABLE IF EXISTS `v_laporanrawatinap` */;

/*!50001 CREATE TABLE  `v_laporanrawatinap`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `kat_dokter` int(11) ,
 `nama_dokter` varchar(50) ,
 `status` varchar(20) ,
 `restitusi` char(1) ,
 `ditanggung` varchar(20) ,
 `nama_item` varchar(100) ,
 `hba_item` int(11) ,
 `hrg_satuan` int(15) ,
 `jumlah` int(11) ,
 `total_harga` decimal(42,0) ,
 `idjns_item` int(11) ,
 `nama_provider` varchar(50) ,
 `buku_besar` varchar(45) ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) ,
 `tgl_masuk` date ,
 `tgl_keluar` date ,
 `jenis` varchar(1) 
)*/;

/*Table structure for table `v_laporanrawatjalan` */

DROP TABLE IF EXISTS `v_laporanrawatjalan`;

/*!50001 DROP VIEW IF EXISTS `v_laporanrawatjalan` */;
/*!50001 DROP TABLE IF EXISTS `v_laporanrawatjalan` */;

/*!50001 CREATE TABLE  `v_laporanrawatjalan`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `kat_dokter` int(11) ,
 `nama_dokter` varchar(50) ,
 `status` varchar(20) ,
 `restitusi` char(1) ,
 `ditanggung` varchar(20) ,
 `nama_item` varchar(100) ,
 `hba_item` int(11) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` decimal(32,0) ,
 `idjns_item` int(11) ,
 `nama_provider` varchar(50) ,
 `buku_besar` varchar(45) ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) ,
 `jenis_transaksi` varchar(2) 
)*/;

/*Table structure for table `v_laporanrekammedis` */

DROP TABLE IF EXISTS `v_laporanrekammedis`;

/*!50001 DROP VIEW IF EXISTS `v_laporanrekammedis` */;
/*!50001 DROP TABLE IF EXISTS `v_laporanrekammedis` */;

/*!50001 CREATE TABLE  `v_laporanrekammedis`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `nama_dokter` varchar(50) ,
 `status` varchar(20) ,
 `restitusi` char(1) ,
 `ditanggung` varchar(20) ,
 `nama_item` varchar(100) ,
 `hba_item` int(11) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `total` bigint(21) ,
 `idjns_item` int(11) ,
 `nama_provider` varchar(50) ,
 `buku_besar` varchar(45) ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) ,
 `jenis_transaksi` varchar(21) ,
 `tgl_keluar` binary(0) ,
 `nama_dosis` varchar(50) 
)*/;

/*Table structure for table `v_laporansap` */

DROP TABLE IF EXISTS `v_laporansap`;

/*!50001 DROP VIEW IF EXISTS `v_laporansap` */;
/*!50001 DROP TABLE IF EXISTS `v_laporansap` */;

/*!50001 CREATE TABLE  `v_laporansap`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `kat_dokter` int(11) ,
 `nama_dokter` varchar(50) ,
 `status` varchar(20) ,
 `restitusi` char(1) ,
 `ditanggung` varchar(20) ,
 `nama_item` varchar(100) ,
 `hba_item` int(11) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `id_rekomendasi` int(11) ,
 `total` decimal(42,0) ,
 `idjns_item` int(11) ,
 `nama_provider` varchar(50) ,
 `buku_besar` varchar(45) ,
 `jenis_penyakit` varchar(20) ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) ,
 `jenis_transaksi` varchar(2) ,
 `rj` varchar(2) ,
 `totalkoreksi` decimal(64,0) 
)*/;

/*Table structure for table `v_master_dokter` */

DROP TABLE IF EXISTS `v_master_dokter`;

/*!50001 DROP VIEW IF EXISTS `v_master_dokter` */;
/*!50001 DROP TABLE IF EXISTS `v_master_dokter` */;

/*!50001 CREATE TABLE  `v_master_dokter`(
 `id_dokter` int(8) ,
 `nama_dokter` varchar(50) ,
 `langg_dokter` varchar(12) ,
 `tarif_dokter` varchar(10) ,
 `tarif_standar` varchar(10) ,
 `gol_nama` varchar(20) ,
 `kat_nama` varchar(20) 
)*/;

/*Table structure for table `v_master_item` */

DROP TABLE IF EXISTS `v_master_item`;

/*!50001 DROP VIEW IF EXISTS `v_master_item` */;
/*!50001 DROP TABLE IF EXISTS `v_master_item` */;

/*!50001 CREATE TABLE  `v_master_item`(
 `id_item` int(8) ,
 `nama_item` varchar(100) ,
 `hba_item` int(7) ,
 `harga_item` int(7) ,
 `frm_item` char(1) ,
 `oral_item` char(1) ,
 `kls_item` int(1) ,
 `provider_item` varchar(50) ,
 `entri_item` varchar(50) ,
 `idjns_item` int(11) ,
 `jenis_item` varchar(45) 
)*/;

/*Table structure for table `v_master_karyawan` */

DROP TABLE IF EXISTS `v_master_karyawan`;

/*!50001 DROP VIEW IF EXISTS `v_master_karyawan` */;
/*!50001 DROP TABLE IF EXISTS `v_master_karyawan` */;

/*!50001 CREATE TABLE  `v_master_karyawan`(
 `id_karyawan` int(8) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `alamat` varchar(200) ,
 `sex` char(1) ,
 `telp` varchar(15) ,
 `ttl` varchar(100) ,
 `tgl_lahir` date ,
 `ap` char(1) ,
 `status` int(11) ,
 `nama_status` varchar(45) ,
 `kelas_kamar` int(2) ,
 `nama_bagian` varchar(50) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `nama_rayon` varchar(100) 
)*/;

/*Table structure for table `v_master_provider` */

DROP TABLE IF EXISTS `v_master_provider`;

/*!50001 DROP VIEW IF EXISTS `v_master_provider` */;
/*!50001 DROP TABLE IF EXISTS `v_master_provider` */;

/*!50001 CREATE TABLE  `v_master_provider`(
 `id_provider` int(10) ,
 `nama_provider` varchar(50) ,
 `langg_provider` varchar(12) ,
 `almt_provider` varchar(100) ,
 `email_provider` varchar(50) ,
 `tlp_provider` varchar(20) ,
 `fax_provider` varchar(20) ,
 `idjenis_provider` int(2) 
)*/;

/*Table structure for table `v_master_rayon` */

DROP TABLE IF EXISTS `v_master_rayon`;

/*!50001 DROP VIEW IF EXISTS `v_master_rayon` */;
/*!50001 DROP TABLE IF EXISTS `v_master_rayon` */;

/*!50001 CREATE TABLE  `v_master_rayon`(
 `id_rayon` int(8) ,
 `nama_rayon` varchar(100) ,
 `id_wilayah` int(8) ,
 `nama_wilayah` varchar(100) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_master_tertanggung` */

DROP TABLE IF EXISTS `v_master_tertanggung`;

/*!50001 DROP VIEW IF EXISTS `v_master_tertanggung` */;
/*!50001 DROP TABLE IF EXISTS `v_master_tertanggung` */;

/*!50001 CREATE TABLE  `v_master_tertanggung`(
 `id_tertanggung` int(8) ,
 `nama_tertanggung` varchar(100) ,
 `sex` char(1) ,
 `tgl_lahir` date ,
 `usia` varchar(3) ,
 `status` varchar(20) ,
 `ditanggung` varchar(20) ,
 `nama_karyawan` varchar(100) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_master_user` */

DROP TABLE IF EXISTS `v_master_user`;

/*!50001 DROP VIEW IF EXISTS `v_master_user` */;
/*!50001 DROP TABLE IF EXISTS `v_master_user` */;

/*!50001 CREATE TABLE  `v_master_user`(
 `user_id` int(8) ,
 `user_username` varchar(20) ,
 `user_password` varchar(100) ,
 `user_name` varchar(20) ,
 `name_level` varchar(45) 
)*/;

/*Table structure for table `v_postbiayarirj` */

DROP TABLE IF EXISTS `v_postbiayarirj`;

/*!50001 DROP VIEW IF EXISTS `v_postbiayarirj` */;
/*!50001 DROP TABLE IF EXISTS `v_postbiayarirj` */;

/*!50001 CREATE TABLE  `v_postbiayarirj`(
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `id_transaksi` int(11) ,
 `jenis_item` varchar(45) ,
 `total_transaksi` decimal(40,0) 
)*/;

/*Table structure for table `v_restitusi` */

DROP TABLE IF EXISTS `v_restitusi`;

/*!50001 DROP VIEW IF EXISTS `v_restitusi` */;
/*!50001 DROP TABLE IF EXISTS `v_restitusi` */;

/*!50001 CREATE TABLE  `v_restitusi`(
 `id_transaksi` int(11) ,
 `restitusi` char(1) 
)*/;

/*Table structure for table `v_summarydokter` */

DROP TABLE IF EXISTS `v_summarydokter`;

/*!50001 DROP VIEW IF EXISTS `v_summarydokter` */;
/*!50001 DROP TABLE IF EXISTS `v_summarydokter` */;

/*!50001 CREATE TABLE  `v_summarydokter`(
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_transaksi` int(11) ,
 `kat_dokter` int(1) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_summaryjabatanterbanyak` */

DROP TABLE IF EXISTS `v_summaryjabatanterbanyak`;

/*!50001 DROP VIEW IF EXISTS `v_summaryjabatanterbanyak` */;
/*!50001 DROP TABLE IF EXISTS `v_summaryjabatanterbanyak` */;

/*!50001 CREATE TABLE  `v_summaryjabatanterbanyak`(
 `id_rayon` int(8) ,
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `nama_bagian` varchar(50) ,
 `id_bagian` int(8) ,
 `total` decimal(38,0) 
)*/;

/*Table structure for table `v_summaryobatterbanyak` */

DROP TABLE IF EXISTS `v_summaryobatterbanyak`;

/*!50001 DROP VIEW IF EXISTS `v_summaryobatterbanyak` */;
/*!50001 DROP TABLE IF EXISTS `v_summaryobatterbanyak` */;

/*!50001 CREATE TABLE  `v_summaryobatterbanyak`(
 `id_transaksi` int(11) ,
 `nama_item` varchar(100) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date 
)*/;

/*Table structure for table `v_summarypenyakitterbanyak` */

DROP TABLE IF EXISTS `v_summarypenyakitterbanyak`;

/*!50001 DROP VIEW IF EXISTS `v_summarypenyakitterbanyak` */;
/*!50001 DROP TABLE IF EXISTS `v_summarypenyakitterbanyak` */;

/*!50001 CREATE TABLE  `v_summarypenyakitterbanyak`(
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_summarypostbiayaall` */

DROP TABLE IF EXISTS `v_summarypostbiayaall`;

/*!50001 DROP VIEW IF EXISTS `v_summarypostbiayaall` */;
/*!50001 DROP TABLE IF EXISTS `v_summarypostbiayaall` */;

/*!50001 CREATE TABLE  `v_summarypostbiayaall`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `jenis_penyakit` varchar(20) ,
 `ap` char(1) ,
 `status` varchar(20) ,
 `total_transaksi` bigint(19) 
)*/;

/*Table structure for table `v_summaryrawatinap` */

DROP TABLE IF EXISTS `v_summaryrawatinap`;

/*!50001 DROP VIEW IF EXISTS `v_summaryrawatinap` */;
/*!50001 DROP TABLE IF EXISTS `v_summaryrawatinap` */;

/*!50001 CREATE TABLE  `v_summaryrawatinap`(
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_summaryrestitusi` */

DROP TABLE IF EXISTS `v_summaryrestitusi`;

/*!50001 DROP VIEW IF EXISTS `v_summaryrestitusi` */;
/*!50001 DROP TABLE IF EXISTS `v_summaryrestitusi` */;

/*!50001 CREATE TABLE  `v_summaryrestitusi`(
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_summaryspesialis` */

DROP TABLE IF EXISTS `v_summaryspesialis`;

/*!50001 DROP VIEW IF EXISTS `v_summaryspesialis` */;
/*!50001 DROP TABLE IF EXISTS `v_summaryspesialis` */;

/*!50001 CREATE TABLE  `v_summaryspesialis`(
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `kat_nama` varchar(20) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_summarytransaksiterbesar` */

DROP TABLE IF EXISTS `v_summarytransaksiterbesar`;

/*!50001 DROP VIEW IF EXISTS `v_summarytransaksiterbesar` */;
/*!50001 DROP TABLE IF EXISTS `v_summarytransaksiterbesar` */;

/*!50001 CREATE TABLE  `v_summarytransaksiterbesar`(
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `tgl_transaksi` date ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) ,
 `total_apotek` decimal(32,0) ,
 `total_dak` decimal(32,0) ,
 `total_dokter` decimal(32,0) ,
 `total_gigi` decimal(32,0) ,
 `total_lab` decimal(32,0) ,
 `total_lain` decimal(32,0) ,
 `total_optik` decimal(32,0) ,
 `total_penunjang` decimal(32,0) ,
 `total_transaksi_rs` decimal(32,0) ,
 `total` decimal(38,0) 
)*/;

/*Table structure for table `v_totaltransaksi` */

DROP TABLE IF EXISTS `v_totaltransaksi`;

/*!50001 DROP VIEW IF EXISTS `v_totaltransaksi` */;
/*!50001 DROP TABLE IF EXISTS `v_totaltransaksi` */;

/*!50001 CREATE TABLE  `v_totaltransaksi`(
 `id_transaksi` int(11) ,
 `tgl_kunjungan` date ,
 `tgl_transaksi` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `kat_dokter` int(11) ,
 `nama_dokter` varchar(50) ,
 `status` varchar(20) ,
 `restitusi` char(1) ,
 `no_bukti` varchar(45) ,
 `ditanggung` varchar(20) ,
 `nama_item` varchar(100) ,
 `hba_item` int(11) ,
 `hrg_satuan` int(11) ,
 `jumlah` int(11) ,
 `id_rekomendasi` int(11) ,
 `total` decimal(42,0) ,
 `idjns_item` int(11) ,
 `nama_provider` varchar(50) ,
 `buku_besar` varchar(45) ,
 `jenis_penyakit` varchar(20) ,
 `nama_diagnosa` varchar(20) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) ,
 `jenis_transaksi` varchar(2) ,
 `rj` varchar(2) 
)*/;

/*Table structure for table `v_transaksi` */

DROP TABLE IF EXISTS `v_transaksi`;

/*!50001 DROP VIEW IF EXISTS `v_transaksi` */;
/*!50001 DROP TABLE IF EXISTS `v_transaksi` */;

/*!50001 CREATE TABLE  `v_transaksi`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `buku_besar` varchar(45) ,
 `id_bagian` int(11) ,
 `nama_bagian` varchar(50) ,
 `restitusi` char(1) ,
 `biaya_satuan` decimal(46,0) ,
 `biaya_standar` decimal(42,0) ,
 `selisih` decimal(47,0) ,
 `biaya_koreksi` decimal(46,0) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_transaksi_all` */

DROP TABLE IF EXISTS `v_transaksi_all`;

/*!50001 DROP VIEW IF EXISTS `v_transaksi_all` */;
/*!50001 DROP TABLE IF EXISTS `v_transaksi_all` */;

/*!50001 CREATE TABLE  `v_transaksi_all`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_tertanggung` int(11) ,
 `id_dokter` int(11) 
)*/;

/*Table structure for table `v_transaksi_dokter` */

DROP TABLE IF EXISTS `v_transaksi_dokter`;

/*!50001 DROP VIEW IF EXISTS `v_transaksi_dokter` */;
/*!50001 DROP TABLE IF EXISTS `v_transaksi_dokter` */;

/*!50001 CREATE TABLE  `v_transaksi_dokter`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_tertanggung` varchar(100) ,
 `status` varchar(20) ,
 `nama_dokter` varchar(50) ,
 `biaya` bigint(21) ,
 `nama_item` varchar(100) ,
 `nama_dosis` varchar(50) ,
 `jumlah` int(11) ,
 `jumlah_hari` double ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*Table structure for table `v_transaksi_kunjungan_rs` */

DROP TABLE IF EXISTS `v_transaksi_kunjungan_rs`;

/*!50001 DROP VIEW IF EXISTS `v_transaksi_kunjungan_rs` */;
/*!50001 DROP TABLE IF EXISTS `v_transaksi_kunjungan_rs` */;

/*!50001 CREATE TABLE  `v_transaksi_kunjungan_rs`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_tertanggung` int(8) ,
 `nama_tertanggung` varchar(100) ,
 `id_karyawan` int(8) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `no_surat` varchar(45) ,
 `tgl_masuk` date ,
 `tgl_keluar` date ,
 `id_provider` int(10) ,
 `nama_provider` varchar(50) ,
 `diagnosa_masuk` varchar(50) ,
 `kondisi` varchar(45) ,
 `dokter_rawat` char(1) ,
 `jenis_jml_obat` varchar(45) ,
 `tindakan` varchar(45) ,
 `id_dokter` int(8) ,
 `nama_dokter` varchar(50) 
)*/;

/*Table structure for table `v_transaksi_provider` */

DROP TABLE IF EXISTS `v_transaksi_provider`;

/*!50001 DROP VIEW IF EXISTS `v_transaksi_provider` */;
/*!50001 DROP TABLE IF EXISTS `v_transaksi_provider` */;

/*!50001 CREATE TABLE  `v_transaksi_provider`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `ap` char(1) ,
 `nama_provider` varchar(50) ,
 `idjenis_provider` int(11) ,
 `jenis_provider` varchar(20) ,
 `nama_item` varchar(100) ,
 `jumlah` int(11) ,
 `harga_item` int(11) ,
 `hrg_satuan` int(11) ,
 `id_rayon` int(11) ,
 `id_wilayah` int(11) ,
 `id_mitra` int(11) 
)*/;

/*Table structure for table `v_transaksi_rekam_medis` */

DROP TABLE IF EXISTS `v_transaksi_rekam_medis`;

/*!50001 DROP VIEW IF EXISTS `v_transaksi_rekam_medis` */;
/*!50001 DROP TABLE IF EXISTS `v_transaksi_rekam_medis` */;

/*!50001 CREATE TABLE  `v_transaksi_rekam_medis`(
 `id_transaksi` int(11) ,
 `tgl_transaksi` date ,
 `tgl_kunjungan` date ,
 `id_tertanggung` int(8) ,
 `nama_tertanggung` varchar(100) ,
 `id_karyawan` int(8) ,
 `nip` varchar(45) ,
 `nama_karyawan` varchar(100) ,
 `tgl_masuk` date ,
 `no_kamar` varchar(40) ,
 `tgl_keluar` date ,
 `id_provider` int(10) ,
 `nama_provider` varchar(50) ,
 `diagnosa_masuk` varchar(45) ,
 `diagnosa_keluar` varchar(45) ,
 `riwayat` varchar(45) ,
 `periksa_fisik` varchar(45) ,
 `hasil_lab` varchar(45) ,
 `hasil_rontgen` varchar(45) ,
 `hasil_lain` varchar(45) ,
 `progres_harian` varchar(45) ,
 `pasca_rawat` varchar(45) ,
 `tindakan` varchar(45) 
)*/;

/*Table structure for table `v_user` */

DROP TABLE IF EXISTS `v_user`;

/*!50001 DROP VIEW IF EXISTS `v_user` */;
/*!50001 DROP TABLE IF EXISTS `v_user` */;

/*!50001 CREATE TABLE  `v_user`(
 `user_id` int(8) ,
 `user_username` varchar(20) ,
 `user_password` varchar(100) ,
 `user_name` varchar(20) ,
 `user_level` int(2) ,
 `name_level` varchar(45) ,
 `id_rayon` int(8) ,
 `id_wilayah` int(8) ,
 `id_mitra` int(8) 
)*/;

/*View structure for view transaksi apotek */

/*!50001 DROP TABLE IF EXISTS `transaksi apotek` */;
/*!50001 DROP VIEW IF EXISTS `transaksi apotek` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi apotek` AS (select `mi`.`nama_item` AS `nama_item`,`ji`.`jenis_item` AS `jenis_item`,`mi`.`harga_item` AS `harga_item`,`mi`.`frm_item` AS `frm_item`,`md`.`nama_dosis` AS `nama_dosis` from ((((`item_transaksi_apotek` `ta` join `master_item` `mi`) join `jenis_item` `ji`) join `master_dosis` `md`) join `dosis_item` `di` on(((`ta`.`id_item` = `mi`.`id_item`) and (`mi`.`idjns_item` = `ji`.`idjns_item`) and (`di`.`id_item` = `mi`.`id_item`) and (`di`.`id_dosis` = `md`.`id_dosis`))))) */;

/*View structure for view v_detail_item_transaksiapotek */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksiapotek` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksiapotek` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksiapotek` AS select `item_transaksi_apotek`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_apotek`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_apotek`.`id_item_transaksi_apotek` AS `id_item_transaksi_apotek`,`item_transaksi_apotek`.`hrg_satuan` AS `hrg_satuan`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`item_transaksi_apotek`.`total` AS `total`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_apotek` join `transaksi` on((`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_apotek`.`id_item` = `master_item`.`id_item`))) left join `master_rekomendasi` on((`item_transaksi_apotek`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_apotek`.`id_item_transaksi_apotek`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksidak */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksidak` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksidak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksidak` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_dak`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_dak`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_dak` join `transaksi` on((`item_transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_dak`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_dak`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_dak`.`id_item_transaksi_dak`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksidokter */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksidokter` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksidokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksidokter` AS select `item_transaksi_dokter`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_dokter`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_dokter`.`id_transaksi_dokter` AS `id_transaksi_dokter`,`item_transaksi_dokter`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_dokter`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from (((((`item_transaksi_dokter` join `master_item` on((`item_transaksi_dokter`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_dokter`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on((`dosis_item`.`id_item` = `master_item`.`id_item`))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_dokter`.`id_transaksi_dokter`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksigigi */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksigigi` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksigigi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksigigi` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_gigi`.`id_item_transaksi_gigi` AS `id_item_transaksi_gigi`,`item_transaksi_gigi`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_gigi`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_gigi`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_gigi` join `transaksi` on((`item_transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_gigi`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_gigi`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_gigi`.`id_item_transaksi_gigi`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksilab */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksilab` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksilab` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksilab` AS select `itlab`.`id_transaksi` AS `id_transaksi`,`itlab`.`id_item_transaksi_lab` AS `id_item_transaksi_lab`,`mi`.`nama_item` AS `nama_item`,`mi`.`idjns_item` AS `idjns_item`,`itlab`.`nilai` AS `nilai`,`itlab`.`rontgen` AS `rontgen`,`ji`.`jenis_item` AS `jenis_item`,`itlab`.`hasil` AS `hasil` from ((`item_transaksi_lab` `itlab` join `master_item` `mi` on((`mi`.`id_item` = `itlab`.`id_item`))) left join `jenis_item` `ji` on((`ji`.`idjns_item` = `mi`.`idjns_item`))) */;

/*View structure for view v_detail_item_transaksilain */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksilain` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksilain` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksilain` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_lain`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_lain`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_lain`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_lain` join `transaksi` on((`item_transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_lain`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_lain`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_lain`.`id_item_transaksi_lain`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksioptik */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksioptik` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksioptik` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksioptik` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`item_transaksi_optik`.`id_item_transaksi_optik` AS `id_item_transaksi_optik`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_optik`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_optik`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_optik`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_optik` join `transaksi` on((`item_transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_optik`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_optik`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_optik`.`id_item_transaksi_optik`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksipenunjang */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksipenunjang` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksipenunjang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksipenunjang` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`item_transaksi_penunjang`.`id_item_transaksi_penunjang` AS `id_item_transaksi_penunjang`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_penunjang`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_penunjang`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_penunjang`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_penunjang` join `transaksi` on((`item_transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_penunjang`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_penunjang`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_penunjang`.`id_item_transaksi_penunjang`,`dosis_item`.`id_item` */;

/*View structure for view v_detail_item_transaksirs */

/*!50001 DROP TABLE IF EXISTS `v_detail_item_transaksirs` */;
/*!50001 DROP VIEW IF EXISTS `v_detail_item_transaksirs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_item_transaksirs` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`jenis_item`.`jenis_item` AS `jenis_item`,`item_transaksi_rs`.`id_item_transaksi_rs` AS `id_item_transaksi_rs`,`master_item`.`nama_item` AS `nama_item`,`item_transaksi_rs`.`jumlah` AS `jumlah`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_rs`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_rs`.`total` AS `total`,`master_rekomendasi`.`nama_rekomendasi` AS `nama_rekomendasi`,`master_dosis`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_rs` join `transaksi` on((`item_transaksi_rs`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_rs`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) left join `master_rekomendasi` on((`item_transaksi_rs`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`))) left join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) left join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) group by `item_transaksi_rs`.`id_item_transaksi_rs`,`dosis_item`.`id_dosis` */;

/*View structure for view v_diagnosa */

/*!50001 DROP TABLE IF EXISTS `v_diagnosa` */;
/*!50001 DROP VIEW IF EXISTS `v_diagnosa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_diagnosa` AS select `td`.`id_transaksi` AS `id_transaksi`,`md`.`nama_diagnosa` AS `nama_diagnosa`,`md`.`id_diagnosa` AS `id_diagnosa`,`td`.`id_transaksi_diagnosa` AS `id_transaksi_diagnosa` from (`transaksi_diagnosa` `td` join `master_diagnosa` `md` on((`md`.`id_diagnosa` = `td`.`id_diagnosa`))) */;

/*View structure for view v_hasiltransaksiapotek */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksiapotek` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksiapotek` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksiapotek` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`transaksi_apotek`.`no_surat` AS `no_surat`,`transaksi_apotek`.`no_bukti` AS `no_bukti`,`master_buku_besar`.`buku_besar` AS `buku_besar`,`transaksi_apotek`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_rujukan`.`nama_rujukan` AS `nama_rujukan`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,`transaksi_apotek`.`no_dak` AS `no_dak`,`transaksi_diagnosa`.`id_transaksi_diagnosa` AS `id_transaksi_diagnosa`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`item_transaksi_apotek`.`id_item_transaksi_apotek` AS `id_item_transaksi_apotek`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_apotek`.`hrg_satuan` AS `hrg_satuan`,`item_transaksi_apotek`.`jumlah` AS `jumlah`,coalesce(`item_transaksi_apotek`.`total`,(`item_transaksi_apotek`.`hrg_satuan` * `item_transaksi_apotek`.`jumlah`)) AS `total`,(`master_item`.`harga_item` * `item_transaksi_apotek`.`jumlah`) AS `koreksi`,(coalesce(`item_transaksi_apotek`.`total`,(`item_transaksi_apotek`.`hrg_satuan` * `item_transaksi_apotek`.`jumlah`)) - (`master_item`.`harga_item` * `item_transaksi_apotek`.`jumlah`)) AS `selisih` from ((((((((((((((`transaksi_apotek` join `transaksi` on((`transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `master_rujukan` on((`transaksi_apotek`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) join `master_provider` on((`transaksi_apotek`.`id_provider` = `master_provider`.`id_provider`))) left join `master_dokter` on((`transaksi_apotek`.`id_dokter` = `master_dokter`.`id_dokter`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) join `item_transaksi_apotek` on((`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_item` on((`item_transaksi_apotek`.`id_item` = `master_item`.`id_item`))) left join `master_buku_besar` on((`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`))) group by `item_transaksi_apotek`.`id_item_transaksi_apotek` */;

/*View structure for view v_hasiltransaksidak */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksidak` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksidak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksidak` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`jenis_kunjungan`.`idjenis_kunjungan` AS `idjenis_kunjungan`,`jenis_kunjungan`.`nama_kunjungan` AS `nama_kunjungan`,`transaksi_dak`.`no_bukti` AS `no_bukti`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_rujukan`.`id_rujukan` AS `id_rujukan`,`master_rujukan`.`nama_rujukan` AS `nama_rujukan`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`periksa_dak`.`anamnesis` AS `anamnesis`,`periksa_dak`.`kondisi` AS `kondisi`,`periksa_dak`.`kesadaran` AS `kesadaran`,`periksa_dak`.`suhu` AS `suhu`,`periksa_dak`.`berat` AS `berat`,`periksa_dak`.`tinggi` AS `tinggi`,`periksa_dak`.`nadi` AS `nadi`,`periksa_dak`.`sistole` AS `sistole`,`periksa_dak`.`diastole` AS `diastole`,`periksa_dak`.`pernafasan` AS `pernafasan`,`periksa_dak`.`riwayat_alergi` AS `riwayat_alergi`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi_dak` join `transaksi` on((`transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `master_rujukan` on((`transaksi_dak`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) left join `master_dokter` on((`transaksi_dak`.`id_dokter` = `master_dokter`.`id_dokter`))) left join `periksa_dak` on((`periksa_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `jenis_kunjungan` on((`periksa_dak`.`idjenis_kunjungan` = `jenis_kunjungan`.`idjenis_kunjungan`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransaksidokter */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksidokter` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksidokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksidokter` AS select `td`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`td`.`no_surat` AS `no_surat`,`td`.`no_bukti` AS `no_bukti`,`td`.`restitusi` AS `restitusi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mt`.`status` AS `status`,`mb`.`buku_besar` AS `buku_besar`,(select group_concat(`md`.`nama_diagnosa` separator ',') from (`transaksi_diagnosa` `tdi` join `master_diagnosa` `md` on((`md`.`id_diagnosa` = `tdi`.`id_diagnosa`))) where (`tdi`.`id_transaksi` = `itd`.`id_transaksi`)) AS `nama_diagnosa`,`mdo`.`nama_dokter` AS `nama_dokter`,`td`.`tarif_satuan_dokter` AS `total`,`itd`.`jumlah` AS `jumlah`,(sum(coalesce(`itd`.`total`,(`itd`.`jumlah` * `itd`.`hrg_satuan`))) + coalesce(`td`.`tarif_satuan_dokter`,0)) AS `total_satuan`,(sum(coalesce(`itd`.`total`,(`itd`.`jumlah` * `mi`.`harga_item`))) + coalesce(`td`.`tarif_standar_dokter`,0)) AS `total_standar`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`itd`.`id_item` AS `id_item` from (((((((((`transaksi_dokter` `td` join `transaksi` `t` on((`t`.`id_transaksi` = `td`.`id_transaksi`))) left join `master_dokter` `mdo` on((`mdo`.`id_dokter` = `td`.`id_dokter`))) left join `item_transaksi_dokter` `itd` on((`itd`.`id_transaksi` = `td`.`id_transaksi`))) left join `master_item` `mi` on((`mi`.`id_item` = `itd`.`id_item`))) join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `td`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) group by `td`.`id_transaksi` */;

/*View structure for view v_hasiltransaksigigi */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksigigi` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksigigi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksigigi` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`transaksi_gigi`.`no_surat` AS `no_surat`,`transaksi_gigi`.`no_bukti` AS `no_bukti`,`transaksi_gigi`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_buku_besar`.`buku_besar` AS `buku_besar` from (((((((((((`transaksi_gigi` join `transaksi` on((`transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) join `master_dokter` on((`transaksi_gigi`.`id_dokter` = `master_dokter`.`id_dokter`))) join `master_provider` on((`transaksi_gigi`.`id_provider` = `master_provider`.`id_provider`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) left join `master_buku_besar` on((`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransaksikunjunganrs */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksikunjunganrs` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksikunjunganrs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksikunjunganrs` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi_kunjungan_rs`.`tgl_masuk` AS `tgl_masuk`,`transaksi_kunjungan_rs`.`tgl_keluar` AS `tgl_keluar`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_provider`.`nama_provider` AS `nama_provider`,`periksa_kunjungan_rs`.`diagnosa_masuk` AS `diagnosa_masuk`,`periksa_kunjungan_rs`.`kondisi` AS `kondisi`,`periksa_kunjungan_rs`.`dokter_rawat` AS `dokter_rawat`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`periksa_kunjungan_rs`.`tindakan` AS `tindakan`,`periksa_kunjungan_rs`.`jenis_jml_obat` AS `jenis_jml_obat`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra` from (((((((((`transaksi_kunjungan_rs` join `transaksi` on((`transaksi_kunjungan_rs`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) join `master_provider` on((`transaksi_kunjungan_rs`.`id_provider` = `master_provider`.`id_provider`))) join `periksa_kunjungan_rs` on((`periksa_kunjungan_rs`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_dokter` on((`periksa_kunjungan_rs`.`id_dokter` = `master_dokter`.`id_dokter`))) */;

/*View structure for view v_hasiltransaksilab */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksilab` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksilab` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksilab` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`transaksi_lab`.`no_surat` AS `no_surat`,`transaksi_lab`.`no_bukti` AS `no_bukti`,`transaksi_lab`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_buku_besar`.`buku_besar` AS `buku_besar` from ((((((((((((`transaksi_lab` join `transaksi` on((`transaksi_lab`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `master_rujukan` on((`transaksi_lab`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) left join `master_dokter` on((`transaksi_lab`.`id_dokter` = `master_dokter`.`id_dokter`))) left join `master_provider` on((`transaksi_lab`.`id_provider` = `master_provider`.`id_provider`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) left join `master_buku_besar` on((`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransaksilain */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksilain` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksilain` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksilain` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`transaksi_lain`.`no_surat` AS `no_surat`,`transaksi_lain`.`no_bukti` AS `no_bukti`,`transaksi_lain`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_rujukan`.`nama_rujukan` AS `nama_rujukan`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_buku_besar`.`buku_besar` AS `buku_besar` from ((((((((((((`transaksi_lain` join `transaksi` on((`transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `master_rujukan` on((`transaksi_lain`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) left join `master_dokter` on((`transaksi_lain`.`id_dokter` = `master_dokter`.`id_dokter`))) left join `master_provider` on((`transaksi_lain`.`id_provider` = `master_provider`.`id_provider`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) left join `master_buku_besar` on((`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransaksioptik */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksioptik` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksioptik` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksioptik` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`transaksi_optik`.`no_surat` AS `no_surat`,`transaksi_optik`.`no_bukti` AS `no_bukti`,`transaksi_optik`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_buku_besar`.`buku_besar` AS `buku_besar` from (((((((((((`transaksi_optik` join `transaksi` on((`transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `master_dokter` on((`transaksi_optik`.`id_dokter` = `master_dokter`.`id_dokter`))) left join `master_provider` on((`transaksi_optik`.`id_provider` = `master_provider`.`id_provider`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) left join `master_buku_besar` on((`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransaksipenunjang */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksipenunjang` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksipenunjang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksipenunjang` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`transaksi_penunjang`.`no_surat` AS `no_surat`,`transaksi_penunjang`.`no_bukti` AS `no_bukti`,`transaksi_penunjang`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_rujukan`.`id_rujukan` AS `id_rujukan`,`master_rujukan`.`nama_rujukan` AS `nama_rujukan`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_buku_besar`.`buku_besar` AS `buku_besar` from ((((((((((((`transaksi_penunjang` join `transaksi` on((`transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `master_provider` on((`transaksi_penunjang`.`id_provider` = `master_provider`.`id_provider`))) left join `master_dokter` on((`transaksi_penunjang`.`id_dokter` = `master_dokter`.`id_dokter`))) left join `master_rujukan` on((`transaksi_penunjang`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) left join `master_buku_besar` on((`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransaksirm */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksirm` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksirm` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksirm` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi_rekam_medis`.`tgl_masuk` AS `tgl_masuk`,`transaksi_rekam_medis`.`tgl_keluar` AS `tgl_keluar`,`transaksi_rekam_medis`.`no_kamar` AS `no_rm`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_provider`.`nama_provider` AS `nama_provider`,`periksa_rekam_medis`.`diagnosa_masuk` AS `diagnosa_masuk`,`periksa_rekam_medis`.`diagnosa_keluar` AS `diagnosa_keluar`,`periksa_rekam_medis`.`riwayat` AS `riwayat`,`periksa_rekam_medis`.`periksa_fisik` AS `periksa_fisik`,`periksa_rekam_medis`.`hasil_lab` AS `hasil_lab`,`periksa_rekam_medis`.`hasil_rontgen` AS `hasil_rontgen`,`periksa_rekam_medis`.`hasil_lain` AS `hasil_lain`,`periksa_rekam_medis`.`progres_harian` AS `progres_harian`,`periksa_rekam_medis`.`pasca_rawat` AS `pasca_rawat`,`periksa_rekam_medis`.`tindakan` AS `tindakan`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra` from ((((((((`transaksi_rekam_medis` join `transaksi` on((`transaksi_rekam_medis`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) join `master_provider` on((`transaksi_rekam_medis`.`id_provider` = `master_provider`.`id_provider`))) left join `periksa_rekam_medis` on((`periksa_rekam_medis`.`id_transaksi` = `transaksi`.`id_transaksi`))) */;

/*View structure for view v_hasiltransaksirs */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransaksirs` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransaksirs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransaksirs` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi_rmh_sakit`.`no_surat` AS `no_surat`,`transaksi_rmh_sakit`.`no_bukti` AS `no_bukti`,`transaksi_rmh_sakit`.`restitusi` AS `restitusi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`transaksi_rmh_sakit`.`tgl_masuk` AS `tgl_masuk`,`transaksi_rmh_sakit`.`tgl_keluar` AS `tgl_keluar`,`jenis_rawat`.`nama_rawat` AS `nama_rawat`,`master_provider`.`nama_provider` AS `nama_provider`,group_concat(`master_diagnosa`.`nama_diagnosa` separator ',') AS `nama_diagnosa`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_buku_besar`.`buku_besar` AS `buku_besar` from (((((((((((`transaksi_rmh_sakit` join `transaksi` on((`transaksi_rmh_sakit`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `jenis_rawat` on((`transaksi_rmh_sakit`.`idjenis_rawat` = `jenis_rawat`.`idjenis_rawat`))) left join `master_provider` on((`transaksi_rmh_sakit`.`id_provider` = `master_provider`.`id_provider`))) left join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) left join `master_buku_besar` on((`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_hasiltransapotek */

/*!50001 DROP TABLE IF EXISTS `v_hasiltransapotek` */;
/*!50001 DROP VIEW IF EXISTS `v_hasiltransapotek` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hasiltransapotek` AS select `transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_tertanggung`.`status` AS `status`,`master_rujukan`.`nama_rujukan` AS `nama_rujukan`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_provider`.`nama_provider` AS `nama_provider`,`transaksi_apotek`.`no_bukti` AS `no_bukti`,`jenis_item`.`jenis_item` AS `jenis_item`,`master_item`.`nama_item` AS `nama_item`,`master_item`.`oral_item` AS `oral_item`,`master_item`.`hba_item` AS `hba_item`,`master_item`.`harga_item` AS `harga_item`,`item_transaksi_apotek`.`jumlah` AS `jumlah`,`item_transaksi_apotek`.`disetujui` AS `disetujui`,`master_dosis`.`jml_dosis` AS `jml_dosis`,`master_diagnosa`.`nama_diagnosa` AS `nama_diagnosa`,`master_diagnosa`.`jenis_penyakit` AS `jenis_penyakit` from (((((((((((((`transaksi_apotek` join `transaksi` on((`transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_rujukan` on((`transaksi_apotek`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) join `master_dokter` on((`transaksi_apotek`.`id_dokter` = `master_dokter`.`id_dokter`))) join `master_provider` on((`transaksi_apotek`.`id_provider` = `master_provider`.`id_provider`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `item_transaksi_apotek` on((`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_item` on((`item_transaksi_apotek`.`id_item` = `master_item`.`id_item`))) join `jenis_item` on((`master_item`.`idjns_item` = `jenis_item`.`idjns_item`))) join `dosis_item` on(((`dosis_item`.`id_item` = `master_item`.`id_item`) and (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)))) join `master_dosis` on((`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`))) join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) */;

/*View structure for view v_item_transaksi_all */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_all` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_all` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_all` AS select `a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`hba_item` AS `hba_item`,`b`.`idjns_item` AS `idjns_item` from (`item_transaksi_apotek` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`hba_item` AS `hba_item`,`b`.`idjns_item` AS `idjns_item` from (`item_transaksi_dokter` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`hba_item` AS `hba_item`,`b`.`idjns_item` AS `idjns_item` from (`item_transaksi_gigi` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`hba_item` AS `hba_item`,`b`.`idjns_item` AS `idjns_item` from (`item_transaksi_lain` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`hba_item` AS `hba_item`,`b`.`idjns_item` AS `idjns_item` from (`item_transaksi_optik` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`hba_item` AS `hba_item`,`b`.`idjns_item` AS `idjns_item` from (`item_transaksi_penunjang` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`))) order by `id_transaksi` */;

/*View structure for view v_item_transaksi_apotek */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_apotek` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_apotek` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_apotek` AS (select `a`.`id_item_transaksi_apotek` AS `id_item_transaksi_apotek`,`a`.`id_transaksi` AS `id_transaksi`,`d`.`jenis_item` AS `jenis_item`,`a`.`id_item` AS `id_item`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,(`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,((`b`.`harga_item` * `a`.`jumlah`) - (`a`.`hrg_satuan` * `a`.`jumlah`)) AS `selisih`,`a`.`racikan` AS `racikan`,`a`.`disetujui` AS `disetujui`,`f`.`nama_dosis` AS `nama_dosis`,`c`.`nama_rekomendasi` AS `nama_rekomendasi` from (((((`item_transaksi_apotek` `a` join `master_item` `b`) join `master_rekomendasi` `c`) join `jenis_item` `d`) join `dosis_item` `e`) join `master_dosis` `f` on(((`a`.`id_item` = `b`.`id_item`) and (`a`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`b`.`idjns_item` = `d`.`idjns_item`) and (`b`.`id_item` = `e`.`id_item`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`e`.`id_dosis` = `f`.`id_dosis`)))) group by `a`.`id_item_transaksi_apotek`) */;

/*View structure for view v_item_transaksi_dak */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_dak` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_dak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_dak` AS (select `a`.`id_item_transaksi_dak` AS `id_item_transaksi_dak`,`a`.`id_transaksi` AS `id_transaksi`,`d`.`jenis_item` AS `jenis_item`,`a`.`id_item` AS `id_item`,`b`.`nama_item` AS `nama_item`,`a`.`jumlah` AS `jumlah`,`a`.`racikan` AS `racikan`,`a`.`disetujui` AS `disetujui`,`f`.`nama_dosis` AS `nama_dosis`,`c`.`nama_rekomendasi` AS `nama_rekomendasi` from (((((`item_transaksi_dak` `a` join `master_item` `b`) join `master_rekomendasi` `c`) join `jenis_item` `d`) join `dosis_item` `e`) join `master_dosis` `f` on(((`a`.`id_item` = `b`.`id_item`) and (`a`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`b`.`idjns_item` = `d`.`idjns_item`) and (`b`.`id_item` = `e`.`id_item`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`e`.`id_dosis` = `f`.`id_dosis`)))) group by `a`.`id_item_transaksi_dak`) */;

/*View structure for view v_item_transaksi_dokter */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_dokter` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_dokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_dokter` AS (select `a`.`id_transaksi_dokter` AS `id_transaksi_dokter`,`a`.`id_transaksi` AS `id_transaksi`,`d`.`jenis_item` AS `jenis_item`,`a`.`id_item` AS `id_item`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,(`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,((`b`.`harga_item` * `a`.`jumlah`) - (`a`.`hrg_satuan` * `a`.`jumlah`)) AS `selisih`,`a`.`disetujui` AS `disetujui`,`f`.`nama_dosis` AS `nama_dosis`,`c`.`nama_rekomendasi` AS `nama_rekomendasi` from (((((`item_transaksi_dokter` `a` join `master_item` `b`) join `master_rekomendasi` `c`) join `jenis_item` `d`) join `dosis_item` `e`) join `master_dosis` `f` on(((`a`.`id_item` = `b`.`id_item`) and (`a`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`b`.`idjns_item` = `d`.`idjns_item`) and (`b`.`id_item` = `e`.`id_item`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`e`.`id_dosis` = `f`.`id_dosis`)))) group by `a`.`id_transaksi_dokter`) */;

/*View structure for view v_item_transaksi_lab */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_lab` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_lab` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_lab` AS (select `a`.`id_item_transaksi_lab` AS `id_item_transaksi_lab`,`a`.`id_transaksi` AS `id_transaksi`,`b`.`nama_item` AS `nama_item`,`a`.`hasil` AS `hasil`,`a`.`nilai` AS `nilai`,`a`.`rontgen` AS `rontgen` from (`item_transaksi_lab` `a` join `master_item` `b` on((`a`.`id_item` = `b`.`id_item`)))) */;

/*View structure for view v_item_transaksi_lain */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_lain` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_lain` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_lain` AS (select `a`.`id_item_transaksi_lain` AS `id_item_transaksi_lain`,`a`.`id_transaksi` AS `id_transaksi`,`d`.`jenis_item` AS `jenis_item`,`a`.`id_item` AS `id_item`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,(`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,((`b`.`harga_item` * `a`.`jumlah`) - (`a`.`hrg_satuan` * `a`.`jumlah`)) AS `selisih`,`a`.`disetujui` AS `disetujui`,`f`.`nama_dosis` AS `nama_dosis`,`c`.`nama_rekomendasi` AS `nama_rekomendasi` from (((((`item_transaksi_lain` `a` join `master_item` `b`) join `master_rekomendasi` `c`) join `jenis_item` `d`) join `dosis_item` `e`) join `master_dosis` `f` on(((`a`.`id_item` = `b`.`id_item`) and (`a`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`b`.`idjns_item` = `d`.`idjns_item`) and (`b`.`id_item` = `e`.`id_item`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`e`.`id_dosis` = `f`.`id_dosis`)))) group by `a`.`id_item_transaksi_lain`) */;

/*View structure for view v_item_transaksi_optik */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_optik` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_optik` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_optik` AS (select `a`.`id_item_transaksi_optik` AS `id_item_transaksi_optik`,`a`.`id_transaksi` AS `id_transaksi`,`c`.`jenis_item` AS `jenis_item`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,(`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,((`b`.`harga_item` * `a`.`jumlah`) - (`a`.`hrg_satuan` * `a`.`jumlah`)) AS `selisih`,`a`.`disetujui` AS `disetujui`,`d`.`nama_rekomendasi` AS `nama_rekomendasi` from (((`item_transaksi_optik` `a` join `master_item` `b`) join `jenis_item` `c`) join `master_rekomendasi` `d` on(((`a`.`id_item` = `b`.`id_item`) and (`b`.`idjns_item` = `c`.`idjns_item`) and (`a`.`id_rekomendasi` = `d`.`id_rekomendasi`)))) group by `a`.`id_item_transaksi_optik`) */;

/*View structure for view v_item_transaksi_ov */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_ov` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_ov` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_ov` AS (select `a`.`id_transaksi_ov` AS `id_transaksi_ov`,`b`.`nama_dokter` AS `nama_dokter`,`b`.`tarif_standar` AS `tarif_standar`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,(`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,`a`.`ov` AS `ov`,`c`.`nama_rekomendasi` AS `nama_rekomendasi`,`a`.`disetujui` AS `disetujui` from ((`transaksi_ov` `a` join `master_dokter` `b`) join `master_rekomendasi` `c` on(((`a`.`id_dokter` = `b`.`id_dokter`) and (`a`.`d_rekomendasi` = `c`.`id_rekomendasi`)))) group by `a`.`id_transaksi_ov`) */;

/*View structure for view v_item_transaksi_penunjang */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_penunjang` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_penunjang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_penunjang` AS (select `a`.`id_item_transaksi_penunjang` AS `id_item_transaksi_penunjang`,`a`.`id_transaksi` AS `id_transaksi`,`a`.`disetujui` AS `disetujui`,`a`.`jumlah` AS `jumlah`,`a`.`kesimpulan` AS `kesimpulan`,`a`.`nilai` AS `nilai`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`id_item` AS `id_item`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,`d`.`jenis_item` AS `jenis_item`,`c`.`nama_rekomendasi` AS `nama_rekomendasi`,(`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,((`b`.`harga_item` * `a`.`jumlah`) - (`a`.`hrg_satuan` * `a`.`jumlah`)) AS `selisih` from (((`item_transaksi_penunjang` `a` join `master_item` `b`) join `master_rekomendasi` `c`) join `jenis_item` `d` on(((`a`.`id_item` = `b`.`id_item`) and (`a`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`b`.`idjns_item` = `d`.`idjns_item`)))) group by `a`.`id_item_transaksi_penunjang`) */;

/*View structure for view v_item_transaksi_rs */

/*!50001 DROP TABLE IF EXISTS `v_item_transaksi_rs` */;
/*!50001 DROP VIEW IF EXISTS `v_item_transaksi_rs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_rs` AS (select `a`.`id_item_transaksi_rs` AS `id_item_transaksi_rs`,`a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_resep` AS `tgl_resep`,`a`.`hrg_satuan` AS `hrg_satuan`,`a`.`jumlah` AS `jumlah`,`b`.`nama_item` AS `nama_item`,`b`.`harga_item` AS `harga_item`,(`a`.`jumlah` * `b`.`harga_item`) AS `total`,((`a`.`jumlah` * `b`.`harga_item`) - (`a`.`hrg_satuan` * `a`.`jumlah`)) AS `selisih`,`b`.`idjns_item` AS `idjns_item`,`c`.`jenis_item` AS `jenis_item`,`a`.`disetujui` AS `disetujui`,`a`.`kandungan` AS `kandungan`,`a`.`nilai` AS `nilai`,`d`.`nama_dokter` AS `nama_dokter`,`e`.`nama_rekomendasi` AS `nama_rekomendasi`,`f`.`id_item` AS `id_item`,`g`.`nama_dosis` AS `nama_dosis` from ((((((`item_transaksi_rs` `a` join `master_item` `b`) join `jenis_item` `c`) join `master_dokter` `d`) join `master_rekomendasi` `e`) join `dosis_item` `f`) join `master_dosis` `g` on(((`a`.`id_item` = `b`.`id_item`) and (`b`.`idjns_item` = `c`.`idjns_item`) and (`a`.`id_dokter` = `d`.`id_dokter`) and (`a`.`id_rekomendasi` = `e`.`id_rekomendasi`) and (`a`.`id_item` = `f`.`id_item`) and (`a`.`id_transaksi` = `f`.`id_transaksi`) and (`g`.`id_dosis` = `f`.`id_dosis`)))) group by `a`.`id_item_transaksi_rs`) */;

/*View structure for view v_laporan_biaya */

/*!50001 DROP TABLE IF EXISTS `v_laporan_biaya` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_biaya` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_biaya` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`l`.`buku_besar` AS `buku_besar`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(case when (`c`.`disetujui` = _latin1't') then (`c`.`hrg_satuan` * `c`.`jumlah`) when (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0) then ((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) end) AS `selisih`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `master_buku_besar` `l`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`c`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`a`.`id_transaksi` = `l`.`id_transaksi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where ((`c`.`disetujui` = _latin1't') or (((`c`.`hrg_satuan` * `c`.`jumlah`) - (`d`.`harga_item` * `c`.`jumlah`)) > 0)) */;

/*View structure for view v_laporan_detail */

/*!50001 DROP TABLE IF EXISTS `v_laporan_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_detail` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,(`c`.`jumlah` * `c`.`hrg_satuan`) AS `total`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`c`.`disetujui` AS `disetujui`,`n`.`nama_rekomendasi` AS `nama_rekomendasi`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `master_rekomendasi` `n`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`c`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`n`.`id_rekomendasi` = `c`.`id_rekomendasi`) and (`a`.`id_transaksi` = `o`.`id_transaksi`) and (`o`.`id_diagnosa` = `p`.`id_diagnosa`)))) */;

/*View structure for view v_laporan_detail_bukubesar */

/*!50001 DROP TABLE IF EXISTS `v_laporan_detail_bukubesar` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_detail_bukubesar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_detail_bukubesar` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,_utf8'Rawat Jalan' AS `rawat`,`b`.`no_bukti` AS `no_bukti`,`b`.`no_surat` AS `no_surat`,`b`.`restitusi` AS `restitusi`,_utf8'Apotek' AS `kunjungan`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `total`,`h`.`ap` AS `ap`,`d`.`buku_besar` AS `buku_besar`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_buku_besar` `d`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `d`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,_utf8'Rawat Jalan' AS `rawat`,`b`.`no_bukti` AS `no_bukti`,`b`.`no_surat` AS `no_surat`,`b`.`restitusi` AS `restitusi`,_utf8'Lab Gigi' AS `kunjungan`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `total`,`h`.`ap` AS `ap`,`d`.`buku_besar` AS `buku_besar`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_buku_besar` `d`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `d`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,_utf8'Rawat Jalan' AS `rawat`,`b`.`no_bukti` AS `no_bukti`,`b`.`no_surat` AS `no_surat`,`b`.`restitusi` AS `restitusi`,_utf8'Lain' AS `kunjungan`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `total`,`h`.`ap` AS `ap`,`d`.`buku_besar` AS `buku_besar`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_buku_besar` `d`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `d`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,_utf8'Rawat Jalan' AS `rawat`,`b`.`no_bukti` AS `no_bukti`,`b`.`no_surat` AS `no_surat`,`b`.`restitusi` AS `restitusi`,_utf8'Optik' AS `kunjungan`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `total`,`h`.`ap` AS `ap`,`d`.`buku_besar` AS `buku_besar`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_buku_besar` `d`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `d`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,_utf8'Rawat Jalan' AS `rawat`,`b`.`no_bukti` AS `no_bukti`,`b`.`no_surat` AS `no_surat`,`b`.`restitusi` AS `restitusi`,_utf8'Penunjang' AS `kunjungan`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `total`,`h`.`ap` AS `ap`,`d`.`buku_besar` AS `buku_besar`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_buku_besar` `d`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `d`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`e`.`nama_rawat` AS `rawat`,`b`.`no_bukti` AS `no_bukti`,`b`.`no_surat` AS `no_surat`,`b`.`restitusi` AS `restitusi`,_utf8'Rumah Sakit' AS `kunjungan`,sum(coalesce(`c`.`total`,(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `total`,`h`.`ap` AS `ap`,`d`.`buku_besar` AS `buku_besar`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_buku_besar` `d`) join `jenis_rawat` `e`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `d`.`id_transaksi`) and (`b`.`idjenis_rawat` = `e`.`idjenis_rawat`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) group by `a`.`id_transaksi` order by `id_transaksi` */;

/*View structure for view v_laporan_lebihhet */

/*!50001 DROP TABLE IF EXISTS `v_laporan_lebihhet` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_lebihhet` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_lebihhet` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`m`.`nama_provider` AS `nama_provider`,_utf8'Rawat Jalan' AS `rawat`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,round(((`d`.`hba_item` + (0.1 * `d`.`hba_item`)) + (0.25 * (`d`.`hba_item` + (0.1 * `d`.`hba_item`)))),0) AS `het`,`c`.`hrg_satuan` AS `hrg_satuan`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_provider` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`b`.`id_provider` = `m`.`id_provider`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`c`.`hrg_satuan` > `het`) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`m`.`nama_provider` AS `nama_provider`,_utf8'Rawat Jalan' AS `rawat`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,round(((`d`.`hba_item` + (0.1 * `d`.`hba_item`)) + (0.25 * (`d`.`hba_item` + (0.1 * `d`.`hba_item`)))),0) AS `het`,`c`.`hrg_satuan` AS `hrg_satuan`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_provider` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`b`.`id_provider` = `m`.`id_provider`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`c`.`hrg_satuan` > `het`) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`m`.`nama_provider` AS `nama_provider`,_utf8'Rawat Jalan' AS `rawat`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,round(((`d`.`hba_item` + (0.1 * `d`.`hba_item`)) + (0.25 * (`d`.`hba_item` + (0.1 * `d`.`hba_item`)))),0) AS `het`,`c`.`hrg_satuan` AS `hrg_satuan`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_provider` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`b`.`id_provider` = `m`.`id_provider`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`c`.`hrg_satuan` > `het`) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`m`.`nama_provider` AS `nama_provider`,_utf8'Rawat Jalan' AS `rawat`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,round(((`d`.`hba_item` + (0.1 * `d`.`hba_item`)) + (0.25 * (`d`.`hba_item` + (0.1 * `d`.`hba_item`)))),0) AS `het`,`c`.`hrg_satuan` AS `hrg_satuan`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_provider` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`b`.`id_provider` = `m`.`id_provider`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`c`.`hrg_satuan` > `het`) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`m`.`nama_provider` AS `nama_provider`,_utf8'Rawat Jalan' AS `rawat`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,round(((`d`.`hba_item` + (0.1 * `d`.`hba_item`)) + (0.25 * (`d`.`hba_item` + (0.1 * `d`.`hba_item`)))),0) AS `het`,`c`.`hrg_satuan` AS `hrg_satuan`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_provider` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`b`.`id_provider` = `m`.`id_provider`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`c`.`hrg_satuan` > `het`) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`m`.`nama_provider` AS `nama_provider`,`n`.`nama_rawat` AS `rawat`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,round(((`d`.`hba_item` + (0.1 * `d`.`hba_item`)) + (0.25 * (`d`.`hba_item` + (0.1 * `d`.`hba_item`)))),0) AS `het`,`c`.`hrg_satuan` AS `hrg_satuan`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_provider` `m`) join `jenis_rawat` `n`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`c`.`id_dokter` = `i`.`id_dokter`) and (`b`.`id_provider` = `m`.`id_provider`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`b`.`idjenis_rawat` = `n`.`idjenis_rawat`)))) having (`c`.`hrg_satuan` > `het`) */;

/*View structure for view v_laporan_obatberlebih */

/*!50001 DROP TABLE IF EXISTS `v_laporan_obatberlebih` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_obatberlebih` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_obatberlebih` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`f`.`nama_dosis` AS `nama_dosis`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,if((substr(`f`.`nama_dosis`,4) = _latin1'1/2'),(round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1) * 2),(substr(`f`.`nama_dosis`,4) * round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1))) AS `jumlah_hari`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`jumlah_hari` > 15) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`f`.`nama_dosis` AS `nama_dosis`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,if((substr(`f`.`nama_dosis`,4) = _latin1'1/2'),(round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1) * 2),(substr(`f`.`nama_dosis`,4) * round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1))) AS `jumlah_hari`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`jumlah_hari` > 15) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`f`.`nama_dosis` AS `nama_dosis`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,if((substr(`f`.`nama_dosis`,4) = _latin1'1/2'),(round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1) * 2),(substr(`f`.`nama_dosis`,4) * round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1))) AS `jumlah_hari`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`jumlah_hari` > 15) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`f`.`nama_dosis` AS `nama_dosis`,((`c`.`jumlah` * `d`.`harga_item`) - (`c`.`jumlah` * `c`.`hrg_satuan`)) AS `selisih`,if((substr(`f`.`nama_dosis`,4) = _latin1'1/2'),(round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1) * 2),(substr(`f`.`nama_dosis`,4) * round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1))) AS `jumlah_hari`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`c`.`id_dokter` = `i`.`id_dokter`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) having (`jumlah_hari` > 15) order by `id_transaksi` */;

/*View structure for view v_laporan_obatkeluarga */

/*!50001 DROP TABLE IF EXISTS `v_laporan_obatkeluarga` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_obatkeluarga` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_obatkeluarga` AS select `v_laporan_transaksi_all`.`id_transaksi` AS `id_transaksi`,`v_laporan_transaksi_all`.`tgl_transaksi` AS `tgl_transaksi`,`v_laporan_transaksi_all`.`tgl_kunjungan` AS `tgl_kunjungan`,`v_laporan_transaksi_all`.`nip` AS `nip`,`v_laporan_transaksi_all`.`nama_karyawan` AS `nama_karyawan`,`v_laporan_transaksi_all`.`ap` AS `ap`,`v_laporan_transaksi_all`.`nama_tertanggung` AS `nama_tertanggung`,`v_laporan_transaksi_all`.`status` AS `status`,`v_laporan_transaksi_all`.`nama_dokter` AS `nama_dokter`,`v_laporan_transaksi_all`.`kategori` AS `kategori`,`v_laporan_transaksi_all`.`biaya` AS `biaya`,`v_laporan_transaksi_all`.`selisih` AS `selisih`,`v_laporan_transaksi_all`.`id_rayon` AS `id_rayon`,`v_laporan_transaksi_all`.`id_wilayah` AS `id_wilayah`,`v_laporan_transaksi_all`.`id_mitra` AS `id_mitra` from `v_laporan_transaksi_all` where (`v_laporan_transaksi_all`.`tgl_transaksi` in (select `v_laporan_transaksi_all`.`tgl_transaksi` AS `tgl_transaksi` from `v_laporan_transaksi_all` group by `v_laporan_transaksi_all`.`tgl_transaksi`,`v_laporan_transaksi_all`.`nip` having (count(`v_laporan_transaksi_all`.`tgl_transaksi`) > 1)) and `v_laporan_transaksi_all`.`nip` in (select `v_laporan_transaksi_all`.`nip` AS `nip` from `v_laporan_transaksi_all` group by `v_laporan_transaksi_all`.`tgl_transaksi`,`v_laporan_transaksi_all`.`nip` having (count(`v_laporan_transaksi_all`.`nip`) > 1))) */;

/*View structure for view v_laporan_polifarmasi */

/*!50001 DROP TABLE IF EXISTS `v_laporan_polifarmasi` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_polifarmasi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_polifarmasi` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,count(`c`.`hrg_satuan`) AS `jumlah_item`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,(sum((`d`.`harga_item` * `c`.`jumlah`)) - sum((`c`.`hrg_satuan` * `c`.`jumlah`))) AS `selisih`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from (((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) group by `a`.`id_transaksi` having (`jumlah_item` > 4) */;

/*View structure for view v_laporan_postbiaya */

/*!50001 DROP TABLE IF EXISTS `v_laporan_postbiaya` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_postbiaya` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_postbiaya` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`m`.`buku_besar` AS `buku_besar`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`p`.`nama_diagnosa` AS `nama_diagnosa`,`p`.`jenis_penyakit` AS `jenis_penyakit`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `master_buku_besar` `m`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l`) join `transaksi_diagnosa` `o`) join `master_diagnosa` `p` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`c`.`id_dokter` = `i`.`id_dokter`) and (`a`.`id_transaksi` = `m`.`id_transaksi`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`) and (`o`.`id_transaksi` = `a`.`id_transaksi`) and (`p`.`id_diagnosa` = `o`.`id_diagnosa`)))) group by `a`.`id_transaksi` */;

/*View structure for view v_laporan_resepmahal */

/*!50001 DROP TABLE IF EXISTS `v_laporan_resepmahal` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_resepmahal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_resepmahal` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`d`.`nip` AS `nip`,`d`.`nama_karyawan` AS `nama_karyawan`,`d`.`ap` AS `ap`,`c`.`nama_tertanggung` AS `nama_tertanggung`,`c`.`status` AS `status`,`e`.`nama_dokter` AS `nama_dokter`,(case when (`e`.`kat_dokter` = _utf8'2') then _utf8'umum' else _utf8'spesialis' end) AS `kategori`,sum((`b`.`hrg_satuan` * `b`.`jumlah`)) AS `biaya`,(sum((`b`.`harga_item` * `b`.`jumlah`)) - sum((`b`.`hrg_satuan` * `b`.`jumlah`))) AS `selisih`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from (((((((`v_transaksi_all` `a` join `v_item_transaksi_all` `b`) join `master_tertanggung` `c`) join `master_karyawan` `d`) join `master_dokter` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`c`.`id_tertanggung` = `a`.`id_tertanggung`) and (`d`.`id_karyawan` = `c`.`id_karyawan`) and (`e`.`id_dokter` = `a`.`id_dokter`) and (`f`.`id_rayon` = `d`.`id_rayon`) and (`g`.`id_wilayah` = `f`.`id_wilayah`) and (`h`.`id_mitra` = `g`.`id_mitra`)))) where (`e`.`kat_dokter` = _utf8'2') group by `a`.`id_transaksi` having (`biaya` >= 250000) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`d`.`nip` AS `nip`,`d`.`nama_karyawan` AS `nama_karyawan`,`d`.`ap` AS `ap`,`c`.`nama_tertanggung` AS `nama_tertanggung`,`c`.`status` AS `status`,`e`.`nama_dokter` AS `nama_dokter`,(case when (`e`.`kat_dokter` = _utf8'2') then _utf8'umum' else _utf8'spesialis' end) AS `kategori`,sum((`b`.`hrg_satuan` * `b`.`jumlah`)) AS `biaya`,(sum((`b`.`harga_item` * `b`.`jumlah`)) - sum((`b`.`hrg_satuan` * `b`.`jumlah`))) AS `selisih`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from (((((((`v_transaksi_all` `a` join `v_item_transaksi_all` `b`) join `master_tertanggung` `c`) join `master_karyawan` `d`) join `master_dokter` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`c`.`id_tertanggung` = `a`.`id_tertanggung`) and (`d`.`id_karyawan` = `c`.`id_karyawan`) and (`e`.`id_dokter` = `a`.`id_dokter`) and (`f`.`id_rayon` = `d`.`id_rayon`) and (`g`.`id_wilayah` = `f`.`id_wilayah`) and (`h`.`id_mitra` = `g`.`id_mitra`)))) where (`e`.`kat_dokter` <> _utf8'2') group by `a`.`id_transaksi` having (`biaya` > 500000) */;

/*View structure for view v_laporan_shopingdokter */

/*!50001 DROP TABLE IF EXISTS `v_laporan_shopingdokter` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_shopingdokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_shopingdokter` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`nip` AS `nip`,`a`.`nama_karyawan` AS `nama_karyawan`,`a`.`ap` AS `ap`,`a`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`status` AS `status`,`a`.`nama_dokter` AS `nama_dokter`,sum(`a`.`jumlah_hari`) AS `jumlah_hari`,sum(`a`.`biaya`) AS `biaya`,`a`.`id_rayon` AS `id_rayon`,`a`.`id_wilayah` AS `id_wilayah`,`a`.`id_mitra` AS `id_mitra` from `v_transaksi_dokter` `a` where `a`.`nip` in (select `b`.`nip` AS `nip` from `v_transaksi_dokter` `b` where ((`b`.`tgl_transaksi` < `a`.`tgl_transaksi`) and ((`b`.`tgl_transaksi` - `a`.`tgl_transaksi`) < `a`.`jumlah_hari`))) group by `a`.`id_transaksi` */;

/*View structure for view v_laporan_transaksi_all */

/*!50001 DROP TABLE IF EXISTS `v_laporan_transaksi_all` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_transaksi_all` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_transaksi_all` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`d`.`nip` AS `nip`,`d`.`nama_karyawan` AS `nama_karyawan`,`d`.`ap` AS `ap`,`c`.`nama_tertanggung` AS `nama_tertanggung`,`c`.`status` AS `status`,`e`.`nama_dokter` AS `nama_dokter`,(case when (`e`.`kat_dokter` = _utf8'2') then _utf8'umum' else _utf8'spesialis' end) AS `kategori`,sum((`b`.`hrg_satuan` * `b`.`jumlah`)) AS `biaya`,(sum((`b`.`harga_item` * `b`.`jumlah`)) - sum((`b`.`hrg_satuan` * `b`.`jumlah`))) AS `selisih`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from (((((((`v_transaksi_all` `a` join `v_item_transaksi_all` `b`) join `master_tertanggung` `c`) join `master_karyawan` `d`) join `master_dokter` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`c`.`id_tertanggung` = `a`.`id_tertanggung`) and (`d`.`id_karyawan` = `c`.`id_karyawan`) and (`e`.`id_dokter` = `a`.`id_dokter`) and (`f`.`id_rayon` = `d`.`id_rayon`) and (`g`.`id_wilayah` = `f`.`id_wilayah`) and (`h`.`id_mitra` = `g`.`id_mitra`)))) group by `a`.`id_transaksi` */;

/*View structure for view v_laporan_verifikasi */

/*!50001 DROP TABLE IF EXISTS `v_laporan_verifikasi` */;
/*!50001 DROP VIEW IF EXISTS `v_laporan_verifikasi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_verifikasi` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`b`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`f`.`nip` AS `nip`,`f`.`nama_karyawan` AS `nama_karyawan`,`f`.`ap` AS `ap`,`e`.`nama_tertanggung` AS `nama_tertanggung`,`e`.`status` AS `status`,`g`.`nama_dokter` AS `nama_dokter`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya`,`c`.`disetujui` AS `disetujui`,`k`.`nama_rekomendasi` AS `nama_rekomendasi`,`h`.`id_rayon` AS `id_rayon`,`i`.`id_wilayah` AS `id_wilayah`,`j`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `master_tertanggung` `e`) join `master_karyawan` `f`) join `master_dokter` `g`) join `master_rekomendasi` `k`) join `rayon_karyawan` `h`) join `wilayah_karyawan` `i`) join `mitra_karyawan` `j` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`d`.`id_item` = `c`.`id_item`) and (`a`.`id_tertanggung` = `e`.`id_tertanggung`) and (`e`.`id_karyawan` = `f`.`id_karyawan`) and (`c`.`id_dokter` = `g`.`id_dokter`) and (`c`.`id_rekomendasi` = `k`.`id_rekomendasi`) and (`f`.`id_rayon` = `h`.`id_rayon`) and (`h`.`id_wilayah` = `i`.`id_wilayah`) and (`i`.`id_mitra` = `j`.`id_mitra`)))) where (`c`.`id_rekomendasi` = 1) group by `a`.`id_transaksi` order by `id_transaksi` */;

/*View structure for view v_laporandiagnosa */

/*!50001 DROP TABLE IF EXISTS `v_laporandiagnosa` */;
/*!50001 DROP VIEW IF EXISTS `v_laporandiagnosa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporandiagnosa` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`master_diagnosa`.`nama_diagnosa` AS `nama_diagnosa`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`status` AS `status`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra` from (((((((`transaksi_diagnosa` join `transaksi` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) */;

/*View structure for view v_laporankunjungandak */

/*!50001 DROP TABLE IF EXISTS `v_laporankunjungandak` */;
/*!50001 DROP VIEW IF EXISTS `v_laporankunjungandak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporankunjungandak` AS select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,`master_tertanggung`.`status` AS `status`,`master_dokter`.`nama_dokter` AS `nama_dokter`,`master_diagnosa`.`nama_diagnosa` AS `nama_diagnosa`,`jenis_kunjungan`.`idjenis_kunjungan` AS `idjenis_kunjungan`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`wilayah_karyawan`.`id_wilayah` AS `id_wilayah`,`mitra_karyawan`.`id_mitra` AS `id_mitra`,`master_karyawan`.`ap` AS `ap` from ((((((((((((`periksa_dak` join `jenis_kunjungan` on((`periksa_dak`.`idjenis_kunjungan` = `jenis_kunjungan`.`idjenis_kunjungan`))) join `transaksi` on((`periksa_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) join `transaksi_dak` on((`transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_rujukan` on((`transaksi_dak`.`id_rujukan` = `master_rujukan`.`id_rujukan`))) join `master_dokter` on((`transaksi_dak`.`id_dokter` = `master_dokter`.`id_dokter`))) join `transaksi_diagnosa` on((`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`))) join `master_diagnosa` on((`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`))) */;

/*View structure for view v_laporankunjungankesehatan */

/*!50001 DROP TABLE IF EXISTS `v_laporankunjungankesehatan` */;
/*!50001 DROP VIEW IF EXISTS `v_laporankunjungankesehatan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporankunjungankesehatan` AS (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`ta`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'A' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_apotek` `ita` on((`ita`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `ta`.`id_dokter`))) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`td`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'D' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_dokter` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_dokter` `itd` on((`itd`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `td`.`id_dokter`))) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tg`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'G' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from ((((((((((`transaksi` `t` join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tg`.`id_provider`))) join `item_transaksi_gigi` `itg` on((`itg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tg`.`id_dokter`))) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tl`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'L' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_lain` `tl` on((`tl`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_lain` `itl` on((`itl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tl`.`id_dokter`))) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`top`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'O' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_optik` `ito` on((`ito`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `top`.`id_dokter`))) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tp`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'P' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_penunjang` `itp` on((`itp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tp`.`id_dokter`))) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'R' AS `jenis_transaksi`,'2' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 2) group by `t`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Ri' AS `jenis_transaksi`,'1' AS `idjenis_rawat` from (((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 1) group by `t`.`id_transaksi`) */;

/*View structure for view v_laporanperiksadak */

/*!50001 DROP TABLE IF EXISTS `v_laporanperiksadak` */;
/*!50001 DROP VIEW IF EXISTS `v_laporanperiksadak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporanperiksadak` AS select `pd`.`id_transaksi` AS `id_transaksi`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`nama_wilayah` AS `nama_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`pd`.`idjenis_kunjungan` AS `idjenis_kunjungan` from (((((`periksa_dak` `pd` join `transaksi` `t` on((`t`.`id_transaksi` = `pd`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) */;

/*View structure for view v_laporanrawatinap */

/*!50001 DROP TABLE IF EXISTS `v_laporanrawatinap` */;
/*!50001 DROP VIEW IF EXISTS `v_laporanrawatinap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporanrawatinap` AS (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itr`.`hrg_satuan` AS `hrg_satuan`,`itr`.`jumlah` AS `jumlah`,coalesce(`itr`.`total`,(`itr`.`hrg_satuan` * `itr`.`jumlah`)) AS `total_harga`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`tr`.`tgl_masuk` AS `tgl_masuk`,`tr`.`tgl_keluar` AS `tgl_keluar`,'t' AS `jenis` from ((((((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tr`.`id_provider`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itr`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 1) group by `t`.`id_transaksi`,`itr`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,sum((`tov`.`jumlah` * `tov`.`hrg_satuan`)) AS `SUM(tov.jumlah*tov.hrg_satuan)`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`tr`.`tgl_masuk` AS `tgl_masuk`,`tr`.`tgl_keluar` AS `tgl_keluar`,'d' AS `jenis` from (((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `transaksi_ov` `tov` on((`tov`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tov`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 1) group by `tov`.`id_transaksi`) */;

/*View structure for view v_laporanrawatjalan */

/*!50001 DROP TABLE IF EXISTS `v_laporanrawatjalan` */;
/*!50001 DROP VIEW IF EXISTS `v_laporanrawatjalan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporanrawatjalan` AS (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`ta`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`ita`.`hrg_satuan` AS `hrg_satuan`,`ita`.`jumlah` AS `jumlah`,coalesce(`ita`.`total`,(`ita`.`hrg_satuan` * `ita`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'A' AS `jenis_transaksi` from ((((((((((((`transaksi` `t` join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `ta`.`id_provider`))) join `item_transaksi_apotek` `ita` on((`ita`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `ita`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `ta`.`id_dokter`))) group by `t`.`id_transaksi`,`ita`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`td`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itd`.`hrg_satuan` AS `hrg_satuan`,`itd`.`jumlah` AS `jumlah`,coalesce(`itd`.`total`,(`itd`.`hrg_satuan` * `itd`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mdok`.`nama_dokter` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'D' AS `jenis_transaksi` from (((((((((((`transaksi` `t` join `transaksi_dokter` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_dokter` `itd` on((`itd`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itd`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `td`.`id_dokter`))) group by `t`.`id_transaksi`,`itd`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tg`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itg`.`hrg_satuan` AS `hrg_satuan`,`itg`.`jumlah` AS `jumlah`,coalesce(`itg`.`total`,(`itg`.`hrg_satuan` * `itg`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'G' AS `jenis_transaksi` from ((((((((((((`transaksi` `t` join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tg`.`id_provider`))) join `item_transaksi_gigi` `itg` on((`itg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itg`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tg`.`id_dokter`))) group by `t`.`id_transaksi`,`itg`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tl`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itl`.`hrg_satuan` AS `hrg_satuan`,`itl`.`jumlah` AS `jumlah`,coalesce(`itl`.`jumlah`,(`itl`.`hrg_satuan` * `itl`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'L' AS `jenis_transaksi` from ((((((((((((`transaksi` `t` join `transaksi_lain` `tl` on((`tl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tl`.`id_provider`))) join `item_transaksi_lain` `itl` on((`itl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itl`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tl`.`id_dokter`))) group by `t`.`id_transaksi`,`itl`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`top`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`ito`.`hrg_satuan` AS `hrg_satuan`,`ito`.`jumlah` AS `jumlah`,coalesce(`ito`.`total`,(`ito`.`hrg_satuan` * `ito`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'O' AS `jenis_transaksi` from ((((((((((((`transaksi` `t` join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `top`.`id_provider`))) join `item_transaksi_optik` `ito` on((`ito`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `ito`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `top`.`id_dokter`))) group by `t`.`id_transaksi`,`ito`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tp`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itp`.`hrg_satuan` AS `hrg_satuan`,`itp`.`jumlah` AS `jumlah`,coalesce(`itp`.`total`,(`itp`.`hrg_satuan` * `itp`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'P' AS `jenis_transaksi` from ((((((((((((`transaksi` `t` join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tp`.`id_provider`))) join `item_transaksi_penunjang` `itp` on((`itp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itp`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tp`.`id_dokter`))) group by `t`.`id_transaksi`,`itp`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itr`.`hrg_satuan` AS `hrg_satuan`,`itr`.`jumlah` AS `jumlah`,coalesce(`itr`.`total`,(`itr`.`hrg_satuan` * `itr`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'R' AS `jenis_transaksi` from ((((((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tr`.`id_provider`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itr`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 2) group by `t`.`id_transaksi`,`itr`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,sum(`tov`.`hrg_satuan`) AS `SUM(tov.hrg_satuan)`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'DR' AS `jenis_transaksi` from (((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `transaksi_ov` `tov` on((`tov`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tov`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 2) group by `tov`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,NULL AS `NULL`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`td`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`td`.`tarif_satuan_dokter` AS `tarif_satuan_dokter`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'DD' AS `jenis_transaksi` from ((((((`transaksi` `t` join `transaksi_dokter` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `td`.`id_dokter`))) group by `t`.`id_transaksi`) */;

/*View structure for view v_laporanrekammedis */

/*!50001 DROP TABLE IF EXISTS `v_laporanrekammedis` */;
/*!50001 DROP VIEW IF EXISTS `v_laporanrekammedis` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporanrekammedis` AS (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`ta`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`ita`.`hrg_satuan` AS `hrg_satuan`,`ita`.`jumlah` AS `jumlah`,coalesce(`ita`.`total`,(`ita`.`hrg_satuan` * `ita`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Apotek' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `ta`.`id_provider`))) join `item_transaksi_apotek` `ita` on((`ita`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `ita`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `ta`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`ita`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`td`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itd`.`hrg_satuan` AS `hrg_satuan`,`itd`.`jumlah` AS `jumlah`,coalesce(`itd`.`total`,(`itd`.`hrg_satuan` * `itd`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mdok`.`nama_dokter` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Dokter' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from (((((((((((((`transaksi` `t` join `transaksi_dokter` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_dokter` `itd` on((`itd`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itd`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `td`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`itd`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tg`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itg`.`hrg_satuan` AS `hrg_satuan`,`itg`.`jumlah` AS `jumlah`,coalesce(`itg`.`total`,(`itg`.`hrg_satuan` * `itg`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Gigi' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tg`.`id_provider`))) join `item_transaksi_gigi` `itg` on((`itg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itg`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tg`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`itg`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tl`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itl`.`hrg_satuan` AS `hrg_satuan`,`itl`.`jumlah` AS `jumlah`,coalesce(`itl`.`total`,(`itl`.`hrg_satuan` * `itl`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Lain' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_lain` `tl` on((`tl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tl`.`id_provider`))) join `item_transaksi_lain` `itl` on((`itl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itl`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tl`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`itl`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`top`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`ito`.`hrg_satuan` AS `hrg_satuan`,`ito`.`jumlah` AS `jumlah`,coalesce(`ito`.`total`,(`ito`.`hrg_satuan` * `ito`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Optik' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `top`.`id_provider`))) join `item_transaksi_optik` `ito` on((`ito`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `ito`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `top`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`ito`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tp`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itp`.`hrg_satuan` AS `hrg_satuan`,`itp`.`jumlah` AS `jumlah`,coalesce(`itp`.`total`,(`itp`.`hrg_satuan` * `itp`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Penunjang' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tp`.`id_provider`))) join `item_transaksi_penunjang` `itp` on((`itp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itp`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tp`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`itp`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itr`.`hrg_satuan` AS `hrg_satuan`,`itr`.`jumlah` AS `jumlah`,coalesce(`itr`.`total`,(`itr`.`hrg_satuan` * `itr`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Rumah Sakit' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tr`.`id_provider`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itr`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`itr`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tlab`.`restitusi` AS `restitusi`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,NULL AS `hrg_satuan`,NULL AS `jumlah`,`itr`.`total` AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'Transaksi Lab' AS `jenis_transaksi`,NULL AS `tgl_keluar`,`mdos`.`nama_dosis` AS `nama_dosis` from ((((((((((((((`transaksi` `t` join `transaksi_lab` `tlab` on((`tlab`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tlab`.`id_provider`))) join `item_transaksi_lab` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itr`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tlab`.`id_dokter`))) left join `dosis_item` `di` on((`di`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_dosis` `mdos` on((`mdos`.`id_dosis` = `di`.`id_dosis`))) group by `t`.`id_transaksi`,`itr`.`id_item`) */;

/*View structure for view v_laporansap */

/*!50001 DROP TABLE IF EXISTS `v_laporansap` */;
/*!50001 DROP VIEW IF EXISTS `v_laporansap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporansap` AS select `v_totaltransaksi`.`id_transaksi` AS `id_transaksi`,`v_totaltransaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`v_totaltransaksi`.`tgl_transaksi` AS `tgl_transaksi`,`v_totaltransaksi`.`nip` AS `nip`,`v_totaltransaksi`.`nama_karyawan` AS `nama_karyawan`,`v_totaltransaksi`.`ap` AS `ap`,`v_totaltransaksi`.`nama_tertanggung` AS `nama_tertanggung`,`v_totaltransaksi`.`kat_dokter` AS `kat_dokter`,`v_totaltransaksi`.`nama_dokter` AS `nama_dokter`,`v_totaltransaksi`.`status` AS `status`,`v_totaltransaksi`.`restitusi` AS `restitusi`,`v_totaltransaksi`.`ditanggung` AS `ditanggung`,`v_totaltransaksi`.`nama_item` AS `nama_item`,`v_totaltransaksi`.`hba_item` AS `hba_item`,`v_totaltransaksi`.`hrg_satuan` AS `hrg_satuan`,`v_totaltransaksi`.`jumlah` AS `jumlah`,`v_totaltransaksi`.`id_rekomendasi` AS `id_rekomendasi`,`v_totaltransaksi`.`total` AS `total`,`v_totaltransaksi`.`idjns_item` AS `idjns_item`,`v_totaltransaksi`.`nama_provider` AS `nama_provider`,`v_totaltransaksi`.`buku_besar` AS `buku_besar`,`v_totaltransaksi`.`jenis_penyakit` AS `jenis_penyakit`,`v_totaltransaksi`.`nama_diagnosa` AS `nama_diagnosa`,`v_totaltransaksi`.`id_rayon` AS `id_rayon`,`v_totaltransaksi`.`id_wilayah` AS `id_wilayah`,`v_totaltransaksi`.`id_mitra` AS `id_mitra`,`v_totaltransaksi`.`jenis_transaksi` AS `jenis_transaksi`,`v_totaltransaksi`.`rj` AS `rj`,sum(`v_totaltransaksi`.`total`) AS `totalkoreksi` from `v_totaltransaksi` */;

/*View structure for view v_master_dokter */

/*!50001 DROP TABLE IF EXISTS `v_master_dokter` */;
/*!50001 DROP VIEW IF EXISTS `v_master_dokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_dokter` AS (select `mdo`.`id_dokter` AS `id_dokter`,`mdo`.`nama_dokter` AS `nama_dokter`,if((`mdo`.`langg_dokter` = 'y'),'Berlangganan','Tidak') AS `langg_dokter`,`mdo`.`tarif_dokter` AS `tarif_dokter`,`mdo`.`tarif_standar` AS `tarif_standar`,`gd`.`gol_nama` AS `gol_nama`,`kd`.`kat_nama` AS `kat_nama` from ((`master_dokter` `mdo` join `kategori_dokter` `kd` on((`kd`.`kat_dokter` = `mdo`.`kat_dokter`))) join `golongan_dokter` `gd` on((`gd`.`gol_dokter` = `mdo`.`gol_dokter`)))) */;

/*View structure for view v_master_item */

/*!50001 DROP TABLE IF EXISTS `v_master_item` */;
/*!50001 DROP VIEW IF EXISTS `v_master_item` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_item` AS select `mi`.`id_item` AS `id_item`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`mi`.`harga_item` AS `harga_item`,`mi`.`frm_item` AS `frm_item`,`mi`.`oral_item` AS `oral_item`,`mi`.`kls_item` AS `kls_item`,`mi`.`provider_item` AS `provider_item`,`mi`.`entri_item` AS `entri_item`,`mi`.`idjns_item` AS `idjns_item`,`ji`.`jenis_item` AS `jenis_item` from (`master_item` `mi` join `jenis_item` `ji` on((`ji`.`idjns_item` = `mi`.`idjns_item`))) */;

/*View structure for view v_master_karyawan */

/*!50001 DROP TABLE IF EXISTS `v_master_karyawan` */;
/*!50001 DROP VIEW IF EXISTS `v_master_karyawan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_karyawan` AS (select `mk`.`id_karyawan` AS `id_karyawan`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`alamat` AS `alamat`,`mk`.`sex` AS `sex`,`mk`.`telp` AS `telp`,`mk`.`ttl` AS `ttl`,`mk`.`tgl_lahir` AS `tgl_lahir`,`mk`.`ap` AS `ap`,`mk`.`status` AS `status`,`sk`.`nama_status` AS `nama_status`,`mk`.`kelas_kamar` AS `kelas_kamar`,`bk`.`nama_bagian` AS `nama_bagian`,`rk`.`id_rayon` AS `id_rayon`,`rk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`rk`.`nama_rayon` AS `nama_rayon` from ((((`master_karyawan` `mk` join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `bagian_karyawan` `bk` on((`bk`.`id_bagian` = `mk`.`id_bagian`))) left join `status_karyawan` `sk` on((`sk`.`id_status` = `mk`.`status`)))) */;

/*View structure for view v_master_provider */

/*!50001 DROP TABLE IF EXISTS `v_master_provider` */;
/*!50001 DROP VIEW IF EXISTS `v_master_provider` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_provider` AS (select `mp`.`id_provider` AS `id_provider`,`mp`.`nama_provider` AS `nama_provider`,if((`mp`.`langg_provider` = 'y'),'Berlangganan','Tidak') AS `langg_provider`,`mp`.`almt_provider` AS `almt_provider`,`mp`.`email_provider` AS `email_provider`,`mp`.`tlp_provider` AS `tlp_provider`,`mp`.`fax_provider` AS `fax_provider`,`mp`.`idjenis_provider` AS `idjenis_provider` from `master_provider` `mp`) */;

/*View structure for view v_master_rayon */

/*!50001 DROP TABLE IF EXISTS `v_master_rayon` */;
/*!50001 DROP VIEW IF EXISTS `v_master_rayon` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_rayon` AS select `rk`.`id_rayon` AS `id_rayon`,`rk`.`nama_rayon` AS `nama_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`nama_wilayah` AS `nama_wilayah`,`wk`.`id_mitra` AS `id_mitra` from (`rayon_karyawan` `rk` join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) */;

/*View structure for view v_master_tertanggung */

/*!50001 DROP TABLE IF EXISTS `v_master_tertanggung` */;
/*!50001 DROP VIEW IF EXISTS `v_master_tertanggung` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_tertanggung` AS select `mt`.`id_tertanggung` AS `id_tertanggung`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mt`.`sex` AS `sex`,`mt`.`tgl_lahir` AS `tgl_lahir`,`mt`.`usia` AS `usia`,`mt`.`status` AS `status`,`mt`.`ditanggung` AS `ditanggung`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`id_rayon` AS `id_rayon`,`rk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra` from (((`master_tertanggung` `mt` join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) */;

/*View structure for view v_master_user */

/*!50001 DROP TABLE IF EXISTS `v_master_user` */;
/*!50001 DROP VIEW IF EXISTS `v_master_user` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_user` AS select `u`.`user_id` AS `user_id`,`u`.`user_username` AS `user_username`,`u`.`user_password` AS `user_password`,`u`.`user_name` AS `user_name`,`lu`.`name_level` AS `name_level` from (`user` `u` join `level_user` `lu` on((`lu`.`user_level` = `u`.`user_level`))) */;

/*View structure for view v_postbiayarirj */

/*!50001 DROP TABLE IF EXISTS `v_postbiayarirj` */;
/*!50001 DROP VIEW IF EXISTS `v_postbiayarirj` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_postbiayarirj` AS select `rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`t`.`id_transaksi` AS `id_transaksi`,`ji`.`jenis_item` AS `jenis_item`,((((((((sum(coalesce(`ita`.`total`,0)) + sum(coalesce(`itd`.`total`,0))) + sum(coalesce(`itda`.`total`,0))) + sum(coalesce(`itg`.`total`,0))) + sum(coalesce(`itlab`.`total`,0))) + sum(coalesce(`itl`.`total`,0))) + sum(coalesce(`ito`.`total`,0))) + sum(coalesce(`itp`.`total`,0))) + sum(coalesce(`itr`.`total`,0))) AS `total_transaksi` from (((((((((((((((`transaksi` `t` left join `item_transaksi_apotek` `ita` on((`t`.`id_transaksi` = `ita`.`id_transaksi`))) left join `item_transaksi_dak` `itda` on((`t`.`id_transaksi` = `itda`.`id_transaksi`))) left join `item_transaksi_dokter` `itd` on((`t`.`id_transaksi` = `itd`.`id_transaksi`))) left join `item_transaksi_gigi` `itg` on((`t`.`id_transaksi` = `itg`.`id_transaksi`))) left join `item_transaksi_lab` `itlab` on((`t`.`id_transaksi` = `itlab`.`id_transaksi`))) left join `item_transaksi_lain` `itl` on((`t`.`id_transaksi` = `itl`.`id_transaksi`))) left join `item_transaksi_optik` `ito` on((`t`.`id_transaksi` = `ito`.`id_transaksi`))) left join `item_transaksi_penunjang` `itp` on((`t`.`id_transaksi` = `itp`.`id_transaksi`))) left join `item_transaksi_rs` `itr` on((`t`.`id_transaksi` = `itr`.`id_transaksi`))) left join `master_item` `mi` on(((`ita`.`id_item` = `mi`.`id_item`) or (`itda`.`id_item` = `mi`.`id_item`) or (`itd`.`id_item` = `mi`.`id_item`) or (`itg`.`id_item` = `mi`.`id_item`) or (`itlab`.`id_item` = `mi`.`id_item`) or (`itl`.`id_item` = `mi`.`id_item`) or (`ito`.`id_item` = `mi`.`id_item`) or (`itp`.`id_item` = `mi`.`id_item`) or (`itr`.`id_item` = `mi`.`id_item`)))) join `jenis_item` `ji` on((`mi`.`idjns_item` = `ji`.`idjns_item`))) join `master_tertanggung` `mt` on((`t`.`id_tertanggung` = `mt`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mt`.`id_karyawan` = `mk`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`mk`.`id_rayon` = `rk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`rk`.`id_wilayah` = `wk`.`id_wilayah`))) group by `rk`.`id_rayon`,`wk`.`id_wilayah`,`ji`.`idjns_item` */;

/*View structure for view v_restitusi */

/*!50001 DROP TABLE IF EXISTS `v_restitusi` */;
/*!50001 DROP VIEW IF EXISTS `v_restitusi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_restitusi` AS select `transaksi_apotek`.`id_transaksi` AS `id_transaksi`,`transaksi_apotek`.`restitusi` AS `restitusi` from `transaksi_apotek` union select `transaksi_dokter`.`id_transaksi` AS `id_transaksi`,`transaksi_dokter`.`restitusi` AS `restitusi` from `transaksi_dokter` union select `transaksi_gigi`.`id_transaksi` AS `id_transaksi`,`transaksi_gigi`.`restitusi` AS `restitusi` from `transaksi_gigi` union select `transaksi_lab`.`id_transaksi` AS `id_transaksi`,`transaksi_lab`.`restitusi` AS `restitusi` from `transaksi_lab` union select `transaksi_lain`.`id_transaksi` AS `id_transaksi`,`transaksi_lain`.`restitusi` AS `restitusi` from `transaksi_lain` union select `transaksi_optik`.`id_transaksi` AS `id_transaksi`,`transaksi_optik`.`restitusi` AS `restitusi` from `transaksi_optik` union select `transaksi_penunjang`.`id_transaksi` AS `id_transaksi`,`transaksi_penunjang`.`restitusi` AS `restitusi` from `transaksi_penunjang` union select `transaksi_rmh_sakit`.`id_transaksi` AS `id_transaksi`,`transaksi_rmh_sakit`.`restitusi` AS `restitusi` from `transaksi_rmh_sakit` order by `id_transaksi` */;

/*View structure for view v_summarydokter */

/*!50001 DROP TABLE IF EXISTS `v_summarydokter` */;
/*!50001 DROP VIEW IF EXISTS `v_summarydokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summarydokter` AS select `t`.`tgl_transaksi` AS `tgl_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`id_transaksi` AS `id_transaksi`,`md`.`kat_dokter` AS `kat_dokter`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra` from ((((((((((((((`transaksi` `t` left join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_dak` `tdak` on((`tdak`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_dokter` `tdo` on((`tdo`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_lab` `tl` on((`tl`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_lain` `tlain` on((`tlain`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_ov` `ov` on((`ov`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_dokter` `md` on(((`md`.`id_dokter` = `ta`.`id_dokter`) or (`md`.`id_dokter` = `tdak`.`id_dokter`) or (`md`.`id_dokter` = `tdo`.`id_dokter`) or (`md`.`id_dokter` = `tg`.`id_dokter`) or (`md`.`id_dokter` = `tl`.`id_dokter`) or (`md`.`id_dokter` = `tlain`.`id_dokter`) or (`md`.`id_dokter` = `top`.`id_dokter`) or (`md`.`id_dokter` = `ov`.`id_dokter`) or (`md`.`id_dokter` = `tp`.`id_dokter`)))) join `master_tertanggung` `mtang` on((`mtang`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mkang` on((`mkang`.`id_karyawan` = `mtang`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mkang`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `wk`.`id_wilayah`))) group by `t`.`id_transaksi` */;

/*View structure for view v_summaryjabatanterbanyak */

/*!50001 DROP TABLE IF EXISTS `v_summaryjabatanterbanyak` */;
/*!50001 DROP VIEW IF EXISTS `v_summaryjabatanterbanyak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summaryjabatanterbanyak` AS select `rayon_karyawan`.`id_rayon` AS `id_rayon`,`transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`tgl_kunjungan` AS `tgl_kunjungan`,`rayon_karyawan`.`id_wilayah` AS `id_wilayah`,`wilayah_karyawan`.`id_mitra` AS `id_mitra`,`bagian_karyawan`.`nama_bagian` AS `nama_bagian`,`bagian_karyawan`.`id_bagian` AS `id_bagian`,((((((coalesce(sum(`item_transaksi_apotek`.`total`),0) + coalesce(sum(`item_transaksi_dak`.`total`),0)) + coalesce(sum(`item_transaksi_dokter`.`total`),0)) + coalesce(sum(`item_transaksi_gigi`.`total`),0)) + coalesce(sum(`item_transaksi_lab`.`total`),0)) + coalesce(sum(`item_transaksi_lain`.`total`),0)) + ((coalesce(sum(`item_transaksi_optik`.`total`),0) + coalesce(sum(`item_transaksi_penunjang`.`total`),0)) + coalesce(sum(`item_transaksi_rs`.`total`),0))) AS `total` from (((((((((((((((`transaksi` join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `item_transaksi_apotek` on((`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_dak` on((`item_transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_dokter` on((`item_transaksi_dokter`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_gigi` on((`item_transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_lab` on((`item_transaksi_lab`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_lain` on((`item_transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_optik` on((`item_transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_penunjang` on((`item_transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_rs` on((`item_transaksi_rs`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `bagian_karyawan` on((`master_karyawan`.`id_bagian` = `bagian_karyawan`.`id_bagian`))) group by `transaksi`.`id_transaksi` */;

/*View structure for view v_summaryobatterbanyak */

/*!50001 DROP TABLE IF EXISTS `v_summaryobatterbanyak` */;
/*!50001 DROP VIEW IF EXISTS `v_summaryobatterbanyak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summaryobatterbanyak` AS select `t`.`id_transaksi` AS `id_transaksi`,`mi`.`nama_item` AS `nama_item`,`rk`.`id_rayon` AS `id_rayon`,`rk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi` from ((((((((((((((`transaksi` `t` left join `item_transaksi_apotek` `ita` on((`ita`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_dak` `itd` on((`itd`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_dokter` `itdo` on((`itdo`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_gigi` `itg` on((`itg`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_lab` `itl` on((`itl`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_lain` `itlain` on((`itlain`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_optik` `ito` on((`ito`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_penunjang` `itp` on((`itp`.`id_transaksi` = `t`.`id_transaksi`))) left join `item_transaksi_rs` `itrs` on((`itrs`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on(((`ita`.`id_item` = `mi`.`id_item`) or (`itd`.`id_item` = `mi`.`id_item`) or (`itdo`.`id_item` = `mi`.`id_item`) or (`itg`.`id_item` = `mi`.`id_item`) or (`itl`.`id_item` = `mi`.`id_item`) or (`itlain`.`id_item` = `mi`.`id_item`) or (`ito`.`id_item` = `mi`.`id_item`) or (`itp`.`id_item` = `mi`.`id_item`) or (`itrs`.`id_item` = `mi`.`id_item`)))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) where (`mi`.`idjns_item` = 1) */;

/*View structure for view v_summarypenyakitterbanyak */

/*!50001 DROP TABLE IF EXISTS `v_summarypenyakitterbanyak` */;
/*!50001 DROP VIEW IF EXISTS `v_summarypenyakitterbanyak` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summarypenyakitterbanyak` AS select `t`.`tgl_transaksi` AS `tgl_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`md`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`rk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra` from ((((((`transaksi_diagnosa` `td` join `transaksi` `t` on((`t`.`id_transaksi` = `td`.`id_transaksi`))) join `master_diagnosa` `md` on((`md`.`id_diagnosa` = `td`.`id_diagnosa`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) */;

/*View structure for view v_summarypostbiayaall */

/*!50001 DROP TABLE IF EXISTS `v_summarypostbiayaall` */;
/*!50001 DROP VIEW IF EXISTS `v_summarypostbiayaall` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summarypostbiayaall` AS select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,`md`.`jenis_penyakit` AS `jenis_penyakit`,`mk`.`ap` AS `ap`,`mt`.`status` AS `status`,((((((((coalesce(`ita`.`total`,0) + coalesce(`itd`.`total`,0)) + coalesce(`itda`.`total`,0)) + coalesce(`itg`.`total`,0)) + coalesce(`itlab`.`total`,0)) + coalesce(`itl`.`total`,0)) + coalesce(`ito`.`total`,0)) + coalesce(`itp`.`total`,0)) + coalesce(`itr`.`total`,0)) AS `total_transaksi` from (((((((((((((((((`transaksi` `t` left join `item_transaksi_apotek` `ita` on((`t`.`id_transaksi` = `ita`.`id_transaksi`))) left join `item_transaksi_dak` `itda` on((`t`.`id_transaksi` = `itda`.`id_transaksi`))) left join `item_transaksi_dokter` `itd` on((`t`.`id_transaksi` = `itd`.`id_transaksi`))) left join `item_transaksi_gigi` `itg` on((`t`.`id_transaksi` = `itg`.`id_transaksi`))) left join `item_transaksi_lab` `itlab` on((`t`.`id_transaksi` = `itlab`.`id_transaksi`))) left join `item_transaksi_lain` `itl` on((`t`.`id_transaksi` = `itl`.`id_transaksi`))) left join `item_transaksi_optik` `ito` on((`t`.`id_transaksi` = `ito`.`id_transaksi`))) left join `item_transaksi_penunjang` `itp` on((`t`.`id_transaksi` = `itp`.`id_transaksi`))) left join `item_transaksi_rs` `itr` on((`t`.`id_transaksi` = `itr`.`id_transaksi`))) left join `transaksi_diagnosa` `td` on((`t`.`id_transaksi` = `td`.`id_transaksi`))) join `master_diagnosa` `md` on((`td`.`id_diagnosa` = `md`.`id_diagnosa`))) left join `master_item` `mi` on(((`ita`.`id_item` = `mi`.`id_item`) or (`itda`.`id_item` = `mi`.`id_item`) or (`itd`.`id_item` = `mi`.`id_item`) or (`itg`.`id_item` = `mi`.`id_item`) or (`itlab`.`id_item` = `mi`.`id_item`) or (`itl`.`id_item` = `mi`.`id_item`) or (`ito`.`id_item` = `mi`.`id_item`) or (`itp`.`id_item` = `mi`.`id_item`) or (`itr`.`id_item` = `mi`.`id_item`)))) join `jenis_item` `ji` on((`mi`.`idjns_item` = `ji`.`idjns_item`))) join `master_tertanggung` `mt` on((`t`.`id_tertanggung` = `mt`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mt`.`id_karyawan` = `mk`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`mk`.`id_rayon` = `rk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`rk`.`id_wilayah` = `wk`.`id_wilayah`))) */;

/*View structure for view v_summaryrawatinap */

/*!50001 DROP TABLE IF EXISTS `v_summaryrawatinap` */;
/*!50001 DROP VIEW IF EXISTS `v_summaryrawatinap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summaryrawatinap` AS select `t`.`tgl_transaksi` AS `tgl_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`mk`.`id_rayon` AS `id_rayon`,`rk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra` from (((((`transaksi_rmh_sakit` `trs` join `transaksi` `t` on((`t`.`id_transaksi` = `trs`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) where (`trs`.`idjenis_rawat` = 1) */;

/*View structure for view v_summaryrestitusi */

/*!50001 DROP TABLE IF EXISTS `v_summaryrestitusi` */;
/*!50001 DROP VIEW IF EXISTS `v_summaryrestitusi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summaryrestitusi` AS select `t`.`tgl_transaksi` AS `tgl_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra` from ((((((((((((`transaksi` `t` left join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_dokter` `tdo` on((`tdo`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_lab` `tlab` on((`tlab`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_lain` `tlain` on((`tlain`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_rmh_sakit` `trs` on((`trs`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) where ((`ta`.`restitusi` = 'y') or (`tdo`.`restitusi` = 'y') or (`tg`.`restitusi` = 'y') or (`tlab`.`restitusi` = 'y') or (`tlain`.`restitusi` = 'y') or (`top`.`restitusi` = 'y') or (`tp`.`restitusi` = 'y') or (`trs`.`restitusi` = 'y')) */;

/*View structure for view v_summaryspesialis */

/*!50001 DROP TABLE IF EXISTS `v_summaryspesialis` */;
/*!50001 DROP VIEW IF EXISTS `v_summaryspesialis` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summaryspesialis` AS select `t`.`tgl_transaksi` AS `tgl_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`kd`.`kat_nama` AS `kat_nama`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra` from (((((((((((((((`transaksi` `t` left join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_dak` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_dokter` `tdo` on((`tdo`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_lab` `tlab` on((`tlab`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_lain` `tlain` on((`tlain`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_ov` `tov` on((`tov`.`id_transaksi` = `t`.`id_transaksi`))) left join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_dokter` `md` on(((`ta`.`id_dokter` = `md`.`id_dokter`) or (`td`.`id_dokter` = `md`.`id_dokter`) or (`tdo`.`id_dokter` = `md`.`id_dokter`) or (`tg`.`id_dokter` = `md`.`id_dokter`) or (`tlab`.`id_dokter` = `md`.`id_dokter`) or (`tlain`.`id_dokter` = `md`.`id_dokter`) or (`top`.`id_dokter` = `md`.`id_dokter`) or (`tov`.`id_dokter` = `md`.`id_dokter`) or (`tp`.`id_dokter` = `md`.`id_dokter`)))) join `kategori_dokter` `kd` on((`kd`.`kat_dokter` = `md`.`kat_dokter`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) where (`md`.`kat_dokter` = 1) */;

/*View structure for view v_summarytransaksiterbesar */

/*!50001 DROP TABLE IF EXISTS `v_summarytransaksiterbesar` */;
/*!50001 DROP VIEW IF EXISTS `v_summarytransaksiterbesar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_summarytransaksiterbesar` AS select `master_karyawan`.`nip` AS `nip`,`master_karyawan`.`nama_karyawan` AS `nama_karyawan`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`rayon_karyawan`.`id_rayon` AS `id_rayon`,`rayon_karyawan`.`id_wilayah` AS `id_wilayah`,`wilayah_karyawan`.`id_mitra` AS `id_mitra`,coalesce(sum(`item_transaksi_apotek`.`total`),0) AS `total_apotek`,coalesce(sum(`item_transaksi_dak`.`total`),0) AS `total_dak`,coalesce(sum(`item_transaksi_dokter`.`total`),0) AS `total_dokter`,coalesce(sum(`item_transaksi_gigi`.`total`),0) AS `total_gigi`,coalesce(sum(`item_transaksi_lab`.`total`),0) AS `total_lab`,coalesce(sum(`item_transaksi_lain`.`total`),0) AS `total_lain`,coalesce(sum(`item_transaksi_optik`.`total`),0) AS `total_optik`,coalesce(sum(`item_transaksi_penunjang`.`total`),0) AS `total_penunjang`,coalesce(sum(`item_transaksi_rs`.`total`),0) AS `total_transaksi_rs`,((((((coalesce(sum(`item_transaksi_apotek`.`total`),0) + coalesce(sum(`item_transaksi_dak`.`total`),0)) + coalesce(sum(`item_transaksi_dokter`.`total`),0)) + coalesce(sum(`item_transaksi_gigi`.`total`),0)) + coalesce(sum(`item_transaksi_lab`.`total`),0)) + coalesce(sum(`item_transaksi_lain`.`total`),0)) + ((coalesce(sum(`item_transaksi_optik`.`total`),0) + coalesce(sum(`item_transaksi_penunjang`.`total`),0)) + coalesce(sum(`item_transaksi_rs`.`total`),0))) AS `total` from ((((((((((((((`transaksi` join `master_tertanggung` on((`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`))) join `master_karyawan` on((`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`))) join `rayon_karyawan` on((`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`))) join `wilayah_karyawan` on((`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`))) join `mitra_karyawan` on((`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `item_transaksi_apotek` on((`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_dak` on((`item_transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_dokter` on((`item_transaksi_dokter`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_gigi` on((`item_transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_lab` on((`item_transaksi_lab`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_lain` on((`item_transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_optik` on((`item_transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_penunjang` on((`item_transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`))) left join `item_transaksi_rs` on((`item_transaksi_rs`.`id_transaksi` = `transaksi`.`id_transaksi`))) group by `master_karyawan`.`nip` order by ((((((coalesce(sum(`item_transaksi_apotek`.`total`),0) + coalesce(sum(`item_transaksi_dak`.`total`),0)) + coalesce(sum(`item_transaksi_dokter`.`total`),0)) + coalesce(sum(`item_transaksi_gigi`.`total`),0)) + coalesce(sum(`item_transaksi_lab`.`total`),0)) + coalesce(sum(`item_transaksi_lain`.`total`),0)) + ((coalesce(sum(`item_transaksi_optik`.`total`),0) + coalesce(sum(`item_transaksi_penunjang`.`total`),0)) + coalesce(sum(`item_transaksi_rs`.`total`),0))) desc */;

/*View structure for view v_totaltransaksi */

/*!50001 DROP TABLE IF EXISTS `v_totaltransaksi` */;
/*!50001 DROP VIEW IF EXISTS `v_totaltransaksi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_totaltransaksi` AS (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`ta`.`restitusi` AS `restitusi`,`ta`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`ita`.`hrg_satuan` AS `hrg_satuan`,`ita`.`jumlah` AS `jumlah`,`ita`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`ita`.`total`,(`ita`.`hrg_satuan` * `ita`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'A' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_apotek` `ta` on((`ta`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `ta`.`id_provider`))) join `item_transaksi_apotek` `ita` on((`ita`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `ita`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `ta`.`id_dokter`))) group by `t`.`id_transaksi`,`ita`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`td`.`restitusi` AS `restitusi`,`td`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itd`.`hrg_satuan` AS `hrg_satuan`,`itd`.`jumlah` AS `jumlah`,`itd`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`itd`.`total`,(`itd`.`hrg_satuan` * `itd`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mdok`.`nama_dokter` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'D' AS `jenis_transaksi`,'rj' AS `rj` from (((((((((((`transaksi` `t` join `transaksi_dokter` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) join `item_transaksi_dokter` `itd` on((`itd`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itd`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `td`.`id_dokter`))) group by `t`.`id_transaksi`,`itd`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tg`.`restitusi` AS `restitusi`,`tg`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itg`.`hrg_satuan` AS `hrg_satuan`,`itg`.`jumlah` AS `jumlah`,`itg`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`itg`.`total`,(`itg`.`hrg_satuan` * `itg`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'G' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_gigi` `tg` on((`tg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tg`.`id_provider`))) join `item_transaksi_gigi` `itg` on((`itg`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itg`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tg`.`id_dokter`))) group by `t`.`id_transaksi`,`itg`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tl`.`restitusi` AS `restitusi`,`tl`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itl`.`hrg_satuan` AS `hrg_satuan`,`itl`.`jumlah` AS `jumlah`,`itl`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`itl`.`total`,(`itl`.`hrg_satuan` * `itl`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'L' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_lain` `tl` on((`tl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tl`.`id_provider`))) join `item_transaksi_lain` `itl` on((`itl`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itl`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tl`.`id_dokter`))) group by `t`.`id_transaksi`,`itl`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`top`.`restitusi` AS `restitusi`,`top`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`ito`.`hrg_satuan` AS `hrg_satuan`,`ito`.`jumlah` AS `jumlah`,`ito`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`ito`.`total`,(`ito`.`hrg_satuan` * `ito`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'O' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_optik` `top` on((`top`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `top`.`id_provider`))) join `item_transaksi_optik` `ito` on((`ito`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `ito`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `top`.`id_dokter`))) group by `t`.`id_transaksi`,`ito`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tp`.`restitusi` AS `restitusi`,`tp`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itp`.`hrg_satuan` AS `hrg_satuan`,`itp`.`jumlah` AS `jumlah`,`itp`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`itp`.`total`,(`itp`.`hrg_satuan` * `itp`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'P' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_penunjang` `tp` on((`tp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tp`.`id_provider`))) join `item_transaksi_penunjang` `itp` on((`itp`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itp`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tp`.`id_dokter`))) group by `t`.`id_transaksi`,`itp`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`tr`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itr`.`hrg_satuan` AS `hrg_satuan`,`itr`.`jumlah` AS `jumlah`,`itr`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`itr`.`total`,(`itr`.`hrg_satuan` * `itr`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'R' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tr`.`id_provider`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itr`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 2) group by `t`.`id_transaksi`,`itr`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`tr`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,`mi`.`nama_item` AS `nama_item`,`mi`.`hba_item` AS `hba_item`,`itr`.`hrg_satuan` AS `hrg_satuan`,`itr`.`jumlah` AS `jumlah`,`itr`.`id_rekomendasi` AS `id_rekomendasi`,coalesce(`itr`.`total`,(`itr`.`hrg_satuan` * `itr`.`jumlah`)) AS `total`,`mi`.`idjns_item` AS `idjns_item`,`mp`.`nama_provider` AS `nama_provider`,`mb`.`buku_besar` AS `buku_besar`,`mdi`.`jenis_penyakit` AS `jenis_penyakit`,`mdi`.`nama_diagnosa` AS `nama_diagnosa`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'R' AS `jenis_transaksi`,'ri' AS `rj` from ((((((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_provider` `mp` on((`mp`.`id_provider` = `tr`.`id_provider`))) join `item_transaksi_rs` `itr` on((`itr`.`id_transaksi` = `t`.`id_transaksi`))) join `master_item` `mi` on((`mi`.`id_item` = `itr`.`id_item`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `transaksi_diagnosa` `tdi` on((`tdi`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) left join `master_diagnosa` `mdi` on((`mdi`.`id_diagnosa` = `tdi`.`id_diagnosa`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `itr`.`id_dokter`))) where (`tr`.`idjenis_rawat` = 1) group by `t`.`id_transaksi`,`itr`.`id_item`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`tr`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,sum((`tov`.`jumlah` * `tov`.`hrg_satuan`)) AS `SUM(tov.jumlah*tov.hrg_satuan)`,NULL AS `NULL`,NULL AS `NULL`,`mb`.`buku_besar` AS `buku_besar`,NULL AS `NULL`,NULL AS `NULL`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'DR' AS `jenis_transaksi`,'rj' AS `rj` from ((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `transaksi_ov` `tov` on((`tov`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tov`.`id_dokter`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) where (`tr`.`idjenis_rawat` = 2) group by `tov`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`tr`.`restitusi` AS `restitusi`,`tr`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,sum((`tov`.`jumlah` * `tov`.`hrg_satuan`)) AS `SUM(tov.jumlah*tov.hrg_satuan)`,NULL AS `NULL`,NULL AS `NULL`,`mb`.`buku_besar` AS `buku_besar`,NULL AS `NULL`,NULL AS `NULL`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'DR' AS `jenis_transaksi`,'ri' AS `rj` from ((((((((`transaksi` `t` join `transaksi_rmh_sakit` `tr` on((`tr`.`id_transaksi` = `t`.`id_transaksi`))) join `transaksi_ov` `tov` on((`tov`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `tov`.`id_dokter`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) where (`tr`.`idjenis_rawat` = 1) group by `tov`.`id_transaksi`) union (select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_kunjungan` AS `tgl_kunjungan`,`t`.`tgl_transaksi` AS `tgl_transaksi`,`mk`.`nip` AS `nip`,`mk`.`nama_karyawan` AS `nama_karyawan`,`mk`.`ap` AS `ap`,`mt`.`nama_tertanggung` AS `nama_tertanggung`,`mdok`.`kat_dokter` AS `kat_dokter`,`mdok`.`nama_dokter` AS `nama_dokter`,`mt`.`status` AS `status`,`td`.`restitusi` AS `restitusi`,`td`.`no_bukti` AS `no_bukti`,`mt`.`ditanggung` AS `ditanggung`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`td`.`tarif_satuan_dokter` AS `tarif_satuan_dokter`,NULL AS `NULL`,NULL AS `NULL`,`mb`.`buku_besar` AS `buku_besar`,NULL AS `NULL`,NULL AS `NULL`,`rk`.`id_rayon` AS `id_rayon`,`wk`.`id_wilayah` AS `id_wilayah`,`wk`.`id_mitra` AS `id_mitra`,'DD' AS `jenis_transaksi`,'rj' AS `rj` from (((((((`transaksi` `t` join `transaksi_dokter` `td` on((`td`.`id_transaksi` = `t`.`id_transaksi`))) join `master_tertanggung` `mt` on((`mt`.`id_tertanggung` = `t`.`id_tertanggung`))) join `master_karyawan` `mk` on((`mk`.`id_karyawan` = `mt`.`id_karyawan`))) join `rayon_karyawan` `rk` on((`rk`.`id_rayon` = `mk`.`id_rayon`))) join `wilayah_karyawan` `wk` on((`wk`.`id_wilayah` = `rk`.`id_wilayah`))) left join `master_dokter` `mdok` on((`mdok`.`id_dokter` = `td`.`id_dokter`))) left join `master_buku_besar` `mb` on((`mb`.`id_transaksi` = `t`.`id_transaksi`))) group by `t`.`id_transaksi`) */;

/*View structure for view v_transaksi */

/*!50001 DROP TABLE IF EXISTS `v_transaksi` */;
/*!50001 DROP VIEW IF EXISTS `v_transaksi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi` AS select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_apotek` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_apotek` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` union all select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_dokter` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_dokter` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` union all select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_gigi` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_gigi` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` union all select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_lain` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_lain` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` union all select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_optik` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_optik` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` union all select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_penunjang` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_penunjang` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` union all select `b`.`id_transaksi` AS `id_transaksi`,`b`.`tgl_transaksi` AS `tgl_transaksi`,`b`.`tgl_kunjungan` AS `tgl_kunjungan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`e`.`ap` AS `ap`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`a`.`buku_besar` AS `buku_besar`,`e`.`id_bagian` AS `id_bagian`,`i`.`nama_bagian` AS `nama_bagian`,`k`.`restitusi` AS `restitusi`,sum((`c`.`hrg_satuan` * `c`.`jumlah`)) AS `biaya_satuan`,sum((`j`.`harga_item` * `c`.`jumlah`)) AS `biaya_standar`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)),0)) AS `selisih`,sum(if((((`c`.`hrg_satuan` * `c`.`jumlah`) - (`j`.`harga_item` * `c`.`jumlah`)) > 0),(`j`.`harga_item` * `c`.`jumlah`),(`c`.`hrg_satuan` * `c`.`jumlah`))) AS `biaya_koreksi`,`f`.`id_rayon` AS `id_rayon`,`g`.`id_wilayah` AS `id_wilayah`,`h`.`id_mitra` AS `id_mitra` from ((((((((((`master_buku_besar` `a` join `transaksi` `b`) join `item_transaksi_rs` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `rayon_karyawan` `f`) join `wilayah_karyawan` `g`) join `mitra_karyawan` `h`) join `bagian_karyawan` `i`) join `master_item` `j`) join `transaksi_rmh_sakit` `k` on(((`b`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_transaksi` = `b`.`id_transaksi`) and (`b`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`e`.`id_rayon` = `f`.`id_rayon`) and (`f`.`id_wilayah` = `g`.`id_wilayah`) and (`g`.`id_mitra` = `h`.`id_mitra`) and (`e`.`id_bagian` = `i`.`id_bagian`) and (`c`.`id_item` = `j`.`id_item`) and (`b`.`id_transaksi` = `k`.`id_transaksi`)))) group by `b`.`id_transaksi` */;

/*View structure for view v_transaksi_all */

/*!50001 DROP TABLE IF EXISTS `v_transaksi_all` */;
/*!50001 DROP VIEW IF EXISTS `v_transaksi_all` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_all` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`b`.`id_dokter` AS `id_dokter` from (`transaksi` `a` join `transaksi_apotek` `b` on((`a`.`id_transaksi` = `b`.`id_transaksi`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`b`.`id_dokter` AS `id_dokter` from (`transaksi` `a` join `transaksi_dokter` `b` on((`a`.`id_transaksi` = `b`.`id_transaksi`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`b`.`id_dokter` AS `id_dokter` from (`transaksi` `a` join `transaksi_gigi` `b` on((`a`.`id_transaksi` = `b`.`id_transaksi`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`b`.`id_dokter` AS `id_dokter` from (`transaksi` `a` join `transaksi_lain` `b` on((`a`.`id_transaksi` = `b`.`id_transaksi`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`b`.`id_dokter` AS `id_dokter` from (`transaksi` `a` join `transaksi_optik` `b` on((`a`.`id_transaksi` = `b`.`id_transaksi`))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`b`.`id_dokter` AS `id_dokter` from (`transaksi` `a` join `transaksi_penunjang` `b` on((`a`.`id_transaksi` = `b`.`id_transaksi`))) order by `id_transaksi` */;

/*View structure for view v_transaksi_dokter */

/*!50001 DROP TABLE IF EXISTS `v_transaksi_dokter` */;
/*!50001 DROP VIEW IF EXISTS `v_transaksi_dokter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_dokter` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`h`.`nip` AS `nip`,`h`.`nama_karyawan` AS `nama_karyawan`,`h`.`ap` AS `ap`,`g`.`nama_tertanggung` AS `nama_tertanggung`,`g`.`status` AS `status`,`i`.`nama_dokter` AS `nama_dokter`,(`c`.`hrg_satuan` * `c`.`jumlah`) AS `biaya`,`d`.`nama_item` AS `nama_item`,`f`.`nama_dosis` AS `nama_dosis`,`c`.`jumlah` AS `jumlah`,if((substr(`f`.`nama_dosis`,4) = _latin1'1/2'),(round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1) * 2),(substr(`f`.`nama_dosis`,4) * round((`c`.`jumlah` / left(`f`.`nama_dosis`,1)),1))) AS `jumlah_hari`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `dosis_item` `e`) join `master_dosis` `f`) join `master_tertanggung` `g`) join `master_karyawan` `h`) join `master_dokter` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`d`.`id_item` = `e`.`id_item`) and (`e`.`id_dosis` = `f`.`id_dosis`) and (`a`.`id_transaksi` = `e`.`id_transaksi`) and (`a`.`id_tertanggung` = `g`.`id_tertanggung`) and (`g`.`id_karyawan` = `h`.`id_karyawan`) and (`b`.`id_dokter` = `i`.`id_dokter`) and (`h`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) */;

/*View structure for view v_transaksi_kunjungan_rs */

/*!50001 DROP TABLE IF EXISTS `v_transaksi_kunjungan_rs` */;
/*!50001 DROP VIEW IF EXISTS `v_transaksi_kunjungan_rs` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_kunjungan_rs` AS (select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`d`.`id_karyawan` AS `id_karyawan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`b`.`no_surat` AS `no_surat`,`b`.`tgl_masuk` AS `tgl_masuk`,`b`.`tgl_keluar` AS `tgl_keluar`,`b`.`id_provider` AS `id_provider`,`f`.`nama_provider` AS `nama_provider`,`c`.`diagnosa_masuk` AS `diagnosa_masuk`,`c`.`kondisi` AS `kondisi`,`c`.`dokter_rawat` AS `dokter_rawat`,`c`.`jenis_jml_obat` AS `jenis_jml_obat`,`c`.`tindakan` AS `tindakan`,`c`.`id_dokter` AS `id_dokter`,`g`.`nama_dokter` AS `nama_dokter` from ((((((`transaksi` `a` join `transaksi_kunjungan_rs` `b`) join `periksa_kunjungan_rs` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `master_provider` `f`) join `master_dokter` `g` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`b`.`id_provider` = `f`.`id_provider`) and (`c`.`id_dokter` = `g`.`id_dokter`)))) group by `a`.`id_transaksi`) */;

/*View structure for view v_transaksi_provider */

/*!50001 DROP TABLE IF EXISTS `v_transaksi_provider` */;
/*!50001 DROP VIEW IF EXISTS `v_transaksi_provider` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_provider` AS select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_provider` AS `nama_provider`,`f`.`idjenis_provider` AS `idjenis_provider`,`f`.`jenis_provider` AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_apotek` `b`) join `item_transaksi_apotek` `c`) join `master_item` `d`) join `master_provider` `e`) join `jenis_provider` `f`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_provider` = `e`.`id_provider`) and (`e`.`idjenis_provider` = `f`.`idjenis_provider`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_provider` AS `nama_provider`,`f`.`idjenis_provider` AS `idjenis_provider`,`f`.`jenis_provider` AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_gigi` `b`) join `item_transaksi_gigi` `c`) join `master_item` `d`) join `master_provider` `e`) join `jenis_provider` `f`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_provider` = `e`.`id_provider`) and (`e`.`idjenis_provider` = `f`.`idjenis_provider`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_provider` AS `nama_provider`,`f`.`idjenis_provider` AS `idjenis_provider`,`f`.`jenis_provider` AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_lain` `b`) join `item_transaksi_lain` `c`) join `master_item` `d`) join `master_provider` `e`) join `jenis_provider` `f`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_provider` = `e`.`id_provider`) and (`e`.`idjenis_provider` = `f`.`idjenis_provider`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_provider` AS `nama_provider`,`f`.`idjenis_provider` AS `idjenis_provider`,`f`.`jenis_provider` AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_optik` `b`) join `item_transaksi_optik` `c`) join `master_item` `d`) join `master_provider` `e`) join `jenis_provider` `f`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_provider` = `e`.`id_provider`) and (`e`.`idjenis_provider` = `f`.`idjenis_provider`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_provider` AS `nama_provider`,`f`.`idjenis_provider` AS `idjenis_provider`,`f`.`jenis_provider` AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_penunjang` `b`) join `item_transaksi_penunjang` `c`) join `master_item` `d`) join `master_provider` `e`) join `jenis_provider` `f`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_provider` = `e`.`id_provider`) and (`e`.`idjenis_provider` = `f`.`idjenis_provider`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_provider` AS `nama_provider`,`f`.`idjenis_provider` AS `idjenis_provider`,`f`.`jenis_provider` AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from ((((((((((`transaksi` `a` join `transaksi_rmh_sakit` `b`) join `item_transaksi_rs` `c`) join `master_item` `d`) join `master_provider` `e`) join `jenis_provider` `f`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_provider` = `e`.`id_provider`) and (`e`.`idjenis_provider` = `f`.`idjenis_provider`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) union all select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`i`.`nip` AS `nip`,`i`.`nama_karyawan` AS `nama_karyawan`,`i`.`ap` AS `ap`,`e`.`nama_dokter` AS `nama_dokter`,`e`.`kat_dokter` AS `kat_dokter`,if((`e`.`kat_dokter` = _utf8'2'),_utf8'umum',_utf8'spesialis') AS `jenis_provider`,`d`.`nama_item` AS `nama_item`,`c`.`jumlah` AS `jumlah`,`d`.`harga_item` AS `harga_item`,`c`.`hrg_satuan` AS `hrg_satuan`,`j`.`id_rayon` AS `id_rayon`,`k`.`id_wilayah` AS `id_wilayah`,`l`.`id_mitra` AS `id_mitra` from (((((((((`transaksi` `a` join `transaksi_dokter` `b`) join `item_transaksi_dokter` `c`) join `master_item` `d`) join `master_dokter` `e`) join `master_tertanggung` `h`) join `master_karyawan` `i`) join `rayon_karyawan` `j`) join `wilayah_karyawan` `k`) join `mitra_karyawan` `l` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`c`.`id_item` = `d`.`id_item`) and (`b`.`id_dokter` = `e`.`id_dokter`) and (`a`.`id_tertanggung` = `h`.`id_tertanggung`) and (`h`.`id_karyawan` = `i`.`id_karyawan`) and (`i`.`id_rayon` = `j`.`id_rayon`) and (`j`.`id_wilayah` = `k`.`id_wilayah`) and (`k`.`id_mitra` = `l`.`id_mitra`)))) order by `id_transaksi` */;

/*View structure for view v_transaksi_rekam_medis */

/*!50001 DROP TABLE IF EXISTS `v_transaksi_rekam_medis` */;
/*!50001 DROP VIEW IF EXISTS `v_transaksi_rekam_medis` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_rekam_medis` AS (select `a`.`id_transaksi` AS `id_transaksi`,`a`.`tgl_transaksi` AS `tgl_transaksi`,`a`.`tgl_kunjungan` AS `tgl_kunjungan`,`a`.`id_tertanggung` AS `id_tertanggung`,`d`.`nama_tertanggung` AS `nama_tertanggung`,`d`.`id_karyawan` AS `id_karyawan`,`e`.`nip` AS `nip`,`e`.`nama_karyawan` AS `nama_karyawan`,`b`.`tgl_masuk` AS `tgl_masuk`,`b`.`no_kamar` AS `no_kamar`,`b`.`tgl_keluar` AS `tgl_keluar`,`b`.`id_provider` AS `id_provider`,`f`.`nama_provider` AS `nama_provider`,`c`.`diagnosa_masuk` AS `diagnosa_masuk`,`c`.`diagnosa_keluar` AS `diagnosa_keluar`,`c`.`riwayat` AS `riwayat`,`c`.`periksa_fisik` AS `periksa_fisik`,`c`.`hasil_lab` AS `hasil_lab`,`c`.`hasil_rontgen` AS `hasil_rontgen`,`c`.`hasil_lain` AS `hasil_lain`,`c`.`progres_harian` AS `progres_harian`,`c`.`pasca_rawat` AS `pasca_rawat`,`c`.`tindakan` AS `tindakan` from (((((`transaksi` `a` join `transaksi_rekam_medis` `b`) join `periksa_rekam_medis` `c`) join `master_tertanggung` `d`) join `master_karyawan` `e`) join `master_provider` `f` on(((`a`.`id_transaksi` = `b`.`id_transaksi`) and (`a`.`id_transaksi` = `c`.`id_transaksi`) and (`a`.`id_tertanggung` = `d`.`id_tertanggung`) and (`d`.`id_karyawan` = `e`.`id_karyawan`) and (`b`.`id_provider` = `f`.`id_provider`)))) group by `a`.`id_transaksi`) */;

/*View structure for view v_user */

/*!50001 DROP TABLE IF EXISTS `v_user` */;
/*!50001 DROP VIEW IF EXISTS `v_user` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user` AS select `user`.`user_id` AS `user_id`,`user`.`user_username` AS `user_username`,`user`.`user_password` AS `user_password`,`user`.`user_name` AS `user_name`,`user`.`user_level` AS `user_level`,`level_user`.`name_level` AS `name_level`,`user_rayon`.`id_rayon` AS `id_rayon`,`user_wilayah`.`id_wilayah` AS `id_wilayah`,`user_mitra`.`id_mitra` AS `id_mitra` from (((((`user` left join `level_user` on((`user`.`user_level` = `level_user`.`user_level`))) left join `user_mitra` on((`user_mitra`.`user_id` = `user`.`user_id`))) left join `mitra_karyawan` on((`user_mitra`.`id_mitra` = `mitra_karyawan`.`id_mitra`))) left join `user_rayon` on((`user_rayon`.`user_id` = `user`.`user_id`))) left join `user_wilayah` on((`user_wilayah`.`user_id` = `user`.`user_id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
