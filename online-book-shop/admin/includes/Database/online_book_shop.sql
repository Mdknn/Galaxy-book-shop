-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 12:20 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_book_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(200) NOT NULL,
  `author_slug` varchar(200) NOT NULL,
  `author_pic` varchar(200) NOT NULL,
  `author_desc` text NOT NULL,
  `author_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `author_slug`, `author_pic`, `author_desc`, `author_status`) VALUES
(1, 'DR. RD SHARMA', 'dr-rd-sharma', '1636170633rdsharma.jpg', '<p><span style=\"color: #2dc26b;\"><strong>Specialist in Mathematics</strong></span></p>', 1),
(2, 'DR. RS AGARWAL', 'dr-rs-agarwal', '1636170676rsagarwaal.jpeg', '<p><span style=\"color: #2dc26b;\"><strong>Specialist in Mathematics</strong></span></p>', 1),
(3, 'Himanshu Pandey', 'himanshu-pandey', '1636170800himanshu.jpg', '<p><span style=\"color: #2dc26b;\"><strong>Specialist in Science</strong></span></p>', 1),
(4, 'Dr. Pradeep', 'dr-pradeep', '1636170837pradeep.jpg', '<p><span style=\"color: #2dc26b;\"><strong>Specialist in Science</strong></span></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `prod_id`, `prod_qty`, `added_on`) VALUES
(43, 2, 3, 1, '2021-11-19 02:58:42'),
(79, 1, 12, 7, '2021-11-27 09:27:58'),
(80, 1, 3, 1, '2021-11-27 09:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_slug` varchar(100) NOT NULL,
  `cat_pic` varchar(100) NOT NULL,
  `cat_desc` text NOT NULL,
  `cat_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_slug`, `cat_pic`, `cat_desc`, `cat_status`) VALUES
(1, 'Class X', 'class-ten', '1636170151classTen.png', '<p>All Books Of Class 10 are Present Here.</p>', 1),
(2, 'Class IX', 'class-nine', '1636170195classNine.png', '<p>All Books Of Class 9 are Present Here.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `pmobile` varchar(100) NOT NULL,
  `smobile` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `order_status` varchar(200) NOT NULL DEFAULT 'request',
  `del_rem_days` int(11) NOT NULL DEFAULT 5,
  `cancel_by_admin` int(11) NOT NULL DEFAULT 0,
  `cancel_by_user` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `customer_name`, `customer_email`, `state`, `city`, `address`, `pincode`, `pmobile`, `smobile`, `subtotal`, `tax`, `total`, `payment_type`, `payment_id`, `payment_status`, `order_status`, `del_rem_days`, `cancel_by_admin`, `cancel_by_user`, `timestamp`) VALUES
(1, 1, 'v', 'vkj2535@gmail.com', 'e', 'e', 'e', '4', '6', '6', '420', '9', '429', 'CashOnDelivery', 'Not Available', 'success', 'cancel', 2, 1, 1, '2021-11-20 03:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_products_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_mrp` varchar(100) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_qty` varchar(100) NOT NULL,
  `product_discount` varchar(100) NOT NULL,
  `rem_stock` int(11) NOT NULL,
  `product_thumbnail` varchar(100) NOT NULL,
  `product_subtotal` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_products_id`, `order_id`, `user_id`, `product_id`, `product_name`, `product_mrp`, `product_price`, `product_qty`, `product_discount`, `rem_stock`, `product_thumbnail`, `product_subtotal`, `timestamp`) VALUES
(1, 1, 1, 7, 'erree', '300', '210', '2', '30', 68, '1636332898pradeep.jpg', '420', '2021-11-20 03:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_slug` varchar(200) NOT NULL,
  `prod_author_id` int(11) NOT NULL,
  `prod_cat_id` int(11) NOT NULL,
  `prod_pcat_id` int(11) NOT NULL,
  `prod_publisher_id` int(11) NOT NULL,
  `prod_mrp` int(11) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_discount` int(11) NOT NULL,
  `prod_desc_id` int(11) NOT NULL,
  `prod_keywords` varchar(200) NOT NULL,
  `prod_features` varchar(200) NOT NULL,
  `prod_subject` varchar(200) NOT NULL,
  `prod_stock` int(11) NOT NULL DEFAULT 1,
  `prod_trending` int(11) NOT NULL DEFAULT 0,
  `prod_thumbnail` varchar(200) NOT NULL,
  `prod_lang` varchar(100) NOT NULL DEFAULT 'English',
  `prod_pages` int(11) NOT NULL,
  `prod_isbn` varchar(200) NOT NULL,
  `prod_publication_date` varchar(200) NOT NULL,
  `prod_delivery_type` varchar(200) NOT NULL,
  `prod_see_age` varchar(100) NOT NULL,
  `prod_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_slug`, `prod_author_id`, `prod_cat_id`, `prod_pcat_id`, `prod_publisher_id`, `prod_mrp`, `prod_price`, `prod_discount`, `prod_desc_id`, `prod_keywords`, `prod_features`, `prod_subject`, `prod_stock`, `prod_trending`, `prod_thumbnail`, `prod_lang`, `prod_pages`, `prod_isbn`, `prod_publication_date`, `prod_delivery_type`, `prod_see_age`, `prod_status`) VALUES
(3, 'Mental Mathematics2', 'mental-math-class-nine', 2, 2, 2, 1, 300, 240, 20, 1, 'Because it\'s fun and can prepare you for a variety of excellent careers! If you like solving puzzles and figuring things out, then a mathematics major may interest you. In addition, applications of ma', 'There is debate over whether mathematical objects such as numbers and points exist naturally or are human creations. The mathematician Benjamin Peirce called mathematics \"the science that draws necess', 'Mathematics', 23, 1, '1636172745class9bookmath.jpg', 'English', 255, 'Mental5463536', '2021-11-05', 'Free', 'Below 18', 1),
(7, 'erree', 'www-rrrr', 1, 1, 3, 2, 300, 210, 30, 1, '44', '44', 'Mathematics', 72, 1, '1636332898pradeep.jpg', 'Hindi', 222, '22', '2021-11-15', '33', 'Below 10', 1),
(12, 'Math', 'math', 1, 1, 1, 1, 200, 120, 60, 1, '', '', 'English', 28, 0, '1636434175arihant.png', 'English', 200, 'hhhhs', '2021-01-01', 'free', 'More Than 18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `pcat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pcat_name` varchar(100) NOT NULL,
  `pcat_slug` varchar(100) NOT NULL,
  `pcat_pic` varchar(100) NOT NULL,
  `pcat_desc` text NOT NULL,
  `pcat_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`pcat_id`, `cat_id`, `pcat_name`, `pcat_slug`, `pcat_pic`, `pcat_desc`, `pcat_status`) VALUES
(1, 1, 'Math', 'math', '1636170265math.jpg', '<p>Math Book</p>', 1),
(2, 2, 'Math', 'math', '1636170288math.jpg', '<p>Math Book</p>', 1),
(3, 1, 'Science', 'science', '1636170315science.jpg', '<p>Science Book</p>', 1),
(4, 2, 'Science', 'science', '1636170345science.jpg', '<p>Science Book</p>', 1),
(5, 1, 'English', 'english', '1636426971nova.jpg', '<p>English Book</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_description`
--

CREATE TABLE `product_description` (
  `desc_id` int(11) NOT NULL,
  `desc_name` varchar(255) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_description`
--

INSERT INTO `product_description` (`desc_id`, `desc_name`, `prod_desc`, `prod_status`) VALUES
(1, 'Mental Math for Class 9', '<p>mathematics, the science of structure, order, and relation that has evolved from elemental practices of counting, measuring, and describing the shapes of objects. It deals with logical reasoning and quantitative calculation, and its development has involved an increasing degree of idealization and abstraction of its subject matter. Since the 17th century, mathematics has been an indispensable adjunct to the physical sciences and technology, and in more recent times it has assumed a similar role in the quantitative aspects of the life sciences.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_discuss`
--

CREATE TABLE `product_discuss` (
  `dis_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `dis_title` varchar(200) NOT NULL,
  `dis_desc` varchar(200) NOT NULL,
  `dis_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_discuss`
--

INSERT INTO `product_discuss` (`dis_id`, `prod_id`, `dis_title`, `dis_desc`, `dis_status`) VALUES
(1, 3, 'How intresting book', 'So Intresing', 1),
(5, 3, 'How you rate this book?', 'I rate 5 out of 5.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `prod_id`, `image`, `image_status`) VALUES
(12, 3, '1636370756classNine.png', 0),
(13, 3, '1636370756classTen.png', 1),
(14, 3, '1636370756nova.jpg', 1),
(15, 3, '1636370756pradeep.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `pub_id` int(11) NOT NULL,
  `pub_name` varchar(100) NOT NULL,
  `pub_slug` varchar(100) NOT NULL,
  `pub_pic` varchar(100) NOT NULL,
  `pub_desc` varchar(100) NOT NULL,
  `pub_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`pub_id`, `pub_name`, `pub_slug`, `pub_pic`, `pub_desc`, `pub_status`) VALUES
(1, 'Arihant', 'arihant', '1636170716arihant.png', '<p>arihant publication</p>', 1),
(2, 'Nova', 'nova', '1636170745nova.jpg', '<p>Nova Publication</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `auth_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `user_type` enum('user','admin','vendor','') NOT NULL DEFAULT 'user',
  `job` varchar(50) NOT NULL,
  `reg_status` int(11) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`auth_id`, `name`, `email`, `password`, `mobile`, `user_type`, `job`, `reg_status`, `timestamp`) VALUES
(1, 'Vk Kumar', 'vk@gmail.com', '$2y$10$zRDwFdgfm7q4/Fov5xPfyOvfXVSQnfZvH/qGIx.eJAntQENZ3VSMu', 2147483647, 'user', 'customer', 1, '2021-11-19 07:59:44'),
(2, 'Vk Kr.', 'v@gmail.com', '$2y$10$VcqvZBJAIfoic2DgeLMdJOtpgOGP9UHIzXFuCvLhATZuCJswRWZq6', 2147483647, 'admin', 'admin', 1, '2021-11-19 08:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rev_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_review` varchar(255) NOT NULL,
  `rev_status` int(11) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rev_id`, `user_id`, `user_name`, `prod_id`, `user_rating`, `user_review`, `rev_status`, `timestamp`) VALUES
(4, 1, 'Vk Kumar', 7, 3, 'Very Good Book.', 1, '2021-11-20 03:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_pic` varchar(255) NOT NULL,
  `slider_url` varchar(255) NOT NULL,
  `slider_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_pic`, `slider_url`, `slider_status`) VALUES
(6, '163799477610 percent off.png', 'show-books.php?discount=10', 1),
(7, '163799479220 percent off.png', 'show-books.php?discount=20', 1),
(8, '163799491330 percent off.png', 'show-books.php?discount=30', 1),
(9, '163799494640 percent off.png', 'show-books.php?discount=40', 1),
(12, '163799554450 percent off.png', 'show-books.php?discount=50', 1),
(13, '163799556160 percent off.png', 'show-books.php?discount=60', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_products_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`pcat_id`);

--
-- Indexes for table `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`desc_id`);

--
-- Indexes for table `product_discuss`
--
ALTER TABLE `product_discuss`
  ADD PRIMARY KEY (`dis_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `pcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_description`
--
ALTER TABLE `product_description`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_discuss`
--
ALTER TABLE `product_discuss`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `pub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
