<?php

namespace Jekk0\Binlist\Client\Tests\Integration;

use Jekk0\Binlist\Client\ValueObject\CardNumber;
use \PHPUnit\Framework\TestCase;

class CardNumberTest extends TestCase
{
    public function testGetters()
    {
        $length = 16;
        $luhn = true;
        $cardNumber = new CardNumber($length, $luhn);

        $this->assertSame($length, $cardNumber->getLength());
        $this->assertSame($luhn, $cardNumber->isLuhn());
    }
}
