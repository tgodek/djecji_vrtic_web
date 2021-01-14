-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 08:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdip2019x041`
--

-- --------------------------------------------------------

--
-- Table structure for table `dijete`
--

CREATE TABLE `dijete` (
  `OIB_dijete` char(11) NOT NULL,
  `ime_djeteta` varchar(25) NOT NULL,
  `prezime_djeteta` varchar(25) NOT NULL,
  `godine` int(11) NOT NULL,
  `spol` char(1) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `skupina_ID` int(11) NOT NULL,
  `prijava_ID` int(11) NOT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dijete`
--

INSERT INTO `dijete` (`OIB_dijete`, `ime_djeteta`, `prezime_djeteta`, `godine`, `spol`, `slika`, `skupina_ID`, `prijava_ID`, `korisnik_ID`) VALUES
('11111111111', 'jan', 'janic', 6, 'M', '9605_slika.jpg', 26, 31, 17),
('22222222222', 'Eva', 'Maric', 3, 'Z', '1414_slika.jpg', 26, 31, 17);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_ID` int(11) NOT NULL,
  `radnja` text NOT NULL,
  `upit` text DEFAULT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `korisnik_ID` int(11) NOT NULL,
  `tip_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dodjeljen`
--

CREATE TABLE `dodjeljen` (
  `vrtic_ID` int(11) NOT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evidencija_dolaska`
--

CREATE TABLE `evidencija_dolaska` (
  `evidencija_dolaska_ID` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `status_evidencije` varchar(45) NOT NULL,
  `racun_ID` int(11) NOT NULL,
  `OIB_dijete` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `javni_poziv`
--

CREATE TABLE `javni_poziv` (
  `javni_poziv_ID` int(11) NOT NULL,
  `broj_mjesta` int(11) NOT NULL,
  `datum_vrijeme_pocetak` datetime NOT NULL,
  `datum_vrijeme_kraj` datetime NOT NULL,
  `vrtic_ID` int(11) NOT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `javni_poziv`
--

INSERT INTO `javni_poziv` (`javni_poziv_ID`, `broj_mjesta`, `datum_vrijeme_pocetak`, `datum_vrijeme_kraj`, `vrtic_ID`, `korisnik_ID`) VALUES
(12, 60, '2020-06-10 14:39:00', '2020-06-20 14:00:00', 6, 19),
(14, 25, '2020-06-01 10:00:00', '2020-06-11 17:00:00', 7, 20),
(15, 5, '2020-06-01 15:14:00', '2020-06-15 15:14:00', 6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_ID` int(11) NOT NULL,
  `ime_korisnika` varchar(45) NOT NULL,
  `prezime_korisnika` varchar(45) NOT NULL,
  `kor_ime` varchar(25) NOT NULL,
  `lozinka` varchar(25) NOT NULL,
  `lozinka_sha1` char(40) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uvjeti` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `uloga_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_ID`, `ime_korisnika`, `prezime_korisnika`, `kor_ime`, `lozinka`, `lozinka_sha1`, `email`, `uvjeti`, `status`, `uloga_ID`) VALUES
(16, 'Tomi', 'Godek', 'tom1604', 'Tgodek123', '948cf71fcbd1404c6c69bd3ec5366c371cbef39c', 'tgodek@foi.hr', NULL, 1, 1),
(17, 'Marko', 'Marić', 'mmaric123', 'Mmaric123', '32d99e636a921fab2b97e46ecf8ccb96fbffc1a0', 'mmaric@foi.hr', NULL, 1, 3),
(18, 'Juro', 'Jurić', 'jjuric123', 'Jjuric123', '01fb2ec66013d91faa9f5079af755f1fe1223c05', 'jjuric@mailinator.com', NULL, 1, 3),
(19, 'Pero', 'Peric', 'pperic', 'Pperic123', '047c1d5f2c42a564008c77c53dbab538f5215a89', 'pperic@foi.hr', NULL, 1, 2),
(20, 'Zdravko', 'Zdravic', 'zzdravic123', 'Zzdravic123', 'fc300decf64d2e0343b53d710b2c52af23ba61a1', 'zzdravic@gmail.com', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ocjena_vrtica`
--

CREATE TABLE `ocjena_vrtica` (
  `ocjena_vrtica_ID` int(11) NOT NULL,
  `mjesec` varchar(25) NOT NULL,
  `godina` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL,
  `vrtic_ID` int(11) NOT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ocjena_vrtica`
--

INSERT INTO `ocjena_vrtica` (`ocjena_vrtica_ID`, `mjesec`, `godina`, `ocjena`, `vrtic_ID`, `korisnik_ID`) VALUES
(13, '06', 2020, 5, 6, 16),
(14, '04', 2020, 7, 6, 16),
(15, '05', 2020, 4, 6, 16),
(16, '06', 2020, 8, 7, 16);

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `prijava_ID` int(11) NOT NULL,
  `datum_prijave` datetime NOT NULL,
  `status_prijave` varchar(20) NOT NULL DEFAULT 'u tijeku',
  `javni_poziv_ID` int(11) NOT NULL,
  `skupina_ID` int(11) NOT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`prijava_ID`, `datum_prijave`, `status_prijave`, `javni_poziv_ID`, `skupina_ID`, `korisnik_ID`) VALUES
(27, '2020-06-08 10:39:22', 'odobren', 12, 26, 18),
(30, '2020-06-09 12:25:43', 'u tijeku', 14, 29, 17),
(31, '2020-06-09 09:09:06', 'odobren', 12, 26, 17),
(32, '2020-06-12 03:15:56', 'u tijeku', 15, 27, 17);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `racun_ID` int(11) NOT NULL,
  `mjesec` varchar(25) NOT NULL,
  `godina` int(11) NOT NULL,
  `iznos` int(11) NOT NULL,
  `status_racuna` varchar(20) DEFAULT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

CREATE TABLE `skupina` (
  `skupina_ID` int(11) NOT NULL,
  `naziv_skupine` varchar(25) NOT NULL,
  `broj_djece` int(11) DEFAULT NULL,
  `mj_naplata` int(11) NOT NULL,
  `korisnik_ID` int(11) NOT NULL,
  `vrtic_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skupina`
--

INSERT INTO `skupina` (`skupina_ID`, `naziv_skupine`, `broj_djece`, `mj_naplata`, `korisnik_ID`, `vrtic_ID`) VALUES
(26, 'a', NULL, 300, 19, 6),
(27, 'b', NULL, 300, 19, 6),
(29, 'a', NULL, 220, 20, 7),
(30, 'c', 0, 120, 19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `tip_ID` int(11) NOT NULL,
  `naziv_tipa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`tip_ID`, `naziv_tipa`) VALUES
(1, 'prijava'),
(2, 'odjava'),
(3, 'rad s bazom'),
(4, 'ostale radnje');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_ID` int(11) NOT NULL,
  `naziv_uloge` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_ID`, `naziv_uloge`) VALUES
(1, 'administrator'),
(2, 'voditelj'),
(3, 'roditelj'),
(4, 'neregistriran');

-- --------------------------------------------------------

--
-- Table structure for table `vrtic`
--

CREATE TABLE `vrtic` (
  `vrtic_ID` int(11) NOT NULL,
  `ime_vrtica` varchar(45) NOT NULL,
  `lokacija` varchar(45) NOT NULL,
  `galerija` varchar(100) NOT NULL,
  `korisnik_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vrtic`
--

INSERT INTO `vrtic` (`vrtic_ID`, `ime_vrtica`, `lokacija`, `galerija`, `korisnik_ID`) VALUES
(6, 'Sunce', 'zvonimira 12', 'default.jpg', 19),
(7, 'Radost', 'trg svete Ane 36', 'default.jpg', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dijete`
--
ALTER TABLE `dijete`
  ADD PRIMARY KEY (`OIB_dijete`,`korisnik_ID`),
  ADD KEY `fk_dijete_skupina1_idx` (`skupina_ID`),
  ADD KEY `fk_dijete_prijava1_idx` (`prijava_ID`),
  ADD KEY `fk_dijete_korisnik1_idx` (`korisnik_ID`);

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_ID`,`korisnik_ID`,`tip_ID`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_ID`),
  ADD KEY `fk_dnevnik_tip1_idx` (`tip_ID`);

--
-- Indexes for table `dodjeljen`
--
ALTER TABLE `dodjeljen`
  ADD PRIMARY KEY (`korisnik_ID`,`vrtic_ID`),
  ADD UNIQUE KEY `korisnik_ID_UNIQUE` (`korisnik_ID`),
  ADD UNIQUE KEY `vrtic_ID_UNIQUE` (`vrtic_ID`),
  ADD KEY `fk_dodjeljen_vrtic1_idx` (`vrtic_ID`),
  ADD KEY `fk_dodjeljen_korisnik1_idx` (`korisnik_ID`);

--
-- Indexes for table `evidencija_dolaska`
--
ALTER TABLE `evidencija_dolaska`
  ADD PRIMARY KEY (`evidencija_dolaska_ID`),
  ADD KEY `fk_evidencija_dolaska_racun1_idx` (`racun_ID`),
  ADD KEY `fk_evidencija_dolaska_dijete1_idx` (`OIB_dijete`);

--
-- Indexes for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  ADD PRIMARY KEY (`javni_poziv_ID`),
  ADD KEY `fk_javni_poziv_vrtic1_idx` (`vrtic_ID`),
  ADD KEY `fk_javni_poziv_korisnik1_idx` (`korisnik_ID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_ID`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_ID`);

--
-- Indexes for table `ocjena_vrtica`
--
ALTER TABLE `ocjena_vrtica`
  ADD PRIMARY KEY (`ocjena_vrtica_ID`),
  ADD KEY `fk_ocjena_vrtica_vrtic1_idx` (`vrtic_ID`),
  ADD KEY `fk_ocjena_vrtica_korisnik1_idx` (`korisnik_ID`);

--
-- Indexes for table `prijava`
--
ALTER TABLE `prijava`
  ADD PRIMARY KEY (`prijava_ID`),
  ADD KEY `fk_prijava_javni_poziv1_idx` (`javni_poziv_ID`),
  ADD KEY `fk_prijava_skupina1_idx` (`skupina_ID`),
  ADD KEY `fk_prijava_korisnik1_idx` (`korisnik_ID`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`racun_ID`),
  ADD KEY `fk_racun_korisnik1_idx` (`korisnik_ID`);

--
-- Indexes for table `skupina`
--
ALTER TABLE `skupina`
  ADD PRIMARY KEY (`skupina_ID`),
  ADD KEY `fk_skupina_korisnik1_idx` (`korisnik_ID`),
  ADD KEY `fk_skupina_vrtic1_idx` (`vrtic_ID`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`tip_ID`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_ID`);

--
-- Indexes for table `vrtic`
--
ALTER TABLE `vrtic`
  ADD PRIMARY KEY (`vrtic_ID`),
  ADD KEY `fk_vrtic_korisnik1_idx` (`korisnik_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `evidencija_dolaska`
--
ALTER TABLE `evidencija_dolaska`
  MODIFY `evidencija_dolaska_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  MODIFY `javni_poziv_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ocjena_vrtica`
--
ALTER TABLE `ocjena_vrtica`
  MODIFY `ocjena_vrtica_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prijava`
--
ALTER TABLE `prijava`
  MODIFY `prijava_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `racun_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skupina`
--
ALTER TABLE `skupina`
  MODIFY `skupina_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `tip_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `uloga_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vrtic`
--
ALTER TABLE `vrtic`
  MODIFY `vrtic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dijete`
--
ALTER TABLE `dijete`
  ADD CONSTRAINT `fk_dijete_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dijete_prijava1` FOREIGN KEY (`prijava_ID`) REFERENCES `prijava` (`prijava_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dijete_skupina1` FOREIGN KEY (`skupina_ID`) REFERENCES `skupina` (`skupina_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dnevnik_tip1` FOREIGN KEY (`tip_ID`) REFERENCES `tip` (`tip_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dodjeljen`
--
ALTER TABLE `dodjeljen`
  ADD CONSTRAINT `fk_dodjeljen_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dodjeljen_vrtic1` FOREIGN KEY (`vrtic_ID`) REFERENCES `vrtic` (`vrtic_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evidencija_dolaska`
--
ALTER TABLE `evidencija_dolaska`
  ADD CONSTRAINT `fk_evidencija_dolaska_dijete1` FOREIGN KEY (`OIB_dijete`) REFERENCES `dijete` (`OIB_dijete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evidencija_dolaska_racun1` FOREIGN KEY (`racun_ID`) REFERENCES `racun` (`racun_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `javni_poziv`
--
ALTER TABLE `javni_poziv`
  ADD CONSTRAINT `fk_javni_poziv_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_javni_poziv_vrtic1` FOREIGN KEY (`vrtic_ID`) REFERENCES `vrtic` (`vrtic_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_ID`) REFERENCES `uloga` (`uloga_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ocjena_vrtica`
--
ALTER TABLE `ocjena_vrtica`
  ADD CONSTRAINT `fk_ocjena_vrtica_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ocjena_vrtica_vrtic1` FOREIGN KEY (`vrtic_ID`) REFERENCES `vrtic` (`vrtic_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `fk_prijava_javni_poziv1` FOREIGN KEY (`javni_poziv_ID`) REFERENCES `javni_poziv` (`javni_poziv_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prijava_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prijava_skupina1` FOREIGN KEY (`skupina_ID`) REFERENCES `skupina` (`skupina_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `fk_racun_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skupina`
--
ALTER TABLE `skupina`
  ADD CONSTRAINT `fk_skupina_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_skupina_vrtic1` FOREIGN KEY (`vrtic_ID`) REFERENCES `vrtic` (`vrtic_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vrtic`
--
ALTER TABLE `vrtic`
  ADD CONSTRAINT `fk_vrtic_korisnik1` FOREIGN KEY (`korisnik_ID`) REFERENCES `korisnik` (`korisnik_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
