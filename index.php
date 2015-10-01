<?php
use \Kernel\Helper as Helper;

// Autoload Classes
\spl_autoload_register(function($class){ 
    $excludeAutoload = array('Smarty_Internal_Data');
    // While exception-class in same file as base-class
    $class = \str_replace('_exception', '', $class);
    $strParts = explode('\\', $class);
    if(file_exists("kernel/" . end($strParts) . ".class.php") && !\in_array($class, $excludeAutoload)) {
        include "kernel/" . end($strParts) . ".class.php";
    }
});

Helper\helper::setErrorReporting('most');

//phpinfo();
//header("Content-type: text/html");
//$helper = new helper();

$kernel = Kernel\kernel::getInstance();

$smarty = $kernel->smarty;

$smarty->assign('name', 'Tobias');

if(true === isset($_GET['content'])) {
    $content = $_GET['content'];
} else {
    $content = 'home';
}

$smarty->assign('contentActive', $content);
$smarty->assign('kernelMessages', $kernel->getKernelMsg());

$smarty->display("{$content}.tpl");