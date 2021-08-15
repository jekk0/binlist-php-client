<?php

namespace Jekk0\Binlist\Client\Result;

use Jekk0\Binlist\Client\ValueObject\Bank;
use Jekk0\Binlist\Client\ValueObject\Card;
use Jekk0\Binlist\Client\ValueObject\Country;
use Jekk0\Binlist\Client\ValueObject\CardNumber;
use Jekk0\Binlist\Client\ValueObject\Result;

class ResultValueObjectBuilder implements ResultBuilderInterface
{
    private const CAST_TO_BOOL = 0;
    private const CAST_TO_INT = 1;
    private const CAST_TO_STRING = 2;

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
            length: $this->getValue($data, ['number', 'length'], self::CAST_TO_INT),
            luhn: $this->getValue($data, ['number', 'luhn'], self::CAST_TO_BOOL)
        );

        return new Card(
            number: $cardNumber,
            scheme: $this->getValue($data, ['scheme'], self::CAST_TO_STRING),
            type: $this->getValue($data, ['type'], self::CAST_TO_STRING),
            brand: $this->getValue($data, ['brand'], self::CAST_TO_STRING),
            prepaid: $this->getValue($data, ['prepaid'], self::CAST_TO_STRING),
        );
    }

    private function buildBank(array $data): Bank
    {
        return new Bank(
            name: $this->getValue($data, ['bank', 'name'], self::CAST_TO_STRING),
            url: $this->getValue($data, ['bank', 'url'], self::CAST_TO_STRING),
            phone: $this->getValue($data, ['bank', 'phone'], self::CAST_TO_STRING),
            city: $this->getValue($data, ['bank', 'city'], self::CAST_TO_STRING),
        );
    }

    private function buildCountry(array $data): Country
    {
        return new Country(
            numeric: $this->getValue($data, ['country', 'numeric'], self::CAST_TO_INT),
            alpha2: $this->getValue($data,['country', 'alpha2'], self::CAST_TO_STRING),
            name: $this->getValue($data,['country', 'name'], self::CAST_TO_STRING),
            emoji: $this->getValue($data,['country','emoji'], self::CAST_TO_STRING),
            currency: $this->getValue($data,['country', 'currency'], self::CAST_TO_STRING),
            latitude: $this->getValue($data, ['country', 'latitude'], self::CAST_TO_INT),
            longitude: $this->getValue($data, ['country', 'longitude'], self::CAST_TO_INT),
        );
    }

    private function getValue(array $data, array $keys, int $castTo): mixed
    {
        foreach ($keys as $key) {
            if (is_array($data) && !array_key_exists($key, $data)) {
                return null;
            }

            if (!is_array($data)) {
                return null;
            }

            $data = $data[$key];
        }

        if ($data === null) {
            return null;
        }

        return match ($castTo) {
            self::CAST_TO_BOOL => (bool)$data,
            self::CAST_TO_INT => (int)$data,
            self::CAST_TO_STRING => (string)$data,
        };
    }
}