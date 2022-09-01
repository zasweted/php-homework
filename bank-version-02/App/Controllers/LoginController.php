<?php

namespace App\Controllers;

use App\App;
use App\DB\Json;

class LoginController {

    public function login()
    {
        $title = 'Login';

        return App::view('user_login', ['title' => $title]);
    }
    public function welcome()
    {
        $title = 'Welcome';

        return App::view('welcome', ['title' => $title]);
    }

    public function logout()
    {
        unset($_SESSION['login'], $_SESSION['user']);

        $title = 'Farewell';

        return App::view('farewell', ['title' => $title]);
    }

    public function doLogin()
    {
        $users = Json::connect('users')->showAll();

        foreach($users as $user){
            if($user['userName'] == $_POST['userName']){
                if($user['pass'] == md5($_POST['pass'])){
                    $_SESSION['login'] =1;
                    $_SESSION['user'] = $user;
                    return App::redirect('welcome');
                }
            }
        }
        return App::redirect('login');
    }
}