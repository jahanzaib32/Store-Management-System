-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2019 at 09:20 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `issued` (
  `ID` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `register_no` int(11) NOT NULL,
  `page_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `sub_cata_id` int(11) NOT NULL,
  `store_id` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `main_cata` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_returnable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_cata`
--

INSERT INTO `main_cata` (`ID`, `name`, `is_returnable`) VALUES
(1, 'Returnable', 1),
(3, 'Non-Returnable', 0);


CREATE TABLE `non_user` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `store_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `received` (
  `ID` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `register_name` varchar(50) NOT NULL,
  `page_no` int(11) NOT NULL,
  `req_no` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `returned` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sub_carta` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `main_cata_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `store_id` varchar(15) NOT NULL,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`ID`, `name`, `email`, `pass`, `store_id`, `isAdmin`) VALUES
(1, 'Jahanzaib Asgher', 'jahanzaib.asgher@gmail.com', '123', 'qwe2', 1),
(2, 'M.Umar', 'user@demo.com', 'abc@123', 'umar', 0),
(3, 'M.Ali', 'ab@yahoo.com', '111', 'qwe2', 0);


ALTER TABLE `issued`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `item_id` (`item_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `sub_cata_id` (`sub_cata_id`);

--
-- Indexes for table `main_cata`
--
ALTER TABLE `main_cata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `non_user`
--
ALTER TABLE `non_user`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `received`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `returned`
--
ALTER TABLE `returned`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `sub_carta`
--
ALTER TABLE `sub_carta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `main_cata_id` (`main_cata_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `issued`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `main_cata`
--
ALTER TABLE `main_cata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `non_user`
--
ALTER TABLE `non_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `received`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returned`
--
ALTER TABLE `returned`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_carta`
--
ALTER TABLE `sub_carta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `issued`
  ADD CONSTRAINT `issued_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `issued_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`sub_cata_id`) REFERENCES `sub_carta` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `received`
--
ALTER TABLE `received`
  ADD CONSTRAINT `received_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `returned`
--
ALTER TABLE `returned`
  ADD CONSTRAINT `returned_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `returned_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `sub_carta`
--
ALTER TABLE `sub_carta`
  ADD CONSTRAINT `sub_carta_ibfk_1` FOREIGN KEY (`main_cata_id`) REFERENCES `main_cata` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;