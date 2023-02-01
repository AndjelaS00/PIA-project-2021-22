-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2022 at 09:44 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andjela`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivnosti`
--

DROP TABLE IF EXISTS `aktivnosti`;
CREATE TABLE IF NOT EXISTS `aktivnosti` (
  `idAktivnosti` int(5) NOT NULL,
  `idProjekta` int(5) NOT NULL,
  `nazivAktivnosti` text NOT NULL,
  `opisAktivnosti` text NOT NULL,
  `statusAktivnosti` text NOT NULL,
  `komentar` text NOT NULL,
  `odgovorKomentara` text NOT NULL,
  PRIMARY KEY (`idAktivnosti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aktivnosti`
--

INSERT INTO `aktivnosti` (`idAktivnosti`, `idProjekta`, `nazivAktivnosti`, `opisAktivnosti`, `statusAktivnosti`, `komentar`, `odgovorKomentara`) VALUES
(1, 1, 'Portreti', 'crtanje portreta svim tehnikama', 'u fazi izvrsavanja', '', 'Slazem se'),
(2, 1, 'Pejzazi', 'Crtanje pejzaza', 'u fazi izvrsavanja', 'Dobar izbor tehnike.', 'odlicno'),
(3, 2, 'Autobiografija', 'Pisanje licne biografije od strane korisnika', 'ZavrÅ¡en', 'Zanimljivo', '/'),
(4, 2, 'Ljubavni romani', 'Pisanje romana', 'u fazi izvrsavanja', 'Jako emotivno', '/'),
(5, 3, 'Klasicna dela', 'Komponovanje klasicne kuzike ', 'u fazi izvrsavanja', 'Opustajuce', ''),
(6, 3, 'Moderna muzika', 'Komponovanje savremene muzike ', 'Zavrsen', 'Kul', ''),
(7, 4, 'Izrada zvuka', 'Podesavanje zvuka za film i njegovo povezivanje sa slikom', 'u fazi izvrsavanja', '', ''),
(8, 4, 'Snimanje', 'Snimanje filma i povezivanje snimaka u jedan', 'u fazi izvrsavanja', 'Interesantno delo', '');

-- --------------------------------------------------------

--
-- Table structure for table `delegirano`
--

DROP TABLE IF EXISTS `delegirano`;
CREATE TABLE IF NOT EXISTS `delegirano` (
  `idAktivnosti` int(50) NOT NULL,
  `idKorisnika` int(50) NOT NULL,
  PRIMARY KEY (`idAktivnosti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delegirano`
--

INSERT INTO `delegirano` (`idAktivnosti`, `idKorisnika`) VALUES
(1, 1),
(2, 4),
(3, 6),
(4, 8),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `knjiga`
--

DROP TABLE IF EXISTS `knjiga`;
CREATE TABLE IF NOT EXISTS `knjiga` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `autor` varchar(200) NOT NULL,
  `naslov` varchar(200) NOT NULL,
  `godina` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knjiga`
--

INSERT INTO `knjiga` (`id`, `autor`, `naslov`, `godina`) VALUES
(1, 'Ivo Andric', 'Na Drini Cuprija', 1960),
(2, 'Ivana', 'Kafidzonka', 2021),
(3, 'Andjela Ivana', 'Pijemon kafu', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKorisnika` int(5) NOT NULL AUTO_INCREMENT,
  `prezime` text NOT NULL,
  `ime` text NOT NULL,
  `uloga` text NOT NULL,
  `korisnickoIme` varchar(20) NOT NULL,
  `sifra` text NOT NULL,
  `potvrda` int(15) NOT NULL,
  PRIMARY KEY (`idKorisnika`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnika`, `prezime`, `ime`, `uloga`, `korisnickoIme`, `sifra`, `potvrda`) VALUES
(1, 'Veljkovic', 'Nemanja', 'MenadÅ¾er', 'nemanja123', '12345', 1),
(2, 'Stanojevic', 'Sladjana', 'Zaposleni', 'sladjana12', '12345', 1),
(3, 'Stefanovic', 'Andjela', 'Administrator', 'andjela123', '1234', 1),
(4, 'Jovanovic', 'Nevena', 'Zaposleni', 'nevena12', '12345', 1),
(6, 'Jovanovic', 'Ognjen', 'Zaposleni', 'ognjen12', '12345', 1),
(5, 'Mikic', 'Ivana', 'Menadžer', 'ivana12', '12345', 0),
(7, 'Vukovic', 'Milos', '', 'milos12', '1234', 1),
(8, 'Solunac', 'Sofija', 'Zaposleni', 'sofija12', '12345', 1),
(10, 'Presic', 'ivan', 'zaposleni', 'ivan12', '1234', 1),
(12, 'potparic', 'nikolina', 'menadzer', 'nikolina12', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projekat`
--

DROP TABLE IF EXISTS `projekat`;
CREATE TABLE IF NOT EXISTS `projekat` (
  `idProjekta` int(5) NOT NULL AUTO_INCREMENT,
  `nazivProjekta` text NOT NULL,
  `lokacija` text NOT NULL,
  `sprema` text NOT NULL,
  `opis` text NOT NULL,
  `pogodnosti` text NOT NULL,
  `rok` text NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`idProjekta`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projekat`
--

INSERT INTO `projekat` (`idProjekta`, `nazivProjekta`, `lokacija`, `sprema`, `opis`, `pogodnosti`, `rok`, `status`) VALUES
(2, 'Pisanje', 'Jagodina', 'srednja', 'Pisanje dela na osnovu price klijenta', 'rad od kuce', '2.2.2023.', 'cekanje'),
(1, 'Crtanje', 'Kragujevac', 'osnovna', 'Crtanje razlicitim tehnikama na platnu', 'kreativnost je lako ispoljiti', '1.1.2023.', '0'),
(3, 'Komponovanje', 'Kragujevac', 'fakultet', 'Komponovanje dela razlicitih zanrova ', 'Rad od kuce', '12.12.2022.', 'zavrseno'),
(4, 'Snimanje filmova', 'Beograd', 'fakultet', 'Snimanje kratkometraznih filmova po zelji klijenata', 'Dobro placen posao', '1.5.2024.', 'u fazi izvrsavanja'),
(5, 'Heklanje', 'Batocina', 'osnovna', 'Heklanje inovativnih stolnjaka', 'Cuvanje tradicije', '1.1.2023.', 'zavrsen');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
