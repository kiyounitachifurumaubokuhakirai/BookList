-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 4 月 29 日 03:06
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
(7, '管理者A', 'admin', '$2y$10$tpFq3EE6cGjX0hPKePgJiOuYJBCTRi2JJQx87yY6djSOjBpsMpAFi', '未来のかたち本町2校', 1, '2020-04-29 10:23:55', '2020-04-29 10:25:45');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `staffs_list`
--
ALTER TABLE `staffs_list`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `staffs_list`
--
ALTER TABLE `staffs_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
