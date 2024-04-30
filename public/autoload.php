<?php
define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH", dirname(__DIR__) . DS);
define("APP", ROOT_PATH . 'app' . DS);
define("CORE", APP . 'Core' . DS);
define("CONFIG", APP . 'Config' . DS);
define("CONTROLLERS", APP . 'Controllers' . DS);
define("MODELS", APP . 'Models' . DS);
define("VIEWS", APP . 'Views' . DS);

define("UPLOADS", ROOT_PATH . 'public' . DS . 'uploads' . DS);

function custom_autoload($class) {
    $class_file = str_replace('\\', DS, $class) . '.php';
    $paths = [ROOT_PATH, APP, CORE, VIEWS, CONTROLLERS, MODELS, CONFIG];
    foreach ($paths as $path) {
        $file = $path . $class_file;
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}

spl_autoload_register('custom_autoload');
