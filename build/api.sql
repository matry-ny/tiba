-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 03 2015 г., 00:07
-- Версия сервера: 5.5.42-log
-- Версия PHP: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `api_phones`
--

CREATE TABLE IF NOT EXISTS `api_phones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `api_users`
--

CREATE TABLE IF NOT EXISTS `api_users` (
  `id` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` timestamp NULL DEFAULT NULL,
  `group` tinyint(2) unsigned NOT NULL,
  `password` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `api_users`
--

INSERT INTO `api_users` (`id`, `email`, `name`, `gender`, `group`, `password`, `auth_key`, `avatar`, `is_active`, `create_time`) VALUES
(3, 'd.kotenko@i.ua', 'Дима Котенко', NULL, 1, 'c0988d3ad2956cf8a0a1d252f30a1f0f', 'VvT1wUhJST', '/storage/images/system/dkotenko_avatar.jpg', 1, '2015-05-25 21:02:51');

-- --------------------------------------------------------

--
-- Структура таблицы `api_user_groups`
--

CREATE TABLE IF NOT EXISTS `api_user_groups` (
  `id` tinyint(2) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `access_level` tinyint(1) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `api_user_groups`
--

INSERT INTO `api_user_groups` (`id`, `name`, `access_level`) VALUES
(1, 'Супер администратор', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `api_phones`
--
ALTER TABLE `api_phones`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQUE` (`email`), ADD KEY `user_group` (`group`);

--
-- Индексы таблицы `api_user_groups`
--
ALTER TABLE `api_user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `api_phones`
--
ALTER TABLE `api_phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `api_users`
--
ALTER TABLE `api_users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `api_user_groups`
--
ALTER TABLE `api_user_groups`
  MODIFY `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `api_phones`
--
ALTER TABLE `api_phones`
ADD CONSTRAINT `api_phones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `api_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `api_users`
--
ALTER TABLE `api_users`
ADD CONSTRAINT `api_users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `api_user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
