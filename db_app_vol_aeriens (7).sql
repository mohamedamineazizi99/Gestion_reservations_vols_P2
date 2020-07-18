-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 juin 2020 à 06:32
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_app_vol_aeriens`
--

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id_passager` int(11) NOT NULL,
  `nom_passager` varchar(60) NOT NULL,
  `prenom_passager` varchar(60) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `phone_passager` int(11) NOT NULL,
  `email_passager` varchar(60) NOT NULL,
  `cin_passager` varchar(60) NOT NULL,
  `n_passport_passager` varchar(60) NOT NULL,
  `date_create_passager` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`id_passager`, `nom_passager`, `prenom_passager`, `date_de_naissance`, `phone_passager`, `email_passager`, `cin_passager`, `n_passport_passager`, `date_create_passager`, `id_user_created`) VALUES
(1, 'akram', 'karimi', '1996-03-20', 644556678, 'akram1@gmail.com', 'CIN_1akram', 'NUMPASSPORT1akram', '2020-06-07 18:37:42', 3),
(2, 'yassine', 'br', '2000-03-16', 634566786, 'ya@gmail.com', 'CIN_1YASSSINE', 'NUMPASSPORT1YASSINE', '2020-06-07 18:39:04', 3),
(3, 'oussaama', 'mohamed', '2002-02-14', 622668822, 'oussaama@gmail.com', 'CIN_1OUSSAMA', 'NUMPASSPORT1OUSSAMA', '2020-06-07 19:52:19', 6),
(4, 'ayoub', 'rafif', '2020-06-06', 999999999, 'fafif@gmail.com', 'CIN_1RAFIF', 'NUMPASSPORT1RAFIF', '2020-06-08 19:35:16', 7),
(5, 'ayoub', 'rafif', '2020-06-26', 0, 'fafif@gmail.com', 'CIN_1RAFIF', 'NUMPASSPORT1RAFIF', '2020-06-13 11:42:27', 7),
(6, 'Admin', 'Admin', '2020-06-25', 0, 'admin@gmail.com', 'CIN_ADMIN', 'NUMPASSPORT1ADMIN', '2020-06-15 12:13:36', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL,
  `id_vol` int(11) NOT NULL,
  `id_passager` int(11) NOT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id_reservation`, `id_vol`, `id_passager`, `date_reservation`) VALUES
(1, 2, 1, '2020-06-07 18:37:42'),
(2, 2, 2, '2020-06-07 18:39:04'),
(3, 2, 3, '2020-06-07 19:52:19'),
(4, 2, 4, '2020-06-08 19:35:16'),
(5, 1, 5, '2020-06-13 11:42:27'),
(6, 4, 6, '2020-06-15 12:13:36');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `statut` varchar(5) NOT NULL,
  `cin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `statut`, `cin`) VALUES
(1, 'RH', 'Taoufiq', 'ta@gmail.com', 'ta123', 'Admin', 'CIN_RH'),
(2, 'Admin', 'Admin', 'admin@gmail.com', 'admin123', 'Admin', 'CIN_ADMIN'),
(3, 'yassine', 'br', 'ya@gmail.com', 'ya123', 'User', '_'),
(4, 'Ahmed', 'MOHAMED', 'ahmed@gmail.com', 'ahmed123', 'User', '_'),
(5, 'hamza', 'boud', 'hamza@gmail.com', 'hamza123', 'User', '_'),
(6, 'oussaama', 'mohamed', 'oussaama@gmail.com', 'oussama123', 'User', '_'),
(7, 'ayoub', 'rafif', 'fafif@gmail.com', '123', 'User', '_'),
(8, 'meryem', 'meryem', 'meryem@gmail.com', '123', 'User', '_');

-- --------------------------------------------------------

--
-- Structure de la table `vols`
--

CREATE TABLE `vols` (
  `id_vol` int(11) NOT NULL,
  `nam` varchar(60) NOT NULL,
  `price` float NOT NULL,
  `image` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pays_depart` varchar(60) NOT NULL,
  `pays_arrive` varchar(60) NOT NULL,
  `date_vol` date NOT NULL,
  `hour_vol` int(11) NOT NULL,
  `minute_vol` int(11) NOT NULL,
  `nb_place_initial` int(11) NOT NULL,
  `nb_place_rest` int(11) NOT NULL,
  `statu_vol` varchar(10) NOT NULL,
  `id_admin_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vols`
--

INSERT INTO `vols` (`id_vol`, `nam`, `price`, `image`, `date_created`, `pays_depart`, `pays_arrive`, `date_vol`, `hour_vol`, `minute_vol`, `nb_place_initial`, `nb_place_rest`, `statu_vol`, `id_admin_created`) VALUES
(1, 'Voyage en famille', 15000, 'vol.jpg', '2020-06-13 11:42:27', 'safi', 'paris', '2020-06-26', 8, 12, 10, 8, 'active', 2),
(2, 'Voyage de travel', 40000, 'vol.jpg', '2020-06-08 19:35:16', 'madrid', 'marakech', '2020-08-30', 6, 44, 20, 9, 'active', 2),
(3, 'Voyage en famille', 10, 'vol.jpg', '2020-06-08 19:41:41', 'maroc', 'madrid', '2020-07-12', 4, 2, 40, 40, 'active', 2),
(4, 'Voyage en famille', 10000, 'vol.jpg', '2020-06-15 12:13:36', 'holanda', 'canada', '2020-06-20', 2, 4, 20, 19, 'active', 2),
(5, 'Voyage en famille', 4000, 'vol.jpg', '2020-06-15 12:23:30', 'canadaa', 'marocv', '2020-07-10', 10, 18, 60, 60, 'active', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id_passager`),
  ADD KEY `id_user_created` (`id_user_created`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_passager` (`id_passager`),
  ADD KEY `id_vol` (`id_vol`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vols`
--
ALTER TABLE `vols`
  ADD PRIMARY KEY (`id_vol`),
  ADD KEY `id_admin_created` (`id_admin_created`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `passager`
--
ALTER TABLE `passager`
  MODIFY `id_passager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `vols`
--
ALTER TABLE `vols`
  MODIFY `id_vol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `passager`
--
ALTER TABLE `passager`
  ADD CONSTRAINT `passager_ibfk_1` FOREIGN KEY (`id_user_created`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_passager`) REFERENCES `passager` (`id_passager`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_vol`) REFERENCES `vols` (`id_vol`);

--
-- Contraintes pour la table `vols`
--
ALTER TABLE `vols`
  ADD CONSTRAINT `vols_ibfk_1` FOREIGN KEY (`id_admin_created`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
