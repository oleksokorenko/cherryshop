-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: uc455454.mysql.ukraine.com.ua
-- Czas generowania: 03 Lip 2022, 11:25
-- Wersja serwera: 5.7.33-36-log
-- Wersja PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `uc455454_shopsisterbadabase`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `value` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `colors`
--

INSERT INTO `colors` (`id`, `label`, `value`) VALUES
(1, 'black', '#000000'),
(2, 'white', '#ffffff');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `fullprise` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `discount` int(2) DEFAULT NULL,
  `status` enum('received','processed','paymant','sent') NOT NULL DEFAULT 'received'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `date`, `user`, `fullprise`, `address`, `discount`, `status`) VALUES
(1, '2022-06-07 16:31:18', 2, 350, 'ul.Puszkina 34', 5, 'received'),
(3, '2022-06-26 07:17:34', 4, 400, 'ul.Sobolowa 45', 2, 'received'),
(4, '2022-06-26 07:17:34', 2, 200, 'ul. Gogola 23', NULL, 'received');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(5) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `description`, `img`) VALUES
(1, 't-short', 100, 'najlepsza na świecielin', 'link/img'),
(2, 'short', 150, 'najlepsza z najlepszych', 'link/img');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `purchases`
--

INSERT INTO `purchases` (`id`, `product`, `size`, `color`, `total`) VALUES
(1, 2, 2, 1, 1),
(2, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `purchers_by_order`
--

CREATE TABLE `purchers_by_order` (
  `id` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `purchers_by_order`
--

INSERT INTO `purchers_by_order` (`id`, `purchase`, `order`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `label` varchar(10) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `sizes`
--

INSERT INTO `sizes` (`id`, `label`, `value`) VALUES
(1, 's', 's'),
(2, 'm', 'm');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `translation`
--

CREATE TABLE `translation` (
  `id` int(11) NOT NULL,
  `ua` varchar(5000) NOT NULL,
  `ru` varchar(5000) NOT NULL,
  `pl` varchar(5000) NOT NULL,
  `en` varchar(5000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `name`) VALUES
(1, '+380667897918', 'ghjhkj@gmail.com', 'olek'),
(2, '+380665558988', 'ttyhjilko@gmail.com', 'tolik'),
(3, '+380667897910', 'tfuygu', 'stas'),
(4, '+380667897954', 'fggkk@meta.ua', 'tanya'),
(5, '+380978503747', 'erfff@mai.ru', 'NIKOLA');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `purchers_by_order`
--
ALTER TABLE `purchers_by_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indeksy dla tabeli `translation`
--
ALTER TABLE `translation`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `purchers_by_order`
--
ALTER TABLE `purchers_by_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `translation`
--
ALTER TABLE `translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
