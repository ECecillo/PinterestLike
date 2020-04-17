<?php
/* Récupère le nom des images dans la base de donnée */

function get_all_image($link)
{
    $query = "SELECT nomFich from `Photo`;";
    $result = executeQuery($link, $query);
    return $result;
}

function get_alt($link)
{
    $query = "SELECT `Photo.description` from `Photo`;";
    $result = executeQuery($link, $query);
    return $result;
}

function fill_category($link)
{
  $output='';
  $query = "SELECT * from `Categorie`;";
  $result = executeQuery($link, $query);
  $cat=$result;
  foreach ($cat as $cat1) {
    $output .=  '<option value="'.$cat1["catId"].'">'.$cat1["nomCat"].'</option>';

 }
 return $output;
}

function fill_image($link)
{
  $output='';
  if (isset($_POST['Valider']))
  {
    $image=$_POST['Image'];
    if(($image=='')){
      $query = "SELECT nomFich from `Photo`;";
    }
    else{
       $query = 'SELECT * FROM Photo WHERE catId='.$image.'';

    }
  }
  else{
    $query = "SELECT nomFich from `Photo`;";
  }
    $result = executeQuery($link, $query);
    $images=$result;
    $nbImage = 0;
    foreach ($images as $uneimage) {
      $output.= "
      <div class='card card-tall' style='background-image: url(./assets/img/". $uneimage['nomFich'] . ");' alt=''>
        <a class='' href=''>
          <span></span>
        </a>
      </div>";
      $nbImage++;
    }
  return $output;
}