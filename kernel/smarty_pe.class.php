<?php
namespace Kernel\Smarty;

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 * 
 */

// @todo global statt $GLOBALS
require_once "{$GLOBALS['smartyLibPath']}Smarty.class.php";
/**
 * Description of smarty_pe
 *
 * @author TP
 */
class smarty_pe extends \Smarty 
{
    public function __construct(Array $config) {
        
        parent::__construct();
        
        $this->setTemplateDir($config['templatesDir']);
        $this->setCompileDir($config['templates_cDir']);
        $this->setConfigDir($config['configsDir']);
        $this->setCacheDir($config['cacheDir']);
        
        $this->debugging = $config['debugging'];
        $this->caching = $config['caching'];
        
        //$smarty->testinstall();
    }
    
}
