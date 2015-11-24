<?php

namespace Mpay\Service\Connector;

use Zend\Http\Request;
use Zend\Stdlib\Hydrator\ClassMethods;
use Mpay\Model\Entity\User;

class Connector implements ConnectorInterface
{
    protected $client;
    protected $cache;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $grantType;

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

        $response = $this->connect($params);

        if ($response->isOk()) {
            $data = $this->formatResponse($response->getBody());
            if (isset($data['access_token']) && $data['access_token']) {

                return $data['access_token'];
            }
        }

        return null;
    }

    public function userProfile($username, $accessToken)
    {
        $params = array(
            'method'   => Request::METHOD_GET,
            'path_url' => '/users/' . $username,
            'params'   => array(
                'access_token' => $accessToken,
            ),
        );

        $response = $this->connect($params);

        if ($response->isOk()) {
            $data = $this->formatResponse($response->getBody());

            if (isset($data['user'])) {
                $data     = $data['user'];
                $hydrator = new ClassMethods();
                $user     = $hydrator->hydrate($data, new User());
                if ($user->getId() && $user->getUsername()) {

                    return $user;
                }
            }
        }

        return null;
    }

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

    protected function formatResponse($data)
    {
        if (is_string($data)) $data = json_decode($data);

        $data = json_decode(json_encode($data), true);

        return $data;
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
}
