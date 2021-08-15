<?php

namespace Jekk0\Binlist\Client\Tests\Integration;

use Jekk0\Binlist\Client\ValueObject\Country;
use \PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    public function testGetters()
    {
        $numeric = 208;
        $alpha2 = 'DK';
        $name = 'Denmark';
        $emoji = '🇩🇰';
        $currency = 'DKK';
        $latitude = 56;
        $longitude = 10;

        $country = new Country($numeric, $alpha2, $name, $emoji, $currency, $latitude, $longitude);

        $this->assertSame($numeric, $country->getNumeric());
        $this->assertSame($alpha2, $country->getAlpha2());
        $this->assertSame($name, $country->getName());
        $this->assertSame($emoji, $country->getEmoji());
        $this->assertSame($currency, $country->getCurrency());
        $this->assertSame($latitude, $country->getLatitude());
        $this->assertSame($longitude, $country->getLongitude());
    }
}
