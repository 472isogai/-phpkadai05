-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2024 年 9 月 08 日 13:33
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db_class`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `content`, `date`) VALUES
(1, 'こすげたつや', 'test@test.jp', '内容', '2024-07-21 09:34:57'),
(2, 'こすつや', 'tt@test.jp', '容', '2024-07-21 09:36:50'),
(3, 'こすげ66たつや', 'test66@test.jp', '内66容', '2024-07-21 09:37:03'),
(4, 'いそがい22', '222@gmail.com', '444', '2024-07-21 11:16:29');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bookmark_table`
--

CREATE TABLE `gs_bookmark_table` (
  `id` int(11) NOT NULL,
  `user_id` int(12) NOT NULL,
  `book_name` varchar(64) NOT NULL,
  `book_url` text NOT NULL,
  `book_comment` text NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bookmark_table`
--

INSERT INTO `gs_bookmark_table` (`id`, `user_id`, `book_name`, `book_url`, `book_comment`, `date`, `image`) VALUES
(4, 0, 'eee444', '34343', '5535', '2024-08-12 09:07:18', ''),
(5, 0, '555', '666', '777', '2024-08-12 09:21:04', ''),
(6, 0, '', '', '', '2024-09-08 13:23:47', ''),
(11, 0, 'eee', 'ttt', 'yyreay', '2024-08-12 14:59:43', ''),
(13, 0, 'rere', 'rerer', 'rerere', '2024-08-12 15:44:21', ''),
(14, 0, 'eee', 'tttt', 'kkk', '2024-09-01 21:08:18', ''),
(16, 1, 'rere', 'https://rere', 'rere', '2024-09-08 20:11:37', 'img/66dd8669d8388.png'),
(17, 1, '4445', 'https://4445', '4445', '2024-09-08 20:18:25', 'img/66dd8698542a5.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト１管理者', 'test1', 'test1', 1, 0),
(2, 'テスト2一般', 'test2', 'test2', 0, 0),
(3, 'テスト３', 'test3', 'test3', 0, 0),
(7, 'test6', 'test6', 'test6', 0, 0),
(8, 'test7', 'test7', 'test7', 1, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_bookmark_table`
--
ALTER TABLE `gs_bookmark_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `gs_bookmark_table`
--
ALTER TABLE `gs_bookmark_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
