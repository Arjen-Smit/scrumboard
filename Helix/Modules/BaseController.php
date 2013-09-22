<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helix\Modules;

/**
 * Description of Home
 *
 * @author arjen
 */
class BaseController {
    
    protected $view;
    
    protected $settings;
         
    public function __construct($view, $arguments = null) {
        $this->view = $view;
        if (isset($arguments)) {
            $this->arguments = $arguments;
        }
    }
    
    public function run() {
        $this->prepare();
        $this->execute();
        return $this->draw();
    }
    
    protected function prepare() {
        
    }
    
    protected function execute() {
        
    }
    
    protected function draw() {
        
    }
}