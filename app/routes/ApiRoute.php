<?php

namespace app\routes;
use app\Route;

/**
 * Api route
 */
class ApiRoute {
    use Route;

    private function map()
    {
        return [
            '/^api\/list$/' => ['app\controllers\ListController' => 'list'],
            '/^api\/list\/create$/' => ['app\controllers\ListController' => 'create'],
            '/^api\/list\/(\d{1,})$/' => ['app\controllers\ListController' => 'item'],
        ];
    }
}