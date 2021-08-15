<?php

namespace Jekk0\Binlist\Client\Result;

use Jekk0\Binlist\Client\ValueObject\Bank;
use Jekk0\Binlist\Client\ValueObject\Card;
use Jekk0\Binlist\Client\ValueObject\Country;
use Jekk0\Binlist\Client\ValueObject\CardNumber;
use Jekk0\Binlist\Client\ValueObject\Result;

class ResultValueObjectBuilder implements ResultBuilderInterface
{
    private const DATA_DEFAULT = [
        'number' => [
            'length' => null,
            'luhn' => null
        ],
        'scheme' => null,
        'type' => null,
        'brand' => null,
        'prepaid' => null,
        'bank' => [
            'name' => null,
            'url' => null,
            'phone' => null,
            'city' => null,
        ],
        'country' => [
            'numeric' => null,
            'alpha2' => null,
            'name' => null,
            'emoji' => null,
            'currency' => null,
            'latitude' => null,
            'longitude' => null,
        ]
    ];

    public function build(string $content): Result
    {
        $data = json_decode($content, true);

        $data = array_replace_recursive(self::DATA_DEFAULT, $data);

        return new Result(
            $this->buildCard($data),
            $this->buildBank($data),
            $this->buildCountry($data)
        ); 
    }
    
    private function buildCard(array $data): Card
    {
        $cardNumber = new CardNumber(
            length: (int)$data['number']['length'],
            luhn: (bool)$data['number']['luhn']
        );

        return new Card(
            number: $cardNumber,
            scheme: (string)$data['scheme'],
            type: (string)$data['type'],
            brand: (string)$data['brand'],
            prepaid: (string)$data['prepaid'],
        );
    }

    private function buildBank(array $data): Bank
    {
        return new Bank(
            name: (string)$data['bank']['name'],
            url: (string)$data['bank']['url'],
            phone: (string)$data['bank']['phone'],
            city: (string)$data['bank']['city'],
        );
    }

    private function buildCountry(array $data): Country
    {
        return new Country(
            numeric: (string)$data['country']['numeric'],
            alpha2: (string)$data['country']['alpha2'],
            name: (string)$data['country']['name'],
            emoji: (string)$data['country']['emoji'],
            currency: (string)$data['country']['currency'],
            latitude: (string)$data['country']['latitude'],
            longitude: (string)$data['country']['longitude'],
        );
    }
}