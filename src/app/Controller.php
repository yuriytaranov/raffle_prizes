<?php

namespace app;

use app\http\Request;
/**
 * All controllers that should return app\Response must extend this class.
 */
abstract class Controller {
    /**
     * @var app\Request The user request.
     */
    protected $_request = null;

    /**
     * Creates a response.
     */
    public function __construct($request)
    {
        $this->_request = $request;
    }
}