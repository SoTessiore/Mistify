-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 déc. 2020 à 18:40
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mistify`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment_user_id_id` int(11) NOT NULL,
  `comment_post_id_id` int(11) NOT NULL,
  `comment_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `comment_user_id_id`, `comment_post_id_id`, `comment_content`) VALUES
(6, 11, 13, 'Ce jeu est vraiment vraiment cool !');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201126182833', '2020-11-26 19:28:49', 2076),
('DoctrineMigrations\\Version20201204163107', '2020-12-04 17:31:32', 2072),
('DoctrineMigrations\\Version20201208114655', '2020-12-08 12:47:22', 1888),
('DoctrineMigrations\\Version20201208134547', '2020-12-08 14:46:05', 546),
('DoctrineMigrations\\Version20201210153353', '2020-12-10 16:34:08', 2019),
('DoctrineMigrations\\Version20201213135232', '2020-12-13 14:53:11', 3371);

-- --------------------------------------------------------

--
-- Structure de la table `download`
--

CREATE TABLE `download` (
  `id` int(11) NOT NULL,
  `download_user_id_id` int(11) NOT NULL,
  `download_post_id_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `download`
--

INSERT INTO `download` (`id`, `download_user_id_id`, `download_post_id_id`) VALUES
(6, 11, 12);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `likes_user_id_id` int(11) NOT NULL,
  `likes_post_id_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `likes_user_id_id`, `likes_post_id_id`) VALUES
(7, 11, 12);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_user_id_id` int(11) NOT NULL,
  `post_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_download_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_nb_likes` int(11) DEFAULT NULL,
  `post_nb_coms` int(11) DEFAULT NULL,
  `post_nb_downloads` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `post_user_pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `post_user_id_id`, `post_name`, `post_description`, `post_category`, `post_download_link`, `post_image`, `post_nb_likes`, `post_nb_coms`, `post_nb_downloads`, `post_date`, `post_user_pseudo`) VALUES
(12, 11, 'Giacometti Museum', 'hahaha', 'Simulation', 'Giacometti Museum.zip', 'Giacometti Museum.png', 1, 0, 1, '2020-12-13', 'so_tessiore'),
(13, 11, 'The Enchanted Forest', 'C\'EST MON PREMIER JEU SOYEZ GENTILS SVP', 'Plateformes', 'The Enchanted Forest.zip', 'The Enchanted Forest.png', 0, 1, 0, '2020-12-15', 'so_tessiore');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_pseudo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_born` date NOT NULL,
  `user_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_pseudo`, `user_password`, `user_mail`, `user_born`, `user_avatar`, `user_firstname`, `user_lastname`) VALUES
(11, 'so_tessiore', 'zypsynou', 'soso.tessiore@gmail.com', '2002-02-02', '11.jpeg', 'Solène', 'Tessiore');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C1F67EF2F` (`comment_user_id_id`),
  ADD KEY `IDX_9474526C6ABE9898` (`comment_post_id_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_781A8270A4445C72` (`download_user_id_id`),
  ADD KEY `IDX_781A8270D19D2BC5` (`download_post_id_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_49CA4E7D5033ED80` (`likes_user_id_id`),
  ADD KEY `IDX_49CA4E7D25EA9A37` (`likes_post_id_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FAB8C3B3BEFE6CCE` (`post_user_id_id`);
ALTER TABLE `post` ADD FULLTEXT KEY `IDX_FAB8C3B39776190DB9A19060FDED88F` (`post_name`,`post_category`,`post_user_pseudo`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `download`
--
ALTER TABLE `download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C1F67EF2F` FOREIGN KEY (`comment_user_id_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526C6ABE9898` FOREIGN KEY (`comment_post_id_id`) REFERENCES `post` (`id`);

--
-- Contraintes pour la table `download`
--
ALTER TABLE `download`
  ADD CONSTRAINT `FK_781A8270A4445C72` FOREIGN KEY (`download_user_id_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_781A8270D19D2BC5` FOREIGN KEY (`download_post_id_id`) REFERENCES `post` (`id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_49CA4E7D25EA9A37` FOREIGN KEY (`likes_post_id_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_49CA4E7D5033ED80` FOREIGN KEY (`likes_user_id_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8DBEFE6CCE` FOREIGN KEY (`post_user_id_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
