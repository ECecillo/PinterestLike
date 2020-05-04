<?php
session_start();
require_once('./config/configuration.php'); // Fichier où l'on a toute les constantes
require_once(PATH_LIB . 'bd.php'); // Fichier qui gère l'execution des requetes, l'envoie ..
require_once(PATH_LIB . 'utilisateur.php'); // Fichier où l'on a mis les fonctions liés à la table utilisateur
require_once(PATH_LIB . 'discussion.php'); // 
require_once(PATH_LIB . 'add_funct.php'); // Toute les fonctions que l'on a déclaré jusqu'à maintenant

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName); // Connection à la BDD.

if (isset($_POST["edit"])) { // Si l'admin est connecté et qu'il clique sur modifier on le redirige sur la page edit de la photo qu'il a selectionné que l'on stock dans la session
  $role=get_role($link);
  if($role =='root'){
    $_SESSION["current_image"]=$_POST["image_now"];
    header('Location: views/editImage.php');
  }
  else { // Si c'est un utilisateur lambda on le redirige sur sa page de profil où là il gérera ces propres photos
    header('Location: views/User_profile.php');
  }
}
if (isset($_POST["delete"])) { // Si le root est connecté il peut supprimer une image
  $role = get_role($link);
  if ($role != 'root') {
    echo "<div>You are not root<div> </br>";
  } else {
    unlink("assets/img/" . $_POST["image_now"] . "");
    $image_delete = $_POST['image_now'];
    $query  = "DELETE FROM  Photo WHERE nomFich='$image_delete'";
    executeUpdate($link, $query);
  }
}

if (isset($_POST["logout"])) { // Si l'utilisateur appuie sur le bouton logout on change l'état dans la bdd et on réinitialise la session
  $pseudo = $_SESSION['pseudo'];
  $mdp = $_SESSION['mdp'];
  $check = getUser($pseudo, $mdp, $link); // cherche si l'utilisateur est bien dans la bdd

  if ($check) {
    setDisconnected($pseudo, $link);
    session_unset();
    header('Location: home.php');
    exit();
  }
}


?>

<?php include(PATH_VIEWS . 'v_head.php'); ?>

<body>
  <?php include(PATH_VIEWS . 'header.php'); ?>
  <!-- Partie sur les images  -->

  <div class="category_paragraph">
    <p>Which pictures do you wanna show ? </p> <br>
  </div>
  <div class="category_selector">
    <div class="btn-group dropright">
      <form method="post" action="home.php">
        <select id="Image" name="Image">
          <option value=""> All images </option>
          <?php echo fill_category($link); ?> <!-- Affiche le dropdown qui est déclaré dans lib/addfucntion.php -->
        </select>
        <input type="submit" name="Valider" value="OK" />
      </form>
    </div>
  </div>
  <div class="container">
    <h1><strong>Galery Photo</strong></h1>
    <!-- Affichage des jeux  -->
    <div>
      <div class="photo-grid" id="fill_image" style="margin: 1rem 1rem;">
        <?php
        echo fill_image($link); // Affichage des photos
        ?>
      </div>
    </div>
  </div>
</body>

</html>