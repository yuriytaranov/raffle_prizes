<?php
namespace app;

/**
 * Use this trait to handle requests with a controller
 * 
 * @return app\Response|false if request processed or false.
 */
trait Route {
    public function handle($request)
    {
        $controller = null;
        foreach($this->map() as $path => $callbackName) {
            $actionArguments = [];
            $routeProcess = preg_match($path, $request->path, $actionArguments);
            array_shift($actionArguments);
            if(1 === $routeProcess) {
                $controllerClass = key($callbackName);
                $action = $callbackName[$controllerClass];
                $controller = new $controllerClass($request);
                return $controller->$action(...$actionArguments);
            }
        }
        return false;
    }
}