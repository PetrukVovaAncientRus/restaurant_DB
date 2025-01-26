-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 26 2025 г., 22:58
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lab3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `bank_id` int(11) UNSIGNED NOT NULL,
  `amount_of_chefs` int(11) NOT NULL,
  `amount_of_waiters` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `bank_id`, `amount_of_chefs`, `amount_of_waiters`) VALUES
(1, 1, 5, 10),
(2, 2, 4, 8),
(3, 3, 6, 12),
(4, 4, 3, 7),
(5, 5, 5, 15),
(6, 6, 4, 9),
(7, 7, 6, 14),
(8, 8, 3, 6),
(9, 9, 5, 11),
(10, 10, 4, 10),
(13, 3, 4, 0),
(14, 10, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `bank`
--

CREATE TABLE `bank` (
  `id` int(11) UNSIGNED NOT NULL,
  `money_id` int(11) UNSIGNED NOT NULL,
  `amount_of_all_money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `bank`
--

INSERT INTO `bank` (`id`, `money_id`, `amount_of_all_money`) VALUES
(1, 1, 12312),
(2, 4, 13454),
(3, 3, 13445),
(4, 6, 11334),
(5, 5, 14954),
(6, 10, 19373),
(7, 7, 14345),
(8, 8, 17324),
(9, 9, 20484),
(10, 2, 16430),
(11, 3, 17000);

-- --------------------------------------------------------

--
-- Структура таблицы `chef`
--

CREATE TABLE `chef` (
  `id` int(11) UNSIGNED NOT NULL,
  `dishes_id` int(11) UNSIGNED NOT NULL,
  `food_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `chef`
--

INSERT INTO `chef` (`id`, `dishes_id`, `food_id`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 5),
(4, 4, 7),
(5, 5, 1),
(6, 6, 6),
(7, 7, 8),
(8, 8, 9),
(9, 9, 4),
(10, 10, 10),
(11, 11, 11),
(12, 12, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `name`) VALUES
(1, 'Alice Johnson'),
(2, 'Bob Smith'),
(3, 'Charlie Brown'),
(4, 'Diana Miller'),
(5, 'Evan Davis'),
(6, 'Fiona Wilson'),
(7, 'George White'),
(8, 'Hannah Green'),
(9, 'Ivan Black'),
(10, 'Julia Gray'),
(11, 'fgafdg');

-- --------------------------------------------------------

--
-- Структура таблицы `dish`
--

CREATE TABLE `dish` (
  `id` int(11) UNSIGNED NOT NULL,
  `from_what_food` text NOT NULL,
  `name` varchar(52) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `dish`
--

INSERT INTO `dish` (`id`, `from_what_food`, `name`, `price`) VALUES
(1, 'Chicken, Spices, Rice', 'Chicken Biryani', 250),
(2, 'Fish, Lemon, Garlic', 'Grilled Fish', 300),
(3, 'Beef, Cheese, Bread', 'Beef Burger', 150),
(4, 'Flour, Cheese, Tomato', 'Margherita Pizza', 200),
(5, 'Pasta, Shrimp, Cream', 'Seafood Pasta', 280),
(6, 'Milk, Eggs, Sugar', 'Vanilla Pudding', 120),
(7, 'Vegetables, Tofu, Soy Sauce', 'Stir-Fried Vegetables', 180),
(8, 'Bread, Ham, Cheese', 'Ham Sandwich', 140),
(9, 'Potatoes, Butter, Cheese', 'Mashed Potatoes', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) UNSIGNED NOT NULL,
  `cooked_id` int(11) UNSIGNED NOT NULL,
  `dish_id_Arr` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`id`, `cooked_id`, `dish_id_Arr`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `food`
--

CREATE TABLE `food` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `food`
--

INSERT INTO `food` (`id`, `type`, `amount`) VALUES
(1, 'Vegetables', 100),
(2, 'Fruits', 80),
(3, 'Meat', 200),
(4, 'Seafood', 150),
(5, 'Dairy Products', 120),
(6, 'Grains', 300),
(7, 'Beverages', 250),
(8, 'Spices', 50),
(9, 'Bakery Items', 180),
(10, 'Condiments', 60);

-- --------------------------------------------------------

--
-- Структура таблицы `money`
--

CREATE TABLE `money` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `money`
--

INSERT INTO `money` (`id`, `client_id`, `amount`) VALUES
(1, 1, 500),
(2, 2, 650),
(3, 3, 700),
(4, 4, 560),
(5, 5, 870),
(6, 6, 300),
(7, 7, 450),
(8, 8, 600),
(9, 9, 1010),
(10, 10, 1100);

-- --------------------------------------------------------

--
-- Структура таблицы `ordered`
--

CREATE TABLE `ordered` (
  `id` int(11) UNSIGNED NOT NULL,
  `dish_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `ordered`
--

INSERT INTO `ordered` (`id`, `dish_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `order_`
--

CREATE TABLE `order_` (
  `id` int(11) UNSIGNED NOT NULL,
  `ordered_dishes` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_`
--

INSERT INTO `order_` (`id`, `ordered_dishes`, `client_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `salary_chef`
--

CREATE TABLE `salary_chef` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `chef_id` int(11) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `salary_chef`
--

INSERT INTO `salary_chef` (`id`, `admin_id`, `chef_id`, `amount`) VALUES
(1, 1, 1, 3000),
(2, 2, 2, 3200),
(3, 3, 3, 3500),
(4, 4, 4, 3300),
(5, 5, 5, 3400),
(6, 6, 6, 3100),
(7, 7, 7, 3000),
(8, 8, 8, 3300),
(9, 9, 9, 3600),
(10, 10, 10, 3400);

-- --------------------------------------------------------

--
-- Структура таблицы `salary_waiter`
--

CREATE TABLE `salary_waiter` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `waiter_id` int(11) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `salary_waiter`
--

INSERT INTO `salary_waiter` (`id`, `admin_id`, `waiter_id`, `amount`) VALUES
(1, 1, 1, 1000),
(2, 1, 2, 1200),
(3, 2, 3, 1500),
(4, 2, 4, 1300),
(5, 3, 5, 1400),
(6, 3, 6, 1100),
(7, 4, 7, 1000),
(8, 4, 8, 1300),
(9, 5, 9, 1600),
(10, 5, 10, 1400);

-- --------------------------------------------------------

--
-- Структура таблицы `waiter`
--

CREATE TABLE `waiter` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `dishes_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `waiter`
--

INSERT INTO `waiter` (`id`, `order_id`, `dishes_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `waiter_chef`
--

CREATE TABLE `waiter_chef` (
  `id` int(11) UNSIGNED NOT NULL,
  `waiter_id` int(11) UNSIGNED NOT NULL,
  `chef_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `waiter_chef`
--

INSERT INTO `waiter_chef` (`id`, `waiter_id`, `chef_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Индексы таблицы `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `money_id` (`money_id`);

--
-- Индексы таблицы `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `dishes_id` (`dishes_id`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dish_id_Arr_2` (`dish_id_Arr`),
  ADD KEY `dish_id_Arr` (`dish_id_Arr`);

--
-- Индексы таблицы `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Индексы таблицы `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_`
--
ALTER TABLE `order_`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `ordered_dishes` (`ordered_dishes`);

--
-- Индексы таблицы `salary_chef`
--
ALTER TABLE `salary_chef`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `chef_id` (`chef_id`);

--
-- Индексы таблицы `salary_waiter`
--
ALTER TABLE `salary_waiter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waiter_id` (`waiter_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Индексы таблицы `waiter`
--
ALTER TABLE `waiter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `dishes_id` (`dishes_id`);

--
-- Индексы таблицы `waiter_chef`
--
ALTER TABLE `waiter_chef`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waiter_id` (`waiter_id`),
  ADD KEY `chef_id` (`chef_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `chef`
--
ALTER TABLE `chef`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `money`
--
ALTER TABLE `money`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `ordered`
--
ALTER TABLE `ordered`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `order_`
--
ALTER TABLE `order_`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `salary_chef`
--
ALTER TABLE `salary_chef`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `salary_waiter`
--
ALTER TABLE `salary_waiter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `waiter`
--
ALTER TABLE `waiter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `waiter_chef`
--
ALTER TABLE `waiter_chef`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `dish_ibfk_1` FOREIGN KEY (`id`) REFERENCES `dishes` (`dish_id_Arr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `waiter` (`dishes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`id`) REFERENCES `chef` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `money`
--
ALTER TABLE `money`
  ADD CONSTRAINT `money_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bank` (`money_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `money_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ordered`
--
ALTER TABLE `ordered`
  ADD CONSTRAINT `ordered_ibfk_1` FOREIGN KEY (`id`) REFERENCES `order_` (`ordered_dishes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_`
--
ALTER TABLE `order_`
  ADD CONSTRAINT `order__ibfk_1` FOREIGN KEY (`id`) REFERENCES `waiter` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order__ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `salary_chef`
--
ALTER TABLE `salary_chef`
  ADD CONSTRAINT `salary_chef_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_chef_ibfk_2` FOREIGN KEY (`chef_id`) REFERENCES `chef` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `salary_waiter`
--
ALTER TABLE `salary_waiter`
  ADD CONSTRAINT `salary_waiter_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_waiter_ibfk_2` FOREIGN KEY (`waiter_id`) REFERENCES `waiter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `waiter_chef`
--
ALTER TABLE `waiter_chef`
  ADD CONSTRAINT `waiter_chef_ibfk_1` FOREIGN KEY (`waiter_id`) REFERENCES `waiter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waiter_chef_ibfk_2` FOREIGN KEY (`chef_id`) REFERENCES `chef` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
