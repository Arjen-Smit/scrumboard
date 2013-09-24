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
class HomeController extends \Helix\Modules\BaseController {
    
    public function Html(\Symfony\Component\HttpFoundation\Request $request, \Silex\Application $app) {
        return $this->setTwig();
    }
    
    public function API(\Symfony\Component\HttpFoundation\Request $request, \Silex\Application $app) {
        return "request";
    }
    
    
    protected function setTwig() {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . "/../Templates");
        
        $twig_settings = array();
//        $twig_settings['cache'] = __DIR__ . "/Cache";
        $twig = new \Twig_Environment($loader, $twig_settings);
        return $twig->render("base.html.twig");
    }
}