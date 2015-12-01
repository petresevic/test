<?php

namespace Mpay\Service\Connector;

interface ConnectorInterface
{
    public function userLogin($username, $password);
    public function userProfile($username, $accessToken);
    public function userRegister($data);
    public function connect(array $options = array());
}
