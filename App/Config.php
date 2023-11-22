<?php

// Constantes utilizadas na aplicação.

define("BASEDIR", dirname(__FILE__, 2) . "\\");

define("VIEWS", dirname(__FILE__) . "\\View\\");

define("BACKUP", "C:");

// Senha Mestra.

define("MASTER", "a6facc54aeeb0ee2d5e0c01d17074b77");

// Variáveis utilizadas na conexão com o MySQL.

$_ENV["database"]["host"] = "localhost:3307";
$_ENV["database"]["user"] = "root";
$_ENV["database"]["password"] = "etecjau";
$_ENV["database"]["db_name"] = "db_anime_world";

?>