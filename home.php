<?php
session_start();
require_once ('./config/configuration.php');
require_once (PATH_LIB . 'bd.php');
require_once (PATH_LIB . 'utilisateur.php');
require_once (PATH_LIB . 'discussion.php');
require_once (PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link)== TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    $_SESSION["pseudo"]= '';
    $_SESSION["mdp"]='';
    $_SESSION["logged"]="no";
    header('Location: home.php');
    exit();
  }
}

function AffDate($date){
 if(!ctype_digit($date))
  $date = strtotime($date);
 if(date('Ymd', $date) == date('Ymd')){
  $diff = time()-$date;
  if($diff < 60) /* moins de 60 secondes */
   return $diff.' secondes ago';
  else if($diff < 3600) /* moins d'une heure */
   return round($diff/60, 0).' minutes ago';
  else if($diff < 10800) /* moins de 3 heures */
   return round($diff/3600, 0).' hour ago';
  else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
   return 'Today at '.date('H:i:s', $date);
 }
 else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
  return 'Yesterday at '.date('H:i:s', $date);
 else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
  return 'Two days ago at '.date('H:i:s', $date);
 else
  return date('d/m/Y à H:i:s', $date);
}
?>

<?php include(PATH_VIEWS . 'v_head.php'); ?>


<body>

  <?php include(PATH_VIEWS . 'header.php'); ?>

  <!-- Category Selector  -->

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


  <!-- Show images  -->
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