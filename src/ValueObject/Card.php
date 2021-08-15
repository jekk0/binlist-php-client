<?php
namespace Jekk0\Binlist\Client\ValueObject;

class Card
{
    public function __construct(
        private CardNumber $number,
        private ?string $scheme,
        private ?string $type,
        private ?string $brand,
        private ?bool $prepaid
    ){}

    public function getNumber(): CardNumber
    {
        return $this->number;
    }

    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function isPrepaid(): ?bool
    {
        return $this->prepaid;
    }
}