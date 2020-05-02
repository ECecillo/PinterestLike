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
  photoId int NOT NULL AUTO_INCREMENT,
  nomFich varchar(250) NOT NULL,
  description varchar(250) NOT NULL,
  catId int NOT NULL,
  PRIMARY KEY (photoId),
  FOREIGN KEY (catId) REFERENCES Categorie(catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO Photo(nomFich,description,catId)
            VALUES ('street.jpeg',"Street",3);
INSERT INTO Photo(nomFich,description,catId)
            VALUES ('stars.jpeg',"stars",1);
INSERT INTO Photo(nomFich,description,catId)
            VALUES ('birds.jpeg',"birds",2);
INSERT INTO Photo(nomFich,description,catId)
            VALUES ('bat.jpeg',"bats",2);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE TABLE IF NOT EXISTS `utilisateur` (
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO utilisateur(pseudo,mdp,role,etat)
    VALUES ('root','63a9f0ea7bb98050796b649e85481845','root','disconnected');

INSERT INTO utilisateur(pseudo,mdp,role,etat)
    VALUES ('zozolito','6edb4f777954ca01cba741d44ca5f6f1','user','disconnected');
