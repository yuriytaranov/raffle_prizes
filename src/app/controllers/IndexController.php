<?php

namespace app\controllers;

use app\ext\Template;
use app\http\Response;
use WebApp;

class IndexController extends HttpController
{
    /**
     * @throws \Exception
     */
    public function index(): \app\http\Response
    {
        return $this->view("index", ['hello' => 'world']);
    }

    /**
     * @throws \Exception
     */
    public function dashboard(): Response {

        return $this->redirect("login");
    }

    public function login(): Response {
        return $this->view("auth/login", []);
    }
}