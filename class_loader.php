<?php
spl_autoload_register(function ($class) {
    $dir = __DIR__;
    if (file_exists($dir . DIRECTORY_SEPARATOR . 'jobs' . DIRECTORY_SEPARATOR . $class . '.php')) {
        require_once $dir . DIRECTORY_SEPARATOR . 'jobs' . DIRECTORY_SEPARATOR . $class . '.php';
    } else {
        require_once $dir . DIRECTORY_SEPARATOR . $class . '.php';
    }
});
?>