<?php

namespace Cpanel;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Session\Config\SessionConfig;

class Module implements AutoloaderProviderInterface,
                        ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'sessionSTart'), 9000);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'checkAccess'), 1000);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'setModuleLayout'), 100);
    }

    public function sessionStart(MvcEvent $event)
    {
        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions(array());

        $sessionManager = new SessionManager($sessionConfig);
        $sessionManager->start();
        Container::setDefaultManager($sessionManager);
    }

    public function checkAccess(MvcEvent $event)
    {
        if ($this->findModuleName($event) === 'Cpanel') {
            $mpayManager = $event->getApplication()->getServiceManager()->get('Mpay\Service\Manager');
            $routeMatch  = $event->getRouteMatch();

            if (! $mpayManager->getAccessToken()) {
                $routeMatch->setParam('controller', 'Application\Controller\Login');
                $routeMatch->setParam('action',     'index');

                return;
            }

            $acl = $event->getApplication()->getServiceManager()->get('Mpay\Service\Acl');

            if (! $acl->checkAcl($mpayManager->getLoggedInUser(), $routeMatch)) $acl->denyAccess();
        }
    }

    public function setModuleLayout(MvcEvent $event)
    {
        if ($this->findModuleName($event) === 'Cpanel') {
            $viewModel = $event->getViewModel();
            $viewModel->setTemplate('cpanel/layout/cpanel');
        }
    }

    protected function findModuleName(MvcEvent $event)
    {
        $matches         = $event->getRouteMatch();
        $controllerClass = $matches->getParam('controller');
        $chunks          = explode('\\', $controllerClass);

        return $chunks[0];
    }
}
