<?php

namespace app;

class Command {
    /**
     * Array of arguments passed by command line.
     */
    private $_args = [];

    /**
     * {@inheritdoc}
     */
    public function __construct($args)
    {
        $this->_args = $args;
    }

    /**
     * Runs the command and calls an action.
     */
    public function run()
    {
        if(isset($this->_args[2])) {
            $action = $this->_args[2];
            $params = array_slice($this->_args, 2);
            $this->$action(...$params);
        } else {
            $this->handle();
        }

    }

    /**
     * Simple text output to stdout.
     */
    public function write($text)
    {
        echo $text;
    }

    /**
     * Prints text and insert new line.
     */
    public function writeln($text)
    {
        $this->write("{$text}\n");
    }

    /**
     * Prints text and update current line.
     */
    public function writern($text)
    {
        $this->write("{$text}\r");
    }
}