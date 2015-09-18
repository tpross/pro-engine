<?php

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 * 
 * @todo Namespaces
 */

/**
 * App-Class
 *
 * @author TP
 */
class kernel {
    
    //    http://pecl.php.net/package/yaml
    private $neededExtensions = array('yaml');
    private $yaml = null;
    private $database = null;
    
    /**
     * Constructor
     * 
     * @return boolean
     */
    public function __construct() {
        
        helper::echobr('Hello Kernel');
        $this->checkExtensions();

        $this->yaml = new yaml('kernel/config.yml');
        helper::echobr($this->yaml->getFileName());
        helper::echobr($this->readConfig());
        
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
        
        helper::echobr('readConfig');
        
        if(true === $this->yaml->readFile()) {
            var_dump($this->yaml->getFileData());
            
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
            if(true === extension_loaded($ext)) {
                helper::echobr("Extension: <strong>$ext</strong> loaded");
            } else {
                helper::echobr("Extension: <strong>$ext</strong> not loaded");
                return false;
            }
        }
        
        return true;
    }
    
    public function __destruct() {
        
        return true;
    }
}
