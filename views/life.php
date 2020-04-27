<?php
session_start();
require_once ('../config/configuration.php');
require_once ('.'.PATH_LIB . 'bd.php');
require_once ('.'.PATH_LIB . 'utilisateur.php');
require_once ('.'.PATH_LIB . 'discussion.php');
require_once ('.'.PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);
  echo $_SESSION["pseudo"];

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link)== TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    $_SESSION["pseudo"]= '';
    $_SESSION["mdp"]='';
    $_SESSION["logged"]="no";
    header('Location: ../home.php');
    exit();
  }
}


?>
<?php include('v_head_category.php'); ?>

<body>

  <?php include('headers_category.php'); ?>

  <?php  if (isset($_SESSION["logged"])){
   if ($_SESSION["logged"]=="yes") {
    echo "<h1><strong>Welcome ".$_SESSION['pseudo']." <br/></strong></h1>";
    echo AffDate($_SESSION["date"]);
  }
}
   ?>

  <!-- Partie sur les images  -->

  <h1><strong>Galery Photo: Naturals</strong></h1>
  <!-- Affichage des jeux  -->
  <div>
    <div class="photo-grid" id="fill_image" style="margin: 1rem 1rem;">
      <?php
        echo fill_image_life($link);
      ?>
    </div>
  </div>
</body>

</html>
