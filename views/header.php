<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<header>
  <div class="menu-toggle" id="hamburger">
    <i class="fas fa-bars"></i>
  </div>
  <div class="overlay"></div>
  <div class="container">
    <nav>
      <h1 class="brand"><a href="home.php">Pin<span>ter</span>est</a></h1>
      <ul>
        <li><a href="home.php">Home</a></li>
        <?php  if (isset($_SESSION["logged"])){
        if ($_SESSION["logged"]=="yes") {
            echo "<li><a href='AddImage.php'>Add image</a></li>";
          }
        } ?>
        <li style="margin-top: -0.5625rem;">
          <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Category &#8659;
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= PATH_VIEWS ?>Naturals.php" style="margin-left: 0px;margin-right: 0px;">Naturals</a>
            <a class="dropdown-item" href="<?= PATH_VIEWS ?>animals.php" style="margin-left: 0px;margin-right: 0px;">Animals</a>
            <a class="dropdown-item" href="<?= PATH_VIEWS ?>life.php" style="margin-left: 0px;margin-right: 0px;">Life</a>
          </div>
        </li>
        <li>
          <?php  if (isset($_SESSION["logged"])){
          if ($_SESSION["logged"]=="yes") {
           echo "<form action='home.php' method='post'>
           <li><a><input type='submit' name='logout' value='logout' style='border:none;background:none;'/></a></li>
         </form>";
         }
         else {
           echo "<li><a href='./views/login.php'>Login</a></li>";
         }
       }
         else {
           echo "<li><a href='./views/login.php'>Login</a></li>";
         }?>

        </li>
      </ul>
    </nav>
  </div>
</header>
