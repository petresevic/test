<?php

namespace Mpay\Service\MpayManager;

interface MpayManagerAwareInterface
{
    public function setMpayManager(MpayManagerInterface $mpayManager);
    public function getMpayManager();
}
