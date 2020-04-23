<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';
require_once 'fonctions/discussion.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

function fill_image($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='Animals';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $output.= "
      <img src='assets/img/".$uneimage['nomFich']."' data-toggle='modal' data-target='#".$uneimage['nomFich']."' class='card card-tall'  alt=''>
      </img>
      <!-- Modal -->
      <div class='modal fade' id='".$uneimage['nomFich']."'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:650px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Description sheet</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='assets/img/".$uneimage['nomFich']."'  style='width: 250px;height: 250px;margin-right:20px;' align='left'>
            <div> Description: ".$uneimage['description']."</div>
          <div>File Name: ".$uneimage['nomFich']."</div>
          <div>Category: ".$uneimage['nomCat']."</div>
            </div>
          </div>
        </div>
      </div>";
      $nbImage++;
    }
  return $output;
}
/* $alt = get_alt($link); */

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
              <a class="dropdown-item" href="Naturals.php" style="margin-left: 0px;margin-right: 0px;">Naturals</a>
              <a class="dropdown-item" href="animals.php" style="margin-left: 0px;margin-right: 0px;">Animals</a>
              <a class="dropdown-item" href="life.php>" style="margin-left: 0px;margin-right: 0px;">Life</a>
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
  <div style="margin: 1rem 15rem;">
    <h1><strong>Galery Photo: Naturals</strong></h1>
    <!-- Affichage des jeux  -->
    <div>
      <div class="photo-grid" id="fill_image">
        <?php
        echo fill_image($link);
        ?>
      </div>
    </div>
  </div>
</body>

</html>
