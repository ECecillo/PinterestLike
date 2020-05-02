<?php
session_start();
require_once ('../config/configuration.php');
require_once ('.'.PATH_LIB . 'bd.php');
require_once ('.'.PATH_LIB . 'utilisateur.php');
require_once ('.'.PATH_LIB . 'discussion.php');
require_once ('.'.PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

if (isset($_POST["edit-root"])) {
  $image=$_SESSION["current_image"];
  $extension = substr(strrchr($image,'_'),1);

  rename("../assets/img/".$_SESSION["current_image"]."","../assets/img/".$_POST["editDescription"]."_".$extension."");
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

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link)== TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    $_SESSION["pseudo"]= '';
    $_SESSION["mdp"]='';
    $_SESSION["logged"]="no";
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
                <button type='submit' class='valider' name='edit-root'><b>Edit</b></button>
              </div>
            </div>
          </form>
        </div";
      ?>
    </div>
  </div>
</body>

</html>
