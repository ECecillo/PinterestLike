<?php

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
      <a class='card card-tall' style='background-image: url(./assets/img/" . $uneimage['nomFich'] . ");' data-toggle='modal' data-target='#" . $uneimage['nomFich'] . "'>
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
/* $alt = get_alt($link); */

