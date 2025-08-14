<?php

spl_autoload_register(function ($className) {
    $folders = [
        __DIR__ . '/../core/',
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/',
    ];

    foreach ($folders as $folder) {
        $file = $folder . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
