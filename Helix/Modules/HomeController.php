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
        return "<h1>Cool</h1>";        
    }
    
    public function API(\Symfony\Component\HttpFoundation\Request $request, \Silex\Application $app) {
        return "request";
    }
}