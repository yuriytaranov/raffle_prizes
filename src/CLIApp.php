<?php

class CLIApp{
    private $_commands = [];

    private function create()
    {
        $name = '';
        $args = $_SERVER['argv'];
        if(isset($args[1])) {
            $name = ucfirst($args[1]);
            $command = "app\\console\\{$name}Command";
            return new $command($args);
        }

        throw new \Exception("Command not found");
    }



    public function run()
    {
        $command = $this->create();

        $command->run();
    }
}