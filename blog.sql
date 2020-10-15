-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2020 at 06:00 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `created_at`, `post_id`) VALUES
(39, 'Topaz M', 'this comment is a test', '2020-10-08 15:27:50', 18),
(40, 'Daniel Gu1', 'this comment is a test', '2020-10-09 15:18:39', 21),
(41, 'Daniel Gu1', 'this comment is a second test', '2020-10-09 15:19:31', 21);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `write_to_us` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `content`, `image`, `created_at`) VALUES
(18, 8, 'The art of Body', '<p>Some people tend to think that our body is a sacred palace, that we should save it to ourselves and our loved ones.</p><p> I came with a different approach, I think that our body is a masterpiece and we need to cooperate with it and show it to the world.</p><p> on my posts, you can see how the material world and the spiritual world clash together to create a fantasy in a reality. </p>', '1602246349_danielgu1.jpg', '2020-10-09 15:25:49'),
(20, 9, 'The art of a Draw', 'When you hear the word Drawing, the first thing that comes into your mind is a big old faded painting by Leonardo de Vinci or Van Gogh. In the past few years, a new style of painting was born, the art of Digital Painting. This new style of art gonna change the world of art as we know it, on my posts I am going to show you how to take a simple black line and make a powerful painting from it. ', '1600611032_lera1.jpg', '2020-09-21 12:51:24'),
(21, 10, 'The art of Interior Design', 'When you think about a new house the first thing that pops up into your head is how to make it as perfect as you imagined, you have that image framed in your head with those little details of everything that you ever dreamed of. here in this part, I step into the picture to help you maximize your design while minimizing the costs. Interior design is all about accomplishing the client&#39;s vision to the point of excellence.', '1600623482_eliel4.jpg', '2020-09-22 19:33:47'),
(24, 7, 'The art of Makeup', 'When you hear the word makeup you are not usually thinking about a guy in makeup, you are more thinking about a lady and cosmetics, but! you can do more than just make pretty faces with makeup, you can create whole new faces, emotions, and imaginary things with it. here on my blog I&#39;m gonna show you how we can create a wild imaginary thing with just a little bit makeup and some props.', '1600696883_danielts1.jpg', '2020-09-21 17:01:23'),
(25, 9, 'The art of My Mind', 'In my last post here I wrote you all about the art of drawing and how we can make a strong emotional painting from a black line, today I\'m gonna speak with you about the creation of a mind, how can we all transfer our mind into a powerful painting, lately we\'ve heard about several women who got raped and their souls have been ripped apart by a rude and mean person. how they felt violated and silenced from fear as their consciousness took away from them.</p><p>today my drawing is all about that feeling that no one should never feel. never be afraid to say what\'s on your mind.', '1600686723_lera3.jpg', '2020-09-21 14:12:03'),
(26, 7, 'The art of Fear', '<p>Have you ever got the feeling of someone watching you? when you are alone at home and all of a sudden you caught up something in the corner of your eye. but nothing is there. so today I\'m gonna show you how you make someone\'s heart to stop for a sec.</p><p>first, we start with the first white layer, we spread it evenly on our face (make sure you won\'t miss any part of your skin), afterwords we gonna draw a hexagon around your eye with black color, and then draw out some pines, make it look scarier.</p><p>now we gonna draw the mouth and nose, put on a white wig and vuala. have fun guys.</p>', '1600694932_danielts2.jpg', '2020-09-21 16:28:52'),
(27, 8, 'The art of Mind', 'what do we know about our minds? scientists say that we only use 7% of our brain functionality. no one ever succeeds to fully analyze our brain.&nbsp; we surely know how it looks like but we will never know how it works. the most beautiful thing about our mind is that it can take us to a whole new place and adventures without even leaving the places we&#39;re located at.&nbsp;today I choose the mind as a subject and I want to show you all how I see my mind in my own eyes and imagination.', '1600709740_danielgu4.jpg', '2020-09-21 20:37:42'),
(29, 10, 'The art of Texture', '<p>what do we know about textures? the art of mixing different elements to create a new material is more than just science.</p><p>today we can combine all sorts of different materials in one place to create a new element. in this post I\'ll write to you about the element of mixing textures.</p><p>in old fashioned lifes the main way to decore was to take one element and go with it from roof to door, today we can see how mixing different elements can create new textures and gives the space a whole new feeling.</p><p>for example we can take a place and combine in it the business world in the micro spaces to create a warm feeling of home.</p><p>it may look like a living room but it\'s the waiting room of your office.</p>', '1600787174_eliel5.jpg', '2020-09-22 18:06:14'),
(30, 7, 'The art of Trixting', '<p>How doesn\'t know a famouse scene form a horror film in which one of the characters got stab or decapitade.&nbsp;</p><p>it looks so real but it\'s all just toilet paper and fake blood.</p><p>this time I\'m gonna show you how we can make a fake blooded wound with just 3 ingredians.&nbsp;</p><p>toilet paper, fake blood, and glue.</p><p>at first we gonna wett the toilet paper and squees out all the water.</p><p>we gonna put it on our skin with the glue we have and shape it to the wound we want.</p><p>now we gonna dye it with the fake blood until it\'s all gonna be red and scary.</p><p>it\'s ok if the blood spils, it\'s supose to be that way .</p><p><br></p><p><br></p>', '1600793004_danielts4.jpg', '2020-09-22 19:43:24'),
(31, 9, 'The art of Hush', '&#34;You can&#39;t escape so HUSH!&#34;. and all of a sudden your sight vanished, it&#39;s all dark and heavy and hurts.At this point, you wished he would rip your eyes off, you don&#39;t want to see it, you&#39;re too afraid, you just want it to end, you can&#39;t speak you can&#39;t scream you can&#39;t breathe, he took everything from you.you&#39;re just laying there and pray to God you&#39;ll disappear, but he can&#39;t hear you, because you&#39;ve been Hushed!.the only thing that you can hear is the Hummingbirds around.even though many years had passed since that day, you still hushed and afraid, only the Hummingbirds can hear you loud.and they loudly say &#34;Don&#39;t be Hushed&#34;.', '1600798517_lera2.jpg', '2020-09-22 21:16:59'),
(32, 8, 'The art of Soul', '<p>Have you ever stopped and think about how your soul may look like?&nbsp;</p><p>We know how our physical body looks like, but how is our spiritual body looks like? is it like the physical one? is it colorful? is it dark? are we all light inside?.&nbsp;</p><p>If you had a chance to projectile your soul out, how do you think it\'ll look like?.&nbsp;</p><p>Today in my post I\'m gonna show you how I see my soul from the inside.</p><p>I got a little help from a good friend of mine \"colored sand\", I call this pic \"L\'âme du Monde\".</p>', '1600945386_dnaielgu5.jpg', '2020-09-24 14:03:06'),
(33, 10, 'The art of Pattern', '<p>Patterns. T<span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">he elements of repeat in a predictable&nbsp;</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">manner. the art of making one mold and duplicate it in the creation and make the same exact thing over and over, resulting in a perfect pattern who stays the same no matter where you gonna find it, that\'s my friends, an art.</span></p><p><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">in this post I\'ll show you the last pattern I saw and really loved, it sure looks like an amusing park from above.</span></p>', '1601049441_eliel6.jpg', '2020-09-25 18:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profilepic` varchar(500) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `name`, `profilepic`, `role`) VALUES
(1, 'omer@gmail.com', '$2y$10$7YlgsvzmB/cPIzzucEruPuyfkxEFM3gsDgIbrZ.qT/Wb4j163PpK2', 'omer avhar', '', 7),
(7, 'danielts@gmail.com', '$2y$10$8GSrlhiOZh1GXmXOaQBsne7KNPexgqTeT8kWSPFQg.uQAT8bNFRdK', 'Daniel Ts', '1601894875_danielts5.jpg', 7),
(8, 'danielgu@gmail.com', '$2y$10$8GSrlhiOZh1GXmXOaQBsne7KNPexgqTeT8kWSPFQg.uQAT8bNFRdK', 'Daniel Gu1', '1601894242_dnaielgu5.jpg', 7),
(9, 'lerani@gmail.com', '$2y$10$8GSrlhiOZh1GXmXOaQBsne7KNPexgqTeT8kWSPFQg.uQAT8bNFRdK', 'Lera Ni', '1601896974_lera6.jpg', 7),
(10, 'elielch@gmail.com', '$2y$10$8GSrlhiOZh1GXmXOaQBsne7KNPexgqTeT8kWSPFQg.uQAT8bNFRdK', 'Eliel Ch', '1601896904_eliel7.jpg', 7),
(14, 'mordi@gmail.com', '$2y$10$8GSrlhiOZh1GXmXOaQBsne7KNPexgqTeT8kWSPFQg.uQAT8bNFRdK', 'mordi', '1601634373_danielgu3.jpg', 7),
(15, 'topazm@gmail.com', '$2y$10$8GSrlhiOZh1GXmXOaQBsne7KNPexgqTeT8kWSPFQg.uQAT8bNFRdK', 'Topaz M', '1601540185_pako.jpg', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
