<?php

namespace Mpay\Service\Connector;

interface ConnectorAwareInterface
{
    public function setConnector(ConnectorInterface $connector);
    public function getConnector();
}
