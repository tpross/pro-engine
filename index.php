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
//$kernel = new Kernel\kernel();

require_once 'libs/smarty-3.1.27/Smarty.class.php';
$smarty = new Smarty();

// @todo absolute Pfadangaben
$smarty->setTemplateDir('web/templates/');
$smarty->setCompileDir('web/templates_c/');
$smarty->setConfigDir('web/configs/');
$smarty->setCacheDir('web/cache/');
$smarty->debugging = false;
$smarty->caching = false;

//$smarty->testinstall();
$smarty->assign('name', 'Tobias');

if(true === isset($_GET['content'])) {
    $content = $_GET['content'];
} else {
    $content = 'home';
}

$smarty->display("{$content}.tpl");
//echo $smarty->fetch('index.tpl');
