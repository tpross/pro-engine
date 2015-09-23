<?php
use \Kernel\Helper as Helper;

// Autoload Klassen
\spl_autoload_register(function($class){
    $strParts = explode('\\', $class);
    include "kernel/" . end($strParts) . ".class.php";
});

Helper\helper::setErrorReporting('most');

//phpinfo();

//$helper = new helper();
$kernel = new Kernel\kernel();