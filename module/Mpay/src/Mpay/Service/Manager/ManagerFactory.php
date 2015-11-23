<?php

namespace Mpay\Service\Manager;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $config = $config['mpay'];

        $service = new Manager();
        $service->setConnector($serviceLocator->get('Mpay\Service\Connector'));
        $service->setCache($serviceLocator->get('Mpay\Service\Cache'));

        unset($config);

        return $service;
    }
}

