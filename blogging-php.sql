-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 06:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogging-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `description`, `content`, `category`, `image`, `user`, `status`) VALUES
(17, 'what is html', 'a short description about html', 'HTML stands for Hyper Text Markup Language. HTML is the standard markup language for creating Web pages. HTML describes the structure of a Web page. HTML consists of a series of elements.\r\n\r\nThe HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It is often assisted by technologies such as Cascading Style Sheets (CSS) and scripting languages such as JavaScript.\r\n\r\nWeb browsers receive HTML documents from a web server or from local storage and render the documents into multimedia web pages. HTML describes the structure of a web page semantically and originally included cues for its appearance.\r\n\r\nHTML elements are the building blocks of HTML pages. With HTML constructs, images and other objects such as interactive forms may be embedded into the rendered page. HTML provides a means to create structured documents by denoting structural semantics for text such as headings, paragraphs, lists, links, quotes, and other items. HTML elements are delineated by tags, written using angle brackets. Tags such as \'img\' and \'input\' directly introduce content into the page. Other tags such as surround and provide information about document text and may include sub-element tags. Browsers do not display the HTML tags but use them to interpret the content of the page.\r\n\r\nHTML can embed programs written in a scripting language such as JavaScript, which affects the behavior and content of web pages. The inclusion of CSS defines the look and layout of content. The World Wide Web Consortium (W3C), former maintainer of the HTML and current maintainer of the CSS standards, has encouraged the use of CSS over explicit presentational HTML since 1997.[2] A form of HTML, known as HTML5, is used to display video and audio, primarily using the \'canvas\' element, together with JavaScript.', 1, '9991html.png', 'sumanta@ghosh.com', 'active'),
(18, 'what is css', 'a short description about css', 'Cascading Style Sheets (CSS) is a stylesheet language used to describe the presentation of a document written in HTML or XML (including XML dialects such as SVG, MathML or XHTML). CSS describes how el', 3, '9992css.png', 'sumanta@ghosh.com', 'active'),
(19, 'what is js', 'a short description about js', 'Javascript is used by programmers across the world to create dynamic and interactive web content like applications and browsers. JavaScript is so popular that it\'s the most used programming language i', 1, '9993js.png', 'sumanta@ghosh.com', 'active'),
(20, 'what is jquery', 'a short description about jquery', 'jQuery is a lightweight, &quot;write less, do more&quot;, JavaScript library. The purpose of jQuery is to make it much easier to use JavaScript on your website. jQuery takes a lot of common tasks that', 2, '9994jquery.png', 'sumanta@ghosh.com', 'active'),
(21, 'what is php', 'a short description about php', 'PHP(short for Hypertext PreProcessor) is the most widely used open source and general purpose server side scripting language used mainly in web development to create dynamic websites and applications.', 3, '9995php.png', 'sumanta@ghosh.com', 'active'),
(22, 'what is mysql', 'a short description about mysql', 'It may be anything from a simple shopping list to a picture gallery or the vast amounts of information in a corporate network. To add, access, and process data stored in a computer database, you need ', 2, '9996mysql.png', 'sumanta@ghosh.com', 'active'),
(23, 'what is laravle used for', 'a short description about laravel', 'Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching. Laravel aims to make the devel', 3, '9997laravel.png', 'sumanta@ghosh.com', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'test 01', 'final update', 'active'),
(2, 'test 02', 'updated description', 'active'),
(3, 'test 03', 'this is another category', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `bio` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user',
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `bio`, `email`, `password`, `image`, `usertype`, `register_date`, `status`) VALUES
(5, 'sumanta ghosh', 'sumanta@ghoscom', 'this is test bio', 'sumanta@ghosh.com', '$2y$10$7oWsbqHK3Ot5az0z3LZBY.MgB/RKNk4G8amTQDnHcELKdg2.IfiKm', '807532classic-1.jpg', 'admin', '2023-02-17 13:03:35', 'active'),
(6, 'test user', 'test@user', 'this is user', 'user@user.com', '$2y$10$ozmphfV8FP6rgl/yEMwky.M55wQ4qwOo/dtBHZjdaXxk.KCKj64t6', '533140goroup-1.jpg', 'user', '2023-02-17 13:28:44', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
