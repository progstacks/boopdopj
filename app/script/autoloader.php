<?php
require_once 'app\common\config\common.properties';
spl_autoload_register(function ($name) {
    if (file_exists($name . '.php')) {
        require_once $name . '.php';
    } else {
        throw new app\base\exception\ClassNotFoundException("Unable to load " . $name);
    }
});