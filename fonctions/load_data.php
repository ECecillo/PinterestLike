<?php
session_start();
//load_data.php
require_once 'bd.php';
require_once 'utilisateur.php';
require_once 'discussion.php';
$link=getConnection($dbHost, $dbUser, $dbPwd, $dbName);
$output='';
if(isset($_POST["catId2"]))
{
  if($_POST["catId2"]!='')
  {
    $query="SELECT * FROM 'Photo';";
  }
  else
  {
    $query="SELECT * FROM 'Photo';";
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
  echo $output;
}
?>
