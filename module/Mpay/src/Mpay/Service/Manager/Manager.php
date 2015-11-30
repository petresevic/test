<?php

namespace Mpay\Service\Manager;

use Mpay\Service\Acl\AclAwareInterface;
use Mpay\Service\Acl\AclInterface;
use Mpay\Service\Cache\CacheAwareInterface;
use Mpay\Service\Cache\CacheInterface;
use Mpay\Service\Connector\ConnectorAwareInterface;
use Mpay\Service\Connector\ConnectorInterface;
use Mpay\Model\Entity\User;

class Manager implements ManagerInterface,
                         AclAwareInterface,
                         CacheAwareInterface,
                         ConnectorAwareInterface

{
    protected $acl;
    protected $cache;
    protected $connector;
    protected $sessionId;
    protected $accessToken;
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

    /** @return \Mpay\Service\Acl\Acl */
    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl(AclInterface $acl)
    {
        $this->acl = $acl;
    }

    /** @return \Mpay\Service\Cache\Cache */
    public function getCache()
    {
        return $this->cache;
    }

    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /** @return \Mpay\Service\Connector\Connector */
    public function getConnector()
    {
        return $this->connector;
    }

    public function setConnector(ConnectorInterface $connector)
    {
        $this->connector = $connector;
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
