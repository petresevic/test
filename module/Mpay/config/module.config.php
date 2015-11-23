<?php

return array(
    'mpay' => array(
        'connector' => array(
            // default params for mpay api connection
            'base_url'       => 'http://rest.mpay.net',
            'client_id'      => 'WebApp',
            'client_secret'  => 'testapp',
            'grant_type'     => 'password',
            'client_options' => array(
                'maxredirects' => 2,
                'timeout'      => 10,
                    'curloptions' => array(
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                ),
            ),
            'access_token_cache_prefix' => 'access-token',
            'username_cache_prefix'     => 'username',
        ),
        'cache' => array(
            'options' => array(
                'adapter' => array(
                    'name'    => 'filesystem',
                    'options' => array(
                        'cache_dir'       => 'data/cache',
                        'dir_permission'  => 0777,
                        'file_permission' => 0664,
                        'dir_level'       => 3,
                        'ttl'             => 60,
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Mpay\Service\Connector' => 'Mpay\Service\Connector\ConnectorFactory',
            'Mpay\Service\Cache'     => 'Mpay\Service\Cache\CacheFactory',
            'Mpay\Service\Manager'   => 'Mpay\Service\Manager\ManagerFactory',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'mpayManager' => 'Mpay\View\Helper\Manager',
        ),
    ),
);
