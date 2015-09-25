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
 * @todo Exception Handling / fuer Konstruktor/Destruktor bei der Instanzierung mit new
 * @todo Template Vererbung pruefen (bei var_dump() landet der Head-Bereich im Body-Bereich)
 */

/**
 * App-Class
 *
 * @author TP
 */
class kernel {
    
    private $neededExtensions = array('yaml');
    private $yaml = null;
    private $config = null;
    private $database = null;
    private $kernelMsg = array();
    public $smarty = null;
    
    /**
     * Constructor
     * 
     * @return boolean
     */
    public function __construct() {
        
//        Helper\helper::echobr('Hello Kernel');
        $this->setKernelMsg('Hello Kernel');
        
        $this->checkExtensions();

        $this->yaml = new Yaml\yaml('kernel/config.yml');
//        Helper\helper::echobr($this->yaml->getFileName());
        $this->setKernelMsg("Config-File: <strong>" . $this->yaml->getFileName() . "</strong>");
        $readConfigMsg = $this->readConfig();
//        Helper\helper::echobr($readConfigMsg);
        $this->setKernelMsg($readConfigMsg);
        
        $GLOBALS['smartyLibPath'] = $this->config['smarty']['dir'];
        $this->smarty = new Smarty\smarty_pe($this->config['smarty']);
        $this->setKernelMsg("Smarty successfully loaded");
    }
    
    /**
     * Read the necessary Config Values
     * @todo Under Construction
     * 
     * @return string
     */
    private function readConfig() {
        
        $msg = '';
        
//        Helper\helper::echobr('readConfig');
        $this->setKernelMsg('readConfig');
        
        if(true === $this->yaml->readFile()) {
//            \var_dump($this->yaml->getFileData());
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
        
        foreach($this->neededExtensions as $ext) {
            if(true === \extension_loaded($ext)) {
//                Helper\helper::echobr("Extension: <strong>$ext</strong> loaded");
                $this->setKernelMsg("Extension: <strong>$ext</strong> loaded");
                $ext = __NAMESPACE__ . "\\" . ucfirst($ext). "\\$ext";
//                Helper\helper::echobr("namespace: <strong>$ext</strong>");
                $this->setKernelMsg("namespace: <strong>$ext</strong>");
            } else {
//                Helper\helper::echobr("Extension: <strong>$ext</strong> not loaded");
                $this->setKernelMsg("Extension: <strong>$ext</strong> not loaded");
                $ext::installDescription();
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
        
        return $this->kernelMsg;
    }
    
    public function __destruct() {
        
        $this->neededExtensions = null;
        $this->yaml = null;
        $this->config = null;
        $this->database = null;
        $this->smarty = null;
        $this->kernelMsg = null;
    }
}
