<?php

use Controllers\MainController;
use Controllers\ProfileController;
use Core\Autoloader;
use Controllers\UserController;
use Requests\LoginRequest;
use Requests\ProfileRequest;
use Requests\RegistrationRequest;

require_once './../Core/Autoloader.php';

Autoloader::registrate();

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/login') {
    $obj = new UserController();
    if ($requestMethod === 'GET') {
        $obj->getLogin();
    } elseif ($requestMethod === 'POST') {
        $request = new LoginRequest($_POST);
        $obj->postLogin($request);
    } else {
        echo "Метод $requestMethod не поддерживается для адреса $requestUri";
    }
}

if ($requestUri === '/registrate') {
    $obj = new UserController();
    if ($requestMethod === 'GET') {
        $obj->getRegistrate();
    } elseif ($requestMethod === 'POST') {
        $request = new RegistrationRequest($_POST);
        $obj->postRegistrate($request);
    } else {
        echo "Метод $requestMethod не поддерживается для адреса $requestUri";
    }
}

if ($requestUri === '/profile') {
    $obj = new ProfileController();
    if ($requestMethod === 'GET') {
        $obj->getProfile();
    } elseif ($requestMethod === 'POST') {
        $request = new ProfileRequest($_POST);
        $obj->postProfile($request);
    } else {
        echo "Метод $requestMethod не поддерживается для адреса $requestUri";
    }
}

if ($requestUri === '/main') {
    $obj = new MainController();
    if ($requestMethod === 'GET') {
        $obj->getMain();
    } else {
        echo "Метод $requestMethod не поддерживается для адреса $requestUri";
    }
}

if ($requestUri === '/logout') {
    $obj = new UserController();
    if ($requestMethod === 'GET') {
        $obj->logout();
    } else {
        echo "Метод $requestMethod не поддерживается для адреса $requestUri";
    }
}
