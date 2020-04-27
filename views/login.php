<?php
session_start();
require_once ('../config/configuration.php');
require_once ('.'.PATH_LIB . 'bd.php');
require_once ('.'.PATH_LIB . 'utilisateur.php');
require_once ('.'.PATH_LIB . 'discussion.php');
require_once ('.'.PATH_LIB . 'add_funct.php');
$stateMsg = "";

if (isset($_POST["valider"])) {
  $pseudo = $_POST["pseudo"];
  $hashMdp = md5($_POST["mdp"]);

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($pseudo, $hashMdp, $link);

  if (getUser($pseudo, $hashMdp, $link) == TRUE) {
    $_SESSION["pseudo"]= $pseudo;
    $_SESSION["mdp"]= $hashMdp;
    date_default_timezone_set('Europe/Paris');
    $_SESSION["date"]=date('d-m-Y H:i:s');
    setConnected($pseudo, $link);
    $_SESSION["logged"]="yes";
    header('Location: ../home.php');
    exit();
  }
  else {
    echo "Le couple pseudo/mot de passe ne correspond à aucun utilisateur enregistré";
  }
}


?>

<?php include('v_head_category.php'); ?>


<body>
  <div class="menu-toggle" id="hamburger">
    <i class="fas fa-bars"></i>
  </div>
  <div class="overlay"></div>
  <div class="container">
    <nav>
      <h1 class="brand"><a href="../home.php">Pin<span>ter</span>est</a></h1>
      <ul>
        <li><a href="../home.php">Home</a></li>
        <?php  if (isset($_SESSION["logged"])){
        if ($_SESSION["logged"]=="yes") {
            echo "<li><a href='../AddImage.php'>Add image</a></li>";
          }
        }?>
        <li style="margin-top: -0.5625rem;">
          <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Category &#8659;
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Naturals.php" style="margin-left: 0px;margin-right: 0px;">Naturals</a>
            <a class="dropdown-item" href="animals.php" style="margin-left: 0px;margin-right: 0px;">Animals</a>
            <a class="dropdown-item" href="life.php" style="margin-left: 0px;margin-right: 0px;">Life</a>
          </div>
        </li>
        <li>
          <?php   if (isset($_SESSION["logged"])){
          if ($_SESSION["logged"]=="yes") {
           echo "<form action='home.php' method='post'>
           <li><a><input type='submit' name='logout' value='logout' style='border:none;background:none;' /></a></li>
         </form>";
         }
         else {
           echo "<li><a href='login.php'>Login</a></li>";
         }
       }
         else {
           echo "<li><a href='login.php'>Login</a></li>";
         }?>

        </li>
      </ul>
    </nav>
  </div>
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
