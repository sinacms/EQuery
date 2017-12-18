<?php
// use it directory, include bootstrap;
define('EQUERY_PATH', __DIR__.DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR);
set_include_path(get_include_path().PATH_SEPARATOR. EQUERY_PATH);

function equery_autoload ($class) {
    if (strpos($class,'\\')!==false) {
        $file = EQUERY_PATH.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    }
    if(!file_exists($file))     return FALSE ;
    include_once($file);
    if(!class_exists($class))   return FALSE;
}
spl_autoload_register('equery_autoload');

// use simple funcs
include_once "functions/es_functions.php";
