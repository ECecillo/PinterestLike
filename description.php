<?php
session_start();
require_once('./config/configuration.php');
require_once(PATH_LIB . 'bd.php');
require_once(PATH_LIB . 'utilisateur.php');
require_once(PATH_LIB . 'discussion.php');
require_once(PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link) == TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    $_SESSION["pseudo"] = '';
    $_SESSION["mdp"] = '';
    $_SESSION["logged"] = "no";
    header('Location: home.php');
    exit();
  }
}


?>
<?php include(PATH_VIEWS . 'v_head.php'); ?>

<body>

  <?php include(PATH_VIEWS . 'header.php'); ?>

  <div class="container shadow_container">
    <div class="title_container">
      <h1 style="padding-top: 1rem;">You have successfully add this Picture !</h1>
    </div>
    <div class="photo-grid" style="margin: 1rem 1rem;"> <!-- class="desc_image" -->
      <?php
        echo last_image_post($link);
      ?>
    </div>
  </div>
  <hr class="solid">
  <div class="title_container">
    <h3 style="color: black;">More content related to your picture</h3>
  </div>
  <div class="photo-grid">
    <?php 
      echo get_image_off_cat($link);
    ?>
  </div>
</body>

</html>