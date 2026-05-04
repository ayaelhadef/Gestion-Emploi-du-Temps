-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 02 mai 2026 à 02:21
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12
CREATE DATABASE IF NOT EXISTS `gestion-emploi`;
USE `gestion-emploi`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-emploi`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `sujet`, `message`, `created_at`, `updated_at`) VALUES
(1, 'aya@gmail.com', 'Nothing', 'Hello hope you are doing amazing', '2026-04-29 20:42:37', '2026-04-29 20:42:37'),
(2, 'zahira@gmail.com', 'Test', 'Message test', NULL, NULL),
(3, 'aya@gmail.com', 'Info', ' message....', NULL, NULL),
(4, 'khadija@gmail.com', 'Support', 'message....', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `filiere_id` bigint(20) UNSIGNED NOT NULL,
  `semestre_id` bigint(20) UNSIGNED NOT NULL,
  `enseignant_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_heures` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `nom`, `filiere_id`, `semestre_id`, `enseignant_id`, `nombre_heures`, `created_at`, `updated_at`) VALUES
(1, 'Recherche Opérationnelle', 1, 2, 3, 6, '2026-04-30 22:11:47', '2026-04-30 22:11:47'),
(2, 'Management de projet', 2, 3, 4, 4, '2026-05-01 11:43:26', '2026-05-01 11:43:26'),
(3, 'Français', 1, 2, 8, 2, '2026-05-01 14:55:21', '2026-05-01 14:55:21'),
(4, 'DEV WEB', 2, 2, 7, 6, '2026-05-01 14:56:47', '2026-05-01 14:56:47'),
(5, 'Management de projet', 1, 2, 4, 4, '2026-05-01 15:01:45', '2026-05-01 15:01:45'),
(6, 'DEV WEB', 1, 2, 7, 6, '2026-05-01 15:02:10', '2026-05-01 15:02:10');

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

CREATE TABLE `emplois` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cours_id` bigint(20) UNSIGNED NOT NULL,
  `salle_id` bigint(20) UNSIGNED NOT NULL,
  `jour` varchar(255) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`id`, `cours_id`, `salle_id`, `jour`, `heure_debut`, `heure_fin`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Lundi', '08:30:00', '10:15:00', '2026-05-01 15:03:30', '2026-05-01 15:03:30'),
(3, 3, 3, 'Vendredi', '14:30:00', '16:15:00', '2026-05-01 15:03:53', '2026-05-01 15:03:53'),
(4, 5, 5, 'Jeudi', '10:30:00', '12:15:00', '2026-05-01 15:04:15', '2026-05-01 15:04:15'),
(5, 6, 4, 'Mercredi', '16:30:00', '18:15:00', '2026-05-01 15:05:52', '2026-05-01 15:05:52');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

CREATE TABLE `filieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`id`, `nom`, `code`, `created_at`, `updated_at`) VALUES
(1, 'IL', NULL, '2026-04-29 16:20:23', '2026-04-29 16:20:23'),
(2, 'MGSI', NULL, '2026-04-29 16:21:05', '2026-04-29 16:21:05'),
(3, 'Datascience', NULL, '2026-05-01 11:42:54', '2026-05-01 11:42:54'),
(4, 'Securité', NULL, '2026-05-01 14:52:40', '2026-05-01 14:52:40');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_04_29_110156_create_filieres_table', 1),
(4, '2026_04_29_110326_create_semestres_table', 1),
(5, '2026_04_29_110412_create_users_table', 1),
(6, '2026_04_29_112502_create_cours_table', 1),
(7, '2026_04_29_115906_create_salles_table', 1),
(8, '2026_04_29_122117_create_emplois_table', 1),
(9, '2026_04_29_125518_add_password_to_users_table', 1),
(10, '2026_04_29_213153_create_contacts_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE `salles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `capacite` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`id`, `nom`, `capacite`, `created_at`, `updated_at`) VALUES
(2, 'SALLE 13', 60, '2026-04-30 15:12:16', '2026-04-30 15:12:16'),
(3, 'SALLE 1', 55, '2026-05-01 14:59:08', '2026-05-01 14:59:08'),
(4, 'SALLE 3', 60, '2026-05-01 14:59:40', '2026-05-01 14:59:40'),
(5, 'SALLE 14', 50, '2026-05-01 14:59:53', '2026-05-01 14:59:53');

-- --------------------------------------------------------

--
-- Structure de la table `semestres`
--

CREATE TABLE `semestres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `semestres`
--

INSERT INTO `semestres` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'S5', NULL, NULL),
(2, 'S6', NULL, NULL),
(3, 'S7', NULL, NULL),
(4, 'S8', NULL, NULL),
(5, 'S9', NULL, NULL),
(6, 'S10', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'etudiant',
  `numero_etudiant` varchar(255) DEFAULT NULL,
  `filiere_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semestre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `date_naissance`, `adresse`, `email`, `password`, `role`, `numero_etudiant`, `filiere_id`, `semestre_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'System', '2004-09-03', 'Agadir', 'ENSIASD@gmail.com', '$2y$12$.8IWmM9YB754fqJs5D/R2uoXzUvViAW6/T24HxQS4X21IkQq3Tfx6', 'admin', NULL, NULL, NULL, '2026-03-29 11:59:48', '2026-04-27 11:59:48'),
(2, 'AYA', 'EL-HADEF', '2004-06-24', 'Fès Maroc', 'aya@gmail.com', '$2y$12$DLYpaTG3CMuo9Lv3cN/au.TWK7JYN2eS7IRivIT9TQ7CN6v7fAkFO', 'etudiant', 'N123', 1, 1, '2026-03-29 15:52:52', '2026-05-01 14:45:25'),
(3, 'Ait', 'Mghart', '1999-03-09', 'Agadir jbel toubkal', 'Aitmghart@gmail.com', '$2y$12$EoTJWLPko2sRKXscJwgyPOKssYq7Qtal/EAZHO50NzgXe5PSe7B1e', 'enseignant', NULL, NULL, NULL, '2026-04-30 22:11:17', '2026-04-30 22:11:17'),
(4, 'SARA', 'SMIRI', '2000-08-03', 'FES, narjiss', 'S.SMIRI@gmail.com', '$2y$12$vZ7g5iaVCAny7ck97o9RVeqZfUKBfgK9.qm7VecHD4B3rhlUdS5Ze', 'enseignant', NULL, NULL, NULL, '2026-05-01 11:42:35', '2026-05-01 11:42:35'),
(5, 'Khadija', 'ID HAMMOU', '2004-09-03', 'Agadir', 'khadija@gmail.com', '$2y$12$q025f1eMFNmAt0dvDqMtS.hch.N5rFjMzilzWsRmO0NplGHtTUw/e', 'etudiant', 'C12345', 1, 2, '2026-05-01 14:44:41', '2026-05-01 14:44:41'),
(6, 'Zahira', 'Merzaki', '2004-02-14', 'Massa maroc', 'Zahira@gmail.com', '$2y$12$u3lJnWBxSsJ5.3a1C.mgreHK2cBcN1vhwO7OoP8uJBM75ZrlrYmK6', 'etudiant', 'Z1234566', 2, 3, '2026-05-01 14:46:49', '2026-05-01 14:46:49'),
(7, 'BRAHIM', 'LAASSEM', '1999-06-02', 'CASA', 'B.LAASSEM@gmail.com', '$2y$12$Q41sDISA.H7P4OtN630sQuL5i1GWhtPjJX0zv6Sn2UqjNlsMu4/Pm', 'enseignant', NULL, NULL, NULL, '2026-05-01 14:50:39', '2026-05-01 14:50:39'),
(8, 'OURDI', 'MOHAMMED', '1995-12-12', 'RABAT MAROC', 'OUARDI@gmail.com', '$2y$12$E37jUHSeO02WsTRy1VgwT..LG4WfN9CvJtnaCMcz5oC10.sxHNtnC', 'enseignant', NULL, NULL, NULL, '2026-05-01 14:51:31', '2026-05-01 14:51:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cours_filiere_id_foreign` (`filiere_id`),
  ADD KEY `cours_semestre_id_foreign` (`semestre_id`),
  ADD KEY `cours_enseignant_id_foreign` (`enseignant_id`);

--
-- Index pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emplois_cours_id_foreign` (`cours_id`),
  ADD KEY `emplois_salle_id_jour_index` (`salle_id`,`jour`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salles`
--
ALTER TABLE `salles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_numero_etudiant_unique` (`numero_etudiant`),
  ADD KEY `users_filiere_id_foreign` (`filiere_id`),
  ADD KEY `users_semestre_id_foreign` (`semestre_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `filieres`
--
ALTER TABLE `filieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `salles`
--
ALTER TABLE `salles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_enseignant_id_foreign` FOREIGN KEY (`enseignant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cours_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cours_semestre_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD CONSTRAINT `emplois_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_salle_id_foreign` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_semestre_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
