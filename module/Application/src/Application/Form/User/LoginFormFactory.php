<?php

namespace Application\Form\User;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new LoginForm();
        $service->setInputFilter(new LoginFormInputFilter());
        $service->init();

        return $service;
    }
}
