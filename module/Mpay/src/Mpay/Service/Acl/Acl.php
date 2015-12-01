<?php

namespace Mpay\Service\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Mpay\Model\UserInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Http\Request;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Acl extends ZendAcl implements AclInterface,
                                     ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    public function initAcl()
    {
        $this->addRole(UserInterface::ROLE_WP);
        $this->addRole(UserInterface::ROLE_3U);
        $this->addRole(UserInterface::ROLE_ADM);
        $this->addRole(UserInterface::ROLE_CC);
        $this->addRole(UserInterface::ROLE_FM);
        $this->addRole(UserInterface::ROLE_AS);
        $this->addRole(UserInterface::ROLE_CRM);
        $this->addRole(UserInterface::ROLE_A);
        $this->addRole(UserInterface::ROLE_M);
        $this->addRole(UserInterface::ROLE_S);
        $this->addRole(UserInterface::ROLE_MTC);
        $this->addRole(UserInterface::ROLE_DCARD);
        $this->addRole(UserInterface::ROLE_3VOMS);
        $this->addRole(UserInterface::ROLE_UC);
        $this->addRole(UserInterface::ROLE_IN);
        $this->addRole(UserInterface::ROLE_FEE);

        $this->addResource('cpanel.index.read');
        $this->addResource('cpanel.admin.read');
        $this->addResource('cpanel.accounting.read');
        $this->addResource('cpanel.mcommerce.read');
        $this->addResource('cpanel.user.read');

        $this->allow(UserInterface::ROLE_ADM, 'cpanel.index.read');
        $this->allow(UserInterface::ROLE_ADM, 'cpanel.admin.read');
        $this->allow(UserInterface::ROLE_ADM, 'cpanel.accounting.read');
        $this->allow(UserInterface::ROLE_ADM, 'cpanel.mcommerce.read');
        $this->allow(UserInterface::ROLE_ADM, 'cpanel.user.read');

        $this->allow(UserInterface::ROLE_S, 'cpanel.index.read');
    }

    public function checkAcl(UserInterface $user, $routeMatchOrUrl)
    {
        if (! $user || ! $user->getRole()) return false;

        if ((! $routeMatchOrUrl instanceof RouteMatch) && ! is_string($routeMatchOrUrl)) {
            throw new \InvalidArgumentException('routeMatchOrUrl should instance of Zend\Mvc\Router\Http\RouteMatch or URL string, ' . gettype($routeMatchOrUrl) . ' provided');
        }

        if (is_string($routeMatchOrUrl)) {
            $router  = $this->getServiceLocator()->get('router');
            $request = new Request();
            $request->setUri($routeMatchOrUrl);
            $match = $router->match($request);
            if (! $match) throw new \InvalidArgumentException('Invalid url provided as routeMatchOrUrl');
            $routeMatchOrUrl = $match;
        }

        $params   = $this->getParamsFromRouteMatch($routeMatchOrUrl);
        $resource = $params['module'] . '.' . $params['controller'] . '.' . $params['action'];

        return $this->isAllowed($user->getRole(), $resource);
    }

    protected function getParamsFromRouteMatch(RouteMatch $routeMatch)
    {
        $params          = array();
        $controllerClass = $routeMatch->getParam('controller');
        $chunks          = explode('\\', $controllerClass);
        $moduleName      = strtolower($chunks[0]);
        $controllerName  = strtolower($chunks[sizeof($chunks) - 1]);
        $actionName      = strtolower($routeMatch->getParam('action'));

        if ($actionName == 'index') $actionName = 'read';

        $params['module']     = $moduleName;
        $params['controller'] = $controllerName;
        $params['action']     = $actionName;

        return $params;
    }

    public function denyAccess()
    {
        $routeMatch = $this->getServiceLocator()->get('application')->getMvcEvent()->getRouteMatch();
        $routeMatch->setParam('controller', 'Cpanel\Controller\Error');
        $routeMatch->setParam('action',     'error403');
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
