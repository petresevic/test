<?php

namespace Mpay\Service\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Mpay\Model\UserInterface;

class Acl extends ZendAcl implements AclInterface
{
    public function initAcl()
    {
        $this->addRole(new Role(UserInterface::ROLE_ADM));
        $this->addRole(new Role(UserInterface::ROLE_3U));

        $this->addResource(new Resource('admin'));

        $this->allow(UserInterface::ROLE_ADM, 'admin');
    }
}
