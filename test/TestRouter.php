<?php

namespace test\router;

class TestRouter
{
    function __construct(){
        $_GET['QUERY_STRING']='?Site/login';
        app\base\App::loadUserRequest();
        $router = new app\base\controller\BaseRouter();
        $controller = $router->getController();
        $action = $router->getAction();
    }
}