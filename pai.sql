-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 26 Lis 2022, 18:12
-- Wersja serwera: 10.4.10-MariaDB
-- Wersja PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pai`
--
CREATE DATABASE IF NOT EXISTS `pai` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `pai`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

DROP TABLE IF EXISTS `adresy`;
CREATE TABLE IF NOT EXISTS `adresy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idKlienta` int(11) NOT NULL,
  `imie` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `ulica` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `nrDomu` int(11) NOT NULL,
  `nrMieszkania` int(11) DEFAULT NULL,
  `kodPocztowy` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `miasto` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `adresy`
--

INSERT INTO `adresy` (`id`, `idKlienta`, `imie`, `nazwisko`, `ulica`, `nrDomu`, `nrMieszkania`, `kodPocztowy`, `miasto`) VALUES
(4, 1, 'Maciej', 'Olech', 'Marszew', 10, NULL, '97-225', 'Ujazd'),
(8, 1, 'Jan', 'Nowak', 'Marchwiowa', 11, 22, '22-112', 'Działdkowice'),
(9, 4, 'Jacek', 'Kowalski', 'Śmietankowa', 3, 11, '11-223', 'Szczecin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmrezyser`
--

DROP TABLE IF EXISTS `filmrezyser`;
CREATE TABLE IF NOT EXISTS `filmrezyser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilmu` int(11) NOT NULL,
  `idRezysera` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFilmu` (`idFilmu`),
  KEY `idRezysera` (`idRezysera`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `filmrezyser`
--

INSERT INTO `filmrezyser` (`id`, `idFilmu`, `idRezysera`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 6),
(4, 4, 4),
(5, 5, 5),
(7, 12, 11),
(13, 13, 13),
(14, 13, 12),
(15, 14, 18),
(16, 15, 19),
(17, 16, 21),
(18, 17, 23),
(19, 18, 25),
(20, 19, 27),
(21, 20, 31),
(22, 21, 34),
(23, 22, 35),
(24, 23, 37),
(25, 24, 39),
(26, 25, 39),
(27, 26, 36),
(28, 27, 42),
(29, 28, 45),
(30, 29, 46),
(31, 30, 49),
(32, 31, 53);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmscenarzysta`
--

DROP TABLE IF EXISTS `filmscenarzysta`;
CREATE TABLE IF NOT EXISTS `filmscenarzysta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilmu` int(11) NOT NULL,
  `idScenarzysty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFilmu` (`idFilmu`),
  KEY `idScenarzysty` (`idScenarzysty`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `filmscenarzysta`
--

INSERT INTO `filmscenarzysta` (`id`, `idFilmu`, `idScenarzysty`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 10, 9),
(7, 10, 10),
(12, 12, 11),
(17, 13, 15),
(19, 13, 14),
(20, 14, 16),
(21, 14, 17),
(22, 15, 19),
(23, 15, 20),
(24, 16, 21),
(25, 16, 22),
(26, 17, 24),
(27, 18, 25),
(28, 19, 26),
(29, 19, 28),
(30, 19, 29),
(31, 19, 30),
(32, 20, 32),
(33, 20, 33),
(34, 21, 34),
(35, 22, 36),
(36, 23, 38),
(37, 24, 40),
(38, 25, 41),
(39, 26, 41),
(40, 27, 42),
(41, 27, 43),
(42, 28, 44),
(43, 29, 47),
(44, 29, 46),
(45, 29, 48),
(46, 30, 49),
(47, 30, 50),
(48, 30, 51),
(49, 31, 53);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy`
--

DROP TABLE IF EXISTS `filmy`;
CREATE TABLE IF NOT EXISTS `filmy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `orgTytul` varchar(90) COLLATE utf8_polish_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `zwiastun` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `calyfilm` varchar(15) COLLATE utf8_polish_ci NOT NULL DEFAULT 'aqz-KE-bpKQ',
  `krajProdukcji` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `opisFilmu` text COLLATE utf8_polish_ci NOT NULL,
  `dataProdukcji` date NOT NULL,
  `cenaZakupu` float NOT NULL,
  `lektor` tinyint(1) NOT NULL DEFAULT 0,
  `dubbing` tinyint(1) NOT NULL DEFAULT 0,
  `napisy` tinyint(1) NOT NULL DEFAULT 0,
  `odslony` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `image` (`image`),
  UNIQUE KEY `zwiastun` (`zwiastun`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `filmy`
--

INSERT INTO `filmy` (`id`, `tytul`, `orgTytul`, `image`, `zwiastun`, `calyfilm`, `krajProdukcji`, `opisFilmu`, `dataProdukcji`, `cenaZakupu`, `lektor`, `dubbing`, `napisy`, `odslony`) VALUES
(1, '30 nocy paranormalnej aktywności z opętaną przez diabła dziewczyną z tatuażem', '30 Nights of Paranormal Activity with the Devil Inside the Girl with the Dragon Tattoo', '7505177.6.jpg', 'fFERDRMOIB4', 'aqz-KE-bpKQ', 'USA', 'Dana wychowywała się w szpitalu psychiatrycznym. Jej ojciec trafił tam po tym, jak zamordował całą ekipę filmu \"Artysta\". Po latach Dana wraz z mężem Aaronem wprowadza się do nawiedzonego domu, w którym mieszkał ojciec. Tam muszą stawić czoła \"innym\" mieszkańcom, takim jak zły duch czy nastoletnia pasierbica , zadurzona w sąsiedzie - Abrahamie Lincolnie .', '2013-01-15', 25, 1, 0, 1, 3),
(2, 'Pulp Fiction', '', '7517880.6.jpg', '5ZAhzsi1ybM', 'aqz-KE-bpKQ', 'USA', 'Przemoc i odkupienie w opowieści o dwóch płatnych mordercach pracujących na zlecenie mafii, żonie gangstera, bokserze i parze okradającej ludzi w restauracji.', '1994-05-12', 25, 1, 0, 0, 9),
(3, 'Boże Ciało', '', '7897966.6.jpg', 'Y22lmaNA_Aw', 'aqz-KE-bpKQ', 'Polska', 'Dwudziestoletni Daniel zostaje warunkowo zwolniony z poprawczaka. Wyjeżdża na drugi koniec Polski, żeby pracować w stolarni, ale zamiast tego zaczyna udawać księdza.', '2019-08-29', 25, 0, 0, 0, 6),
(4, 'Szkoła czarownic: Dziedzictwo', 'The Craft: Legacy', '7934502.6.jpg', 'pDYNZewDq9A', 'aqz-KE-bpKQ', 'USA', 'Główną bohaterką filmu jest Lilith, która wraz z matką przeprowadza się do Los Angeles, gdzie zamieszka wraz ze swoim ojczymem. W nowym liceum dziewczyna zaprzyjaźnia się z trzema koleżankami, z którymi zaczyna eksperymentować z czarami. W wyniku magicznego eksperymentu wszystkie dziewczyny otrzymują nadprzyrodzone moce od bóstwa Manon. Początkowo nowe umiejętności zdają się rozwiązywać wszystkie problemy nastolatek, ale z czasem doprowadzają do mrocznych konsekwencji.', '2020-10-30', 25, 0, 0, 1, 3),
(5, 'Proces Siódemki z Chicago', 'The Trial of the Chicago 7', 'proces7.jpg', 'f35C_CjOHlE', 'aqz-KE-bpKQ', 'USA', 'Pokojowy protest przerodził się w brutalne starcie z policją, a jego organizatorzy stanęli przed sądem. Tak rozpoczął się jeden z najgłośniejszych procesów w historii.', '2020-10-01', 25, 0, 0, 1, 8),
(10, '21 mostów', '21 Bridges', '7924192.6.jpg', 'BVZDhunTrYA', 'aqz-KE-bpKQ', 'USA', 'Zhańbiony detektyw nowojorskiej policji otrzymuje szansę na odkupienie.', '2019-09-25', 25, 0, 0, 1, 6),
(12, 'Asymetria', '', '7936992.6.jpg', 'xc00dLngalU', 'aqz-KE-bpKQ', 'Polska', 'Piotr Sternik wraz ze swoją dziewczyną Weroniką  planują wspólną przyszłość. Nie spodziewają się, że jeden wieczór może zmienić wszystko… Nie tylko w ich życiu. \"Asymetria\" to opowieść o wyborach, decyzjach i konsekwencjach. Czasem nie ma dobrej drogi.', '2020-11-13', 25, 0, 0, 0, 5),
(13, 'Zwierzogród', 'Zootopia', '7713593.6.jpg', 'GxLXGoEFc8Q', 'aqz-KE-bpKQ', 'USA', 'Nick Bajer – żyjący z drobnych przekrętów szczwany lis, i Judy Hops – pierwszy w historii królik zatrudniony w policji, łączą siły, by rozwiązać pewną kryminalną zagadkę.', '2016-02-10', 25, 0, 1, 0, 4),
(14, 'Deadpool', '', '7716978.6.jpg', 'CnYv2yj2D3M', 'aqz-KE-bpKQ', 'USA', 'Były żołnierz oddziałów specjalnych zostaje poddany niebezpiecznemu eksperymentowi. Niebawem uwalnia swoje alter ego i rozpoczyna polowanie na człowieka, który niemal zniszczył jego życie.', '2016-01-21', 25, 1, 1, 1, 16),
(15, 'Na rauszu', 'Druk', '7935240.6.jpg', 'reetjA0zxtg', 'aqz-KE-bpKQ', 'Dania', '\"Na rauszu\" opowiada historię grupy przyjaciół, nauczycieli szkoły średniej, zainspirowanych teorią, że skromna dawka alkoholu pozwala otworzyć się na świat i lepiej w nim funkcjonować.\r\nNie przewidują jednak skutków, jakie pociągnie za sobą długotrwałe utrzymywanie stałego poziomu promili we krwi – przez cały dzień, również w pracy...', '2020-09-12', 19.99, 0, 0, 1, 15),
(16, 'Joker', '', '7905225.6.jpg', 'snspfWOeEeY', 'aqz-KE-bpKQ', 'USA', 'Strudzony życiem komik popada w obłęd i staje się psychopatycznym mordercą.', '2019-08-31', 24.99, 1, 1, 1, 5),
(17, 'To: Rozdział 2', 'It: Chapter Two', '7897336.6.jpg', '2-K7COJbp1Y', 'aqz-KE-bpKQ', 'USA', '27 lat po tragicznych wydarzeniach w Derry dorośli członkowie \"Klubu frajerów\" powracają do miasteczka, aby ponownie zmierzyć się z zabójczym klaunem.', '2019-08-26', 14.99, 1, 0, 1, 18),
(18, 'Zielona mila', 'The Green Mile', '7517878.6.jpg', 'kRPhuj8f_3U', 'aqz-KE-bpKQ', 'USA', 'Emerytowany strażnik więzienny opowiada przyjaciółce o niezwykłym mężczyźnie, którego skazano na śmierć za zabójstwo dwóch 9-letnich dziewczynek.', '1999-12-06', 9.99, 1, 0, 0, 8),
(19, 'Joe Black', 'Meet Joe Black', '7383021.6.jpg', '9S21Hw8z3SY', 'aqz-KE-bpKQ', 'USA', 'Śmierć pod pseudonimem Joe Black zjawia się po Williama. Nieoczekiwanie zakochuje się w jego córce.', '1998-07-02', 9.99, 1, 0, 0, 7),
(20, 'Terminal', 'The Terminal', '6936218.6.jpg', 'iZqQRmhRvyg', 'aqz-KE-bpKQ', 'USA', 'Gdy Viktor Navorski, turysta z Europy Wschodniej, przylatuje do Nowego Jorku, w jego ojczyźnie ma miejsce zamach stanu. Amerykańskie władze nie uznają paszportu mężczyzny, więc miejscem przymusowego pobytu staje się dla niego hala terminalu.', '2004-06-09', 9.99, 0, 1, 0, 7),
(21, 'Trzy billboardy za Ebbing, Missouri', 'Three Billboards Outside Ebbing, Missouri', '7828023.6.jpg', 'Jit3YhGx5pU', 'aqz-KE-bpKQ', 'Wielka Brytania', 'Samotna matka, która straciła córkę w wyniku morderstwa, wynajmuje trzy tablice reklamowe i umieszcza na nich prowokacyjny przekaz.', '2017-09-04', 9.99, 0, 0, 1, 11),
(22, 'Polityka', '', '7894169.6.jpg', 'jTZgRj1D0_4', 'aqz-KE-bpKQ', 'Polska', 'Spojrzenie na zachowania polskich polityków, gdy kamery są wyłączone.', '2019-09-03', 9.99, 0, 0, 0, 11),
(23, 'Kiler', '', '6900785.6.jpg', '0QsgQgT0O5E', 'aqz-KE-bpKQ', 'Polska', 'Jerzy Kiler, warszawski taksówkarz, przypadkowo zostaje wzięty za płatnego zabójcę i umieszczony w areszcie. Wyciąga go stamtąd boss świata przestępczego, który oferuje mu nowe zadanie.', '1997-07-17', 9.99, 0, 0, 0, 31),
(24, 'E=mc²', '', '6900791.6.jpg', 'gkfyNp6hlOY', 'aqz-KE-bpKQ', 'Polska', 'Dziewczyna gangstera zakochuje się w doktorze filozofii, któremu zleca napisanie pracy magisterskiej.', '2002-08-23', 9.99, 0, 0, 0, 4),
(25, 'Poranek kojota', '', '6901063.6.jpg', 'ZtAUxxnmMHo', 'aqz-KE-bpKQ', 'Polska', 'Kuba poznaje młodą piosenkarkę i jest nią zauroczony. Nie podoba się to ojcu dziewczyny, jak również jej chłopakowi.', '2001-08-24', 9.99, 0, 0, 0, 72),
(26, 'Chłopaki nie płaczą', '', '6901032.6.jpg', '0Pl_vhON4A4', 'aqz-KE-bpKQ', 'Polska', 'Kuba, młody skrzypek, trafia w sam środek gangsterskich porachunków.', '2000-02-25', 9.99, 0, 0, 0, 36),
(27, 'Chłopcy z ferajny', 'Goodfellas', '6941458.6.jpg', 'Z8_XV89wu8c', 'aqz-KE-bpKQ', 'USA', 'Kilkunastoletni Henry i Tommy DeVito trafiają pod opiekę potężnego gangstera. Obaj szybko uczą się panujących w mafii reguł.', '1990-09-12', 14.99, 1, 0, 1, 49),
(28, 'Sekretne życie zwierzaków domowych 2', 'The Secret Life of Pets 2', '7877452.6.jpg', '2xqgeTjw8ZY', 'aqz-KE-bpKQ', 'USA', 'Max i Snowball wyjeżdżają na wycieczkę poza miasto, gdzie czeka ich życie, którego nigdy nie znali.', '2019-05-24', 14.99, 0, 1, 0, 68),
(29, 'Ale cyrk 3D', 'Orla Frøsnapper', '7421367.6.jpg', 'OTLVR9_sZBk', 'aqz-KE-bpKQ', 'Dania', 'Zafascynowany cyrkiem pies Ozorek marzy o występach na arenie. Zgłasza się więc do konkursu dla cyrkowców.', '2011-06-01', 12.99, 0, 1, 0, 70),
(30, 'Logan: Wolverine', 'Logan', '7774933.6.jpg', 'Div0iP65aZo', 'aqz-KE-bpKQ', 'Australia', 'Logan opiekuje się chorym Charlesem Xavierem, nie stroniąc od alkoholu. Jego wegetację przerywa prośba nieznajomej o przewiezienie małej Laury za kanadyjską granicę.', '2017-02-17', 14.99, 1, 0, 1, 104),
(31, 'I zbaw nas ode złego', 'Da-man Ak-e-seo Gu-ha-so-seo', '7930665.6.jpg', 'hrAa_As2reY', 'aqz-KE-bpKQ', 'Korea Południowa', 'W Tajlandii dochodzi do szokującego porwania dziewczynki. Płatny zabójca In-nam, który właśnie zakończył swój kontrakt, dowiaduje się, że porwaną może być jego najbliższa krewna.', '2020-08-05', 39, 0, 0, 1, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gatunek`
--

DROP TABLE IF EXISTS `gatunek`;
CREATE TABLE IF NOT EXISTS `gatunek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwaGatunku` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nazwaGatunku` (`nazwaGatunku`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `gatunek`
--

INSERT INTO `gatunek` (`id`, `nazwaGatunku`) VALUES
(8, 'Akcja'),
(11, 'Animacja'),
(10, 'Dramat'),
(6, 'Dramat sądowy'),
(19, 'Familijny'),
(4, 'Fantasy'),
(2, 'Gangsterski'),
(5, 'Horror'),
(1, 'Komedia'),
(16, 'Komedia romantyczna'),
(7, 'Kryminał'),
(15, 'Melodramat'),
(3, 'Obyczajowy'),
(17, 'Polityczny'),
(12, 'Przygodowy'),
(14, 'Sci-Fi'),
(18, 'Sensacyjny'),
(9, 'Thriller');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gatunki`
--

DROP TABLE IF EXISTS `gatunki`;
CREATE TABLE IF NOT EXISTS `gatunki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilmu` int(11) NOT NULL,
  `idGatunku` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFilmu` (`idFilmu`),
  KEY `idGatunku` (`idGatunku`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `gatunki`
--

INSERT INTO `gatunki` (`id`, `idFilmu`, `idGatunku`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 4, 5),
(6, 5, 6),
(55, 10, 7),
(56, 10, 8),
(57, 10, 9),
(58, 12, 10),
(59, 13, 11),
(60, 13, 1),
(61, 13, 12),
(63, 14, 8),
(64, 14, 14),
(65, 14, 1),
(66, 15, 10),
(67, 15, 1),
(68, 16, 10),
(69, 16, 7),
(70, 17, 5),
(71, 18, 10),
(72, 19, 4),
(73, 19, 15),
(74, 20, 16),
(75, 21, 10),
(76, 22, 3),
(77, 22, 17),
(78, 23, 1),
(79, 23, 18),
(80, 24, 1),
(81, 24, 18),
(82, 25, 1),
(83, 25, 18),
(84, 26, 1),
(85, 26, 18),
(86, 27, 10),
(87, 27, 2),
(88, 28, 11),
(89, 28, 1),
(90, 28, 12),
(91, 29, 11),
(92, 29, 19),
(93, 29, 1),
(94, 30, 10),
(95, 30, 8),
(96, 30, 14),
(97, 31, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historiazakupow`
--

DROP TABLE IF EXISTS `historiazakupow`;
CREATE TABLE IF NOT EXISTS `historiazakupow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilmu` int(11) NOT NULL,
  `idKlienta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `historiazakupow`
--

INSERT INTO `historiazakupow` (`id`, `idFilmu`, `idKlienta`) VALUES
(73, 22, 4),
(74, 20, 4),
(75, 14, 4),
(76, 2, 4),
(77, 16, 4),
(78, 17, 4),
(80, 27, 4),
(81, 16, 1),
(82, 3, 1),
(83, 19, 1),
(84, 5, 1),
(85, 12, 1),
(86, 10, 1),
(87, 2, 1),
(88, 29, 1),
(89, 23, 1),
(91, 21, 1),
(92, 22, 1),
(94, 25, 1),
(95, 10, 4),
(96, 5, 4),
(97, 4, 4),
(98, 1, 4),
(102, 31, 1),
(103, 17, 1),
(104, 23, 6),
(105, 26, 6),
(106, 21, 6),
(108, 31, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

DROP TABLE IF EXISTS `koszyk`;
CREATE TABLE IF NOT EXISTS `koszyk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFilmu` int(11) NOT NULL,
  `idKlienta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ludziekina`
--

DROP TABLE IF EXISTS `ludziekina`;
CREATE TABLE IF NOT EXISTS `ludziekina` (
  `idlu` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(35) COLLATE utf8_polish_ci NOT NULL,
  `imie2` varchar(35) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`idlu`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ludziekina`
--

INSERT INTO `ludziekina` (`idlu`, `imie`, `imie2`, `nazwisko`) VALUES
(1, 'Quentin', NULL, 'Tarantino'),
(2, 'Craig', NULL, 'Moss'),
(3, 'Mateusz', NULL, 'Pacewicz'),
(4, 'Zoe', NULL, 'Lister-Jones'),
(5, 'Aaron', NULL, 'Sorkin'),
(6, 'Jan', NULL, 'Komasa'),
(9, 'Adam', NULL, 'Mervis'),
(10, 'Matthew', 'Michael', 'Carnahan'),
(11, 'Konrad', NULL, 'Niewolski'),
(12, 'Byron', NULL, 'Howard'),
(13, 'Rich', NULL, 'Moore'),
(14, 'Jared', NULL, 'Bush'),
(15, 'Phil', NULL, 'Johnston'),
(16, 'Rhett', NULL, 'Reese'),
(17, 'Paul', NULL, 'Wernick'),
(18, 'Tim', NULL, 'Miller'),
(19, 'Thomas', NULL, 'Vinterberg'),
(20, 'Tobias', NULL, 'Lindholm'),
(21, 'Todd', NULL, 'Phillips'),
(22, 'Scott', NULL, 'Silver'),
(23, 'Andy', NULL, 'Muschietti'),
(24, 'Gary', NULL, 'Dauberman'),
(25, 'Frank', NULL, 'Darabont'),
(26, 'Ron', NULL, 'Osborn'),
(27, 'Martin', NULL, 'Brest'),
(28, 'Jeff', NULL, 'Reno'),
(29, 'Kevin', NULL, 'Wade'),
(30, 'Bo', NULL, 'Goldman'),
(31, 'Steven', NULL, 'Spielberg'),
(32, 'Sacha', NULL, 'Gervasi'),
(33, 'Jeff', NULL, 'Nathanson'),
(34, 'Martin', NULL, 'McDonagh'),
(35, 'Patryk', NULL, 'Vega'),
(36, 'Olaf', NULL, 'Olszewski'),
(37, 'Juliusz', NULL, 'Machulski'),
(38, 'Piotr', NULL, 'Wereśniak'),
(39, 'Olaf', NULL, 'Lubaszenko'),
(40, 'Robert', NULL, 'Mąka'),
(41, 'Mikołaj', NULL, 'Korzyński'),
(42, 'Martin', NULL, 'Scorsese'),
(43, 'Nicholas', NULL, 'Pileggi'),
(44, 'Brian', NULL, 'Lynch'),
(45, 'Chris', NULL, 'Renaud'),
(46, 'Peter', NULL, 'Dodd'),
(47, 'Søren', NULL, 'Danielsen'),
(48, 'Michael', 'W.', 'Horsten'),
(49, 'James', NULL, 'Mangold'),
(50, 'Michael', NULL, 'Green'),
(51, 'Scott', NULL, 'Frank'),
(52, '', NULL, ''),
(53, 'Won-Chan', NULL, 'Hong');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szczegolyzamowienia`
--

DROP TABLE IF EXISTS `szczegolyzamowienia`;
CREATE TABLE IF NOT EXISTS `szczegolyzamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idZamowienia` int(11) NOT NULL,
  `tytulFilmu` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `cenaFilmu` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `szczegolyzamowienia`
--

INSERT INTO `szczegolyzamowienia` (`id`, `idZamowienia`, `tytulFilmu`, `cenaFilmu`) VALUES
(3, 6, 'Polityka', 9.99),
(4, 6, 'Terminal', 9.99),
(5, 6, 'Deadpool', 25),
(6, 6, 'Pulp Fiction', 25),
(7, 6, 'Joker', 24.99),
(8, 6, 'To: Rozdział 2', 14.99),
(9, 7, 'Chłopcy z ferajny', 14.99),
(10, 8, 'Joker', 24.99),
(11, 8, 'Boże Ciało', 25),
(12, 8, 'Joe Black', 9.99),
(13, 9, 'Proces Siódemki z Chicago', 25),
(14, 9, 'Asymetria', 25),
(15, 9, '21 mostów', 25),
(16, 9, 'Pulp Fiction', 25),
(17, 9, 'Ale cyrk 3D', 12.99),
(18, 9, 'Kiler', 9.99),
(19, 10, 'Trzy billboardy za Ebbing, Missouri', 9.99),
(20, 10, 'Polityka', 9.99),
(21, 11, 'Poranek kojota', 9.99),
(22, 12, '21 mostów', 25),
(23, 12, 'Proces Siódemki z Chicago', 25),
(24, 12, 'Szkoła czarownic: Dziedzictwo', 25),
(25, 12, '30 nocy paranormalnej aktywności z opętaną przez diabła dziewczyną z tatuażem', 25),
(26, 13, 'I zbaw nas ode złego', 39),
(27, 14, 'To: Rozdział 2', 14.99),
(28, 15, 'Kiler', 9.99),
(29, 16, 'Chłopaki nie płaczą', 9.99),
(30, 16, 'Trzy billboardy za Ebbing, Missouri', 9.99),
(31, 17, 'I zbaw nas ode złego', 39);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

DROP TABLE IF EXISTS `uzytkownicy`;
CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwaUzytkownika` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `rola` varchar(10) COLLATE utf8_polish_ci NOT NULL DEFAULT 'klient',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nazwaUzytkownika` (`nazwaUzytkownika`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwaUzytkownika`, `email`, `haslo`, `rola`) VALUES
(1, 'Meekgeek23', 'emkgee1k@gmail.com', '$2y$10$520XqPv4TtdHREHKiSEA.uWQsRKv8KBrerA1sfxj0bj8qAPFqhtT2', 'admin'),
(2, 'dominika', 'doominisia98@o2.pl', '$2y$10$abP0wYEKc.m5lU9hV2DBXOCE7YVftuGBxMPnbWnfplz2lwBCutTnq', 'admin'),
(3, 'aaa', 'a@a.a', '$2y$10$K1P.q67yxVWu7he3W/6mYOtERlFmw/aG51ieO4l9tdsZYjJ9cDXr6', 'klient'),
(4, 'Klient', 'klient@gmail.com', '$2y$10$XcTiPsC6yO.Nkf1nE7SfsO0YG8NxD4/z4IgaNeZ8ioAnZkRLTC09W', 'klient'),
(5, 'ziomsonpl', 'adrianpl@polaczki.pl', '$2y$10$onD/fx/8152TShVPh9PwM.8.G0u9VD7eyYt7v88gXZGnIOefxpCi6', 'klient'),
(6, 'JanRapowanie', 'janrap@wp.pl', '$2y$10$NyoBuyhs30LOabkfUOYKpeiaRPMA0H5mwx9Z9MVRBqor6XPUVtmJq', 'admin'),
(7, 'test', 'test@wp.pl', '$2y$10$khfMMWW80KJ1EXf7wOzE7u4cLI7vRu58yheAHYWyGxlSCXITgROAm', 'klient');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

DROP TABLE IF EXISTS `zamowienia`;
CREATE TABLE IF NOT EXISTS `zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idKlienta` int(11) NOT NULL,
  `bramka` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(15) COLLATE utf8_polish_ci NOT NULL DEFAULT 'Oczekiwanie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `idKlienta`, `bramka`, `data`, `status`) VALUES
(6, 4, 'paypal', '2020-12-15 12:44:41', 'Zapłacone'),
(7, 4, 'przelewy24', '2020-12-15 12:45:17', 'Zapłacone'),
(8, 1, 'payu', '2020-12-15 18:43:54', 'Zapłacone'),
(9, 1, 'przelewy24', '2020-12-15 18:44:17', 'Zapłacone'),
(10, 1, 'paypal', '2020-12-15 18:44:29', 'Zapłacone'),
(11, 1, 'paypal', '2020-12-15 22:03:46', 'Zapłacone'),
(12, 4, 'przelewy24', '2020-12-16 09:50:50', 'Zapłacone'),
(13, 1, 'payu', '2020-12-16 10:01:20', 'Zapłacone'),
(14, 1, 'payu', '2020-12-16 10:36:42', 'Zapłacone'),
(15, 6, 'paypal', '2022-11-26 01:20:56', 'Zapłacone'),
(16, 6, 'przelewy24', '2022-11-26 01:21:49', 'Zapłacone'),
(17, 7, 'paypal', '2022-11-26 17:37:03', 'Zapłacone');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `filmrezyser`
--
ALTER TABLE `filmrezyser`
  ADD CONSTRAINT `filmrezyser_ibfk_1` FOREIGN KEY (`idFilmu`) REFERENCES `filmy` (`id`),
  ADD CONSTRAINT `filmrezyser_ibfk_2` FOREIGN KEY (`idRezysera`) REFERENCES `ludziekina` (`idlu`);

--
-- Ograniczenia dla tabeli `filmscenarzysta`
--
ALTER TABLE `filmscenarzysta`
  ADD CONSTRAINT `filmscenarzysta_ibfk_1` FOREIGN KEY (`idFilmu`) REFERENCES `filmy` (`id`),
  ADD CONSTRAINT `filmscenarzysta_ibfk_2` FOREIGN KEY (`idScenarzysty`) REFERENCES `ludziekina` (`idlu`);

--
-- Ograniczenia dla tabeli `gatunki`
--
ALTER TABLE `gatunki`
  ADD CONSTRAINT `gatunki_ibfk_1` FOREIGN KEY (`idFilmu`) REFERENCES `filmy` (`id`),
  ADD CONSTRAINT `gatunki_ibfk_2` FOREIGN KEY (`idGatunku`) REFERENCES `gatunek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
