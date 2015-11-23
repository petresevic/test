<?php

namespace Mpay\Service\Manager;

use Zend\Http\Request;

class Manager implements ManagerInterface
{
    protected $connector;
    protected $cache;

    public function userLogin($username, $password)
    {
        $params = array(
            'method'           => Request::METHOD_POST,
            'path_url'         => '/oauth/token',
            'use_oauth_params' => true,
            'params'           => array(
                'username' => $username,
                'password' => $password,
            ),
        );

        $status   = false;
        $response = $this->getConnector()->connect($params);

        if ($response->isOk()) {
            $data = $this->formatResponse(json_decode($response->getBody()));
            if (isset($data['access_token']) && $data['access_token']) {
                $this->getConnector()->setAccessToken($data['access_token']);
                $this->getConnector()->setUsername($username);

                $this->getCache()->set($this->getConnector()->getAccessTokenCachePrefix() . $this->getCache()->getSessionId(), $this->getConnector()->getAccessToken());
                $this->getCache()->set($this->getConnector()->getUsernameCachePrefix() . $this->getCache()->getSessionId(), $this->getConnector()->getUsername());

                $status = true;
            }
        }

        return $status;
    }

    public function userLoadProfile($username, $accessToken)
    {
        $user = null;

        $params = array(
            'method'   => Request::METHOD_GET,
            'path_url' => '/users/' . $username,
            'params'   => array(
                'access_token' => $accessToken,
            ),
        );

        $response = $this->getConnector()->connect($params);

        //var_dump($response->getBody());

        if ($response->isOk()) {

            //var_dump($response->getBody());

            //$data = $this->formatResponse(json_decode($response->getBody()));

            //var_dump($data);

        }

        return $user;
    }

    protected function formatResponse($data)
    {
        if (! is_array($data) && (! $data instanceof \stdClass)) return $data;

        $formatted = array();

        foreach ($data as $key => $value) {
            $formatted[$key] = $value;
        }

        return $formatted;
    }

    /** @return \Mpay\Service\Connector\Connector */
    public function getConnector()
    {
        return $this->connector;
    }

    public function setConnector($connector)
    {
        $this->connector = $connector;
    }

    /** @return \Mpay\Service\Cache\Cache */
    public function getCache()
    {
        return $this->cache;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;
    }
}
