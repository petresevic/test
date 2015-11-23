<?php

namespace Cpanel;

return array(
    'controllers' => array(
        'invokables' => array(
            'Cpanel\Controller\Index' => 'Cpanel\Controller\IndexController',
        ),
    ),    
    'router' => array(
        'routes' => array(
            'cpanel' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/cpanel',
                    'defaults' => array(
                        'controller' => 'Cpanel\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),  
    'view_manager' => array(
        'template_path_stack' => array(
            'Cpanel' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'cpanel/layout/cpanel' => __DIR__ . '/../view/layout/cpanel.phtml',
        ),
    ),
);    
