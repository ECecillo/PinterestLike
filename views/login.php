<?php
session_start();
require_once('../config/configuration.php');
require_once('.' . PATH_LIB . 'bd.php');
require_once('.' . PATH_LIB . 'utilisateur.php');
require_once('.' . PATH_LIB . 'discussion.php');
require_once('.' . PATH_LIB . 'add_funct.php');
$stateMsg = "";

if (isset($_POST["valider"])) {
  $pseudo = $_POST["pseudo"];
  $hashMdp = md5($_POST["mdp"]);

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($pseudo, $hashMdp, $link);

  if (getUser($pseudo, $hashMdp, $link) == TRUE) {
    $_SESSION["pseudo"] = $pseudo;
    $_SESSION["mdp"] = $hashMdp;
    date_default_timezone_set('Europe/Paris');
    $_SESSION["date"] = date('d-m-Y H:i:s');
    setConnected($pseudo, $link);
    $_SESSION["logged"] = "yes";
    header('Location: ../home.php');
    exit();
  } else {
    echo "Le couple pseudo/mot de passe ne correspond à aucun utilisateur enregistré";
  }
}


?>

<?php include('v_head_category.php'); ?>


<body>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <header>
    <div class="menu-toggle" id="hamburger">
      <i class="fas fa-bars"></i>
    </div>
    <div class="overlay"></div>
    <div class="container">
      <nav>
        <h1 class="brand"><a href="../home.php">Pin<span>ter</span>est</a></h1>
        <ul>
          <li><a href="../home.php">Home</a></li>
          <?php if (isset($_SESSION["logged"])) {
            if ($_SESSION["logged"] == "yes") {
              echo "<li><a href='../AddImage.php'>Add image</a></li>";
            }
          } ?>
          <li style="margin-top: -0.5625rem;">
            <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 2rem;">
              Category
              <span class="material-icons">
                expand_more
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 1rem">
              <a class="dropdown-item" href="Naturals.php" style="margin-left: 0px;margin-right: 0px; padding-right: 5.5rem;">Naturals</a>
              <a class="dropdown-item" href="animals.php" style="margin-left: 0px;margin-right: 0px;">Animals</a>
              <a class="dropdown-item" href="life.php" style="margin-left: 0px;margin-right: 0px;">Life</a>
            </div>
          </li>
          <?php if (isset($_SESSION["logged"])) {
            if ($_SESSION["logged"] == "yes") {
              $dateUser = AffDate($_SESSION["date"]);
              echo '
            <li class="log-drop">
              <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0">
                <span class="material-icons">
                  face
                </span>
                ' . $_SESSION['pseudo'] . ' 
                <span class="anim-chevron material-icons">
                expand_more
                </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 1rem">
                <small class="date">
                  <span class="material-icons">timer</span>
                  Connected since: <br>' . $dateUser . '
                </small>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="User_profile.php" style="margin-left: 0px;margin-right: 0px;">Your profile</a>
                <div class="dropdown-divider"></div>
                <form action="../home.php" method="post" class="logout-container">
                  <a class="dropdown-item log-butt" style="background-color: crimson;">
                    <span class="material-icons">clear</span>
                    <input type="submit" name="logout" value="Logout" style="border:none;background-color: crimson;"/>
                  </a>
                </form>
              </div>
            </li>';
            } else {
              echo "<li><a href='#'>Login</a></li>";
            }
          } else {
            echo "<li><a href='#'>Login</a></li>";
          } ?>
        </ul>
      </nav>
    </div>
  </header>
  <!-- à compléter -->
  <h1 style="text-align: center; color:red">Bienvenue sur Pinterest</h1>
  <form action="login.php" style="border:2px solid #ccc; border-radius: 30px;" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <label for="pseudo"><b>Pseudo:</b></label>
        <input type="text" placeholder="Entrer un pseudo" name="pseudo" required>
        <br>
        <br>
        <label for="mdp"><b>Mot de passe:</b></label>
        <input type="password" placeholder="Entrer MDP" name="mdp" required>
        <br>
        <br>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <button type="submit" class="valider" name="valider"><b>Se Connecter</b></button>
      </div>
    </div>
    <div style="text-align: center; margin: 1rem;"> <a href="./inscription.php">Première connexion ?</a> </div>

  </form>
</body>

</html>