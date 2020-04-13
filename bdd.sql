-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Février 2018 à 16:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `Projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE IF NOT EXISTS Categorie (
  catId INT NOT NULL,
  nomCat varchar(255) NOT NULL,
  PRIMARY KEY(catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO Categorie (catId,nomCat)
            VALUES  (1, 'Naturals');
INSERT INTO Categorie (catId,nomCat)
            VALUES  (2, 'Animals');
INSERT INTO Categorie (catId,nomCat)
            VALUES  (3, 'Life');
-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS Photo (
  photoId int NOT NULL,
  nomFich varchar(250) NOT NULL,
  description varchar(250) NOT NULL,
  catId int NOT NULL,
  PRIMARY KEY (photoId),
  FOREIGN KEY (catId) REFERENCES Categorie(catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (1,'street.jpeg',"Street",3);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (2,'stars.jpeg',"stars",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (3,'birds',"birds",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (4,'bats.jpeg',"bats",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (5,'city.jpeg',"bats",3);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (6,'dog.jpeg',"bats",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (7,'rock.jpeg',"bats",1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;