-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 18 2017 г., 17:46
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `trade`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `title`, `slug`) VALUES
(1, NULL, 'gadgets 1', 'gadgets-1'),
(2, 1, 'Desktops', 'desktops'),
(3, 1, 'Laptops', 'laptops'),
(4, 1, 'Tablets', 'tablets'),
(5, 1, 'Notebooks', 'notebooks'),
(6, 1, 'Smartphones', 'smartphones');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `product_id`) VALUES
(1, 4),
(2, 7),
(4, 8),
(5, 9),
(3, 10),
(6, 11),
(7, 12),
(8, 13),
(9, 14),
(10, 15),
(11, 16),
(12, 17);

-- --------------------------------------------------------

--
-- Структура таблицы `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `wmid_or_merchant` varchar(25) DEFAULT NULL,
  `wallet` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `method`
--

INSERT INTO `method` (`id`, `title`, `wmid_or_merchant`, `wallet`) VALUES
(1, 'Webmoney', '', 'Z119655043982'),
(2, 'Payeer', '231223308', '-'),
(3, 'AdvCash', '', '-'),
(4, 'Blockchain', '', '-'),
(5, 'PayPal', '', '-'),
(6, 'WalletOne', '', '-'),
(7, 'Perfect Money', '', '-'),
(8, 'Interkassa', '', '-'),
(9, 'Yandex money', '', '-'),
(10, 'Qiwi', '', '-'),
(11, 'OKpay', '', '-'),
(12, 'btc-e', '', '-');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1498064693),
('m130524_201442_init', 1498064697),
('m141123_221351_shop', 1498064698);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `news_title` varchar(30) NOT NULL,
  `news_text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`newsID`, `news_title`, `news_text`) VALUES
(1, 'Start', 'This market starts 11.07.2017'),
(2, 'Updated backend', 'more functions were added to this site(comments,filters,online payment, extended personal cabinet)');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `customer_type` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'guest',
  `surname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(39) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paysystem` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `created_at`, `updated_at`, `customer_type`, `surname`, `name`, `country`, `region`, `city`, `address`, `zip_code`, `phone`, `email`, `paysystem`, `wallet`, `notes`, `status`) VALUES
(10, 1507960423, 1507960423, 'user', 'Admin Surname', 'Admin Name', 'Ukraine', 'Kharkiv', 'Liubotyn', 'sl122455', '1112111', '+38xxxxxxxxxxx', 'an128z56@gmail.com', 'Pay to courier', '', 'fast shipping', 'New');

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `title`, `price`, `product_id`, `quantity`) VALUES
(6, 10, 'iMac', '147.6200', 4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `order_items_attribute`
--

CREATE TABLE `order_items_attribute` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `attr_title` varchar(50) DEFAULT NULL,
  `attr_value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `order_items_attribute`
--

INSERT INTO `order_items_attribute` (`id`, `item_id`, `attr_title`, `attr_value`) VALUES
(30, 6, 'color', 'blue'),
(31, 6, 'model', 'iMac1');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `instore` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `slug`, `description`, `category_id`, `price`, `instore`) VALUES
(4, 'iMac', 'imac', 'Just when you thought iMac had everything, now there´s even more. More powerful Intel Core 2 Duo processors. And more memory standard. Combine this with Mac OS X Leopard and iLife ´08, and it´s more all-in-one than ever. iMac packs amazing performance into a stunningly slim space.', 3, '122.0000', 100),
(7, 'MacBook', 'macbook', 'Intel Core 2 Duo processor Powered by an Intel Core 2 Duo processor at speeds up to 2.1..', 5, '602.0000', 200),
(8, 'MacBook Air', 'macbook-air', 'MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don’t lose..', 5, '1202.0000', 100),
(9, 'Samsung Galaxy Tab 10.1', 'samsung-galaxy-tab-101', 'Samsung Galaxy Tab 10.1, is the world’s thinnest tablet, measuring 8.6 mm thickness, runnin..', 4, '241.0000', 200),
(10, 'Samsung SyncMaster 941BW', 'samsung-syncmaster-941bw', 'Imagine the advantages of going big without slowing down. The big 19\" 941BW monitor combines..', 2, '242.0000', 50),
(11, 'Sony VAIO', 'sony-vaio', 'Unprecedented power. The next generation of processing technology has arrived. Built into the new..', 5, '1202.0000', 27),
(12, 'HTC Touch HD', 'htc-touch-hd', 'HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high d', 4, '122.0000', 200),
(13, 'iPhone', 'iphone', 'iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a nam.', 6, '123.0000', 100),
(14, 'Palm Treo Pro', 'palm-treo-pro', 'Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to b..', 6, '337.0000', 200),
(15, 'iPod Classic', 'ipod-classic', 'More room to move. With 80GB or 160GB of storage and up to 40 hours of battery l..', 4, '122.0000', 140),
(16, 'iPod Nano', 'ipod-nano', 'Video in your pocket. Its the small iPod with one very big idea: video. The worlds most..', 4, '122.0000', 220),
(17, 'Apple cinema 30', 'apple-cinema-30', 'Monitor', 2, '200.0000', 300);

-- --------------------------------------------------------

--
-- Структура таблицы `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attr_title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attr_title`) VALUES
(1, 4, 'color'),
(2, 4, 'model'),
(3, 7, 'model'),
(4, 8, 'model'),
(5, 9, 'color'),
(6, 11, 'model'),
(7, 11, 'color'),
(8, 13, 'model');

-- --------------------------------------------------------

--
-- Структура таблицы `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  `price_coef` double NOT NULL DEFAULT '1',
  `quantity_percent` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `attr_id`, `value`, `price_coef`, `quantity_percent`) VALUES
(4, 1, 'blue', 1.1, 20),
(5, 1, 'green', 1, 20),
(13, 1, 'gray', 1, 0),
(14, 1, 'silver', 1, 10),
(15, 2, 'iMac1', 1, 30),
(16, 2, 'iMac2', 1, 70),
(18, 1, 'red', 1.2, 20),
(21, 1, 'yellow', 1.5, 10),
(22, 1, 'royal blue', 1.4, 10),
(23, 1, 'orange', 1, 10),
(24, 3, 'MacBook1', 1, 50),
(25, 3, 'MacBook2', 1.2, 30),
(26, 3, 'MacBook3', 1.5, 20),
(27, 4, 'MacBookAir1', 1, 50),
(28, 4, 'MacBookAir2', 1.1, 50),
(29, 5, 'grey', 1, 50),
(30, 5, 'black', 1, 50),
(31, 6, 'vayo1', 1, 25),
(32, 6, 'vayo2', 1, 25),
(33, 6, 'vayo3', 1.2, 25),
(34, 6, 'vayo4', 1.5, 25),
(35, 7, 'white', 1, 25),
(36, 7, 'grey', 1, 50),
(37, 7, 'black', 1, 25),
(38, 8, 'iphone1', 1, 25),
(39, 8, 'iphone2', 1, 25),
(40, 8, 'iphone3', 1.2, 20),
(41, 8, 'iphone4', 1.5, 20),
(42, 8, 'iphone5', 2, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `product_feedback`
--

CREATE TABLE `product_feedback` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_feedback`
--

INSERT INTO `product_feedback` (`id`, `product_id`, `id_user`, `comment`) VALUES
(20, 4, 'admin', 'Helpful,reliable!!!'),
(21, 4, 'abk', 'Very good product'),
(22, 7, 'admin', 'Nice notebook'),
(23, 11, 'admin', 'Thanks for very good device');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` smallint(6) NOT NULL DEFAULT '15',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `surname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(39) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`, `surname`, `name`, `country`, `region`, `city`, `address`, `zip_code`, `phone`) VALUES
(1, 'admin', '3xvqbVApPyEf88pbdZTp1fDvxm3k0v72', '$2y$13$aokytNMhilBo8SW0GUfc1Omyh/jbyhKBygNHcWrC77N/W/kju.yO6', NULL, 'an128z56@gmail.com', 10, 20, 1498117103, 1507735673, 'Admin Surname', 'Admin Name', 'Ukraine', 'Kharkiv', 'Liubotyn', 'sl122455', '1112111', '+38xxxxxxxxxxx'),
(3, 'abk', 'avcY0Y2-FHXpYnTCxNs_NssB9-Ds42ff', '$2y$13$1iZe82UW6ytb7v/3j7/3B.G6Nnqe4TdqTpkWZzCjWrbq4o2yFr48K', NULL, 'semen@gmail.com', 10, 15, 1506787233, 1507743937, 'Smolyarchuk', 'Semen', 'Ukraine', 'Kiev', 'Vasylkiv', 'khreschatic 35456', '22222222', '+38067xxxxxxx');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-category-parent_id-category-id` (`parent_id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-image-product_id-product_id` (`product_id`);

--
-- Индексы таблицы `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`),
  ADD KEY `news_title` (`news_title`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-order_item-order_id-order-id` (`order_id`),
  ADD KEY `fk-order_item-product_id-product-id` (`product_id`);

--
-- Индексы таблицы `order_items_attribute`
--
ALTER TABLE `order_items_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-product-category_id-category_id` (`category_id`);

--
-- Индексы таблицы `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attr_id` (`attr_id`);

--
-- Индексы таблицы `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `method`
--
ALTER TABLE `method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `order_items_attribute`
--
ALTER TABLE `order_items_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT для таблицы `product_feedback`
--
ALTER TABLE `product_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk-category-parent_id-category-id` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk-image-product_id-product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk-order_item-order_id-order-id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-order_item-product_id-product-id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `order_items_attribute`
--
ALTER TABLE `order_items_attribute`
  ADD CONSTRAINT `order_items_attribute_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `order_item` (`id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk-product-category_id-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD CONSTRAINT `product_attribute_value_ibfk_1` FOREIGN KEY (`attr_id`) REFERENCES `product_attributes` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD CONSTRAINT `product_feedback_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
