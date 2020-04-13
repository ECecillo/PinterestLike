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
            VALUES (1,"https://images.unsplash.com/photo-1585858966705-2668b705fcb7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80","Street",3);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (2,'https://images.unsplash.com/photo-1545559054-8f4f9e855781?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80',"stars",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (3,"https://images.unsplash.com/photo-1444464666168-49d633b86797?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1349&q=80","birds",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (4,"https://images.unsplash.com/photo-1585974780732-05acf9f01c32?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=646&q=80","insecte",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (5,"https://images.unsplash.com/photo-1584709521360-ff0f5bbda444?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=691&q=80","insecte2",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (6,"https://images.unsplash.com/photo-1557008075-7f2c5efa4cfd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=642&q=80","fox",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (7,"https://images.unsplash.com/photo-1536536982624-06c1776e0ca8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80","Montain night",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (8,"https://images.unsplash.com/photo-1558258695-39d4595e049c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80","Montain",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (9,'https://images.unsplash.com/photo-1561436599-2f12fffd6c83?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80',"New-York",3);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (10,"https://images.unsplash.com/photo-1545334610-35dd6680f5bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80","lake",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (11,"https://images.unsplash.com/photo-1546074340-48089b234842?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80","Montain",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (12,"https://images.unsplash.com/photo-1531145877453-9b68a77926b9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80","bat",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (13,"https://images.unsplash.com/photo-1548092352-4944c775dd75?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=564&q=80","snow",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (14,"https://images.unsplash.com/photo-1518457607834-6e8d80c183c5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80","lava",1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;