<?php
namespace Kernel;

use \Kernel\Helper as Helper;
use \Kernel\Yaml as Yaml;
use \Kernel\Smarty as Smarty;
/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 * 
 * @todo Namespaces Namespaces umschreiben / use verwenden
 * @todo Exception Handling
 * @todo Template Vererbung pruefen (bei var_dump() landet der Head-Bereich im Body-Bereich)
 */

class kernel_exception extends \Exception {}

/**
 * App-Class
 *
 * @author TP
 */
class kernel {
    
    /** 
     * @var self Singleton Class Var 
     */
    private static $uniqueInstance = null;
    private $neededExtensions = array('yaml', 'mod_rewrite');
    private $yaml = null;
    private $config = null;
    private $database = null;
    private $kernelMsg = array();
    public $smarty = null;
    
    /**
     * Protected for use as Singleton-Constructor
     * 
     * @return boolean
     */
    protected function __construct() {
        
        $this->setKernelMsg('Kernel Bootup Debug >>>');
        
        $this->checkExtensions();

        $this->yaml = new Yaml\yaml('kernel/config.yml');
        $this->setKernelMsg("Config-File: <strong>" . $this->yaml->getFileName() . "</strong>");
        $readConfigMsg = $this->readConfig();
        $this->setKernelMsg($readConfigMsg);
        
        $GLOBALS['smartyLibPath'] = $this->config['smarty']['dir'];
        $this->smarty = new Smarty\smarty_pe($this->config['smarty']);
        $this->setKernelMsg("Smarty Lib Path: <strong>" . $GLOBALS['smartyLibPath'] . "</strong>");
        $this->setKernelMsg("Smarty successfully loaded");
        $this->setKernelMsg("Kernel Constructor finally passed.");
    }
    
    /* For Use as Singleton-Class */
    private final function __clone() {}
    
    /**
     * Checks, whether the class is instanced (Singleton)
     * no Instances with "new"
     * 
     * @return Instance
     */
    public static function getInstance() {
        
        if(self::$uniqueInstance === null) {
            self::$uniqueInstance = new kernel;
        }
        
        return self::$uniqueInstance;
    }
    
    /**
     * Read the necessary Config Values
     * @todo Under Construction
     * 
     * @return string
     */
    private function readConfig() {
        
        $msg = '';
        
        $this->setKernelMsg('readConfig');
        
        if(true === $this->yaml->readFile()) {
            $this->config = $this->yaml->getFileData();
            
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
        $this->setKernelMsg("Check Extensions: " . implode(" / ", $this->neededExtensions));
        foreach($this->neededExtensions as $ext) {
            $extNS = __NAMESPACE__ . "\\" . ucfirst($ext). "\\$ext";
            if(!\class_exists($extNS)) {
                $this->setKernelMsg("Error-Extension: No Class -> $extNS");
            }
            
            if(true === \extension_loaded($ext)) {
                $this->setKernelMsg("Extension: <strong>$ext</strong> loaded");
                $this->setKernelMsg("Needed Class: <strong>$extNS</strong>");
            } else {
                $this->setKernelMsg("Extension: <strong>$ext</strong> not loaded");
                $extNSException = $extNS . '_exception';
                if(\class_exists($extNSException)) {
                    try {
                        throw new $extNSException('Module not installed.', 555);
                    } catch (\Exception $e) {
                        if(\method_exists($e, 'customError')) {
                            $e->customError();
                            $extNS::installDescription();
                        } else {
                            echo "Unknown Module $ext.";
                        }
                        die();
                    }
                } else {
                    $this->setKernelMsg("Error-Extension: No Exception-Class found -> $extNSException");
                }
                return false;
            }
        }
        
        return true;
    }
    
    protected function setKernelMsg($msg) {
        
        \array_push($this->kernelMsg, $msg);
        
        return true;
    }
    
    public function getKernelMsg() {
        
        return (array) $this->kernelMsg;
    }
    
    public function __destruct() {
        
        $this->neededExtensions = null;
        $this->yaml = null;
        $this->config = null;
        $this->database = null;
        $this->smarty = null;
        $this->kernelMsg = null;
//        echo "Kernel Destruct";
    }
}
