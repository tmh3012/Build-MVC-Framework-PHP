<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $data = [
            'title' => 'Shop page',
        ];
        return $this->View('home', $data);
    }
    public function contact()
    {
        return $this->View('frontEnd.contact');
    }

    public function handlerContact( Request $request)
    {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "</pre>";
    }

}