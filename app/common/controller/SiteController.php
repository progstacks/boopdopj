<?php

namespace app\common\controller;
use app\base\controller\Controller;
use app\base\controller\ControllerInterface;
class SiteController extends Controller implements ControllerInterface
{
    public function indexAction(){
        $this->addMainContent($this->render('app\common\view\docs\welcome'));

        $this->addGridContent($this->render('app\common\view\site\login_form'));
        $this->addGridContent($this->render('app\common\view\docs\about'));
        $this->addGridContent($this->render('app\common\view\docs\getting_started'));
    }
    public function loginAction($username,$password){
        return 'hello '.$username.' world! login using '. $password;
    }
    
    public function renderPage($content){
        return $this->renderFinalPage($content,'app\common\template\main-template');
    }

    public function cheetsheetAction(){
        $this->outputAjax('app\common\view\site\hello_ajax_alert');
    }

    public function alertAction(){
        $this->outputAjax('app\common\view\site\hello_ajax_alert');
    }
    
    public function modalAction(){
        $this->outputAjax('app\common\view\site\hello_ajax_modal');
    }
    public function confirmAction(){
        $this->outputAjax('app\common\view\site\hello_ajax_confirm_modal');
    }
}