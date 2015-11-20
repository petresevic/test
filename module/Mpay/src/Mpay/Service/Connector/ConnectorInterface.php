<?php

namespace Mpay\Service\Connector;

interface ConnectorInterface
{
    public function connect(array $options = array());
}
