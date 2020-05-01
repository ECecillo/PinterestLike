<?php
session_start();
require_once('../config/configuration.php');
require_once('.' . PATH_LIB . 'bd.php');
require_once('.' . PATH_LIB . 'utilisateur.php');
require_once('.' . PATH_LIB . 'discussion.php');
require_once('.' . PATH_LIB . 'add_funct.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

$pseudo = $_SESSION['pseudo'];

if (isset($_POST["logout"])) {
  $pseudo = $_SESSION['pseudo'];
  $mdp = $_SESSION['mdp'];
  $check = getUser($pseudo, $mdp, $link);

  if ($check) {
    setDisconnected($pseudo, $link);
    session_unset();
    header('Location: home.php');
    exit();
  }
}


?>
<?php include('v_head_category.php'); ?>

<body>
  <?php include('headers_category.php'); ?>
  <div class="container-user">
    <div class="info_profile">
      <div class="logo_profile">
        <i class="far fa-user-circle fa-4x"></i>
      </div>
      <div class="name_info_user">
        <div class="name_modify">
          <div class="name">
            <h3 style="font-weight: bold;">
              <? echo $_SESSION['pseudo']; ?>
            </h3>
          </div>
          <div class="modify_butt">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Edit profile
            </button>
          </div>
        </div>
        <div class="number_publica">
          <? echo get_number_of_publication($link, $pseudo); ?>
        </div>
      </div>
    </div>
    <!-- Le séparateur -->
    <hr class="solid">
    <div class="photo-grid">
      <!-- le php qui affiche les images de l'user -->
      <? echo get_image_user($link, $pseudo) ?>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit your profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label for="inputPassword6">Password</label>
            <input type="password" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
