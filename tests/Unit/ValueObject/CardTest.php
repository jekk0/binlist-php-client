<?php

namespace Jekk0\Binlist\Client\Tests\Integration;

use Jekk0\Binlist\Client\ValueObject\Card;
use Jekk0\Binlist\Client\ValueObject\CardNumber;
use \PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testGetters()
    {
        $length = 16;
        $luhn = true;
        $scheme = 'visa';
        $type = 'debit';
        $brand = 'Visa/Dankort';
        $prepaid = false;

        $cardNumber = $this->createMock(CardNumber::class);
        $cardNumber->expects($this->once())->method('getLength')->willReturn($length);
        $cardNumber->expects($this->once())->method('isLuhn')->willReturn($luhn);

        $card = new Card($cardNumber, $scheme, $type, $brand, $prepaid);

        $this->assertSame($length, $card->getNumber()->getLength());
        $this->assertSame($luhn, $card->getNumber()->isLuhn());

        $this->assertSame($scheme, $card->getScheme());
        $this->assertSame($type, $card->getType());
        $this->assertSame($brand, $card->getBrand());
        $this->assertSame($prepaid, $card->isPrepaid());
    }
}
