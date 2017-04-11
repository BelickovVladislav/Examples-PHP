-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 27 2016 г., 20:11
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `orderticket`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `First Name` text NOT NULL,
  `Middle Name` text NOT NULL,
  `Name` text NOT NULL,
  `id_spetional` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_spetional` (`id_spetional`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`id`, `First Name`, `Middle Name`, `Name`, `id_spetional`, `room_number`) VALUES
(1, 'Петров', 'Николаевич', 'Николай', 1, 101),
(2, 'Иванов', 'Васильевич', 'Максим', 1, 102),
(3, 'Сидоров', 'Николаевич', 'Алексей', 1, 103),
(4, 'Петров', 'Алексеевич', 'Николай', 2, 201),
(5, 'Иванов', 'Алексеевич', 'Максим', 2, 202),
(6, 'Сидоров', 'Алексеевич', 'Алексей', 2, 203),
(7, 'Петров', 'Егорович', 'Николай', 3, 301),
(8, 'Иванов', 'Егорович', 'Максим', 3, 302),
(9, 'Сидоров', 'Егорович', 'Алексей', 3, 303);

-- --------------------------------------------------------

--
-- Структура таблицы `spetional`
--

CREATE TABLE IF NOT EXISTS `spetional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `spetional`
--

INSERT INTO `spetional` (`id`, `name`) VALUES
(1, 'Терапевт'),
(2, 'ЛОР'),
(3, 'Хирург');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doctor` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `Last Name` text NOT NULL,
  `Name` text NOT NULL,
  `Middle Name` text NOT NULL,
  `bday` date NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_doctor` (`id_doctor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`id`, `id_doctor`, `date`, `time`, `Last Name`, `Name`, `Middle Name`, `bday`, `address`) VALUES
(3, 5, '2016-05-28', '15:00:00', 'Беликов', 'Владислав', 'Сергеевич', '1997-05-28', 'Налибокская 32,208'),
(4, 5, '2016-05-28', '18:00:00', 'Беликов', 'Владислав', 'Сергеевич', '1997-05-28', 'Налибокская 32,208'),
(5, 5, '2016-05-27', '08:00:00', 'Анальный', 'Дистрибьютив', 'Викторович', '2016-05-05', 'Кокс'),
(6, 5, '2016-05-27', '08:40:00', 'Анальный', 'Дистрибьютив', 'Викторович', '2016-05-05', 'Кокс');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`id_spetional`) REFERENCES `spetional` (`id`);

--
-- Ограничения внешнего ключа таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
