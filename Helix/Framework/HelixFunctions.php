<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helix\Framework;

/**
 * Description of Home
 *
 * @author arjen
 */
class HelixFunctions {
    
    static public function uncamelize($camel,$splitter="_") {
        $camel=preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', $splitter.'$0', $camel));
        return strtolower($camel);
    }
    
    static public function camelize($word) { 
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word); 
    }
            
}