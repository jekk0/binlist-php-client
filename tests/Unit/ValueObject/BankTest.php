<?php

namespace Jekk0\Binlist\Client\Tests\Integration;

use Jekk0\Binlist\Client\ValueObject\Bank;
use \PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
    public function testGetters()
    {
        $name = uniqid();
        $url = 'www.example.com';
        $phone = '+12345678890';
        $city = uniqid();

        $bank = new Bank($name, $url, $phone, $city);

        $this->assertSame($name, $bank->getName());
        $this->assertSame($url, $bank->getUrl());
        $this->assertSame($phone, $bank->getPhone());
        $this->assertSame($city, $bank->getCity());
    }
}
