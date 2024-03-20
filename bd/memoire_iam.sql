-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 15 mars 2024 à 02:24
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
-- Base de données : `memoire_iam`
--

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `domaine_id` int(50) NOT NULL,
  `nom_domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`domaine_id`, `nom_domaine`) VALUES
(1, 'Informatique'),
(2, 'Sante'),
(3, 'Education '),
(4, 'Technologie'),
(5, 'Securite '),
(6, 'Markting');

-- --------------------------------------------------------

--
-- Structure de la table `memoires`
--

CREATE TABLE `memoires` (
  `id_memoire` int(50) NOT NULL,
  `titre` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `fichier` varchar(50) NOT NULL,
  `date_publication` date NOT NULL,
  `id_utilisateur` int(11) DEFAULT 1,
  `theme_id` int(11) NOT NULL,
  `domaine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `memoires`
--

INSERT INTO `memoires` (`id_memoire`, `titre`, `description`, `fichier`, `date_publication`, `id_utilisateur`, `theme_id`, `domaine_id`) VALUES
(1, 'L\'informatique, un domaine qui change le monde actuellement', 'Avantage et inconvénient de l\'informatique dans le monde plus particulièrement au Sénégal ', 'fichier_memoire/informatique.pdf', '2022-10-10', 1, 1, 1),
(2, 'Evolution de la qualité de suivie des patients tuberculeux au Sénégal et au Togo ', 'L\'évaluation de la qualité du suivi des patients tuberculeux au Sénégal et au Togo pourrait s\'articu', 'fichier_memoire/santee.pdf', '2023-01-01', 1, 2, 2),
(3, 'L\'EDUCATION ET LA FORMATION AU DEVELOPPEMENT', 'L\'éducation et la formation sont des piliers fondamentaux dans le processus de développement économi', 'fichier_memoire/education_future.pdf', '2018-10-15', 1, 3, 3),
(4, 'Révolution Numérique : Impact et Avenir de la Technologie dans la Société ', 'Le domaine de la technologie, en constante évolution, est à la fois un moteur de changement et un re', 'fichier_memoire/technologie.pdf', '2023-12-10', 1, 4, 4),
(5, 'Défis et Stratégies de la Sécurité dans un Monde Connecté', 'À l\'ère numérique, la sécurité est devenue une préoccupation centrale pour les individus, les entrep', 'fichier_memoire/securite.pdf', '2015-01-01', 1, 5, 5),
(6, 'Innovation et Personnalisation : L\'Avenir du Marketing à l\'Ère Numérique', 'Le marketing, un domaine en constante évolution, est profondément transformé par les technologies nu', 'fichier_memoire/markting.pdf', '2016-12-10', 1, 6, 6),
(10, 'Optimiser votre Bien-être: Conseils Pratiques pour une Santé Équilibrée', 'Explorez notre guide complet axé sur la santé, regorgeant de conseils pratiques pour améliorer votre bien-être physique et mental', 'fichier_memoire/sante1.pdf', '2003-01-01', 1, 2, 2),
(11, 'Bien-Être Holistique: Nourrir le Corps et l\'Esprit', 'Explorez les différentes facettes du bien-être, de la nutrition optimale aux pratiques de gestion du stress', 'fichier_memoire/sante2.pdf', '2012-11-28', 1, 2, 2),
(12, 'Innovations Médicales: Révolutionner la Santé de Demain', 'Plongez dans le monde fascinant des avancées médicales qui façonnent l\'avenir de la santé', 'fichier_memoire/sante3.pdf', '2014-12-27', 1, 2, 2),
(13, 'Mentalité Saine, Vie Épanouissante', 'Explorez les clés d\'une santé mentale robuste et découvrez comment cultiver une mentalité positive pour une vie épanouissante', 'fichier_memoire/sante4.pdf', '2022-04-29', 1, 2, 2),
(14, 'Nouvelles Tendances en Informatique', 'Exploration des dernières avancées technologiques', 'fichier_memoire/Informatique1.pdf', '2024-03-11', 1, 1, 1),
(15, 'Analyse des Algorithmes', 'Étude approfondie des algorithmes et de leurs applications', 'fichier_memoire/informatique2.pdf', '2024-03-12', 1, 1, 1),
(16, 'Développement Logiciel Moderne', 'Méthodologies et pratiques innovantes en développement logiciel', 'fichier_memoire/informatique3.pdf', '2024-03-13', 1, 1, 1),
(20, 'Intelligence Artificielle dans l\'Industrie', 'Impact de l\'IA sur divers secteurs industriels', 'fichier_memoire/informatique4.pdf', '2024-03-14', 1, 1, 1),
(21, 'Cybersécurité Avancée', 'Exploration des dernières avancées en cybersécurité', 'fichier_memoire/securite1.pdf', '2024-03-11', 1, 5, 5),
(22, 'Analyse des Vulnérabilités', 'Étude approfondie des vulnérabilités de sécurité informatique', 'fichier_memoire/securite2.pdf', '2024-03-12', 1, 5, 5),
(23, 'Stratégies de Défense contre les Menaces', 'Méthodes pour la défense efficace contre les menaces informatiques', 'fichier_memoire/securite3.pdf', '2024-03-13', 1, 5, 5),
(24, 'Sécurité des Applications Web', 'Protocoles et bonnes pratiques pour sécuriser les applications web', 'fichier_memoire/securite4.pdf', '2024-03-14', 1, 5, 5),
(25, 'Innovation Pédagogique', 'Impact des nouvelles approches pédagogiques sur éducation', 'fichier_memoire/education1.pdf', '2024-03-15', 1, 3, 3),
(26, 'Technologies Éducatives', 'Intégration des technologies dans le processus éducatif', 'fichier_memoire/education2.pdf', '2024-03-16', 1, 3, 3),
(27, 'Formation des Enseignants', 'Développement des compétences pédagogiques des enseignants', 'fichier_memoire/education3.pdf', '2024-03-17', 1, 3, 3),
(28, 'Stratégies de Marketing Digital', 'Analyse des stratégies efficaces en marketing digital', 'fichier_memoire/marketing1.pdf', '2024-03-23', 1, 6, 6),
(29, 'Influence des Réseaux Sociaux sur le Marketing', 'L\'impact des réseaux sociaux sur les stratégies marketing', 'fichier_memoire/marketing2.pdf', '2024-03-24', 1, 6, 6),
(30, 'Analyse de Marché', 'Méthodes et outils d\'analyse de marché', 'fichier_memoire/marketing3.pdf', '2024-03-25', 1, 6, 6),
(31, 'Marketing Événementiel', 'Stratégies de marketing liées aux événements', 'fichier_memoire/marketing4.pdf', '2024-03-26', 1, 6, 6),
(32, 'Internet des Objets (IoT)', 'Applications et défis de l\'Internet des Objets', 'fichier_memoire/technologie2.pdf', '2024-03-20', 1, 4, 4),
(33, 'Impacts des Nouvelles Technologies', 'Analyse des impacts sociaux et économiques des nouvelles technologies', 'fichier_memoire/technologie4.pdf', '2024-03-22', 1, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `theme_id` int(50) NOT NULL,
  `nom_theme` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`theme_id`, `nom_theme`) VALUES
(1, 'Importance de l\'informatique dans la societe'),
(2, 'La Sante, avant tous'),
(3, 'L\'éducation est il un moyen de développer un pays?'),
(4, 'Technologie et développement durable '),
(5, 'L\'utilité de sécurise des données pour empêcher le'),
(6, 'Gestion de la relation client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `type_utilisateur` varchar(50) NOT NULL DEFAULT 'etudiant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `type_utilisateur`) VALUES
(1, 'BEYE', 'Balla', 'admin12@iam.sn', 'passer123', 'admin'),
(3, 'MBOUP', 'Mouhamadane', 'admin10@iam.sn', 'admin2024', 'admin'),
(9, 'Dabo', 'Aminata', 'dabs12@iam.sr', 'passer@0101', 'etudiant'),
(10, 'BEYE', 'Balla', 'beyeballa04@gmail.com', 'passer', 'etudiant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`domaine_id`);

--
-- Index pour la table `memoires`
--
ALTER TABLE `memoires`
  ADD PRIMARY KEY (`id_memoire`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `theme_id` (`theme_id`),
  ADD KEY `domaine_id` (`domaine_id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`theme_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `domaine_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `memoires`
--
ALTER TABLE `memoires`
  MODIFY `id_memoire` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `theme_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `memoires`
--
ALTER TABLE `memoires`
  ADD CONSTRAINT `memoires_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `memoires_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`theme_id`),
  ADD CONSTRAINT `memoires_ibfk_3` FOREIGN KEY (`domaine_id`) REFERENCES `domaine` (`domaine_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
