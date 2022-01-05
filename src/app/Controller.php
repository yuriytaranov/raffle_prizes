<?php

namespace app;

use app\http\Request;
/**
 * All controllers that should return app\Response must extend this class.
 */
abstract class Controller {
    /**
     * @var array current app instance.
     */
    protected $app = null;
    /**
     * @var Request The user request.
     */
    protected $_request = null;

    /**
     * Creates a response.
     */
    public function __construct(Request $request)
    {
        $this->_request = $request;
    }
}