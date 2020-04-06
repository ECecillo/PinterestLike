<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';

$stateMsg = "";

if (isset($_POST["valider"])) {
  $pseudo = $_POST["pseudo"];
  $hashMdp = md5($_POST["mdp"]);

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($pseudo, $hashMdp, $link);

  if (getUser($pseudo, $hashMdp, $link) == TRUE) {
    $_SESSION["pseudo"] = $pseudo;
    $_SESSION["mdp"] = $pwd;
    setConnected($pseudo, $link);
    header('Location: chat.php?subscribe=yes');
    exit();
  } else {
    $stateMsg = "Le couple pseudo/mot de passe ne correspond à aucun utilisateur enregistré";
  }
  echo $stateMsg;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Css Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Js Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Mon style -->
  <style>
    @import url('style.css');
  </style>
</head>

<body>

                                                            <!-- Partie sur la navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Navbar</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
                                                      <!-- Partie sur les images  -->

  <h1><strong>Toutes les photos</strong></h1>
  <!-- Affichage des jeux  -->
  <div>
    <div class="photo-grid" style="margin: 1rem 1rem;">
      <!-- 1er message ----------------------------------------------------------------- -->
      <div class="card card-tall" style="background-image: var(--bg-I1);" alt="">
        <a class="" href="">
          <span></span>
        </a>

      </div>
      <!-- 2ieme message ----------------------------------------------------------------- -->
      <div class="card card-tall" style="background-image:var(--bg-I2);" alt="">
        <a class="" href="">
          <span></span>
        </a>

      </div>
      <!-- 3ieme message ----------------------------------------------------------------- -->
      <div class="card card-tall" style="background-image:var(--bg-I3);">
        <a class="" href="">
          <span></span>
        </a>

      </div>
      <!-- 4ieme message ----------------------------------------------------------------- -->
      <div class="card card-tall" style="background-image:var(--bg-I4)" alt="">
        <a class="" href="">
          <span></span>
        </a>

      </div>
      <!-- 5ieme message ----------------------------------------------------------------- -->
      <div class="card card-tall" style="background-image:var(--bg-I5);">
        <a class="" href="">
          <span></span>
        </a>

      </div>
      <!-- 6ieme message ----------------------------------------------------------------- -->
      <div class="card card-tall" style="background-image:var(--bg-I6);">
        <a class="" href="">
          <span></span>
        </a>

      </div>

    </div>
  </div>
</body>

</html>