<?php
$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

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
      <a class='card card-tall' style='background-image: url(assets/img/" . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:650px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='assets/img/" . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
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

function fill_image_natural($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='Naturals';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $output.= "
      <a class='card card-tall' style='background-image: url(../assets/img/" . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:650px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='../assets/img/" . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
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

function fill_image_animals($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='animals';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $output.= "
      <a class='card card-tall' style='background-image: url(../assets/img/" . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:650px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='../assets/img/" . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
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

function fill_image_life($link)
{
    $output='';
    $query = "SELECT C.nomCat,P.nomFich,P.catId,P.description from Photo P join Categorie C on C.catId=P.catId WHERE C.nomCat='life';";
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $output.= "
      <a class='card card-tall' style='background-image: url(../assets/img/" . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
      </a>
      <!-- Modal -->
      <div class='modal fade' id='" . $uneimage['nomFich'] . "'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:650px;'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Details of this picture</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <img src='../assets/img/" . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
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

function last_image_post($link){
  $output='';
  $query = 'SELECT * from Photo P join Categorie C on C.catId=P.catId  ORDER BY P.photoId DESC LIMIT 1;';
  $result = executeQuery($link, $query);
  $images=$result;
  $nbImage = 0;
  foreach ($images as $uneimage) {
    $output.= "
          <img src='assets/img/" . $uneimage['nomFich'] . "'  style='width: 250px;height: 250px;margin-right:20px; float:left; '>
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
?>
