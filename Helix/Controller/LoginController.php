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
class LoginController extends BaseController {
    
    public function Login(Request $request, Application $app) {
        $username = $request->get('username');
        $password = $request->get('password');
        
        $user = HelixAuthentication::login($app, $username, $password);
        
        return $app->redirect("/");
    }
}