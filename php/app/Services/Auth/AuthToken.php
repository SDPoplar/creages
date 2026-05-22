<?php
namespace App\Services\Auth;

use App\Exceptions\CacheAuthFailed as ErrCacheAuthFailed;

class AuthToken
{
    public static function load(string $token): ?self
    {
        $cache_str = Surface::getToken($token);
        $unpacked = empty($cache_str) ? null : json_decode($cache_str);
        if (empty($unpacked)) {
            return null;
        }
        $ins = new self($unpacked->account_id);
        $ins->token = $token;
        $ins->cache_at = intval($unpacked->cache_at);
        $ins->expire_at = intval($unpacked->expire_at);
        return $ins;
    }

    public function __construct(
        public readonly int $account_id,
    ) {
        $this->life_seconds = config('auth.life_seconds', LifeSeconds::OneDay->value);
    }

    public function cache(): void
    {
        $ts = time();
        $this->cache_at = $ts;
        $this->expire_at = $this->life_seconds > 0 ? $ts + $this->life_seconds : -1;
        $this->token ??= md5('at_' . $this->account_id . '_' . $ts);
        Surface::setToken($this->token, $this->packCache(), $this->life_seconds)
            or throw new ErrCacheAuthFailed();
    }

    protected function packCache(): string
    {
        return json_encode([
            'account_id' => $this->account_id,
            'cache_at' => $this->cache_at,
            'expire_at' => $this->expire_at,
        ]);
    }

    public readonly int $life_seconds;
    public private(set) int $cache_at;
    public private(set) int $expire_at;
    public readonly string $token;
}
