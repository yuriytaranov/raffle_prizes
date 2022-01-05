<?php

namespace app\routes;

use app\Route;

class WebRoute {
    use Route;

    private function map(): array
    {
        return [
            '/^$/' => ['app\controllers\IndexController' => 'index'],
            '/^login$/' => ['app\controllers\IndexController' => 'login'],
            '/^authenticate/' => ['app\controllers\IndexController' => 'authenticate'],
            '/^register/' => ['app\controllers\IndexController' => 'register'],
            '/^dashboard/' => ['app\controllers\IndexController' => 'dashboard'],
        ];
    }
}