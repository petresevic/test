<?php

namespace Mpay\Service\Manager;

class Manager implements ManagerInterface
{
    protected $connector;
    protected $cache;

    public function userLogin($username, $password)
    {
        $params = array(
            'method'           => 'POST',
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
