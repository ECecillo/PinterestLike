<?php
session_start();
require_once('../config/configuration.php');
require_once('.' . PATH_LIB . 'bd.php');
require_once('.' . PATH_LIB . 'utilisateur.php');
require_once('.' . PATH_LIB . 'discussion.php');
require_once('.' . PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link) == TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    $_SESSION["pseudo"] = '';
    $_SESSION["mdp"] = '';
    $_SESSION["logged"] = "no";
    header('Location: ../home.php');
    exit();
  }
}


?>
<?php include('v_head_category.php'); ?>

<body>

  <?php include('headers_category.php'); ?>

  <!-- Partie sur les images  -->

  <h1><strong>Stats</strong></h1>
  <!-- Affichage des jeux  -->
  <div>
    <table>
      <tbody>
        <?php
        echo number_image_life($link);
        echo number_image_naturals($link);
        echo number_image_animals($link);
        echo number_image($link);
        echo number_user($link);
        ?>
      </tbody>
    </table>
  </div>
  <h1 style="text-align:center"><strong>More details<br /></strong></h1>
  <div style='display: flex;justify-content: center;'>
    <table>
      <tr>
        <td style='border:solid 1px black;text-align:center;'> User</td>
        <td style='border:solid 1px black;text-align:center;'>number Photo </td>
      </tr>
      <?php
      echo all_user($link);
      $init = image_init($link);
      ?>
      <tr>
        <td style='border:solid 1px black;text-align:center;'> Machine</td>
        <td style='border:solid 1px black;text-align:center;'><?php echo $init; ?> </td>
      </tr>
    </table>
  </div>
</body>

</html>