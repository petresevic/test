<?php

namespace Mpay\Service\Acl;

interface AclAwareInterface
{
    public function setAcl(AclInterface $cache);
    public function getAcl();
}
