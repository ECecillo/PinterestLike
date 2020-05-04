<?php
session_start();
require_once('../config/configuration.php');
require_once('.' . PATH_LIB . 'bd.php');
require_once('.' . PATH_LIB . 'utilisateur.php');
require_once('.' . PATH_LIB . 'discussion.php');
require_once('.' . PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

$pseudo = $_SESSION['pseudo'];


if (isset($_POST['valider'])) { // récupère les infos entrées dans le formulaire
  $hashMdp = md5($_POST["mdp"]);
  $hashConfirmMdp = md5($_POST["mdp-repeat"]);
  if ($hashMdp == $hashConfirmMdp) {
    newPass($link, $hashMdp, $pseudo); // Fonction qui modifie le mot de passe de l'utilisateur dans la base de données en le cryptant, cf lib/addfucntion.php
    $_SESSION['mdp'] = $hashMdp;
    header('Location: User_profile.php'); // On recharge la page
  }
}


if (isset($_POST["logout"])) {
  $pseudo = $_SESSION['pseudo'];
  $mdp = $_SESSION['mdp'];
  $check = getUser($pseudo, $mdp, $link);

  if ($check) {
    setDisconnected($pseudo, $link);
    session_unset();
    header('Location: home.php');
    exit();
  }
}

if (isset($_POST["edit"])) { // L'utilisateur peut modifier les images où celles qui sont affichés sur sa page n'appartiennent qu'à lui donc pas besoin de checker son role
  $_SESSION["current_image"] = $_POST["image_now"];
  header('Location: editImage.php');
}

if (isset($_POST["delete"])) { // Pas non plus besoin de checker son role puisque ce sont ces images

  unlink("assets/img/" . $_POST["image_now"] . "");
  $image_delete = $_POST['image_now'];
  $query  = "DELETE FROM  Photo WHERE nomFich='$image_delete'";
  executeUpdate($link, $query);
}


?>
<?php include('v_head_category.php'); ?>

<body>
  <?php include('headers_category.php'); ?>
  <div class="container-user">
    <div class="info_profile">
      <div class="logo_profile">
        <i class="far fa-user-circle fa-4x"></i>
      </div>
      <div class="name_info_user">
        <div class="name_modify">
          <div class="name">
            <h3 style="font-weight: bold;">
              <? echo $_SESSION['pseudo']; ?> <!-- nom de l'utilisateur connecté -->
            </h3>
          </div>
          <div class="modify_butt">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Edit profile
            </button>
          </div>
        </div>
        <div class="number_publica">
          <? echo get_number_of_publication($link, $pseudo); ?>
        </div>
      </div>
    </div>
    <!-- Le séparateur -->
    <hr class="solid">
    <div class="photo-grid">
      <!-- le php qui affiche les images de l'user -->
      <? echo get_image_user($link, $pseudo) ?>  <!-- On récupère les images de l'utilisateur et on les affiches, cf lib/addfunction.php -->
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit your profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="User_profile.php" method="POST">
            <label for="mdp">Your new Password</label>
            <input type="password" name="mdp" id="inputPassword6" class="form-control mb-2 mr-sm-2" aria-describedby="passwordHelpInline" placeholder="Your new Psswd" required>
            <br>
            <label for="psw-repeat">Confirm new Password</label>
            <input type="password" name="mdp-repeat" id="confirmPassword6" class="form-control mb-2 mr-sm-2" aria-describedby="passwordHelpInline" placeholder="Confirm new Password" required>
            <button type='submit' class='btn btn-outline-success valider' name='valider'><b>Modifier</b></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>