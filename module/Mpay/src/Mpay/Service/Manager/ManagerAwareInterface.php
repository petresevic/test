<?php

namespace Mpay\Service\Manager;

interface ManagerAwareInterface
{
    public function setManager(ManagerInterface $manager);
    public function getManager();
}
