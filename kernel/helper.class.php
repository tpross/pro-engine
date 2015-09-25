<?php
namespace Kernel\Helper;

/**
 * @author Tobias Pross
 * 
 * @copyright (c) 2015, Tobias Pross
 */

/**
 * Simple Helper Functions
 *
 * @author tp
 */
class helper {
    public function __construct() {
        
        $this->echobr('Hello Helper');
    }
    
    /**
     * Simple static function, what extends an echo with a br-html-tag at the end of the line.
     * 
     * @param string $string
     * @return boolean
     */
    static function echobr($string = '') {
                
        echo nl2br($string . "\n");
        return true;
    }
    
    /**
     * Quick set of Error Reporting
     * 
     * @todo Under Construction
     * 
     * @param string $art
     * @return boolean
     */
    static function setErrorReporting($art = '') {
        
        switch($art) {
            case 'most':
                error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
                break;
            case 'all-notice':
                error_reporting(E_ALL & ~E_NOTICE);
                break;
            case 'off':
                error_reporting(0);
                break;
            default:
                error_reporting(E_ALL);
        }
        
        return true;
    }
    
    public function __destruct() {
        
    }
}
