-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 07 Nov 2018 pada 00.04
-- Versi server: 5.7.19
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reza`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asses`
--

CREATE TABLE `asses` (
  `id` int(11) NOT NULL,
  `id_exam` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `asses`
--

INSERT INTO `asses` (`id`, `id_exam`, `id_student`, `score`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 70, 2, '2018-11-06 23:51:06', '2018-11-07 07:52:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'RPL 3', '2018-11-06 17:35:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `essay_keywords`
--

CREATE TABLE `essay_keywords` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `essay_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `essay_keywords`
--

INSERT INTO `essay_keywords` (`id`, `text`, `essay_id`, `created_at`, `updated_at`) VALUES
(10, 'test', 8, '2018-11-06 22:29:14', NULL),
(11, 'test123', 8, '2018-11-06 22:29:14', NULL),
(12, 'test test', 8, '2018-11-06 22:29:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `essay_questions`
--

CREATE TABLE `essay_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `weight` int(11) NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `essay_questions`
--

INSERT INTO `essay_questions` (`id`, `question`, `weight`, `exam_id`, `created_at`, `updated_at`) VALUES
(8, 'Testing', 20, 5, '2018-11-06 22:29:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `exams`
--

INSERT INTO `exams` (`id`, `title`, `start`, `end`, `created_by`, `classroom_id`, `created_at`, `updated_at`) VALUES
(5, 'MTK', '2018-06-10 02:00:00', '2018-06-11 02:00:00', 2, 1, '2018-11-06 22:27:54', NULL),
(6, 'Exam', '2018-11-06 10:00:00', '2018-11-06 10:00:00', 2, 1, '2018-11-06 22:49:06', NULL),
(7, 'asdasd', '2080-03-12 12:03:00', '2094-11-28 12:03:00', 2, 1, '2018-11-06 22:51:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_student_essay_answers`
--

CREATE TABLE `history_student_essay_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `answer` varchar(100) NOT NULL,
  `essay_question_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_student_essay_answers`
--

INSERT INTO `history_student_essay_answers` (`id`, `answer`, `essay_question_id`, `student_id`, `created_at`, `updated_at`) VALUES
(8, 'test', 8, 1, '2018-11-06 22:35:02', '2018-11-07 07:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_student_multiple_choice_answers`
--

CREATE TABLE `history_student_multiple_choice_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `option_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_student_multiple_choice_answers`
--

INSERT INTO `history_student_multiple_choice_answers` (`id`, `question_id`, `option_id`, `student_id`, `created_at`, `updated_at`) VALUES
(15, 24, 87, 1, '2018-11-06 22:35:02', '2018-11-07 07:23:18'),
(16, 25, 91, 1, '2018-11-06 22:35:02', '2018-11-07 07:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login_logs`
--

INSERT INTO `login_logs` (`id`, `login_time`, `ip_address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2018-11-07 01:44:19', NULL, 2, '2018-11-06 17:44:19', NULL),
(2, '2018-11-07 01:44:56', NULL, 1, '2018-11-06 17:44:56', NULL),
(3, '2018-11-07 01:45:11', NULL, 2, '2018-11-06 17:45:11', NULL),
(4, '2018-11-07 05:03:06', '127.0.0.1', 1, '2018-11-06 21:03:06', NULL),
(5, '2018-11-07 05:18:22', '127.0.0.1', 1, '2018-11-06 21:18:22', NULL),
(6, '2018-11-07 05:18:33', '127.0.0.1', 2, '2018-11-06 21:18:33', NULL),
(7, '2018-11-07 05:26:54', '127.0.0.1', 1, '2018-11-06 21:26:54', NULL),
(8, '2018-11-07 06:27:15', '127.0.0.1', 2, '2018-11-06 22:27:15', NULL),
(9, '2018-11-07 06:39:43', '127.0.0.1', 2, '2018-11-06 22:39:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `multiple_choice_options`
--

CREATE TABLE `multiple_choice_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `multiple_choice_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `multiple_choice_options`
--

INSERT INTO `multiple_choice_options` (`id`, `text`, `multiple_choice_id`, `created_at`, `updated_at`) VALUES
(86, '1', 24, '2018-11-06 22:28:09', NULL),
(87, '2', 24, '2018-11-06 22:28:09', NULL),
(88, '3', 24, '2018-11-06 22:28:09', NULL),
(89, '4', 24, '2018-11-06 22:28:09', NULL),
(90, '5', 24, '2018-11-06 22:28:09', NULL),
(91, '20', 25, '2018-11-06 22:28:30', NULL),
(92, '40', 25, '2018-11-06 22:28:30', NULL),
(93, '60', 25, '2018-11-06 22:28:30', NULL),
(94, '70', 25, '2018-11-06 22:28:30', NULL),
(95, '90', 25, '2018-11-06 22:28:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `multiple_choice_question`
--

CREATE TABLE `multiple_choice_question` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `weight` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `correct_answer_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `multiple_choice_question`
--

INSERT INTO `multiple_choice_question` (`id`, `question`, `weight`, `exam_id`, `correct_answer_id`, `created_at`, `updated_at`) VALUES
(24, '1+1 adalah', 50, 5, 87, '2018-11-06 22:28:09', '2018-11-07 06:28:09'),
(25, '30 + 30 adalah', 30, 5, 93, '2018-11-06 22:28:30', '2018-11-07 06:28:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `id_user`, `name`, `classroom_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Reza Juliandri', 1, '2018-11-06 21:28:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_essay_answers`
--

CREATE TABLE `student_essay_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `essay_question_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student_essay_answers`
--

INSERT INTO `student_essay_answers` (`id`, `answer`, `essay_question_id`, `student_id`, `created_at`, `updated_at`) VALUES
(7, 'test', 8, 1, '2018-11-06 22:35:02', '2018-11-07 07:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_multiple_choice_answers`
--

CREATE TABLE `student_multiple_choice_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `option_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student_multiple_choice_answers`
--

INSERT INTO `student_multiple_choice_answers` (`id`, `question_id`, `option_id`, `student_id`, `created_at`, `updated_at`) VALUES
(15, 24, 87, 1, '2018-11-06 22:35:02', '2018-11-07 07:23:18'),
(16, 25, 91, 1, '2018-11-06 22:35:02', '2018-11-07 07:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teachers`
--

INSERT INTO `teachers` (`id`, `id_user`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mr. Hello', '2018-11-06 22:58:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `student_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'Siswa', 'siswa', 'siswa@mail.com', '$2y$10$DWf5PUTsVrhhD8oZdkWcteefzo6Gz0s0MIKZbT8A55PcQXToNQwhC', '9OPYH2QJkFWhlYgErzDwXZ3jLZ9OS9mvOTx4yawceNjIxR1S5bXP42DDUt2z', 1, 0, '2018-11-07 01:00:20', '2018-11-07 05:18:07'),
(2, 'Guru', 'guru', 'guru@mail.com', '$2y$10$tCLCkTGBg77may9wcRDlOet.awXgae46OW3J7TnxAz0cLut/KFDfm', 'N54HofcyR6mRNCykPfRYBWvU6606eqewB8ccW5YNn1T1RBnNK6ikr5g6VZMT', NULL, 1, '2018-11-07 01:03:19', '2018-11-07 01:03:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asses`
--
ALTER TABLE `asses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `essay_keywords`
--
ALTER TABLE `essay_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essay_id` (`essay_id`);

--
-- Indeks untuk tabel `essay_questions`
--
ALTER TABLE `essay_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indeks untuk tabel `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `history_student_essay_answers`
--
ALTER TABLE `history_student_essay_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `history_student_multiple_choice_answers`
--
ALTER TABLE `history_student_multiple_choice_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indeks untuk tabel `login_logs`
--
ALTER TABLE `login_logs`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `multiple_choice_options`
--
ALTER TABLE `multiple_choice_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `multiple_choice_id` (`multiple_choice_id`);

--
-- Indeks untuk tabel `multiple_choice_question`
--
ALTER TABLE `multiple_choice_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `weight` (`weight`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `correct_answer_id` (`correct_answer_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `student_essay_answers`
--
ALTER TABLE `student_essay_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essay_question_id` (`essay_question_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `student_multiple_choice_answers`
--
ALTER TABLE `student_multiple_choice_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asses`
--
ALTER TABLE `asses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `essay_keywords`
--
ALTER TABLE `essay_keywords`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `essay_questions`
--
ALTER TABLE `essay_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `history_student_essay_answers`
--
ALTER TABLE `history_student_essay_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `history_student_multiple_choice_answers`
--
ALTER TABLE `history_student_multiple_choice_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `multiple_choice_options`
--
ALTER TABLE `multiple_choice_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `multiple_choice_question`
--
ALTER TABLE `multiple_choice_question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `student_essay_answers`
--
ALTER TABLE `student_essay_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `student_multiple_choice_answers`
--
ALTER TABLE `student_multiple_choice_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `essay_keywords`
--
ALTER TABLE `essay_keywords`
  ADD CONSTRAINT `essay_keywords_ibfk_1` FOREIGN KEY (`essay_id`) REFERENCES `essay_questions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `essay_questions`
--
ALTER TABLE `essay_questions`
  ADD CONSTRAINT `essay_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `multiple_choice_options`
--
ALTER TABLE `multiple_choice_options`
  ADD CONSTRAINT `multiple_choice_options_ibfk_1` FOREIGN KEY (`multiple_choice_id`) REFERENCES `multiple_choice_question` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `multiple_choice_question`
--
ALTER TABLE `multiple_choice_question`
  ADD CONSTRAINT `multiple_choice_question_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
