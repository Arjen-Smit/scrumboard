<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helix\Framework;

/**
 * Description of Home
 *
 * @author arjen
 */
class HelixConfig {

    /**
     * Holds the instance if already loaded
     *
     * @var HelixConfig 
     */
    static $instance;
    
    /**
     * Holds the data loaded from the config jsons
     * 
     * @var array 
     */
    protected $configArray = array();
    
    /**
     * checks if the instance is already set otherwise creates a new instance
     * 
     * @return HelixConfig
     */
    static public function init() {
        if (!(self::$instance instanceof HelixConfig ) ) {
            self::$instance = new HelixConfig();
        } 
        return self::$instance;
    }
    
    /**
     * __call
     * 
     * Function to set the magic getters
     * 
     * @param type $name
     * @param type $arguments
     * @return array of boolean
     */
    public function __call($name, $arguments) {
        $config = explode("_", HelixFunctions::uncamelize($name) );
        if (count($config) == 2 && $config[0] == "get") {
            return $this->getConfiguration($config[1]);
        } else {
            return false;
        }
    }
    
    /**
     * getConfiguration
     * 
     * returns the already loaded configuration file or tries to load it
     * 
     * @param string $name
     * @return array
     */
    protected function getConfiguration($name) {
        if (array_key_exists($name, $this->configArray)) {
            return $this->configArray[$name];
        } else {
            return $this->loadFromFile($name);
        }
    }
    
    /**
     * loadFromFile
     * 
     * finds the config file and loads it
     * 
     * @param string $name
     * @return array or boolean
     */
    protected function loadFromFile($name) {
       $filename = __DIR__ . "/../Config/" . $name . ".json";
       if (file_exists($filename) && is_readable($filename)) {
           $json = file_get_contents($filename);
           $this->configArray[$name] = json_decode($json);
           return $this->configArray[$name];
       }
       else {
           return false;
       }
    }
}