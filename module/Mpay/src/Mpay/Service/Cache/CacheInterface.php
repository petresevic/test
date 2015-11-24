<?php

namespace Mpay\Service\Cache;

interface CacheInterface
{
    public function get($namespace);
    public function set($namespace, $value);
    public function has($namespace);
}
