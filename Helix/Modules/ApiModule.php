<?php

namespace Helix\Modules;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Silex\Application;

class ApiModule {
    
    protected $app;
    
    protected $content = array();
    
    public function setApp(Application $app) {
        $this->app = $app;
    }
    
    public function ApiGet() {
        return json(array("error", "API get not defined"));
    }
    
    public function ApiPost() {
        return json(array("error", "API Post not defined"));
    }
    
    public function getJson() {
        return json_encode($this->content);
    }
    
    public function hasErrors() {
        if (array_key_exists("error", $this->content)) {
            return true;
        }
        return false;
    }
    
    public function getErrors() {
        if (array_key_exists("error", $this->content)) {
            return $this->content['error'];
        }
        return false;
    }
}