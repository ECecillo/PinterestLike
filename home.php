<?php
session_start();
require_once ('./config/configuration.php');
require_once (PATH_LIB . 'bd.php');
require_once (PATH_LIB . 'utilisateur.php');
require_once (PATH_LIB . 'discussion.php');
require_once (PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

?>

<?php include(PATH_VIEWS . 'v_head.php'); ?>


<body>

  <?php include(PATH_VIEWS . 'header.php'); ?>

  <!-- Partie sur les images  -->

  <div class="category_paragraph">
    <p>Which pictures do you wanna show ? </p> <br>
  </div>
  <div class="category_selector">
    <div class="btn-group dropright">
      <form method="post" action="home.php">
        <select id="Image" name="Image">
          <option value=""> All images </option>
          <?php echo fill_category($link); ?>
        </select>
        <input type="submit" name="Valider" value="OK" />
      </form>
    </div>
  </div>


  <!-- Affichage des jeux  -->
  <div style="margin: 1rem 25rem;">
    <h1><strong>Galery Photo</strong></h1>
    <div class="photo-grid" id="fill_image">
      <?php
      echo fill_image($link);
      ?>
    </div>
  </div>
</body>

</html>