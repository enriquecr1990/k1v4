<?php

/**
 * 1. tener que crear el archivo .htaccess para el cacheo de las peticion que provienen de la url
 * RewriteEngine On
 * RewriteCond %{REQUEST_FILENAME} !-f
 * RewriteCond %{REQUEST_FILENAME} !-d
 * RewriteRule ^(.*)$ index.php?/$1
 */

/**
 * 2. cargamos constantes que usaremos a lo largo del framework
 */

define('APP_PATH',__DIR__.'/app/');
define('CONFIG_PATH',APP_PATH.'config/');
define('CORE_PATH',APP_PATH.'core/');
define('CONTROLADORES_PATH',APP_PATH.'controladores/');
define('MODELOS_PATH',APP_PATH.'modelos/');
define('VISTAS_PATH',APP_PATH.'vistas/');
define('NAME_ESPACE_CTRL','\\App\\controladores');

/**
 * 3. cargar el nucleo del sistema, estó contendra los
 * controladores, modelos, clases para la bd, ...
 */

include_once CONFIG_PATH.'autocarga.php';

use App\core\framework;

/**
 * cargamos los objetos para la super clase
 */

/**
 * 5. procesamos la peticion conforme la url
 */
$fw = new Framework();
$fw->start();
