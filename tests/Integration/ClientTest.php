<?php

namespace Jekk0\Binlist\Client\Tests\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Jekk0\Binlist\Client\Client;
use \PHPUnit\Framework\TestCase;
use \GuzzleHttp\Client as GuzzleClient;

class ClientTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function testGet(Response $response, array $expected)
    {
        $mock = new MockHandler([$response]);

        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new GuzzleClient(['handler' => $handlerStack]);

        $binlistClient = new Client($guzzleClient);

        $bin = '123456';
        $result = $binlistClient->get($bin);

        // Card
        $this->assertSame($expected['cardLength'], $result->getCard()->getNumber()->getLength());
        $this->assertSame($expected['cardLuhn'], $result->getCard()->getNumber()->isLuhn());
        $this->assertSame($expected['cardScheme'], $result->getCard()->getScheme());
        $this->assertSame($expected['cardType'], $result->getCard()->getType());
        $this->assertSame($expected['cardBrand'], $result->getCard()->getBrand());
        $this->assertSame($expected['cardPrepaid'], $result->getCard()->isPrepaid());

        // Bank
        $this->assertSame($expected['bankName'], $result->getBank()->getName());
        $this->assertSame($expected['bankPhone'], $result->getBank()->getPhone());
        $this->assertSame($expected['bankUrl'], $result->getBank()->getUrl());
        $this->assertSame($expected['bankCity'], $result->getBank()->getCity());

        // Country
        $this->assertSame($expected['countryNumeric'], $result->getCountry()->getNumeric());
        $this->assertSame($expected['countryAlpha2'], $result->getCountry()->getAlpha2());
        $this->assertSame($expected['countryName'], $result->getCountry()->getName());
        $this->assertSame($expected['countryEmoji'], $result->getCountry()->getEmoji());
        $this->assertSame($expected['countryCurrency'], $result->getCountry()->getCurrency());
        $this->assertSame($expected['countryLatitude'], $result->getCountry()->getLatitude());
        $this->assertSame($expected['countryLongitude'], $result->getCountry()->getLongitude());
    }


    public function dataProvider()
    {
        return [
            'empty_response' => [
                new Response(200, [], file_get_contents(__DIR__ . '/../Resources/Response/empty.json')),
                [
                    // Card
                    "cardLength" => null,
                    "cardLuhn" => null,
                    "cardScheme" => null,
                    "cardType" => null,
                    "cardBrand" => null,
                    "cardPrepaid" => null,

                    // Bank
                    "bankName" => null,
                    "bankUrl" => null,
                    "bankPhone" => null,
                    "bankCity" => null,

                    // Country
                    "countryNumeric" => null,
                    "countryAlpha2" => null,
                    "countryName" => null,
                    "countryEmoji" => null,
                    "countryCurrency" => null,
                    "countryLatitude" => null,
                    "countryLongitude" => null,
                ]
            ],
            'bin_389501' => [
                new Response(200, [], file_get_contents(__DIR__ . '/../Resources/Response/389501.json')),
                [
                    // Card
                    "cardLength" => null,
                    "cardLuhn" => null,
                    "cardScheme" => 'discover',
                    "cardType" => 'credit',
                    "cardBrand" => null,
                    "cardPrepaid" => null,
                    // Bank
                    "bankName" => null,
                    "bankUrl" => null,
                    "bankPhone" => null,
                    "bankCity" => null,
                    // Country
                    "countryNumeric" => 840,
                    "countryAlpha2" => 'US',
                    "countryName" => 'United States of America',
                    "countryEmoji" => '🇺🇸',
                    "countryCurrency" => 'USD',
                    "countryLatitude" => 38,
                    "countryLongitude" => -97,
                ]
            ],
            'bin_430180' => [
                new Response(200, [], file_get_contents(__DIR__ . '/../Resources/Response/430180.json')),
                [
                    // Card
                    "cardLength" => 16,
                    "cardLuhn" => true,
                    "cardScheme" => 'visa',
                    "cardType" => 'debit',
                    "cardBrand" => 'Traditional',
                    "cardPrepaid" => true,
                    // Bank
                    "bankName" => null,
                    "bankUrl" => null,
                    "bankPhone" => null,
                    "bankCity" => null,
                    // Country
                    "countryNumeric" => 826,
                    "countryAlpha2" => 'GB',
                    "countryName" => 'United Kingdom of Great Britain and Northern Ireland',
                    "countryEmoji" => '🇬🇧',
                    "countryCurrency" => 'GBP',
                    "countryLatitude" => 54,
                    "countryLongitude" => -2,
                ]
            ],
            'bin_457173' => [
                new Response(200, [], file_get_contents(__DIR__ . '/../Resources/Response/457173.json')),
                [
                    // Card
                    "cardLength" => 16,
                    "cardLuhn" => true,
                    "cardScheme" => 'visa',
                    "cardType" => 'debit',
                    "cardBrand" => 'Traditional',
                    "cardPrepaid" => false,
                    // Bank
                    "bankName" => null,
                    "bankUrl" => null,
                    "bankPhone" => null,
                    "bankCity" => null,
                    // Country
                    "countryNumeric" => 208,
                    "countryAlpha2" => 'DK',
                    "countryName" => 'Denmark',
                    "countryEmoji" => '🇩🇰',
                    "countryCurrency" => 'DKK',
                    "countryLatitude" => 56,
                    "countryLongitude" => 10,
                ]
            ],
            'bin_527798' => [
                new Response(200, [], file_get_contents(__DIR__ . '/../Resources/Response/527798.json')),
                [
                    // Card
                    "cardLength" => null,
                    "cardLuhn" => null,
                    "cardScheme" => 'mastercard',
                    "cardType" => 'credit',
                    "cardBrand" => 'Platinum Immediate Debit',
                    "cardPrepaid" => null,
                    // Bank
                    "bankName" => 'NEW BANK NAME, N.A.',
                    "bankUrl" => 'www.example.com',
                    "bankPhone" => '(907) 111-2223',
                    "bankCity" => null,
                    // Country
                    "countryNumeric" => 643,
                    "countryAlpha2" => 'RU',
                    "countryName" => 'Russian Federation',
                    "countryEmoji" => '🇷🇺',
                    "countryCurrency" => 'RUB',
                    "countryLatitude" => 60,
                    "countryLongitude" => 100,
                ]
            ]
        ];
    }
}
