<?php

namespace Jekk0\Binlist\Client\Tests\Integration;

use Jekk0\Binlist\Client\ValueObject\Bank;
use Jekk0\Binlist\Client\ValueObject\Card;
use Jekk0\Binlist\Client\ValueObject\CardNumber;
use Jekk0\Binlist\Client\ValueObject\Country;
use Jekk0\Binlist\Client\ValueObject\Result;
use \PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    public function testGetters()
    {
        $cardLength = 16;
        $cardLuhn = true;
        $cardScheme = 'visa';
        $cardType = 'debit';
        $cardBrand = 'Visa/Dankort';
        $cardPrepaid = false;

        $bankName = uniqid();
        $bankUrl = 'www.example.com';
        $bankPhone = '+12345678890';
        $bankCity = uniqid();

        $countryNumeric = 208;
        $countryAlpha2 = 'DK';
        $countryName = 'Denmark';
        $countryEmoji = '🇩🇰';
        $countryCurrency = 'DKK';
        $countryLatitude = 56;
        $countryLongitude = 10;

        // Card Number Mock
        $cardNumber = $this->createMock(CardNumber::class);
        $cardNumber->expects($this->once())->method('getLength')->willReturn($cardLength);
        $cardNumber->expects($this->once())->method('isLuhn')->willReturn($cardLuhn);

        // Card Mock
        $card = $this->createMock(Card::class);
        $card->expects($this->exactly(2))->method('getNumber')->willReturn($cardNumber);
        $card->expects($this->once())->method('getScheme')->willReturn($cardScheme);
        $card->expects($this->once())->method('getType')->willReturn($cardType);
        $card->expects($this->once())->method('getBrand')->willReturn($cardBrand);
        $card->expects($this->once())->method('isPrepaid')->willReturn($cardPrepaid);

        // Bank Mock
        $bank = $this->createMock(Bank::class);
        $bank->expects($this->once())->method('getName')->willReturn($bankName);
        $bank->expects($this->once())->method('getPhone')->willReturn($bankPhone);
        $bank->expects($this->once())->method('getUrl')->willReturn($bankUrl);
        $bank->expects($this->once())->method('getCity')->willReturn($bankCity);

        // Country Mock
        $country = $this->createMock(Country::class);
        $country->expects($this->once())->method('getNumeric')->willReturn($countryNumeric);
        $country->expects($this->once())->method('getAlpha2')->willReturn($countryAlpha2);
        $country->expects($this->once())->method('getName')->willReturn($countryName);
        $country->expects($this->once())->method('getEmoji')->willReturn($countryEmoji);
        $country->expects($this->once())->method('getCurrency')->willReturn($countryCurrency);
        $country->expects($this->once())->method('getLatitude')->willReturn($countryLatitude);
        $country->expects($this->once())->method('getLongitude')->willReturn($countryLongitude);


        $result = new Result($card, $bank, $country);

        // Card
        $this->assertSame($cardLength, $result->getCard()->getNumber()->getLength());
        $this->assertSame($cardLuhn, $result->getCard()->getNumber()->isLuhn());
        $this->assertSame($cardScheme, $result->getCard()->getScheme());
        $this->assertSame($cardType, $result->getCard()->getType());
        $this->assertSame($cardBrand, $result->getCard()->getBrand());
        $this->assertSame($cardPrepaid, $result->getCard()->isPrepaid());

        // Bank
        $this->assertSame($bankName, $result->getBank()->getName());
        $this->assertSame($bankPhone, $result->getBank()->getPhone());
        $this->assertSame($bankUrl, $result->getBank()->getUrl());
        $this->assertSame($bankCity, $result->getBank()->getCity());

        // Country
        $this->assertSame($countryNumeric, $result->getCountry()->getNumeric());
        $this->assertSame($countryAlpha2, $result->getCountry()->getAlpha2());
        $this->assertSame($countryName, $result->getCountry()->getName());
        $this->assertSame($countryEmoji, $result->getCountry()->getEmoji());
        $this->assertSame($countryCurrency, $result->getCountry()->getCurrency());
        $this->assertSame($countryLatitude, $result->getCountry()->getLatitude());
        $this->assertSame($countryLongitude, $result->getCountry()->getLongitude());
    }
}
