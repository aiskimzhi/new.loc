-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 02 2015 г., 15:22
-- Версия сервера: 5.6.25
-- Версия PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `app`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advert`
--

CREATE TABLE IF NOT EXISTS `advert` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `advert`
--

INSERT INTO `advert` (`id`, `user_id`, `region_id`, `city_id`, `category_id`, `subcategory_id`, `title`, `text`, `created_at`, `updated_at`, `views`) VALUES
(2, 6, 1, 1, 1, 1, 'title', 'here should be the text of the advert', 0, 0, 2),
(3, 12, 1, 2, 2, 1, 'title here', 'here is the text of an Anastasia Iskimzhi advert', 0, 0, 2),
(5, 12, 1, 2, 2, 2, 'new title', 'text of the second advert', 0, 0, 0),
(6, 12, 1, 2, 2, 3, 'title new', 'a new text of a new advert i am writing here', 0, 0, 0),
(7, 12, 1, 1, 1, 1, 'title here', 'text here', 1442251549, 1442251549, 0),
(9, 12, 2, 4, 1, 1, 'hkjhljk', 'ghjgkj', 1442931830, 1442931830, 0),
(10, 12, 1, 2, 1, 2, 'try title', 'Here I am trying to add an advert to my database. I hope I am lucky', 1442932280, 1442932280, 0),
(11, 12, 1, 2, 1, 2, 'try title', 'Here I am trying to add an advert to my database. I hope I am lucky', 1442932331, 1442932331, 0),
(12, 12, 1, 1, 2, 6, 'title 8', 'text 8', 1442932877, 1442932877, 1),
(13, 12, 1, 1, 2, 5, 'advert title', 'advert tetxt', 1442933801, 1442933801, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `bookmark`
--

CREATE TABLE IF NOT EXISTS `bookmark` (
  `user_id` int(11) DEFAULT NULL,
  `advert_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `advert_id`) VALUES
(12, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'category_1'),
(2, 'category_2');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `region_id`, `name`) VALUES
(1, 1, 'Kharkiv'),
(2, 1, 'Chuhuev'),
(3, 1, 'Kupiansk'),
(4, 2, 'Luhansk'),
(5, 2, 'Sverdlovsk'),
(6, 2, 'Schastie');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1439553468),
('m150814_113541_create_user_table', 1439555576),
('m150814_113603_create_region_table', 1439555576),
('m150814_113614_create_city_table', 1439555577),
('m150814_113629_create_category_table', 1439555577),
('m150814_113640_create_subcategory_table', 1439555578),
('m150814_113654_create_advert_table', 1439555581),
('m150814_113704_create_bookmark_table', 1439555582);

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Kharkiv region'),
(2, 'Luhansk region');

-- --------------------------------------------------------

--
-- Структура таблицы `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`) VALUES
(1, 1, '1_subcategory_1'),
(2, 1, '1_subcategory_2'),
(3, 1, '1_subcategory_3'),
(4, 2, '2_subcategory_1'),
(5, 2, '2_subcategory_2'),
(6, 2, '2_subcategory_3');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `email`, `skype`, `phone`, `auth_key`, `password_reset_token`) VALUES
(1, 'anton', 'anton', 'anton1', 'anton@example.com', NULL, NULL, 'sM47jQWUvDgcJjjSMP4Dm_A-qVyeKTPA', ''),
(2, 'Anastasia', 'Iskimzhi', '', 'mail@example.com', '', '', '', ''),
(4, 'Anastasia', 'surname', '111111', 'email@email.com', '', '', '', ''),
(6, 'Anastasia', 'new', '111111', 'anton1@example.com', 'skype', '+380501111111', 'authkey', 'password reset token'),
(7, 'Anastasia', 'Iskimzhi', '111111', 'aiskimz111hi@mail.ru', '', '', '', ''),
(8, 'Anastasia', 'Iskimzhi', '111111', 'aiskimz1111hi@mail.ru', '', '', '', ''),
(9, 'Anastasia', 'Iskimzhi', '111111', 'aiskimz11121hi@mail.ru', '', '', '', ''),
(10, 'name', 'surname', '$2y$13$aMkATKBt7hP7eRw0rzIlvu0p28.dtMZIwP2yfq5bgcq9MZ.QLV40e', 'nastya@example.com', NULL, NULL, '50DPRPHDoSFTCwOFHzZdZcd6IoAP8vV3', 'JvsuwBiWnkTq6ykDYTRKylekiYZo-v72'),
(11, 'name1', 'surname1', '$2y$13$lRoX3.4.VmDHzQNrENVwmuOMMRKqADFmHHpUFqhX7YJTcr..Ul8D2', 'nastya1@example.com', NULL, NULL, 'Vdg11zs7PirAHxN_Tj0jqMwhLTH7J2G3', 'HKAWyqXDGk_FeSmOfg6gSrZT1McF-hOw'),
(12, 'Anastasia', 'Iskimzhi', '$2y$13$dVubZxWYiKUVQcxoQ.szjukGKAGHMxBnBFyEp2WV/XAKK4AI5OXvy', 'my@mail.com', 'skype1', '+380991111111', 'VY4V3htjJbtHD0f3F4PJBySv1JArdGZY', 'XtfmTj3lTKrx7fbr-Tnmgu_ClmoMoHD1'),
(13, 'name', 'surname', '$2y$13$DqB/DuA.yGriuQ5ndiGXX.KwtZ/.fQNX/UtsBFuv1u9tQw4zUbs8.', 'aiskimzhi@mail.ru', NULL, NULL, 'a-DhJts6fZfcdctQPLNV6P_2is-UFTcu', 'IHF889NMk7OqLZPLkkBplWri6AxZWiwV'),
(14, 'Vasya', 'Pupkin', '$2y$13$bmk.qv7NggbaFJvr5VDtT.HWsj8yERioaAfx0/m/5ZTjxvJV/QPEi', 'email@mail.com', NULL, NULL, 'ASwNjYlSnkhT3FFqGRr1pu-EGeJrNTQB', 'XC3UCncxMIzuFCX0ACWaPZ7LANMCCCdh'),
(15, 'Ivan', 'Ivanov', '$2y$13$0vaJ2FZThcgWDQJINuktt.bmdKFzV40nwQ5WhzwLQXyzpzhQkP4VO', 'email@mil.com', 'skype_sk', '+345557735', 'Xa-PTtpFWspAsU4HnILnyYfs0sRd4iFD', 'BPXXBxLo6mt3gSKrSVD4xtIC8wACzkgb');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advert_user` (`user_id`),
  ADD KEY `advert_region` (`region_id`),
  ADD KEY `advert_city` (`city_id`),
  ADD KEY `advert_category` (`category_id`),
  ADD KEY `advert_subcategory` (`subcategory_id`);

--
-- Индексы таблицы `bookmark`
--
ALTER TABLE `bookmark`
  ADD KEY `bookmark_user` (`user_id`),
  ADD KEY `bookmark_advert` (`advert_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_city` (`region_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_subcategory` (`category_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `advert`
--
ALTER TABLE `advert`
  ADD CONSTRAINT `advert_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advert_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advert_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advert_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advert_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_advert` FOREIGN KEY (`advert_id`) REFERENCES `advert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `region_city` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `category_subcategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
