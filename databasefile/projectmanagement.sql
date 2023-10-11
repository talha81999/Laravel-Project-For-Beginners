-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 09:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(96, '2023_05_01_091555_add_updated_at_column_to_tbl_user_table', 1),
(97, '2023_05_01_094719_add_column_to_tbl_user_table', 1),
(109, '2023_05_01_101355_drop_updated_by_from_tbl_user_table', 4),
(148, '2023_05_01_102200_add_column_to_tbl_user_table', 5),
(149, '2023_05_01_102454_add_user_created_at_to_tbl_user_table', 6),
(189, '2023_05_01_103217_add_user_updated_at_to_tbl_user_table', 7),
(202, '2023_05_01_101232_drop_created_by_from_tbl_user_table', 8),
(203, '2023_05_01_101607_drop_updated_at_from_tbl_user_table', 8),
(204, '2023_05_01_103119_add_user_created_at_to_tbl_user_table', 8),
(232, '2023_05_01_061558_add_columns_to_tbl_user_table', 9),
(248, '2023_05_02_064622_rename_column_in_table', 10),
(249, '2023_05_02_084946_add_default_value_to_column_tbl_user', 10),
(250, '2014_10_12_000000_create_users_table', 11),
(251, '2014_10_12_100000_create_password_resets_table', 11),
(252, '2019_08_19_000000_create_failed_jobs_table', 11),
(253, '2019_12_14_000001_create_personal_access_tokens_table', 11),
(254, '2023_04_28_043639_create_tbl_user_table', 11),
(255, '2023_04_28_045409_create_tbl_project_table', 11),
(256, '2023_04_28_045431_create_tbl_task_table', 11),
(257, '2023_04_28_045447_create_tbl_teams_table', 11),
(258, '2023_04_28_054220_add_columns_to_tbl_teams_table', 11),
(259, '2023_05_01_112647_add_user_last_login_to_tbl_user_table', 11),
(260, '2023_05_01_113259_add_user_profile_image_to_tbl_user_table', 11),
(261, '2023_05_02_101815_rename_column_team_id_in_tbl_teams', 12),
(262, '2023_05_02_101950_rename_column_team_created_at_in_tbl_teams', 13),
(263, '2023_05_02_102028_rename_column_team_updated_at_in_tbl_teams', 14),
(264, '2023_05_02_102132_rename_column_tbl_user_id_in_tbl_user', 15),
(265, '2023_05_02_102404_add_user_first_and_last_name_to_tbl_user', 16),
(266, '2023_05_02_102543_add_user_first_name_to_tbl_user', 17),
(267, '2023_05_02_102619_add_user_last_name_to_tbl_user', 18),
(268, '2023_05_02_103531_change_temporary_password_to_default_to_tbl_user', 19),
(269, '2023_05_02_103821_temporarypassword_to_default_to_tbl_user', 20),
(270, '2023_05_03_053032_rename_column_tbl_project_id_in_tbl_project', 21),
(271, '2023_05_03_053228_rename_column_project_created_at_in_tbl_project', 22),
(272, '2023_05_03_053318_rename_column_project_updated_at_in_tbl_project', 23),
(273, '2023_05_03_073844_add_column_user_teamlead_to_tbl_user', 24),
(274, '2023_05_03_091249_rename_column_task_id_in_tbl_task', 25),
(275, '2023_05_03_091358_rename_column_task_created_at_in_tbl_task', 26),
(276, '2023_05_03_091450_rename_column_task_updated_at_in_tbl_task', 27),
(277, '2023_05_03_093450_add_column_task_name_to_tbl_task', 28),
(279, '2023_05_03_094315_change_column_task_due_to_enum__to_tbl_task', 30),
(280, '2023_05_03_100004_add_column_project_task_team_lead_to_date_to_tbl_task', 31),
(281, '2023_05_03_100118_change_column_project_task_status_date_to_tbl_task', 32),
(282, '2023_05_03_100218_change_column_project_task_due_to_tbl_task', 33),
(283, '2023_05_04_064518_add_column_task_comment_due_to_tbl_task', 34),
(284, '2023_05_04_064637_add_column_task_comment_due_to_tbl_task', 35),
(285, '2023_05_04_065139_add_column_task_completed_at_to_tbl_task', 36),
(286, '2023_05_05_065520_add_column_task_completed_status_to_tbl_task', 37),
(287, '2023_05_05_065823_add_column_name_task_completed_status_to_tbl_task', 38),
(288, '2023_05_05_094022_create_tbl_comments_table', 39),
(289, '2023_05_09_053541_remove_column_name_task_comment_from_tbl_task', 40),
(290, '2023_05_12_095822_add_column_deleted_at_to_tbl_users', 41),
(291, '2023_05_12_100814_add_column_deleted_at_to_tbl_project', 42);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `task_id`, `comment`, `created_at`, `updated_at`) VALUES
(14, 12, 'hi', '2023-05-11 01:03:11', '2023-05-11 01:03:11'),
(15, 13, 'hello', '2023-05-12 01:23:17', '2023-05-12 01:23:17'),
(16, 14, 'hi', '2023-05-12 02:04:56', '2023-05-12 02:04:56'),
(17, 14, 'hello', '2023-05-12 02:05:12', '2023-05-12 02:05:12'),
(18, 15, 'hi', '2023-07-13 23:37:48', '2023-07-13 23:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_assign_to` int(11) NOT NULL,
  `project_assign_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `project_name`, `project_assign_to`, `project_assign_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'indici', 16, 1, '2023-05-15 06:02:47', '2023-05-15 06:02:47', NULL),
(17, 'PMS', 21, 1, '2023-05-15 06:02:54', '2023-05-15 06:02:54', NULL),
(18, 'Securism', 16, 1, '2023-05-15 06:03:00', '2023-05-15 06:03:00', NULL),
(19, 'abc', 16, 1, '2023-05-15 07:50:40', '2023-05-15 07:50:40', NULL),
(20, 'xyz', 22, 1, '2023-05-15 07:50:58', '2023-05-15 07:50:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_assign_to` int(11) NOT NULL,
  `task_assign_by` int(11) NOT NULL,
  `task_team_lead` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_due` date DEFAULT NULL,
  `task_status` int(11) NOT NULL,
  `task_completed_at` date DEFAULT NULL,
  `task_completed_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`id`, `task_name`, `project_id`, `task_assign_to`, `task_assign_by`, `task_team_lead`, `task_due`, `task_status`, `task_completed_at`, `task_completed_status`, `created_at`, `updated_at`) VALUES
(15, 'crud', 16, 17, 1, '16', '2023-05-16', 0, '2023-05-19', 'late complete', '2023-05-15 06:03:23', '2023-05-19 11:04:42'),
(16, 'crud', 16, 17, 1, '16', '2023-05-17', 0, '2023-05-19', 'late complete', '2023-05-15 06:03:35', '2023-05-19 11:04:38'),
(17, 'new', 18, 17, 1, '16', '2023-05-18', 0, '2023-05-19', 'late complete', '2023-05-15 07:50:22', '2023-05-19 11:04:39'),
(18, 'pms', 17, 24, 1, '21', '2023-05-19', 0, '2023-05-19', 'late complete', '2023-05-15 10:47:46', '2023-05-19 11:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teams`
--

CREATE TABLE `tbl_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teamlead_id` int(11) NOT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_teams`
--

INSERT INTO `tbl_teams` (`id`, `teamlead_id`, `team_name`, `created_at`, `updated_at`) VALUES
(1, 22, 'PHP', '2023-05-02 15:44:06', '2023-05-02 15:44:06'),
(2, 23, 'React', '2023-05-02 15:45:16', '2023-05-02 15:45:16'),
(3, 24, 'Laravel', '2023-05-02 15:45:26', '2023-05-02 15:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_gender` enum('M','F','O') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_dob` date NOT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_temporary_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1234',
  `user_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_team` int(11) DEFAULT NULL,
  `user_team_lead` int(11) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1,
  `user_joining_date` date NOT NULL,
  `user_created_by` int(11) DEFAULT NULL,
  `user_updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_name`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `user_gender`, `user_address`, `user_dob`, `user_last_login`, `user_password`, `user_temporary_password`, `user_type`, `user_role`, `user_team`, `user_team_lead`, `user_status`, `user_joining_date`, `user_created_by`, `user_updated_by`, `created_at`, `updated_at`, `user_profile_image`, `deleted_at`) VALUES
(1, 'user3456', 'Admin', '', 'admin@example.com', '12345678', 'M', 'islamabad', '2023-05-01', '2023-05-09 10:20:20', '123', '1234', '0', 'admin', NULL, NULL, 1, '2023-05-01', NULL, NULL, '2023-05-02 10:28:16', '2023-05-09 10:20:20', 'profile.png', NULL),
(16, 'user8474', 'talha', 'khan', 'zaidkhan30034@gmail.com', '2343343', 'M', 'isb', '2023-05-10', '2023-05-12 12:04:47', NULL, '1234', '1', 'Team Lead', 2, NULL, 1, '2023-05-12', 1, 1, '2023-05-12 01:50:53', '2023-05-12 07:04:47', '1683893087la.jpg', NULL),
(17, 'user905', 'shawaiz', 'khan', 'shawaix@gmail.com', '2343343', 'M', 'isb', '2023-05-09', '2023-05-12 09:33:18', '123', '1234', '2', 'Developer', 1, 16, 1, '2023-05-12', 1, 1, '2023-05-12 01:58:48', '2023-05-12 09:33:18', '1683874728la.jpeg', NULL),
(21, 'user4288', 'hammad', 'hammad', 'rajhammad099@gmail.com', '634746378', 'M', 'isb', '2023-05-11', '2023-05-12 12:29:49', NULL, '1234', '1', 'Team Lead', 3, NULL, 1, '2023-05-12', 1, 1, '2023-05-12 07:03:12', '2023-05-12 07:29:49', '1683893059la.png', NULL),
(22, 'user7473', 'ali', 'khan', 'rajhammad09@gmail.com', '2343343', 'M', 'isb', '2023-05-14', '2023-05-15 12:21:45', NULL, '1234', '1', 'Team Lead', 1, NULL, 1, '2023-05-15', 1, 1, '2023-05-15 01:32:56', '2023-05-15 07:21:45', '1684153305la.jpg', NULL),
(23, 'user8649', 'employee', '.', 'zaidkhan3004@gmail.com', '2343343', 'M', 'isb', '2023-05-15', '2023-07-14 04:39:29', '123', '1234', '2', 'Developer', 2, 16, 1, '2023-05-15', 1, 1, '2023-05-15 04:41:14', '2023-07-13 23:39:29', '1684153332la.jpeg', NULL),
(24, 'user9288', 'hamza', 'khan', 'hammadnaseer766@gmail.com', '2343343', 'M', 'isb', '2023-05-14', '2023-05-15 05:46:53', NULL, '1234', '2', 'Developer', 3, 21, 1, '2023-05-15', 1, 1, '2023-05-15 05:46:53', '2023-05-15 05:46:53', '1684147613la.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
