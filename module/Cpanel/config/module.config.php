<?php

namespace Cpanel;

return array(
    'controllers'  => array(
        'invokables' => array(
            'Cpanel\Controller\Index'      => 'Cpanel\Controller\IndexController',
            'Cpanel\Controller\Admin'      => 'Cpanel\Controller\AdminController',
            'Cpanel\Controller\Accounting' => 'Cpanel\Controller\AccountingController',
            'Cpanel\Controller\Mcommerce'  => 'Cpanel\Controller\McommerceController',
            'Cpanel\Controller\User'       => 'Cpanel\Controller\UserController',
            'Cpanel\Controller\Error'      => 'Cpanel\Controller\ErrorController',
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
                        'may_terminate' => true,
                        'child_routes'  => array(
                            'user' => array(
                                'type'    => 'Literal',
                                'options' => array(
                                    'route'    => '/users',
                                    'defaults' => array(
                                        'controller' => 'Cpanel\Controller\User',
                                        'action'     => 'index',
                                    ),
                                ),
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
    'view_helpers' => array(
        'invokables' => array(
            'cpanelFlashMessenger' => 'Cpanel\View\Helper\FlashMessenger',
        ),
    ),
    'navigation' => array(
        'cpanel' => array(
            'cpanel' => array(
                'label' => 'Cpanel',
                'route' => 'cpanel',
                'icon'  => 'icon-home',
            ),
            'admin' => array(
                'label' => 'Admin',
                'route' => 'cpanel/admin',
                'icon'  => 'icon-user',
                'pages' => array(
                    'user' => array(
                        'label' => 'Users',
                        'route' => 'cpanel/admin/user',
                    ),
                ),
            ),
            'accounting' => array(
                'label' => 'Accounting',
                'route' => 'cpanel/accounting',
                'icon'  => 'icon-bar-chart',
            ),
            'mcommerce' => array(
                'label' => 'Mcommerce',
                'route' => 'cpanel/mcommerce',
                'icon'  => 'icon-wallet',
            ),
        ),
    ),
);
