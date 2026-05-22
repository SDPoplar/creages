<?php
namespace App\Services\Auth;

class Surface extends \Mxs\Services\Redis\RedisService
{
    protected const string CONNECT = 'auth';

    public static function getToken(string $key): string
    {
        return new self()->getRedisIns()->get(self::buildCacheKey($key)) ?: '';
    }

    public static function setToken(string $key, string $content, int $life_seconds): bool
    {
        if ($life_seconds > 0) {
            return new self()->getRedisIns()->set(self::buildCacheKey($key), $content, $life_seconds);
        } else {
            return new self()->getRedisIns()->set(self::buildCacheKey($key), $content);
        }
    }

    protected static function buildCacheKey(string $origin): string
    {
        return 'AT_' . $origin;
    }
}
