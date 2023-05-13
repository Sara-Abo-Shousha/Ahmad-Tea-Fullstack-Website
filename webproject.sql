-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 10:14 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `cutomer_id` char(255) NOT NULL,
  `Address` char(255) NOT NULL,
  `City` char(255) NOT NULL,
  `Country` char(255) NOT NULL,
  `Zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`cutomer_id`, `Address`, `City`, `Country`, `Zip`) VALUES
('mustafauhoow@gmail.com', 'jaradaleh buidling', 'saida', 'Lebanon', 0),
('someone@gmail.com', 'somewhere', 'saida', 'Lebanon', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(40) NOT NULL,
  `uid` longtext NOT NULL,
  `item_id` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `uid`, `item_id`) VALUES
(20, '1', 21),
(21, '1', 30),
(22, '1', 44),
(23, '1', 40);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_ID` int(11) NOT NULL,
  `Name` char(255) NOT NULL,
  `Price` float NOT NULL,
  `Description` text DEFAULT NULL,
  `Category` char(255) NOT NULL,
  `image_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_ID`, `Name`, `Price`, `Description`, `Category`, `image_file`) VALUES
(19, 'Royal Breakfast Tea', 14, 'Royal Tea for Breakfast time', 'Black Tea', 'Products/1/'),
(20, 'Royal Chai Tea', 12, 'Royal chai tea using black tea', 'Black Tea', 'Products/2/'),
(21, 'Royal Earl Grey', 10, 'Royal Black tea made with earl grey', 'Black Tea', 'Products/3/'),
(22, 'Cinnamon Hazed Black Tea', 8, 'Black to with Cinnamon', 'Black Tea', 'Products/4/'),
(23, 'Green Tea Pure', 3, 'Pure Green Tea with no extra flavors', 'Green Tea', 'Products/5/'),
(30, 'Camomile Lemongrass Infusion', 13.45, 'Camomile & Lemongrass Infusion is a deliciously relaxing herbal tea that soothes with every sip. In this delicately fragrant blend, lemongrass adds an exotic citrus twist to much-loved camomile.\r\n\r\nComforting camomile is the star of this show. Our Tea Masters source finest quality camomile leaf and balance it with exotically fragrant lemongrass. The honey-coloured herbal tea has a satisfying aroma of late summer meadows and zesty citrus. With camomile famed for its soothing properties, you’ll enjoy a relaxing infusion in every cup.', 'Various', 'Products/6/'),
(31, 'Camomile and Honey Calm Infusion', 19.13, '\r\nOur Tea Masters use the finest ingredients to create this harmonious herbal tea blend. Large-cut camomile leaves are joined by silky vanilla and luxurious dried honey pieces that melt into every infusion. Underneath these comforting flavours, a touch of liquorice root and wild fennel add depth and a rounded sweetness. The light sunshine-yellow tea has a mellow flavour and a gorgeous wildflower and natural honey perfume', 'Various', 'Products/7/'),
(32, 'Cardamom Green Tea', 21.55, 'For green tea lovers with a taste for the exotic, our Cardamom Green Tea is a must-try blend. Pairing our signature Chinese green tea with the unique aromatic notes of cardamom, this delicious brew is both comforting and refreshing in equal measure.', 'Green Tea', 'Products/8/'),
(33, 'English Afternoon Black Tea', 13.45, '\r\nOur English Afternoon is an uplifting black tea with a gentle note of bergamot. Its style sits between our robust English Breakfast tea and more floral Earl Grey. As such, it makes the perfect afternoon pick-me-up.\r\n\r\nTo make it, our Tea Masters balance delicate Darjeeling with malty Assam, rich Kenyan and brisk Ceylon teas. This special blend gives our English Afternoon its full yet lively flavour. A little of our signature bergamot flavouring adds an exotic citrusy note.', 'Black Tea', 'Products/10/'),
(34, 'Lemon & Ginger Infusion', 13.45, 'This invigorating Lemon & Ginger Infusion mixes cleansing power with convenience. Sip yourself to a brighter day with this perfectly balanced, revitalising blend of lemon, ginger, apple and hibiscus – all in one handy teabag.\r\n\r\nOften added to hot water for their invigorating properties, lemon and ginger are a classic combination the world over. Our Tea Masters have done the hard work for you with this blend, delivering a warming and uplifting fruit and herbal tea with a kick. Zesty lemon peel, exotic lemongrass and fiery ginger lend their bold flavours, while a base of sweet apple and hibiscus gives a rich backnote. Straw-gold in colour and punchy with fragrant aromas, this is a herbal tea to truly awaken the senses.', 'Various', 'Products/12/'),
(35, ' Lemon & Lime Cold Brew Iced Tea', 13.45, 'With Lemon & Lime Twist being one of our most popular fruity black teas, we had to make a Cold Brew version too. Bringing the zesty zing of lemon and limes to pure Kenyan black tea, this lovely infusion adds a fantastic fruitiness to chilled water. Just add a bag to your H2O and you’re good to go!\r\n\r\nCold Brew teabags make iced tea easier than ever. We’ve used our generations of blending expertise to create a range that’s full of flavour and imagination. Consider your glass of water the canvas, and these teas the colour. Watch the teabags steep and swirl their rich, amber hues and citrusy flavour as they magically ‘cold brew’ in front of you. Unlike standard teabags, each of these blends has been specially designed to infuse with cold water in just five minutes. With no sugar, no sweeteners, and no need for boiling water, they’re the light and bright infusions the whole family can enjoy.', 'Various', 'Products/13/'),
(36, 'Lemon and Mint Cold Brew Iced Tea', 13.45, '\r\nLemon & Mint Cold Brew combines the naturally refreshing flavours of grassy green tea, zesty lemon and sweet mint to deliver a ready-to-brew iced tea. It’s easy-peasy, with no-need for lemon squeezy – just add one teabag to a mug, glass or bottle with cold water. You’ll enjoy a refreshing glass of hydration, infused with a cleansing touch of citrus-mint sunshine.\r\n\r\nOur Cold Brew teabags make iced tea easier than ever. We’ve used our generations of blending expertise to create a range that’s full of flavour and imagination. Consider your glass of water the canvas and these teas the colour. Watch the teabags steep and swirl their sunny hues and fresh flavours into the water as they magically ‘cold brew’ in front of you. Unlike standard teabags, each of these blends has been specially designed to infuse with cold water in just five minutes. With no sugar, no sweeteners, and no need for boiling water, they’re the light and bright infusions the whole family can enjoy', 'Various', 'Products/14/'),
(37, 'Lemon & Turmeric Defence Infusion', 19.13, 'For a cleansing, energising cuppa, our Lemon & Turmeric Defence is your go-to brew. Mixing bling with zing, this blend of golden turmeric, zesty lemongrass and spicy ginger delivers a naturally supportive, invigorating infusion. A cup of this sunny herbal tea is sure to brighten even the dreariest of days.\r\n\r\nOur Tea Masters select only 100% natural ingredients to make this herbal infusion. Fragrant lemongrass and lemon peel give a citrusy-sweet balance to the rich golden turmeric. A member of the ginger family, turmeric root has been used for centuries in cooking and medicine. This earthy, vibrant yellow ‘super-spice’ is high in antioxidants, helping to boost your body’s natural defences. We add ginger to accentuate the warming flavours, then round off the blend with a touch of sweet liquorice and cinnamon. The final infusion is bold yet balanced, with gentle spice and citrus notes.', 'Various', 'Products/15/'),
(38, 'LEMON VITALITY GREEN TEA', 13.45, 'Lemon Vitality combines the soft, grassy flavours of Chinese green tea with an invigorating twist of zesty lemon. This fruity expression offers all the benefits of our much-loved green tea with an energising, citrus lift.\r\n\r\nTo create this revitalising blend, our Tea Masters source fine green teas from China’s Jiangxi, Anhui and Zhejiang provinces. Known as the ‘Golden Triangle’, this area is renowned for the quality of its green tea. We include high-quality Chun Mee in the blend – both silvery tips and leaf fannings – harvested in the early spring for a more delicate, sweet flavour. Chun Mee translates as ‘precious eyebrow’, a name inspired by the curled appearance of the dried tea leaves. With a nuttier taste than most green teas, Chun Mee brings a lovely character to this blend that pairs particularly well with citrus. We add real lemon peel and our unique lemon flavouring to this blend to give it a lovely citrus edge. It accentuates the soft green tea with a zing of refreshing lemon, resulting in a delightfully clean and invigorating brew.', 'Green Tea', 'Products/16/'),
(39, 'Mango & Lychee Green Tea', 13.45, 'Mango & Lychee Green Tea is perfect for green tea lovers looking for a bolder brew. We bring together the exotic flavours of sweet mango, ripe lychee and nutty, grassy Chinese green tea to give you a taste of tropical bliss that helps your stresses gently float away.\r\n\r\nTo create this blend, our Tea Masters start with a base of fine green teas from China’s Jiangxi, Anhui and Zhejiang provinces. This area is known as the ‘Golden Triangle’ for the quality of its green tea production. The blend features Chun Mee, a special green tea with subtly toasty dried grass flavours. Chun Mee brings a lovely character to this infusion, providing the perfect backdrop for sweet mango and exotic lychee. Real pieces of dried mango and lychee bring a burst of sunshine to the delicate green tea, which we intensify with the addition of our unique mango and lychee flavouring. The light-yellow infusion is a wonderful cuppa to wake up to, or equally rejuvenating in the afternoon. With its exotically floral scent of lychees and mango, this is a tea that delights the nose as well as the palate.', 'Green Tea', 'Products/17/'),
(40, 'Mint Mystique Green Tea', 21.55, 'Soothing Chinese green tea and cool, refreshing mint are a timeless match. For those who like their green tea with a little extra oomph, our Mint Mystique is the perfect choice. It’s a brew that both invigorates and calms in one cup, garden-fresh with a clean, invigorating lift.\r\n\r\nTo create this blend, our Tea Masters start with a base of fine green teas from China’s Jiangxi, Anhui and Zhejiang provinces. Known as the ‘Golden Triangle’, this area is renowned for the quality of its green tea production. We include high quality Chun Mee leaf and tips in the blend, a tea prized for it slightly toasted, almost nutty taste. Ours is harvested in the early spring when the tea has a more delicate, sweet flavour. To transform it into our Mint Mystique tea, we add dried spearmint leaf and our signature mint flavouring. The result is a refreshing tea with a yellowy-green colour and unmistakable minty aromas, with its dried grass flavours complemented by a distinctive menthol freshness.', 'Green Tea', 'Products/18/'),
(41, 'Mixed Berry Boost Infusion', 19.13, 'Our Mixed Berry Boost is a true gem of a tea. Tangy berries, sweet apples, zesty hibiscus and fragrant rosehips all shine brightly in this ruby red infusion. A delightfully fruity blend, this herbal tea packs an invigorating punch that gives you a burst of instant berry refreshment.\r\n\r\nTo create this blend, our Tea Masters start with a full-bodied base of hibiscus, apple, rosehips and orange peel. This tangy backdrop builds upon vibrant layers of sweet, sour and citrus. We then add blueberries, blackberries, raspberries and elderberries for a glorious wild berry intensity. To complete the tea, we add natural vitamin B6. Known to boost serotonin levels, it transforms this blushing brew into a brilliant pick-me-up. Put a smile on your face with this fruit and herb tea’s delightfully sweet and sharp character.', 'Fruit', 'Products/19/'),
(42, 'Peach & Passion Fruit Cold Brew Iced Tea', 13.45, 'Our Peach & Passion Fruit Cold Brew is the easy way to keep happily hydrated. We’ve taken one of our most popular teas – Peach and Passion Fruit Flavoured Black Tea – and created this even cooler version. Add a little excitement to chilled water with this popular fruit combination. It makes for a crisp and mellow infusion to leave you feeling refreshed and revived.\r\n\r\nCold Brew blends make iced tea easier than ever. We’ve used our generations of blending expertise to create a range that’s full of flavour and imagination. Consider your glass of water the canvas, and these teas the colour. Watch the teabags steep and swirl their rich chestnut hues and bold black tea flavour as they magically ‘cold brew’ right in front of you. Unlike standard teabags, each of these blends has been specially designed to infuse in cold water in just five minutes. With no sugar, no sweeteners, and no need for boiling water, they’re the light and bright infusions the whole family can enjoy.\r\n', 'Various', 'Products/20/'),
(43, 'Peppermint & Fennel Cleanse Infusion', 19.13, '', 'Various', 'Products/21/'),
(44, 'Raspberry & Pomegranate Green Tea', 13.45, 'Looking for a deliciously fruity brew? Our Raspberry & Pomegranate Green Tea is just the ticket. Blending grassy Chinese green tea with the summery sweetness of raspberry and pomegranate, it makes for a mouth-wateringly fruity infusion.\r\n\r\nOur Tea Masters use top quality green tea for this blend, sourced from China’s Jiangxi, Anhui and Zhejiang provinces. Known as the ‘Golden Triangle’, this area is renowned for the quality of its green tea production. The tea features Chun Mee, a special green tea harvested in the early spring for its delicate dried-grass flavour. With a sweeter taste and a slightly nutty note, Chun Mee brings a lovely character to this infusion, providing the perfect backdrop for sunny raspberry and pomegranate. Real pieces of dried pomegranate and raspberry give the blend its summery bouquet. We also emphasise the fruits’ naturally intense flavours with our unique raspberry and pomegranate flavourings. The vibrant tanginess really complements the green tea, balancing its mellow grassy flavour with playful bursts of ripe summer berries.', 'Green Tea', 'Products/22/'),
(45, 'Summer Fruits Cold Brew Iced Drink', 13.45, 'Combining sweet strawberry, tangy raspberry and ripe cherry, our Summer Fruits Cold Brew Iced Drink turns plain water into a sip to celebrate. Satisfying the need for tasty, health-conscious hydration, this summery teabag transforms H2O at home or on-the-go.\r\n\r\nCold Brew blends make iced tea easier than ever. We’ve used our generations of blending expertise to create a range that’s full of flavour and imagination. Consider your glass of water the canvas, and these teas the colour. Watch your Summer Fruits teabag steep and swirl it’s vibrant red hues and berry flavours into the water as it magically ‘cold brews’ in front of you. Unlike standard teabags, each of our Cold Brew blends have been specially designed to infuse in cold water in just five minutes.', 'Fruit', 'Products/23/'),
(46, ' Sweet Mint Digest Infusion', 19.13, 'Our Sweet Mint Digest is a vivacious herbal tea blend that delivers a truly refreshing brew. We use a combination of spearmint and peppermint to bring you a mint tea that’s twice as nice. This exhilarating infusion is perfectly balanced by the mellow tones of fennel and liquorice.\r\n\r\nMint tea is hugely popular in North Africa, which is where our Tea Masters found inspiration for this blend. We use a gentle base of fennel to create a sweet yet savoury backdrop. This gives the blend complexity, while allowing the fresh, minty flavours of the peppermint and spearmint leaves to sing. Liquorice root rounds things off with its distinctive bittersweet note. Renowned for centuries for aiding healthy digestion, mint tea is a great remedy for bloated tummies. The blend is made with 100% natural ingredients, so it’s the perfect choice to help keep you feeling fresh and upbeat.', 'Various', 'Products/24/');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Product_ID` int(11) NOT NULL,
  `Customer_email` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Arrived` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Product_ID`, `Customer_email`, `Quantity`, `Date`, `Arrived`) VALUES
(19, 'someone@gmail.com', 4, '2019-08-21 16:38:28', '1'),
(19, 'someone@gmail.com', 3, '2021-01-14 16:39:49', '0'),
(20, 'someone@gmail.com', 2, '2020-02-13 16:39:44', '0'),
(21, 'someone@gmail.com', 1, '2020-06-09 16:38:23', '0'),
(22, 'someone@gmail.com', 3, '2020-02-19 16:35:44', '1'),
(23, 'someone@gmail.com', 1, '2018-11-08 16:38:36', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Email` char(255) NOT NULL,
  `Fname` char(255) NOT NULL,
  `Lname` char(255) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Password` char(255) NOT NULL,
  `Type` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Email`, `Fname`, `Lname`, `Birthday`, `Password`, `Type`) VALUES
('admin@gmail.com', 'Admin', 'Admin', '0000-00-00', '$2y$10$Ex26C/rh7n01321Uq4avSO/ojzJP19DdIdPiAOcHgBDZadBZP/LKq', '0'),
('mustafauhoow@gmail.com', 'Mustafa', 'Hijazi', '2001-09-07', '$2y$10$yE5b3fOwanATBfb6OuXtq.UWd.LpZ9klX0ZuHoi9jg16qqSTnE8Vm', '0'),
('someone@gmail.com', 'Someone', 'Name', '2020-12-16', '$2y$10$yE5b3fOwanATBfb6OuXtq.UWd.LpZ9klX0ZuHoi9jg16qqSTnE8Vm', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`cutomer_id`),
  ADD KEY `cutomer_id` (`cutomer_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Product_ID`,`Customer_email`,`Date`),
  ADD KEY `Product_ID` (`Product_ID`,`Customer_email`),
  ADD KEY `Cutomer_Sale` (`Customer_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `user_address` FOREIGN KEY (`cutomer_id`) REFERENCES `users` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `Cutomer_Sale` FOREIGN KEY (`Customer_email`) REFERENCES `users` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_Sale` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
