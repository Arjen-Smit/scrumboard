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
class ApiController extends \Helix\Modules\BaseController {
    
    public function Request(\Symfony\Component\HttpFoundation\Request $request, \Silex\Application $app) {
        var_dump($request); die;
        return $request;
    }
    
}