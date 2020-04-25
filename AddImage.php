<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
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

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>AddImage</title>
</head>

<body>
  <style>
    body {
      width: 50%;
      padding: 10% 22%;
      justify-content: center;
      /* text-align: center; */
    }
  </style>
  <!-- à compléter -->
  <h1 style="text-align: center; color:red">Add Image</h1>
  <form enctype="multipart/form-data" action="AddImage.php" style="border:2px solid #ccc; border-radius: 30px;" method="POST">
    <div class="container">
      <div class="fillform" style="margin: 1rem;">
        <label for="image"><b>Add image:</b></label>
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <input type="file"  name="pseudo"  value="parcourir" required>
        <br>
        <br>
        <label for=""><b>Categorie:</b></label>
        <select id="Image"name="Image">
          <?php echo fill_category($link);?>
          </select>
        <br>
        <br>
      </div>
      <div class="butt" style="text-align: center; margin: 1rem;">
        <button type="button" class="cancelbtn"><b>Annuler</b></button>
        <button type="submit" class="valider" name="valider"><b>Se Connecter</b></button>
      </div>
    </div>
    <div style="text-align: center; margin: 1rem;"> <a href="./inscription.php">Première connexion ?</a> </div>

  </form>
</body>

</html>
