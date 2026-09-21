-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 21 2026 г., 14:57
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Beauty_Salon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Payment_method`
--

CREATE TABLE `Payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Payment_method`
--

INSERT INTO `Payment_method` (`payment_method_id`, `name`) VALUES
(1, 'Карта'),
(2, 'Наличные'),
(3, 'СБП');

-- --------------------------------------------------------

--
-- Структура таблицы `Request`
--

CREATE TABLE `Request` (
  `request_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `preferred_date` date NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Request`
--

INSERT INTO `Request` (`request_id`, `service_id`, `user_id`, `preferred_date`, `payment_method_id`, `status_id`) VALUES
(1, 1, 5, '2026-09-11', 1, 1),
(2, 3, 4, '2026-09-26', 1, 1),
(3, 1, 4, '2026-09-25', 2, 1),
(5, 3, 5, '2026-09-19', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Request_status`
--

CREATE TABLE `Request_status` (
  `request_status_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Request_status`
--

INSERT INTO `Request_status` (`request_status_id`, `name`) VALUES
(1, 'Новая'),
(2, 'Подтверждена'),
(3, 'Выполняется'),
(4, 'Завершена');

-- --------------------------------------------------------

--
-- Структура таблицы `Review`
--

CREATE TABLE `Review` (
  `review_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Service`
--

CREATE TABLE `Service` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Service`
--

INSERT INTO `Service` (`service_id`, `name`, `price`) VALUES
(1, 'Ногти', 1000),
(2, 'Покраска', 4000),
(3, 'Стрижка', 5000);

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`user_id`, `login`, `password_hash`, `surname`, `name`, `patronymic`, `phone_number`, `email`, `role`) VALUES
(2, 'adpivejh', '$2y$10$EF.RdA/jo12oe4/mMXBwSePgUUomVmOvaxcMja8x8jssWSoBwDb96', 'surname', 'name', 'otchestvo', '+79654564565', 'tigr123655@gmail.com', 'user'),
(3, 'lodfgdfg', '$2y$10$lNmW1D0XwnCO4vZeRoPZLu8cC7MP2z1M0XrnXOvGWoPYQEsg5.ujS', 'surname', 'name', 'dfgdfg', '+79654564565', 'mail@mail.ru', 'user'),
(4, 'ylarosome', '$2y$10$hB3o822H33L80vKdgayLCuuOJWxFcTTrTmqR65gy3/bY4FA.3e/0C', 'Familia', 'Alexander', 'otchestvo', '+79654564565', 'ylaromail@mail.com', 'user'),
(5, 'userAdmin', '$2y$10$FdhMYHvptwBt2QXqJ0OBwOkJZQ0QSfTv8qkPJr790/7DZ.Y5VuFHG', 'admin', 'admin', 'admin', '+79999999999', 'admin@mail.com', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Payment_method`
--
ALTER TABLE `Payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Индексы таблицы `Request`
--
ALTER TABLE `Request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_request_user` (`user_id`),
  ADD KEY `fk_request_service` (`service_id`),
  ADD KEY `fk_request_status` (`status_id`),
  ADD KEY `fk_request_payment` (`payment_method_id`);

--
-- Индексы таблицы `Request_status`
--
ALTER TABLE `Request_status`
  ADD PRIMARY KEY (`request_status_id`);

--
-- Индексы таблицы `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review_user` (`user_id`),
  ADD KEY `fk_review_request` (`request_id`);

--
-- Индексы таблицы `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`service_id`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `UNIQUE` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Payment_method`
--
ALTER TABLE `Payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Request`
--
ALTER TABLE `Request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Request_status`
--
ALTER TABLE `Request_status`
  MODIFY `request_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Review`
--
ALTER TABLE `Review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Service`
--
ALTER TABLE `Service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Request`
--
ALTER TABLE `Request`
  ADD CONSTRAINT `fk_request_payment` FOREIGN KEY (`payment_method_id`) REFERENCES `Payment_method` (`payment_method_id`),
  ADD CONSTRAINT `fk_request_service` FOREIGN KEY (`service_id`) REFERENCES `Service` (`service_id`),
  ADD CONSTRAINT `fk_request_status` FOREIGN KEY (`status_id`) REFERENCES `Request_status` (`request_status_id`),
  ADD CONSTRAINT `fk_request_user` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `fk_review_request` FOREIGN KEY (`request_id`) REFERENCES `Request` (`request_id`),
  ADD CONSTRAINT `fk_review_user` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
