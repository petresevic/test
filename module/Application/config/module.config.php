<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index'    => 'Application\Controller\IndexController',
            'Application\Controller\Login'    => 'Application\Controller\LoginController',
            'Application\Controller\Test'     => 'Application\Controller\TestController',
            'Application\Controller\Register' => 'Application\Controller\RegisterController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Login',
                        'action'     => 'index',
                    ),
                ),
            ),
            'register' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/register',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Register',
                        'action'     => 'index',
                    ),
                ),
            ),
            'logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Login',
                        'action'     => 'logout',

                    ),
                ),
            ),
            'test' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/test',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Test',
                        'action'     => 'index',
                    ),
                ),
            ),
            'test-status' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/test-status',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Test',
                        'action'     => 'status',
                    ),
                ),
            ),
            'test-flash' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/test-flash',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Test',
                        'action'     => 'flash',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'Application\Form\User\LoginForm'        => 'Application\Form\User\LoginFormFactory',
            'Application\Form\Register\RegisterForm' => 'Application\Form\Register\RegisterFormFactory',
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale'                    => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phparray',
                'base_dir' => 'data/languages/',
                'pattern'  => '%s.php',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
