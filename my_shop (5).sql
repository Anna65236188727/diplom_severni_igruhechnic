-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 23 2024 г., 17:54
-- Версия сервера: 8.2.0
-- Версия PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_general_ci,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `link`, `image`, `logo_path`, `description`, `date`) VALUES
(1, 'Мастера из областной столицы продолжают традиции...', 'https://xn--80adde7arb.xn--p1ai/news/economy/74111/?ysclid=lp2evjjuai457146932', 'about_write1.png', 'Vologda_rf.png', 'Мы начинали свое дело с открытия детского магазина, для которого...', '2007-11-20'),
(2, 'Евгений и Валентина Коменковы: «Верим, что наши...', 'https://marketvologda.ru/journal/detail/evgeniy-i-valentina-komenkovy-verim-chto-nashi-igrushki-lyubimy-i-imenno-o-nikh-budut-vspominat-vyro/', 'about_write2.png', 'made_in_Vologda.png', 'Супруги Коменковы пять лет назад создали мастерскую по изготовлени...', '2023-10-26'),
(3, 'На выставке-форуме «Россия» в Москве представлена продукц...', 'https://vologda-oblast.ru/novosti/produktsiya_vologodskikh_proizvoditeley_predstavlena_na_vystavke_forume_rossiya_v_moskve/?sphrase_id=19651491', 'about_write3.png', 'government_VO.png', 'На ВДНХ в павильоне №75 работает новое пространство «Универмаг». Его...', '2023-11-20'),
(4, 'Помните свою любимую детскую игрушку? Я да. Это...', 'https://vk.com/o.a.kuvshinnikov?w=wall-24860838_319681', 'about_write4.png', 'Kuvshinnikov.png', 'В новом выпуске видеоблога расскажу о том, как я вместе с мастерами...', '2021-04-27');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fio_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `house_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apartment` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `city`, `fio_name`, `street`, `house_number`, `apartment`, `comment`, `price`) VALUES
(91, 'dd', 'd@df', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 450),
(111, 'Карина Белова', 'kar@gmail.com', '1111111', 'вол', 'апр', 'пп', 'пп', 'п', 'п', 1300),
(117, 'Иван', '2@mail.com', '9999999999', 'Вологда', 'Иванов Иван Иванович', '2', '2', '2', '', 6500);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_product` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `materials` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `weight` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image_3` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image_4` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image_5` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `collection_name` enum('Техника','Новогодняя коллекция','Развивающие игрушки') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name_product`, `materials`, `size`, `weight`, `price`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `description`, `collection_name`, `quantity`) VALUES
(2, 'Деревянная машинка \"Почта\"', 'дерево, масло', '12*5,5*8 см', '170г', 850.00, 'pochta1.png', 'pochta2.png', 'pochta3.png', '', '', 'А какая машинка возит радостные, не очень радостные, весёлые послания или посылки, бандероли?\r\n\r\nКонечно, ПОЧТОВОЗ. Мы сделали его ярким, удобным и очень быстрым. Так что пишите письма - мы обязательно доставим адресатам.', 'Техника', 3),
(3, 'Деревянная машинка \"Малыш\"', 'бук, орех', '6*7*7,5 см', '110 г', 450.00, 'malih1.png', 'malih2.png', 'malih3.png', 'malih4.png', '', 'Яркая машинка с гладкими краями станет украшением игрушечного гаража.\r\n\r\nЕё удобно держать в руке, а благодаря форме с отверстиями даже маленькая ручка сможет ухватиться за новое авто.\r\n\r\nМашинка может использоваться для игр дома, в детских садах и на уроках в детских садах', 'Техника', 6),
(4, 'Деревянная игрушка Трактор с прицепом \"Лес\"', 'дерево', '16*6*9 см', '240 г', 950.00, 'forest1.png', 'forest2.png', 'forest3.png', 'forest4.png', '', 'Трудолюбивый Трактор обзавёлся грузом. Теперь он не только тянет машинки на буксире, подвозит других игрушек, но и сам везёт брёвна для строительства новых зданий в Царстве Игрушек.', 'Техника', 12),
(6, 'Деревянная игрушка каталка \"Жираф\"', 'бук, орех, берёза', '18*11,5*6 см', '', 950.00, 'giraffe1.png', 'giraffe2.png', 'giraffe3.png', '', '', 'Каталка - незаменимый помощник в играх и на занятиях в детских садах, студиях раннего развития.\r\n\r\nЖирафик может:\r\n-ездить от задания к заданию;\r\n-становиться переходящей наградой;\r\n-стать подвижным помощником на уроках.\r\n\r\nКроме того, игры с каталкой: развивают мелкую моторику, координацию и смекалку.', 'Развивающие игрушки', 18),
(5, 'Набор деревянных машинок \"Техника\"', 'бук, берёза, грецкий орех, натуральное масло', 'размер каждой машинки 11-12 см', '', 3750.00, 'technic1.png', 'technic2.png', 'technic3.png', 'technic4.png', '', 'Очень полезный набор.\r\n\r\nЕщё какой полезный! Ведь в нём целых ПЯТЬ машинок!\r\n\r\nБез этого спецтранспорта не обойтись, если вы задумали большую стройку или организовали прибыльную ферму.\r\n\r\nА сколько игрушек можно сделать водителями! Безработными точно никто не останется.', 'Техника', 15),
(7, 'Деревянная игрушка каталка \"Уточка\"', 'берёза, бук, грецкий орех, натуральное масло', '10*5,5*10 см', '140г', 850.00, 'duck1.png', 'duck2.png', 'duck3.png', 'duck4.png', '', 'Уточка-каталка\n\nУдивительный ребёнок!\nТолько вышел из пелёнок\nМожет плавать и нырять,\nКак его родная мать!\n\nЗабавная Уточка из разных пород дерева понравится и девочкам, и мальчикам.\n\nС Уточкой весело и очень удобно играть. Её размеры позволяют брать игрушку с собой в дорогу, на приём в поликлинику.\n\nКаталки - это не только познавательно, но и удобно.', 'Развивающие игрушки', 3),
(8, 'Деревянная игрушка каталка \"Дракончик\"', 'бук, грецкий орех, клён, натуральное масло', '10*9*3,5 см', '', 850.00, 'dragon_catalka1.png', 'dragon_catalka2.png', 'dragon_catalka3.png', '', '', 'Добродушный Дракончик-каталка.\r\n\r\nМилый Дракоша на колёсиках сделан из разных пород дерева: он приятный на ощупь и очень симпатичный внешне.\r\n\r\nЭта игрушка станет любимым другом малыша и полезным помощником взрослых в обучающих играх. Например, в обучении чтению: Дракоша катается от буквы к букве и знакомит ребёнка с алфавитом.\r\n\r\nКаталку можно привлекать на занятиях в школах раннего развития, в работе с логопедом и дома.', 'Развивающие игрушки', 4),
(9, 'Игрушка из дерева \"Дракончик\"', 'бук, грецкий орех, клён, натуральное масло', '10*9*3,5 см', '', 650.00, 'dragon1.png', 'dragon2.png', 'dragon3.png', 'dragon4.png', 'dragon5.png', 'НОВИНКА! Братья-дракоши.\r\n\r\nДружные, смешливые, в меру упитанные и очень добродушные!\r\n\r\nИзготовлены из разных пород дерева, гладкие, приятные на ощупь и универсальны для любых игр: от обучающих до коротающих время в очереди в поликлинике.\r\n\r\nДракончиков можно передвигать, поворачивая вправо-влево, можно пересчитывать шипы на гребне, а можно рассказывать сказки и стихи от имени Дракоши.', 'Развивающие игрушки', 6),
(12, 'Деревянная игрушка каталка \"Зайка\"', 'берёза, бук, грецкий орех, натуральное масло', '12*5*11 см', '120г', 950.00, 'bunny1.png', 'bunny2.png', 'bunny3.png', 'bunny4.png', 'bunny5.png', 'Очаровательный Зайка обязательно понравится вашему малышу. Ведь он -маневренный,\r\n-удобный в управлении и ооочень приятный на ощупь.\r\n\r\nА как же иначе, если речь о деревянной игрушке?!\r\n\r\nКаталка подходит для самых маленьких, только-только познающих мир и для деток постарше, которые учатся различать лево - право, понимать, как придать ускорение предмету.', 'Развивающие игрушки', 1),
(175, 'Ёлочная игрушка \"Золотая рыбка\"', 'берёзовая фанера, лак, акриловая краска', '6 см', '', 350.00, 'image 266.png', 'image 267.png', 'image 268.png', '', '', '- Рыбка на ёлке?! Не может быть!  Может! Если Рыбка эта не простая, а волшебная!!  Исполняет желания, аккумулирует позитивную энергию и просто вызывает улыбку от приятных воспоминаний о волшебном празднике из детства.  Золотая Рыбка прекрасно смотрится не только на ёлке, но и на дверце книжного шкафа в детской.', 'Новогодняя коллекция', 18),
(36, 'Ёлочная игрушка \"Зайка\"', 'бук, натуральное масло', '6 см', '', 250.00, 'bunny_christmas1.png', '', '', '', '', 'Зайка, Зайка, где твой дом?\r\n\r\nЁлочная игрушка Зайка придаст сказочности вечнозелёной новогодней красавице.\r\n\r\nНо не спешите убирать Зайчика вместе с другими игрушками! Его можно повесить на дверцу шкафа, чтобы новогодние воспоминания были рядом всегда. Тем более если зайчата актуальны целый 2023 год.', 'Новогодняя коллекция', 2),
(34, 'Ёлочная игрушка \"Избушка\"', 'берёзовая фанера, акриловые краски, лак', '6 см', '', 350.00, 'izba1.png', '', '', '', '', '- Избушка, избушка, стань к лесу задом, а ко мне передом!\r\n\r\n- А может, сможешь вертеться туда-сюда, чтоб никому обидно не было?\r\n\r\nКак же можно, чтобы у Бабы-Яги жилплощади не было?! Нет, эту жилищную проблему мы решили: красивая, яркая, уютная избушка обязательно придётся по душе Яге, Ёлочке и Вам.', 'Новогодняя коллекция', 3),
(35, 'Ёлочная игрушка \"Баба Яга\"', 'берёзовая фанера, акриловые краски, лак', '6 см', '', 350.00, 'babayaga1.png', 'babayaga2.png', 'babayaga3.png', '', '', 'Какой праздник без Бабы-Яги?\r\n\r\nПравильно: НИКАКОЙ! Тем более она у нас ни капли не злая, а добродушная (в душе) и симпатичная... (если присмотреться).\r\n\r\nИ как же идеально она вписывается в общий дизайн ёлки! А ещё она подружится со всеми игрушками и даже присмотрит за тем, чтобы никто не ссорился.\r\n\r\nБаба-Яга здорово помогает рассказать и объяснить детям главных персонажей фольклора.', 'Новогодняя коллекция', 2),
(33, 'Ёлочная игрушка \"Дракончик\"', 'дерево', '6 см', '', 350.00, 'dragon_сhristmas1.png', 'dragon_сhristmas2.png', 'dragon_сhristmas3.png', 'dragon_сhristmas4.png', 'dragon_сhristmas5.png', 'Игрушка не только украсит новогоднюю ёлочку, но и прекрасно впишется в интерьер.\r\n\r\nС милым Дракошей можно играть, повесить на любимый шкафчик с игрушками, повесить на дверь в комнату или положить на письменный стол для привлечения удачи.', 'Новогодняя коллекция', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
