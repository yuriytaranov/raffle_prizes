<?php

use app\Router;
use app\http\Response;

/**
 * Main class for entire web application.
 */
class WebApp{

    /**
     * The router.
     */
    private $_router = null;

    /**
     * Response.
     */
    public $response = null;

    /**
     * Application initialization.
     */
    public function __construct()
    {
        $this->_router = new Router();
        $this->response = new Response();
    }

    /**
     * Tells to the router to handle a request.
     * 
     * @return app\http\Reponse|Response processed request answer.
     */
    public function handle()
    {
        return $this->_router->handle();
    }
}