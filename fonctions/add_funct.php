<?php
/* Récupère le nom des images dans la base de donnée */

function get_all_image ($link) {
    $query = "SELECT nomFich from `Photo` WHERE pseudo ='$pseudo' and mdp ='$hashPwd';";
}