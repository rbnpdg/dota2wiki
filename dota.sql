-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 20.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dota`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `creep`
--

CREATE TABLE `creep` (
  `id_creep` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_creep` varchar(255) NOT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `health` int(11) DEFAULT NULL,
  `damage` int(11) DEFAULT NULL,
  `bounty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `creep`
--

INSERT INTO `creep` (`id_creep`, `gambar`, `nama_creep`, `tipe`, `health`, `damage`, `bounty`) VALUES
(2, 'Melee_Creep_Radiant_model.webp', 'Melee Creep', 'Lane', 550, 21, 39),
(3, 'Ranged_Creep_Radiant_model.webp', 'Ranged Creep', 'Lane', 300, 25, 48),
(4, 'Siege_Creep_Radiant_model.webp', 'Siege Creep', 'Lane', 825, 45, 94),
(5, 'Ancient_Black_Dragon_model.webp', 'Ancient Black Dragon', 'Neutral', 3000, 100, 200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero`
--

CREATE TABLE `hero` (
  `id_hero` int(11) NOT NULL,
  `nama_hero` varchar(100) NOT NULL,
  `atribut` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hero`
--

INSERT INTO `hero` (`id_hero`, `nama_hero`, `atribut`, `roles`, `bio`, `gambar`) VALUES
(10, 'AntiMage', 'Agility', 'Carry, Escape', 'Seorang pejuang gesit yang menggunakan serangan cepat untuk menghancurkan musuh yang menggunakan sihir.', 'Anti-Mage_icon.webp'),
(11, 'Crystal Maiden', 'Intelligence', 'Support, Disabler', 'Penyihir es yang dapat membekukan musuh dan memberikan aura mana regenerasi kepada rekan satu timnya.', 'Crystal_Maiden_icon.webp'),
(12, 'Earthshaker', 'Strength', 'Support, Initiator', 'Pahlawan dengan kekuatan gempa bumi yang dapat menghentikan musuh di jalurnya dan menyebabkan kerusakan area yang besar.', 'Earthshaker_icon.webp'),
(13, 'Juggernaut', 'Agility', 'Carry', 'Seorang pejuang legendaris yang menggunakan kecepatan dan seni pedang untuk menyerang dengan kekuatan yang mematikan.', 'Juggernaut_icon.webp'),
(14, 'Pudge', 'Strength', 'Tank, Disabler', 'Seorang penjagal yang kuat yang dapat menarik musuh dengan kailnya dan menginfeksi mereka dengan racun mematikan.', 'Pudge_icon.webp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_item` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `atribut` text DEFAULT NULL,
  `efek` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`id_item`, `gambar`, `nama_item`, `harga`, `atribut`, `efek`) VALUES
(3, 'Aghanims_Scepter_icon.webp', 'Aghanims Scepter', 4200, '50 health and 35 health regen\r\n140 mana, 2.5 mana regen, and 200% flatbase magic resist', 'Upgrade ulti dan beberapa ability untuk semua hero'),
(7, 'Arcane_Boots_icon.webp', 'Arcane Boots', 1300, '+250 Mana', 'Mengaktifkan: Restore 175 mana ke unit sekutu di sekitar dalam radius 1200.'),
(8, 'Black_King_Bar_icon.webp', 'Black King Bar', 4050, '+24 Damage, +10 Strength', 'Mengaktifkan: Memberikan spell immunity untuk 9/8/7/6/5 detik (durasi menurun setiap penggunaan).'),
(9, 'Daedalus_icon.webp', 'Daedalus', 5150, '+88 Damage	', 'Memberikan 30% chance untuk critical hit 225% damage.'),
(10, 'Shadow_Blade_icon.webp', 'Shadow Blade', 3000, '+20 Damage, +35 Attack Speed	', 'Mengaktifkan: Memberikan invisibility selama 14 detik, bonus 175 damage saat keluar dari invisible.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mechanics`
--

CREATE TABLE `mechanics` (
  `id_mechanics` int(11) NOT NULL,
  `nama_mechanics` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `efek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telents`
--

CREATE TABLE `telents` (
  `id_telents` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_hero` varchar(255) DEFAULT NULL,
  `level10` varchar(255) DEFAULT NULL,
  `level15` varchar(255) DEFAULT NULL,
  `level20` varchar(255) DEFAULT NULL,
  `level25` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `telents`
--

INSERT INTO `telents` (`id_telents`, `gambar`, `nama_hero`, `level10`, `level15`, `level20`, `level25`) VALUES
(2, 'Anti-Mage_icon.webp', 'AntiMage', '+10 Agility', '-1.5s Blink Cooldown', '+400 Blink Cast Range', '+1s Spell Shield Reflect'),
(3, 'Crystal_Maiden_icon.webp', 'Crystal Maiden', '+120 Gold/Min', '+250 Attack Speed', '+200 Freezing Field Damage', '+1.5s Frostbite Duration'),
(4, 'Earthshaker_icon.webp', 'Earthshaker', '+200 Health', '+35 Damage', '+50% Magic Resistance', '+1 Echo Damage Per Echo'),
(5, 'Juggernaut_icon.webp', 'Juggernaut', '+20 Damage', '+8 Agility', '+100 Blade Fury DPS', '+5 Omnislash Attacks'),
(6, 'Pudge_icon.webp', 'Pudge', '+75 Damage', '+150 Gold/Min', '+35 Flesh Heap Stack Strength ', '+3s Dismember Duration');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '123', 'admin@admin.com', '2024-06-13 16:11:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `creep`
--
ALTER TABLE `creep`
  ADD PRIMARY KEY (`id_creep`);

--
-- Indeks untuk tabel `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id_hero`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`id_mechanics`);

--
-- Indeks untuk tabel `telents`
--
ALTER TABLE `telents`
  ADD PRIMARY KEY (`id_telents`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `creep`
--
ALTER TABLE `creep`
  MODIFY `id_creep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hero`
--
ALTER TABLE `hero`
  MODIFY `id_hero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id_mechanics` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `telents`
--
ALTER TABLE `telents`
  MODIFY `id_telents` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
