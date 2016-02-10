<?php

namespace Mpay;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Mpay\Service\Acl\AclAwareInterface;
use Mpay\Service\Cache\CacheAwareInterface;
use Mpay\Service\Connector\ConnectorAwareInterface;
use Mpay\Service\Manager\ManagerAwareInterface;

class Module implements AutoloaderProviderInterface,
                        ConfigProviderInterface,
                        ServiceProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'initializers' => array(
                function ($instance, $serviceManager) {
                    if ($instance instanceof AclAwareInterface) {
                        $instance->setAcl($serviceManager->get('Mpay\Service\Acl'));
                    }
                    if ($instance instanceof CacheAwareInterface) {
                        $instance->setCache($serviceManager->get('Mpay\Service\Cache'));
                    }
                    if ($instance instanceof ConnectorAwareInterface) {
                        $instance->setConnector($serviceManager->get('Mpay\Service\Connector'));
                    }
                    if ($instance instanceof ManagerAwareInterface) {
                        $instance->setManager($serviceManager->get('Mpay\Service\Manager'));
                    }
                },
            ),
        );
    }
    
    public function jajosh()
    {
}
