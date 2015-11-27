<?php

namespace Mpay\Service\Acl;

use Mpay\Model\UserInterface;

interface AclInterface
{
    public function initAcl();
    public function checkAcl(UserInterface $user, $routeMatchOrUrl);
    public function denyAccess();
}
