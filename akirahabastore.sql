/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - akihabarastore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`akihabarastore` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `akihabarastore`;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id_alamat` char(20) NOT NULL,
  `id_user` char(20) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  KEY `fk_user_address` (`id_user`),
  CONSTRAINT `fk_user_address` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `address` */

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_pgw` char(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` char(15) NOT NULL,
  `data_ktp` varchar(100) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `profil_pic` varchar(100) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_online` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` varchar(10) NOT NULL,
  `status` char(10) NOT NULL,
  PRIMARY KEY (`id_pgw`),
  UNIQUE KEY `EMAIL` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `karyawan` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` char(8) NOT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`kategori`) values 
('CAT1','Nendoroid'),
('CAT2','Action Figures'),
('CAT3','Light Novel'),
('CAT4','Manga'),
('CAT5','Merchandise');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` char(15) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `id_kategori` char(8) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `product_pic` varchar(200) NOT NULL,
  `tgl_register` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_produk`),
  KEY `fk_category_product` (`id_kategori`),
  CONSTRAINT `fk_category_product` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `produk` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` char(20) NOT NULL,
  `id_user` char(20) NOT NULL,
  `id_produk` char(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kurir` varchar(50) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_user_transaction` (`id_user`),
  KEY `fk_product_transaction` (`id_produk`),
  CONSTRAINT `fk_product_transaction` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_transaction` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` char(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` char(15) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `profil_pic` varchar(100) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

/*Table structure for table `wishlist` */

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id_wish` char(20) NOT NULL,
  `id_user` char(20) DEFAULT NULL,
  `id_produk` char(15) DEFAULT NULL,
  PRIMARY KEY (`id_wish`),
  KEY `fk_user_wishlist` (`id_user`),
  KEY `fk_produk_wishlist` (`id_produk`),
  CONSTRAINT `fk_produk_wishlist` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_wishlist` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `wishlist` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
