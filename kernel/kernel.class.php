<?php
namespace Kernel;

use \Kernel\Helper as Helper;
use \Kernel\Yaml as Yaml;
/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 * 
 * @todo Namespaces Namespaces umschreiben / use verwenden
 */

/**
 * App-Class
 *
 * @author TP
 */
class kernel {
    
    private $neededExtensions = array('yaml');
    private $yaml = null;
    private $database = null;
//    public $smarty = null;
    
    /**
     * Constructor
     * 
     * @return boolean
     */
    public function __construct() {
        
        Helper\helper::echobr('Hello Kernel');
        $this->checkExtensions();

        $this->yaml = new Yaml\yaml('kernel/config.yml');
        Helper\helper::echobr($this->yaml->getFileName());
        Helper\helper::echobr($this->readConfig());
        
        return true;
    }
    
    /**
     * Read the necessary Config Values
     * @todo Under Construction
     * 
     * @return string
     */
    private function readConfig() {
        
        $msg = '';
        
        Helper\helper::echobr('readConfig');
        
        if(true === $this->yaml->readFile()) {
            \var_dump($this->yaml->getFileData());
            
            $msg = "Configuration successfully loaded ";
        } else {
            $msg = "Error Reading Config ";
        }
        
        return $msg . $this->yaml->getFileName();
    }
    
    /**
     * Check the necessary Extenions like yaml
     * $this->neededExtensions
     * @todo Under Construction
     * 
     * @return boolean
     */
    private function checkExtensions() {
        
        foreach($this->neededExtensions as $ext) {
            if(true === \extension_loaded($ext)) {
                Helper\helper::echobr("Extension: <strong>$ext</strong> loaded");
                $ext = __NAMESPACE__ . "\\" . ucfirst($ext). "\\$ext";
                echo $ext;
            } else {
                Helper\helper::echobr("Extension: <strong>$ext</strong> not loaded");
                $ext::installDescription();
                return false;
            }
        }
        
        return true;
    }
    
    public function __destruct() {
        
        return true;
    }
}
