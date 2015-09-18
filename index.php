<?php

// Autoload Klassen
spl_autoload_register(function($class){
    include "kernel/{$class}.class.php";
});

helper::setErrorReporting('all');

//phpinfo();

//if(extension_loaded(yaml)) {
//    helper::echobr("yaml loaded");
//} else {
//    helper::echobr("install yaml"); 
//}

//$helper = new helper();
$kernel = new kernel();