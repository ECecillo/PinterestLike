<?php
/* Module de PHP
 * Paramètres de configuration du site
 *
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

const DEBUG = true; // production : false; dev : true

// Accès base de données
const BD_HOST = 'localhost';
const BD_DBNAME = 'project';
const BD_USER = 'root';
const BD_PWD = '';

// Langue du site
const LANG ='FR-fr';

// Paramètres du site : nom de l'auteur ou des auteurs
const AUTEUR = '';

//dossiers racines du site
define('PATH_CONTROLLERS','./controllers/');
define('PATH_ASSETS','./assets/');
define('PATH_ASSETS_FROM_VIEWS','../assets/');
define('PATH_LIB','./lib/');
define('PATH_MODELS','./models/');
define('PATH_VIEWS','./views/');
define('PATH_TEXTES','./languages/');

//sous dossiers
define('PATH_CSS', PATH_ASSETS.'style/');
define('PATH_IMG', PATH_ASSETS.'img/');
define('PATH_IMG_FROM_VIEWS', PATH_ASSETS_FROM_VIEWS.'img/');
define('PATH_SCRIPT', PATH_ASSETS.'script/');
define('PATH_CSS_CAT','.'.PATH_ASSETS.'style/');
define('PATH_IMG_CAT','.'.PATH_ASSETS.'img/');
define('PATH_SCRIPT_CAT','.'.PATH_ASSETS.'img/');
//define("PATH_GALERIE",'galerie/');
//define('PATH_LOG','log/');

//fichiers
//define('LOG_BDD','logbdd.txt');
define('PATH_LOGO', PATH_IMG.'logo.png');
define('PATH_MENU', PATH_VIEWS.'menu.php');
