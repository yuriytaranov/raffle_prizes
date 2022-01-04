<?php


/**
 * Register application autoloader.
 */
spl_autoload_register(function($name){
    $appPath = __DIR__;
    $classPath = str_replace('\\', '/', $name);
    $fullPath = "{$appPath}/{$classPath}.php";
    require_once($fullPath);
});

/**
 * Read configuration file. Gives config value.
 * @param string $section Configuration section
 * @param string $name Parameter name.
 * @param mixed $default Default value is it isn't in config file.
 * 
 * @return mixed Configuration parameter.
 */
function conf($section, $name, $default = null)
{
    static $conf = [];
    if(empty($conf)) {
        $configFiles = glob(__DIR__ . "/conf/*.ini");
        array_walk($configFiles, function($file) use (&$conf) {
            $pieceOfConf = parse_ini_file($file, true, INI_SCANNER_TYPED);
            $conf = array_merge($conf, $pieceOfConf);
        });
    }
    return (isset($conf[$section][$name])) ? $conf[$section][$name] : $default;
}

/**
 * Application access to the database.
 * 
 * @return mixed Configured database connection.
 */
function Database()
{
    static $db = null;
    if(is_null($db) && ($driver = conf("Database", "driver", false)) !== false) {
        $className = "app\\db\\drivers\\{$driver}";
        $db = new $className();
    }
    return $db;
}

/**
 * Application handler.
 * @param string|null $name Class to create application.
 * 
 * @return mixed Application handler.
 */
function app($name = null)
{
    static $h = null;
    if(is_null($h)){
        if(is_null($name)) {
            throw new Exception("Application name required on first call");
        }
        $h = new $name();
    }
    return $h;
}

$vendor = conf("Main", "vendor_autoload", "vendor/autoload.php");

if(file_exists($vendor)) {
    require_once($vendor);
}