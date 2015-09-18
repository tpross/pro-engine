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
    private $database = null;
    
    public function __construct() {
        helper::echobr('Hello Kernel');
        $this->checkExtensions();
        $this->readConfig();
        
        return true;
    }
    
    private function readConfig() {
        helper::echobr('readConfig');
        $data = yaml_parse_file('kernel/config.yml');
        
        var_dump($data);
        
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
