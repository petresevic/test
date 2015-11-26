<?php

namespace Cpanel;

return array(
    'controllers'  => array(
        'invokables' => array(
            'Cpanel\Controller\Index'      => 'Cpanel\Controller\IndexController',
            'Cpanel\Controller\Admin'      => 'Cpanel\Controller\AdminController',
            'Cpanel\Controller\Accounting' => 'Cpanel\Controller\AccountingController',
            'Cpanel\Controller\Mcommerce'  => 'Cpanel\Controller\McommerceController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cpanel' => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/cpanel',
                    'defaults' => array(
                        'controller' => 'Cpanel\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'slash' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route' => '/',
                        ),
                    ),
                    'admin' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/admin',
                            'defaults' => array(
                                'controller' => 'Cpanel\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'accounting' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/accounting',
                            'defaults' => array(
                                'controller' => 'Cpanel\Controller\Accounting',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'mcommerce' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/mcommerce',
                            'defaults' => array(
                                'controller' => 'Cpanel\Controller\Mcommerce',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Cpanel' => __DIR__ . '/../view',
        ),
        'template_map'        => array(
            'cpanel/layout/cpanel' => __DIR__ . '/../view/layout/cpanel.phtml',
        ),
    ),
);
