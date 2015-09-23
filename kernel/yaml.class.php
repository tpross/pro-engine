<?php

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 */

/**
 * Inherited class must use the same class-Name as the needed extension
 */
interface iExtensions
{
    static function installDescription();
}

/**
 * Handling YAML-Files (YAML Ain't Markup Language)
 * 
 * @author TP
 */

abstract class abstractYaml implements iExtensions
{
    protected $fileName = null;
    protected $fileData = null;
    
    abstract protected function readFile();
    
    /**
     * Constructor
     * Instance sets yaml-filename
     * 
     * @param string $fileName
     * @return boolean 
     */
    public function __construct($fileName) {
        
        $this->setFileName($fileName);
        
        return true;
    }
    
    /**
     * Checks existence of file
     * 
     * @return boolean
     */
    protected function checkFile() {
        
        if(null !== $this->fileName && true === file_exists($this->fileName)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * FileName Setter
     * 
     * @param string $fileName
     * @return boolean
     */
    protected function setFileName($fileName) {
        
        $this->fileName = $fileName;
        
        return true;
    }
    
    /**
     * FileName Getter
     * 
     * @return string
     */
    public function getFileName() {
        
        return $this->fileName;
    }

    /**
     * FileData Setter
     * 
     * @param array $fileData
     * @return boolean
     */
    protected function setFileData($fileData) {
        
        $this->fileData = $fileData;
        
        return true;
    }
    
    /**
     * FileData Getter
     * 
     * @return array
     */
    public function getFileData() {
        
        return $this->fileData;
    }
    
    static function installDescription() {
        helper::echobr("<strong>Short Install Description (Linux):</strong>");
        helper::echobr("<i>sudo apt-get install php-pear libyaml-dev</i>");
        helper::echobr("<i>pecl install yaml</i>");
        helper::echobr("<i>vi /etc/php5/apache2/php.ini</i>");
        helper::echobr("<i>add: extension = yaml.so</i>");
        helper::echobr("<i>sudo service apache2 restart</i>");
        helper::echobr("<i>http://pecl.php.net/package/yaml</i>");
    }
    
    /**
     * Destructor
     * 
     * @return boolean
     */
    public function __destruct() {
        
        return true;
    }
}

class yaml extends abstractYaml 
{
    public function __construct($fileName) {
        
        parent::__construct($fileName);
        
        return true;
    }
    
    /**
     * Reads File
     * 
     * @return boolean
     */
    public function readFile() {
        
        if(true === $this->checkFile()) {
            $this->setFileData(yaml_parse_file($this->fileName));
            return true;
        }
        
        return false;
    }

    public function __destruct() {
        parent::__destruct();
        
        return true;
    }
}

