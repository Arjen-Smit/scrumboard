<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helix\Framework;

use Silex\Application;
use ScrumBoard\User;
use ScrumBoard\UserQuery;
/**
 * Description of Home
 *
 * @author arjen
 */
class HelixAuthentication {
    public function login(Application $app, $username = false, $password = false) {
        if ($username === false || $password === false) {
            return false;
        }
        $user = UserQuery::create()->filterByUsername($username)->filterByPassword(md5($password) )->findOne();
        if ($user instanceof User) {
            $app['session']->set('user', $user);
            return $app['session']->get('user');
        }
        return false;
    }
    
    public static function logedin(Application $app) {
        if ($app['session']->get('user') instanceof User) {
            return true;
        }        
        return false;

    }
    
    public static function getUser(Application $app) {
        if ($app['session']->get('user') instanceof User) {
            return $app['session']->get('user');
        }        
        return false;
    }
}