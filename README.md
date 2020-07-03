# PHP Detect Caller

[![Latest Stable Version](https://poser.pugx.org/horat1us/detect-caller/version)](https://packagist.org/packages/horat1us/detect-caller)
[![Total Downloads](https://poser.pugx.org/horat1us/detect-caller/downloads)](https://packagist.org/packages/horat1us/detect-caller)
[![Build Status](https://travis-ci.org/Horat1us/detect-caller.svg?branch=master)](https://travis-ci.org/Horat1us/detect-caller)
[![codecov](https://codecov.io/gh/horat1us/detect-caller/branch/master/graph/badge.svg)](https://codecov.io/gh/horat1us/detect-caller)

Util to detect caller of current method/function.

## Installation
Using composer:
```bash
composer require horat1us/detect-caller
```
**Requires PHP 7.4 to stimulate language version upgrade*

## Usage
```php
<?php declare(strict_types=1);

use Horat1us\DetectCaller;

function ReturnOwnName(): string {
    return DetectCaller::function();
}

echo ReturnOwnName(); // ReturnOwnName
```
See [test case](./tests/DetectCallerTest.php) for more examples.

## Contributors
- [Alexander Letnikow](mailto:reclamme@gmail.com)

## License
[MIT](./LICENSE)
