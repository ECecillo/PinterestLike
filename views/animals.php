<?php
session_start();
require_once ('../config/configuration.php');
require_once ('.'.PATH_LIB . 'bd.php');
require_once ('.'.PATH_LIB . 'utilisateur.php');
require_once ('.'.PATH_LIB . 'discussion.php');
require_once ('.'.PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName); // Connexion base de donnée
if (isset($_POST["logout"])) {

  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);

  if ($check) {
    setDisconnected($_SESSION["pseudo"], $link);
    session_unset();
    header('Location: ../home.php');
    exit();
  }
}
if (isset($_POST["edit"])) {
  $role=get_role($link);
  if($role !='root'){
    header('Location: User_profile.php ');
  }
  else{
    $_SESSION["current_image"]=$_POST["image_now"];
    header('Location: editImage.php ');
  }
}
  if (isset($_POST["delete"])) {
    $role=get_role($link);
    if($role !='root'){
      echo "<div>you are not root<div> </br>";
    }
    else{
      unlink("../assets/img/".$_POST["image_now"]."");
      $image_delete=$_POST['image_now'];
      $query  ="DELETE FROM  Photo WHERE nomFich='$image_delete'";
        executeUpdate($link, $query);

    }

  }

?>

<?php include('v_head_category.php'); ?>

<body>

  <?php include('headers_category.php'); ?>

  <!-- Partie sur les images  -->
  <div class="container" style="margin-top: 2rem;">
  <h1><strong>Galery Photo: Naturals</strong></h1>
  <!-- Affichage des jeux  -->
  <div>
    <div class="photo-grid" id="fill_image" style="margin: 1rem 1rem;">
      <?php
        echo fill_image_animals($link, PATH_IMG_FROM_VIEWS); // Affiche les images qui sont dans la catégorie animals, cf voir le fichier addfunction.php dans lib.
      ?>
    </div>
  </div>
  </div>
</body>

</html>
