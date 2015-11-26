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
    'service_manager' => array(
        'factories' => array(
            'Cpanel\Service\Navigation' => 'Cpanel\Service\NavigationFactory',
        ),
        'aliases' => array(
            'cpanel-nav' => 'Cpanel\Service\Navigation',
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
    'navigation' => array(
        'cpanel' => array(
            'item1' => array(
                'label' => 'Item 1',
                'route' => 'cpanel',
                'icon'  => 'icon-plane',
            ),
            'item2' => array(
                'label' => 'Item 2',
                'route' => 'cpanel/admin',
                'icon'  => 'icon-plane',
                'pages' => array(
                    'item21' => array(
                        'label' => 'Item 2 1',
                        'route' => 'cpanel/accounting',
                        'icon'  => 'icon-plane',
                    ),
                    'item22' => array(
                        'label' => 'Item 2 2',
                        'route' => 'cpanel/mcommerce',
                        'icon'  => 'icon-plane',
                        'pages' => array(
                            'item221' => array(
                                'label' => 'Item 2 2 1',
                                'route' => 'cpanel/accounting',
                                'icon'  => 'icon-plane',
                            ),
                            'item222' => array(
                                'label' => 'Item 2 2 2',
                                'route' => 'cpanel/accounting',
                                'icon'  => 'icon-plane',
                            ),
                            'item223' => array(
                                'label' => 'Item 2 2 3',
                                'route' => 'cpanel/accounting',
                                'icon'  => 'icon-plane',
                            ),
                        ),
                    ),
                    'item23' => array(
                        'label' => 'Item 2 3',
                        'route' => 'cpanel/accounting',
                        'icon'  => 'icon-plane',
                    ),
                ),
            ),
            'item3' => array(
                'label' => 'Item 3',
                'route' => 'cpanel/accounting',
                'icon'  => 'icon-plane',
            ),
        ),
    ),
);
