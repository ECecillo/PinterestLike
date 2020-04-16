<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';
require_once 'fonctions/discussion.php';
require_once 'fonctions/add_funct.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
function fill_category($link)
{
  $output='';
  $query = "SELECT * from `Categorie`;";
  $result = executeQuery($link, $query);
  $cat=$result;
  foreach ($cat as $cat1) {
    $output .=  '<option value="'.$cat1["catId"].'">'.$cat1["nomCat"].'</option>';

 }
 return $output;
}

function fill_image($link)
{
  if (isset($_POST['Valider']))
  {
    $image=$_POST['Image'];
    $output='';
    if(($image=='')){
      $query = "SELECT nomFich from `Photo`;";
    }
    else{
       $query = 'SELECT * FROM Photo WHERE catId='.$image.'';

    }
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $output.= "
      <div class='card card-tall' style='background-image: url(./assets/img/". $uneimage['nomFich'] . ");' alt=''>
        <a class='' href=''>
          <span></span>
        </a>
      </div>";
      $nbImage++;
    }
    return $output;
  }
}
/* $alt = get_alt($link); */

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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <!-- Logo -->
  <link rel="icon" href="./img/pinter.png" type="image/icon type">
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
          <li><a href="#">Home</a></li>
          <li><a href="#">Add Pictures</a></li>
          <li><a href="#">More</a></li>
          <li><a href="./views/login.php">Login</a></li>
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
      <select id="Image"name="Image">
        <option value=""> select a Category </option>
        <?php echo fill_category($link);?>
        </select>
           <input type="submit" name="Valider" value="OK"/>
    </form>
    </div>
  </div>

  <h1><strong>Toutes les photos</strong></h1>
  <!-- Affichage des jeux  -->
  <div>
    <div class="photo-grid" id="fill_image" style="margin: 1rem 1rem;">
      <?php
        echo fill_image($link);
      ?>
    </div>
  </div>
</body>

</html>
