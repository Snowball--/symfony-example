<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class MixRepository
{
    /**
     * @param CacheInterface $cache
     * @param HttpClientInterface $client
     */
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly HttpClientInterface $githubContentClient,
        #[Autowire('%kernel.debug%')]
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
            $response = $this->githubContentClient->request(
                'GET',
                '/SymfonyCasts/vinyl-mixes/main/mixes.json'
            );

            return $response->toArray();
        });
    }
}