-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 28, 2023 alle 16:35
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1.0`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `favpl`
--

CREATE TABLE `favpl` (
  `id` varchar(23) NOT NULL,
  `user` varchar(255) NOT NULL,
  `immagine` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `favpl`
--

INSERT INTO `favpl` (`id`, `user`, `immagine`, `nome`) VALUES
('12VSqVwyR6f9rK9nCMbHkQ', 'provola', 'https://mosaic.scdn.co/640/ab67616d0000b2731f4d8d9f0c7efa41c78ee7fbab67616d0000b2735c3371d3cf7a835f77f97213ab67616d0000b27382038ca31d73893c215c5be6ab67616d0000b273c930b14d55a33f16e7ab675b', 'CHARLIE FA SURF'),
('37i9dQZF1DWV2mRphxMWjR', 'luffy', 'https://i.scdn.co/image/ab67706f00000003ccb0c2349e23e3cb0ba5f9f2', 'ONE PIECE FILM RED'),
('37i9dQZF1DWVCKO3xAlT1Q', 'stefa350', 'https://i.scdn.co/image/ab67706f00000003077274f141f3ff499a781082', 'Eurovision 2023'),
('37i9dQZF1DZ06evO1bqVuq', 'olly', 'https://thisis-images.scdn.co/37i9dQZF1DZ06evO1bqVuq-large.jpg', 'This Is Olly'),
('44SmkW2zYTkTxVXBTZU7In', 'mati', 'https://i.scdn.co/image/ab67706c0000bebbff0a0fee9236d64879ece6d5', 'Top 50 - Italia');

-- --------------------------------------------------------

--
-- Struttura della tabella `favs`
--

CREATE TABLE `favs` (
  `id` int(10) NOT NULL,
  `user` varchar(255) NOT NULL,
  `albumCover` varchar(255) NOT NULL,
  `trackName` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `audio` varchar(300) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `collectionName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `favs`
--

INSERT INTO `favs` (`id`, `user`, `albumCover`, `trackName`, `artist`, `audio`, `genre`, `collectionName`) VALUES
(273418791, 'provola', 'https://is2-ssl.mzstatic.com/image/thumb/Music/88/d2/59/mzi.vhxvgrjv.jpg/100x100bb.jpg', 'Charlie Fa Surf', 'Baustelle', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview125/v4/59/cb/17/59cb1755-402f-9147-c355-c1f7eda7f3be/mzaf_6073015271459994787.plus.aac.p.m4a', 'Rock', 'Amen'),
(1435546671, 'stefa350', 'https://is4-ssl.mzstatic.com/image/thumb/Music115/v4/ea/24/e2/ea24e228-6bf1-625a-11dc-d83d5ee780e6/18UMGIM53788.rgb.jpg/100x100bb.jpg', 'Love It If We Made It', 'The 1975', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview122/v4/0b/45/9a/0b459a74-5798-4a1d-03e8-d417743d9750/mzaf_8815322002909981026.plus.aac.p.m4a', 'Alternative', 'A Brief Inquiry Into Online Relationships'),
(1440838130, 'mati', 'https://is4-ssl.mzstatic.com/image/thumb/Music125/v4/6b/64/f8/6b64f8f3-b116-8704-7476-829420486cbb/15UMGIM50961.rgb.jpg/100x100bb.jpg', 'Like I Can', 'Sam Smith', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview122/v4/8f/11/cd/8f11cdac-9eb4-103b-2aa8-e63f8662f066/mzaf_11088651028527472124.plus.aac.p.m4a', 'Pop', 'In the Lonely Hour (Drowning Shadows Edition)'),
(1577319505, 'luffy', 'https://is3-ssl.mzstatic.com/image/thumb/Music115/v4/84/c5/48/84c548ae-b3ce-9b78-eb7c-9ffc2bf55c4e/artwork.jpg/100x100bb.jpg', 'We Are \"One Piece\"', 'HelloROMIX', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview115/v4/0e/7d/f2/0e7df2c5-423b-201a-0b91-e669a7897ec2/mzaf_10686075821969428417.plus.aac.p.m4a', 'Rock', 'We Are \"One Piece\" - Single'),
(1669796568, 'provola', 'https://is1-ssl.mzstatic.com/image/thumb/Music126/v4/f0/fd/c4/f0fdc4ca-3cd3-ab91-3458-a60f77721499/8053307092836.jpg/100x100bb.jpg', 'Charlie Fa Surf (RMX) [feat. bnkr44]', 'Sethu & Jiz', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview116/v4/16/3b/75/163b75d8-c250-75c9-fdf2-6b622c8156cd/mzaf_14137243976260717053.plus.aac.p.m4a', 'Pop', 'Cause Perse - EP'),
(1671747462, 'luffy', 'https://is2-ssl.mzstatic.com/image/thumb/Music116/v4/ee/6a/b3/ee6ab3ee-cb3d-08ab-b7bf-aada1fa08429/artwork.jpg/100x100bb.jpg', 'Bon Voyage (One Piece)', 'Miura Jam BR', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview116/v4/f2/3d/58/f23d583f-cd96-cf46-e759-e5887005b05e/mzaf_2667181978647604584.plus.aac.p.m4a', 'Rock', 'Bon Voyage (One Piece) - Single'),
(1676037023, 'luffy', 'https://is2-ssl.mzstatic.com/image/thumb/Music116/v4/56/5f/be/565fbe48-5917-22d6-25ca-e8ff71268263/artwork.jpg/100x100bb.jpg', 'Bink\'s no Sake', 'beynim zonkluyor', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview126/v4/a0/cf/6e/a0cf6eaa-705e-e77f-0f4e-9cca3c5a3aa5/mzaf_4179752622246352732.plus.aac.p.m4a', 'J-Pop', 'Bink\'s no Sake - Single'),
(1676628291, 'olly', 'https://is4-ssl.mzstatic.com/image/thumb/Music116/v4/52/48/49/52484972-e8cf-633b-7298-c77db47688a5/196589969064.jpg/100x100bb.jpg', 'Ho un amico', 'Olly & JVLI', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview126/v4/b1/59/ea/b159ea73-76ec-58f3-8e85-a1c1b8e8a2b6/mzaf_5281300664834247813.plus.aac.p.m4a', 'Pop', 'Gira, il mondo gira'),
(1676628313, 'stefa350', 'https://is4-ssl.mzstatic.com/image/thumb/Music116/v4/52/48/49/52484972-e8cf-633b-7298-c77db47688a5/196589969064.jpg/100x100bb.jpg', 'Bianca', 'Olly & JVLI', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview116/v4/17/39/15/173915c9-c4d6-c0d5-cef1-3f481cf132cf/mzaf_2972523401579524419.plus.aac.p.m4a', 'Pop', 'Gira, il mondo gira'),
(1679399030, 'stefa350', 'https://is2-ssl.mzstatic.com/image/thumb/Music126/v4/96/79/9d/96799dd3-c623-8668-69de-7746bb7a1a97/23UMGIM35867.rgb.jpg/100x100bb.jpg', 'L\'unica Cosa Che Vuoi', 'Boomdabash', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview116/v4/e0/e1/70/e0e170cd-fb5c-6f11-d3bd-a3ff5f5eb96e/mzaf_18187661901079300266.plus.aac.p.m4a', 'Pop', 'L\'unica Cosa Che Vuoi - Single'),
(1688205003, 'stefa350', 'https://is4-ssl.mzstatic.com/image/thumb/Music116/v4/55/e3/55/55e35534-09bb-26a9-422d-5794565effa0/5054197693373.jpg/100x100bb.jpg', 'DISCO PARADISE', 'Fedez, Annalisa & Articolo 31', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview116/v4/65/ca/be/65cabe0f-946b-69ee-60aa-d6f4af9704a6/mzaf_5421114918110576371.plus.aac.p.m4a', 'Pop', 'DISCO PARADISE - Single');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `user` varchar(255) NOT NULL,
  `albumCover` varchar(255) NOT NULL,
  `trackName` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `datas` datetime NOT NULL,
  `id` int(10) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `collectionName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`user`, `albumCover`, `trackName`, `artist`, `audio`, `caption`, `datas`, `id`, `genre`, `collectionName`) VALUES
('mati', 'https://is4-ssl.mzstatic.com/image/thumb/Music125/v4/6b/64/f8/6b64f8f3-b116-8704-7476-829420486cbb/15UMGIM50961.rgb.jpg/100x100bb.jpg', 'Like I Can', 'Sam Smith', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview122/v4/8f/11/cd/8f11cdac-9eb4-103b-2aa8-e63f8662f066/mzaf_11088651028527472124.plus.aac.p.m4a', 'like devils can', '2023-05-24 13:44:48', 1440838130, 'Pop', 'In the Lonely Hour (Drowning Shadows Edition)'),
('olly', 'https://is4-ssl.mzstatic.com/image/thumb/Music116/v4/52/48/49/52484972-e8cf-633b-7298-c77db47688a5/196589969064.jpg/100x100bb.jpg', 'Ho un amico', 'Olly & JVLI', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview126/v4/b1/59/ea/b159ea73-76ec-58f3-8e85-a1c1b8e8a2b6/mzaf_5281300664834247813.plus.aac.p.m4a', 'per i miei amici', '2023-05-26 23:27:39', 1676628291, 'Pop', 'Gira, il mondo gira'),
('provola', 'https://is2-ssl.mzstatic.com/image/thumb/Music/88/d2/59/mzi.vhxvgrjv.jpg/100x100bb.jpg', 'Charlie Fa Surf', 'Baustelle', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview125/v4/59/cb/17/59cb1755-402f-9147-c355-c1f7eda7f3be/mzaf_6073015271459994787.plus.aac.p.m4a', 'charlie fa surf', '2023-05-26 19:41:55', 273418791, 'Rock', 'Amen'),
('stefa350', 'https://is4-ssl.mzstatic.com/image/thumb/Music116/v4/55/e3/55/55e35534-09bb-26a9-422d-5794565effa0/5054197693373.jpg/100x100bb.jpg', 'DISCO PARADISE', 'Fedez, Annalisa & Articolo 31', 'https://audio-ssl.itunes.apple.com/itunes-assets/AudioPreview116/v4/65/ca/be/65cabe0f-946b-69ee-60aa-d6f4af9704a6/mzaf_5421114918110576371.plus.aac.p.m4a', 'è uscita stanotte', '2023-05-25 16:30:34', 1688205003, 'Pop', 'DISCO PARADISE - Single');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `Gender` varchar(2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(16) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`Nome`, `Cognome`, `Gender`, `img`, `Email`, `Username`, `Password`) VALUES
('Matilde', 'Conti', 'f', 'http://localhost/hw1/images/pfp1.png', 'mati@conti.com', 'mati', '$2y$10$fSWytfuyWGO29s0LHlq1VOPdq8p8aLvaNO2W9mbixHb5XTlQzEqri'),
('Federico', 'Olivieri', 'm', 'http://localhost/hw1/images/pfp7.png', 'fedeolly@gmail.com', 'olly', '$2y$10$lpto6O6fqHNisRbconpeeOMvAn2u8FfC8EuxkfReAGVaPVEm3TAgO'),
('Stefano', 'D\'Urso', 'm', 'http://localhost/hw1/images/pfp5.png', 'stefanodurso350@gmail.com', 'stefa350', '$2y$10$Xx99sZCt96MopEy/RWROFu3gbDmVAuiskiHIGmqP4.AqPfw6a.rV.');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `favpl`
--
ALTER TABLE `favpl`
  ADD PRIMARY KEY (`id`,`user`);

--
-- Indici per le tabelle `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`id`,`user`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`user`,`datas`,`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
