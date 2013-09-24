<?php

class Helix {
    /**
     * if debug mode will output stuff
     * 
     * @var boolean 
     */
    protected $debug = false;
    
    /**
     * @var Silex\Application 
     */
    protected $app;
           
    public function __construct($debug = false) {
        $this->debug = $debug;
    }

    /**
     * init
     * 
     * initialising some stuff :P
     */
    public function init() {
        $this->autoLoadExternals();
        $this->InitializePropel();
        $this->setIncludePath();
        
        $this->setApp();
    }
    
    /**
     * Run some stuff, yeah really I love to comment :P
     * 
     */    
    public function run() {
        $this->loadRouters();
        $this->app->run();
    }
    
    /**
     * setIncludePath
     * 
     * Sets the include path
     */
    protected function setIncludePath() {
        set_include_path(__DIR__ . "/Modules" . PATH_SEPARATOR . __DIR__ . "/Propel" . PATH_SEPARATOR . get_include_path());
    }
    
    /**
     * InitializePropel
     * 
     * Initialize Propel
     */
    protected function InitializePropel() {
        require_once __DIR__ . "/../vendor/propel/propel1/runtime/lib/Propel.php";
        Propel::init(__DIR__ . "/Propel/conf.php");
    }
    
    /**
     * autoLoadExternals
     * 
     * Loads the autoloader from the External files
     */
    protected function autoLoadExternals() {
        include_once __DIR__ . "/../vendor/autoload.php";
    }
    
    protected function setApp() {
        $this->app = new Silex\Application();
        $this->app['debug'] = $this->debug;
    }
    
    protected function loadRouters() {
        foreach(RouterQuery::create()->filterByActive(true)->find() as $route) {
            $this->app->get($route->getLink(), $route->getAction());
        }        
    }
 }