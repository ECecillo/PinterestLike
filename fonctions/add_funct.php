<?php
/* Récupère le nom des images dans la base de donnée */

function get_all_image ($link) {
    $query = "SELECT nomFich from `Photo`;";
    $result = executeQuery($link, $query);
    return $result;
}

function get_alt ($link) {
    $query = "SELECT `Photo.description` from `Photo`;";
    $result = executeQuery($link, $query);
    return $result;
}