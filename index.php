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
//echo $smarty->fetch('index.tpl');
