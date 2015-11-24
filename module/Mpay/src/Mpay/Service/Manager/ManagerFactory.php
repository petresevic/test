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

        $service   = new Manager();
        $connector = $serviceLocator->get('Mpay\Service\Connector');
        $service->setConnector($connector);
        $cache = $serviceLocator->get('Mpay\Service\Cache');
        $service->setCache($cache);
        $service->setSessionId(session_id());

        $cachedAccessToken  = $cache->get($cache->getAccessTokenCachePrefix() . $service->getSessionId());
        $cachedLoggedInUser = unserialize($cache->get($cache->getUserCachePrefix() . $service->getSessionId()));

        if ($cachedAccessToken) $service->setAccessToken($cachedAccessToken);
        if ($cachedLoggedInUser && $cachedLoggedInUser->getId()) $service->setLoggedInUser($cachedLoggedInUser);

        //$cachedUsername = $cache->get($service->getUsernameCachePrefix() . $cache->getSessionId());
        //if ($cachedUsername) $service->setUsername($cachedUsername);

        unset($config);

        return $service;
    }
}

