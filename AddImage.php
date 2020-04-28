<?php
session_start();
require_once ('./config/configuration.php');
require_once (PATH_LIB . 'bd.php');
require_once (PATH_LIB . 'utilisateur.php');
require_once (PATH_LIB . 'discussion.php');
require_once (PATH_LIB . 'add_funct.php');


$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

if (isset($_POST["validate"])) {
  $nameImage = pathinfo($_FILES['Image']['name']);
  $extension = $nameImage['extension'];
  $extension_accept = array("jpeg", "jpg", "gif");
  if (!(in_array($extension, $extension_accept))) {
    echo "File does not have expected extension. </br>";
  }
  $size_max = 904860;
  $size_Image = filesize($_FILES['Image']['tmp_name']);
   if ($size_Image > $size_max){
     echo "You have exceeded the allowed file size. </br>";
   }
   else {
     $destination_directory=dirname(__FILE__)."/assets/img/";
     move_uploaded_file($_FILES["Image"]["tmp_name"],$destination_directory.$_POST["Description"]."_".$_SESSION["pseudo"].".".$extension);
     $req="INSERT INTO Photo("."nomFich,description,catId".")
                 VALUES (" .
                                "'" .$_POST["Description"]."_". $_SESSION["pseudo"] .".".$extension."', " .
                                "'" . $_POST["Description"]. "', " .
                                "'" . $_POST["Category"]. "')";
     executeUpdate($link, $req);
     header('Location: description.php');
   }

}

?>

<?php include(PATH_VIEWS . 'v_head.php'); ?>


<body>
  <div class="menu-toggle" id="hamburger">
    <i class="fas fa-bars"></i>
  </div>
  <div class="overlay"></div>
  <div class="container">
    <nav>
      <h1 class="brand"><a href="home.php">Pin<span>ter</span>est</a></h1>
      <ul>
        <li><a href="../home.php">Home</a></li>
        <?php  if (isset($_SESSION["logged"])){
        if ($_SESSION["logged"]=="yes") {
            echo "<li><a href='AddImage.php'>Add image</a></li>";
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
  <?php if (isset($_SESSION["logged"])){
  if ($_SESSION["logged"]=="yes") {
    echo "<h1><strong>Welcome ".$_SESSION['pseudo']." <br/></strong></h1>";
    echo AffDate($_SESSION["date"]);
  }
}
   ?>
  <!-- à compléter -->
  <h1 style="text-align: center; color:red">Add Image</h1>
  <form enctype="multipart/form-data" action="AddImage.php" style="border:2px solid #ccc; border-radius: 30px;" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <label for="image"><b>Add image:</b></label>
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <input type="file"  name="Image"  value="parcourir" required>
        <br>
        <br>
        <label for=""><b>Categorie: </b></label>
        <select id="Image"name="Category" required>
          <option value=""> select a Category </option>
          <?php echo fill_category($link);?>
          </select>
        <br>
        <br>
        <label for="image"><b> Description: </b></label>
        <input type="text" placeholder="Enter Description" name="Description" required>
        <br>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <button type="submit" class="valider" name="validate"><b>Validate</b></button>
      </div>
    </div>
  </form>
</body>

</html>
