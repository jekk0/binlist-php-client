# The composer php client for interact with binlist.net api. (IN DEVELOPMENT)

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

// Fields may contain null values which suggests that cards may be one or the other.
// If no matching cards are found an HTTP 404 response is returned.

```

### Documentations
* https://binlist.net/

