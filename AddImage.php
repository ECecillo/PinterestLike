<?php
session_start();
require_once('./config/configuration.php'); // Fichier où l'on a toute les constantes
require_once(PATH_LIB . 'bd.php'); // Fichier qui gère l'execution des requetes, l'envoie ..
require_once(PATH_LIB . 'utilisateur.php'); // Fichier où l'on a mis les fonctions liés à la table utilisateur
require_once(PATH_LIB . 'discussion.php'); // 
require_once(PATH_LIB . 'add_funct.php'); // Toute les fonctions que l'on a déclaré jusqu'à maintenant


$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

if (isset($_POST["validate"])) { 
  $nameImage = pathinfo($_FILES['Image']['name']); // Donne le nom de l'image quand on fait parcourir
  $extension = $nameImage['extension']; // Retourne son format
  $extension_accept = array("jpeg", "jpg", "gif", "png"); // On vérifie que le format respect les consignes
  if (!(in_array($extension, $extension_accept))) {
    echo "File does not have expected extension. </br>";
  }
  $size_max = 104860; // Taille max du fichier
  $size_Image = filesize($_FILES['Image']['tmp_name']); //Récupère la taille du fichier fournie
  if ($size_Image > $size_max) { 
    echo "You have exceeded the allowed file size. </br>";
  } else {
    $description = $_POST["Description"];
    $pseud = $_SESSION["pseudo"];
    $cate = $_POST["Category"];
    $constName = $description . '_' . $pseud . '.' . $extension;

    $destination_directory = dirname(__FILE__) . "/assets/img/"; // On met dans la variable le chemin vers le dossier où l'on les images
    move_uploaded_file($_FILES["Image"]["tmp_name"], $destination_directory . $constName); // fonction qui va déplacer la nouvelle image vers ce dossier
    $req = "INSERT INTO Photo(nomFich,`description`,catId) VALUES ('$constName', '$description',  '$cate')"; // La requête sql qui ajoute l'image dans la bdd
    executeUpdate($link, $req);
    header('Location: description.php');
  }
}

?>

<?php include(PATH_VIEWS . 'v_head.php'); ?>


<body>
  <?php include(PATH_VIEWS . 'header.php'); ?>
  <!-- à compléter -->
  <h1 style="text-align: center; color:red">Add Image</h1>
  <form enctype="multipart/form-data" action="AddImage.php" style="border:2px solid #ccc; border-radius: 30px;" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <label for="image"><b>Add image:</b></label>
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <input type="file" name="Image" value="parcourir" required>
        <br>
        <br>
        <label for=""><b>Categorie: </b></label>
        <select id="Image" name="Category" required>
          <option value=""> select a Category </option>
          <?php echo fill_category($link); ?>
        </select>
        <br>
        <br>
        <label for="image"><b> Description: </b></label>
        <input type="text" placeholder="Enter Description" name="Description" required>
        <br>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <button type='submit' class='btn btn-outline-success btn-lg valider' name='validate'><b>Validate</b></button>
      </div>
    </div>
  </form>
</body>

</html>