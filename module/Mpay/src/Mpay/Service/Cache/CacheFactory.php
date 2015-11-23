<?php

namespace Mpay\Service\Cache;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\Cache\StorageFactory;

class CacheFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $config = $config['mpay']['cache'];

        $service = new Cache();
        $storage = StorageFactory::factory($config['options']);
        $service->setStorage($storage);
        $service->setSessionId(session_id());

        return $service;
    }
}

