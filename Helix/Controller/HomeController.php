<?php

namespace Helix\Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Helix\Framework\HelixAuthentication;
/**
 * Description of Home
 *
 * @author arjen
 */
class HomeController extends BaseController {
    
    public function Html(Request $request, Application $app) {
        if (HelixAuthentication::logedin($app)) {
            return $this->drawBoard();
        }
        else {
            return $this->drawLogin();
        }
    }
        
    protected function drawBoard() {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . "/../Templates");
        
        $twig_settings = array();
//        $twig_settings['cache'] = __DIR__ . "/Cache";
        $twig = new \Twig_Environment($loader, $twig_settings);
        return $twig->render("base.html.twig");
    }
    
    protected function drawLogin() {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . "/../Templates");
        
        $twig_settings = array();
//        $twig_settings['cache'] = __DIR__ . "/Cache";
        $twig = new \Twig_Environment($loader, $twig_settings);
        return $twig->render("login.html.twig");
    }
}