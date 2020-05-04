<!-- Pour ajouter les icones -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<header>
  <div class="menu-toggle" id="hamburger"> <!-- Le hamburger si l'utilisateur était sur un appareil mobile (non fonctionnel)-->
    <i class="fas fa-bars"></i>
  </div>
  <div class="overlay"></div>
  <div class="container">
    <nav>
      <h1 class="brand"><a href="home.php">Pin<span>ter</span>est</a></h1>
      <ul>
        <li><a href="home.php">Home</a></li>
        <?php if (isset($_SESSION["logged"])) { /* Si l'utilisateur est connecté on affiche le lien vers la page AddImage */
          if ($_SESSION["logged"] == "yes") {
            echo "<li><a href='AddImage.php'>Add image</a></li>";
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
            <a class="dropdown-item" href="<?= PATH_VIEWS ?>Naturals.php" style="margin-left: 0px;margin-right: 0px; padding-right: 5.5rem;">Naturals</a>
            <a class="dropdown-item" href="<?= PATH_VIEWS ?>animals.php" style="margin-left: 0px;margin-right: 0px;">Animals</a>
            <a class="dropdown-item" href="<?= PATH_VIEWS ?>life.php" style="margin-left: 0px;margin-right: 0px;">Life</a>
          </div>
        </li>
        <?php if (isset($_SESSION["logged"])) {
          if ($_SESSION["logged"] == "yes") {
            $dateUser = AffDate($_SESSION["date"]); // Donne la date de connexion de l'utilisateur à partir du moment où il s'est connecté.
            $role = get_role($link);
            if ($role == 'root') { // On affiche le lien vers la page de stat si l'utilisateur connecté est le root
              echo "
              <li>
                <a href='views/stats.php' style='margin: 0 3rem;'>Stats</a>
              </li>";
            } 
            // Quand l'utilisateur est co on créer un dropdown menu qui lui affiche sa durrée de connexion et un lien vers son profile. On a aussi le logout.
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
                <a class="dropdown-item" href="' . PATH_VIEWS . 'User_profile.php" style="margin-left: 0px;margin-right: 0px;">Your profile</a>
                <div class="dropdown-divider"></div>
                <form action="home.php" method="post" class="logout-container">
                  <a class="dropdown-item log-butt" style="background-color: crimson;">
                    <span class="material-icons">clear</span>
                    <input type="submit" name="logout" value="Logout" style="border:none;background-color: crimson; cursor:pointer;"/>
                  </a>
                </form>
              </div>
            </li>';
          } else {
            echo "<li><a href='./views/login.php'>Login</a></li>";
          }
        } else {
          echo "<li><a href='./views/login.php'>Login</a></li>";
        } 
        
        ?>
      </ul>
    </nav>
  </div>
</header>