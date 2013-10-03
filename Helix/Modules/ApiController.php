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
        
        
        $output = array();
        
        array_push($output, array('title' => 'StickyNote Original scheme :)') );
        
        $themes = array("neon", "ultra", "tropical", "samba", "aquatic", "sunbrite", "classic");
        foreach ($themes as $theme) {
            for($x=1;$x<=5;$x++) {
                $note = array(
                    'title' => 'StickyNote with Scheme: ' . $theme . ' Number: ' . $x  ,
                    'scheme' => $theme,
                    'color' => $x
                );
                array_push($output, $note);
            }
        }
        
        return json_encode($output);
    }
    
}