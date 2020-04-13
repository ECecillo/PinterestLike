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
            VALUES (1,"brunel-johnson-k8zVbh6Duk0-unsplash","Man in a Street",3);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (2,'https://images.unsplash.com/photo-1545559054-8f4f9e855781?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80',"stars",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (3,"david-clode-CGSFeqa3kG0-unsplash","monkey",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (4,"charles-deluvio-AQRp2NH-O8k-unsplash","dog",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (5,"https://images.unsplash.com/photo-1584709521360-ff0f5bbda444?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=691&q=80","insecte2",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (6,"https://images.unsplash.com/photo-1557008075-7f2c5efa4cfd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=642&q=80","fox",2);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (7,"danny-giebe-VOG9q8Kz4XA-unsplash","Montain day",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (8,"voy-zan-R44UWCU7pwg-unsplash","Montain",1);
INSERT INTO Photo(photoId,nomFich,description,catId)
            VALUES (9,'annie-spratt-ccjLnZC8hT4-unsplash',"stuff",3);
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