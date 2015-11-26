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
        $service->setSessionId(session_id());

        $cache = $serviceLocator->get('Mpay\Service\Cache');

        $cachedAccessToken  = $cache->get($cache->getAccessTokenCachePrefix() . $service->getSessionId());
        $cachedLoggedInUser = unserialize($cache->get($cache->getUserCachePrefix() . $service->getSessionId()));

        if ($cachedAccessToken) $service->setAccessToken($cachedAccessToken);
        if ($cachedLoggedInUser && $cachedLoggedInUser->getId()) $service->setLoggedInUser($cachedLoggedInUser);

        unset($config);

        return $service;
    }
}

