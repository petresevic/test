<?php

namespace Mpay\Service\Manager;

use Mpay\Model\Entity\User;

interface ManagerInterface
{
    public function userLogin(User $user, $accessToken);
    public function userLogout();
}
