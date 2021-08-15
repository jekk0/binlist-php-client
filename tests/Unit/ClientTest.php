<?php

namespace Jekk0\Binlist\Client\Tests\Unit;

use Jekk0\Binlist\Client\Client;
use Jekk0\Binlist\Client\ValueObject\Result;
use \PHPUnit\Framework\TestCase;
use \GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use function PHPUnit\Framework\once;

class ClientTest extends TestCase
{
    public function testGet()
    {
        $streamMock = $this->createMock(StreamInterface::class);
        $streamMock->expects($this->once())->method('getContents')->willReturn('{}');

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(once())->method('getBody')->willReturn($streamMock);

        $guzzleClientMock = $this->createMock(GuzzleClient::class);
        $guzzleClientMock->expects($this->once())->method('request')->willReturn($response);

        $binlistClient = new Client($guzzleClientMock);

        $bin = '123456';
        $result = $binlistClient->get($bin);

        $this->assertInstanceOf(Result::class, $result);
    }
}
