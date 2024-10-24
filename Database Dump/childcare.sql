-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2022 at 06:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `childcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_categories` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_categories`, `type`, `price`) VALUES
(1, 'Baby', 100),
(2, 'Wobbler', 90),
(3, 'Toddler', 85),
(4, 'Preschool', 75);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `first_name`, `last_name`, `email`, `phone`, `message`, `date`) VALUES
(1, 'Jennifer', 'Coleman', 'jenny.col@hotmail.com', '0833978822', 'Do you open on weekends?', '2022-04-09'),
(2, 'John', 'Smith', 'john.smith@gmail.com', '0833973412', 'My son is coeliac and is very delicate about foods. He can not eat foods with gluten and he is lactose intolerant. I was wondering if you offer breakfast and lunch suitable for my child? \nI was also wondering if you have a nursery facility? just in case my son needs medical assistance.\n\nThank you', '2022-04-28'),
(3, 'Oliver', 'Khan', 'oliver.khan@hotmail.com', '0833976548', 'Do you guys offer any discount if I enroll my 4 children?', '2022-04-29'),
(4, 'Leticia', 'Perez', 'leticia.perez@hotmail.com', '0839543612', 'What are your teacher-to-child ratios?', '2022-05-02'),
(5, 'Albert', 'Hitchcock', 'albert.h@hotmail.com', '0842973412', 'Is there a weekly learning plan?', '2022-05-02'),
(6, 'Cinthia', 'O’Donnell', 'odonellcinthia@gmail.com', NULL, 'Can you tell me about your discipline policy?', '2022-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `daily_detail`
--

CREATE TABLE `daily_detail` (
  `id_details` int(11) NOT NULL,
  `id_kid` int(11) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `temperature` varchar(10) DEFAULT NULL,
  `breakfast` varchar(100) DEFAULT NULL,
  `lunch` varchar(100) DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_detail`
--

INSERT INTO `daily_detail` (`id_details`, `id_kid`, `first_name`, `last_name`, `temperature`, `breakfast`, `lunch`, `activities`, `date`) VALUES
(1, 4, 'Billy', 'Cassino', '36.5', 'Omelet', 'Pasta', 'Drawing', '2022-04-26'),
(4, 4, 'Billy', 'Cassino', '20', 'Chicken Eggs Bennedict', 'Soup', 'Baseball', '2022-04-27'),
(5, 4, 'Billy', 'Cassino', '35', 'Tortilla', 'Barbecue', 'Drawing and dancing', '2022-04-28'),
(6, 13, 'Oliver', 'Cooper', '32', 'Ham Sandwich', 'Chicken & Potato', 'Singing& Dancing ', '2022-05-01'),
(7, 14, 'Valentina', 'Blunt', '36.5', 'Cheese Sandwich', 'Soup', 'Dancing', '2022-05-02'),
(8, 5, 'Mandy', 'Cassino', '32.8', 'Cheese Sandwich', 'Mashed Potatoes', 'Drawing & Arts', '2022-05-02'),
(9, 9, 'Juan', 'Cassino', '34.3', 'Cereal & Milk', 'Chicken Soup', 'Football', '2022-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id_feature` int(11) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `page_link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id_feature`, `title`, `description`, `image`, `page_link`) VALUES
(1, 'Events', 'Find details and discover lots of kids events at Children\'s Cloud, to learn more go to events.', 'Alices-adventures-in-wonderland.jpeg', 'events.php'),
(2, 'Activities', 'Find details and discover lots of kids activities at Children\'s Cloud, to learn more go to activities.', 'kids.jpg', 'activities.php');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id_kid` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `school_days` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_categories` int(11) DEFAULT NULL,
  `id_school_hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id_kid`, `first_name`, `last_name`, `gender`, `school_days`, `email`, `id_categories`, `id_school_hours`) VALUES
(4, 'Billy', 'Cassino', 'male', 5, 'robertocassino11@gmail.com', 1, 1),
(5, 'Mandy', 'Cassino', 'female', 2, 'robertocassino11@gmail.com', 3, 2),
(9, 'Juan', 'Cassino', 'male', 1, 'robertocassino11@gmail.com', 1, 1),
(13, 'Oliver', 'Cooper', 'Male', 5, 'cooper.paul32@hotmail.com', 3, 2),
(14, 'Valentina', 'Blunt', 'Female', 4, 'ciara.blunt@gmail.com', 3, 1),
(15, 'Victor', 'Perez', 'Male', 4, 'leticia.perez@hotmail.com', 1, 2),
(16, 'Manuel', 'Perez', 'Male', 4, 'leticia.perez@hotmail.com', 4, 2),
(17, 'Maria', 'Perez', 'Female', 4, 'leticia.perez@hotmail.com', 4, 2),
(18, 'Alicia', 'Perez', 'Female', 4, 'leticia.perez@hotmail.com', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `school_hour`
--

CREATE TABLE `school_hour` (
  `id_school_hours` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_hour`
--

INSERT INTO `school_hour` (`id_school_hours`, `type`, `price`) VALUES
(1, 'Half Day', 50),
(2, 'Full Day', 100);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id_testimonials` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `services` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id_testimonials`, `first_name`, `last_name`, `comment`, `status`, `services`, `date`) VALUES
(1, 'Julia', 'Alves', 'It\'s really wonderful. I am really satisfied with my Children\'s Cloud membership. Children\'s Cloud has got everything I need.', 1, 'Nanning', '2022-04-20'),
(2, 'Mark', 'Doe', 'The service was excellent. I will recommend you to my colleagues. I am really satisfied with my Children\'s Cloud.', 1, 'Nursery', '2022-04-20'),
(3, 'Cionaodh', 'Mairéad', 'Definitely worth the investment. Children\'s Cloud is worth much more than I paid.', 1, 'Nursery', '2022-04-03'),
(4, 'Clíodhna', 'Colmán', 'The services are simply unbelievable! Thanks, Children\'s Cloud!', 1, 'Nanny', '2022-04-14'),
(5, 'Aodhagán', 'Nóra', 'We\'ve joined Children\'s Cloud for the last five years. Your company and services are truly upstanding.', 1, 'Homebased Childcare Services', '2022-04-30'),
(6, 'Eavan', 'Keeva', 'Needless to say we are extremely satisfied with the services. Children\'s Cloud was the best investment I ever made for myself and my kid. Needless to say, we are extremely satisfied. ', 1, 'Homebased Childcare Services', '2022-04-24'),
(7, 'Jesus', 'Cassino', 'AMAZING', NULL, 'Homebased Childcare', '2022-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `first_name`, `last_name`, `password`, `type`, `phone`) VALUES
('childrenscloud@hotmail.com', 'childrens', 'cloud', '123', 'Admin', '0833946622'),
('ciara.blunt@gmail.com', 'Ciara', 'Blunt', '23DqX12', 'Member', '0842973412'),
('cooper.paul32@hotmail.com', 'Paul', 'Cooper', '23DqX12', 'Member', '0842973412'),
('jesus.cassino@student.griffith.ie', 'Jesus', 'Cassino', '12', 'Member', '0833943222'),
('leticia.perez@hotmail.com', 'Leticia', 'Perez', '2345!*', 'Member', '0839543612'),
('robertocassino11@gmail.com', 'Jesus', 'Cassino', '12', 'Member', '0834546622'),
('tony.m@hotmail.com', 'Tony', 'Montana', '12345', 'Member', '0849946622');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_categories`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `daily_detail`
--
ALTER TABLE `daily_detail`
  ADD PRIMARY KEY (`id_details`),
  ADD KEY `id_kid` (`id_kid`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id_feature`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id_kid`),
  ADD KEY `id_categories` (`id_categories`),
  ADD KEY `id_school_hours` (`id_school_hours`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `school_hour`
--
ALTER TABLE `school_hour`
  ADD PRIMARY KEY (`id_school_hours`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id_testimonials`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_categories` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daily_detail`
--
ALTER TABLE `daily_detail`
  MODIFY `id_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id_feature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id_kid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `school_hour`
--
ALTER TABLE `school_hour`
  MODIFY `id_school_hours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id_testimonials` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_detail`
--
ALTER TABLE `daily_detail`
  ADD CONSTRAINT `daily_detail_ibfk_1` FOREIGN KEY (`id_kid`) REFERENCES `registration` (`id_kid`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`id_categories`) REFERENCES `category` (`id_categories`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`id_school_hours`) REFERENCES `school_hour` (`id_school_hours`),
  ADD CONSTRAINT `registration_ibfk_3` FOREIGN KEY (`email`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
