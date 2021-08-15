<?php

namespace Jekk0\Binlist\Client;

use Jekk0\Binlist\Client\Result\ResultBuilderInterface;
use Jekk0\Binlist\Client\Result\ResultValueObjectBuilder;
use Jekk0\Binlist\Client\ValueObject\Result;
use \GuzzleHttp\Client as GuzzleClient;

class Client implements ClientInterface
{
    private const API_ENDPOINT = 'https://lookup.binlist.net';
    private const API_VERSION_HEADER = 'Accept-Version';
    private const API_VERSION = '3';
    private const API_METHOD = 'POST';
    private const API_TIMEOUT = 2.0;

    private GuzzleClient $client;
    private ResultBuilderInterface $resultBuilder;

    public function __construct(
        ?GuzzleClient $client = null,
        ?ResultBuilderInterface $resultBuilder = null
    ) {
        if ($client === null) {
            $this->client = $this->createClient();
        }

        if ($resultBuilder === null) {
            $this->resultBuilder = new ResultValueObjectBuilder();
        }
    }

    public function get(string $bin): Result
    {
        $content = $this->client->request(self::API_METHOD, $bin)->getBody()->getContents();

        return $this->resultBuilder->build($content);
    }

    private function createClient()
    {
        return new \GuzzleHttp\Client(
            [
                'base_uri' => self::API_ENDPOINT,
                'timeout'  => self::API_TIMEOUT,
                'allow_redirects' => false,
                'headers' => [self::API_VERSION_HEADER => self::API_VERSION]
            ]
        );
    }
}