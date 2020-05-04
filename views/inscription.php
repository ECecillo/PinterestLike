<?php
session_start();
require_once('../config/configuration.php');
require_once('.' . PATH_LIB . 'bd.php');
require_once('.' . PATH_LIB . 'utilisateur.php');
require_once('.' . PATH_LIB . 'discussion.php');
require_once('.' . PATH_LIB . 'add_funct.php');

$stateMsg = "";

if (isset($_POST["valider"])) {
  $pseudo = $_POST["pseudo"]; // On sauvegarde ce qui a été rentré dans le formulaire pour le pseudo
  $hashMdp = md5($_POST["mdp"]); // On va crypter le mot de passe 
  $hashConfirmMdp = md5($_POST["mdp-repeat"]); // Pour l'évaluation si les deux mdp sont les mêmes

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName); // lien bdd
  $available = checkAvailability($pseudo, $link); // Regarder si l'utilisateur n'existe pas dans la base de donéée

  if ($hashMdp == $hashConfirmMdp) { // On check si le mdp est le même que celui de confirmation pour que l'utilisateur soit sur de sa saisie
    if ($available) {
      register($pseudo, $hashMdp, $link); // Fonction qui enregistre l'utilisateur dans la bdd cf lib/utilisateur.php
      $_SESSION["pseudo"] = $pseudo; // Met en session le pseudo du form
      $_SESSION["mdp"] = $hashMdp;
      date_default_timezone_set('Europe/Paris'); // récupère l'heure en fonction de notre heure locale française
      $_SESSION["date"] = date('d-m-Y H:i:s'); // Créer en session la date pour l'affichage sur home.php
      setConnected($pseudo, $link); // Fonction qui rend connecté dans la base de donnée l'utilisateur cf lib/utilisateur.php
      $_SESSION["logged"] = "yes";
      header('Location: ../home.php'); // redirige vers la page d'accueil
      exit();
    } else {
      echo "Le pseudo demandé est déjà utilié";
    }
  } else {
    echo "Les mots de passe ne correspondent pas, veuillez réessayer";
  }
}
?>

<?php include('v_head_category.php'); ?>

<body> 
  <!-- Pour les icones  -->
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
            <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 0rem;">
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
              $dateUser = AffDate($_SESSION["date"]); // On récupère la date de l'utilisateur et on l'affiche même si dans notre cas elle sera unset
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
              <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0">
                Your picture
              </a>
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
              echo "<li><a href='login.php'>Login</a></li>";
            }
          } else {
            echo "<li><a href='login.php'>Login</a></li>";
          } ?>
        </ul>
      </nav>
    </div>
  </header>

  <!-- à compléter -->
  <h1 style="text-align: center;color:red">Inscription à la BDW</h1>
  <form action="inscription.php" style="border:2px solid #ccc; border-radius: 30px;" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <label for="pseudo"><b>Pseudo souhaité:</b></label>
        <input type="text" placeholder="Entrer un pseudo" name="pseudo" required>
        <br>
        <br>
        <label for="mdp"><b>Mot de passe:</b></label>
        <input type="password" placeholder="Entrer MDP" name="mdp" required>
        <br>
        <br>
        <label for="psw-repeat"><b>Confirmer mot de passe:</b></label>
        <input type="password" placeholder="Confirmer mdp" name="mdp-repeat" required>
        <br>
        <br>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <button type="submit" class="valider" name="valider">S'inscrice</button>
      </div>
    </div>
    <div style="text-align: center; margin: 1rem;"> <a href="login.php">Déjà inscrit ?</a> </div>
  </form>

</body>

</html>