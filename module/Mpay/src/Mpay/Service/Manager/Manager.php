<?php

namespace Mpay\Service\Manager;

use Mpay\Model\Entity\User;

class Manager implements ManagerInterface
{
    protected $connector;
    protected $cache;
    protected $sessionId;
    protected $accessToken;
    //protected $username;
    protected $loggedInUser;

    public function userLogin(User $user, $accessToken)
    {
        $this->setAccessToken($accessToken);
        $this->setLoggedInUser($user);

        $this->getCache()->set($this->getCache()->getAccessTokenCachePrefix() . $this->getSessionId(), $accessToken);
        $this->getCache()->set($this->getCache()->getUserCachePrefix() . $this->getSessionId(), serialize($user));
    }

    public function userLogout()
    {
        $this->setAccessToken(null);
        $this->setLoggedInUser(null);

        $this->getCache()->set($this->getCache()->getAccessTokenCachePrefix() . $this->getSessionId(), null);
        $this->getCache()->set($this->getCache()->getUserCachePrefix() . $this->getSessionId(), null);
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

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
    
    public function getLoggedInUser()
    {
        return $this->loggedInUser;
    }

    public function setLoggedInUser($loggedInUser)
    {
        $this->loggedInUser = $loggedInUser;
    }
}
