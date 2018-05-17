<?php

namespace app\base\controller;

use app\base\App;

class Controller
{
    private $_page_parts = array();
    private $_template = '';
    private $_has_content = false;
    static $_footer_scripts =[];
    public function __contruct()
    {
        $this->_page_parts = array();
    }
    public function getMethodParameters($funcName)
    {
        $f = new \ReflectionMethod($this, $funcName);
        $result = array();
        foreach ($f->getParameters() as $param) {
            $result[] = $param->name;
        }
        return $result;
    }

    public function renderFinalPage(string $mainContent, $template)
    {
        $this->addMainContent($mainContent);
        return $this->output($template);
    }

    public function addRightSideBarContent(string $content)
    {
        if (!isset($this->_page_parts['right_side_bar'])) {
            $this->_page_parts += ['right_side_bar' => []];
        }
        array_push($this->_page_parts['right_side_bar'], $content);
        $this->_has_content = true;
    }

    public function addGridContent(string $content)
    {
        $this->addContent('grid', $content);
    }

    public function addLeftSideBarContent(string $content)
    {
        $this->addContent('left_side_bar', $content);
    }
    public function addMainContent(string $content)
    {
        $this->addContent('center_content', $content);
    }

    public function addContent($location, $content)
    {
        if (!isset($this->_page_parts[$location])) {
            $this->_page_parts[$location] = [];
        }
        array_push($this->_page_parts[$location], $content);
        $this->_has_content = true;
    }
    public function setTemplate(string $template)
    {
        $this->_template = $template;
    }
    /**
     * DONT invoke this method this manually!!!
     * This is automatically executed at the end of processing.
     * Ajax reply doesnt execute this;
     * To load the template into buffer, just use render('template',array(key=>value))
     * To output ajax reply, just use outputAjax('template',array(key=>value))
     * To output ajax reply, just use outputAjaxObject(Object())
     */
    public function output(string $template = '')
    {
        $template = $template === "" ? ($this->_template === "" ? App::getDefaultTemplate() : $this->_template) : $template;
        ob_start();
        extract($this->_page_parts);
        require_once $template . '.php';
        return (ob_get_clean());
    }
    public static function render(string $template, array $keyValue=[])
    {
        ob_start();
        extract($keyValue);
        require_once $template . '.php';
        return (ob_get_clean());
    }
    public function hasContent()
    {
        return $this->_has_content;
    }

    public static function setFooterScript($script,$attributes=[]){
        $script = Controller::render($script,$attributes);
        Controller::$_footer_scripts[]= $script;
    }

    public static function outputAjax($template,$attributes=[]){
        echo Controller::render($template,$attributes);
    }
}
