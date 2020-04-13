-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 4 月 13 日 02:13
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `Booklist`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `book_list`
--

CREATE TABLE `book_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `book_count` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL DEFAULT '1',
  `correction` varchar(50) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:未削除、1:削除済み',
  `creation_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `book_list`
--

INSERT INTO `book_list` (`id`, `name`, `book_count`, `isbn`, `genre_id`, `level_id`, `correction`, `picture`, `is_deleted`, `creation_date_time`, `update_date_time`) VALUES
(13, 'a', 1, '1-1-1-1', 3, 1, NULL, NULL, 0, '2020-03-14 11:38:21', '2020-03-14 11:38:21'),
(14, 's', 1, '1-1-1-2', 3, 2, NULL, NULL, 0, '2020-03-14 11:40:45', '2020-03-14 11:40:45'),
(15, 'd', 1, '1-1-1-5', 3, 3, NULL, NULL, 0, '2020-03-16 09:45:35', '2020-03-16 09:45:55'),
(16, 'r', 1, '1-1-1-6', 8, 1, NULL, NULL, 0, '2020-03-16 09:46:15', '2020-03-16 09:47:15'),
(17, 'q', 1, '1-1-1-7', 8, 2, NULL, NULL, 0, '2020-03-16 09:46:32', '2020-03-16 09:46:32'),
(18, 't', 1, '1-1-1-7', 8, 3, NULL, NULL, 0, '2020-03-16 10:10:41', '2020-03-16 10:10:41'),
(19, 'z', 1, '1-1-2-1', 1, 1, NULL, NULL, 0, '2020-03-16 10:11:11', '2020-03-16 10:11:11'),
(20, 'x', 1, '1-1-2-2', 1, 2, NULL, NULL, 0, '2020-03-16 10:11:32', '2020-03-16 10:11:32'),
(21, 'c', 1, '1-1-2-3', 1, 3, NULL, NULL, 0, '2020-03-16 10:11:52', '2020-03-16 10:11:52'),
(22, 'p', 1, '1-1-3-3', 2, 3, NULL, NULL, 0, '2020-03-16 10:12:10', '2020-03-16 10:12:10'),
(23, 'I', 1, '1-1-3-2', 2, 2, NULL, NULL, 0, '2020-03-16 10:12:28', '2020-03-16 10:12:28'),
(24, 'u', 1, '1-1-3-1', 2, 1, NULL, NULL, 0, '2020-03-16 10:12:40', '2020-03-16 10:12:40'),
(25, 'ppp', 1, '9-9-9-9-9', 1, 3, NULL, NULL, 1, '2020-03-23 10:38:46', '2020-04-10 14:24:01'),
(26, 'awe', 1, '1-1-1-1-1', 12, 1, NULL, NULL, 1, '2020-04-01 10:29:36', '2020-04-06 13:33:53'),
(27, 'クェ', 1, '10-10-10', 3, 1, NULL, NULL, 0, '2020-04-06 13:57:21', '2020-04-06 13:57:21');

-- --------------------------------------------------------

--
-- テーブルの構造 `genre_list`
--

CREATE TABLE `genre_list` (
  `id` int(11) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:未削除、1:削除済み',
  `creation_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `genre_list`
--

INSERT INTO `genre_list` (`id`, `genre`, `is_deleted`, `creation_date_time`, `update_date_time`) VALUES
(1, 'JAVA', 0, '2020-02-28 14:21:02', '2020-03-05 11:23:15'),
(2, 'PHP', 0, '2020-02-28 14:22:10', '2020-02-28 14:22:10'),
(3, 'C#', 0, '2020-03-04 10:28:23', '2020-04-10 14:21:33'),
(8, 'C++', 0, '2020-03-05 09:49:59', '2020-03-05 09:49:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `level_list`
--

CREATE TABLE `level_list` (
  `id` int(11) NOT NULL,
  `level` varchar(20) NOT NULL,
  `is_deleted` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0:未削除、1:削除',
  `creation_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `level_list`
--

INSERT INTO `level_list` (`id`, `level`, `is_deleted`, `creation_date_time`, `update_date_time`) VALUES
(1, '初級', 0, '2020-03-10 14:49:36', '2020-03-10 14:50:42'),
(2, '中級', 0, '2020-03-10 14:49:36', '2020-03-10 14:50:42'),
(3, '上級', 0, '2020-03-10 14:49:36', '2020-03-10 14:50:42');

-- --------------------------------------------------------

--
-- テーブルの構造 `requests_list`
--

CREATE TABLE `requests_list` (
  `id` int(11) NOT NULL,
  `contributor` varchar(50) NOT NULL,
  `request` varchar(1000) NOT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:未完了、1:完了',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:未削除、1:削除済み',
  `creation_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `requests_list`
--

INSERT INTO `requests_list` (`id`, `contributor`, `request`, `is_completed`, `is_deleted`, `creation_date_time`, `update_date_time`) VALUES
(1, '匿名', 'あ', 1, 0, '2020-02-19 11:45:47', '2020-04-07 13:48:10'),
(2, '匿名', 'asdferdferffghgfcvbx', 0, 0, '2020-02-26 11:14:43', '2020-03-16 10:38:07'),
(3, '匿名', 'sssssssssssssssss', 0, 0, '2020-02-26 11:26:06', '2020-03-16 11:00:52'),
(4, '匿名', 'kkkkkkkkkkkkkkkkkkkkk', 0, 0, '2020-02-26 11:37:08', '2020-03-16 10:38:07'),
(5, '匿名', 'aaaaaaaaaaaaa', 0, 1, '2020-04-06 13:06:59', '2020-04-07 13:48:06');

-- --------------------------------------------------------

--
-- テーブルの構造 `staffs_list`
--

CREATE TABLE `staffs_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `creation_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `staffs_list`
--

INSERT INTO `staffs_list` (`id`, `name`, `username`, `password`, `is_deleted`, `creation_date_time`, `update_date_time`) VALUES
(2, 'qw', 'e', '$2y$10$s8nTB12jmCHgJ48xH.Hlaet1htntsqBWMD77zZA2RFT9uJTLi8eZ2', 0, '2020-04-03 11:37:50', '2020-04-08 11:36:49');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `genre_list`
--
ALTER TABLE `genre_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `level_list`
--
ALTER TABLE `level_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `requests_list`
--
ALTER TABLE `requests_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `staffs_list`
--
ALTER TABLE `staffs_list`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- テーブルのAUTO_INCREMENT `genre_list`
--
ALTER TABLE `genre_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルのAUTO_INCREMENT `level_list`
--
ALTER TABLE `level_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `requests_list`
--
ALTER TABLE `requests_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `staffs_list`
--
ALTER TABLE `staffs_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
