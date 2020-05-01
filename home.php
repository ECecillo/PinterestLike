<?php
session_start();
require_once ('./config/configuration.php');
require_once (PATH_LIB . 'bd.php');
require_once (PATH_LIB . 'utilisateur.php');
require_once (PATH_LIB . 'discussion.php');
require_once (PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link)== TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    $_SESSION["pseudo"]= '';
    $_SESSION["mdp"]='';
    $_SESSION["logged"]="no";
    header('Location: home.php');
    exit();
  }
}


?>

<?php include(PATH_VIEWS . 'v_head.php'); ?>

<body>
  <?php include(PATH_VIEWS . 'header.php'); ?>

  <?php if (isset($_SESSION["logged"])){
  if ($_SESSION["logged"]=="yes") {
    echo "<h1><strong>Welcome ".$_SESSION['pseudo']." <br/></strong></h1>";
    echo AffDate($_SESSION["date"]);
  }
}
echo"</br> </br>";
if (isset($_POST["edit"])) {
  $role=get_role($link);
  if($role !='root'){
    echo "<div>you are not root<div> </br>";
  }
  else{
    $_SESSION["current_image"]=$_POST["image_now"];
    header('Location: ./views/editImage.php ');
  }

}

echo"</br> </br>";
if (isset($_POST["delete"])) {
  $role=get_role($link);
  if($role !='root'){
    echo "<div>you are not root<div> </br>";
  }
  else{
    unlink("assets/img/".$_POST["image_now"]."");
    $image_delete=$_POST['image_now'];
    $query  ="DELETE FROM  Photo WHERE nomFich='$image_delete'";
      executeUpdate($link, $query);

  }

}
   ?>

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

  <h1><strong>Galery Photo</strong></h1>
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
