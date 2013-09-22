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
    
    /**
     *
     * @var Twig_Environment
     */
    protected $twig;
    
    
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
        $this->setTwig();
    }
    
        
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
        require_once __DIR__ . "/Externals/propel/propel1/runtime/lib/Propel.php";
        Propel::init(__DIR__ . "/Propel/conf.php");
    }
    
    /**
     * autoLoadExternals
     * 
     * Loads the autoloader from the External files
     */
    protected function autoLoadExternals() {
        include_once __DIR__ . "/Externals/autoload.php";
    }
    
    protected function setApp() {
        $this->app = new Silex\Application();
        $this->app['debug'] = $this->debug;
    }
    
    protected function loadRouters() {
        foreach(HelixRouterQuery::create()->filterByActive(true)->find() as $router) {
            if ($router instanceof HelixRouter) {
                $controllerClass = $router->getModule();
                $viewClass = $this->twig;
                $this->app->get($router->getSeolink(), function() use($viewClass, $controllerClass) {
                    $controller = new $controllerClass($viewClass);
                    return $controller->run();
                });
            }
        }
    }
    
    protected function setTwig() {
        /* Load Twig */
        $loader = new Twig_Loader_Filesystem(__DIR__ . "/Templates");
        $twig_settings = array();
        
        if(!$this->debug) {
            $twig_settings['cache'] = __DIR__ . "/Cache";
        }
                
        $this->twig = new Twig_Environment($loader, $twig_settings);
    }

 }