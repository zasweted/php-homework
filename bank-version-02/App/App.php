<?php

namespace App;

use App\Controllers\HomeController as H;
use App\Controllers\UserController as U;
use App\Controllers\LoginController as L;
use App\Middlewares\Auth;

class App {

    public static function start()
    {
        session_start();
        self::router();
    }

    public static function router()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        array_shift($url);
        $method = $_SERVER['REQUEST_METHOD'];

        if(!Auth::authorize($url)){
            return self::redirect('login');
        }

        if($method == 'GET' && count($url) == 1 && $url[0] == ''){
            return((new H)->home());
        }
        if($method == 'GET' && count($url) == 1 && $url[0] == 'create'){
            return((new U)->create());
        }
        if($method == 'POST' && count($url) == 1 && $url[0] == 'store'){
            return((new U)->store());
        }
        if($method == 'GET' && count($url) == 1 && $url[0] == 'list'){
            return((new U)->list());
        }
        if($method == 'GET' && count($url) == 1 && $url[0] == 'login'){
            return((new L)->login());
        }
        if($method == 'GET' && count($url) == 1 && $url[0] == 'welcome'){
            return((new L)->welcome());
        }
        if($method == 'POST' && count($url) == 1 && $url[0] == 'login'){
            return((new L)->doLogin());
        }
        if($method == 'POST' && count($url) == 1 && $url[0] == 'logout'){
            return((new L)->logout());
        }
    }

    public static function view(string $name, array $data=[])
    {
        extract($data);
        require DIR . 'resources/view/' . $name . '.php';
    }

    public static function redirect(string $where)
    {
        header('Location: ' . URL . $where);
    }
}