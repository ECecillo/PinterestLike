<?php
$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName); // Connection vers la base de données

function AffDate($date) // Fonction qui affiche la date, heure, minute et seconde à partir du moment où l'utilisateut se connecte
{
  if (!ctype_digit($date))
    $date = strtotime($date);
  if (date('Ymd', $date) == date('Ymd')) {
    $diff = time() - $date;
    if ($diff < 60) /* moins de 60 secondes */
      return $diff . ' secondes ago';
    else if ($diff < 3600) /* moins d'une heure */
      return round($diff / 60, 0) . ' minutes ago';
    else if ($diff < 10800) /* moins de 3 heures */
      return round($diff / 3600, 0) . ' hour ago';
    else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
      return 'Today at ' . date('H:i:s', $date);
  } else if (date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
    return 'Yesterday at ' . date('H:i:s', $date);
  else if (date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
    return 'Two days ago at ' . date('H:i:s', $date);
  else
    return date('d/m/Y à H:i:s', $date);
}

function fill_category($link) // Fonction qui génère les options pour la dropdown liste sur la page home et les pages natural, animal et life
{
  $output = '';
  $query = "SELECT * from `Categorie`;";
  $result = executeQuery($link, $query);
  $cat = $result;
  foreach ($cat as $cat1) {
    $output .=  '<option value="' . $cat1["catId"] . '">' . $cat1["nomCat"] . '</option>';
  }
  return $output;
}

function RenderForm($link, $uneimage) // Affiche les boutons edit et delete selon l'utilisateur si il est root on affiche les deux sinon on affiche que edit pour l'utilisateur lambda
{
  $output = '';
  if (isset($_SESSION["logged"])) {
    if ($_SESSION["logged"] == "yes") {
      $role = get_role($link);
      if ($role == 'root') {
        $output .=
          "<form action='home.php' method='POST'>
        <input id='Imageid' name='image_now' type='hidden' value='" . $uneimage['nomFich'] . "'>
        <button type='submit' class='btn btn-outline-danger valider' name='delete'><b>Delete</b></button>
        <button type='submit' class='btn btn-outline-primary valider' name='edit'><b>Edit</b></button>
      </form>";
      } else {
        $output .=
          "<form action='home.php' method='POST'>
        <input id='Imageid' name='image_now' type='hidden' value='" . $uneimage['nomFich'] . "'>
        <button type='submit' class='btn btn-outline-primary valider' name='edit'><b>Edit</b></button>
      </form>";
      }
    }
  }
  return $output;
}


function fill_image($link) // Affihche les images avec un modal qui donne leur description, .. Toute les valeurs dans la bdd dans un tableau style bootstrap
{
  $output = '';
  if (isset($_POST['Valider'])) {
    $image = $_POST['Image'];
    if (($image == '')) {
      $query = "SELECT C.nomCat, P.nomFich,P.catId,P.description  from Photo P join Categorie C on C.catId=P.catId ;";
    } else {
      $query = 'SELECT C.nomCat, P.nomFich, P.catId,P.description  FROM Photo P join Categorie C on C.catId=P.catId WHERE P.catId=' . $image . '';
    }
  } else {
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId;";
  }
  $result = executeQuery($link, $query); // Execute la requête sql dans la bdd cf lib/bd.php
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) { // Pour chaque image dans la bdd on affiche ce html 
    $form = RenderForm($link, $uneimage);
    $output .= "
      <a class='card card-tall' style='background-image: url(" . PATH_IMG . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:750px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='" . PATH_IMG . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
            <div style='display: flex;justify-content: center; font-size: 1.2rem'>
            <table class='table'>
              <tbody>
                <tr>
                  <th>Description</th>
                  <td>" . $uneimage['description'] . "</td>
                </tr>
                <tr>
                  <th>Name of the file</th>
                  <td>" . $uneimage['nomFich'] . "</td>
                </tr>
                <tr>
                  <th>Category name</th>
                  <td>" . $uneimage['nomCat'] . "</td>
                </tr>
              </tbody>
            </table>
            </div>
            " . $form . "
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function fill_image_natural($link, $path) // Affiche les images qui sont sur la page natural par rapport à la catégorie natural dans la bdd
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='Naturals';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $form = RenderForm($link, $uneimage);
    $output .= "
      <a class='card card-tall' style='background-image: url(" . $path . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:750px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='" . $path . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
            <div style='display: flex;justify-content: center; font-size: 1.2rem'>
            <table class='table'>
              <tbody>
                <tr>
                  <th>Description</th>
                  <td>" . $uneimage['description'] . "</td>
                </tr>
                <tr>
                  <th>Name of the file</th>
                  <td>" . $uneimage['nomFich'] . "</td>
                </tr>
                <tr>
                  <th>Category name</th>
                  <td>" . $uneimage['nomCat'] . "</td>
                </tr>
              </tbody>
            </table>
            </div>
            " . $form . "
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function fill_image_animals($link, $path) // Affiche les images qui sont sur la page animal par rapport à la catégorie animal dans la bdd
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='animals';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $form = RenderForm($link, $uneimage);
    $output .= "
      <a class='card card-tall' style='background-image: url(" . $path . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:750px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='" . $path . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
            <div style='display: flex;justify-content: center; font-size: 1.2rem'>
            <table class='table'>
              <tbody>
                <tr>
                  <th>Description</th>
                  <td>" . $uneimage['description'] . "</td>
                </tr>
                <tr>
                  <th>Name of the file</th>
                  <td>" . $uneimage['nomFich'] . "</td>
                </tr>
                <tr>
                  <th>Category name</th>
                  <td>" . $uneimage['nomCat'] . "</td>
                </tr>
              </tbody>
            </table>
            </div>
            " . $form . "
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function fill_image_life($link, $path) // Affiche les images qui sont sur la page life par rapport à la catégorie life dans la bdd
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='life';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $form = RenderForm($link, $uneimage);
    $output .= "
      <a class='card card-tall' style='background-image: url(" . $path . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:750px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='" . $path . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
            <div style='display: flex;justify-content: center; font-size: 1.2rem'>
            <table class='table'>
              <tbody>
                <tr>
                  <th>Description</th>
                  <td>" . $uneimage['description'] . "</td>
                </tr>
                <tr>
                  <th>Name of the file</th>
                  <td>" . $uneimage['nomFich'] . "</td>
                </tr>
                <tr>
                  <th>Category name</th>
                  <td>" . $uneimage['nomCat'] . "</td>
                </tr>
              </tbody>
            </table>
            </div>
            " . $form . "
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function last_image_post($link) // Affiche la dernière image ajouté par l'utilisateur, va dans description.php
{
  $output = '';
  $query = 'SELECT * from Photo P join Categorie C on C.catId=P.catId  ORDER BY P.photoId DESC LIMIT 1;';
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $output .= "
          <img src='" . PATH_IMG . $uneimage['nomFich'] . "'  class='card card-tall'>
          <div style='display: flex;justify-content: center; font-size: 1.2rem'>
          <table class='table'>
            <tbody>
              <tr>
                <th>Description</th>
                <td>" . $uneimage['description'] . "</td>
              </tr>
              <tr>
                <th>Name of the file</th>
                <td>" . $uneimage['nomFich'] . "</td>
              </tr>
              <tr>
                <th>Category name</th>
                <td>" . $uneimage['nomCat'] . "</td>
              </tr>
            </tbody>
          </table>
          </div>";
    $nbImage++;
  }
  return $output;
}
function get_role($link) // Récupère le role de l'utilisateur en fonction son pseudo de session et on le sauvegarde dans la variable de session role
{
  $output = '';
  $query = 'SELECT `role` from utilisateur WHERE utilisateur.`pseudo` = "' . $_SESSION['pseudo'] . '"';
  $result = executeQuery($link, $query);
  $user = $result;
  foreach ($user as $users) {
    $output = $users['role'];
  }
  return $output;
}

function get_image_off_cat($link) // Fonction que l'on utilise dans description.php qui nous affiche les images dans la même catégorie que celle ajouter par l'utilisateur
{
  $path = PATH_IMG;
  $query = 'SELECT P.catId from Photo P join Categorie C on C.catId=P.catId  ORDER BY P.photoId DESC LIMIT 1;';
  $result = executeQuery($link, $query);
  $id = 0;
  foreach ($result as $imageid) {
    switch ($imageid['catId']) { // variable que l'on a créer lors de l'ajout de l'image
      case 1:
        echo fill_image_natural($link, $path);
        break;
      case 2:
        echo fill_image_animals($link, $path);
        break;
      case 3:
        echo fill_image_life($link, $path);
        break;

      default:
        echo "erreur dans la requête";
    }
    $id++;
  }
}

function get_number_of_publication($link, $pseudo) // Récupère le nombre de publication pour l'user_profile.php 
{
  $output = '';
  $query = "SELECT COUNT(nomFich) AS nomFich FROM Photo P WHERE P.nomFich LIKE '%$pseudo%'";
  $result = executeQuery($link, $query);
  foreach ($result as $cat1) {
    $output .=  '<p> <strong>' . $cat1['nomFich'] . '</strong> upload</p>';
  }
  return $output;
}

function get_image_user($link, $pseudo) // Récupère les images de l'utilisateur dans la base de données et les affiches sur la page user_profile.php
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE P.nomFich LIKE '%$pseudo%';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $output .= "
      <a class='card card-wide' style='background-image: url(" . PATH_IMG_FROM_VIEWS . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:750px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='" . PATH_IMG_FROM_VIEWS . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
            <div style='display: flex;justify-content: center; font-size: 1.2rem'>
            <table class='table'>
              <tbody>
                <tr>
                  <th>Description</th>
                  <td>" . $uneimage['description'] . "</td>
                </tr>
                <tr>
                  <th>Name of the file</th>
                  <td>" . $uneimage['nomFich'] . "</td>
                </tr>
                <tr>
                  <th>Category name</th>
                  <td>" . $uneimage['nomCat'] . "</td>
                </tr>
              </tbody>
            </table>
            </div>
            <form action='User_profile.php' method='POST'>
              <input id='Imageid' name='image_now' type='hidden' value='" . $uneimage['nomFich'] . "'>
              <button type='submit' class='btn btn-outline-danger valider' name='delete'><b>Delete</b></button>
              <button type='submit' class='btn btn-outline-primary valider' name='edit'><b>Edit</b></button>
            </form>
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function number_image($link) // Retourne l'html d'une case d'un tableau avec le nombre de photos dans la base de données, on la met dans state.php
{
  $query = "SELECT *  from Photo P";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $nbImage++;
  }
  $output =
    "<tr>
      <th>Number of Pictures</th>
      <td>" . $nbImage . " pictures</td>
    </tr>";
  return $output;
}

//number user with admin
function number_user($link)
{
  $query = "SELECT *  from utilisateur";
  $result = executeQuery($link, $query);
  $user = $result;
  $nbuser = 0;
  foreach ($user as $users) {
    $nbuser++;
  }
  $output =
    "<tr>
    <th>Number of users</th>
    <td>" . $nbuser . " users</td>
  </tr>";
  return $output;
}

function number_image_user($link, $user) // Nombre d'image de chaque utilisateur
{
  $output ="";
  $query = "SELECT COUNT(*) AS num_user_img from Photo P join Categorie C on C.catId=P.catId WHERE P.nomFich LIKE '%$user%';";
  $result = executeQuery($link, $query);
  $images = $result;
  foreach ($images as $uneimage) {
    $output.="".$uneimage['num_user_img']."";
  }
  return $output;
}


function all_user($link) // Nombre d'image en tout
{
  $output = '';
  $query = "SELECT pseudo  from utilisateur";
  $result = executeQuery($link, $query);
  $user = $result;
  foreach ($user as $users) {
    $output .= "
        <tr>
          <td style='border:solid 1px black; text-align:center;'> " . $users['pseudo'] . "</td>
          <td style='border:solid 1px black; text-align:center;'>";
    $images_user = number_image_user($link, $users['pseudo']);
    $output .= "" . $images_user . "</td>
          </tr>";
  }

  return $output;
}

function image_init($link) // 
{
  $output='';
  $query = "SELECT COUNT(*) AS number_machine from Photo P WHERE P.nomFich   NOT LIKE '%\_%';";
  $result = executeQuery($link, $query);
  $user = $result;
  $nbimage_init = 0;
  foreach ($user as $users) {
    $output.="".$users['number_machine']."";
  }

  return $output;
}

function number_image_life($link) // Nombre d'image dans la catégorie life
{
  $output = '';
  $query = "SELECT COUNT(*) AS number_life from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='life';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $output =
    "<tr>
      <th>Pictures for Life</th>
      <td>" . $uneimage['number_life'] . " picutures</td>
    </tr>";
  }
  return $output;
}
function number_image_animals($link) // nombre d'image dans la catégorie animal
{
  $output = '';
  $query = "SELECT COUNT(*) AS number_animals from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='animals';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $output =
    "<tr>
      <th>Pictures for Animals</th>
      <td>" . $uneimage['number_animals'] . " pictures</td>
    </tr>";
  }
  return $output;
}
function number_image_naturals($link) // Nombre d'image dans la catégorie natural
{
  $output = '';
  $query = "SELECT COUNT(*) AS number_naturals from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='Naturals';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    "<tr>
      <th>Pictures for Natural</th>
      <td>" . $uneimage['number_naturals'] . " pictures</td>
    </tr>";
  }

  return $output;
}