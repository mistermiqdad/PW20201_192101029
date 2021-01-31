/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.1.31-MariaDB : Database - db_kuliah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kuliah` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_kuliah`;

/*Table structure for table `tb_distribusi` */

DROP TABLE IF EXISTS `tb_distribusi`;

CREATE TABLE `tb_distribusi` (
  `IndexDistribusi` int(11) NOT NULL AUTO_INCREMENT,
  `NamaSekolah` varchar(150) DEFAULT NULL,
  `Kelas` int(3) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`IndexDistribusi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_distribusi` */

insert  into `tb_distribusi`(`IndexDistribusi`,`NamaSekolah`,`Kelas`,`Jumlah`) values 
(3,'SMK Wikrama',2,13),
(4,'SMA 1 Bogor',1,7);

/*Table structure for table `tb_stock` */

DROP TABLE IF EXISTS `tb_stock`;

CREATE TABLE `tb_stock` (
  `IndexStock` int(11) NOT NULL AUTO_INCREMENT,
  `Kelas` int(3) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL,
  `NilaiPersediaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`IndexStock`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_stock` */

insert  into `tb_stock`(`IndexStock`,`Kelas`,`Jumlah`,`Harga`,`NilaiPersediaan`) values 
(1,2,7,150000,1050000),
(4,1,3,10000,30000),
(5,3,35,150000,5250000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
