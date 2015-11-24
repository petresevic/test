<?php

namespace Application\Form\Register;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegisterFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new RegisterForm();
        $service->setInputFilter(new RegisterFormInputFilter());
        $service->init();

        return $service;
    }
}
