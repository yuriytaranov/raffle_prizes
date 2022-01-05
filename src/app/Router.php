<?php
namespace app;
use app\http\Request;
use app\http\Response;
use WebApp;

class Router {
    /** @var WebApp */
    public $app = null;
    /**
     * Array of router files.
     */
    private $_routers = null;

    /**
     * Scans the route dir for the routers.
     */
    private function scan()
    {
        $routerFiles = glob(__DIR__ . "/routes/*Route.php");
        array_walk($routerFiles, function($item) {
            $className = str_replace('.php', '', basename($item));
            $routeClass = "app\\routes\\{$className}";
            $this->_routers[] = new $routeClass();
        });
    }

    /**
     * Router handler
     *
     * @return Response The answer.
     */
    public function handle(): Response
    {
        $this->scan();
        $request = new Request();
        foreach($this->_routers as $route) {
            if(($result = $route->handle($request)) !== false) {
                return $result;
            }
        }

        //TODO: The router must not create a new response in case of errors.
        $response = new Response();
        
        $response->json->error(404, 'Not found!');
        return $response;
    }
}