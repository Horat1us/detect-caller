# PHP Detect Caller

[![Latest Stable Version](https://poser.pugx.org/horat1us/detect-caller/version)](https://packagist.org/packages/horat1us/detect-caller)
[![Total Downloads](https://poser.pugx.org/horat1us/detect-caller/downloads)](https://packagist.org/packages/horat1us/detect-caller)
[![Test & Lint](https://github.com/Horat1us/detect-caller/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/Horat1us/detect-caller/actions/workflows/php.yml)
[![codecov](https://codecov.io/gh/horat1us/detect-caller/branch/master/graph/badge.svg)](https://codecov.io/gh/horat1us/detect-caller)

Util to detect caller of current method/function.

Compatibility: tested on PHP 8.4, PHP 8.5

## Installation
Using composer:
```bash
composer require horat1us/detect-caller
```

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
