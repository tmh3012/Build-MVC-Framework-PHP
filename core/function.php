<?php

use app\core\Application;

if (! function_exists('generateBreadcrumbs')){
    function generateBreadcrumbs(): string
    {
        $breadcrumbs = Application::$app->controller->breadcrumbs;
        $result = '';
        foreach($breadcrumbs as $each) {
            $result .= '<a class="level" href="'.$each['url'] .'"><span class="level-title">'. $each['label'] .'</span></a> > ';
        }
//        return $result;
        return rtrim($result,' > ');
    }
}
