<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';
require_once 'fonctions/discussion.php';
require_once 'fonctions/add_funct.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinterrest</title>
  <!-- Css Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Js Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <!-- Logo -->
  <link rel="icon" href="assets/img/pinter.png" type="image/icon type">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" href="materialize.css">
  <!-- Mon style -->
  <style>
    @import url('style.css');
  </style>
  <!-- Mon script -->
  <link rel="script" href="./script.js">
</head>

<body>

  <!-- Partie sur la navbar -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <header>
    <div class="menu-toggle" id="hamburger">
      <i class="fas fa-bars"></i>
    </div>
    <div class="overlay"></div>
    <div class="container">
      <nav>
        <h1 class="brand"><a href="home.php">Pin<span>ter</span>est</a></h1>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li style="margin-top: -0.5625rem;">
            <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Category &#8659;
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="Naturals.php">Naturals</a>
              <a class="dropdown-item" href="animals.php">Animals</a>
              <a class="dropdown-item" href="life.php>">Life</a>
            </div>
          </li>
          <li>
            <a href="./views/login.php">Login <i class="material-icons">face</i></a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Partie sur les images  -->

  <div class="category_paragraph">
    <p>Which pictures do you wanna show ? </p> <br>
  </div>
  <div class="category_selector">
    <div class="btn-group dropright">
      <form method="post" action="home.php">
        <select id="Image" name="Image">
          <option value=""> All images </option>
          <?php echo fill_category($link); ?>
        </select>
        <input type="submit" name="Valider" value="OK" />
      </form>
    </div>
  </div>
  

  <!-- Affichage des jeux  -->
  <div style="margin: 1rem 15rem;">
    <h1><strong>Galery Photo</strong></h1>
    <div class="photo-grid" id="fill_image">
      <?php
      echo fill_image($link);
      ?>
    </div>
  </div>
</body>

</html>