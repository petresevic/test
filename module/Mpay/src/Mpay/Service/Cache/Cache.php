<?php

namespace Mpay\Service\Cache;

class Cache implements CacheInterface
{
    protected $storage;
    protected $sessionId;

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

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }
}
