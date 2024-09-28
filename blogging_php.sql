-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 08:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogging_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `ownerId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `image`, `content`, `ownerId`, `categoryId`, `createdAt`, `updatedAt`) VALUES
(1, 'test blog title updated', 'test blog description updated', '66f6cf04705ee.jpg', '# test ***blog*** content with some dummy data updated', 2, 5, '2024-09-27 15:28:04', '2024-09-27 15:41:07'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Maecenas at arcu sed quam pretium congue eget sit amet nunc. Maecenas id magna ipsum. Maecenas faucibus tincidunt tincidunt. Nam ac vestibulum diam, et luctus nisl. Vivamus aliquam sed magna at feugia', '66f78b1f4010a.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at arcu sed quam pretium congue eget sit amet nunc. Maecenas id magna ipsum. Maecenas **faucibus tincidunt tincidunt**. Nam ac vestibulum diam, et luctus nisl. Vivamus aliquam sed magna at feugiat. Integer condimentum, massa id gravida tempus, justo justo semper erat, non tincidunt justo quam eget dolor. Curabitur maximus tincidunt tincidunt. Nulla quam felis, luctus nec porta ut, ullamcorper eget lacus. Donec quam metus, tempus sit amet elementum eu, placerat a purus. Sed ultrices tempor enim dictum consectetur. Sed finibus nisl a ligula rhoncus placerat. *Curabitur hendrerit* varius urna ut posuere.', 2, 2, '2024-09-28 04:50:39', '2024-09-28 04:50:39'),
(4, 'Integer interdum non orci sed rhoncus', 'Suspendisse ac consequat velit. Proin quis ultrices arcu. Curabitur euismod felis vitae libero rutrum, eu ullamcorper magna scelerisque.', '66f78b4a2f056.jpg', 'Integer interdum non orci sed rhoncus. Suspendisse ac consequat velit. Proin quis ultrices arcu. Curabitur euismod felis vitae libero rutrum, eu ullamcorper magna scelerisque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In ac urna sed diam cursus semper id ac urna. Ut pulvinar quam lorem, elementum porta diam vulputate id. Sed tempus ante ***quis consectetur tincidunt. Maecenas tincidunt sodales tincidunt. Aenean luctus elit ligula, sed fringilla ex euismod*** et. Etiam ut nisl sit amet risus scelerisque tempus quis in erat. Cras sit amet neque vel ipsum congue mollis id vitae massa. Mauris vel nunc scelerisque, tempor elit posuere, tempus nunc. Sed condimentum, purus at hendrerit egestas, ligula massa elementum magna, imperdiet euismod lacus ex nec est. Aliquam id massa vitae metus sollicitudin semper.', 2, 2, '2024-09-28 04:51:22', '2024-09-28 04:51:22'),
(5, 'Aenean pellentesque sollicitudin viverra', 'Nullam molestie leo nibh. In hac habitasse platea dictumst.', '66f78b742ea5a.png', 'Aenean pellentesque sollicitudin viverra. Nullam molestie leo nibh. In hac habitasse platea dictumst. Ut nec vulputate augue. Maecenas ultricies mi nec lacus aliquet interdum. Morbi venenatis commodo nisl non hendrerit. Ut venenatis varius urna, sit amet maximus urna ultricies eu. Donec non neque tincidunt lorem porta posuere id at nulla. Nulla facilisi. Maecenas convallis nisl a diam maximus, sed venenatis velit molestie.', 2, 3, '2024-09-28 04:52:04', '2024-09-28 04:52:04'),
(6, 'Vivamus finibus condimentum metus', 'Nam luctus erat nisl, sit amet tempus ex finibus vel. Donec non facilisis enim. Suspendisse eget lacinia felis, sed vestibulum metus.', '66f78b91a1c37.jpg', 'Vivamus finibus condimentum metus. Nam luctus erat nisl, sit amet tempus ex finibus vel. Donec non facilisis enim. Suspendisse eget lacinia felis, sed vestibulum metus. Donec sed pharetra elit. In hac habitasse platea dictumst. Donec fermentum auctor orci, a rutrum ante semper sed.', 2, 3, '2024-09-28 04:52:33', '2024-09-28 04:52:33'),
(7, 'Cras non ultrices justo', 'Nam vestibulum nisl ut purus faucibus vulputate ac nec nibh. Nulla tellus nibh, mattis eget arcu id, congue semper nunc.', '66f78bcebeb7f.png', '***Cras non ultrices justo***. Nam vestibulum nisl ut purus faucibus vulputate ac nec nibh. Nulla tellus nibh, mattis eget arcu id, congue semper nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent fringilla nunc et mi elementum convallis. Vestibulum pellentesque velit id dui dignissim imperdiet. Sed volutpat lacinia quam. Curabitur ullamcorper consequat massa.', 2, 4, '2024-09-28 04:53:34', '2024-09-28 04:53:34'),
(8, 'Suspendisse a tempus diam', 'Curabitur ac massa consectetur, maximus tortor ut, maximus ex. Aliquam ultrices, est ac varius tempus, ex magna condimentum dui, eget molestie ipsum nisl ac orci.', '66f78bf859cb1.jpg', 'Suspendisse a tempus diam. Curabitur ac massa consectetur, maximus tortor ut, maximus ex. Aliquam ultrices, est ac varius tempus, ex ***magna condimentum*** dui, eget molestie ipsum nisl ac orci. Integer sed dolor felis. Nunc a finibus massa. Morbi iaculis at leo sed facilisis. Etiam tortor ante, fringilla vitae cursus in, vulputate ac justo. Etiam tempor bibendum molestie. Fusce eget diam vel felis fermentum ornare vitae sed est. Nam at faucibus libero, sed ornare velit.', 2, 4, '2024-09-28 04:54:16', '2024-09-28 04:54:16'),
(9, 'Curabitur tempus sem id eros hendrerit maximus', 'Duis hendrerit metus tristique, venenatis urna vel, posuere nibh. Vivamus bibendum urna eget massa luctus rhoncus.', '66f78c32c9665.jpg', '**Curabitur tempus** sem id eros hendrerit maximus. Duis hendrerit metus tristique, venenatis urna vel, posuere nibh. Vivamus bibendum urna eget massa luctus rhoncus. Nulla ut erat vel dolor suscipit vulputate id lacinia felis. Nulla rhoncus porta massa. Donec rutrum nibh eu hendrerit sagittis. Fusce volutpat, risus ut feugiat sagittis, tortor ante porttitor risus, sed tempus nisl nunc et erat. Aenean placerat finibus neque, vitae porta velit tincidunt eget. Quisque efficitur porta nisi, sit amet ullamcorper mauris imperdiet sed. Fusce imperdiet lacus id ante auctor ornare. Cras sit amet arcu eros. Etiam est felis, ornare et purus quis, laoreet efficitur diam. *Nullam sed* leo efficitur, facilisis diam eget, rutrum elit.', 2, 5, '2024-09-28 04:55:14', '2024-09-28 04:55:14'),
(10, 'Praesent elementum mi id purus vestibulum', 'eget cursus libero semper. Nunc tincidunt feugiat quam, viverra convallis sem. Maecenas vitae iaculis ex, ut varius ipsum.', '66f78c5397ee6.jpg', 'Praesent elementum mi id purus vestibulum, eget cursus libero semper. Nunc tincidunt feugiat quam, viverra convallis sem. Maecenas vitae iaculis ex, ut varius ipsum. Vestibulum vehicula quis dolor id egestas. Sed laoreet nisl orci, in pretium magna pretium sed. Proin vitae orci elit. Duis venenatis pulvinar sagittis. Pellentesque a turpis at massa posuere congue. Phasellus magna tortor, porta sodales neque sit amet, hendrerit porta dolor. Suspendisse potenti. Phasellus mollis sagittis ligula eget vulputate. Nunc lobortis finibus lacinia.', 2, 5, '2024-09-28 04:55:47', '2024-09-28 04:55:47'),
(11, 'Proin rutrum, magna vel porta cursus', 'ligula tortor posuere lectus, vitae eleifend enim nisi eu lorem. Fusce in posuere justo. Quisque quis scelerisque metus.', '66f78c9d75d50.png', 'Proin rutrum, magna vel porta cursus, ligula tortor posuere lectus, vitae eleifend enim nisi eu lorem. Fusce in posuere justo. Quisque quis scelerisque metus. Nam augue nunc, imperdiet quis massa at, vulputate aliquet enim. Maecenas nulla mi, scelerisque et cursus ac, mollis ut arcu. Ut porttitor elit eu libero mattis, at fringilla diam maximus. Mauris scelerisque dui facilisis, tempus quam quis, condimentum purus. Donec non nisi venenatis, mollis felis a, pellentesque ex. Aenean a sodales metus. Donec id ultricies turpis, quis dapibus velit. Maecenas eget libero vitae orci mollis cursus et sed ex.', 2, 6, '2024-09-28 04:57:01', '2024-09-28 04:57:01'),
(12, 'Phasellus elementum diam eget orci sagittis consectetur', 'Donec finibus sit amet erat ac molestie. Ut purus ante, consequat vitae lacus sed, luctus vehicula lacus. Quisque tristique tortor eleifend varius interdum.', '66f78cb9d419f.jpg', 'Phasellus elementum diam eget orci sagittis consectetur. Donec finibus sit amet erat ac molestie. Ut purus ante, consequat vitae lacus sed, luctus vehicula lacus. Quisque tristique tortor eleifend varius interdum. Aliquam erat volutpat. Etiam viverra, metus sit amet venenatis molestie, nisl ligula finibus dolor, in vulputate mi urna in dolor. Curabitur euismod blandit nunc, at vehicula odio elementum eget. Mauris convallis, risus eget malesuada tristique, erat est fermentum libero, at ullamcorper dui nulla ut ligula. Fusce ut ante vitae urna mollis aliquam a sed est. Pellentesque et pharetra nisi. Quisque feugiat porta orci, at vehicula justo vestibulum non.', 2, 6, '2024-09-28 04:57:29', '2024-09-28 04:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `createdAt`, `updatedAt`) VALUES
(2, 'Technology', '66f6b31b2ef9e.jpg', '2024-09-27 13:28:59', '2024-09-27 13:28:59'),
(3, 'Health & Wellness', '66f6b32663ed1.png', '2024-09-27 13:29:10', '2024-09-27 13:29:10'),
(4, 'Personal Finance', '66f6b334ebf05.jpg', '2024-09-27 13:29:24', '2024-09-27 13:29:24'),
(5, 'Travel', '66f6b33f319b7.jpg', '2024-09-27 13:29:35', '2024-09-27 13:29:35'),
(6, 'Home Improvement', '66f6b37d4f896.jpg', '2024-09-27 13:30:37', '2024-09-27 13:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `blogId` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ownerId`, `blogId`, `message`, `createdAt`, `updatedAt`) VALUES
(1, 1, 3, 'test message', '2024-09-28 05:22:05', '2024-09-28 05:22:05'),
(3, 1, 3, 'hello', '2024-09-28 05:39:18', '2024-09-28 05:39:18'),
(4, 1, 7, 'hello', '2024-09-28 05:39:33', '2024-09-28 05:39:33'),
(5, 1, 9, 'hi', '2024-09-28 05:39:46', '2024-09-28 05:39:46'),
(6, 2, 3, 'abc', '2024-09-28 05:42:12', '2024-09-28 05:42:12'),
(7, 2, 3, 'final one', '2024-09-28 05:49:29', '2024-09-28 05:49:29'),
(8, 2, 3, 'abc', '2024-09-28 05:49:58', '2024-09-28 05:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `addressline` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `mobileNumber`, `password`, `firstName`, `lastName`, `username`, `filename`, `dob`, `gender`, `city`, `state`, `country`, `zip`, `addressline`, `status`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'test@user.com', '9999999999', '$2y$10$m4pbYMc61OTU27mAV0QipOvRK1E4IEJlOA991DZWrERZlpazpPZou', 'test', 'user', 'test@user', '66f642e14be66.jpg', '2013-03-06', 'male', 'kolkata', 'west bengal', 'India', '700012', 'abc road kolkata', 'active', 'user', '2024-09-27 05:27:42', '2024-09-27 05:33:16'),
(2, 'test@admin.com', '7777777777', '$2y$10$3kPUiSRM/ZlG/AEYFlpLaeYWrL8weldj7gSevO7xRLuPrTpVXisci', 'test', 'admin', 'test@admin', '66f643f22ba3b.jpg', '2007-08-16', 'male', 'test', 'test', 'test', 'test', 'test', 'active', 'admin', '2024-09-27 05:28:10', '2024-09-27 05:35:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerId` (`ownerId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogId` (`blogId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileNumber` (`mobileNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blogId`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
