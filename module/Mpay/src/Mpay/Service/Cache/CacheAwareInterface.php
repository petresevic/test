<?php

namespace Mpay\Service\Cache;

interface CacheAwareInterface
{
    public function setCache(CacheInterface $cache);
    public function getCache();
}
