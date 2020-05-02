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
        <?php  if (isset($_SESSION["logged"])){
        if ($_SESSION["logged"]=="yes") {
            echo "<li><a href='../AddImage.php'>Add image</a></li>";
          }
        }?>
        <li style="margin-top: -0.5625rem;">
          <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Category 
            <span class="material-icons">
              expand_more
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Naturals.php" style="margin-left: 0px;margin-right: 0px;">Naturals</a>
            <a class="dropdown-item" href="animals.php" style="margin-left: 0px;margin-right: 0px;">Animals</a>
            <a class="dropdown-item" href="life.php" style="margin-left: 0px;margin-right: 0px;">Life</a>
          </div>
        </li>
        <?php if (isset($_SESSION["logged"])) {
          if ($_SESSION["logged"] == "yes") {
            if($role =='root'){
              echo "<li><a href='stats.php'>Stats</a></li>";
            }
            $dateUser = AffDate($_SESSION["date"]);
            echo '
            <li class="log-drop">
              <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0">
                <span class="material-icons">
                  face
                </span>
                '.$_SESSION['pseudo'].' 
                <span class="anim-chevron material-icons">
                expand_more
                </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 1rem">
                <small class="date">
                  <span class="material-icons">timer</span>
                  Connected since: <br>'.$dateUser.'
                </small>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="User_profile.php" style="margin-left: 0px;margin-right: 0px;">Your profile</a>
                <div class="dropdown-divider"></div>
                <form action="../home.php" method="post" class="logout-container">
                  <a class="dropdown-item log-butt" style="background-color: crimson;">
                    <span class="material-icons">clear</span>
                    <input type="submit" name="logout" value="Logout" style="border:none;background-color: crimson; cursor:pointer;"/>
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
