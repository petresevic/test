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
        $service->setAccessTokenCachePrefix($config['access_token_cache_prefix']);
        //$service->setUsernameCachePrefix($config['username_cache_prefix']);
        $service->setUserCachePrefix($config['user_cache_prefix']);

        return $service;
    }
}

