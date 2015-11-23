<?php

namespace Mpay\Service\Connector;

use Zend\Http\Request;

class Connector implements ConnectorInterface
{
    protected $client;
    protected $cache;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $grantType;
    protected $accessToken;
    protected $accessTokenCachePrefix;

    public function connect(array $options = array())
    {
        $options['url']              = isset($options['url'])              ? $options['url']              : '';
        $options['base_url']         = isset($options['base_url'])         ? $options['base_url']         : $this->getBaseUrl();
        $options['path_url']         = isset($options['path_url'])         ? $options['path_url']         : '';
        $options['method']           = isset($options['method'])           ? $options['method']           : Request::METHOD_GET;
        $options['params']           = isset($options['params'])           ? $options['params']           : array();
        $options['use_oauth_params'] = isset($options['use_oauth_params']) ? $options['use_oauth_params'] : false;

        if ($options['url']) {
            $this->getClient()->setUri($options['url']);
        } else {
            $this->getClient()->setUri($options['base_url'] . $options['path_url']);
        }
        $this->getClient()->setMethod($options['method']);

        $params = array();

        if ($options['use_oauth_params']) {
            $params['client_id']     = $this->getClientId();
            $params['client_secret'] = $this->getClientSecret();
            $params['grant_type']    = $this->getGrantType();
        }

        if (is_array($options['params'])) {
            foreach ($options['params'] as $key => $value) {
                $params[$key] = $value;
            }
        }

        if (count($params)) {
            if ($options['method'] === Request::METHOD_POST) {
                $this->getClient()->setParameterPost($params);
            } else {
                $this->getClient()->setParameterGet($params);
            }
        }

        return $this->getClient()->send();
    }

    /** @return \Zend\Http\Client */
    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
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

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    public function getGrantType()
    {
        return $this->grantType;
    }

    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        $this->getCache()->set($this->getAccessTokenCachePrefix() . $this->getCache()->getSessionId(), $accessToken);
    }

    public function getAccessTokenCachePrefix()
    {
        return $this->accessTokenCachePrefix;
    }

    public function setAccessTokenCachePrefix($accessTokenCachePrefix)
    {
        $this->accessTokenCachePrefix = $accessTokenCachePrefix;
    }
}
