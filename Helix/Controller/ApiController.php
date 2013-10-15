<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helix\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Silex\Application;
use Helix\Framework\HelixAuthentication;
use Helix\Modules\ProjectModule;

/**
 * Description of Home
 *
 * @author arjen
 */
class ApiController extends BaseController {
    
    /**
     * Holds the Silex Application
     * 
     * @var Silex\Application 
     */
    protected $app;
    
    /**
     * Holds the request to the API
     * 
     * @var Symfony\Component\HttpFoundation\Request 
     */
    protected $request;
    
    
    /**
     * Loaded Module
     *
     * @var \Helix\Module\*
     */
    protected $module;
    
    /**
     * Request
     * 
     * Start point of the API
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Silex\Application $app
     * @return string
     */
    public function Request(Request $request, Application $app) {
        if (!HelixAuthentication::logedin($app)) {
            return json_encode(array("authentication" => false));
        }
        
        $this->app = $app;
        $this->request = $request;
        $this->SetModule();        
        $this->SuggestParametersFromRequest();        

        return $this->InvokeModule();
    }
    
    
    /**
     * InvokeModule
     * 
     * Runs the Module as either get or post depending on the request method
     * 
     * @return string
     */
    protected function InvokeModule() {
        switch ($this->request->getMethod()) {
            case "GET":
                $this->module->ApiGet();
                break;
            case "POST":
                $this->module->ApiPost();
                break;
            default:
                return json_encode(array("error" => "unknow request type"));
        }
        if (!$this->module->hasErrors()) {
            return $this->module->getJson();
        }
        else {
            return $this->module->getErrors();
        }
    }
    
    /**
     * setModule
     * 
     * Gets the Module from the request and loads it
     */
    protected function SetModule() {
        $moduleName = "\Helix\Modules\\" . ucfirst($this->request->get('module')) . "Module";
        if (class_exists($moduleName)) {
            $this->module = new $moduleName();
        } else {
            $this->module = false;
        }
        
        if ($this->module instanceof \Helix\Modules\ApiModule) {
            $this->module->setApp($this->app);
        }
    }
    
    
    /**
     * SuggestParametersFromRequest
     * 
     * Suugests Paramaters to the module from the query
     */
    protected function SuggestParametersFromRequest() {
        $attributes = $this->request->attributes;
        if ($attributes instanceof ParameterBag) {
            foreach($attributes->keys() as $key) {
                $method = \Helix\Framework\HelixFunctions::camelize("set_" . $key);
                if (method_exists($this->module, $method) && $attributes->has($key)) {
                    $this->module->$method($attributes->get($key));
                }
            }
        }
        
        $query = $this->request->query;
        if ($query instanceof ParameterBag) {
            foreach($query->keys() as $key) {
                $method = \Helix\Framework\HelixFunctions::camelize("set_" . $key);
                if (method_exists($this->module, $method) && $query->has($key)) {
                    $this->module->$method($query->get($key));
                }
            }   
        }
    }
      
//    protected function getContent() {
//        $requested = $this->request->get('requested');
//        switch($requested) {
//            case "stories":
//                return $this->getStories();
//                break;
//            case "project":
//                return $this->getProject();
//                break;
//            default:
//                return json_encode(array("error" => "invalid request"));
//        }
//    }
//    
//    protected function postContent() {
//        return json_encode(array("error" => "Not implemented yet"));
//    }
//    
//    protected function getProject() {
//        var_dump( 
//        get_class_methods($this->request->query)); die;
//        return json_encode(array("error" => "Not implemented yet"));
//    }
//    
//    protected function getStories() {
//        $output = array();
//        
//        array_push($output, array('title' => 'StickyNote Original scheme :)') );
//        
//        $themes = array("neon", "ultra", "tropical", "samba", "aquatic", "sunbrite", "classic");
//        foreach ($themes as $theme) {
//            for($x=1;$x<=5;$x++) {
//                $note = array(
//                    'title' => 'StickyNote with Scheme: ' . $theme . ' Number: ' . $x  ,
//                    'scheme' => $theme,
//                    'color' => $x
//                );
//                array_push($output, $note);
//            }
//        }
//        
//        return json_encode($output);
//    }
    
}