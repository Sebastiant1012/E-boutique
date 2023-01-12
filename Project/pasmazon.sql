-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2022 at 07:44 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasmazon`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_titre`) VALUES
(1, 'Auto'),
(2, 'Cuisine'),
(3, 'Maison'),
(4, 'Electronique');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `com_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_prixTotal` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`com_id`, `user_id`, `prod_prixTotal`, `date`) VALUES
(1, 1, '100', '06-10-2022'),
(2, 2, '200', '05-10-2022'),
(3, 2, '29', '13-10-2022'),
(4, 2, '29', '13-10-2022'),
(5, 2, '57', '13-10-2022'),
(6, 2, '147', '13-10-2022');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `prod_id` int(11) NOT NULL,
  `prod_nom` varchar(50) NOT NULL,
  `prod_prix` varchar(50) NOT NULL,
  `prod_image` varchar(50) NOT NULL,
  `prod_desc` varchar(200) NOT NULL,
  `prod_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`prod_id`, `prod_nom`, `prod_prix`, `prod_image`, `prod_desc`, `prod_cat`) VALUES
(3, 'Ustensiles de cuisine', '40', 'Ustensiles_de_cuisine', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida vestibulum lorem, id venenatis urna.\n', 2),
(5, 'OxiClean', '15', 'OxiClean', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida vestibulum lorem, id venenatis urna.', 3),
(6, 'Swiffer', '36', 'Swiffer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida vestibulum lorem, id venenatis urna.', 3),
(7, 'Station de charge', '59', 'Station_de_charge', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida vestibulum lorem, id venenatis urna.', 4),
(8, 'Depoussiereur', '60', 'Depoussiereur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida vestibulum lorem, id venenatis urna.', 4),
(9, 'GPS', '22', 'GPS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida vestibulum lorem, id venenatis urna. ', 1),
(10, 'Support_de_telephone', '65', 'Support_de_telephone', 'support ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produit_commande`
--

CREATE TABLE `produit_commande` (
  `com_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_prix` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produit_commande`
--

INSERT INTO `produit_commande` (`com_id`, `prod_id`, `prod_qty`, `prod_prix`) VALUES
(1, 1, 2, '198'),
(1, 2, 3, '84'),
(2, 4, 1, '74'),
(2, 6, 10, '360'),
(5, 2, 1, '28'),
(5, 3, 1, '29'),
(6, 5, 5, '75'),
(6, 6, 2, '72');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nom`, `prenom`, `email`, `password`, `usertype`) VALUES
(1, 'Jack', 'Daniel', 'jack_daniel@gmail.com', 'Drunk101', 1),
(2, 'Bob', 'Mario', 'bob_mario@gmail.com', 'Luigi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL,
  `type_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_id`, `type_nom`) VALUES
(1, 'Standard'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
