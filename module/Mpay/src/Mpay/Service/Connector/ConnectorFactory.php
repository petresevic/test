<?php

namespace Mpay\Service\Connector;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;

class ConnectorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $config = $config['mpay']['connector'];

        $service = new Connector();
        $service->setBaseUrl($config['base_url']);
        $service->setClientId($config['client_id']);
        $service->setClientSecret($config['client_secret']);
        $service->setGrantType($config['grant_type']);
        $service->setAccessTokenCachePrefix($config['access_token_cache_prefix']);
        $service->setUsernameCachePrefix($config['username_cache_prefix']);

        $client = new Client();
        $client->setAdapter(new Curl());
        $client->setOptions($config['client_options']);
        $service->setClient($client);

        $cache = $serviceLocator->get('Mpay\Service\Cache');
        $service->setCache($cache);

        $cachedAccessToken = $cache->get($service->getAccessTokenCachePrefix() . $cache->getSessionId());
        if ($cachedAccessToken) $service->setAccessToken($cachedAccessToken);

        $cachedUsername = $cache->get($service->getUsernameCachePrefix() . $cache->getSessionId());
        if ($cachedUsername) $service->setUsername($cachedUsername);


        unset($config);

        return $service;
    }
}

