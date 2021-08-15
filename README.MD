# The composer php client for interact with binlist.net api.
https://travis-ci.com/jekk0/binlist-php-client.svg?branch=master

[![Build Status](https://travis-ci.com/jekk0/binlist-php-client.svg?branch=master)](https://travis-ci.com/github/jekk0/binlist-php-client)
[![Coverage Status](https://codecov.io/gh/jekk0/binlist-php-client/branch/master/graphs/badge.svg)](https://app.codecov.io/gh/jekk0/binlist-php-client)
[![Latest Stable Version](https://poser.pugx.org/jekk0/binlist-php-client/v/stable)](https://packagist.org/packages/jekk0/binlist-php-client)
[![Total Downloads](https://poser.pugx.org/jekk0/binlist-php-client/downloads)](https://packagist.org/packages/jekk0/binlist-php-client)

### Requirements
- php >= 8.0

### Installation

Install the latest version with
```
 $ composer require jekk0/binlist-php-client
```

### Quick start.
```
<?php
require_once __DIR__ . '/vendor/autoload.php';

use \Jekk0\Binlist\Client\Client;
$client = new Client();

$bin = '45717360';

$result = $client->get($bin);

$cardLength = $result->getCard()->getNumber()->getLength(); // 16
var_dump($cardLength);

$cardScheme = $result->getCard()->getScheme(); // visa
var_dump($cardScheme);

$bankName = $result->getBank()->getName(); // Jyske Bank
var_dump($bankName);

$country = $result->getCountry()->getName(); // Denmark
var_dump($country);

// Other result available methods

// Card value object
$value = $result->getCard()->getNumber()->getLength(); // 16
$value = $result->getCard()->getNumber()->isLuhn(); // true
$value = $result->getCard()->getScheme(); // visa
$value = $result->getCard()->getType(); // debit
$value = $result->getCard()->getBrand(); // Visa/Dankort
$value = $result->getCard()->isPrepaid(); // false

// Bank value object
$value = $result->getBank()->getName(); // Jyske Bank
$value = $result->getBank()->getCity(); // Hjørring
$value = $result->getBank()->getPhone(); // +45....
$value = $result->getBank()->getUrl(); // www.....dk

// Country value object
$value = $result->getCountry()->getName(); // Denmark
$value = $result->getCountry()->getAlpha2(); // DK
$value = $result->getCountry()->getNumeric(); // 208
$value = $result->getCountry()->getCurrency(); // DKK
$value = $result->getCountry()->getEmoji(); // 🇩🇰
$value = $result->getCountry()->getLatitude(); // 56
$value = $result->getCountry()->getLongitude(); // 10

```

### Documentations
* https://binlist.net/
