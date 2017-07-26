-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 25 juil. 2017 à 17:04
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hidden_profile`
--

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

CREATE TABLE `command` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('company') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'company',
  `siret` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tva_nb` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` int(5) NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `activity_area` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `employes_nb` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
   `nb_of_tokens` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `role`, `siret`, `tva_nb`, `telephone`, `address`, `postcode`, `city`, `country`, `activity_area`, `employes_nb`, `nb_of_tokens`) VALUES
(1, 'Google', 'example@example.com', '$2y$10$bI4s41TGe95X3QMPDC7fkuRiVDRsRoyKY4DyOTUMDwJHGPKdp86JS', '', '40483384800022', '40483384800022', 504020103, 'address', 75000, 'city', 'country', 'activity_area', '20', 0),
(2, 'Facebook', 'test222@gmail.com', '$2y$10$zvCUWb9Sg7lU8fsGDWBdHeXavzp9PJUAGREPTaNlOl39sLm.Kd8n6', 'company', '12345678912344', '12345678912344', 504020103, 'address', 75000, 'city', 'country', 'activity_area', '20', 0);


--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `role`, `siret`, `tva_nb`, `telephone`, `address`, `postcode`, `city`, `country`, `activity_area`, `employes_nb`, `nb_of_tokens`) VALUES
(3, 'Hidden Profile', 'test@mail.com', '$2y$10$2JGQIRIEzdIYguM.YtvgvefmujzFUaKS/q13AHvG3oWO5aoY9E3.W', 'company', 'MONACOCONFO001', 'FR01123456789', '0123456789', 'test', 78000, 'Versailles', 'France', 'Informatique', '10', 250);


-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `job_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `companies` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `year_of_experience` enum('1') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `job_name`, `companies`, `description`, `year_of_experience`, `user_id`) VALUES

(19, 'intégrateur', 'blablabla', 'blublbgbaleb', 1, 2),
(24, 'job_name[]', 'companies[]', 'description[]', 1, 6),
(43, 'Développeur', 'companies', '- description\r\n- Création du site\r\n- Création de newsletters', 1, 3),
(44, 'Intégrateur', 'Google', '- Tâches 1\r\n- Tâches 1\r\n- Tâches 1\r\n- Tâches 1', 1, 3),
(52, 'job_name[]', 'companies[]', 'description[]', 1, 5),
(15, 'job_name1', 'companies1', 'description1', 1, 3),
(16, 'job_name2', 'companies2', 'description2', 1, 3),
(17, 'Développeur PHP', 'Hidden Profile', 'faire le café', 1, 3);


-- --------------------------------------------------------

--

-- Structure de la table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `language_select` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `language`
--

INSERT INTO `language` (`id`, `language_select`, `language_level`, `user_id`) VALUES
(9, 'anglais', 'moyen', 3),
(10, 'allemand', 'courant', 3);

-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `id_resume` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `reference` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `id_resume`, `id_company`, `reference`) VALUES
(3, 14, 1, 'xxx'),
(4, 14, 1, 'xxx'),
(5, 14, 1, 'xxx'),
(6, 14, 1, 'xxx'),
(7, 14, 1, 'xxx'),
(8, 14, 1, 'xxx'),
(9, 14, 1, 'xxx'),
(10, 14, 1, 'xxx'),
(11, 14, 1, 'xxx'),
(12, 14, 1, 'xxx'),
(13, 14, 1, 'xxx'),
(14, 14, 1, 'xxx'),
(15, 14, 1, 'xxx');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `nb_of_tokens` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `id_company`, `amount`, `nb_of_tokens`, `order_date`, `status`) VALUES
(1, 1, 250, 250, '2017-07-23 22:20:58', 1),
(2, 1, 50, 50, '2017-07-23 23:03:11', 1),
(3, 1, 10, 10, '2017-07-23 23:06:05', 1),
(4, 1, 50, 50, '2017-07-23 23:08:05', 1),
(5, 1, 50, 50, '2017-07-23 23:08:29', 1),
(6, 1, 50, 50, '2017-07-23 23:10:28', 1),
(7, 1, 50, 50, '2017-07-23 23:17:31', 1),
(8, 1, 50, 50, '2017-07-23 23:21:12', 1),
(9, 1, 50, 50, '2017-07-23 23:22:42', 1),
(10, 1, 50, 50, '2017-07-23 23:23:08', 1),
(11, 1, 50, 50, '2017-07-23 23:23:32', 1),
(12, 1, 50, 50, '2017-07-23 23:24:13', 1);


-- --------------------------------------------------------

--
-- Structure de la table `resume`
--

CREATE TABLE `resume` (
  `id` int(11) NOT NULL,
  `reference` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `professionnal_domain` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desired_job` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contract_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hobbies` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `resume`
--

INSERT INTO `resume` (`id`, `reference`, `professionnal_domain`, `desired_job`, `contract_type`, `hobbies`, `user_id`) VALUES

(20, 'PmsdCFOESf', 'informatique', 'developpeur', 'cdi', '- Yoga\r\n- Voyage\r\n- Surf', 3),
(25, '3GSKxT6XqF', 'informatique', 'dev', 'cdi', 'hobbies', 5),
(14, 'xxx', 'informatique', 'Développeur Web', 'cdi', 'PHP', 3);


-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `skills` text COLLATE utf8_unicode_ci NOT NULL,
  `informatique` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `skill`
--


INSERT INTO `skill` (`id`, `skills`, `informatique`, `user_id`) VALUES
(13, 'skills', 'informatique', 2),
(18, 'skills', 'informatique', 6),
(24, '- Rigoureux\r\n- Bla\r\n- Blabla', 'informatique', 3),
(29, 'skills', 'informatique', 5);



-- --------------------------------------------------------

--
-- Structure de la table `study`
--

CREATE TABLE `study` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `level` enum('bac+5','bac+3') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `study`
--

INSERT INTO `study` (`id`, `name`, `level`, `user_id`) VALUES
(15, 'name[]', 'bac+5', 6),
(25, 'Webforce3', 'bac+5', 3),
(35, 'name[]', 'bac+5', 5),
(9, 'name1', 'bac+5', 3);


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `telephone` int(11) NOT NULL,
  `postcode` int(5) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `telephone`, `postcode`, `register_date`) VALUES
(3, 'Céline', 'Zanier', 'celinezanier@gmail.com', '$2y$10$wjQydv5MxscqOP2xqnZcQ.b.nGTKe/2U/z8qAsefgGykGI0AwP5me', 'user', 685646798, 75000, '2017-07-25'),
(4, 'Pika', 'Chu', 'test@test.com', '$2y$10$75CAtyngwRDSpQ8KisOvpepb09d2LHt4SsXm/iDLy2bP3GSz49GFK', 'user', 606060606, 66666, '2017-07-18'),
(5, 'Pré', 'Nom', 'email@email.com', '$2y$10$8VAaFlNrRIQPuiIfR.ylkel4votAOiVlHdaLNYoUmuq0z0dWWs9Fa', 'user', 606060606, 75000, '2017-07-19'),
(6, 'Bla', 'Bla', 'test@gmail.com', '$2y$10$4co2VLqzjJhmVICkHR0YQ.lSM5/Nhmve1r77xMwP.x.DPvM1NxwUO', 'user', 504020103, 75000, '2017-07-19'),
(7, 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$SLeCbUV4eTS3BwYJKvknKuWaPnk1EdtPGbvhSgpMRLUjx0SiEpvlG', 'user', 504020103, 75000, '2017-07-20'),
(8, 'firstname', 'lastname', 'example@example.com', '$2y$10$L5SZeHNbwNpxI3YhEVe1l.2AH00TqCQqTCyCzzehsXhTT9ntxkPsy', 'user', 504020103, 91330, '2017-07-21'),
(9, 'Teeeeeest', 'Test', 'test@webforce.fr', '$2y$10$zBcQrpKFiNIYY4ujFSW/F.TNeVFw7LwfTc4h9tpaiXc/cqesi1a76', 'user', 152635241, 75000, '2017-07-24'),
(10, 'firstname', 'lastname', 'example@exemple.com', '$2y$10$xQBdoZ9AgU7V7UFdw9v.mO9vznR4ld4lKiwknShCTewsd3oL7xqT.', 'user', 504020103, 75000, '2017-07-24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_favorites_id_company` (`id_company`),
  ADD KEY `fk_favorites_id_resume` (`id_resume`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_id_company` (`id_company`);


--
-- Index pour la table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `study`
--
ALTER TABLE `study`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`

  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `resume`
--
ALTER TABLE `resume`

  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `study`
--
ALTER TABLE `study`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables déchargées

--

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_favorites_id_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_favorites_id_resume` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`);

--
-- Contraintes pour la table `orders`
--

ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_id_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`);
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
