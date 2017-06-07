# LIN3S PHP CS Fixer Config
>PHP linting tool using [PHP CS Fixer][2] for [LIN3S][1] projects

[![Build Status](https://travis-ci.org/lin3s/PhpCsFixerConfig.svg?branch=master)](https://travis-ci.org/lin3s/PhpCsFixerConfig)

It's based on [`kreta/php-cs-fixer-config`](https://github.com/kreta/php-cs-fixer-config/).

## Installation
```bash
$ composer require --dev lin3s/php-cs-fixer-config
```
  
## Usage
### Configuration
Create a configuration file `.php_cs` in the root of your project:
```php
<?php

/*
 * This file is part of the PhpCsFixerConfig project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use LIN3S\PhpCsFixerConfig\Lin3sConfig;

$config = new Lin3sConfig('LIN3S awesome project', '2017');
$config->getFinder()->in(__DIR__ . '/src');

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
```
In case your project uses [PhpSpec][3] BDD test framework, also create a `.phpspec_cs` file in the root of your project:
```php
<?php

/*
 * This file is part of the PhpCsFixerConfig project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use LIN3S\PhpCsFixerConfig\Lin3sConfig;

$config = new Lin3sConfig('LIN3S awesome project', '2017', true);
$config->getFinder()
    ->in(__DIR__ . '/tests/Spec')
    ->name('*Spec.php');

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
```

### Git
Add `.php_cs.cache` (this is the cache file created by `php-cs-fixer`) to `.gitignore`:
```bash
/vendor
/.php_cs.cache
```

### Composer
Add the following scripts in the `composer.json` file:
```json
(...)

"scripts": {
    (...)

    "cs": [
        "php-cs-fixer fix --config=.php_cs -v",
        "php-cs-fixer fix --config=.phpspec_cs -v"
    ]
},
```

### Travis
Update your `.travis.yml` to cache the `php_cs.cache` file:
```yml
cache:
  directories:
    - $HOME/.php-cs-fixer
```
Then run `php-cs-fixer` in the `script` section:
```yml
script:
  - vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --diff --dry-run
  - vendor/bin/php-cs-fixer fix --config=.phpspec_cs --verbose --diff --dry-run
```

## Fixing issues
### Manually
If you need to fix issues locally and if you previously added the composer script, just run:
```bash
$ composer run-script cs
```
otherwise you can run:
```bash
$ vendor/bin/php-cs-fixer fix -v
$ vendor/bin/php-cs-fixer fix -v --config=.phpspec_cs 
```

## Licensing Options
[![License](https://poser.pugx.org/lin3s/php-cs-fixer-config/license.svg)](https://github.com/LIN3S/PhpCsFixerConfig/blob/master/LICENSE)

[1]: http://lin3s.com/
[2]: http://cs.sensiolabs.org/
[3]: http://www.phpspec.net/
