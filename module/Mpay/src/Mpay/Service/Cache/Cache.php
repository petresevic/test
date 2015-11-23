<?php

namespace Mpay\Service\Cache;

class Cache implements CacheInterface
{
    protected $storage;
    protected $accessTokenCachePrefix;
    //protected $usernameCachePrefix;
    protected $userCachePrefix;

    public function get($namespace)
    {
        return $this->getStorage()->getItem($namespace);
    }

    public function set($namespace, $value)
    {
        $this->getStorage()->setItem($namespace, $value);

        return $value;
    }

    public function has($namespace)
    {
        return $this->getCache()->hasItem($namespace);
    }

    public function getStorage()
    {
        return $this->storage;
    }

    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    public function getAccessTokenCachePrefix()
    {
        return $this->accessTokenCachePrefix;
    }

    public function setAccessTokenCachePrefix($accessTokenCachePrefix)
    {
        $this->accessTokenCachePrefix = $accessTokenCachePrefix;
    }

//    public function getUsernameCachePrefix()
//    {
//        return $this->usernameCachePrefix;
//    }
//
//    public function setUsernameCachePrefix($usernameCachePrefix)
//    {
//        $this->usernameCachePrefix = $usernameCachePrefix;
//    }

    public function getUserCachePrefix()
    {
        return $this->userCachePrefix;
    }

    public function setUserCachePrefix($userCachePrefix)
    {
        $this->userCachePrefix = $userCachePrefix;
    }
}
