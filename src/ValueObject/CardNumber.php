<?php
namespace Jekk0\Binlist\Client\ValueObject;

class CardNumber
{
    public function __construct(
        private ?int $length,
        private ?bool $luhn
    ){}

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function isLuhn(): ?bool
    {
        return $this->luhn;
    }
}