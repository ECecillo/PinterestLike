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

  <?php
  if (isset($_POST["edit"])) {
     $role=get_role($link);
     if($role =='root'){
       $_SESSION["current_image"]=$_POST["image_now"];
       header('Location: editImage.php');
     }
     else{
     echo "<div>you are not root<div> </br>";
     }
   }
   echo "</br> </br>";
   include('headers_category.php'); ?>

  <?php  if (isset($_SESSION["logged"])){
    if ($_SESSION["logged"]=="yes") {
    echo "<h1><strong>Welcome ".$_SESSION['pseudo']." <br/></strong></h1>";
    echo AffDate($_SESSION["date"]);
  }
}
echo"</br> </br>";
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

  <!-- Partie sur les images  -->

  <h1><strong>Galery Photo: Animals</strong></h1>
  <!-- Affichage des jeux  -->
  <div>
    <div class="photo-grid" id="fill_image" style="margin: 1rem 1rem;">
      <?php
        echo fill_image_animals($link,PATH_IMG_FROM_VIEWS);
      ?>
    </div>
  </div>
</body>

</html>
