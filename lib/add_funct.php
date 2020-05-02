<?php
$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

function AffDate($date)
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

function fill_category($link)
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

function fill_image($link)
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
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
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
            <form action='home.php' method='POST'>
            <input id='Imageid' name='image_now' type='hidden' value='".$uneimage['nomFich']."'>
            <button type='submit' class='valider' name='delete'><b>Delete</b></button>
            <button type='submit'  class='valider' name='edit' <b> modifier</b> </button>
            </form>
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function fill_image_natural($link, $path)
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='Naturals';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
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
            <form action='Naturals.php' method='POST'>
            <input id='Imageid' name='image_now' type='hidden' value='".$uneimage['nomFich']."'>
            <button type='submit' class='valider' name='delete'><b>Delete</b></button>
            <button type='submit'  class='valider' name='edit' <b> modifier</b> </button>
            </form>
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function fill_image_animals($link, $path)
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='animals';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
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
            <form action='animals.php' method='POST'>
            <input id='Imageid' name='image_now' type='hidden' value='".$uneimage['nomFich']."'>
            <button type='submit' class='valider' name='delete'><b>Delete</b></button>
            <button type='submit'  class='valider' name='edit' <b> modifier</b> </button>
            </form>
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function fill_image_life($link, $path)
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='life';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
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
            <form action='life.php' method='POST'>
            <input id='Imageid' name='image_now' type='hidden' value='".$uneimage['nomFich']."'>
            <button type='submit' class='valider' name='delete'><b>Delete</b></button>
            <button type='submit'  class='valider' name='edit' <b> modifier</b> </button>
            </form>
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function last_image_post($link)
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
function get_role($link){
  $output='';
  $query = 'SELECT `role` from utilisateur WHERE utilisateur.`pseudo` = "'. $_SESSION['pseudo'] .'"';
  $result = executeQuery($link, $query);
  $user=$result;
  foreach ($user as $users) {
    $output = $users['role'];
  }
  return $output;
}

function get_image_off_cat($link)
{
  $path = PATH_IMG;
  $query = 'SELECT P.catId from Photo P join Categorie C on C.catId=P.catId  ORDER BY P.photoId DESC LIMIT 1;';
  $result = executeQuery($link, $query);
  $id = 0;
  foreach ($result as $imageid) {
    switch ($imageid['catId']) {
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

function get_number_of_publication($link, $pseudo)
{
  $output = '';
  $query = "SELECT COUNT(nomFich) AS nomFich FROM Photo P WHERE P.nomFich LIKE '%$pseudo%'";
  $result = executeQuery($link, $query);
  foreach ($result as $cat1) {
    $output .=  '<p> <strong>' . $cat1['nomFich'] . '</strong> upload</p>';
  }
  return $output;
}

function get_image_user($link, $pseudo)
{
  $output = '';
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE P.nomFich LIKE '%$pseudo%';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $output .= "
      <a class='card card-wide' style='background-image: url(". PATH_IMG_FROM_VIEWS . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
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
            </div>
          </div>
        </div>
      </div>";
    $nbImage++;
  }
  return $output;
}

function number_image($link){
  $query = "SELECT *  from Photo P";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $nbImage++;
  }
  $output=
  "<tr>
      <th>Number of Pictures</th>
      <td>".$nbImage." pictures</td>
    </tr>";
  return $output;

}

//number user with admin
function number_user($link){
  $query = "SELECT *  from utilisateur";
  $result = executeQuery($link, $query);
  $user= $result;
  $nbuser = 0;
  foreach ($user as $users) {
    $nbuser++;
  }
  $output= 
  "<tr>
    <th>Number of users</th>
    <td>".$nbuser." users</td>
  </tr>";
  return $output;

}

function number_image_user($link,$user){
  $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE P.nomFich LIKE '%$user%';";
  $result = executeQuery($link, $query);
  $images = $result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $nbImage++;
  }
  return $nbImage;
}


function all_user($link){
  $output='';
  $query = "SELECT pseudo  from utilisateur";
  $result = executeQuery($link, $query);
  $user= $result;
  $nbuser = 0;
  foreach ($user as $users) {
    $output.="
        <tr>
          <td style='border:solid 1px black; text-align:center;'> ". $users['pseudo'] . "</td>
          <td style='border:solid 1px black; text-align:center;'>";
          $images_user=number_image_user($link,$users['pseudo']);
          $output.="".$images_user."</td>
          </tr>";
  }

  return $output;
}

function image_init($link){
  $output='/_/';
  $query = "SELECT * from Photo P WHERE P.nomFich   NOT LIKE '%\_%';";
  $result = executeQuery($link, $query);
  $user= $result;
  $nbimage_init = 0;
  foreach ($user as $users) {
    $nbimage_init++;
  }

  return $nbimage_init;
}

function number_image_life($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='life';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $nbImage++;
    }
    $output=
    "<tr>
      <th>Pictures for Life</th>
      <td>".$nbImage." picutures</td>
    </tr>";
  return $output;
}
function number_image_animals($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='animals';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $nbImage++;
    }
    $output=
    "<tr>
      <th>Pictures for Animals</th>
      <td>".$nbImage." pictures</td>
    </tr>";
  return $output;
}
function number_image_naturals($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='Naturals';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $nbImage++;
    }
    $output=
    "<tr>
      <th>Pictures for Natural</th>
      <td>".$nbImage." pictures</td>
    </tr>";
  return $output;
}
