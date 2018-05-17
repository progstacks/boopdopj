<?php
namespace app\base\controller;

use app\base\controller\BaseController;

class BaseRouter extends Router
{
    function __construct(){
        parent::__construct();
    }
    public function getController()
    {        
        return $this->getRequestController();
    }
    public function getAction($controller){
        return $this->getRequestAction($controller);
    }
    public function actionHasParameter(){

    }
}
