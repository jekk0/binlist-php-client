<?php
namespace Jekk0\Binlist\Client\ValueObject;

class Result
{
    public function __construct(
        private Card $card,
        private Bank $bank,
        private Country $country
    ){}

    public function getCard(): Card
    {
        return $this->card;
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }
}