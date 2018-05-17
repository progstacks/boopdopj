<?php
namespace app\base;

use app\base\controller\Router;
use app\base\util\ClassLoader;

class Application
{
    /**
     * Starts our application
     */
    public function start()
    {
        global $config;
        /**
        * Let's load the default router from out base configuration $config[]
        * $config=[
        *   ...
        *    'router'=>[
        *        'class'=>'BaseRouter',
        *        'namespace'=>'app\base\controller',
        *    ],...
        *];
        */
        $router = ClassLoader::getClass($config, 'router');
        
        // Instantiate our router.
        // BaseRouter
        $rtr = new $router();

        // Get the required controller.
        // BaseRouter.getController()
        $controllerClass = $rtr->getController();

        // Instantiate our controller.
        $controller = new $controllerClass();

        // Get the intended or default action 
        // method from the controller
        // BaseRouter.getAction()
        $method = $rtr->getAction($controller);
        
        // Get the method parameters
        $parameters = $controller->getMethodParameters($method);
        
        // Use reflection to invoke our controller's method
        $reflectionMethod = new \ReflectionMethod($controller, $method);

        // Invoke our controller's method and pass on the arguments
        $reflectionMethod->invokeArgs($controller, array('username'=>'Mike', 'password'=>'346234'));

        // if has content to render display the page
        if($controller->hasContent()){
            echo($controller->output());
        }
        
    }
}
