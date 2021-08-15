<?php

namespace Jekk0\Binlist\Client\Result;

use Jekk0\Binlist\Client\ValueObject\Result;

interface ResultBuilderInterface
{
    public function build(string $content): Result;
}