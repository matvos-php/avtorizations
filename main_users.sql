-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 17 2024 г., 09:23
-- Версия сервера: 5.7.39
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `main_users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application_driver`
--

CREATE TABLE `application_driver` (
  `id_application` int(11) NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_car` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `driving_age` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application_driver`
--

INSERT INTO `application_driver` (`id_application`, `surname`, `name`, `patronymic`, `phone`, `brand_car`, `driving_age`, `license`, `id_user`, `status`) VALUES
(6, 'Гринцев', 'Валерий', 'Андреевич', '+7 (904) 994-05-12', 'mers', '2', '23-52 352352', 14, 2),
(7, 'Литвиненко', 'Игорь', 'Павлович', '+7 (800) 555-35-35', 'mers', '2', '23-52 352352', 11, 2),
(8, 'Литвиненко', 'Игорь', 'Павлович', '+7 (800) 555-35-35', 'mers', '5', '23-52 352352', 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id_car` int(11) NOT NULL,
  `gov_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_car` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id_car`, `gov_number`, `brand`, `color`, `type_car`) VALUES
(1, 'О222КА', 'Mercedess s63', 'Серый', 'Седан'),
(4, 'asd', 'asd', 'asd', 'asdasd');

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `id_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id_message`, `id_user`, `message`, `time`, `id_order`) VALUES
(180, 14, 'Ghbd', '2024-05-15 13:55:19', 30),
(181, 11, 'Ye ghbd', '2024-05-15 13:55:24', 30),
(182, 14, 'asdasd', '2024-05-15 13:55:33', 30),
(183, 14, 'f', '2024-05-15 18:42:29', 30),
(184, 1, 'Ацу', '2024-05-16 22:37:23', 31),
(185, 11, 'Да?', '2024-05-16 22:39:36', 31),
(186, 11, 'Еду уже', '2024-05-16 22:39:39', 31),
(187, 11, 'Я приехал!', '2024-05-17 00:42:17', 33),
(188, 10, 'Уже выхожу.', '2024-05-17 00:45:09', 33);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_driver` int(11) DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_come` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_order` datetime DEFAULT NULL,
  `date_confirm_order` datetime(6) DEFAULT NULL,
  `date_complete_order` datetime(6) DEFAULT NULL,
  `id_tarif` int(11) DEFAULT '0',
  `id_status` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_client`, `id_driver`, `client_name`, `client_phone`, `address_out`, `address_come`, `date_order`, `date_confirm_order`, `date_complete_order`, `id_tarif`, `id_status`, `comment`) VALUES
(30, 1, 14, 'Игорь', '+7 (800) 555-35-35', 'Белово, пгт Инской, ул Друзя, д. 2', 'Белово, пер Цинкзаводской, д. 1', '2024-05-15 13:47:17', '2024-05-15 13:50:17.000000', '2024-05-16 16:35:12.000000', 6, 3, 'БЫстро пажэ'),
(31, 1, 11, 'Игорь', '+7 (800) 555-35-35', 'Белово, пгт Инской, ул Друзя, д. 2', 'Белово, пгт Инской, ул Правды, д. 3', '2024-05-15 13:57:15', '2024-05-15 13:57:39.000000', '2024-05-15 17:25:47.000000', 7, 7, 'Куку'),
(32, 1, 11, 'Игорь', '+7 (800) 555-35-35', 'Белово, пгт Инской, ул Друзя, д. 2', 'Белово, пгт Инской, ул Правды, д. 3', '2024-05-15 13:57:15', '2024-05-15 13:57:39.000000', '2024-05-16 17:25:47.000000', 7, 7, 'Куку'),
(33, 10, 11, 'Игорь', '+7 (800) 555-35-35', 'Белово, пгт Инской, ул Друзя, д. 2', 'Белово, пгт Инской, ул Правды, д. 3', '2024-05-15 13:57:15', '2024-05-15 13:57:39.000000', '2024-05-16 17:25:47.000000', 7, 4, 'Куку');

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id_rating`, `rating`, `id_user`) VALUES
(7, 3, 11),
(8, 4, 11),
(9, 5, 11),
(10, 1, 11),
(11, 4, 11),
(12, 4, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'Администратор'),
(2, 'Водитель'),
(3, 'Клиент');

-- --------------------------------------------------------

--
-- Структура таблицы `status_order`
--

CREATE TABLE `status_order` (
  `id_status` int(11) NOT NULL,
  `status_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status_order`
--

INSERT INTO `status_order` (`id_status`, `status_name`, `status_description`, `status_img`, `color`) VALUES
(1, 'Отсутствует', 'У вас сейчас нет заказа! Закажите такси во вкладке Оформить заказ.', 'offline.gif', '255, 0, 0'),
(2, 'Поиск водителя...', 'Ваш заказ оформлен, ожидайте пока его примет водитель.', 'search.gif', '251, 255, 0'),
(3, 'Заказ принят', 'Ваш заказ принял водитель, ожидайте его приезда!', 'online.gif', '9, 255, 0'),
(4, 'Водитель прибыл', 'Водитель прибыл на указанный адрес.', 'driver_over.gif', '25, 255, 136'),
(5, 'В пути', 'Вы в пути с водителем до указанного вами адреса.', 'drive.gif', '167, 255, 25'),
(6, 'Ожидание', 'Водитель ожидает вас!', 'expectation.gif', '255, 234, 46'),
(7, 'Завершен', 'Вы прибыли  в пункт назначения, оцените работу водителя!', NULL, '127, 84, 255');

-- --------------------------------------------------------

--
-- Структура таблицы `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `tarif_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif_cost` int(11) NOT NULL,
  `tarif_img` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif_definition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `tarif_name`, `tarif_cost`, `tarif_img`, `tarif_definition`) VALUES
(6, 'Эконом', 149, 'eco.jpg', 'Самый выгодный тариф для выполнения заказов при использовании сервиса такси «Драйвер».'),
(7, 'Бизнес', 449, 'business.jpg', 'Бизнес-класс. Если спешите на работу утром, вы точно все успеете, даже посидеть за чашкой кофе.'),
(8, 'Комфорт', 299, 'comfort.jpg', 'Удобство и приятная атмосфера, создаем специально для вас.'),
(9, 'Премиум', 789, 'premium.jpg', 'Премиальные автомобили для вас, комфорт и удобства на высшем уровне.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL,
  `mail` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_car` int(11) DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL,
  `id_uslug` int(11) DEFAULT NULL,
  `id_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `surname`, `name`, `patronymic`, `phone`, `id_role`, `mail`, `img`, `gallery`, `id_car`, `id_tarif`, `id_uslug`, `id_rating`) VALUES
(1, '123', '1234', 'Шипачев', 'Матвей', 'Александрович', '+7 (899) 920-52-05', 1, '1234', '1.jpg', '', NULL, NULL, NULL, NULL),
(10, 'zxcc', 'zxc', 'Кравцов', 'Сергей', 'Евгеньевич', '+7 (899) 933-32-10', 3, 'zxc', '10.png', NULL, NULL, NULL, NULL, NULL),
(11, '11', '22', 'Литвиненко', 'Игорь', 'Павлович', '+7 (800) 555-35-35', 2, '54321', NULL, NULL, 4, 6, 1, NULL),
(14, 'qq', 'qqq', 'Гринцев', 'Валерий', 'Андреевич', '+7 (904) 994-05-12', 2, 'qqq', '14.jpg', NULL, 1, 8, 1, NULL),
(15, '235', '235', '2352', '5323', '235', '+7 (235) 235-23-52', 3, '235235@erwrwe', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `uslugs`
--

CREATE TABLE `uslugs` (
  `id_uslug` int(11) NOT NULL,
  `name_uslug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `uslugs`
--

INSERT INTO `uslugs` (`id_uslug`, `name_uslug`) VALUES
(1, 'Доставка'),
(3, 'Грузоперевозка');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application_driver`
--
ALTER TABLE `application_driver`
  ADD PRIMARY KEY (`id_application`) USING BTREE,
  ADD KEY `FK_application_driver_users` (`id_user`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_car`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `FK_chat_orders` (`id_order`),
  ADD KEY `FK_chat_users` (`id_user`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK_orders_tarif` (`id_tarif`),
  ADD KEY `FK_orders_clients` (`id_client`),
  ADD KEY `FK_orders_status_order` (`id_status`),
  ADD KEY `FK_orders_users_2` (`id_driver`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `FK_rating_users` (`id_user`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `status_order`
--
ALTER TABLE `status_order`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_users_roles` (`id_role`),
  ADD KEY `FK_users_cars` (`id_car`),
  ADD KEY `FK_users_tarif` (`id_tarif`),
  ADD KEY `FK_users_uslugs` (`id_uslug`),
  ADD KEY `FK_users_rating` (`id_rating`);

--
-- Индексы таблицы `uslugs`
--
ALTER TABLE `uslugs`
  ADD PRIMARY KEY (`id_uslug`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application_driver`
--
ALTER TABLE `application_driver`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `status_order`
--
ALTER TABLE `status_order`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `uslugs`
--
ALTER TABLE `uslugs`
  MODIFY `id_uslug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application_driver`
--
ALTER TABLE `application_driver`
  ADD CONSTRAINT `FK_application_driver_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_chat_orders` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_chat_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_status_order` FOREIGN KEY (`id_status`) REFERENCES `status_order` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orders_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orders_users` FOREIGN KEY (`id_client`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orders_users_2` FOREIGN KEY (`id_driver`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_rating_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_cars` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id_car`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_users_rating` FOREIGN KEY (`id_rating`) REFERENCES `rating` (`id_rating`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_users_roles` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_users_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_users_uslugs` FOREIGN KEY (`id_uslug`) REFERENCES `uslugs` (`id_uslug`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
