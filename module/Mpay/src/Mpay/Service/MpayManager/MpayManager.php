<?php

namespace Mpay\Service\MpayManager;

class MpayManager implements MpayManagerInterface
{
    protected $client;
    protected $baseUrl;
    protected $apiUser;
    protected $apiPass;


    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getApiUser()
    {
        return $this->apiUser;
    }

    public function setApiUser($apiUser)
    {
        $this->apiUser = $apiUser;
    }

    public function getApiPass()
    {
        return $this->apiPass;
    }

    public function setApiPass($apiPass)
    {
        $this->apiPass = $apiPass;
    }
}
