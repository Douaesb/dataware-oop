-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 déc. 2023 à 09:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dw`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(10) NOT NULL,
  `nom_equipe` varchar(100) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `id_pro` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `nom_equipe`, `date_creation`, `id_pro`) VALUES
(1, 'none', '2023-12-07', 1),
(2, 'codecrafters', '2023-12-09', 5),
(4, 'boldmemberssss', '2023-12-23', 2);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_pro` int(10) NOT NULL,
  `nom_pro` varchar(100) DEFAULT NULL,
  `descrp_pro` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_pro`, `nom_pro`, `descrp_pro`) VALUES
(1, 'none', 'nothing\r\n'),
(2, 'Restaurant pizza', 'maquetter et mettre en oeuvre site web de pizza restaurant'),
(3, 'Salle de sport', 'realiser et implementer un site web de salle de sport'),
(4, 'Gamebit', 'concevoir un site d une société de gaming'),
(5, 'Dataware', 'gerer le personnel de l entreprise dataware');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_qst` int(10) NOT NULL,
  `titre_qst` varchar(100) DEFAULT NULL,
  `descrp_qst` varchar(255) DEFAULT NULL,
  `date_qst` datetime DEFAULT NULL,
  `archive_qst` tinyint(1) DEFAULT NULL,
  `like_qst` int(10) DEFAULT NULL,
  `dislike_qst` int(10) DEFAULT NULL,
  `id_pro` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_qst`, `titre_qst`, `descrp_qst`, `date_qst`, `archive_qst`, `like_qst`, `dislike_qst`, `id_pro`, `id_user`) VALUES
(1, 'kjewh.BCFZE/K', 'sdlfjs', '2023-12-11 16:48:56', NULL, NULL, NULL, NULL, 5),
(10, 'test', 'dddddddddddddd', '2023-12-11 16:23:52', NULL, NULL, NULL, 5, 5),
(12, 'test', 'hello', '2023-12-12 10:55:22', 1, NULL, NULL, 5, 5),
(13, 'hs', 'dd', '2023-12-12 10:57:04', 1, NULL, NULL, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reactions`
--

CREATE TABLE `reactions` (
  `id_qst` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `likee` int(11) DEFAULT NULL,
  `dislike` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reactions`
--

INSERT INTO `reactions` (`id_qst`, `id_user`, `likee`, `dislike`) VALUES
(1, 5, 1, NULL),
(10, 5, NULL, 1),
(1, 2, 1, NULL),
(10, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_rep` int(10) NOT NULL,
  `descrp_rep` varchar(255) DEFAULT NULL,
  `date_rep` datetime DEFAULT NULL,
  `archive_rep` tinyint(1) DEFAULT NULL,
  `statut_rep` tinyint(1) DEFAULT NULL,
  `like_rep` int(10) DEFAULT NULL,
  `dislike_rep` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_qst` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_rep`, `descrp_rep`, `date_rep`, `archive_rep`, `statut_rep`, `like_rep`, `dislike_rep`, `id_user`, `id_qst`) VALUES
(1, 'this is my repons', '2023-12-06 00:00:00', 1, 0, NULL, NULL, 5, 1),
(3, 'testjsdfs ', '2023-12-07 00:00:00', 1, 1, NULL, NULL, 5, 1),
(13, 'hi', '2023-12-12 10:56:02', 1, NULL, NULL, NULL, 5, 12),
(14, 'how are you', '2023-12-12 10:56:09', 1, 1, NULL, NULL, 5, 12),
(15, 'ok', '2023-12-12 10:57:13', 1, NULL, NULL, NULL, 2, 13);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(10) NOT NULL,
  `nom_tag` varchar(255) DEFAULT NULL,
  `id_qst` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `nom_tag`, `id_qst`) VALUES
(1, 'test', 12),
(2, 'd', 13);

-- --------------------------------------------------------

--
-- Structure de la table `tag_qst`
--

CREATE TABLE `tag_qst` (
  `id_qst` int(10) NOT NULL DEFAULT 0,
  `titre_qst` varchar(100) DEFAULT NULL,
  `nom_tag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tag_qst`
--

INSERT INTO `tag_qst` (`id_qst`, `titre_qst`, `nom_tag`) VALUES
(4, 'daali', 'me'),
(10, 'test', 'dd'),
(11, 'how can i update qkjdhbuz', 'ss'),
(12, 'test', 'test'),
(13, 'hs', 'd');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `tel` int(10) DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `equipe` int(10) DEFAULT NULL,
  `projet` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `pass`, `tel`, `statut`, `role`, `equipe`, `projet`) VALUES
(1, 'Sebti', 'Douae', 'douaesb123@gmail.com', 'douae123', 664589784, 'active', 'ProductOwner', NULL, NULL),
(2, 'OLM', 'Yassir', 'yassirolm123@gmail.com', 'yassir123', 615878477, 'active', 'ScrumMaster', NULL, 5),
(3, 'Toto', 'Mouad', 'mouadtoto123@gmail.com', 'Mouad123', 687459165, 'active', 'membre', 2, 5),
(4, 'Houas', 'Chaimae', 'chaimaeh123@gmail.com', 'chaimae123', 684516578, 'active', 'membre', NULL, NULL),
(5, 'Daali', 'Mohamed', 'mohamedda123@gmail.com', 'Mohamed123', 616457899, 'active', 'membre', 2, 5),
(6, 'radia', 'idelkadi', 'radia123@gmail.com', 'radia123', 654871548, 'active', 'membre', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `id_pro` (`id_pro`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_pro`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_qst`),
  ADD KEY `id_pro` (`id_pro`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `reactions`
--
ALTER TABLE `reactions`
  ADD KEY `id_qst` (`id_qst`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_rep`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_qst` (`id_qst`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`),
  ADD KEY `id_qst` (`id_qst`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD KEY `equipe` (`equipe`),
  ADD KEY `projet` (`projet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_pro` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_qst` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_rep` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `projet` (`id_pro`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `projet` (`id_pro`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`id_qst`) REFERENCES `question` (`id_qst`),
  ADD CONSTRAINT `reactions_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`id_qst`) REFERENCES `question` (`id_qst`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `id_qst` FOREIGN KEY (`id_qst`) REFERENCES `question` (`id_qst`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`equipe`) REFERENCES `equipe` (`id_equipe`),
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`projet`) REFERENCES `projet` (`id_pro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
