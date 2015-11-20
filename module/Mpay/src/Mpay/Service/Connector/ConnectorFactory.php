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

        $client = new Client();
        $client->setAdapter(new Curl());
        $client->setOptions($config['client_options']);
        $service->setClient($client);

        unset($config);

        return $service;
    }
}

