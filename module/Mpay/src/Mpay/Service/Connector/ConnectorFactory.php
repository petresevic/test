<?php

namespace Mpay\Service\Connector;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\Http\Client;

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

        $client = new Client();
        $client->setOptions($config['client_options']);
        $service->setClient($client);

        $cache = $serviceLocator->get('Mpay\Service\Cache');
        $service->setCache($cache);

        unset($config);

        return $service;
    }
}

