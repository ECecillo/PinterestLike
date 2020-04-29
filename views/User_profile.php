<?php
session_start();
require_once('../config/configuration.php');
require_once('.' . PATH_LIB . 'bd.php');
require_once('.' . PATH_LIB . 'utilisateur.php');
require_once('.' . PATH_LIB . 'discussion.php');
require_once('.' . PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

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


?>
<?php include('v_head_category.php'); ?>

<body>
  <?php include('headers_category.php'); ?>
  <div class="container">
    <div class="info_profile">

      <div class="name_info_user">

      </div>
    </div>
    <!-- Le séparateur -->
    <div class="photo-grid">
      <!-- le php qui affiche les images de l'user -->
    </div>
  </div>

</body>

</html>