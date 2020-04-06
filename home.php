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
    $_SESSION["pseudo"]= $pseudo;
    $_SESSION["mdp"]= $pwd;
    setConnected($pseudo, $link);
    header('Location: chat.php?subscribe=yes');
    exit();
  }
  else {
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
    
      <!-- Affichage des jeux  -->
      <div>
        <div class="photo-grid" style="margin: 1rem 1rem;">
          <!-- 1er message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image: var(--bg-I1);" alt="Image d'un jeu de mémoire du nom de Memoria">
            <!-- <a class="" href="">
              <span></span>
            </a> -->
            <div class="module">
              <header>
                <h6 class="title">
                  <b> Memoria </b>
                </h6>
              </header>
            </div>
          </div>
          <!-- 2ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I2);" alt="Image d'un jeu de mémoire type Window">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  2
                </h6>
              </header>
            </div>
          </div>
          <!-- 3ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I3);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  3
                </h6>
              </header>
            </div>
          </div>
          <!-- 4ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I4)" alt="Une autre Image d'un jeu Window">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  4
                </h6>
              </header>
            </div>
          </div>
          <!-- 5ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I5);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  5
                </h6>
              </header>
            </div>
          </div>
          <!-- 6ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I6);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  6
                </h6>
              </header>
            </div>
          </div>
          <!-- 7ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I7);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  7
                </h6>
              </header>
            </div>
          </div>
          <!-- 8ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I8);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  8
                </h6>
              </header>
            </div>
          </div>
          <!-- 9ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I9);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  9
                </h6>
              </header>
            </div>
          </div>
          <!-- 10ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I10);">
            <a class="" href="script.js">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  10
                </h6>
              </header>
            </div>
          </div>
          <!-- 11ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I11);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  11
                </h6>
              </header>
            </div>
          </div>
          <!-- 12ieme message ----------------------------------------------------------------- -->
          <div class="card card-tall" style="background-image:var(--bg-I12);">
            <a class="" href="">
              <span></span>
            </a>
            <div class="module">
              <header>
                <h6 class="title">
                  12
                </h6>
              </header>
            </div>
          </div>

        </div>
      </div>
</body>
</html>