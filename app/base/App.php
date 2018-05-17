<?php

namespace app\base;

use app\base\util\ClassLoader;

class App
{
    static $_appPath = '';
    static $_get = [];
    static $_post = [];
    static $_request = [];
    static $_config = [];
    static $_server = [];
    private function __construct()
    {

    }

    /**
     * Get our base directory path
     * @return string as path
     */
    final public static function getBasePath(): string
    {
        return App::$_appPath;
    }

    /**
     * Sets the base directory path
     * @return null
     */
    final public static function initializePath($path)
    {
        App::$_appPath = $path;
    }

    /**
     * Merges the $_POST, $_GET and $_SERVER global arrays into $_request
     * @return null
     */
    public static function loadUserRequest()
    {
        foreach ($_POST as $key => $value) {
            App::$_post[$key] = trim($value);
        }
        foreach ($_GET as $key => $value) {
            App::$_get[$key] = trim($value);
        }
        foreach ($_SERVER as $key => $value) {
            App::$_server[$key] = trim($value);
        }
        $_request = array_merge(App::$_post, App::$_get);
    }

    //TODO fix this
    public static function getDefaultController()
    {
        $default = App::getConfig('defaults', App::$_config);
        return ClassLoader::getClass($default, 'controller');
    }

    /**
     * Returns the $_SERVER['QUERY_STRING'] value
     */
    private static function getQueryString()
    {
        return App::$_server['QUERY_STRING'];
    }

    /**
     * Returns the $_SERVER['QUERY_STRING'] value
     * @return array value of excploded $_SERVER['QUERY_STRING']
     */
    public static function getRequest(): array
    {
        return explode('/', App::getQueryString());
    }

    /**
     * Loads environment configurations
     * app\environment\<environment>\config\environment.properties
     * @return null
     */
    public static function loadEnvironmentConfig()
    {
        global $config;
        $env = strtolower(App::getEnvironment());
        //C:\xampp\htdocs\myframework\app\environment\dev\congfig.php
        require_once App::getBasePath() . '\\app\\environment\\' . $env . '\\config\environment.properties';
        App::$_config = array_merge($config, $environment);
    }

    /**
     * Gets the value of $key from $conf[]
     * @var string|int $key as array key or index
     * @var array $conf is the array containing the key=>value
     */
    public static function getConfig($key, $conf = [])
    {
        if (count($conf) > 0) {
            return $conf[$key];
        }

        return App::$_config[$key];
    }

    public static function getAppName(){
        return App::$_config['name'];
    }
    /**
     * Gets the application environment
     * $config=[
     *      'env'=>'dev',
     *      ...
     * @return string for environment such as prod|dev|qa|test
     */
    public static function getEnvironment()
    {
        global $config;
        return App::getConfig('env', $config);
    }

    public static function getDefaultTemplate(){  
        global $config;      
        $default= App::getConfig('defaults', $config);
        return App::getConfig('template', $default);
    }
}
