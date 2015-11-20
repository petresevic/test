<?php

namespace Mpay\Service\MpayManager;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class MpayManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $config = $config['mpay'];

        $service = new MpayManager();

        unset($config);

        return $service;
    }
}

