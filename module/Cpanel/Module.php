<?php

namespace Cpanel;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

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
        $eventManager->attach('dispatch', array($this, 'checkAccess'), 1000);
        $eventManager->attach('dispatch', array($this, 'setModuleLayout'), 100);
    }

    public function checkAccess(MvcEvent $event)
    {
        if ($this->findModuleName($event) === 'Cpanel') {
            $mpayManager = $event->getApplication()->getServiceManager()->get('Mpay\Service\Manager');
            if (! $mpayManager->getAccessToken()) {
                $routeMatch = $event->getRouteMatch();
                $routeMatch->setParam('controller', 'Application\Controller\Login');
                $routeMatch->setParam('action',     'index');
            }
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
        $matches = $event->getRouteMatch();
        $controllerClass = $matches->getParam('controller');
        $chunks          = explode('\\', $controllerClass);

        return $chunks[0];
    }
}
