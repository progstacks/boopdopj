<?php

namespace app\base\helper;
use app\base\controller\Controller;
class Html
{
    public static function link($label, $url, $attributs = [])
    {
        $tag = '<a href="' . $url . '" ';
        $tag .=Html::parseHtmlAttributes($attributs);
        $tag .= '>'.$label.'</a>';
        return $tag;
    }
    public static function internalLink($label, $url, $attributes = [])
    {        
        Html::link($label, $url, $attributes);
    }
/**
     * This helper popups the javascript alert window containing the message from return message from the controller.
     * This automatically provides the [id] attribute to the <a></a> tag if none is given.
     * @param string $label is the label of the <a></a> tag.
     * @param string $url of the controller that will perform the revalidation of action.
     * @param array $attributes is the additional attributes of <a></a> tag.
     */
    public static function ajaxLinkAlert($label, $url,  $attributes = [])
    {
        $attributes =Html::registerAjaxLink($label, $attributes, 'ajax_link_alert_js');
        return Html::link($label, $url, $attributes);
    }

    /**
     * This helper popups the confirmation dialog with with customizable action button.
     * This automatically provides the [id] attribute to the <a></a> tag if none is given.
     * This automatically provides the [id], [data-target] and [data-toggle] attribute to the modal target if none is given.
     * @param string $label is the label of the <a></a> tag.
     * @param string $url of the controller that will perform the revalidation of action.
     * @param array $attributes is the additional attributes of <a></a> tag.
     * @param string $template is the template name stored in app\base\helper\script\ directory.
     */
    public static function ajaxLinkPopupModal($label, $url,  $attributes = [],$template)
    {
        //data-toggle="modal" data-target="#myModal"
        $id = isset($attributes['id'])?$attributes['id']:strtolower(str_replace(' ','_',$label));
        $data_toggle = isset($attributes['data-toggle'])?$attributes['data-toggle']:strtolower(str_replace(' ','_',$label));
        $data_target = isset($attributes['data-target'])?$attributes['data-target']:strtolower(str_replace(' ','_',$label));
        $attributes['data-target']=$data_target;
        $attributes['data_target']=$data_target;
        $attributes['data-toggle']=$data_toggle;
        $attributes =Html::registerAjaxLink($label, $attributes, $template);
        unset($attributes['data_target']);
        return Html::link($label, $url, $attributes);
    }
    /**
     * This helper popups the confirmation dialog with with customizable action button.
     * This automatically provides the [id] attribute to the <a></a> tag if none is given.
     * This automatically provides the [id], [data-target] and [data-toggle] attribute to the modal target if none is given.
     * @param string $label is the label of the <a></a> tag.
     * @param string $url of the controller that will perform the revalidation of action.
     * @param array $attributes is the additional attributes of <a></a> tag.
     * @param string $template is the template name stored in app\base\helper\script\ directory.
     */
    public static function ajaxLinkPopupConfirmModal($label, $url,  $attributes = [],$template){
        return Html::ajaxLinkPopupModal($label, $url,  $attributes, $template);
    }
    public static function externalLink($label, $url, $attributes = [])
    {

    }
    /**
     * Parse the passed array of attributes as string key = value.
     * @param array $attributes is the attribute to be parsed
     */
    private static function parseHtmlAttributes($attributes)
    {
        $attr_str='';
        foreach ($attributes as $key => $value) {
            $attr_str.= $key.'="'.$value.'" ';
        }
        return $attr_str;
    }
    /**
     * This helper registers our templates used for ajax and popup operation that will be generated once we completed processing the request.
     * The generated templates can be found right before <body> tag ends.
     * This automatically provides the [id] attribute to the <a></a> tag if none is given.
     * This automatically provides the [id], [data-target] and [data-toggle] attribute to the modal target if none is given.
     * @param string $label is the label of the <a></a> tag.
     * @param string $url of the controller that will perform the revalidation of action.
     * @param array $attributes is the additional attributes of <a></a> tag.
     * @param string $template is the template name stored in app\base\helper\script\ directory.
     */
    private static function registerAjaxLink($label,$attributes,$template){
        // If the attribute id is not set, that label will be automatically converted to element id
        $id = isset($attributes['id'])?$attributes['id']:strtolower(str_replace(' ','_',$label));
        $attributes['id']=$id;
        Controller::setFooterScript('app\base\helper\script\\'.$template,$attributes);
        return $attributes;
    }
}
