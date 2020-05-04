<?php
session_start();
require_once ('../config/configuration.php');
require_once ('.'.PATH_LIB . 'bd.php');
require_once ('.'.PATH_LIB . 'utilisateur.php');
require_once ('.'.PATH_LIB . 'discussion.php');
require_once ('.'.PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

if (isset($_POST["edit-root"])) { // ceci s'applique quand on passe par le root pour l'utilisateur on a simplement fais une redirection à partir du profile
  $image=$_SESSION["current_image"];
  $extension = substr(strrchr($image,'_'),1);

  rename(. PATH_IMG_FROM_VIEWS .$_SESSION["current_image"]."",. PATH_IMG_FROM_VIEWS .$_POST["editDescription"]."_".$extension.""); // On rénome la photo dans le dossier assets/images
  $current_image = $_SESSION["current_image"];
  $editFile= "".$_POST["editDescription"]."_".$extension."";
  $editDescription=$_POST["editDescription"];
  $cat=$_POST['editCategory'];
  $query  ="UPDATE Photo SET  nomFich='$editFile', catId='$cat', description='$editDescription' WHERE nomFich='$current_image'";
    executeUpdate($link, $query);

}

if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);
  echo $_SESSION["pseudo"];

  if ($check) {
    setDisconnected($_SESSION["pseudo"], $link);
    session_unset();
    header('Location: ../home.php');
    exit();
  }
}

$category = fill_category($link);

?>
<?php include('v_head_category.php'); ?>

<body>

  <?php include('headers_category.php'); ?>

  <div class="container shadow_container">
    <div class="photo-grid" style="margin: 1rem 1rem;"> <!-- class="desc_image" -->
      <?php
        echo "
        <img src='" . PATH_IMG_FROM_VIEWS . $_SESSION['current_image'] . "'  class='card card-tall'>
        <div style='display: flex;justify-content: center; font-size: 1.2rem'>
          <form  action='editImage.php' style='border:2px solid #ccc; border-radius: 30px;' method='POST'>
            <div class='container'>
              <div class='fillform' style='margin: 1rem;'>
                <label><b>Categorie: </b></label>
                <select id='Image' name='editCategory' required>
                  <option value=''> Select a Category </option>
                  ". $category ."
                </select>
                <br>
                <br>
                <input id='Imageid' name='editImage' type='hidden'>
                <label for='image'><b> Description: </b></label>
                <input type='text' placeholder='Enter Description' name='editDescription' required>
                <br>
              </div>
              <div class='butt' style='text-align: center; margin: 1rem;'>
                <button type='submit' class='btn btn-outline-success btn-lg valider' name='edit-root'><b>Edit</b></button>
              </div>
            </div>
          </form>
        </div";
      ?>
    </div>
  </div>
</body>

</html>
