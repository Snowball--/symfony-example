<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MixRepository
{
    /**
     * @param CacheInterface $cache
     * @param HttpClientInterface $client
     */
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly HttpClientInterface $client,
        private readonly bool $isDebug
    ) {}

    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function findAll(): array
    {
        return $this->cache->get('mixes_data', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $response = $this->client->request(
                'GET',
                'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json'
            );

            return $response->toArray();
        });
    }
}