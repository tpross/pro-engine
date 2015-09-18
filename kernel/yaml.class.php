<?php

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 */

/**
 * Handling YAML-Files (YAML Ain't Markup Language)
 * 
 * @author TP
 */

abstract class abstractYaml 
{
    protected $fileData = null;
    
    abstract protected function readFile($fileName);
    
    protected function setFileData($fileData) {
        
        $this->fileData = $fileData;
        
        return true;
    }
    
    public function getFileData() {
        
        return $this->fileData;
    }
}

class yaml extends abstractYaml 
{
    public function __construct() {
    
        return true;
    }
    
    public function readFile($fileName) {
        
        $this->setFileData(yaml_parse_file($fileName));
        
        return true;
    }

    public function __destruct() {
        
        return true;
    }
}

