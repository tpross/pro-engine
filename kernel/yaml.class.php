<?php
namespace Kernel\Yaml;

use Kernel\Helper as Helper;

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 */

/**
 * Inherited class/namespace must use the same class-Name as the needed extension
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

abstract class aYaml implements iExtensions
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
        Helper\helper::echobr("");
        Helper\helper::echobr("");
        Helper\helper::echobr("<strong>Short Install Description (Linux):</strong>");
        Helper\helper::echobr("<i>type: sudo apt-get install php-pear libyaml-dev</i>");
        Helper\helper::echobr("<i>type: pecl install yaml</i>");
        Helper\helper::echobr("<i>type: vi /etc/php5/apache2/php.ini</i>");
        Helper\helper::echobr("<i>add: extension = yaml.so</i>");
        Helper\helper::echobr("<i>type: sudo service apache2 restart</i>");
        Helper\helper::echobr("<i><a href='http://pecl.php.net/package/yaml' target='_blank'>http://pecl.php.net/package/yaml</a></i>");
        Helper\helper::echobr("");
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

class yaml extends aYaml 
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

