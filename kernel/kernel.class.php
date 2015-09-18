<?php

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 */

/**
 * Description of kernel
 *
 * @author TP
 */
class kernel {
    
    //    http://pecl.php.net/package/yaml
    private $neededExtensions = array('yaml');
    private $yaml = null;
    private $database = null;
    
    public function __construct() {
        helper::echobr('Hello Kernel');
        $this->checkExtensions();

        $this->yaml = new yaml();
        $this->readConfig();
        
        return true;
    }
    
    private function readConfig() {
        helper::echobr('readConfig');
        
        $this->yaml->readFile('kernel/config.yml');
        
        var_dump($this->yaml->getFileData());
        
        return true;
    }
    
    private function checkExtensions() {
        
        foreach($this->neededExtensions as $ext) {
            if(true === extension_loaded($ext)) {
                helper::echobr($ext . ' loaded');
            } else {
                helper::echobr($ext . ' not loaded');
                return false;
            }
        }
        
        return true;
    }
    
    public function __destruct() {
        
        return true;
    }
}
