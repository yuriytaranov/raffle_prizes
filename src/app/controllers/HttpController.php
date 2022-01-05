<?php

namespace app\controllers;

use app\Controller;
use app\ext\Template;
use app\http\Response;
use WebApp;

abstract class HttpController extends Controller {
    /**
     * Render view and return response.
     * @param string $view
     * @param array $data
     * @return Response
     * @throws \Exception
     */
    public function view(string $view, array $data):Response {
        /** @var WebApp $app */
        $app = app();
        $template = new Template("raffle_prizes", "layout");
        $content = $template->render($view, $data);
        $app->response->set($content);
        return $app->response;
    }

    public function redirect(string $url): Response {
        /** @var WebApp $app */
        $app = app();
        $app->response->header(["Location" => $url]);
        return $app->response;
    }
}