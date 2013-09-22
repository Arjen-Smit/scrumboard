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
class Home extends \Helix\Modules\BaseController {

    protected function getTemplate() {
        return "home.html.twig";
    }
    
    protected function draw() {
        $view = array();
        return $this->view->render($this->getTemplate(), array('view' => $view));
    }
}

?>
