-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2019 at 04:29 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr10_florian_rechberger_biglibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(60) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'George', 'Orwell'),
(2, 'Jonathan', 'Swift'),
(3, 'William', 'Shakespeare'),
(4, 'Herbert George', 'Wells'),
(5, 'Fyodor', 'Dostoevsky'),
(6, 'Homer', 'Homer'),
(7, 'Ernest', 'Hemingway'),
(8, 'Erich Maria', 'Remarque'),
(9, 'Thomas', 'Bernhard'),
(10, 'Rüdiger', 'Sünner'),
(11, 'Karl', 'Lahmer'),
(26, 'Mr.', 'Who'),
(27, 'hello', 'hello'),
(28, 'bye', 'bye'),
(29, 'BeiÃŸ', 'Zange'),
(30, 'Will', 'Working'),
(31, 'Will', 'Working'),
(32, 'dfsgh', 'dsfg'),
(33, '55555', '5555'),
(34, '88888888888', '8888888888'),
(35, '88888888888', '8888888888'),
(36, '77777777777', '7777777777777'),
(37, '66666666666', '6666666666666'),
(38, '66666666666', '6666666666666'),
(39, '66666666666', '6666666666666'),
(40, '44444444444', '4444444444444'),
(41, 'dfasfdasd', 'fasdfasdfa'),
(42, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `isbn` char(13) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(2083) CHARACTER SET latin1 DEFAULT NULL,
  `fk_author_id` int(11) DEFAULT NULL,
  `short_description` varchar(2083) CHARACTER SET latin1 DEFAULT NULL,
  `publish_date` year(4) DEFAULT NULL,
  `fk_publisher_id` int(11) DEFAULT NULL,
  `type` varchar(4) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`isbn`, `title`, `image`, `fk_author_id`, `short_description`, `publish_date`, `fk_publisher_id`, `type`) VALUES
('1111111111', 'hello', 'hello', NULL, 'hello', 0000, NULL, 'hel'),
('123', 'test', 'test', 42, 'test', 2019, 26, 'test'),
('3333333333333', 'bye', 'bye', 28, 'bye', 0000, 19, 'bye'),
('3898485501', 'Nachtmeerfahrten. Eine Reise in die Psychologie von C. G. Jung', 'http://ecx.images-amazon.com/images/I/51GARmJMntL._SL160_.jpg', 10, 'In vielen Mythen muss der Held eine Nachtmeerfahrt durchmachen, in der er rätselhaften Wesen und gefährlichen Situationen begegnet. Der Psychologe Carl Gustav Jung (1875-1961) ging selbst auf eine solche Entdeckungsreise und befragte die Welt der Symbole und Archetypen auf ihre Bedeutung für unser Leben. Was können wir aus Mythen und Träumen lernen? Was erzählen uns unsere \'Anima\' und unser \'Schatten\' dabei? Wie sehen heutige Nachtmeerfahrten aus? Jung begab sich in Gefahrenzonen, aber er entdeckte vor allem den schöpferischen Reichtum unseres Unbewussten - das heilende Potential der Archetypen und Symbole, das uns, bei richtigem Umgang, zu einem vollständigeren Leben führen kann. Eine filmische Reise in die Biografie C. G. Jungs und in die wirkmächtige Welt der Mythen, Träume und Symbole.', 2011, 9, 'DVD'),
('424645634', 'asdfasdf', 'asdffasdfas', 41, 'sdfasdfasdfasdf', 0000, 25, '435'),
('4444444444444', '444444444444', '4444444444444', 40, '444444444444', 0000, 25, '44'),
('666666666666', '66666666666', '6666666666666', 37, '66666666666666', 1966, 24, '666'),
('765432567854', 'same author and publisher', 'ddd', NULL, 'no duplicates please', 0000, NULL, 'book'),
('777777777777', '777777777777', '77777777777', 36, '77777777777', 0000, 23, '777'),
('9780140268867', 'The Odyssey', 'https://images-na.ssl-images-amazon.com/images/I/51FR8mSgqoL._SX346_BO1,204,203,200_.jpg', 6, 'Description\r\nThe Odyssey is one of two major ancient Greek epic poems attributed to Homer. It is, in part, a sequel to the Iliad, the other Homeric epic. The Odyssey is fundamental to the modern Western canon; it is the second-oldest extant work of Western literature, while the Iliad is the oldest.', 1999, 5, 'Book'),
('9780140447927', 'The Idiot', 'https://images-na.ssl-images-amazon.com/images/I/51yvz7yNF6L._SX322_BO1,204,203,200_.jpg', 5, 'The Idiot is a novel by the 19th-century Russian author Fyodor Dostoevsky. It was first published serially in the journal The Russian Messenger in 1868–9', 2004, 5, 'Book'),
('9780141439495', 'Gulliver\'s Travels', 'https://images-na.ssl-images-amazon.com/images/I/513QIDycqxL._SX321_BO1,204,203,200_.jpg', 2, 'Gulliver\'s Travels, or Travels into Several Remote Nations of the World. In Four Parts. By Lemuel Gulliver, First a Surgeon, and then a Captain of Several Ships, is a prose satire by Irish writer and clergyman Jonathan Swift, that is both a satire on human nature and the \'travellers\' tales\' literary subgenre.', 2003, 5, 'Book'),
('9780436410550', 'Nineteen Eighty-Four', 'https://pictures.abebooks.com/isbn/9780436410550-us.jpg', 1, 'Nineteen Eighty-Four, often published as 1984, is a dystopian novel by English writer George Orwell published in June 1949. The novel is set in the year 1984 when most of the world population have become victims of perpetual war, omnipresent government surveillance and propaganda.', 1999, 1, 'Book'),
('9780684801223', 'The Old Man and the Sea', 'https://images-na.ssl-images-amazon.com/images/I/411pakPjvdL._SX326_BO1,204,203,200_.jpg', 7, 'Description\r\nThe Old Man and the Sea is a short novel written by the American author Ernest Hemingway in 1951 in Cuba, and published in 1952. It was the last major work of fiction by Hemingway that was published during his lifetime.', 1995, 6, 'Book'),
('9780743482752', 'Much Ado About Nothing', 'https://images-na.ssl-images-amazon.com/images/I/51Q8CdztbqL._SX304_BO1,204,203,200_.jpg', 3, 'Description\r\nMuch Ado About Nothing is a comedy by William Shakespeare thought to have been written in 1598 and 1599, as Shakespeare was approaching the middle of his career. The play was included in the First Folio, published in 1623.', 2004, 3, 'Book'),
('9780743487733', 'The Time Machine', 'https://images-na.ssl-images-amazon.com/images/I/51OcjfHW-2L._SX302_BO1,204,203,200_.jpg', 4, 'Description\r\nThe Time Machine is a science fiction novella by H. G. Wells, published in 1895 and written as a frame narrative. The work is generally credited with the popularization of the concept of time travel by using a vehicle that allows an operator to travel purposely and selectively forwards or backwards in time.', 2004, 4, 'Book'),
('9781420922530', 'Hamlet', 'https://images-na.ssl-images-amazon.com/images/I/51u6sYkanoL._SX331_BO1,204,203,200_.jpg', 3, 'Description\r\nThe Tragedy of Hamlet, Prince of Denmark, often shortened to Hamlet, is a tragedy written by William Shakespeare at an uncertain date between 1599 and 1602. Set in Denmark, the play dramatises the revenge Prince Hamlet is called to wreak upon his uncle, Claudius, by the ghost of Hamlet\'s father, King Hamlet.', 2005, 2, 'Book'),
('9783462027310', 'Im Westen nichts Neues', 'https://images-na.ssl-images-amazon.com/images/I/51DRW0PBXYL._SX305_BO1,204,203,200_.jpg', 8, 'All Quiet on the Western Front is a novel by Erich Maria Remarque, a German veteran of World War I. The book describes the German soldiers\' extreme physical and mental stress during the war, and the detachment from civilian life felt by many of these soldiers upon returning home from the front.', 1998, 7, 'Book'),
('9783518460740', 'Städtebeschimpfungen', 'https://www.suhrkamp.de/cover/200/46074.jpg', 9, 'Augsburg, das muffige verabscheuungswürdige Nest, die Lechkloake. Überhaupt: Salzburg, Augsburg, Regensburg, Würzburg, ich hasse sie alle, weil in ihnen jahrhundertelang der Stumpfsinn warmgestellt ist. Bremen verabscheute ich vom ersten Moment an, es ist eine kleinbürgerliche unzumutbare sterile Stadt. Übrigens Trier: Man geht nicht ungestraft nach Trier / man geht nach Trier und macht sich lächerlich.', 2016, 8, 'Book'),
('9783705527072', 'Kernbereiche Psychologie und Philosophie, Schüler/innen-CD-ROM', 'https://c.wgr.de/i/artikel/283x/370-552707.webp', 11, 'Zahlreiche interaktive Übungen und Animationen zum besseren Verständnis von Psychologie und Philosophie. Ausführliches Wiederholen jedes Kernbereichs mit anschaulichen und abwechslungsreichen Methoden. Umfangreiches Lern-Quiz und Checklisten zu jedem Kernbereich. Interaktive Beispiele zu Wahrnehmungstäuschungen. Verschiedene Lerntypentests. Lerntipps mit Übungen. Intuitionstest mit 50 Fragen. Gesprächsformen und Präsentieren mit Übungen. Kommunikationstypentest. Vier-Ohren-Test. Zeitreisen: Persönlichkeiten der Psychologie und Philosophie. Lexikon', 2011, 10, 'CD'),
('9999999999999', 'Will I work', 'https://images-na.ssl-images-amazon.com/images/I/51zXumFxDpL._SX308_BO1,204,203,200_.jpg', 30, 'A SQL Query walks into a bar. In one corner of the bar are two tables. The Query walks up to the tables and asks: - Mind if I join you?', 2019, 21, 'book');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `size` varchar(6) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `name`, `address`, `size`) VALUES
(1, 'Harvill Secker', 'somewhere in London, UK', 'small'),
(2, 'Digireads.com', 'who knows where', 'small'),
(3, 'Washington Square Press', 'no idea where', 'small'),
(4, 'Simon & Schuster', '1230 6th Ave, New York, NY 10020, USA', 'big'),
(5, 'Penguin Classics', 'somewhere in London, UK', 'big'),
(6, 'Scribner', '1230 Avenue of the Americas, 10th, New York, NY, 10020', 'medium'),
(7, 'KiWi-Taschenbuch', 'if I knew where', 'medium'),
(8, 'Suhrkamp', 'Pappelallee 78-79 10437 Berlin', 'medium'),
(9, 'absolut MEDIEN (AL!VE)', 'is it a srecret or what?', 'small'),
(10, 'Westermann Gruppe', 'Hainburger Str. 33, 1030 Wien, AT)', 'small'),
(17, 'test-publisher', 'test-address', 'mega'),
(18, 'hello', 'hello', 'hello'),
(19, 'bye', 'bye', 'bye'),
(20, 'working', 'nowhere', 'mega'),
(21, 'Vivaldi books', 'Thunder street', 'small'),
(22, 'Vivaldi books', 'Thunder street', 'big'),
(23, '77777777777', '777777777777', '777'),
(24, '666666666', '66666666666', '6666'),
(25, '44444444444', '44444444444', '44'),
(26, 'test', 'test', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `fk_author_id` (`fk_author_id`),
  ADD KEY `fk_publisher_id` (`fk_publisher_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`fk_author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`fk_publisher_id`) REFERENCES `publishers` (`publisher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
