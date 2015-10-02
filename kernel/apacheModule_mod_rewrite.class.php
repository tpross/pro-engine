<?php
namespace Kernel\ApacheModules;
/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 * 
 * @todo Webserver Checken
 */

/**
 * Description of apacheModules
 *
 * @author User
 */
class apacheModule_mod_rewrite implements iApacheModules 
{
    
    public $useModule = true;

    public function __construct() {
        ;
    }
    
    public function getUseModule() {
        
        return $this->useModule;
    }
    
    public function setUseModule($use) {
        
        if(true === is_bool($use)) {
            $this->useModule = $use;
            return true;
        }
        
        return false;
    }
    
    public static function enableDescription() {
        ;
    }


    public function __destruct() {
        $this->useModule = null;
    }
}
