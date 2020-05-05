-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 5 月 04 日 01:36
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


-- --------------------------------------------------------

--
-- テーブルの構造 `staffs_list`
--

CREATE TABLE `staffs_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tuka` varchar(50) NOT NULL COMMENT '合言葉',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `creation_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `staffs_list`
--

INSERT INTO `staffs_list` (`id`, `name`, `username`, `password`, `tuka`, `is_deleted`, `creation_date_time`, `update_date_time`) VALUES
(6, 'as', 'd', '$2y$10$jouLLSR2aWpq67zZIbW8iOerf4Sj8o2KDHmp0jKWxITgZxQHCBRU.', '未来のかたち本町2校', 0, '2020-04-22 14:10:42', '2020-04-25 14:44:11'),
(7, '管理者A', 'admin', '$2y$10$tpFq3EE6cGjX0hPKePgJiOuYJBCTRi2JJQx87yY6djSOjBpsMpAFi', '未来のかたち本町2校', 0, '2020-04-29 10:23:55', '2020-05-01 12:22:12');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
