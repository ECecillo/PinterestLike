<?php

$historySize = 10;// modifiable

/*Cette fonction renvoie un tableau (array) des $nbRecord derniers enregistrements triés par ordre chronologique inversé (les plus récents d'abord) sur la date et l'heure.
Un enregistrement est une chaine de caractères de la forme "auteur;valeur;date;heure;type".*/
function getHistory($nbRecord, $link)
{
	$query = "SELECT * FROM `message` ORDER BY message.date ASC, heure ASC LIMIT $nbRecord;";
	$result = executeQuery($link, $query);
	return $result;
}

/*Cette fonction prend en entrée un nouveau message soumis par un utilisateur et stocke le message
dans la relation message avec la date de soumission au format 'Y-m-d' et l'heure au format 'H:i:s' via la connexion active $link. Le type sera 'texte'.
Il faudra faire attention à échapper les caractères spéciaux du message pour qu'ils ne soient pas interprétés par la base de données. Une méthode mysqli permet
de gérer automatiquement cet échappement de caractères.*/
function submitMessage($auteur, $message, $link)
{
	$date_message = date('Y-m-d');
	$heure_message = date('H:i:s');
	// $msg = mysqli_escape_string($link, $message);
	$query="INSERT INTO `message` (auteur, `message`.`date`, heure, valeur, `message`.`type`) VALUES ('$auteur', '$date_message', '$heure_message' , '$message' ,'texte')";
	$result = executeUpdate($link, $query);
	return $result;
}

/*Cette fonction prend en entrée un nouveau message soumis par un utilisateur et stocke le message
dans la relation message avec la date de soumission au format 'Y-m-d' et l'heure au format 'H:i:s' via la connexion active $link. Le type sera 'image'.
Il faudra faire attention à échapper les caractères spéciaux du message pour qu'ils ne soient pas interprétés par la base de données. Une méthode mysqli permet
de gérer automatiquement cet échappement de caractères.*/
function submitImage($auteur, $imgLink, $link)
{
	// Optionnel, à compléter
}

/*Cette fonction prend en entrée un nouveau message soumis par un utilisateur et stocke le message
dans la relation message avec la date de soumission au format 'Y-m-d' et l'heure au format 'H:i:s' via la connexion active $link. Le type sera 'video'.
Il faudra faire attention à échapper les caractères spéciaux du message pour qu'ils ne soient pas interprétés par la base de données. Une méthode mysqli permet
de gérer automatiquement cet échappement de caractères.*/
function submitVideo($auteur, $videoLink, $link)
{
	// Optionnel, à compléter
}

?>
