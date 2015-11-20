<?php

return array(
    'modules' => array(
        'Mpay',
        'Application',
        'ZendDeveloperTools',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
);
