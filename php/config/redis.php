<?php
use \Mxs\Services\Redis\RedisConfig;

return [
    'def' => RedisConfig::host(
        env('REDIS_HOST', 'localhost'),
        env('REDIS_PORT', 6379),
        env('REDIS_HOST_TRANSPORT', false),
        env('REDIS_AUTH', ''),
        0
    ),

    'auth' => RedisConfig::host(
        env('REDIS_HOST', 'localhost'),
        env('REDIS_PORT', 6379),
        env('REDIS_HOST_TRANSPORT', false),
        env('REDIS_AUTH', ''),
        1
    ),
];